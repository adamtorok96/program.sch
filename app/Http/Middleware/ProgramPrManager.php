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
        abort_unless($request->route()->hasParameter('program'), 403);
        abort_unless($request->user()->isPRManagerAt($request->route()->parameter('program')->circle), 403);

        return $next($request);
    }
}
