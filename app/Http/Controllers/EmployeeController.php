<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Employee;
use Validator;
use Illuminate\Database\Eloquent\Model;

class EmployeeController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
    
        
       
        
        $employees = Employee::latest()->paginate(5);
       
        return view('employees.index',compact('employees'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
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
            'full_name'=>'required',
            'email' => 'required|email|unique',
            'age'=>'required',]);

        Employee::create($request->all());
        
        return redirect()->route('home')->with('success','created successfully');
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
        $emp= Employee::find($id);  
        return view('employees.edit', compact('emp'));
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
        $empl = Employee::find($id);  
        $empl->full_name =$request->get('full_name');  
        $empl->email =$request->get('email');
        $empl->age =$request->get('age');  
        $empl->save();  
        return redirect('/home');
    }
  


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        return redirect()->intended('/employees');
    }
}
