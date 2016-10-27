<?php

namespace CTP\Http\Composers;

use CTP\Models\User;
use Illuminate\View\View;

class AdminDashboardStatistics
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
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $statistics_total_users = User::all()->count();
        $statistics_total_users_on_mailing_list = User::where("is_subscribed", "=", 1)->count();
        $statistics_percentage_users_on_mailing_list = ($statistics_total_users_on_mailing_list / $statistics_total_users) * 100;

        $view->with("total_users", $statistics_total_users)
             ->with("total_users_on_mailing_list", $statistics_total_users_on_mailing_list)
             ->with("percentage_users_on_mailing_list", $statistics_percentage_users_on_mailing_list);
    }
}