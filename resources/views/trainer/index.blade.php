@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trainer Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('trainer.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
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
                                        <th>Name</th>
                                        <th>Branch Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($trainer as $key => $t)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $t->name }}</td>
                                            <td>{{$t->branch ? $t->branch->name : ''}}</td>
                                            <td>
                                                @can('trainer-edit')
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" data-id="{{$t->id}}"
                                                               class="custom-control-input checkStatus"
                                                               id="c{{$key+1}}" {{ $t->is_active ? '' : 'checked' }}>
                                                        <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                    </div>
                                                @endcan
                                            </td>
                                            <td>
                                                <a href="{{ route('trainer.show',$t->id) }}"
                                                   class="btn btn-info btn-sm" title="show"><i class="fa fa-eye"></i> View</a>

                                                @can('trainer-edit')
                                                    <a href="{{ route('trainer.edit',$t->id) }}"
                                                       class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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
                var trainer_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: '/changeTrainerStatus',
                    data: {'status': status, 'trainer_id': trainer_id},
                    success: function (data) {
                        toastr.options =
                            {
                                "closeButton": true,
                                "progressBar": true
                            }
                        if (status) {
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
