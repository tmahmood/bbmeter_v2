<?php namespace BBMeter\Http\Controllers;

use BBMeter\Group;
use BBMeter\Repositories\QuestionRepository;
use BBMeter\Repositories\GroupRepository;
use BBMeter\Repositories\SitevarRepository;
use BBMeter\Repositories\SurveyRepository;

class HomeController extends Controller {
	function __construct()
	{
		$this->qr = new QuestionRepository;
	}

	function index()
	{
		$questions = $this->qr->get_selected_question();
		return view('latest')->withQuestions($questions)->withLatest(true);
	}

	function latest(SurveyRepository $sr, GroupRepository $gr)
	{
		$survey = $sr->latest();
		$questions = $this->returnSurveyQuestionsAsJSON($survey->id, true);
		$groups  = $gr->get_child_groups($questions);
		return view('latest')->withGroups($groups)->withLatest(true)
					->withQuestions($questions)->withSurvey($survey);
	}

	public function archieve(GroupRepository $gr)
	{
		$groups = $gr->toHierarchy();
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

	function returnQuestionsAsJSON($group_id)
	{
		return $this->qr->get_by_group($group_id);
	}

	function returnSurveyQuestionsAsJSON( $survey_id, $with_group=false)
	{
		return $this->qr->get_by_survey($survey_id, $with_group);
	}

	function questionData($question_id)
	{
		return $this->qr->get_question_data($question_id);
	}

}
