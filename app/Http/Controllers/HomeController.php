<?php namespace BBMeter\Http\Controllers;

use BBMeter\Group;
use BBMeter\Repositories\QuestionRepository;
use BBMeter\Repositories\SurveyRepository;

class HomeController extends Controller {

	function index(SurveyRepository $sr)
	{
		$survey = $sr->latest();
		$questions = $this->returnSurveyQuestionsAsJSON(new QuestionRepository, $survey->id, true);
		$groups  = $sr->get_child_groups($questions);
		return view('latest')->withGroups($groups)->withLatest(true);
	}

	public function archieve()
	{
		$groups = Group::all()->toHierarchy();
		return view('home')->withGroups($groups);
	}

	public function aboutpage()
	{
		return view('aboutdi');
	}

	public function methodology()
	{
		return view('methodology');
	}

	function returnQuestionsAsJSON(QuestionRepository $qr, $group_id)
	{
		return $qr->get_by_group($group_id);
	}

	function returnSurveyQuestionsAsJSON(QuestionRepository $qr, $survey_id, $with_group=false)
	{
		return $qr->get_by_survey($survey_id, $with_group);
	}

	function questionData(QuestionRepository $qr, $question_id)
	{
		return $qr->get_question_data($question_id);
	}

}
