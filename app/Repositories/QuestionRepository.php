<?php namespace BBMeter\Repositories;

use BBMeter\Repositories\BaseRepositoryInterface;
use BBMeter\Question;
use BBMeter\Option;
use BBMeter\Group;
use BBMeter\OptionGroup;
use BBMeter\Response;
use BBMeter\Repositories\GroupRepository;
use BBMeter\Repositories\SitevarRepository;

/**
 * Class QuestionRepository
 * @author Tarin Mahmood
 */
class QuestionRepository implements BaseRepositoryInterface
{
	function __construct()
	{
		$this->gr = new GroupRepository;
		$this->svr = new SitevarRepository;
	}

	public function all()
	{
		return Question::all();
	}

	function get_selected_question()
	{
		$fp_selection = $this->svr->find_by_name('FRONTPAGE_SELECTION');
		if ($fp_selection != null) {
			$ids = explode(',', $fp_selection);
			return Question::whereIn('id', $ids)->get();
		}
		throw new \Exception("No frontpage selection made");
	}

	function get_latest_few($how_many = 50)
	{
		return Question::limit($how_many)->orderBy('id', 'desc')->get();
	}

	function find($id)
	{
		return Question::find($id);
	}

	function save($data)
	{
		return Question::create($data);
	}

	public function get_by($by, $val)
	{
		return Question::where($by, $val)->firstOrFail();
	}

	function get_by_survey($survey_id, $with_group=false)
	{
		return Question::where('survey_id', $survey_id)
			->orderBy('ordering', 'asc')
			->orderBy('id', 'asc')
			->with('survey', 'options', 'group')
			->get();
	}

	public function get_by_group($group_id)
	{
		$s = Question::where('group_id', $group_id)
			->orderBy('ordering', 'asc')
			->orderBy('id', 'asc')
			->with('survey', 'options');
		return $s->get();
	}


	function get_by_keyword($kward)
	{
		return Question::where('key', 'like', "%$kward%")
			->orderBy('ordering', 'asc')
			->orderBy('id', 'asc')
			->with('survey', 'options', 'group')
			->get();
	}

	function get_question_data($question_id)
	{
		$q = $this->find($question_id);
		$gdata = $this->get_graph_data($q);;

		if ($q->has_crosstabs == 0) {
			return $gdata;
		}

		if ($q->graph_type == 'SimpleLine') {
			$response_data = $this->get_simple_line_chart($q, $gdata);
			$gt = 'SimpleLine';
		} else {
		 	$response_data = $this->get_grouped_bar_chart($q, $gdata);
			if (in_array($q->graph_type , ['VStackedBar', 'HStackedBar'])) {
				$gt = $q->graph_type;
			} else {
				$gt = 'GroupedMultiBar';
			}
		}

		$final_response_data = [];
		$option_groups = [];

		foreach ($response_data as $ky=>$response){
			$gd = $this->get_graph_data($q);
			$gd['type'] = $gt;
			$gd['values'] = $response;
			$final_response_data[] = $gd;
			$option_groups[] = $ky;
		}
		return [ $gdata, $final_response_data, $option_groups ];
	}

	function get_simple_line_chart($q)
	{
		$response_data = [];
		foreach ($q->options as $i=>$option){
			foreach ($option->responses as $response){
				$response_data[$response->option_group->option_group_name][$i]['key'] = $option->label;
				$response_data[$response->option_group->option_group_name][$i]['values'][] = [ strtotime($response->label) * 1000, (float) $response->value ];
			}
		}
		return $response_data;
	}


	function get_grouped_bar_chart($q)
	{
		$response_data = [];
		foreach ($q->options as $i=>$option){
			foreach ($option->responses as $response){
				if(!array_key_exists($response->option_group->option_group_name, $response_data)) {
					$response_data[$response->option_group->option_group_name]=['categories'=>[]];
				}
				if (!in_array($response->label, $response_data[$response->option_group->option_group_name]['categories'])) {
					$response_data[$response->option_group->option_group_name]['categories'][] = $response->label;
				}
				$response_data[$response->option_group->option_group_name]['data'][$i]['name'] = $option->label;
				$response_data[$response->option_group->option_group_name]['data'][$i]['data'][] = (float) $response->value;
			}
		}
		return (array)$response_data;
	}


 	private function get_graph_data($q)
	{
		$timestamp = strtotime($q->survey->survey_date);
		$survey_date = strftime("%b %Y", $timestamp);
		$moe = $q->survey->margin_of_error ;
		$sample_size = $q->survey->participants;

		$info_text = [
						$survey_date != "Nov -1" ? "Survey Date: " . $survey_date : '',
						$moe != 0 ? "Margin of Error: " . $moe : "",
						$sample_size != 0 ? "Sample size: ". $sample_size : ""
					];

		if ($q->extra_info != '') {
			$info_text[] = $q->extra_info;
		}

		return [
			'type'=> $q->graph_type,
			'info'=> trim(implode(" / ", $info_text), ' / '),
			'key'=> $q->key,
			'container' => '#chart',
			'values' => $q->options,
			'explanation' => [
				'heading' => 'Explain the graph',
				'text' => 'We explain the graph for your understanding',
				]
			];
	}

	function save_question($survey, $question)
	{
		$group = $this->gr->get_group_by_path($question->group);
		$q = Question::create([
				'key' => $question->key,
				'survey_id' => $survey->id,
				'group_id' => $group->id,
				'graph_type' => $question->type,
				'guid' => $survey->survey_guid . '_' . $question->filename,
				'ordering' => array_key_exists('ordering', $question) ? $question->ordering : 0,
				'extra_info' => array_key_exists('extra_info', $question) ? $question->extra_info : '',
		]);
		return $q;
	}

	function is_grouped_types($type)
	{
		return in_array($type, [ 'GroupedMultiBar', 'SimpleLine', 'HStackedBar', 'VStackedBar', 'HGStackedBar' ]);
	}

	function save_question_and_options($survey, $question)
	{
		if (!$this->is_grouped_types($question->type)) {

			$q = $this->save_question($survey, $question);
			$vals = [];

			foreach ($question->values as $value){
				$vals[] = new Option((array)$value);
			}
			return $q->options()->saveMany($vals);

		} else {

			if(!array_key_exists('related_to', $question)) {
				$q = $this->save_question($survey, $question);
				$vals = [];
				foreach ($question->values->data as $value){
					$vals[] = new Option([ "label"=> $value->name ]);
				}
				$q->options()->saveMany($vals);
			}

		}

		if (!isset($q) or $q == null) {
			$q = Question::where('guid', $survey->survey_guid . "_" . $question->related_to)->firstOrFail();
		}

		$option_group = OptionGroup::where("option_group_name", $question->option_group)->first();
		if ($option_group == null) {
			$option_group = OptionGroup::create( [ 'option_group_name' => strtolower($question->option_group) ] );
		}

		foreach ($question->values->data as $data){

			$option = Option::where('question_id', $q->id)
								->where('label', $data->name)
								->first();
			if ($option == null) {
				var_dump($data);
				throw new \Exception("Option not found");
			}
			$responses = [];
			foreach ($question->values->categories as $idx => $category){
					$responses[] = new Response([
										"label" => $category,
										"value" => $data->data[$idx],
										"option_group_id" => $option_group->id
									]);
			}

			$option->responses()->saveMany($responses);
			$q->has_crosstabs = 1;
			$q->save();
		}
	}

}


