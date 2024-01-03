@extends('layouts.admin')
@push('styles')
    <style>
        tr {
            border-top: 1px solid #ccc;
        }

        tr:first-child {
            border-top: 0;
        }

        tr > th {
            border-top: 0;
        }

    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trainer Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('trainer.index') }}">Show Trainer
                                    List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if($trainer->photo)
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('assets/trainer/' . $trainer->photo)}}"
                                         alt="User profile picture" style="width: 150px;height: 150px;">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{asset('assets/student/images/dummy-profile.jpeg')}}"
                                             alt="User profile picture" style="width: 150px;height: 150px;">

                                    @endif
                                </div>

                                <h3 class="profile-username text-center">{{ $trainer->name }}
                                    &nbsp;{{ $trainer->surname }}</h3><br>


                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Designation</b> <a class="float-right">{{ $trainer->designation }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Branch Name</b> <a class="float-right">{{ $trainer->branch->name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2 d-flex">
                                <ul class="nav nav-pills col-11">
                                    <li class="nav-item"><a class="nav-link active" href="#personal_info"
                                                            data-toggle="tab">Employee Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#emergency_info"
                                                            data-toggle="tab">Emergency Contact Information</a></li>
                                    <li class="nav-item"><a class="nav-link " href="#office_use_only"
                                                            data-toggle="tab">Office Use Only</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link " href="#document"
                                                            data-toggle="tab">Uploaded Document</a>
                                    </li>
                                </ul>
                                <a href="{{ route('trainer.index') }}"
                                   class="col-1 btn btn-primary float-right">Back</a>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personal_info">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <input type="hidden" name="trainer_id" id="trainer_id" value="{{ $trainer->id }}">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>Father Name</th>
                                                        <td>{{ $trainer->father_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date of Birth</th>
                                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $trainer->dob)->format('d/m/Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email address</th>
                                                        <td>{{ $trainer->email_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Marital Status</th>
                                                        <td>{{ $trainer->marital_status == 1 ? "Married" : "Unmarried" }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Qualification</th>
                                                        <td>{{ $trainer->qualification }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td>{{ $trainer->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <td>{{ $trainer->phone }}</td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="emergency_info">
                                        <div class="col-md-12">

                                            <div class="card-body">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <td>{{ $trainer->emer_fullName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td>{{ $trainer->emer_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mobile No</th>
                                                        <td>{{ $trainer->emer_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Relationship</th>
                                                        <td>{{ $trainer->emer_relationship }}</td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="office_use_only">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>Department</th>
                                                            <td>{{ $trainer->department }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Work Location</th>
                                                            <td>{{ $trainer->work_location }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Trainer Type</th>
                                                            <td>{{ $trainer->emp_type == 1 ? "FreeLancer" : "Fixed" }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email Address</th>
                                                            <td>{{ $trainer->office_use_email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Joining Date</th>
                                                            <td>{{ $str = str_replace(',', ' to ', $trainer->joining_date) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>I-Card</th>
                                                            <td>{{$trainer->i_card_date ?  date('d-m-Y', strtotime($trainer->i_card_date)) : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>I-Card Return Date</th>
                                                            <td>{{ $trainer->i_card_return_date ? date('d-m-Y', strtotime($trainer->i_card_return_date)) : ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>I-Card Note</th>
                                                            <td>{{ $trainer->i_card_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uniform</th>
                                                            <td>{{ $trainer->uniform_date ? date('d-m-Y', strtotime($trainer->uniform_date)) : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uniform Return Date</th>
                                                            <td>{{ $trainer->uniform_return_date ? date('d-m-Y', strtotime($trainer->uniform_return_date)) : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uniform Note</th>
                                                            <td>{{ $trainer->uniform_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Material</th>
                                                            <td>{{ $trainer->material_date ? date('d-m-Y', strtotime($trainer->material_date)) : ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Material Return Date</th>
                                                            <td>{{ $trainer->material_return_date ?  date('d-m-Y', strtotime($trainer->material_return_date)) : ''}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>Material Note</th>
                                                            <td>{{ $trainer->material_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Offer Letter</th>
                                                            <td>{{ $trainer->offer_letter_date ? date('d-m-Y', strtotime($trainer->offer_letter_date)) : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Offer Letter Note</th>
                                                            <td>{{ $trainer->offer_letter_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Bond</th>
                                                            <td>{{ $trainer->bond_date ? date('d-m-Y', strtotime($trainer->bond_date)) : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Bond Note</th>
                                                            <td>{{ $trainer->bond_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Petrol Allowance</th>
                                                            <td>{{ $trainer->petrol_allowance }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Incentive</th>
                                                            <td>{{ $trainer->incentive }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Other allowance</th>
                                                            <td>{{ $trainer->other_allowance }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Branch Name</th>
                                                            <td>{{ $trainer->branch->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Course(s)</th>
                                                            <td>
                                                                @if (json_decode($trainer->course_id) != null)
                                                                    <ul>
                                                                        @foreach ($courseNames as $courseName)
                                                                            <li>{{ $courseName }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    No courses assigned
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Role</th>
                                                            <td>{{$trainer->user->roles->first()->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            @if($trainer->is_active == '0')
                                                                <td>Active</td>
                                                            @else
                                                                <td> Deactive </td>
                                                            @endif
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="document">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>Aadhaar Card</th>
                                                            <td>
                                                                @if ($trainer->aadhaar_card)
                                                                    <a  class="btn btn-outline-dark fa fa-eye" href="{{ asset('assets/trainer/' . $trainer->aadhaar_card) }}" target="_blank"></a>
                                                                    <a class="btn btn-outline-dark" href="{{ asset('assets/trainer/' . $trainer->aadhaar_card) }}" download>Download</a>
                                                                @else
                                                                    No image available
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Marksheet Photo</th>
                                                            <td>
                                                                @if ($trainer->last_edu_markSheet)
                                                                    <a class="btn btn-outline-dark fa fa-eye" href="{{ asset('assets/trainer/' . $trainer->last_edu_markSheet) }}" target="_blank"></a>
                                                                    <a class="btn btn-outline-dark" href="{{ asset('assets/trainer/' . $trainer->last_edu_markSheet) }}" download>Download</a>
                                                                @else
                                                                    No image available
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Bank-Passbook</th>
                                                            <td>
                                                                @if ($trainer->bank_passbook)
                                                                    <a class="btn btn-outline-dark fa fa-eye" href="{{ asset('assets/trainer/' . $trainer->bank_passbook) }}" target="_blank"></a>
                                                                    <a class="btn btn-outline-dark" href="{{ asset('assets/trainer/' . $trainer->bank_passbook) }}" download>Download</a>
                                                                @else
                                                                    No image available
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <table class="table table-hover">
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $rtcId = [];
                        @endphp
                        <div class="card">
                            @foreach($tarinerSlot as $key => $slot)
                            @if(!in_array($slot->rtc_id,$rtcId))
                                <div class="card-header">
                                    <h3 class="card-title"><b>RTC : </b>{{ $slot->rtc->rtc_name }}</h3>
                                </div>
                            @endif
                                <div class="card-body">
                                    <h6 class="border-bottom pb-2"><b>Slot : </b>{{ $slot->slot_time }}</h6>
                                    @if($slot->slotList->isNotEmpty())
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Meduim</th>
                                                    <th>Standard</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($slot->slotList as $student)
                                                    <tr>
                                                        <td>{{ $student->student->name }} {{ $student->student->surname }}</td>
                                                        <td>{{ $student->student->medium }}</td>
                                                        <td>{{ $student->student->standard }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                    @php
                                        $rtcId[] = $slot->rtc_id;
                                    @endphp
                                    <!-- /.card-header -->
                                @endforeach
                             <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                @if($trainerAttendance->isNotEmpty())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
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
                                                <button type="button" class="btn btn-primary search-btn">
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
                                                    <td>{{ $attendance->slots->slot_time ?? '' }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($attendance->date))  ?? ''}}</td>
                                                    <td>
                                                        @if($attendance->status == 'A')
                                                            Absent
                                                        @else
                                                            Present
                                                        @endif
                                                    </td>
                                                    <td>{{ $attendance->slot_type ?? '' }}</td>
                                                    <td>
                                                        @if($attendance->absent_reason !== null)
                                                            {{ $attendance->absent_reason  ?? ''}}
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
                @endif
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $('body').on('click', '.search-btn',  function(){
            var baseurl = "{{ asset('/') }}";
            var fromDate = $("#from_date").val();
            var toDate = $("#to_date").val();
            var trainer_id = $('#trainer_id').val();
            console.log(trainer_id);
            var url = baseurl + "trainer/" + trainer_id + "?fromDate=" + fromDate + "&toDate=" + toDate;
            window.location = url;
        });
    </script>
@endpush

