@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Trainer Wise Student-Rtc-Proxy-Slot Detail</h1>
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
                            <div class="col-12 d-flex align-items-stretch flex-column pb-4" >
                                <div class="card bg-light d-flex flex-fill border">
                                    <div class="card-header border-bottom-0">
                                        <b> Branch Name : </b> {{ $branch->name }}<br>
                                        <b>Total Trainer : </b> {{ count($branch->trainer) }}
                                        <hr>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($branch->trainer as $key => $trainerName)
                                                    <div class="pb-3">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="5" style="background-color:lightgray"><b>Trainer Name : </b> {{ $trainerName->name }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>RTC</th>
                                                                    <th>Slot Time</th>
                                                                    <th>Student Name</th>
                                                                    <th>Medium</th>
                                                                    <th>Standard</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($trainerName->slots as $slotTime)
                                                                    @php $firstRow = true; @endphp
                                                                    @foreach ($slotTime->proxySlotlist as $student)
                                                                        <tr>
                                                                            @if ($firstRow)
                                                                                <td rowspan="{{ count($slotTime->proxySlotlist) }}">{{ $slotTime->rtc->rtc_name }}</td>
                                                                                <td rowspan="{{ count($slotTime->proxySlotlist) }}">{{ $slotTime->slot_time }}</td>
                                                                                @php $firstRow = false; @endphp
                                                                            @endif
                                                                            <td>{{ $student->student->name }} {{ $student->student->surname }}</td>
                                                                            <td>{{ $student->student->medium }}</td>
                                                                            <td>{{ $student->student->standard }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    @if ($firstRow)
                                                                        <tr>
                                                                            <td>{{ $slotTime->rtc->rtc_name }}</td>
                                                                            <td>{{ $slotTime->slot_time }}</td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>       
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