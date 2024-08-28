<?php

namespace ConnorLock05\LaravelAdmin\Middleware;

use Closure;
use Illuminate\Http\Request;
use function ConnorLock05\LaravelAdmin\load_classes_from_namespace_prefix;

class LoadModels
{
    public function handle(Request $request, Closure $next)
    {
        load_classes_from_namespace_prefix("App\\Models");

        return $next($request);
    }
}