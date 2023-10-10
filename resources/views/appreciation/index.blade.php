@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Appreciation Management</h1>
                    </div>
                    <div class="col-sm-6 row input-group-append justify-content-end">
                        @can('appreciation-create')
                            <div class="col-md-3 text-right">
                                <a href="{{route('appreciation.create')}}" class="btn btn-primary"><i class="fa fa-plus pr-2"></i> Add</a>
                            </div>
                        @endcan

                    </div>

                </div>
            </div><!-- /.container-fluid -->
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
                                        <th>No</th>
                                        <th>Appreciation name</th>
                                        <th>Course Name</th>
                                        @can('rtc-edit')
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($appreciation as $key => $a)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $a->appreciation_name }}</td>
                                            <td>{{ $a->course->course_name }}</td>
                                            @can('appreciation-edit')
                                                <td>
                                                    <a href="{{ route('appreciation.edit',$a->id) }}"
                                                       class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                </td>
                                            @endcan
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
            dataTable =  $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1]).every( function () {
                            var column = this;
                            var select = $('<select class="form-control select2"><option value="">All</option></select>')
                                .appendTo( $(column.header()).find('span').empty() )
                                .on({ 'change': function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        column
                                            .search( val ? '^'+val+'$' : '', true, false ).draw();
                                    },
                                    'click': function(e) {
                                        e.stopPropagation();
                                    }
                                });
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            });
                        },
                        this.api().columns([6]).every( function () {
                            var column = this;
                            var val = 0;
                            $('.status-dropdown').on({ 'change': function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column.column(6).search(val).draw();
                                },
                            });
                            column.column(6).search(val).draw();
                        })
                    );
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $(document).on('change', '.checkStatus', function() {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var rtc_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeRtcStatus',
                    data: {'status': status, 'rtc_id': rtc_id},
                    success: function (data) {
                        toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                        if(status){
                            toastr.error(data.success);
                        } else {
                            toastr.success(data.success);
                        }
                    }
                });
            });
        })
    </script>
@endpush
