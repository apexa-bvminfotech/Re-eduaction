@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1>Student List with Course Detail</h1>
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
                                        <th>Meduim</th>
                                        <th>Standard</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($studentCourse as $key=>$student)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $student->student->name }} {{ $student->student->surname  }}</td>
                                                <td>{{ $student->course->course_name }}</td>
                                                <td>{{$student->student->medium}}</td>
                                                <td>{{$student->student->standard}}</td>
                                                <td>
                                                    @if($student->start_date == null)
                                                        -
                                                    @else
                                                        {{date('Y-m-d', strtotime($student->start_date))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($student->end_date == null)
                                                        -
                                                    @else
                                                        {{date('Y-m-d', strtotime($student->end_date))}}
                                                    @endif
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
        $(function () {
            dataTable = $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1, 2, 4, 6]).every(function () {
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