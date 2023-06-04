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
                                            <th>Status</th>
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
                                                <div class="custom-control custom-switch">
                                                    @can('rtc-edit')
                                                        <input type="checkbox" data-id="{{$r->id}}" class="custom-control-input checkStatus" id="c{{$key+1}}" {{ $r->is_active ? '' : 'checked' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    @endcan
                                                    <span class="badge badge-pill changeStatus{{ $r->id }} {{ $r->is_active ? 'badge-danger': 'badge-success' }} ">{{ $r->is_active ? 'Deactive': 'Active' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @can('rtc-edit')
                                                    <a href="{{ route('rtc.edit',$r->id) }}" class="btn btn-success" title="Edit"><i class="fe fe-edit"></i></a>
                                                @endcan
{{--                                                @can('rtc-delete')--}}
{{--                                                    {!! Form::open(['method' => 'DELETE','route' => ['rtc.destroy', $r->id],'style'=>'display:inline']) !!}--}}
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
                var rtc_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeRtcStatus',
                    data: {'status': status, 'rtc_id': rtc_id},
                    success: function(data){
                        if(data == 0){
                            $('.changeStatus'+rtc_id).removeClass('badge-danger');
                            $('.changeStatus'+rtc_id).addClass('badge-success');
                            $('.changeStatus'+rtc_id).html('Active');
                        } else {
                            $('.changeStatus'+rtc_id).removeClass('badge-success');
                            $('.changeStatus'+rtc_id).addClass('badge-danger');
                            $('.changeStatus'+rtc_id).html('Deactive');
                        }
                    }
                });
            })
        })
    </script>
@endpush
