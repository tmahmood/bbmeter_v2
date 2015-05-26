<?php namespace BBMeter;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {

	protected $guarded = [ 'id' ];

	function question()
	{
		return $this->belongsTo('BBMeter\Question');
	}

	function responses()
	{
		return $this->hasMany('BBMeter\Response');
	}

}
