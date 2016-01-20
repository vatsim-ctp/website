<?php namespace CTP\Data\Api;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Account extends \CTP\Data\DataModel {

    public $table        = "api_account";
    public $primaryKey   = "api_account_id";
    public $incrementing = true;
    public $dates        = ["created_at", "updated_at", "deleted_at"];
    public $fillable     = [];
    public $guarded      = [];

    public function ips() {
        return $this->hasMany("\CTP\Data\Api\Account\Ip", "api_account_id", "api_account_id");
    }

    public function roles() {
        return $this->belongsToMany("\CTP\Data\Api\Account\Role", "api_account_role", "api_account_id", "api_role_id")->orderBy("level", "DESC");
    }

    public function requests() {
        return $this->hasMany("\CTP\Data\Api\Request", "api_account_id", "api_account_id");
    }

    public function getHighestRoleAttribute(){
        return $this->roles->first();
    }

    public function getPermissionsAttribute() {
        $result = new Collection();;
        foreach($this->roles as $r){
            $result = $result->merge($r->permissions);
        }

        return $result;
    }

    public function hasPermission($permission){
        return $this->permissions->filter(function($p) use($permission){
            return $p->permission == $permission;
        })->count() > 0;
    }
}
