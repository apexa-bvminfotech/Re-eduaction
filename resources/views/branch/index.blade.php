@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Branch Management</h1>
                    </div>
                    <div class="col-sm-6 row input-group-append justify-content-end">
                        @can('branch-create')
                            <div class="col-md-3 text-right">
                                <a href="{{route('branch.create')}}" class="btn btn-primary"><i class="fa fa-plus pr-2"></i> Add</a>
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
                                        <th>Branch Address</th>
                                        <th>Authorized person name</th>
                                        <th>Authorized person Contact</th>
                                        @can('branch-edit')
                                            <th>Status</th>
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($branches as $key=>$u)
                                        <tr>
                                            <td>{{ $u->id }}</td>
                                            <td>{{$u->name}}</td>
                                            <td>{{$u->address}}</td>
                                            <td>{{$u->authorized_person_name}}</td>
                                            <td>{{$u->authorized_person_contact}}</td>
                                            @can('branch-edit')
                                                <td>
                                                    <span style="display: none">{{ $u->is_active }}</span>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" data-id="{{$u->id}}" class="custom-control-input checkStatus" id="c{{$key+1}}" {{ $u->is_active ? '' : 'checked' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{route('branch.edit',$u->id)}}"
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
            dataTable = $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1]).every(function () {
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
                        this.api().columns([5]).every(function () {
                            var column = this;
                            var val = 0;
                            $('.status-dropdown').on({ 'change': function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column.column(5).search(val).draw();
                                },
                            });
                            column.column(5).search(val).draw();
                        })
                    );
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $(document).on('change', '.checkStatus', function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var branch_id = $(this).data('id');
                $.ajax({
                    type: "GET",

                    url: 'change-status/changeBranchStatus',
                    data: {'status': status, 'branch_id': branch_id},
                    success: function (data) {
                        toastr.options =
                            {
                                "closeButton": true,
                                "progressBar": true
                            }
                        if (status) {
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
