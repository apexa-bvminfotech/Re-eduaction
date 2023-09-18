<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::orderBy('id','DESC')->get();
        return view('branch.index', compact('branches'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branch.create');
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
            'name' => 'required|max:255',
            'address' => 'required',
            'authorized_person_name' => 'required',
            'authorized_person_contact' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
        ]);
        $branch = Branch::Create([
            'name' => $request->name,
            'address' => $request->address,
            'authorized_person_name' => $request->authorized_person_name,
            'authorized_person_contact' => $request->authorized_person_contact
        ]);

        return redirect()->route('branch.index')->with('success', 'Branch Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('branch.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'authorized_person_name' => 'required',
            'authorized_person_contact' => 'required|regex:/[0-9]{5}[\s]{1}[0-9]{5}/',
        ]);
        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            'authorized_person_name' => $request->authorized_person_name,
            'authorized_person_contact' => $request->authorized_person_contact,
        ]);

        return redirect()->route('branch.index')->with('success', 'Branch Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }

    public function changeBranchStatus(Request $request)
    {
        $branch = Branch::find($request->branch_id);
        $branch->is_active = $request->status;
        $branch->save();
        return response()->json(['success' => $request->status ? 'Branch de-active' : 'Branch active']);
    }
}
