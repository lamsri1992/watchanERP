<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CALENDAR_API extends Controller
{
    public function index()
    {
        $result = DB::table('leave_list')
                    ->selectRaw('CONCAT(name," : ",type_name) AS title , leave_start AS start, leave_end AS end')
                    ->leftJoin('users', 'users.id', '=', 'leave_list.user_id')
                    ->leftJoin('leave_type', 'leave_type.type_id', '=', 'leave_list.leave_type')
                    ->where('leave_status', '=', '3')
                    ->get();
        return response()->json($result);
    }
}
