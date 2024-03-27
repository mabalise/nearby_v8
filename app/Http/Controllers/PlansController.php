<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PlansController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Subscription Controller
    |--------------------------------------------------------------------------
    |
    */

    public function __construct()
    {
    }

    /**
     * Upgrade
     */
    public function showPlans(): View
    {
        $current_plan = auth()->user()->plan;

        $days_left = 12;
        if ($current_plan == null && auth()->user()->trial_ends_at != null) {
            $days_left = auth()->user()->trial_ends_at->diffInDays(\Carbon\Carbon::now());
        }

        return view('app.plans', compact('current_plan', 'days_left'));
    }
}
