<?php namespace CTP\Data\Api\Account;

use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "api_permission";
    public $primaryKey = "api_permission_id";
    public $incrementing = true;
    public $fillable = [];
    public $guarded = [];
    public $touches = ['accounts'];

    public function types(){
        return $this->belongsToMany("\CTP\Data\Api\Account\Type", "api_permission_type", "api_permission_id", "api_type_id");
    }
}