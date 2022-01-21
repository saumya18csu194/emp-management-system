<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Attendance;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email=Auth::user()->email;
        $emp=DB::table('employees')->where('email',$email)->first();
        $get_emp_id=DB::table('employees')->where('emp_id',$emp->emp_id)->first();
        $empid=$get_emp_id->emp_id;
      
        // $result=DB::select("select * from attendances where emp_id in ");
        $result=DB::select("select * from attendances where emp_id in(SELECT emp_id FROM employees WHERE m_id=$empid) and status!=1");
     
        return view('attendance.index',compact('result'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $email=Auth::user()->email;
        $emp=DB::table('employees')->where('email',$email)->first();
        $get_emp_id=DB::table('employees')->where('emp_id',$emp->emp_id)->first();
        $empid=$get_emp_id->emp_id;
        Attendance::create($request->all()+ ['emp_id' => $empid,'status'=>0]);
       
        return redirect('/newhomepage'); 
    }



    public function get_status()
    {

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($attendance_id)
    {

        Attendance::where('attendance_id', $attendance_id)->update(array('status' => 1));
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
