<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HR_API extends Controller
{
    public function index()
    {
        $result = DB::table('users')
                    ->select('id', 'barcode', 'name', 'position', 'dept_name','job_name'
                    ,'address','tel','person_name','person_tel','person_address','img')
                    ->leftJoin('departments', 'users.department', '=', 'departments.dept_id')
                    ->leftJoin('personals', 'users.id', '=', 'personals.user_id')
                    ->leftJoin('jobs', 'users.job', '=', 'jobs.job_id')
                    ->where('work_status', '=', 'work')
                    ->orderBy('users.id', 'asc')
                    ->get();
        return response()->json($result);
    }
}
