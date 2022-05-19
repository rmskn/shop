<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Administrate
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->isAdmin === 0) {
            return abort('403');
        }
        return $next($request);
    }
}
