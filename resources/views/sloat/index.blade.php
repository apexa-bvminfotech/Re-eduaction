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
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">Sloat Management</h2>
                                    @can('sloat-create')
                                        <a href="{{route('sloat.create')}}" class="btn btn-primary float-right">Create
                                            New Sloat</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered table-striped" id="dataTable-1">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Staff Name</th>
                                        <th>RTC Name</th>
                                        <th>Time</th>
                                        <th>Status</th>
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
                                                <div class="custom-control custom-switch">
                                                    @can('sloat-edit')
                                                        <input type="checkbox" data-id="{{$s->id}}"
                                                               class="custom-control-input checkStatus"
                                                               id="c{{$key+1}}" {{ $s->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                @can('sloat-edit')
                                                    <a href="{{ route('sloat.edit',$s->id) }}"
                                                       class="btn btn-outline-success" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                @endcan
                                                {{--                                                @can('sloat-delete')--}}
                                                {{--                                                    {!! Form::open(['method' => 'DELETE','route' => ['sloat.destroy', $s->id],'style'=>'display:inline']) !!}--}}
                                                {{--                                                        <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash-2"></i></button>--}}
                                                {{--                                                    {!! Form::close() !!}--}}
                                                {{--                                                @endcan--}}
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
