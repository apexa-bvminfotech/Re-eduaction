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
                            <div class="card-body">
                                {!! Form::open(array('route' => 'student_attendance.store','method'=>'POST', 'id' => 'quickForm', 'class' => 'needs-validation', 'validate' => false)) !!}
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="example-date">Date</label>
                                            <input class="form-control" type="date" value="{{ date('Y-m-d') }}" max="{{now()->format('Y-m-d')}}"
                                                   name="attendance_date" required>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($trainer as $t)
                                    @if (isset($studentStaffAssign[$t->name]))
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="simpleinput">Trainer name</label> 
                                                    <input type="text" readonly value="{{ $t->name }}" class="form-control">                                                    
                                                    <input type="hidden" readonly name="trainer_id[]"  value="{{ $t->id }}" class="form-control">
                                                </div>
                                            </div>
                                            {{-- for Regular staff  --}}
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
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Attendance</label>
                                                                        <br>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                value="1" required checked>
                                                                            <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $regularStaff->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                value="0" required>
                                                                            <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                        </div>
                                                                    </div>
                                                                    @error('attendance_type')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
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
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    {{-- for Proxy staff --}}
                                    @if (isset($proxyStaff[$t->name]))
                                        @foreach ($proxyStaff[$t->name]->groupBy('slot_id') as $slotGroup)
                                            @foreach ($slotGroup as $key => $proxy)
                                                @if ($t->name !== $proxy->trainer_name)
                                                    <div class="row">
                                                        <div class="col-md-3">
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

                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                    value="1" required checked>
                                                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="attendance_details_{{ $t->id }}[slot_{{ $t->id }}_{{  $proxy->slot->id }}][student_details][{{ $key }}][attendance_type]" 
                                                                                    value="0" required>
                                                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                                                            </div>
                                                                        </div>
                                                                        @error('attendance_type')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
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
                                                    </div>
                                                @endif
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
        </section>
    </div> 
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            var form = $('#quickForm');
            var validator = form.validate({
                rules : {
                    attendance_type : {
                        required: true,
                    }
                },
                messages: {
                    attendance_type: {
                        required: 'Please fill your attendance .',
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).closest('.form-check').addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush

