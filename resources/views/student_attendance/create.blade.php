@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Student Attendance</h1>
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
                            @if(isset($studentAttendance) && count($studentAttendance)>0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            <li>This date Attendance already created</li>
                                        </ul>
                                    </div>
                            @endif
                            <div class="card-body">
                                {!! Form::open(array('route' => 'student_attendance.store','method'=>'POST', 'id' => 'quickForm', 'class' => 'needs-validation', 'validate' => false)) !!}
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="example-date">Date</label>
                                            <input class="form-control" type="date" value="{{ date('Y-m-d') }}" max="{{now()->format('Y-m-d')}}"
                                                   name="attendance_date" required>
                                        </div>
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
                                                    <input type="text" readonly value="{{ $t->name }}" class="form-control">
                                                    <input type="hidden" readonly name="trainer_id[]"  value="{{ $t->id }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="simpleinput">Attendance</label>
                                                    <br>
                                                    <label for="all_present">All Present</label>
                                                    <input type="radio" name="all_present_{{ $t->id }}" value="1" onclick="toggleAttendancepresent(this, {{ $t->id }}, '1')">
                                                    <label for="all_absent">All Absent</label>
                                                    <input type="radio" name="all_absent_{{ $t->id }}" value="0" onclick="toggleAttendanceabsent(this, {{ $t->id }}, '0')">
                                                </div>
                                            </div>

                                            {{-- for Regular staff  --}}
                                            <div class="col-md-7">
                                                @foreach ($studentStaffAssign[$t->name]->groupBy('slot_id') as $slotGroup)
                                                    @foreach ($slotGroup as $key => $regularStaff)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    @if ($key === 0)
                                                                        <div class="form-group">
                                                                            <label for="simpleinput">RegularStaff slot-time</label>
                                                                            <input type="text" readonly  value="{{ $regularStaff->slot->slot_time }}" class="form-control">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Student Name</label>
                                                                        <input type="text" readonly
                                                                            value="{{ $regularStaff->student->name }}" class="form-control">
                                                                        <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][student_details_regular][{{ $key }}][slot_type]"
                                                                            value="Regular" class="form-control">
                                                                        <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][slot_id]"  value="{{ $regularStaff->slot->id }}" class="form-control">
                                                                        <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][student_details_regular][{{ $key }}][student_id]"  value="{{ $regularStaff->student->id }}" class="form-control">
                                                                        {{-- <input type="hidden" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details][{{ $key }}][attendance_type]" value="null"> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    {{-- <div class="form-group">
                                                                        <label for="simpleinput">Attendance</label>
                                                                        <br>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]"
                                                                                value="1">
                                                                            <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]"
                                                                                value="0">
                                                                            <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                        </div>
                                                                    </div> --}}


                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Attendance</label>
                                                                        <br>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input attendance-checkbox-present trainer-{{ $t->id }}" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]" value="1">
                                                                            <label class="form-check-label" for="inlineCheckbox1">Present</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input attendance-checkbox-absent trainer-{{ $t->id }}" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]" value="0">
                                                                            <label class="form-check-label" for="inlineCheckbox2">Absent</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Absent reason</label>
                                                                        <input type="text" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][absent_reason]"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
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
                                                                    <input type="text" readonly value="{{ $t->name }}" class="form-control">
                                                                    <input type="hidden" readonly name="trainer_id[]"  value="{{ $t->id }}" class="form-control">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="simpleinput">Attendance</label>
                                                                <br>
                                                                <label for="all_present">All Present</label>
                                                                <input type="radio" name="all_present_proxy{{ $t->id }}" value="1" onclick="toggleAttendancepresentproxy(this, {{ $t->id }}, '1')">
                                                                <label for="all_absent">All Absent</label>
                                                                <input type="radio" name="all_absent_proxy{{ $t->id }}" value="1" onclick="toggleAttendanceabsentproxy(this, {{ $t->id }}, '0')">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        @if ($key === 0)
                                                                            @if(!in_array($proxy->slot->id,$regularSlotIds) && !in_array($proxy->slot->id,$proxySlotIds))
                                                                                <div class="form-group">
                                                                                    <label for="simpleinput">Proxy slot-time</label>
                                                                                    <input type="text" readonly
                                                                                        value="{{ $proxy->slot->slot_time }}" class="form-control">
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="simpleinput">Student Name</label>
                                                                            <input type="text" readonly
                                                                                value="{{ $proxy->student->name }}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="simpleinput">Attendance</label>
                                                                            <br>
                                                                            <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $proxy->slot->id }}][student_details_proxy][{{ $key }}][slot_type]"
                                                                            value="Proxy" class="form-control">
                                                                            <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][slot_id]"  value="{{  $proxy->slot->id }}" class="form-control">
                                                                            <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][student_id]"  value="{{ $proxy->student->id }}" class="form-control">
                                                                            {{-- <input type="hidden" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][attendance_type]" value="null"> --}}
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input attendance-checkbox-present-proxy trainer-{{ $t->id }}" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][attendance_type]"
                                                                                    value="1">
                                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input attendance-checkbox-absent-proxy trainer-{{ $t->id }}" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][attendance_type]"
                                                                                    value="0">
                                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="simpleinput">Absent reason</label>
                                                                            <input type="text" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][absent_reason]"
                                                                            class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                    <a href="{{ route('student_attendance.index') }}"
                                        class="btn btn-danger">Cancel</a>
                                </div>
                                    {!! Form::close() !!}
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

