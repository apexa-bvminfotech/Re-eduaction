<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Trainer;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class TrainerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:trainer-list|trainer-create|trainer-edit|trainer-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:trainer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:trainer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:trainer-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $trainer = Trainer::orderBy('id', 'DESC')->get();
        return view('trainer.index', compact('trainer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::orderBy('id', 'DESC')->get();
        $course = Course::orderBy('id', 'DESC')->get();
        $roles = Role::orderBy('id', 'DESC')->get();
        $emp_id = Trainer::get()->count();
        return view('trainer.create', compact('branch', 'course', 'roles', 'emp_id'));
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
        $request->validate([
            'surname' => 'required',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'phone' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'email' => 'required|email|unique:users,email',
            'qualification' => 'required',
            'dob' => 'required',
            'marital_status' => 'required',
            'address' => 'required',
            'emer_fullName' => 'required|max:255',
            'emer_phone' => 'required',
            'emer_relationship' => 'required',
            'emer_address' => 'required',
            'photo' => 'required',
            'aadhaar_card' => 'required',
            'last_edu_markSheet' => 'required',
            'bank_passbook' => 'required',
            'terms_conditions' => 'required',
        ]);

        $user = User::Create([
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'contact' => $request->phone,
            'password' => Hash::make(strtolower($request->name) . '@123'),
            'type' => 1,
            'branch_id' => $request->input('branch_id'),
        ]);
        $user->assignRole($request->input('role_id'));

        $photo = null;
        if ($request->photo) {
            $filename = $request->photo->getClientOriginalName();
            $request->photo->move('assets/trainer', $filename);
            $photo = $filename;
        }
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
            'email' => $request->email,
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
            'user_id' => $user->id,
            'photo' => $photo,
            'aadhaar_card' => $aadhaar_card,
            'last_edu_markSheet' => $last_edu_markSheet,
            'bank_passbook' => $bank_passbook,
            'terms_conditions' => $request->terms_conditions,
        ]);

        return redirect()->route('trainer.index')
            ->with('success', 'Trainer created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        return view('trainer.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        $course = Course::orderBy('id', 'DESC')->get();
        $branch = Branch::orderBy('id', 'DESC')->get();
        $roles = Role::orderBy('id', 'DESC')->get();
        $user = User::where('id', $trainer->user_id)->first();
        $userRole = $user->roles->first();
        $selectedCourses = $trainer->course_id;

        return view('trainer.edit', compact('trainer', 'branch', 'course', 'roles', 'user', 'userRole', 'selectedCourses'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
//dd($request->all());
        $request->validate([
            'surname' => 'required',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'phone' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'email' => 'required|email|unique:trainers,email,' . $trainer->id,
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
        $user = $trainer->user;
        $user->update([
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'contact' => $request->phone,
            'password' => Hash::make(($request->name) . '@123'),
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

        $photo = $trainer->photo;
        if ($request->photo) {
            $filename = $request->photo->getClientOriginalName();
            $request->photo->move('assets/trainer', $filename);
            $photo = $filename;
        }
        $aadhaar_card = $trainer->aadhaar_card;
        if ($request->aadhaar_card) {
            $filename = $request->aadhaar_card->getClientOriginalName();
            $request->aadhaar_card->move('assets/trainer', $filename);
            $aadhaar_card = $filename;
        }
        $last_edu_markSheet = $trainer->last_edu_markSheet;
        if ($request->last_edu_markSheet) {
            $filename = $request->last_edu_markSheet->getClientOriginalName();
            $request->last_edu_markSheet->move('assets/trainer', $filename);
            $last_edu_markSheet = $filename;
        }
        $bank_passbook = $trainer->bank_passbook;
        if ($request->bank_passbook) {
            $filename = $request->bank_passbook->getClientOriginalName();
            $request->bank_passbook->move('assets/trainer', $filename);
            $bank_passbook = $filename;
        }

        $trainer->update([
            'emp_id' => $request->emp_id,
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
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
        ]);

        return redirect()->route('trainer.index')
            ->with('success', 'Trainer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trainer::where('id', $id)->delete();
        return redirect()->route('trainer.index')
            ->with('success', 'trainer deleted successfully');
    }

}
