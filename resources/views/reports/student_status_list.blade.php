@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1>Student Status List</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>    
        
        <!-- Main content -->
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
                                        <th>No</th>
                                        <th><span></span></th>
                                        <th><span></span></th>
                                        <th>Staus</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                        <th>Meduim</th>
                                        <th>Standard</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($studentStatus as $key=>$status)
                                            @foreach($status->student->activeCourses as $key => $course)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $status->student->name }} {{ $status->student->surname }}</td>
                                                    <td>{{ $course->course->course_name }}</td>
                                                    <td>{{ $status->status }}</td>
                                                    <td>{{ $status->cancel_reason }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($status->date)) }}</td>
                                                    <td>{{ $status->student->medium }}</td>
                                                    <td>{{ $status->student->standard }}</td>
                                                </tr>
                                            @endforeach
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
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1, 2]).every(function () {
                            var column = this;
                            var select = $('<select class="form-control select2"><option value="">All</option></select>')
                                .appendTo($(column.header()).find('span').empty())
                                .on({
                                    'change': function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        column
                                            .search(val ? '^' + val + '$' : '', true, false).draw();
                                    },
                                    'click': function (e) {
                                        e.stopPropagation();
                                    }
                                });
                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        },
                        
                    );
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
