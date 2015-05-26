<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;

class Surveycontroller extends Controller {
	public function __construct()
	{
		// add authentication
		$this->middleware('auth');
	}

}

