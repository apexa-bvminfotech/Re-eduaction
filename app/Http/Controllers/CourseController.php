<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Sloat;
use App\Models\SubCourse;
use App\Models\SubCoursePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'asc')->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
//        dd($request->all());
        $rules = [
            'course_name' => 'required|string|max:255',
            'sub_course_name.*' => 'required|string|max:255',
            'point.*.name.*' => 'required|string|max:255',
        ];

        $messages = [
            'course_name.required' => 'The course name is required.',
            'sub_course_name.*.name.required' => 'The sub-course name is required.',
            'point.*.name.*.required' => 'The point field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->save();

        foreach ($request->sub_course_name as $key => $sub_course) {
            $subCourse = new SubCourse();
            $subCourse->course_id = $course->id;
            $subCourse->sub_course_name = $sub_course;
            $subCourse->save();
            if (isset($request->point[$key])) {
                foreach ($request->point[$key] as $point) {
                    $subCoursePoint = SubCoursePoint::create(['sub_course_id' => $subCourse->id, 'sub_point_name' => $point]);
                }
            }
        }
        return redirect()->route('course.index')->with('success', 'Course Created Successfully.');

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
        return view('courses.edit', compact('course'));
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
        $rules = [
            'course_name' => 'required|string|max:255',
            'sub_course_name' => 'required',
            'sub_course_name.*.name' => 'required|string|max:255',
            'sub_course_name.*.point' => 'required',
            'sub_course_name.*.point.*.name' => 'required|string|max:255',
        ];

        $messages = [
            'course_name.required' => 'The course name is required.',
            'sub_course_name.*.name.required' => 'The sub-course name is required.',
            'sub_course_name.*.point.*.name.required' => 'The point field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $course->course_name = $request->course_name;
        $course->save();

        $subCoursesData = [];

        foreach ($request->sub_course_name as $key => $sub_course) {
            $subCourse = SubCourse::updateOrCreate(['id'=> $sub_course['id']], [
                'id' => $sub_course['id'],
                'course_id' => $course->id,
                'sub_course_name' => $sub_course['name']
            ]);
            if (isset($sub_course['point'])) {
                foreach ($sub_course['point'] as $point) {
                    SubCoursePoint::where('id',$point['id'])->update([
                        'sub_point_name' => $point['name']
                    ]);
                }
            }

            if (isset($request->point[$key])) {

                foreach ($request->point[$key] as $p) {

                    $subCoursePoint = SubCoursePoint::create(['sub_course_id' => $subCourse->id, 'sub_point_name' =>  $p]);
                }
            }

        }



        return redirect()->route('course.index')->with('success', 'Course Updated Successfully.');
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
        return redirect()->route('course.index')->with('success', 'Course Deleted Successfully.');
    }
}
