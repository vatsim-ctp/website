<?php

namespace CTP\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Airfield extends Model
{
    public $dates = ["created_at", "updated_at"];

    public function scopeForEvent($query, $eventID){
        return $query->where("event_id", "=", $eventID);
    }

    public function scopeDeparture($query){
        return $query->where("type", "=", "departure");
    }

    public function scopeArrival($query){
        return $query->where("type", "=", "arrival");
    }

    public function event(){
        return $this->belongsTo(Event::class, "event_id", "id");
    }

    public function votes(){
        return $this->hasMany(Vote::class, "airfield_id", "id");
    }

    public function getIsDepartureAttribute(){
        return $this->type === "departure";
    }

    public function getIsArrivalAttribute(){
        return $this->type === "arrival";
    }
}
