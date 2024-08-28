<?php

namespace ConnorLock05\LaravelAdmin\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpAuthorisation
{
    public function handle(Request $request, Closure $next)
    {
        $allowedIps = config('laravel-admin.allowed_ips');

        if (!in_array($request->ip(), $allowedIps))
        {
            abort(403);
        }

        return $next($request);
    }
}