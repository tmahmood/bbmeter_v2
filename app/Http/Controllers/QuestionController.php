<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;
use BBMeter\Repositories\GroupRepository;
use BBMeter\Repositories\QuestionRepository;
use BBMeter\Repositories\SurveyRepository;
use BBMeter\Repositories\SitevarRepository;

class QuestionController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->qr = new QuestionRepository;
		$this->gr = new GroupRepository;
		$this->sr = new SitevarRepository;
	}

	function list_questions($survey_id)
	{
		$questions = $this->qr->get_by_survey($survey_id);
		return view('questions.list')->withQuestions($questions);
	}

	function list_selected_questions()
	{
		$questions = $this->qr->get_selected_question();
		$sitevar = $this->sr->find_or_create_by_name('FRONTPAGE_SELECTION');
		return view('questions.list')->withQuestions($questions)->with('frontpage_questions', $sitevar);
	}

	function list_latest_questions()
	{
		$questions = $this->qr->get_latest_few();
		$sitevar = $this->sr->find_or_create_by_name('FRONTPAGE_SELECTION');
		return view('questions.list')->withQuestions($questions)->with('frontpage_questions', $sitevar);
	}

	function save_frontpage_content()
	{
		$sitevar = $this->sr->find_or_create_by_name('FRONTPAGE_SELECTION');
		if ($sitevar->update(Request::except('_token')) != null) {
			return redirect(url('/admin/questions/latest'))
				->withMessage("Update frontpage questions");
		}

		return redirect(url('/admin/questions/latest'))
			->withError("Failed to update frontpage questions");
	}


	///////////////////////////////////////////////////////////////////////////////
	public function create()
	{
		$groups = $this->gr->toHierarchy();
		$tree = $this->gr->make_nice_tree($groups, "");
		return view('questions.form')->withGroups($tree);
	}
}

