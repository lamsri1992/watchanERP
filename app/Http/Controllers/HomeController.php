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
                    (SELECT COUNT(leave_num) FROM leave_list WHERE leave_type = '1' AND date_format(leave_start, '%Y-%m-%d') = curdate() AND leave_status ='3') AS busy,
                    (SELECT COUNT(leave_num) FROM leave_list WHERE leave_type = '2' AND date_format(leave_start, '%Y-%m-%d') = curdate() AND leave_status ='3') AS sick,
                    (SELECT COUNT(leave_num) FROM leave_list WHERE leave_type = '3' AND date_format(leave_start, '%Y-%m-%d') = curdate() AND leave_status ='3') AS vacation"));
        return view('dashboard', ['data'=>$data]);
        // return dd($data);
    }
}

