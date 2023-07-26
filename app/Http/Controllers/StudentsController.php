<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Slot;
use App\Models\StudentAttendance;
use App\Models\StudentCourseComplete;
use App\Models\SubCoursePoint;
use App\Models\Trainer;
use App\Models\StudentStaffAssign;
use App\Models\StudentProxyStaffAssign;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{

    public function index()
    {
        $slots = Slot::orderBy('id', 'desc')->get();
        $trainers = Trainer::orderBy('id', 'desc')->get();
        $students = Student::with('course')->orderBy('id')->get();
        return view('student.index', compact('students', 'trainers', 'slots'))->with('i');
    }

    public function create()
    {
        $student = Student::orderBy('id', 'desc')->get();
        $role = Role::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $trainer = Trainer::orderBy('id')->where('is_active', 0)->get();
        return view('student.create', compact('student', 'role', 'course', 'trainer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'address' => 'required',
            'gender' => 'required',
            'email_id' => 'nullable|email',
            'father_contact_no' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'mother_contact_no' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'standard' => 'required|numeric|max:12',
            'medium' => 'required',
            'school_name' => 'required|max:255',
            'school_time_to' => 'required',
            'school_time_from' => 'required',
            'extra_tuition_time_to' => 'required',
            'extra_tuition_time_from' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'course_id' => 'required|exists:courses,id',
            'payment_condition' => 'required|max:255',
            'reference_by' => 'required',
            'demo_trainer_id' => 'required',
            'fees' => 'required',
            'extra_note' => 'required',
            'analysis_trainer_id' => 'required|exists:trainers,id',
            'upload_analysis' => 'nullable',
            'upload_student_image' => 'nullable',
        ]);
        $user = User::Create([
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email_id,
            'contact' => $request->father_contact_no,
            'password' => Hash::make(strtolower($request->name) . '@123'),
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
        Student::create([
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
            'demo_trainer_id' => $request->demo_trainer_id,
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_trainer_id' => $request->analysis_trainer_id,
            'upload_analysis' => $upload_analysis,
            'upload_student_image' => $upload_student_image,
            'user_id' => $user->id,
        ]);
        return redirect()->route('student.index')->with('success', 'student created successfully');
    }

    public function show($id)
    {
        $student = Student::find($id);
        $assignStaff = StudentStaffAssign::orderBy('id')->where('student_id', $student->id)->With('Trainer', 'Slot')->get();
        $studentAttendance = StudentAttendance::orderBy('id')->where('student_id', $student->id)->get();
        $proxy_staff_details = $student->proxyStaffAssignments;
        return view('student.show', compact('student', 'assignStaff', 'studentAttendance', 'proxy_staff_details'));
    }

    public function edit(Student $student)
    {
        $role = Role::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $trainer = Trainer::orderBy('id')->get();
        return view('student.edit', compact('student', 'role', 'course', 'trainer'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'address' => 'required',
            'gender' => 'required',
            'father_contact_no' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'mother_contact_no' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'standard' => 'required|min:1|max:12',
            'medium' => 'required',
            'school_name' => 'required|max:255',
            'school_time_to' => 'required',
            'school_time_from' => 'required',
            'extra_tuition_time_to' => 'required',
            'extra_tuition_time_from' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'course_id' => 'required|exists:courses,id',
            'payment_condition' => 'required|max:255',
            'reference_by' => 'required',
            'demo_trainer_id' => 'required',
            'fees' => 'required',
            'extra_note' => 'required',
            'analysis_trainer_id' => 'required|exists:trainers,id',
        ]);
        $user = $student->user;
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email_id,
            'contact' => $request->father_contact_no,
            'password' => Hash::make(strtolower($request->name) . '@123'),
            'type' => 2,
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
        $user->assignRole($request->input('role'));
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
            'demo_trainer_id' => $request->demo_trainer_id,
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_trainer_id' => $request->analysis_trainer_id,
            'upload_analysis' => $upload_analysis,
            'upload_student_image' => $upload_student_image,
        ]);
        return redirect()->route('student.index')->with('success', 'Student updated successfully');
    }

    public function destroy($id)
    {
        Student::where('id', $id)->delete();
        return redirect()->route('student.index')
            ->with('success', 'student deleted successfully');
    }

    public function slot($id)
    {
        $slots = Slot::where('trainer_id', $id)
            ->where('is_active', 0)
            ->with('rtc')
            ->get();
        return response()->json(['slots' => $slots]);
    }

    public function assignStaff(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'trainer_id' => 'required|integer',
            'slot_id' => 'required|integer',
        ]);
//        dd($validatedData);
        $student = StudentStaffAssign::where('student_id', $request->student_id)->where('is_active', 0)->first();

        if ($student) {
            if ($student->trainer_id == $request->trainer_id) {
                return back()->with('error', 'Trainer is already Assigned');
            }
            $student->update([
                'is_active' => 1,
            ]);
            $check = StudentStaffAssign::where(['student_id' => $request->student_id, 'trainer_id' => $validatedData['trainer_id']])->where('is_active', 1)->first();
            if ($check) {
                $check->update([
                    'is_active' => 0,
                    'date' => now(),
                ]);
            } else {
                $assignStaff = new StudentStaffAssign();
                $assignStaff->student_id = $validatedData['student_id'];
                $assignStaff->trainer_id = $validatedData['trainer_id'];
                $assignStaff->slot_id = $validatedData['slot_id'];
                $assignStaff->date = Carbon::now()->toDateString();
                $assignStaff->save();
            }
        } else {
            $assignStaff = new StudentStaffAssign();
            $assignStaff->student_id = $validatedData['student_id'];
            $assignStaff->trainer_id = $validatedData['trainer_id'];
            $assignStaff->slot_id = $validatedData['slot_id'];
            $assignStaff->date = Carbon::now()->toDateString();
            $assignStaff->save();
        }

        return redirect()->back()->with('success', 'Trainer assigned successfully');
    }

    public function proxySlot($id)
    {
        $proxy_slots = Slot::where('trainer_id', $id)
            ->with('rtc')
            ->get();
        return response()->json(['slots' => $proxy_slots]);
    }

    public function proxyStaff(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'trainer_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'starting_date' => 'required',
            'ending_date' => 'required',
        ]);

        $existingProxyStaff = StudentProxyStaffAssign::where('student_id', $request->student_id)
            ->where('starting_date', $request->starting_date)
            ->where('ending_date', $request->ending_date)
            ->first();

        if ($existingProxyStaff) {
            if ($existingProxyStaff->trainer_id == $request->trainer_id) {
                return back()->with('error', 'Trainer is already assigned as proxy staff for the specified dates');
            }
        }

        $proxyStaff = new StudentProxyStaffAssign();
        $proxyStaff->student_id = $validatedData['student_id'];
        $proxyStaff->trainer_id = $validatedData['trainer_id'];
        $proxyStaff->slot_id = $validatedData['slot_id'];
        $proxyStaff->starting_date = $validatedData['starting_date'];
        $proxyStaff->ending_date = $validatedData['ending_date'];
        $proxyStaff->save();

        return redirect()->back()->with('success', 'Proxy-Trainer assigned successfully');
    }


    public function sendNotification(Request $request)
    {
//        dd($request->all());
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
//            'sub_course_id' => 'nullable',
//            'subCourse_point_after' => 'nullable|array',

        ]);


        foreach ($request->subCourse_point_after as $key => $value)
        {
            $point = SubCoursePoint::find($key);
            $studentCourseComplete = new StudentCourseComplete();
            $studentCourseComplete->student_id = $validatedData['student_id'];

            if (Auth::user()->roles()->first()->value('name') == "Admin") {
                $studentCourseComplete->user_id = Auth::user()->id;
            } else {
                $studentCourseComplete->trainer_id = Auth::user()->id;
            }

            $studentCourseComplete->course_id = $validatedData['course_id'];
            $studentCourseComplete->sub_course_id = $point->sub_course_id;
            $studentCourseComplete->sub_course_point_id = $key;
            $studentCourseComplete->after = 1;
            $studentCourseComplete->trainer_confirm_date = Carbon::now()->toDateString();
            $studentCourseComplete->admin_confirm_date = Carbon::now()->toDateString();
            $studentCourseComplete->save();
        }

        return redirect()->route('student.show', $validatedData['student_id'])->with('success', 'notification sent to admin.');
    }
}




