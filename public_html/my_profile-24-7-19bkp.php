<?php
ob_start();
include('header.php');
$userid = $_SESSION['userid'];


if(isset($_POST)){
    $reviewer_fname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $reviewer_lname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $reviewer_email = mysqli_real_escape_string($conn, $_POST['email']);
    $reviewer_lanid = mysqli_real_escape_string($conn, $_POST['lanid']);
    $reviewer_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $reviewer_zip   = mysqli_real_escape_string($conn, $_POST['zip']);
    $reviewer_city  = mysqli_real_escape_string($conn, $_POST['city']);
    $reviewer_state = mysqli_real_escape_string($conn, $_POST['state']);
    $reviewer_hire_date = mysqli_real_escape_string($conn, $_POST['hire_date']);
    
    $uploaded_file = $_FILES["fileToUpload"]["name"];
    
    if ($_FILES["fileToUpload"]['tmp_name']!='') {		
    		$target_dir = "profile_image/";
    		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    		$uploadOk = 1;
    		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    	
    } 
    
    if($uploaded_file)
    {
            $sql_UsrProfile = "UPDATE cb_user SET first_name = '$reviewer_fname',last_name = '$reviewer_lname', email = '$reviewer_email',lanid = '$reviewer_lanid',phone = $reviewer_phone,state = '$reviewer_state',city = '$reviewer_city',zip = '$reviewer_zip',hire_date = '$reviewer_hire_date',profile_image = '$uploaded_file' WHERE id = $userid";

    } else {
            $sql_UsrProfile = "UPDATE cb_user SET first_name = '$reviewer_fname',last_name = '$reviewer_lname', email = '$reviewer_email',lanid = '$reviewer_lanid',phone = $reviewer_phone,state = '$reviewer_state',city = '$reviewer_city',zip = '$reviewer_zip',hire_date = '$reviewer_hire_date' WHERE id = $userid";
    }
    //echo $sql_UsrProfile = "INSERT INTO cb_user (first_name,last_name,email,lanid,phone,state,city,zip) VALUES ('$reviewer_fname','$reviewer_lname','$reviewer_email','$reviewer_lanid',$reviewer_phone,'$reviewer_state','$reviewer_city','$reviewer_zip')  WHERE id = $userid";
    $result_UsrProfile = $conn->query($sql_UsrProfile);
    if ($conn->query($sql_UsrProfile) === TRUE) {
        if ($_FILES["fileToUpload"]['tmp_name']!='') {		
    		
    			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    			} else {
    				//echo "Sorry, there was an error uploading your file.";
    			}
    		
    	}
    }
}
if($_GET['id']) {
    $sql_UsrProfile = "SELECT * FROM cb_user WHERE id = '".$_GET['id']."'";
    
} else {
    $sql_UsrProfile = "SELECT * FROM cb_user WHERE id = $userid";
}


$result_UsrProfile = $conn->query($sql_UsrProfile);
$UsrProfile_res = $result_UsrProfile->fetch_array();
if ($result_UsrProfile->num_rows > 0) {
    
    if($UsrProfile_res['first_name'])
    {
        $user_name = $UsrProfile_res['first_name'].' '.$UsrProfile_res['last_name'];
    } else {
        $user_name = 'N/A';
    }
    if($UsrProfile_res['email'])
    {
        $user_email = $UsrProfile_res['email'];
    } else {
        $user_email = 'N/A';
    }
    if($UsrProfile_res['phone'])
    {
        $user_phone = $UsrProfile_res['phone'];
    } else {
        $user_phone = 'N/A';
    }
    if($UsrProfile_res['username'])
    {
        $user_profilename = $UsrProfile_res['username'];
    } else {
        $user_profilename = 'N/A';
    }
    if($UsrProfile_res['address'])
    {
        $user_address = $UsrProfile_res['address'];
    } else {
        $user_address = 'N/A';
    }
    if($UsrProfile_res['lanid'])
    {
        $user_lanid = $UsrProfile_res['lanid'];
    } else {
        $user_lanid = 'N/A';
    }
     if($UsrProfile_res['website'])
    {
        $user_website = $UsrProfile_res['website'];
    } else {
        $user_website = 'N/A';
    }
    if($UsrProfile_res['profile_image'])
    {
        $user_profile_image = $UsrProfile_res['profile_image'];
    } else {
        $user_profile_image = 'users01.png';
    }
    if($UsrProfile_res['city'] || $UsrProfile_res['state'])
    {
        
        if($UsrProfile_res['state'] && $UsrProfile_res['city'] )
        {
            $user_address = $UsrProfile_res['city'];
            $user_address .= ",".$UsrProfile_res['state'];
             
        } elseif($UsrProfile_res['city']){
            
            $user_address = $UsrProfile_res['city'];
        } else {
            $user_address = $UsrProfile_res['state'];
        }
       
        //$user_addresstop = $UsrProfile_res['address'];
    } else {
        $user_address = '';
       // $user_addresstop = '';
    }
       //$user_pass = DECODE('abBxjdJQWn8xw', 'secret');

} else {
    
}

//echo "<pre>";print_r($_POST);





//$password = base64_encode(1234);
//$password = ENCODE('1234', 'secret');


?>

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
    <link href="assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="assets/vendors/css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/toastr.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/vendors/css/datatables.min.css" rel="stylesheet" />
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
<style>
.panel.panel-default.box-shadow-div01 {
    border: none;
    -webkit-box-shadow: 0 0 1px rgba(0,0,0,.1);
    -moz-box-shadow: 0 0 1px rgba(0,0,0,.1);
    -ms-box-shadow: 0 0 1px rgba(0,0,0,.1);
    -o-box-shadow: 0 0 1px rgba(0,0,0,.1);
    box-shadow: 0 0 1px rgba(0,0,0,.1);
}
.box-shadow-div01.panel .panel-heading {
    background: #00a5df;
    color: #fff;
    padding: 20px;
    text-transform: none;
    font-size: 14px;
    font-weight: 400;
}
.panel .panel-heading strong {
    font-weight: 400;
}
.list-info li {
    padding: 10px;
    border-bottom: 1px solid #eee;
}
.list-info li .fa {
    margin-right: 10px;
    color: #6d7c85;
}
.list-info li label {
    width: 100px;
}
.panel-ico .fa {
    margin-right: 10px;
    color: #009688;
}
.profile-color-div .fa {
    color: #6d7c85;
    padding-top: 6px;
}
</style>
</head>


<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <!--<header class="header">
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <!--<ul class="nav navbar-toolbar">
                    <li>
                        <a href="dashboard.html"><img src="assets/img/Logo.png" alt="image"></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <!--<ul class="nav navbar-toolbar">
								<li>
                        <a href="dashboard.html"><i class="sidebar-item-icon fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a>
                    </li>
					<li>
                        <a href=""><i class="sidebar-item-icon fa fa-user"></i><span class="nav-label">Resources</span></a>
                    </li>
					<li class="color-div"><a href=""><i class="fa fa-phone"></i> Contact</a></li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span>Super Admin</span>
                            <img src="assets/img/users/admin-image.png" alt="image" />
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                            <div class="dropdown-header text-center">
                              <strong>Account</strong>
                            </div>
							<!--<a class="dropdown-item" href="manage-member.html"><i class="fa fa-briefcase"></i>Add member</a>
							<a class="dropdown-item" href="manage-role.html"><i class="fa fa-pencil"></i>Add role</a>-->
							
							
                            <!--<a class="dropdown-item" href="edit_profile.php"><i class="fa fa-wrench"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                          </div>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            <!--</div>
        </header>-->
        <!-- END HEADER-->
	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-4 col-xlg-3 col-md-4 align-self-center">
                                            <div class="card">
                                                <div class="card-block">
                                                    <center class="m-t-30"> 
                                                    <!--<img src="assets/img/user1.jpg" class="img-circle" width="150">-->
                                                    <?php if($user_profile_image){ ?>
                                                        <img src="https://epiksolution.org/cross_bore/profile_image/<?php echo $user_profile_image;?>" class="img-circle" width="150">
                                                        
                                                    <?php } else { ?>
                                                        <img src="assets/img/users/admin-image.png" alt="image" />
                                                        
                                                    <?php } ?>
                                                    
                                                    
                                                   
                                                   
                                                        <h4 class="card-title m-2"><?= $user_name?></h4>
                                                        <!--<h6 class="card-subtitle py-2">Accoubts Manager Amix corp</h6>-->
                                                       
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                <div class="col-sm-8">
                                        <div class="panel panel-default box-shadow-div01">
                                                <div class="panel-heading"><strong><i class="fa fa-list panel-ico mr-2"></i>Profile Info</strong></div>
                                                <div class="panel-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <ul class="list-unstyled list-info">
                                                                <li>
                                                                    <span class="sidebar-item-icon fa fa-user"></span>
                                                                    <label>User name</label>
                                                                    <?= $user_name?>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-envelope timeline-icon"></span>
                                                                    <label>Email</label>
                                                                    <?= $user_email?>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-map-marker timeline-icon"></span>
                                                                    <label>Address</label>
                                                                    
                                                                    <?php if(isset($user_address)){
                                                                        echo $user_address;
                                                                    } ?>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-phone"></span>
                                                                    <label>Contact</label>
                                                                    <?= $user_phone?>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-flag"></span>
                                                                    <label>LANID</label>
                                                                    <?= $user_lanid?>
                                                                </li>
                                                                
                                                            </ul>
                                                             <a href="edit_profile.php" class="btn btn-warning btn-lg" id="editprofilebtn" value="Save">EDIT</a>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                </div>
                                            </div>   
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
				

<!-------popup-form-end-form-here----------->
               
            <footer class="page-footer">
                <div class="font-13">2019 ©</div>
                <div class="px-3">
                    Design by: <a href="http://epikso.com" target="_blank">Epik Solutions</a>
                </div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
		</div>
    </div>
				</div>
		</div>
	</div>
    <!-- START SEARCH PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>

    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="assets/vendors/js/jquery.min.js"></script>
    <script src="assets/vendors/js/popper.min.js"></script>
    <script src="assets/vendors/js/bootstrap.min.js"></script>
    <script src="assets/vendors/js/metisMenu.min.js"></script>
    <script src="assets/vendors/js/jquery.slimscroll.min.js"></script>
    <script src="assets/vendors/js/toastr.min.js"></script>
    <script src="assets/vendors/js/jquery.validate.min.js"></script>
    <script src="assets/vendors/js/bootstrap-select.min.js"></script>
    <script src="assets/vendors/js/datatables.min.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="assets/vendors/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.selection.js"></script>
    <script src="assets/vendors/flot-orderBars/js/jquery.flot.orderBars.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/dashboard_visitors.js"></script>
    <script>
        
    </script>
</body>


</html>