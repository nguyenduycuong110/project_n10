<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SetGuardSession
{
    public function handle($request, Closure $next, $guard = null)
    {
        config(['session.cookie' => 'session_' . $guard]);
        return $next($request);
    }
}