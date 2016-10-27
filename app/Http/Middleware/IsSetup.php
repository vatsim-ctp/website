<?php

namespace CTP\Http\Middleware;

use Auth;
use Closure;

class IsSetup
{
    /**
     * Determine if the event is actually setup.  If not, redirect to the settings page.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!is_setup_complete() && $request->is("admin*") && !$request->is("admin/settings*")){
            flash("You must complete the settings page to initialise the website.", "danger");

            return redirect()->route("admin.settings.index");
        }

        if(!is_setup_complete() && !$request->is("admin*") && !$request->is("landing")){
            return redirect()->route("landing");
        }

        return $next($request);
    }
}
