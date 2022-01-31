<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

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
                
        if ($role == User::ROLE_TYPE_ADMIN)
        {
            return response()->view('users.home');
        }
        else if($role ==User::ROLE_TYPE_EMPLOYEE )
        {
            return response()->view('employees.home');
        }
        else if($role ==User::ROLE_TYPE_MANAGER)
        {
            return response()->view('managers.home');
        }
        else
        {
            return view('home');
        }}
        return $next($request);
    
}}
