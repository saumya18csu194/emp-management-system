<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidateRequest;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Exception;
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
        $employees=$user1->searchUser($search);
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
    public function store(ValidateRequest $request)
    {     
        try
        { 
            $user1=new User();
            $admin_data = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=> bcrypt('pass@admin'),        //set a default password of newly created admin
            'role'=>'admin',
            ];
        $user1->storeUser($admin_data);
        }
        catch(Exception $e)
        {
            error_log($e);
        }
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
        try
        {
        $userfind= new User();
        $user=$userfind->findId($id);
        }
        catch(Exception $e)
        {
            error_log($e);
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateRequest $request, $id)  //update admin data in user table
    {
        try
        {
        $user=new User();      
        $update_admin_data=[
        'name' =>$request->get('name'),
        'email'=>$request->get('email'),
        'password' => bcrypt('pass@admin'),  
        'role'=>'admin',
        ];    
        $user->saveAdmin($update_admin_data,$id);
        }
        catch(Exception $e)
        {
            error_log($e);
        }

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
        try
        {
            $user=new User();
            $user->deleteAdmin($id);          //delete admin record from users table
        }
        catch(Exception $e)
        {
            error_log($e);
        }
        return redirect()->intended('/users');
    }
}
