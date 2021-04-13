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
        $Token = "w5QuztyBKpMk262OYuuQP6rV1v7bFO1ooX2JvHHJDzh";
        // $Token = $unit->line_token;
        $message = "มีรายการแจ้งซ่อมคอมพิวเตอร์\nจาก : ".Auth::User()->name."\nอาการ : ".$request->get('title')."\nสถานที่/ห้อง : ".$place->place_name."\nกรุณาดำเนินที่ : https://erp.watchanhospital.com/";
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
        // $note = $request->get('fixFrm');
        $date = date("Y-m-d H:i:s");
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
    }
}
