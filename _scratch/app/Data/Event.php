<?php namespace CTP\Data;

use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends DataModel {

    use SoftDeletes;
    public $table        = "event";
    public $primaryKey   = "event_id";
    public $incrementing = true;
    public $dates        = ["created_at", "updated_at", "deleted_at"];
    public $fillable     = [];
    public $guarded      = [];
    public $visible      = [];

    public function getFullNameAttribute(){
        return $this->full_direction." ".$this->year;
    }

    public function getFullDirectionAttribute(){
        if($this->direction == "E"){
            return "Eastbound";
        } else {
            return "Westbound";
        }
    }
}
