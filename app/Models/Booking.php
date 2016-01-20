<?php

namespace \CTP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model {

	protected $table = 'booking';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function flight()
	{
		return $this->hasOne('\CTP\Models\Flight');
	}

}