<?php namespace CTP\Data;

use \Illuminate\Database\Eloquent\Model;
use \Webpatser\Uuid\Uuid;

abstract class UuidDataModel extends DataModel {
    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->{$model->getKeyName()} = (String) Uuid::generate(4);
        });
    }
}