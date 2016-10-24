<?php

namespace CTP\Http\Controllers\Site;

use Auth;
use CTP\Models\Airfield;
use CTP\Models\Event;
use CTP\Models\Setting;
use CTP\Models\Vote;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Voting extends BaseController
{
    public function getIndex(Request $request)
    {
        $canVoteOnDeparture = ! Auth::user()->has_voted_for_departure;

        if ($canVoteOnDeparture) {
            $departureAirfields = Airfield::forEvent(Event::getCurrent()->id)
                                          ->departure()
                                          ->inRandomOrder()
                                          ->get();
        } elseif (Setting::getValue('voting.show_results_after')) {
            $departureAirfields = Airfield::forEvent(Event::getCurrent()->id)
                                          ->departure()
                                          ->get()
                                          ->sortByDesc(function ($airfield) {
                                              return $airfield->votes->count();
                                          });
        } else {
            $departureAirfields = [];
        }

        $canVoteOnArrival = ! Auth::user()->has_voted_for_arrival;

        if ($canVoteOnArrival) {
            $arrivalAirfields = Airfield::forEvent(Event::getCurrent()->id)
                                        ->arrival()
                                        ->inRandomOrder()
                                        ->get();
        } elseif (Setting::getValue('voting.show_results_after')) {
            $arrivalAirfields = Airfield::forEvent(Event::getCurrent()->id)
                                        ->arrival()
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
            ->with('arrivalAirfields', $arrivalAirfields)
            ->with('canVoteOnArrival', $canVoteOnArrival);
    }

    public function postCast($type, Airfield $airfield, Request $request)
    {
        $vote = new Vote();
        $vote->airfield_id = $airfield->id;
        $vote->user_id = Auth::user()->id;

        try {
            $vote->save();
        } catch (QueryException $qe) {
            dd($qe);
            // Do nothing.  Duplicated.
        }

        return redirect()->route('voting.list');
    }
}
