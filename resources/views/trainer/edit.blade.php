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
                                    <h2 class="mb-1 page-title">Edit Trainer</h2>
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
                                {!! Form::model($trainer, ['method' => 'PATCH','route' => ['trainer.update', $trainer->id]]) !!}
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Branch Name:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="branch_id" required>
                                            <option value="">--- Select Branch ---</option>
                                            @foreach($branch as $key => $b)
                                                <option value="{{ $b->id }}" {{$b->id == $trainer->id? 'selected' : ''}}>{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="simpleinput" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ $trainer->name }}"
                                                   placeholder="Name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-success float-right mr-2">Edit</button>
                                    <a href="{{ route('trainer.index') }}"
                                       class="btn btn-danger float-right mr-2">Cancel</a>
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

