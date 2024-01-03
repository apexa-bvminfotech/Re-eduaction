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

            $stuListWithTrainer = StudentStaffAssign::whereIn('students.id', $studentTrainer)
            ->where('student_staff_assigns.is_active', 0)
            ->join('students', 'students.id', 'student_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->join('student_courses', 'student_courses.student_id', 'students.id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->with('trainer', 'student', 'slot', 'studentcourses', 'course')
            ->get()
            ->groupBy('trainer.name');

            $stuListWithTrainerProxy = StudentProxyStaffAssign::with('trainer', 'student', 'slot','studentcourses','course')
            ->join('students', 'students.id', 'student_proxy_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->join('student_courses', 'student_courses.student_id', 'students.id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->get()->groupBy('trainer.name');

            $trainerSchedule = TrainerShedule::with('trainer','student','slot')->where('user_id', '=', 0)->get()->groupBy('trainer.name');
            $userSchedule = TrainerShedule::with('user')->where('user_id', '!=', 0)->get()->groupBy('user.name');
        }
        else{
            $stuListWithTrainer = StudentStaffAssign::
              with('trainer', 'student', 'slot', 'branch','studentcourses','course')
            ->where('student_staff_assigns.is_active', 0)
            ->join('students', 'students.id', 'student_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->join('student_courses', 'student_courses.student_id', 'students.id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->get()
             ->groupBy('trainer.name');

             $stuListWithTrainerProxy = StudentProxyStaffAssign::with('trainer', 'student', 'slot','branch','studentcourses','course')
            ->join('students', 'students.id', 'student_proxy_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->join('student_courses', 'student_courses.student_id', 'students.id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->get()->groupBy('trainer.name');

            $trainerSchedule = TrainerShedule::with('trainer','student','slot')->where('user_id', '=', 0)
            ->get()->groupBy('trainer.name');

            $userSchedule = TrainerShedule::with('user')->where('user_id', '!=', 0)->get()->groupBy('user.name');
        }
        $trainerData = [];
        $trainerDataProxy = [];
        $userListWithTrinerData = [];
        $userScheduleList = [];

        foreach ($stuListWithTrainer as $trainerName => $trainerSlot) {
            $trainerData[$trainerName] = [];

            foreach ($trainerSlot as $slots) {

                $slotID = $slots->slot->id ?? '';
                if (!isset($trainerData[$trainerName][$slotID])) {
                    $trainerData[$trainerName][$slotID] = [
                        'slot_time' => $slots->slot->slot_time ?? '',
                        'students' => [],
                        'branches' => [],
                        'courses' => [],
                        'standard' => [],
                        'student_courses'=> [],
                        'mobileno'=> [],
                        'student_id' => $slots->student_id ?? '',
                      ];
                }
                $trainerData[$trainerName][$slotID]['students'][] = $slots->student->name . ' ' . $slots->student->surname ?? '';
                $trainerData[$trainerName][$slotID]['branches'][] = $slots->branch->name ?? '';
                $trainerData[$trainerName][$slotID]['courses'][] = $slots->course->course_name ?? '';
                $trainerData[$trainerName][$slotID]['student_courses'][] = $slots->studentcourses->first()['start_date'] ?? '' ;
                $trainerData[$trainerName][$slotID]['standard'][] = $slots->student->standard ?? '';
                $trainerData[$trainerName][$slotID]['mobileno'][] = $slots->student->father_contact_no ?? '' ;



            }
        }

        foreach ($stuListWithTrainerProxy as $trainerName => $trainerSlotProxy) {

            $trainerDataProxy[$trainerName] = [];

            foreach ($trainerSlotProxy as $slotsProxy) {
                $slotID = $slotsProxy->slot->id ?? '';

                if (!isset($trainerDataProxy[$trainerName][$slotID])) {
                    $trainerDataProxy[$trainerName][$slotID] = [
                        'slot_time' => $slotsProxy->slot->slot_time ?? '',
                        'startDate'=> $slotsProxy->starting_date ?? '',
                        'endDate'=> $slotsProxy->ending_date ?? '',
                        'rtc' => $slotsProxy->branch->name ?? '',
                        'branches' => [],
                        'courses' => [],
                        'standard' => [],
                        'student_courses'=> [],
                        'mobileno'=> [],
                        'students' => [],
                        'student_id' => [],
                    ];
                }

                $trainerDataProxy[$trainerName][$slotID]['students'][] = $slotsProxy->student->name . ' ' . $slotsProxy->student->surname ?? '';
                $trainerDataProxy[$trainerName][$slotID]['branches'][] = $slotsProxy->branch->name ?? '';
                $trainerDataProxy[$trainerName][$slotID]['courses'][] = $slotsProxy->course->course_name ?? '';
                $trainerDataProxy[$trainerName][$slotID]['student_courses'][] = $slotsProxy->studentcourses->first()['start_date'] ?? '';
                $trainerDataProxy[$trainerName][$slotID]['standard'][] = $slotsProxy->student->standard ?? '';
                $trainerDataProxy[$trainerName][$slotID]['mobileno'][] = $slotsProxy->student->father_contact_no ?? '';
                $trainerDataProxy[$trainerName][$slotID]['student_id'][] = $slotsProxy->student_id ?? '';

            }
        }

        foreach ($userSchedule as $userName => $user) {
            foreach($user as $u){
                    $userScheduleList[$userName][] = [
                        'startDate' => $u->date ?? '',
                        'note' => $u->note ?? '',
                        'userName' => $userName ?? '',
                        'day' => $u->day ?? '',
                        'id' => $u->id ?? '',
                    ];
            }
        }

        foreach ($trainerSchedule as $trainerName => $UsertrainerSlot) {
            foreach($UsertrainerSlot as $Usertrainer){

                    $userListWithTrinerData[$trainerName][] = [
                        'date' => $Usertrainer->date ?? '',
                        'note' => $Usertrainer->note ?? '',
                        'day' => $Usertrainer->day ?? '',
                        'userName' => $trainerName ?? '',
                        'slot_time'=>$Usertrainer->slot->slot_time ?? '',
                        'id'=> $Usertrainer->id ?? '',
                    ];

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
            'day' => $request->day,
            'note' => $request->note ? $request->note : '',
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



    public function slotupdate(Request $request, $slotId)
    {

        $slot = TrainerShedule::findOrFail($slotId);

        $slot->note = $request->input('note');
        $slot->trainer_id = $request->input('trainer_id');
        $slot->slot_id = $request->input('slot_id');
        $slot->day = $request->input('day');
        // dd($slot);

        $slot->save();

        return redirect()->back()->with('success', 'Slot updated successfully');
    }


}




