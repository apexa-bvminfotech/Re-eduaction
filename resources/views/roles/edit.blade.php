@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Show Roles List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary">
                            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputEmail3">Role Name</label>
                                    <input type="text" name="name" placeholder="Enter role name" value="{{ $role->name }}" class="form-control col-md-6" required>
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Permission</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="toggle(this);">
                                        <label class="form-check-label" for="exampleCheck1">Select All</label>
                                    </div>
                                    <br>
                                    <div class="row">
                                        @foreach($permission->chunk(count($permission) / 3) as $chunk)
                                            <div class="col-sm-4">
                                                @foreach ($chunk as $value)
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input  name="permission[]" class="custom-control-input" type="checkbox" id="customCheckbox{{ $value->id }}" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                        <label for="customCheckbox{{ $value->id }}" class="custom-control-label">{{ $value->name }}</label><br>
                                                    </div>
                                                @endforeach

                                            </div>
                                        @endforeach
                                    </div>
                                    @error('permission')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endpush
