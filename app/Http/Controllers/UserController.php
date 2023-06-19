<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id')->where('type',0)->get();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::orderBy('id')->get();
        return view('user.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|unique:users,email|email',
        ]);
        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(strtolower($request->name) . '@2121'),
            'type' => 0,
        ]);
        $user->assignRole($request->input('role'));
        return redirect()->route('user.index') ->with('success','User created successfully');
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
    public function edit(User $user)
    {
        $role = Role::orderBy('id')->get();
        return view('user.edit',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required'
        ]);

        $user->update([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt(strtolower($request->name) . '@2121'),
           'type' => 0,
        ]);
        $user->assignRole($request->input('role'));
       return redirect()->route('user.index')->with('success','User update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user.index')
            ->with('success', 'user deleted successfully');
    }

    public function changeUserStatus(Request $request){
        $user = User::find($request->user_id);
        $user->is_active = $request->status;
        $user->save();
        return response()->json($request->status);
    }
}
