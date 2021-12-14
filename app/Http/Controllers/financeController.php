<?php

namespace App\Http\Controllers;

use App\Imports\salaryImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use File;
use Auth;

class financeController extends Controller
{
    public function index()
    {
        $result = DB::table('salary')
                ->join('users', 'users.acc_no', '=', 'salary.acc_no')
                ->get();

        $salog = DB::table('salary_log')
                ->orderBy('sal_id', 'desc')
                ->limit(5)
                ->get();

        return view('finance.index',['result'=>$result,'salog'=>$salog]);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'select-file' => 'required|mimes:xls,xlsx'
        ]);
        
        // $path1 = $request->file('select-file')->getRealPath();
        $path1 = $request->file('select-file')->store('temp'); 
        $path = storage_path('app').'/'.$path1;  
        $data = \Excel::import(new salaryImport, $path);

        // Upload Files
        $file  = $request->file('select-file');
        $fileName = date('Ymdhis')."_".$file->getClientOriginalName();
        $destination = public_path('Files/');
        File::makeDirectory($destination, 0777, true, true);
        $file->move(public_path('Files/'), $fileName);
        // Update File Destination to Mysql
        DB::table('salary_log')->insert(
            [
                'sal_file' => $fileName,
            ]
        );
       
        return back()->with('success', 'นำเข้าข้อมูลเงินเดือนสำเร็จ');
    }

    public function salary(Request $request)
    {
        $year = date('Y')+543;
        $accno = Auth::User()->acc_no;
        $sal = DB::table('salary')
                ->join('users', 'users.acc_no', '=', 'salary.acc_no')
                ->where('users.acc_no', $accno)
                ->where('salary.year',$year)
                ->orderby('salary_id','desc')
                ->get();
        // return dd($sal);
        return view('finance.slip',['sal'=>$sal]);
    }

    public function slip($id)
    {
        for ($i = 0; $i < 10; $i++)
        {
            $id = base64_decode($id);
        }
        $slip = DB::table('salary')
                ->where('salary_id', $id)
                ->first();

        return view('finance.view',['slip'=>$slip]);
    }

    public function slip_print($id)
    {
        for ($i = 0; $i < 10; $i++)
        {
            $id = base64_decode($id);
        }
        $data = DB::table('salary')
                ->join('users', 'users.acc_no', '=', 'salary.acc_no')
                ->where('salary_id', $id)
                ->first();

        return view('finance.sal_print',['data'=>$data]);
    }
}
