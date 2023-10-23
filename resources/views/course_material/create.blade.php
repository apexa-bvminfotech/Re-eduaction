@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Course Material</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('course_material.index') }}">Show Material List</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            {!! Form::open(array('route' => 'course_material.store','method'=>'POST')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Course Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="course_name" required>
                                            <option value="">Select Course</option>
                                            @foreach($course as $key => $c)
                                                <option value="{{ $c->id }}" {{ old('course_name') == $c->id ? 'selected' : '' }}>{{ $c->course_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('course_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Medium</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="medium" required>
                                            <option value="">Select Medium</option>
                                            <option value="gujarati" {{ old('medium') == 'gujarati' ? 'selected' : '' }}>Gujarati</option>
                                            <option value="hindi" {{ old('medium') == 'hindi' ? 'selected' : '' }}>Hindi</option>
                                            <option value="english" {{ old('medium') == 'english' ? 'selected' : '' }}>English</option>
                                            <option value="gujlish" {{ old('medium') == 'gujlish' ? 'selected' : '' }}>Gujlish</option>
                                        </select>
                                    </div>
                                    @error('medium')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Material Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="material_name" class="form-control" placeholder="Enter Material name" value="{{ old('material_name') }}" required>
                                        @error('material_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Create</button>
                                <a href="{{ route('course_material.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
