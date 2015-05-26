<?php namespace BBMeter;

use Illuminate\Database\Eloquent\Model;

class Response extends Model {
	protected $guarded = [ 'id' ];

	//

	function option()
	{
		return $this->belongsTo('BBMeter\Option');
	}



	function option_group()
	{
		return $this->belongsTo('BBMeter\OptionGroup');
	}
}
