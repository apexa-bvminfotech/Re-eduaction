@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">Show Users List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/user/' . $user->user_profile)}}" alt="User profile picture" style="width: 150px;height: 150px;">
                                </div>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>User Type</b>
                                        <a class="float-right">
                                            @if($user->type == 0)
                                                {{ "Admin" }}
                                            @elseif($user->type == 1)
                                                {{ "Trainer" }}
                                            @elseif($user->type == 2)
                                                {{ "Student" }}
                                            @else
                                                {{ "Unknown" }}
                                            @endif
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Branch</b>
                                        <a class="float-right">
                                            @if($user->branch)
                                                {{$user->branch->name}}
                                            @endif
                                        </a>
                                    </li>
                                    <br>
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <div class="custom-file">
                                                <form action="{{ route('user.update-profile-image', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" class="custom-file-input" id="photoInput" name="new_profile_image" accept="image/*" style="display: none;" onchange="this.form.submit();">
                                                    <label for="photoInput" class="custom-file-label btn btn-success fa fa-edit"> Edit Profile</label>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2 d-flex">
                                <ul class="nav nav-pills col-11">
                                    <li class="nav-item"><a class="nav-link " href="#" data-toggle="tab">User Information</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body tab-content">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personal_info">
                                        <div class="col-md-12">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>Surname</th>
                                                        <td>{{$user->surname}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>User Name</th>
                                                        <td>{{$user->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Father Name</th>
                                                        <td>{{$user->father_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email address</th>
                                                        <td>{{$user->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Contact Information</th>
                                                        <td>{{$user->contact}}</td>
                                                    </tr>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

