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
        $s=Employee::count();
        $user1=new Employee();
        $employees=$user1->search_employee($request);  
        return view('employees.index',compact('employees','s'));
        
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
            //try catch implement
        $value=$this->randomUserId();
        Employee::create($request->all()+ ['emp_id' => $value]);        
        $user2=new User();
        $user2->store_user($request,$value);
        $salary=new Salary();
        $salary->store_salary($request,$value);
        try{
        dispatch(new EmailJob());}
        catch(Exception $e)
        {
            error_log($e);
        }
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
        
        $emp=Employee::where('id',$id)->first() ;
        $empl=Employee::where('emp_id',$emp->emp_id)->first();
        $data=array('full_name' => $request->get('full_name'),
        'email' => $request->get('email'),
        'gender' => $request->get('gender'),
        'address' => $request->get('address'),
        'birth_date' => $request->get('birth_date'),
        'joining_date' => $request->get('joining_date'),
        'm_id'=>$request->get('m_id'));
      
        Employee::where('emp_id',$emp->emp_id)->update($data);  
        $salary=Salary::where('s_id',$emp->emp_id)->first(); 
        $salary_data=array(
        'package' => $request->get('package'),
        'gratuity' => $request->get('gratuity'),
        'variable_salary' => $request->get('variable_salary'),
        'basic_pay' => $request->get('basic_pay'),
        'rent_allowance' => $request->get('rent_allowance')); 
         Salary::where('s_id',$emp->emp_id)->update($salary_data);  
         $mid= $request->get('mid');
         Employee::where('emp_id',$emp->emp_id)->update(array('m_id' => $mid));
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
        $emp=Employee::where('id',$id)->get() ;
        Employee::where('emp_id',$emp[0]->emp_id)->delete() ;       
        User::where('id',$emp[0]->emp_id)->delete() ;
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
