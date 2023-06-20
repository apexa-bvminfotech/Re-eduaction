@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">Branch Management</h2>
                                    @can('branch-create')
                                        <a href="{{route('branch.create')}}" class="btn btn-primary float-right">Create
                                            New Branch</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Authorized person name</th>
                                        <th>Authorized person Contact</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($branches as $key=>$u)
                                        <tr>
                                            <td>{{$u->id}}</td>
                                            <td>{{$u->name}}</td>
                                            <td>{{$u->address}}</td>
                                            <td>{{$u->authorized_person_name}}</td>
                                            <td>{{$u->authorized_person_contact}}</td>
                                            <td>
                                                @can('branch-edit')
                                                    <a href="{{route('branch.edit',$u->id)}}" class="btn btn-outline-success"
                                                       title="Edit"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                {{--                                                {!! Form::open(['method' => 'DELETE','route' => ['branch.destroy', $u->id],'style'=>'display:inline']) !!}--}}
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
