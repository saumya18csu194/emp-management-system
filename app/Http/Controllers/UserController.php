<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s=User::count();
        $search =  $request->input('q');
        if($search!=""){
            $employees= User::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%');
                   
            })
            ->paginate(2);
            $employees->appends(['q' => $search]);
        }
        else{
            $employees = User::where('role', '=', 'admin')->paginate(2);
        }
        return view('users.index',compact('employees','s'));
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
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'email' => 'required|email|unique',]);
             
        
        $user=new User();
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = bcrypt('pass@admin');
        $user->role='admin';
        $user->save();
        return view('users.home')->with('success','created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = User::find($id);  
        $user->name =$request->get('name');  
        $user->email =$request->get('email');
        $user->password = bcrypt('pass@admin');
        
        $user->role='admin';
        $user->save();  
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
        User::where('id', $id)->delete();
        return redirect()->intended('/users');
    }
}
