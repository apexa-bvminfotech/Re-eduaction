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
                                            @foreach ($trainer as $t)
                                                @php
                                                    $regularSlottrainerIds = [];
                                                @endphp
                                                 @php
                                                    $regularSlottrainerIds = [];
                                                @endphp
                                                @php
                                                    $presentTrainerId = [];
                                                    $presentSlotId = [];
                                                    $absentTrainerId = [];
                                                    $absentSlotId = [];
                                                @endphp
                                                @foreach ($trainerAttendance as $atten)
                                                    @if($atten->status == 'P')
                                                        @php
                                                            $presentTrainerId[] = $atten->trainer_id;
                                                            $presentSlotId[] = $atten->slot_id;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $absentTrainerId[] = $atten->trainer_id;
                                                            $absentSlotId[] = $atten->slot_id;
                                                        @endphp
                                                    @endif
                                                @endforeach
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
                                                                                            @foreach ($trainerAttendance as $ta)
                                                                                                @if($t->id == $ta->trainer_id && $regularStaff->slot->id == $ta->slot_id)
                                                                                                    <input type="hidden" readonly name="data[{{ $regularStaff->slot->id }}][trainer_attendance_id]"  value="{{ $ta->id }}" class="form-control">
                                                                                                @endif
                                                                                            @endforeach   
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="simpleinput">Attendance</label>
                                                                                        <br>
                                                                                        @if (in_array($t->id,$presentTrainerId) && in_array($regularStaff->slot->id,$presentSlotId))
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                    value="P" checked>
                                                                                                <label class="form-check-label"
                                                                                                    for="inlineRadio1" >Present</label>
                                                                                            </div>
                                                                                        @else
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                    value="P">
                                                                                                <label class="form-check-label"
                                                                                                    for="inlineRadio1" >Present</label>
                                                                                            </div>
                                                                                        @endif
                                                                                        @if (in_array($t->id,$absentTrainerId) && in_array($regularStaff->slot->id,$absentSlotId))
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                    value="A" checked>
                                                                                                <label class="form-check-label"
                                                                                                    for="inlineRadio2">Absent</label>
                                                                                            </div>
                                                                                        @else
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                    value="A">
                                                                                                <label class="form-check-label"
                                                                                                    for="inlineRadio2">Absent</label>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="simpleinput">Absent reason</label>
                                                                                        @foreach ($trainerAttendance as $at)
                                                                                            @php
                                                                                                $absentReasonStudentId = [];
                                                                                                $absentReasonTrainerId = [];
                                                                                                $absentReasonSlotId = [];
                                                                                            @endphp
                                                                                            @if($at->absent_reason !== null)
                                                                                                @php
                                                                                                    $absentReasonTrainerId[] = $at->trainer_id;
                                                                                                    $absentReasonSlotId[] = $at->slot_id;
                                                                                                @endphp
                                                                                            @else
                                                                                                @php
                                                                                                    $absentReasonTrainerId[] = $at->trainer_id;
                                                                                                    $absentReasonSlotId[] = $at->slot_id;
                                                                                                @endphp
                                                                                            @endif
                                                                                            @if (in_array($t->id,$absentReasonTrainerId) && in_array($regularStaff->slot->id,$absentReasonSlotId))
                                                                                                <input type="text"  name="data[{{  $regularStaff->slot->id }}][absent_reason]"
                                                                                                    class="form-control" value="{{ $at->absent_reason }}">
                                                                                            @elseif (in_array($t->id,$absentReasonTrainerId) && in_array($regularStaff->slot->id,$absentReasonSlotId))
                                                                                                <input type="text"  name="data[{{  $regularStaff->slot->id }}][absent_reason]"
                                                                                                    class="form-control" value="">
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div> 
                                                                                </div> 
                                                                            @endif           
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $regularSlottrainerIds[] = $regularStaff->trainer_id;
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
                                                                                                    @foreach ($trainerAttendance as $ta)
                                                                                                        @if($t->id == $ta->trainer_id && $proxy->slot->id == $ta->slot_id)
                                                                                                            <input type="hidden" readonly name="data[{{ $proxy->slot->id }}][trainer_attendance_id]"  value="{{ $ta->id }}" class="form-control">
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="simpleinput">Attendance</label>
                                                                                        <br>
                                                                                        @if (in_array($t->id,$presentTrainerId) && in_array($proxy->slot->id,$presentSlotId))
                                                                                        <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{ $proxy->slot->id }}][status]"
                                                                                                    value="P" checked>
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="inlineRadio1">Present</label>
                                                                                            </div>
                                                                                        @else
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{ $proxy->slot->id }}][status]"
                                                                                                    value="P">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="inlineRadio1">Present</label>
                                                                                            </div>
                                                                                        @endif
                                                                                        @if (in_array($t->id,$absentTrainerId) && in_array($proxy->slot->id,$absentSlotId))
                                                                                        <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{  $proxy->slot->id }}][status]"
                                                                                                    value="A" checked>
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="inlineRadio2">Absent</label>
                                                                                            </div>
                                                                                        @else
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="radio"
                                                                                                    name="data[{{  $proxy->slot->id }}][status]"
                                                                                                    value="A">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="inlineRadio2">Absent</label>
                                                                                            </div>
                                                                                        @endif  
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="simpleinput">Absent reason</label>
                                                                                        @foreach ($trainerAttendance as $at)
                                                                                            @php
                                                                                                $absentReasonTrainerId = [];
                                                                                                $absentReasonSlotId = [];
                                                                                            @endphp
                                                                                            @if($at->absent_reason !== null && $at->slot_type == 'Proxy')
                                                                                                @php
                                                                                                    $absentReasonTrainerId[] = $at->trainer_id;
                                                                                                    $absentReasonSlotId[] = $at->slot_id;
                                                                                                @endphp
                                                                                            @else
                                                                                                @php
                                                                                                    $absentReasonTrainerId[] = $at->trainer_id;
                                                                                                    $absentReasonSlotId[] = $at->slot_id;
                                                                                                @endphp
                                                                                            @endif
                                                                                            @if (in_array($t->id,$absentReasonTrainerId) && in_array($proxy->slot->id,$absentReasonSlotId))
                                                                                                <input type="text"  name="data[{{  $proxy->slot->id }}][absent_reason]"
                                                                                                    class="form-control" value="{{ $at->absent_reason }}">
                                                                                            @elseif (in_array($t->id,$absentReasonTrainerId) && in_array($proxy->slot->id,$absentReasonSlotId))
                                                                                                <input type="text"  name="data[{{  $proxy->slot->id }}][absent_reason]"
                                                                                                    class="form-control" value="">
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div> 
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $proxyStaffTrainerIds[] = $proxy->trainer_id;
                                                                    @endphp
                                                                </div>
                                                            {{-- @endif --}}
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            {{-- @foreach($trainerAttendance as $key => $ta)
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
                                            @endforeach --}}
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

