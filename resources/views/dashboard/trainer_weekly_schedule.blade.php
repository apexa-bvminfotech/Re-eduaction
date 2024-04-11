@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1>Trainer Weekly Schedule</h1>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <td>
                        <button class="btn btn-secondary btn-shift-regular-slot btn-sm mb-1 mt-1" data-toggle="modal"
                            data-target="#myModal" data-old-regular-slot-id data-old-regular-trainer-id>
                            Add Weekly Schedule
                        </button>

                    </td>
                    <div class="col-12">
                        <div class="card">
                            @foreach ($trainerData as $trainerName => $slots)
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">

                                        @php
                                            $startDate = now()->startOfWeek();
                                            $endDate = now()->endOfWeek();
                                            $checkDate = $startDate->format('Y-m-d');
                                            //dd($checkDate);
                                            $numberOfDays = 7;
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th colspan="7" style="background-color:lightgray; font-size:25px;"
                                                    class="text-center p-3"><b>{{ $trainerName }}</b></th>
                                            </tr>
                                            <tr>
                                                @for ($day = 1; $day <= $numberOfDays; $day++)
                                                    <th class="text-center p-3">
                                                        {{-- {{ $startDate->format('d-m-Y') }}<br> --}}
                                                        {{ $startDate->format('D') }}
                                                    </th>
                                                    @php
                                                        $startDate->addDay();
                                                    @endphp
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                @foreach ($slots as $slot)
                                                    @php
                                                        $startDate = now()->startOfWeek();
                                                        $endDate = now()->endOfWeek();
                                                        $checkDate = $startDate->format('Y-m-d');
                                                        //dd($checkDate);
                                                        $numberOfDays = 7;
                                                    @endphp

                                                @for ($day = 1; $day <= $numberOfDays; $day++)
                                                @if ($day <= 5)
                                                    <td class="text-center p-5"
                                                        style="background-color: lightgreen ;font-weight: bold">
                                                        Time :- {{ $slot['slot_time'] }}<br><br>
                                                        Rtc :- {{ $slot['rtc']}}<br><br>

                                                        @php
                                                            $activeStudentsCount = collect($slot['students'])->reject(function ($student) {
                                                                return $student['status'] == 'Hold';
                                                            })->count();
                                                        @endphp
                                                        Total Active Students: {{ $activeStudentsCount }}<br><br>
                                                        Watsapp Group Name :- {{$slot['whatsapp_group_name']}}<br>
                                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg{{ $slot['student_id'] }}">Student Details</button>

                                                          <div class="modal fade bd-example-modal-lg{{ $slot['student_id'] }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{ $slot['student_id'] }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">

                                                              <div class="modal-content" style="width: fit-content;">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">student Details</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Student Name</th>
                                                                                <th>Course</th>
                                                                                <th>Father Contact No</th>
                                                                                <th>Mother Contact No</th>
                                                                                <th>Course Start Date</th>
                                                                                <th>Standard</th>
                                                                                <th>Trainer Name</th>
                                                                                <th>Running Course</th>
                                                                                <th>Complete Course</th>
                                                                                <th>Pending Course</th>
                                                                                <th>Medium</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @php $noteNumber = 1; @endphp
                                                                            @foreach ($slot['students'] as $student)

                                                                                @if($student['status'] != 'Hold')
                                                                                    <tr>
                                                                                        <td style="font-weight: normal">{{ $noteNumber }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['name'] }} {{ $student['surname'] }}</td>
                                                                                        <td style="font-weight: normal">{{ implode(', ', array_unique($student['courses'])) }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['father_phone_no'] }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['mother_phone_no'] }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['student_courses'] }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['standard'] }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['trainer_name'] }}</td>
                                                                                        @php
                                                                                            $runningCourses = [];
                                                                                            $completeCourses = [];
                                                                                            $pendingCourses = [];
                                                                                        @endphp
                                                                                        @foreach ($student['courses'] as $key => $course)
                                                                                            @php
                                                                                                $status = $student['course_status'][$key];
                                                                                                if ($status == 'Running' && !in_array($course, $runningCourses)) {
                                                                                                    $runningCourses[] = $course;
                                                                                                } elseif ($status == 'Complete' && !in_array($course, $completeCourses)) {
                                                                                                    $completeCourses[] = $course;
                                                                                                } elseif ($status == 'Pending' && !in_array($course, $pendingCourses)) {
                                                                                                    $pendingCourses[] = $course;
                                                                                                }
                                                                                            @endphp
                                                                                        @endforeach
                                                                                        <td style="font-weight: normal">{{ implode(', ', $runningCourses) }}</td>
                                                                                        <td style="font-weight: normal">{{ implode(', ', $completeCourses) }}</td>
                                                                                        <td style="font-weight: normal">{{ implode(', ', $pendingCourses) }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['medium'] }}</td>
                                                                                    </tr>
                                                                                    @php $noteNumber++; @endphp
                                                                                @endif
                                                                                @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    </td>
                                                    @else
                                                    <td class="text-center p-5"
                                                    style="background-color: lightgreen ;font-weight: bold"></td>
                                                @endif
                                                @endfor

                                            </tr>
                            @endforeach
                            </tr>


                            <tr>
                                @foreach ($trainerDataProxy as $trainerNames => $slots)
                                    @if ($trainerName == $trainerNames)
                                        @foreach ($slots as $slot)
                                            @php
                                                $checkStartDate = now()->startOfWeek();
                                                $checkEndDate = now()->endOfWeek();
                                                $numberOfDays = 7;

                                            @endphp

                                            @for ($day = 1; $day <= $numberOfDays; $day++)

                                                @if ($checkStartDate->format('Y-m-d') >= $slot['startDate'] && $checkStartDate->format('Y-m-d') <= $slot['endDate'])

                                                    <td class="text-center p-5"
                                                        style="background-color: red ;font-weight: bold">
                                                        Proxy Slot Time :- {{ $slot['slot_time'] }}<br><br>
                                                        RTC:- {{$slot['rtc']}}<br><br>
                                                        WhatsApp Group :- {{$slot['whatsapp_group_name']}}<br><br>

                                                        Total Students :- {{ count($slot['students']) }}
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg{{ implode('', $slot['student_id']) }}">Student Details</button>

                                                        <div class="modal fade bd-example-modal-lg{{ implode('', $slot['student_id']) }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{ implode('', $slot['student_id']) }}" aria-hidden="true">
                                                          <div class="modal-dialog modal-lg">

                                                            <div class="modal-content" style="width: fit-content;">
                                                              <div class="modal-header">
                                                                  <h4 class="modal-title">student Details</h4>
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Student Name</th>
                                                                            <th>Course</th>
                                                                            <th>Course Start Date</th>
                                                                            <th>standard</th>
                                                                            <th>Father Contact No</th>
                                                                            <th>Mother Contact No</th>
                                                                            <th>Trainer Name</th>
                                                                            <th>Running Course</th>
                                                                            <th>Complete Course</th>
                                                                            <th>Pending Course</th>
                                                                            <th>Medium</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                                @foreach ($slot['students'] as $student)
                                                                                @if($student['status'] != 'Hold')
                                                                                <tr>
                                                                                        <td style="font-weight: normal">{{ $student['name'] }} {{ $student['surname'] }}</td>
                                                                                        <td style="font-weight: normal">{{ implode(', ', array_unique($student['courses'])) }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['student_courses'] }}</td>
                                                                                        <td style="font-weight: normal">{{ $student['standard'] }}</td>
                                                                                        <td style="font-weight: normal">{{$student['father_phone_no']}}</td>
                                                                                        <td style="font-weight: normal">{{$student['mother_phone_no']}}</td>
                                                                                        <td style="font-weight: normal">{{$student['trainer_name']}}</td>
                                                                                        @php
                                                                                                $runningCourses = [];
                                                                                                $completeCourses = [];
                                                                                                $pendingCourses = [];
                                                                                            @endphp
                                                                                            @foreach ($student['courses'] as $key => $course)
                                                                                            @php
                                                                                            $status = $student['course_status'][$key];
                                                                                            if ($status == 'Running' && !in_array($course, $runningCourses)) {
                                                                                                $runningCourses[] = $course;
                                                                                            } elseif ($status == 'Complete' && !in_array($course, $completeCourses)) {
                                                                                                $completeCourses[] = $course;
                                                                                            } elseif ($status == 'Pending' && !in_array($course, $pendingCourses)) {
                                                                                                $pendingCourses[] = $course;
                                                                                            }
                                                                                        @endphp
                                                                                            @endforeach
                                                                                            <td style="font-weight: normal">{{ implode(', ', $runningCourses) }}</td>
                                                                                            <td style="font-weight: normal">{{ implode(', ', $completeCourses) }}</td>
                                                                                            <td style="font-weight: normal">{{ implode(', ', $pendingCourses) }}</td>
                                                                                            <td style="font-weight: normal">{{ $student['medium'] }}</td>
                                                                                     </tr>
                                                                                     @endif
                                                                                @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                          </div>
                                                        </div>

                                                    </td>
                                                @else
                                                    <td class="text-center p-5">

                                                    </td>
                                                @endif
                                                @php
                                                    $checkStartDate->addDay();
                                                @endphp
                                            @endfor
                                        @endforeach
                                    @endif
                                @endforeach
                            </tr>

                            <tr>
                                @foreach ($userListWithTrinerData as $trainerNames => $slots)
                                    @if ($trainerName == $trainerNames)
                                        @php
                                            $checkStartDate = now()->startOfWeek();
                                            $checkEndDate = now()->endOfWeek();
                                            $numberOfDays = 7;
                                            $noteNumber = 1;
                                            $checkDate = $startDate->format('Y-m-d');
                                        @endphp
                                        @for ($day = 1; $day <= $numberOfDays; $day++)
                                            @php
                                                $applyStyle = false;
                                            @endphp

                                            @foreach ($slots as $s)
                                                @if ($checkStartDate->format('Y-m-d') == $s['date'] || $checkStartDate->format('D') == $s['day'])
                                                    @php
                                                        if ($s['note'] != null) {
                                                            $applyStyle = true;
                                                        }
                                                    @endphp
                                                @endif
                                            @endforeach

                                            <td class="text-center p-5"
                                                @if ($applyStyle) style="background-color: yellow; font-weight: bold;" @endif>
                                                @foreach ($slots as $s)

                                                    @if ($checkStartDate->format('Y-m-d') == $s['date'] || $checkStartDate->format('D') == $s['day'])
                                                        @if ($s['note'] != null)
                                                            Note:-{{ $noteNumber }} {{ $s['note'] }}<br><br>
                                                            Sloat Time:-{{ $s['slot_time'] }}

                                                            @foreach ($slotstime as $key => $slot)
                                                            @if ($slot->is_active == 0)
                                                                @if ($s['slot_id'] == $slot->id)
                                                                    <span>slot:-{{ $slot->slot_time }}</span>
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                            @php
                                                                $noteNumber++;
                                                            @endphp
                                                            <br>
                                                            @if(auth()->user()->type == 0)
                                                            <button type="button" class="btn btn-primary edit-slot"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $s['id'] }}">
                                                                Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $s['id'] }}">
                                                                Delete
                                                             </button>
                                                             @endif
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="editModal{{ $s['id'] }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="editModalLabel{{ $s['id'] }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editModalLa bel{{ $s['id'] }}">Edit
                                                                                Slot</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('sloatupdate', ['slotId' => $s['id']]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label for="note"
                                                                                        class="col-form-label">Note:</label>
                                                                                    <input type=""
                                                                                        class="form-control" id="note"
                                                                                        name="note"
                                                                                        value="{{ $s['note'] }}">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="note"
                                                                                        class="col-form-label">Day:</label>
                                                                                    <select name="day"
                                                                                        class="form-control" >
                                                                                        <option value="">------Select
                                                                                            day-----</option>
                                                                                        <option value="Mon"
                                                                                            {{ old('day', $s['day']) == 'Mon' ? 'selected' : '' }}>
                                                                                            MONDAY</option>
                                                                                        <option value="Tue"
                                                                                            {{ old('day', $s['day']) == 'Tue' ? 'selected' : '' }}>
                                                                                            TUESDAY</option>
                                                                                        <option value="Wed"
                                                                                            {{ old('day', $s['day']) == 'Wed' ? 'selected' : '' }}>
                                                                                            WEDNESDAY</option>
                                                                                        <option value="Thu"
                                                                                            {{ old('day', $s['day']) == 'Thu' ? 'selected' : '' }}>
                                                                                            THURSDAY</option>
                                                                                        <option value="Fri"
                                                                                            {{ old('day', $s['day']) == 'Fri' ? 'selected' : '' }}>
                                                                                            FRIDAY</option>
                                                                                        <option value="Sat"
                                                                                            {{ old('day', $s['day']) == 'Sat' ? 'selected' : '' }}>
                                                                                            SATURDAY</option>
                                                                                        <option value="Sun"
                                                                                            {{ old('day', $s['day']) == 'Sun' ? 'selected' : '' }}>
                                                                                            SUNDAY</option>
                                                                                    </select>
                                                                                </div>
                                                                                {{-- {{dd($s)}} --}}
                                                                                <div class="form-group">
                                                                                    <label for="triner"
                                                                                        class="col-form-label">Triner
                                                                                        Name:</label>
                                                                                    <select class="form-control select2 proxy_class select2 trainer_id"
                                                                                        name="trainer_id" >
                                                                                        <option value="">--- Select
                                                                                            Trainer ---</option>
                                                                                            @foreach ($trainershedule as $key => $trainer)
                                                                                            @if ($trainer->is_active == 0)
                                                                                                <option value="{{ $trainer->id }}" {{ $s['trainer_id'] == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="name">Slot: </label>
                                                                                    <select name="slot_id" class="form-control slot select2">
                                                                                        <option value="">------Select Slot-----</option>
                                                                                        @foreach ($slotstime as $key => $slot)
                                                                                            @if ($slot->is_active == 0)
                                                                                                <option value="{{ $slot->id }}"  {{ $s['slot_id'] == $slot->id ? 'selected' : '' }} data-slot-id="{{ $slot->id }}">
                                                                                                    {{ $slot->slot_time }}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                @php
                                                                                $time_parts = explode(' - ', $s['slot_time']);
                                                                                $slot_time_to = isset($time_parts[0]) ? $time_parts[0] : '';
                                                                                $slot_time_from = isset($time_parts[1]) ? $time_parts[1] : '';

                                                                                @endphp
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="inputEmail3" class="col-form-label">Slot Time:</label>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-5">
                                                                                            <div class="form-group">
                                                                                                <div>
                                                                                                    <input type="time"
                                                                                                           class="form-control "
                                                                                                           name="slot_time_to"
                                                                                                           value="{{  $slot_time_to }}"
                                                                                                           />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-2 mt-2"
                                                                                             style="display: flex;justify-content: space-around;">
                                                                                            <p>to</p>
                                                                                        </div>
                                                                                        <div class="col-sm-5">
                                                                                            <div class="form-group">
                                                                                                <div>
                                                                                                    <input type="time"
                                                                                                           class="form-control "
                                                                                                           name="slot_time_from"
                                                                                                           value="{{ $slot_time_from }}"
                                                                                                           />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>


                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Save
                                                                                    Changes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- End Edit Model --}}

                                                            {{-- Delete Model --}}
                                                                <div class="modal fade" id="deleteModal{{ $s['id'] }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="deleteModalLabel{{ $s['id'] }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="deleteModalLabel{{ $s['id'] }}">Delete
                                                                                    Slot</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{ route('delete.slot', ['slotId' => $s['id']]) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-body">
                                                                                        <p>Are you sure you want to delete?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            {{-- End Delete Model --}}

                                                        @endif
                                                    @endif
                                                @endforeach
                                                @php
                                                    // Reset noteNumber for each date
                                                    $noteNumber = 1;
                                                @endphp
                                            </td>

                                            @php
                                                $checkStartDate->addDay();
                                            @endphp
                                        @endfor
                                    @endif
                                @endforeach
   </tr>
                            </tbody>
                            </table>
                        </div>
                        @endforeach

                            @foreach ($userListWithTrinerData as $userName => $slots)
                                @if($trainerName != $userName)
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            @php
                                                $startDate = now()->startOfWeek();
                                                $endDate = now()->endOfWeek();
                                                $checkDate = $startDate->format('Y-m-d');
                                                $numberOfDays = 7;
                                            @endphp
                                            <thead>
                                                <tr>
                                                    <th colspan="7" style="background-color:lightgray; font-size:25px;"
                                                        class="text-center p-3"><b>{{ $userName }}</b></th>
                                                </tr>
                                                <tr>
                                                    @for ($day = 1; $day <= $numberOfDays; $day++)
                                                        <th class="text-center p-3">
                                                            {{ $startDate->format('D') }}
                                                        </th>
                                                        @php
                                                            $startDate->addDay();
                                                        @endphp

                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @php
                                                        $checkStartDate = now()->startOfWeek();
                                                        $checkEndDate = now()->endOfWeek();
                                                        $numberOfDays = 7;
                                                        $noteNumber = 1;
                                                        $checkDate = $startDate->format('Y-m-d');
                                                    @endphp

                                                    @for ($day = 1; $day <= $numberOfDays; $day++)
                                                        @php
                                                            $applyStyle = false;
                                                        @endphp

                                                        @foreach ($slots as $s)
                                                            @if ($checkStartDate->format('Y-m-d') == $s['date'] || $s['day'] == $checkStartDate->format('D'))
                                                                @php
                                                                    if ($s['note'] != null) {
                                                                        $applyStyle = true;
                                                                    }
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                        <td class="text-center p-5"
                                                            @if ($applyStyle) style="background-color: yellow; font-weight: bold;" @endif>
                                                            @foreach ($slots as $s)
                                                                @if ($checkStartDate->format('Y-m-d') == $s['date'] || $s['day'] == $checkStartDate->format('D'))
                                                                @if ($s['note'] != null)
                                                                Note:-{{ $noteNumber }} {{ $s['note'] }}<br><br>
                                                                Sloat Time:-{{ $s['slot_time'] }}<br><br>

                                                                @foreach ($slotstime as $key => $slot)
                                                                @if ($slot->is_active == 0)
                                                                    @if ($s['slot_id'] == $slot->id)
                                                                        <span>slot:-{{ $slot->slot_time }}</span><br><br>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                                        @php
                                                                            $noteNumber++;
                                                                        @endphp
                                                                    @if(auth()->user()->type == 0)
                                                                    <button type="button" class="btn btn-primary edit-slot"
                                                                        data-toggle="modal"
                                                                        data-target="#editModal{{ $s['id'] }}">
                                                                        Edit
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteModal{{ $s['id'] }}">
                                                                        Delete
                                                                        </button>
                                                                        @endif

                                                                    @endif
                                                                @endif

                                                            @endforeach
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="editModal{{ $s['id'] }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editModalLabel{{ $s['id'] }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editModalLa bel{{ $s['id'] }}">Edit
                                                                            Slot</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('sloatupdate', ['slotId' => $s['id']]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="note"
                                                                                    class="col-form-label">Note:</label>
                                                                                <input type=""
                                                                                    class="form-control" id="note"
                                                                                    name="note"
                                                                                    value="{{ $s['note'] }}">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="note"
                                                                                    class="col-form-label">Day:</label>
                                                                                <select name="day"
                                                                                    class="form-control" >
                                                                                    <option value="">------Select
                                                                                        day-----</option>
                                                                                    <option value="Mon"
                                                                                        {{ old('day', $s['day']) == 'Mon' ? 'selected' : '' }}>
                                                                                        MONDAY</option>
                                                                                    <option value="Tue"
                                                                                        {{ old('day', $s['day']) == 'Tue' ? 'selected' : '' }}>
                                                                                        TUESDAY</option>
                                                                                    <option value="Wed"
                                                                                        {{ old('day', $s['day']) == 'Wed' ? 'selected' : '' }}>
                                                                                        WEDNESDAY</option>
                                                                                    <option value="Thu"
                                                                                        {{ old('day', $s['day']) == 'Thu' ? 'selected' : '' }}>
                                                                                        THURSDAY</option>
                                                                                    <option value="Fri"
                                                                                        {{ old('day', $s['day']) == 'Fri' ? 'selected' : '' }}>
                                                                                        FRIDAY</option>
                                                                                    <option value="Sat"
                                                                                        {{ old('day', $s['day']) == 'Sat' ? 'selected' : '' }}>
                                                                                        SATURDAY</option>
                                                                                    <option value="Sun"
                                                                                        {{ old('day', $s['day']) == 'Sun' ? 'selected' : '' }}>
                                                                                        SUNDAY</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="triner"
                                                                                    class="col-form-label">Triner
                                                                                    Name:</label>
                                                                                <select class="form-control select2 proxy_class select2 trainer_id"
                                                                                    name="trainer_id" >
                                                                                    <option value="">--- Select
                                                                                        Trainer ---</option>
                                                                                        @foreach ($trainershedule as $key => $trainer)
                                                                                        @if ($trainer->is_active == 0)
                                                                                            <option value="{{ $trainer->id }}" {{ $s['trainer_id'] == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="name">Slot: </label>
                                                                                <select name="slot_id" class="form-control slot select2">
                                                                                    <option value="">------Select Slot-----</option>
                                                                                    @foreach ($slotstime as $key => $slot)
                                                                                        @if ($slot->is_active == 0)
                                                                                            <option value="{{ $slot->id }}"  {{ $s['slot_id'] == $slot->id ? 'selected' : '' }} data-slot-id="{{ $slot->id }}">
                                                                                                {{ $slot->slot_time }}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @php
                                                                            $time_parts = explode(' - ', $s['slot_time']);
                                                                            $slot_time_to = isset($time_parts[0]) ? $time_parts[0] : '';
                                                                            $slot_time_from = isset($time_parts[1]) ? $time_parts[1] : '';
                                                                            @endphp
                                                                            <div class="form-group col-md-12">
                                                                                <label for="inputEmail3" class="col-form-label">Slot Time:</label>
                                                                                <div class="row">
                                                                                    <div class="col-sm-5">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group date" id="timepicker2"
                                                                                                data-target-input="nearest">
                                                                                                <input type="time"
                                                                                                    class="form-control "
                                                                                                    name="slot_time_to"
                                                                                                    value="{{  $slot_time_to }}"
                                                                                                    />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-2 mt-2"
                                                                                        style="display: flex;justify-content: space-around;">
                                                                                        <p>to</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group date" id="timepicker3"
                                                                                                data-target-input="nearest">
                                                                                                <input type="time"
                                                                                                    class="form-control "
                                                                                                    name="slot_time_from"
                                                                                                    value="{{ $slot_time_from }}"
                                                                                                    />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Save
                                                                                Changes</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- End Edit Model --}}

                                                        {{-- Delete Model --}}
                                                            <div class="modal fade" id="deleteModal{{ $s['id'] }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="deleteModalLabel{{ $s['id'] }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="deleteModalLabel{{ $s['id'] }}">Delete
                                                                                Slot</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('delete.slot', ['slotId' => $s['id']]) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <div class="modal-body">
                                                                                    <p>Are you sure you want to delete?</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {{-- End Delete Model --}}
                                                        </div>

                                                            @php
                                                                // Reset noteNumber for each date
                                                                $noteNumber = 1;
                                                            @endphp
                                                        </td>
                                                        @php
                                                            $checkStartDate->addDay();
                                                        @endphp
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach


                        @if(auth()->user()->type == 0)
                        @foreach ($userScheduleList as $userName => $slots)
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    @php
                                        $startDate = now()->startOfWeek();
                                        $endDate = now()->endOfWeek();
                                        $checkDate = $startDate->format('Y-m-d');
                                        $numberOfDays = 7;
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th colspan="7" style="background-color:lightgray; font-size:25px;"
                                                class="text-center p-3"><b>{{ $userName }}</b></th>
                                        </tr>
                                        <tr>
                                            @for ($day = 1; $day <= $numberOfDays; $day++)
                                                <th class="text-center p-3">
                                                    {{-- {{ $startDate->format('d-m-Y') }}<br> --}}
                                                    {{ $startDate->format('D') }}
                                                </th>
                                                @php
                                                    $startDate->addDay();
                                                @endphp

                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @php
                                                $checkStartDate = now()->startOfWeek();
                                                $checkEndDate = now()->endOfWeek();
                                                $numberOfDays = 7;
                                                $noteNumber = 1;
                                                $checkDate = $startDate->format('Y-m-d');
                                            @endphp

                                            @for ($day = 1; $day <= $numberOfDays; $day++)
                                                @php
                                                    $applyStyle = false;
                                                @endphp

                                                @foreach ($slots as $s)
                                                    @if ($checkStartDate->format('Y-m-d') == $s['startDate'] || $s['day'] == $checkStartDate->format('D'))
                                                        @php
                                                            if ($s['note'] != null) {
                                                                $applyStyle = true;
                                                            }
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                <td class="text-center p-5"
                                                    @if ($applyStyle) style="background-color: yellow; font-weight: bold;" @endif>
                                                    @foreach ($slots as $s)
                                                        @if ($checkStartDate->format('Y-m-d') == $s['startDate'] || $s['day'] == $checkStartDate->format('D'))
                                                            @if ($s['note'] != null)
                                                                {{ $noteNumber }} {{ $s['note'] }}<br><br>
                                                                @php
                                                                    $noteNumber++;
                                                                @endphp
                                                                   <button type="button" class="btn btn-primary"
                                                                   data-toggle="modal"
                                                                   data-target="#editModal{{ $s['id'] }}">
                                                                   Edit
                                                               </button>

                                                            @endif
                                                        @endif

                                                    @endforeach
                                                    <div class="modal fade" id="editModal{{ $s['id'] }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="editModalLabel{{ $s['id'] }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $s['id'] }}">Edit
                                                                    Slot</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('sloatupdate', ['slotId' => $s['id']]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="note"
                                                                            class="col-form-label">Note:</label>
                                                                        <input type="text"
                                                                            class="form-control" id="note"
                                                                            name="note"
                                                                            value="{{ $s['note'] }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="note"
                                                                            class="col-form-label">Day:</label>
                                                                        <select name="day"
                                                                            class="form-control" >
                                                                            <option value="">------Select
                                                                                day-----</option>
                                                                            <option value="Mon"
                                                                                {{ old('day', $s['day']) == 'Mon' ? 'selected' : '' }}>
                                                                                MONDAY</option>
                                                                            <option value="Tue"
                                                                                {{ old('day', $s['day']) == 'Tue' ? 'selected' : '' }}>
                                                                                TUESDAY</option>
                                                                            <option value="Wed"
                                                                                {{ old('day', $s['day']) == 'Wed' ? 'selected' : '' }}>
                                                                                WEDNESDAY</option>
                                                                            <option value="Thu"
                                                                                {{ old('day', $s['day']) == 'Thu' ? 'selected' : '' }}>
                                                                                THURSDAY</option>
                                                                            <option value="Fri"
                                                                                {{ old('day', $s['day']) == 'Fri' ? 'selected' : '' }}>
                                                                                FRIDAY</option>
                                                                            <option value="Sat"
                                                                                {{ old('day', $s['day']) == 'Sat' ? 'selected' : '' }}>
                                                                                SATURDAY</option>
                                                                            <option value="Sun"
                                                                                {{ old('day', $s['day']) == 'Sun' ? 'selected' : '' }}>
                                                                                SUNDAY</option>
                                                                        </select>
                                                                    </div>

                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save
                                                                        Changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    @php
                                                        // Reset noteNumber for each date
                                                        $noteNumber = 1;
                                                    @endphp
                                                </td>
                                                @php
                                                    $checkStartDate->addDay();
                                                @endphp
                                            @endfor
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Weekly Slot Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="shiftRegularSlotForm" action="{{ route('get-slot-times') }}" method="POST">
                        @csrf
                        <div class="col-md-12 mb-1">
                            <label for="name">User Name: </label>
                            <select class="form-control select2 user_id" name="user_id" required>
                                <option value="0">------Select User-----</option>
                                @foreach ($users as $key => $user)
                                    @if ($user->is_active == 0)
                                        <option value="{{ $user->id }}" data-user-id="{{ $user->id }}">
                                            {{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="name">Trainer Name: </label>
                            <select class="form-control proxy_class select2 trainer_id" name="trainer_id" required>
                                <option value="0">------Select Trainer-----</option>
                                @foreach ($trainershedule as $key => $trainer)
                                    @if ($trainer->is_active == 0)
                                        <option value="{{ $trainer->id }}" data-trainer-id="{{ $trainer->id }}">
                                            {{ $trainer->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-1">
                            <label for="name">Slot: </label>
                            <select name="slot_id" class="form-control slot select2" required>
                                <option value="">------Select Slot-----</option>
                                @foreach ($slotstime as $key => $slot)
                                    @if ($slot->is_active == 0)
                                        <option value="{{ $slot->id }}" data-slot-id="{{ $slot->id }}">
                                            {{ $slot->slot_time }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="start_date">Date:</label>
                                <input type="date" class="form-control" name="date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label">SLOT
                                Time:</label>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="input-group date" id="timepicker"
                                             data-target-input="nearest">
                                            <input type="text"
                                                   class="form-control datetimepicker-input"
                                                   name="slot_time_to"
                                                   value="{{ old('slot_time_to') }}"
                                                   aria-describedby="button-addon2"
                                                   data-target="#timepicker"/>
                                            <div class="input-group-append"
                                                 data-target="#timepicker"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i
                                                        class="far fa-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"
                                     style="display: flex;justify-content: space-around;">
                                    <p>to</p>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="input-group date" id="timepicker1"
                                             data-target-input="nearest">
                                            <input type="text"
                                                   class="form-control datetimepicker-input"
                                                   name="slot_time_from"
                                                   value="{{ old('slot_time_from') }}"
                                                   aria-describedby="button-addon2"
                                                   data-target="#timepicker1"/>
                                            <div class="input-group-append"
                                                 data-target="#timepicker1"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i
                                                        class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="start_date">Day:</label>
                                <select name="day" class="form-control" required>
                                    <option value="">------Select Day-----</option>
                                    <option value="Mon">MONDAY</option>
                                    <option value="Tue">TUESDAY</option>
                                    <option value="Wed">WEDNESDAY</option>
                                    <option value="Thu">THURSDAY</option>
                                    <option value="Fri">FRIDAY</option>
                                    <option value="Sat">SATURDAY</option>
                                    <option value="Sun">SUNDAY</option>

                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="message-text" name="note"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary btn-submit-triner-slot"
                                data-dismiss="modal">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
            $(document).on('change', '.proxy_class', function() {

                let triner = ($(this).val());

                $.ajax({
                    url: 'shift-triner-slot/' + triner,
                    type: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        console.log("Slot display done.", data);
                        let slotOption = '<option value="">------Select Slot-----</option>';
                        $.each(data.slots, function(index, slot) {
                            slotOption += '<option value="' + slot.id + '">' + slot.slot_time +
                                '  (' + slot.rtc.rtc_name + ')</option>';
                        })
                        $('.slot').html("")
                        $('.slot').html(slotOption)
                    }
                });
            });

            $(document).on('click', '.btn-submit-triner-slot', function() {
                $('#shiftRegularSlotForm').submit();
            });
            $('#timepicker').datetimepicker({
                format: 'LT'
            })
            $('#timepicker1').datetimepicker({
                format: 'LT'
            })

            $(document).on('click', '.edit-slot', function() {
                console.log("timepicker model open");
            $('#timepicker2').datetimepicker({
                format: 'LT'
            });

            $('#timepicker3').datetimepicker({
                format: 'LT'
            });
            });


    </script>
@endpush
