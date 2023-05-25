@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Sloat Management</h2>
                    @can('sloat-create')
                        <a href="{{route('sloat.create')}}" class="btn btn-primary">Create New Sloat</a>
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
                                        <th>Staff Name</th>
                                        <th>RTC Name</th>
                                        <th>Time</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sloat as $key => $s)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $s->staff_name }}</td>
                                            <td>{{ $s->rtc_name }}</td>
                                            <td>{{ $s->sloat_time }}</td>
                                            <td>
                                                @can('sloat-edit')
                                                    <a href="{{ route('sloat.edit',$s->id) }}" class="btn btn-success" title="Edit"><i class="fe fe-edit"></i></a>
                                                @endcan
                                                @can('sloat-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['sloat.destroy', $s->id],'style'=>'display:inline']) !!}
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
