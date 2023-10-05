<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

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
    Route::resource('student', 'StudentsController');
    Route::resource('student_ptm', 'StudentPTMController');
    Route::group(['prefix'=>'student'],function (){
        Route::get('/staff-slot/{id}','StudentsController@slot');
        Route::post('/assign-staff', 'StudentsController@assignStaff')->name('student.assignStaff');
        //proxy-staff-route
        Route::get('/proxy-slot/{id}','StudentsController@proxySlot');
        Route::get('/get-leave-data/{id}','StudentsController@getLeaveData')->name('student.getLeaveData');
        Route::post('/get-course-material-data','StudentsController@getCourseMaterialData')->name('student.getCourseMaterialData');

        Route::get('/edit-student-approve-leave/{id}','StudentsController@proxySlot');
        Route::post('/proxy-staff', 'StudentsController@proxyStaff')->name('student.proxyStaff');
        Route::post('/send-notification', 'StudentsController@sendNotification')->name('student.sendNotification');
        Route::post('/student-leave-approve','StudentsController@studentLeaveApprove')->name('student.studentLeaveApprove');
        Route::post('/edit-student-leave-approve','StudentsController@editStudentLeaveApprove')->name('student.editStudentLeaveApprove');
        Route::post('/change-student-status','StudentsController@ChangeStudentStatus')->name('student.ChangeStudentStatus');
        Route::post('/student-appreciation','StudentsController@studentAppreciation')->name('student.studentAppreciation');
        Route::get('/update-course-start-end-date/{student_id}/{course_id}/{task}','StudentsController@updateCourseStartEndDate')->name('student.updateCourseStartEndDate');
    });
    Route::resource('roles', 'RoleController');
    Route::resource('trainer', 'TrainerController');
    Route::resource('rtc', 'RtcController');
    Route::resource('slot', 'SlotController');
    Route::resource('trainer_attendance', 'TrainerAttendanceController');
    Route::resource('student_attendance','StudentAttendanceController');
    Route::resource('course', 'CourseController');
    Route::resource('appreciation', 'AppreciationController');
    Route::resource('point', 'PointController')->only(['destroy']);
    Route::resource('subCourse', 'SubCourseController')->only(['destroy']);
    Route::resource('user','UserController');
    Route::resource('branch','BranchController');
    Route::resource('course_material','CourseWiseMaterialController');
    Route::get('changeRtcStatus', 'RtcController@changeRtcStatus');
    Route::get('changeSlotStatus', 'SlotController@changeSlotStatus');
    Route::get('changeUserStatus','UserController@changeUserStatus');
    Route::get('changeTrainerStatus','TrainerController@changeTrainerStatus');
    Route::get('changeBranchStatus','BranchController@changeBranchStatus');

    Route::get('get-trainer-data','SlotController@gettrainerdata')->name('get-trainer-data');
    Route::get('myprofile', 'UserController@profile')->name('profile');
    Route::post('user/{user}/update-profile-image', 'UserController@updateProfileImage')->name('user.update-profile-image');

    Route::get('/reports-trainer-wise-student-rtc-slot','ReportController@getTrainerWiseStudentRtcSlot')->name('report.trainer-wise-student-rtc-slot');
    Route::get('/reports-course-wise-student','ReportController@getCourseWiseStudentList')->name('report.course-wise-student-list');
    Route::get('/reports-student-list','ReportController@getStudentList')->name('report.student-list');
    Route::post('/search-date','ReportController@getSearchDate')->name('student.getSerachDate');
    Route::get('/pending-appreciation-student-list','ReportController@getPendingAppreciationStudentList')->name('report.pending-appreciation-student-list');
    Route::get('/pending-course-student-list','ReportController@getPendingCourseStudentList')->name('report.pending-course-student-list');
    Route::get('/student-list-with-course-detail','ReportController@getStudentListWithCourseDetail')->name('report.student-list-with-course-detail');
    Route::get('/pending-counselling-student-list','ReportController@getPendingCounselllingStudentList')->name('report.pending-counselling-student-list');
    Route::get('/pending-material-list-student-list','ReportController@getPendingMaterialListStudentList')->name('report.pending-material-list-student-list');
    Route::get('/student-status-list','ReportController@getStudentStatusList')->name('report.student-status-list');
});

