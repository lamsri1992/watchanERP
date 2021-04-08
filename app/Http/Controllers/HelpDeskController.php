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
                ->leftJoin('departments', 'departments.dept_id', '=', 'helpdesk.help_dept')
                ->get();
        return view('helpdesk.index', ['list'=>$list]);
    }
}
