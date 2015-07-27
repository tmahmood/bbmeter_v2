<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;
use BBMeter\Repositories\SurveyRepository;

class Surveycontroller extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	function create()
	{
		return view('surveys.form');
	}

	function edit($id, SurveyRepository $sr)
	{
		return view('surveys.form')->withSurvey($sr->find($id));
	}


	function save(SurveyRepository $sr, $id=null)
	{
		if ($sr->save(Request::except('_token')) !== null) {
			return redirect(url('/admin/surveys/'))
				->withMessage("New Survey Created");
		}
		return redirect(url('/admin/surveys/'))
			->withError("Failed to create new survey");
	}

	function update(SurveyRepository $sr, $id)
	{
		if ($sr->save(Request::except('_token'), $id) !== null) {
			redirect(url('/admin/surveys/'))
				->withMessage("Survey Updated");
		}
		return redirect(url('/admin/surveys/'))
			->withError("Faild to update survey");
	}

	function list_surveys(SurveyRepository $sr)
	{
		return view('surveys.list')->withSurveys($sr->all());
	}

}

