<?php

namespace CTP\Http\Controllers\Site;

use CTP\Models\MailingList;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Newsletter extends BaseController
{
    public function postSubscribe(Request $request)
    {
        $mlSub = new MailingList();
        $mlSub->email = $request->input('email');

        if ($mlSub->save()) {
            return back()->withCookie(cookie('mailing_list_subscribed', true, 60 * 24 * 2));
        } else {
            return back()->withErrors('Invalid Email');
        }
    }
}
