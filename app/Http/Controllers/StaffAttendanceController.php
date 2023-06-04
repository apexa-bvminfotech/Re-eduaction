<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\staffAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:staff-attendance-list|staff-attendance-create|staff-attendance-edit|staff-attendance-delete', ['only' => ['index','store']]);
        $this->middleware('permission:staff-attendance-create', ['only' => ['create','store']]);
        $this->middleware('permission:staff-attendance-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:staff-attendance-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffAttendance = DB::table("staff_attendance")
            ->select('staff_attendance.date',DB::raw('count(IF(attendance = 0, 1, NULL)) as present'),
                DB::raw('count(IF(attendance = 1, 1, NULL)) as absent'))
            ->groupBy('staff_attendance.date')
            ->orderBy('staff_attendance.id','DESC')->paginate(10);

        return view('staff_attendance.index',compact('staffAttendance'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Staff::orderBy('id','DESC')->where('is_active',0)->get();
        return view('staff_attendance.create',compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|unique:staff_attendance,date',
        ]);
        foreach ($request->data as $key => $r){
            $data = [
                'staff_id' => $r['Staff_id'],
                'attendance' => $r['attendance'],
                'absent_reason' => $r['absent_reason'],
                'date' => date('Y-m-d', strtotime($request->date)),
                'user_id' => auth()->user()->id,
            ];
            staffAttendance::Create($data);
        }

        return redirect()->route('staff_attendance.index')
            ->with('success','Staff attendance add successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($date)
    {
        $EditDate = $date;
        $staffAttendance = staffAttendance::select('staff_attendance.*','staff.id as staffID','staff.staff_name')->Where('date', $date)->join('staff','staff.id','staff_attendance.staff_id')->orderBy('staff_attendance.id','DESC')->get();
        $staff = Staff::orderBy('id','DESC')->where('is_active',0)->get();
        if($staffAttendance){
            return view('staff_attendance.edit',compact('staffAttendance','EditDate'));
        } else {
            return view('staff_attendance.create',compact('staff'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $date)
    {
        foreach ($request->data as $key => $r){
            $data = [
                'staff_id' => $r['Staff_id'],
                'attendance' => $r['attendance'],
                'absent_reason' => $r['absent_reason'],
                'user_id' => auth()->user()->id,
            ];
            staffAttendance::where('id',$r['id'])->update($data);
        }
        return redirect()->route('staff_attendance.index')
            ->with('success','Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($date)
    {
        staffAttendance::where('date', $date)->delete();
        return redirect()->route('staff_attendance.index')
            ->with('success','Attendance deleted successfully');
    }
}
