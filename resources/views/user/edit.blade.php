@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
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
                            {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <input type="hidden" name="role" id="role" value="1">
                                    <label for="customFile" class="col-sm-3 col-form-label">Profile Photo</label>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input filePhoto" id="customFile" name="user_profile" value="{{$user->user_profile}}" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose Profile Photo</label>
                                        </div>
                                        <div id="editImageContainer">
                                            @if(file_exists(asset('assets/user/' . $user->user_profile)))
                                                <img src="{{asset('assets/user/' . $user->user_profile)}}" width="100" height="100">
                                            @else
                                                <img src="{{asset('assets/student/images/dummy-profile.jpeg' )}}" width="100" height="100">
                                            @endif
                                        </div>
                                        <div style="display: none;" id="imageContainer">
                                            <img id="previewHolder" alt="Uploaded Image Preview Holder" width="100px" height="100px"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="surname" class="col-sm-3 col-form-label">Surname </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="surname" placeholder="Enter your surname" value="{{ $user->surname }}" class="form-control" required>
                                        @error('surname')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="Enter your name" value="{{ $user->name }}" class="form-control" required>
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="father_name" placeholder="Enter father name" value="{{ $user->father_name }}" class="form-control" required>
                                        @error('father_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{ $user->email }}" placeholder="email" class="form-control">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="password"  placeholder="Enter your password" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="simpleinput" class="col-sm-3 col-form-label">Contact:</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="contact" placeholder="1234567890" value="{{ $user->contact }}" class="form-control">
                                        @error('contact')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Branch:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="branch_id" >
                                            <option value="">Select Branch</option>
                                            @foreach($branches as $key=> $branch)
                                                <option value="{{$branch->id}}"{{old('branch',$user->branch_id)==$branch->id?'selected':''}}>{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('branch')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Role </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="role">
                                            <?php $checkarray = [strtolower('admin'), strtolower('Sub-Admin')]
                                            ?>
                                            <option value="">Select Role</option>
                                            @foreach($role as $key => $roles)
                                                @if(in_array(strtolower($roles->name), $checkarray))
                                                    <option value="{{ $roles->id }}" {{ old('role') == $roles->name ? 'selected' : '' }}>
                                                        {{ $roles->name }}
                                                    </option>
                                                @endif
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
                                                   name="is_active" value="0"
                                                   @if($user->is_active =='0') checked @endif>
                                            <label for="customRadio1" class="custom-control-label">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-2">
                                            <input class="custom-control-input custom-control-input-danger" value="1"
                                                   type="radio" id="customRadio4" name="is_active"
                                                   @if($user->is_active =='1') checked @endif>
                                            <label for="customRadio4" class="custom-control-label">Deactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-success mr-2">Update</button>
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
            $('#editImageContainer').css('display','none');
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
