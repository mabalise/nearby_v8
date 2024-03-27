<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;

class Localization
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->input('set_lang', null);

        if ($request->user()) {
            if ($lang != null && $lang != $request->user()->locale) {
                // Update user language
                $request->user()->locale = $lang;
                $request->user()->save();
            }
            app()->setLocale($request->user()->locale);
        } else {
            // No user logged in, check first route element
            $languages = array_keys(array_except(config('system.available_languages'), ['en']));
            if (in_array(\Request::segment(1), $languages)) {
                app()->setLocale(\Request::segment(1));
            } else {
                app()->setLocale(config('system.default_language'));
            }
        }

        return $next($request);
    }
}
