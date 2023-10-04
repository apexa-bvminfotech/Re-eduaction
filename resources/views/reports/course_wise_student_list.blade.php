@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Wise Student Detail</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>

        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Student Name</th>
                                        <th>Meduim</th>
                                        <th>Standard</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courseWiseStudentData as $courseName)
                                            <tr>
                                                <td rowspan="{{ count($courseName->studentCourse) }}">{{ $courseName->course_name }}</td>
                                                @foreach ($courseName->studentCourse as $key => $student)
                                                    @if ($key > 0)
                                                        </tr><tr>
                                                    @endif
                                                    <td>{{ $student->student->name }} {{  $student->student->surname }}</td>
                                                    <td>{{ $student->student->medium }}</td>
                                                    <td>{{ $student->student->standard }}</td>
                                                @endforeach
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
        $(function () {
            dataTable = $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endpush
