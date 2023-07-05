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
                            <div class="card-body ">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset( $student->upload_student_image )}}"
                                         alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$student->surname}} {{$student->name}}</h3>
                                <p class="text-muted text-center">Student</p>
                                <ul class="list-group  mb-3">
                                    <li class="list-group-item">
                                        <b>Course:</b> <a class="float-right">{{$student->course->course_name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Demo taken:</b> <a class="float-right">{{$student->trainer->name}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2 d-flex">
                                <ul class="nav nav-pills col-11">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal
                                            Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">School
                                            Detail</a></li>
                                </ul>
                                <a href="{{ route('student.index') }}"
                                   class="col-1 btn btn-primary float-right">Back</a>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">
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
                                                    <th><b>Fess:</b></th>
                                                    <td>{{$student->fees}}</td>
                                                    <th><b>Extra Note:</b></th>
                                                    <td>{{$student->extra_note}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Upload PDF:</b></th>
                                                    <td>{{$student->upload_analysis}}</td>
                                                    <th><b>Reference By:</b></th>
                                                    <td>{{$student->reference_by}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="timeline">
                                        <div class="post">
                                            <table class="table">
                                                <tr>
                                                    <th><b>Courses:</b></th>
                                                    <td>{{$student->course->course_name}}</td>
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
                                                    <td>{{$student->trainer->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Demo Taken By:</b></th>
                                                    <td>{{$student->trainer->name}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
