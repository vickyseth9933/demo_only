<?php
session_start();
include_once 'config.php';
$conn = OpenCon();
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID))
{
	$homeurl = 'admin-dashboard.php';
}else{
    $homeurl = 'reviewer-dashboard.php';	
}

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
    <link href="assets/vendors/css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/toastr.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/vendors/css/datatables.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/select.datatable.min.css" rel="stylesheet" />
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        .card .card-avatar img {
            height: 60px;
            width: 60px;
        }
      
        .colorbox.light-Blue {
            background: #ADD8E6;
        }
        .wizard .actions ul > li.disabled {
            display: none;
        }
  
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
			
                <li>
				 <a href="<?= $homeurl ?>"><img src="assets/img/Logo.png" alt="image"></a>
				</li>
				
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
				<?php
				if (in_array("1", $roleID))
				{
				?>
				<li>
                        <a href="assign-jobs.php"><i class="sidebar-item-icon fa fa-share-square-o"></i><span class="nav-label">Assign Jobs</span></a>
                    </li>
				<?php } ?>
				<?php
				if (in_array("1", $roleID))
				{
				?>
					<li>
                        <a href="#"><i class="sidebar-item-icon fa fa-file"></i><span class="nav-label">Reports</span></a>
                    </li>
				<?php } ?>
				
					 <li>
					 <?php
				if (in_array("1", $roleID))
				{
				?>
                        <a href="admin-dashboard.php"><i class="sidebar-item-icon fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a>
				<?php }else{
					?>
					<a href="reviewer-dashboard.php"><i class="sidebar-item-icon fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a>
					<?php
				} ?>
                    </li>
					<li>
                        <a href="resources.php"><i class="sidebar-item-icon fa fa-user"></i><span class="nav-label">Resources</span></a>
                    </li>
					<!--<li class="color-div"><a href=""><i class="fa fa-phone"></i> Contact</a></li>-->
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span><?php echo $_SESSION['name']; ?></span>
                            <img src="assets/img/users/admin-image.png" alt="image" />
                            
                            <img src="https://epiksolution.org/cross_bore/profile_image/<?php echo $img;?>"
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                            <div class="dropdown-header text-center">
                                <!--<a href="my_profile.php">-->
                               <a href="my_profile.php"><strong>Account</strong></a>
                            </div>
							<?php
				if (in_array("1", $roleID))
				{
				?>
							 <!--<a class="dropdown-item" href="manage-member.php"><i class="fa fa-user-plus"></i> Add Member</a>
							 <a class="dropdown-item" href="manage-role.php"><i class="fa fa-user-plus"></i> Add Role</a>-->
				<?php } ?>	
                            <a class="dropdown-item" href="edit_profile.php">
                              <i class="fa fa-wrench"></i> Settings</a>
                            <a class="dropdown-item" href="logout.php">
                              <i class="fa fa-lock"></i> Logout</a>
                          </div>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
	
            <!-- END PAGE CONTENT-->
           