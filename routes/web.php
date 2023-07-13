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
        Route::get('/staff-slot/{id}','StudentsController@slot');
        Route::post('/assign-staff', 'StudentsController@assignStaff')->name('student.assignStaff');
        //proxy-staff-route
        Route::get('/proxy-slot/{id}','StudentsController@proxySlot');
        Route::post('/proxy-staff', 'StudentsController@proxyStaff')->name('student.proxyStaff');
    });
    Route::resource('roles', 'RoleController');
    Route::resource('trainer', 'TrainerController');
    Route::resource('rtc', 'RtcController');
    Route::resource('slot', 'SlotController');
    Route::resource('trainer_attendance', 'TrainerAttendanceController');
    Route::resource('student_attendance','StudentAttendanceController');
    Route::resource('course', 'CourseController');
    Route::resource('point', 'PointController')->only(['destroy']);
    Route::resource('subCourse', 'SubCourseController')->only(['destroy']);
    Route::resource('user','UserController');
    Route::resource('branch','BranchController');

    Route::get('changeRtcStatus', 'RtcController@changeRtcStatus');
    Route::get('changeSlotStatus', 'SlotController@changeSlotStatus');
//    Route::get('changeStaffStatus', 'StaffController@changeStaffStatus');
    Route::get('changeUserStatus','UserController@changeUserStatus');
    Route::get('changeTrainerStatus','TrainerController@changeTrainerStatus');

    Route::get('get-trainer-data','SlotController@gettrainerdata')->name('get-trainer-data');
});

