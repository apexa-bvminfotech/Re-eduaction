@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">RTC Management</h2>
                    @can('rtc-create')
                        <a href="{{route('rtc.create')}}" class="btn btn-primary">Create New RTC</a>
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
                                        <th>RTc No</th>
                                        <th>RTc Name</th>
                                        <th>RTc Address</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($rtc as $key => $r)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $r->rtc_no }}</td>
                                            <td>{{ $r->rtc_name }}</td>
                                            <td>{{ $r->address }}</td>
                                            <td>
                                                @can('role-edit')
                                                    <a href="{{ route('rtc.edit',$r->id) }}" class="btn btn-success" title="Edit"><i class="fe fe-edit"></i></a>
                                                @endcan
                                                @can('role-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['rtc.destroy', $r->id],'style'=>'display:inline']) !!}
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
