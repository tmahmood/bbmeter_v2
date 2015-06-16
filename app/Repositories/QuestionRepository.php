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

		$final_response_data = [];
		$option_groups = [];

		foreach ($response_data as $ky=>$response){
			$gd = $this->get_graph_data($q);
			$gd['type'] = 'GroupedMultiBar';
			$gd['values'] = $response;
			$gd['linktext'] = $ky;
			$gd['key'] .= " - $ky";
			$final_response_data[] = $gd;
			$option_groups[] = $ky;
		}

		return [ $gdata, $final_response_data, $option_groups ];
	}

 	private function get_graph_data($q)
	{
		$timestamp = strtotime($q->survey->survey_date);
		return [
			'type'=> $q->graph_type,
			'linktext' => 'Main',
			'info'=> "Survey Date: " . strftime("%b %Y", $timestamp).
				" / Margin of Error: " . $q->survey->margin_or_error .
				"% / No of Participants: ". $q->survey->participants,
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


