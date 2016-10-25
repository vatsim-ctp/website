<?php

namespace CTP\Http\Controllers\Site;

use Auth;
use CTP\Models\Airfield;
use CTP\Models\Setting;
use CTP\Models\Vote;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Voting extends BaseController
{
    public function getIndex(Request $request)
    {
        $hasVotedOnDeparture = Auth::user()->has_voted_for_departure;
        $canVoteOnDeparture = !$hasVotedOnDeparture;

        if ($canVoteOnDeparture) {
            $departureAirfields = Airfield::departure()
                                        ->inRandomOrder()
                                        ->get();
        } elseif (setting('voting','show_results_after')) {
            $departureAirfields = Airfield::departure()
                                        ->get()
                                        ->sortByDesc(function ($airfield) {
                                            return $airfield->votes->count();
                                        });
        } else {
            $departureAirfields = [];
        }

        $hasVotedOnArrival = Auth::user()->has_voted_for_arrival;
        $canVoteOnArrival = !$hasVotedOnArrival;

        if ($canVoteOnArrival) {
            $arrivalAirfields = Airfield::arrival()
                                      ->inRandomOrder()
                                      ->get();
        } elseif (setting("voting", "show_results_after")) {
            $arrivalAirfields = Airfield::arrival()
                                      ->get()
                                      ->sortByDesc(function ($airfield) {
                                          return $airfield->votes->count();
                                      });
        } else {
            $arrivalAirfields = [];
        }

        return view('site.voting.index')
            ->with('departureAirfields', $departureAirfields)
            ->with('canVoteOnDeparture', $canVoteOnDeparture)
            ->with("hasVotedOnDeparture", $hasVotedOnDeparture)
            ->with('arrivalAirfields', $arrivalAirfields)
            ->with('canVoteOnArrival', $canVoteOnArrival)
            ->with("hasVotedOnArrival", $hasVotedOnArrival);
    }

    public function postCast($type, Airfield $airfield, Request $request)
    {
        $vote = new Vote();
        $vote->event_id = Event::getCurrent()->id;
        $vote->airfield_id = $airfield->id;
        $vote->user_id = Auth::user()->id;

        try {
            $vote->save();
        } catch (QueryException $qe) {
            // Do nothing.  Duplicated.
        }

        return redirect()->route('voting.list');
    }
}
