@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit RTC</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('rtc.index') }}">Show RTC List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            {!! Form::model($rtc, ['method' => 'PUT','route' => ['rtc.update', $rtc->id]]) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Branch Name:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="branch_id" required>
                                            <option value="">Select Branch</option>
                                            @foreach($branch as $key => $b)
                                                <option
                                                    value="{{ $b->id }}" {{ $b->id == $rtc->branch_id ? "selected" : "" }}>{{ $b->name }}</option>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">RTC No</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="rtc_no" placeholder="Enter RTC no" value="{{ $rtc->rtc_no }}" class="form-control" >
                                        @error('rtc_no')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="rtc_name" placeholder="Enter RTC name" value="{{ $rtc->rtc_name }}" class="form-control" >
                                        @error('rtc_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" placeholder="RTC Address"
                                                  rows="2">{{ $rtc->address }}</textarea>
                                        @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Person Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="person_name" placeholder="name" class="form-control"
                                               value="{{$rtc->person_name}}">
                                        @error('person_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="contact" placeholder="12345 67890" value="{{$rtc->contact}}" class="form-control" pattern="[0-9]{5}[\s]{1}[0-9]{5}">
                                        @error('contact')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                    <div class="col-sm-9 d-flex justify-content-evenly">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1"
                                                   name="is_active" value="0"
                                                   @if($rtc->is_active =='0') checked @endif>
                                            <label for="customRadio1" class="custom-control-label">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-2">
                                            <input class="custom-control-input custom-control-input-danger" value="1"
                                                   type="radio" id="customRadio4" name="is_active"
                                                   @if($rtc->is_active =='1') checked @endif>
                                            <label for="customRadio4" class="custom-control-label">Deactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-success mr-2">Update</button>
                                <a href="{{ route('rtc.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
