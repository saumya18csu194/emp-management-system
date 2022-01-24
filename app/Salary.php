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
}
