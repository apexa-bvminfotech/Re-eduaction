@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Trainer Wise Student-Rtc-Slot Detail</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trainer Wise Student-Rtc-Slot list</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($trainerWiseData as $branch)
                        <div class="col-12 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header border-bottom-0">
                                    <b> Branch Name : </b> {{ $branch->name }}
                                    <hr>    
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($branch->trainer as $key => $trainerName)
                                                <b>Trainer Name : </b> {{ $trainerName->name }} 
                                                @foreach ($trainerName->slots as $slotTime)
                                                    <p class="pt-3"><b>RTC Name : </b>{{ $slotTime->rtc->rtc_name }}</p>
                                                    <p><b>Slot Time : </b>{{ $slotTime->slot_time }}</p>
                                                    @foreach ($slotTime->slotList as $student)
                                                        <p><b>Student Detail :- </b></p>
                                                        <p><b>Student Name : </b> {{ $student->student->name }} {{ $student->student->surname }}</p>
                                                        <p><b>Standard : </b> {{ $student->student->standard }}</p>
                                                        <p><b>Meduim : </b> {{ $student->student->medium }}</p>
                                                    @endforeach
                                                    @foreach ($slotTime->proxySlotlist as $student)
                                                        <p><b>Student Detail :- </b></p>
                                                        <p><b>Student Name : </b> {{ $student->student->name }} {{ $student->student->surname }}</p>
                                                        <p><b>Standard : </b> {{ $student->student->standard }}</p>
                                                        <p><b>Meduim : </b> {{ $student->student->medium }}</p>
                                                    @endforeach
                                                @endforeach
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        @endforeach 
                    </div>      
                </div>
            </div>
        </section>
    </div>
@endsection




