<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.index', 'uses' => 'ProfileController@index']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('personal','PersonalController@update')->name('personal');
});


Route::namespace('Auth')->group(function () {
	Route::post('/login','LoginController@login')->name('login');
});

Route::get('/hr', function () {
    return view('hr.index');
});

Route::group(['prefix' => 'leave'], function () {
	Route::get('/','LeaveController@index')->name('leave.index');
	Route::get('/addLeave','LeaveController@addLeave')->name('leave.addLeave');
	Route::get('/approve','LeaveController@approve')->name('leave.approve');
	Route::get('/{id}','LeaveController@list')->name('leave.list_show');
    Route::get('/cancleList/{id}','LeaveController@cancleList')->name('leave.cancleList');

});

Route::group(['prefix' => 'approve'], function () {
	Route::get('/','LeaveController@approve')->name('leave.approve');
	Route::get('/{id}','LeaveController@show')->name('leave.approve_show');
    Route::get('/allowList/{id}','LeaveController@allowList')->name('approve.allowList');
    Route::get('/disallowList/{id}','LeaveController@disallowList')->name('approve.disallowList');
});

Route::group(['prefix' => 'authorize'], function () {
	Route::get('/','LeaveController@authorizeList')->name('leave.authorize');
	Route::get('/approve_all','LeaveController@approve_all')->name('leave.approve_all');
});

Route::group(['prefix' => 'hrm'], function () {
	Route::get('/leave','LeaveController@HrmLeaveList')->name('leave.hr');
	Route::get('/leave/{id}','LeaveController@Hrshow')->name('leave.hr_show');
});

Route::group(['prefix' => 'worktime'], function () {
	Route::get('/','TimeController@index')->name('worktime.index');
});

Route::group(['prefix' => 'helpdesk'], function () {
	Route::get('/','HelpDeskController@index')->name('helpdesk.index');
	Route::get('/addHelpdesk','HelpDeskController@addHelpdesk')->name('helpdesk.addHelpdesk');
	Route::get('/fixHelpdesk/{id}','HelpDeskController@fixHelpdesk')->name('helpdesk.fixHelpdesk');
	Route::get('/{id}','HelpDeskController@show')->name('helpdesk.show');
});