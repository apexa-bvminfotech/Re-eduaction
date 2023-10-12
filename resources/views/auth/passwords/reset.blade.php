<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | RESET Password (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">

    <style>
        #email-error{
            color: #DC3545
        }
        #password-error{
            color: #DC3545
        }
        #password_confirmation-error{
            color: #DC3545
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h1"><b> Reset Password</b></a>
        </div>
        <div class="card-body">
            {{-- <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p> --}}
            <form action="{{ route('reset.password.update') }}" method="post" id="submitForm">
                @csrf
                {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
                <input id="email" type="hidden" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Enter your Email" required autocomplete="email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>    
                </div>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror   
                
                <div class="row">
                    <div class="col-md-7">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                    <div class="col-md-5">
                        <a type="button" href="{{ route('login') }}" class="btn btn-primary">
                            Back to login
                        </a>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
{{-- <script src="{{asset('assets/plugins/jquery.min.js')}}"></script> --}}
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/plugins/adminlte.min.js')}}"></script>
<!-- jQuery validation -->
<script src="{{asset('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script type="text/javascript">
	$(document).ready(function() {
        var form = $('#submitForm');
        var validator = form.validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            },
            messages: {
                email: {
                    required: 'Email is required',
                    email: 'Invalid email address',
                },
                password: {
                    required: 'Password is required',
                    minlength: 'Password must be at least 8 characters',
                },
                password_confirmation: {
                    required: 'Confirm Password is required',
                    minlength: 'Password must be at least 8 characters',
                    equalTo: 'Password and confirm password do not match',
                }
            }
        });
    });
</script>
</body>
</html>
