<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;

class Employee extends Model
{
    protected $fillable = ["emp_id","full_name", "email", "age","gender","phone_number","address","birth_date","joining_date"];
    protected $table='employees';
    public function find_id($id)
    {
        $empl = self::where('id', $id)->first();
        $emp = self::where('emp_id', $empl->emp_id)->first();
        return $emp;
    }
    public function find_employee_by_email()
    {
        $email=Auth::user()->email;     
        $emp=self::where('email',$email)->first();
        $get_emp_id=self::where('emp_id',$emp->emp_id)->first();  
        $empid=$get_emp_id->emp_id; 
        return $empid;
    }
    public function get_employee()
    {
        $user1=self::get();       
        return $user1;
    }
    public function store_employee($employee_data,$value)
    {
        self::create($employee_data + ['emp_id' => $value]);
    }
    public function search_employee($input)
    {
        $search =  $input['search_word'];
        if($search!="")
        {
            $employees= self::where('full_name', 'like', '%'.$search.'%')
            ->paginate(2);
            $employees->appends(['search_word' => $search]);
        }
        else
        {
            $employees = self::paginate(2);
        }
        error_log(print_r($employees)); //to check print_r working
        return $employees;
    }
    public function update_employee($data,$id,$mid)
    {
        $emp=self::where('id',$id)->first() ;
        $empl=self::where('emp_id',$emp->emp_id)->first(); 
        self::where('emp_id',$emp->emp_id)->update($data);  
 
        
        var_dump($mid);
        self::where('emp_id',$emp->emp_id)->update(array('m_id' => $mid));
        // app('App\User')->update_user($emp);     
    }
    public function delete_employee($id)
    {
        $emp=self::where('id',$id)->get() ;
        self::where('emp_id',$emp[0]->emp_id)->delete() ;
        app('App\User')->delete_user($id,$emp);               
    }
}
