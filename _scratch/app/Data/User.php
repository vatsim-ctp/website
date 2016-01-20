<?php namespace CTP\Data;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "user";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $hidden = ['email', 'admin', 'deleted_at', 'created_at', 'updated_at'];
}