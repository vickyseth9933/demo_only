<?php
ob_start();
?>
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
    <!-- PAGE LEVEL STYLES-->
    <style>
      
	html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
  background: #3f93b1;
}
*{ margin: 0;
    padding: 0;}
	.wrapper {
    position: relative;
    z-index: 2;
    height: 100%;
    width: 100%;
    display: table;
    vertical-align: middle; text-align:center;
}
.middle {
    display: table-cell;
    vertical-align: middle;
    padding: 10px 10px;
}
        .auth-head-icon {
position: relative;
    height: 72px;
    width: 72px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    background-color: #fff;
    color: #3f93b1;
    box-shadow: 0 5px 20px #d6dee4;
    border-radius: 50%;
    transform: translateY(-50%);
    z-index: 2;
        }
        
        .box.bg-white {
    max-width: 400px;
    text-align: left;
    margin: 0 auto;
    border-radius: 4px;    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
input.form-control.form-control-air {
    padding: 12px 12px !important;
    height: auto;
    box-shadow: none;
    border: 1px solid #ccc;;
}
.btn-primary {
    color: #fff;
    background: #5c6bc0;
    border-color: #5c6bc0;
    box-shadow: none;
    padding: 12px 20px !important;
    font-size: 16px;
    color: #fff;
    height: auto;
    width: 100%;
    border-radius: 4px;    font-weight: 600;

}
label#email-error {
    color: #FF0000;
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;
    font-size: 13px;
}
label#password-error {
    color: #FF0000;
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;
    font-size: 13px;
}
.flexbox.mb-2 label, .flexbox.mb-2 a {
    font-size: 13px;
}
.flash-close {
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    background: none;
    border: 0;
    color: inherit;
    cursor: pointer;
    float: center;
    margin: 0px;
    opacity: .6;
    padding: 16px;
    text-align: center;
}
form#login-form {
    padding-top: 14px !important;
}
    </style>
</head>

<body>
<?php
session_start();
include_once 'config.php';
$conn = OpenCon();
$err = '';
 

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
	{
        $role_id = $row['role_id'];
        $roleID = explode(',',$role_id);
        $_SESSION['email']    =   $row['email'];
		$_SESSION['role']     =   $row['role_id'];
		$_SESSION['name']     =   $row['first_name'];
		$_SESSION['userid']   =   $row['id'];
         if(in_array("1", $roleID) || in_array("7", $roleID))
        { 
                header("Location: admin-dashboard.php");
        }
	    else if(in_array("3", $roleID)){
	            header("Location: reviewer-dashboard.php");
	    }	
	    else if(in_array("2", $roleID)){
	            header("Location: reviewer-dashboard.php");
	   }
	   else if(in_array("4", $roleID)){
	            header("Location: /cb_review/cb_prevention_team/admin-dashboard-prevention.php");
	   }
	   else if(in_array("6", $roleID)){
	            header("Location: /cb_review/senior_team/snr_dashboard.php");
	   }
	}
	else
	{
            $err = "<p style='color: red' class='flash-close js-flash-close'>Incorrect username or password.</p>";
		?>
       
        <?php
	}
	
	
	
} else {
	
}
?>     <div class="wrapper">
		<div class="middle">
    <div class="container">
   
        <div class="">
            <div class="box bg-white">
                <div class="text-center">
                    <span class="auth-head-icon"><i class="fa fa-user"></i></span>
                </div>
                <div class="text-center"><img src="assets/img/pge_logo.png"/></div>
                <?php echo $err;?>
                <div class="ibox m-0" style="box-shadow: none;">
                    <form class="pb-3 p-md-4" id="login-form"  method="POST">
                        <h4 class="font-strong text-center mb-5">Login</h4>
                        <div class="form-group">
                            <input class="form-control form-control-air" type="text" name="email" placeholder="Email">
                        </div>
                        <div class="form-group mb-4">
                            <input class="form-control form-control-air" type="password" name="password" placeholder="Password">
                        </div>
                        <div class="flexbox mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" checked>
                                <span class="input-span"></span> Remember</label>
                            <a class="ext-primary float-right" href="forgot_password.php" name="btn-login">Forgot password?</a>
                        </div>
    					 <div class="text-center">
                            <button class="btn btn-primary btn-rounded btn-block btn-air" name="btn-login">LOGIN</button>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div> </div> </div>
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