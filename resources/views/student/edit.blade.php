@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Update Form</h1>
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
                    <div class="col-md-12">
                        <div class="card card-primary">
                            {{--                            {!! Form::open(array('route' => 'student.store','method'=>'POST')) !!}--}}
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Student Information</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Office Use Only</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#office-use-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="office-use-part" id="office-use-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Image and Upload file</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <form method="POST" id="quickForm" action="{{route('student.update',$student->id)}}"
                                          enctype="multipart/form-data"
                                          class="needs-validation" novalidate>
                                        @csrf
                                        @method('PUT')
                                        <div id="logins-part" class="content" role="tabpanel"
                                             aria-labelledby="logins-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Form no:</label>
                                                            <input type="text" id="form_no" class="form-control " value="{{ $student->form_no }}" name="form_no" readonly>
                                                            @error('form_no')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">

                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-group">
                                                            <label for="dob">Registration Date:</label>
                                                            <input type="date" class="form-control" name="registration_date" readonly
                                                                    value="{{ $student->registration_date ? Carbon\Carbon::parse($student->registration_date)->format('Y-m-d') : date('Y-m-d')}}" id="registration_date">
                                                            @error('registration_date')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Surname:</label>
                                                            <input type="text" id="simpleinput"
                                                                   class="form-control "
                                                                   value="{{ $student->surname }}"
                                                                   name="surname" placeholder="enter surname"
                                                                   required>
                                                            @error('surname')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Student Name:</label>
                                                            <input type="text" id="simpleinput" class="form-control"
                                                                   name="name"
                                                                   value="{{ $student->name }}"
                                                                   placeholder="enter name" required>
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Father Name:</label>
                                                            <input type="text" id="simpleinput" class="form-control"
                                                                   name="father_name"
                                                                   value="{{ $student->father_name }}"
                                                                   placeholder="enter father name" required>
                                                            @error('father_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="address">Address:</label>
                                                            <textarea name="address" class="form-control"
                                                                      placeholder="enter address">{{ $student->address }}</textarea>
                                                            @error('address')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-3">
                                                            <label for="inputMailForm">Email ID:</label>
                                                            <input type="email" class="form-control" name="email_id"
                                                                   placeholder="enter email"
                                                                   value="{{ $student->email_id }}">
                                                            @error('email_id')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="standard">Standard:</label>
                                                            <input type="number" class="form-control" min="1" max="12"
                                                                   name="standard"
                                                                   placeholder="enter standard"
                                                                   value="{{ $student->standard }}">
                                                            @error('standard')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Mother Contact No:</label>
                                                            <input type="tel" class="form-control"
                                                                   name="mother_contact_no"
                                                                   placeholder="1234567890"
                                                                   id="mother_contact_no"
                                                                   value="{{ $student->mother_contact_no }}">
                                                            @error('mother_contact_no')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Father Contact No:</label>
                                                            <input type="tel" class="form-control"
                                                                   name="father_contact_no"
                                                                   placeholder="1234567890"
                                                                   id="father_contact_no"
                                                                   value="{{ $student->father_contact_no }}">
                                                            @error('father_contact_no')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="gender">Gender:</label>
                                                            <br/>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check" type="radio" name="gender"
                                                                       id="gender_male"
                                                                       value="male" {{ $student->gender =='male' ?'checked' : '' }} >
                                                                <label class="form-check-label" for="gender_male">&nbsp;&nbsp;
                                                                    Male
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="gender"
                                                                       id="gender_female"
                                                                       value="female" {{ $student->gender =='female' ?'checked' : '' }} >
                                                                <label class="form-check-label" for="gender_female">
                                                                    Female
                                                                </label>
                                                            </div>
                                                            @error('gender')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="medium">Medium:</label>
                                                            <br>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" name="medium" value="gujarati"
                                                                       {{ $student->medium == 'gujarati' ? 'checked' :'' }}
                                                                       class="form-check-input medium-list">
                                                                <label class="form-check-label"
                                                                       for="medium_gujarati">
                                                                    Gujarati
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" name="medium" value="hindi"
                                                                       {{ $student->medium == 'hindi' ? 'checked' :'' }}
                                                                       class="form-check-input medium-list">
                                                                <label class="form-check-label" for="medium_hindi">
                                                                    Hindi
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" name="medium" value="english"
                                                                       {{ $student->medium == 'english' ? 'checked' :'' }}
                                                                       class="form-check-input medium-list">
                                                                <label class="form-check-label"
                                                                       for="medium_english">
                                                                    English
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" name="medium" value="gujlish"
                                                                       {{ $student->medium == 'gujlish' ? 'checked' :'' }}
                                                                       class="form-check-input medium-list">
                                                                <label class="form-check-label"
                                                                       for="medium_gujlish">
                                                                    Gujlish
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" name="medium" value="other"
                                                                       {{ $student->medium == 'other' ? 'checked' :'' }}
                                                                       class="form-check-input medium-list">
                                                                <label class="form-check-label"
                                                                       for="medium_other">
                                                                    Other
                                                                </label>
                                                            </div>
                                                            @error('medium')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label for="school name">School Name:</label>
                                                            <input type="text" class="form-control"
                                                                   name="school_name"
                                                                   placeholder="enter school name"
                                                                   value="{{ $student->school_name }}">
                                                            @error('school_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @php
                                                        $seperateSchlTime = explode('-', $student->school_time);
                                                    @endphp
                                                    <div class="form-group  col-md-6">
                                                        <label for="inputEmail3" class=" col-form-label">School
                                                            Time:</label>
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="input-group date" id="timepicker"
                                                                     data-target-input="nearest">
                                                                    <input type="text"
                                                                           class="form-control datetimepicker-input"
                                                                           name="school_time_to"
                                                                           value="{{ $seperateSchlTime[0] }}"
                                                                           aria-describedby="button-addon2"
                                                                           data-target="#timepicker"/>
                                                                    <div class="input-group-append"
                                                                         data-target="#timepicker"
                                                                         data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i
                                                                                class="far fa-clock"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2"
                                                                 style="display: flex;justify-content: space-around;">
                                                                <p>to</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="input-group date" id="timepicker1"
                                                                     data-target-input="nearest">
                                                                    <input type="text"
                                                                           class="form-control datetimepicker-input"
                                                                           name="school_time_from"
                                                                           value="{{ $seperateSchlTime[1] }}"
                                                                           aria-describedby="button-addon2"
                                                                           data-target="#timepicker1"/>
                                                                    <div class="input-group-append"
                                                                         data-target="#timepicker1"
                                                                         data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i
                                                                                class="far fa-clock"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $seperateTuitionTime = explode('-', $student->extra_tuition_time);
                                                    @endphp
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail3" class="col-form-label">Extra
                                                            Tuition
                                                            Time:</label>
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="input-group date" id="timepicker2"
                                                                     data-target-input="nearest">
                                                                    <input type="text"
                                                                           class="form-control datetimepicker-input"
                                                                           name="extra_tuition_time_to"
                                                                           value="{{$seperateTuitionTime[0]}}"
                                                                           aria-describedby="button-addon2"
                                                                           data-target="#timepicker2"/>
                                                                    <div class="input-group-append"
                                                                         data-target="#timepicker2"
                                                                         data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i
                                                                                class="far fa-clock"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2 mt-2"
                                                                 style="display: flex;justify-content: space-around;">
                                                                <p>to</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="input-group date" id="timepicker3"
                                                                     data-target-input="nearest">
                                                                    <input type="text"
                                                                           class="form-control datetimepicker-input"
                                                                           name="extra_tuition_time_from"
                                                                           value="{{$seperateTuitionTime[1]}}"
                                                                           aria-describedby="button-addon2"
                                                                           data-target="#timepicker3"/>
                                                                    <div class="input-group-append"
                                                                         data-target="#timepicker3"
                                                                         data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i
                                                                                class="far fa-clock"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group">
                                                            <label for="dob">Date Of Birth:</label>
                                                            <input type="date" class="form-control" name="dob"
                                                                   placeholder="enter birthdate" id="dob"
                                                                   value="{{Carbon\Carbon::parse($student->dob)->format('Y-m-d')}}">
                                                            @error('dob')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="age">Age:</label>
                                                            <input type="number" name="age" id="age" min="1" max="20"
                                                                   onkeyup="ageValidation()"
                                                                   class="form-control"
                                                                   placeholder="enter age" value="{{$student->age}}">
                                                            @error('age')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="course_name">Course Name:</label>
                                                            <br>
                                                            <select name="course_id[]" multiple="" class="form-control select2 course_id " id="course_id">
                                                                <option value="">----- Course Name -----</option>
                                                                @foreach($course as $key=>$c)
                                                                    <option value="{{$c->id}}"
                                                                        @if(in_array($c->id, $courseID)) selected @endif>{{$c->course_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('course_id')
                                                                <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="course_material_string" id="course_material_string" class="form-control" value="{{implode(",",$courseMaterialIds)}}">
                                                    <div class="col-md-6 mb-1">
                                                        <label for="course_material">Course Material:</label>
                                                        <div id="empty_course_material">
                                                            <div class="form-check">                                                            
                                                                @foreach ($courseWiseMaterial as $courseMaterial)
                                                                    <input class="form-check-input course_material" type="checkbox" id="course_material"
                                                                        data-course-id="{{ $courseMaterial->course_id }}" name="course_material[]"  value="{{ $courseMaterial->id }}"
                                                                        @if(in_array($courseMaterial->id, $courseMaterialIds)) checked @endif>
                                                                        <label class="form-check-label" for="course_material">
                                                                            {{ $courseMaterial->material_name }}
                                                                        </label>
                                                                    <br>
                                                                @endforeach
                                                            </div>
                                                        </div>   
                                                        <div id="append_course_material">
                                                                
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                        class="btn btn-primary float-right btn-next-form nxtbt next-btn">
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                             aria-labelledby="information-part-trigger">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="demo">Demo Taken By:</label>
                                                            <br>
                                                            <select name="demo_trainer_id"
                                                                    class="form-control select2">
                                                                <option value="">---- Select Trainer ----</option>
                                                                @foreach($trainer as $key=>$t)
                                                                    <option
                                                                        value="{{$t->id}}"
                                                                        @if($student->demo_trainer_id==$t->id) selected @endif>{{$t->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Demo Counselling By:</label>
                                                            <input type="text" class="form-control"
                                                                   name="demo_counselling_by"
                                                                   value="{{$student->counselling_by}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Reference By:</label>
                                                            <input type="text" class="form-control"
                                                                   name="reference_by"
                                                                   value="{{$student->reference_by}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="name">Analysis Trainer Name: </label>
                                                            <select class="form-control select2"
                                                                    name="analysis_trainer_id">
                                                                <option value="">------ Select Trainer -----</option>
                                                                @foreach($trainer as $key=>$t)
                                                                    <option
                                                                        value="{{$t->id}}"
                                                                        @if($student->analysis_trainer_id== $t->id) selected @endif>{{$t->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="payment">Payment Condition:</label>
                                                            <input type="text" name="payment_condition"
                                                                   class="form-control"
                                                                   placeholder="enter payment condition"
                                                                   value="{{$student->payment_condition}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="role">Role name:</label>
                                                            <select class="form-control select2" name="role" required>
                                                                <option value="">------ Select Role ------</option>
                                                                @foreach($role as $key=> $r)
                                                                    <option
                                                                        value="{{$r->id}}"
                                                                        @if($student->user->roles->first()->id == $r->id) selected @endif>{{$r->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="inputtext">Branch
                                                                Name:</label>
                                                            <select class="form-control select2" name="branch_id"
                                                                    required>
                                                                <option value="">--- Select Branch ---</option>
                                                                @foreach($branch as $key => $b)
                                                                    <option
                                                                        value="{{ $b->id }}" {{ old('branch_id',$student->branch_id)==$b->id?'selected':'' }}>{{ $b->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <label for="fees">Form Fees:</label>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" value="paid"
                                                                   {{$student->fees == 'paid'?'checked' :''}} name="fees"
                                                                   class="form-check">&nbsp;&nbsp;
                                                            <label class="form-check-label"
                                                                   for="medium_hindi" {{ old("fees") == 'paid' ? 'checked' : '' }}>
                                                                Paid
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" value="unpaid"
                                                                   {{$student->fees == 'unpaid'?'checked' :''}} name="fees"
                                                                   class="form-check-input">
                                                            <label class="form-check-label" for="medium_hindi">
                                                                Unpaid
                                                            </label>
                                                        </div>
                                                        @error('fees')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="fees">DMIT</label>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" name="fp"
                                                                               {{ $studentDmit->fp == 1 ? 'checked' :'' }}
                                                                               class="form-check">&nbsp;&nbsp;
                                                                        <label class="form-check-label"
                                                                               for="fp">
                                                                            FP
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control" name="fp_date"
                                                                               value="{{ $studentDmit->fp_date }}" id="fp_date">
                                                                        @error('fp_date')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" name="report"
                                                                               {{ $studentDmit->report == 1 ? 'checked' :'' }}
                                                                               class="form-check">&nbsp;&nbsp;
                                                                        <label class="form-check-label"
                                                                               for="report">
                                                                            Report
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control" name="report_date"
                                                                                value="{{ $studentDmit->report_date }}" id="report_date">
                                                                        @error('report_date')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" name="key_point"
                                                                               class="form-check" {{ $studentDmit->key_point == 1 ? 'checked' :'' }}>&nbsp;&nbsp;
                                                                        <label class="form-check-label"
                                                                               for="fp">
                                                                            Key Point
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control" name="key_point_date"
                                                                               min="{{ date('Y-m-d') }}"  id="key_point_date" value="{{ $studentDmit->key_point_date }}">
                                                                        @error('key_point_date')
                                                                            <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" name="counselling_by"
                                                                               {{ $studentDmit->counselling_by == 1 ? 'checked' :'' }}
                                                                               class="form-check">&nbsp;&nbsp;
                                                                        <label class="form-check-label"
                                                                               for="counselling_by">
                                                                            Counselling Date
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control" name="counselling_date"
                                                                               value="{{ $studentDmit->counselling_date }}" id="counselling_date">
                                                                        @error('counselling_date')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" name="counselling_by_trainer"
                                                                               class="form-check" {{ $studentDmit->counselling_by_trainer == 1 ? 'checked' :'' }}>&nbsp;&nbsp;
                                                                        <label class="form-check-label"
                                                                               for="counselling_by_trainer">
                                                                            Counselling By Trainer
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <select name="counselling_by_trainer_name"
                                                                                class="form-control select2">
                                                                            <option value="">---- Select Trainer ----</option>
                                                                            @foreach($trainer as $key=>$t)
                                                                                <option
                                                                                    value="{{$t->id}}"
                                                                                    @if($student->demo_trainer_id==$t->id) selected @endif>{{$t->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <label for="note">Extra Note:</label>
                                                        <textarea name="extra_note"
                                                                  class="form-control">{{$student->extra_note}}</textarea>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                        class="btn btn-primary float-right nxtbt  ml-2 next-btn">
                                                    Next
                                                </button>
                                                <button type="button" class="btn btn-primary prvBtn float-right"
                                                        onclick="stepper.previous()">Previous
                                                </button>
                                            </div>
                                        </div>
                                        <div id="office-use-part" class="content" role="tabpanel"
                                             aria-labelledby="office-use-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="simpleinput">STF:</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label>Gujarati</label>
                                                            <textarea id="summernote1" name="stf_gujarati">{{ $studentDmit->stf_gujarati }}</textarea>
                                                            @error('stf_gujarati')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label>Hindi</label>
                                                            <textarea id="summernote2" name="stf_hindi" >{{ $studentDmit->stf_hindi }}</textarea>
                                                            @error('stf_hindi')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label >English</label>
                                                            <textarea id="summernote3" name="stf_english">{{ $studentDmit->stf_english }}</textarea>
                                                            @error('stf_english')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label >Maths</label>
                                                            <textarea id="summernote4" name="stf_maths">{{ $studentDmit->stf_maths }}</textarea>
                                                            @error('stf_maths')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label>SeIf Development</label>
                                                            <textarea id="summernote5" name="stf_self_development">{{ $studentDmit->stf_self_development }}</textarea>
                                                            @error('stf_self_development')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label>Others</label>
                                                            <textarea id="summernote6" name="stf_others">{{ $studentDmit->stf_others }}</textarea>
                                                            @error('stf_others')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-group mb-2">
                                                            <label for="student image">Student Profile Photo:</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="upload_student_image"
                                                                       class="custom-file-input filePhoto"
                                                                       id="image" accept="image/*">
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                                <div id="editImageContainer">
                                                                    <img src="{{asset('assets/student/images/'. $student->upload_student_image )}}"
                                                                    width="100" height="100">
                                                                </div>   
                                                                <div style="display: none;" id="imageContainer">
                                                                    <img id="previewHolder" alt="Uploaded Image Preview Holder" width="100px" height="100px"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-group mb-2">
                                                            <label for="pdf">Student Analysis PDF:</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="upload_analysis"
                                                                       class="custom-file-input"
                                                                       accept="application/pdf"
                                                                       placeholder="enter pdf">
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                                <a href="{{asset('assets/student/pdf/'. $student->upload_analysis )}}">{{( str_replace("assets/student/pdf/","",$student->upload_analysis))}}</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <button type="submit"
                                                        class="btn btn-success float-right ml-2 next-btn1">Update
                                                </button>
                                                <button type="button" class="btn btn-primary prvBtn float-right ml-2"
                                                        onclick="stepper.previous()">Previous
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('.medium-list').on('change', function() {
            $('.medium-list').not(this).prop('checked', false);
        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        $(document).ready(function () {
            $('#summernote1').summernote({
                height: 150
            });
            $('#summernote2').summernote({
                height: 150
            });
            $('#summernote3').summernote({
                height: 150
            });
            $('#summernote4').summernote({
                height: 150
            });
            $('#summernote5').summernote({
                height: 150
            });
            $('#summernote6').summernote({
                height: 150
            });

            //script for image preview
            function readURL(input) {
                $('#editImageContainer').css('display','none');
                $('#imageContainer').css('display','block');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewHolder').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('select a file to see preview');
                    $('#previewHolder').attr('src', '');
                }
            }

            $(".filePhoto").change(function() {
                readURL(this);
            });

            $('#timepicker').datetimepicker({
                format: 'LT'
            })
            $('#timepicker1').datetimepicker({
                format: 'LT'
            })
            $('#timepicker2').datetimepicker({
                format: 'LT'
            })
            $('#timepicker3').datetimepicker({
                format: 'LT'
            })
            var form = $('#quickForm');
            var validator = form.validate({
                rules: {
                    surname: {
                        required: true,
                        maxlength: 255,
                    },
                    name: {
                        required: true,
                        maxlength: 255,
                    },
                    father_name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    fees: {
                        required: true,
                    },
                    father_contact_no: {
                        required: true,
                        maxlength: 10,
                        number : true,
                    },
                    mother_contact_no: {
                        required: true,
                        maxlength: 10,
                        number : true,
                    },
                    standard: {
                        required: true,
                    },
                    medium: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    age: {
                        required: true,
                    },
                },
                messages: {
                    surname: {
                        required: "Please enter a surname ",
                    },
                    name: {
                        required: "Please enter a name ",
                    },
                    father_name: {
                        required: "Please enter a father name ",
                    },
                    address: {
                        required: "Please enter a address ",
                    },
                    gender: {
                        required: "Please select a gender ",
                    },
                    fees: {
                        required: "Please select a fees ",
                    },
                    father_contact_no: {
                        required: "Please enter a father_contact_no ",
                    },
                    mother_contact_no: {
                        required: "Please enter a mother_contact_no ",
                    },
                    standard: {
                        required: "Please enter a standard ",
                    },
                    medium: {
                        required: "Please enter a medium ",
                    },
                    dob: {
                        required: "Please enter a dob ",
                    },
                    age: {
                        required: "Please enter a age ",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $('.next-btn').click(function () {
                var isValid = form.valid();
                if (isValid) {
                    stepper.next()
                    resetValidation(form)
                }
            });
            $('.next-btn1').click(function () {
                // alert('s')
                var isValid = form.valid();
                if (isValid) {
                    form.submit()
                }
            });

            function resetValidation(form) {
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').remove();
            }
        });

        $(document).ready(function() {
            $('#dob').on('change', function() {
                var dob = new Date($(this).val());
                var today = new Date();
                var age = today.getFullYear() - dob.getFullYear();
                // Adjust age based on the month and day
                if (today.getMonth() < dob.getMonth() ||
                    (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }
                $('#age').val(age);
            });

            $(".getDeleteCourseId").on("select2:select select2:unselect", function (e) {
                var lastSelectedItem = e.params.data.id;
                $('.course_material').each(function() {
                    var courseId = $(this).data('course-id');
                    if(lastSelectedItem == courseId ){
                        $(this).closest('div.form-check').remove();
                    }
                });
            });
        
            //append course_material according to change meduim and course
            $('body').on("change", ".medium-list, #course_id", function(){
                $('#empty_course_material').empty();
                $('#append_course_material').empty();
                var medium_id = $('input[name="medium"]:checked').val();
                var course_material_string = $('#course_material_string').val();
                var course_id = $('.course_id option:selected').map(function () {
                    return $(this).val();
                }).get();

                $.ajax({
                    url : "{{ route('student.getCourseMaterialData') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    data: {
                        'course_id': course_id,
                        'medium_id' : medium_id,
                        'course_material_string' : course_material_string
                    },
                    success: function (data) {
                        $('#append_course_material').append(data);
                    },
                    error: function (err) {
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });

    </script>
@endpush
