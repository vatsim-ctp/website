<?php

namespace CTP\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function scopeAspect($query, $aspect)
    {
        return $query->where("aspect", "LIKE", $aspect);
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', 'LIKE', $code);
    }

    public function scopeFindFull($query, $aspect, $code)
    {
        return $query->aspect($aspect)->code($code);
    }

    public static function getValue($aspect, $code)
    {
        return self::findFull($aspect, $code)->first()->value;
    }

    public function getValueOrDefaultAttribute()
    {
        if(!$this->attributes['value']){
            return $this->attributes['value_default'];
        }

        return $this->attributes['value'];
    }
}
