<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rtc;
use DB;

class RtcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:rtc-list|rtc-create|rtc-edit|rtc-delete', ['only' => ['index','store']]);
        $this->middleware('permission:rtc-create', ['only' => ['create','store']]);
        $this->middleware('permission:rtc-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:rtc-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rtc = Rtc::orderBy('id','DESC')->paginate(5);
        return view('rtc.index',compact('rtc'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rtc.create');
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
            'address' => 'required',
        ]);

        Rtc::create($request->all());

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
        if($rtc){
            return view('rtc.edit',compact('rtc'));
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
            'rtc_no' => 'required|unique:rtc,rtc_no',
            'rtc_name' => 'required',
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
}
