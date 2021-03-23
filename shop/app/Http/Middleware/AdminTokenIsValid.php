<?php

namespace App\Http\Middleware;

use App\Services\Auth\AdminGuard;
use App\Providers\AdminProvider;
use Illuminate\Support\Facades\Auth;

use Closure;

class AdminTokenIsValid
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
        $guard = new AdminGuard(new AdminProvider( new \App\Admin() ));
        if($guard->validate($request->data))
        {
            Auth::setUser($guard->user());
            //$request->userId = $guard->user()->id;
            return $next($request);
        }
        return null;
    }
}
