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
                                            <input class="form-control" type="date" value="{{ date('Y-m-d') }}" max="{{now()->format('Y-m-d')}}"
                                                   name="attendance_date" required>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($studentAttendance as $key => $sa)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="simpleinput">Trainer name</label> 
                                                <input type="text" readonly value="{{ $key }}" class="form-control">                                                    
                                            </div>
                                        </div>
                                        {{-- for Regular staff  --}}
                                        <div class="col-md-9">
                                            @php
                                                $regularSlotIds = [];
                                            @endphp
                                            @php
                                                $proxySlotIds = [];
                                            @endphp
                                            @foreach ($sa as $key => $slotGroup)
                                                @if ($slotGroup->slot_type == "Regular")
                                                    @if(!in_array($slotGroup->slot_id,$regularSlotIds))
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">RegularStaff slot-time</label>
                                                                        <input type="hidden" readonly name="trainer_id[]"  value="{{ $slotGroup->trainerID }}" class="form-control">
                                                                        <input type="text" readonly  value="{{ $slotGroup->slot_time }}" class="form-control">    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif     
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="simpleinput">Student Name</label>     
                                                                    <input type="text" readonly 
                                                                        value="{{ $slotGroup->student_name }}" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{ $slotGroup->slot_id }}][slot_type]" 
                                                                        value="Regular" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{ $slotGroup->slot_id }}][slot_id]"  value="{{  $slotGroup->slot_id }}" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][student_attendance_id]"  value="{{ $slotGroup->id }}" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][student_id]"  value="{{ $slotGroup->studentID }}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="simpleinput">Attendance</label>
                                                                    <br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][attendance_type]" 
                                                                            value="1" {{ $slotGroup->attendance_type == "1" ? 'checked' : '' }} >
                                                                        <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{$slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][attendance_type]" 
                                                                            value="0" {{ $slotGroup->attendance_type == "0" ? 'checked' : '' }} >
                                                                        <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="simpleinput">Absent reason</label>
                                                                    <input type="text" name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{$slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][absent_reason]" 
                                                                    value="{{ $slotGroup->absent_reason }}"  class="form-control">
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    @php
                                                        $regularSlotIds[] = $slotGroup->slot_id;
                                                    @endphp 
                                                @else
                                                    @if(!in_array($slotGroup->slot_id,$proxySlotIds))
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">ProxyStaff slot-time</label>
                                                                        <input type="text" readonly  value="{{ $slotGroup->slot_time }}" class="form-control">    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="simpleinput">Student Name</label>     
                                                                    <input type="text" readonly 
                                                                        value="{{ $slotGroup->student_name }}" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{ $slotGroup->slot_id }}][slot_type]" 
                                                                        value="pROXY" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{ $slotGroup->slot_id }}][slot_id]"  value="{{  $slotGroup->slot_id }}" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][student_attendance_id]"  value="{{ $slotGroup->id }}" class="form-control">
                                                                    <input type="hidden" readonly name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][student_id]"  value="{{ $slotGroup->studentID }}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="simpleinput">Attendance</label>
                                                                    <br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{ $slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][attendance_type]" 
                                                                            value="1" {{ $slotGroup->attendance_type == "1" ? 'checked' : '' }} required>
                                                                        <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{$slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][attendance_type]" 
                                                                            value="0" {{ $slotGroup->attendance_type == "0" ? 'checked' : '' }} required>
                                                                        <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="simpleinput">Absent reason</label>
                                                                    <input type="text" name="attendance_details_{{ $slotGroup->trainerID }}[slot_{{$slotGroup->trainerID }}_{{  $slotGroup->slot_id }}][student_details][{{ $key }}][absent_reason]" 
                                                                    value="{{ $slotGroup->absent_reason }}"  class="form-control">
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        @php
                                                            $proxySlotIds[] = $slotGroup->slot_id;
                                                        @endphp 
                                                    </div>
                                                @endif   
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                @if(Auth::user()->type !== 1)
                                    @foreach ($trainer as $t)
                                        @php
                                            $regularSlottrainerIds = [];
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
                                                                            <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][slot_type]" 
                                                                                value="Regular" class="form-control">
                                                                            <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][slot_id]"  value="{{ $regularStaff->slot->id }}" class="form-control">
                                                                            <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][student_details][{{ $key }}][student_id]"  value="{{ $regularStaff->student->id }}" class="form-control">
                                                                            <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $regularStaff->slot->id }}][student_details][{{ $key }}][student_attendance_id]"  value="" class="form-control">
                                                                            <input type="hidden" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details][{{ $key }}][attendance_type]" value="null">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="simpleinput">Attendance</label>
                                                                            <br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                    value="1">
                                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                    value="0">
                                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="simpleinput">Absent reason</label>
                                                                            <input type="text" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details][{{ $key }}][absent_reason]" 
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>    
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

                                        @if (isset($proxyStaff[$t->name]))
                                            @foreach ($proxyStaff[$t->name]->groupBy('slot_id') as $slotGroup)
                                                @php
                                                    $proxyStaffTrainerIds = [];
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
                                                                                <div class="form-group">
                                                                                    <label for="simpleinput">Proxy slot-time</label>
                                                                                    <input type="text" readonly 
                                                                                        value="{{ $proxy->slot->slot_time }}" class="form-control">
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
                                                                                    value="{{ $proxy->student->name }}" class="form-control">   
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="simpleinput">Attendance</label>
                                                                                <br>
                                                                                <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{ $proxy->slot->id }}][slot_type]" 
                                                                                value="Proxy" class="form-control">
                                                                                <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][slot_id]"  value="{{  $proxy->slot->id }}" class="form-control">
                                                                                <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][student_id]"  value="{{ $proxy->student->id }}" class="form-control">
                                                                                <input type="hidden" readonly name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][student_attendance_id]"  value="{{ $slotGroup->id }}" class="form-control">
                                                                                <input type="hidden" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][attendance_type]" value="null">

                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                        value="1">
                                                                                    <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                        value="0">
                                                                                    <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="simpleinput">Absent reason</label>
                                                                                <input type="text" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][absent_reason]" 
                                                                                class="form-control">
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php
                                                                $proxyStaffTrainerIds[] = $proxy->trainer_id;
                                                            @endphp
                                                        </div>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                                
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

