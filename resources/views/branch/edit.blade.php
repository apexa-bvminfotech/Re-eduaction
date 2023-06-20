@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card-deck col-6">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-0 page-title">Edit Branch</h2>
                                    <a href="{{ route('branch.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::model($branch, ['method' => 'PATCH','route' => ['branch.update', $branch->id]]) !!}
                                <input type="hidden" name="branch_id" value="{{ $branch->branch_id }}">
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-md-12">--}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Name:</label>
                                            <input type="text" name="name" placeholder="name" value="{{ $branch->name }}" class="form-control" >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="address">Address:</label>
                                            <textarea name="address" class="form-control"
                                                      placeholder="enter address">{{ $branch->address }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Authorized Person Name:</label>
                                            <input type="text" name="authorized_person_name" placeholder="Enter Authorized Person Name" value="{{ $branch->authorized_person_name }}" class="form-control" >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Authorized Person Contact:</label>
                                            <input type="number" name="authorized_person_contact" placeholder="Enter Authorized Person Contact" value="{{ $branch->authorized_person_contact }}" class="form-control" onkeypress="return isNumber(event)" minlength="10"
                                                   maxlength="10" >
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-success float-right mr-2">Edit</button>
                                    <a href="{{ route('branch.index') }}"
                                       class="btn btn-danger float-right mr-2">Cancel</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
