@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @foreach ($students as $student)
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    {{-- <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                                            src="{{asset('assets/student/images/'. $student->upload_student_image )}}" alt="Student Profile Photo">
                                    </div> --}}
                                    <div class="text-center">
                                        @if($student->upload_student_image)
                                            <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                                             src="{{asset('assets/student/images/'. $student->upload_student_image )}}" alt="Student Profile Photo">
                                        @else
                                            <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                                                 src="{{asset('assets/student/images/dummy-profile.jpeg' )}}" alt="Student Profile Photo">
                                        @endif
                                    </div>
                                    <h3 class="profile-username text-center">{{ $student->name }} {{ $student->surname }}</h3>
                                    <p class="text-muted text-center">Student</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email : </b> <a class="float-right">{{ $student->email_id ?? ''}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Gender : </b> <a class="float-right">{{ $student->gender ?? ''}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Meduim : </b> <a class="float-right">{{ $student->medium ?? ''}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Standard : </b> <a class="float-right">{{ $student->standard ?? ''}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Demo taken:</b> <a class="float-right">{{ $student->trainer->name ?? ''}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Demo Counselling:</b> <a class="float-right">{{ $student->counselling_by ?? ''}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Trainer Name :</b> <a class="float-right">{{ $student->studentTrainer->trainer->name ?? ''}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Courses : </b>
                                            @foreach ($studentCourse as $course)
                                                <a class="float-right">{{ $course->course->course_name ?? ''}}</a><br>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card card-success">
                                <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address </strong>
                                    <p class="text-muted"> {{ $student->address ?? ''}}</p>
                                    <hr>
                                    <strong><i class="fas fa-school mr-1"></i>School Name</strong>
                                    <p class="text-muted">
                                        {{ $student->school_name ?? ''}}
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-calendar-alt mr-1"></i>Date of Birth</strong> :  {{ date('d-m-Y',strtotime($student->dob)) ?? '' }}
                                    <hr>
                                    <strong><i class="fas fa-user mr-1"></i>Age :</strong> {{ $student->age ?? ''}}
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Personal Information :</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="post">
                                        <table class="table table-borderless table-striped table-hover">
                                            <tr>
                                                <th><b>Father Name:</b></th>
                                                <td>{{$student->father_name ?? ''}}</td>

                                            </tr>
                                            <tr>
                                                <th><b>Father Contact No:</b></th>
                                                <td>{{$student->father_contact_no ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Mother Contact No:</b></th>
                                                <td>{{$student->mother_contact_no ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>School Time:</b></th>
                                                <td>{{$student->school_time ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Extra Tuition Time:</b></th>
                                                <td>{{$student->extra_tuition_time ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Date Of Birth:</b></th>
                                                <td>{{date('Y-m-d', strtotime($student->dob)) ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Fees:</b></th>
                                                <td>{{$student->fees ?? ''}}</td>
                                            </tr>

                                            <tr>
                                                <th><b>Courses:</b></th>
                                                <td>
                                                    @foreach($student->courses as $key => $course)
                                                        <b>{{ $key+1 }}:</b> {{ $course->course->course_name ?? ''}}
                                                        <br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Course Material :</th>
                                                <td>
                                                    @foreach ($student->studentMaterial as $key => $material)
                                                        <b>{{ $key+1 }}:</b> {{ $material->material->material_name ?? ''}}
                                                        <br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><b>Student Analysis PDF:</b></th>
                                                <td><a href="{{asset('assets/student/pdf/'. $student->upload_analysis )}}" download="">
                                                        <button class="btn btn-success">Download  <i class="fa fa-file-pdf"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <tr>
                                            <th><b>Extra Note:</b></th>
                                            <td>{{$student->extra_note}}</td>
                                        </tr>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                               <div class="card-header">
                                    <h3 class="card-title"><b>School Detail :</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="post">
                                        <table class="table table-borderless table-striped table-hover">
                                            <tr>
                                                <th><b>Reference By:</b></th>
                                                <td>{{$student->reference_by ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Demo Taken By:</b></th>
                                                <td>{{$student->trainer->name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Analysis Staff Name:</b></th>
                                                <td>{{$student->trainer->name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Payment Condition:</b></th>
                                                <td>{{$student->payment_condition ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Branch Name:</b></th>
                                                <td>{{ $student->branch->name ?? ''}}</td>
                                            </tr>

                                            @if($student->studentDmit)
                                            <tr>
                                                <th><b>STF Details</b></th>
                                                <td></td>
                                                <th></th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th><b>Gujarati</b></th>
                                                <td>{!! $student->studentDmit->stf_gujarati !!}</td>
                                               
                                            </tr>
                                            <tr>
                                                <th><b>Hindi</b></th>
                                                <td>{!! $student->studentDmit->stf_hindi !!}</td>
                                               
                                            </tr>
                                            <tr>
                                                <th><b>English</b></th>
                                                <td>{!! $student->studentDmit->stf_english !!}</td>
                                               
                                            </tr>
                                            <tr>
                                                <th><b>Maths</b></th>
                                                <td>{!! $student->studentDmit->stf_maths !!}</td>
                                               
                                            </tr>
                                            <tr>
                                                <th><b>Self Development</b></th>
                                                <td>{!! $student->studentDmit->stf_self_development !!}</td>
                                               
                                            </tr>
                                            <tr>
                                                <th><b>Others</b></th>
                                                <td>{!! $student->studentDmit->stf_others !!}</td>
                                               
                                            </tr>
                                                <tr>
                                                    <th><b>DMIT Details</b></th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th><b>FP</b></th>
                                                    <td>{!! $student->studentDmit->fp ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Fp Date</b></th>
                                                    <td>{{ $student->studentDmit->fp_date ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Report</b></th>
                                                    <td>{!! $student->studentDmit->report ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Report Date</b></th>
                                                    <td>{{ $student->studentDmit->report_date ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Key Point</b></th>
                                                    <td>{!! $student->studentDmit->key_point ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Key Point Date</b></th>
                                                    <td>{{ $student->studentDmit->key_point_date ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Counselling By</b></th>
                                                    <td>{!! $student->studentDmit->counselling_by ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Counselling by Date</b></th>
                                                    <td>{{ $student->studentDmit->counselling_date ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Counselling By Trainer</b></th>
                                                    <td>{!! $student->studentDmit->counselling_by_trainer ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Counselling By Trainer Name</b></th>
                                                    <td>{{ $student->studentDmit->trainer->name ?? '' }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3 class="card-title"><b>PTM Report :</b></h3>
                                        </div>
                                        <div class="col-md-4">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date_ptm_report" name="fromDatePtmreport" value="{{ !empty($fromDatePtmreport) ? $fromDatePtmreport : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date_ptm_report" name="toDatePtmReport" value="{{ !empty($toDatePtmReport) ? $toDatePtmReport : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary student-ptm-search">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordere example1 table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Trainer Name</th>
                                                <th>Effort & Improvement</th>
                                                <th> Next Month's Plan</th>
                                                <th> Suggestion to Parents</th>
                                                <th>Suggestion by Parents</th>
                                                <th> Date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentPtm as $ptm)
                                                <tr>
                                                    <td>{{ $ptm->trainer->name }}</td>
                                                    <td>
                                                        @if($ptm->effort_improvement !== null)
                                                            {!! $ptm->effort_improvement !!}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($ptm->next_month_plan !== null)
                                                            {!! $ptm->next_month_plan !!}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($ptm->suggestion_to_parents !== null)
                                                            {!! $ptm->suggestion_to_parents !!}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($ptm->suggestion_by_parents !== null)
                                                            {!! $ptm->suggestion_to_parents !!}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($ptm->date)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-dark"><b><i>Courses</i></b></h4>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card-body">
                                            <form action="{{route('student.sendNotification')}}" method="POST" id="disabledform">
                                                @csrf
                                                @foreach($student->courses as $student_course)
                                                    <span class="h4 p-2">{{$student_course->course->course_name}}</span>
                                                    @if($student_course->start_date == null)
                                                        <a class="btn btn-success btn-start btn-start_{{ $student_course->course_id }} inactiveLink" data-student-id="{{ $student->id }}" data-course-id="{{ $student_course->course_id }}" data-btn="start_task" id="" disabled>Start Course</a>
                                                        <span class="h6 border p-2 display_start_date_{{ $student_course->course_id }}" style="display: none;" id=""> Start Date :- {{ date('d-m-Y', $student_course->start_date)}}</span>
                                                    @else
                                                        <span class="h6 border p-2 mr-2"> Start Date :- {{ date('d-m-Y', strtotime($student_course->start_date))}} </span>
                                                    @endif
                                                    @if($student_course->end_date == null)
                                                        <a class="btn btn-primary btn-end btn-end_{{ $student_course->course_id  }} inactiveLink" data-student-id="{{ $student->id }}" data-course-id="{{ $student_course->course_id }}" data-btn="end_task" id="" disabled>End Course</a>
                                                        <span class="h6 border p-2 display_end_date_{{ $student_course->course_id }}" style="display: none;" id=""> End Date :- {{ date('d-m-Y', $student_course->end_date) }}</span>
                                                    @else
                                                        <span class="h6 border p-2"> End Date :- {{ date('d-m-Y', strtotime($student_course->end_date))}}</span>
                                                        <button class="btn btn-success" disabled>Course Completed</button>
                                                    @endif
                                                    <button class="btn btn-success course-complete_{{ $student_course->course_id }}" style="display: none;" id="" disabled>Course Completed</button>
                                                    <a class="btn btn-secondary btn-restart-course restart_course_{{ $student_course->course_id }}" data-student-id="{{ $student->id }}"
                                                       data-course-id="{{ $student_course->course_id }}" style="display: none;" disabled>Restart Course</a>
                                                    @if($student_course->end_date !== null)
                                                        <span><a class="btn btn-secondary btn-restart-course" data-student-id="{{ $student->id }}" data-course-id="{{ $student_course->course_id }}">Restart Course</a></span>
                                                    @endif
                                                    <br><br>
                                                    <table class="table table-bordered table-striped" id="courseTable" style="width: 180%">
                                                        <td class="text-center"><b>Course Start Date:</b>  {{$student_course->start_date}}</td>
                                                        @if($student_course->end_date !== null)
                                                        <td class="text-center"><b>Course End Date:</b>  {{$student_course->end_date}}</td>
                                                        @endif
                                                        <td class="text-center"><b>Course Restart Date:</b>  {{$student_course->restart_date}}</td>
                                                    </table>
                                                    <table class="table table-bordered table-striped" id="courseTable" style="width: 180%">
                                                        <input type="hidden" name="student_id" class="form-control student_id" value="{{$student->id}}">
                                                        <input type="hidden" name="course_id" class="form-control course_id" value="{{$student_course->course_id}}">
                                                        <input type="hidden" name="trainer_id" class="form-control trainer" value="{{ $trainer ? $trainer->trainer_id : ''}}">
                                                        @if($student_course->course->subcourses->isNotEmpty())
                                                            <tr>
                                                                <td class="text-center">Before</td>
                                                                <td></td>
                                                                <td class="text-center">After</td>
                                                                <td>
                                                                    Trainer Confirm Date
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    Admin Confirm Date
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        {{-- //subCourse before after--}}
                                                        @foreach($student_course->course->subcourses as $key =>$sc)
                                                            <tr>
                                                                <th class="bg-info">
                                                                    <!--Before-->
                                                                    @if($sc->points->count() == 0)
                                                                        <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                            @can('student-course-start')
                                                                                <input @if($sub_course=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'before'=>1])->first()) checked disabled @endif
                                                                                @if($student_course->start_date == null) disabled @endif
                                                                                       type="checkbox" class="form-check-input sub-course-checkbox_before" name="subCourse_before[{{$student_course->id}}][{{$sc->id}}]" data-id="{{ $sc->id }}"
                                                                                       data-subCourseId="{{ $sc->id }}" data-pointId="{{$sc->id}}">
                                                                            @else
                                                                                <input @if($sub_course= \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'before'=>1])->first()) checked disabled @endif
                                                                                @if(auth()->user()->type == 1) disabled @endif @if($student_course->start_date == null) disabled @endif  type="checkbox" class="form-check-input sub-course-checkbox_before" name="subCourse_before[{{$student_course->id}}][{{$sc->id}}]" data-id="{{ $sc->id }}"
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
                                                                            @can('student-course-start')
                                                                                <input @if($sub_course1=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'after'=>1])->first()) checked disabled @endif
                                                                                type="checkbox" class="form-check-input  sub-course-checkbox_after" name="subCourse_after[{{$student_course->id}}][{{$sc->id}}]" data-id="{{ $sc->id }}"
                                                                                       data-subCourseId="{{ $sc->id }}" data-pointId="{{$sc->id}}">
                                                                            @else
                                                                                <input @if($sub_course1=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_id'=>$sc->id,'after'=>1])->first()) checked disabled @endif
                                                                                type="checkbox" class="form-check-input  sub-course-checkbox_after" name="subCourse_after[{{$student_course->id}}][{{$sc->id}}]" data-id="{{ $sc->id }}"
                                                                                       data-subCourseId="{{ $sc->id }}" data-pointId="0">
                                                                            @endcan
                                                                        </div>
                                                                    @endif
                                                                </th>

                                                                <th  class="text-center bg-info">@if($sc->points->count() == 0) {{isset($sub_course->trainer_confirm_date)? $sub_course->trainer_confirm_date:(isset($sub_course1->trainer_confirm_date)?$sub_course1->trainer_confirm_date:'')}} @endif</th>
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
                                                                @else
                                                                    <td>
                                                                        @if(auth()->user()->type != 0)
                                                                            @if((isset($sub_course) && auth()->user()->id == $sub_course->user_id) || (isset($sub_course1) && auth()->user()->id == $sub_course1->user_id))
                                                                                @if(isset($sub_course) && in_array($sub_course->id,$approvedCourse))
                                                                                    Approved
                                                                                @endif
                                                                                @if(isset($sub_course1) && in_array($sub_course1->id,$approvedCourse))
                                                                                    Approved
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                                <td>@if($sc->points->count() == 0) {{isset($sub_course->admin_confirm_date)? $sub_course->admin_confirm_date:''}} @endif</td>
                                                            </tr>
                                                            <tr>
                                                                @if($sc->points->count() > 0)
                                                                    <td class="text-center" id="countBeforeSubCourse_{{ $sc->id }}">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <b>Points</b>
                                                                    </td>
                                                                    <td class="text-center" id="countAfterSubCourse_{{ $sc->id }}">
                                                                    </td>
                                                                    <td></td>
                                                                    <td class="text-center" id="approvedSubCourse_{{ $sc->id }}">
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                            {{--                                              //Points before after--}}
                                                            @forelse($sc->points as $key =>$sp)
                                                                @php
                                                                    $checkPoint = false;
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <!--Before -->
                                                                        @if($sc->points->count() > 0)
                                                                            <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                                @can('student-course-start')
                                                                                    <input @if($sub_course = \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'before'=>1])->first()) checked disabled @endif @if($student_course->start_date == null) disabled @endif
                                                                                    class="form-check-input point-checkbox subcourse_before_{{ $sc->id }} beforSubCourse" type="checkbox" data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}"
                                                                                           name="subCourse_point_before[{{$student_course->id}}][{{$sp->id}}]" disabled>
                                                                                @else
                                                                                    @php
                                                                                        $checked= '';
                                                                                        if($sub_course=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'before'=>1])->first()) {
                                                                                            $checked= "checked";
                                                                                            $checkPoint = true;
                                                                                        }
                                                                                    @endphp
                                                                                    <input {{ $checked }} @if($student_course->start_date == null) disabled @endif  @if(auth()->user()->type == 1) disabled @endif
                                                                                    class="form-check-input point-checkbox subcourse_before_{{ $sc->id }} beforSubCourse"
                                                                                           name="subCourse_point_before[{{$student_course->id}}][{{$sp->id}}]" type="checkbox" data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}" disabled>
                                                                                @endcan
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">{{$sp->sub_point_name}}</td>
                                                                    <td>
                                                                        <!--After-->
                                                                        <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                            @can('student-course-start')
                                                                                <input @if($sub_course1 = App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'after'=>1])->first()) checked disabled @endif @if($student_course->start_date == null) disabled @endif
                                                                                class="form-check-input point-checkbox subcourse_{{ $sc->id }} afterSubCourse" name="subCourse_point_after[{{$student_course->id}}][{{$sp->id}}]" type="checkbox" data-subCourseId="{{ $sc->id }}"
                                                                                       data-pointId="{{ $sp->id }}" disabled>
                                                                            @else
                                                                                @php
                                                                                    $checked= '';
                                                                                    if($sub_course1 = \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'after'=>1])->first()) {
                                                                                        $checked= "checked disabled";
                                                                                        $checkPoint = true;
                                                                                    }
                                                                                @endphp
                                                                                <input {{ $checked }} @if($student_course->start_date == null) disabled @endif
                                                                                class="form-check-input point-checkbox subcourse_{{ $sc->id }} afterSubCourse" type="checkbox" name="subCourse_point_after[{{$student_course->id}}][{{$sp->id}}]" data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}" disabled>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        {{isset($sub_course->trainer_confirm_date)? $sub_course->trainer_confirm_date:(isset($sub_course1->trainer_confirm_date)?$sub_course1->trainer_confirm_date:'')}}
                                                                    </td>
                                                                    @if(auth()->user()->type == 0)
                                                                        <td>
                                                                            <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                                @php
                                                                                    $id= isset($sub_course)? $sub_course->id :(isset($sub_course1)?$sub_course1->id:0);
                                                                                    $status= isset($sub_course)? $sub_course->status :(isset($sub_course1)?$sub_course1->status:0);
                                                                                @endphp
                                                                                @if(in_array($id,$studentCompleteCourses))
                                                                                    <input @if($student_course->start_date == null) disabled @endif class="form-check-input point-checkbox subCourse_point_approve_{{ $sc->id }} approvedSubCourse" type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]" data-subCourseId="{{ $sc->id }}" disabled>
                                                                                @else
                                                                                    <input {{  $student_course->start_date != null && $checkPoint == true ? '' : 'disabled' }}  class="form-check-input point-checkbox subCourse_point_approve_{{ $sc->id }} approvedSubCourse"
                                                                                           {{ $status == 2 ? 'checked' : ''}} type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]" data-subCourseId="{{ $sc->id }}" disabled>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            @if(auth()->user()->type != 0)
                                                                                @if(isset($sub_course) && in_array($sub_course->id,$approvedCourse))
                                                                                    Approved
                                                                                @elseif(isset($sub_course1) && in_array($sub_course1->id,$approvedCourse))
                                                                                    Approved
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    @endif
                                                                    @php
                                                                        $status= isset($sub_course)? $sub_course->status :(isset($sub_course1)?$sub_course1->status:0);
                                                                    @endphp
                                                                    <td>{{isset($sub_course->admin_confirm_date )&& $status==2? $sub_course->admin_confirm_date:(isset($sub_course1->admin_confirm_date)&& $status==2?$sub_course1->admin_confirm_date:'')}}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-center">No Data Available</td>
                                                                </tr>
                                                            @endforelse
                                                        @endforeach
                                                    </table>
                                                @endforeach
                                               </form>
                                            <button type="submit" class="btn btn-primary float-right mt-2 saveChanges inactiveLink" onclick="disableForm()">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="result"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3 class="card-title"><b>Regular Staff Assign Detail :</b></h3>
                                        </div>
                                        <div class="col-md-4">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date_staff_assign" name="fromDateStaffAssign" value="{{ !empty($fromDateStaffAssign) ? $fromDateStaffAssign : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date_staff_assign" name="toDateStaffAssign" value="{{ !empty($toDateStaffAssign) ? $toDateStaffAssign : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary student-staff-assign-search">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <table class="table table-bordere example1 table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Trainer Name</th>
                                                <th> Slot Time </th>
                                                <th> Date</th>
                                                <th> Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentStaffAssign as $regularStaff)
                                                <tr>
                                                    <td>{{ $regularStaff->trainer->name ?? '' }}</td>
                                                    <td>{{ $regularStaff->slot->slot_time ?? ''}}</td>
                                                    <td>{{ date('d-m-Y', strtotime($regularStaff->date)) ?? '' }}</td>
                                                    <td>{!! $regularStaff->is_active == 0 ? '<i class="fa fa-check-circle text-center" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3 class="card-title"><b>Proxy Staff Assign Detail :</b></h3>
                                        </div>
                                        <div class="col-md-4">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date_proxy_staff" name="fromProxyDateStaff" value="{{ !empty($fromProxyDateStaff) ? $fromProxyDateStaff : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date_proxy_staff" name="toDateProxyStaff" value="{{ !empty($toDateProxyStaff) ? $toDateProxyStaff : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary student-proxy-staff-search">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <table class="table table-bordere example1 table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Trainer Name</th>
                                                <th> Slot Time </th>
                                                <th> Starting Date</th>
                                                <th> Ending Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentProxyStaffAssign as $proxyStaff)
                                                <input type="hidden" name="student_ptm_id" id="student_ptm_id" value="{{ $proxyStaff->id }}">
                                                <tr>
                                                    <td>{{ $proxyStaff->trainer->name }}</td>
                                                    <td>{{ $proxyStaff->slot->slot_time}}</td>
                                                    <td>{{ date('d-m-Y', strtotime($proxyStaff->starting_date)) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($proxyStaff->ending_date)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3 class="card-title"><b>Courses :</b></h3>
                                        </div>
                                        <div class="col-md-4">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date_course" name="fromDateCourse" value="{{ !empty($fromDateCourse) ? $fromDateCourse : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date_course" name="toDateCourse" value="{{ !empty($toDateCourse) ? $toDateCourse : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary student-course-search">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <table class="table table-bordere example1 table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Course Name</th>
                                                <th> Starting Date</th>
                                                <th> Ending Date</th>
                                                <th> Appreciation </th>
                                                <th> Appreciation given Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentCourse as $course)
                                                <tr>
                                                    <td>{{ $course->course->course_name ?? '' }}</td>
                                                    <td>
                                                        @if($course->start_date !== null)
                                                            {{ date('d-m-Y', strtotime($course->start_date)) ??'' }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($course->end_date !== null)
                                                            {{ date('d-m-Y', strtotime($course->end_date)) ?? '' }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ !empty($course->appreciation->appreciation_name) ? $course->appreciation->appreciation_name : '' }}</td>
                                                    <td>
                                                        @if($course->appreciation_given_date !== null)
                                                            {{ date('d-m-Y', strtotime($course->appreciation_given_date))  ?? ''}}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class=""><b> Leave List</b></h5>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date_leave" name="fromDateLeave" value="{{ !empty($fromDateLeave) ? $fromDateLeave : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date_leave" name="toDateLeave" value="{{ !empty($toDateLeave) ? $toDateLeave : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary student-leave-search">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <table class="table table-bordere example1 table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Starting Date</th>
                                                <th>Ending Date </th>
                                                <th>Leave reason </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentLeave as $leave)
                                                <tr>
                                                    <td>{{ date('d-m-Y', strtotime($leave->start_date)) ?? '' }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($leave->end_date)) ?? ''}}</td>
                                                    <td>
                                                        @if($leave->reason !== null)
                                                            {{ $leave->reason ?? '' }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class=""><b> Attendace Detail </b></h5>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date_attendance" name="fromDateAttendance" value="{{ !empty($fromDateAttendance) ? $fromDateAttendance : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date_attendance" name="toDateAttendance" value="{{ !empty($toDateAttendance) ? $toDateAttendance : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary student-attendance-search">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <table class="table table-bordere example1 table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Trainer Name</th>
                                                <th>Slot Time</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Slot Type</th>
                                                <th>Absent Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentAttendance as $attendance)
                                                <tr>
                                                    <td>{{ $attendance->trainer->name }}</td>
                                                    <td>{{ $attendance->slot->slot_time }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($attendance->attendance_date)) }}</td>
                                                    <td>
                                                        @if($attendance->status == 'A')
                                                            Absent
                                                        @else
                                                            Present
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $attendance->slot_type }}
                                                    </td>
                                                    <td>
                                                        @if($attendance->absent_reason !== null)
                                                            {{ $attendance->absent_reason }}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class=""><b> Status </b></h5>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date_status" name="fromDateStatus" value="{{ !empty($fromDateStatus) ? $fromDateStatus : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date_status" name="toDateStatus" value="{{ !empty($toDateStatus) ? $toDateStatus : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary student-status-serach">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <table class="table table-bordere example1 table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Trainer </th>
                                                <th>Reason </th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentStatus as $status)
                                                <tr>
                                                    <td>{{ $status->status }}</td>
                                                    <td>
                                                        @if($status->trainer_name !== null)
                                                            {{ $status->trainer_name ?? '' }}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($status->cancel_reason !== null)
                                                            {{ $status->cancel_reason ?? '' }}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($status->date)) ?? ''}}</td>
                                                    <td>{!! $status->is_active == 0 ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>

        //for search date in student ptm report
        $('body').on('click', '.student-ptm-search',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDatePtmreport = $("#from_date_ptm_report").val();
            console.log(fromDatePtmreport);
            var toDatePtmReport = $("#to_date_ptm_report").val();
            console.log(toDatePtmReport);
            var student_ptm_id = $('#student_ptm_id').val();
            var url = baseurl + "student-dashboard/" + "student_ptm_report/" + "?fromDatePtmreport=" + fromDatePtmreport + "&toDatePtmReport=" + toDatePtmReport;
            window.location = url;
        });

        //for search date in student regular staff assign
        $('body').on('click', '.student-staff-assign-search',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDateStaffAssign = $("#from_date_staff_assign").val();
            console.log(fromDateStaffAssign);
            var toDateStaffAssign = $("#to_date_staff_assign").val();
            console.log(toDateStaffAssign);
            var url = baseurl + "student-dashboard/" + "student_staff_assign/" + "?fromDateStaffAssign=" + fromDateStaffAssign + "&toDateStaffAssign=" + toDateStaffAssign;
            window.location = url;
        });

        //for search date in student proxy staff assign
        $('body').on('click', '.student-proxy-staff-search',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromProxyDateStaff = $("#from_date_proxy_staff").val();
            var toDateProxyStaff = $("#to_date_proxy_staff").val();
            var url = baseurl + "student-dashboard/" + "student_proxy_staff_assign/" + "?fromProxyDateStaff=" + fromProxyDateStaff + "&toDateProxyStaff=" + toDateProxyStaff;
            window.location = url;
        });

        //for search date in student Course detail
        $('body').on('click', '.student-course-search',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDateCourse = $("#from_date_course").val();
            var toDateCourse = $("#to_date_course").val();
            var url = baseurl + "student-dashboard/" + "student_course/" + "?fromDateCourse=" + fromDateCourse + "&toDateCourse=" + toDateCourse;
            window.location = url;
        });

        //for search date in student leave list
        $('body').on('click', '.student-leave-search',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDateLeave = $("#from_date_leave").val();
            var toDateLeave = $("#to_date_leave").val();
            var url = baseurl + "student-dashboard/" + "student_leave/" + "?fromDateLeave=" + fromDateLeave + "&toDateLeave=" + toDateLeave;
            window.location = url;
        });

        //for search date in student attendance list
        $('body').on('click', '.student-attendance-search',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDateAttendance = $("#from_date_attendance").val();
            var toDateAttendance = $("#to_date_attendance").val();
            var url = baseurl + "student-dashboard/" + "student_attendance/" + "?fromDateAttendance=" + fromDateAttendance + "&toDateAttendance=" + toDateAttendance;
            window.location = url;
        });

        //for search date in student status
        $('body').on('click', '.student-status-serach',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDateStatus = $("#from_date_status").val();
            var toDateStatus = $("#to_date_status").val();
            var url = baseurl + "student-dashboard/" + "student_status/" + "?fromDateStatus=" + fromDateStatus + "&toDateStatus=" + toDateStatus;
            window.location = url;
        });

        $(function () {
            dataTable = $(".example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([]).every(function () {
                            var column = this;
                            var select = $('<select class="form-control select2"><option value="">All</option></select>')
                                .appendTo($(column.header()).find('span').empty())
                                .on({
                                    'change': function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        column
                                            .search(val ? '^' + val + '$' : '', true, false).draw();
                                    },
                                    'click': function (e) {
                                        e.stopPropagation();
                                    }
                                });
                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        },
                    );
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });



            function disableForm() {
                var form = document.getElementById('disabledform');
                var elements = form.elements;

                for (var i = 0; i < elements.length; i++) {
                    elements[i].disabled = true;
                }
    }

    </script>
@endpush
