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
                                    <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                                         src="{{asset('assets/student/images/'. $student->upload_student_image )}}" alt="Student Profile Photo">
                                </div>
                                <input type="hidden" name="student_id" id="student_id" value="{{ $student->id }}">
                                <h3 class="profile-username text-center">{{ $student->surname }} {{ $student->name }}</h3>
                                <p class="text-muted text-center">Student</p>
                                <ul class="list-group  mb-3">
                                    <li class="list-group-item">
                                        <b>Demo taken:</b> <a class="float-right">{{ $student->trainer->name ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Demo Counselling:</b> <a class="float-right">{{ $student->counselling_by ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email ID:</b> <a class="float-right">{{ $student->email_id ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender:</b> <a class="float-right">{{ $student->gender ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Standard:</b> <a class="float-right">{{ $student->standard ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Medium:</b> <a class="float-right">{{ $student->medium ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Trainer Name :</b> <a class="float-right">{{ $student->studentTrainer->trainer->name ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Course:</b>
                                        <a class="float-right">
                                            @foreach($student->courses as $key => $cor)
                                                <b>{{ $key+1 }}:</b> {{ $cor->course->course_name }}<br>
                                                <b>Start Date : </b>{{ !empty($cor->start_date) ? date('d-m-Y',strtotime($cor->start_date)) : ''}}<br>
                                            @endforeach
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2 d-flex">
                                <ul class="nav nav-pills col-12">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Office Use Only</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#proxy_detail" data-toggle="tab">Proxy staff Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline1" data-toggle="tab">Assign Staff</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline2" data-toggle="tab">Absent Student Attendance Show</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#student_leave" data-toggle="tab">Student Leave List</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#student_appreciation" data-toggle="tab">Student Appreciation Detail</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#student_status" data-toggle="tab">Student Status Detail</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="post">
                                            <table class="table border-bottom">
                                                <tr>
                                                    <th><b>Father Name:</b></th>
                                                    <td>{{$student->father_name}}</td>
                                                    <th><b>Father Contact No:</b></th>
                                                    <td>{{$student->father_contact_no}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Mother Contact No:</b></th>
                                                    <td>{{$student->mother_contact_no}}</td>
                                                    <th><b>Address:</b></th>
                                                    <td>{{$student->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>School Name:</b></th>
                                                    <td>{{$student->school_name}}</td>
                                                    <th><b>School Time:</b></th>
                                                    <td>{{$student->school_time}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Extra Tuition Time:</b></th>
                                                    <td>{{$student->extra_tuition_time}}</td>
                                                    <th><b>Date Of Birth:</b></th>
                                                    <td>{{date('d-m-Y',strtotime($student->dob))}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Age:</b></th>
                                                    <td>{{$student->age}}</td>
                                                    <th><b>Fees:</b></th>
                                                    <td>{{$student->fees}}</td>
                                                </tr>
                                                <tr class="border-bottom">
                                                    <th><b>Extra Note:</b></th>
                                                    <td>{{$student->extra_note}}</td>
                                                    <th><b>Student Analysis PDF:</b></th>
                                                    <td><a href="{{asset('assets/student/pdf/'. $student->upload_analysis )}}" download="">
                                                            <button class="btn btn-success">Download  <i class="fa fa-file-pdf"></i></button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><b>Courses:</b></th>
                                                    <td>
                                                        @foreach($student->courses as $key => $course)
                                                            <b>{{ $key+1 }}:</b> {{ $course->course->course_name }}
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                    <th>Course Material :</th>
                                                    <td>
                                                        @foreach ($student->studentMaterial as $key => $material)
                                                            <b>{{ $key+1 }}:</b> {{ $material->material->material_name }}
                                                            <br>
                                                        @endforeach
                                                    </td>
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
                                                    <th><b>Role:</b></th>
                                                    <td>{{$student->user->roles->first()->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Demo Taken By:</b></th>
                                                    <td>{{$student->trainer->name ?? ''}}</td>
                                                    <th><b>Analysis Staff Name:</b></th>
                                                    <td>{{$student->trainer->name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Payment Condition:</b></th>
                                                    <td>{{$student->payment_condition}}</td>
                                                    <th><b>Branch Name:</b></th>
                                                    <td>{{ $student->branch->name }}</td>
                                                </tr>
                                                @if($student->studentDmit)
                                                    <tr>
                                                        <th><b>DMIT Details</b></th>
                                                        <td></td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>FP</b></th>
                                                        <td>{!! $student->studentDmit->fp ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                        <th><b>Fp Date</b></th>
                                                        <td>{{ $student->studentDmit->fp_date ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Report</b></th>
                                                        <td>{!! $student->studentDmit->report ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                        <th><b>Report Date</b></th>
                                                        <td>{{ $student->studentDmit->report_date ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Key Point</b></th>
                                                        <td>{!! $student->studentDmit->key_point ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                        <th><b>Key Point Date</b></th>
                                                        <td>{{ $student->studentDmit->key_point_date ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Counselling By</b></th>
                                                        <td>{!! $student->studentDmit->counselling_by ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                        <th><b>Counselling by Date</b></th>
                                                        <td>{{ $student->studentDmit->counselling_date ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Counselling By Trainer</b></th>
                                                        <td>{!! $student->studentDmit->counselling_by_trainer ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                        <th><b>Counselling By Trainer Name</b></th>
                                                        <td>{{ $student->studentDmit->trainer->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>STF Details</b></th>
                                                        <td></td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Gujarati</b></th>
                                                        <td>{!! $student->studentDmit->stf_gujarati !!}</td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Hindi</b></th>
                                                        <td>{!! $student->studentDmit->stf_hindi !!}</td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>English</b></th>
                                                        <td>{!! $student->studentDmit->stf_english !!}</td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Maths</b></th>
                                                        <td>{!! $student->studentDmit->stf_maths !!}</td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Self Development</b></th>
                                                        <td>{!! $student->studentDmit->stf_self_development !!}</td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Others</b></th>
                                                        <td>{!! $student->studentDmit->stf_others !!}</td>
                                                        <th></th>
                                                        <td></td>
                                                    </tr>
                                                @endif
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
                                                    <th><b>Action</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($proxy_staff_details as $psd)
                                                    <tr>
                                                        <td>{{$psd->trainer->name}}</td>
                                                        <td>{{$psd->slot->slot_time}}</td>
                                                        <td>{{$psd->starting_date}}</td>
                                                        <td>{{$psd->ending_date}}</td>
                                                        @if($loop->first)
                                                            <td>
                                                                @can('student-proxy-staff-edit')
                                                                    <button type="button"
                                                                            class="btn btn-success btn-edit-proxy-slot" data-trainer-id={{ $psd->trainer_id }} data-student-id={{ $psd->student_id }} data-old-slot-id={{ $psd->slot_id }}>
                                                                        Edit Slot
                                                                    </button>
                                                                @endcan
                                                            </td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form id="editProxySlot" action="{{ route('student.editProxySlot') }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="verticalModal1" tabindex="-1" role="dialog"
                                             aria-labelledby="verticalModalTitle"
                                             style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="verticalModalTitle">Edit Proxy Slot</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="student_id" class="form-control student_proxy_id " value="">
                                                        <input type="hidden" name="trainer_id" class="form-control trainer_proxy_id " value="">
                                                        <input type="hidden" name="old_slot_id" class="form-control old_proxy_slot_id " value="">
                                                        <div class="col-md-12 mb-1">
                                                            <label for="name">Slot: </label>
                                                            <select class="form-control slot select2" name="slot_id" required>
                                                                <option value="">------Select Slot-----</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="start_date">Starting Date:</label>
                                                                <input type="date" class="form-control" name="starting_date"
                                                                       value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="end_date">Ending Date:</label>
                                                                <input type="date" class="form-control" name="ending_date"
                                                                       value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close
                                                        </button>
                                                        <button type="button" class="btn mb-2 btn-primary edit_proxy_slot_submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="tab-pane" id="timeline1">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>Assign Staff name</b></th>
                                                    <th><b>Slot:</b></th>
                                                    <th><b>Date:</b></th>
                                                    <th><b>Action</b></th>
                                                    <th><b>Status</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($assignStaff as $key => $as)
                                                    <tr>
                                                        <td>{{$as->trainer->name}}</td>
                                                        <td>{{$as->slot->slot_time}}</td>
                                                        <td>{{$as->date}}</td>
                                                        <td>
                                                            @if($loop->first)
                                                                @can('student-regular-staff-edit')
                                                                    <button type="button"
                                                                            class="btn btn-success btn-edit-regular-slot  btn-md" data-trainer-id={{ $as->trainer_id }} data-student-id={{ $as->student_id }} data-old-slot-id={{ $as->slot_id }}>Edit Slot
                                                                    </button>
                                                                @endcan
                                                            @endif
                                                        </td>
                                                        <td>{!! $as->is_active == 0 ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form id="editRegularSlot" action="{{ route('student.editRegularSlot') }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="verticalModal2" tabindex="-1" role="dialog"
                                             aria-labelledby="verticalModalTitle"
                                             style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="verticalModalTitle">Edit Regular Slot</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="student_id" class="form-control student_regular_id " value="">
                                                        <input type="hidden" name="trainer_id" class="form-control trainer_regular_id " value="">
                                                        <input type="hidden" name="old_slot_id" class="form-control old_regular_slot_id " value="">
                                                        <div class="col-md-12 mb-1">
                                                            <label for="name">Slot: </label>
                                                            <select class="form-control slot select2" name="slot_id" required>
                                                                <option value="">------Select Slot-----</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="start_date">Starting Date:</label>
                                                                <input type="date" class="form-control" name="date"
                                                                       value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close
                                                        </button>
                                                        <button type="button" class="btn mb-2 btn-primary edit_regular_slot_submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
                                                    <th><b>No</b></th>
                                                    <th><b>Leave Date From</b></th>
                                                    <th><b>Leave Date To</b></th>
                                                    <th><b>Reason</b></th>
                                                    <th></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($student_leave_show as $key => $leave)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{$leave->start_date}}</td>
                                                        <td>{{$leave->end_date}}</td>
                                                        <td>{{$leave->reason}}</td>
                                                        <td>
                                                            @if(\Illuminate\Support\Facades\Auth::user()->type == 0)
                                                                <button type="button"
                                                                        class="btn btn-success btn-student-leave-edit btn-sm"
                                                                        data-id="{{$leave->id}}"><i class="fa fa-edit"></i>
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- for Student appreciation detail --}}
                                    <div class="tab-pane" id="student_appreciation">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>No</b></th>
                                                    <th><b>Course Name:</b></th>
                                                    <th><b>Appreciation:</b></th>
                                                    <th><b>Appreciation Date:</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student_appreciation as $key => $appreciation)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{$appreciation->course->course_name}}</td>
                                                        <td>{{!empty($appreciation->appreciation->appreciation_name) ? $appreciation->appreciation->appreciation_name : null}}</td>
                                                        @if($appreciation->appreciation_given_date !== NULL)
                                                            <td>{{ $appreciation_given_date = date('d-m-Y', strtotime($appreciation->appreciation_given_date)) }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td>
                                                            @can('student-appreciation-edit')
                                                                @if($appreciation->end_date !== NULL && $appreciation->appreciation_given_date == NULL)
                                                                    <button type="button"
                                                                            class="btn btn-success btn-sm btn-student-appreciation"
                                                                            data-id="{{$appreciation->id}}" data-student-id="{{ $appreciation->student_id }}"> Appreciation
                                                                    </button>
                                                                @endif
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="student_status">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>No</b></th>
                                                    <th><b>Status:</b></th>
                                                    <th><b>Trainer Name:</b></th>
                                                    <th><b>Reason:</b></th>
                                                    <th><b>Date:</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student->studentStatus as $key => $status)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $status->status }}</td>
                                                        @if ($status->trainer_name !== null)
                                                            <td>{{ $status->trainer_name }}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif
                                                        @if ($status->cancel_reason !== null)
                                                            <td>{{ $status->cancel_reason }}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif
                                                        <td>{{ date('d-m-Y', strtotime($status->date)) }}</td>
                                                        <td>{!! $status->is_active == 0 ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
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
                @if($student->isActiveStatus() != null && $student->isActiveStatus()->status  == 'Start')
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
                                            {{-- @dd($student_course->start_date) --}}
                                            <span class="h4 p-2">{{$student_course->course->course_name}}</span>
                                            @if($student_course->start_date == null)
                                                <a class="btn btn-success btn-start btn-start_{{ $student_course->course_id }}" data-student-id="{{ $student->id }}" data-course-id="{{ $student_course->course_id }}" data-btn="start_task" id="">Start Course</a>
                                                <span class="h6 border p-2 display_start_date_{{ $student_course->course_id }}" style="display: none;" id=""> Start Date :- {{ date('d-m-Y', $student_course->start_date)}}</span>
                                            @else
                                                <span class="h6 border p-2 mr-2"> Start Date :- {{ date('d-m-Y', strtotime($student_course->start_date))}} </span>
                                            @endif
                                            @if($student_course->end_date == null)
                                                <a class="btn btn-primary btn-end btn-end_{{ $student_course->course_id  }}" data-student-id="{{ $student->id }}" data-course-id="{{ $student_course->course_id }}" data-btn="end_task" id="">End Course</a>
                                                <span class="h6 border p-2 display_end_date_{{ $student_course->course_id }}" style="display: none;" id=""> End Date :- {{ date('d-m-Y', $student_course->end_date) }}</span>
                                            @else
                                                <span class="h6 border p-2"> End Date :- {{ date('d-m-Y', strtotime($student_course->end_date))}}</span>
                                                <button class="btn btn-success" disabled>Course Completed</button>
                                            @endif
                                            <button class="btn btn-success course-complete_{{ $student_course->course_id }}" style="display: none;" id="" disabled>Course Completed</button>
                                            <a class="btn btn-secondary btn-restart-course restart_course_{{ $student_course->course_id }}" data-student-id="{{ $student->id }}"
                                               data-course-id="{{ $student_course->course_id }}" style="display: none;">Restart Course</a>
                                            @if($student_course->end_date !== null)
                                                <span><a class="btn btn-secondary btn-restart-course" data-student-id="{{ $student->id }}" data-course-id="{{ $student_course->course_id }}">Restart Course</a></span>
                                            @endif
                                            <br><br>
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

                                                        <th  class="text-center bg-info">@if($sc->points->count() == 0) {{isset($sub_course->trainer_confirm_date)? $sub_course->trainer_confirm_date:''}} @endif</th>
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
                                                        <tr>
                                                            <td>
                                                                <!--Before -->
                                                                @if($sc->points->count() > 0)
                                                                    <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                        @can('student-course-start')
                                                                            <input @if($sub_course = \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'before'=>1])->first()) checked disabled @endif @if($student_course->start_date == null) disabled @endif
                                                                            class="form-check-input point-checkbox subcourse_before_{{ $sc->id }} beforSubCourse" type="checkbox" data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}"
                                                                                   name="subCourse_point_before[{{$student_course->id}}][{{$sp->id}}]">
                                                                        @else
                                                                            <input @if($sub_course=\App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'before'=>1])->first()) checked @endif @if($student_course->start_date == null) disabled @endif
                                                                            @if(auth()->user()->type == 1) disabled @endif class="form-check-input point-checkbox subcourse_before_{{ $sc->id }} beforSubCourse" name="subCourse_point_before[{{$student_course->id}}][{{$sp->id}}]" type="checkbox" data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}">
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
                                                                               data-pointId="{{ $sp->id }}" >
                                                                    @else
                                                                        <input @if($sub_course1 = \App\Models\StudentCourseComplete::where(['student_id'=>$student->id,'sub_course_point_id'=>$sp->id,'after'=>1])->first()) checked disabled @endif @if($student_course->start_date == null) disabled @endif
                                                                        class="form-check-input point-checkbox subcourse_{{ $sc->id }} afterSubCourse" type="checkbox" name="subCourse_point_after[{{$student_course->id}}][{{$sp->id}}]" data-subCourseId="{{ $sc->id }}" data-pointId="{{ $sp->id }}">
                                                                    @endcan
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{isset($sub_course->trainer_confirm_date)? $sub_course->trainer_confirm_date:''}}
                                                            </td>
                                                            @if(auth()->user()->type == 0)
                                                                <td>
                                                                    <div class="form-check checkbox-xl custom-checkbox text-center">
                                                                        @php
                                                                            $id= isset($sub_course)? $sub_course->id :(isset($sub_course1)?$sub_course1->id:0);
                                                                            $status= isset($sub_course)? $sub_course->status :(isset($sub_course1)?$sub_course1->status:0);
                                                                        @endphp
                                                                        @if(in_array($id,$studentCompleteCourses))
                                                                            <input @if($student_course->start_date == null) disabled @endif class="form-check-input point-checkbox subCourse_point_approve_{{ $sc->id }} approvedSubCourse" type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]" data-subCourseId="{{ $sc->id }}">
                                                                        @else
                                                                            <input @if($student_course->start_date == null) disabled @endif class="form-check-input point-checkbox subCourse_point_approve_{{ $sc->id }} approvedSubCourse"
                                                                                   {{ $status == 2 ? 'checked' : ''}} type="checkbox"  name="subCourse_point_approve[{{$student_course->id}}][{{$id}}]" data-subCourseId="{{ $sc->id }}">
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
                                                            <td>{{isset($sub_course->admin_confirm_date)? $sub_course->admin_confirm_date:(isset($sub_course1->admin_confirm_date)?$sub_course1->admin_confirm_date:'')}}</td>
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
                @endif
                {{-- @if($trainerAttendance->isNotEmpty()) --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:lightgray">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class=""><b>Attendance</b></h5>
                                            <h6><b>Total Present Students :- </b>{{ !empty($fromDate) ? $allPresentStudent : null}}</h3>
                                            <h6><b>Total Absent Students :- </b>{{ !empty($toDate) ? $allAbsentStudent : null  }}</h3>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <form class="form-inline" action="">
                                                <div class="form-group mr-2">
                                                    <label for="start-date" class="mr-2">From :</label>
                                                    <input type="date" class="form-control" id="from_date" name="from_date" value="{{ !empty($fromDate) ? $fromDate : '' }}">
                                                </div>
                                                <div class="form-group mr-2">
                                                    <label for="end-date" class="mr-2">To :</label>
                                                    <input type="date" class="form-control" id="to_date" name="to_date" value="{{ !empty($toDate) ? $toDate : '' }}">
                                                </div>
                                                <button type="button" class="btn btn-secondary search-btn">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3"></th>
                                                <th colspan="{{ $numberOfDaysInCurrentMonth }}" class="text-center">
                                                    {{  $currentMonthName }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width: 6rem" class="text-center">Slot Time</th>
                                                <th style="width: 4rem" class="text-center">Total A :-</th>
                                                <th style="width: 4rem" class="text-center">Total P :-</th>
                                                @php
                                                    $startDate = $currentMonthInHead;
                                                    $numberOfDays = $startDate->daysInMonth;
                                                @endphp
                                                @for ($day = 1; $day <= $numberOfDays; $day++)
                                                    <th class="text-center">
                                                        {{ $startDate->format('d') }}<br>
                                                    </th>
                                                    @php
                                                        $startDate->addDay();
                                                    @endphp
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentAttendances as $key => $attendance)
                                                @php
                                                    $currentMDate = $currentMonthInBody->copy();
                                                    $numberOfDays = $currentMDate->daysInMonth;
                                                @endphp
                                                @php
                                                    $totalPresentStudent = 0;
                                                @endphp
                                                @php
                                                    $totalAbsentStudent = 0;
                                                @endphp
                                                @foreach($attendance as $atd)
                                                    @if($atd->attendance_type == '0')
                                                        @php
                                                            $totalAbsentStudent++;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $totalPresentStudent++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td style="width: 6rem" class="text-center">{{ $key }}</td>
                                                    <td style="width: 4rem" class="text-center">{{ $totalAbsentStudent }}</td>
                                                    <td style="width: 4rem" class="text-center"> {{ $totalPresentStudent }}</td>
                                                    @for ($day = 1; $day <= $numberOfDays; $day++)
                                                        <td class="text-center">
                                                            @foreach ($attendance as $atd)
                                                                @php
                                                                    $attendanceDate = \Carbon\Carbon::parse($atd->attendance_date);
                                                                @endphp
                                                                @if ($attendanceDate->format('Y-m-d') == $currentMDate->format('Y-m-d'))
                                                                    @if ($atd->attendance_type == '0')
                                                                        0
                                                                    @else
                                                                        1
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        @php
                                                            $currentMDate->addDay();
                                                        @endphp
                                                    @endfor
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- @endif  --}}
            </div>
        </section>
        <div class="modal fade" id="btn-student-leave-edit" tabindex="-1" role="dialog"
             aria-labelledby="verticalModalTitle"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verticalModalTitle">Edit student Approved leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="leaveApprovedForm" action="{{ route('student.editStudentLeaveApprove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="leave_id" id="leave_id" value="">
                        <input type="hidden" name="user_id" id="leave_user_id" value="">
                        <input type="hidden" name="student_id" class="form-control student_id" id="leave_student_id" value="" required>
                        <div class="modal-body">
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="date">From:</label>
                                    <input type="date" class="form-control" name="start_date"
                                           value="{{date('Y-m-d')}}" id="start_date_leave" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="date">To:</label>
                                    <input type="date" class="form-control" name="end_date"
                                           value="{{date('Y-m-d')}}" id="end_date_leave">
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="text">Leave Reason:</label>
                                    <input type="text" class="form-control" name="reason" required id="leave_reason">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn mb-2 btn-primary leave-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- form for give student appreciation --}}
        <form id="appreciationForm" action="{{ route('student.studentAppreciation') }}" method="POST">
            @csrf
            <input type="hidden" name="student_course_appreciation_id" class="form-control student_course_appreciation_id"  id="student_course_appreciation_id" value="" required>
            <input type="hidden" name="student_id" class="form-control student_id" id="apprecation_student_id" value="" required>
            <div class="modal fade" id="verticalModal4" tabindex="-1" role="dialog"
                 aria-labelledby="verticalModalTitle"
                 style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verticalModalTitle">Student Appreciation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="date">Appreciation Date:</label>
                                    <input type="date" class="form-control" name="appreciation_given_date"
                                           value="{{date('Y-m-d')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn mb-2 btn-primary appreciation-form-submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.btn-student-leave-edit', function () {
            let id = parseInt($(this).data('id'));
            $('.student_id').val(id);
            let user_id = {{ Auth::id() }};
            $('#user_id').val(user_id);
            $('#btn-student-leave-edit').modal('toggle');

            $.ajax({
                url : "get-leave-data/" + id,
                type: 'GET',
                success: function (data) {
                    $('#start_date_leave').val(data.start_date);
                    $('#end_date_leave').val(data.end_date);
                    $('#leave_reason').val(data.reason);
                    $('#leave_student_id').val(data.student_id);
                    $('#leave_user_id').val(data.student_id);
                    $('#leave_id').val(id);
                }
            });
        });

        $(document).on('click', '.btn-student-appreciation', function () {
            let id = $(this).data('id');
            let student_id = $(this).data('student-id');
            $('#apprecation_student_id').val(student_id);
            $('#student_course_appreciation_id').val(id);
            $('#verticalModal4').modal('toggle');
        });

        $(document).on('click', '.appreciation-form-submit', function () {
            $('#appreciationForm').submit();
        });

        $(document).on('click','.btn-start, .btn-end', function(){
            let student_id = $(this).data('student-id');
            let course_id = $(this).data('course-id');
            let task = $(this).data('btn');

            $.ajax({
                url : "update-course-start-end-date/" + student_id + "/" + course_id + "/" + task,
                type: 'GET',
                success: function (data) {
                    if(data.success == true)
                    {
                        course_id = data.course_id;
                        $('.btn-start_' + course_id).remove();
                        $('.display_start_date_' + course_id).show();
                    }
                    else
                    {
                        course_id = data.course_id;
                        $('.btn-end_' + course_id).remove();
                        $('.display_end_date_' + course_id).show();
                        $('.course-complete_' + course_id).show();
                        $('.restart_course_' + course_id).show();
                    }
                    window.location.reload();
                }
            });
        });

        $(document).on('click','.btn-restart-course',function(){
            let student_id = $(this).data('student-id');
            let course_id = $(this).data('course-id');
            let url =  "restart-course/" + student_id + "/" + course_id;

            $.ajax({
                url : url,
                type: 'GET',
                success: function (data) {
                   location.reload();
                }
            });

        });

        $('body').on('click', '.search-btn',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDate = $("#from_date").val();
            var toDate = $("#to_date").val();
            var student_id = $('#student_id').val();
            var url = baseurl + "student/" + student_id + "?fromDate=" + fromDate + "&toDate=" + toDate;
            window.location = url;
        });


        $(document).on('click', '.btn-edit-proxy-slot', function () {
            let trainer_id = $(this).data('trainer-id');
            let student_id = $(this).data('student-id');
            let old_slot_id = $(this).data('old-slot-id');
            $('.student_proxy_id').val(student_id);
            $('.trainer_proxy_id').val(trainer_id);
            $('.old_proxy_slot_id').val(old_slot_id);

            $.ajax({
                url: 'trainer-proxy-slot/' + trainer_id,
                type: 'GET',
                data: {
                    "_token": "{{csrf_token()}}",
                },
                success: function (data) {
                    let slotOption = '<option value="">------Select Slot-----</option>'
                    $.each(data.slots, function (index, slot) {
                        slotOption += '<option value="' + slot.id + '">' + slot.slot_time + '</option>'
                    });
                    $('#verticalModal1').modal('toggle');
                    $('.slot').html(slotOption)
                }
            });
        });

        $(document).on('click', '.edit_proxy_slot_submit', function () {
            $('#editProxySlot').submit();
        });

        $(document).on('click', '.btn-edit-regular-slot', function () {
            let trainer_id = $(this).data('trainer-id');
            let student_id = $(this).data('student-id');
            let old_slot_id = $(this).data('old-slot-id');
            $('.student_regular_id').val(student_id);
            $('.trainer_regular_id').val(trainer_id);
            $('.old_regular_slot_id').val(old_slot_id);

            $.ajax({
                url: 'trainer-regular-slot/' + trainer_id,
                type: 'GET',
                data: {
                    "_token": "{{csrf_token()}}",
                },
                success: function (data) {
                    let slotOption = '<option value="">------Select Slot-----</option>'
                    $.each(data.slots, function (index, slot) {
                        slotOption += '<option value="' + slot.id + '">' + slot.slot_time + '</option>'
                    });
                    $('#verticalModal2').modal('toggle');
                    $('.slot').html(slotOption)
                }
            });
        });

        $(document).on('click', '.edit_regular_slot_submit', function () {
            $('#editRegularSlot').submit();
        });

        $(document).ready(function () {
            $(".beforSubCourse").each(function() {
                var subCourseBeforId = $(this).attr('data-subCourseId');
                var totalCheckedBefore = $('.subcourse_before_' + subCourseBeforId + ':checked').length;
                $('#countBeforeSubCourse_' + subCourseBeforId).text(totalCheckedBefore);
            });

            $(".afterSubCourse").each(function() {
                var subCourseAfterId = $(this).attr('data-subCourseId');
                var totalCheckedAfter = $('.subcourse_' + subCourseAfterId + ':checked').length;
                $('#countAfterSubCourse_' + subCourseAfterId).text(totalCheckedAfter);
            });

            $(".approvedSubCourse").each(function() {
                var subCourseApproveId = $(this).attr('data-subCourseId');
                var totalApproved = $('.subCourse_point_approve_' + subCourseApproveId + ':checked').length;
                $('#approvedSubCourse_' + subCourseApproveId).text(totalApproved);
            });
        });

    </script>
@endpush

