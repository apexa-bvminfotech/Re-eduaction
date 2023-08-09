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
                                {!! Form::open(array('route' => 'student_attendance.store','method'=>'POST')) !!}
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="example-date">Date</label>
                                            <input class="form-control" type="date" value="{{ date('Y-m-d') }}" max="{{now()->format('Y-m-d')}}"
                                                   name="attendance_date" required>
                                        </div>
                                    </div>

                                </div>

                                @foreach($trainer as $t)
                                    @if(isset($t->studentAssign) && !$t->studentAssign->isEmpty())
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="simpleinput">Trainer name</label>
                                                    <input type="hidden" readonly
                                                           name="data[{{ $t->id  }}][trainer_id]"
                                                           value="{{ $t->id }}" class="form-control">
                                                    <input type="text" readonly
                                                           name="data[{{ $t->id  }}][trainer_name]"
                                                           value="{{ $t->name }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                @forelse($t->studentAssign->groupBy('slot.slot_time') as $key => $regularSlot)
                                                    @if($key>0)
                                                        <div class="col-md-3">
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="simpleinput">RegularStaff
                                                                        slot-time</label>
                                                                    <input type="hidden" readonly
                                                                           name="data[{{ $key }}][trainer_id]"
                                                                           value="{{ $key }}"
                                                                           class="form-control">
                                                                    <div class="row">
                                                                        <input type="text" readonly
                                                                               name="data[{{ $key }}][trainer_name]"
                                                                               value="{{ $key }}"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach($regularSlot as $key1 => $student)

                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label for="simpleinput">Student name</label>
                                                                            <input type="hidden" readonly
                                                                                   name="data[{{ $key1 }}][student_id]"
                                                                                   value="{{ $key1 }}" class="form-control">
                                                                            <input type="text" readonly
                                                                                   name="data[{{ $key1 }}][student_name]"
                                                                                   value="{{ $student->student->name }}" class="form-control">
                                                                            @error('student_id')
                                                                            <span class="text-danger">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label for="simpleinput">Attendance</label>
                                                                            <br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio"
                                                                                       name="data[{{ $key }}][attendance_type]" value="0"
                                                                                >
                                                                                <label class="form-check-label"
                                                                                       for="inlineRadio1">Present</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio"
                                                                                       name="data[{{ $key }}][attendance_type]" value="1">
                                                                                <label class="form-check-label"
                                                                                       for="inlineRadio2">Absent</label>
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
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @empty
                                                @endforelse
                                            </div>
                                            {{-- ///proxy staff//--}}
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                @forelse($t->studentAssignProxy->groupBy('slot.slot_time') as $key2 => $regularSlotProxy)
                                                    @if(isset($t->studentAssignProxy) && !$t->studentAssignProxy->isEmpty())
                                                        @if($key2>0)
                                                            <div class="col-md-3">
                                                            </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="simpleinput">Proxy
                                                                            slot-time</label>
                                                                        <input type="hidden" readonly
                                                                               name="data[{{ $key2 }}][trainer_id]"
                                                                               value="{{ $key2 }}"
                                                                               class="form-control">
                                                                        <div class="row">
                                                                            <input type="text" readonly
                                                                                   name="data[{{ $key2 }}][trainer_name]"
                                                                                   value="{{ $key2 }}"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @foreach($regularSlotProxy as $key3 => $studentProxy)
                                                            @if($key3>0)
                                                                <div class="col-md-3">
                                                                </div>
                                                            @endif
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group mb-3">
                                                                                <label for="simpleinput">Student name</label>
                                                                                <input type="hidden" readonly
                                                                                       name="data[{{ $key3 }}][student_id]"
                                                                                       value="{{ $key3 }}" class="form-control">
                                                                                <input type="text" readonly
                                                                                       name="data[{{ $key3 }}][student_name]"
                                                                                       value="{{ $student->student->name }}" class="form-control">
                                                                                @error('student_id')
                                                                                <span class="text-danger">{{$message}}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group mb-3">
                                                                                <label for="simpleinput">Attendance</label>
                                                                                <br>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio"
                                                                                           name="data[{{ $key }}][attendance_type]" value="0"
                                                                                    >
                                                                                    <label class="form-check-label"
                                                                                           for="inlineRadio1">Present</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio"
                                                                                           name="data[{{ $key }}][attendance_type]" value="1">
                                                                                    <label class="form-check-label"
                                                                                           for="inlineRadio2">Absent</label>
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
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                                {!! Form::close() !!}
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer justify-content-end d-flex">
                                <button type="submit" class="btn btn-success mr-2">Create</button>
                                <a href="{{ route('student_attendance.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> <!-- .container-fluid -->
@endsection
