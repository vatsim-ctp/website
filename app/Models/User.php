<?php

namespace CTP\Models;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Authorizable, Notifiable;

    public $incrementing = false;

    public function votesAll()
    {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }

    public function voteType($type)
    {
        return $this->votesAll()
                    ->with("airfield")
                    ->whereHas("airfield", function ($airfield) use ($type) {
                        $airfield->where("type", "=", $type);
                    });
    }

    public function getVoteFor($type)
    {
        return $this->voteType($type)->first();
    }

    public function getVoteDepartureAttribute()
    {
        return $this->getVoteFor("departure");
    }

    public function getVoteArrivalAttribute()
    {
        return $this->getVoteFor("arrival");

    }

    public function hasVotedFor($type)
    {
        return $this->getVoteFor($type) ? true : false;
    }

    public function getHasVotedForDepartureAttribute()
    {
        return $this->hasVotedFor("departure");
    }

    public function getHasVotedForArrivalAttribute()
    {
        return $this->hasVotedFor("arrival");
    }
}
