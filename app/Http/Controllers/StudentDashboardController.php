<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $students = Student::where('user_id',$user->id)->get();
        return view('dashboard.student_dashboard',compact('students'));
    }
}
