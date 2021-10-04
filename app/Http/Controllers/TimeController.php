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
        $data = DB::table('users')->get();
        return view('worktime.hr', ['data'=>$data,'result'=>$result]);
    }
    
}
