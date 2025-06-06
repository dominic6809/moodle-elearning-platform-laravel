<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStudent
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('student')->check()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}