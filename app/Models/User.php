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

    public function voteType($type){
        return $this->votesAll()->with("airfield")->whereHas("airfield", function($airfield) use($type){
            return isset($airfield->type) && $airfield->type == $type;
        });
    }

    public function getVoteType($type)
    {
        return $this->voteType($type)->first();
    }

    public function getVoteDepartureAttribute()
    {
        return $this->getVoteType("departure");
    }

    public function getHasVotedForDepartureAttribute(){
        return $this->vote_departure ? true : false;
    }

    public function getVoteArrivalAttribute()
    {
        return $this->getVoteType("arrival");
    }

    public function getHasVotedForArrivalAttribute(){
        return $this->vote_arrival ? true : false;
    }
}
