<?php namespace CTP\Http\Controllers\Site;

use Response;
use Redirect;
use Request;
use CTP\Data\MailingList as MailingListData;

class Homepage extends SiteController {

    public function getHomepage() {
        return $this->viewMake("home");
    }

    public function getLanding(){
        $areadySubscribed = Request::cookie("mailing_list_subscribed", false);

        return $this->viewMake("landing")->with("alreadySubscribed", $areadySubscribed);
    }

    public function postLandingSubscribe(){
        $mlSub = new MailingListData();
        $mlSub->email = Request::input("email");

        if($mlSub->save()){
            return Redirect::route("landing")->withCookie(cookie("mailing_list_subscribed", true, 60*24*2));
        } else {
            return Redirect::route("landing")->withErrors("Invalid Email");
        }
    }

}
