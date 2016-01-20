<?php namespace CTP\Data\Booking;

use Illuminate\Database\Eloquent\SoftDeletes;

class Atc extends \CTP\Data\UuidDataModel {

    use SoftDeletes;
    public $table = "booking_atc";
    public $primaryKey = "booking_atc_id";
    public $incrementing = false;
    public $dates = ["start_timestamp", "finish_timestamp", "created_at", "updated_at", "deleted_at"];
    public $fillable = ["user_id", "start_timestamp", "finish_timestamp", "notes"];
    public $guarded = [];
    public $hidden = ["user_id", "api_account_id", "airport_facility_position_id", "created_at", "deleted_at", "updated_at", "notes"];

    public function facilityPosition(){
        return $this->belongsTo("\CTP\Data\Vdata\Airport\Facility\Position", "airport_facility_position_id", "airport_facility_position_id");
    }

    public function facility(){
        return $this->facility_position->facility();
    }

    public function airport(){
        return $this->facility->airport();
    }

    public function user(){
        return $this->belongsTo("\CTP\Data\User", "user_id", "user_id");
    }

    public function setNotesAttribute($value){
        $this->attributes['notes'] = strip_tags($value);
    }
}