<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class TimeController extends Controller
{
    public function index()
    {
        // $count = DB::select(DB::raw("SELECT COUNT(*) FROM worktime WHERE STR_TO_DATE(work_time, '%Y-%m-%d') = CURDATE() AS count_normal"));
        // return view('worktime.index', ['count'=>$count]);
        return view('worktime.index');
    }
}
