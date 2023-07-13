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
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('assets/trainer/' . $trainer->photo)}}"
                                         alt="User profile picture" style="width: 150px;height: 150px;">
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
                                                            <td>{{ date('d-m-Y', strtotime($trainer->i_card_date)) }}</td>
{{--                                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$trainer->i_card_date )->format('d/m/Y') }}</td>--}}
                                                        </tr>
                                                        <tr>
                                                            <th>I-Card Return Date</th>
                                                            <td>{{ date('d-m-Y', strtotime($trainer->i_card_return_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>I-Card Note</th>
                                                            <td>{{ $trainer->i_card_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uniform</th>
                                                            <td>{{ date('d-m-Y', strtotime($trainer->uniform_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uniform Return Date</th>
                                                            <td>{{ date('d-m-Y', strtotime($trainer->uniform_return_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uniform Note</th>
                                                            <td>{{ $trainer->uniform_note }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>Material</th>
                                                            <td>{{ date('d-m-Y', strtotime($trainer->material_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Material Return Date</th>
                                                            <td>{{ date('d-m-Y', strtotime($trainer->material_return_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Material Note</th>
                                                            <td>{{ $trainer->material_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Offer Letter</th>
                                                            <td>{{ date('d-m-Y', strtotime($trainer->offer_letter_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Offer Letter Note</th>
                                                            <td>{{ $trainer->offer_letter_note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Bond</th>
                                                            <td>{{ date('d-m-Y', strtotime($trainer->bond_date)) }}</td>
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
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
