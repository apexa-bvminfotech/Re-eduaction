<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Student;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStaffAssign;
use App\Models\StudentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(){
        $students = Student::whereMonth('registration_date', Carbon::now()->month)->where('branch_id',Auth::user()->branch_id)->get();
        $curMonStu = Student::whereMonth('registration_date', Carbon::now()->month)->get();
        $curMonStuStatus = StudentStatus::where('is_active','0')->with('student')->get();
        $studentStatus = StudentStatus::select('student_status.id','student_status.status','students.branch_id','students.registration_date')
            ->join('students', 'students.id', 'student_status.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->whereMonth('students.registration_date', '=', Carbon::now()->month)
            ->where('student_status.is_active','0')
            ->where('students.branch_id',Auth::user()->branch_id)
            ->get();

        $absentTrainer = Branch::with('trainer.trainerAttendance')->get();
        $absentStudent = Branch::with('student.studentAttendance')->get();
        $proxyTrainer = Branch::with('trainer.trainerProxySlot.slot')
        ->get();

        $trainerSlot = StudentStaffAssign::with('student','trainer')->get();
        $trainerProxySlot = StudentProxyStaffAssign::whereDate('starting_date', now()->format('Y-m-d'))
        ->with('student','trainer','regular')->get();

        // $trainerProxySlot = StudentProxyStaffAssign::select('student_proxy_staff_assigns.*','trainers.branch_id')
        //     ->join('trainers', 'trainers.id', 'student_proxy_staff_assigns.trainer_id')
        //     ->join('branches', 'branches.id', 'trainers.branch_id')
        //     ->whereDate('student_proxy_staff_assigns.starting_date', now()->format('Y-m-d'))->whereDate('student_proxy_staff_assigns.ending_date', now()->format('Y-m-d'))
        //     ->where('trainers.branch_id',Auth::user()->branch_id)->get();

        return view('dashboard.admin_dashboard',compact('trainerSlot','students','studentStatus','absentTrainer','absentStudent','proxyTrainer','trainerProxySlot','curMonStu','curMonStuStatus'));
    }
}
