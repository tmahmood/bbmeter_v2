<?php namespace BBMeter\Repositories;

use BBMeter\Repositories\BaseRepositoryInterface;
use BBMeter\Question;

/**
 * Class QuestionRepository
 * @author Tarin Mahmood
 */
class QuestionRepository implements BaseRepositoryInterface
{
	public function all()
	{
		return Question::all();
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

	public function get_by_group($group_id)
	{
		return Question::where('group_id', $group_id)
			->with('survey', 'options')
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
			$gt = 'GroupedMultiBar';
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
				$response_data[$response->option_group->option_group_name][$i]['values'][] = [ strtotime($response->label) * 1000, (float) $response->value];
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
		return $response_data;
	}

 	private function get_graph_data($q)
	{
		$timestamp = strtotime($q->survey->survey_date);
		$survey_date = strftime("%b %Y", $timestamp);
		$moe = $q->survey->margin_or_error ;
		$sample_size = $q->survey->participants;

		$info_text = [
						$survey_date != "Nov -1" ? "Survey Date: " . $survey_date : '',
						$moe != 0 ? "MoE: " . $moe : "",
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


}


