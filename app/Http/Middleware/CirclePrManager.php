<?php

namespace App\Http\Middleware;

use App\Models\Circle;
use Closure;

class CirclePrManager
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
        $circle = null;

        if( $request->route()->hasParameter('circle') ) {
            $circle = $request->route()->parameter('circle');
        }
        else if( $request->has('circle') ) {
            $circle = Circle::findOrFail($request->circle);
        }

        abort_if(is_null($circle), 403);
        abort_unless($request->user()->isPRManagerAt($circle), 403);

        return $next($request);
    }
}
