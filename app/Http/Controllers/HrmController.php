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
    }

    public function editEmp(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update(
            [
                'name' => $request->get('name'),
                'department' => $request->get('dept'),
                'position' => $request->get('position'),
                'job' => $request->get('job'),
                'work_start' => $request->get('work_start')
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

}
