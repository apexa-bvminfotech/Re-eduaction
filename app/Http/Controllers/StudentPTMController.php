<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPtm;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPTMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ptmData = Student::join('student_ptm_report', 'student_ptm_report.student_id', 'students.id')->orderBy('student_ptm_report.id','DESC')->get();
        if(Auth::user()->type == 1) {
            $students = Student::
            select('students.id','students.surname', 'students.name')
                ->join('student_staff_assigns', 'student_staff_assigns.student_id', 'students.id')
                ->join('trainers','trainers.id', 'student_staff_assigns.trainer_id')
                ->join('student_ptm_report', 'student_ptm_report.student_id', 'students.id')
                ->where(['trainers.user_id' => Auth::user()->id,'student_staff_assigns.is_active' => 0])
                ->orderBy('students.id', 'DESC')->get();
        }
        return view('student_ptm.index', compact('ptmData'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::select('students.id','students.surname','students.name')->orderBy('id','DESC')->get();
        $trainers = Trainer::where('is_active', 0)->orderBy('id', 'desc')->get();

        if(Auth::user()->type == 1) {
            $students = Student::
            select('students.id','students.surname', 'students.name')
                ->join('student_staff_assigns', 'student_staff_assigns.student_id', 'students.id')
                ->join('trainers','trainers.id', 'student_staff_assigns.trainer_id')
                ->where(['trainers.user_id' => Auth::user()->id,'student_staff_assigns.is_active' => 0])
                ->orderBy('students.id', 'DESC')->get();
            $trainers = Trainer::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        }
        return view('student_ptm.create', compact('students', 'trainers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existRecord = StudentPtm::where('student_id', $request->student_id)
            ->where('date' ,'=', $request->date)
            ->first();

        if ($existRecord) {
            return back()->with('error', 'Selected date PTM is already added');
        }
        $data = [
            'date' => $request->date,
            'student_id' => $request->student_id,
            'trainer_id'=>$request->trainer_id,
            'effort_improvement'=>$request->effort_improvement,
            'next_month_plan' => $request->next_month_plan,
            'suggestion_to_parents'=>$request->suggestion_to_parents,
            'suggestion_by_parents' => $request->suggestion_by_parents,
        ];
        StudentPtm::create($data);

        return redirect()->route('student_ptm.index')
            ->with('success','PTM created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = StudentPtm::select('student_ptm_report.*', 'students.name as studentName','trainers.name as trainerName')
                ->join('trainers', 'trainers.id', 'student_ptm_report.trainer_id')
                ->join('students', 'students.id', 'student_ptm_report.student_id')
                ->where('student_ptm_report.id', $id)->first();
        return view('student_ptm.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ptmData = StudentPtm::find($id);
        $students = Student::select('students.id','students.surname','students.name')->orderBy('id','DESC')->get();
        $trainers = Trainer::where('is_active', 0)->orderBy('id', 'desc')->get();

        if(Auth::user()->type == 1) {
            $students = Student::
            select('students.id','students.surname', 'students.name')
                ->join('student_staff_assigns', 'student_staff_assigns.student_id', 'students.id')
                ->join('trainers','trainers.id', 'student_staff_assigns.trainer_id')
                ->where(['trainers.user_id' => Auth::user()->id,'student_staff_assigns.is_active' => 0])
                ->orderBy('students.id', 'DESC')->get();
            $trainers = Trainer::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        }
        if($ptmData){
            return view('student_ptm.edit',compact('ptmData','students','trainers'));
        } else {
            return view('student_ptm.create');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ptm)
    {

        $existRecord = StudentPtm::where('student_id', $request->student_id)
            ->where('date' , $request->date)
            ->where('id','!=',$ptm)
            ->first();
        if ($existRecord) {
            return back()->with('error', 'Selected date PTM is already added');
        }
        $ptmData = StudentPtm::find($ptm);
        $data = [
            'date' => $request->date,
            'student_id' => $request->student_id,
            'trainer_id'=>$request->trainer_id,
            'effort_improvement'=>$request->effort_improvement,
            'next_month_plan' => $request->next_month_plan,
            'suggestion_to_parents'=>$request->suggestion_to_parents,
            'suggestion_by_parents' => $request->suggestion_by_parents,
        ];

        $ptmData->update($data);
        return redirect()->route('student_ptm.index')
            ->with('success','Student PTM updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
