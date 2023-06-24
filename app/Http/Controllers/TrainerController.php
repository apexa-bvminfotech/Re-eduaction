<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Trainer;
use App\Models\Branch;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:trainer-list|trainer-create|trainer-edit|trainer-delete', ['only' => ['index','store']]);
        $this->middleware('permission:trainer-create', ['only' => ['create','store']]);
        $this->middleware('permission:trainer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:trainer-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $trainer = Trainer::orderBy('id','DESC')->get();
        return view('trainer.index',compact('trainer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::orderBy('id','DESC')->get();
        $course = Course::orderBy('id','DESC')->get();
        $roles = Role::orderBy('id','DESC')->get();
        return view('trainer.create',compact('branch','course','roles'));
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
            'name' => 'required|max:255',
            'branch_id'=>'required',
            'course_id'=>'required',
            'role_id'=>'required'
            ]);
        $data = [
            'name' => $request->name,
            'branch_id'=>$request->input('branch_id'),
            'course_id'=>$request->input('course_id'),
            'role_id'=>$request->input('role_id'),
            ];
//        dd($data);
        Trainer::create($data);
             return redirect()->route('trainer.index')
                 ->with('success','Trainer created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        return view('trainer.show',compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        $branch = Branch::orderBy('id','DESC')->get();
        return view('trainer.edit',compact('trainer','branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        $this->validate($request, [
            'name' => 'required',
            'branch_id'=>'required',
            'course_id'=>'required',
            'role_id'=>'required'
            ]);
        $trainer->update([
            'name' => $request->name,
            'branch_id'=>$request->input('branch_id'),
            'course_id'=>$request->input('course_id'),
            'role_id'=>$request->input('role_id'),
            ]);
        return redirect()->route('trainer.index')
            ->with('success','trainer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trainer::where('id',$id)->delete();
        return redirect()->route('trainer.index')
            ->with('success','trainer deleted successfully');
    }

}
