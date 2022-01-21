<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.home');
    }
    public function new_employee()
    {
        return view('employees.home');
    }
    public function newhome()
    {
            
            $role = Auth::user()->role;
            if ($role == 'admin') {
                return view('users.home');
            } 
            else if(strcmp($role, 'employee')==0) {
                return view('employees.home');
            }
            else if(strcmp($role, 'manager')==0) {
                return view('managers.home');
            }
            else
            return redirect('/employees/home');
        
    }
}
