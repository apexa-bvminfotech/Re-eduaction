@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('student-create')
                            <a href="{{route('student.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus pr-2"></i> Add</a>
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
                                        <th>ID</th>
                                        <th><span></span></th>
                                        <th>Course name</th>
                                        <th><span></span></th>
                                        <th>Mother Contact no.</th>
                                        <th>Standard</th>
                                        <th>Medium</th>
                                        <th width="300px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $key=>$s)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $s->surname }} {{ $s->name }}</td>
                                            <td>{{ $s->course->course_name }}</td>
                                            <td>{{ $s->branch_name }}</td>
                                            <td>{{ $s->mother_contact_no }}</td>
                                            <td>{{ $s->standard }}</td>
                                            <td>{{ $s->medium }}</td>
                                            <td>
                                                <div class="flex justify-between">
                                                    <a href="{{ route('student.show',$s->id) }}"
                                                       class="btn btn-info btn-sm" title="Show">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @can('student-edit')
                                                        <a href="{{ route('student.edit',$s->id) }}"
                                                           class="btn btn-success btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('student-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['student.destroy', $s->id],'style'=>'display:inline']) !!}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                    @can('student-edit')
                                                        <button type="button"
                                                                class="btn  btn-secondary btn-assign btn-sm"
                                                                data-id="{{$s->id}}"> Assign Staff
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-secondary btn-proxy btn-sm"
                                                                data-id="{{$s->id}}"> Assign Proxy Staff
                                                        </button>
                                                    @endcan
                                                </div>
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
                <form id="assignStaffForm" action="{{ route('student.assignStaff') }}" method="POST">
                    @csrf
                    <div class="modal fade" id="verticalModal" tabindex="-1" role="dialog"
                         aria-labelledby="verticalModalTitle"
                         style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="verticalModalTitle">Assign Staff</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="student_id" class="form-control student_id" value="">
                                    <div class="col-md-12 mb-1">
                                        <label for="name">Trainer Name: </label>
                                        <select  name="trainer_id" class="form-control staff_id select2" required>
                                            <option value="0">------Select Trainer-----</option>
                                            @foreach($trainers as $key =>$trainer)
                                                @if($trainer->is_active == 0)
                                                    <option
                                                        value="{{$trainer->id}}" {{old('name')==$trainer->id}}>{{$trainer->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <label for="name">Slot: </label>
                                        <select  name="slot_id" class="form-control slot select2" required>
                                            <option value="">------Select Slot-----</option>
                                            @foreach($slots as $key =>$s)
                                                @if($s->is_active == 0)
                                                    <option
                                                        value="{{$s->id}}" {{old('slot_id')==$s->id}}>{{$s->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn mb-2 btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="proxyStaffForm" action="{{ route('student.proxyStaff') }}" method="POST">
                    @csrf
                    <div class="modal fade" id="verticalModal1" tabindex="-1" role="dialog"
                         aria-labelledby="verticalModalTitle"
                         style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="verticalModalTitle">Assign ProxyStaff</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="student_id" class="form-control student_id " value="">
                                    <div class="col-md-12 mb-1">
                                        <label for="name">Trainer Name(Proxy): </label>
                                        <select class="form-control proxy_class select2" name="trainer_id" required>
                                            <option value="0">------Select Trainer-----</option>
                                            @foreach($trainers as $key =>$trainer)
                                                @if($trainer->is_active == 0)
                                                    <option
                                                        value="{{$trainer->id}}" {{old('name')==$trainer->id}}>{{$trainer->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <label for="name">Slot: </label>
                                        <select class="form-control slot select2" name="slot_id" required>
                                            <option value="">------Select Slot-----</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="start_date">Starting Date:</label>
                                            <input type="date" class="form-control" name="starting_date" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="end_date">Ending Date:</label>
                                            <input type="date" class="form-control" name="ending_date" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn mb-2 btn-primary proxy_submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            {{--let regularStaffAssignedSlots = @json($regularStaffAssignedSlots);--}}

            $(document).on('click', '.btn-assign', function () {
                let id = parseInt($(this).data('id'));
                $('.student_id').val(id)
                $('#verticalModal').modal('toggle')
                $('.staff_id').val($('.staff_id').children().eq(0).val());
                $('.slot').html('<option value="">------Select Slot-----</option>')
            });

            $(document).on('change', '.staff_id', function () {
                let staff = ($(this).val());
                if (staff != "") {
                    $.ajax({
                        url: 'student/staff-slot/' + staff,
                        type: 'GET',
                        data: {
                            "_token": "{{csrf_token()}}",
                        },
                        success: function (data) {
                            console.log("Slot display done.", data);
                            let slotOption = '<option value="">------Select Slot-----</option>'
                            $.each(data.slots, function (index, slot) {
                                slotOption += '<option value="' + slot.id + '">' + slot.slot_time + '  (' + slot.rtc.rtc_name + ')</option>'
                            })
                            $('.slot').html("")
                            $('.slot').html(slotOption)
                        }
                    });
                }
            });
            $(document).on('click', '.btn-primary', function () {
                $('#assignStaffForm').submit();
            });

            //proxy-assign-staff

            $(document).on('click', '.btn-proxy', function () {
                let id = parseInt($(this).data('id'));
                $('.student_id').val(id)
                $('#verticalModal1').modal('toggle')
                $('.proxy_class').val($('.proxy_class').children().eq(0).val());
                $('.slot').html('<option value="">------Select Slot-----</option>')
            });

            $(document).on('change', '.proxy_class', function () {
                let proxy = ($(this).val());
                if (proxy != "") {
                    $.ajax({
                        url: 'student/proxy-slot/' + proxy,
                        type: 'GET',
                        data: {
                            "_token": "{{csrf_token()}}",
                        },
                        success: function (data) {
                            console.log("Slot display done.", data);
                            let slotOption = '<option value="">------Select Slot-----</option>';
                            $.each(data.slots, function (index, slot) {
                                slotOption += '<option value="' + slot.id + '">' + slot.slot_time + '  (' + slot.rtc.rtc_name + ')</option>';
                            })
                            $('.slot').html("")
                            $('.slot').html(slotOption)
                        }
                    });
                }
            });

            $(document).on('click', '.proxy_submit', function () {
                $('#proxyStaffForm').submit();
            });

            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1,3]).every( function () {
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
