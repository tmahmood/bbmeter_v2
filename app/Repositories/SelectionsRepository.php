<?php namespace BBMeter\Repositories;

use BBMeter\Repositories\BaseRepositoryInterface;
use BBMeter\Question;
use BBMeter\Option;
use BBMeter\Group;
use BBMeter\OptionGroup;
use BBMeter\Response;
use BBMeter\Selection;

/**
 * Class QuestionRepository
 * @author Tarin Mahmood
 */
class SelectionsRepository implements BaseRepositoryInterface
{
	function __construct()
	{
	}

	public function all()
	{
		return Selection::all();
	}

	function find($id)
	{
		return Selection::find($id);
	}

	function save($data)
	{
		return Selection::create($data);
	}

	public function get_by($by, $val)
	{
		return Selection::where($by, $val)->firstOrFail();
	}
}
