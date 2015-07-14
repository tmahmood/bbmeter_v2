<?php namespace BBMeter\Repositories;

use BBMeter\Group;
use BBMeter\Repositories\BaseRepositoryInterface;

class GroupRepository implements BaseRepositoryInterface
{
	public function all()
	{
		return Group::all();
	}

	public function toHierarchy()
	{
		return Group::all()->toHierarchy();
	}

	function save($data)
	{
		return Group::create($data);
	}

	public function get_by($by, $val)
	{
		return Group::where($by, $val)->firstOrFail();
	}

	function get_group_by_path($group)
	{
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

	function make_nice_tree($groups, $parent_group="")
	{
		$tree = [];
		foreach ($groups as $group){
			$gname = "$parent_group/$group->group_name";
			$tree[] = [ $group->id, $gname ];
			if (count($group->children)  > 0) {
				$nodes = $this->make_nice_tree($group->children, $gname);
				$tree = array_merge($tree, $nodes);
			}
		}
		return $tree;
	}

	function get_child_groups($questions)
	{
		$groups = [];
		$parent_group = null;
		foreach ($questions as $question){
			if (array_key_exists($question->group_id, $groups)) {
				continue;
			}

			if ($parent_group == null) {
				$parent_group = Group::find($question->group->parent_id);

			} elseif ($question->group->parent_id < $parent_group->id) {
				$parent_group = $question->group_id;
			}

			$groups[$question->group_id] = $question->group;
		}

		return $parent_group->getDescendantsAndSelf()->toHierarchy();
	}

}

