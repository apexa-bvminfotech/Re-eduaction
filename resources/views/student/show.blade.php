@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Show Student Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student.index') }}">Show Student
                                    List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset( $student->upload_student_image )}}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$student->surname}} {{$student->name}}</h3>
                                <p class="text-muted text-center">Student</p>
                                <ul class="list-group  mb-3">
                                    <li class="list-group-item">
                                        <b>Course:</b>
                                        <a class="float-right">
{{--                                            {{$student->course->course_name}}--}}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Demo taken:</b> <a class="float-right">{{$student->trainer->name ?? ''}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2 d-flex">
                                <ul class="nav nav-pills col-11">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">School Detail</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#proxy_detail" data-toggle="tab">Proxy staff Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline1" data-toggle="tab">Assign Staff</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline2" data-toggle="tab">Student Attendance Show</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#student_leave" data-toggle="tab">Student Leave List</a></li>
                                </ul>
                                <a href="{{ route('student.index') }}" class="col-1 btn btn-primary float-right">Back</a>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="post">
                                            {{--                                            @dd($student)--}}
                                            <table class="table border-bottom">
                                                <tr>
                                                    <th><b>Father Contact No:</b></th>
                                                    <td>{{$student->father_contact_no}}</td>
                                                    <th><b>Mother Contact No:</b></th>
                                                    <td>{{$student->mother_contact_no}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Gender:</b></th>
                                                    <td>{{$student->gender}}</td>
                                                    <th><b>Email ID:</b></th>
                                                    <td>{{$student->email_id}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Address:</b></th>
                                                    <td>{{$student->address}}</td>
                                                    <th><b>School Name:</b></th>
                                                    <td>{{$student->school_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Standard:</b></th>
                                                    <td>{{$student->standard}}</td>
                                                    <th><b>Medium:</b></th>
                                                    <td>{{$student->medium}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>School Time:</b></th>
                                                    <td>{{$student->school_time}}</td>
                                                    <th><b>Extra Tuition Time:</b></th>
                                                    <td>{{$student->extra_tuition_time}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Date Of Birth:</b></th>
                                                    <td>{{$student->dob}}</td>
                                                    <th><b>Age:</b></th>
                                                    <td>{{$student->age}}</td>
                                                </tr>
                                                <tr class="border-bottom">
                                                    <th><b>Fees:</b></th>
                                                    <td>{{$student->fees}}</td>
                                                    <th><b>Extra Note:</b></th>
                                                    <td>{{$student->extra_note}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Upload PDF:</b></th>
                                                    <td>{{$student->upload_analysis}}</td>
                                                    <th><b>Courses:</b></th>
{{--                                                    <td>{{$student->course->course_name}}</td>--}}
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="timeline">
                                        <div class="post">
                                            <table class="table">
                                                <tr>
                                                    <th><b>Reference By:</b></th>
                                                    <td>{{$student->reference_by}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Role:</b></th>
                                                    <td>{{$student->user->roles->first()->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Payment Condition:</b></th>
                                                    <td>{{$student->payment_condition}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Analysis Staff Name:</b></th>
                                                    <td>{{$student->trainer->name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Demo Taken By:</b></th>
                                                    <td>{{$student->trainer->name ?? ''}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="proxy_detail">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>ProxyTrainer Name:</b></th>
                                                    <th><b>Slot Time:</b></th>
                                                    <th><b>Starting Date:</b></th>
                                                    <th><b>Ending Date:</b></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($proxy_staff_details as $psd)
                                                    <tr>
                                                        <td>{{$psd->trainer->name}}</td>
                                                        <td>{{$psd->slot->slot_time}}</td>
                                                        <td>{{$psd->starting_date}}</td>
                                                        <td>{{$psd->ending_date}}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="timeline1">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>Assign Staff name</b></th>
                                                    <th><b>Slot:</b></th>
                                                    <th><b>Date:</b></th>
                                                    <th><b>Status</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($assignStaff as $key => $as)
                                                    <tr>
                                                        <td>{{$as->trainer->name}}</td>
                                                        <td>{{$as->slot->slot_time}}</td>
                                                        <td>{{$as->date}}</td>
                                                        <td>{!! $as->is_active == 0 ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="timeline2">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>Absent Date:</b></th>
                                                    <th><b>Absent Reason:</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($studentAttendance as $key => $st)
                                                    @if ($st->absent_reason)
                                                        <tr>
                                                            <td>{{$st->attendance_date}}</td>
                                                            <td>{{$st->absent_reason}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="student_leave">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><b>Leave Date From:</b></th>
                                                        <th><b>Leave Date To:</b></th>
                                                        <th><b>Reason:</b></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($student_leave_show as $leave)
                                                        <tr>
                                                            <td>{{$leave->start_date}}</td>
                                                            <td>{{$leave->end_date}}</td>
                                                            <td>{{$leave->reason}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark"><b><i>Courses</i></b></h4></div>
                    <div class="row">
                        <div class="col-sm-1">

                        </div>
                        <div class="col-sm-6">
                            <div class="card-body">
                                <form action="{{route('student.sendNotification')}}" method="POST">
                                    @csrf
                                    @foreach($student->courses as $student_course)
                                        <a class="btn btn-success">Start</a>
                                        <a class="btn btn-primary">End Task</a>
                                        <table class="table table-bordered table-striped" id="courseTable" >
                                            <input type="hidden" name="student_id" class="form-control student_id" value="{{$student->id}}">
                                            <input type="hidden" name="course_id" class="form-control course_id" value="{{$student_course->course_id}}">
                                            <tr>
                                                <td class="text-center">Before</td>
                                                <td></td>
                                                <td class="text-center">After</td>
                                                <td>
                                                    Date
                                                </td>
                                            </tr>
                                            {{-- //subCourse before after--}}
                                            @foreach($student_course->course->subcourses as $key =>$sc)
                                                <tr>
                                                    <th class="bg-info">
                                                        <!--Before-->
                                                        @if($sc->points->count() == 0)
                                                            <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                @can('student-course-complete-before')
                                                                    <input @if($sub_course=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'before'=>1])->first()) checked disabled @endif
                                                                    type="checkbox" class="form-check-input sub-course-checkbox_before" name="subCourse_before[{{$student_course->id}}][{{$sc->id}}]" data-id="{{ $sc->id }}"
                                                                           data-subCourseId="{{ $sc->id }}" data-pointId="{{$sc->id}}">
                                                                @else
                                                                    <input @if($sub_course= \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'before'=>1])->first()) checked disabled @endif
                                                                    type="checkbox" class="form-check-input sub-course-checkbox_before"  data-id="{{ $sc->id }}"
                                                                           data-subCourseId="{{ $sc->id }}" data-pointId="0">
                                                                @endcan
                                                            </div>
                                                        @endif
                                                    </th>

                                                    <th class="text-center bg-info" style="font-size: 20px">{{$sc->sub_course_name}}</th>

                                                    <!--After-->
                                                    <th class="bg-info">
                                                        @if($sc->points->count() == 0)
                                                            <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                @can('student-course-complete-after')
                                                                    <input @if($sub_course1=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'after'=>1])->first()) checked disabled @endif
                                                                    type="checkbox" class="form-check-input  sub-course-checkbox_after" name="subCourse_after[{{$student_course->id}}][{{$sc->id}}]" data-id="{{ $sc->id }}"
                                                                           data-subCourseId="{{ $sc->id }}" data-pointId="{{$sc->id}}">
                                                                @else
                                                                    <input @if($sub_course1=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'after'=>1])->first()) checked  disabled @endif
                                                                    type="checkbox" class="form-check-input  sub-course-checkbox_after" data-id="{{ $sc->id }}"
                                                                           data-subCourseId="{{ $sc->id }}" data-pointId="0">
                                                                @endcan
                                                            </div>
                                                        @endif
                                                    </th>

                                                    <th  class="text-center bg-info">{{isset($sub_course->trainer_confirm_date)? $sub_course->trainer_confirm_date:''}}
                                                        {{isset($sub_course1->trainer_confirm_date)? $sub_course1->trainer_confirm_date:''}}</th>
                                                    @if(auth()->user()->type == 0)
                                                        <td>
                                                            @if($sc->points->count() == 0)
                                                            <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                @php
                                                                    $id= isset($sub_course)? $sub_course->id :(isset($sub_course1)?$sub_course1->id:0);
                                                                    $status= isset($sub_course)? $sub_course->status :(isset($sub_course1)?$sub_course1->status:0);
                                                                @endphp
                                                                @if(in_array($id,$studentCompleteCourses))
                                                                    <input class="form-check-input point-checkbox" type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]">
                                                                @elseif($status ==2)
                                                                    <input class="form-check-input point-checkbox" checked  type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]">
                                                                @else
                                                                    <input class="form-check-input point-checkbox" type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]">

                                                                @endif
                                                            </div>
                                                                @endif
                                                        </td>
                                                    @endif
                                                    @if(auth()->user()->type != 0)
                                                        @if((isset($sub_course) && auth()->user()->id == $sub_course->user_id) || (isset($sub_course1) && auth()->user()->id == $sub_course1->user_id))
                                                            <td>
                                                                @if(isset($sub_course) && in_array($sub_course->id,$approvedCourse))
                                                                    Approved
                                                                @endif
                                                                @if(isset($sub_course1) && in_array($sub_course1->id,$approvedCourse))
                                                                    Approved
                                                                @endif
                                                            </td>
                                                        @endif
                                                    @endif
                                                </tr>
                                                <tr>
                                                    @if($sc->points->count() > 0)
                                                        <td class="text-center">
                                                        </td>
                                                        <td class="text-center">
                                                            <b>Points</b>
                                                        </td>
                                                        <td class="text-center">
                                                        </td>
                                                        <td></td>
                                                    @endif
                                                </tr>
    {{--                                              //Points before after--}}
                                                @forelse($sc->points as $key =>$sp)
                                                    <tr>
                                                        <td>
                                                            <!--Before -->
                                                            @if($sc->points->count() > 0)
                                                                <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                    @can('student-course-complete-before')
                                                                        <input @if($sub_course = \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'before'=>1])->first()) checked disabled @endif
                                                                        class="form-check-input point-checkbox subcourse_before_{{ $sc->id }}" type="checkbox" data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}"
                                                                               name="subCourse_point_before[{{$student_course->id}}][{{$sp->id}}]">
                                                                    @else
                                                                        <input @if($sub_course=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'before'=>1])->first()) checked @endif
                                                                        class="form-check-input point-checkbox subcourse_before_{{ $sc->id }}" type="checkbox" disabled data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}">
                                                                    @endcan
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{$sp->sub_point_name}}</td>
                                                        <td>
                                                            <!--After-->
                                                            <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                @can('student-course-complete-before')
                                                                    <input @if($sub_course1 = App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'after'=>1])->first()) checked disabled @endif
                                                                    class="form-check-input point-checkbox subcourse_{{ $sc->id }}" name="subCourse_point_after[{{$student_course->id}}][{{$sp->id}}]" type="checkbox" data-subCourseId="{{ $sc->id }}"
                                                                           data-pointId="{{ $sp->id }}" >
                                                                @else
                                                                    <input @if($sub_course1 = \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'after'=>1])->first()) checked @endif
                                                                    class="form-check-input point-checkbox subcourse_{{ $sc->id }}" type="checkbox" disabled data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}">
                                                                @endcan
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{isset($sub_course->trainer_confirm_date)? $sub_course->trainer_confirm_date:''}}
                                                            {{isset($sub_course1->trainer_confirm_date)? $sub_course1->trainer_confirm_date:''}}
                                                        </td>
                                                        @if(auth()->user()->type == 0)
                                                            <td>
                                                                <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                    @php
                                                                    $id= isset($sub_course)? $sub_course->id :(isset($sub_course1)?$sub_course1->id:0);
                                                                    $status= isset($sub_course)? $sub_course->status :(isset($sub_course1)?$sub_course1->status:0);
                                                                    @endphp
                                                                    @if(in_array($id,$studentCompleteCourses))
                                                                        <input class="form-check-input point-checkbox" type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]">
                                                                    @elseif($status ==2)
                                                                        <input class="form-check-input point-checkbox" checked  type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]">
                                                                    @else
                                                                        <input class="form-check-input point-checkbox" type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]">

                                                                    @endif
                                                                </div>
                                                            </td>
                                                        @endif
                                                        @if(auth()->user()->type != 0)
                                                            @if((isset($sub_course) && auth()->user()->id == $sub_course->user_id) || (isset($sub_course1) && auth()->user()->id == $sub_course1->user_id))
                                                                <td>
                                                                    @if(isset($sub_course) && in_array($sub_course->id,$approvedCourse))
                                                                        Approved
                                                                    @endif
                                                                    @if(isset($sub_course1) && in_array($sub_course1->id,$approvedCourse))
                                                                        Approved
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @empty
                                                @endforelse
                                            @endforeach
                                        </table>
                                    @endforeach

                                    <button type="submit" class="btn btn-primary float-right mt-2 saveChanges">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="result"></div>
                </div>
            </div>
        </section>
    </div>
@endsection

