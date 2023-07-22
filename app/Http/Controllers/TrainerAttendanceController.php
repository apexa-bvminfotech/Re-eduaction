<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStaffAssign;
use App\Models\Trainer;
use App\Models\TrainerAttendance;
use App\Models\TrainerSlotWiseAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:trainer-attendance-list|trainer-attendance-create|trainer-attendance-edit|trainer-attendance-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:trainer-attendance-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:trainer-attendance-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:trainer-attendance-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $trainerAttendance = DB::table("trainer_attendances")
//            ->select('trainer_attendances.date',DB::raw('count(IF(attendance = 0, 1, NULL)) as present'),
//                DB::raw('count(IF(attendance = 1, 1, NULL)) as absent'))
//            ->groupBy('trainer_attendances.date')
//            ->orderBy('trainer_attendances.id','DESC')->get();
        $trainerAttendance = TrainerAttendance::orderBy('id', 'DESC');
//        $regularStaffAssignedSlots = Slot::orderBy('id','DESC');


        return view('trainer_attendance.index', compact('trainerAttendance',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainer = Trainer::orderBy('id', 'DESC')->get();
        $studentStaffAssign = StudentStaffAssign::orderBy('id', 'DESC')->with('trainer')->get()->groupBy('trainer.name');
//        dd($studentStaffAssign);
        $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereDate('starting_date', now()->format('Y-m-d'))->with('trainer')
            ->get()->groupBy('trainer.name');
//        dd($proxyStaff);
        $trainerSlotWise = TrainerSlotWiseAttendance::orderBy('id', 'DESC')->get();

//        dd($trainerSlots);
        return view('trainer_attendance.create', compact('trainer', 'proxyStaff', 'studentStaffAssign', 'trainerSlotWise'));
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
            'date' => 'required|unique:trainer_attendance,date',
        ]);
        foreach ($request->data as $key => $r) {
            $data = [
                'trainers_id' => $r['trainer_id'],
                'attendance' => $r['attendance'],
                'absent_reason' => $r['absent_reason'],
                'date' => date('Y-m-d', strtotime($request->date)),
                'user_id' => auth()->user()->id,
            ];
            TrainerAttendance::Create($data);
        }

        return redirect()->route('trainer_attendance.index')
            ->with('success', 'trainer attendance add successfully');

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
    public function edit($date)
    {
        $EditDate = $date;
        $trainerAttendance = TrainerAttendance::select('trainer_attendance.*', 'trainers.id as trainerID', 'trainers.name')
            ->Where('date', $date)
            ->join('trainers', 'trainers.id', 'trainer_attendance.trainers_id')
            ->orderBy('trainer_attendance.id', 'DESC')->get();
        $trainer = Trainer::orderBy('id', 'DESC')->get();
        $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereDate('starting_date', now()->format('Y-m-d'))->with('trainer')->get();
        if ($trainerAttendance) {
            return view('trainer_attendance.edit', compact('trainerAttendance', 'EditDate', 'proxyStaff'));
        } else {
            return view('trainer_attendance.create', compact('trainer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $date)
    {
        foreach ($request->data as $key => $r) {
            $data = [
                'trainers_id' => $r['trainers_id'],
                'attendance' => $r['attendance'],
                'absent_reason' => $r['absent_reason'],
                'user_id' => auth()->user()->id,
            ];
            TrainerAttendance::where('id', $r['id'])->update($data);
        }
        return redirect()->route('trainer_attendance.index')
            ->with('success', 'Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($date)
    {
        TrainerAttendance::where('date', $date)->delete();
        return redirect()->route('trainer_attendance.index')
            ->with('success', 'Attendance deleted successfully');
    }
}
