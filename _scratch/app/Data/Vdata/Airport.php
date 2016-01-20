<?php namespace CTP\Data\Vdata;

use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "vdata_airport";
    public $primaryKey = "airport_id";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $hidden = ["airport_id", "deleted_at", "created_at", "updated_at", "region_id", "type"];

    public function runways(){
        return $this->hasMany("\CTP\Data\Vdata\Airport\Runway", "airport_id", "airport_id");
    }

    public function region(){
        return $this->belongsTo("\CTP\Data\I18n\Region", "region_id", "region_id");
    }

    public function country(){
        return $this->region->country();
    }

    public function facilities(){
        return $this->hasMany("\CTP\Data\Vdata\Airport\Facility", "airport_id", "airport_id");
    }

    public function getLatitudeAttribute(){
        return (double) $this->attributes['latitude'];
    }

    public function getLongitudeAttribute(){
        return (double) $this->attributes['longitude'];
    }

    public function getElevationAttribute(){
        return (int) $this->attributes['elevation'];
    }
}
