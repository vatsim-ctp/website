<?php

namespace \CTP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends Model {

	protected $table = 'airport';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function event()
	{
		return $this->hasManyThrough('\CTP\Models\Event', '\CTP\Models\Event\Airport')->withPivot("type");
	}

	public function nominations()
	{
		return $this->hasMany('\CTP\Models\Event\Nomination');
	}

}