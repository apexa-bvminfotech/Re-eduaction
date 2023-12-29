<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentApproveLeave;
use App\Models\StudentAttendance;
use App\Models\StudentCourse;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentPtm;
use App\Models\StudentStaffAssign;
use App\Models\StudentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCourseComplete;

class StudentDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $studentId = Student::where('user_id',$user->id)->first();
        $students = Student::where('user_id',$user->id)->orderBy('id','DESC')->with('branch','trainer','courses','studentTrainer.trainer')->get();
        $studentPtm = StudentPtm::where('student_id',$studentId->id)->with('trainer');
        $studentStaffAssign = StudentStaffAssign::orderBy('id','DESC')->where('student_id',$studentId->id)->with('slot','trainer');
        $studentProxyStaffAssign = StudentProxyStaffAssign::orderBy('id','DESC')->where('student_id',$studentId->id)->with('slot','trainer');
        $studentCourse = StudentCourse::orderBy('id','DESC')->where('student_id',$studentId->id)->with('course.courseMaterial.studentCourseMaterial','appreciation');
        $studentAttendance = StudentAttendance::orderBy('id')->where('student_id', $studentId->id)->with('slot','trainer');
        $studentLeave = StudentApproveLeave::orderBy('id','DESC')->where('student_id', $studentId->id);
        $studentStatus = StudentStatus::orderBy('id','DESC')->where('student_id', $studentId->id);
        $student = Student::with('courses','studentDmit.trainer','studentStatus','branch','studentMaterial.material','studentTrainer.trainer')->where('student_id',$studentId->id);
        $trainer = StudentStaffAssign::where(['student_id' => $studentId->id, 'is_active' => 0])->first();
        $approvedCourse= StudentCourseComplete::where('status',2)->where('student_id',$studentId->id)->pluck('id')->toArray();

        //for date search in student ptm report
        $fromDatePtmreport = '';
        $toDatePtmReport = '';

        if(isset($_GET['fromDatePtmreport'])){
            $fromDatePtmreport = $_GET['fromDatePtmreport'];
        }
        if(isset($_GET['toDatePtmReport'])){
            $toDatePtmReport = $_GET['toDatePtmReport'];
        }

        $qurey = $studentPtm;

        if($fromDatePtmreport != '' && $fromDatePtmreport != null){
            $qurey->whereDate('date', '>=', date('Y-m-d', strtotime($fromDatePtmreport)));
        }

        if($toDatePtmReport != '' && $toDatePtmReport != null){
            $qurey->whereDate('date', '<=',  date('Y-m-d', strtotime($toDatePtmReport)));
        }

        $studentPtm = $qurey->get();

        //for date serch in student staff assign
        $fromDateStaffAssign = '';
        $toDateStaffAssign = '';

        if(isset($_GET['fromDateStaffAssign'])){
            $fromDateStaffAssign = $_GET['fromDateStaffAssign'];
        }
        if(isset($_GET['toDateStaffAssign'])){
            $toDateStaffAssign = $_GET['toDateStaffAssign'];
        }

        $qurey = $studentStaffAssign;

        if($fromDateStaffAssign != '' && $fromDateStaffAssign != null){
            $qurey->whereDate('date', '>=', date('Y-m-d', strtotime($fromDateStaffAssign)));
        }

        if($toDateStaffAssign != '' && $toDateStaffAssign != null){
            $qurey->whereDate('date', '<=',  date('Y-m-d', strtotime($toDateStaffAssign)));
        }

        $studentStaffAssign = $qurey->get();

        //for search date in student proxy staff assign
        $fromProxyDateStaff = '';
        $toDateProxyStaff = '';

        if(isset($_GET['fromProxyDateStaff'])){
            $fromProxyDateStaff = $_GET['fromProxyDateStaff'];
        }
        if(isset($_GET['toDateProxyStaff'])){
            $toDateProxyStaff = $_GET['toDateProxyStaff'];
        }

        $qurey = $studentProxyStaffAssign;

        if($fromProxyDateStaff != '' && $fromProxyDateStaff != null){
            $qurey->whereDate('starting_date', '>=', date('Y-m-d', strtotime($fromProxyDateStaff)));
        }

        if($toDateProxyStaff != '' && $toDateProxyStaff != null){
            $qurey->whereDate('ending_date', '<=',  date('Y-m-d', strtotime($toDateProxyStaff)));
        }

        $studentProxyStaffAssign = $qurey->get();

        //for search date in student course
        $fromDateCourse = '';
        $toDateCourse = '';

        if(isset($_GET['fromDateCourse'])){
            $fromDateCourse = $_GET['fromDateCourse'];
        }
        if(isset($_GET['toDateCourse'])){
            $toDateCourse = $_GET['toDateCourse'];
        }

        $qurey = $studentCourse;

        if($fromDateCourse != '' && $fromDateCourse != null){
            $qurey->whereDate('start_date', '>=', date('Y-m-d', strtotime($fromDateCourse)));
        }

        if($toDateCourse != '' && $toDateCourse != null){
            $qurey->whereDate('end_date', '<=',  date('Y-m-d', strtotime($toDateCourse)));
        }

        $studentCourse = $qurey->get();

        //for search date in student leave list
        $fromDateLeave = '';
        $toDateLeave = '';

        if(isset($_GET['fromDateLeave'])){
            $fromDateLeave = $_GET['fromDateLeave'];
        }
        if(isset($_GET['toDateLeave'])){
            $toDateLeave = $_GET['toDateLeave'];
        }

        $qurey = $studentLeave;

        if($fromDateLeave != '' && $fromDateLeave != null){
            $qurey->whereDate('start_date', '>=', date('Y-m-d', strtotime($fromDateLeave)));
        }

        if($toDateLeave != '' && $toDateLeave != null){
            $qurey->whereDate('end_date', '<=',  date('Y-m-d', strtotime($toDateLeave)));
        }

        $studentLeave = $qurey->get();

        //for search date in student attendance
        $fromDateAttendance = '';
        $toDateAttendance = '';

        if(isset($_GET['fromDateAttendance'])){
            $fromDateAttendance = $_GET['fromDateAttendance'];
        }
        if(isset($_GET['toDateAttendance'])){
            $toDateAttendance = $_GET['toDateAttendance'];
        }

        $qurey = $studentAttendance;

        if($fromDateAttendance != '' && $fromDateAttendance != null){
            $qurey->whereDate('attendance_date', '>=', date('Y-m-d', strtotime($fromDateAttendance)));
        }

        if($toDateAttendance != '' && $toDateAttendance != null){
            $qurey->whereDate('attendance_date', '<=',  date('Y-m-d', strtotime($toDateAttendance)));
        }

        $studentAttendance = $qurey->get();

        //for search date in student status
        $fromDateStatus = '';
        $toDateStatus = '';

        if(isset($_GET['fromDateStatus'])){
            $fromDateStatus = $_GET['fromDateStatus'];
        }
        if(isset($_GET['toDateStatus'])){
            $toDateStatus = $_GET['toDateStatus'];
        }

        $qurey = $studentStatus;

        if($fromDateStatus != '' && $fromDateStatus != null){
            $qurey->whereDate('date', '>=', date('Y-m-d', strtotime($fromDateStatus)));
        }

        if($toDateStatus != '' && $toDateStatus != null){
            $qurey->whereDate('date', '<=',  date('Y-m-d', strtotime($toDateStatus)));
        }

        $studentStatus = $qurey->get();

        return view('dashboard.student_dashboard',compact('students','student','approvedCourse','trainer','studentPtm','fromDatePtmreport','toDatePtmReport','studentStaffAssign','studentProxyStaffAssign',
                    'studentCourse','studentAttendance','studentLeave','studentStatus','fromDateStaffAssign','toDateStaffAssign','fromProxyDateStaff','toDateProxyStaff',
                        'fromDateCourse','toDateCourse','fromDateLeave','toDateLeave','fromDateAttendance','toDateAttendance','fromDateStatus','toDateStatus'));
    }
}
