<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Employee;
use App\User;
use Validator;
use App\Salary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Mail\RegisterMail;
use App\Jobs\EmailJob;
use Illuminate\Support\Facades\Mail;
class EmployeeController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        // $s=Employee::count();
        $user1=new Employee();
        $employees=$user1->search_employee($request);  
        return view('employees.index',compact('employees'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user=new Employee();
        $user1=$user->get_employee(); 
        return view('employees.create',compact('user1'));
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
            'full_name'=>'required',
            'email' => 'required',
            'age'=>'required',
            'gender'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'birth_date'=>'required',
            'joining_date'=>'required',]);
           
        $value=$this->randomUserId();
        Employee::create($request->all()+ ['emp_id' => $value]);        
        $user2=new User();
        $user2->store_user($request,$value);
        $salary=new Salary();
        $salary->store_salary($request,$value);

        dispatch(new EmailJob());

        return redirect('/newhomepage')->with('success','created successfully'); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $empl=Employee::where('id',$id)->first() ;
        $emp=Employee::where('emp_id',$empl->emp_id)->first();
        $salary=Salary::where('s_id',$empl->emp_id)->first(); 
        $items=User::where('role','manager')->get();
        return view('employees.edit', compact('emp','salary','items'));
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
        $emp=new Employee();
        $salary=new Salary();
        $emp->update_employee($request,$id);
        $salary->update_salary($request,$id);
        return redirect('/newhomepage')->with('success','created successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp=new Employee();
        $emp->delete_employee($id);
        return redirect()->back();
    }  
    public function randomUserId()        //to generate employee id
    {
        $timestamp = time();
        $random = rand(1, 100);
        $emp_id = $timestamp . $random;
        return $emp_id;
    }   
}
