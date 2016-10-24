<?php

namespace CTP\Http\Middleware;

use Closure;
use CTP\Models\Event;

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
        $currentEvent = Event::getCurrent();

        if ($currentEvent->is_voting_enabled && $request->is('landing')) {
            return redirect()->route('voting.list');
        }

        if (! $currentEvent->is_voting_enabled && $request->is('voting*')) {
            return redirect()->route('landing');
        }

        return $next($request);
    }
}
