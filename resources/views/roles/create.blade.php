@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-1 page-title">Create New Role</h3>
                                <a href="{{ route('roles.index') }}" class="btn btn-outline-dark float-right">Back</a>
                            </div>
                        </div>

                        <form action="{{route('roles.store')}}" method="POST">
                            <div class="card-body">
                                <div class="card-body">
                                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                                    <div class="form-group">
                                        <label for="inputEmail3">Role Name :</label>

                                            {!! Form::text('name', null, array('placeholder' => 'Enter Role Name','class' => 'form-control')) !!}

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2">Permission :</label>

                                        @foreach($permission->chunk(16) as $chunk)
                                            <div class="col-sm-4">
                                                @foreach ($chunk as $value)
                                                    <div class="form-check">
                                                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name ')) }}
                                                            {{ $value->name }}</label><br>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-fuchsia">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
