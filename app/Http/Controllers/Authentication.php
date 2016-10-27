<?php

namespace CTP\Http\Controllers;

use CTP\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use VatsimSSO;
use URL;

class Authentication extends BaseController
{
    public function getLogout(Request $request){
        Auth::logout();

        return redirect("/");
    }

    public function getLogin(Request $request)
    {
        if (\App::environment('local')) {
            \Auth::loginUsingId(980234);

            return redirect('/');
        }

        if (! $request->session()->has('auth_return')) {
            $request->session()->set('auth_return', $request->input('return', '/'));
        }

        // Do we already have some kind of CID? If so, we can skip this bit and go to the redirect!
        if (Auth::check() || Auth::viaRemember()) {
            return redirect('/');
        }

        // Just, native VATSIM.net SSO login.
        return VatsimSSO::login(
            [URL::route('login.verify'), 'suspended' => true, 'inactive' => true],
            function ($key, $secret, $url) use ($request) {
                $request->session()->put('vatsimauth', compact('key', 'secret'));

                return redirect($url);
            },
            function ($error) use ($request) {
                $request->session()->set('cert_offline', true);
                dd($error);

                return redirect('/');
            }
        );
    }

    public function getVerify(Request $request)
    {
        if ($request->input('oauth_cancel') !== null) {
            dd('ERROR PAGE HERE -- OAUTH_CANCEL');
        }

        if (! $request->session()->has('vatsimauth')) {
            dd('ERROR PAGE HERE -- OAUTH_CANCEL');
        }

        $session = $request->session()->get('vatsimauth');

        if ($request->input('oauth_token') !== $session['key']) {
            dd('ERROR PAGE HERE -- RETURNED TOKEN MISMATCH');
        }

        if (! $request->input('oauth_verifier')) {
            dd('ERROR PAGE HERE -- VERIFICATION CODE AWOL');
        }

        return VatsimSSO::validate($session['key'], $session['secret'], $request->input('oauth_verifier'), function ($user, $request) {
            $request->session()->forget('vatsimauth');

            // At this point WE HAVE data in the form of $user;
            $user = User::find($user->id);

            if (is_null($user)) {
                $user = new User();
                $user->id = $user->id;
            }

            $user->name_first = $user->name_first;
            $user->name_last = $user->name_last;
            $user->email = $user->email;

            $user->save();

            Auth::login($user, true);

            return redirect($request->session()->get('auth_return', '/'));
        }, function ($error) {
            throw new \Exception($error['message']);
        });
    }
}
