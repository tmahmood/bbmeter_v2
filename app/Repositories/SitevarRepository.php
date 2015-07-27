<?php namespace BBMeter\Repositories;

use BBMeter\Repositories\BaseRepositoryInterface;
use BBMeter\Sitevar;

/**
 * Class Sitevars
 * @author Tarin Mahmood
 */
class SitevarRepository
{
	public function all()
	{
		return Sitevar::all();
	}

	function get_latest_few($how_many = 50)
	{
		return Sitevar::limit($how_many)->get();
	}

	function find($id)
	{
		return Sitevar::find($id);
	}

	function find_or_create_by_name($name)
	{
		$sitevar = $this->find_by_name($name);
		if ($sitevar == null) {
			return Sitevar::create( [ 'var_name'=>$name, ] );
		}
		return $sitevar;
	}

	function find_by_name($name)
	{
		$sitevar = Sitevar::where('var_name', $name)->get();
		return $sitevar->first();
	}



	function save($data)
	{
		return Sitevar::create($data);
	}

	public function get_by($by, $val)
	{
		return Sitevar::where($by, $val)->firstOrFail();
	}

}

