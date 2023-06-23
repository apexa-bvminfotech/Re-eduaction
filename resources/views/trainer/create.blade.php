@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">Employee Registration Form</h2>
                                    <a href="{{ route('trainer.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
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
                                        <div id="logins-part" class="content" role="tabpanel"
                                             aria-labelledby="logins-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Surname:</label>
                                                            <input type="text" id="simpleinput"
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
                                                            <input type="text" id="simpleinput" class="form-control"
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
                                                            <input type="text" id="simpleinput" class="form-control"
                                                                   name="father_name"
                                                                   value="{{ old('father_name') }}"
                                                                   placeholder="Enter Father Name">
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
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Mobile No:</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                   placeholder="Enter Contact Number" id="phone"
                                                                   onkeypress="return isNumber(event)"
                                                                   minlength="10"
                                                                   maxlength="10"
                                                                   value="{{ old('mobile_no') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="qualification">Qualification:</label>
                                                            <input type="text" class="form-control"
                                                                   name="qualification"
                                                                   placeholder="Enter Your Qualification."
                                                                   id="qualification"
                                                                   value="{{ old('qualification') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="inputMailForm">Email address:</label>
                                                            <input id="inputMailForm" type="email" name="email_id"
                                                                   class="form-control" placeholder="Enter Email Address">
                                                            <div class="invalid-feedback">Please fill the email
                                                                field
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="dob">Date Of Birth:</label>
                                                            <input type="date" class="form-control" name="dob"
                                                                   placeholder="Enter Birthdate"
                                                                   value="{{ old('dob',date('Y-m-d')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group">
                                                            <label for="Marital Status">Marital Status:</label>
                                                            <br/>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check m-2" type="radio"
                                                                       name="marital_status"
                                                                       id="married"
                                                                       {{ old("marital_status") == 'married' ? 'checked' : '' }}
                                                                       value="married">
                                                                <label class="form-check-label" for="married">
                                                                    Married
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="marital_status"
                                                                       id="unmarried"
                                                                       {{ old("marital_status") == 'unmarried' ? 'checked' : '' }}
                                                                       value="unmarried">
                                                                <label class="form-check-label" for="unmarried">
                                                                    Unmarried
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="marital_status"
                                                                       id="divorce"
                                                                       {{ old("marital_status") == 'divorce' ? 'checked' : '' }}
                                                                       value="divorce">
                                                                <label class="form-check-label" for="divorce">
                                                                    Divorce
                                                                </label>
                                                            </div>
                                                        </div>
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
                                                <button class="btn btn-primary float-right nxtbt">Next</button>
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
                                                    <div class="col-md-12">
                                                        <label for="note">Address:</label>
                                                        <textarea name="emer_address" placeholder="address"
                                                                  class="form-control">{{ old('emer_address') }}</textarea>
                                                        <br>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group mb-3">
                                                            <label for="contact number">Mobile No:</label>
                                                            <input type="text" class="form-control" name="emer_phone"
                                                                   placeholder="Enter Contact " id="mobile_no"
                                                                   onkeypress="return isNumber(event)"
                                                                   minlength="10"
                                                                   maxlength="10"
                                                                   value="{{ old('emer_phone') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Relationship:</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Relationship"
                                                                   name="emer_relationship"
                                                                   value="{{ old('emer_relationship') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right nxtbt  ml-2">
                                                    Next
                                                </button>
                                                <button class="btn btn-primary prvBtn float-right">Previous
                                                </button>

                                            </div>
                                        </div>
                                        <div id="office-use-part" class="content" role="tabpanel"
                                             aria-labelledby="office-use-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 ">
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
                                                    <div class="col-md-6 ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Work Location:</label>
                                                            <input type="text" class="form-control" name="work_location"
                                                                   placeholder="work location"
                                                                   value="{{ old('work_location') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Email Address:</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="email address"
                                                                   name="office_use_email"
                                                                   value="{{ old('office_use_email') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
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
                                                                           name="joining_date"
                                                                           value="{{ old('joining_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2"
                                                                 style="display: flex;justify-content: space-around;">
                                                                <label for="simpleinput">To:</label>
                                                            </div>
                                                            {{--                                                            <label for="simpleinput" class="m-2"  style="justify-content: space-around; display: flex">To:</label>--}}
                                                            <div class="col-sm-4">
                                                                <div class="input-group date" id="timepicker3"
                                                                     data-target-input="nearest">

                                                                    <input type="date"
                                                                           class="form-control "
                                                                           name="joining_date"
                                                                           value="{{ old('joining_date') }}">
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right nxtbt  ml-2">
                                                    Next
                                                </button>
                                                <button class="btn btn-primary prvBtn float-right ml-2">Previous
                                                </button>
                                            </div>
                                        </div>
                                        <div id="document-list-part" class="content" role="tabpanel"
                                             aria-labelledby="document-list-part-trigger">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <div class="ml-5 d-inline">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card card-default">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title"><b>Passport Size Photo :</b></h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div id="actions" class="row">
                                                                                    <div class="col-lg-2">
                                                                                        <div class="btn-group w-100">
                                                                                    <span class="btn btn-success col fileinput-button dz-clickable">
                                                                                            <i class="fas fa-plus"></i>
                                                                                    <span>Add files</span>
                                                                                    </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6 d-flex align-items-center">
                                                                                        <div class="fileupload-process w-100">
                                                                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                                                                                                <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="table table-striped files" id="previews">

                                                                                </div>
                                                                            </div>
                                                                            <!-- /.card-body -->

                                                                        </div>
                                                                        <!-- /.card -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <div class="ml-5 d-inline">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card card-default">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title"><b>Aadhaar Card : </b></h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div id="actions" class="row">
                                                                                    <div class="col-lg-2">
                                                                                        <div class="btn-group w-100">
                                                                                    <span class="btn btn-success col fileinput-button dz-clickable">
                                                                                            <i class="fas fa-plus"></i>
                                                                                    <span>Add files</span>
                                                                                    </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6 d-flex align-items-center">
                                                                                        <div class="fileupload-process w-100">
                                                                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                                                                                                <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="table table-striped files" id="previews">

                                                                                </div>
                                                                            </div>
                                                                            <!-- /.card-body -->

                                                                        </div>
                                                                        <!-- /.card -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <div class="ml-5 d-inline">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card card-default">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title"><b>Last Education MarkSheet :</b></h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div id="actions" class="row">
                                                                                    <div class="col-lg-2">
                                                                                        <div class="btn-group w-100">
                                                                                    <span class="btn btn-success col fileinput-button dz-clickable">
                                                                                            <i class="fas fa-plus"></i>
                                                                                    <span>Add files</span>
                                                                                    </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6 d-flex align-items-center">
                                                                                        <div class="fileupload-process w-100">
                                                                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                                                                                                <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="table table-striped files" id="previews">

                                                                                </div>
                                                                            </div>
                                                                            <!-- /.card-body -->

                                                                        </div>
                                                                        <!-- /.card -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <div class="ml-5 d-inline">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card card-default">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title"><b>Choose Passport Size Photo:</b></h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div id="actions" class="row">
                                                                                    <div class="col-lg-2">
                                                                                        <div class="btn-group w-100">
                                                                                    <span class="btn btn-success col fileinput-button dz-clickable">
                                                                                            <i class="fas fa-plus"></i>
                                                                                    <span>Add files</span>
                                                                                    </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6 d-flex align-items-center">
                                                                                        <div class="fileupload-process w-100">
                                                                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                                                                                                <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="table table-striped files" id="previews">

                                                                                </div>
                                                                            </div>
                                                                            <!-- /.card-body -->

                                                                        </div>
                                                                        <!-- /.card -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                        class="btn btn-primary float-right nxtbt  ml-2">
                                                    Next
                                                </button>
                                                <button class="btn btn-primary prvBtn float-right ml-2">Previous
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
                                                <button type="submit"
                                                        class="btn btn-primary float-right nxtbt  ml-2">
                                                    Submit
                                                </button>
                                                <button class="btn btn-primary prvBtn float-right ml-2">Previous
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div> <!-- .col-12 -->
                <!-- .row -->
                <!-- .container-fluid -->
                @endsection
                @push('scripts')
                    <script>

                        $(document).ready(function () {
                            var stepper = new Stepper($('.bs-stepper')[0])

                            $(document).on('click', '.nxtbt', function () {
                                stepper.next()
                            })
                            $(document).on('click', '.prvBtn', function () {
                                stepper.previous()
                            })
                        })
                        var loadFile = function (event) {
                            var image = document.getElementById("profilePic");
                            image.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>
    @endpush
