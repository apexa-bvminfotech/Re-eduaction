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
                                    <h2 class="mb-0 page-title">RTC Management</h2>
                                    @can('rtc-create')
                                        <a href="{{route('rtc.create')}}" class="btn btn-primary float-right">Create New
                                            RTC</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered table-striped datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Branch Name</th>
                                        <th>RTc No</th>
                                        <th>RTc Name</th>
                                        <th>Person Name</th>
                                        <th>RTc Address</th>
                                        <th>Status</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($rtc as $key => $r)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $r->branch ? $r->branch->name : ''}}</td>
                                            <td>{{ $r->rtc_no }}</td>
                                            <td>{{ $r->rtc_name }}</td>
                                            <td>{{$r->person_name}}<br>{{$r->contact}}</td>
                                            <td>{{ $r->address }}</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    @can('rtc-edit')
                                                        <input type="checkbox" data-id="{{$r->id}}"
                                                               class="custom-control-input checkStatus"
                                                               id="c{{$key+1}}" {{ $r->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                @can('rtc-edit')
                                                    <a href="{{ route('rtc.edit',$r->id) }}"
                                                       class="btn btn-outline-success" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
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
        $(function () {
            $('.checkStatus').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var rtc_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeRtcStatus',
                    data: {'status': status, 'rtc_id': rtc_id},
                    success: function (data) {
                        if (data == 0) {
                            $('.changeStatus' + rtc_id).removeClass('badge-danger');
                            $('.changeStatus' + rtc_id).addClass('badge-success');

                        } else {
                            $('.changeStatus' + rtc_id).removeClass('badge-success');
                            $('.changeStatus' + rtc_id).addClass('badge-danger');

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
