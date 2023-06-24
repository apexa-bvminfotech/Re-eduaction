@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slot Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('slot.create')}}" class="btn btn-primary float-right">Create New Slot</a>
                        @endcan
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Branch Name</th>
                                            <th>Trainer Name</th>
                                            <th>RTC Name</th>
                                            <th>Time</th>
                                            <th>WhatsApp group Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                                   id="c{{$key+1}}" {{ $s->is_active ? '' : 'checked' }}>
                                                            <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                        @endcan
                                                    </div>
                                                </td>
                                                <td>
                                                    @can('slot-edit')
                                                        <a href="{{ route('slot.edit',$s->id) }}"
                                                           class="btn btn-outline-success btn-xs" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('.checkStatus').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var slot_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: '/changeSlotStatus',
                    data: {'status': status, 'slot_id': slot_id},
                    success: function (data) {
                        toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                        if(status){
                            toastr.error(data.success);
                        } else {
                            toastr.success(data.success);
                        }
                    }
                });
            });
        })
    </script>
@endpush
