<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GlobalCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request = $next($request);
        $request->header('Cache-Control', 'max-age=600');

        return $request;
    }
}
