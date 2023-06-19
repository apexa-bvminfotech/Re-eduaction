@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-1 page-title">Staff Attendance</h2>
                                    @can('staff-attendance-create')
                                        <a href="{{route('staff_attendance.create')}}"
                                           class="btn btn-primary float-right">Today Attendance</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered table-striped" id="dataTable-1">
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
                                                    <a href="{{ route('staff_attendance.edit',$s->date) }}"
                                                       class="btn btn-success" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('staff-attendance-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['staff_attendance.destroy', $s->date],'style'=>'display:inline']) !!}
                                                    <button type="submit" class="btn btn-danger" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                        <i class="fa fa-trash"></i></button>
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
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#dataTable-1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endpush
