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
                            <div class="container-fluid">
                                <div class="card card-primary card-outline">
                                    <div class="card-header" style="display: flex;justify-content: space-between;">
                                        <h3 class="card-title"><b>Branch Name :</b> {{ $branch->name }}</h3>
                                        <h3 class="card-title"><b>Total Trainer :</b> {{ count($branch->trainer) }}</h3>
                                    </div> <!-- /.card-body -->
                                    @foreach($branch->trainer as $key => $trainerName)
                                        <div class="card-body">
                                            <div class="card-header" style="display: flex;justify-content: space-between;">
                                                <h3 class="card-title"><strong>Trainer Name : </strong> {{ $trainerName->surname }} {{ $trainerName->name }} </h3>
                                            </div>
                                            @foreach ($trainerName->slots as $slotTime)
                                                <div class="card-header">
                                                    <h3 class="card-title"><strong>RTC Name : </strong> {{ $slotTime->rtc->rtc_name }} </h3><br>
                                                    <h3 class="card-title"><strong>Slot Time : </strong> 10:00 AM - 12:00 PM</h3>
                                                </div>
                                                @if(count($slotTime->slotList) > 0 || count($slotTime->proxySlotlist) > 0)
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Student Name</th>
                                                                <th>Standard</th>
                                                                <th>Meduim</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($slotTime->slotList as $student)
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td>{{ $student->student->name }} {{ $student->student->surname }}</td>
                                                                    <td>{{ $student->student->standard }}</td>
                                                                    <td>{{ $student->student->medium }}</td>
                                                                </tr>
                                                            @endforeach
                                                            @foreach ($slotTime->proxySlotlist as $student)
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td>{{ $student->student->name }} {{ $student->student->surname }}</td>
                                                                    <td>{{ $student->student->standard }}</td>
                                                                    <td>{{ $student->student->medium }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach<!-- /.card-body -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




