@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Branch Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('branch.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
                        @endcan
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
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
                                            <th><span></span></th>
                                            <th>Branch Address</th>
                                            <th>Authorized person name</th>
                                            <th>Authorized person Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($branches as $key=>$u)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{$u->name}}</td>
                                                <td>{{$u->address}}</td>
                                                <td>{{$u->authorized_person_name}}</td>
                                                <td>{{$u->authorized_person_contact}}</td>
                                                <td>
                                                    @can('branch-edit')
                                                        <a href="{{route('branch.edit',$u->id)}}" class="btn btn-success btn-sm"
                                                           title="Edit"><i class="fa fa-edit"></i> Edit</a>
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
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1]).every( function () {
                        var column = this;
                        var select = $('<select class="form-control select2"><option value="">All</option></select>')
                            .appendTo( $(column.header()).find('span').empty() )
                            .on({ 'change': function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false ).draw();
                                },
                                'click': function(e) {
                                    e.stopPropagation();
                                }
                            });
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        });
                    });
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        })
    </script>
@endpush
