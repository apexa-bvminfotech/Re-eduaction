@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row md-12">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="card bg-light card-info">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <h5 class="d-block w-100" data-toggle="collapse">
                            <b>Total Students</b>
                        </h5>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background-color:lightgray">
                                <div class="inner">
                                    <h4>Total Students</h4>
                                    <h4>{{ count($totalStudent) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            @php
                                $presentStudent = 0;
                            @endphp

                            @foreach ($absentPresentStudent as $student)   
                                @if ($student->attendance_type == '1')
                                    @php
                                        $presentStudent++;
                                    @endphp
                                @endif   
                            @endforeach
                            
                            <div class="small-box" style="background-color:lightgray">
                                <div class="inner">
                                    <h4>Total Present Student</h4>
                                    <h4>{{ $presentStudent }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            @php
                                $absentStudent = 0;
                            @endphp

                            @foreach ($absentPresentStudent as $student)
                                @if ($student->attendance_type == '0')
                                    @php
                                        $absentStudent++;
                                    @endphp
                                @endif
                            @endforeach
                            
                            <div class="small-box" style="background-color:lightgray">
                                <div class="inner">
                                    <h4>Total Absent Student</h4>
                                    <h4>{{ $absentStudent }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            
            <div class="card bg-light card-info">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <h5 class="d-block w-100" data-toggle="collapse">
                            <b>Today Assign Student List </b>
                        </h5>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Student</th>
                            <th>Meduim</th>
                            <th>Standard</th>
                            <th>Slot Time</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($trainerStudent as $key=>$trainer)
                                <tr>
                                    <td>{{ ++$key}}</td>
                                    <td>{{$trainer->student->name}} {{$trainer->student->surname}}</td>
                                    <td>{{$trainer->student->medium}}</td>
                                    <td>{{$trainer->student->standard}}</td>
                                    <td>{{ $trainer->slot->slot_time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card bg-light card-info">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <h5 class="d-block w-100" data-toggle="collapse">
                            <b>Today Regular and Proxy slot</b>
                        </h5>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Slot Time</th>
                            <th>Slot Type</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $regularSlot = [];
                            @endphp
                            @foreach($tarinerRegularLecture as $key=>$trainerLecture)
                                @if(!in_array($trainerLecture->trainer_id,$regularSlot))
                                    <tr>
                                        <td>{{$trainerLecture->slot->slot_time}}</td>
                                        <td>Regular</td>
                                        @php
                                            $regularSlot[] = $trainerLecture->trainer_id;
                                        @endphp
                                    </tr>
                                @endif    
                            @endforeach
                            @php
                                $proxySlot = [];
                            @endphp
                            @foreach($tarinerProxyLecture as $key=>$trainerLecture)
                                @if(!in_array($trainerLecture->trainer_id,$proxySlot))
                                    <tr>
                                        <td>{{$trainerLecture->slot->slot_time}}</td>
                                        <td>Proxy</td>
                                        @php
                                            $proxySlot[] = $trainerLecture->trainer_id;
                                        @endphp
                                    </tr>
                                @endif   
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                                        src="{{asset('assets/trainer/'. $trainers->photo )}}" alt="Trainer Profile Photo">
                            </div>
                            <h3 class="profile-username text-center">{{ $trainers->name }} {{ $trainers->surname }}</h3>
                            <p class="text-muted text-center">Trainer</p>
            
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Designation : </b> <a class="float-right">{{ $trainers->designation }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Branch Name : </b> <a class="float-right">{{ $trainers->branch->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email address : </b> <a class="float-right">{{ $trainers->email_id }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Qualification : </b> <a class="float-right">{{ $trainers->qualification }}</a>
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
                            <p class="text-muted"> {{ $trainers->address }}</p>
                            <hr>
                            <strong><i class="fas fa-calendar-alt mr-1"></i>Date of Birth</strong> :  {{ date('d-m-Y',strtotime($trainers->dob)) }}
                            <hr>
                            <strong>Father Name :</strong> {{ $trainers->father_name }}
                            <hr>
                            <strong>Marital Status :</strong> {{ $trainers->marital_status == 1 ? "Married" : "Unmarried"     }}
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><b>Emergency Contact Information :</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="post">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Full Name</th>
                                        <td>{{ $trainers->emer_fullName }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $trainers->emer_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile No</th>
                                        <td>{{ $trainers->emer_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Relationship</th>
                                        <td>{{ $trainers->emer_relationship }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><b>Office Use Only :</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="post">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Department</th>
                                        <td>{{ $trainers->department }}</td>
                                        <th>Work Location</th>
                                        <td>{{ $trainers->work_location }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trainer Type</th>
                                        <td>{{ $trainers->emp_type == 1 ? "FreeLancer" : "Fixed" }}</td>
                                        <th>Email Address</th>
                                        <td>{{ $trainers->office_use_email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Joining Date</th>
                                        <td>{{ $str = str_replace(',', ' to ', $trainers->joining_date) }}</td>
                                        <th>I-Card</th>
                                        <td>{{ $trainers->i_card_date ?  date('d-m-Y', strtotime($trainers->i_card_date)) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>I-Card Return Date</th>
                                        <td>{{ $trainers->i_card_return_date ? date('d-m-Y', strtotime($trainers->i_card_return_date)) : '' }}</td>
                                        <th>I-Card Note</th>
                                        <td>{{ $trainers->i_card_note }}</td>
                                    </tr>
                                    <tr>
                                        <th>Uniform</th>
                                        <td>{{ $trainers->uniform_date ? date('d-m-Y', strtotime($trainers->uniform_date)) : '' }}</td>
                                        <th>Uniform Return Date</th>
                                        <td>{{ $trainers->uniform_return_date ? date('d-m-Y', strtotime($trainers->uniform_return_date)) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Uniform Note</th>
                                        <td>{{ $trainers->uniform_note }}</td>
                                        <th>Material</th>
                                        <td>{{ $trainers->material_date ? date('d-m-Y', strtotime($trainers->material_date)) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Material Return Date</th>
                                        <td>{{ $trainers->material_return_date ? date('d-m-Y', strtotime($trainers->material_return_date)) : ''}}</td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><b>Uploaded Documents :</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="post">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Aadhaar Card</th>
                                        <td>
                                            @if ($trainers->aadhaar_card)
                                                <a  class="btn btn-outline-dark fa fa-eye" href="{{ asset('assets/trainer/' . $trainers->aadhaar_card) }}" target="_blank"></a>
                                                <a class="btn btn-outline-dark" href="{{ asset('assets/trainer/' . $trainers->aadhaar_card) }}" download>Download</a>
                                            @else
                                                No image available
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Marksheet Photo</th>
                                        <td>
                                            @if ($trainers->last_edu_markSheet)
                                                <a class="btn btn-outline-dark fa fa-eye" href="{{ asset('assets/trainer/' . $trainers->last_edu_markSheet) }}" target="_blank"></a>
                                                <a class="btn btn-outline-dark" href="{{ asset('assets/trainer/' . $trainers->last_edu_markSheet) }}" download>Download</a>
                                            @else
                                                No image available
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bank-Passbook</th>
                                        <td>
                                            @if ($trainers->bank_passbook)
                                                <a class="btn btn-outline-dark fa fa-eye" href="{{ asset('assets/trainer/' . $trainers->bank_passbook) }}" target="_blank"></a>
                                                <a class="btn btn-outline-dark" href="{{ asset('assets/trainer/' . $trainers->bank_passbook) }}" download>Download</a>
                                            @else
                                                No image available
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"  style="background-color:lightgray">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class=""><b>Attendance</b></h5>
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Slot Time</th>
                                        <th>Date</th>
                                        <th>Status</th> 
                                        <th>Slot Type</th>
                                        <th>Absent Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trainerAttendance as $attendance)
                                        <tr>
                                            <td>{{ $attendance->slots->slot_time }}</td>
                                            <td>{{ date('d-m-Y', strtotime($attendance->date)) }}</td>
                                            <td>
                                                @if($attendance->status == 'A')
                                                    Absent
                                                @else
                                                    Present
                                                @endif
                                            </td>
                                            <td>{{ $attendance->slot_type }}</td>
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
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('body').on('click', '.search-btn',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDate = $("#from_date").val();
            var toDate = $("#to_date").val();
            var trainer_id = $('#trainer_id').val();
            var url = baseurl + "trainer-dashboard/" + "?fromDate=" + fromDate + "&toDate=" + toDate;
            window.location = url;            
        });
    </script>
@endpush