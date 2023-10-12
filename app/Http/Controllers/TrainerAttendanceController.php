<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\StudentProxyStaffAssign;
use App\Models\StudentStaffAssign;
use App\Models\Trainer;
use App\Models\TrainerAttendance;
use App\Models\TrainerSlotWiseAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $trainerAttendance = DB::table("trainer_attendances")
            ->select('trainer_attendances.date',DB::raw('count(IF(status = "P", 1, NULL)) as present'),
                DB::raw('count(IF(status = "A", 1, NULL)) as absent'))
            ->groupBy('trainer_attendances.date')
            ->orderBy('trainer_attendances.id','DESC')->get();

        return view('trainer_attendance.index', compact('trainerAttendance',));
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
            $studentStaffAssign = StudentStaffAssign::orderBy('id', 'DESC')->where('is_active','0')->with('trainer')->get()->groupBy('trainer.name');
            $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereDate('starting_date', now()->format('Y-m-d'))->with('trainer')
                ->get()->groupBy('trainer.name');
            return view('trainer_attendance.create', compact('trainer', 'proxyStaff', 'studentStaffAssign'));
        }
        else{
            $trainer = Trainer::orderBy('id', 'DESC')->get();
            $studentStaffAssign = StudentStaffAssign::orderBy('id', 'DESC')->where('is_active','0')->with('trainer')->get()->groupBy('trainer.name');
            $proxyStaff = StudentProxyStaffAssign::orderBy('id', 'DESC')->whereDate('starting_date', now()->format('Y-m-d'))->with('trainer')
                ->get()->groupBy('trainer.name');
            return view('trainer_attendance.create', compact('trainer', 'proxyStaff', 'studentStaffAssign'));
        }      
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
            'date' => 'required|unique:trainer_attendances,date',
        ]);

        $date = date('Y-m-d', strtotime($request->date));

        foreach ($request->data as $key => $r) {
            $data = [
                'trainer_id' => $r['trainer_id'],
                'slot_id' =>  $r['slot_id'],
                'status' => $r['status'],
                'absent_reason' => $r['absent_reason'],
                'slot_type' => $r['slot_type'],
                'date' =>  $date,
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
    public function show($date)
    {
        $trainerAttendance = TrainerAttendance::select('trainer_attendances.*','trainers.name','slots.slot_time')
            ->where('date',$date)
            ->join('trainers', 'trainers.id', 'trainer_attendances.trainer_id')
            ->join('slots', 'slots.id', 'trainer_attendances.slot_id')
            ->get()->groupby('trainer.name');
        return view('trainer_attendance.show',compact('trainerAttendance'));
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
        $trainerAttendance = TrainerAttendance::select('trainer_attendances.*', 'trainers.id as trainerID', 'trainers.name', 'slots.slot_time')
            ->Where('date', $date)
            ->join('trainers', 'trainers.id', 'trainer_attendances.trainer_id')
            ->join('slots', 'slots.id', 'trainer_attendances.slot_id')
            ->orderBy('trainer_attendances.id', 'ASC')->get()->groupby('trainer.name');
            return view('trainer_attendance.edit', compact('trainerAttendance', 'EditDate'));
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
        $this->validate($request, [
            'date' => 'required',
        ]);
        foreach ($request->data as $key => $r) {
            $data = [
                'status' => $r['status'],
                'absent_reason' => $r['absent_reason'],
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
