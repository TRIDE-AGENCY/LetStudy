<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return route('login');
        }

        if ($request->is('member-area') || $request->is('member-area/*')) {
            return route('user.login.index');
        }

        return route('user.login.index');
    }
}
