<?php namespace CTP\Data\Api\Account;

use Illuminate\Database\Eloquent\SoftDeletes;

class Ip extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "api_account_ip";
    public $primaryKey = "api_account_ip_id";
    public $incrementing = true;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = [];
    public $guarded = [];
    public $touches = ['account'];

    public function account(){
        return $this->belongsTo("\CTP\Data\Api\Account", "api_account_id", "api_account_id");
    }

}