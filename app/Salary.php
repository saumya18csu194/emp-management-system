<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Salary extends Model
{
    protected $fillable = ["package","basic_pay","rent_allowance","variable_salary","gratuity"];

    public function store_salary(Request $request,$value)
    {
        $salary=new Salary();
        $salary->package=$request->input('package');
        $salary->variable_salary=$request->input('variable_salary');
        $salary->basic_pay=$request->input('basic_pay');
        $salary->rent_allowance=$request->input('rent_allowance');
        $salary->gratuity=$request->input('gratuity');
        $salary->s_id=$value;
        $salary->save();
    }
    public function update_salary($request,$id)
    {
        $emp=Employee::where('id',$id)->first() ;
        $salary=Salary::where('s_id',$emp->emp_id)->first(); 
        $salary_data=array(
        'package' => $request->get('package'),
        'gratuity' => $request->get('gratuity'),
        'variable_salary' => $request->get('variable_salary'),
        'basic_pay' => $request->get('basic_pay'),
        'rent_allowance' => $request->get('rent_allowance')); 
         Salary::where('s_id',$emp->emp_id)->update($salary_data);  
    }
}
