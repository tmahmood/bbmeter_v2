<?php namespace BBMeter;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {
	protected $guarded = [ 'id' ];

	function options()
	{
		return $this->hasMany('BBMeter\Option');
	}

	function survey()
	{
		return $this->belongsTo('BBMeter\Survey');
	}

}
