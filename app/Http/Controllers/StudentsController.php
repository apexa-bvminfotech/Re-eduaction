<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Slot;
use App\Models\StudentAttendance;
use App\Models\StudentCourseComplete;
use App\Models\SubCourse;
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
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{

    public function index()
    {
        $slots = Slot::where('is_active', 0)->orderBy('id', 'desc')->get();
        $trainers = Trainer::where('is_active', 0)->orderBy('id', 'desc')->get();
        $students = Student::with('course')->orderBy('id')->get();
        if(Auth::user()->type == 1) {
            $slots = Slot::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
            $trainers = Trainer::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
            $students = Student::
                select('students.surname', 'students.name','students.standard','students.medium','students.course_id','students.id','students.father_contact_no')
                ->with('course')
                ->join('student_staff_assigns', 'student_staff_assigns.student_id', 'students.id')
                ->join('trainers','trainers.id', 'student_staff_assigns.trainer_id')
                ->where(['trainers.user_id' => Auth::user()->id,'student_staff_assigns.is_active' => 0])
                ->orderBy('students.id')->get();
        }
        return view('student.index', compact('students', 'trainers', 'slots'))->with('i');
    }

    public function create()
    {
        $role = Role::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $trainer = Trainer::orderBy('id')->where('is_active', 0)->get();
        $branch = Branch::orderBy('id', 'DESC')->get();
        if(Auth::user()->type == 1) {
            $trainer = Trainer::orderBy('id')->where(['is_active' => 0, 'branch_id' => Auth::user()->branch_id])->get();
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('student.create', compact('role', 'course', 'trainer','branch'));
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
            'branch_id' => 'required',
        ]);
        $user = User::Create([
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email_id,
            'contact' => $request->father_contact_no,
            'password' => Hash::make(strtolower($request->name) . '@123'),
            'branch_id' => $request->input('branch_id'),
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
            'demo_trainer_id' => $request->demo_trainer_id ? $request->demo_trainer_id : 0,
            'branch_id' => $request->input('branch_id'),
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_trainer_id' => $request->analysis_trainer_id ? $request->analysis_trainer_id : 0,
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
        $trainer = Trainer::where('is_active', 0)->orderBy('id')->get();
        $branch = Branch::orderBy('id', 'DESC')->get();
        if(Auth::user()->type == 1) {
            $trainer = Trainer::orderBy('id')->where(['is_active' => 0, 'branch_id' => Auth::user()->branch_id])->get();
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('student.edit', compact('student', 'role', 'course', 'trainer','branch'));
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
            'course_id' => 'required|exists:courses,id'
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
            'demo_trainer_id' => $request->demo_trainer_id ? $request->demo_trainer_id : 0,
            'branch_id' => $request->input('branch_id'),
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_trainer_id' => $request->analysis_trainer_id ? $request->analysis_trainer_id : 0,
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
        $student = StudentStaffAssign::where(['student_id' => $request->student_id, 'trainer_id' => $request->trainer_id, 'slot_id' => $request->slot_id])->where('is_active', 0)->first();

        if ($student) {
                return back()->with('error', 'Trainer is already Assigned');
        } else {

            $studentUpdate = StudentStaffAssign::where(['student_id' => $request->student_id, 'is_active' => 0])->first();
            $studentUpdate->update([
                'is_active' => 1,
            ]);

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
        $proxy_slots = Slot::where(['trainer_id' => $id, 'is_active' => 0])
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
            ->where('starting_date' ,'>=', $request->starting_date)
            ->where('ending_date', '<=', $request->ending_date)
            ->where('trainer_id',  $request->trainer_id)
            ->first();

        $checkIsregularTrainer = StudentStaffAssign::where(['student_id' => $request->student_id, 'trainer_id' => $request->trainer_id, 'is_active' => 0])->first();
        if ($existingProxyStaff) {
                return back()->with('error', 'Trainer is already assigned as proxy staff for the specified dates');
        } elseif($checkIsregularTrainer) {
            return back()->with('error', 'Trainer is already assigned as regular staff');
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
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
            'subCourse_before' => 'nullable|array',
            'subCourse_after' => 'nullable|array',
            'subCourse_point_after' => 'nullable|array',
            'subCourse_point_before' => 'nullable|array',
        ]);
        // Handle 'before' checkboxes for subCourses
        if (!empty($request->subCourse_before) && is_array($request->subCourse_before)) {
            foreach ($request->subCourse_before as $subCourseBefore_key => $subCourseBefore_value) {
                $subCourseBefore = SubCourse::find($subCourseBefore_key);

                if ($subCourseBefore) {
                    StudentCourseComplete::updateOrCreate(
                        [
                            'student_id' => $validatedData['student_id'],
                            'course_id' => $validatedData['course_id'],
                            'sub_course_id' => $subCourseBefore_key,
                            'before' => 1,
                        ],
                        [
                            'user_id' => Auth::user()->roles()->first()->value('name') == "Admin" ? Auth::user()->id : null,
                            'trainer_id' => Auth::user()->roles()->first()->value('name') != "Admin" ? Auth::user()->id : null,
//                            'sub_course_id' => $subCourseBefore,
                            'trainer_confirm_date' => Carbon::now()->toDateString(),
                            'admin_confirm_date' => Carbon::now()->toDateString(),
                        ]
                    );
                }
            }
        }

        // Handle 'after' checkboxes for subCourses
        if (!empty($request->subCourse_after) && is_array($request->subCourse_after)) {
            foreach ($request->subCourse_after as $subCourseAfter_key => $subCourseAfter_value) {
                $subCourseAfter = SubCourse::find($subCourseAfter_key);
//            dd($subCourseAfter);
                if ($subCourseAfter) {
                    StudentCourseComplete::updateOrCreate(
                        [
                            'student_id' => $validatedData['student_id'],
                            'course_id' => $validatedData['course_id'],
                            'sub_course_id' => $subCourseAfter_key,
                            'after' => 1,
                        ],
                        [
                            'user_id' => Auth::user()->roles()->first()->value('name') == "Admin" ? Auth::user()->id : null,
                            'trainer_id' => Auth::user()->roles()->first()->value('name') != "Admin" ? Auth::user()->id : null,
//                            'sub_course_id' => $subCourseAfter,
                            'trainer_confirm_date' => Carbon::now()->toDateString(),
                            'admin_confirm_date' => Carbon::now()->toDateString(),
                        ]
                    );
                }
            }
        }

        // Handle subCourse points for 'before'
        if (!empty($request->subCourse_point_before) && is_array($request->subCourse_point_before)) {
            foreach ($request->subCourse_point_before as $key1 => $value1) {
                $point_before = SubCoursePoint::find($key1);

                if ($point_before) {
                    StudentCourseComplete::updateOrCreate(
                        [
                            'student_id' => $validatedData['student_id'],
                            'course_id' => $validatedData['course_id'],
                            'sub_course_point_id' => $key1,
                        ],
                        [
                            'user_id' => Auth::user()->roles()->first()->value('name') == "Admin" ? Auth::user()->id : null,
                            'trainer_id' => Auth::user()->roles()->first()->value('name') != "Admin" ? Auth::user()->id : null,
                            'sub_course_id' => optional($point_before)->sub_course_id,
                            'before' => 1,
                            'trainer_confirm_date' => Carbon::now()->toDateString(),
                            'admin_confirm_date' => Carbon::now()->toDateString(),
                        ]
                    );
                }
            }
        }
        // Handle subCourse points for 'after'
        if (!empty($request->subCourse_point_after) && is_array($request->subCourse_point_after)) {
            foreach ($request->subCourse_point_after as $key => $value) {
                $point = SubCoursePoint::find($key);

                if ($point) {
                    StudentCourseComplete::updateOrCreate(
                        [
                            'student_id' => $validatedData['student_id'],
                            'course_id' => $validatedData['course_id'],
                            'sub_course_point_id' => $key,
                        ],
                        [
                            'user_id' => Auth::user()->roles()->first()->value('name') == "Admin" ? Auth::user()->id : null,
                            'trainer_id' => Auth::user()->roles()->first()->value('name') != "Admin" ? Auth::user()->id : null,
                            'sub_course_id' => optional($point)->sub_course_id,
                            'after' => 1,
                            'trainer_confirm_date' => Carbon::now()->toDateString(),
                            'admin_confirm_date' => Carbon::now()->toDateString(),
                        ]
                    );
                }
            }
        }

        return redirect()->route('student.show', $validatedData['student_id'])->with('success', 'notification sent to admin.');
    }

}




