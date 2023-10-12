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
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card bg-light card-info">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <h3 class="d-block w-100" data-toggle="collapse">
                                    Current Month Student Registration
                                </h3>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h2>Total Students</h2>
                                            <h4>{{ count($students) }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
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
                                            <h2>Pending</h2>
                                            <h4>{{ $countPending }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
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
                                            <h2>Start</h2>
                                            <h4>{{ $countStart }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-6">
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
                                            <h2>Hold</h2>
                                            <h4>{{ $countHold }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
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
                                            <h2>Cancel</h2>
                                            <h4>{{ $countCancel }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
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
                                            <h2>Complete</h2>
                                            <h4>{{ $countComplete }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light card-info">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <h3 class="d-block w-100" data-toggle="collapse">
                                    Today Absent Trainer
                                </h3>
                            </h4>
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex bd-highlight">
                                @foreach($absentTrainer as $branch)
                                    <div class="p-2 flex-fill bd-highlight">
                                        <div class="small-box bg-secondary">
                                            <div class="inner">   
                                                <p>Branch :- {{ $branch->name }}</p>
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
                                                <p>Total Absent :- {{ $countAbsent }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach     
                            </div>
                        </div>                          
                    </div>
                    <div class="card bg-light card-info">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <h3 class="d-block w-100" data-toggle="collapse">
                                    Today Absent Student
                                </h3>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex bd-highlight">
                                @foreach($absentStudent as $branch)
                                    <div class="p-2 flex-fill bd-highlight">
                                        <div class="small-box bg-warning">
                                            <div class="inner">   
                                                <p>Branch :- {{ $branch->name }}</p>
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
                                                <p>Total Absent :- {{ $stuAbsent }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach     
                            </div>                    
                        </div>
                    </div>
                    <div class="card bg-light card-info">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <h3 class="d-block w-100" data-toggle="collapse">
                                    Today Proxy Lecture
                                </h3>
                            </h4>
                        </div>
                        @if($trainerProxySlot->isNotEmpty())
                            <div class="card-body">
                                <div class="d-flex bd-highlight">
                                    @foreach($proxyTrainer as $key => $branch)
                                        <div class="p-2 flex-fill bd-highlight">
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <p>Branch :- {{ $branch->name }}</p>
                                                    @foreach ($branch->trainer as $trainer)
                                                        @if($trainer->trainerProxySlot->isNotEmpty())
                                                            <p>Trainer Name :- {{ $trainer->name }}</p>
                                                            @foreach ($trainer->trainerProxySlot as $slot)
                                                                <p>Slot Time :- {{ $slot->slot->slot_time }}</p>
                                                            @endforeach
                                                        @endif    
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div> 
                        @endif                              
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection