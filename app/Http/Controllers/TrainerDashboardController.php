<?php

namespace App\Http\Controllers;

use App\Models\StudentAttendance;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStaffAssign;
use App\Models\Trainer;
use App\Models\TrainerAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->with('branch')->first();
        $trainerStudent = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->with('student.courses.course','slot','trainer')->get();
        $tarinerRegularLecture = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->with('slot')->get();
        $tarinerProxyLecture = StudentProxyStaffAssign::where('trainer_id',$trainers->id)->whereDate('starting_date', now()->format('Y-m-d'))->whereDate('ending_date', now()->format('Y-m-d'))->with('slot')->get();
        $totalStudent = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->get();
        $tStudent = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
        $absentPresentStudent = StudentAttendance::where('trainer_id',$trainers->id)->whereIn('student_id',$tStudent)->whereDate('attendance_date', now()->format('Y-m-d'))->where('slot_type','Regular')->get();
        $fromDate = '';
        $toDate = '';

        if(isset($_GET['fromDate'])){
            $fromDate = $_GET['fromDate'];
        }
        if(isset($_GET['toDate'])){
            $toDate = $_GET['toDate'];
        }
       
        $qurey = TrainerAttendance::from('trainer_attendances')->where('trainer_id',$trainers->id);

        if($fromDate != '' && $fromDate != null){
            $qurey->whereDate('date', '>=', date('Y-m-d', strtotime($fromDate)));
        }

        if($toDate != '' && $toDate != null){
            $qurey->whereDate('date', '<=',  date('Y-m-d', strtotime($toDate)));
        }

        $trainerAttendance = $qurey->with('slots')->get();
        return view('dashboard.trainer_dashboard',compact('trainers','trainerAttendance','fromDate','toDate','trainerStudent','tarinerRegularLecture','tarinerProxyLecture','totalStudent','absentPresentStudent'));
    }

    public function traineWeeklySchedule(){
        $user = Auth::user();
        $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
        $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');
        $stuListWithTrainer = StudentStaffAssign::whereIn('student_id',$studentTrainer)->where('is_active','0')->with('trainer', 'student', 'slot')->get()->groupBy('trainer.name');
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
                $trainerData[$trainerName][$slotID]['students'][] = $slots->student->name . ' ' . $slots->student->surname;
            }
        }
        return view('dashboard.trainer_weekly_schedule', compact('trainerData'));
    }
}
