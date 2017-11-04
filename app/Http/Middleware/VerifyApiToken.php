<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;

class VerifyApiToken
{
    const HEADER_KEY = 'Authorization';
    const TOKEN_PREFIX = 'PSCH ';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        abort_unless(
            $request->hasHeader(self::HEADER_KEY),
            401,
            'Missing Authorization header!'
        );

        abort_unless(
            starts_with($request->header(self::HEADER_KEY), self::TOKEN_PREFIX),
            401,
            'Invalid token format!'
        );

        abort_unless(
            ApiToken::whereToken(str_after($request->header(self::HEADER_KEY), self::TOKEN_PREFIX))->exists(),
            401,
            'Invalid api token!'
        );

        return $next($request);
    }
}
