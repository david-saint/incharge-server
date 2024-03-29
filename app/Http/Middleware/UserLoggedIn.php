<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class UserLoggedIn
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
        if (Auth()->check()) {
            return $next($request);
        } else {
            $message = ["message" => "Permission Denied"];
            return response($message, 401);
        }
        
    }
}
