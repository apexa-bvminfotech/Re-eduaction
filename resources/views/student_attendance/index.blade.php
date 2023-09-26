@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Students Attendance Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('student-attendance-create')
                            <a href="{{route('student_attendance.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
                        @endcan
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped datatables" id="example1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Total present student</th>
                                        <th>Total absent student</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($studenAttendance as $key=> $s)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{ date('d-m-Y', strtotime($s->attendance_date))}}</td>
                                            <td>{{$s->present}}</td>
                                            <td>{{$s->absent}}</td>
                                            <td>
                                                <a href="{{ route('student_attendance.show',$s->attendance_date) }}"
                                                    class="btn btn-primary btn-sm" title="Edit">
                                                    <i class="fa fa-eye"></i> View</a>
                                                </a>
                                                @can('student-attendance-edit')
                                                    @if($s->attendance_date == date('Y-m-d') && \Illuminate\Support\Facades\Auth::user()->type !=0)
                                                        <a href="{{route('student_attendance.edit',$s->attendance_date)}}"
                                                           class="btn btn-success btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i> Edit</a>
                                                    @elseif(\Illuminate\Support\Facades\Auth::user()->type == 0)
                                                        <a href="{{route('student_attendance.edit',$s->attendance_date)}}"
                                                           class="btn btn-success btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i> Edit</a>
                                                    @endif
                                                @endcan
                                                @can('student-attendance-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['student_attendance.destroy', $s->attendance_date],'style'=>'display:inline']) !!}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                        <i class="fa fa-trash"></i> Delete</button>
                                                    {!! Form::close() !!}
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // $('#dataTable-1').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": true,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        })
    </script>
@endpush
