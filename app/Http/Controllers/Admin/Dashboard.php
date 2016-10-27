<?php

namespace CTP\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Dashboard extends BaseController
{
    public function getDashboard(Request $request)
    {
        return view('admin.dashboard.dashboard');
    }
}
