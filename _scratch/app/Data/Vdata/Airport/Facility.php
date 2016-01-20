<?php namespace CTP\Data\Vdata\Airport;

use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "vdata_airport_facility";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $hidden = ["airport_facility_id", "airport_id", "deleted_at", "updated_at", "created_at"];
    public $touches = ['airport'];

    public function airport(){
        return $this->belongsTo("\CTP\Data\Vdata\Airport", "airport_id", "airport_id");
    }

    public function positions(){
        return $this->hasMany("\CTP\Data\Vdata\Airport\Facility\Position", "airport_facility_id", "airport_facility_id");
    }
}