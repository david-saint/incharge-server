<?php

namespace App\Http\Middleware;

use Closure;

class Guard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
        \Auth::setDefaultDriver($guard);
        return $next($request);
    }
}
