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
                                    <h2 class="mb-0 page-title">Create New User</h2>
                                        <a href="{{ route('user.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(array('route' => 'user.store','method'=>'POST')) !!}
                                <div class="form-group row">
                                    <label for="surname" class="col-sm-3 col-form-label">Surname:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="surname" placeholder="Enter Surname" value="{{ old('surname') }}"
                                               class="form-control" >
                                        @error('surname')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="Enter Your Name" value="{{ old('name') }}"
                                               class="form-control" >
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="father_name" class="col-sm-3 col-form-label">Father Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="father_name" placeholder="Enter Father Name" value="{{ old('father_name') }}"
                                               class="form-control" >
                                        @error('father_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                               placeholder="Enter Email" class="form-control" >
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="simpleinput" class="col-sm-3 col-form-label">Contact:</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="contact" placeholder="Enter Contact" value="{{ old('contact') }}" class="form-control" onkeypress="return isNumber(event)" minlength="10"
                                           maxlength="10" >
                                        @error('contact')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Role name:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="role" >
                                            <option value="">------Select Role------</option>
                                            @foreach($role as $key=> $r)
                                                <option
                                                    value="{{$r->id}}"{{old('role')==$r->id?'selected':''}}>{{$r->name}}</option>
                                            @endforeach
                                        </select>
                                        @error("role")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Branch:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="branch_id" >
                                            <option value="">-------------Select Branch------------</option>
                                            @foreach($branches as $key=> $branch)
                                                <option value="{{$branch->id}}" {{old('branch')==$branch->id?'selected':''}}>{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('branch_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                    <div class="col-sm-9 d-flex justify-content-evenly">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1"
                                                   name="is_active" value="1">
                                            <label for="customRadio1" class="custom-control-label">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-2">
                                            <input class="custom-control-input custom-control-input-danger" value="0"
                                                   type="radio" id="customRadio4" name="is_active">
                                            <label for="customRadio4" class="custom-control-label">Deactive</label>
                                        </div>&nbsp;
                                        @error('is_active')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 buttonEnd">
                                <button type="submit" class="btn btn-success float-right mr-2">Create</button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .col-12 -->
    </div> <!-- .row -->

@endsection
