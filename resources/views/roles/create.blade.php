@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Create New Role</h2>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
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
                <div class="card-deck col-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">Role Name</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-1">Permission</div>

                                    @foreach($permission->chunk(16) as $chunk)
                                        <div class="col-sm-4">
                                            @foreach ($chunk as $value)
                                            <div class="form-check">
                                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                        {{ $value->name }}</label><br>
                                            </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-primary mr-2">Create</button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->


@endsection
