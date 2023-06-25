@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trainer Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('trainer.create')}}" class="btn btn-primary float-right">Create New Trainer</a>
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
                                            <th>Name</th>
                                            <th>Branch Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trainer as $key => $t)
                                            <tr>
                                                <td>{{ $t->id }}</td>
                                                <td>{{ $t->name }}</td>
                                                <td>{{$t->branch ? $t->branch->name : ''}}</td>
                                                <td>
                                                    @can('trainer-edit')
                                                        <a href="{{ route('trainer.edit',$t->id) }}"
                                                           class="btn btn-outline-success btn-sm" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        })
    </script>
@endpush
