<?php

namespace CTP\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            '*', 'CTP\Http\Composers\Settings'
        );

        View::composer(
            ['admin.dashboard*'],
            \CTP\Http\Composers\AdminDashboardStatistics::class
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
