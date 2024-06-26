<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Slot;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\StudentDMIT;
use App\Models\StudentStaffAssign;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStatus;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function index() {
        return view('reports.report_list');
    }

    public function getTrainerWiseStudentRtcRegularSlot(){
        $trainerWiseData = Branch::with(['trainer.slots.rtc','trainer.slots.slotList.student'])->get();
        return view('reports.trainer_wise_student_rtc_regular_slot',compact('trainerWiseData'));
    }

    public function getTrainerWiseStudentRtcProxySlot(){
        $trainerWiseData = Branch::with(['trainer.slots.rtc','trainer.slots.proxySlotlist.student'])->get();
        return view('reports.trainer_wise_student_rtc_proxy_slot',compact('trainerWiseData'));
    }

    public function getCourseWiseStudentList(){
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $courseWiseStudentData = StudentCourse::whereIn('student_id',$studentTrainer)->with('student','course')->get()->groupBy('course.course_name');
        }elseif(Auth::user()->type == 3)
        {
            $courseWiseStudentData = StudentCourse::with('student','course') ->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get()->groupBy('course.course_name');
        }
        else{
            $courseWiseStudentData = StudentCourse::with('student','course')->get()->groupBy('course.course_name');
        }
        return view('reports.course_wise_student_list',compact('courseWiseStudentData'));
    }

    public function getStudentList()
    {
        $data['startDate'] = '';
        $data['endDate'] = '';

        if(isset($_GET['startDate'])){
            $data['startDate'] = $_GET['startDate'];
        }
        if(isset($_GET['endDate'])){
            $data['endDate'] = $_GET['endDate'];
        }

        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $branch = Branch::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');

            $qurey = Student::whereIn('id',$studentTrainer)->from('students');
        }elseif(Auth::user()->type == 3)
        {
            $qurey = Student::from('students')->where('branch_id',Auth::user()->branch_id);
        }
        else{
            $qurey = Student::from('students');

        }

        if($data['startDate'] != '' && $data['startDate'] != null){
            $qurey->whereDate('registration_date', '>=', date('Y-m-d', strtotime($data['startDate'])));
        }

        if($data['endDate'] != '' && $data['endDate'] != null){
            $qurey->whereDate('registration_date', '<=',  date('Y-m-d', strtotime($data['endDate'])));
        }
        $data['studentList'] = $qurey->get();
        $data['studentList'] = $qurey->with('statusStudent','studentTrainer.trainer','branch')->get();
        return view('reports.student_list', $data);
    }

    public function getPendingAppreciationStudentList()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $pendingApprecitionStu = StudentCourse::whereIn('student_id',$studentTrainer)->with('student','course','appreciation')->where('end_date','!=',null)->where('appreciation_given_date',null)->get();
        }elseif(Auth::user()->type == 3){
            $pendingApprecitionStu = StudentCourse::with('student','course','appreciation')->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('end_date','!=',null)->where('appreciation_given_date',null)->get();
        }
        else{
            $pendingApprecitionStu = StudentCourse::with('student','course','appreciation')->where('end_date','!=',null)->where('appreciation_given_date',null)->get();
        }

        return view('reports.pending_appreciation_student_list',compact('pendingApprecitionStu'));
    }

    public function getPendingCourseStudentList()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active','0')->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $pendingCourseStu = StudentCourse::whereIn('student_id',$studentTrainer)->with('student','course')->where('start_date',null)->get();
        }elseif(Auth::user()->type == 3){
            $pendingCourseStu = StudentCourse::with('student','course')->where('start_date',null)->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
        }
        else{
            $pendingCourseStu = StudentCourse::with('student','course')->where('start_date',null)->get();
        }
        return view('reports.pending_course_student_list',compact('pendingCourseStu'));
    }

    public function getStudentListWithCourseDetail()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $studentCourse = StudentCourse::whereIn('student_id',$studentTrainer)->with('student','course')->get();
        }elseif(Auth::user()->type == 3)
        {
            $studentCourse = StudentCourse::with('student','course')->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
        }
        else{
            $studentCourse = StudentCourse::with('student','course')->get();
        }
        return view('reports.student_list_with_course_detail',compact('studentCourse'));
    }

    public function getPendingCounselllingStudentList()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $pendingCounselling = StudentDMIT::whereIn('student_id',$studentTrainer)->where('counselling_by','0')->with('student')->get();
            $pendingReport = StudentDMIT::whereIn('student_id',$studentTrainer)->where('report','0')->with('student')->get();
            $pendingKeyPoint = StudentDMIT::whereIn('student_id',$studentTrainer)->where('key_point',0)->with('student')->get();
        }elseif(Auth::user()->type == 3)
        {
            $pendingCounselling = StudentDMIT::where('counselling_by','0')->with('student')->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
            $pendingReport = StudentDMIT::where('report','0')->with('student')->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
            $pendingKeyPoint = StudentDMIT::where('key_point',0)->with('student')->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
        }
        else{
            $pendingCounselling = StudentDMIT::where('counselling_by','0')->with('student')->get();
            $pendingReport = StudentDMIT::where('report','0')->with('student')->get();
            $pendingKeyPoint = StudentDMIT::where('key_point',0)->with('student')->get();
        }

        return view('reports.pending_counselling_student_list',compact('pendingCounselling','pendingReport','pendingKeyPoint'));
    }

    public function getPendingMaterialListStudentList()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $students = Student::whereIn('id',$studentTrainer)->with('studentMaterial', 'courses.course')->get();
            $studentList = [];
            foreach ($students as $student) {
                if ($student->studentMaterial->isEmpty()) {
                    $studentList[] = $student;
                }
            }
        }elseif(Auth::user()->type == 3)
        {
            $students = Student::with('studentMaterial', 'courses.course')->where('branch_id', Auth::user()->branch_id)->get();
            $studentList = [];
            foreach ($students as $student) {
                if ($student->studentMaterial->isEmpty()) {
                    $studentList[] = $student;
                }
            }
        }
        else{
            $students = Student::with('studentMaterial', 'courses.course')->get();
            $studentList = [];
            foreach ($students as $student) {
                if ($student->studentMaterial->isEmpty()) {
                    $studentList[] = $student;
                }
            }
        }

        return view('reports.pending_material_list_student_list', compact('studentList'));
    }

    public function getStudentStatusList()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $studentStatus = StudentStatus::whereIn('student_id',$studentTrainer)->whereIn('status',['Hold','Cancel','Start','Pending','Cancel'])->where('is_active','0')->with('student.activeCourses.course','course','studentcourses')->get();
        }elseif(Auth::user()->type == 3)
        {
            $studentStatus = StudentStatus::whereIn('status',['Hold','Cancel','Start','Pending','Cancel'])->where('is_active','0')
            ->join('student_courses', 'student_courses.student_id', 'student_status.student_id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })
            ->with('student.activeCourses.course','course','studentcourses')->get();
        }
        else{
            $studentStatus = StudentStatus::whereIn('status',['Hold','Cancel','Start','Pending','Cancel'])->where('is_active','0')
            ->join('student_courses', 'student_courses.student_id', 'student_status.student_id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->with('student.activeCourses.course','course','studentcourses')->get();

        }
        return view('reports.student_status_list',compact('studentStatus'));
    }

    public function sloatwisestudent()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $stuListWithTrainer = StudentStaffAssign::
            with('trainer', 'student', 'slot', 'branch')
            ->whereIn('student_id',$studentTrainer)
            ->where('student_staff_assigns.is_active', 0)
            ->join('students', 'students.id', 'student_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.id')
            ->with('trainer', 'student', 'slot')
            ->get()
            ->groupBy('branch.slot_time');
        }elseif(Auth::user()->type == 3){
            $stuListWithTrainer = StudentStaffAssign::
            with('trainer', 'student', 'slot', 'branch')
            ->where('student_staff_assigns.is_active', 0)
            ->join('students', 'students.id', 'student_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.id')
            ->where('students.branch_id',Auth::user()->branch_id)
            ->with('trainer', 'student', 'slot')
            ->get()
            ->groupBy('branch.slot_time');
        }else{
            $stuListWithTrainer = StudentStaffAssign::
            with('trainer', 'student', 'slot', 'branch')
            ->where('student_staff_assigns.is_active', 0)
            ->join('students', 'students.id', 'student_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.id')
            ->with('trainer', 'student', 'slot')
            ->get()
            ->groupBy('branch.slot_time');
        }
        return view('reports.sloat_wise_student_list',compact('stuListWithTrainer'));
    }


    public function studentcourseduration()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $courseWiseStudentData = StudentCourse::whereIn('student_id',$studentTrainer)->with('student','course')->get();
        }elseif(Auth::user()->type == 3)
        {
            $courseWiseStudentData = StudentCourse::with('student','course')->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
        }else{
            $courseWiseStudentData = StudentCourse::with('student','course')->get();
            // dd($courseWiseStudentData);
        }
        return view('reports.course_duration_time_list',compact('courseWiseStudentData'));
    }

    public function Proxysloatwisestudent()
    {
        if(Auth::user()->type == 3)
        {
            $stuListWithTrainerProxy = StudentProxyStaffAssign::with('trainer', 'student', 'slot','branch')
            ->join('students', 'students.id', 'student_proxy_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->where('students.branch_id',Auth::user()->branch_id)
            ->get()->groupBy('trainer.name');
        }else{
            $stuListWithTrainerProxy = StudentProxyStaffAssign::with('trainer', 'student', 'slot','branch')
            ->join('students', 'students.id', 'student_proxy_staff_assigns.student_id')
             ->join('branches', 'branches.id', 'students.branch_id')
            ->get()->groupBy('trainer.name');

        }
        return view('reports.proxy_sloat_wise_student_list',compact('stuListWithTrainerProxy'));
    }

    public function getWeeklyStudentListWithTrainer()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
            $stuListWithTrainer = StudentStaffAssign::whereIn('student_id',$studentTrainer)->where('is_active','0')->with('trainer', 'student', 'slot')->get()->groupBy('trainer.name');
        }elseif(Auth::user()->type == 3)
        {
            $stuListWithTrainer = StudentStaffAssign::where('is_active','0')->with('trainer', 'student', 'slot')->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get()->groupBy('trainer.name');

        }
        else{
            $stuListWithTrainer = StudentStaffAssign::where('is_active','0')->with('trainer', 'student', 'slot')->get()->groupBy('trainer.name');
        }

        $trainerData = [];

        foreach ($stuListWithTrainer as $trainerName => $trainerSlot) {
            $trainerData[$trainerName] = [];

            foreach ($trainerSlot as $slots) {
                $slotID = $slots->slot->id;

                if (!isset($trainerData[$trainerName][$slotID])) {
                    $trainerData[$trainerName][$slotID] = [
                        'slot_time' => $slots->slot->slot_time,
                        'students' => [],
                    ];
                }
                if ($slots->student !== null) {
                    $trainerData[$trainerName][$slotID]['students'][] = $slots->student->name . ' ' . $slots->student->surname;
                }
            }
        }
        return view('reports.weekly_student_list_with_trainer', compact('trainerData'));
    }


    public function getTransferStudentTransferTrainerList()
    {
        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentList = StudentStaffAssign::where('is_active','0')->where('trainer_id',$trainers->id)->with(['student','trainer','slot'])->get();
            $transferStudent = StudentStaffAssign::where('is_active','1')->with(['student','trainer','slot'])->get();
        }elseif(Auth::user()->type == 3)
        {
            $studentList = StudentStaffAssign::where('is_active','0')->with(['student','trainer','slot'])->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
            $transferStudent = StudentStaffAssign::where('is_active','1')->with(['student','trainer','slot'])->whereHas('student', function($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();
        }
        else{
            $studentList = StudentStaffAssign::where('is_active','0')->with(['student','trainer','slot'])->get();
            $transferStudent = StudentStaffAssign::where('is_active','1')->with(['student','trainer','slot'])->get();
        }
        return view('reports.transfer_student_transfer_trainer_list',compact('studentList','transferStudent'));
    }

    public function getStudentData(){
        if(Auth::user()->type == 3)
        {
            $students = Student::where('status',1)->with('courses','trainer')->where('branch_id',Auth::user()->branch_id)->get();
            $slots= Slot::where('is_active',0)->with('slotList','trainer','rtc')->where('slots.branch_id',Auth::user()->branch_id)->get();
        }else{
            $students = Student::where('status',1)->with('courses','trainer')->get();
            $slots= Slot::where('is_active',0)->with('slotList','trainer','rtc')->get();
        }

        return view('reports.student_report',compact('students','slots'));
    }
}
