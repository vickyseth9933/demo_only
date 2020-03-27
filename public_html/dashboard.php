<?php
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
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <!-- START HEADER-->
        <header class="header">
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                         <a href="dashboard.html"><img src="assets/img/Logo.png" alt="image"></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
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
							<a class="dropdown-item" href="manage-member.php"><i class="fa fa-briefcase"></i>Add member</a>
							<a class="dropdown-item" href="manage-role.php"><i class="fa fa-pencil"></i>Add role</a>
							
							
                            <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                          </div>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
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
                                    <div class="col-sm-12">
                                        <h5 class="font-strong mb-4">Jobs to be Reviewed</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="flexbox control-div mb-4">
                                            <div class="flexbox">
                                                <label class="mb-0 mr-2">Status:</label>
                                                <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">
                                                    <option value="">All</option>
                                                    <option>CN-29 Eligiblle</option>
                                                    <option>Field Remediation Required</option>
                                                    <option>Unknown Status</option>
                                                </select>
                                            </div>
                                            <div class="flexbox">
                                                <label class="mb-0 mr-2">Search</label>
                                                <div class="input-group-icon input-group-icon-left">
                                                    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="ad_datatable">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th><input name="select_all" value="1" id="adtbl-select-all" type="checkbox" /></th>
                                                        <th>Order No</th>
                                                        <th>Order Description</th>
                                                        <th>Resp Group</th>
                                                        <th>MAT</th>
                                                        <th>Current Stage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>31012445</td>
                                                        <td>73O R4 G ALDYL RPL KIT CARSON, S-GRP 165</td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                         <td>Cover Sheet</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31227426 </td>
                                                        <td>BR G ALDYL RPL SA BRAVO WAY, SAC. </td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                        <td>Project Details</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31289828</td>
                                                        <td>XGCSAC ALDYL RPL SA LUCILE WY, RIO LINDA </td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                        <td>Distribution Checklist</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31328089</td>
                                                        <td>SA G GPRP LAND PARK PHS 2, SACRAMENTO </td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                        <td>M&C Checklist</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31395926</td>
                                                        <td>OCW 655, 659,  665  MANOR PACIFICA</td>
                                                        <td>CD</td>
                                                        <td>50C</td>
                                                        <td>Transmission Checklist</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31012445</td>
                                                        <td>73O R4 G ALDYL RPL KIT CARSON, S-GRP 165</td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                        <td>Cover Sheet</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31227426 </td>
                                                        <td>BR G ALDYL RPL SA BRAVO WAY, SAC. </td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                        <td>Project Details</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31289828</td>
                                                        <td>XGCSAC ALDYL RPL SA LUCILE WY, RIO LINDA </td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                        <td>Distribution Checklist</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31328089</td>
                                                        <td>SA G GPRP LAND PARK PHS 2, SACRAMENTO </td>
                                                        <td>CD </td>
                                                        <td>14D</td>
                                                        <td>M&C Checklist</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>31395926</td>
                                                        <td>OCW 655, 659,  665  MANOR PACIFICA</td>
                                                        <td>CD</td>
                                                        <td>50C</td>
                                                        <td>Transmission Checklist</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="assign_tojob" style="display: none;">
                                    <div class="col-sm-12  d-flex">
                                        <select class="form-control mr-3 w-auto" id="ad_assignctrl" name="ad_assignctrl" style="padding: .375rem .75rem;">
                                            <option>Assign Jobs To</option>
                                            <option>Sam</option>
                                            <option>Michal</option>
                                        </select>
                                        <button type="button" class="btn btn-primary" style="padding: .375rem .75rem;">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6  mb-4">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Total Jobs</div>
                            </div>
                            <div class="ibox-body">
                                <div>
                                    <div id="ad_pie_totaljobs" style="height:280px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6  mb-4">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Review Done</div>
                            </div>
                            <div class="ibox-body">
                                <div>
                                    <div id="ad_pie_reviewdone" style="height:280px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 mb-4">
                        <div class="card">
                          <div class="card-header">CN-29 Eligible</div>
                          <div class="card-body">
                            <div class="chart-wrapper">
                              <div id="ad_cn29_jobs" style="height:200px;"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 mb-4">
                        <div class="card">
                          <div class="card-header">Field Remediation Required</div>
                          <div class="card-body">
                            <div class="chart-wrapper">
                              <div id="ad_fieldrem_done" style="height:200px;"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                          <div class="card-header">Unknown Status</div>
                          <div class="card-body">
                            <div class="chart-wrapper">
                              <div id="ad_unknownstatus_done" style="height:200px;"></div>
                            </div>
                          </div>
                        </div>
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
    <!-- datatables -->
    <!-- <script src="assets/vendors/js/datatables.min.js"></script> -->
    <script src="assets/vendors/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/vendors/js/dataTables.select.min.js"></script>
    <!-- pie chart -->
    <script src="assets/vendors/Flot/jquery.flot.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.tooltip.min.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.selection.js"></script>
    <script src="assets/vendors/Flot/jquery.flot.orderBars.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/dashboard.admn.min.js"></script>
    <script>
        
    </script>
</body>


</html>