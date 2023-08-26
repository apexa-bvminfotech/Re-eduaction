@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Management</h1>
                    </div>
                    <div class="col-sm-6 row input-group-append justify-content-end">
                        @can('student-create')
                            <a href="{{route('student.create')}}" class="btn btn-primary float-right"><i
                                    class="fa fa-plus pr-2"></i> Add</a>
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
                                        <th>Course</th>
                                        <th><span></span></th>
                                        <th>Phone</th>
                                        <th>Std</th>
                                        <th>Medium</th>
                                        <th><span></span></th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $key=>$s)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $s->surname }} {{ $s->name }}</td>
                                            <td>@foreach($s->courses as $course)
                                                {{$course->course->course_name }}
                                                @endforeach
                                            </td>
                                            <td>{{ $s->branch_name }}</td>
                                            <td>{{ $s->mother_contact_no }}</td>
                                            <td>{{ $s->standard }}</td>
                                            <td>{{ $s->medium }}</td>
                                            <td>{{ $s->isActiveStatus() != null ? $s->isActiveStatus()->status : 'Pending' }}</td>
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
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                    @can('student-edit')
                                                        <button type="button"
                                                                class="btn  btn-secondary btn-assign btn-sm"
                                                                data-id="{{$s->id}}"
                                                                data-assigned="{{ $s->isStaffAssigned() ? 'true' : 'false' }}">
                                                            {{ $s->isStaffAssigned() ? 'Shift Trainer' : 'Assign Trainer' }}
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-secondary btn-proxy btn-sm"
                                                                data-id="{{$s->id}}"> Assign Proxy Trainer
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-secondary btn-student-leave btn-sm"
                                                                data-id="{{$s->id}}"> Approved Leave
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-secondary btn-student-status btn-sm"
                                                                data-id="{{$s->id}}"> Change status
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
                                    <h5 class="modal-title" id="verticalModalTitle">Assign Trainer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="student_id" class="form-control student_id" value="">
                                    <div class="col-md-12 mb-1">
                                        <label for="name">Trainer Name: </label>
                                        <select name="trainer_id" class="form-control staff_id select2" required>
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
                                        <select name="slot_id" class="form-control slot select2" required>
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
                                    <h5 class="modal-title" id="verticalModalTitle">Assign ProxyTrainer</h5>
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
                                            <input type="date" class="form-control" name="starting_date"
                                                   value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="end_date">Ending Date:</label>
                                            <input type="date" class="form-control" name="ending_date"
                                                   value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
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
                <form id="leaveApprovedForm" action="{{ route('student.studentLeaveApprove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <input type="hidden" name="student_id" class="form-control student_id" value="" required>
                    <div class="modal fade" id="verticalModal2" tabindex="-1" role="dialog"
                         aria-labelledby="verticalModalTitle"
                         style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="verticalModalTitle">Student Approved leave</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="date">From:</label>
                                            <input type="date" class="form-control" name="start_date"
                                                   value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="date">To:</label>
                                            <input type="date" class="form-control" name="end_date"
                                                   value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="text">Leave Reason:</label>
                                            <input type="text" class="form-control" name="reason" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn mb-2 btn-primary leave-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal fade" id="StudentStatus" tabindex="-1" role="dialog"
                     aria-labelledby="verticalModalTitle"
                     style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verticalModalTitle">Change student status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('student.ChangeStudentStatus') }}" method="POST" id="studentStatusForm">
                                @csrf
                                <input type="hidden" name="student_id" class="form-control student_id" value="" required>
                                    <div class="modal-body">
                                        <div class="col-md-12 mb-1">
                                            <label for="name">Status</label>
                                            <select class="form-control proxy_class select2 statusSelect" name="status" required>
                                                <option value="0">------Select Status-----</option>
                                                <option value="Start">Start</option>
                                                <option value="Hold">Hold</option>
                                                <option value="Cancel">Cancel</option>
                                                <option value="Complete">Complete</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-1" id="displayTrainerBox" style="display: none">
                                            <div class="form-group">
                                                <label for="text">Trainer name:</label>
                                                <input type="text" class="form-control" name="trainer_name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn mb-2 btn-primary students-status">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {

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

            //Student Leave Form
            $(document).on('click', '.btn-student-leave', function () {
                let id = parseInt($(this).data('id'));
                $('.student_id').val(id);
                let user_id = {{ Auth::id() }};
                $('#user_id').val(user_id);
                $('#verticalModal2').modal('toggle');
            });

            $(document).on('click', '.leave-submit', function () {
                $('#leaveApprovedForm').submit();
            });

            $(document).on('click', '.btn-student-status', function () {
                let id = parseInt($(this).data('id'));
                $('.student_id').val(id);
                $('#StudentStatus').modal('toggle')
            });

            $(document).ready(function () {
                $('.statusSelect').on('change', function () {
                    var selectedValue = $(this).val();

                    if (selectedValue === 'Complete') { // Option "Other" is selected
                        $('#displayTrainerBox').show();
                    } else {
                        $('#displayTrainerBox').hide();
                    }
                });
            });
            $(document).on('click', '.students-status', function () {
                $('#studentStatusForm').submit();
            });
            $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["csv", "excel", "pdf", "print"],
                    initComplete: function () {
                        this.api().columns([1, 3, 7]).every(function () {
                            var column = this;
                            var select = $('<select class="form-control select2"><option value="">All</option></select>')
                                .appendTo($(column.header()).find('span').empty())
                                .on({
                                    'change': function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        column
                                            .search(val ? '^' + val + '$' : '', true, false).draw();
                                    },
                                    'click': function (e) {
                                        e.stopPropagation();
                                    }
                                });
                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        })
    </script>
@endpush
