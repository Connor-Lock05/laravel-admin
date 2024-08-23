<?php

namespace ConnorLock05\LaravelAdmin\Middleware;

use Closure;
use ConnorLock05\LaravelAdmin\Exceptions\UserDoesntHaveRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class AdminPanelAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::hasUser()) abort(403);

        $allowedRoles = config('laravel-admin.allowed_roles');

        if ($allowedRoles == ['*'])
        {
            return $next($request);
        }

        // Check user has role;
        $user = $request->user();
        $userClass = get_class($user);

        $traitsOnUserClass = class_uses_recursive($userClass);

        if (!in_array(HasRoles::class, $traitsOnUserClass))
        {
            throw new UserDoesntHaveRoles($userClass);
        }

        if ($user->hasAnyRole(...$allowedRoles))
        {
            return $next($request);
        }

        abort(403);
    }
}