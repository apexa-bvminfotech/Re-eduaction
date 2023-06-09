@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">User Management</h2>
                    @can('staff-create')
                        <a href="{{route('user.create')}}" class="btn btn-primary">Create New User</a>
                    @endcan
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key=>$u)
                                        <tr>
                                            <td>{{$u->id}}</td>
                                            <td>{{$u->name}}</td>
                                            <td>{{$u->email}}</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-id="{{$u->id}}"
                                                           class="custom-control-input checkStatus"
                                                           id="c{{$key+1}}" {{ $u->is_active ? '' : 'checked' }}>
                                                    <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    <span
                                                        class="badge badge-pill changeStatus{{ $u->id }} {{ $u->is_active ? 'badge-danger': 'badge-success' }} ">{{ $u->is_active ? 'Deactive': 'Active' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{route('user.edit',$u->id)}}" class="btn btn-success"
                                                   title="Edit"><i class="fa fa-edit"></i></a>
{{--                                                {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $u->id],'style'=>'display:inline']) !!}--}}
{{--                                                <button type="submit" class="btn btn-danger" title="Delete"--}}
{{--                                                        onclick="return confirm('Are you sure you want to delete?')"><i--}}
{{--                                                        class="fe fe-trash-2"></i></button>--}}
{{--                                                {!! Form::close() !!}--}}
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
        </div> <!-- .row -->
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('.checkStatus').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var user_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeUserStatus',
                    data: {'status': status, 'user_id': user_id},
                    success: function (data) {
                        if (data == 0) {
                            $('.changeStatus'+user_id).removeClass('badge-danger');
                            $('.changeStatus'+user_id).addClass('badge-success');
                            $('.changeStatus'+user_id).html('Active');
                        } else {
                            $('.changeStatus'+user_id).removeClass('badge-success');
                            $('.changeStatus'+user_id).addClass('badge-danger');
                            $('.changeStatus'+user_id).html('Deactive');
                        }
                    }
                });
            })
        })
    </script>
@endsection
