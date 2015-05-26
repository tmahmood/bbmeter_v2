<?php namespace BBMeter\Http\Controllers;

use BBMeter\Group;
use BBMeter\Question;
use BBMeter\Response;

class HomeController extends Controller {

	/*
	   |--------------------------------------------------------------------------
	   | Home Controller
	   |--------------------------------------------------------------------------
	   |
	   | This controller renders your application's "dashboard" for users that
	   | are authenticated. Of course, you are free to change or remove the
	   | controller as you wish. It is just here to get your app started!
	   |
	 */

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = Group::all()->toHierarchy();
		return view('home')->withGroups($groups);
	}

	function returnQuestionsAsJSON($group_id)
	{
		return Question::where('group_id', $group_id)->get();
	}

	function questionData($question_id)
	{
		$q = Question::find($question_id);

		$gdata = $this->get_graph_data($q);;

		if ($q->has_crosstabs == 0) {
			return $gdata;
		}

		$response_data = [];

		foreach ($q->options as $option){

			foreach ($option->responses as $response){

				if(!array_key_exists($response->option_group->option_group_name, $response_data)) {
					$response_data[$response->option_group->option_group_name]=['categories'=>[]];
				}

				if (!in_array($response->label, $response_data[$response->option_group->option_group_name]['categories'])) {
					$response_data[$response->option_group->option_group_name]['categories'][] = $response->label;
				}

				$response_data[$response->option_group->option_group_name][$option->id]['name'] = $option->label;
				$response_data[$response->option_group->option_group_name][$option->id]['data'][] = $response->value;
			}
		}

		$final_response_data = [];
		foreach ($response_data as $ky=>$response){
			$gd = $this->get_graph_data($q);
			$gd['values'] = $response;
			$gd['linktext'] = $ky;
			$final_response_data[] = $gd;
		}

		return [ $gdata, $final_response_data ];
	}

 	function get_graph_data($q)
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
