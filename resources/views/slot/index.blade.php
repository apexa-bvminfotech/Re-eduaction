@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slot Management</h1>
                    </div>
                    <div class="col-sm-6 row input-group-append justify-content-end">
                        @can('slot-create')
                            <div class="col-md-3 text-right">
                                <a href="{{route('slot.create')}}" class="btn btn-primary"><i class="fa fa-plus pr-2"></i> Add</a>
                            </div>
                        @endcan
                        <div class="col-md-3">
                            <div class="btn-group submitter-group float-right">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Status</div>
                                </div>
                                <select class="form-control status-dropdown">
                                    <option value="0">Active</option>
                                    <option value="1">De Active</option>
                                </select>
                            </div>
                        </div>
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
                                            <th>No</th>
                                            <th><span></span></th>
                                            <th>Trainer Name</th>
                                            <th>RTC Name</th>
                                            <th>Time</th>
                                            <th>WhatsApp group Name</th>
                                            @can('slot-edit')
                                                <th>Status</th>
                                                <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slot as $key => $s)
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{$s->branch->name}}</td>
                                                <td>{{ $s->trainer->name }}</td>
                                                <td>{{$s->rtc->rtc_name}}</td>
                                                <td>{{ $s->slot_time }}</td>
                                                <td>{{$s->whatsapp_group_name}}</td>
                                                @can('slot-edit')
                                                    <td>
                                                        <span style="display: none">{{ $s->is_active }}</span>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" data-id="{{$s->id}}"
                                                                   class="custom-control-input checkStatus"
                                                                   id="c{{$key+1}}" {{ $s->is_active ? '' : 'checked' }}>
                                                            <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('slot.edit',$s->id) }}"
                                                           class="btn btn-success btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i> Edit</a>
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



            $('.checkStatus').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var slot_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: '/changeSlotStatus',
                    data: {'status': status, 'slot_id': slot_id},
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
        });
    </script>
@endpush
