<?php namespace BBMeter\Http\Controllers;

use BBMeter\Group;
use BBMeter\Repositories\QuestionRepository;

class HomeController extends Controller {

	public function index()
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

	function questionData(QuestionRepository $qr, $question_id)
	{
		return $qr->get_question_data($question_id);
	}

}
