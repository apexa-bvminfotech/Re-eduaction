@extends('layouts.admin')
@push('styles')
    <style>
        input[type=radio] {
            width: 2em;
            height: 1em;
        }
    </style>
@endpush
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
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Employee Information</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Emergency Contact information</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#office-use-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="office-use-part" id="office-use-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Office Use Only</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#document-list-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="document-list-part" id="document-list-part-trigger">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Upload Document</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#terms-condition-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="terms-condition-part" id="terms-condition-part-trigger" required>
                                            <span class="bs-stepper-circle">5</span>
                                            <span class="bs-stepper-label">Terms & Condition</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <form action="{{route('trainer.store')}}" method="POST" id="quickForm" class="needs-validation" novalidate enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Employee ID</label>
                                                            <input type="text" class="form-control " value="REYB01E{{ $emp_id+1<10 ? '0'.$emp_id+1 : $emp_id+1 }}" name="emp_id" required>
                                                        </div>
                                                    </div>
                                                    @error('emp_id')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Surname:</label>
                                                            <input type="text" class="form-control " value="{{ old('surname') }}" name="surname" placeholder="Enter Surname">
                                                            @error('surname')
                                                            <span class="text-danger">{{ $surname }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Name:</label>
                                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                                            @error('name')
                                                            <span class="text-danger">{{ $name }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Father/Husband Name:</label>
                                                            <input type="text" class="form-control" name="father_name" value="{{ old('father_name') }}" placeholder="Enter Father Name">
                                                            @error('father_name')
                                                            <span class="text-danger">{{ $father_name }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Mobile No:</label>
                                                            <input type="tel" name="phone" placeholder="1234567890" value="{{ old('phone') }}" class="form-control">
                                                            @error('phone')
                                                            <span class="text-danger">{{ $phone }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="inputMailForm">Email address:</label>
                                                            <input id="inputMailForm" type="email" name="email_id" class="form-control" placeholder="Enter Email Address" value="{{ old('email_id') }}">
                                                            @error('email_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="qualification">Qualification:</label>
                                                            <input type="text" class="form-control" name="qualification" placeholder="Enter Your Qualification" id="qualification" value="{{ old('qualification') }}">
                                                            @error('qualification')
                                                            <span class="text-danger">{{ $qualification }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="dob">Date Of Birth:</label>
                                                            <input type="date" class="form-control" name="dob" placeholder="Enter Birthdate" max="{{ date('Y-m-d') }}"  value="{{ !empty(old('dob')) ? old('dob', date('Y-m-d')) : null }}">
                                                            @error('dob')
                                                            <span class="text-danger">{{ $dob }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="Marital Status">Marital Status:</label>
                                                            <br/>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio mt-2">
                                                                    <input type="radio" id="married" class="custom-control-input" name="marital_status" value="1" @if(old('marital_status') == '1')checked @endif>
                                                                    <label for="married" class="custom-control-label" style="font-weight: normal">Married</label>

                                                                </div>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio mt-1">
                                                                    <input type="radio" id="unmarried" class="custom-control-input" name="marital_status" value="0" {{ old('marital_status')}} @if(old('marital_status') == '0')checked @endif>
                                                                    <label for="unmarried" class="custom-control-label" style="font-weight: normal">Unmarried</label>
                                                                </div>
                                                            </div>
                                                            @error('marital_status')
                                                                <span class="text-danger">{{ $marital_status }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="address">Address:</label>
                                                            <textarea name="address" class="form-control" placeholder="Enter Address">{{ old('address') }}</textarea>
                                                            @error('address')
                                                            <span class="text-danger">{{ $address }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary float-right next-btn" id="firstNext">Next</button>
                                            </div>
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Full Name:</label>
                                                            <input type="text" class="form-control" name="emer_fullName" placeholder="Enter Your FullName" value="{{ old('emer_fullName') }}">
                                                            @error('emer_fullName')
                                                            <span class="text-danger">{{ $emer_fullName }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Mobile No:</label>
                                                            <input type="tel" name="emer_phone" placeholder="1234567890" value="{{ old('emer_phone') }}" class="form-control">
                                                            @error('emer_phone')
                                                            <span class="text-danger">{{ $emer_phone }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Relationship:</label>
                                                            <input type="text" class="form-control" placeholder="Relationship" name="emer_relationship" value="{{ old('emer_relationship') }}">
                                                            @error('emer_relationship')
                                                            <span class="text-danger">{{ $emer_relationship }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="note">Address:</label>
                                                        <textarea name="emer_address" placeholder="address" class="form-control">{{ old('emer_address') }}</textarea>
                                                        <br>

                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary float-right next-btn ml-2">Next</button>
                                                <button type="button" class="btn btn-primary prvBtn float-right" onclick="stepper.previous()">Previous</button>
                                            </div>
                                        </div>
                                        <div id="office-use-part" class="content" role="tabpanel" aria-labelledby="office-use-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Designation:</label>
                                                            <input type="text" class="form-control" name="designation" placeholder="designation" value="{{ old('designation') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="note">Department:</label>
                                                        <input type="text" class="form-control" name="department" placeholder="department" value="{{ old('department') }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Work Location:</label>
                                                            <input type="text" class="form-control" name="work_location" placeholder="work location" value="{{ old('work_location') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="trainerType">Trainer Type</label>
                                                            <br>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio">
                                                                    <input class="custom-control-input" type="radio" id="freelancerRadio" name="emp_type" value="1" @if(old('emp_type') == '1') checked @endif>
                                                                    <label for="freelancerRadio" class="custom-control-label">Freelancer</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <div class="custom-control custom-radio ml-2">
                                                                    <input class="custom-control-input" type="radio" id="fixedRadio" name="emp_type" value="0" @if(old('emp_type') == '0')checked @endif>
                                                                    <label for="fixedRadio" class="custom-control-label">Fixed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('emp_type')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <div class="col-md-6 ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Office use Email Address:</label>
                                                            <input type="email" class="form-control" placeholder="email address" name="office_use_email" value="{{ old('office_use_email') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="simpleinput">Joining Date:</label>
                                                        <div class="row">
                                                            <div class="col-sm-1" style="display: flex;justify-content: space-around;">
                                                                <label for="simpleinput">From:</label>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                                                    <input type="date" class="form-control" name="joining_date_from"  value="{{ !empty(old('joining_date_from')) ? old('joining_date_from', date('Y-m-d')) : null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1" style="display: flex;justify-content: space-around;">
                                                                <label for="simpleinput">To:</label>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="input-group date" id="timepicker3" data-target-input="nearest">
                                                                    <input type="date" class="form-control " name="joining_date_to"  value="{{ !empty(old('joining_date_to')) ? old('joining_date_to', date('Y-m-d')) : null }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="simpleinput">I Card:</label>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input placeholder="i-card date" class="form-control textbox-n" name="i_card_date" type="date" id="date" max="{{ date('Y-m-d') }}"
                                                                        value="{{ !empty(old('i_card_date')) ? old('i_card_date', date('Y-m-d')) : null }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="date" class="form-control textbox-n" name="i_card_return_date" placeholder="i-card return date"  max="{{ date('Y-m-d') }}"
                                                                        value="{{ !empty(old('i_card_return_date')) ? old('i_card_return_date', date('Y-m-d')) : null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="text" class="form-control" name="i_card_note" placeholder="add note" value="{{ old('i_card_note') }}">
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
                                                                           type="date"
                                                                           id="date"
                                                                            max="{{ date('Y-m-d') }}"
                                                                            value="{{ !empty(old('uniform_date')) ? old('uniform_date', date('Y-m-d')) : null }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="date" class="form-control textbox-n"
                                                                           name="uniform_return_date"
                                                                           placeholder="uniform return date"
                                                                           max="{{ date('Y-m-d') }}"
                                                                           value="{{ !empty(old('uniform_return_date')) ? old('uniform_return_date', date('Y-m-d')) : null }}">
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
                                                                           type="date"
                                                                           id="date"
                                                                            max="{{ date('Y-m-d') }}"
                                                                            value="{{ !empty(old('material_date')) ? old('material_date', date('Y-m-d')) : null }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <input type="date" class="form-control textbox-n"
                                                                           name="material_return_date"
                                                                           placeholder="material return date"
                                                                            max="{{ date('Y-m-d') }}"
                                                                            value="{{ !empty(old('material_return_date')) ? old('material_return_date', date('Y-m-d')) : null }}">
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
                                                        <label for="simpleinput">Offer Letter:</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <input placeholder="Offer later date"
                                                                           class="form-control textbox-n"
                                                                           name="offer_letter_date"
                                                                           type="date"
                                                                           id="date"
                                                                            max="{{ date('Y-m-d') }}"
                                                                            value="{{ !empty(old('offer_letter_date')) ? old('material_return_date', date('Y-m-d')) : null }}"/>
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
                                                                           type="date"
                                                                           id="date"
                                                                            max="{{ date('Y-m-d') }}"
                                                                            value="{{ !empty(old('bond_date')) ? old('bond_date', date('Y-m-d')) : null }}"/>
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
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label for="inputtext">Branch
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
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label for="inputtext">Course
                                                                Name:</label>
                                                            <select class="form-control select2" name="course_id[]" multiple="multiple" data-placeholder="Select a course">
                                                                <option value="">--- Select Course ---</option>
                                                                @foreach($course as $key=>$c)
                                                                    <option value="{{$c->id}}" {{ in_array($c->id, old('course_id', json_decode($c->course_id, true) ?: [])) ? 'selected' : '' }}>{{$c->course_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Role
                                                                Name:</label>
                                                            <select class="form-control select2" name="role_id"
                                                                    required>
                                                                <option value="">--- Select Role ---</option>
                                                                @foreach($roles as $key => $r)
                                                                    <option
                                                                        value="{{ $r->id }}" {{ old('role_id')==$r->id?'selected':'' }}>{{ $r->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label for="status" class="col-sm-1 col-form-label">Status :</label>
                                                    <div class="col-sm-9 mt-2 d-flex justify-content-evenly form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                   id="customRadio1" name="is_active" value="0" @if(old('is_active') == '0') checked @endif
                                                                  required>
                                                            <label for="customRadio1" class="custom-control-label">Active</label>
                                                        </div>
                                                        <div class="custom-control custom-radio ml-2">
                                                            <input
                                                                class="custom-control-input custom-control-input-danger"
                                                                value="1" type="radio" id="customRadio4"
                                                                name="is_active" required @if(old('is_active') == '1') checked @endif>
                                                            <label for="customRadio4" class="custom-control-label">Deactive</label>
                                                        </div>
                                                    </div>
                                                    @error('is_active')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="button" class="btn btn-primary float-right next-btn ml-2">Next</button>
                                                <button type="button" class="btn btn-primary prvBtn float-right ml-2" onclick="stepper.previous()">Previous</button>
                                            </div>
                                        </div>
                                        <div id="document-list-part" class="content" role="tabpanel" aria-labelledby="document-list-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Passport Size Photo</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="photo" accept="image/*" value="{{old('photo')}}" id="profilePhoto" data-image="profilePhoto"/>
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                            <div style="display: none;" id="profilePhotoContainer">
                                                                <img id="profilePhotoHolder" alt="Uploaded Image Preview Holder"  width="100" height="100"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Aadhaar Card</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="aadhaar_card" accept="image/*" value="{{ old('aadhaar_card') }}" id="adharCard"/>
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                            <div style="display: none;" id="adharCardContainer">
                                                                <img id="adharCardHolder" alt="Uploaded Image Preview Holder"  width="100" height="100"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Last Education MarkSheet</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       name="last_edu_markSheet" accept="image/*" value="{{ old('last_edu_markSheet') }}" id="lastEduMarkSheet"/>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                            </div>
                                                            <div style="display: none;" id="lastEduMarkSheetContainer">
                                                                <img id="lastEduMarkSheetHolder" alt="Uploaded Image Preview Holder"  width="100" height="100"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="inputtext">Choose Bank Passbook Photo</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       name="bank_passbook" accept="image/*" value="{{ old('bank_passbook') }}" id="passbookPhoto"/>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                            </div>
                                                            <div style="display: none;" id="passbookPhotoContainer">
                                                                <img id="passbookPhotoHolder" alt="Uploaded Image Preview Holder"  width="100" height="100"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary float-right next-btn  ml-2">Next</button>
                                                <button type="button" class="btn btn-primary prvBtn float-right ml-2" onclick="stepper.previous()">Previous</button>
                                            </div>
                                        </div>
                                        <div id="terms-condition-part" class="content" role="tabpanel" aria-labelledby="terms-condition-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <input type="checkbox" name="terms_conditions" value="1"
                                                                   @if(old('terms_conditions') == '1')checked @endif
                                                                   class="m-2" required>
                                                            <label for="terms & condition">Terms & Conditions:</label>
                                                            @error('terms_conditions')
                                                            {{-- <span class="text-danger">{{ $terms_conditions }}</span> --}}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                <textarea id="summernote" name="terms_conditions_detail" >{{ old('terms_conditions_detail') }}</textarea>
                                                @error('terms_conditions_detail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-success float-right next-btn  ml-2">Submit</button>
                                                <button type="button" class="btn btn-primary prvBtn float-right ml-2" onclick="stepper.previous()">Previous</button>
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
        $(document).ready(function () {

            //script for image preview
            function readURL(input, containerId, holderId) {
                $('#' + containerId).css('display', 'block');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#' + holderId).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('Select a file to see the preview');
                    $('#' + holderId).attr('src', '');
                }
            }

            $("#profilePhoto").change(function () {
                readURL(this, 'profilePhotoContainer', 'profilePhotoHolder');
            });

            $("#adharCard").change(function () {
                readURL(this, 'adharCardContainer', 'adharCardHolder');
            });

            $("#lastEduMarkSheet").change(function () {
                readURL(this, 'lastEduMarkSheetContainer', 'lastEduMarkSheetHolder');
            });

            $("#passbookPhoto").change(function () {
                readURL(this, 'passbookPhotoContainer', 'passbookPhotoHolder');
            });

            $('#summernote').summernote({
                height: 250
            });
            var form = $('#quickForm');
            var validator = form.validate({
                rules: {
                    emp_id: {
                        required: true,
                    },
                    surname: {
                        required: true,
                        maxlength: 255,
                    },
                    emer_fullName: {
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
                    phone: {
                        required: true,
                        maxlength: 10,
                        number : true,
                    },
                    email_id: {
                        required: true,
                    },
                    qualification: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    emer_phone: {
                        required: true,
                        maxlength: 10,
                        number : true,
                    },
                    emer_relationship: {
                        required: true,
                    },
                    emer_address: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    marital_status: {
                        required: true,
                    },
                    emp_type:{
                        required: true,
                    },
                    is_active:{
                        required: true,
                    },
                    terms_conditions: {
                        required: true,
                    },
                },
                messages: {
                    emp_id: {
                        required: 'Please enter your Employee Id.'
                    },
                    surname: {
                        required: 'Please enter your surname.'
                    },
                    emer_fullName: {
                        required: 'Please enter your emer_fullName.'
                    },
                    name: {
                        required: 'Please enter your name.'
                    },
                    father_name: {
                        required: "Please enter your father name ",
                    },
                    phone: {
                        required: "Please enter a Contact ",
                    },
                    email_id: {
                        required: "Please enter your Email ",
                    },
                    qualification: {
                        required: "Please enter your Qualification ",
                    },
                    address: {
                        required: "Please enter a Address ",
                    },
                    emer_phone: {
                        required: "Please enter Emergency contact Number",
                    },
                    emer_relationship: {
                        required: "Please enter Relationship",
                    },
                    emer_address: {
                        required: "Please Enter Address",
                    },
                    dob: {
                        required: "Please choose Date Of Birth ",
                    },
                    marital_status: {
                        required: "Please fill this field ",
                    },
                    emp_type: {
                        required : "Please select emp type ",
                    },
                    is_active: {
                        required : "Please select status ",
                    },
                    terms_conditions: {
                        required: 'Please read terms and condition and select this checkbox for submit data',
                    }
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

            function resetValidation(form) {
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').remove();
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'));
        });

    </script>
@endpush
