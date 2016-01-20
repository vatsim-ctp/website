<?php namespace CTP\Data\Api;

use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends \CTP\Data\UuidDataModel {

    use SoftDeletes;
    public $table = "api_request";
    public $primaryKey = "api_request_id";
    public $incrementing = false;
    public $dates = ["created_at", "updated_at", "deleted_at"];
    public $fillable = ["method", "url", "data", "ip_raw"];
    public $guarded = [];

    public function apiAccount(){
        return $this->belongsTo("\CTP\Data\Api\Account", "api_account_id", "api_account_id");
    }

    public function ip(){
        return $this->belongsTo("\CTP\Data\Api\Account\ip", "api_account_ip_id", "api_account_ip_id");
    }

    public function setResponseAttribute($value){
        $this->attributes['response'] = json_encode($value);
    }

    public function getResponseAttribute(){
        return json_decode($this->attributes['response']);
    }

    public function setDataAttribute($value){
        $this->attributes['data'] = json_encode($value);
    }

    public function getDataAttribute($value){
        return json_decode($this->attributes['data']);
    }

    public function setIpRawAttribute($value){
        $this->attributes['ip_raw'] = ip2long($value);
    }

    public function setIpAttribute($value){
        $this->setIpRawAttribute($value);
    }

    public function getTrueIpAttribute(){
        if($this->ip){
            return $this->ip->ip;
        } else {
            return long2ip($this->attributes['ip_raw']);
        }
    }

}