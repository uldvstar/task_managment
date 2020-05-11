<?php

namespace App\Http\Middleware;

use Closure;

class CheckForAuthenticationToken
{
    /**
     * Checks if token exist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('access_token') === false) {
            return redirect()->route('login')->withErrors('Your session has expired. Please log in again.');
        }

        return $next($request);
    }
}
