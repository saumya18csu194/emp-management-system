<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
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
            }
            
        
    }
    public function showChangePasswordForm()
    {
        return view('auth.changePassword');
    }
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
    
    $validatedData = $this->validate($request, [
        'current-password' => 'required',
        'new-password' =>  'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
    ]);

    //Change Password
    $user = Auth::user();
    $user->password = bcrypt($request->get('new-password'));
    $user->save();

    return redirect()->back()->with("success","Password changed successfully !");

}}
