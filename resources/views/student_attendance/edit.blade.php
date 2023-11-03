@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Student Attendance</h1>
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
                            <div class="card-body">
                                {!! Form::model($studentAttendance, ['method' => 'PATCH','route' => ['student_attendance.update',$EditDate]]) !!}
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="example-date">Date</label>
                                            <input class="form-control" type="date" value="{{ $EditDate }}" max="{{now()->format('Y-m-d')}}"
                                                   name="attendance_date" required readonly>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($trainer as $t)
                                    @php
                                        $regularSlottrainerIds = [];
                                        $regularSlotIds = [];
                                    @endphp
                                    {{-- for regular stff --}}
                                    @if (isset($studentStaffAssign[$t->name]))
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="simpleinput">Trainer name</label> 
                                                    <input type="text" readonly value="{{ $t->name }}" class="form-control">                                                    
                                                    <input type="hidden" readonly name="trainer_id[]"  value="{{ $t->id }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                @foreach ($studentStaffAssign[$t->name]->groupBy('slot_id') as $slotGroup)
                                                    @foreach ($slotGroup as $key => $regularStaff)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
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
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Student Name</label>     
                                                                        <input type="text" readonly 
                                                                            value="{{ $regularStaff->student->name }}" class="form-control">
                                                                        <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][student_details_regular][{{ $key }}][slot_type]" 
                                                                            value="Regular" class="form-control">
                                                                        <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][slot_id]"  value="{{ $regularStaff->slot->id }}" class="form-control">
                                                                        <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][student_details_regular][{{ $key }}][student_id]"  value="{{ $regularStaff->student->id }}" class="form-control">
                                                                        @foreach ($studentAttendance as $at)
                                                                            @if($t->id == $at->trainer_id && $regularStaff->slot->id == $at->slot_id && $regularStaff->student->id == $at->student_id)
                                                                                <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][student_attendance_id]"  value="{{ $at->id }}" class="form-control">
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Attendance</label>
                                                                        <br>
                                                                        @if (in_array($t->id,$presentTrainerId) && in_array($regularStaff->slot->id,$presentSlotId) && in_array($regularStaff->student->id,$presentStudentId))
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]" 
                                                                                    value="1" checked>
                                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]" 
                                                                                    value="1">
                                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                            </div>
                                                                        @endif
                                                                        @if (in_array($t->id,$absentTrainerId) && in_array($regularStaff->slot->id,$absentSlotId) && in_array($regularStaff->student->id,$absentStudentId))
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]" 
                                                                                    value="0" checked>
                                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][attendance_type]" 
                                                                                    value="0">
                                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $studentAttendanceController = new App\Http\Controllers\StudentAttendanceController();
                                                                    $absentReason = $studentAttendanceController->getAbsentReason($regularStaff->student->id,$t->id,$regularStaff->slot->id,$EditDate);
                                                                @endphp
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Absent reason</label>
                                                                        <input type="text" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details_regular][{{ $key }}][absent_reason]" 
                                                                            class="form-control" value="{{ $absentReason }}">
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
                                    {{-- for proxy slot --}}
                                    @if (isset($proxyStaff[$t->name]))
                                        @foreach ($proxyStaff[$t->name]->groupBy('slot_id') as $slotGroup)
                                            @php
                                                $proxyStaffTrainerIds = [];
                                                $proxySlotIds = [];
                                            @endphp
                                            @foreach ($slotGroup as $key => $proxy)
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
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
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
                                                                <div class="col-md-3">
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
                                                                        @foreach ($studentAttendance as $at)
                                                                            @if($t->id == $at->trainer_id && $proxy->slot->id == $at->slot_id && $proxy->student->id == $at->student_id)
                                                                                <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][student_attendance_id]"  value="{{ $at->id }}" class="form-control">
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        @if (in_array($t->id,$presentTrainerId) && in_array($proxy->slot->id,$presentSlotId) && in_array($proxy->student->id,$presentStudentId))
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][attendance_type]" 
                                                                                    value="1" checked>
                                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][attendance_type]" 
                                                                                    value="1">
                                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                            </div>
                                                                        @endif
                                                                        @if (in_array($t->id,$absentTrainerId) && in_array($proxy->slot->id,$absentSlotId) && in_array($proxy->student->id,$absentStudentId))
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][attendance_type]" 
                                                                                    value="0" checked>
                                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][attendance_type]" 
                                                                                    value="0">
                                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div> 
                                                                @php
                                                                    $studentAttendanceController = new App\Http\Controllers\StudentAttendanceController();
                                                                    $absentReason = $studentAttendanceController->getAbsentReason($proxy->student->id,$t->id,$proxy->slot->id,$EditDate);
                                                                @endphp
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Absent reason</label>
                                                                        <input type="text" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details_proxy][{{ $key }}][absent_reason]" 
                                                                                    class="form-control" value="{{ $absentReason }}">
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
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                                
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-success mr-1">
                                        Update
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

