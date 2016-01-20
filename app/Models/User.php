<?php

namespace \CTP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {

	protected $table = 'user';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function votes()
	{
		return $this->hasMany('\CTP\Models\Event\Nomination\Vote');
	}

	public function bookings()
	{
		return $this->hasMany('\CTP\Models\Booking');
	}

	public function oldBookings()
	{
		return $this->hasMany('\CTP\Models\Booking')->onlyTrashed();
	}

}