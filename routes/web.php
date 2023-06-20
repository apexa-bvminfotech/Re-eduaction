<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>['auth']],function (){
    Route::resource('student', 'StudentsController');;
    Route::group(['prefix'=>'student'],function (){
        Route::get('/staff-slot/{id}','StudentsController@sloat');
        Route::post('/assign-staff', 'StudentsController@assignStaff')->name('student.assignStaff');
    });
    Route::resource('roles', 'RoleController');
    Route::resource('trainer', 'TrainerController');
    Route::resource('rtc', 'RtcController');
    Route::resource('slot', 'SlotController');
    Route::resource('staff_attendance', 'StaffAttendanceController');
    Route::resource('course', 'CourseController');
    Route::resource('point', 'PointController')->only(['destroy']);
    Route::resource('subCourse', 'SubCourseController')->only(['destroy']);
    Route::resource('user','UserController');
//    Route::resource('branch','BranchController');
    Route::get('changeRtcStatus', 'RtcController@changeRtcStatus');
    Route::get('changeSlotStatus', 'SloatController@changeSloatStatus');
    Route::get('changeStaffStatus', 'StaffController@changeStaffStatus');
    Route::get('changeUserStatus','UserController@changeUserStatus');
    Route::get('get-trainer-data','SlotController@gettrainerdata')->name('get-trainer-data');
});

