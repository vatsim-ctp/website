<?php namespace CTP\Data\Vdata;

use Illuminate\Database\Eloquent\SoftDeletes;

class Aircraft extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table        = "vdata_aircraft";
    public $incrementing = true;
    public $dates        = ["created_at", "updated_at", "deleted_at"];
    public $fillable     = [];
    public $guarded      = [];
    public $visible      = ["icao", "name", "manufacturer", "type", "engine_type", "engine_quantity", "weight_class", "climb_rate", "descent_rate", "service_ceiling", "cruise_tas"];
}
