<?php

namespace App\Http\Controllers;

use App\Models\StudentAttendance;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStaffAssign;
use App\Models\Trainer;
use App\Models\Slot;
use App\Models\User;
use App\Models\TrainerShedule;
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
        $trainershedule = Trainer::where('is_active', 0)->orderBy('id', 'desc')->get();

        $slotstime = Slot::where('is_active', 0)->orderBy('id', 'desc')->get();
        $users = User::where('is_active', 0)->where('type', 0)->orderBy('id', 'desc')->get();

        if(Auth::user()->type == 1){
            $user = Auth::user();
            $trainershedule = Trainer::where('is_active', 0)->orderBy('id', 'desc')->get();
            $trainers = Trainer::where('user_id',$user->id)->where('is_active',0)->first();
            $studentTrainer = StudentStaffAssign::where('trainer_id',$trainers->id)->where('is_active','0')->pluck('student_id');

            $stuListWithTrainer = StudentStaffAssign::whereIn('student_id',$studentTrainer)->where('is_active','0')->with('trainer', 'student', 'slot')->get()->groupBy('trainer.name');
            $stuListWithTrainerProxy = StudentProxyStaffAssign::with('trainer', 'student', 'slot')->get()->groupBy('trainer.name');

            $trainerSchedule = TrainerShedule::with('trainer','student','slot')->where('user_id', '=', 0)->get()->groupBy('trainer.name');
            $userSchedule = TrainerShedule::with('user')->where('user_id', '!=', 0)->get()->groupBy('user.name');
        }
        else{
            $stuListWithTrainer = StudentStaffAssign::where('is_active','0')->with('trainer', 'student', 'slot')->get()->groupBy('trainer.name');

            $stuListWithTrainerProxy = StudentProxyStaffAssign::with('trainer', 'student', 'slot')->get()->groupBy('trainer.name');

            $trainerSchedule = TrainerShedule::with('trainer','student','slot')->where('user_id', '=', 0)->get()->groupBy('trainer.name');
            $userSchedule = TrainerShedule::with('user')->where('user_id', '!=', 0)->get()->groupBy('user.name');
        }
        $trainerData = [];
        $trainerDataProxy = [];
        $userListWithTrinerData = [];
        $userScheduleList = [];

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

        foreach ($stuListWithTrainerProxy as $trainerName => $trainerSlotProxy) {

            $trainerDataProxy[$trainerName] = [];

            foreach ($trainerSlotProxy as $slotsProxy) {
                $slotID = $slotsProxy->slot->id;

                if (!isset($trainerDataProxy[$trainerName][$slotID])) {
                    $trainerDataProxy[$trainerName][$slotID] = [
                        'slot_time' => $slotsProxy->slot->slot_time,
                        'startDate'=> $slotsProxy->starting_date,
                        'endDate'=> $slotsProxy->ending_date,
                        'students' => [],
                    ];
                }

                $trainerDataProxy[$trainerName][$slotID]['students'][] = $slotsProxy->student->name . ' ' . $slotsProxy->student->surname;
            }
        }

        foreach ($userSchedule as $userName => $user) {
            foreach($user as $u){

                    $userScheduleList[$userName][] = [
                        'startDate' => $u->date,
                        'note' => $u->note,
                        'userName' => $userName
                    ];
            }
        }

        foreach ($trainerSchedule as $trainerName => $UsertrainerSlot) {
            $userListWithTrinerData[$trainerName] = [];
            foreach ($UsertrainerSlot as $slotsUsertriner) {
                if ($slotsUsertriner->user) {
                    $UserID = $slotsUsertriner->user->id;
                    $userName = $slotsUsertriner->user->name;
                }
                if (!isset($userListWithTrinerData[$trainerName][$slotID] )) {
                    $userListWithTrinerData[$trainerName][$slotID] = [
                        //'slot_time' => $slotsUsertriner->slot->slot_time,
                        'user_id' =>$slotsUsertriner->user_id,
                        'user_name'=> $userName,
                        'date'=> $slotsUsertriner->date,
                        'note'=>$slotsUsertriner->note,
                        'students' => [],
                    ];
                }
            }
        }


        return view('dashboard.trainer_weekly_schedule', compact('userScheduleList','userListWithTrinerData','trainerData','trainerDataProxy','trainershedule','slotstime','users'));
    }


    public function trinerweeklyadd(Request $request)
    {

        TrainerShedule::create([
             'user_id' => $request->user_id,
            'trainer_id' => $request->trainer_id,
            'slot_id' => $request->slot_id,
            'date' => $request->date,
            'note' => $request->note,
        ]);


        return redirect()->back()->with('success', 'Trainer Added succesfully !!');
    }

    public function TrinerSlot($id)
    {
        $proxy_slots = Slot::where(['trainer_id' => $id, 'is_active' => 0])
            ->with('rtc')
            ->get();
        return response()->json(['slots' => $proxy_slots]);
    }
}




