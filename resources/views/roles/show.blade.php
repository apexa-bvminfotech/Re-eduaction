@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show Role</h1>
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
    </div>
{{--    <div class="container-fluid">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-12">--}}
{{--                <div class="buttonAlign">--}}
{{--                    <h2 class="mb-2 page-title">Show Role</h2>--}}
{{--                    <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>--}}
{{--                </div>--}}

{{--                <div class="row my-4">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="card shadow">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="col-xs-12 col-sm-12 col-md-12">--}}

{{--                                    <div class="form-group">--}}
{{--                                        <strong>Name:</strong>--}}
{{--                                        {{ $role->name }}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <strong>Permissions:</strong>--}}
{{--                                        @if(!empty($rolePermissions))--}}
{{--                                            @foreach($rolePermissions as $v)--}}
{{--                                                <label class="label label-success">{{ $v->name }},</label><br>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
