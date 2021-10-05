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
                    ->select('work_id', 'work_time', 'emp_barcode', 'name', 'position','dept_name','work_note')
                    ->leftJoin('users', 'users.barcode', '=', 'worktime.emp_barcode')
                    ->leftJoin('departments', 'departments.dept_id', '=', 'users.department')
                    ->leftJoin('worktime_status', 'worktime_status.time_id', '=', 'worktime.work_status')
                    // ->where('work_time', '>=', DB::raw('curdate()'))
                    ->whereRaw('date_format(work_time, "%Y-%m-%d") >= curdate()')
                    ->get();
        return response()->json($result);
    }
}
