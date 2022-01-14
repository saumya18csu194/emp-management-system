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
            //return redirect('/home');
            $role = Auth::user()->role;
            if ($role == 'admin') {
                return redirect('/admin/home');
            } 
            else if($role =='employee') {
                return redirect('/employee/home');
            }
            else if($role=='manager') {
                return redirect('/manager/home');
            }
            else
            return redirect('home');
        }

        return $next($request);
    }
}
