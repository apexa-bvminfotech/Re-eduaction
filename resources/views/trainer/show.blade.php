@extends('layouts.admin')

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
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('assets/trainer/' . $trainer->photo)}}"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $trainer->name }}
                                    &nbsp;{{ $trainer->surname }}</h3>

                                <p class="text-muted text-center">{{ $trainer->designation }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Employee Type</b> <a
                                            class="float-right">{{ $trainer->emp_type == 1 ? "FreeLancer" : "Fixed" }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Department</b> <a class="float-right">{{ $trainer->department }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Marital Status</b> <a
                                            class="float-right">{{ $trainer->marital_status == 1 ? "Married" : "Unmarried" }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Work Location</b> <a class="float-right">{{$trainer->work_location}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone</b> <a class="float-right">{{ $trainer->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Branch Name</b> <a class="float-right">{{ $trainer->branch->name }}</a>
                                    </li>
                                </ul>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-calendar-alt mr-1"></i>Joining Date</strong>
                                <p class="text-muted">{{ $trainer->joining_date }}</p>
                                <hr>

                                <strong><i class="fas fa-book mr-1"></i> Education</strong>
                                <p class="text-muted">{{$trainer->qualification}}</p>
                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                <p class="text-muted">{{$trainer->address}}</p>
                                <hr>

                                <strong><i class="fas fa-envelope mr-1"></i> Email Address (Office use Only)</strong>
                                <p class="text-muted">{{ $trainer->office_use_email }}</p>
                                <hr>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Employee Information</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Emergency FullName</th>
                                        <td>{{ $trainer->emer_fullName }}</td>
                                    </tr>
                                    <tr>
                                        <th>Emergency Address</th>
                                        <td>{{ $trainer->emer_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Emergency Contact</th>
                                        <td>{{ $trainer->emer_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $trainer->dob)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email address</th>
                                        <td>{{ $trainer->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Marital Status</th>
                                        <td>{{ $trainer->marital_status == 1 ? "Married" : "Unmarried" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Course</th>
                                        <td>{{ $trainer->course_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Relationship</th>
                                        <td>{{ $trainer->emer_relationship }}</td>
                                    </tr>
                                    <tr>
                                        <th>I-card Date</th>
                                        <td>From:
                                            <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->i_card_date )->format('d/m/Y') }}</b>&nbsp;To
                                            <b> {{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->i_card_return_date )->format('d/m/Y') }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>I-card Note</th>
                                        <td>{{ $trainer->i_card_note }}</td>
                                    </tr>
                                    <tr>
                                        <th>Uniform Date</th>
                                        <td>From:
                                            <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->uniform_date )->format('d/m/Y') }}</b>&nbsp;To
                                            <b> {{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->uniform_return_date )->format('d/m/Y') }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Uniform Note</th>
                                        <td>{{ $trainer->uniform_note }}</td>
                                    </tr>
                                    <tr>
                                        <th>Material Date</th>
                                        <td>From:
                                            <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->material_date )->format('d/m/Y') }}</b>&nbsp;To
                                            <b> {{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->material_return_date )->format('d/m/Y') }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Material Note</th>
                                        <td>{{ $trainer->material_note }}</td>
                                    </tr>
                                    <tr>
                                        <th>Offer-Letter Date</th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->offer_letter_date )->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Offer-Letter Note</th>
                                        <td>{{ $trainer->offer_letter_note }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bond Date</th>

                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->bond_date )->format('d/m/Y') }}</td>
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
                                        <th>Other Allowance</th>
                                        <td>{{ $trainer->other_allowance }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
