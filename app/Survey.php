<?php namespace BBMeter;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model {
	protected $guarded = [ 'id' ];

	function surveytypes()
	{
		return $this->belongsTo('survey_types');
	}

	function questions()
	{
		return $this->hasMany('BBMeter\Question');
	}


}
