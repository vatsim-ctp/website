<?php

namespace CTP\Http\Controllers\Site;

use CTP\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use VatsimSSO;
use URL;

class Account extends BaseController
{
    public function postSubscribe(Request $request)
    {
        Auth::user()->is_subscribed = true;
        Auth::user()->save();

        if($request->ajax()){
            return response()->json([
                "status" => "OK",
                "subscribed" => Auth::user()->is_subscribed,
            ]);
        } else {
            return redirect("/");
        }
    }

    public function postUnsubscribe(Request $request)
    {
        Auth::user()->is_subscribed = false;
        Auth::user()->save();

        if($request->ajax()){
            return response()->json([
                "status" => "OK",
                "subscribed" => Auth::user()->is_subscribed,
            ]);
        } else {
            return redirect("/");
        }
    }
}
