<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;
use BBMeter\Survey;

class Surveycontroller extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	function create()
	{
		return view('surveys.form');
	}

	function save()
	{
		if (Survey::create(Request::except('_token')) !== null) {
			redirect(url('/admin/survey/create'))
				->withMessage("New Survey Created");
		}
	}
}

