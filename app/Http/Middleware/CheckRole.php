<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, $role1, $role2 = 'NULL', $role3 = 'NULL', $role4 = 'NULL', $role5 = 'NULL'): Response
    {
        if (! $request->user()->hasRole([$role1, $role2, $role3, $role4, $role5])) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
