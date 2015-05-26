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
		$timestamp = strtotime($q->survey->survey_date);

		$gdata = [
					'type'=> $q->graph_type,
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

		$responses = [];
		foreach ($q->options as $option){
			foreach ($option->responses as $response){
				$ogn = $response->option_group->option_group_name;
				if(!array_key_exists($ogn, $responses)) {
					$responses[$ogn] = [
						'categories' => [],
					];
				}
				$responses[$ogn]['categories'][] = $response->label;
				//$d[$option->id][]= $response->value;
			}
			//$responses[]
		}
		dd ($responses);
		return $responses;
	}
}
