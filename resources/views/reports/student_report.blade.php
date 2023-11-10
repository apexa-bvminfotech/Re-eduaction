@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Student Details</h1>
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
                                        <th><span>Date</span></th>
                                        <th><span>Student Name</span></th>
                                        <th><span>Mobile Number</span></th>
                                        <th><span>Course</span></th>
                                        <th><span>Std</span></th>
                                        <th><span>Medium</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $key=>$student)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$student->registration_date}}</td>
                                            <td>{{ $student->name }} {{ $student->surname }}</td>
                                            <td>{{ $student->father_contact_no }}</td>
                                            <td>
                                                @foreach($student->courses as $course)
                                                    {{$course->course->course_name }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $student->standard }}</td>
                                            <td>{{ $student->medium }}</td>
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
