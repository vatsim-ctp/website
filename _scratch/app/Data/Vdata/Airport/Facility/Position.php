<?php namespace CTP\Data\Vdata\Airport\Facility;

use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "vdata_airport_facility_position";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $hidden = ["airport_facility_position_id", "airport_facility_id", "deleted_at", "updated_at", "created_at"];
    public $touches = ['facility', 'airport'];

    public function facility(){
        return $this->belongsTo("\CTP\Data\Vdata\Airport\Facility", "airport_facility_id", "airport_facility_id");
    }

    public function airport(){
        return $this->facility->airport();
    }

    public function getNameAttribute(){
        if($this->attributes['name'] == "" && $this->facility){
            return $this->facility->name;
        } else {
            return $this->attributes['name'];
        }
    }

    public function getFrequencyAttribute(){
        return (double) $this->attributes['frequency'];
    }
}