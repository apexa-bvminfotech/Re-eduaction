@extends('layouts.header')
@section('content')
    {!! Form::model($student, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['student.update', $student->id]]) !!}
    <div class="card shadow mb-1">
        <div class="card-header">
            <h1><strong class="card-title">ADMISSION FORM</strong></h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{--                            <a href="{{ route('student.index') }}" class="btn btn-primary">Back</a>--}}
            <div class="flex mt-0 float-right">
                <div class="form-group">
                    <img src="{{asset( $student->upload_student_image )}}" width="150">
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary btn-rounded">
                        <label class="form-label text-white mb-1" for="customFile1">Choose file</label>
                        <input type="file" class="form-control d-none" id="customFile1" name="upload_student_image"
                               accept="image/*"
                        />
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-1">

                <div class="card-header">
                    <h2><strong class="card-title">Personal Information</strong></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Surname:</label>
                                <input type="text" id="simpleinput" class="form-control" value="{{$student->surname}}"
                                       name="surname" placeholder="enter surname" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Student Name:</label>
                                <input type="text" id="simpleinput" class="form-control" name="name"
                                       value="{{$student->name}}" placeholder="enter name" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Father Name:</label>
                                <input type="text" id="simpleinput" class="form-control" name="father_name"
                                       value="{{$student->father_name}}" placeholder="enter father name" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="address">Address:</label>
                                <textarea name="address" class="form-control"
                                          placeholder="enter address">{{$student->address}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <br/>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                           value="male" {{$student->gender =='male' ?'checked' : ''}} >
                                    <label class="form-check-label" for="gender_male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                           value="female" {{$student->gender =='female' ?'checked' : ''}} >
                                    <label class="form-check-label" for="gender_female">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="email">Email ID:</label>
                                <input type="email" class="form-control" name="email_id" placeholder="enter email"
                                       value="{{$student->email_id}}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group mb-3">
                                <label for="contact number">Father Contact No:</label>
                                <input type="text" class="form-control" name="father_contact_no"
                                       placeholder="enter father's no." id="father_contact_no"
                                       onkeypress="return isNumber(event)" minlength="10" maxlength="10"
                                       value="{{$student->father_contact_no}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group mb-3">
                                <label for="contact number">Mother Contact No:</label>
                                <input type="text" class="form-control" name="mother_contact_no"
                                       placeholder="enter mother's no." id="mother_contact_no"
                                       onkeypress="return isNumber(event)" minlength="10" maxlength="10"
                                       value="{{$student->mother_contact_no}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="standard">Standard:</label>
                            <input type="number" class="form-control" name="standard" placeholder="enter standard"
                                   value="{{$student->standard}}">
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="medium">Medium:</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" value="gujarati"
                                           {{$student->medium == 'gujarati'?'checked' :''}} name="medium"
                                           class="form-check-input">
                                    <label class="form-check-label" for="medium_gujarati">
                                        Gujarati
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" value="hindi"
                                           {{$student->medium == 'hindi'?'checked' :''}} name="medium"
                                           class="form-check-input">
                                    <label class="form-check-label" for="medium_hindi">
                                        Hindi
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" value="english"
                                           {{$student->medium == 'english'?'checked' :''}} name="medium"
                                           class="form-check-input">
                                    <label class="form-check-label" for="medium_english">
                                        English
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="school name">School Name:</label>
                            <input type="text" class="form-control" name="school_name" placeholder="enter school name"
                                   value="{{$student->school_name}}">
                        </div>
                        @php
                            $seperateSchlTime = explode('-', $student->school_time);

                        @endphp
                        <div class="form-group  col-md-6">
                            <label for="inputEmail3" class=" col-form-label">School Time:</label>
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="text" name="school_time_to" class="form-control time-input"
                                           autocomplete="off" placeholder="" aria-describedby="button-addon2"
                                           value="{{$seperateSchlTime[0]}}">
                                </div>
                                <div class="col-sm-2" style="display: flex;justify-content: space-around;">
                                    <p>to</p>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" name="school_time_to" class="form-control time-input"
                                           autocomplete="off" placeholder="" aria-describedby="button-addon2"
                                           value="{{$seperateSchlTime[1]}}">
                                </div>
                            </div>
                        </div>
                        @php
                            $seperateTuitionTime = explode('-', $student->extra_tuition_time);
                        @endphp
                        <div class="form-group col-md-6">
                            <label for="inputEmail3" class="col-form-label">Extra Tuition Time:</label>
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="text" name="extra_tuition_time_from" class="form-control time-input"
                                           autocomplete="off" placeholder="" aria-describedby="button-addon2"
                                           value="{{$seperateTuitionTime[0]}}">
                                </div>
                                <div class="col-sm-2 mt-2" style="display: flex;justify-content: space-around;">
                                    <p>to</p>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" name="extra_tuition_time_from" class="form-control time-input"
                                           autocomplete="off" placeholder="" aria-describedby="button-addon2"
                                           value="{{$seperateTuitionTime[1]}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="dob">Date Of Birth:</label>
                            <input type="date" class="form-control" name="dob" placeholder="enter birthdate"
                                   value="{{Carbon\Carbon::parse($student->dob)->format('Y-m-d')}}">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="age">Age:</label>
                            <input type="number" name="age" class="form-control" placeholder="enter age"
                                   value="{{$student->age}}">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="course_name">Course Name:</label>
                            <br>
                            <select name="course_id" class="form-control select2">
                                <option value="">-------------Course Name----------</option>
                                @foreach($course as $key=>$c)
                                    <option
                                        value="{{$c->id}}"
                                        @if($student->course_id==$c->id) selected @endif>{{$c->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="payment">Payment Condition:</label>
                            <input type="text" name="payment_condition" class="form-control"
                                   placeholder="enter payment condition" value="{{$student->payment_condition}}">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="name">Analysis Staff Name: </label>
                            <select class="form-control select2" name="analysis_staff_id">
                                <option value="">------Select Staff-----</option>
                                @foreach($staff as $key=>$s)
                                    <option value="{{$s->id}}"
                                            @if($student->analysis_staff_id== $s->id) selected @endif>{{$s->staff_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label for="pdf">Upload PDF:</label>
                            <input type="file" name="upload_analysis" class="form-control" accept="application/pdf"
                                   placeholder="enter pdf">
                            <a href="{{asset($student->upload_analysis)}}">{{( str_replace("assets/student/pdf/","",$student->upload_analysis))}}</a>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="role">Role name:</label>

                            <select class="form-control select2" name="role" required>
                                <option value="">------Select Role------</option>
                                @foreach($role as $key=> $r)
                                    <option
                                        value="{{$r->id}}"
                                        @if($student->user->roles->first()->id == $r->id) selected @endif>{{$r->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-header">
                    <h2><strong class="card-title">Office Use Only</strong></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Reference By:</label>
                                <input type="text" class="form-control" name="reference_by"
                                       value="{{$student->reference_by}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group mb-3">
                                <label for="demo">Demo Taken By:</label>
                                <br>
                                <select name="demo_staff_id" class="form-control select2">
                                    <option value="">----Select Staff----</option>
                                    @foreach($staff as $key=>$s)
                                        <option value="{{$s->id}}"
                                                @if($student->demo_staff_id==$s->id) selected @endif>{{$s->staff_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="fees">Form Fees:</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" value="paid"
                                       {{$student->fees == 'paid'?'checked' :''}} name="fees" class="form-check-input">
                                <label class="form-check-label" for="medium_hindi">
                                    Paid
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" value="unpaid"
                                       {{$student->fees == 'unpaid'?'checked' :''}} name="fees"
                                       class="form-check-input">
                                <label class="form-check-label" for="medium_hindi">
                                    Unpaid
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="note">Extra Note:</label>
                            <textarea name="extra_note" class="form-control">{{$student->extra_note}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2 buttonEnd">
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                    <a href="{{ route('student.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        var loadFile = function (event) {
            var image = document.getElementById("profilePic");
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endsection
