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
        return view('helpdesk.index', ['list'=>$list,'place'=>$place]);
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
}
