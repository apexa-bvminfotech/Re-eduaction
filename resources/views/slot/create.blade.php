@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Slot</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('slot.index') }}">Show Slot List</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            {!! Form::open(array('route' => 'slot.store','method'=>'POST')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Branch Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 branch_id" name="branch_id"  required>
                                            <option value="">Select Branch</option>
                                            @foreach($branch as $key => $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Trainer Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 trainer_id" name="trainer_id" required>
                                            <option value="">Select Trainer</option>
                                        </select>
                                        @error('trainer_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 rtc_id" name="rtc_id" required>
                                            <option value="">Select RTC</option>
                                        </select>
                                        @error('rtc_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Time</label>
                                    <div class="col-sm-4">
                                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                   name="slot_time_to" value="{{ old('slot_time_to') }}"
                                                   aria-describedby="button-addon2" data-target="#timepicker">
                                            <div class="input-group-append" data-target="#timepicker"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            @error('slot_time_to')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-1" style="display: flex;justify-content: space-around;">
                                        <p>to</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group date" id="timepicker1" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                   name="slot_time_from" value="{{ old('slot_time_to') }}"
                                                   aria-describedby="button-addon2" data-target="#timepicker1"/>
                                            <div class="input-group-append" data-target="#timepicker1"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            @error('slot_time_from')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Whatsapp Group Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="whatsapp_group_name" class="form-control" placeholder="Enter whatsapp group name" value="{{ old('whatsapp_group_name') }}" required>
                                        @error('whatsapp_group_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9 d-flex justify-content-evenly">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1"
                                                   name="is_active" value="0" {{ old('is_active') == 0 ? 'checked' : '' }} checked>
                                            <label for="customRadio1" class="custom-control-label">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-2">
                                            <input class="custom-control-input custom-control-input-danger" value="1"
                                                   type="radio" id="customRadio4" name="is_active" {{ old('is_active') == 1 ? 'checked' : '' }}>
                                            <label for="customRadio4" class="custom-control-label">Deactive</label>
                                        </div>
                                        @error('status')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Create</button>
                                <a href="{{ route('slot.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
                        let trainerOption = '<option value="">Select Trainer</option>'
                        $.each(data.trainer, function (index, trainer) {
                            trainerOption += '<option value="' + trainer.id + '">' + trainer.name + '</option>'
                        })
                        $('.trainer_id').html("")
                        $('.trainer_id').html(trainerOption)

                        let rtcOption = '<option value="">Select Rtc</option>'
                        $.each(data.rtc, function (index, rtc) {
                            rtcOption += '<option value="' + rtc.id + '">' + rtc.rtc_name + '</option>'
                        })
                        $('.rtc_id').html("")
                        $('.rtc_id').html(rtcOption)
                    },

                    error :function( data ) {
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
