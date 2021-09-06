<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HelpDeskController extends Controller
{
    public function index()
    {
        $list = DB::table('helpdesk')
                ->leftJoin('helpdesk_status', 'helpdesk_status.hs_id', '=', 'helpdesk.help_status')
                ->leftJoin('helpdesk_rate', 'helpdesk_rate.t_help_id', '=', 'helpdesk.help_id')
                ->leftJoin('places', 'places.place_id', '=', 'helpdesk.help_place')
                ->leftJoin('departments', 'departments.dept_id', '=', 'helpdesk.help_dept')
                ->get();
        $place = DB::table('places')
                ->get();
        $count = DB::select(DB::raw("SELECT
                (SELECT COUNT(help_id) FROM helpdesk WHERE help_status = '1') AS wait,
                (SELECT COUNT(help_id) FROM helpdesk WHERE help_status = '2') AS repair,
                (SELECT COUNT(help_id) FROM helpdesk WHERE help_status = '3') AS finish"));
        return view('helpdesk.index', ['list'=>$list,'place'=>$place,'count'=>$count]);
    }

    public function addHelpdesk(Request $request)
    {
        $userID = Auth::User()->id;
        $userDept = Auth::User()->department;
        $curdate = date('Y-m-d H:i:s');
        // Get Place Name
        $place = DB::table('places')
                ->where('place_id', $request->get('place'))
                ->first();
        // Insert Helpdesk Request
        DB::table('helpdesk')->insert(
            [
                'help_date' => $curdate,
                'help_title' => $request->get('title'),
                'help_create' => $userID,
                'help_dept' => $userDept,
                'help_place' => $request->get('place')
            ]
        );
        $Token = "al9wgTb0rZZq40Vf1gPdyz0XNuYsCdcBZL5hbLHagsz";
        $message = "มีรายการแจ้งซ่อมคอมพิวเตอร์\nจาก : ".Auth::User()->name."\nอาการ : ".$request->get('title')."\nสถานที่/ห้อง : ".$place->place_name."\nตรวจสอบได้ที่ : https://erp.wc-hospital.go.th/";
        line_notify($Token, $message);
    }

    public function show($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::table('helpdesk')
                ->leftJoin('users', 'users.id', '=', 'helpdesk.help_create')
                ->leftJoin('departments', 'departments.dept_id', '=', 'helpdesk.help_dept')
                ->leftJoin('places', 'places.place_id', '=', 'helpdesk.help_place')
                ->leftJoin('helpdesk_type', 'helpdesk_type.ht_id', '=', 'helpdesk.help_type')
                ->leftJoin('helpdesk_status', 'helpdesk_status.hs_id', '=', 'helpdesk.help_status')
                ->leftJoin('helpdesk_rate', 'helpdesk_rate.t_help_id', '=', 'helpdesk.help_id')
                ->where('helpdesk.help_id', $parm_id)
                ->first();
        $type = DB::table('helpdesk_type')
                ->get();
        $stat = DB::table('helpdesk_status')
                ->get();
        return view('helpdesk.show', ['list'=>$list,'type'=>$type,'stat'=>$stat]);
    }

    public function fixHelpdesk(Request $request, $id)
    {
        $date = date("Y-m-d H:i:s");
        $mess = DB::table('helpdesk')
                ->where('help_id', $id)
                ->leftJoin('users', 'users.id', '=', 'helpdesk.help_create')
                ->leftJoin('departments', 'departments.dept_id', '=', 'helpdesk.help_dept')
                ->leftJoin('places', 'places.place_id', '=', 'helpdesk.help_place')
                ->leftJoin('helpdesk_type', 'helpdesk_type.ht_id', '=', 'helpdesk.help_type')
                ->first();
        DB::table('helpdesk')->where('help_id', $id)->update(
            [
                'help_fix' => $request->get('fix'),
                'help_cause' => $request->get('cause'),
                'help_type' => $request->get('type'),
                'help_support' => Auth::User()->name,
                'help_status' => $request->get('stat'),
                'help_end' => $date,
            ]
        );
        if($request->get('stat') == 3){
            $Token = "al9wgTb0rZZq40Vf1gPdyz0XNuYsCdcBZL5hbLHagsz";
            $message = "รายการแจ้งซ่อมคอมพิวเตอร์ดำเนินการสำเร็จแล้ว
            \nผู้แจ้ง : ".$mess->name."
            \nอาการ : ".$mess->help_title."
            \nสาเหตุ : ".$request->get('cause')."
            \nวิธีแก้ไข : ".$request->get('fix')."
            \nสถานที่/ห้อง : ".$mess->place_name."
            \nกรุณาประเมินความพึงพอใจที่ : https://erp.wc-hospital.go.th/ (ระบบงานแจ้งซ่อม -> แจ้งซ่อมคอมพิวเตอร์)";
            line_notify($Token, $message);
        }
    }

    public function rateHelpdesk(Request $request, $id)
    {
        DB::table('helpdesk_rate')->insert(
            [
                'rate_1' => $request->get('rate_1'),
                'rate_2' => $request->get('rate_2'),
                'rate_3' => $request->get('rate_3'),
                'rate_user' => Auth::User()->name,
                't_help_id' => $id
            ]
        );
    }
}
