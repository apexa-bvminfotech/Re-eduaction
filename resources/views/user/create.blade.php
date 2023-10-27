@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">Show Users List</a></li>
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
                            {!! Form::open(array('route' => 'user.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="customFile" class="col-sm-3 col-form-label">Profile Photo</label>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input filePhoto" id="customFile" name="user_profile" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose Profile Photo</label>   
                                        </div>
                                        <div style="display: none;" id="imageContainer">
                                            <img id="previewHolder" alt="Uploaded Image Preview Holder"  width="100" height="100"/>
                                        </div>
                                        @error('user_profile')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="surname" class="col-sm-3 col-form-label">Surname</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="surname" placeholder="Enter your surname" value="{{ old('surname') }}" class="form-control" >
                                        @error('surname')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}" class="form-control" >
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="father_name" placeholder="Enter father name" value="{{ old('father_name') }}" class="form-control" >
                                        @error('father_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" class="form-control" required>
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" value="{{ old('password') }}" placeholder="Enter your password" class="form-control" >
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="simpleinput" class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="contact" placeholder="1234567890" value="{{ old('contact') }}" class="form-control">
                                        @error('contact')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Branch </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="branch_id">
                                            <option value=""> Select Branch </option>
                                            @foreach($branches as $key=> $branch)
                                                <option value="{{$branch->id}}" {{old('branch_id')==$branch->id?'selected':''}}>{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('branch_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status </label>
                                    <div class="col-sm-9 d-flex justify-content-evenly">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="is_active" value="0" required @if(old('is_active') == '0') checked @endif>
                                            <label for="customRadio1" class="custom-control-label">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-2">
                                            <input class="custom-control-input custom-control-input-danger" value="1" type="radio" id="customRadio4" name="is_active" required @if(old('is_active') == '1') checked @endif>
                                            <label for="customRadio4" class="custom-control-label">Deactive</label>
                                        </div>&nbsp;
                                        @error('is_active')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Create</button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger">Cancel</a>
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
        //script for image preview
        function readURL(input) {
            $('#imageContainer').css('display','block');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewHolder').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert('select a file to see preview');
                $('#previewHolder').attr('src', '');
            }
        }

        $(".filePhoto").change(function() {
            readURL(this);
        });

    </script>
@endpush
