<?php namespace CTP\Data\I18n;

use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends \CTP\Data\DataModel {

    public $table = "i18n_country";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $visible = ["continent", "name", "code", "small_image_url", "big_image_url"];
    public $touches = ['continent'];
    public $appends = ["small_image_url", "big_image_url"];

    public function continent(){
        return $this->belongsTo("\CTP\Data\I18n\Continent", "continent_id", "continent_id");
    }

    public function regions(){
        return $this->hasMany("\CTP\Data\I18n\Region", "country_id", "country_id");
    }

    public function getSmallImageUrlAttribute(){
        if(file_exists(public_path()."/assets/flags/small/".strtolower($this->code).".png")){
            return asset("assets/flags/small/".strtolower($this->code).".png");
        } else {
            return null;
        }
    }

    public function getBigImageUrlAttribute(){
        if(file_exists(public_path()."/assets/flags/big/".strtolower($this->code).".png")){
            return asset("assets/flags/big/".strtolower($this->code).".png");
        } else {
            return null;
        }
    }
}