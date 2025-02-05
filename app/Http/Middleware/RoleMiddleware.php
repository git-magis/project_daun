<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->level === $role) {
            return $next($request);
        }

        // Redirect if the user does not have the required role
        return redirect()->route('login')->withErrors('Access denied.');
    }
}
