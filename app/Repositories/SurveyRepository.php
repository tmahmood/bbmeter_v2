<?php namespace BBMeter\Repositories;

use BBMeter\Repositories\BaseRepositoryInterface;
use BBMeter\Survey;
use BBMeter\Group;

/**
 * Class QuestionRepository
 * @author Tarin Mahmood
 */
class SurveyRepository implements BaseRepositoryInterface
{
	public function all()
	{
		return Survey::all();
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


	function latest()
	{
		return Survey::orderBy('id', 'desc')->firstOrFail();
	}

	function find($id)
	{
		return Survey::find($id);
	}

	function save($data)
	{
		return Survey::create($data);
	}

	public function get_by($by, $val)
	{
		return Survey::where($by, $val)->firstOrFail();
	}

}


