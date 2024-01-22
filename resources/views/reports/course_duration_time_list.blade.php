@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Course Duration Wise Student</h1>
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
                                    <th><span>Course Name </span></th>
                                    <th><span>Student Name </span></th>
                                    <th><span>Medium </span></th>
                                    <th><span>Standard </span></th>
                                    <th><span>Start Date </span></th>
                                    <th><span>End Date </span></th>
                                    <th><span>Duration </span></th>

                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($courseWiseStudentData as $courseName => $students)
                                        @if($students->start_date != null )
                                            <tr>
                                                <td>{{ $students->course->course_name  ?? ''}}</td>
                                                <td>{{ $students->student->name  ?? ''}}</td>
                                                <td>{{ $students->student->medium ?? ''}}</td>
                                                <td>{{ $students->student->standard  ?? '' }}</td>
                                                <td>{{ $students->start_date ?? '' }}</td>
                                                <td>{{ $students->end_date ?? '' }}</td>
                                                <td>
                                                    <?php
                                                    $startDateTime = \Carbon\Carbon::parse($students->start_date);
                                                    $endDateTime = \Carbon\Carbon::parse($students->end_date);
                                                    $duration = $endDateTime->diff($startDateTime);

                                                    // Format with months, days, hours, minutes
                                                    echo $duration->format('%m months, %d days');
                                                    //, %h hours, %i minutes
                                                ?>
                                                </td>
                                            </tr>
                                            @endif
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
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([0,1, 2, 3,4,5,6,7]).every(function () {
                        var column = this;
                        var columnName = column.header().innerText;

                        var select = $('<select class="form-control select2"><option value="">' + columnName + '</option></select>')
                            .appendTo($(column.header()).find('span').empty())
                            .on({
                                'change': function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                },
                                'click': function (e) {
                                    e.stopPropagation();
                                }
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    });
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
