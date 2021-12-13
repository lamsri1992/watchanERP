<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $userID = Auth::user()->id;
         // Check Personal Data
         $check = DB::table('personals')->where('user_id', $userID)->first();
         DB::table('users')->where('id', $userID)->update(
            [
                'acc_no' => $request->get('acc_no')
            ]
        );
         
        if(isset($check)){
            DB::table('personals')->where('user_id', $userID)->update(
                [
                    'address' => $request->get('address'),
                    'tel' => $request->get('tel'),
                    'person_name' => $request->get('person_name'),
                    'person_tel' => $request->get('person_tel'),
                    'person_address' => $request->get('person_address')
                ]
            );
        }else{
            DB::table('personals')->insert(
                [
                    'address' => $request->get('address'),
                    'tel' => $request->get('tel'),
                    'person_name' => $request->get('person_name'),
                    'person_tel' => $request->get('person_tel'),
                    'person_address' => $request->get('person_address'),
                    'user_id' => $userID
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
