<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Cross Bore</title>
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
            background-repeat: no-repeat;
            background-size: cover;
        }
input#useremail {
    padding: 12px 12px !important;
    height: auto;
    box-shadow: none;
    border: 1px solid #ccc;
}
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
        .cover {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(117, 54, 230, .1);
        }

        .login-content {
            max-width: 400px;
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
        .btn-primary {
    color: #fff;
    background-color: #5c6bc0;
    border-color: #5c6bc0;
    padding: 12px 20px !important;
    font-size: 16px;
    font-weight: 700;
}
  #donemsg{
    text-align: center;
    padding: 0px 0px 33px 0px;
    margin-top: -12px;
  }
    </style>
</head>
<?php
 $baseurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

?>
<body>
    <div class="wrapper">
		<div class="middle">
    <div class="cover"></div>
    <div class="ibox login-content">
        <div class="text-center">
            <span class="auth-head-icon"><i class="fa fa-unlock" aria-hidden="true"></i></span>
        </div>
        <div id="donemsg">
		
        <form class="ibox-body pt-0" id="forgot-form"   method="POST">
            <h4 class="font-strong text-center mb-4">FORGOT PASSWORD</h4>
            <p class="mb-4 text-left">Enter your email address below and we'll send you password reset instructions.</p>
            <div class="form-group">
                <input class="form-control" type="text" id="useremail" name="useremail" placeholder="Email">
                <p id="forgetmsgbox" class="error text-left" style="color:#FF0000; margin:0;"></p>
            </div>
            
            <div class="text-center">
                <button  onclick="forgetpass();" class="btn btn-primary mt-1 btn-block btn-air" type="button">SUBMIT</button>
            </div>
			<div _ngcontent-pyw-c1="" class="col-sm-12"><a href="<?= $baseurl; ?>" class="text-primary float-right" name="btn-login" style="cursor:pointer;margin-top: 10px">Back to Login</a></div>
        </form>
        </div>
    </div></div></div>
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
            $('#forgot-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
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
     <script type="text/javascript">
       function forgetpass() {
		   //alert('hehehehe');
       var flag = 1;
        var email = $("#useremail").val();
       
    
        
         if( email =='') {	
            $('#forgetmsgbox').html('Please enter your email id');
            $('#forgetmsgbox').show();
              $('#erormsg').html('');  
                       flag = 0;
                       
            
                }
 
            if (email != '') {
        	                if (!validateEmail(email)) {
        	                 	$('#forgetmsgbox').html('Please enter valid email');
        	                 	$('#forgetmsgbox').show();
        	                 	$('#erormsg').html('');
        	                    flag = 0;
        	                    //   return false;
        
        	                }
        	                }
							
       if (flag == 1){
        var dataString = 'email='+ email ;
        //alert("hi");
      
            $.ajax({
                    cache: false,
                    type: "POST",
                    data:dataString, 
                    dataType: 'json',					
                    url: 'ForgotPassJS.php',
                   
                    
                    success: function(result){
                      //alert(result);
						 var obj = JSON.parse(result);
						 
                          if(obj.status== '200')
                             {
                                $('#donemsg').html("Your reset password link has been sent to your mail box.");
								$('#donemsg').css("color", "green");
								$('#donemsg').css("text-align", "center");
                                $('#donemsg').addClass('modalcls');
        	                    setTimeout(function(){
        	                        window.location.href = "index.php";
                                  //window.location.reload(1);
                               }, 4000); 
                              }else{
                                $('#forgetmsgbox').html("Please enter your registered email id");
        	                 	$('#forgetmsgbox').show(); 
                              }
                           
                    }
            });
            }
            else if (flag == 0) {
	                return false;
	            }
    }

    </script>
    <script>
		function validateEmail(sEmail) {
	        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	        return emailReg.test(sEmail);
	    }
	</script>
</body>
</html>