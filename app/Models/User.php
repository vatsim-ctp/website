<?php

namespace CTP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Authorizable, Notifiable;

    public function votesAll()
    {
        return $this->hasMany(Vote::class, "user_id", "id");
    }

    public function votes()
    {
        return $this->votesAll()
                    ->with("airfield")
                    ->whereHas("airfield", function($airfield){
                        $airfield->where("event_id", "=", Event::getCurrent()->id);
                    });;
    }

    public function getHasVotedForDepartureAttribute()
    {
        return $this->votes->filter(function ($vote) {
            return $vote->airfield->is_departure;
        })->count() > 0;
    }

    public function getHasVotedForArrivalAttribute()
    {
        return $this->votes->filter(function ($vote) {
            return $vote->airfield->is_arrival;
        })->count() > 0;
    }
}
