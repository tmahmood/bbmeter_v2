<?php namespace BBMeter;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model {
	protected $guarded = array('id', );


	function responses()
	{
		return $this->hasMany('BBMeter\Response');
	}

}
