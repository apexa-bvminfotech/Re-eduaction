@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Branch</h1>
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
                            {!! Form::model($branch, ['method' => 'PATCH','route' => ['branch.update', $branch->id]]) !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="simpleinput">Branch Name</label>
                                        <input type="text" name="name" placeholder="Enter branch name" value="{{ $branch->name }}" class="form-control" >
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">Branch Address</label>
                                        <textarea name="address" class="form-control" placeholder="Enter branch address">{{ $branch->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Authorized Person Name:</label>
                                        <input type="text" name="authorized_person_name" placeholder="Enter authorized person name" value="{{ $branch->authorized_person_name }}" class="form-control" >
                                        @error('authorized_person_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Authorized Person Contact:</label>
                                        <input type="tel" name="authorized_person_contact" placeholder="12345 67890" value="{{ $branch->authorized_person_contact }}" class="form-control" pattern="[0-9]{5}[\s]{1}[0-9]{5}">

                                        @error('authorized_person_contact')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer justify-content-end d-flex" >
                                    <button type="submit" class="btn btn-success mr-2">Update</button>
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
