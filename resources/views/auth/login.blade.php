<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('backend/dist/css/login.css')}}">
    <style>
        ::placeholder {
            color: rgb(76,76,76);
        }
    </style>
</head>
<body>
<div class="custom-card">
    <div class="login-box">
        <h1>Login</h1>
            <form method="POST" action="{{route('login') }}" id="loginForm" novalidate>
                @csrf
                <div class="textbox">
                    <i class="fa fa-user"></i>
                    <input type="text" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                    @error('email')
                    <span class="text-danger" style="font-size: 18px;">
                    {{$errors->first('email')}}
                    </span>
                    @enderror
                </div>
                <div class="textbox" id="show_hide_password">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" id="password_field" placeholder="Password">
                    <span toggle="#password_field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    @error('password')
                    <span class="text-danger" style="font-size: 18px;">
                    {{$errors->first('password')}}
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-info btnLogin" name="btnLogin" id="btnLogin" value="login">Login</button>
            </form>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src=".{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>

<script type="text/javascript">

    // Show/Hide Password Field
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>


</body>
</html>
