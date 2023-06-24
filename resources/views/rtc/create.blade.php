@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New RTC</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('rtc.index') }}">Show RTC List</a></li>
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
                            {!! Form::open(array('route' => 'rtc.store','method'=>'POST')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3">Branch Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="branch_id" required>
                                            <option value="">Select Branch</option>
                                            @foreach($branch as $key => $b)
                                                <option value="{{ $b->id }}" {{old('branch_id') == $b->id?'selected':''}}>{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="simpleinput" class="col-sm-3">RTC NO</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="rtc_no" placeholder="Enter RTC no" value="{{ old('rtc_no') }}" class="form-control" required>
                                        @error('rtc_no')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="simpleinput" class="col-sm-3">RTC Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="rtc_name" placeholder="Enter RTC name" value="{{ old('rtc_name') }}" class="form-control" required>
                                        @error('rtc_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3">RTC Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" placeholder="Enter RTC Address" rows="1"></textarea>
                                        @error('address')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3">Person Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="person_name" placeholder="Enter person name" value="{{ old('person_name') }}" class="form-control" required>
                                        @error('person_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="contact" placeholder="12345 67890" value="{{ old('contact') }}" class="form-control" pattern="[0-9]{5}[\s]{1}[0-9]{5}">
                                        @error('contact')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Status:</label>
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
