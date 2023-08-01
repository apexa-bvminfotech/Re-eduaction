@extends('layouts.admin')
@section('content')

    <div class="card card-primary card-outline container">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{asset('assets/img/pngImage.png')}}"
                     alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">Nina Mcintire</h3>

            <p class="text-muted text-center">Software Engineer</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Full Name</b> <a class="float-right">{{$user->surname}}&nbsp;{{$user->name}}&nbsp;{{$user->father_name}}</a>
                </li>
                <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$user->email}}</a>
                </li>
                <li class="list-group-item">
                    <b>Contact</b> <a class="float-right">{{$user->contact}}</a>
                </li>
                <li class="list-group-item">
                    <b>User Type</b> <a class="float-right">{{ $user->type == 0 ? "Admin" : "Teacher" }}</a>
                </li>
                <li class="list-group-item">
                    <b>Branch</b> <a class="float-right">{{$user->branch->name}}</a>
                </li>
            </ul>

        </div>
    </div>

@endsection

