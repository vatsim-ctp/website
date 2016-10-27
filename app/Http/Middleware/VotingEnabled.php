<?php

namespace CTP\Http\Middleware;

use Closure;

class VotingEnabled
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
        if (status_voting_available() && $request->is('landing')) {
            return redirect()->route('voting.list');
        }

        if (! status_voting_available() && $request->is('voting*')) {
            return redirect()->route('landing');
        }

        return $next($request);
    }
}
