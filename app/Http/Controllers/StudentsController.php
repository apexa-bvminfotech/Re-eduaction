<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('course')->orderBy('id')->paginate(10);
        return view('student.index', compact('students'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::orderBy('id', 'desc')->get();
        $role = Role::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $staff = Staff::orderBy('id')->get();
        return view('student.create', compact('student', 'role', 'course', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'address' => 'required',
            'gender' => 'required',
            'email_id' => 'required|email|unique:users,email',
            'father_contact_no' => 'required|numeric|digits:10',
            'mother_contact_no' => 'required|numeric|digits:10',
            'standard' => 'required|numeric|max:12',
            'medium' => 'required',
            'school_name' => 'required|max:255',
            'school_time_to' => 'required',
            'school_time_from' => 'required',
            'extra_tuition_time_to' => 'required',
            'extra_tuition_time_from' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'payment_condition' => 'required|max:255',
            'reference_by' => 'required',
            'demo_staff_id' => 'required',
            'fees' => 'required',
            'extra_note' => 'required',
            'analysis_staff_id'=>'required|exists:staff,id',
            'course_id'=>'required|exists:courses,id'
        ]);

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email_id,
            'password' => bcrypt(strtolower($request->name) . '@123'),
            'type' => 2,
        ]);
        $user->assignRole($request->input('role'));
        $upload_student_image = null;
        if ($request->upload_student_image) {
            $filename = $request->name . '_' . date_default_timezone_get() . '.' . $request->upload_student_image->getClientOriginalExtension();
            $request->upload_student_image->move(public_path('assets/student'), $filename);
            $upload_student_image = 'assets/student' . '/' . $filename;
        }
        $upload_analysis = null;
        if ($request->upload_analysis) {
            $filename = $request->name . '-' . $request->upload_analysis->getClientOriginalExtension();
            $request->upload_analysis->move(public_path('assets/student'), $filename);
            $upload_analysis = 'assets/student' . '/' . $filename;
        }
        $time = $request->input('school_time_to') . " - " . $request->input('school_time_from');

        $tuition = $request->input('extra_tuition_time_to') . "-" . $request->input('extra_tuition_time_from');
        $last_id = Student::latest()->first() ? Student::latest()->first()->value('id') + 1 : 1;
        $student = Student::create([
            'form_no' => 'RE/' . $last_id,
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'address' => $request->address,
            'gender' => $request->gender,
            'email_id' => $request->email_id,
            'father_contact_no' => $request->father_contact_no,
            'mother_contact_no' => $request->mother_contact_no,
            'standard' => $request->standard,
            'medium' => $request->medium,
            'school_name' => $request->school_name,
            'school_time' => $time,
            'extra_tuition_time' => $tuition,
            'dob' => $request->dob,
            'age' => $request->age,
            'course_id' => $request->course_id,
            'payment_condition' => $request->payment_condition,
            'reference_by' => $request->reference_by,
            'demo_staff_id' => $request->demo_staff_id,
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_staff_id' => $request->analysis_staff_id,
            'upload_analysis' => $upload_analysis,
            'upload_student_image' => $upload_student_image,
            'user_id' => $user->id,
        ]);
        return redirect()->route('student.index', compact('student'))->with('success', 'student created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $role = Role::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $staff = Staff::orderBy('id')->get();
        return view('student.edit', compact('student', 'role', 'course', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'address' => 'required',
            'gender' => 'required',
            'email_id' => 'required|email',
            'father_contact_no' => 'required|numeric',
            'mother_contact_no' => 'required|numeric',
            'standard' => 'required|min:1|max:12',
            'medium' => 'required',
            'school_name' => 'required|max:255',
            'school_time_to' => 'required',
            'school_time_from' => 'required',
            'extra_tuition_time_to' => 'required',
            'extra_tuition_time_from'=>'required',
            'dob' => 'required',
            'age' => 'required',
            'payment_condition' => 'required|max:255',
            'reference_by' => 'required',
            'demo_staff_id' => 'required',
            'fees' => 'required',
            'extra_note' => 'required',
            'analysis_staff_id'=>'required|exists:staff,id',
            'course_id'=>'required|exists:courses,id'
        ]);
        $upload_student_image = $student->upload_student_image;
        if ($request->upload_student_image) {
            $filename = $request->name . '_' . date_default_timezone_get() . '.' . $request->upload_student_image->getClientOriginalExtension();
            $request->upload_student_image->move(public_path('assets/student/images'), $filename);
            $upload_student_image = 'assets/student/images/' . $filename;
        }
        $upload_analysis = $student->upload_analysis;
        if ($request->upload_analysis) {
            $filename = $request->name . '-' . $request->upload_analysis->getClientOriginalExtension();
            $request->upload_analysis->move(public_path('assets/student/pdf'), $filename);
            $upload_analysis = 'assets/student/pdf/' . $filename;
        }
        $time = $request->input('school_time_to') . " - " . $request->input('school_time_from');
        $tuition = $request->input('extra_tuition_time_to') . "-" . $request->input('extra_tuition_time_from');
        $student->update([
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'address' => $request->address,
            'gender' => $request->gender,
            'email_id' => $request->email_id,
            'father_contact_no' => $request->father_contact_no,
            'mother_contact_no' => $request->mother_contact_no,
            'standard' => $request->standard,
            'medium' => $request->medium,
            'school_name' => $request->school_name,
            'school_time' => $time,
            'extra_tuition_time' => $tuition,
            'dob' => $request->dob,
            'age' => $request->age,
            'course_id' => $request->course_id,
            'payment_condition' => $request->payment_condition,
            'reference_by' => $request->reference_by,
            'demo_staff_id' => $request->demo_staff_id,
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_staff_id' => $request->analysis_staff_id,
            'upload_analysis' => $upload_analysis,
            'upload_student_image' => $upload_student_image,
        ]);
        return redirect()->route('student.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::where('id', $id)->delete();
        return redirect()->route('student.index')
            ->with('success', 'student deleted successfully');
    }
}
