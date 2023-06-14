@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
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
                                <h2 class="mb-0 page-title">Create New RTC</h2>
                                <a href="{{ route('rtc.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open(array('route' => 'rtc.store','method'=>'POST')) !!}
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC NO</label>
                                <div class="col-sm-9">
                                    {!! Form::text('rtc_no', null, array('placeholder' => 'RTC No','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Name</label>
                                <div class="col-sm-9">
                                    {!! Form::text('rtc_name', null, array('placeholder' => 'RTC Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">RTC Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="address" placeholder="RTC Address" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="form-group mt-3 mb-2 float-right">
                                <button type="submit" class="btn btn-primary mr-2">Create</button>
                                <a href="{{ route('rtc.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->


@endsection
