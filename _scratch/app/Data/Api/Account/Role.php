<?php namespace CTP\Data\Api\Account;


use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends \CTP\Data\DataModel {

    use SoftDeletes;
    public $table = "api_role";
    public $primaryKey = "api_role_id";
    public $incrementing = true;
    public $fillable = [];
    public $guarded = [];
    public $touches = ['accounts'];

    public static function scopeDefault($query){
        return $query->where("is_default", "=", 1);
    }

    public static function scopeRequireApproval($query){
        return $query->where("require_approval", "=", 1);
    }

    public function accounts(){
        return $this->belongsToMany("\CTP\Data\Api\Account", "api_account_role", "api_role_id", "api_account_id");
    }

    public function permissions(){
        return $this->belongsToMany("\CTP\Data\Api\Account\Permission", "api_permission_role", "api_role_id", "api_permission_id");
    }

    public function getIsDefaultAttribute(){
        return (bool) $this->attributes['is_default'];
    }

    public function getDefaultAttribute(){
        return $this->getIsDefaultAttribute();
    }

    public function getRequireApprovalAttribute(){
        return (bool) $this->attributes['require_approval'];
    }

}
