@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit TrainerAttendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student_attendance.index') }}">Show
                                    trainerAttendance List</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row">
                            <div class="card-deck col-12">
                                <div class="card shadow mb-4">
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
                                        {!! Form::model($trainerAttendance, ['method' => 'PATCH','route' => ['trainer_attendance.update',$EditDate]]) !!}

                                        <div class="col-md-12">
                                            @foreach($trainerAttendance as $key => $s)
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Trainer name</label>
                                                            <input type="hidden" readonly name="data[{{ $key }}][id]"
                                                                   value="{{ $s->id }}" class="form-control">
                                                            <input type="hidden" readonly
                                                                   name="data[{{ $key }}][trainer_id]"
                                                                   value="{{ $s->trainerID }}" class="form-control">
                                                            <input type="text" readonly
                                                                   name="data[{{ $key }}][trainer_name]"
                                                                   value="{{ $s->trainer_name }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Attendance</label>
                                                            <br>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="data[{{ $key }}][attendance]" value="0"
                                                                       checked>
                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="data[{{ $key }}][attendance]"
                                                                       value="1" {{ $s->attendance == 1 ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Absent reason</label>
                                                            <input type="text" name="data[{{ $key }}][absent_reason]"
                                                                   value="{{ $s->absent_reason }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group mb-2 buttonEnd">
                                            <button type="submit" class="btn btn-success float-right mr-2">Update</button>
                                            <a href="{{ route('trainer_attendance.index') }}"
                                               class="btn btn-danger float-right mr-2">Cancel</a>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
