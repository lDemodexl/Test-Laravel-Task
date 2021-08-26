<?php

namespace App\Http\Middleware;

use Closure;
use Str;
use Cookie;
use Illuminate\Http\Request;

class SetCookieOnVisit
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
        if($request->hasCookie('user_uid')) {
            return $next($request);
        }

        $user_uid = Str::uuid()->toString();
        Cookie::queue(Cookie::forever('user_uid', $user_uid));
        return $next($request);
    }
}
