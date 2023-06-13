@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Edit Sloat</h2>
                    <a href="{{ route('sloat.index') }}" class="btn btn-primary">Back</a>
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
                <div class="card-deck col-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            {!! Form::model($sloat, ['method' => 'PATCH','route' => ['sloat.update', $sloat->id]]) !!}
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Staff Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2"  name="staff_id" required>
                                        <option value="">--- Select Staff ---</option>
                                        @foreach($staff as $key => $s)
                                            <option value="{{ $s->id }}" {{ $s->id == $sloat->staff_id ? "selected" : "" }}>{{ $s->staff_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="rtc_id" required>
                                        <option value="">--- Select RTC ---</option>
                                        @foreach($rtc as $key => $r)
                                            <option value="{{ $r->id }}" {{ $r->id == $sloat->rtc_id ? "selected" : "" }}>{{ $r->rtc_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Time</label>
                                @php
                                    $seprateTime = explode('-', $sloat->sloat_time);
                                @endphp
                                <div class="col-sm-4">
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               name="sloat_time_to" value="{{ $seprateTime[0] }}"
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
                                               name="sloat_time_from" value="{{ $seprateTime[1] }}"
                                               aria-describedby="button-addon2" data-target="#timepicker1"/>
                                        <div class="input-group-append" data-target="#timepicker1"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 buttonEnd">
                                <button type="submit" class="btn btn-primary mr-2">Edit</button>
                                <a href="{{ route('sloat.index') }}" class="btn btn-danger">Cancel</a>
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
