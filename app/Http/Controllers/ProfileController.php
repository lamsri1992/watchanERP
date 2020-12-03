<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userID = Auth::user()->id;
        $data = DB::table('users')
                ->leftJoin('departments', 'users.department', '=', 'departments.dept_id')
                ->leftJoin('jobs', 'users.job', '=', 'jobs.job_id')
                ->where('users.id', $userID)
                ->first();
        $unit = DB::table('users')
                ->where('users.id', $data->unit)
                ->first();
        return view('profile.index', ['data' => $data], ['unit' => $unit]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('บันทึกการแก้ไขข้อมูลสำเร็จ'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('บันทึกการแก้ไขรหัสผ่านสำเร็จ.'));
    }
}
