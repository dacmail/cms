<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && ! $request->user()->hasPermission('admin')) {
            abort(401);
        }

        return $next($request);
    }
}
