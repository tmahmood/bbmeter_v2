<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;

class QuestionController extends Controller {
	public function __construct()
	{
		// add authentication
		$this->middleware('auth');
	}

	public function create()
	{
		return view('questions.form');
	}


}

