<?php

namespace \CTP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {

	protected $table = 'event';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function airports()
	{
		return $this->hasManyThrough('\CTP\Models\Airport', '\CTP\Models\Event\Airport')->withPivot("type");
	}

	public function nominations()
	{
		return $this->hasMany('\CTP\Models\Event\Nomination');
	}

}