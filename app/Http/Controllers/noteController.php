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
    
    public function print()
    {
        return view('note.print');
    }
}
