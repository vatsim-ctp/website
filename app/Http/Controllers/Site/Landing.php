<?php

namespace CTP\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Landing extends BaseController
{
    public function getLanding(Request $request)
    {
        $alreadySubscribed = $request->cookie('mailing_list_subscribed', false);

        return view('site.landing')->with('alreadySubscribed', $alreadySubscribed);
    }
}
