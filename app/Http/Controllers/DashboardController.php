<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

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
    public function dashboard(): View
    {
        return view('app.dashboard');
    }
}
