<?php

namespace CTP\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $dates = ['created_at', 'updated_at'];

    public function airfield()
    {
        return $this->belongsTo(Airfield::class, 'airfield_id', 'id');
    }
}
