<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = $guards ?: [null];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                return $user->role === 'Admin'
                    ? redirect()->route('admin.dashboard')
                    : redirect()->route('user.home');
            }
        }

        return $next($request);
    }
}
