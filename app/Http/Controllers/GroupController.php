<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;
use BBMeter\Group;
use BBMeter\Repositories\GroupRepository;

class Groupcontroller extends Controller {
	public function __construct()
	{
		// add authentication
		$this->middleware('auth');
	}

	function create()
	{
		return view('groups.form');
	}

	function save(GroupRepository $gr)
	{
		$group = Request::input('group');
		$gr->get_group_by_path($group);
	}
}

