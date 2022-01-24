<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
use DB;
use Illuminate\Http\Request;

class Employee extends Model
{
    protected $fillable = ["emp_id","full_name", "email", "age","gender","phone_number","address","birth_date","joining_date"];

    public function get_employee()
    {
        $user1=DB::table('employees')->get();
        return $user1;
    }
    public function search_employee(Request $request)
    {
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
        return $employees;
    }

}
