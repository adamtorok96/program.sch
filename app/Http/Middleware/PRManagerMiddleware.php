<?php

namespace App\Http\Middleware;

use Closure;

class PRManagerMiddleware
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
        if(
            $request->route()->parameter('circle') != null &&
            !$request->user()->isPRManagerAt($request->route()->parameter('circle'))
        ) {
            abort(403);
        }


        return $next($request);
    }
}
