@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Branch Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('branch.create')}}" class="btn btn-primary float-right">Create New Branch</a>
                        @endcan
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
                                            <th>Branch Name</th>
                                            <th>Branch Address</th>
                                            <th>Authorized person name</th>
                                            <th>Authorized person Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($branches as $key=>$u)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{$u->name}}</td>
                                                <td>{{$u->address}}</td>
                                                <td>{{$u->authorized_person_name}}</td>
                                                <td>{{$u->authorized_person_contact}}</td>
                                                <td>
                                                    @can('branch-edit')
                                                        <a href="{{route('branch.edit',$u->id)}}" class="btn btn-success btn-sm"
                                                           title="Edit"><i class="fa fa-edit"></i></a>
                                                    @endcan
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
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        })
    </script>
@endpush
