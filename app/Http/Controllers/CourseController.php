<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Sloat;
use App\Models\SubCourse;
use App\Models\SubCoursePoint;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id','asc')->paginate(5);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $sub_courses = SubCourse::orderBy('id','asc')->get();
//        $sub_course_points = SubCoursePoint::orderBy('id','asc')->get();
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//       dd($request->all());
        $this->validate($request, [
            'course_name' => 'required',
            'sub_course.*' => 'required',
            'sub_point_name.*' => 'required',
        ]);
        $course = new Course();
        $course->course_name = $request->course_name;
        $course->save();
        foreach ($request->sub_course_name as $key => $sub_course) {
            $subCourse = new SubCourse();
            $subCourse->course_id = $course->id;
            $subCourse->sub_course_name = $sub_course;
            $subCourse->save();
            foreach ($request->point[$key] as $point) {
                $subCoursePoint = SubCoursePoint::create(['sub_course_id'=>$subCourse->id,'sub_point_name'=>$point]);
            }
        }
        return redirect()->route('course.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return redirect()->route('course.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
//        dd($request->all());
//        $course->id = $course->id;
        $course->course_name = $request->course_name;
        $course->save();
        foreach ($request->edit_sub_course_name as $key => $sub_course) {
            $subCourse = SubCourse::find($key);
            $subCourse->course_id = $course->id;
            $subCourse->sub_course_name = $sub_course;
            $subCourse->save();
            foreach ($request->point[$key] as $key1 => $point) {
                $subCoursePoint = SubCoursePoint::find($key1);
                $subCoursePoint->sub_point_name = $point;
                $subCoursePoint->save();
            }
        }
        $course->update();
        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('course.index')->with('success','Course Deleted successfully.');
    }
}
