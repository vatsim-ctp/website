<?php

namespace CTP\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function scopeAspect($query, $aspect)
    {
        return $query->where('aspect', 'LIKE', $aspect);
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

    public static function getGroups()
    {
        $groups = Setting::select("aspect")
                         ->distinct()
                         ->get()
                         ->pluck("aspect");

        return $groups;
    }

    public static function buildValidatorRules()
    {
        $rules = [];

        foreach (Setting::all() as $setting) {
            $key = $setting->aspect . "." . $setting->code;

            $rule = "";

            if ($setting->required) {
                $rule .= "required|";
            } else {
                $rule .= "nullable|";
            }

            if ($setting->type == "date" || $setting->type == "timestamp") {
                $rule .= "date|";
            } elseif ($setting->type == "time") {
                $rule .= "date_format:H:i:s|";
            } else {
                $rule .= $setting->type . "|";
            }

            if ($setting->value_options !== null) {
                $rule .= "in:" . implode(",", $setting->value_options) . "|";
            }

            $rule .= $setting->type_validation . "|";

            $rules[$key] = rtrim($rule, "|");
        }

        return $rules;
    }

    public function getValueOptionsAttribute()
    {
        return json_decode($this->attributes['value_options']);
    }

    public function getValueOrDefaultAttribute()
    {
        if (!$this->attributes['value']) {
            return $this->attributes['value_default'];
        }

        return $this->attributes['value'];
    }

    public function getFormNameAttribute()
    {
        return $this->attributes['aspect'] . "[" . $this->attributes['code'] . "]";
    }

    public function getNameAttribute()
    {
        $name = $this->attributes['aspect'] . " " . $this->attributes['code'];

        return ucwords(str_replace("_", " ", $name));
    }

    public function getHasChangedAttribute()
    {
        return $this->attributes['value'] != null;
    }
}
