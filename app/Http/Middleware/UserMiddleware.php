<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Auth::setDefaultDriver('users');

        // allow if a user is logged in
        if (Auth::check() && Auth::user() instanceof User) return $next($request);

        return response([
            'error' => 'You are not allowed to access this resource'
        ], 401);
    }
}
