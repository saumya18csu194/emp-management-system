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

    public function index(Request $request)  //search function and display data
    {
        $input=['search_word'=>$request->input('search_word')];
        $user1 = new Employee();
        $employees = $user1->search_employee($input);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)  //admin adds new employee data
    {
        $user = new Employee();
        $user1 = $user->get_employee();
        return view('employees.create', compact('user1'));
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
            'full_name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'joining_date' => 'required',
        ]);
        DB::beginTransaction();
        try
        {
        $employee_data=[
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'birth_date' => $request->input('birth_date'),
            'joining_date' => $request->input('joining_date'),
        ];
        $value = $this->randomUserId();
      
        $emp=new Employee();
        $emp->store_employee($employee_data,$value);
        $user2=new User();
        $abcd=$request->input('selectEmp1');
        if($request->input('select_manager')=='On')
        { 
            $select_manager=[           
            'name'=>$request->input('full_name'),
            'email'=>$request->input('email'),
            'role'=>'manager',
            'password' => bcrypt('pass@manager'), 
            'id'=>$value,         
            ];
            
            $user2->store_manager($abcd,$select_manager,$value);          
        }
        else
        {     
        $select_emp=[
        'id'=>$value,  
        'name'=>$request->input('full_name'),
        'email'=>$request->input('email'),
        'role'=>'employee',
        'password' => bcrypt('pass@employee'),
        
        ];
        
        $user2->store_employeee($select_emp);
        }    
        $salary = new Salary();
        $salary_save=[
            's_id'=>$value,
            'package'=>$request->input('package'),
            'variable_salary'=>$request->input('variable_salary'),
            'basic_pay'=>$request->input('basic_pay'),
            'rent_allowance'=>$request->input('rent_allowance'),
            'gratuity'=>$request->input('gratuity'),
           
        ];
        $salary->store_salary($salary_save,$value);
    }
    catch(Exception $e)
    {
        error_log($e);
        DB::rollback();
    }
    DB::commit();  
    return redirect('/newhomepage')->with('success', 'created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emp1=new Employee();
        $emp=$emp1->find_id($id);
        $sal=new Salary();
        $salary=$sal->find_sid($emp);
        $user=new User();
        $items=$user->find_managerlist();
        return view('employees.edit', compact('emp', 'salary', 'items'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  //admin updates employee data
    {
        $emp = new Employee();
        $salary = new Salary();
        $user=new User();
        $emp=new Employee();   
        DB::beginTransaction();
        try
        {   
        $data=array('full_name' => $request->get('full_name'),
        'email' => $request->get('email'),
        'gender' => $request->get('gender'),
        'address' => $request->get('address'),
        'birth_date' => $request->get('birth_date'),
        'joining_date' => $request->get('joining_date'),
        'm_id'=>$request->get('m_id'));   
        $mid= $request->get('mid');
        $emp->update_employee($data, $id,$mid);
        $data=array('name' => $request->get('full_name'),
        'email' => $request->get('email')); 
   
        $salary_data=array(
            'package' => $request->get('package'),
            'gratuity' => $request->get('gratuity'),
            'variable_salary' => $request->get('variable_salary'),
            'basic_pay' => $request->get('basic_pay'),
            'rent_allowance' => $request->get('rent_allowance')); 
        $salary->update_salary($salary_data, $id);

        }
        catch(Exception $e)
        {
            error_log(print_r($e));
            DB::rollback();
        }
        DB::commit();
        return redirect('/newhomepage')->with('success', 'created successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  //delete employee data 
    {
        DB::beginTransaction();
        try
        {
        $emp = new Employee();
        $emp->delete_employee($id);
        DB::commit();
        }
        catch(Exception $e)
        {
        error_log($e);
        DB::rollback();
        }
        return redirect()->back();
    }
    public function randomUserId() //generate employee id from timestamp+ random number
    {
        $timestamp = time();
        $random = rand(1, 100);
        $emp_id = $timestamp . $random;
        return $emp_id;
    }
}
