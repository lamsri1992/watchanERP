<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HrmController extends Controller
{
    public function dashboard()
    {
        $users = DB::table('users')
                ->where('work_status', 1)
                ->count();
        $resign = DB::table('users')
                ->where('work_status', 2)
                ->count();
        $leaves = DB::table('leave_list')
                ->count();
        $times = DB::table('worktime')
                ->count();
        return view('hr.dashboard', ['users'=>$users,'leaves'=>$leaves,'resign'=>$resign,'times'=>$times]);
    }

    public function employeeList()
    {
        $data = DB::table('users')
                    ->leftJoin('departments', 'users.department', '=', 'departments.dept_id')
                    ->leftJoin('jobs', 'users.job', '=', 'jobs.job_id')
                    ->leftJoin('work_status', 'users.work_status', '=', 'work_status.ws_id')
                    ->orderBy('users.id', 'asc')
                    ->get();
        $dept = DB::table('departments')
                    ->get();
        $jobs = DB::table('jobs')
                    ->get();
        $unit = DB::table('users')
                    ->get();
        return view('hr.emplist', ['data'=>$data,'dept'=>$dept,'jobs'=>$jobs,'unit'=>$unit]);
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
        $unit = DB::table('users')
                    ->get();
        $perm = DB::table('permissions')
                    ->get();
        $leaves = DB::table('leave_list')
                    ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                    ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                    ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                    ->orderBy('leave_list.leave_id', 'asc')
                    ->where('leave_list.user_id', $parm_id)
                    ->get();
        return view('hr.show', ['data'=>$data,'dept'=>$dept,'jobs'=>$jobs,'unit'=>$unit,'leaves'=>$leaves,'perm'=>$perm]);
    }

    public function editEmp(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update(
            [
                'name' => $request->get('name'),
                'department' => $request->get('dept'),
                'position' => $request->get('position'),
                'job' => $request->get('job'),
                'permission' => $request->get('perm'),
                'work_start' => $request->get('work_start'),
                'line_token' => $request->get('line_token'),
                'acc_no' => $request->get('acc_no'),
                'unit' => $request->get('unit')
            ]
        );
        // Check Personal Data
        $check = DB::table('personals')
                ->where('user_id', $id)
                ->first();
        if(isset($check)){
            DB::table('personals')->where('user_id', $id)->update(
                [
                    'dob' => $request->get('dob'),
                    'email' => $request->get('email'),
                    'address' => $request->get('address'),
                    'tel' => $request->get('tel'),
                    'person_name' => $request->get('person_name'),
                    'person_tel' => $request->get('person_tel'),
                    'person_address' => $request->get('person_address')
                ]
            );
        }else{
            DB::table('personals')->insert(
                [
                    'dob' => $request->get('dob'),
                    'email' => $request->get('email'),
                    'address' => $request->get('address'),
                    'tel' => $request->get('tel'),
                    'person_name' => $request->get('person_name'),
                    'person_tel' => $request->get('person_tel'),
                    'person_address' => $request->get('person_address'),
                    'user_id' => $id
                ]
            );
        }
    }

    public function resign(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update(
            [
                'work_end' => $request->get('resign'),
                'work_status' => 2
            ]
        );
    }

    public function addVacation(Request $request, $id)
    {
        DB::table('leave_vacation')->insert(
            [
                'balance_new' => $request->get('vacNum'),
                'user_id' => $id
            ]
        );
    }

    public function addEmp(Request $request)
    {
        // Generate Barcode_ID
        $dept = DB::table('departments')
                    ->where('dept_id', $request->get('dept'))
                    ->first();
        $e_dept = DB::table('users')
                    ->where('department', $request->get('dept'))
                    ->count();
        $new_id = $e_dept + 1;
        $barcode = "D00".$dept->dept_id."-H00".$new_id;

        DB::table('users')->insert(
            [
                'barcode' => $barcode,
                'name' => $request->get('name'),
                'department' => $request->get('dept'),
                'position' => $request->get('position'),
                'job' => $request->get('job'),
                'work_start' => $request->get('work_start'),
                'unit' => $request->get('unit')
            ]
        );
    }

}
