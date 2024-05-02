<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::orderBy('id', 'ASC')->get();
        if(Auth::user()->type == 3){
            $users = User::where('type', 3)->orderBy('id', 'ASC')->get();

        }else{
            $users = User::whereIn('type', [0, 3])->orderBy('id', 'ASC')->get();
        }

        return view('user.index', compact('users', 'branches'))->with('i');
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
        return view('user.create', compact('role', 'branches'));
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
        'password' => 'required|string',
        'contact' => 'required|digits:10|numeric',
        'is_active' => 'required',
        'user_profile' => 'nullable|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user_profile = null;
    if ($request->user_profile) {
        $filename = $request->user_profile->getClientOriginalName();
        $request->user_profile->move('assets/user', $filename);
        $user_profile = $filename;
    }

    $role = Role::findOrFail($request->input('role')); // Get the role object

    $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'father_name' => $request->father_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_profile' => $user_profile,
        'contact' => $request->contact,
        'branch_id' => $request->branch_id ? $request->branch_id : 0,
        'type' => $role->name == "Admin" ? 0 : ($role->name == "Sub-Admin" ? 3 : null),
    ]);

    $user->assignRole($role); // Assign the role object directly

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
        $password = Hash::make($user->password);
        return view('user.edit', compact('user', 'role', 'branches','password'));
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
            'user_profile' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'contact' => 'required|digits:10|numeric',
            'is_active' => 'required',
        ]);

        $user_profile = $user->user_profile;
        if ($request->hasFile('user_profile') && $request->file('user_profile')->isValid()) {
            if ($user_profile) {
                // Delete old profile image if exists
                $existingFilePath = public_path('assets/user/' . $user_profile);
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
                // Upload new profile image
                $filename = $request->file('user_profile')->getClientOriginalName();
                $request->file('user_profile')->move(public_path('assets/user'), $filename);
                $user_profile = $filename;
            }
        }
        $role = Role::findOrFail($request->input('role'));
        $user->update([
            'surname' => $request->surname,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_profile' => $user_profile,
            'contact' => $request->contact,
            'branch_id' => $request->branch_id ? $request->branch_id : 0,
            'type' => $role->name == "Admin" ? 0 : ($role->name == "Sub-Admin" ? 3 : null),
            'is_active' => $request->is_active,
        ]);
        $user->assignRole($role);
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

    public function profile()
    {
        $branches = Branch::orderBy('id', 'ASC')->get();
        $user = User::find(Auth::user()->id);
        return view('layouts.profile', compact('user','branches'));
    }
    public function updateProfileImage(Request $request, User $user)
    {
        $request->validate([
            'new_profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Delete old profile image if exists
        if ($user->user_profile) {
            Storage::delete('public/assets/user/' . $user->user_profile);
        }

        // upload new profile
        $image = null;
        if ($request->new_profile_image) {
            $filename = $request->new_profile_image->getClientOriginalName();
            $request->new_profile_image->move('assets/user', $filename);
            $image = $user->update(['user_profile' => $filename]);
        }

        return redirect()->back()->with('success', 'Profile image updated successfully');
    }
}
