@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-default-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-1 page-title">Course Management</h2>
                                    <a href="{{route('course.create')}}" class="btn btn-primary float-right">Create New Course</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered table-striped" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Course Name</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @foreach ($sub_courses as $key => $sub_course)--}}

                                            @foreach($courses as $course)
                                                <tr>
                                                <td>{{$course->id}}</td>
                                                <td>{{$course->course_name}}</td>

                                                <td>
                                                    <form action="{{route('course.destroy',$course->id)}}" method="POST">

                                                        <a class="btn btn-primary" href="{{ route('course.edit',$course->id) }}">Edit</a>

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger show_confirm">Delete</button>
                                                    </form>
                                                </td>
                                                </tr>
                                            @endforeach

{{--                                    @endforeach--}}

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
        $(function() {
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
        }
@endpush
