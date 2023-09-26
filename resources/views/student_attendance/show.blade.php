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
                                    <th>Student Name</th>
                                    <th>Status</th>
                                    <th>Reason for absent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentAttendance as $trainerName => $attendance)
                                    <tr>
                                        <td rowspan="{{ count($attendance) }}">{{ $trainerName }} </td>
                                        @foreach ($attendance as $key => $sa)
                                            @if ($key > 0)
                                                </tr><tr>
                                            @endif
                                            <td>{{ date('d-m-Y', strtotime($sa->attendance_date)) }} / {{ $sa->slot_type }}</td>
                                            <td>{{ $sa->slot_time }}</td>
                                            <td>{{ $sa->name }}</td>
                                            <td>
                                                @if($sa->attendance_type == '0')
                                                    Absent
                                                @else
                                                    Present
                                                @endif
                                            </td>
                                            <td>
                                                @if($sa->absent_reason == NULL)
                                                    -
                                                @else
                                                    {{ $sa->absent_reason }}
                                                @endif 
                                            </td>
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


