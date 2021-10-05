<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class TimeController extends Controller
{
    public function index()
    {
        return view('worktime.index');
    }

    public function HrTime()
    {
        $result = DB::select(DB::raw("SELECT *,DATE_FORMAT(work_time,'%Y-%m-%d') as date_s 
                FROM worktime
                LEFT JOIN users ON worktime.emp_barcode = users.barcode
                WHERE MONTH(worktime.work_time) = MONTH(CURDATE())
                AND YEAR(worktime.work_time) = YEAR(CURDATE())
                ORDER BY users.barcode ASC"));
        // return dd($result);
        $data = DB::table('users')
                ->where('users.work_status', 1)
                ->get();
        $dept = DB::table('departments')
                ->get();
        return view('worktime.hr', ['data'=>$data,'result'=>$result,'dept'=>$dept]);
    }
    
    public function addTime(Request $request)
    {
        DB::table('worktime')->insert(
            [
                'work_time' => $request->get('idate'),
                'emp_barcode' => $request->get('emp'),
                'work_note' => $request->get('note'),
                'work_status' => 1,
            ]
        );
    }

    public function reportTime(Request $request)
    {
        $dept_report = $request->get('dept');
        if($request->get('dept')==0){$finddept="";}else{$finddept="AND users.department = $dept_report";}
        $num_month_day=date("t",strtotime(date("Y")."-".$request->get('month')."-01"));
        $start_date_check = date("Y")."-".$request->get('month')."-01";
        $end_date_check = date("Y")."-".$request->get('month')."-".$num_month_day;
        $result = DB::select(DB::raw("SELECT *,DATE_FORMAT(work_time,'%Y-%m-%d') as date_s 
                FROM worktime
                LEFT JOIN users ON worktime.emp_barcode = users.barcode
                WHERE worktime.work_time >= '$start_date_check' 
                AND worktime.work_time <= '$end_date_check'
                $finddept
                ORDER BY users.barcode ASC"));
        return view('worktime.hr_report', ['result'=>$result]);
    }
    
}
