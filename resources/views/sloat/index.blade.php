@extends('layouts.admin')
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
                    <div class="alert alert-default-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered table-striped" id="dataTable-1">
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
                                                        <input type="checkbox" data-id="{{$s->id}}" class="custom-control-input checkStatus" id="c{{$key+1}}" {{ $s->is_active ? '' : 'checked' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    @endcan
                                                    <span class="badge badge-pill changeStatus{{ $s->id }} {{ $s->is_active ? 'badge-danger': 'badge-success' }} ">{{ $s->is_active ? 'Deactive': 'Active' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @can('sloat-edit')
                                                    <a href="{{ route('sloat.edit',$s->id) }}" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i></a>
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
        $(function() {
            $('.checkStatus').change(function() {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var sloat_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeSloatStatus',
                    data: {'status': status, 'sloat_id': sloat_id},
                    success: function(data){
                        if(data == 0){
                            $('.changeStatus'+sloat_id).removeClass('badge-danger');
                            $('.changeStatus'+sloat_id).addClass('badge-success');
                            $('.changeStatus'+sloat_id).html('Active');
                        } else {
                            $('.changeStatus'+sloat_id).removeClass('badge-success');
                            $('.changeStatus'+sloat_id).addClass('badge-danger');
                            $('.changeStatus'+sloat_id).html('Deactive');
                        }
                    }
                });
            })
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
