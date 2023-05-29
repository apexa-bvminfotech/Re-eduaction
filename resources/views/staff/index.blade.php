@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Staff Management</h2>
                    @can('staff-create')
                        <a href="{{route('staff.create')}}" class="btn btn-primary">Create New Staff</a>
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
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>I_card</th>
                                        <th>uniform</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Emergency phone</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($staff as $key => $s)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $s->employee_ID }}</td>
                                            <td>{{ $s->staff_name }}</td>
                                            <td>{{ $s->staff_phone }}</td>
                                            <td>@if($s->staff_I_card) <i class="fe fe-check"></i> @endif</td>
                                            <td>@if($s->staff_uniform) <i class="fe fe-check"></i> @endif</td>
                                            <td>{{ $s->staff_email }}</td>
                                            <td>{{ $s->staff_address }}</td>
                                            <td>{{ $s->eme_phone }}</td>
                                            <td>
                                                @can('staff-edit')
                                                    <a href="{{ route('staff.edit',$s->id) }}" class="btn btn-success" title="Edit"><i class="fe fe-edit"></i></a>
                                                @endcan
                                                @can('staff-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['staff.destroy', $s->id],'style'=>'display:inline']) !!}
                                                    <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash-2"></i></button>
                                                    {!! Form::close() !!}
                                                @endcan
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
    </div> <!-- .container-fluid -->


@endsection
