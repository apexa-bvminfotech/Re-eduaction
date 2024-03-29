<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseWiseMaterial;
use Illuminate\Http\Request;

class CourseWiseMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:course-material-list|course-material-create|course-material-edit', ['only' => ['index','store']]);
        $this->middleware('permission:course-material-create', ['only' => ['create','store']]);
        $this->middleware('permission:course-material-edit', ['only' => ['edit','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_material = CourseWiseMaterial::orderBy('id','DESC')->with('course')->get();
        return view('course_material.index',compact('course_material'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::orderBy('id','ASC')->get();
        return view('course_material.create',compact('course'));
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
            'course_name' => 'required',
            'medium' => 'required',
            'material_name' => 'required'
        ]);

        CourseWiseMaterial::create([
            'course_id' => $request->input('course_name'),
            'medium' => $request->input('medium'),
            'material_name' => $request->input('material_name')
        ]);
        return redirect()->route('course_material.index')->with('success', 'Material created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseWiseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(CourseWiseMaterial $courseMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseWiseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseWiseMaterial $courseMaterial)
    {
        $course = Course::orderBy('id','ASC')->get();
        return view('course_material.edit',compact('course','courseMaterial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseWiseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseWiseMaterial $courseMaterial)
    {
        $this->validate($request, [
            'course_name' => 'required',
            'medium' => 'required',
            'material_name' => 'required'
        ]);
        $courseMaterial->update([
            'course_id' => $request->input('course_name'),
            'medium' => $request->input('medium'),
            'material_name' => $request->input('material_name')
        ]);
        return redirect()->route('course_material.index')->with('success', 'Material Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseWiseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseWiseMaterial $courseMaterial)
    {
        //
    }
}
