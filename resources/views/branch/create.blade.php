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
                <div class="row">
                    <div class="card-deck col-6">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">Create New Branch</h2>
                                    <a href="{{ route('branch.index') }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(array('route' => 'branch.store','method'=>'POST')) !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Name:</label>
                                            <input type="text" name="name" placeholder="name" value="{{ old('name') }}" class="form-control" >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="address">Address:</label>
                                            <textarea name="address" class="form-control"
                                                      placeholder="enter address">{{ old('address') }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Authorized Person Name:</label>
                                            <input type="text" name="authorized_person_name" placeholder="Enter Authorized Person Name" value="{{ old('authorized_person_name') }}" class="form-control" >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Authorized Person Contact:</label>
                                            <input type="number" name="authorized_person_contact" placeholder="Enter Authorized Person Contact" value="{{ old('authorized_person_contact') }}" class="form-control" onkeypress="return isNumber(event)" minlength="10"
                                                   maxlength="10" >
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-group mb-2  float-right">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success mr-2">Create</button>
                                        <a href="{{ route('branch.index') }}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
