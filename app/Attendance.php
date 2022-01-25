<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
class Attendance extends Model
{
    protected $fillable = ['attendance_id','shift_date_from','shift_date_to','location','message','status','emp_id','created_at','updated_at'];
    public function view_attendance()
    {
        $email=Auth::user()->email;     
        $emp=Employee::where('email',$email)->first();
        $get_emp_id=Employee::where('emp_id',$emp->emp_id)->first();  
        $empid=$get_emp_id->emp_id; 
        //below is the query to return attendance queries made by employees under manager   
        $result=DB::select("select * from attendances where emp_id in(SELECT emp_id FROM employees WHERE m_id=$empid) and status!=1"); 
        return $result;
    }
    public function store_attendance(Request $request)
    {
        $email=Auth::user()->email;
        $emp=Employee::where('email',$email)->first();
        $get_emp_id=DB::table('employees')->where('emp_id',$emp->emp_id)->first();
        $empid=$get_emp_id->emp_id;
        Attendance::create($request->all()+ ['emp_id' => $empid,'status'=>0]);    //set status=0(which means manager has not approved )   
    }
    public function update_attendance_request($attendance_id)
    {
        Attendance::where('attendance_id', $attendance_id)->update(array('status' => 1)); //set status=1(attendance approved)
    }


}
