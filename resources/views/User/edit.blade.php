@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Edit User</h2>
                    <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
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
                <div class="row">
                    <div class="card-deck col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Form controls</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}
                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Name:</label>
                                            <input type="text" name="name" placeholder="name" value="{{ $user->name }}"
                                                   class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Email:</label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                   placeholder="email" class="form-control" required>
                                        </div>
                                        <div class="col-md-3 mb-1">
                                            <label for="role">Role name:</label>
                                            <select class="form-control select2" name="role" required>
                                                <option value="">------Select Role------</option>
                                                @foreach($role as $key=> $r)
                                                    <option
                                                        value="{{$r->id}}" @if($user->roles->first()->id == $r->id) selected @endif>{{$r->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 buttonEnd">
                                <button type="submit" class="btn btn-primary mr-2">Edit</button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
    <!-- .container-fluid -->

@endsection
