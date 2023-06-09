@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Staff Attendance</h2>
                    @can('staff-attendance-create')
                        <a href="{{route('staff_attendance.create')}}" class="btn btn-primary">Today Attendance</a>
                    @endcan
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Total present Staff</th>
                                        <th>Total absent Staff</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($staffAttendance as $key => $s)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ date('d-m-Y', strtotime($s->date))}}</td>
                                            <td>{{ $s->present }}</td>
                                            <td>{{ $s->absent }}</td>
                                            <td>
                                                @can('staff-attendance-edit')
                                                    <a href="{{ route('staff_attendance.edit',$s->date) }}" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('staff-attendance-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['staff_attendance.destroy', $s->date],'style'=>'display:inline']) !!}
                                                    <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></button>
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->


@endsection
