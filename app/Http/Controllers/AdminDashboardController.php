<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Student;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(){
        $students = Student::whereMonth('registration_date', Carbon::now()->month)->where('branch_id',Auth::user()->branch_id)->get();
        $studentStatus = StudentStatus::where('is_active','0')->get();
        $absentTrainer = Branch::with('trainer.trainerAttendance')->get();
        $absentStudent = Branch::with('student.studentAttendance')->get();
        $proxyTrainer = Branch::with('trainer.trainerProxySlot.slot')->get();
        $trainerProxySlot = StudentProxyStaffAssign::whereDate('starting_date', now()->format('Y-m-d'))->whereDate('ending_date', now()->format('Y-m-d'))->get();
        return view('dashboard.admin_dashboard',compact('students','studentStatus','absentTrainer','absentStudent','proxyTrainer','trainerProxySlot'));
    }
}
