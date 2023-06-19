@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-deck col-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div class="buttonAlign d-flex justify-content-between">
                                <h2 class="mb-1 page-title">Create New Sloat</h2>
                                <a href="{{ route('sloat.index') }}" class="btn btn-primary float-right">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open(array('route' => 'sloat.store','method'=>'POST')) !!}
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Staff Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="staff_id" required>
                                        <option value="">--- Select Staff ---</option>
                                        @foreach($staff as $key => $s)
                                            <option value="{{ $s->id }}">{{ $s->staff_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('staff_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="rtc_id" required>
                                        <option value="">--- Select RTC ---</option>
                                        @foreach($rtc as $key => $r)
                                            <option value="{{ $r->id }}">{{ $r->rtc_name }}</option>
                                        @endforeach
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
                                               name="sloat_time_to"
                                               aria-describedby="button-addon2" data-target="#timepicker"/>
                                        <div class="input-group-append" data-target="#timepicker"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        @error('sloat_time_to')
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
                                               name="sloat_time_from"
                                               aria-describedby="button-addon2" data-target="#timepicker1"/>
                                        <div class="input-group-append" data-target="#timepicker1"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        @error('sloat_time_from')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                <div class="col-sm-9 d-flex justify-content-evenly">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1"
                                               name="is_active" value="1">
                                        <label for="customRadio1" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-2">
                                        <input class="custom-control-input custom-control-input-danger" value="0"
                                               type="radio" id="customRadio4" name="is_active">
                                        <label for="customRadio4" class="custom-control-label">Deactive</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2 buttonEnd">
                                <button type="submit" class="btn btn-success float-right mr-2">Create</button>
                                <a href="{{ route('sloat.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
        })
    </script>
@endpush
