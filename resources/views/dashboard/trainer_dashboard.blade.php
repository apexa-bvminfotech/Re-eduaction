@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                                        src="{{asset('assets/trainer/'. $trainer->photo )}}" alt="Student Profile Photo">
                            </div>
                            <h3 class="profile-username text-center">{{ $trainer->name }} {{ $trainer->surname }}</h3>
                            <p class="text-muted text-center">Trainer</p>
            
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Designation : </b> <a class="float-right">{{ $trainer->designation }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Branch Name : </b> <a class="float-right">{{ $trainer->branch->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email address : </b> <a class="float-right">{{ $trainer->email_id }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Qualification : </b> <a class="float-right">{{ $trainer->qualification }}</a>
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
                            <p class="text-muted"> {{ $trainer->address }}</p>
                            <hr>
                            <strong><i class="fas fa-calendar-alt mr-1"></i>Date of Birth</strong> :  {{ date('d-m-Y',strtotime($trainer->dob)) }}
                            <hr>
                            <strong>Father Name :</strong> {{ $trainer->father_name }}
                            <hr>
                            <strong>Marital Status :</strong> {{ $trainer->marital_status == 1 ? "Married" : "Unmarried"     }}
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><b>Office Use Only :</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="post">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Department</th>
                                        <td>{{ $trainer->department }}</td>
                                        <th>Work Location</th>
                                        <td>{{ $trainer->work_location }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trainer Type</th>
                                        <td>{{ $trainer->emp_type == 1 ? "FreeLancer" : "Fixed" }}</td>
                                        <th>Email Address</th>
                                        <td>{{ $trainer->office_use_email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Joining Date</th>
                                        <td>{{ $str = str_replace(',', ' to ', $trainer->joining_date) }}</td>
                                        <th>I-Card</th>
                                        <td>{{ date('d-m-Y', strtotime($trainer->i_card_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>I-Card Return Date</th>
                                        <td>{{ date('d-m-Y', strtotime($trainer->i_card_return_date)) }}</td>
                                        <th>I-Card Note</th>
                                        <td>{{ $trainer->i_card_note }}</td>
                                    </tr>
                                    <tr>
                                        <th>Uniform</th>
                                        <td>{{ date('d-m-Y', strtotime($trainer->uniform_date)) }}</td>
                                        <th>Uniform Return Date</th>
                                        <td>{{ date('d-m-Y', strtotime($trainer->uniform_return_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Uniform Note</th>
                                        <td>{{ $trainer->uniform_note }}</td>
                                        <th>Material</th>
                                        <td>{{ date('d-m-Y', strtotime($trainer->material_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Material Return Date</th>
                                        <td>{{ date('d-m-Y', strtotime($trainer->material_return_date)) }}</td>
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