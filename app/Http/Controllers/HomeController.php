<?php

namespace App\Http\Controllers;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = DB::select(DB::raw("SELECT
                    (SELECT COUNT(*) FROM leave_list
                    WHERE CURDATE() BETWEEN STR_TO_DATE(leave_start, '%Y-%m-%d') AND STR_TO_DATE(leave_end, '%Y-%m-%d')
                    AND leave_status = '3' AND leave_type = '2' GROUP BY leave_type) AS sick,
                    (SELECT COUNT(*) FROM leave_list
                    WHERE CURDATE() BETWEEN STR_TO_DATE(leave_start, '%Y-%m-%d') AND STR_TO_DATE(leave_end, '%Y-%m-%d')
                    AND leave_status = '3' AND leave_type = '1' GROUP BY leave_type) AS busy,
                    (SELECT COUNT(*) FROM leave_list
                    WHERE CURDATE() BETWEEN STR_TO_DATE(leave_start, '%Y-%m-%d') AND STR_TO_DATE(leave_end, '%Y-%m-%d')
                    AND leave_status = '3' AND leave_type = '3' GROUP BY leave_type) AS vacation"));
        $count = DB::select(DB::raw("SELECT
                    (SELECT COUNT(leave_num) FROM leave_list WHERE leave_type = '1' AND leave_status ='3') AS busy,
                    (SELECT COUNT(leave_num) FROM leave_list WHERE leave_type = '2' AND leave_status ='3') AS sick,
                    (SELECT COUNT(leave_num) FROM leave_list WHERE leave_type = '3' AND leave_status ='3') AS vacation"));
        return view('dashboard', ['data'=>$data,'count'=>$count]);
    }
}

