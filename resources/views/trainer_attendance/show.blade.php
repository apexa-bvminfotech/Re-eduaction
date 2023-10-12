@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Trainer Attendance Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('trainer_attendance.index') }}">Show Trainer Attendance List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trainer attendance list</h3>
                    </div>
                      <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Trainer Name</th>
                                    <th>Date</th>
                                    <th>Trainer Slot times</th>
                                    <th>Status</th>
                                    <th>Reason for absent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trainerAttendance as $trainerName => $attendance)
                                    <tr>
                                        <td rowspan="{{ count($attendance) }}">{{ $trainerName }} </td>
                                        @foreach ($attendance as $key => $ta)
                                            @if ($key > 0)
                                                </tr><tr>
                                            @endif
                                            <td>{{ date('d-m-Y', strtotime($ta->date)) }} / {{ $ta->slot_type }}</td>
                                            <td>{{ $ta->slot_time }}</td>
                                            <td>{{ $ta->status }}</td>
                                            @if($ta->absent_reason == NULL)
                                                <td> - </td>
                                            @else
                                                <td> {{ $ta->absent_reason }} </td>
                                            @endif 
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                     <!-- /.card-body -->       
                </div>
            </div>
        </section>
    </div>
@endsection


