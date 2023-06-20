@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-deck col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div class="buttonAlign d-flex justify-content-between">
                                <h2 class="mb-1 page-title">Edit Slot</h2>
                                <a href="{{ route('slot.index') }}" class="btn btn-primary float-right">Back</a>
                            </div>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            {!! Form::model($slot, ['method' => 'PATCH','route' => ['slot.update', $slot->id]]) !!}
                            <div class="form-group row">
                                <label for="inputtext" class="col-sm-3 col-form-label">Branch Name:</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 branch_id" name="branch_id" required>
                                        <option value="">--- Select Branch ---</option>
                                        @foreach($branch as $key => $b)
                                            <option
                                                value="{{ $b->id }}" {{ $b->id == $slot->branch_id ? "selected" : "" }}>{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Trainer Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 trainer_id" name="trainer_id" required>
                                        <option value="">--- Select Trainer ---</option>
                                        @foreach($trainer as $key => $t)
                                            <option
                                                value="{{ $t->id }}" {{ $t->id == $slot->trainer_id ? "selected" : "" }}>{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 rtc_id" name="rtc_id" required>
                                        <option value="">--- Select RTC ---</option>
                                        @foreach($rtc as $key => $r)
                                            <option
                                                value="{{ $r->id }}" {{ $r->id == $slot->rtc_id ? "selected" : "" }}>{{ $r->rtc_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Time</label>
                                @php
                                    $seprateTime = explode('-', $slot->slot_time);
                                @endphp
                                <div class="col-sm-4">
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               name="slot_time_to" value="{{ $seprateTime[0] }}"
                                               aria-describedby="button-addon2" data-target="#timepicker"/>
                                        <div class="input-group-append" data-target="#timepicker"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1" style="display: flex;justify-content: space-around;">
                                    <p>to</p>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group date" id="timepicker1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               name="slot_time_from" value="{{ $seprateTime[1] }}"
                                               aria-describedby="button-addon2" data-target="#timepicker1"/>
                                        <div class="input-group-append" data-target="#timepicker1"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext" class="col-sm-3 col-form-label">Whatsapp Group Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="whatsapp_group_name" class="form-control" value="{{$slot->whatsapp_group_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                <div class="col-sm-9 d-flex justify-content-evenly">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1"
                                               name="is_active" value="1"
                                               @if($slot->is_active =='1') checked @endif>
                                        <label for="customRadio1" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-2">
                                        <input class="custom-control-input custom-control-input-danger" value="0"
                                               type="radio" id="customRadio4" name="is_active"
                                               @if($slot->is_active =='0') checked @endif>
                                        <label for="customRadio4" class="custom-control-label">Deactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 buttonEnd">
                                <button type="submit" class="btn btn-success float-right mr-2">Edit</button>
                                <a href="{{ route('slot.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })
            $('#timepicker1').datetimepicker({
                format: 'LT'
            })
            $(document).on('change','.branch_id',function (){
                $.ajax({
                    type: "GET",
                    url: "{{route('get-trainer-data') }}",
                    data: {
                        branch_id:$(this).val(),
                        _token:"{{csrf_token()}}"
                    },
                    success: function(data) {
                        console.log("Data Check RTC.", data.rtc);
                        console.log("Data Check Trainer.", data.trainer);
                        let trainerOption = '<option value="">------Select Trainer-----</option>'
                        $.each(data.trainer, function (index, trainer) {
                            trainerOption += '<option value="' + trainer.id + '">' + trainer.name + '</option>'
                        })
                        $('.trainer_id').html("")
                        $('.trainer_id').html(trainerOption)

                        let rtcOption = '<option value="">------Select Rtc-----</option>'
                        $.each(data.rtc, function (index, rtc) {
                            rtcOption += '<option value="' + rtc.id + '">' + rtc.rtc_name + '</option>'
                        })
                        $('.rtc_id').html("")
                        $('.rtc_id').html(rtcOption)
                    },

                    error :function( data ) {
                        console.log(data.status)
                        if(data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors.errors, function (key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                    }
                });

            });
        })
    </script>
@endpush
