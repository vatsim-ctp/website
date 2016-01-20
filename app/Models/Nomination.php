<?php

namespace \CTP\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomination extends Model {

	protected $table = 'event_nomination';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function votes()
	{
		return $this->hasMany('\CTP\Models\Event\Nomination\Vote');
	}

	public function event()
	{
		return $this->belongsTo('\CTP\Models\Event');
	}

	public function airport()
	{
		return $this->belongsTo('\CTP\Models\Airport');
	}

}