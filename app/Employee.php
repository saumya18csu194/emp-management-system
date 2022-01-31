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
    public function findId($id)
    { 
        $emp = self::where('id', $id)->first(); 
                    
        return $emp;    
    }
    public function findEmpId($id)
    {
        $emp=Employee::where('id',$id)->first() ;
        $empid=$emp->emp_id;
        return $empid;
    }
    public function storeEmployeesUnderManager($employees_under_manager,$value)   //if new employee is also manager:store details of employees under new manager
    {          
            $update= self::whereIn('emp_id',$employees_under_manager)
            ->update(array('m_id' => $value));                        
    }

   
    public function getEmployee()
    {
        $user1=self::get();       
        return $user1;
    }
    public function storeEmployee($employee_data,$value)
    {
        self::create($employee_data + ['emp_id' => $value]);
    }
    public function searchEmployee($search_word)
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

    public function updateEmployee($data,$id,$mid)
    {
        $emp=self::where('id',$id)->first() ;
        $empl=self::where('emp_id',$emp->emp_id)->first(); 
        self::where('emp_id',$emp->emp_id)->update($data);  
        self::where('emp_id',$emp->emp_id)->update(array('m_id' => $mid));
           
    }
    public function deleteEmployee($id)
    {
        $emp=self::where('id',$id)->get();
        $empid=self::where('emp_id',$emp[0]->emp_id)->delete();                    
    }
}
