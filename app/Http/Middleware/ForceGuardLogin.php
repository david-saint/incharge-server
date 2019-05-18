<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ForceGuardLogin extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'users')
    {
        if (! $token = auth()->guard($guard)->tokenById($request->route('id'))) {
            return response()->json([
                'status'    =>  'force.guard',
                'message'   =>  'Couldn\'t force guard login'
            ], 422);
        }

        $request->headers->set('Authorization', 'Bearer ' . $token);

        $this->authenticate($request);

        return $next($request);
    }
}
