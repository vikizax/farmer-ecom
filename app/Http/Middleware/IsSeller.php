<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class IsSeller
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
        $user = new User();

        if (!$user->isSeller()) {
            abort(401);
        }
        return $next($request);
    }
}
