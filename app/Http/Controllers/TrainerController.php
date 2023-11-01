<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Trainer;
use App\Models\Branch;
use App\Models\Rtc;
use App\Models\Slot;
use App\Models\Student;
use App\Models\StudentStaffAssign;
use App\Models\TrainerAttendance;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class TrainerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:trainer-list|trainer-create|trainer-edit', ['only' => ['index', 'store']]);
        $this->middleware('permission:trainer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:trainer-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $trainer = Trainer::orderBy('id', 'DESC')->where('is_active','0')->with('user')->get();
        return view('trainer.index', compact('trainer'))->with('i');
    }

    public function create()
    {
        $branch = Branch::orderBy('id', 'DESC')->get();
        $course = Course::orderBy('id', 'DESC')->get();
        $roles = Role::orderBy('id', 'DESC')->get();
        $emp_id = Trainer::get()->count();
        return view('trainer.create', compact('branch', 'course', 'roles', 'emp_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|unique:trainers,emp_id',
            'surname' => 'required',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'phone' => 'required|digits:10|numeric',
            'email_id' => 'required|email|unique:users,email',
            'qualification' => 'required',
            'dob' => 'required',
            'marital_status' => 'required',
            'address' => 'required',
            'emer_fullName' => 'required|max:255',
            'emer_phone' => 'required',
            'emer_relationship' => 'required',
            'emer_address' => 'required',
            'photo' => 'nullable',
            'aadhaar_card' => 'nullable',
            'last_edu_markSheet' => 'nullable',
            'bank_passbook' => 'nullable',
            'terms_conditions' => 'required',
            'emp_type' => 'required',
            'is_active' => 'required',
        ]);

        $photo = null;
        if ($request->photo) {
            $filename = $request->photo->getClientOriginalName();
            $request->photo->move('assets/trainer', $filename);
            $photo = $filename;
        }
        $user = User::Create([
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email_id,
            'contact' => $request->phone,
            'password' => Hash::make(strtolower($request->name) . '@2121'),
            'type' => 1,
            'branch_id' => $request->input('branch_id'),
            'user_profile' => $photo,
        ]);
        $user->assignRole($request->input('role_id'));

        $aadhaar_card = null;
        if ($request->aadhaar_card) {
            $filename = $request->aadhaar_card->getClientOriginalName();
            $request->aadhaar_card->move('assets/trainer', $filename);
            $aadhaar_card = $filename;
        }
        $last_edu_markSheet = null;
        if ($request->last_edu_markSheet) {
            $filename = $request->last_edu_markSheet->getClientOriginalName();
            $request->last_edu_markSheet->move('assets/trainer', $filename);
            $last_edu_markSheet = $filename;
        }
        $bank_passbook = null;
        if ($request->bank_passbook) {
            $filename = $request->bank_passbook->getClientOriginalName();
            $request->bank_passbook->move('assets/trainer', $filename);
            $bank_passbook = $filename;
        }
        Trainer::create([
            'emp_id' => $request->emp_id,
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email_id' => $request->email_id,
            'phone' => $request->phone,
            'qualification' => $request->qualification,
            'dob' => $request->dob,
            'marital_status' => $request->marital_status,
            'address' => $request->address,
            'emer_fullName' => $request->emer_fullName,
            'emer_phone' => $request->emer_phone,
            'emer_relationship' => $request->emer_relationship,
            'emer_address' => $request->emer_address,
            'designation' => $request->designation,
            'department' => $request->department,
            'work_location' => $request->work_location,
            'emp_type' => $request->emp_type,
            'office_use_email' => $request->office_use_email,
            'joining_date' => $request->joining_date_from . ',' . $request->joining_date_to,
            'i_card_date' => $request->i_card_date,
            'i_card_return_date' => $request->i_card_return_date,
            'i_card_note' => $request->i_card_note,
            'uniform_date' => $request->uniform_date,
            'uniform_return_date' => $request->uniform_return_date,
            'uniform_note' => $request->uniform_note,
            'material_date' => $request->material_date,
            'material_return_date' => $request->material_return_date,
            'material_note' => $request->material_note,
            'offer_letter_date' => $request->offer_letter_date,
            'offer_letter_note' => $request->offer_letter_note,
            'bond_date' => $request->bond_date,
            'bond_note' => $request->bond_note,
            'petrol_allowance' => $request->petrol_allowance,
            'incentive' => $request->incentive,
            'other_allowance' => $request->other_allowance,
            'branch_id' => $request->input('branch_id'),
            'course_id' => json_encode($request->input('course_id')),
            'course_wise_material_id' => json_encode($request->input('course_material')),
            'user_id' => $user->id,
            'photo' => $photo,
            'aadhaar_card' => $aadhaar_card,
            'last_edu_markSheet' => $last_edu_markSheet,
            'bank_passbook' => $bank_passbook,
            'terms_conditions' => $request->terms_conditions,
            'terms_conditions_detail' => $request->terms_conditions_detail,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('trainer.index')->with('success', 'Trainer created successfully');
    }

    public function show(Trainer $trainer)
    {
        if (json_decode($trainer->course_id) != null){
            $trainerId = $trainer->id;
            $tarinerSlot = Slot::where('trainer_id',$trainerId)->with('rtc','slotList.student')->get();
            $courseIds = json_decode($trainer->course_id);
            $courseNames = Course::whereIn('id', $courseIds)->pluck('course_name');

            $fromDate = '';
            $toDate = '';

            if(isset($_GET['fromDate'])){
                $fromDate = $_GET['fromDate'];
            }
            if(isset($_GET['toDate'])){
                $toDate = $_GET['toDate'];
            }

            $qurey = TrainerAttendance::from('trainer_attendances')->where('trainer_id',$trainerId);

            if($fromDate != '' && $fromDate != null){
                $qurey->whereDate('date', '>=', date('Y-m-d', strtotime($fromDate)));
            }

            if($toDate != '' && $toDate != null){
                $qurey->whereDate('date', '<=',  date('Y-m-d', strtotime($toDate)));
            }

            $trainerAttendance = $qurey->with('slots')->get();

            return view('trainer.show', compact('trainer', 'courseNames','tarinerSlot','trainerAttendance','fromDate','toDate'));
        }
        else{
            return view('trainer.show', compact('trainer'));
        }
    }

    public function edit(Trainer $trainer)
    {
        $course = Course::orderBy('id', 'DESC')->get();
        $branch = Branch::orderBy('id', 'DESC')->get();
        $roles = Role::orderBy('id', 'DESC')->get();
        $user = User::where('id', $trainer->user_id)->first();
        $userRole = $user->roles->first();

        return view('trainer.edit', compact('trainer', 'branch', 'course', 'roles', 'user','userRole'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $request->validate([
            'emp_id' => 'required',
            'surname' => 'required',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'phone' => 'required|digits:10|numeric',
            'email_id' => 'required|email',
            'qualification' => 'required',
            'dob' => 'required',
            'marital_status' => 'required',
            'address' => 'required',
            'emer_fullName' => 'required|max:255',
            'emer_phone' => 'required',
            'emer_relationship' => 'required',
            'emer_address' => 'required',
            'photo' => 'nullable',
            'aadhaar_card' => 'nullable',
            'last_edu_markSheet' => 'nullable',
            'bank_passbook' => 'nullable',
            'terms_conditions' => 'required',
        ]);

        $photo = $trainer->photo;
        if ($request->hasFile('photo')) {
            if ($photo) {
                // Delete old photo if exists
                $existingFilePath = public_path('assets/trainer/' . $photo);
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
                // Upload new photo
                $filename = $request->photo->getClientOriginalName();
                $request->photo->move('assets/trainer', $filename);
                $photo = $filename;
            }
        }

        $user = $trainer->user;
        $user->update([
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email_id,
            'user_profile' => $photo,
            'contact' => $request->phone,
            'type' => 1,
            'branch_id' => $request->input('branch_id'),
        ]);

        if ($user->roles()->count() > 0) {
            if ($user->removeRole($user->roles()->first()->id)){
                $user->assignRole($request->role_id);
            }
        } else {
            $user->assignRole($request->role_id);
        }

        $aadhaar_card = $trainer->aadhaar_card;
        if ($request->hasFile('aadhaar_card')) {
            if ($aadhaar_card) {
                // Delete old adhar card if exists
                $existingFilePath = public_path('assets/trainer/' . $aadhaar_card);
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
                // Upload new adhar card
                $filename = $request->aadhaar_card->getClientOriginalName();
                $request->aadhaar_card->move('assets/trainer', $filename);
                $aadhaar_card = $filename;
            }
        }

        $last_edu_markSheet = $trainer->last_edu_markSheet;
        if ($request->hasFile('last_edu_markSheet')) {
            if ($aadhaar_card) {
                // Delete old last education marksheet if exists
                $existingFilePath = public_path('assets/trainer/' . $last_edu_markSheet);
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
                // Upload new last education marksheet
                $filename = $request->last_edu_markSheet->getClientOriginalName();
                $request->last_edu_markSheet->move('assets/trainer', $filename);
                $last_edu_markSheet = $filename;
            }
        }

        $bank_passbook = $trainer->bank_passbook;
        if ($request->hasFile('bank_passbook')) {
            if ($bank_passbook) {
                // Delete old bank passbook if exists
                $existingFilePath = public_path('assets/trainer/' . $bank_passbook);
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
                // Upload new bank passbook
                $filename = $request->bank_passbook->getClientOriginalName();
                $request->bank_passbook->move('assets/trainer', $filename);
                $bank_passbook = $filename;
            }
        }

        $trainer->update([
            'emp_id' => $request->emp_id,
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email_id' => $request->email_id,
            'phone' => $request->phone,
            'qualification' => $request->qualification,
            'dob' => $request->dob,
            'marital_status' => $request->marital_status,
            'address' => $request->address,
            'emer_fullName' => $request->emer_fullName,
            'emer_phone' => $request->emer_phone,
            'emer_relationship' => $request->emer_relationship,
            'emer_address' => $request->emer_address,
            'designation' => $request->designation,
            'department' => $request->department,
            'work_location' => $request->work_location,
            'emp_type' => $request->emp_type,
            'office_use_email' => $request->office_use_email,
            'joining_date' => $request->joining_date_from . ',' . $request->joining_date_to,
            'i_card_date' => $request->i_card_date,
            'i_card_return_date' => $request->i_card_return_date,
            'i_card_note' => $request->i_card_note,
            'uniform_date' => $request->uniform_date,
            'uniform_return_date' => $request->uniform_return_date,
            'uniform_note' => $request->uniform_note,
            'material_date' => $request->material_date,
            'material_return_date' => $request->material_return_date,
            'material_note' => $request->material_note,
            'offer_letter_date' => $request->offer_letter_date,
            'offer_letter_note' => $request->offer_letter_note,
            'bond_date' => $request->bond_date,
            'bond_note' => $request->bond_note,
            'petrol_allowance' => $request->petrol_allowance,
            'incentive' => $request->incentive,
            'other_allowance' => $request->other_allowance,
            'branch_id' => $request->input('branch_id'),
            'course_id' => $request->input('course_id') ? json_encode($request->input('course_id')) : null,
            'user_id' => $request->user_id,
            'photo' => $photo,
            'aadhaar_card' => $aadhaar_card,
            'last_edu_markSheet' => $last_edu_markSheet,
            'bank_passbook' => $bank_passbook,
            'terms_conditions' => $request->terms_conditions,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('trainer.index')->with('success', 'Trainer updated successfully');
    }

    public function destroy($id)
    {
        Trainer::where('id', $id)->delete();
        return redirect()->route('trainer.index')
            ->with('success', 'trainer deleted successfully');
    }
    public function changeTrainerStatus(Request $request)
    {
        $trainer = Trainer::find($request->trainer_id);
        $trainer->is_active = $request->status;
        $trainer->save();
        return response()->json(['success' => $request->status ? 'Trainer de-active' : 'Trainer active']);
    }

    public function changeTrainerPwd(Request $request)
    {
        $trainer = Trainer::where('id',$request->trainer_id)->with('user')->first();
        $trainer->user->password = Hash::make(strtolower($request->password));
        $trainer->user->save();

        return redirect()->back()->with('success', 'Trainer password updated successfully !!');
    }
}
