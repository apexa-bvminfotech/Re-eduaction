@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card-deck col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">Edit Staff</h2>
                                    <a href="{{ route('staff.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
                            </div>
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
                            <div class="card-body">
                                {!! Form::model($staff, ['method' => 'PATCH','route' => ['staff.update', $staff->id]]) !!}
                                <input type="hidden" name="user_id" value="{{ $staff->user_id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Employee ID</label>
                                            <input type="text" name="employee_ID" placeholder="Employee ID"
                                                   value="{{ $staff->employee_ID }}" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">First Name</label>
                                            <input type="text" name="first_name" value="{{ $staff->first_name }}"
                                                   placeholder="first name" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Name</label>
                                            <input type="text" name="staff_name" value="{{ $staff->staff_name }}"
                                                   placeholder="Name" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Father Name</label>
                                            <input type="text" name="father_name" value="{{ $staff->father_name }}"
                                                   placeholder="father name" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Phone</label>
                                            <input type="text" name="staff_phone" value="{{ $staff->staff_phone }}"
                                                   placeholder="Phone" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Emergency Phone</label>
                                            <input type="text" name="eme_phone" value="{{ $staff->eme_phone }}"
                                                   placeholder="Emergency Phone" class="form-control" required>
                                        </div>

                                    </div> <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-email">Email</label>
                                            <input type="email" name="email" value="{{ $staff->email }}"
                                                   class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-email">Address</label>
                                            <textarea class="form-control" placeholder="Address" name="staff_address"
                                                      required>{{ $staff->staff_address }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-email">Course</label>
                                            <div class="form-row">
                                                @foreach($course->chunk(2) as $chunk)
                                                    <div class="col-sm-4">
                                                        @foreach ($chunk as $value)
                                                            <div class="form-check">
                                                                <label>{{ Form::checkbox('course_id[]', $value->id, in_array($value->id, json_decode($staff->course_id)) ? true : false, array('class' => 'name')) }}
                                                                    {{ $value->course_name }}</label>
                                                                <br/>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-email">Role</label>
                                            <select class="form-control select2" name="roles" required>
                                                <option value="">--- Select Role ---</option>
                                                @foreach($role as $key => $r)
                                                    <option
                                                        value="{{ $r->id }}" {{ $userRole->id == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3 custom-control custom-checkbox">
                                                    <label for="simpleinput"></label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="staff_i_card"
                                                               class="custom-control-input"
                                                               {{ $staff->staff_I_card == 1 ? 'checked' : '' }} id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Staff
                                                            I-card</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3 custom-control custom-checkbox">
                                                    <label for="simpleinput"></label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="staff_uniform"
                                                               class="custom-control-input"
                                                               {{ $staff->staff_uniform == 1 ? 'checked' : '' }} id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">Staff
                                                            Uniform</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                            <div class="col-sm-9 d-flex justify-content-evenly">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio1"
                                                           name="is_active" value="1"
                                                           @if($staff->is_active =='1') checked @endif>
                                                    <label for="customRadio1"
                                                           class="custom-control-label">Active</label>
                                                </div>
                                                <div class="custom-control custom-radio ml-2">
                                                    <input class="custom-control-input custom-control-input-danger"
                                                           value="0"
                                                           type="radio" id="customRadio4" name="is_active"
                                                           @if($staff->is_active =='0') checked @endif>
                                                    <label for="customRadio4"
                                                           class="custom-control-label">Deactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-success float-right mr-2">Edit</button>
                                    <a href="{{ route('staff.index') }}"
                                       class="btn btn-danger float-right mr-2">Cancel</a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
