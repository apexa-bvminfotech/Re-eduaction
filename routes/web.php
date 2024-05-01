<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\ResetPasswordController;


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
Route::get('migrate', function() {
    Artisan::call('migrate');
    echo "Migration run success<br>";
});
Route::get('seeder', function() {
    Artisan::call('db:seed --class=CreateAdminUserSeeder');
    echo "Migration run seeder<br>";
});
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    echo "Cache is cleared<br>";
    Artisan::call('route:clear');
    echo "route cache is cleared<br>";
    Artisan::call('config:clear');
    echo "config is cleared<br>";
    Artisan::call('view:clear');
    echo "view is cleared<br>";
});
Route::get('/dashboard', function () {
    $user =  Auth::user()->type;
    if ($user == 0 || $user == 3) {
        return redirect()->route('admindashboard.index');
    } elseif ($user == 1) {
        return redirect()->route('trainerdashboard.index');
    } else {
        return redirect()->route('studentdashboard.index');
    }
})->middleware(['auth:web'])->name('login-as-user');

//Route for change password
Route::get('reset-password','Auth\ResetPasswordController@showResetPasswordForm')->name('reset.password.form');
Route::post('reset-password', 'Auth\ResetPasswordController@submitResetPasswordForm')->name('reset.password.update');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>['auth']],function (){
    Route::resource('student', 'StudentsController');
    Route::post('change-student-pwd','StudentsController@changeStudentPwd')->name('change.student.pwd');
    Route::delete('/delete/{id}','StudentsController@delete')->name('delete');
   // Route::get('/showStartdate', 'StudentsController@showStartdate')->name('showStartdate');
    Route::post('/storeStartdate//{student_id}/{course_id}', 'StudentsController@storeStartdate')->name('storeStartdate');

    Route::resource('student_ptm', 'StudentPTMController');
    Route::group(['prefix'=>'student'],function (){
        Route::get('/staff-slot/{id}','StudentsController@slot');
        Route::get('/shift-regular-slot/{id}/{oldSlotId}','SlotController@slot');
        Route::get('/shift-proxy-slot/{id}','SlotController@proxySlot');
        Route::get('/trainer-proxy-slot/{id}','StudentsController@trainerProxySlot');
        Route::get('/trainer-regular-slot/{id}','StudentsController@trainerRegularSlot');
        Route::post('/assign-staff', 'StudentsController@assignStaff')->name('student.assignStaff');
        //proxy-staff-route
        Route::get('/get-leave-data/{id}','StudentsController@getLeaveData')->name('student.getLeaveData');
        Route::post('/get-course-material-data','StudentsController@getCourseMaterialData')->name('student.getCourseMaterialData');

        // Route::delete('delete/{id}', [StudentsController::class, 'delete'])->name('student.delete');
        Route::get('/edit-student-approve-leave/{id}','StudentsController@proxySlot');
        Route::post('/proxy-staff', 'StudentsController@proxyStaff')->name('student.proxyStaff');
        Route::post('/send-notification', 'StudentsController@sendNotification')->name('student.sendNotification');
        Route::post('/edit-proxy-slot', 'StudentsController@editProxySlot')->name('student.editProxySlot');
        Route::post('/edit-regular-slot', 'StudentsController@editRegularSlot')->name('student.editRegularSlot');
        Route::post('/student-leave-approve','StudentsController@studentLeaveApprove')->name('student.studentLeaveApprove');
        Route::post('/edit-student-leave-approve','StudentsController@editStudentLeaveApprove')->name('student.editStudentLeaveApprove');
        Route::post('/change-student-status','StudentsController@ChangeStudentStatus')->name('student.ChangeStudentStatus');
        Route::post('/student-appreciation','StudentsController@studentAppreciation')->name('student.studentAppreciation');
        Route::put('/updateStartDate/{student_id}/{course_id}','StudentsController@coursedate')->name('student.updateStartDate');
        Route::get('/update-course-start-end-date/{student_id}/{course_id}/{task}','StudentsController@updateCourseStartEndDate')->name('student.updateCourseStartEndDate');
        Route::get('/restart-course/{student_id}/{course_id}','StudentsController@restartCourse')->name('student.restartCourse');

    });
    Route::resource('roles', 'RoleController');
    Route::resource('trainer', 'TrainerController');
    Route::post('change-trainer-pwd','TrainerController@changeTrainerPwd')->name('change.trainer.pwd');
    Route::resource('rtc', 'RtcController');
    Route::resource('slot', 'SlotController');
    Route::resource('trainer_attendance', 'TrainerAttendanceController');
    Route::resource('student_attendance','StudentAttendanceController');
    Route::resource('course', 'CourseController');
    Route::resource('appreciation', 'appreciationController');
    Route::resource('point', 'PointController')->only(['destroy']);
    Route::resource('subCourse', 'SubCourseController')->only(['destroy']);
    Route::resource('user','UserController');
    Route::resource('branch','BranchController');
    Route::resource('course_material','CourseWiseMaterialController');

    Route::group(['prefix' => 'change-status'], function(){
        Route::get('/changeRtcStatus', 'RtcController@changeRtcStatus');
        Route::get('/changeSlotStatus', 'SlotController@changeSlotStatus');
        Route::get('/changeUserStatus','UserController@changeUserStatus');
        Route::get('/changeTrainerStatus','TrainerController@changeTrainerStatus');
        Route::get('/changeBranchStatus','BranchController@changeBranchStatus');
    });

    Route::post('/submit-shift-regular-slot', 'SlotController@shiftRegularSlot')->name('slot.shift-regular-slot');

    // Route::put('slots/{slotId}', [SlotController::class, 'update'])->name('update.slot');
    Route::get('get-trainer-data','SlotController@gettrainerdata')->name('get-trainer-data');
    Route::get('assign-proxy-slot','SlotController@assignProxySlot')->name('slot.assign-proxy-slot');
    Route::post('submit-proxy-slot','SlotController@submitProxySlot')->name('slot.submit-proxy-slot');
    Route::get('myprofile', 'UserController@profile')->name('profile');
    Route::post('user/{user}/update-profile-image', 'UserController@updateProfileImage')->name('user.update-profile-image');

    Route::get('/report-list','ReportController@index')->name('report.report-list');
    Route::get('/reports-trainer-wise-student-rtc-regular-slot','ReportController@getTrainerWiseStudentRtcRegularSlot')->name('report.trainer-wise-student-rtc-regular-slot');
    Route::get('/reports-trainer-wise-student-rtc-proxy-slot','ReportController@getTrainerWiseStudentRtcProxySlot')->name('report.trainer-wise-student-rtc-proxy-slot');
    Route::get('/reports-course-wise-student','ReportController@getCourseWiseStudentList')->name('report.course-wise-student-list');
    Route::get('/reports-student-list','ReportController@getStudentList')->name('report.student-list');
    Route::get('/pending-appreciation-student-list','ReportController@getPendingAppreciationStudentList')->name('report.pending-appreciation-student-list');
    Route::get('/pending-course-student-list','ReportController@getPendingCourseStudentList')->name('report.pending-course-student-list');
    Route::get('/student-list-with-course-detail','ReportController@getStudentListWithCourseDetail')->name('report.student-list-with-course-detail');
    Route::get('/pending-counselling-student-list','ReportController@getPendingCounselllingStudentList')->name('report.pending-counselling-student-list');
    Route::get('/pending-material-list-student-list','ReportController@getPendingMaterialListStudentList')->name('report.pending-material-list-student-list');
    Route::get('/student-status-list','ReportController@getStudentStatusList')->name('report.student-status-list');
    Route::get('/weekly-student-list-with-trainer','ReportController@getWeeklyStudentListWithTrainer')->name('report.weekly-student-list-with-trainer');
    Route::get('/transfer-student-transfer-trainer-list','ReportController@getTransferStudentTransferTrainerList')->name('report.transfer-student-transfer-trainer-list');
    Route::get('/reports-student-data','ReportController@getStudentData')->name('report.student-data');
    Route::get('/student-courseduration','ReportController@studentcourseduration')->name('report.student-courseduration');
    Route::get('/sloat-wise-student','ReportController@sloatwisestudent')->name('report.sloatwisestudent');
    Route::get('/proxy-sloat-wise-student','ReportController@Proxysloatwisestudent')->name('report.Proxysloatwisestudent');

    Route::group(['prefix' => 'trainer-dashboard'], function(){
        Route::get('/','TrainerDashboardController@index')->name('trainerdashboard.index');
        Route::get('/trainer-schedule','TrainerDashboardController@traineWeeklySchedule')->name('trainer.weekly.schedule');
        Route::post('/trinerweeklyadd', 'TrainerDashboardController@trinerweeklyadd')->name('get-slot-times');
        Route::get('shift-triner-slot/{id}','TrainerDashboardController@TrinerSlot');
        Route::post('/slots/{slotId}', 'TrainerDashboardController@slotupdate')->name('sloatupdate');
        Route::post('/proxy-slot/{slotId}', 'TrainerDashboardController@proxySlotUpdate')->name('proxySlotUpdate');
        Route::delete('/delete/{slotId}', 'TrainerDashboardController@delete')->name('delete.slot');
        Route::delete('/proxy-delete/{slotId}', 'TrainerDashboardController@ProxyDelete')->name('Proxy-delete.slot');
    });

    Route::group(['prefix'=>'student-dashboard'],function (){
        Route::get('/','StudentDashboardController@index')->name('studentdashboard.index');
        Route::get('/student_ptm_report','StudentDashboardController@index');
        Route::get('/student_staff_assign','StudentDashboardController@index');
        Route::get('/student_proxy_staff_assign','StudentDashboardController@index');
        Route::get('/student_course','StudentDashboardController@index');
        Route::get('/student_leave','StudentDashboardController@index');
        Route::get('/student_attendance','StudentDashboardController@index');
        Route::get('/student_status','StudentDashboardController@index');
    });

    Route::group(['prefix' => 'admin-dashboard'], function(){
        Route::get('/','AdminDashboardController@index')->name('admindashboard.index');
    });




});

