<?php

namespace App\Http\Middleware;

use Closure;

class Json
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
        $request->merge(["json" => true]);
        return $next($request);
    }
}
