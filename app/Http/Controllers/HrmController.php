<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HrmController extends Controller
{
    public function employeeList()
    {
        $data = DB::table('users')
                    ->leftJoin('departments', 'users.department', '=', 'departments.dept_id')
                    ->leftJoin('work_status', 'users.work_status', '=', 'work_status.ws_id')
                    ->orderBy('users.id', 'asc')
                    ->get();
        return view('hr.emplist', ['data'=>$data]);
        // return dd($data);
    }

    public function employeeShow($id)
    {
        $parm_id = base64_decode($id);
        $data = DB::table('users')
                    ->leftJoin('departments', 'users.department', '=', 'departments.dept_id')
                    ->leftJoin('jobs', 'users.job', '=', 'jobs.job_id')
                    ->leftJoin('work_status', 'users.work_status', '=', 'work_status.ws_id')
                    ->leftJoin('leave_num', 'users.job', '=', 'leave_num.job_type')
                    ->leftJoin('leave_vacation', 'users.id', '=', 'leave_vacation.user_id')
                    ->leftJoin('personals', 'users.id', '=', 'personals.user_id')
                    ->where('users.id', $parm_id)
                    ->first();
        $dept = DB::table('departments')
                    ->get();
        $jobs = DB::table('jobs')
                    ->get();

        return view('hr.show', ['data'=>$data,'dept'=>$dept,'jobs'=>$jobs]);
        // return dd($data);
    }
}
