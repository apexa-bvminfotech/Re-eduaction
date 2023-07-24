@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Show Student Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student.index') }}">Show Student
                                    List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body ">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset( $student->upload_student_image )}}"
                                         alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$student->surname}} {{$student->name}}</h3>
                                <p class="text-muted text-center">Student</p>
                                <ul class="list-group  mb-3">
                                    <li class="list-group-item">
                                        <b>Course:</b> <a class="float-right">{{$student->course->course_name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Demo taken:</b> <a class="float-right">{{$student->trainer->name ?? ''}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2 d-flex">
                                <ul class="nav nav-pills col-11">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal
                                            Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">School
                                            Detail</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#proxy_detail" data-toggle="tab">Proxy
                                            staff Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline1" data-toggle="tab">Assign
                                            Staff</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline2" data-toggle="tab">Student
                                            Attendance Show</a></li>
                                </ul>
                                <a href="{{ route('student.index') }}"
                                   class="col-1 btn btn-primary float-right">Back</a>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">
                                            <table class="table border-bottom">
                                                <tr>
                                                    <th><b>Father Contact No:</b></th>
                                                    <td>{{$student->father_contact_no}}</td>
                                                    <th><b>Mother Contact No:</b></th>
                                                    <td>{{$student->mother_contact_no}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Gender:</b></th>
                                                    <td>{{$student->gender}}</td>
                                                    <th><b>Email ID:</b></th>
                                                    <td>{{$student->email_id}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Address:</b></th>
                                                    <td>{{$student->address}}</td>
                                                    <th><b>School Name:</b></th>
                                                    <td>{{$student->school_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Standard:</b></th>
                                                    <td>{{$student->standard}}</td>
                                                    <th><b>Medium:</b></th>
                                                    <td>{{$student->medium}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>School Time:</b></th>
                                                    <td>{{$student->school_time}}</td>
                                                    <th><b>Extra Tuition Time:</b></th>
                                                    <td>{{$student->extra_tuition_time}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Date Of Birth:</b></th>
                                                    <td>{{$student->dob}}</td>
                                                    <th><b>Age:</b></th>
                                                    <td>{{$student->age}}</td>
                                                </tr>
                                                <tr class="border-bottom">
                                                    <th><b>Fess:</b></th>
                                                    <td>{{$student->fees}}</td>
                                                    <th><b>Extra Note:</b></th>
                                                    <td>{{$student->extra_note}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Upload PDF:</b></th>
                                                    <td>{{$student->upload_analysis}}</td>
                                                    <th><b>Courses:</b></th>
                                                    <td>{{$student->course->course_name}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="timeline">
                                        <div class="post">
                                            <table class="table">
                                                <tr>
                                                    <th><b>Reference By:</b></th>
                                                    <td>{{$student->reference_by}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Role:</b></th>
                                                    <td>{{$student->user->roles->first()->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Payment Condition:</b></th>
                                                    <td>{{$student->payment_condition}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Analysis Staff Name:</b></th>
                                                    <td>{{$student->trainer->name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th><b>Demo Taken By:</b></th>
                                                    <td>{{$student->trainer->name ?? ''}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="proxy_detail">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>ProxyTrainer Name:</b></th>
                                                    <th><b>Slot Time:</b></th>
                                                    <th><b>Starting Date:</b></th>
                                                    <th><b>Ending Date:</b></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($proxy_staff_details as $psd)
                                                    <tr>
                                                        <td>{{$psd->trainer->name}}</td>
                                                        <td>{{$psd->slot->slot_time}}</td>
                                                        <td>{{$psd->starting_date}}</td>
                                                        <td>{{$psd->ending_date}}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="timeline1">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>Assign Staff name</b></th>
                                                    <th><b>Slot:</b></th>
                                                    <th><b>Date:</b></th>
                                                    <th><b>Status</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($assignStaff as $key => $as)
                                                    <tr>
                                                        <td>{{$as->trainer->name}}</td>
                                                        <td>{{$as->slot->slot_time}}</td>
                                                        <td>{{$as->date}}</td>
                                                        <td>{!! $as->is_active === 0 ? '<i class="fa fa-check-circle" style="font-size:25px;color:green"></i>' : '' !!}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="timeline2">
                                        <div class="post">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><b>Absent Date:</b></th>
                                                    <th><b>Absent Reason:</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($studentAttendance as $key => $st)
                                                    @if ($st->absent_reason)
                                                        <tr>
                                                            <td>{{$st->attendance_date}}</td>
                                                            <td>{{$st->absent_reason}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="text-dark"><b><i>Courses</i></b></h3></div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-12">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-dark"><b><i>Courses</i></b></h3></div>
                    <div class="row">
                        <div class="col-sm-4">
                            {{--                            <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <table class="table table-bordered table-striped">--}}
{{--                                    <tr>--}}
{{--                                        <th class="text-center bg-info" colspan="4" style="font-size: 20px">Gujarati--}}
{{--                                        </th>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td style="padding-top: 15px; padding-left: 120px">Before</td>--}}
{{--                                        <td rowspan="2" class="text-center" style="padding-top: 35px">Topics</td>--}}
{{--                                        <td style="padding-top: 15px; padding-left: 120px">After</td>--}}
{{--                                        <td rowspan="2" class="text-center" style="padding-top: 35px">Date</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td style="padding-top: 10px; padding-left: 140px">0</td>--}}
{{--                                        <td style="padding-top: 10px; padding-left: 140px">0</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <div class="custom-control custom-checkbox"--}}
{{--                                                 style="padding-left: 150px;">--}}
{{--                                                <input class="custom-control-input" type="checkbox"--}}
{{--                                                       id="customCheckbox2">--}}
{{--                                                <label for="customCheckbox2" class="custom-control-label"></label>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            ગુજરાતી k,kh,g--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="custom-control custom-checkbox"--}}
{{--                                                 style="padding-left: 150px;">--}}
{{--                                                <input class="custom-control-input" type="checkbox"--}}
{{--                                                       id="customCheckbox3">--}}
{{--                                                <label for="customCheckbox3" class="custom-control-label"></label>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center">--</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <div class="custom-control custom-checkbox"--}}
{{--                                                 style="padding-left: 150px;">--}}
{{--                                                <input class="custom-control-input" type="checkbox"--}}
{{--                                                       id="customCheckbox4">--}}
{{--                                                <label for="customCheckbox4" class="custom-control-label"></label>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            a ની માત્ર વાળા શબ્દ--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="custom-control custom-checkbox"--}}
{{--                                                 style="padding-left: 150px;">--}}
{{--                                                <input class="custom-control-input" type="checkbox"--}}
{{--                                                       id="customCheckbox5">--}}
{{--                                                <label for="customCheckbox5" class="custom-control-label"></label>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center">--</td>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}
{{--                            </div>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="col-sm-6">
                            {{--                            <div class="card">--}}
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="courseTable" data-CourseId ="{{$student->course->id}}">
                                    @foreach($student->course->subcourses as $key =>$sc)
                                        <tr>
                                            <th class="bg-info">
                                                <input type="hidden" name="trainer_id" class="form-control trainer_id" value="{{$student->trainer->id}}">
                                                <div class="form-check checkbox-xl custom-checkbox text-center">
                                                    @can('student-course-complete-before')
                                                    <input class="form-check-input sub-course-checkbox"
                                                           type="checkbox"
                                                           id="customCheckbox_{{$loop->iteration}}">
                                                    @else
                                                        <input class="form-check-input sub-course-checkbox"
                                                               type="checkbox" disabled
                                                               id="customCheckbox_{{$loop->iteration}}">
                                                    @endcan
                                                    <label for="customCheckbox_{{$loop->iteration}}"
                                                           class="form-check-label"></label>
                                                </div>
                                            </th>
                                            <th class="text-center bg-info"
                                                style="font-size: 20px">{{$sc->sub_course_name}}
                                            </th>
                                            <th class="bg-info">
                                                <div class="form-check checkbox-xl custom-checkbox text-center">
                                                    <input class="form-check-input sub-course-checkbox"
                                                           type="checkbox"
                                                           id="customCheckbox1_{{$loop->iteration}}"
                                                           data-subCourseId="{{$sc->id}}" data-pointId="0">
                                                    <label for="customCheckbox1_{{$loop->iteration}}"
                                                           class="form-check-label"></label>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <b> Before </b>
                                            </td>
                                            <td class="text-center">
                                                <b>Points</b>
                                            </td>
                                            <td class="text-center">
                                                <b> After </b>
                                            </td>
                                        </tr>
                                        @foreach($sc->points as $key =>$sp)
                                            <tr>
                                                <td>
                                                    <div class="form-check checkbox-xl custom-checkbox text-center">
                                                        @can('student-course-complete-before')
                                                        <input class="form-check-input point-checkbox"
                                                               type="checkbox"
                                                               id="customCheckbox2_{{$loop->iteration}}">
                                                        @else
                                                            <input class="form-check-input point-checkbox"
                                                                   type="checkbox" disabled
                                                                   id="customCheckbox2_{{$loop->iteration}}">
                                                        @endcan
                                                        <label for="customCheckbox2_{{$loop->iteration}}"
                                                               class="form-check-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$sp->sub_point_name}}</td>
                                                <td>
                                                    <div class="form-check checkbox-xl custom-checkbox text-center">
                                                        <input class="form-check-input point-checkbox"
                                                               type="checkbox"
                                                               id="customCheckbox3_{{$loop->iteration}}"
                                                               data-subCourseId="{{$sc->id}}"
                                                               data-pointId="{{$sp->id}}">
                                                        <label for="customCheckbox3_{{$loop->iteration}}"
                                                               class="form-check-label"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div id="result"></div>
                </div>
            </div>
            {{--            </div>--}}
        </section>
    </div>
    {{--    <div id="result"></div>--}}
@endsection
@push('styles')
    <style>
        .checkbox {
            width: 200px;
            color: #fff;
            margin: auto;
        }

        .topics {
            padding-top: 300px;
        }
    </style>
@endpush
@push('scripts')
    <script>

        $(document).ready(function () {
            $(document).on('click', '.point-checkbox', function () {
                var subCourseId = $(this).data('subcourseid');
                var pointId = $(this).data('pointid');

                $.ajax({
                    url: "{{route('student.sendNotification')}}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "student_id": "{{$student->id}}",
                        "course_id":"{{$student->course->id}}",
                        "sub_course_id": subCourseId,
                        "sub_course_point_id": pointId
                    },
                    success: function (data) {
                        var student = data.student;
                        var trainer = data.trainer;
                        alert(data.message);

                        $('#result').html('<p>Student: ' + student + '</p><p>Trainer: ' + trainer + '</p>');
                    },
                    error: function (error) {
                        console.log(error);
                    }

                });
            });
        });
    </script>

    @endpush
