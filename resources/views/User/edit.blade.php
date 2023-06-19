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
                                <h2 class="mb-1 page-title">Edit User</h2>
                                    <a href="{{ route('user.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}
                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-md-12">--}}
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="name" value="{{ $user->name }}"
                                               class="form-control" required>
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{ $user->email }}"
                                               placeholder="email" class="form-control" required>
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Role name:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="role" required>
                                            <option value="">------Select Role------</option>
                                            @foreach($role as $key=> $r)
                                                <option
                                                    value="{{$r->id}}"
                                                    @if($user->roles->first()->id == $r->id) selected @endif>{{$r->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                    <div class="col-sm-9 d-flex justify-content-evenly">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1"
                                                   name="is_active" value="1"
                                                   @if($user->is_active =='1') checked @endif>
                                            <label for="customRadio1" class="custom-control-label">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-2">
                                            <input class="custom-control-input custom-control-input-danger" value="0"
                                                   type="radio" id="customRadio4" name="is_active"
                                                   @if($user->is_active =='0') checked @endif>
                                            <label for="customRadio4" class="custom-control-label">Deactive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 buttonEnd">
                                    <button type="submit" class="btn btn-success float-right mr-2">Edit</button>
                                    <a href="{{ route('user.index') }}"
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
