@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card-deck col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <div class="buttonAlign d-flex justify-content-between">
                                    <h2 class="mb-1 page-title">Create New Trainer</h2>
                                    <a href="{{ route('trainer.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
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
                            <div class="card-body">
                                {!! Form::open(array('route' => 'trainer.store','method'=>'POST')) !!}
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Branch Name:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="branch_id" required>
                                            <option value="">--- Select Branch ---</option>
                                            @foreach($branch as $key => $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="simpleinput" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                   placeholder="name" class="form-control" required>
                                            @error('status')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-success float-right mr-2">Create</button>
                                    <a href="{{ route('trainer.index') }}"
                                       class="btn btn-danger float-right mr-2">Cancel</a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div> <!-- .col-12 -->
    <!-- .row -->
    <!-- .container-fluid -->

@endsection
