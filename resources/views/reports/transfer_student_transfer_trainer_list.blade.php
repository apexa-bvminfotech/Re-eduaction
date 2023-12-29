@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1>Transfer Student Transfer Trainer List</h1>
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
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>Student Name</td>
                                            <td>From Trainer</td>
                                            <td>To Trainer</td>
                                            <td>Date</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentList as $student)
                                            @foreach($transferStudent as $key => $tStudent)
                                            <tr>
                                                @if($student->student_id == $tStudent->student_id)
                                                    <td>{{ $tStudent->student->name ?? '' }} {{ $tStudent->student->surname ?? ''}}</td>
                                                    <td>
                                                        {{ $tStudent->trainer->name ?? ''}}<br>
                                                        {{ $tStudent->slot->slot_time ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $student->trainer->name ?? '' }}<br>
                                                        {{ $student->slot->slot_time ?? '' }}
                                                    </td>
                                                    <td>{{ date('Y-m-d',strtotime($student->date)) ??''}}</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

