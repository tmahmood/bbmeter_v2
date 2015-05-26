<?php namespace BBMeter;

use Illuminate\Database\Eloquent\Model;

class SurveyType extends Model {
	protected $guarded = array('id', );

	function surveys()
	{
		return $this->hasMany('surveys');
	}

}

