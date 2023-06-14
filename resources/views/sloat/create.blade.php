@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
{{--                <div class="buttonAlign">--}}
{{--                    <h2 class="mb-2 page-title">Create New Sloat</h2>--}}
{{--                    <a href="{{ route('sloat.index') }}" class="btn btn-primary">Back</a>--}}
{{--                </div>--}}
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
                        <div class="card-header">
                            <div class="buttonAlign d-flex justify-content-between">
                                <h2 class="mb-0 page-title">Create New Sloat</h2>
                                <a href="{{ route('sloat.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open(array('route' => 'sloat.store','method'=>'POST')) !!}
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Staff Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2"  name="staff_id" required>
                                        <option value="">--- Select Staff ---</option>
                                        @foreach($staff as $key => $s)
                                            <option value="{{ $s->id }}">{{ $s->staff_name }}</option>
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
                                            <option value="{{ $r->id }}">{{ $r->rtc_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Time</label>
                                <div class="col-sm-4">
                                    <input type="text" name="sloat_time_to" class="form-control time-input" autocomplete="off" placeholder="" aria-describedby="button-addon2" required>
                                </div>
                                <div class="col-sm-1" style="display: flex;justify-content: space-around;">
                                    <p>to</p>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="sloat_time_from" class="form-control time-input" autocomplete="off" placeholder="" aria-describedby="button-addon2" required>
                                </div>
                            </div>
                            <div class="form-group mt-2 mb-2 float-right">
                                <button type="submit" class="btn btn-primary mr-2">Create</button>
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
