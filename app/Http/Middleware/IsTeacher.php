<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsTeacher
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isTeacher()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}