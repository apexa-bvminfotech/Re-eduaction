@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>RTC Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('rtc.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
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
                                            <th>RTc No</th>
                                            <th>RTc Name</th>
                                            <th>Person Name</th>
                                            <th>RTc Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                                   id="c{{$key+1}}" {{ $r->is_active ? '' : 'checked' }}>
                                                            <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                        @endcan
                                                    </div>
                                                </td>
                                                <td>
                                                    @can('rtc-edit')
                                                        <a href="{{ route('rtc.edit',$r->id) }}"
                                                           class="btn btn-success btn-sm" title="Edit"><i
                                                                class="fa fa-edit"></i> Edit</a>
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
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $('.checkStatus').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var rtc_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeRtcStatus',
                    data: {'status': status, 'rtc_id': rtc_id},
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
