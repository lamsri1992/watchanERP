<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class noteController extends Controller
{
    public function index()
    {
        $list = DB::table('notes')
                ->get();
        $emplist = DB::table('users')
                ->get();
        return view('note.index', ['list'=>$list,'emplist'=>$emplist]);
    }
    
    public function print($id)
    {
        $parm_id = base64_decode($id);
        $note = DB::table('notes')
                ->leftJoin('users', 'users.id', '=', 'notes.note_emp')
                ->leftJoin('departments', 'departments.dept_id', '=', 'users.department')
                ->where('notes.note_id', $parm_id)
                ->first();
        
        $head_id = $note->unit;
        $headlist = DB::table('users')
                ->select('id', 'name', 'position')
                ->where('id', $head_id)
                ->first();

        $list_id = $note->note_list;
        if($list_id != ""){
            $emplist = DB::table('users')
                    ->select('id', 'name', 'position')
                    ->whereRaw('id in ('.$list_id.')')
                    ->get();
            return view('note.print', ['note'=>$note,'emplist'=>$emplist,'headlist'=>$headlist]);
        }else{
            return view('note.print', ['note'=>$note,'headlist'=>$headlist]);
        }
    }

    public function addNote(Request $request)
    {
        $userID = Auth::User()->id;
        if($request->get('list')){
            $arr_select = array();
            foreach($request->get('list') as $list){
                $arr_select[] = $list;
            }
            $emplist = implode(",", $arr_select);
        }else{
            $emplist = "";
        }

        DB::table('notes')->insert(
            [
                'note_emp' => $userID,
                'note_list' => $emplist,
                'note_place' => $request->get('place'),
                'note_title' => $request->get('title'),
                'note_start' => $request->get('dstart'),
                'note_end' => $request->get('dend')
            ]
        );
    }

}
