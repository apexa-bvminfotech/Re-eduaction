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
                                        {!! Form::open(['route' => 'trainer_attendance.store', 'method' => 'POST', 'id' => 'quickForm', 'class' => 'needs-validation', 'validate' => false]) !!}
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label for="example-date">Date</label>
                                                    <input class="form-control" type="date" value="{{ date('Y-m-d') }}"
                                                        max="{{ now()->format('Y-m-d') }}" name="date">
                                                </div>
                                            </div>
                                            @foreach ($trainer as $t)
                                                @php
                                                    $regularSlottrainerIds = [];
                                                    $regularSlotIds = [];
                                                @endphp
                                                @if (isset($studentStaffAssign[$t->name]))
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="simpleinput">Trainer name</label>
                                                                <input type="text" readonly
                                                                    value="{{ $t->name }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        {{-- for Regular staff  --}}
                                                        <div class="col-md-9">
                                                            @foreach ($studentStaffAssign[$t->name]->groupBy('slot_id') as $slotGroup)
                                                                @foreach ($slotGroup as $key => $regularStaff)
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            @if($key === 0)
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="simpleinput">RegularStaff
                                                                                            slot-time</label>
                                                                                        <input type="hidden" readonly
                                                                                            name="data[{{ $regularStaff->slot->id }}][slot_id]"
                                                                                            value="{{ $regularStaff->slot->id }}"
                                                                                            class="form-control">
                                                                                        <input type="hidden" readonly
                                                                                            name="data[{{ $regularStaff->slot->id }}][trainer_id]"
                                                                                            value="{{ $t->id }}"
                                                                                            class="form-control">
                                                                                        <div class="row">
                                                                                            <input type="text" readonly
                                                                                                name="data[{{ $regularStaff->slot->id }}][regular_staff_slot_time]"
                                                                                                value="{{ $regularStaff->slot->slot_time }}"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                        <input type="hidden" readonly
                                                                                            name="data[{{ $regularStaff->slot->id }}][slot_type]"
                                                                                            value="Regular"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="simpleinput">Attendance</label>
                                                                                        <br>
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <input class="form-check-input attendance-checkbox-present trainer-{{ $t->id }}"
                                                                                                type="radio"
                                                                                                name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                value="P">
                                                                                            <label class="form-check-label"
                                                                                                for="inlineRadio1" >Present</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <input class="form-check-input attendance-checkbox-absent trainer-{{ $t->id }}"
                                                                                                type="radio"
                                                                                                name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                value="A">
                                                                                            <input type="hidden" name="data[{{ $regularStaff->slot->id }}][attendance_type]" value="null">
                                                                                            <label class="form-check-label"
                                                                                                for="inlineRadio2">Absent</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="all_present">All Present</label>
                                                                                        <input type="radio" name="all_present_{{ $t->id }}" value="1" onclick="toggleAttendancepresent(this, {{ $t->id }}, '1')">
                                                                                        <label for="all_absent">All Absent</label>
                                                                                        <input type="radio" name="all_absent_{{ $t->id }}" value="1" onclick="toggleAttendanceabsent(this, {{ $t->id }}, '0')">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="simpleinput">Absent
                                                                                            reason</label>
                                                                                        <input type="text"
                                                                                            name="data[{{  $regularStaff->slot->id }}][absent_reason]"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $regularSlottrainerIds[] = $regularStaff->trainer_id;
                                                                        $regularSlotIds[] = $regularStaff->slot->id;
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- for Proxy staff --}}
                                                @if (isset($proxyStaff[$t->name]))
                                                    @foreach ($proxyStaff[$t->name]->groupBy('slot_id') as $slotGroup)
                                                        @php
                                                            $proxyStaffTrainerIds = [];
                                                            $proxySlotIds = [];
                                                        @endphp
                                                        @foreach ($slotGroup as $key => $proxy)
                                                            {{-- @if ($t->name == $proxy->trainer->name) --}}
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        @if(!in_array($t->id,$regularSlottrainerIds) && !in_array($t->id,$proxyStaffTrainerIds))
                                                                            <div class="form-group">
                                                                                <label for="simpleinput">Trainer name</label>
                                                                                <input type="text" readonly
                                                                                    value="{{ $t->name }}" class="form-control">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group">
                                                                            @if(!in_array($proxy->slot->id,$regularSlotIds) && !in_array($proxy->slot->id,$proxySlotIds))
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        @if ($key === 0)
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="simpleinput">Proxy-slot
                                                                                                    Time</label>
                                                                                                <div class="row">
                                                                                                    <input type="hidden"
                                                                                                        readonly
                                                                                                        name="data[{{ $proxy->slot->id }}][slot_id]"
                                                                                                        value="{{ $proxy->slot->id }}"
                                                                                                        class="form-control">
                                                                                                    <input type="hidden" readonly
                                                                                                        name="data[{{ $proxy->slot->id }}][trainer_id]"
                                                                                                        value="{{ $t->id }}"
                                                                                                        class="form-control">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        name="data[{{ $proxy->slot->id }}][proxy_staff_slot_time]"
                                                                                                        value="{{ $proxy->slot->slot_time }}"
                                                                                                        class="form-control">
                                                                                                    <input type="hidden"
                                                                                                        readonly
                                                                                                        name="data[{{ $proxy->slot->id }}][slot_type]"
                                                                                                        value="Proxy"
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
                                                                                                <input
                                                                                                    class="form-check-input attendance-checkbox-present-proxy trainer-{{ $t->id }}"
                                                                                                    type="radio"
                                                                                                    name="data[{{ $proxy->slot->id }}][status]"
                                                                                                    value="P">
                                                                                                <input type="hidden" name="data[{{ $proxy->slot->id }}][attendance_type]" value="null">

                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="inlineRadio1">Present</label>
                                                                                            </div>
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input
                                                                                                    class="form-check-input attendance-checkbox-absent-proxy trainer-{{ $t->id }}"
                                                                                                    type="radio"
                                                                                                    name="data[{{  $proxy->slot->id }}][status]"
                                                                                                    value="A">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="inlineRadio2">Absent</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="all_present">All Present</label>
                                                                                            <input type="radio" name="all_present_proxy{{ $t->id }}" value="1" onclick="toggleAttendancepresentproxy(this, {{ $t->id }}, '1')">
                                                                                            <label for="all_absent">All Absent</label>
                                                                                            <input type="radio" name="all_absent_proxy{{ $t->id }}" value="0" onclick="toggleAttendanceabsentproxy(this, {{ $t->id }}, '0')">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="simpleinput">Absent
                                                                                                reason</label>
                                                                                            <input type="text"
                                                                                                name="data[{{  $proxy->slot->id }}][absent_reason]"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $proxyStaffTrainerIds[] = $proxy->trainer_id;
                                                                        $proxySlotIds[] = $proxy->slot->id;
                                                                    @endphp
                                                                </div>
                                                            {{-- @endif --}}
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            <div class="form-group float-right">
                                                <button type="submit" class="btn btn-success mr-1">
                                                    Create
                                                </button>
                                                <a href="{{ route('trainer_attendance.index') }}"
                                                    class="btn btn-danger">Cancel</a>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
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
<script>
   function toggleAttendancepresent(checkbox, trainerId, attendanceType) {
    var checkboxesAbsent = document.querySelectorAll('.attendance-checkbox-absent.trainer-' + trainerId);
    checkboxesAbsent.forEach(function (cb) {
        cb.checked = false;
    });

    var checkboxesPresent = document.querySelectorAll('.attendance-checkbox-present.trainer-' + trainerId);
    checkboxesPresent.forEach(function (cb) {
        cb.checked = attendanceType === '1';
    });

    document.querySelector('input[name="all_absent_' + trainerId + '"]').checked = false;
    document.querySelector('input[name="all_present_' + trainerId + '"]').checked = attendanceType === '1';
}

function toggleAttendanceabsent(checkbox, trainerId, attendanceType) {
    var checkboxesPresent = document.querySelectorAll('.attendance-checkbox-present.trainer-' + trainerId);
    checkboxesPresent.forEach(function (cb) {
        cb.checked = false;
    });

    var checkboxesAbsent = document.querySelectorAll('.attendance-checkbox-absent.trainer-' + trainerId);
    checkboxesAbsent.forEach(function (cb) {
        cb.checked = attendanceType === '0';
    });

    document.querySelector('input[name="all_present_' + trainerId + '"]').checked = false;
    document.querySelector('input[name="all_absent_' + trainerId + '"]').checked = attendanceType === '0';
}

function toggleAttendancepresentproxy(checkbox, trainerId, attendanceType) {
    var checkboxesAbsent = document.querySelectorAll('.attendance-checkbox-absent-proxy.trainer-' + trainerId);
    checkboxesAbsent.forEach(function (cb) {
        cb.checked = false;
    });

    var checkboxesPresent = document.querySelectorAll('.attendance-checkbox-present-proxy.trainer-' + trainerId);
    checkboxesPresent.forEach(function (cb) {
        cb.checked = attendanceType === '1';
    });

    document.querySelector('input[name="all_absent_proxy' + trainerId + '"]').checked = false;
    document.querySelector('input[name="all_present_proxy' + trainerId + '"]').checked = attendanceType === '1';
}

function toggleAttendanceabsentproxy(checkbox, trainerId, attendanceType) {
    var checkboxesPresent = document.querySelectorAll('.attendance-checkbox-present-proxy.trainer-' + trainerId);
    checkboxesPresent.forEach(function (cb) {
        cb.checked = false;
    });

    var checkboxesAbsent = document.querySelectorAll('.attendance-checkbox-absent-proxy.trainer-' + trainerId);
    checkboxesAbsent.forEach(function (cb) {
        cb.checked = attendanceType === '0';
    });

    document.querySelector('input[name="all_present_proxy' + trainerId + '"]').checked = false;
    document.querySelector('input[name="all_absent_proxy' + trainerId + '"]').checked = attendanceType === '0';
}
</script>
