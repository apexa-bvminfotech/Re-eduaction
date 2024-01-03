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
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Student Name</th>
                                        <th>Medium</th>
                                        <th>Standard</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courseWiseStudentData as $courseName => $students)
                                            @foreach ($students as $index => $student)
                                                <tr>
                                                    @if ($index === 0)
                                                    <td rowspan="{{ count($students) }}">{{ $courseName . ' ' . count($students)  }}</td>
                                                    @endif
                                                    <td>{{ $student->student->name  ?? ''}}</td>
                                                    <td>{{ $student->student->medium ?? ''}}</td>
                                                    <td>{{ $student->student->standard ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
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
            dataTable = $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
