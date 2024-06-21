<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Rtc;
use App\Models\Slot;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStaffAssign;
use App\Models\StudentStatus;
use App\Models\Trainer;
use App\Models\TrainerAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:slot-list|slot-create|slot-edit', ['only' => ['index', 'store']]);
        $this->middleware('permission:slot-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:slot-edit', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == 1 || Auth::user()->type == 3){
            $slot = Slot::where('branch_id', Auth::user()->branch_id)->where('is_active','0')->orderBy('id', 'DESC')->get();
        }else{
            $slot = Slot::orderBy('id', 'DESC')->get();
        }
        $slotStudent = Slot::join('student_staff_assigns', function($join) {
            $join->on('student_staff_assigns.slot_id', 'slots.id')
                ->whereIn('student_staff_assigns.id', function($query) {
                    $query->selectRaw('MAX(id)')
                          ->from('student_staff_assigns')
                          ->groupBy('student_id');
                });
            })
            ->join('students', 'students.id', 'student_staff_assigns.student_id')
            ->join('student_courses', 'student_courses.student_id', 'students.id')
            ->join('courses', 'courses.id', 'student_courses.course_id')
            ->selectRaw('*, (CASE
                WHEN start_date IS NULL THEN "Pending"
                WHEN start_date IS NOT NULL AND end_date IS NULL THEN "Running"
                ELSE "Complete"
                END) AS status_course')
            ->orderBy('slots.created_at', 'DESC')
            ->get();


        $currentDate = now()->toDateString();
        $slotProxyStudent = Slot::join('student_proxy_staff_assigns', function($join) {
            $join->on('student_proxy_staff_assigns.slot_id', 'slots.id')
                ->whereIn('student_proxy_staff_assigns.id', function($query) {
                    $query->selectRaw('MAX(id)')
                          ->from('student_proxy_staff_assigns')
                          ->groupBy('student_id');
                });
        })
        ->join('students', 'students.id', 'student_proxy_staff_assigns.student_id')
        ->join('student_courses', 'student_courses.student_id', 'students.id')
        ->join('courses', 'courses.id', 'student_courses.course_id')
        ->selectRaw('*, (CASE
            WHEN start_date IS NULL THEN "Pending"
            WHEN start_date IS NOT NULL AND end_date IS NULL THEN "Running"
            ELSE "Complete"
            END) AS status_course')
         ->whereDate('student_proxy_staff_assigns.starting_date','>=' ,$currentDate)
        ->orderBy('slots.id', 'DESC')
        ->get();

        $studentStaffAssign = StudentStaffAssign::where('is_active','0')->get();
        $trainerId = [];

        $trainers = Trainer::where('is_active', 0)->orderBy('id', 'desc')->get();
        $proxyStaff = StudentProxyStaffAssign::whereDate('starting_date', now()->format('Y-m-d'))->whereDate('ending_date', now()->format('Y-m-d'))->get();
        return view('slot.index', compact('slot','slotStudent','trainers','studentStaffAssign','proxyStaff','slotProxyStudent'))->with('i');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::orderBy('id', 'DESC')->get();
        if(Auth::user()->type == 1) {
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('slot.create', compact( 'branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'trainer_id' => 'required',
            'rtc_id' => 'required',
            'branch_id' => 'required',
            'whatsapp_group_name' => 'required',
            'slot_time_to' => 'required',
            'slot_time_from' => 'required',
        ]);
        $time = $request->slot_time_to . " - " . $request->slot_time_from;
        $existingTrainerSlot = Slot::where('slot_time', $time)
            ->where('trainer_id', $request->trainer_id)
            ->first();

        if ($existingTrainerSlot) {
            if ($existingTrainerSlot->trainer_id == $request->trainer_id) {
                return back()->with('error', 'Trainer slot already create please select other time');
            }
        }

        $time = $request->input('slot_time_to') . " - " . $request->input('slot_time_from');
        $data = [
            'trainer_id' => $request->input('trainer_id'),
            'rtc_id' => $request->input('rtc_id'),
            'branch_id' => $request->input('branch_id'),
            'whatsapp_group_name' => $request->whatsapp_group_name,
            'slot_time' => $time,
            'is_active' => $request->input('is_active'),
        ];
        Slot::create($data);
        return redirect()->route('slot.index')
            ->with('success', 'Slot created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slot $slot)
    {
        $branch = Branch::orderBy('id', 'DESC')->get();
        if(Auth::user()->type == 1){
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        $trainer = Trainer::where('branch_id', $slot->branch_id)->where('is_active',0)->orderBy('id', 'DESC')->get();
        $rtc = Rtc::where('branch_id', $slot->branch_id)->where('is_active',0)->orderBy('id', 'DESC')->get();
        return view('slot.edit', compact('slot', 'trainer', 'rtc', 'branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slot $slot)
    {
        $this->validate($request, [
            'trainer_id' => 'required',
            'rtc_id' => 'required',
            'branch_id' => 'required',
            'whatsapp_group_name' => 'required',
            'slot_time_to' => 'required',
            'slot_time_from' => 'required',
        ]);
        $time = $request->input('slot_time_to') . " - " . $request->input('slot_time_from');
        $data = [
            'trainer_id' => $request->input('trainer_id'),
            'rtc_id' => $request->input('rtc_id'),
            'branch_id' => $request->input('branch_id'),
            'whatsapp_group_name' => $request->whatsapp_group_name,
            'slot_time' => $time,
            'is_active' => $request->input('is_active')
        ];

        $slot->update($data);

        return redirect()->route('slot.index')
            ->with('success', 'Slot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slot::where('id', $id)->delete();
        return redirect()->route('slot.index')
            ->with('success', 'Slot deleted successfully');
    }

    public function changeSlotStatus(Request $request)
    {
        $slot = Slot::find($request->slot_id);
        $slot->is_active = $request->status;
        $slot->save();
        return response()->json(['success' => $request->status ? 'Slot de-active' : 'Slot active']);
    }

    public function gettrainerdata(Request $request)
    {
        $trainer = Trainer::where('branch_id', $request->branch_id)
                    ->where('is_active',0)->orderBy('id', 'DESC')->get();
        $rtc = Rtc::where('branch_id', $request->branch_id)
                    ->where('is_active',0)->orderBy('id', 'DESC')->get();
        return response()->json(['trainer' => $trainer, 'rtc' => $rtc]);
    }

    public function assignProxySlot(Request $request)
    {
        $existingSlot = Slot::where('trainer_id',$request->trainer_id)->where('slot_time',$request->slot_time)->first();
        if($existingSlot)
        {
            return response()->json(['success'=> 'true']);
        }
        else{
            $slot = Slot::create([
                'slot_time' => $request->slot_time,
                'trainer_id' => $request->trainer_id,
                'rtc_id' => $request->rtc_id,
                'branch_id' => $request->branch_id,
                'whatsapp_group_name' => $request->whatsapp_group_name,
            ]);
            return response()->json(['success'=> 'true', 'data' => $slot]);
        }
    }

    public function slot($id, $oldSlotId)
    {
        $slots = Slot::where('trainer_id', $id)->where('id','!=',$oldSlotId)
            ->where('is_active', 0)
            ->with('rtc')
            ->get();
        return response()->json(['slots' => $slots]);
    }

    public function shiftRegularSlot(Request $request)
    {

        $getStudents = StudentStaffAssign::where('trainer_id',$request->old_regular_trainer_id)->where('slot_id',$request->old_regular_slot_id)->where('is_active','0')->get()->toArray();

        $updateStatus = StudentStaffAssign::where('trainer_id',$request->old_regular_trainer_id)->where('slot_id',$request->old_regular_slot_id)->update([
            'is_active' => '1',
        ]);
        foreach($getStudents as $student){
            StudentStaffAssign::create([
                'student_id' => $student['student_id'],
                'trainer_id' => $request->trainer_id,
                'slot_id' => $request->slot_id,
                'is_active' => '0',
                'date' =>  Carbon::now()->toDateString(),
            ]);
        }
        return redirect()->back()->with('success', 'Trainer shifted succesfully !!');
    }

    public function proxySlot($id)
    {
        $proxy_slots = Slot::where(['trainer_id' => $id, 'is_active' => 0])
            ->with('rtc')
            ->get();
        return response()->json(['slots' => $proxy_slots]);
    }

    public function submitProxySlot(Request $request)
    {
        $existingProxySlot = StudentProxyStaffAssign::where('slot_id',$request->slot_id)->where('trainer_id',$request->trainer_id)
            ->whereDate('starting_date', '>=',$request->starting_date)->where('student_id',$request->student_id)
            ->whereDate('ending_date', '<=', $request->ending_date)->get();

        if ($existingProxySlot->isNotEmpty()) {
            return back()->with('error', 'Trainer is already assigned as proxy staff for the specified dates');
        }

        $regularSlotShift = StudentStaffAssign::where('slot_id',$request->old_proxy_slot_id)->where('trainer_id',$request->old_proxy_trainer_id)->where('is_active','0')->with('trainer')->get();

        $proxySlotShift = StudentProxyStaffAssign::where('slot_id',$request->old_proxy_slot_id)->where('trainer_id',$request->old_proxy_trainer_id)->get();
        // dd($proxySlotShift);
        if($regularSlotShift->isNotempty()){
            foreach($regularSlotShift as $regularTrainer){
                StudentProxyStaffAssign::create([
                    'student_id' => $regularTrainer->student_id,
                    'trainer_id' => $request->trainer_id,
                    'slot_id' => $request->slot_id,
                    'starting_date' => $request->starting_date,
                    'ending_date' => $request->ending_date,
                    'old_regular_trainer_id' => $regularTrainer->trainer->name ?? '',
                ]);
            }
        }
        else{
            foreach($proxySlotShift as $proxyTrainer){
                StudentProxyStaffAssign::create([
                    'student_id' => $proxyTrainer->student_id,
                    'trainer_id' => $request->trainer_id,
                    'slot_id' => $request->slot_id,
                    'starting_date' => $request->starting_date,
                    'ending_date' => $request->ending_date,
                    'old_regular_trainer_id' => $proxyTrainer->trainer->name ?? '',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Trainer shifted succesfully !!');
    }




}


