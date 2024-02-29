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
            $stuListWithTrainer = StudentStaffAssign::with('trainer', 'student', 'slot', 'branch', 'studentcourses', 'course')
            ->where('student_staff_assigns.is_active', 0)
            ->join('students', 'students.id', 'student_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->join('student_courses', 'student_courses.student_id', 'students.id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->selectRaw('*, (CASE
                            WHEN start_date IS NULL THEN "Pending"
                            WHEN start_date IS NOT NULL AND end_date IS NULL THEN "Running"
                            ELSE "Complete"
                        END) AS course_status')
            ->get()
            ->groupBy('trainer.name');

             $stuListWithTrainerProxy = StudentProxyStaffAssign::with('trainer', 'student', 'slot','branch','studentcourses','course')
            ->join('students', 'students.id', 'student_proxy_staff_assigns.student_id')
            ->join('branches', 'branches.id', 'students.branch_id')
            ->join('student_courses', 'student_courses.student_id', 'students.id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->selectRaw('*, (CASE
                            WHEN start_date IS NULL THEN "Pending"
                            WHEN start_date IS NOT NULL AND end_date IS NULL THEN "Running"
                            ELSE "Complete"
                        END) AS course_status')
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
            //  dd($trainerSlot);
            foreach ($trainerSlot as $slots) {
                $slotID = $slots->slot->id ?? '';

                if (!isset($trainerData[$trainerName][$slotID])) {
                    $trainerData[$trainerName][$slotID] = [
                        'slot_time' => $slots->slot->slot_time ?? '',
                        'students' => [],
                        'student_id' => $slots->student_id ?? '',
                        'id' => $slots->id ?? '',
                        'medium' => $slots->medium ?? '',
                        'whatsapp_group_name' => $slots->slot->whatsapp_group_name ?? '',

                    ];
                }

                $trainerData[$trainerName][$slotID]['students'][] = [
                    'name' => $slots->student->name,
                    'surname' => $slots->student->surname ?? '',
                    'branches' => $slots->branch->name ?? 'Null',
                    'courses' => $slots->course->course_name ?? 'Null',
                    'student_courses' => $slots->studentcourses->first()['start_date'] ?? 'Null',
                    'standard' => $slots->student->standard ?? 'Null',
                    'father_phone_no' => $slots->student->father_contact_no ?? 'Null',
                    'mother_phone_no' => $slots->student->mother_contact_no ?? 'Null',
                    'trainer_name' => $slots->trainer->name ?? 'Null',
                    'medium' => $slots->medium ?? '',
                    'running_course' => $slots->course_status === 'Running' ? $slots->course_name : '',
                    'complete_course' => $slots->course_status === 'Complete' ? $slots->course_name : '',
                    'pending_course' => $slots->course_status === 'Pending' ? $slots->course_name : '',
                ];

            }

        }

        foreach ($stuListWithTrainerProxy as $trainerName => $trainerSlotProxy) {
            $trainerDataProxy[$trainerName] = [];

            foreach ($trainerSlotProxy as $slotsProxy) {
                $slotID = $slotsProxy->slot->id ?? '';
                // dd($trainerSlotProxy);
                if (!isset($trainerDataProxy[$trainerName][$slotID])) {
                    $trainerDataProxy[$trainerName][$slotID] = [
                        'slot_time' => $slotsProxy->slot->slot_time ?? '',
                        'startDate' => $slotsProxy->starting_date ?? '',
                        'endDate' => $slotsProxy->ending_date ?? '',
                        'rtc' => $slotsProxy->branch->name ?? '',
                        'students' => [],
                        'student_id' => [],
                        'whatsapp_group_name' => $slotsProxy->slot->whatsapp_group_name ?? '',

                    ];
                }

                $trainerDataProxy[$trainerName][$slotID]['students'][] = [
                    'name' => $slotsProxy->student->name,
                    'surname' => $slotsProxy->student->surname,
                    'branches' => $slotsProxy->branch->name ?? 'Null',
                    'courses' => $slotsProxy->course->course_name ?? 'Null',
                    'student_courses' => $slotsProxy->studentcourses->first()['start_date'] ?? 'Null',
                    'standard' => $slotsProxy->student->standard ?? 'Null',
                    'mobileno' => $slotsProxy->student->father_contact_no ?? 'Null',
                    'startDate' => $slotsProxy->starting_date ?? '',
                    'endDate' => $slotsProxy->ending_date ?? '',
                    'father_phone_no' => $slotsProxy->student->father_contact_no ?? 'Null',
                    'mother_phone_no' => $slotsProxy->student->mother_contact_no ?? 'Null',
                    'trainer_name' => $slotsProxy->trainer->name ?? 'Null',
                    'medium' => $slotsProxy->medium ?? '',
                    'running_course' => $slotsProxy->course_status === 'Running' ? $slotsProxy->course_name : '',
                    'complete_course' => $slotsProxy->course_status === 'Complete' ? $slotsProxy->course_name : '',
                    'pending_course' => $slotsProxy->course_status === 'Pending' ? $slotsProxy->course_name : '',
                ];

                $trainerDataProxy[$trainerName][$slotID]['student_id'][] = $slotsProxy->student_id ?? 'Null';
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
                        // 'slot_time'=>$Usertrainer->slot->slot_time ?? '',
                        'id'=> $Usertrainer->id ?? '',
                        'slot_time' => $Usertrainer->slot_time ?? '',
                    ];

            }

        }

        return view('dashboard.trainer_weekly_schedule', compact('userScheduleList','userListWithTrinerData','trainerData','trainerDataProxy','trainershedule','slotstime','users'));
    }


    public function trinerweeklyadd(Request $request)
    {
        $time = $request->input('slot_time_to') . " - " . $request->input('slot_time_from');

        TrainerShedule::create([
             'user_id' => $request->user_id,
            'trainer_id' => $request->trainer_id,
            'slot_id' => $request->slot_id,
            'date' => $request->date,
            'day' => $request->day,
            'note' => $request->note ? $request->note : '',
            'slot_time' => $time ?? '',
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
        $time = $request->input('slot_time_to') . " - " . $request->input('slot_time_from');
        $slot = TrainerShedule::findOrFail($slotId);

        $slot->note = $request->input('note');
        $slot->trainer_id = $request->input('trainer_id');
        $slot->slot_id = $request->input('slot_id');
        $slot->day = $request->input('day');
        $slot->slot_time = $time;
        // dd($slot);

        $slot->save();

        return redirect()->back()->with('success', 'Slot updated successfully');
    }

    public function delete(Request $request, $slotId)
    {

        $slot = TrainerShedule::findOrFail($slotId);
        $slot->delete();

        return redirect()->back()->with('success', 'Slot Delete successfully');
    }


}




