@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Branch</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('branch.index') }}">Show Branch List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            {!! Form::open(array('route' => 'branch.store','method'=>'POST')) !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="simpleinput">Branch Name</label>
                                        <input type="text" name="name" placeholder="Enter branch name" value="{{ old('name') }}" class="form-control" required>
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Branch Address</label>
                                        <textarea name="address" class="form-control" placeholder="Enter branch address" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="simpleinput">Authorized Person Name</label>
                                        <input type="text" name="authorized_person_name" placeholder="Enter Authorized person name" value="{{ old('authorized_person_name') }}" class="form-control" >
                                        @error('authorized_person_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="simpleinput">Authorized Person Contact:</label>
                                        <input type="tel" name="authorized_person_contact" placeholder="1234567890" value="{{ old('authorized_person_contact') }}" class="form-control">
                                        @error('authorized_person_contact')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer justify-content-end d-flex" >
                                    <button type="submit" class="btn btn-primary mr-2">Create</button>
                                    <a href="{{ route('branch.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
