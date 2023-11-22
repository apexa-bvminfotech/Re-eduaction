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
                        <button class="btn btn-secondary btn-shift-regular-slot btn-sm mb-1 mt-1"
                            data-toggle="modal" data-target="#myModal"
                            data-old-regular-slot-id data-old-regular-trainer-id>
                            Add Weekly Schedule
                        </button>
                    </td>
                    <div class="col-12">
                        <div class="card">

                            @foreach($trainerData as $trainerName => $slots)
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        @php
                                            $startDate = now()->startOfWeek();
                                            $endDate = now()->endOfWeek();
                                            $checkDate = $startDate->format('Y-m-d');
                                            $numberOfDays = 6;
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th colspan="6"  style="background-color:lightgray; font-size:25px;" class="text-center p-3"><b>{{ $trainerName }}</b></th>
                                            </tr>
                                            <tr>
                                                @for ($day = 1; $day <= $numberOfDays; $day++)
                                                    <th class="text-center p-3">
                                                        {{ $startDate->format('d-m-Y') }}<br>
                                                        {{ $startDate->format('D') }}
                                                    </th>
                                                    @php
                                                        $startDate->addDay();
                                                    @endphp
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @php
                                                $sDate = now()->startOfMonth();
                                                $eDate = now()->endOfMonth();
                                                $numberOfDays = 6;
                                            @endphp --}}
                                            <tr>
                                                @foreach ($slots as $slot)
                                                    <tr>
                                                        @for ($day = 1; $day <= $numberOfDays; $day++)
                                                            <td class="text-center p-5">
                                                                Slot Time :- {{ $slot['slot_time'] }}<br><br>
                                                                Total Students :- {{ count($slot['students']) }}
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tr>
                                            <tr>

                                                @foreach($trainerDataProxy as $trainerNames => $slots)
                                                @if($trainerName == $trainerNames)
                                                @foreach ($slots as $slot)
                                                    @php
                                                        $checkStartDate = now()->startOfWeek();
                                                        $checkEndDate = now()->endOfWeek();
                                                        $numberOfDays = 6;
                                                    @endphp

                                                    @for ($day = 1; $day <= $numberOfDays; $day++)
                                                        @if($checkStartDate->format('Y-m-d') >= $slot['startDate'] && $checkStartDate->format('Y-m-d')<=$slot['endDate'])
                                                            <td class="text-center p-5" style="background-color: red ;font-weight: bold">
                                                              Proxy Slot Time :- {{ $slot['slot_time'] }}<br><br>
                                                                Total Students :- {{ count($slot['students']) }}
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
                                            @foreach($userListWithTrinerData as $trainerNames => $slots)
                                            @foreach ($slots as $slot)
                                             @if($trainerName == $trainerNames)
                                                @php
                                                $checkStartDate = now()->startOfWeek();
                                                $checkEndDate = now()->endOfWeek();
                                                $numberOfDays = 6;
                                               @endphp
                                                    @for ($day = 1; $day <= $numberOfDays; $day++)
                                                        @if($checkStartDate->format('Y-m-d') == $slot['date'])
                                                            <td class="text-center p-5"  style="background-color: yellow ;font-weight: bold">
                                                              Note :- {{ $slot['note'] }}<br><br>

                                                            </td>
                                                        @else
                                                            <td class="text-center p-5" >

                                                            </td>
                                                        @endif
                                                        @php
                                                            $checkStartDate->addDay();
                                                        @endphp
                                                    @endfor
                                                </tr>
                                                @endif
                                                @endforeach
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach

                            @foreach($userScheduleList as $userName => $slots)

                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    @php
                                        $startDate = now()->startOfWeek();
                                        $endDate = now()->endOfWeek();
                                        $checkDate = $startDate->format('Y-m-d');
                                        $numberOfDays = 6;
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th colspan="6"  style="background-color:lightgray; font-size:25px;" class="text-center p-3"><b>{{ $userName }}</b></th>
                                        </tr>
                                        <tr>
                                            @for ($day = 1; $day <= $numberOfDays; $day++)
                                                <th class="text-center p-3">
                                                    {{ $startDate->format('d-m-Y') }}<br>
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
                                                $numberOfDays = 6;
                                                $noteNumber = 1;
                                            @endphp
                                            @for ($day = 1; $day <= $numberOfDays; $day++)
                                                @php
                                                    $matchingSlot = null;
                                                    foreach ($slots as $s) {
                                                        if ($checkStartDate->format('Y-m-d') == $s['startDate']) {
                                                            $matchingSlot = $s;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                @if ($matchingSlot)
                                                    <td class="text-center p-5" style="background-color: yellow; font-weight: bold">
                                                        {{ $noteNumber }} {{ $matchingSlot['note'] }}<br><br>
                                                        @php $noteNumber++; @endphp
                                                    </td>
                                                @else
                                                    <td class="text-center p-5">

                                                    </td>
                                                @endif
                                                @php
                                                     $noteNumber = 1;
                                                     $checkStartDate->addDay();
                                                @endphp
                                            @endfor
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        @endforeach
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
                            @foreach($users as $key =>$user)
                                @if($user->is_active == 0)
                                <option value="{{$user->id}}" data-user-id="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-1">
                        <label for="name">Trainer Name: </label>
                        <select class="form-control proxy_class select2 trainer_id" name="trainer_id" required>
                            <option value="0">------Select Trainer-----</option>
                            @foreach($trainershedule as $key =>$trainer)
                                @if($trainer->is_active == 0)
                                <option value="{{$trainer->id}}" data-trainer-id="{{$trainer->id}}">{{$trainer->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-1">
                        <label for="name">Slot: </label>
                        <select name="slot_id" class="form-control slot select2" required>
                            <option value="">------Select Slot-----</option>
                            @foreach($slotstime as $key => $slot)
                                @if($slot->is_active == 0)
                                    <option value="{{$slot->id}}" data-slot-id="{{$slot->id}}">{{$slot->slot_time}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-1">
                        <div class="form-group">
                            <label for="start_date">Date:</label>
                            <input type="date" class="form-control" name="date"
                                   value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                        </div>
                    </div>

                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Note:</label>
                      <textarea class="form-control" id="message-text" name="note"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary btn-submit-triner-slot" data-dismiss="modal">Submit</button>
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

$(document).on('change', '.proxy_class', function () {

            let triner = ($(this).val());

            $.ajax({
                url: 'shift-triner-slot/' + triner,
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
        });
    $(document).on('click', '.btn-submit-triner-slot', function () {
        $('#shiftRegularSlotForm').submit();
    });
</script>

@endpush


