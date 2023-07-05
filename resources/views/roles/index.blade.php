@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('role-create')
                            <a href="{{route('roles.create')}}" class="btn btn-primary float-right">Create New Role</a>
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
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm showDetail" data-id="{{ $role->id }}" data-toggle="modal" data-target="#modal-lg">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    @can('role-edit')
                                                        <a href="{{ route('roles.edit',$role->id) }}"
                                                           class="btn btn-success btn-sm" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
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
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title roleName"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body permission">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(".showDetail").on('click', function(){
            var id = $(this).attr("data-id");
            console.log(id);
            $.ajax({
                url: 'roles/'+id,
                type: 'get',
                success: function(result){
                    var roleName = "Role Name : " + result.role.name;
                    $('.roleName').html(roleName);
                    $('.permission').html(result.permissionData);
                }
            });
        });
    </script>
@endpush
