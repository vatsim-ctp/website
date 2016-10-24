<?php

namespace CTP\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function scopeCode($query, $code){
        return $query->where("code", "LIKE", $code);
    }

    public static function getValue($code){
        return Setting::code($code)->first()->value;
    }
}
