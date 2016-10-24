<?php

namespace CTP\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $dates = [
        "application_start", "application_finish",
        "voting_start", "voting_finish",
        "event_start", "event_finish",
        'created_at', 'updated_at',
    ];

    public static function getCurrent(){
        return Event::current()->first();
    }

    public function scopeCurrent($query){
        return $query->where("current", "=", 1);
    }

    public function mailingList(){
        return $this->hasMany(MailingList::class, "event_id", "id");
    }

    public function getIsVotingEnabledAttribute(){
        $currentEvent = Event::getCurrent();

        if(!$currentEvent->voting_start){
            return false;
        }

        if(!$currentEvent->voting_finish){
            return false;
        }

        return Carbon::now()->between($currentEvent->voting_start, $currentEvent->voting_finish);
    }
}
