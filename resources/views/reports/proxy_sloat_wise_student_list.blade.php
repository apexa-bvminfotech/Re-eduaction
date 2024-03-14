@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Proxy Sloat Wise Student Detail</h1>
                    </div>
                    <div class="col-sm-6 row input-group-append justify-content-end">
                        <a href="{{route('report.report-list')}}" class="btn btn-primary float-right"><i
                                ></i>Back</a>
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

                                        <th><span>Student Name</span></th>
                                        <th><span>Medium</span></th>
                                        <th><span>Standard</span></th>
                                        <th><span>Branch</span></th>
                                        <th><span>Sloat</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stuListWithTrainerProxy as $trainer => $sloat)

                                            @foreach ($sloat as $sloats => $s)
                                                <tr>
                                                    <td>{{ $s->student->name ?? '' }}</td>
                                                    <td>{{ $s->student->medium ?? '' }}</td>
                                                    <td>{{ $s->student->standard ?? ''}}</td>
                                                    <td>{{ $s->branch->name ?? '' }}</td>
                                                    <td >{{$s->slot->slot_time  ?? ''}}</td>
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
        // $(function () {
        //     dataTable = $("#example1").DataTable({
        //         "responsive": true, "lengthChange": false, "autoWidth": false,
        //         "buttons": ["csv", "excel", "pdf", "print"]
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        // });

        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1,2,3,4,5]).every(function () {
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
