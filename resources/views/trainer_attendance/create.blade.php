@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Trainer Attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('trainer_attendance.index') }}">Show
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
                                        {!! Form::open(array('route' => 'trainer_attendance.store','method'=>'POST')) !!}
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="example-date">Date</label>
                                                    <input class="form-control" type="date" value="{{ date('Y-m-d') }}" max="{{now()->format('Y-m-d')}}"
                                                           name="date" required>
                                                </div>
                                            </div>
                                            @foreach($trainer as $key => $s)
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Trainer name</label>
                                                            <input type="hidden" readonly
                                                                   name="data[{{ $key }}][trainer_id]"
                                                                   value="{{ $s->id }}" class="form-control">
                                                            <input type="text" readonly
                                                                   name="data[{{ $key }}][trainer_name]"
                                                                   value="{{ $s->name }}" class="form-control">
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
                                                                       name="data[{{ $key }}][attendance]" value="1">
                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Absent reason</label>
                                                            <input type="text" name="data[{{ $key }}][absent_reason]"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group mb-2 float-right">
                                            <button type="submit" class="btn btn-success mr-2">Create</button>
                                            <a href="{{ route('trainer_attendance.index') }}" class="btn btn-danger">Cancel</a>
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
