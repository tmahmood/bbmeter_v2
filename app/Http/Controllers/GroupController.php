<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;
use BBMeter\Group;

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

	function save()
	{
		$group = Request::input('group');

		$groups = explode('/', $group);
		$group_root = array_shift($groups);

		$root = Group::roots()->where('group_name', $group_root)->first();
		if ($root == null) {
			$root = Group::create(['group_name'=> $group_root]);
		}

		foreach ($groups as $group){
			$node = $root->getDescendants()->where('group_name', $group)->first();
			if ($node == null) {
				$root = $root->children()->create(['group_name' => $group]);
			} else {
				$root = $node;
			}
		}
		return $root;
	}
}

