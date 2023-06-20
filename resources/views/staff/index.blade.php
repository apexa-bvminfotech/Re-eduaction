@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">

                </div>
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
                                    <h2 class="mb-0 page-title">Staff Management</h2>
                                    @can('staff-create')
                                        <a href="{{route('staff.create')}}" class="btn btn-primary float-right">Create
                                            New Staff</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>I_card</th>
                                        <th>uniform</th>
                                        <th>Address</th>
                                        <th>Emergency phone</th>
                                        <th>Status</th>
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
                                            <td>@if($s->staff_I_card)
                                                    <i class="fa fa-check-circle"
                                                       style="font-size:20px;color:green"></i>
                                                @endif</td>
                                            <td>@if($s->staff_uniform)
                                                    <i class="fa fa-check-circle"
                                                       style="font-size:20px;color:green"></i>
                                                @endif</td>
                                            <td>{{ $s->staff_address }}</td>
                                            <td>{{ $s->eme_phone }}</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    @can('rtc-edit')
                                                        <input type="checkbox" data-id="{{$s->id}}"
                                                               class="custom-control-input checkStatus"
                                                               id="c{{$key+1}}" {{ $s->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                @can('staff-edit')
                                                    <a href="{{ route('staff.edit',$s->id) }}"
                                                       class="btn btn-outline-success" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                @endcan
                                                <a href="{{ route('staff.show',$s->id) }}" class="btn btn-outline-info"
                                                   title="Show Permission"><i class="fa fa-eye"></i></a>

                                                {{--                                                @can('staff-delete')--}}
                                                {{--                                                    {!! Form::open(['method' => 'DELETE','route' => ['staff.destroy', $s->id],'style'=>'display:inline']) !!}--}}
                                                {{--                                                    <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash-2"></i></button>--}}
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
                var staff_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStaffStatus',
                    data: {'status': status, 'staff_id': staff_id},
                    success: function (data) {
                        if (data == 0) {
                            $('.changeStatus' + staff_id).removeClass('badge-danger');
                            $('.changeStatus' + staff_id).addClass('badge-success');
                            $('.changeStatus' + staff_id).html('Active');
                        } else {
                            $('.changeStatus' + staff_id).removeClass('badge-success');
                            $('.changeStatus' + staff_id).addClass('badge-danger');
                            $('.changeStatus' + staff_id).html('Deactive');
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
