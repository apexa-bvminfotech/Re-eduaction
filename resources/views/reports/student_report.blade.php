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
                                <table id="example1" class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th><span>Date</span></th>
                                        <th><span>Student Name</span></th>
                                        <th><span>Mobile Number</span></th>
                                        <th><span>Course</span></th>
                                        <th><span>Std</span></th>
                                        <th><span>Medium</span></th>
                                        <th><span>Slot No</span></th>
                                        <th><span>Time</span></th>
                                        <th><span>Runing trainer</span></th>
                                        <th><span>Whatsapp Group Name</span></th>
                                        <th><span>RTC Name</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($slots as $key=>$slot)
                                        <tr>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($slot->slotList as $s)
                                                <tr>
                                                    <td>{{ $s->student->id ?? ''}}</td>
                                                    <td>{{$s->student->registration_date ?? ''}}</td>
                                                    <td>{{ $s->student->name  ?? ''}} {{ $s->student->surname ??''}}</td>
                                                    <td>{{ $s->student->father_contact_no ?? ''}}</td>
                                                    <td>
                                                        @foreach($s->student->courses as $course)
                                                            {{$course->course->course_name ?? '' }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $s->student->standard ?? ''}}</td>
                                                    <td>{{ $s->student->medium   ?? ''}}</td>

                                                    @if($i == 0)
                                                    <td rowspan="2" style="vertical-align:middle">{{$slot->id ?? ''}}</td>
                                                    <td rowspan="2" style="vertical-align:middle">{{$slot->slot_time ?? ''}}</td>
                                                    <td rowspan="2" style="vertical-align:middle">{{$slot->trainer->name ?? ''}}</td>
                                                    <td rowspan="2" style="vertical-align:middle">{{$slot->whatsapp_group_name ?? ''}}</td>
                                                    <td rowspan="2" style="vertical-align:middle">{{$slot->rtc->rtc_name ?? ''}}</td>
                                                    @endif
                                                </tr>
                                                @php $i++; @endphp

                                                @endforeach

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
