@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">

                </div>

                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">Trainer Management</h2>
                                    @can('trainer-create')
                                        <a href="{{route('trainer.create')}}" class="btn btn-primary float-right">Create
                                            New Trainer</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Branch Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($trainer as $key => $t)
                                        <tr>
                                            <td>{{ $t->id }}</td>
                                            <td>{{ $t->name }}</td>
                                            <td>{{$t->branch ? $t->branch->name : ''}}</td>
                                            <td>
                                                @can('trainer-edit')
                                                    <a href="{{ route('trainer.edit',$t->id) }}"
                                                       class="btn btn-outline-success" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                @endcan
                                                <a href="{{ route('trainer.show',$t->id) }}" class="btn btn-outline-info"
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
        $(document).ready(function () {
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
    }
@endpush
