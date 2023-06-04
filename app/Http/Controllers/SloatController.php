<?php

namespace App\Http\Controllers;

use App\Models\Rtc;
use App\Models\Sloat;
use App\Models\Staff;
use Illuminate\Http\Request;

class SloatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:sloat-list|sloat-create|sloat-edit|sloat-delete', ['only' => ['index','store']]);
        $this->middleware('permission:sloat-create', ['only' => ['create','store']]);
        $this->middleware('permission:sloat-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sloat-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sloat = Sloat::select('sloat.*','staff.staff_name','rtc.rtc_name')
            ->join('staff', 'staff.id', 'sloat.staff_id')
            ->join('rtc', 'rtc.id', 'sloat.rtc_id')
            ->orderBy('sloat.id','DESC')->paginate(10);
        return view('sloat.index',compact('sloat'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Staff::orderBy('id','DESC')->where('is_active',0)->get();
        $rtc = Rtc::orderBy('id','DESC')->where('is_active',0)->get();
        return view('sloat.create',compact('staff','rtc'));
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
            'staff_id' => 'required',
            'rtc_id' => 'required',
            'sloat_time_to' => 'required',
            'sloat_time_from' => 'required',
        ]);
        $time = $request->input('sloat_time_to') ." - ". $request->input('sloat_time_from');
        $data = [
            'staff_id' => $request->input('staff_id'),
            'rtc_id' => $request->input('rtc_id'),
            'sloat_time' => $time,
        ];
        Sloat::create($data);

        return redirect()->route('sloat.index')
            ->with('success','Sloat created successfully');
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
    public function edit($id)
    {
        $sloat = Sloat::find($id);
        $staff = Staff::orderBy('id','DESC')->where('is_active',0)->get();
        $rtc = Rtc::orderBy('id','DESC')->where('is_active',0)->get();
        if($sloat){
            return view('sloat.edit',compact('sloat','staff','rtc'));
        } else {
            return view('sloat.create',compact('staff','rtc'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sloat $sloat)
    {
        $this->validate($request, [
            'staff_id' => 'required',
            'rtc_id' => 'required',
            'sloat_time_to' => 'required',
            'sloat_time_from' => 'required',
        ]);
        $time = $request->input('sloat_time_to') ." - ". $request->input('sloat_time_from');
        $data = [
            'staff_id' => $request->input('staff_id'),
            'rtc_id' => $request->input('rtc_id'),
            'sloat_time' => $time,
        ];

        $sloat->update($data);

        return redirect()->route('sloat.index')
            ->with('success','Sloat updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sloat::where('id',$id)->delete();
        return redirect()->route('sloat.index')
            ->with('success','Sloat deleted successfully');
    }

    public function changeSloatStatus(Request $request){
        $sloat = Sloat::find($request->sloat_id);
        $sloat->is_active = $request->status;
        $sloat->save();
        return response()->json($request->status);
    }
}
