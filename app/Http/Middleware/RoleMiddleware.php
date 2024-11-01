<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();

        // Check if the user is authenticated and has a valid role
        if (!$user || !$user->role || !in_array($user->role->name, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
