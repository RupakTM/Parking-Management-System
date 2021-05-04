<?php
require_once "object.php";
if (isset($_COOKIE['name'])) {
    session_start();
    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['name'] = $_COOKIE['name'];
    $_SESSION['email'] = $_COOKIE['email'];
    $_SESSION['image'] = $_COOKIE['image'];
    $_SESSION['role_id'] = $_COOKIE['role_id'];
    $_SESSION['role_name'] = $_COOKIE['rname'];
    header('location:home.blade.php');
//    route('login');
}

if(isset($_POST['btnLogin'])){
    $err = [];
    if(isset($_POST['email']) && !empty($_POST['email'])){
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $user->set('email',$_POST['email']);
        }
        else{
            $err['email'] = "Invalid format";
        }
    } else{
        $err['email'] = "Please enter email";
    }
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $user->set('password',$_POST['password']);
    } else{
        $err['password'] = "Please enter password";
    }

    if(count($err)==0){
        $loginStatus =  $user->login();
    }
}

?>

    <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../../public/backend/dist/css/login.css">
    <link rel="stylesheet" type="text/css" href="../../../public/backend/dist/css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="login-box">
    <h1>Login</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="loginForm" novalidate>
        <div class="alert-message">
            <?php if(isset($loginStatus)){ ?>
            <div class = "text text-danger">Login Failed</div>
            <?php } ?>
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 1){ ?>
            <div class = "text text-danger">Please login to access dashboard</div>
            <?php } ?>
        </div>
        <div class="textbox">
            <i class="fa fa-user"></i>
            <input type="text" name="email" id="email" placeholder="Email">
            <span class="error">
					<?php
                if(isset($err['email'])){
                    echo $err['email'];
                }
                ?>
					</span>
        </div>
        <div class="textbox" id="show_hide_password">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="show_hide">
                <a href=""><i class="fa fa-eye-slash" aria-hidden="true" style="color:#ffffff;"></i></a>
            </div>
            <span class="error">
					<?php
                if(isset($err['password'])){
                    echo $err['password'];
                }
                ?>
					</span>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small customRememberMe">
                <input type="checkbox" class="custom-control-input" id="customRemember" name="remember" id="remember">
                <label class="custom-control-label" for="customRemember">Remember Me</label>
            </div>
        </div>
        <button type="submit" class="btnLogin" name="btnLogin" id="btnLogin" value="login">Login</button>
    </form>
</div>

<script type="text/javascript" src="{{asset('backend/plugins/jquery/jquery.validate.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        // alert('test');
        $('#loginForm').validate({
            rules: {
                email: "required",
                password: "required"
            }
        });

        // Password show-hide js
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password a i').addClass( "fa-eye-slash" );
                $('#show_hide_password a i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password a i').removeClass( "fa-eye-slash" );
                $('#show_hide_password a i').addClass( "fa-eye" );
            }
        });
    });
</script>

<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
