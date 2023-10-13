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
                                                        max="{{ now()->format('Y-m-d') }}" name="date" required>
                                                </div>
                                            </div>
                                            @foreach ($trainer as $t)
                                                @php
                                                    $regularSlottrainerIds = [];
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
                                                                                            <input class="form-check-input"
                                                                                                type="radio"
                                                                                                name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                value="P" required checked>
                                                                                            <label class="form-check-label"
                                                                                                for="inlineRadio1" >Present</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <input class="form-check-input"
                                                                                                type="radio"
                                                                                                name="data[{{ $regularStaff->slot->id }}][status]"
                                                                                                value="A" required>
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
                                                                                            name="data[{{  $regularStaff->slot->id }}][absent_reason]"
                                                                                            class="form-control">
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
                                                                                                class="form-check-input"
                                                                                                type="radio"
                                                                                                name="data[{{ $proxy->slot->id }}][status]"
                                                                                                value="P" required checked>
                                                                                            <label
                                                                                                class="form-check-label"
                                                                                                for="inlineRadio1">Present</label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <input
                                                                                                class="form-check-input"
                                                                                                type="radio"
                                                                                                name="data[{{  $proxy->slot->id }}][status]"
                                                                                                value="A" required>
                                                                                            <label
                                                                                                class="form-check-label"
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
                                                                                            name="data[{{  $proxy->slot->id }}][absent_reason]"
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

@push('scripts')
    <script>
        $(document).ready(function(){
            var form = $('#quickForm');
            var validator = form.validate({
                rules : {
                    status : {
                        required: true,
                    }
                },
                messages: {
                    status: {
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
