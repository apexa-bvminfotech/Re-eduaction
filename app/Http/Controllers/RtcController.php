<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Rtc;
use DB;
use Illuminate\Support\Facades\Auth;

class RtcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:rtc-list|rtc-create|rtc-edit', ['only' => ['index','store']]);
        $this->middleware('permission:rtc-create', ['only' => ['create','store']]);
        $this->middleware('permission:rtc-edit', ['only' => ['edit','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rtc = Rtc::orderBy('id','DESC')->get();
        if(Auth::user()->type == 1){
            $rtc = Rtc::where('branch_id', Auth::user()->branch_id)->where('is_active',0)->orderBy('id','DESC')->get();
        }
        return view('rtc.index',compact('rtc'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::orderBy('id','DESC')->get();
        if(Auth::user()->type == 1){
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('rtc.create',compact('branch'));
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
            'rtc_no' => 'required|unique:rtc,rtc_no',
            'rtc_name' => 'required',
            'branch_id' => 'required',
            'person_name' => 'required',
            'contact' => 'required|digits:10|numeric',
            'address' => 'required',
            'is_active' => 'required',
        ]);
        $data = [
            'rtc_no' => $request->input('rtc_no'),
            'rtc_name' => $request->input('rtc_name'),
            'branch_id'=>$request->input('branch_id'),
            'person_name'=>$request->person_name,
            'contact' => $request->contact,
            'address'=>$request->address,
            'is_active' => $request->is_active,
        ];
        Rtc::create($data);

        return redirect()->route('rtc.index')
            ->with('success','RTC created successfully.');
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
        $rtc = Rtc::find($id);
        $branch = Branch::orderBy('id','DESC')->get();
        if(Auth::user()->type == 1){
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        if($rtc){
            return view('rtc.edit',compact('rtc','branch'));
        } else {
            return view('rtc.create');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rtc $rtc)
    {
        $this->validate($request, [
            'rtc_no' => 'required|unique:rtc,rtc_no,'.$rtc->id,
            'rtc_name' => 'required',
            'branch_id' => 'required',
            'person_name' => 'required',
            'contact' => 'required|digits:10|numeric',
            'address' => 'required',
        ]);

        $rtc->update($request->all());

        return redirect()->route('rtc.index')
            ->with('success','RTC updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rtc::where('id',$id)->delete();
        return redirect()->route('rtc.index')
            ->with('success','RTC deleted successfully');
    }

    public function changeRtcStatus(Request $request){
        $rtc = Rtc::find($request->rtc_id);
        $rtc->is_active = $request->status;
        $rtc->save();
        return response()->json(['success' => $request->status ? 'RTC de-active' : 'RTC active']);
    }
}
