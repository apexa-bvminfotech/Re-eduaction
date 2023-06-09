@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit StudentAttendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student_attendance.index') }}">Show
                                    studentAttendance List</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
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
                            <form method="POST" action="{{route('student_attendance.update',$EditDate)}}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="date" value="{{$EditDate}}">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        @foreach($studentAttendance as $key=>$s)
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label for="simpleinput">Student name</label>
                                                        <input type="hidden" readonly name="data[{{ $key }}][id]"
                                                               value="{{ $s->id }}" class="form-control">
                                                        <input type="hidden" readonly
                                                               name="data[{{ $key }}][student_id]"
                                                               value="{{ $s->studentID }}" class="form-control">
                                                        <input type="text" readonly
                                                               name="data[{{ $key }}][name]"
                                                               value="{{ $s->name }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label for="simpleinput">Attendance</label>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                   name="data[{{ $key }}][attendance_type]" value="0"
                                                                   {{ $s->attendance_type == 0 ?'checked' :'' }}
                                                                   checked>
                                                            <label class="form-check-label"
                                                                   for="inlineRadio1">Present</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                   name="data[{{ $key }}][attendance_type]"
                                                                   value="1" {{ $s->attendance_type == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                   for="inlineRadio2">Absent</label>
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
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer justify-content-end d-flex">
                                    <button type="submit" class="btn btn-success mr-2">Update</button>
                                    <a href="{{ route('student_attendance.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                                {{--                                {!! Form::close() !!}--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> <!-- .container-fluid -->
@endsection
