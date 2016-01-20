<?php namespace CTP\Data\Vdata;

use Illuminate\Database\Eloquent\SoftDeletes;

class Airline extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "vdata_airline";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $visible = ["icao", "image_url", "iata", "callsign", "name", "virtual", "country"];
    public $appends = ['image_url'];

    public function country(){
        return $this->belongsTo("\CTP\Data\I18n\Country", "country_id", "country_id");
    }

    public function getVirtualAttribute(){
        return (bool) $this->attributes['virtual'];
    }

    public function getImageUrlAttribute(){
        if(file_exists(public_path()."/assets/airline_logos/".$this->icao.".png")){
            return asset("assets/airline_logos/".$this->icao.".png");
        } else {
            return null;
        }
    }
}