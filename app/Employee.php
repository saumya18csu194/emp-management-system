<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;
use Exception;

class Employee extends Model
{
    protected $fillable = ["id","emp_id","full_name", "email", "age","gender","phone_number","address","birth_date","joining_date"];
    protected $table='employees';
    public function find_id($id)
    {
        try
        {
        $empl = self::where('id', $id)->first();
        $emp = self::where('emp_id', $empl->emp_id)->first();        
        return $emp;
        }
        catch(Exception $e)
        {
            error_log($e);
        }       
    }
    public function find_empid($id)
    {
        $emp=Employee::where('id',$id)->first() ;
        $empid=$emp->emp_id;
        return $empid;
    }
    public function find_employee_by_email()
    {
        $email=Auth::user()->email;     
        $emp=self::where('email',$email)->first();       
        $get_emp_id=self::where('emp_id',$emp->emp_id)->first();  
        $empid=$get_emp_id->emp_id; 
        return $empid;
    }
    public function store_manager($employees_under_manager,$select_manager,$value)             //if new employee is also manager:store details of employees under new manager
    {          
            $role=array(['role'=>self::ROLE_TYPE_MANAGER]);
            $save=array_merge($select_manager,$role);
            $update= self::whereIn('emp_id',$employees_under_manager)
            ->update(array('m_id' => $value));                
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
    public function search_employee($search_word)
    {
        $search =  $search_word['search_word'];
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
    
        return $employees;
    }

    public function update_employee($data,$id,$mid)
    {
        $emp=self::where('id',$id)->first() ;
        $empl=self::where('emp_id',$emp->emp_id)->first(); 
        self::where('emp_id',$emp->emp_id)->update($data);  
        self::where('emp_id',$emp->emp_id)->update(array('m_id' => $mid));
           
    }
    public function delete_employee($id)
    {
        $emp=self::where('id',$id)->get();
        $empid=self::where('emp_id',$emp[0]->emp_id)->delete();                    
    }
}
