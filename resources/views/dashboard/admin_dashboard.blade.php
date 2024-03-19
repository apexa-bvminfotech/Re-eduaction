@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card bg-light">
                        <div class="card-header" style="background-color:lightgray">
                            <h5 class="card-title w-100">
                                <h5 class="d-block w-100" data-toggle="collapse">
                                    Current Month Student Registration
                                </h5>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h5>Total Students</h5>
                                            <h5>{{ count($curMonStu) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countPending = 0;
                                    @endphp

                                    @foreach ($curMonStuStatus as $status)
                                        @if ($status->status === 'Pending')
                                            @php
                                                $countPending++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h5>Pending</h5>
                                            <h5>{{ $countPending }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countStart = 0;
                                    @endphp

                                    @foreach ($curMonStuStatus as $status)
                                        @if ($status->status === 'Start')
                                            @php
                                                $countStart++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h5>Start</h5>
                                            <h5>{{ $countStart }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countHold = 0;
                                    @endphp

                                    @foreach ($curMonStuStatus as $status)
                                        @if ($status->status === 'Hold')
                                            @php
                                                $countHold++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h5>Hold</h5>
                                            <h5>{{ $countHold }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countCancel = 0;
                                    @endphp

                                    @foreach ($curMonStuStatus as $status)
                                        @if ($status->status === 'Cancel')
                                            @php
                                                $countCancel++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="small-box bg-secondary">
                                        <div class="inner">
                                            <h5>Cancel</h5>
                                            <h5>{{ $countCancel }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countComplete = 0;
                                    @endphp

                                    @foreach ($curMonStuStatus as $status)
                                        @if ($status->status === 'Complete')
                                            @php
                                                $countComplete++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h5>Complete</h5>
                                            <h5>{{ $countComplete }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header" style="background-color:lightgray">
                            <h5 class="card-title w-100">
                                <h5 class="d-block w-100" data-toggle="collapse">
                                    Current Month Current Branch Student Registration
                                </h5>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h5>Total Students</h5>
                                            <h5>{{ count($students) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countPending = 0;
                                    @endphp

                                    @foreach ($studentStatus as $status)
                                        @if ($status->status === 'Pending')
                                            @php
                                                $countPending++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h5>Pending</h5>
                                            <h5>{{ $countPending }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countStart = 0;
                                    @endphp

                                    @foreach ($studentStatus as $status)
                                        @if ($status->status === 'Start')
                                            @php
                                                $countStart++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h5>Start</h5>
                                            <h5>{{ $countStart }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countHold = 0;
                                    @endphp

                                    @foreach ($studentStatus as $status)
                                        @if ($status->status === 'Hold')
                                            @php
                                                $countHold++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h5>Hold</h5>
                                            <h5>{{ $countHold }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countCancel = 0;
                                    @endphp

                                    @foreach ($studentStatus as $status)
                                        @if ($status->status === 'Cancel')
                                            @php
                                                $countCancel++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="small-box bg-secondary">
                                        <div class="inner">
                                            <h5>Cancel</h5>
                                            <h5>{{ $countCancel }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6">
                                    @php
                                        $countComplete = 0;
                                    @endphp

                                    @foreach ($studentStatus as $status)
                                        @if ($status->status === 'Complete')
                                            @php
                                                $countComplete++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h5>Complete</h5>
                                            <h5>{{ $countComplete }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header" style="background-color:lightgray">
                            <h5 class="card-title w-100">
                                <h5 class="d-block w-100" data-toggle="collapse">
                                    Today Absent Trainer
                                </h5>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($absentTrainer as $branch)
                                    <div class="col-md-2">
                                        <div class="small-box bg-secondary">
                                            <div class="inner">
                                                <h5 style="color: deepskyblue">{{ $branch->name }}</h5>
                                                @php
                                                    $countAbsent = 0;
                                                @endphp
                                                @foreach ($branch->trainer as $trainer)
                                                    @foreach($trainer->trainerAttendance as $key => $attendance)
                                                        @if ($attendance->status == 'A' && $attendance->slot_type == 'Regular')
                                                            @php
                                                                $countAbsent++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                <h5>Total Absent :- {{ $countAbsent }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header" style="background-color:lightgray">
                            <h5 class="card-title w-100">
                                <h5 class="d-block w-100" data-toggle="collapse">
                                    Today Absent Student
                                </h5>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($absentStudent as $branch)
                                    <div class="col-md-2">
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h5 style="color: mediumvioletred">{{ $branch->name }}</h5>
                                                @php
                                                    $stuAbsent = 0;
                                                @endphp
                                                @foreach ($branch->student as $student)
                                                    @foreach($student->studentAttendance as $key => $attendance)
                                                        @if ($attendance->attendance_type == '0' && $attendance->slot_type == 'Regular')
                                                            @php
                                                                $stuAbsent++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                <h5>Total Absent :- {{ $stuAbsent }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header" style="background-color:lightgray">
                            <h5 class="card-title w-100">
                                <h5 class="d-block w-100" data-toggle="collapse">
                                    Today Proxy Lecture
                                </h5>
                            </h5>
                        </div>

                        <div class="card-body">

                            @if($trainerProxySlot->isNotEmpty())
                                <div class="row">
                                    @foreach($proxyTrainer as $key => $branch)
                                        <div class="">
                                            @php
                                                $trainerSlot = [];
                                            @endphp
                                            @foreach($branch->trainer as $trainer)
                                                @if($trainer->trainerProxySlot->isNotEmpty())
                                                    @php
                                                        $trainerSlot[] = 'none';
                                                    @endphp
                                                @endif
                                            @endforeach


                                            @if(in_array('none',$trainerSlot))
                                                <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h5 style="color: lightpink">{{ $branch->name }}</h5>
                                                        <h5 style="color: lightpink">Regular Trainer Name:-{{ $branch->trainer_name }}</h5>

                                                        @foreach ($branch->trainer as $trainer)

                                                            @if($trainer->trainerProxySlot->isNotEmpty())

                                                                <h5 style="color: lightpink">Trainer Name :- {{ $trainer->name }}</h5>
                                                                @php
                                                                    $uniqueSlotTimes = [];
                                                                @endphp

                                                                @foreach ($trainer->trainerProxySlot as $slot)

                                                                    @php
                                                                        $slotTime = $slot->slot->slot_time;
                                                                    @endphp
                                                                    @if (!in_array($slotTime, $uniqueSlotTimes))
                                                                        <h5 style="color: lightpink">Slot Time: {{ $slotTime }}</h5>
                                                                        @php
                                                                            $uniqueSlotTimes[] = $slotTime;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
