<?php

namespace CTP\Http\Composers;

use CTP\Models\Event;
use Illuminate\View\View;

class CurrentEvent
{
    /**
     * Create a new current event composer.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $currentEvent = Event::getCurrent();

        $view->with('_event', $currentEvent);
    }
}
