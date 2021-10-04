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
        $userDept = Auth::User()->department;
        $data = DB::table('leave_list')
                    ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                    ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                    ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                    ->where('leave_list.user_id', $userID)
                    ->get();
        $uname = DB::table('users')
                    ->select('id', 'name', 'department')
                    ->where('work_status', 1)
                    ->where('users.department', $userDept)
                    ->where('users.id', '!=' ,$userID)
                    ->orderBy('users.id', 'asc')
                    ->get();
        $num = DB::table('leave_num')
                    ->where('leave_num.job_type',  Auth::User()->job)
                    ->first();
        $vac = DB::table('leave_vacation')
                    ->where('leave_vacation.user_id',  Auth::User()->id)
                    ->first();
        $count = DB::select(DB::raw("SELECT
                    (SELECT SUM(leave_num) FROM leave_list WHERE leave_type = '1' AND user_id = '{$userID}' AND leave_status ='3' GROUP BY user_id) AS busy,
                    (SELECT SUM(leave_num) FROM leave_list WHERE leave_type = '2' AND user_id = '{$userID}' AND leave_status ='3' GROUP BY user_id) AS sick,
                    (SELECT SUM(leave_num) FROM leave_list WHERE leave_type = '3' AND user_id = '{$userID}' AND leave_status ='3' GROUP BY user_id) AS vacation"));
        return view('leave.index', ['data'=>$data,'uname'=>$uname,'count'=>$count,'num'=>$num,'vac'=>$vac]);
    }

    public function addLeave(Request $request)
    {
        $userID = Auth::User()->id;
        $date = date("Y-m-d H:i:s");
        // Check Holiday
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
        // if (!isset(Auth::User()->line_token)){
        //     $statusID = '1';
        // }
        if (Auth::User()->unit == 1){
            $statusID = '2';
        }else{
            $statusID = '1';
        }
        // if (isset(Auth::User()->line_token)){
        //     $statusID = '2';
        // }
        if($request->get('leave_type') == 1 ){ $t_name = 'ลากิจ'; }
        if($request->get('leave_type') == 2 ){ $t_name = 'ลาป่วย'; }
        if($request->get('leave_type') == 3 ){ $t_name = 'ลาพักผ่อน'; }
        // Insert Leave Request
        DB::table('leave_list')->insert(
            [
                'leave_type' => $request->get('leave_type'),
                'leave_create' => $date,
                'leave_start' => $request->get('leave_start'),
                'leave_end' => $request->get('leave_end'),
                'leave_num' => $intWorkDay,
                'leave_time' => $request->get('leave_time'),
                'leave_stead' => $request->get('leave_stead'),
                'leave_note' => $request->get('leave_note'),
                'leave_status' => $statusID,
                'user_id' => $userID
            ]
        );
        // Get Unithead & Send Line Notify
        $data = DB::table('users')
                ->leftJoin('departments', 'users.department', '=', 'departments.dept_id')
                ->where('users.id', $userID)
                ->first();
        $unit = DB::table('users')
                ->where('users.id', $data->unit)
                ->first();
        // $Token = "al9wgTb0rZZq40Vf1gPdyz0XNuYsCdcBZL5hbLHagsz";
        $Token = $unit->line_token;
        $message = "มีรายการขออนุมัติวันลา\nจาก : ".Auth::User()->name."\nประเภท : ".$t_name."\nวันที่ลา : "
                    .DateThai($request->get('leave_start'))."\nถึงวันที่ : ".DateThai($request->get('leave_end')).
                    "\nจำนวน : ".$intWorkDay." วัน\nกรุณาดำเนินการก่อน ".DateThai($request->get('leave_start')).
                    "\nURL : https://erp.wc-hospital.go.th/";
        line_notify($Token, $message);
    }

    public function list($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::table('leave_list')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                ->leftJoin('personals', 'users.id', '=', 'personals.user_id')
                ->where('leave_list.leave_id', $parm_id)
                ->first();
        return view('leave.list', ['list'=>$list]);
    }

    public function cancelList(Request $request, $id)
    {
        $note = $request->get('formData');
        $date = date("Y-m-d H:i:s");
        DB::table('leave_list')->where('leave_id', $id)->update(
            [
                'leave_status' => 5,
                'leave_cancel' => Auth::User()->name,
                'leave_cancel_note' => $note,
                'leave_cancel_date' => $date,
            ]
        );
    }

    public function approve()
    {
        $deptID = Auth::User()->department;
        $list = DB::table('leave_list')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                // ->whereIn('leave_list.leave_status',[1,5])
                ->where('users.department', $deptID)
                ->get();
        return view('leave.approve', ['list'=>$list]);
    }

    public function show($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::table('leave_list')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                ->leftJoin('personals', 'users.id', '=', 'personals.user_id')
                ->where('leave_list.leave_id', $parm_id)
                ->first();
        return view('leave.approve_show', ['list'=>$list]);
    }

    public function allowList(Request $request, $id)
    {
        $date = date("Y-m-d H:i:s");
        $list = DB::table('leave_list')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->where('leave_list.leave_id', $id)
                ->first();
        if($list->leave_status == 1){
            // echo "Send To PJ";
            DB::table('leave_list')->where('leave_id', $id)->update(
                [
                    'leave_hnote' => $request->get('hnote'),
                    'leave_status' => 2
                ]
            );
            // $Token = "al9wgTb0rZZq40Vf1gPdyz0XNuYsCdcBZL5hbLHagsz";
            $Token = "rJeUj5NcPslNXbv6sE8x2KMKXdbkyyfba2kNebCcyub";
            $message = "มีรายการขออนุมัติวันลารอดำเนินการ\nกรุณาดำเนินการที่ : https://erp.wc-hospital.go.th/";
            line_notify($Token, $message);
        }else{
            // echo "Send To Watchan Family";
            DB::table('leave_list')->where('leave_id', $id)->update(
                [
                    'leave_dnote' => 'เห็นควรอนุมัติ',
                    'leave_approve' => $date,
                    'leave_status' => 3,
                ]
            );
            // $Token = "al9wgTb0rZZq40Vf1gPdyz0XNuYsCdcBZL5hbLHagsz";
            $Token = "o1c1RWlrNWcDuKg0J2q7rV3N6xpXLoFHkW8va0qUM2X";
            $message = "รายการ : รหัส HR-".$list->leave_id."\nผู้ขออนุมัติ : ".$list->name."\nวันที่ลา : ".DateThai($list->leave_start)."\nได้รับการอนุมัติแล้ว";;
            line_notify($Token, $message);
        }
    }

    public function disallowList(Request $request, $id)
    {
        DB::table('leave_list')->where('leave_id', $id)->update(
            [
                'leave_hnote' => $request->get('hnote'),
                'leave_status' => 4
            ]
        );
    }

    public function authorizeList()
    {
        $list = DB::table('leave_list')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                ->where('leave_list.leave_status','=',2)
                ->get();
        return view('leave.authorize', ['list'=>$list]);
    }

    public function approve_all()
    {
        $date = date("Y-m-d H:i:s");
        $list = DB::table('leave_list')
                ->select('name','leave_id','leave_start')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->where('leave_list.leave_status','=',2)
                ->get();
        $text = "";
        foreach ($list as $res){
            $text .= "รายการ : รหัส HR-".$res->leave_id."\nผู้ขออนุมัติ : ".$res->name."\nวันที่ลา : ".DateThai($res->leave_start)."\n";
            $text .= "ได้รับการอนุมัติแล้ว\n\n";
        }
        // Send Line To Watchan Family
        // $Token = "al9wgTb0rZZq40Vf1gPdyz0XNuYsCdcBZL5hbLHagsz";
        $Token = "o1c1RWlrNWcDuKg0J2q7rV3N6xpXLoFHkW8va0qUM2X";
        $message = $text;
        line_notify($Token, $message);

        DB::table('leave_list')->where('leave_status', 2)->update(
            [
                'leave_dnote' => 'อนุมัติรายการ',
                'leave_approve' => $date,
                'leave_status' => 3,
            ]
        );
    }

    public function HrmleaveList()
    {
        $list = DB::table('leave_list')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                ->get();
        return view('leave.hr', ['list'=>$list]);
    }

    public function Hrshow($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::table('leave_list')
                ->leftJoin('users', 'leave_list.user_id', '=', 'users.id')
                ->leftJoin('leave_type', 'leave_list.leave_type', '=', 'leave_type.type_id')
                ->leftJoin('leave_time', 'leave_list.leave_time', '=', 'leave_time.time_id')
                ->leftJoin('leave_status', 'leave_list.leave_status', '=', 'leave_status.status_id')
                ->leftJoin('personals', 'users.id', '=', 'personals.user_id')
                ->where('leave_list.leave_id', $parm_id)
                ->first();
        return view('leave.hr_show', ['list'=>$list]);
    }

}
