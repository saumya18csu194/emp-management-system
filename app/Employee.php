<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ["emp_id","full_name", "email", "age","gender","phone_number","address","birth_date","joining_date"];

}
