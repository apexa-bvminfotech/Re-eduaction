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
                                    <h2 class="mb-0 page-title">Edit Attendance</h2>
                                    <a href="{{ route('staff_attendance.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
                                <strong class="card-title">{{ date('d-m-Y', strtotime($EditDate)) }}</strong>
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
                                {!! Form::model($staffAttendance, ['method' => 'PATCH','route' => ['staff_attendance.update',$EditDate]]) !!}

                                <div class="col-md-12">
                                    @foreach($staffAttendance as $key => $s)
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Staff name</label>
                                                    <input type="hidden" readonly name="data[{{ $key }}][id]" value="{{ $s->id }}" class="form-control">
                                                    <input type="hidden" readonly name="data[{{ $key }}][Staff_id]" value="{{ $s->staffID }}" class="form-control">
                                                    <input type="text" readonly name="data[{{ $key }}][staff_name]" value="{{ $s->staff_name }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Attendance</label>
                                                    <br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="data[{{ $key }}][attendance]" value="0" checked>
                                                        <label class="form-check-label" for="inlineRadio1">Present</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="data[{{ $key }}][attendance]" value="1" {{ $s->attendance == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Absent reason</label>
                                                    <input type="text" name="data[{{ $key }}][absent_reason]" value="{{ $s->absent_reason }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-success float-right mr-2">Edit</button>
                                    <a href="{{ route('staff_attendance.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
