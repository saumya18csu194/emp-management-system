<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Salary extends Model
{
    protected $fillable = ["s_id","package","basic_pay","rent_allowance","variable_salary","gratuity"];
    public function findSid($emp)
    {
        $salary = self::where('s_id', $emp->emp_id)->first();
        return $salary;
    }
    public function storeSalary($salary_save,$value)
    {
        
        self::create($salary_save+ ['s_id' => $value]);
    }
    public function updateSalary($salary_data,$emp)
    {      
        $salary=self::where('s_id',$emp->emp_id)->first();    
        self::where('s_id',$emp->emp_id)->update($salary_data);  
    }
}
