<?php

namespace App\Http\Controllers;

use App\Models\Appreciation;
use App\Models\Course;
use Illuminate\Http\Request;

class appreciationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:appreciation-list|appreciation-create|appreciation-edit', ['only' => ['index', 'store']]);
        $this->middleware('permission:appreciation-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:appreciation-edit', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appreciation = Appreciation::orderBy('id','DESC')->with('course')->get();
        return view('appreciation.index', compact('appreciation'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::orderBy('id','ASC')->get();
        return view('appreciation.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'appreciation_name' => 'required',
            'course_id' => 'required|unique:appreciation,course_id',
        ]);

        Appreciation::Create([
            'appreciation_name' => $request->appreciation_name,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('appreciation.index')->with('success', 'Appreciation Created successfully');
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
    public function edit(Appreciation $appreciation)
    {
        $course = Course::orderBy('id','ASC')->get();
        return view('appreciation.edit',compact('appreciation', 'course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appreciation $appreciation)
    {
        $request->validate([
            'appreciation_name' => 'required',
            'course_id' => 'required',
        ]);

        $appreciation->update([
            'appreciation_name' => $request->appreciation_name,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('appreciation.index')->with('success', 'Appreciation Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
