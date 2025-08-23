<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! $request->user()) {
            return redirect()->route('user.login.index');
        }

        if (! in_array($request->user()->role, $roles, true)) {
            return redirect()->route('user.home');
        }

        return $next($request);
    }
}
