<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallation
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Request::segment(1) != 'install') {
            if (! \App\Http\Controllers\InstallationController::isInstalled()) {
                return redirect(url('install'));
                exit();
            }
        }

        return $next($request);
    }
}
