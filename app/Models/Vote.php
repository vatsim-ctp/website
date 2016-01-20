<?php

namespace \CTP\Models\Event\Nomination;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model {

	protected $table = 'event_nomination_vote';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function nomination()
	{
		return $this->belongsTo('\CTP\Models\Event\Nomination');
	}

	public function user()
	{
		return $this->belongsTo('\CTP\Models\User');
	}

}