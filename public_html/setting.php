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
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
.card-body .a-classdiv {
    background: #ddd;
    width: 40px;
    height: 40px;
    display: inline-block;
    padding: 7px 0px 0px 10px;
    border-radius: 50%;
    color: #3f93b1;
    font-size: 18px;
    position: absolute;
    top: 10px;
    right: 20px;
    z-index: 999;
}
.card-body.setting-imgdiv img {
    width: 150px;
    position: relative;
}
.timeline .timeline-item01 {
    padding: 4px 0px;
}
.list-heading-div {
    font-size: 18px;
    padding-left: 5px;
    font-weight: bold;
    color: #00a5df;
}
.timeline-item01 .fa {
    font-size: 20px;
    color: #6d7c85;
    text-align: center;
    min-width: 28px;
}
.setting-form-update button.btn {
    padding: 4px 47px;
    display: inline-block;
}
.ibox-body.setting-div-padd {
    background: #fff;
    vertical-align: middle;
    margin-bottom: 20px;
    padding: 10px;
}
.card-body.setting-imgdiv input#imgInp {
    position: absolute;
    left: 0px;
    opacity: 0;
    right: 0;
    top: 0px;
    overflow: hidden;
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
                        <a href="reviewer-dashboard.html"><img src="assets/img/Logo.png" alt="image"></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a href="reviewer-dashboard.html"><i class="sidebar-item-icon fa fa-tachometer"></i><span class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
                        <a href=""><i class="sidebar-item-icon fa fa-user"></i><span class="nav-label">Resources</span></a>
                    </li>
                    <li class="color-div"><a href=""><i class="fa fa-phone"></i> Contact</a></li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span>Reviewer</span>
                            <img src="assets/img/users/admin-image.png" alt="image" />
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                            <div class="dropdown-header text-center">
                                <strong>Account</strong>
                            </div>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-wrench"></i> Settings</a>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-lock"></i> Logout</a>
                        </div>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->

        <div class="container">
            <div class="content-wrapper">
                <!-- START PAGE CONTENT-->
                <div class="page-content fade-in-up">
                        <div class="ibox-body setting-div-padd">
                                <div class="row">
                                        <div class="col-sm-8">
                                           <h5 class="font-strong mt-2">Edit Setting</h5>
                                        </div>
                                       <!----<div class="col-sm-4 text-right">
                                             <div class="addmember-div ">
                                                     <a class="newdiv d-inline-block" data-toggle="modal" data-target="#modalRegisterForm1" href="#">Edit Profile&nbsp; <span><i class="fa fa-pencil"></i></span></a>											 
                                                </div>
                                        </div>---->
                                     </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body setting-imgdiv">
                                        <a class="a-classdiv" href="#"><i _ngcontent-c1="" class="fa fa-camera"></i><input type="file" name="fileToUpload" id="imgInp"></a>
                                        <img src="http://pge.epikso.biz/user/2310-qa-sheet.png">
                                </div>
                            </div>
                        </div>
                            <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        <ul _ngcontent-c12="" class="timeline">
                                            <li class="list-heading-div">Admin</li>
                                            <li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-map-marker timeline-icon"></i>California,12345422 USA</li>
                                            <li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-envelope timeline-icon"></i> <a _ngcontent-c12="" title="#" href="#">admin@pgne.com</a></li>
                                            <li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-phone timeline-icon"></i><a _ngcontent-c12="" title="#" href="tel:(9098766567)">(9098766567)</a></li>
                                            <li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-envelope timeline-icon"></i> <a _ngcontent-c12="" title="#" href="#">adminassad@pgne.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                    <form id="setting_form" name="form" class="manageform-div bg-white p-4">
                                            <div class="row">
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>First Name</label><input class="form-control " name="firstName" type="text">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Last Name</label><input class="form-control " name="lastName">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Email</label><input class="form-control" disabled name="email" type="email">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>LAN ID</label><input class="form-control " name="Number" type="Number">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                    <div class="form-group">
                                                       <label>LEVEL</label><input class="form-control " name="Number" type="Number">
                                                    </div>
                                                 </div>
                                               <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label>Password</label><input class="form-control " name="Password" placeholder="Enter Password" type="Password">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Confirm Password</label><input class="form-control " name="confirmPassword" type="password">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Zip Code</label><input class="form-control " name="zip" placeholder="Your Zip Code" type="text">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>City</label><input class="form-control " name="city" placeholder="Your City" type="text">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>State</label><input class="form-control " name="state" placeholder="Your State" type="text">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group" >
                                                     <label>Role</label>
                                                     <select class="form-control multiselect "disabled>
                                                        <option>Admin</option>
                                                        <option>Employee</option>
                                                        <option>NDE Vendor Technician</option>
                                                        <option>Supervisor- Level II</option>
                                                        <option>GO NDE Lead</option>
                                                        <option>NDE Field Technician</option>
                                                        <option>Supervisor- Level III</option>
                                                        <option>fghd</option>
                                                        <option>sfdsfsfsdfdsfsfsf</option>
                                                     </select>
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group"><label>Hire Date</label><input class="form-control " disabled id="" name="hire_date" type="date" value="Hire Date"></div>
                                               </div>
                                               <div class="col-sm-12 text-center">
                                               <div class="setting-form-update">
                                                  <button type="button" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-ok-sign"></span>Save</button>
                                               </div>
                                               </div>
                                            </div>
                                         </form>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE CONTENT-->
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
        <!-- START SEARCH PANEL-->
        <!-- BEGIN PAGA BACKDROPS-->
        <div class="sidenav-backdrop backdrop"></div>
        <div class="preloader-backdrop">
            <div class="page-preloader">Loading</div>
        </div>
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
        <script src="assets/vendors/js/jquery.steps.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script>
            $(function() {
                $('#form-wizard').steps({
                    headerTag: "h6",
                    bodyTag: "section",
                    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                    onStepChanging: function(event, currentIndex, newIndex) {
                        var form = $(this);
                        // Always allow going backward even if the current step contains invalid fields!
                        if (currentIndex > newIndex) {
                            return true;
                        }

                        // Clean up if user went backward before
                        if (currentIndex < newIndex) {
                            // To remove error styles
                            $(".body:eq(" + newIndex + ") label.error", form).remove();
                            $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                        }

                        // Disable validation on fields that are disabled or hidden.
                        form.validate().settings.ignore = ":disabled,:hidden";

                        // Start validation; Prevent going forward if false
                        return form.valid();
                    },
                    onFinished: function (event, currentIndex)
                       {
                           $("#modalRegisterForm").modal();
                       }
                })
            })			

        </script>
		
		<script >
			$(function()
				{
				  $('#switch1').click(function()
						{
							if ($('#switch1').is(":checked")) {
								$('#modalRegisterForm3').modal('show');
							}else {
								$('#modalRegisterForm3').modal('hide');
							}
						});
				});
		</script>
</body>

</html>