<?php namespace BBMeter\Http\Controllers;

use BBMeter\Group;
use BBMeter\Repositories\QuestionRepository;
use BBMeter\Repositories\SurveyRepository;
use BBMeter\Repositories\GroupRepository;

class HomeController extends Controller {

	function index(SurveyRepository $sr, GroupRepository $gr, QuestionRepository $qr)
	{
		$survey = $sr->latest();
		$questions = $qr->get_by_survey($survey->id);
		return view('latest')->withQuestions($questions)->withLatest(true);
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
