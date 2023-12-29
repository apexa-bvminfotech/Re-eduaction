@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trainer Management</h1>
                    </div>
                    <div class="col-sm-6 row input-group-append justify-content-end">
                        @can('trainer-list')
                            <div class="col-md-3 text-right">
                                <a href="{{route('trainer.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
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
                                        <th><span>Branch</span></th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($trainer as $key => $t)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $t->name }}</td>
                                            <td>{{$t->branch ? $t->branch->name : ''}}</td>
                                            <td>
                                                <span style="display: none">{{ $t->is_active }}</span>
                                                @can('trainer-edit')
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" data-id="{{$t->id}}"
                                                               class="custom-control-input checkStatus"
                                                               id="c{{$key+1}}" {{ $t->is_active ? '' : 'checked' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    </div>
                                                @endcan
                                            </td>
                                            <td>
                                                <a href="{{ route('trainer.show',$t->id) }}"
                                                   class="btn btn-info btn-sm" title="show"><i class="fa fa-eye"></i> View</a>
                                                @can('trainer-edit')
                                                    <a href="{{ route('trainer.edit',$t->id) }}"
                                                    class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                @endcan
                                                @if(Auth::user()->type == '0')
                                                    <button type="button"
                                                            class="btn btn-secondary btn-trainer-pwd btn-sm"
                                                            data-id="{{$t->id}}"> Change Password
                                                    </button>
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
    <div class="modal fade" id="changeTrainerPwd" tabindex="-1" role="dialog"
        aria-labelledby="verticalModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalModalTitle">Change Trainer Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('change.trainer.pwd') }}" method="POST" id="submitTrainerPwd">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <input type="hidden" name="trainer_id" id="trainer_id" class="trainer_id" value="">
                                <label for="password">Password:</label>
                                <input type="text" name="password" class="form-control old-t-pwd" value=""  placeholder="Enter your password">
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn mb-2 btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // $(function () {
        //     dataTable = $("#example1").DataTable({
        //         "responsive": true, "lengthChange": false, "autoWidth": false,
        //         "buttons": ["csv", "excel", "pdf", "print"],
        //         initComplete: function () {
        //             this.api().columns([2]).every(function () {
        //                     var column = this;
        //                     var select = $('<select class="form-control select2"><option value="">All</option></select>')
        //                         .appendTo($(column.header()).find('span').empty())
        //                         .on({
        //                             'change': function () {
        //                                 var val = $.fn.dataTable.util.escapeRegex(
        //                                     $(this).val()
        //                                 );
        //                                 column
        //                                     .search(val ? '^' + val + '$' : '', true, false).draw();
        //                             },
        //                             'click': function (e) {
        //                                 e.stopPropagation();
        //                             }
        //                         });
        //                     column.data().unique().sort().each(function (d, j) {
        //                         select.append('<option value="' + d + '">' + d + '</option>')
        //                     });
        //                 },
        //                 this.api().columns([3]).every(function () {
        //                     var column = this;
        //                     var val = 0;
        //                     $('.status-dropdown').on({
        //                         'change': function () {
        //                             var val = $.fn.dataTable.util.escapeRegex(
        //                                 $(this).val()
        //                             );
        //                             column.column(3).search(val).draw();
        //                         },
        //                     });
        //                     column.column(3).search(val).draw();
        //                 })
        //             );
        //         }
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //     $(document).on('change', '.checkStatus', function() {
        //         var status = $(this).prop('checked') == true ? 0 : 1;
        //         var trainer_id = $(this).data('id');
        //         $.ajax({
        //             type: "GET",
        //             url: 'change-status/changeTrainerStatus',
        //             data: {'status': status, 'trainer_id': trainer_id},
        //             success: function (data) {
        //                 toastr.options =
        //                     {
        //                         "closeButton": true,
        //                         "progressBar": true
        //                     }
        //                 if (status) {
        //                     toastr.error(data.success);
        //                 } else {
        //                     toastr.success(data.success);
        //                 }
        //             }
        //         });
        //     });
        // });


        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([2]).every(function () {
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

        $(document).on('click', '.btn-trainer-pwd', function () {
            let trainerId = parseInt($(this).data('id'));
            $('.trainer_id').val(trainerId);
            $('#changeTrainerPwd').modal('toggle')
        });
    </script>
@endpush
