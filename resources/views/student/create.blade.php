@extends('layouts.header')
@section('content')
    {!! Form::open(array('route' => 'student.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
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
                    <div class="mb-2 d-flex justify-content-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxk06S9jHtqPVNqxYFUJamJ-O6TEKC0gbAFkt2E4CBFw&s"
                             alt="example placeholder" style="width: 200px;" id="profilePic"/>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-primary btn-rounded">
                            <label class="form-label text-white mb-1" for="customFile1">Choose file</label>
                            <input type="file" class="form-control d-none" id="customFile1" name="upload_student_image" accept="image/*"
                                   onchange="loadFile(event)"/>
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
                                    <input type="text" id="simpleinput" class="form-control" value="{{old('surname')}}"  name="surname" placeholder="enter surname" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Student Name:</label>
                                    <input type="text" id="simpleinput" class="form-control" name="name" value="{{old('name')}}"  placeholder="enter name" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Father Name:</label>
                                    <input type="text" id="simpleinput" class="form-control" name="father_name" value="{{old('father_name')}}"  placeholder="enter father name" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="address">Address:</label>
                                    <textarea name="address" class="form-control" placeholder="enter address" required>{{old('address')}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male" {{ old("gender") == 'male' ? 'checked' : '' }}
                                               value="male" required>
                                        <label class="form-check-label" for="gender_male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female" {{ old("gender") == 'female' ? 'checked' : '' }}
                                               value="female" required>
                                        <label class="form-check-label" for="gender_female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="email">Email ID:</label>
                                    <input type="email" class="form-control" name="email_id" placeholder="enter email" value="{{old('email_id')}}"  required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="form-group mb-3">
                                    <label for="contact number">Father Contact No:</label>
                                    <input type="text" class="form-control" name="father_contact_no" placeholder="enter father's no." id="father_contact_no" onkeypress="return isNumber(event)" minlength="10" maxlength="10" value="{{old('father_contact_no')}}"  required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="form-group mb-3">
                                    <label for="contact number">Mother Contact No:</label>
                                    <input type="text" class="form-control" name="mother_contact_no" placeholder="enter mother's no." id="mother_contact_no" onkeypress="return isNumber(event)" minlength="10" maxlength="10" value="{{old('mother_contact_no')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="standard">Standard:</label>
                                <input type="number" class="form-control" name="standard" placeholder="enter standard" value="{{old('standard')}}"  required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="form-group">
                                    <label for="medium">Medium:</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" value="gujarati" name="medium" class="form-check-input">
                                        <label class="form-check-label" for="medium_gujarati">
                                            Gujarati
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" value="hindi" name="medium" class="form-check-input">
                                        <label class="form-check-label" for="medium_hindi">
                                            Hindi
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" value="english" name="medium" class="form-check-input">
                                        <label class="form-check-label" for="medium_english">
                                            English
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="school name">School Name:</label>
                                <input type="text" class="form-control" name="school_name" placeholder="enter school name" value="{{old('school_name')}}"  required>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="school time">School Time:</label>
                                <input type="text" name="school_time_to" class="form-control time-input" placeholder="enter school time" aria-describedby="button-addon2" required>
                                <div class="col-sm-1 mt-2" style="display: flex;justify-content: space-around;">
                                    <p>to</p>
                                </div>
                                <input type="text" name="school_time_from" class="form-control time-input" placeholder="enter school time" aria-describedby="button-addon2" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="etc time">Extra Tuition Time:</label>
                                <input type="text" name="extra_tuition_time_to" class="form-control time-input" placeholder="enter tuition time" aria-describedby="button-addon2" required>
                                <div class="col-sm-1 mt-2" style="display: flex;justify-content: space-around;">
                                    <p>to</p>
                                </div>
                                <input type="text" name="extra_tuition_time_from" class="form-control time-input" placeholder="enter tuition time" aria-describedby="button-addon2" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="dob">Date Of Birth:</label>
                                <input type="date" class="form-control" name="dob" placeholder="enter birthdate" value="{{old('dob',date('Y-m-d'))}}" required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="age">Age:</label>
                                <input type="number" name="age" id="txtAge" onkeyup="ageValidation()" class="form-control" placeholder="enter age" value="{{old('age')}}"  required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="course_name">Course Name:</label>
                                <br>
                                <select name="course_id" class="form-control select2" required>
                                    <option value="">-------------Course Name----------</option>
                                    @foreach($course as $key=>$c)
                                        <option
                                            value="{{$c->id}}" {{old('course_id')==$c->id?'selected':''}}>{{$c->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="payment">Payment Condition:</label>
                                <input type="text" name="payment_condition" class="form-control" placeholder="enter payment condition" value="{{old('payment_condition')}}"  required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="name">Analysis Staff Name: </label>
                                <select class="form-control select2" name="analysis_staff_id" required>
                                    <option value="">------Select Staff-----</option>
                                   @foreach($staff as $key=>$s)
                                        <option value="{{$s->id}}" {{old('name')==$s->id?'selected':''}}>{{$s->staff_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="pdf">Upload PDF:</label>
                                <input type="file" name="upload_analysis" class="form-control" accept="application/pdf" value="{{old('upload_analysis')}}"  placeholder="enter pdf" required>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="role">Role name:</label>
                                <select class="form-control select2" name="role" required>
                                    <option value="">------Select Role------</option>
                                    @foreach($role as $key=> $r)
                                        <option
                                            value="{{$r->id}}"{{old('role')==$r->id?'selected':''}}>{{$r->name}}</option>
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
                                    <input type="text" class="form-control" name="reference_by" value="{{old('reference_by')}}"  required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="form-group mb-3">
                                    <label for="demo">Demo Taken By:</label>
                                    <br>
                                    <select name="demo_staff_id" class="form-control select2" required>
                                        <option value="">----Select Staff----</option>
                                        @foreach($staff as $key=>$s)
                                            <option value="{{$s->id}}"{{old('demo_staff_id')==$s->id?'selected':''}}>{{$s->staff_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="fees">Form Fees:</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" value="paid" name="fees" class="form-check-input" >
                                    <label class="form-check-label" for="medium_hindi">
                                        Paid
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" value="unpaid" name="fees" class="form-check-input">
                                    <label class="form-check-label" for="medium_hindi">
                                        Unpaid
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="note">Extra Note:</label>
                                <textarea name="extra_note" class="form-control" required>{{old('extra_note')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2 buttonEnd">
                        <button type="submit" class="btn btn-primary mr-2" name="submit">Create</button>
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
        function ageValidation()
        {
            var x = document.getElementById("txtAge").value;
            if (x < 1 || x > 20)
            {
                alert("enter age between 1 to 20")
            }
        }
    </script>
@endsection
