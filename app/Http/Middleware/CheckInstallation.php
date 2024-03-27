<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;

class CheckInstallation
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $role
     * @return mixed
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
