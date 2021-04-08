<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TIME_API extends Controller
{
    public function index()
    {
        $result = DB::table('worktime')
                    ->select('work_id', 'work_time', 'emp_barcode', 'name', 'position','dept_name')
                    ->leftJoin('users', 'users.barcode', '=', 'worktime.emp_barcode')
                    ->leftJoin('departments', 'departments.dept_id', '=', 'users.department')
                    ->where('work_time', '>=', DB::raw('curdate()'))
                    ->get();
        return response()->json($result);
    }
}
