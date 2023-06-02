<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:staff-list|staff-create|staff-edit|staff-delete', ['only' => ['index','store']]);
        $this->middleware('permission:staff-create', ['only' => ['create','store']]);
        $this->middleware('permission:staff-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:staff-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::orderBy('id','DESC')->paginate(5);
        return view('staff.index',compact('staff'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::orderBy('id', 'DESC')->get();
        return view('staff.create',compact('role'));
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
            'employee_ID' => 'required|unique:staff,employee_ID',
            'first_name' => 'required',
            'staff_name' => 'required',
            'father_name' => 'required',
            'staff_phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'staff_address' => 'required',
            'eme_phone' => 'required',
            'course_id' => 'required',
            'roles' => 'required',
        ]);
        $staff_name = str_replace(' ', '_', $request->staff_name);
        $user = User::create([
            'name'=>$request->staff_name,
            'email'=> $request->email,
            'password'=> bcrypt(strtolower($staff_name).'@2121'),
            'type'=> 1,
        ]);
        $user->assignRole($request->input('roles'));

        $data = [
            'first_name' => $request->first_name,
            'staff_name' => $request->staff_name,
            'father_name' => $request->father_name,
            'staff_phone' => $request->staff_phone,
            'course_id' => json_encode($request->course_id),
            'employee_ID' => $request->employee_ID,
            'staff_I_card' => isset($request->staff_i_card) ? 1 : 0,
            'staff_uniform' => isset($request->staff_uniform) ? 1 : 0,
            'staff_address' => $request->staff_address,
            'eme_phone' => $request->eme_phone,
            'user_id' => $user->id
        ];
        Staff::create($data);

        return redirect()->route('staff.index')
            ->with('success','Staff created successfully');
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
    public function edit($id)
    {
        $role = Role::orderBy('id', 'DESC')->get();
        $staff = Staff::select('staff.*', 'users.email')
                -> join('users', 'users.id', 'staff.user_id')
                ->find($id);
        $user = User::where('id', $staff->user_id)->first();
        $userRole = $user->roles->first();
        if($staff){
            return view('staff.edit',compact('staff','role', 'userRole'));
        } else {
            return view('staff.create');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'staff_name' => 'required',
            'father_name' => 'required',
            'staff_phone' => 'required',
            'staff_address' => 'required',
            'eme_phone' => 'required',
            'course_id' => 'required',
            'roles' => 'required',
        ]);
        $staff_name = str_replace(' ', '_', $request->staff_name);
        $user = User::find($request->user_id);
        $user->update([
            'name'=>$request->staff_name,
            'email'=> $request->email,
            'password'=> bcrypt(strtolower($staff_name).'@2121'),
        ]);
        $user->assignRole($request->input('roles'));

        $staff->update([
            'first_name' => $request->first_name,
            'staff_name' => $request->staff_name,
            'father_name' => $request->father_name,
            'staff_phone' => $request->staff_phone,
            'course_id' => json_encode($request->course_id),
            'staff_I_card' => isset($request->staff_i_card) ? 1 : 0,
            'staff_uniform' => isset($request->staff_uniform) ? 1 : 0,
            'staff_address' => $request->staff_address,
            'eme_phone' => $request->eme_phone,
        ]);

        return redirect()->route('staff.index')
            ->with('success','Staff updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::where('id',$id)->delete();
        return redirect()->route('staff.index')
            ->with('success','Staff deleted successfully');
    }
}
