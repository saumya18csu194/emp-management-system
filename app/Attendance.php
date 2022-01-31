<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB;
class Attendance extends Model
{
    protected $fillable = ['attendance_id','shift_date_from','shift_date_to','location','message','status','emp_id','created_at','updated_at'];
    public function view_attendance($empid)
    {     
        //below is the query to return attendance queries made by employees under manager   
        $result = self::whereIn('emp_id', function ($query) use ($empid){
            $query->select('emp_id')
                ->from('employees')
                ->where('m_id',$empid)
                ->where('status',0);
        })->get(); 
        return $result;
    }

    public function store_attendance($attendance_data,$empid)
    {
        self::create($attendance_data+ ['emp_id' => $empid,'status'=>0]);    //set status=0(which means employee has requested attendance approve,not yet approoved)   
    }
    public function update_attendance_request($attendance_id) //manager approves attendance
    {
        self::where('attendance_id', $attendance_id)->update(array('status' => 1)); //set status=1(attendance approved)
    }


}
