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
}
