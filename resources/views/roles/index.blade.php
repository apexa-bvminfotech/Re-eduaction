@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-default-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between ">
                                    <h2 class="mb-0 page-title">Role Management</h2>
                                    <a href="{{route('roles.create')}}" class="btn btn-outline-primary float-right">Create
                                        New Role</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('roles.show',$role->id) }}" class="btn btn-info"
                                                   title="Show Permission"><i class="fa fa-eye"></i></a>
                                                @can('role-edit')
                                                    <a href="{{ route('roles.edit',$role->id) }}"
                                                       class="btn btn-success" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('role-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                    <button type="submit" class="btn btn-danger" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                        <i class="fa fa-trash"></i></button>
                                                    {!! Form::close() !!}
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
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#dataTable-1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endpush
