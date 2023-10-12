<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\StudentDMIT;
use App\Models\StudentStatus;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getTrainerWiseStudentRtcRegularSlot(){
        $trainerWiseData = Branch::with(['trainer.slots.rtc','trainer.slots.slotList.student'])->get();
        return view('reports.trainer_wise_student_rtc_regular_slot',compact('trainerWiseData'));
    }  
    
    public function getTrainerWiseStudentRtcProxySlot(){
        $trainerWiseData = Branch::with(['trainer.slots.rtc','trainer.slots.proxySlotlist.student'])->get();
        return view('reports.trainer_wise_student_rtc_proxy_slot',compact('trainerWiseData'));
    }

    public function getCourseWiseStudentList(){
        $courseWiseStudentData = Course::with('studentCourse.student')->get();
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
        
        $qurey = Student::from('students');

        if($data['startDate'] != '' && $data['startDate'] != null){
            $qurey->whereDate('registration_date', '>=', date('Y-m-d', strtotime($data['startDate'])));
        }

        if($data['endDate'] != '' && $data['endDate'] != null){
            $qurey->whereDate('registration_date', '<=',  date('Y-m-d', strtotime($data['endDate'])));
        }
        $data['studentList'] = $qurey->get();
        $data['studentList'] = $qurey->with('statusStudent','studentTrainer.trainer')->get();
        // dd($data['studentList']);

        return view('reports.student_list', $data);
    }

    public function getPendingAppreciationStudentList()
    {
        $pendingApprecitionStu = StudentCourse::with('student','course','appreciation')->where('end_date','!=',null)->where('appreciation_given_date',null)->get();
        return view('reports.pending_appreciation_student_list',compact('pendingApprecitionStu'));
    }

    public function getPendingCourseStudentList()
    {
        $pendingCourseStu = StudentCourse::with('student','course')->where('start_date',null)->get();
        return view('reports.pending_course_student_list',compact('pendingCourseStu'));
    }

    public function getStudentListWithCourseDetail()
    {
        $studentCourse = StudentCourse::with('student','course')->get();
        return view('reports.student_list_with_course_detail',compact('studentCourse'));
    }

    public function getPendingCounselllingStudentList()
    {
        $studentDmit = StudentDMIT::where('counselling_by','0')->with('student')->get();
        return view('reports.pending_counselling_student_list',compact('studentDmit'));
    }
    
    public function getPendingMaterialListStudentList()
    {
        $students = Student::with('studentMaterial', 'courses.course')->get();    
        $studentList = [];
        foreach ($students as $student) {
            if ($student->studentMaterial->isEmpty()) {
                $studentList[] = $student;
            }
        }

        return view('reports.pending_material_list_student_list', compact('studentList'));
    }

    public function getStudentStatusList()
    {
        $studentStatus = StudentStatus::whereIn('status',['Hold','Cancel'])->where('is_active','0')->with('student.activeCourses.course')->get();
        return view('reports.student_status_list',compact('studentStatus'));
    }
}
