<?php namespace BBMeter\Repositories;

/**
 * Interface for database interaction
 *
 * @package BBMeter\Contracts
 * @author Tarin mahmoo
 */
interface BaseRepositoryInterface
{
	public function all();
	public function save($data_array);
	public function get_by($by, $val);
}
