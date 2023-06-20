@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-3">
                  <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">User Management</h2>
                                    @can('staff-create')
                                        <a href="{{route('user.create')}}" class="btn btn-primary float-right">Create
                                            New User</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Surname</th>
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $key=>$u)
                                        <tr>
                                            <td>{{$u->id}}</td>
                                            <td>{{$u->surname}}</td>
                                            <td>{{$u->name}}</td>
                                            <td>{{$u->father_name}}</td>
                                            <td>{{$u->email}}</td>
                                            <td>{{$u->contact}}</td>
                                            <td>
                                                @if($u->branch)
                                                    {{$u->branch->name}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-id="{{$u->id}}"
                                                           class="custom-control-input checkStatus"
                                                           id="c{{$key+1}}" {{ $u->is_active ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{route('user.edit',$u->id)}}" class="btn btn-outline-success"
                                                   title="Edit"><i class="fa fa-edit"></i></a>
{{--                                                                                                {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $u->id],'style'=>'display:inline']) !!}--}}
{{--                                                                                                <button type="submit" class="btn btn-danger" title="Delete"--}}
{{--                                                                                                        onclick="return confirm('Are you sure you want to delete?')"><i--}}
{{--                                                                                                        class="fe fe-trash-2"></i></button>--}}
{{--                                                                                                {!! Form::close() !!}--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {

            $('#dataTable-1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endpush
