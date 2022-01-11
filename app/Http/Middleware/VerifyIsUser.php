<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyIsUser
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
        // return $next($request);
        if(Auth::user()->checkIsStatus() && Auth::check() && (Auth::user()->checkIsStatus() == 0 )){
            return $next($request);
        }
        return redirect("/login");
    }
}
