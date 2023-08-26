@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Course Material</h1>
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            {!! Form::model($courseMaterial, ['route' => ['course_material.update', $courseMaterial->id], 'method' => 'PUT']) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Course Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="course_name" required>
                                            <option value="">Select Course</option>
                                            @foreach($course as $key => $c)
                                                <option value="{{ $c->id }}" {{ $courseMaterial->course_id == $c->id ? 'selected' : '' }}>{{ $c->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Medium</label>
                                    <div class="col-sm-9">
{{--                                        <pre>{{ dd($courseMaterial->medium) }}</pre>--}}
                                        <select class="form-control select2" name="medium" required>
                                            <option value="">Select Medium</option>

                                            <option value="gujarati"{{ $courseMaterial->medium == 'gujarati' ? 'selected' : '' }}>Gujarati</option>
                                            <option value="hindi"{{ $courseMaterial->medium == 'hindi' ? 'selected' : '' }}>Hindi</option>
                                            <option value="english"{{ $courseMaterial->medium == 'english' ? 'selected' : '' }}>English</option>
                                            <option value="gujlish"{{ $courseMaterial->medium == 'gujlish' ? 'selected' : '' }}>Gujlish</option>
                                            <option value="other"{{ $courseMaterial->medium == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-3 col-form-label">Material Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="material_name" class="form-control" placeholder="Enter Material name" value="{{ $courseMaterial->material_name }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
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
