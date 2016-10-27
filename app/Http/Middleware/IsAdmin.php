<?php

namespace CTP\Http\Middleware;

use Auth;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!Auth::check()){
            return redirect()->route("login", ["return" => $request->fullUrl()]);
        }

        if(!Auth::user()->admin){
            return redirect("/");
        }

        return $next($request);
    }
}
