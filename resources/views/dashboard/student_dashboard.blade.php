@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @foreach ($students as $student)
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header border-bottom-0 h4">
                                    <b>{{ $student->name }} {{ $student->surname }}</b>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="h5 text-muted mb-4">Student</p>
                                            <ul class="ml-4 mb-0 fa-ul">
                                                <li class="h6 mb-3"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Email : {{ $student->email_id}}</li>
                                                <li class="h6 mb-3"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Gender : {{ $student->gender}}</li>
                                                <li class="h6 mb-3"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Date of Birth : {{ date('d-m-Y', strtotime($student->dob))}}</li>
                                                <li class="h6 mb-3"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Meduim : {{ $student->medium}}</li>
                                                <li class="h6 mb-3"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Standard : {{ $student->standard }} </li>
                                                <li class="h6 mb-3"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Age : {{ $student->age }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-6 text-center">
                                            <img class="profile-user-img img-fluid img-circle w-75 h-75"
                                                src="{{asset('assets/student/images/'. $student->upload_student_image )}}" alt="Student Profile Photo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-8 d-flex align-items-stretch flex-column">
                            <div class="card bg-light">
                                <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active bg-secondary" href="#activity" data-toggle="tab">Personal Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">School Detail</a></li>
                                </ul>
                                </div><!-- /.card-header -->
                            </div>
                        <!-- /.card -->
                        </div>
                    </div>
                @endforeach
                {{-- <div class="row">
                    <div class="col-md-3">
          
                      <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                                         src="{{asset('assets/student/images/'. $student->upload_student_image )}}" alt="Student Profile Photo">
                                </div>
                                <h3 class="profile-username text-center">{{ $student->name }} {{ $student->surname }}</h3>
                                <p class="text-muted text-center">Student</p>
                
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Email : </b> <a class="float-right">{{ $student->email_id }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender : </b> <a class="float-right">{{ $student->gender }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Meduim : </b> <a class="float-right">{{ $student->medium }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Standard : </b> <a class="float-right">{{ $student->standard }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                      <!-- /.card -->
          
                      <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address </strong>
                                <p class="text-muted"> {{ $student->address }}</p>
                                <hr>
            
                                <strong><i class="fas fa-book mr-1"></i>School Name</strong>
                                <p class="text-muted">
                                    {{ $student->school_name }}
                                </p>
                                <hr>

                                <strong><i class="fas fa-book mr-1"></i>Date of Birth</strong> :  {{ date('d-m-Y',strtotime($student->dob)) }}
                                <hr>

                                <strong><i class="fas fa-book mr-1"></i>Age :</strong> {{ $student->age }}
                                <hr>
                            <!-- /.card-body -->
                            </div>
                      <!-- /.card -->
                        </div>
                    <!-- /.col -->
                        
                    <!-- /.col -->
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Information</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">School Detail</a></li>
                        </ul>
                        </div><!-- /.card-header -->
                    </div>
                <!-- /.card -->
                </div>
            </div> --}}
        </section>
    </div>
@endsection