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
                                    <h2 class="mb-1 page-title">Slot Management</h2>
                                    @can('slot-create')
                                        <a href="{{route('slot.create')}}" class="btn btn-primary float-right">Create
                                            New Slot</a>
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
                                        <th>Trainer Name</th>
                                        <th>RTC Name</th>
                                        <th>Time</th>
                                        <th>WhatsApp group Name</th>
                                        <th>Status</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($slot as $key => $s)
                                        <tr>
                                            <td>{{ $s->id }}</td>
                                            <td>{{$s->branch->name}}</td>
                                            <td>{{ $s->trainer->name }}</td>
                                            <td>{{$s->rtc->rtc_name}}</td>
                                            <td>{{ $s->slot_time }}</td>
                                            <td>{{$s->whatsapp_group_name}}</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    @can('slot-edit')
                                                        <input type="checkbox" data-id="{{$s->id}}"
                                                               class="custom-control-input checkStatus"
                                                               id="c{{$key+1}}" {{ $s->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                @can('slot-edit')
                                                    <a href="{{ route('slot.edit',$s->id) }}"
                                                       class="btn btn-outline-success" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                @endcan
                                                {{--                                                @can('slot-delete')--}}
                                                {{--                                                    {!! Form::open(['method' => 'DELETE','route' => ['slot.destroy', $s->id],'style'=>'display:inline']) !!}--}}
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
