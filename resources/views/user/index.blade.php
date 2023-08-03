@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('user-create')
                            <a href="{{route('user.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
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
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th><span></span></th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($users as $key=>$u)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{$u->surname}} {{$u->name}} {{$u->father_name}}</td>
                                                <td>{{$u->email}}</td>
                                                <td>{{$u->contact}}</td>
                                                <td>
                                                    @if($u->branch)
                                                        {{$u->branch->name}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @can('user-edit')
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" data-id="{{$u->id}}"
                                                                   class="custom-control-input checkStatus"
                                                                   id="c{{$key+1}}" {{ $u->is_active ? '' : 'checked' }}>
                                                            <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                        </div>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('user-edit')
                                                        <a href="{{route('user.edit',$u->id)}}" class="btn btn-success btn-sm"
                                                           title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                    @endcan
                                                </td>
                                            </tr>
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
                    this.api().columns([4]).every( function () {
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
                    });
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('.checkStatus').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var user_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: '/changeUserStatus',
                    data: {'status': status, 'user_id': user_id},
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