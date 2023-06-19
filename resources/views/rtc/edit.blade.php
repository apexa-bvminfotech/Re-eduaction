@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-deck col-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div class="buttonAlign d-flex justify-content-between">
                                <h2 class="mb-1 page-title">Edit RTC</h2>
                                <a href="{{ route('rtc.index') }}" class="btn btn-primary float-right">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::model($rtc, ['method' => 'PUT','route' => ['rtc.update', $rtc->id]]) !!}
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC No</label>
                                <div class="col-sm-9">
                                    {!! Form::text('rtc_no', null, array('placeholder' => 'RTC No','class' => 'form-control')) !!}
                                </div>
                                @error('rtc_no')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Name</label>
                                <div class="col-sm-9">
                                    {!! Form::text('rtc_name', null, array('placeholder' => 'RTC Name','class' => 'form-control')) !!}
                                </div>
                                @error('rtc_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="address" placeholder="RTC Address"
                                              rows="2">{{ $rtc->address }}</textarea>
                                </div>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                <div class="col-sm-9 d-flex justify-content-evenly">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1"
                                               name="is_active" value="1"
                                               @if($rtc->is_active =='1') checked @endif>
                                        <label for="customRadio1" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-2">
                                        <input class="custom-control-input custom-control-input-danger" value="0"
                                               type="radio" id="customRadio4" name="is_active"
                                               @if($rtc->is_active =='0') checked @endif>
                                        <label for="customRadio4" class="custom-control-label">Deactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 buttonEnd">
                                <button type="submit" class="btn btn-success float-right mr-2">Edit</button>
                                <a href="{{ route('rtc.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
