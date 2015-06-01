<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;

class Surveycontroller extends Controller {
	public function __construct()
	{
		// add authentication
		$this->middleware('auth');
	}

	function create()
	{
		return view('surveys.form');
	}

	function save()
	{
		if (Survey::create(Input::except('_token'))) {
			redirect_to(url('/home'))->withMessage("New Survey Created");
		}
	}
}

