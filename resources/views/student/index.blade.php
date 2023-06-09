@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Students Management</h2>
                    @can('role-create')
                        <a href="{{route('student.create')}}" class="btn btn-primary">Create New Student</a>
                    @endcan
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-default-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
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
                                    @foreach($students as $key=>$student)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->course->course_name}}</td>
                                            <td>{{$student->father_contact_no}}</td>
                                            <td>{{$student->standard}}</td>
                                            <td>{{$student->medium}}</td>
                                            <td>
                                                <div class="flex justify-between">
                                                    @can('student-edit')
                                                        <a href="{{ route('student.edit',$student->id) }}"
                                                           class="btn btn-success" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('student-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['student.destroy', $student->id],'style'=>'display:inline']) !!}
                                                        <button type="submit" class="btn btn-danger" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                    <button type="button"
                                                            class="btn mb-3 btn-outline-success mt-3 btn-assign"
                                                            data-id="{{$student->id}}"> Assign Staff
                                                    </button>
                                                </div>
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
        </div>
        <form id="assignStaffForm" action="{{ route('student.assignStaff') }}" method="POST">
            @csrf
            <div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
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
                                <select class="form-control staff_id" name="staff_id" required>
                                    <option value="0">------Select Staff-----</option>
                                    @foreach($staffs as $key=>$staff)
                                        @if($staff->is_active == 0)
                                            <option value="{{$staff->id}}" {{old('name')==$staff->id}}>{{$staff->staff_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="name">Sloat: </label>
                                <select class="form-control sloat" name="sloat" required>
                                    <option value="">------Select Sloat-----</option>
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
                                        <input class="form-check-input" type="radio" name="type" id="type_regular"
                                               value="regular" required>
                                        <label class="form-check-label" for="type_regular">
                                            Regular Lecture
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn mb-2 btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- .container-fluid -->

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-assign', function () {
                let id = parseInt($(this).data('id'));
                $('.student_id').val(id)
                $('#verticalModal').modal('toggle')
                $('.staff_id').val($('.staff_id').children().eq(0).val());
                $('.sloat').html('<option value="">------Select Sloat-----</option>')
            });
            $(document).on('change', '.staff_id', function () {
                let staff = ($(this).val());
                if (staff != "") {
                    $.ajax({
                        url: 'student/staff-sloat/' + staff,
                        type: 'GET',
                        data: {
                            "_token": "{{csrf_token()}}",
                        },
                        success: function (data) {
                            console.log("Sloat display done.", data);
                            let sloatOption = '<option value="">------Select Sloat-----</option>'
                            $.each(data.sloats, function (index, sloat) {
                                sloatOption += '<option value="' + sloat.id + '">' + sloat.sloat_time + '  (' + sloat.rtc.rtc_name + ')</option>'
                            })
                            $('.sloat').html("")
                            $('.sloat').html(sloatOption)
                        }
                    });
                }
            });
            $(document).on('click', '.btn-primary', function () {
                $('#assignStaffForm').submit();
            });

        })

    </script>
@endpush
