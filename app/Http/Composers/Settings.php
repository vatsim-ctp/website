<?php

namespace CTP\Http\Composers;

use CTP\Models\Event;
use CTP\Models\Setting;
use Illuminate\View\View;

class Settings
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
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $view->with('setting_'.str_replace('.', '_', $setting->code), $setting->value);
        }
    }
}
