<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            
            $role = Auth::user()->role;
            if(strcmp($role, 'admin') == 0){
                return response()->view('users.home');
            } 
            else if(strcmp($role, 'employee') == 0) {
                return response()->view('employees.home');
            }
            else if($role=='manager') {
                return response()->view('manager.home');
            }
            else
            return response()->view('employees.home');
        }

        return $next($request);
    }
}
