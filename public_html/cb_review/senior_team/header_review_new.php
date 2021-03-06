<?php
session_start();
include_once '../../config.php';
$conn = OpenCon();
$userid = $_SESSION['userid'];
if($userid==''){
  header("Location: index.php");
  exit();
}
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID))
{
    $homeurl = 'admin-dashboard.php';
}else{
    $homeurl = 'reviewer-dashboard.php';    
}
$userid = $_SESSION['userid'];
$sql_UsrProfileImg= "SELECT cb_user.profile_image,cb_user.first_name FROM cb_user WHERE id = $userid";
$result_UsrProfileImg = $conn->query($sql_UsrProfileImg);
$UsrProfile_res = $result_UsrProfileImg->fetch_array();
$profileimg = $UsrProfile_res['profile_image'];
$profile_name = $UsrProfile_res['first_name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Cross Bore</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="../../assets/vendors/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../assets/vendors/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../../assets/vendors/css/animate.min.css" rel="stylesheet" />
    <link href="../../assets/vendors/css/toastr.min.css" rel="stylesheet" />
    <link href="../../assets/vendors/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../../assets/css/lobinbox.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <!--<link href="../../assets/vendors/css/datatables.min.css" rel="stylesheet" />
    <link href="../../assets/vendors/css/select.datatable.min.css" rel="stylesheet" />-->
     
         
    <link href="../../assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        /*#dash_jobstatus .legend>div {
        width: 130px !important;
        }*/
        .card .card-avatar img {
            height: 60px;
            width: 60px;
        }
        .successmessage  {
            color:green;
        }
        .error {
            color:red;
        }
        .colorbox.light-Blue {
            background: #ADD8E6;
        }
        .wizard .actions ul > li.disabled {
            display: none;
        }
        .panel.panel-default.box-shadow-div01 a {
    padding: 2px 29px;
    font-size: 16px;
}
  
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header header">
            <div class="flexbox flex-1 navbar navbar-expand-md navbar-light py-0 pr-md-0">
                <!--<a href="<?= $homeurl ?>" class="navbar-brand">
                    <img src="../assets/img/Logo.png" alt="image" style="max-height: 51px;">
                </a>-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarsExample05">
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
                        <li style="display:none;">
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
                            <a class="nav-link dropdown-toggle link flex-row-reverse flex-md-row flex-start justify-content-end" data-toggle="dropdown">
                                <span><?php echo $profile_name; ?></span>
                                <?php if($profileimg) { ?>
                                    <img src="../../profile_image/<?php echo $profileimg;?>" class="ml-0 ml-md-2 mr-2 mr-md-0">
                                    
                                <?php } else { ?>
                                  
                                    <img src="../../profile_image/users01.png" alt="image"  class="ml-0 ml-md-2 mr-2 mr-md-0"/>
                                    <!--<img src="assets/img/users/admin-image.png" alt="image"  class="ml-0 ml-md-2 mr-2 mr-md-0"/>-->
                                    
                               <?php }  ?>
                                
                                
                            </a>
                            <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu mr-md-1 mdropdown">
                                <div class="dropdown-header text-center">
                                    <!--<a href="my_profile.php">-->
                                   <a href="my_profile.php"><strong>Account</strong></a>
                                </div>
                                <?php
                                    if (in_array("1", $roleID))
                                    {
                                    ?>
                                 <a class="dropdown-item" href="manage-member2.php"><i class="fa fa-user-plus"></i> Add Member</a>
                                 <a class="dropdown-item" href="manage-role.php"><i class="fa fa-user-plus"></i> Add Role</a>
                                    <?php } ?>  
                                <a class="dropdown-item" href="edit_profile.php">
                                  <i class="fa fa-wrench"></i> Settings</a>
                                <a class="dropdown-item" href="logout.php">
                                  <i class="fa fa-lock"></i> Logout</a>
                              </div>
                        </li>
                    </ul>
                </div>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
    
           <!-- END PAGE CONTENT-->
           