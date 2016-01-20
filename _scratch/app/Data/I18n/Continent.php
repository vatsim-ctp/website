<?php namespace CTP\Data\I18n;

use Illuminate\Database\Eloquent\SoftDeletes;

class Continent extends \CTP\Data\DataModel {

    public $table = "i18n_continent";
    public $primaryKey = "continent_id";
    public $incrementing = true;
    public $fillable = [];
    public $guarded = [];
    public $visible = ["name", "code"];

    public function countries(){
        return $this->hasMany("\CTP\Data\I18n\Country", "continent_id", "continent_id");
    }
}