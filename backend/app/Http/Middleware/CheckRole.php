<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
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
        if(Auth::check()){
            if (Auth::user()->getRole() != $role) {
                return redirect('index');
            }
            return $next($request);
        } else {
            return redirect('login');
        }
    }
}
