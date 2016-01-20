<?php namespace CTP\Data\Vdata\Airport;

use Illuminate\Database\Eloquent\SoftDeletes;

class Runway extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "vdata_airport_runway";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $hidden = ["airport_runway_id", "airport_id", "recipricol_id", "deleted_at", "updated_at", "created_at"];
    public $touches = ['airport'];

    public function airport(){
        return $this->belongsTo("\CTP\Data\Vdata\Airport", "airport_id", "airport_id");
    }

    public function recipricol(){
        return $this->belongsTo("\CTP\Data\Vdata\Airport\Runway", "recipricol_id", "airport_runway_id");
    }

    public function getIlsAttribute(){
        return (bool) $this->attributes['ils'];
    }

    public function getIlsCourseAttribute(){
        return (int) $this->attributes['ils_course'];
    }

    public function getIlsFreqAttribute(){
        return (double) $this->attributes['ils_freq'];
    }

    public function getGlidepathAttribute(){
        return (double) $this->attributes['glidepath'];
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

    public function getCourseAttribute(){
        return (int) $this->attributes['course'];
    }
}