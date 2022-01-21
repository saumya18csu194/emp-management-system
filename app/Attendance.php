<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['attendance_id','shift_date_from','shift_date_to','location','message','status','emp_id','created_at','updated_at'];
}
