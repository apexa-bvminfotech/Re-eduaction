<?php

namespace App\Http\Controllers;

use App\Models\Appreciation;
use App\Models\Branch;
use App\Models\Course;
use App\Models\CourseWiseMaterial;
use App\Models\Slot;
use App\Models\StudentApproveLeave;
use App\Models\StudentAttendance;
use App\Models\StudentCourse;
use App\Models\StudentCourseComplete;
use App\Models\StudentDMIT;
use App\Models\StudentStatus;
use App\Models\SubCourse;
use App\Models\SubCoursePoint;
use App\Models\Trainer;
use App\Models\StudentStaffAssign;
use App\Models\StudentProxyStaffAssign;
use App\Models\Student;
use App\Models\StudentCourseMaterial;
use App\Models\User;
use App\Notifications\SendNotificationForStudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:student-list|student-create|student-edit|
        student-regular-trainer|
        student-status-list-report|
        student-assign-proxy-trainer|
        student-approved-leave|
        student-status-change|
        student-course-start|
        student-course-end|
        student-proxy-staff-edit|
        student-regular-staff-edit|
        student-approved-leave-edit|
        student-appreciation-edit', ['only' => ['index','store']]);
        $this->middleware('permission:student-create', ['only' => ['create','store']]);
        $this->middleware('permission:student-edit', ['only' => ['edit','update']]);
    }

    public function index()
    {
        $user = Auth::user();
        $slots = Slot::where('is_active', 0)->orderBy('id', 'desc')->get();
        $trainers = Trainer::where('is_active', 0)->orderBy('id', 'desc')->get();
        $students = Student::select('students.id','students.surname','students.name','students.mother_contact_no',
                        'students.standard','students.medium','students.course_id','students.user_id','branches.name as branch_name','trainers.name as trainer_name','student_courses.start_date as course_start_date','student_courses.student_id as student_id')
                    ->join('branches', 'branches.id', 'students.branch_id')
                    ->join('student_courses','student_courses.student_id','students.id')
                    ->leftJoin('student_staff_assigns','student_staff_assigns.student_id','students.id')
                    ->leftJoin('trainers','trainers.id','student_staff_assigns.trainer_id')
                    ->with('courses','studentTrainer.trainer','user')
                    ->orderBy('students.id')->get();

        if(Auth::user()->type == 1) {
            $slots = Slot::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->where('is_active','0')->get();
            $trainers = Trainer::where('branch_id', Auth::user()->branch_id)->where('is_active',0)->orderBy('id', 'desc')->get();
            $students = Student::
                select('students.surname', 'students.name','students.standard','students.medium','students.course_id','students.id','students.mother_contact_no','branches.name as branch_name')
                ->with('courses')
                ->join('branches', 'branches.id', 'students.branch_id')
                ->join('student_staff_assigns', 'student_staff_assigns.student_id', 'students.id')
                ->join('trainers','trainers.id', 'student_staff_assigns.trainer_id')
                ->where(['trainers.user_id' => Auth::user()->id,'student_staff_assigns.is_active' => 0])
                ->orderBy('students.id', 'DESC')->get();

        }
        return view('student.index', compact('students', 'trainers', 'slots'))->with('i');
    }

    public function create()
    {
        $role = Role::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $trainer = Trainer::orderBy('id')->where('is_active', 0)->get();
        $branch = Branch::orderBy('id', 'DESC')->get();
        $last_id = Student::latest()->first() ? 'RE/'.Student::get()->count() + 1 : 'RE/1';

        if(Auth::user()->type == 1) {
            $trainer = Trainer::orderBy('id')->where(['is_active' => 0, 'branch_id' => Auth::user()->branch_id])->get();
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('student.create', compact('role', 'course', 'trainer','branch','last_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_no' => 'required|unique:students,form_no',
            'registration_date' => 'required',
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'address' => 'required',
            'gender' => 'required',
            'email_id' => 'nullable|email',
            'father_contact_no' => 'required|digits:10|numeric',
            'mother_contact_no' => 'required|digits:10|numeric',
            'standard' => 'required|numeric|max:12',
            'medium' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'course_id' => 'required|exists:courses,id',
            'branch_id' => 'required',
        ]);

        $upload_student_image = null;
        if ($request->upload_student_image) {
            $filename = $request->name . '_' . date_default_timezone_get() . '.' . $request->upload_student_image->getClientOriginalExtension();
            $request->upload_student_image->move(public_path('assets/student/images'), $filename);
            $upload_student_image = $filename;
        }

        $user = User::Create([
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email_id,
            'user_profile' => $upload_student_image,
            'contact' => $request->father_contact_no,
            'password' => Hash::make(strtolower($request->name) . '@123'),
            'branch_id' => $request->input('branch_id'),
            'type' => 2,
        ]);

        $user->assignRole($request->input('role'));

        $upload_analysis = null;
        if ($request->upload_analysis) {
            $filename = $request->name . '-' . $request->upload_analysis->getClientOriginalExtension();
            $request->upload_analysis->move(public_path('assets/student/pdf'), $filename);
            $upload_analysis = $filename;
        }

        $time = $request->input('school_time_to') . " - " . $request->input('school_time_from');
        $tuition = $request->input('extra_tuition_time_to') . "-" . $request->input('extra_tuition_time_from');

        $student = Student::create([
            'form_no' => $request->form_no,
            'registration_date' => $request->registration_date,
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
            'education_board' => $request->education_board,
            'payment_condition' => $request->payment_condition,
            'counselling_by' => $request->demo_counselling_by,
            'reference_by' => $request->reference_by,
            'demo_trainer_id' => $request->demo_trainer_id ? $request->demo_trainer_id : 0,
            'branch_id' => $request->input('branch_id'),
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_trainer_id' => $request->analysis_trainer_id ? $request->analysis_trainer_id : 0,
            'upload_analysis' => $upload_analysis,
            'upload_student_image' => $upload_student_image,
            'user_id' => $user->id,
            'not_aaplicable_for_dmit' => $request->not_aaplicable_for_dmit ? '1' : '0',
            'not_aaplicable_for_course_material' => $request->not_aaplicable_for_course_material ? '1' : '0',
        ]);

        StudentStatus::create([
            'status' => 'Pending',
            'is_active' => 0,
            'date' => date('Y-m-d'),
            'student_id' => $student->id,
            'user_id' => Auth::user()->id
        ]);

        StudentDMIT::create([
            'student_id' => $student->id,
            'fp' => $request->fp ? 1 : 0,
            'fp_date' => $request->fp_date,
            'report' => $request->report ? 1 : 0,
            'report_date' => $request->report_date,
            'key_point' => $request->key_point ? 1 : 0,
            'key_point_date' => $request->key_point_date,
            'counselling_by' => $request->counselling_by ? 1 : 0,
            'counselling_date' => $request->counselling_date,
            'counselling_by_trainer' => $request->counselling_by_trainer ? 1 : 0,
            'counselling_by_trainer_name' => $request->counselling_by_trainer_name,
            'stf_gujarati' => $request->stf_gujarati,
            'stf_hindi' => $request->stf_hindi,
            'stf_english' => $request->stf_english,
            'stf_maths' => $request->stf_maths,
            'stf_self_development' => $request->stf_self_development,
            'stf_others' => $request->stf_others,
        ]);

        foreach($request->course_id as $course_id){
            $getAppreciation = Appreciation::where('course_id', $course_id)->first();
            StudentCourse::create([
                'student_id' => $student->id,
                'course_id' => $course_id,
                'user_id' => $user->id,
                'appreciation_id' => $getAppreciation ? $getAppreciation->id : null,
            ]);
        }

        if($request->course_material){
            foreach($request->course_material as $material_id){
                StudentCourseMaterial::create([
                    'student_id' => $student->id,
                    'course_material_id' => $material_id,
                ]);
            }
        }

        return redirect()->route('student.index')->with('success', 'student created successfully');
    }

    public function show($id)
    {
        $student = Student::with('courses','studentDmit.trainer','studentStatus','branch','studentMaterial.material','studentTrainer.trainer')->find($id);

        $assignStaff = StudentStaffAssign::orderBy('id','DESC')->where('student_id', $student->id)->with('Trainer', 'Slot')->get();
        $studentCompleteCourses = StudentCourseComplete::where('status',1)->where('student_id',$id)->pluck('id')->toArray();
        $approvedCourse= StudentCourseComplete::where('status',2)->where('student_id',$id)->pluck('id')->toArray();
        $proxy_staff_details = $student->proxyStaffAssignments;
        $student_appreciation = StudentCourse::orderBy('id')->where('student_id', $student->id)->With('course', 'appreciation')->get();
        $trainer = StudentStaffAssign::where(['student_id' => $id, 'is_active' => 0])->first();
        $studentAttendance = StudentAttendance::orderBy('id')->where('student_id', $student->id)->with('slot','trainer')->get();
        $student_leave_show =  StudentApproveLeave::orderBy('id')->where('student_id', $student->id)->get();

        $numberOfDaysInCurrentMonth = Carbon::now()->daysInMonth;
        $currentMonthInHead = Carbon::now()->startOfMonth();
        $currentMonthInBody = Carbon::now()->startOfMonth();
        $fromDate = '';
        $toDate = '';

        if(isset($_GET['fromDate'])){
            $fromDate = $_GET['fromDate'];
        }
        if(isset($_GET['toDate'])){
            $toDate = $_GET['toDate'];
        }

        $qurey = StudentAttendance::join('slots','students_attendance.slot_id','slots.id')->where('student_id', $student->id);

        if($fromDate != '' && $fromDate != null){
            $qurey->whereDate('attendance_date', '>=', date('Y-m-d', strtotime($fromDate)));
        }

        if($toDate != '' && $toDate != null){
            $qurey->whereDate('attendance_date', '<=',  date('Y-m-d', strtotime($toDate)));
        }

        $totalAbsentPresentStudents = $qurey->get();
        $allAbsentStudent = 0;
        $allPresentStudent = 0;
        foreach($totalAbsentPresentStudents as $key => $atd){
            if($atd->attendance_type == '0'){
                $allAbsentStudent++;
            }
            else{
                $allPresentStudent++;
            }
        }

        if($fromDate){
            $currentMonthInHead = Carbon::parse($fromDate)->startOfMonth();
            $currentMonthInBody = Carbon::parse($fromDate)->startOfMonth();
            $numberOfDaysInCurrentMonth = $currentMonthInBody->daysInMonth;
            $studentAttendances = $qurey->whereMonth('students_attendance.attendance_date', $currentMonthInHead->month)
                ->get()
                ->groupBy('slot_time');
        }
        else{
            $studentAttendances = $qurey->whereMonth('students_attendance.attendance_date', Carbon::now()->month)->get()->groupby('slot_time');
        }

        $currentMonthName = !empty($fromDate) ? Carbon::parse($fromDate)->format('F') : Carbon::now()->format('F');

        return view('student.show', compact('student','assignStaff', 'studentAttendance', 'proxy_staff_details','studentCompleteCourses','approvedCourse',
            'student_leave_show','student_appreciation','fromDate','toDate', 'trainer','studentAttendances','currentMonthName','numberOfDaysInCurrentMonth',
            'allAbsentStudent','allPresentStudent','currentMonthInHead','currentMonthInBody'));
    }

    public function delete($id)
    {
        $appreciation = StudentCourse::find($id);

        if (!$appreciation) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $appreciation->update(['appreciation_given_date' => null]);

        return response()->json(['message' => 'Date deleted successfully'], 200);

    }


    public function edit($id)
    {
        $student = Student::with('courses')->find($id);
        $assignCourse = StudentCourse::select('course_id')->where('student_id', $id)->get()->toArray();
        $courseID = [];
        foreach ($assignCourse as $c){
            array_push($courseID, $c['course_id']);
        }
        $role = Role::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $trainer = Trainer::where('is_active', 0)->orderBy('id')->get();
        $branch = Branch::orderBy('id', 'DESC')->get();
        $studentDmit = StudentDMIT::where('student_id', $id)->first();
        $studentCourseId = [];
        foreach($student->courses as $courseId){
            $studentCourseId[] = $courseId->course_id;
        }
        $courseWiseMaterial = CourseWiseMaterial::whereIn('course_id',$studentCourseId)->where('medium',$student->medium)->get();
        $selectedMaterial = StudentCourseMaterial::
            join('course_wise_materials', 'course_wise_materials.id','student_course_materials.course_material_id')
            ->where('medium',$student->medium)
            ->whereIn('course_id',$studentCourseId)
            ->where('student_id', $id)->get();
        $courseMaterialIds = $selectedMaterial->pluck('course_material_id')->toArray();

        if(Auth::user()->type == 1) {
            $trainer = Trainer::orderBy('id')->where(['is_active' => 0, 'branch_id' => Auth::user()->branch_id])->get();
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('student.edit', compact('student', 'role', 'course', 'trainer','branch', 'courseID', 'studentDmit','courseWiseMaterial','selectedMaterial','courseMaterialIds'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'address' => 'required',
            'gender' => 'required',
            'father_contact_no' => 'required|digits:10|numeric',
            'mother_contact_no' => 'required|digits:10|numeric',
            'standard' => 'required|min:1|max:12',
            'medium' => 'required',
            'dob' => 'required',
            'age' => 'required',
        ]);

        if($student->upload_student_image == null)
        {
            $upload_student_image = null;
            if ($request->upload_student_image) {
                $filename = $request->name . '_' . date_default_timezone_get() . '.' . $request->upload_student_image->getClientOriginalExtension();
                $request->upload_student_image->move(public_path('assets/student/images'), $filename);
                $upload_student_image = $filename;
            }
        }else{
            $upload_student_image = $student->upload_student_image;
            if ($request->hasFile('upload_student_image')) {
                if ($upload_student_image) {
                    // Delete old profile image if exists
                    $existingFilePath = public_path('assets/student/images/' . $upload_student_image);
                    if (file_exists($existingFilePath)) {
                        unlink($existingFilePath);
                    }
                    // Upload new profile image
                    $filename = $request->upload_student_image->getClientOriginalName();
                    $request->upload_student_image->move('assets/student/images', $filename);
                    $upload_student_image = $filename;
                }
            }
        }


        $user = $student->user;
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email_id,
            'user_profile' => $upload_student_image ? $upload_student_image : null,
            'contact' => $request->father_contact_no,
            'type' => 2,
        ]);

        if($student->upload_analysis == null)
        {
            $upload_analysis = null;
            if ($request->upload_analysis) {
                $filename = $request->name . '-' . $request->upload_analysis->getClientOriginalExtension();
                $request->upload_analysis->move(public_path('assets/student/pdf'), $filename);
                $upload_analysis = $filename;
            }
        }else{

            $upload_analysis = $student->upload_analysis;

            if ($request->hasFile('upload_analysis')) {
                if ($upload_analysis) {

                    // Delete old pdf if exists
                    $existingFilePath = public_path('assets/student/pdf/' . $upload_analysis);
                    if (file_exists($existingFilePath)) {
                        unlink($existingFilePath);
                    }
                    // Upload new pdf
                    $filename = $request->name . '-' . $request->upload_analysis->getClientOriginalExtension();
                    $request->upload_analysis->move(public_path('assets/student/pdf'), $filename);
                    $upload_analysis = $filename;
                }
            }
        }


        $time = $request->input('school_time_to') . " - " . $request->input('school_time_from');
        $tuition = $request->input('extra_tuition_time_to') . "-" . $request->input('extra_tuition_time_from');
        $user->assignRole($request->input('role'));
        $student->update([
            'form_no' => $request->form_no,
            'registration_date' => $request->registration_date,
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
            'education_board' => $request->education_board,
            'course_material_id' => json_encode($request->course_material),
            'payment_condition' => $request->payment_condition,
            'counselling_by' => $request->demo_counselling_by,
            'reference_by' => $request->reference_by,
            'demo_trainer_id' => $request->demo_trainer_id ? $request->demo_trainer_id : 0,
            'branch_id' => $request->input('branch_id'),
            'fees' => $request->fees,
            'extra_note' => $request->extra_note,
            'analysis_trainer_id' => $request->analysis_trainer_id ? $request->analysis_trainer_id : 0,
            'upload_analysis' => $upload_analysis,
            'upload_student_image' => $upload_student_image,
            'not_aaplicable_for_dmit' => $request->not_aaplicable_for_dmit ? '1' : '0',
            'not_aaplicable_for_course_material' => $request->not_aaplicable_for_course_material ? '1' : '0',
        ]);

        if($request->course_id) {
            $courseIds = StudentCourse::where('student_id', $student->id)->delete();
            foreach($request->course_id as $course_id){
                $getAppreciation = Appreciation::where('course_id', $course_id)->first();
                StudentCourse::create([
                    'student_id' => $student->id,
                    'course_id' => $course_id,
                    'user_id' => $user->id,
                    'appreciation_id' => $getAppreciation ? $getAppreciation->id : null,
                ]);
            }
        }

        $courseMaterial = StudentCourseMaterial::where('student_id', $student->id)->delete();
        if($request->course_material){
            foreach($request->course_material as $material_id){
                StudentCourseMaterial::create([
                    'student_id' => $student->id,
                    'course_material_id' => $material_id,
                ]);
            }
        }

        if($request->not_aaplicable_for_course_material){
            $courseMaterial = StudentCourseMaterial::where('student_id', $student->id)->delete();
        }

        $getDmit = $student->studentDmit;
        $getDmit->update([
            'student_id' => $student->id,
            'fp' => $request->fp ? 1 : 0,
            'fp_date' => $request->fp_date,
            'report' => $request->report ? 1 : 0,
            'report_date' => $request->report_date,
            'key_point' => $request->key_point ? 1 : 0,
            'key_point_date' => $request->key_point_date,
            'counselling_by' => $request->counselling_by ? 1 : 0,
            'counselling_date' => $request->counselling_date,
            'counselling_by_trainer' => $request->counselling_by_trainer ? 1 : 0,
            'counselling_by_trainer_name' => $request->counselling_by_trainer_name,
            'stf_gujarati' => $request->stf_gujarati,
            'stf_hindi' => $request->stf_hindi,
            'stf_english' => $request->stf_english,
            'stf_maths' => $request->stf_maths,
            'stf_self_development' => $request->stf_self_development,
            'stf_others' => $request->stf_others,
        ]);

        if($request->not_aaplicable_for_dmit){
            $getDmit = $student->studentDmit;
            $getDmit->update([
                'student_id' => $student->id,
                'fp' =>  0,
                'fp_date' => null,
                'report' => 0,
                'report_date' => null,
                'key_point' =>  0,
                'key_point_date' => null,
                'counselling_by' => 0,
                'counselling_date' => null,
                'counselling_by_trainer' =>  0,
                'counselling_by_trainer_name' => 0,
            ]);
        }

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

        $existingProxyStaff = StudentProxyStaffAssign::where(['trainer_id' => $request->trainer_id, 'slot_id' => $request->slot_id])
                ->whereDate('starting_date', now()->format('Y-m-d'))->whereDate('ending_date', now()->format('Y-m-d'))->first();
            if ($existingProxyStaff) {
                return back()->with('error', 'Trainer is already Assigned as proxy staff for this for this slot');
            }

        $student = StudentStaffAssign::where(['slot_id' => $request->slot_id, 'trainer_id' => $request->trainer_id, 'student_id' => $request->student_id] )->where('is_active', 0)->first();

        if ($student) {
                return back()->with('error', 'Trainer is already Assigned');
        } else {

            $studentUpdate = StudentStaffAssign::where(['student_id' => $request->student_id, 'is_active' => 0])->first();
            if ($studentUpdate)
            {
                $studentUpdate->update([
                    'is_active' => 1,
                ]);
            }else{

            }

            $assignStaff = new StudentStaffAssign();
            $assignStaff->student_id = $validatedData['student_id'];
            $assignStaff->trainer_id = $validatedData['trainer_id'];
            $assignStaff->slot_id = $validatedData['slot_id'];
            $assignStaff->date = Carbon::now()->toDateString();
            $assignStaff->save();
        }

        return redirect()->back()->with('success', 'Trainer assigned successfully');
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

        $existingStudentProxySlot = StudentProxyStaffAssign::where('student_id', $request->student_id)
            ->whereDate('starting_date' ,'<=', $request->starting_date)
            ->whereDate('ending_date', '>=', $request->ending_date)
            ->first();

        if ($existingStudentProxySlot) {
            return back()->with('error', 'Student have already proxy slot for the specified dates');
        }

        // $existingProxyStaff = StudentProxyStaffAssign::where('student_id', $request->student_id)
        //     ->whereDate('starting_date' ,'<=', $request->starting_date)
        //     ->whereDate('ending_date', '>=', $request->ending_date)
        //     ->where('trainer_id',  $request->trainer_id)
        //     ->first();

        // if ($existingProxyStaff) {
        //     return back()->with('error', 'Trainer is already assigned as proxy staff for the specified dates');
        // }

        $checkIsregularTrainer = StudentStaffAssign::where(['trainer_id' => $request->trainer_id, 'slot_id' => $request->slot_id , 'is_active' => 0])->first();
        if($checkIsregularTrainer) {
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
            'sub_course_id' => 'nullable|array',
            'sub_course_point_id ' => 'nullable|array',
            'subCourse_before' => 'nullable|array',
            'subCourse_after' => 'nullable|array',
            'subCourse_point_after' => 'nullable|array',
            'subCourse_point_before' => 'nullable|array',
        ]);

        StudentCourseComplete::where('student_id',$request->student_id)->where('trainer_id',$request->trainer_id)->where('course_id',$request->course_id)->update(['status'=>1]);

            if($request->subCourse_point_approve){
                foreach ($request->subCourse_point_approve as $items){
                    foreach ($items as $key=>$item){
                        $studentCompleteCourse = StudentCourseComplete::find($key);
                        if(isset($studentCompleteCourse)){
                            $studentCompleteCourse->status = 2;
                            $studentCompleteCourse->admin_confirm_date = Carbon::now()->toDateString();
                            $studentCompleteCourse->save();
                        }
                    }
                }
            }

            if (!empty($request->subCourse_before) && is_array($request->subCourse_before)) {
                foreach ($request->subCourse_before as $subCourse_before) {
                    foreach($subCourse_before as $subCourseBefore_key => $subCourseBefore_value){
                        $subCourseBefore = SubCourse::find($subCourseBefore_key);
                        if ($subCourseBefore) {
                            StudentCourseComplete::updateOrCreate(
                                [
                                    'student_id' => $validatedData['student_id'],
                                    'course_id' => $validatedData['course_id'],
                                    'sub_course_id' => $subCourseBefore_key,
                                ],
                                [
                                    'user_id' => Auth::user()->id,
                                    'trainer_id' => $request->trainer_id,
                                    'before' => 1,
                                ]
                            );
                        }
                    }
                }
            }

            // Handle 'after' checkboxes for subCourses
            if (!empty($request->subCourse_after) && is_array($request->subCourse_after)) {
                foreach ($request->subCourse_after as $subCourse_after) {
                    foreach ($subCourse_after as $subCourseAfter_key => $subCourseAfter_value) {
                        $subCourseAfter = SubCourse::find($subCourseAfter_key);

                        if ($subCourseAfter) {
                            StudentCourseComplete::updateOrCreate(
                                [
                                    'student_id' => $validatedData['student_id'],
                                    'course_id' => $validatedData['course_id'],
                                    'sub_course_id' => $subCourseAfter_key,

                                ],
                                [
                                    'user_id' => Auth::user()->id,
                                    'trainer_id' => $request->trainer_id,
                                    'after' => 1,
                                    'trainer_confirm_date' => Carbon::now()->toDateString(),
                                ]
                            );
                        }
                    }
                }
            }

            // Handle subCourse points for 'before'
            if (!empty($request->subCourse_point_before) && is_array($request->subCourse_point_before)) {
                foreach ($request->subCourse_point_before as $subCourse_point_before) {
                    foreach ($subCourse_point_before as $key1 => $value1) {
                        $point_before = SubCoursePoint::find($key1);
                        if ($point_before) {
                            StudentCourseComplete::updateOrCreate(
                                [
                                    'student_id' => $validatedData['student_id'],
                                    'course_id' => $validatedData['course_id'],
                                    'sub_course_point_id' => $key1,
                                ],
                                [
                                    'user_id' => Auth::user()->id,
                                    'trainer_id' => $request->trainer_id,
                                    'sub_course_id' => optional($point_before)->sub_course_id,
                                    'before' => 1,
                                ]
                            );
                        }
                    }
                }
            }

            // Handle subCourse points for 'after'
            if (!empty($request->subCourse_point_after) && is_array($request->subCourse_point_after)) {
                foreach ($request->subCourse_point_after as $subCourse_point_after) {

                    foreach ($subCourse_point_after as $key => $value) {
                        $point = SubCoursePoint::find($key);

                        if ($point) {
                            StudentCourseComplete::updateOrCreate(
                                [
                                    'student_id' => $validatedData['student_id'],
                                    'course_id' => $validatedData['course_id'],
                                    'sub_course_point_id' => $key,
                                ],
                                [
                                    'user_id' => Auth::user()->id,
                                    'trainer_id' => $request->trainer_id,
                                    'sub_course_id' => optional($point)->sub_course_id,
                                    'after' => 1,
                                    'trainer_confirm_date' => Carbon::now()->toDateString(),
                                ]
                            );
                        }
                    }
                }
            }
            $status = 1;

            StudentCourseComplete::where('student_id', $validatedData['student_id'])
                ->where('status','!=',2)
                ->where('course_id', $validatedData['course_id'])
                ->update(['status' => $status]);

            $users = User::where('type', 0)->orderBy('id', 'ASC')->get();
            if($users->count() >0){
                foreach($users as $u){
                    $u->notify(new SendNotificationForStudentCourse());
                }
            }

        return redirect()->route('student.show', $validatedData['student_id'])->with('success', 'notification sent to admin.');
    }

    public function trainerProxySlot($id){
        $trainer_proxy_slot = Slot::where(['trainer_id' => $id, 'is_active' => 0])->get();
        return response()->json(['slots' => $trainer_proxy_slot]);
    }

    public function editProxySlot(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'trainer_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'starting_date' => 'required',
            'ending_date' => 'required',
        ]);

        $checkIsregularTrainer = StudentStaffAssign::where(['trainer_id' => $request->trainer_id, 'slot_id' => $request->slot_id , 'is_active' => 0])->first();
        if($checkIsregularTrainer) {
            return back()->with('error', 'Trainer is already assigned as regular staff');
        }

        $studentProxyStaffAssign = StudentProxyStaffAssign::where(['trainer_id' => $request->trainer_id, 'slot_id' => $request->old_slot_id , 'student_id' => $request->student_id])->first();

        StudentProxyStaffAssign::where('id',$studentProxyStaffAssign->id)->update([
            'student_id' => $request->student_id,
            'trainer_id' => $request->trainer_id,
            'slot_id' => $request->slot_id,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
        ]);

        return redirect()->back()->with('success', 'Slot is Edited Successfully !!');
    }

    public function trainerRegularSlot($id){
        $trainer_regular_slot = Slot::where(['trainer_id' => $id, 'is_active' => 0])->get();
        return response()->json(['slots' => $trainer_regular_slot]);
    }

    public function editRegularSlot(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'trainer_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'date' => 'required',
        ]);

        // $checkIsregularTrainer = StudentStaffAssign::where(['trainer_id' => $request->trainer_id, 'slot_id' => $request->slot_id , 'is_active' => 0])->first();
        // if($checkIsregularTrainer) {
        //     return back()->with('error', 'Trainer is already assigned as regular staff');
        // }

        $studentStaffAssign = StudentStaffAssign::where(['trainer_id' => $request->trainer_id, 'slot_id' => $request->old_slot_id , 'student_id' => $request->student_id, 'is_active' => 0])->first();
        StudentStaffAssign::where('id',$studentStaffAssign->id)->update([
            'student_id' => $request->student_id,
            'trainer_id' => $request->trainer_id,
            'slot_id' => $request->slot_id,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Slot is Edited Successfully !!');
    }

    public function studentLeaveApprove(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
        ]);

        $existingProxyStaff = StudentApproveLeave::where('student_id', $request->student_id)
            ->whereDate('start_date' ,'<=', $request->start_date)
            ->whereDate('end_date', '>=', $request->end_date)
            ->first();

        if ($existingProxyStaff) {
            return back()->with('error', 'Selected date leave is already added');
        }

        $user_id = Auth::id();
            $approve = new StudentApproveLeave();
            $approve->student_id = $request->student_id;
            $approve->user_id = $user_id;
            $approve->start_date = $request->start_date;
            $approve->end_date = $request->end_date;
            $approve->reason = $request->reason;
            $approve->save();

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $datesInBetween = [];
        while ($startDate <= $endDate) {
            $datesInBetween[] = $startDate->format('Y-m-d');
            $startDate->addDay();
        }

        $studentStaffAssign = StudentStaffAssign::where('student_id',$request->student_id)->where('is_active','0')->first();

        foreach($datesInBetween as $adate){
            $studentAttendance = new StudentAttendance();
            $studentAttendance->student_id = $request->student_id;
            $studentAttendance->attendance_type = 0;
            $studentAttendance->user_id = $user_id;
            $studentAttendance->trainer_id = $studentStaffAssign->trainer_id;
            $studentAttendance->slot_id = $studentStaffAssign->slot_id;
            $studentAttendance->slot_type = 'Regular';
            $studentAttendance->attendance_date = $adate;
            $studentAttendance->save();
        }
        return redirect()->route('student.index')->with('success', 'Leave Approved');
    }

    public function editStudentLeaveApprove(Request $request)
    {
        $existingProxyStaff = StudentApproveLeave::where('student_id', $request->student_id)
            ->whereDate('start_date' , $request->start_date)
            ->whereDate('end_date', $request->end_date)
            ->where('reason', $request->reason)
            ->first();

        if ($existingProxyStaff) {
            return back()->with('error', 'Selected date leave is already added');
        }
        $updateData = StudentApproveLeave::find($request->leave_id);

        $startDate = Carbon::parse($updateData->start_date);
        $endDate = Carbon::parse($updateData->end_date);

        $datesInBetween = [];
        while ($startDate <= $endDate) {
            $datesInBetween[] = $startDate->format('Y-m-d');
            $startDate->addDay();
        }

        $updateData->update([
            'student_id' => $request->student_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'user_id' => Auth::id(),
        ]);
        $user_id = Auth::id();

        $studentStaffAssign = StudentStaffAssign::where('student_id',$request->student_id)->where('is_active','0')->first();
        $studentAttendances=  StudentAttendance::where('student_id', $request->student_id)->where('user_id',$user_id)
//            ->where('trainer_id',$request->trainer_id)
            ->whereIn('attendance_date',$datesInBetween)->get();
        foreach($studentAttendances as $attendance){
            $attendance->delete();
        }


        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $datesInBetween = [];
        while ($startDate <= $endDate) {
            $datesInBetween[] = $startDate->format('Y-m-d');
            $startDate->addDay();
        }

        foreach($datesInBetween as $adate){
            $studentAttendance = new StudentAttendance();
            $studentAttendance->student_id = $request->student_id;
            $studentAttendance->attendance_type = 0;
            $studentAttendance->user_id = $user_id;
            $studentAttendance->trainer_id = $studentStaffAssign->trainer_id;
            $studentAttendance->slot_id = $studentStaffAssign->slot_id;
            $studentAttendance->slot_type = 'Regular';
            $studentAttendance->attendance_date = $adate;
            $studentAttendance->save();
        }

        return redirect()->route('student.index')->with('success', 'Edit student leave data');
    }

    public function getLeaveData($id){
        $leaveData = StudentApproveLeave::find($id);
        return $leaveData;
    }

    public function ChangeStudentStatus(Request $request) {
        StudentStatus::where('student_id', $request->student_id)->update(['is_active' => 1]);
        StudentStatus::create([
           'status' => $request->status,
           'is_active' => 0,
           'trainer_name' => $request->trainer_name,
           'cancel_reason' => $request->cancel_reason,
           'hold_reason' => $request->hold_reason,
            'date' => \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d')),
            //  'date'=> $request->date,
            'hold_date' => $request->hold_date,
            'cancel_date' => $request->cancel_date,
           'student_id' => $request->student_id,
           'user_id' => Auth::id(),
        ]);

        $student = Student::where('id', $request->student_id)->first();

        if ($student) {
            $student->update(['course_status' => $request->status]);
        } else {
            Student::create([
                'id' => $request->student_id,
                'course_status' => $request->status,
            ]);
        }

        return redirect()->route('student.index')->with('success', 'Student status change');
    }

    public function changeStudentPwd(Request $request)
    {
        $student = Student::where('id',$request->student_id)->with('user')->first();
        $student->user->password = Hash::make(strtolower($request->password));
        $student->user->save();

        return redirect()->back()->with('success', 'Student password updated successfully !!');
    }

    public function studentAppreciation(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'student_course_appreciation_id' => 'required|integer',
            'appreciation_given_date' => 'required'
        ]);

        $studentId = $request->student_id;

        StudentCourse::where('id',$request->student_course_appreciation_id)->update([
            'appreciation_given_date' => $request->appreciation_given_date
        ]);

        return redirect()->route('student.show',$studentId)->with('success', 'Appreciate Given Succesfully');
    }

    public function getCourseMaterialData(Request $request)
    {
        $material_data = [];
        $course_id = $request->course_id;
        $medium_id = $request->medium_id;
        $course_material_string = explode(",",$request->course_material_string);

        $data = CourseWiseMaterial::whereIn('course_id',$course_id)->where('medium',$medium_id)->get();
        foreach ($data as $d) {
            $check = '';

            if(in_array($d->id, $course_material_string)){
                $check = 'checked="checked"';
            }
            $material_data[] = '<div class="form-check form-check-inline">
                <input type="checkbox" value="'.$d->id.'" name="course_material[]" class="form-check course_material" id="course_material" data-course-id="'.$d->course_id.'" '.$check.'>
                    <label class="form-check-label" for="medium_gujarati">&nbsp;&nbsp;
                        '. $d->material_name .'
                    </label>
            </div><br>';
        }
        return $material_data;
    }

    public function updateCourseStartEndDate($student_id, $course_id, $task)
    {

        if($task == "start_task"){
             StudentCourse::where('student_id',$student_id)
            ->where('course_id',$course_id)->update([
                'start_date' =>  date('Y-m-d'),
                ]);
            return response()->json(['success' => true, 'course_id' => $course_id]);
        }
        else{
            StudentCourse::where('student_id',$student_id)
            ->where('course_id',$course_id)->update([
                'end_date' => date('Y-m-d'),
                ]);
            return response()->json(['success' => false, 'course_id' => $course_id]);
        }
    }

    public function restartCourse($student_id, $course_id)
    {
        StudentCourse::where('student_id',$student_id)->where('course_id',$course_id)->update([
                'end_date' =>  null,
                'restart_date' =>  date('Y-m-d'),
            ]);
        return response()->json(['success' => true, 'course_id' => $course_id]);
    }


    public function coursedate(Request $request, $student_id, $course_id)
    {
        $student_course = StudentCourse::where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->first();

        if ($student_course) {
            // Update only the fields that are present in the request
            if ($request->has('start_date')) {
                $student_course->start_date = $request->start_date;
            }

            if ($request->has('end_date')) {
                $student_course->end_date = $request->end_date;
            }

            if ($request->has('restart_date')) {
                $student_course->restart_date = $request->restart_date;
            }

            $student_course->save();

            return redirect()->back()->with(['success' => 'Your Date Update Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Record not found']);
        }
    }


}





