@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Employee Registration Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('trainer.index') }}">Show Trainer List</a></li>
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
{{--                            {!! Form::open(array('route' => 'trainer.store','method'=>'POST')) !!}--}}
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Employee Information</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Emergency Contact information</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#office-use-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="office-use-part" id="office-use-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Office Use Only</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#document-list-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="document-list-part" id="document-list-part-trigger">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Upload Document</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#terms-condition-part">
                                        <button type="button" class="step-trigger" role="tab"
                                                aria-controls="terms-condition-part"
                                                id="terms-condition-part-trigger">
                                            <span class="bs-stepper-circle">5</span>
                                            <span class="bs-stepper-label">Terms & Condition</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <form id="quickForm" class="needs-validation" onsubmit="return false" novalidate>
                                        <div id="logins-part" class="content" role="tabpanel"
                                             aria-labelledby="logins-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Surname:</label>
                                                            <input type="text"
                                                                   class="form-control "
                                                                   value="{{ old('surname') }}"
                                                                   name="surname" placeholder="Enter Surname">
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Name:</label>
                                                            <input type="text" class="form-control"
                                                                   name="name"
                                                                   value="{{ old('name') }}"
                                                                   placeholder="Enter Name">
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Father Name:</label>
                                                            <input type="text"  class="form-control"
                                                                   name="father_name"
                                                                   value="{{ old('father_name') }}"
                                                                   placeholder="Enter Father Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Mobile No:</label>
                                                            <input type="tel" name="phone"
                                                                   placeholder="12345 67890" value="{{ old('phone') }}"
                                                                   class="form-control" pattern="[0-9]{5}[\s]{1}[0-9]{5}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="inputMailForm">Email address:</label>
                                                            <input id="inputMailForm" type="email" name="email"
                                                                   class="form-control" placeholder="Enter Email Address">
                                                            <div class="invalid-feedback">Please fill the email
                                                                field
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="qualification">Qualification:</label>
                                                            <input type="text" class="form-control"
                                                                   name="qualification"
                                                                   placeholder="Enter Your Qualification"
                                                                   id="qualification"
                                                                   value="{{ old('qualification') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="dob">Date Of Birth:</label>
                                                            <input type="date" class="form-control" name="dob"
                                                                   placeholder="Enter Birthdate"
                                                                   value="{{ old('dob',date('Y-m-d')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="Marital Status">Marital Status:</label>
                                                            <br/>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" type="radio" id="customRadio1" name="marital_status" checked>
                                                                    <label for="customRadio1" class="custom-control-label" style="font-weight: normal">Married</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" type="radio" id="customRadio2" name="marital_status">
                                                                    <label for="customRadio2" class="custom-control-label" style="font-weight: normal">Unmarried</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="address">Address:</label>
                                                            <textarea name="address" class="form-control"
                                                                      placeholder="Enter Address"
                                                            >{{ old('address') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary float-right nxtbt" onclick="stepper.next()">Next</button>
                                            </div>
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                             aria-labelledby="information-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Full Name:</label>
                                                            <input type="text" class="form-control" name="emer_fullName"
                                                                   placeholder="Enter Your FullName"
                                                                   value="{{ old('emer_fullName') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Mobile No:</label>
                                                            <input type="tel" name="emer_phone"
                                                                   placeholder="12345 67890" value="{{ old('emer_phone') }}"
                                                                   class="form-control" pattern="[0-9]{5}[\s]{1}[0-9]{5}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Relationship:</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Relationship"
                                                                   name="emer_relationship"
                                                                   value="{{ old('emer_relationship') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="note">Address:</label>
                                                        <textarea name="emer_address" placeholder="address"
                                                                  class="form-control">{{ old('emer_address') }}</textarea>
                                                        <br>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right nxtbt  ml-2" onclick="stepper.next()">
                                                    Next
                                                </button>
                                                <button class="btn btn-primary prvBtn float-right" onclick="stepper.previous()">Previous
                                                </button>

                                            </div>
                                        </div>
                                        <div id="office-use-part" class="content" role="tabpanel"
                                             aria-labelledby="office-use-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Designation:</label>
                                                            <input type="text" class="form-control" name="designation"
                                                                   placeholder="designation"
                                                                   value="{{ old('designation') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="note">Department:</label>
                                                        <input type="text" class="form-control" name="department"
                                                               placeholder="department"
                                                               value="{{ old('department') }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Work Location:</label>
                                                            <input type="text" class="form-control" name="work_location"
                                                                   placeholder="work location"
                                                                   value="{{ old('work_location') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Marital Status">Trainer Type</label>
                                                            <br/>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" type="radio" id="customRadio1" name="emp_type" checked>
                                                                    <label for="customRadio1" class="custom-control-label" style="font-weight: normal">Freelancer</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" type="radio" id="customRadio2" name="emp_type">
                                                                    <label for="customRadio2" class="custom-control-label" style="font-weight: normal">Fix</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Email Address:</label>
                                                            <input type="email" class="form-control"
                                                                   placeholder="email address"
                                                                   name="office_use_email"
                                                                   value="{{ old('office_use_email') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="simpleinput">Joining Date:</label>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-2"
                                                                 style="display: flex;justify-content: space-around;">
                                                                <label for="simpleinput">From:</label>
                                                            </div>
                                                            {{--                                                            <label for="simpleinput" class="m-2" style="justify-content: space-around; display: flex">From:</label>--}}
                                                            <div class="col-sm-4">
                                                                <div class="input-group date" id="timepicker2"
                                                                     data-target-input="nearest">

                                                                    <input type="date"
                                                                           class="form-control"
                                                                           name="joining_date_from"
                                                                           value="{{ old('joining_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1"
                                                                 style="display: flex;justify-content: space-around;">
                                                                <label for="simpleinput">To:</label>
                                                            </div>
                                                            {{--                                                            <label for="simpleinput" class="m-2"  style="justify-content: space-around; display: flex">To:</label>--}}
                                                            <div class="col-sm-4">
                                                                <div class="input-group date" id="timepicker3"
                                                                     data-target-input="nearest">

                                                                    <input type="date"
                                                                           class="form-control "
                                                                           name="joining_date_to"
                                                                           value="{{ old('joining_date') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="simpleinput">I Card:</label>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input placeholder="i-card date"
                                                                           class="form-control textbox-n"
                                                                           name="i_card_date"
                                                                           type="text"
                                                                           onfocus="(this.type='date')"
                                                                           id="date"
                                                                           value="{{ old('i_card_date') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control textbox-n"
                                                                           onfocus="(this.type='date')"
                                                                           name="i_card_return_date"
                                                                           placeholder="i-card return date"
                                                                           value="{{ old('i_card_return_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                           name="i_card_note" placeholder="add note"
                                                                           value="{{ old('i_card_note') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label for="simpleinput">Uniform:</label>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input placeholder="uniform date"
                                                                           class="form-control textbox-n"
                                                                           name="uniform_date"
                                                                           type="text"
                                                                           onfocus="(this.type='date')"
                                                                           id="date"
                                                                           value="{{ old('uniform_date') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control textbox-n"
                                                                           onfocus="(this.type='date')"
                                                                           name="uniform_return_date"
                                                                           placeholder="uniform return date"
                                                                           value="{{ old('uniform_return_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                           name="uniform_note" placeholder="add note"
                                                                           value="{{ old('uniform_note') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label for="simpleinput">Material:</label>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input placeholder="material date"
                                                                           class="form-control textbox-n"
                                                                           name="material_date"
                                                                           type="text"
                                                                           onfocus="(this.type='date')"
                                                                           id="date"
                                                                           value="{{ old('material_date') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control textbox-n"
                                                                           onfocus="(this.type='date')"
                                                                           name="material_return_date"
                                                                           placeholder="material return date"
                                                                           value="{{ old('material_return_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                           name="material_note" placeholder="add note"
                                                                           value="{{ old('material_note') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label for="simpleinput">Offer Latter:</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <input placeholder="Offer later date"
                                                                           class="form-control textbox-n"
                                                                           name="offer_letter_date"
                                                                           type="text"
                                                                           onfocus="(this.type='date')"
                                                                           id="date"
                                                                           value="{{ old('offer_letter_date') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                           name="offer_letter_note"
                                                                           placeholder="add note"
                                                                           value="{{ old('offer_letter_note') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label for="simpleinput">Bond:</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <input placeholder="bond date"
                                                                           class="form-control textbox-n"
                                                                           name="bond_date"
                                                                           type="text"
                                                                           onfocus="(this.type='date')"
                                                                           id="date"
                                                                           value="{{ old('bond_date') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                           name="bond_note"
                                                                           placeholder="add note"
                                                                           value="{{ old('bond_note') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Petrol Allowance:</label>
                                                            <input type="text" class="form-control"
                                                                   name="petrol_allowance"
                                                                   placeholder="petrol_allowance"
                                                                   value="{{ old('petrol_allowance') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="note">Incentive:</label>
                                                        <input type="text" class="form-control" name="incentive"
                                                               placeholder="incentive"
                                                               value="{{ old('incentive') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="simpleinput">Other allowance:</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="other_allowance"
                                                               name="other_allowance"
                                                               value="{{ old('other_allowance') }}">
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="inputtext" class="col-sm-3 col-form-label">Branch
                                                                Name:</label>
                                                            <select class="form-control select2" name="branch_id">
                                                                <option value="">--- Select Branch ---</option>
                                                                @foreach($branch as $key => $b)
                                                                    <option
                                                                        value="{{ $b->id }}">{{ $b->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="inputtext" class="col-sm-3 col-form-label">Course
                                                                Name:</label>
                                                            <select class="form-control select2" name="course_id">
                                                                <option value="">--- Select Course ---</option>
                                                                @foreach($course as $key => $c)
                                                                    <option
                                                                        value="{{ $c->id }}">{{ $c->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext" class="col-sm-3 col-form-label">Role
                                                                Name:</label>
                                                            <select class="form-control select2" name="role_id">
                                                                <option value="">--- Select Role ---</option>
                                                                @foreach($roles as $key => $r)
                                                                    <option
                                                                        value="{{ $r->id }}">{{ $r->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right nxtbt ml-2" onclick="stepper.next()">Next</button>
                                                <button class="btn btn-primary prvBtn float-right ml-2" onclick="stepper.previous()">Previous</button>
                                            </div>
                                        </div>
                                        <div id="document-list-part" class="content" role="tabpanel"
                                             aria-labelledby="document-list-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Passport Size Photo</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Aadhaar Card</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Last Education MarkSheet</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Choose Passport Size Photo</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right nxtbt  ml-2" onclick="stepper.next()">
                                                    Next
                                                </button>
                                                <button class="btn btn-primary prvBtn float-right ml-2" onclick="stepper.previous()">Previous
                                                </button>
                                            </div>

                                        </div>
                                        <div id="terms-condition-part" class="content" role="tabpanel"
                                             aria-labelledby="terms-condition-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <input type="checkbox" name="terms_conditions"
                                                                   class="m-2">
                                                            <label for="terms & conditon">Terms & Conditions:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary prvBtn float-right ml-2" onclick="stepper.previous()">Previous</button>
                                                <button type="submit" class="btn btn-primary float-right nxtbt  ml-2">
                                                    Submit
                                                </button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
{{--                            {!! Form::close() !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script>

        $(document).ready(function () {
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
                        maxlength: 255,
                    },
                    address: {
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
        });
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>
@endpush
