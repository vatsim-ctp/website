<?php namespace CTP\Data\I18n;

use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends \CTP\Data\DataModel {

    public $table = "i18n_region";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $visible = ["country", "name", "code"];
    public $touches = ['country', 'airports'];

    public function country(){
        return $this->belongsTo("\CTP\Data\I18n\Country", "country_id", "country_id");
    }

    public function airports(){
        return $this->hasMany("\CTP\Data\Vdata\Airport", "region_id", "region_id");
    }
}