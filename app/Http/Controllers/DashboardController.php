<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Controller
    |--------------------------------------------------------------------------
    |
    */

    public function __construct()
    {
    }

    /**
     * Dashboard
     */
    public function dashboard()
    {
        return view('app.dashboard');
    }
}
