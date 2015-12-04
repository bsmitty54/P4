<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $urole = \Auth::user()->role;
        if(auth()->check() && ($urole==$role || $urole=='Administrator')) {
            return $next($request);
        }
        \Session::flash('login_message','You must be logged in as an ' . $role . ' to access the requested page.');
        return redirect('/login');

    }
}
