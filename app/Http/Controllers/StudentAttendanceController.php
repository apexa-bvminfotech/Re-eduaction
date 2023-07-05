<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentAttendanceRequest;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\TrainerAttendance;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\StudentAttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:student-attendance-list|student-attendance-create|student-attendance-edit|student-attendance-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:student-attendance-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:student-attendance-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:student-attendance-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studenAttendance = DB::table("students_attendance")
            ->select('students_attendance.attendance_date', DB::raw('count(IF(attendance_type = 0, 1, NULL)) as present'),
                DB::raw('count(IF(attendance_type = 1, 1, NULL)) as absent'))
            ->where('students_attendance.user_id', auth()->id())
            ->groupBy('students_attendance.attendance_date')
            ->orderBy('students_attendance.id', 'DESC')->get();
        $user = auth()->user();
        return view('student_attendance.index', compact('user', 'studenAttendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::orderBy('id')->get();
        return view('student_attendance.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentAttendanceRequest $request)
    {
        foreach ($request->data as $key => $r) {
            $data = [
                'student_id' => $r['student_id'],
                'attendance_type' => $r['attendance_type'],
                'absent_reason' => $r['absent_reason'],
                'attendance_date' => date('Y-m-d', strtotime($request->attendance_date)),
                'user_id' => auth()->user()->id,
            ];
            StudentAttendance::updateOrCreate(['student_id' => $r['student_id'], 'attendance_date' => date('Y-m-d', strtotime($request->attendance_date)), 'user_id' => auth()->user()->id,], $data);
        }

        return redirect()->route('student_attendance.index')->with('success', 'Student Attendence Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($date)
    {
        $EditDate = $date;
        $studentAttendance = StudentAttendance::select('students_attendance.*', 'students.id as studentID', 'students.name')
            ->where('attendance_date', $date)
            ->where('students_attendance.user_id', auth()->id())
            ->join('students', 'students.id', 'students_attendance.student_id')
            ->orderBy('students_attendance.id')->get();

        $students = Student::orderBy('id')->get();

        return view('student_attendance.edit', compact('studentAttendance', 'students', 'EditDate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentAttendanceRequest $request, $date)
    {
        foreach ($request->data as $key => $r) {
            $data = [
                'student_id' => $r['student_id'],
                'attendance_type' => $r['attendance_type'],
                'absent_reason' => $r['absent_reason'],
                'user_id' => auth()->user()->id,
            ];
            StudentAttendance::where('student_id', $r['student_id'])
                ->where('attendance_date', $date)
                ->where('user_id', auth()->id())
                ->update($data);
        }

        return redirect()->route('student_attendance.index')->with('success', 'Student Attendence Created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($date)
    {
        StudentAttendance::where('attendance_date', $date)
//            ->where('user_id', auth()->id())
            ->delete();
        return redirect()->route('student_attendance.index')
            ->with('success', 'Student Attendance deleted successfully');
    }
}
