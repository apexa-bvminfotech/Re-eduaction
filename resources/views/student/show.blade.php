@extends('layouts.admin')
@section('content')
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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <h2 class="h3 mb-4 page-title">Show Student </h2>
                <a href="{{ route('student.index') }}" class="btn btn-primary">Back</a>
                <div class="my-4">
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Security</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">Notifications</a>
                        </li>
                    </ul>
                    <form>
                        <div class="row mt-5 align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    <img
                                        src="{{asset( $student->upload_student_image )}}"
                                        alt="..." class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">{{$student->surname}} {{$student->name}} {{$student->father_name}}</h4>
                                    </div>
                                </div>
{{--                                <div class="row mb-4">--}}
{{--                                    <div class="col">--}}
{{--                                        <p class="small mb-0 text-muted"><strong>Father Contact No: </strong>{{ $student->father_contact_no }}</p>--}}
{{--                                        <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>--}}
{{--                                        <p class="small mb-0 text-muted">(537) 315-1481</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <hr class="my-4">
                        <table class="table table-borderless">
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
                            </tr>
                            <tr>
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
                            <tr>
                                <th><b>Courses:</b></th>
                                <td>{{$student->course->course_name}}</td>
                            </tr>

                            <tr>
                                <th><b>Payment Condition:</b></th>
                                <td>{{$student->payment_condition}}</td>
                            </tr>
                            <tr>
                                <th><b>Analysis Staff Name:</b></th>
                                <td>{{$student->staff->staff_name}}</td>
                            </tr>
                        </table>
                    </form>
                </div> <!-- /.card-body -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div>
@endsection
