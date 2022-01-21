<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ["package","basic_pay","rent_allowance","variable_salary","gratuity"];
}
