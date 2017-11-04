<?php

namespace App\Http\Middleware;

use Closure;

class ProgramPrManager
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
            ! $request->route()->hasParameter('program') ||
            ! $request->user()->isPRManagerAt($request->route()->parameter('program')->circle)
        ) {
            abort(403);
        }


        return $next($request);
    }
}
