@extends('layouts.header')
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
                    <div class="alert alert-success">
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
                                        <th>Action</th>
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
                                                <a href="{{ route('student.show',$student->id) }}" class="btn btn-info" title="Show Permission"><i class="fe fe-eye"></i></a>
                                            @can('student-edit')
                                                    <a href="{{ route('student.edit',$student->id) }}" class="btn btn-success" title="Edit"><i class="fe fe-edit"></i></a>
                                                @endcan
                                                @can('student-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['student.destroy', $student->id],'style'=>'display:inline']) !!}
                                                    <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash-2"></i></button>
                                                    {!! Form::close() !!}
                                                @endcan
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
