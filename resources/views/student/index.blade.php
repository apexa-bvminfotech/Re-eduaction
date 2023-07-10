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
                            <a href="{{route('student.create')}}" class="btn btn-primary float-right">Create New
                                Student</a>
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
                                        <th>Student name</th>
                                        <th>Course name</th>
                                        <th>Father Contact no.</th>
                                        <th>Standard</th>
                                        <th>Medium</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $key=>$s)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$s->name}}</td>
                                            <td>{{$s->course->course_name}}</td>
                                            <td>{{$s->father_contact_no}}</td>
                                            <td>{{$s->standard}}</td>
                                            <td>{{$s->medium}}</td>
                                            <td>
                                                <div class="flex justify-between">
                                                    <a href="{{ route('student.show',$s->id) }}"
                                                       class="btn btn-info" title="Show">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @can('student-edit')
                                                        <a href="{{ route('student.edit',$s->id) }}"
                                                           class="btn btn-success" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('student-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['student.destroy', $s->id],'style'=>'display:inline']) !!}
                                                        <button type="submit" class="btn btn-danger" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                    <button type="button"
                                                            class="btn  btn-secondary  btn-assign"
                                                            data-id="{{$s->id}}"> Assign Staff
                                                    </button>
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
                                        <label for="name">Staff Name: </label>
                                        <select class="form-control staff_id" name="trainer_id" required>
                                            <option value="0">------Select Trainer-----</option>
                                            @foreach($trainers as $key =>$trainer)
                                                @if($trainer->is_active == 0)
                                                    <option
                                                        value="{{$trainer->id}}" {{old('name')==$trainer->id}}>{{$trainer->trainer_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <label for="name">Slot: </label>
                                        <select class="form-control slot" name="slot" required>
                                            <option value="">------Select Slot-----</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="gender">lecture Type:</label>
                                            <br/>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type" id="type_proxy"
                                                       value="proxy" required>
                                                <label class="form-check-label" for="type_proxy">
                                                    Proxy Lecture
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                       id="type_regular"
                                                       value="regular" required>
                                                <label class="form-check-label" for="type_regular">
                                                    Regular Lecture
                                                </label>
                                            </div>
                                        </div>
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

            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        })
    </script>
@endpush
