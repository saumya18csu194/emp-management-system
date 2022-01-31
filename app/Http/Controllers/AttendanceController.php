<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Attendance;
use App\Employee;
use Exception;
use App\Http\Requests\ValidationRequestAttendance;
class AttendanceController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    { 
        try
        {
        $emp=new Employee();
        $empid=$emp->findEmpId($id);
        $view=new Attendance();
        $result=$view->viewAttendance($empid);   //function defined in Attendance model to return attendance requests made by employees under manager
        return view('attendance.index',compact('result'));
        }
        catch(Exception $e)
        {
        error_log($e);
        }
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendance.create');  //for employee to create a new attendance request
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationRequestAttendance $request,$id)
    {
        try
        {
        $emp=new Employee();
        $empid=$emp->findEmpId($id); //to get emp_id of employee who is creating attendance request
        $store=new Attendance();       
        $attendance_data=[
            'shift_date_from' => $request->input('shift_date_from'),
            'shift_date_to' => $request->input('shift_date_to'),
            'location' => $request->input('location'),
            'message' => $request->input('message'),
        ];
        $result=$store->storeAttendance($attendance_data,$empid);  
        return redirect('/newhomepage'); //when attendance request created
        }

        catch(Exception $e)
        {
            error_log($e);
            
        }
       
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($attendance_id) //manager edits employee attendance
    {
        try
        {
        $update_attendance=new Attendance();
        $update=$update_attendance->updateAttendanceRequest($attendance_id);  //function defined in Attendance model when manager approves attendance request made by employee
        return redirect()->back();
        }
        catch(Exception $e)
        {
            error_log($e);
        }
    }
}
