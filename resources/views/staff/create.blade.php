@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Create New Staff</h2>
                    <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>
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
                <div class="row">
                    <div class="card-deck col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Form controls</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(array('route' => 'staff.store','method'=>'POST')) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Employee ID</label>
                                            <input type="text" name="employee_ID" placeholder="Employee ID" value="{{ old('employee_ID') }}" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Surname</label>
                                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Surname" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Name</label>
                                            <input type="text" name="staff_name" value="{{ old('staff_name') }}" placeholder="Enter Name" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Father Name</label>
                                            <input type="text" name="father_name" value="{{ old('father_name') }}" placeholder="father Name" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Phone</label>
                                            <input type="text" name="staff_phone" value="{{ old('staff_phone') }}" placeholder="Phone" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Emergency Phone</label>
                                            <input type="text" name="eme_phone" value="{{ old('eme_phone') }}" placeholder="Emergency Phone" class="form-control" required>
                                        </div>

                                    </div> <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-email">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-email">Address</label>
                                            <textarea class="form-control" placeholder="Address" name="staff_address" required>{{ old('staff_address') }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-email">Course</label>
                                            <div class="form-row">
                                                @foreach($course->chunk(2) as $chunk)
                                                    <div class="col-sm-4">
                                                        @foreach ($chunk as $value)
                                                            <div class="form-check">
                                                                <label>{{ Form::checkbox('course_id[]', $value->id, false, array('class' => 'name')) }}
                                                                    {{ $value->course_name }}</label><br>
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
                                                    <option value="{{ $r->id }}" {{ old('roles') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3 custom-control custom-checkbox">
                                                    <label for="simpleinput"></label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="staff_i_card" class="custom-control-input" {{ old('staff_i_card') == 'on' ? 'checked' : '' }} id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Staff I-card</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3 custom-control custom-checkbox">
                                                    <label for="simpleinput"></label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="staff_uniform"  class="custom-control-input" {{ old('staff_uniform') == 'on' ? 'checked' : '' }} id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">Staff Uniform</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-primary mr-2">Create</button>
                                    <a href="{{ route('staff.index') }}" class="btn btn-danger">Cancel</a>
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
