@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trainer Attendance Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('trainer-create')
                            <a href="{{route('trainer_attendance.create')}}" class="btn btn-primary float-right">Create
                                New TrainerAttendance</a>
                        @endcan
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row my-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- table -->
                                        <table class="table table-bordered table-striped datatables" id="example1">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Total Present Trainer</th>
                                                <th>Total absent Trianer</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($trainerAttendance as $key => $ta)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{ date('d-m-Y', strtotime($ta->date))}}</td>
                                                    <td>{{$ta->present}}</td>
                                                    <td>{{$ta->absent}}</td>
                                                    <td>
                                                        <a href="{{ route('trainer_attendance.show',$ta->date) }}"
                                                            class="btn btn-info btn-md" title="Show">
                                                             <i class="fa fa-eye"></i>
                                                        </a>
                                                        @can('trainer-attendance-edit')
                                                            <a href="{{ route('trainer_attendance.edit',$ta->date) }}"
                                                               class="btn btn-success" title="Edit"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endcan
                                                        @can('trainer-attendance-delete')
                                                            {!! Form::open(['method' => 'DELETE','route' => ['trainer_attendance.destroy', $ta->date],'style'=>'display:inline']) !!}
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
                            </div>
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
