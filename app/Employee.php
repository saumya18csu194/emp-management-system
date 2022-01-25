<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
use Illuminate\Http\Request;

class Employee extends Model
{
    protected $fillable = ["emp_id","full_name", "email", "age","gender","phone_number","address","birth_date","joining_date"];
    protected $table='employees';
    public function get_employee()
    {
        $user1=DB::table('employees')->get();       
        return $user1;
    }
    public function search_employee(Request $request)
    {
        $search =  $request->input('q');
        if($search!=""){
            $employees= Employee::where(function ($query) use ($search)
            {
                $query->where('full_name', 'like', '%'.$search.'%');  
            })
            ->paginate(2);
            $employees->appends(['q' => $search]);
        }
        else
        {
            $employees = Employee::paginate(2);
        }
        error_log(print_r($employees)); //to check print_r working
        return $employees;
    }
    public function update_employee(Request $request,$id)
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
        $mid= $request->get('mid');
        Employee::where('emp_id',$emp->emp_id)->update(array('m_id' => $mid));
    }
    public function delete_employee($id)
    {
        $emp=Employee::where('id',$id)->get() ;
        Employee::where('emp_id',$emp[0]->emp_id)->delete() ;       
        
    }
}
