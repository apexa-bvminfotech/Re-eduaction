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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>['auth']],function (){
    Route::resource('student', 'StudentsController');
    Route::resource('roles', 'RoleController');
    Route::resource('staff', 'StaffController');
    Route::resource('rtc', 'RtcController');
    Route::resource('sloat', 'SloatController');
    Route::resource('course', 'CourseController');
    Route::resource('point', 'PointController')->only(['destroy']);
    Route::resource('subCourse', 'SubCourseController')->only(['destroy']);
});

