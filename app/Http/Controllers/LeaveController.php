<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $userID = Auth::User()->id;
        $data = DB::table('leave_list')
                    ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                    ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                    ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                    ->where('leave_list.user_id', $userID)
                    ->get();
        $uname = DB::table('users')
                    ->select('id', 'name')
                    ->where('work_status', '=', 'work')
                    ->orderBy('users.id', 'asc')
                    ->get();
        return view('leave.index', ['data' => $data],['uname' => $uname]);
    }

    public function addLeave(Request $request)
    {
        $strStartDate = $request->get('leave_start');
        $strEndDate = $request->get('leave_end');
        $intWorkDay = 0;
        $intHoliday = 0;
        $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;
    
        while (strtotime($strStartDate) <= strtotime($strEndDate)) {
    
            $DayOfWeek = date("w", strtotime($strStartDate));
            if($DayOfWeek == 0 or $DayOfWeek ==6){ $intHoliday++; }
            else{ $intWorkDay++; }
            $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
        }

        if ($request->get('leave_time')== '2' || $request->get('leave_time') == '3'){
            $intWorkDay = $intWorkDay - 0.5;
        }

        $userID = Auth::User()->id;
        DB::table('leave_list')->insert(
            [
                'leave_type' => $request->get('leave_type'),
                'leave_start' => $strStartDate,
                'leave_end' => $strEndDate,
                'leave_num' => $intWorkDay,
                'leave_time' => $request->get('leave_time'),
                'leave_stead' => $request->get('leave_stead'),
                'leave_note' => $request->get('leave_note'),
                'user_id' => $userID
            ]
        );
    }
}
