@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Appreciation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('appreciation.index') }}">Show Appreciation List</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            {!! Form::open(array('route' => 'appreciation.store','method'=>'POST')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Course Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="course_id" required>
                                            <option value="">Select Course</option>
                                            @foreach($course as $key => $c)
                                                <option value="{{ $c->id }}" {{ old('course_id') == $c->id ? 'selected' : '' }}>{{ $c->course_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Appreciation Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="appreciation_name" class="form-control" placeholder="Enter appreciation name" value="{{ old('appreciation_name') }}" required>
                                    </div>
                                    @error('appreciation_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Create</button>
                                <a href="{{ route('appreciation.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
