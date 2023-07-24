@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('course.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
                        @endcan
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row my-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- table -->
                                        <table class="table table-bordered table-striped" id="dataTable-1">
                                            <thead>
                                            <tr class="card-primary">
                                                <th>No</th>
                                                <th>Course Name</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $course)
                                                <tr>
                                                    <td>{{$course->id}}</td>
                                                    <td>{{$course->course_name}}</td>

                                                    <td>
                                                        <form action="{{route('course.destroy',$course->id)}}"
                                                              method="POST">
                                                            <a class="btn btn-success btn-sm fa fa-edit"
                                                               href="{{ route('course.edit',$course->id) }}"> Edit</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-danger fa fa-trash-alt btn-sm show_confirm"> Delete</button>
                                                        </form>
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
        $(function () {
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
