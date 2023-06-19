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
                            <h3 class="mb-1 page-title">Edit Role</h3>
                            <a href="{{ route('roles.index') }}" class="btn btn-outline-dark float-right">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="{{route('roles.update', $role->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="simpleinput">Role Name</label>
                            <input type="text" name="name" value="{{ $role->name }}" placeholder="Enter Role name" class="form-control" required>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2">Permission :</label>

                                    @foreach($permission->chunk(16) as $chunk)
                                        <div class="col-sm-4">
                                            @foreach ($chunk as $value)
                                                <div class="form-check">
                                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                        {{ $value->name }}</label><br/>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-fuchsia">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
