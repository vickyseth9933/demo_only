<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Cross Bore Review</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="assets/vendors/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/toastr.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        body {
            background-color: #f2f3fa;
        }

        .login-content {
            max-width: 900px;
            margin: 100px auto 50px;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
        }

        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color: #fff;
            color: #5c6bc0;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
    </style>
</head>

<body>
<?php
session_start();
include_once 'config.php';
$conn = OpenCon();

 

/*if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}*/

if(isset($_POST['btn-login']))
{
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$upass = mysqli_real_escape_string($conn, $_POST['password']);
	
	$res=mysqli_query($conn, "SELECT * FROM cb_user WHERE email='$email' AND password='$upass'");
	$row=mysqli_fetch_assoc($res);
	if($row)
	//if($row['password']==md5($upass))
	{
		//$_SESSION['user'] = $row['user_id'];
		header("Location: reviewer-dashboard.php");
		
	}
	else
	{
            $err = "<p style='color: red'>Wrong Username or Password</p>";
		?>
       
        <?php
	}
	
	
	
} else {
	
}
?>
    <div class="row login-content">
        <div class="col-6 bg-white">
            <div class="text-center">
                <span class="auth-head-icon"><i class="fa fa-user"></i></span>
            </div>
            <div class="ibox m-0" style="box-shadow: none;">
                <form class="ibox-body" id="login-form"  method="POST">
                    <h4 class="font-strong text-center mb-5">LOG IN</h4>
                    <div class="form-group mb-4">
                        <input class="form-control form-control-air" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mb-4">
                        <input class="form-control form-control-air" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="flexbox mb-5">
                        <label class="checkbox checkbox-primary">
                            <input type="checkbox" checked>
                            <span class="input-span"></span> Remember</label>
                        <a class="text-primary" href="forgot_password.html" name="btn-login">Forgot password?</a>
                    </div>
					 <div class="text-center">
                        <button class="btn btn-primary btn-rounded btn-block btn-air" name="btn-login">LOGIN</button>
                    </div>
                   
                </form>
            </div>
        </div>
        <div class="col-6 d-inline-flex align-items-center text-white py-4 px-5" style="background-color: #f5f5f5;">
            <div class="logopg">
                <img src="assets/img/pge_logo.png" alt="#" />
            </div>
        </div>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- CORE PLUGINS-->
    <script src="assets/vendors/js/jquery.min.js"></script>
    <script src="assets/vendors/js/popper.min.js"></script>
    <script src="assets/vendors/js/bootstrap.min.js"></script>
    <script src="assets/vendors/js/metisMenu.min.js"></script>
    <script src="assets/vendors/js/jquery.slimscroll.min.js"></script>
    <script src="assets/vendors/js/toastr.min.js"></script>
    <script src="assets/vendors/js/jquery.validate.min.js"></script>
    <script src="assets/vendors/js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>


</html>