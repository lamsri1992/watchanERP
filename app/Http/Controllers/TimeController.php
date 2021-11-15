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

    public function reportWork(Request $request)
    {
        $dept_report = $request->get('dept');
        $month_report = $request->get('month');
        if($request->get('dept')==0){ $finddept=""; }else{ $finddept = "AND users.department = $dept_report";}
        $report = DB::select(DB::raw("SELECT users.name,users.barcode,departments.dept_name,users.position,jobs.job_name,COUNT(worktime.work_id) AS works,
                (SELECT SUM(leave_list.leave_num) FROM leave_list WHERE leave_list.leave_type = '1' AND leave_list.user_id = users.id 
                AND leave_list.leave_status ='3' AND (leave_list.leave_start >= '2021-{$month_report}-01' AND leave_list.leave_end <= '2021-{$month_report}-31') GROUP BY users.id) AS busy,
                (SELECT SUM(leave_list.leave_num) FROM leave_list WHERE leave_list.leave_type = '2' AND leave_list.user_id = users.id 
                AND leave_list.leave_status ='3' AND (leave_list.leave_start >= '2021-{$month_report}-01' AND leave_list.leave_end <= '2021-{$month_report}-31') GROUP BY users.id) AS sick,
                (SELECT SUM(leave_list.leave_num) FROM leave_list WHERE leave_list.leave_type = '3' AND leave_list.user_id = users.id 
                AND leave_list.leave_status ='3' AND (leave_list.leave_start >= '2021-{$month_report}-01' AND leave_list.leave_end <= '2021-{$month_report}-31') GROUP BY users.id) AS vacation
                FROM users
                LEFT JOIN worktime ON worktime.emp_barcode = users.barcode
                LEFT JOIN departments ON departments.dept_id = users.department
                LEFT JOIN jobs ON jobs.job_id  = users.job
                WHERE worktime.work_time BETWEEN '2021-{$month_report}-01' AND '2021-{$month_report}-31'
                $finddept
                GROUP BY users.id,users.name,users.barcode,departments.dept_name,users.position,jobs.job_name
                ORDER BY departments.dept_id,users.barcode ASC"));
        return view('worktime.hr_summary', ['report'=>$report]);
        // return dd($report);
    }

    public function reportPerson(Request $request)
    {
        $user = DB::table('users')
                ->where('users.id', $request->get('empID'))
                ->first();

        $data = DB::table('leave_list')
                ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->leftJoin('departments', 'users.department', '=', 'departments.dept_id')
                ->leftJoin('jobs', 'users.job', '=', 'jobs.job_id')
                ->where('leave_list.user_id', $request->get('empID'))
                ->whereDate('leave_start','>=', $request->get('dateStr'))
                ->whereDate('leave_end','<=', $request->get('dateEnd'))
                ->where('leave_status', 3)
                ->get();
        // return dd($data);
        return view('worktime.hr_person', ['data'=>$data,'user'=>$user]);

    }
    
}
