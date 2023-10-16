@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Student</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student.index') }}">Show Student
                                    List</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
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
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Office Use Only</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#office-use-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="office-use-part" id="office-use-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Image and Upload file</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <form action="{{route('student.store')}}" method="POST" id="quickForm" class="needs-validation" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Form no:</label>
                                                            <input type="text" id="form_no" class="form-control " value="{{ old('form_no', $last_id) }}" name="form_no" required>
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
                                                            <input type="date" class="form-control" name="registration_date"
                                                                   min="{{ date('Y-m-d') }}" value="{{ old('registration_date',date('Y-m-d')) }}" id="registration_date">
                                                            @error('registration_date')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Surname:</label>
                                                            <input type="text" id="simpleinput" class="form-control " value="{{ old('surname') }}" name="surname" placeholder="enter surname" required>
                                                            @error('surname')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Student Name:</label>
                                                            <input type="text" id="simpleinput" class="form-control" name="name" value="{{ old('name') }}" placeholder="enter name" required>
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Father Name:</label>
                                                            <input type="text" id="simpleinput" class="form-control" name="father_name" value="{{ old('father_name') }}" placeholder="enter father name" required>
                                                            @error('father_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="address">Address:</label>
                                                            <textarea name="address" class="form-control"
                                                                      placeholder="enter address">{{ old('address') }}</textarea>
                                                            @error('address')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-3">
                                                            <label for="email">Email ID:</label>
                                                            <input type="email" class="form-control" name="email_id"
                                                                   placeholder="enter email"
                                                                   value="{{ old('email_id') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="standard">Standard:</label>
                                                            <input type="number" class="form-control" max="12" min="1"
                                                                   name="standard"
                                                                   placeholder="enter standard"
                                                                   value="{{ old('standard') }}">
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
                                                                   value="{{ old('mother_contact_no') }}">
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
                                                                   value="{{ old('father_contact_no') }}">
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
                                                                       id="gender_male" required
                                                                       {{ old("gender") == 'male' ? 'checked' : '' }}
                                                                       value="male">&nbsp;&nbsp;
                                                                <label class="form-check-label" for="gender_male">
                                                                    Male
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="gender"
                                                                       id="gender_female" required
                                                                       {{ old("gender") == 'female' ? 'checked' : '' }}
                                                                       value="female">
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
                                                                <input type="checkbox" value="gujarati" 
                                                                       {{ old("medium") === 'gujarati' ? 'checked' : '' }}
                                                                       name="medium"
                                                                       class="form-check medium-list" id="medium-list">
                                                                <label class="form-check-label"
                                                                       for="medium_gujarati">&nbsp;&nbsp;
                                                                    Gujarati
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" value="hindi"
                                                                       {{ old("medium") === 'hindi' ? 'checked' : '' }} name="medium"
                                                                       class="form-check-input medium-list" id="medium-list">
                                                                <label class="form-check-label" for="medium_hindi">
                                                                    Hindi
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" value="english"
                                                                       {{ old("medium") === 'english' ? 'checked' : '' }} name="medium"
                                                                       class="form-check-input medium-list" id="medium-list">
                                                                <label class="form-check-label"
                                                                       for="medium_english">
                                                                    English
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" value="gujlish"
                                                                       {{ old("medium") === 'gujlish' ? 'checked' : '' }} name="medium"
                                                                       class="form-check-input medium-list" id="medium-list">
                                                                <label class="form-check-label"
                                                                       for="medium_gujlish">
                                                                    Gujlish
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" value="other"
                                                                       {{ old("medium") === 'other' ? 'checked' : '' }} name="medium"
                                                                       class="form-check-input medium-list" id="medium-list">
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
                                                                   value="{{ old('school_name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <label for="inputEmail3" class="col-form-label">School
                                                            Time:</label>
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <div class="input-group date" id="timepicker"
                                                                         data-target-input="nearest">
                                                                        <input type="text"
                                                                               class="form-control datetimepicker-input"
                                                                               name="school_time_to"
                                                                               value="{{ old('school_time_to') }}"
                                                                               aria-describedby="button-addon2"
                                                                               data-target="#timepicker"/>
                                                                        <div class="input-group-append"
                                                                             data-target="#timepicker"
                                                                             data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i
                                                                                    class="far fa-clock"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2"
                                                                 style="display: flex;justify-content: space-around;">
                                                                <p>to</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <div class="input-group date" id="timepicker1"
                                                                         data-target-input="nearest">
                                                                        <input type="text"
                                                                               class="form-control datetimepicker-input"
                                                                               name="school_time_from"
                                                                               value="{{ old('school_time_from') }}"
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
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail3" class="col-form-label">Extra
                                                            Tuition
                                                            Time:</label>
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <div class="input-group date" id="timepicker2"
                                                                         data-target-input="nearest">
                                                                        <input type="text"
                                                                               class="form-control datetimepicker-input"
                                                                               name="extra_tuition_time_to"
                                                                               value="{{ old('extra_tuition_time_to') }}"
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
                                                            </div>
                                                            <div class="col-sm-2 mt-2"
                                                                 style="display: flex;justify-content: space-around;">
                                                                <p>to</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <div class="input-group date" id="timepicker3"
                                                                         data-target-input="nearest">
                                                                        <input type="text"
                                                                               class="form-control datetimepicker-input"
                                                                               name="extra_tuition_time_from"
                                                                               value="{{ old('extra_tuition_time_from') }}"
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
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group">
                                                            <label for="dob">Date Of Birth:</label>
                                                            <input type="date" class="form-control" name="dob"
                                                                   placeholder="enter birthdate"
                                                                    id="dob">
                                                            @error('dob')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="age">Age:</label>
                                                            <input type="number" name="age" id="age" min="1" max="20"
                                                                   class="form-control"
                                                                   placeholder="enter age" value="{{ old('age') }}">
                                                            @error('age')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1" >
                                                        <div class="form-group">
                                                            <label for="course_name">Course Name:</label>
                                                            <br>
                                                            <select name="course_id[]" multiple="" class="form-control select2 course_id" id="course_id"
                                                                    required disabled>
                                                                <option value="">----- Course Name -----</option>
                                                                @foreach($course as $key=>$c)
                                                                    <option
                                                                        value="{{$c->id}}" {{ old('course_id')==$c->id?'selected':'' }}>{{$c->course_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('course_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="course_material">Course Material: </label><br>
                                                            <div id="course_material">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary float-right btn-next-form nxtbt next-btn">Next</button>
                                            </div>
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
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
                                                                        value="{{$t->id}}"{{ old('demo_trainer_id')==$t->id?'selected':'' }}>{{$t->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="counselling_by">Demo Counselling By:</label>
                                                            <input type="text" class="form-control"
                                                                   name="counselling_by"
                                                                   value="{{ old('counselling_by') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Reference By:</label>
                                                            <input type="text" class="form-control"
                                                                   name="reference_by"
                                                                   value="{{ old('reference_by') }}">
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
                                                                        value="{{$t->id}}" {{ old('analysis_trainer_id')==$t->id?'selected':'' }}>{{$t->name}}</option>
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
                                                                   value="{{ old('payment_condition') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="role">Role name:</label>
                                                            <select class="form-control select2" name="role" required>
                                                                <option value="">------ Select Role ------</option>
                                                                @foreach($role as $key=> $r)
                                                                    <option
                                                                        value="{{$r->id}}"{{ old('role') == $r->id || strtolower($r->name) ==='student' ? 'selected' :'' }}>{{$r->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('role')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="inputtext" class="col-sm-3 col-form-label">Branch
                                                                Name:</label>
                                                            <select class="form-control select2" name="branch_id"
                                                                    required>
                                                                <option value="">--- Select Branch ---</option>
                                                                @foreach($branch as $key => $b)
                                                                    <option
                                                                        value="{{ $b->id }}" {{ old('branch_id')==$b->id?'selected':'' }}>{{ $b->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="fees">Form Fees:</label>
                                                            <br>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" value="paid" name="fees"
                                                                       {{ old('fees') == 'paid' ? 'checked' : '' }}
                                                                       class="form-check">&nbsp;&nbsp;
                                                                <label class="form-check-label"
                                                                       for="medium_hindi">
                                                                    Paid
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" value="unpaid" name="fees"
                                                                       class="form-check-input"
                                                                       {{ old('fees') == 'unpaid' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="medium_hindi">
                                                                    Unpaid
                                                                </label>
                                                            </div>
                                                            @error('fees')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="fees">DMIT</label>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" name="fp"
                                                                               {{ old('fp') == 1 ? 'checked' : '' }}
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
                                                                               min="{{ date('Y-m-d') }}"  id="fp_date">
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
                                                                               {{ old('report') == 1 ? 'checked' : '' }}
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
                                                                               min="{{ date('Y-m-d') }}" id="fp_date">
                                                                        @error('report_date')
                                                                            <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" name="counselling_by"
                                                                               {{ old('counselling_by') == 1 ? 'checked' : '' }}
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
                                                                               min="{{ date('Y-m-d') }}"  id="fp_date">
                                                                        @error('counselling_date')
                                                                            <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-group">
                                                            <label for="note">Extra Note:</label>
                                                            <textarea name="extra_note"
                                                                      class="form-control">{{ old('extra_note') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary float-right nxtbt  ml-2 next-btn">Next</button>
                                                <button type="button" class="btn btn-primary prvBtn float-right" onclick="stepper.previous()">Previous</button>
                                            </div>
                                        </div>
                                        <div id="office-use-part" class="content" role="tabpanel" aria-labelledby="office-use-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="stf">STF:</label>
                                                            <input type="text" class="form-control"
                                                                   name="stf"
                                                                   value="{{ old('stf') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="student image">Student Profile Photo:</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       name="upload_student_image"
                                                                       accept="image/*"
                                                                       value="{{old('upload_student_image')}}" onChange="imagePreview(this)"/>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                                {{--                                                               onchange="loadFile(event)"--}}
                                                                @error('upload_student_image')
                                                                <span class="text-danger"> {{$message}} </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img src="" alt="" id="student-photo">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="pdf">Student Analysis PDF:</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="upload_analysis"
                                                                       class="custom-file-input"
                                                                       accept="application/pdf"
                                                                       value="{{ old('upload_analysis') }}"
                                                                       placeholder="enter pdf">
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                                @error('upload_analysis')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                <button type="submit"
                                                        class="btn btn-success float-right ml-2 next-btn1">Submit
                                                </button>
                                                <button type="button"
                                                        class="btn btn-primary prvBtn float-right ml-2"
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
    <script>
        $(document).ready(function ()
        {

            // function imagePreview(input) {
            //     console.log('hii');
            //     if (input.target.files[0]) {
            //         var reader = new FileReader();
                    
            //         reader.onload = function (e) {
            //             $('#student-photo').attr('src', e.target.result);
            //         }
                    
            //         reader.readAsDataURL(input.target.files[0]);
            //     }
            // }


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
                    fees: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    age: {
                        required: true,
                    },
                    course_id: {
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
                        required: "Please select a medium ",
                    },
                    fees: {
                        required: "Please select a fees ",
                    },
                    dob: {
                        required: "Please enter a dob ",
                    },
                    age: {
                        required: "Please enter a age ",
                    },
                    course_id: {
                        required: "Please enter a course_id ",
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
            $('.next-btn').click(function () {
                var isValid = form.valid();
                if (isValid) {
                    stepper.next()
                    resetValidation(form)
                }
            });
            $('.next-btn1').click(function () {
                var isValid = form.valid();
                if (isValid) {
                    form.submit()
                }
            });

            function resetValidation(form) {
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').remove();
            }
            $('.medium-list').on('change', function () {
                $('.medium-list').not(this).prop('checked', false);
            });

        });
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
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

            $('.medium-list').on('change', function(){
                $('#course_id').prop("disabled", false);
            });

            //append course_material according to change meduim and course
            $('body').on("change", ".medium-list, #course_id", function(){
                $('#course_material').empty(); 
                var medium_id = $('input[name="medium"]:checked').val();
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
                        'medium_id' : medium_id
                    },
                    success: function (data) {
                        $('#course_material').append(data);
                    },
                    error: function (err) {
                    }
                });
            });
        });

    </script>
@endpush
