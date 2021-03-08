<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SelfUserMiddleware
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
        $user = auth()->user();
        if ($user && $user->member && $user->id == $user->member->user_id) {
            return $next($request);
        }
        return abort(403, "Vous n'etes pas autorisé");
    }
}
