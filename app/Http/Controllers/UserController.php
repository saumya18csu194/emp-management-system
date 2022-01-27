<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //search function and display data
    {
        $user1=new User();
        $search =  $request->input('search_word');
        $employees=$user1->search_user($search);
        return view('users.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'email' => 'required',]);
           
        $user1=new User();
        $admin_data = [
        'name'=>$request->input('name'),
        'email'=>$request->input('email'),
        'password'=> bcrypt('pass@admin'),
         'role'=>'admin',
        ];
        $user1->store_user($admin_data);
        return view('users.home')->with('success','created successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::find($id);  
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=new User();
        $update_admin_data=[
        'name' =>$request->get('name'),
        'email'=>$request->get('email'),
         'password' => bcrypt('pass@admin'),  
        'role'=>'admin',
        ];
      
        $user->save_admin($update_admin_data,$id);
        return redirect('/newhomepage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=new User();
        $user->delete_admin($id);
        return redirect()->intended('/users');
    }
}
