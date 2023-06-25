@extends('layouts.admin')
@section('content')
    {{--    {!! Form::open(array('route' => 'student.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}--}}
    {{--    <div class="card shadow mb-1">--}}
    {{--        @if (count($errors) > 0)--}}
    {{--            <div class="alert alert-danger">--}}
    {{--                <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
    {{--                <ul>--}}
    {{--                    @foreach ($errors->all() as $error)--}}
    {{--                        <li>{{ $error }}</li>--}}
    {{--                    @endforeach--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        @endif--}}
    {{--        --}}{{--                            <a href="{{ route('student.index') }}" class="btn btn-primary">Back</a>--}}
    {{--    </div>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">ADMISSION FORM</h3>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper linear">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step active" data-target="#logins-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                        id="logins-part-trigger" aria-selected="true">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Student Infomation</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                        id="information-part-trigger" aria-selected="false" disabled="disabled">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Office use only</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#information-image-part">
                                <button type="button" class="step-trigger" role="tab"
                                        aria-controls="information-image-part" id="information-image-part-trigger"
                                        aria-selected="false" disabled="disabled">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Image and Upload file</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            <form id="quickForm" class="needs-validation" onsubmit="return false" novalidate>
                                <div id="logins-part" class="content fade active dstepper-block" role="tabpanel"
                                     aria-labelledby="logins-part-trigger">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-1">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Surname:</label>
                                                    <input type="text" id="simpleinput" class="form-control "
                                                           value="{{ old('surname') }}"
                                                           name="surname" placeholder="enter surname" required>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Student Name:</label>
                                                    <input type="text" id="simpleinput" class="form-control" name="name"
                                                           value="{{ old('name') }}" placeholder="enter name" required>
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
                                                           value="{{ old('father_name') }}"
                                                           placeholder="enter father name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group mb-3">
                                                    <label for="address">Address:</label>
                                                    <textarea name="address" class="form-control"
                                                              placeholder="enter address">{{ old('address') }}</textarea>
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
                                                               value="male">
                                                        <label class="form-check-label" for="gender_male">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                               id="gender_female" required
                                                               {{ old("gender") == 'female' ? 'checked' : '' }}
                                                               value="female">
                                                        <label class="form-check-label" for="gender_female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="email">Email ID:</label>
                                                    <input type="email" class="form-control" name="email_id"
                                                           placeholder="enter email"
                                                           value="{{ old('email_id') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group mb-3">
                                                    <label for="contact number">Father Contact No:</label>
                                                    <input type="text" class="form-control" name="father_contact_no"
                                                           placeholder="enter father's no." id="father_contact_no"
                                                           onkeypress="return isNumber(event)" minlength="10"
                                                           maxlength="10"
                                                           value="{{ old('father_contact_no') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group mb-3">
                                                    <label for="contact number">Mother Contact No:</label>
                                                    <input type="text" class="form-control" name="mother_contact_no"
                                                           placeholder="enter mother's no." id="mother_contact_no"
                                                           onkeypress="return isNumber(event)" minlength="10"
                                                           maxlength="10"
                                                           value="{{ old('mother_contact_no') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label for="standard">Standard:</label>
                                                    <input type="number" class="form-control" name="standard"
                                                           placeholder="enter standard"
                                                           value="{{ old('standard') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label for="medium">Medium:</label>
                                                    <br>
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" value="gujarati" name="medium"
                                                               class="form-check" {{ old("medium") == 'gujarati' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="medium_gujarati">
                                                            Gujarati
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" value="hindi" name="medium"
                                                               class="form-check-input" {{ old("medium") == 'hindi' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="medium_hindi">
                                                            Hindi
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" value="english" name="medium"
                                                               class="form-check-input" {{ old("medium") == 'english' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="medium_english">
                                                            English
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="school name">School Name:</label>
                                                    <input type="text" class="form-control" name="school_name"
                                                           placeholder="enter school name"
                                                           value="{{ old('school_name') }}">
                                                </div>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label for="inputEmail3" class=" col-form-label">School Time:</label>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="input-group date" id="timepicker"
                                                             data-target-input="nearest">
                                                            <input type="text" class="form-control datetimepicker-input"
                                                                   name="school_time_to"
                                                                   value="{{ old('school_time_to') }}"
                                                                   aria-describedby="button-addon2"
                                                                   data-target="#timepicker"/>
                                                            <div class="input-group-append" data-target="#timepicker"
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
                                                            <input type="text" class="form-control datetimepicker-input"
                                                                   name="school_time_from"
                                                                   value="{{ old('school_time_from') }}"
                                                                   aria-describedby="button-addon2"
                                                                   data-target="#timepicker1"/>
                                                            <div class="input-group-append" data-target="#timepicker1"
                                                                 data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="far fa-clock"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail3" class="col-form-label">Extra Tuition
                                                    Time:</label>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="input-group date" id="timepicker2"
                                                             data-target-input="nearest">
                                                            <input type="text" class="form-control datetimepicker-input"
                                                                   name="extra_tuition_time_to"
                                                                   value="{{ old('extra_tuition_time_to') }}"
                                                                   aria-describedby="button-addon2"
                                                                   data-target="#timepicker2"/>
                                                            <div class="input-group-append" data-target="#timepicker2"
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
                                                            <input type="text" class="form-control datetimepicker-input"
                                                                   name="extra_tuition_time_from"
                                                                   value="{{ old('extra_tuition_time_from') }}"
                                                                   aria-describedby="button-addon2"
                                                                   data-target="#timepicker3"/>
                                                            <div class="input-group-append" data-target="#timepicker3"
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
                                                           placeholder="enter birthdate"
                                                           value="{{ old('dob',date('Y-m-d')) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label for="age">Age:</label>
                                                    <input type="number" name="age" id="txtAge"
                                                           onkeyup="ageValidation()"
                                                           class="form-control"
                                                           placeholder="enter age" value="{{ old('age') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label for="course_name">Course Name:</label>
                                                    <br>
                                                    <select name="course_id" class="form-control select2" required>
                                                        <option value="">----- Course Name -----</option>
                                                        @foreach($course as $key=>$c)
                                                            <option
                                                                value="{{$c->id}}" {{ old('course_id')==$c->id?'selected':'' }}>{{$c->course_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label for="payment">Payment Condition:</label>
                                                    <input type="text" name="payment_condition" class="form-control"
                                                           placeholder="enter payment condition"
                                                           value="{{ old('payment_condition') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group">
                                                    <label for="name">Analysis Staff Name: </label>
                                                    <select class="form-control select2" name="analysis_staff_id">
                                                        <option value="">------ Select Staff -----</option>
                                                        @foreach($staff as $key=>$s)
                                                            <option
                                                                value="{{$s->id}}" {{ old('name')==$s->id?'selected':'' }}>{{$s->staff_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-1">
                                                <div class="form-group">
                                                    <label for="role">Role name:</label>
                                                    <select class="form-control select2" name="role" required>
                                                        <option value="">------ Select Role ------</option>
                                                        @foreach($role as $key=> $r)
                                                            <option
                                                                value="{{$r->id}}"{{ old('role')==$r->id?'selected':'' }}>{{$r->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-next-form float-right m-2 ">Next
                                    </button>
                                </div>
                                <div id="information-part" class="content fade dstepper-none" role="tabpanel"
                                     aria-labelledby="information-part-trigger">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Reference By:</label>
                                                    <input type="text" class="form-control" name="reference_by"
                                                           value="{{ old('reference_by') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="form-group mb-3">
                                                    <label for="demo">Demo Taken By:</label>
                                                    <br>
                                                    <select name="demo_staff_id" class="form-control select2">
                                                        <option value="">---- Select Staff ----</option>
                                                        @foreach($staff as $key=>$s)
                                                            <option
                                                                value="{{$s->id}}"{{ old('demo_staff_id')==$s->id?'selected':'' }}>{{$s->staff_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <label for="fees">Form Fees:</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" value="paid" name="fees"
                                                           class="form-check-input">
                                                    <label class="form-check-label"
                                                           for="medium_hindi" {{ old("fees") == 'paid' ? 'checked' : '' }}>
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" value="unpaid" name="fees"
                                                           class="form-check-input" {{ old("fees") == 'unpaid' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="medium_hindi">
                                                        Unpaid
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="note">Extra Note:</label>
                                                <textarea name="extra_note"
                                                          class="form-control">{{ old('extra_note') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>

                                </div>
                                <div id="information-image-part" class="content fade text-center dstepper-none"
                                     role="tabpanel"
                                     aria-labelledby="information-part-trigger">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="mb-2 d-flex justify-content-center">
                                                <img
                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxk06S9jHtqPVNqxYFUJamJ-O6TEKC0gbAFkt2E4CBFw&s"
                                                    alt="example placeholder" style="width: 200px;" id="profilePic"/>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="btn btn-primary btn-rounded">
                                                    <label class="form-label text-white mb-1" for="customFile1">Choose
                                                        file</label>
                                                    <input type="file" class="form-control d-none" id="customFile1"
                                                           name="upload_student_image"
                                                           accept="image/*"
                                                           onchange="loadFile(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="pdf">Upload PDF:</label>
                                            <input type="file" name="upload_analysis" class="form-control"
                                                   accept="application/pdf"
                                                   value="{{ old('upload_analysis') }}" placeholder="enter pdf">
                                        </div>
                                        <div class="flex mt-0 float-right">
                                            <button class="btn btn-primary" onclick="stepper.previous()">Previous
                                            </button>
                                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        {{--    {!! Form::close() !!}--}}

        @endsection
        @push('scripts')
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

                function  () {
                    var x = document.getElementById("txtAge").value;
                    if (x < 1 || x > 20) {
                        alert("enter age between 1 to 20")
                    }
                }

                $(document).ready(function () {
                    //Timepicker
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
                    $.validator.setDefaults({
                        submitHandler: function () {
                            alert("Form successful submitted!");
                        }
                    });
                    $('#quickForm').validate({
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
                            email_id: {
                                required: true,
                                email: true,
                            },
                            father_contact_no: {
                                required: true,
                                maxlength: 10,
                                phoneUS: true,
                            },
                            mother_contact_no: {
                                required: true,
                                maxlength: 10,
                                phoneUS: true,
                            },
                            standard: {
                                required: true,
                            },
                            medium: {
                                required: true,
                            },
                            school_name: {
                                required: true,
                            },
                            school_time_to: {
                                required: true,
                            },
                            school_time_from: {
                                required: true,
                            },
                            extra_tuition_time_to: {
                                required: true,
                            },
                            extra_tuition_time_from: {
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
                            payment_condition: {
                                required: true,
                            },
                            analysis_staff_id: {
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
                                required: "Please enter a gender ",
                            },
                            email_id: {
                                required: "Please enter a email ",
                            },
                            father_contact_no: {
                                required: "Please enter a father_contact_no ",
                                maxlength: "please enter 10 number",
                            },
                            mother_contact_no: {
                                required: "Please enter a mother_contact_no ",
                                maxlength: "please enter 10 number",
                            },
                            standard: {
                                required: "Please enter a standard ",
                            },
                            medium: {
                                required: "Please enter a medium ",
                            },
                            school_name: {
                                required: "Please enter a school_name ",
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
                            payment_condition: {
                                required: "Please enter a payment_condition ",
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
                })
                document.addEventListener('DOMContentLoaded', function () {
                    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
                })

            </script>
    @endpush
