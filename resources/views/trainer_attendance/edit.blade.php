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
                                        {!! Form::model($trainerAttendance, ['method' => 'PATCH','route' => ['trainer_attendance.update',$EditDate]]) !!}
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label for="example-date">Date</label>
                                                    <input class="form-control" type="date" value="{{ $EditDate }}" id="date"
                                                        max="{{ now()->format('Y-m-d') }}" name="date" required readonly>
                                                </div>
                                            </div>
                                            @foreach($trainerAttendance as $key => $ta)
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Trainer name</label>
                                                            <input type="text" readonly
                                                                value="{{ $key }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        @foreach ($ta as $key => $slotGroup)
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        @if ($slotGroup->slot_type == "Regular")
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="simpleinput">RegularStaff
                                                                                    slot-time</label>
                                                                                <input type="hidden" readonly
                                                                                    name="data[{{ $slotGroup->id }}][id]"
                                                                                    value="{{ $slotGroup->id }}"
                                                                                    class="form-control">
                                                                                <div class="row">
                                                                                    <input type="text" readonly
                                                                                        value="{{ $slotGroup->slot_time }}"
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="simpleinput">Proxy
                                                                                    slot-time</label>
                                                                                <input type="hidden" readonly
                                                                                    name="data[{{ $slotGroup->id }}][id]"
                                                                                    value="{{ $slotGroup->id }}"
                                                                                    class="form-control">
                                                                                <div class="row">
                                                                                    <input type="text" readonly
                                                                                        value="{{ $slotGroup->slot_time }}"
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="simpleinput">Attendance</label>
                                                                            <br>
                                                                            <div
                                                                                class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio"
                                                                                    name="data[{{ $slotGroup->id }}][status]" value="P"
                                                                                        {{ $slotGroup->status == "P" ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio1">Present</label>
                                                                            </div>
                                                                            <div
                                                                                class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio"
                                                                                        name="data[{{ $slotGroup->id }}][status]" value="A"
                                                                                        {{ $slotGroup->status == "A" ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error('status')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="simpleinput">Absent
                                                                                reason</label>
                                                                            <input type="text"
                                                                                name="data[{{  $slotGroup->id }}][absent_reason]"
                                                                                value="{{ $slotGroup->absent_reason }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
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

