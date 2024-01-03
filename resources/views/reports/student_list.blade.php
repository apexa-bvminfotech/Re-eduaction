@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1>Student List</h1>
                    </div>
                    <div class="col-sm-4 text-right">
                        <form class="form-inline" action="">
                            <div class="form-group mr-2">
                                <label for="start-date" class="mr-2">Start Date:</label>
                                <input type="date" class="form-control" id="start-date" name="start_date" value="{{ !empty($startDate) ? $startDate : '' }}">
                            </div>
                            <div class="form-group mr-2">
                                <label for="end-date" class="mr-2">End Date:</label>
                                <input type="date" class="form-control" id="end-date" name="end_date" value="{{ !empty($endDate) ? $endDate : '' }}">
                            </div>
                            <button type="button" class="btn btn-primary search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
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
                                        <th>Name</th>
                                        <th><span>Medium</span></th>
                                        <th><span>Standard</span></th>
                                        <th><span>Trainer</span></th>
                                        <th>Registration Date</th>
                                        <th><span>Status</span></th>
                                        <th><span>Branch</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($studentList as $key=>$student)

                                            <tr>
                                                <td>{{ $student->id ?? ''}}</td>
                                                <td>{{$student->name ?? ''}} {{$student->surname ?? ''}}</td>
                                                <td>{{$student->medium ?? ''}}</td>
                                                <td>{{$student->standard ?? ''}}</td>
                                                <td>{{ !empty($student->studentTrainer->trainer->name) ? $student->studentTrainer->trainer->name : ''}}</td>
                                                <td>{{date('Y-m-d', strtotime($student->registration_date)) ?? ''}}</td>
                                                <td>{{ $student->statusStudent->status ?? ''}}</td>
                                                <td>{{  $student->branch->name ?? ''}}</td>
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
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([2, 3, 4, 6,7]).every(function () {
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
        $('body').on('click', '.search-btn',  function(){
            var baseurl = "{{ asset('/') }}";
            var startDate = $("#start-date").val();
            var endDate = $("#end-date").val();
            var url = baseurl + "reports-student-list?startDate="+startDate+"&endDate="+endDate;
            window.location = url;
        });
    </script>
@endpush
