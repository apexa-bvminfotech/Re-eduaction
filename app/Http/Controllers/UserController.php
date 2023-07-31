<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        $users = User::where('type', 0)->orderBy('id', 'DESC')->get();
        return view('user.index', compact('users','branches'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::orderBy('id')->get();
        $role = Role::orderBy('id')->get();
        return view('user.create', compact('role','branches'));
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
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'father_name' => 'required|max:255',
            'email' => 'nullable',
            'contact' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'role' => 'required',
            'is_active' => 'required'
        ]);

        $user = User::Create([
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'password' => bcrypt(strtolower($request->name) . '@2121'),
            'contact' => $request->contact,
            'branch_id' => $request->branch_id ? $request->branch_id : 0,
            'type' => 0,
            'is_active' => $request->is_active,
        ]);
        $user->assignRole($request->input('role'));
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $branches = Branch::orderBy('id')->get();
        $role = Role::orderBy('id')->get();
        return view('user.edit', compact('user', 'role','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'contact' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
            'role' => 'required',
        ]);

        $user->update([
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'password' => bcrypt(strtolower($request->name) . '@2121'),
            'contact' => $request->contact,
            'branch_id' => $request->branch_id ? $request->branch_id : 0,
            'type' => 0,
            'is_active' => $request->is_active,
        ]);
        $user->assignRole($request->input('role'));
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user.index')
            ->with('success', 'user deleted successfully');
    }

    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_active = $request->status;
        $user->save();
        return response()->json(['success' => $request->status ? 'User de-active' : 'User active']);
    }

    public function profile(){
        $user = User::find(Auth::user()->id);
        return view('layouts.profile', compact('user'));
    }
}
