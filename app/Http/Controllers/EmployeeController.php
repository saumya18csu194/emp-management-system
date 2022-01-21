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
        $search =  $request->input('q');
        if($search!=""){
            $employees= Employee::where(function ($query) use ($search){
                $query->where('full_name', 'like', '%'.$search.'%');
               
            })
            ->paginate(2);
            $employees->appends(['q' => $search]);
        }
        else
        {
            $employees = Employee::paginate(2);
        }
        return view('employees.index',compact('employees','s'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user1=DB::table('employees')->get();
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
        $validator = \Validator::make($request->all(), [
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
        
        $user1=new User();
        if($request->input('select_manager')=='On')
        { 
            $user1->id=$value;
            $user1->name=$request->input('full_name');
            $user1->email=$request->input('email');
            $user1->password = bcrypt('pass@manager');
            $user1->role='manager';
            // $user1->m_id->input()
            $user1->save();
        }
        else
        {
        $user1->id=$value;
        $user1->name=$request->input('full_name');
        $user1->email=$request->input('email');
        $user1->password = bcrypt('pass@employee');
        $user1->role='employee';
        $user1->save();
        }
        $salary=new Salary();
        $salary->package=$request->input('package');
        $salary->variable_salary=$request->input('variable_salary');
        $salary->basic_pay=$request->input('basic_pay');
        $salary->rent_allowance=$request->input('rent_allowance');
        $salary->gratuity=$request->input('gratuity');
        $salary->s_id=$value;
        $salary->save();

        $abcd=$request->input('selectEmp1');
        foreach ($abcd as $a)
        {
            Employee::where('emp_id', $a)->update(array('m_id' => $value));
        }


        
        
        return redirect('/newhomepage')->with('success','created successfully'); 
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
        // $emp= Employee::find($id); 
         
        
        $empl=DB::table('employees')->where('id',$id)->first() ;
        $emp=DB::table('employees')->where('emp_id',$empl->emp_id)->first();
        $salary=DB::table('salaries')->where('s_id',$empl->emp_id)->first(); 
        $items=DB::table('users')->where('role','manager')->get();
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
        $emp=DB::table('employees')->where('id',$id)->first() ;
      
        $empl=DB::table('employees')->where('emp_id',$emp->emp_id)->first();
        
        $data=array('full_name' => $request->get('full_name'),

        'email' => $request->get('email'),
    
        'gender' => $request->get('gender'),
    
        'address' => $request->get('address'),
    
        'birth_date' => $request->get('birth_date'),
    
        'joining_date' => $request->get('joining_date'),

        'm_id'=>$request->get('m_id'));

    
     
       
        // $data=$request->;
        DB::table('employees')->where('emp_id',$emp->emp_id)->update($data);  
        $salary=DB::table('salaries')->where('s_id',$emp->emp_id)->first(); 
        $salary_data=array(

        'package' => $request->get('package'),
    
        'gratuity' => $request->get('gratuity'),
    
        'variable_salary' => $request->get('variable_salary'),
    
        'basic_pay' => $request->get('basic_pay'),
    
        'rent_allowance' => $request->get('rent_allowance')); 
         DB::table('salaries')->where('s_id',$emp->emp_id)->update($salary_data);  
         $mid= $request->get('mid');
         Employee::where('emp_id',$emp->emp_id)->update(array('m_id' => $mid));
       
        

       

        return redirect('/newhomepage')->with('success','created successfully'); 
    }
    public function add_manager(Request $request)
    {
       // 
    }
  


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp=DB::table('employees')->where('id',$id)->get() ;
        DB::table('employees')->where('emp_id',$emp[0]->emp_id)->delete() ;
       
        DB::table('users')->where('id',$emp[0]->emp_id)->delete() ;
        return redirect()->back();
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

    }
    public function randomUserId()

    {

        $timestamp = time();

        $random = rand(1, 100);

        $emp_id = $timestamp . $random;

        return $emp_id;

    }
}
