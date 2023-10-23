<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentAttendanceRequest;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStaffAssign;
use App\Models\Trainer;
use App\Models\TrainerAttendance;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\StudentAttendanceRequest;
use App\Rules\StudentAttendanceRule;
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
        $user = auth()->user();
        $trainerId = Trainer::where('user_id',Auth::user()->id)->pluck('id');
        if(Auth::user()->type == 0) {
            $studenAttendance = DB::table("students_attendance")
                ->select('students_attendance.attendance_date', DB::raw('count(IF(attendance_type = 1, 1, NULL)) as present'),
                    DB::raw('count(IF(attendance_type = 0, 1, NULL)) as absent'))
                ->groupBy('students_attendance.attendance_date')
                ->orderBy('students_attendance.attendance_date', 'DESC')->get();
        } else {
            $studenAttendance = DB::table("students_attendance")
                ->where('students_attendance.trainer_id',$trainerId)
                ->select('students_attendance.attendance_date', DB::raw('count(IF(attendance_type = 1, 1, NULL)) as present'),
                    DB::raw('count(IF(attendance_type = 0, 1, NULL)) as absent'))
                ->groupBy('students_attendance.attendance_date')
                ->orderBy('students_attendance.attendance_date', 'DESC')
                ->get();
        }

        return view('student_attendance.index', compact('user', 'studenAttendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $user = Auth::user();
        if(Auth::user()->type == 1){
            $trainer = Trainer::where('user_id',$user->id)->orderBy('id', 'DESC')->get();
            $studentStaffAssign = StudentStaffAssign::orderBy('id', 'DESC')->where('is_active','0')->with('trainer','student','slot')->get()->groupBy('trainer.name');
            $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereDate('starting_date', now()->format('Y-m-d'))
                ->whereDate('ending_date', now()->format('Y-m-d'))->with('trainer','student','slot')
                ->get()->groupBy('trainer.name');
        }
        else{
            $trainer = Trainer::orderBy('id', 'DESC')->get();
            $trainerAttendance = TrainerAttendance::whereDate('date', now()->format('Y-m-d'))->where('status','A')->get();
            $trainerIds = [];
            foreach($trainerAttendance as $atten){
                $trainerIds[] = $atten->trainer_id;
            }
            $studentStaffAssign = StudentStaffAssign::orderBy('id', 'DESC')->whereNotIn('trainer_id',$trainerIds)->where('is_active','0')->with('trainer','student','slot')->get()->groupBy('trainer.name');
            $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereDate('starting_date', now()->format('Y-m-d'))
                ->whereDate('ending_date', now()->format('Y-m-d'))->with('trainer','student','slot')
                ->get()->groupBy('trainer.name');
        }

        return view('student_attendance.create', compact('trainer', 'proxyStaff', 'studentStaffAssign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentAttendanceRequest $request)
    {   
        if(Auth::user()->type == 0){
            $request->validate([
                'attendance_date' => 'required|unique:students_attendance,attendance_date',
            ]);
        }

        $date = date('Y-m-d', strtotime($request->attendance_date));

        foreach($request->trainer_id as $key => $tarinerId){
            foreach($request->input("attendance_details_".$tarinerId) as $atten_key => $atten_value){
                foreach($atten_value['student_details'] as $key => $stu_detail){
                    if(Auth::user()->type == 1){
                        $studentAttendance = StudentAttendance::where('attendance_date',$date)->where('trainer_id',$tarinerId)->where('student_id',$stu_detail['student_id'])->first();
                        if($studentAttendance){
                            return back()->with('error', 'Date is already taken !!');
                        }
                    }
                    if(isset($stu_detail['attendance_type'])){
                        StudentAttendance::Create([
                            'student_id' => $stu_detail['student_id'],
                            'attendance_type' =>   $stu_detail['attendance_type'],
                            'user_id' => Auth::user()->id,
                            'attendance_date' =>  $date,
                            'absent_reason' => $stu_detail['absent_reason'],
                            'trainer_id' =>  $tarinerId,
                            'slot_id' =>  $atten_value['slot_id'],
                            'slot_type' =>  $atten_value['slot_type']
                        ]);
                    }
                }
            }
        }  
        return redirect()->route('student_attendance.index')->with('success', 'Student Attendence Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        if(Auth::user()->type == 1){
            $studentAttendance = StudentAttendance::select('students_attendance.*','trainers.name','slots.slot_time','students.name')
            ->where('attendance_date',$date)
            ->join('trainers', 'trainers.id', 'students_attendance.trainer_id')
            ->join('slots', 'slots.id', 'students_attendance.slot_id')
            ->join('students','students.id','students_attendance.student_id')
            ->where('trainers.user_id',Auth::user()->id)
            ->with('slot')->get()->groupby('trainer.name');
        }else{
            $studentAttendance = StudentAttendance::select('students_attendance.*','trainers.name','slots.slot_time','students.name')
            ->where('attendance_date',$date)
            ->join('trainers', 'trainers.id', 'students_attendance.trainer_id')
            ->join('slots', 'slots.id', 'students_attendance.slot_id')
            ->join('students','students.id','students_attendance.student_id')
            ->with('slot')->get()->groupby('trainer.name');
        }
       
        return view('student_attendance.show',compact('studentAttendance'));
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
        $user = Auth::user();

        if(Auth::user()->type == 1){
            $trainer = Trainer::where('user_id',$user->id)->orderBy('id', 'DESC')->get();
            $studentAttendance = StudentAttendance::where('attendance_date',$EditDate)->get();
            $studentStaffAssign = StudentStaffAssign::orderBy('id', 'DESC')->where('is_active','0')->with('trainer','student','slot')->get()->groupBy('trainer.name');
            $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereDate('starting_date', now()->format('Y-m-d'))
                ->whereDate('ending_date', now()->format('Y-m-d'))->with('trainer','student','slot')
                ->get()->groupBy('trainer.name');
        }
        else{
            $trainer = Trainer::orderBy('id', 'DESC')->get();    
            $studentAttendance = StudentAttendance::where('attendance_date',$EditDate)->get();
            $trainerAttendance = TrainerAttendance::whereDate('date', now()->format('Y-m-d'))->where('status','A')->get();
            $trainerId = [];
            foreach($trainerAttendance as $atten){
                $trainerId[] = $atten->trainer_id;
            }
            $studentStaffAssign = StudentStaffAssign::orderBy('id', 'DESC')->whereNotIn('trainer_id',$trainerId)->where('is_active','0')->with('trainer','student','slot')->get()->groupBy('trainer.name');
            $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereNotIn('trainer_id',$trainerId)->whereDate('starting_date', now()->format('Y-m-d'))
                ->whereDate('ending_date', now()->format('Y-m-d'))->with('trainer','student','slot')
                ->get()->groupBy('trainer.name');
        }
        return view('student_attendance.edit', compact('studentAttendance', 'EditDate','trainer', 'proxyStaff', 'studentStaffAssign'));
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
        $date = date('Y-m-d', strtotime($request->attendance_date));
        foreach($request->trainer_id as $key => $tarinerId){
            foreach($request->input("attendance_details_".$tarinerId) as $atten_key => $atten_value){
                foreach($atten_value['student_details'] as $key => $stu_detail){
                    if(isset($stu_detail['attendance_type'])){
                        if(!isset($stu_detail['student_attendance_id'])){
                            StudentAttendance::create([
                                'student_id' => $stu_detail['student_id'],
                                'attendance_type' =>   $stu_detail['attendance_type'],
                                'user_id' => Auth::user()->id,
                                'attendance_date' =>  $date,
                                'absent_reason' => isset($stu_detail['absent_reason']) ? $stu_detail['absent_reason'] : null,
                                'trainer_id' =>  $tarinerId,
                                'slot_id' =>  $atten_value['slot_id'],
                                'slot_type' =>  $atten_value['slot_type']
                            ]);
                        }else{
                            StudentAttendance::where('attendance_date',$date)->where('id',$stu_detail['student_attendance_id'])->update([
                                'student_id' => $stu_detail['student_id'],
                                'attendance_type' =>   $stu_detail['attendance_type'],
                                'user_id' => Auth::user()->id,
                                'attendance_date' =>  $date,
                                'absent_reason' => $stu_detail['absent_reason'],
                                'trainer_id' =>  $tarinerId,
                                'slot_id' =>  $atten_value['slot_id'],
                                'slot_type' =>  $atten_value['slot_type']
                            ]);
                        }   
                    }   
                }
            }
        }  
        return redirect()->route('student_attendance.index')->with('success', 'Student Attendence Updated successfully');
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
            ->delete();
        return redirect()->route('student_attendance.index')
            ->with('success', 'Student Attendance deleted successfully');
    }
}
