<?php
$limit = 5;  
if (isset($_GET["JobsforApproval"])) {
	$JobsforApproval  = $_GET["JobsforApproval"]; 
	} 
	else{ 
	$JobsforApproval=1;
	};  
$start_fromJobsforApproval = ($JobsforApproval-1) * $limit; 

if (isset($_GET["JobsStatus"])) {
	$JobsStatus  = $_GET["JobsStatus"]; 
	} 
	else{ 
	$JobsStatus=1;
	};  
$start_fromJobsStatus = ($JobsStatus-1) * $limit; 

if (isset($_GET["CompletedJobs"])) {
	$CompletedJobs  = $_GET["CompletedJobs"]; 
	} 
	else{ 
	$CompletedJobs=1;
	};  
$start_fromCompletedJobs = ($CompletedJobs-1) * $limit; 

 if (isset($_GET["JobsNotStarted"])) {
	$JobsNotStarted  = $_GET["JobsNotStarted"]; 
	} 
	else{ 
	$JobsNotStarted=1;
	};  
$start_fromJobsNotStarted = ($JobsNotStarted-1) * $limit;

include('header.php');
 
 
 
/*******************Queries added for pie chart************************/ 
$sql_TotalJobs = "SELECT count(id) FROM cb_order_new";
$result_TotalJobs = $conn->query($sql_TotalJobs);
$row_TotalJob = $result_TotalJobs->fetch_array();
//echo "Total Jobs";
$row_TotalJobs = $row_TotalJob['0'];


$sql_JobsCoverSheet = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 1";
$result_JobsCoverSheet = $conn->query($sql_JobsCoverSheet);
$row_JobsCoverSheet = $result_JobsCoverSheet->fetch_array();
$row_JobsCoverSheet = $row_JobsCoverSheet['0'];


$sql_JobsProjctDetails = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 2";
$result_JobsPrjDetails = $conn->query($sql_JobsProjctDetails);
$row_JobsPrjDetails = $result_JobsPrjDetails->fetch_array();
//echo "PrjDetails";
$row_JobsPrjDetails = $row_JobsPrjDetails['0'];


$sql_JobsQualifyFive = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 3";
$result_JobsQualifyFive = $conn->query($sql_JobsQualifyFive);
$row_JobsQualifyFive = $result_JobsQualifyFive->fetch_array();
//echo "QualifyFive";
$row_JobsQualifyFive = $row_JobsQualifyFive['0'];

$sql_JobsDistributnChkklist = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 4";
$result_JobsDistributnChkklist = $conn->query($sql_JobsDistributnChkklist);
$row_JobsDistributnChkklist = $result_JobsDistributnChkklist->fetch_array();
//echo "DistributnChkklist";
$row_JobsDistributnChkklist = $row_JobsDistributnChkklist['0'];

$sql_JobsReviewDone = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.order_stage = 6";
$result_JobsReviewDone = $conn->query($sql_JobsReviewDone);
$row_JobsReviewDone = $result_JobsReviewDone->fetch_array();
//echo "DistributnChkklist";
$row_JobsReviewDone = $row_JobsReviewDone['0'];

$sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 1";
$result_Jobsfield_remediation = $conn->query($sql_Jobsfield_remediation);
$row_Jobsfield_remediation = $result_Jobsfield_remediation->fetch_array();
//echo "Jobsfield_remediation";
$row_Jobsfield_remediation = $row_Jobsfield_remediation['0'];

$sql_JobsCN29 = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 2";
$result_JobsCN29 = $conn->query($sql_JobsCN29);
$row_JobsCN29 = $result_JobsCN29->fetch_array();
//echo $CN29;
$row_JobsCN29 = $row_JobsCN29['0'];

$sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 3";
$result_Jobsunknown_status = $conn->query($sql_Jobsunknown_status);
$row_Jobsunknown_status = $result_Jobsunknown_status->fetch_array();
//echo $unknown_status;
$row_Jobsunknown_status = $row_Jobsunknown_status['0'];

/*******************Queries End************************/ 
$userid = $_SESSION['userid'];
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID) || in_array("7", $roleID))
{
	
}else{
 session_destroy();
header("Location: index.php");	
}
?>
     <link href="assets/css/main.min.css" rel="stylesheet" />
<style>
thead.thead-default tr {
    cursor: pointer;
}
button.btn.btn-primary.rejectjobs {
    background-color: #f39c12 !important;
    border-color: #f39c12 !important;
    color: #fff !important;
    padding: 3px 9px;
    display: inline-block;
    margin-left: 0px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
}
.inlineInput{
			min-width:200px !important;
	   }
	   .checkbox1{
			display:inline;
			width:250px;
	   }
       .help-block {
    display: block;
    font-size: 13px;
    margin-bottom: 0;
    margin-top: 2px;
    color: #e40930;
}
.card-body.admin-fixeddiv h4 {
    font-size: 15px;
}
.text-blue.divspan01 {
    padding-right: 20px;
    width: 210px;
    display: inline-block;
}
 
select.custom-select.custom-select-sm.form-control.form-control-sm {
    width: 58px;
}
input.form-control.form-control-sm {
    background-color: #f4f5f9;
    border-color: #f4f5f9;
    border-radius: 24px;
}

.approvediv-color:hover {
color: #fff !important;
}
.color01{background: #117a8b !important;}

.approvediv-color {
    color: #fff !important;
    font-size: 14px !important;
    padding: 8px 24px !important;
    border-radius: 4px !important;
}
	.userprofile .card{
		color:#000;
		transition:1s;
		border-bottom:5px solid #5c6bc0;
		position:relative;
		 overflow: visible !important;
		border: 0;
		
	}
	.userprofile .user{
		margin-top:-50px;
	}
	.userprofile .card-body .social-link{
	    font-size: 25px;
		text-decoration: none;
	}
	.userprofile  data{
		width: 45px;
    height: 45px;
    background: #ccc;
    display: inline-block;
    padding-top: 12px;
	}		
	.userprofile  .view-btn-parent{	
		position:absolute;
		top:100%;
		left:50%;
		transform:translate(-50%,-50%);	
	}
	.userprofile  .view-btn{
		border-radius:25px !important;
		padding:9px 29px !important;
		font-weight:600;
		color:white;
		transition:1s;
	}
	.userprofile  .card:hover{
		box-shadow:0px 0px 5px #ddd;
	}
	.userprofile .user img{
		width: 100px;
	}
	.userprofile  .card-header{
		border-bottom:0;
		background:none;
	}
	.userprofile .d-flex.justify-content-center.text-center.pb-2 i {
		display: block;
	}
#determine_the_MOI {
    
    white-space: pre-wrap;
}
</style>

	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">  
                <div class="row mb-4">
                    <?php
                    $queryreviewer = "SELECT id,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_user.profile_image,CONCAT(cb_user.city, ',' , cb_user.state) as address,cb_user.email FROM   cb_user WHERE role_id=3";
                   // $queryreviewer = "SELECT CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_user.profile_image,cb_user.address,cb_user.email,cb_order_new.user_id, count(*) as total_count,COUNT(if(order_stage='5',1,NULL)) as pending_count,COUNT(if(order_stage='6',1,NULL)) as completed_count FROM cb_order_new INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id) GROUP BY user_id";
                    $resultreviewer = $conn->query($queryreviewer);
                   while($rowreviewer = $resultreviewer->fetch_assoc()) {
                    ?>
                    
                              
									
									<div class="col-md-4 py-4 userprofile mb-4">
				<div class="card text-center mt-4">
					<div class="user">
						<?php if($rowreviewer['profile_image']==''){
                                            ?>
                                            <img class="img-circle" src="./profile_image/users01.png" alt="image"/>
                                            <!--<img class="img-circle" src="assets/img/users/u1.jpg" alt="image"/>-->
                                            <?php
                                            
                                            } else{   ?>
                                            <img class="img-circle" src="profile_image/<?= $rowreviewer['profile_image'] ?>" alt="image"/>
                                            <?php } ?>					
					</div>
					<div class="card-header">
						<h4><?= $rowreviewer['name'] ?></h4>
					</div>
					<div class="card-body pt-1">
						<div class="d-flex justify-content-center text-center pb-2">
 							<a href="http://maps.google.com/?q=<?= $rowreviewer['address'] ?>" target="_blank" class=""><i class="fa fa-map-marker px-3 social-link" aria-hidden="true"></i> <?= $rowreviewer['address'] ?> </a> &nbsp; &nbsp;
							<a href="mailto:<?= $rowreviewer['email'] ?>" target="_top" class=""><i class="fa fa-envelope-o px-3 social-link" aria-hidden="true"></i><?= $rowreviewer['email'] ?></a>
						</div>
						<ul class="nav nav-pills nav-fill py-4">
						  <li class="nav-item position-relative">Total <data class="rounded-circle">
						   <?php
                                                        $querytcount="SELECT COUNT(id) as total_count FROM cb_order_new WHERE user_id='".$rowreviewer['id']."'";
                                                        $resulttcount = $conn->query($querytcount);
                                                        $totalcount = $resulttcount->fetch_assoc()
                                                        ?>
                                                            
                                                            <?= $totalcount['total_count'] ?>
						  </data></li>
						  <li class="nav-item position-relative">Completed <data class="rounded-circle">
							<?php
                                                        $queryccount="SELECT COUNT(id) as completed_count FROM cb_order_new WHERE order_stage='6' && user_id='".$rowreviewer['id']."'";
                                                        $resulctcount = $conn->query($queryccount);
                                                        $completed_count = $resulctcount->fetch_assoc()
                                                        ?>
                                                            <?= $completed_count['completed_count'] ?>
						  </data></li>
						  <li class="nav-item position-relative">Pending <data class="rounded-circle">
							<?php
                                                        $querypcount="SELECT COUNT(id) as pending_count FROM cb_order_new WHERE order_stage='5' && user_id='".$rowreviewer['id']."'";
                                                        $resultpcount = $conn->query($querypcount);
                                                        $pending_count = $resultpcount->fetch_assoc()
                                                        ?>
                                                            <?= $pending_count['pending_count'] ?>
						  </data></li>						  
						</ul>						
					</div>	
					<div class="view-btn-parent"><a href="user_proxy.php?id=<?php echo $rowreviewer['id']?>" class="btn btn-warning view-btn mb-4"><i class="fa fa-eye"></i> View All</a></div>
				</div>				
			</div>
                   <?php } ?>
                
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Jobs for Approval</h5>
									</div>
                                </div>
								<div class="d-flex justify-content-between flexible-status-search">
                                  
										<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Status:</label>
												<select class="selectpicker show-tick form-control selectpickerdiv2" id="type-filterjobstatus" title="Please select" data-style="btn-solid" data-width="150px">
													<option value="">All</option>
													<option value="2">CN-29 Eligible</option>
													<option value="1">Field Remediation Required</option>
													<option value="3">Unknown Status</option>													
												</select>
											</div>
										</div>
									
									<div>                                        
										<div class="d-flex align-items-center justify-content-end searchinputdiv">
											<label class="Searchdivclass mr-2 ml-0">Search</label>
											<div class="input-group-icon input-group-icon-left">
												<input  value="" class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-search" type="text" placeholder="">
												<input type="hidden" id="limitid" value="<?php echo '5';  ?>">
												<input type="hidden" id="pageid" value="1">
												<input type="hidden" id="sortOrder" value="DESC">	
								                <input type="hidden" id="sortField" value="ORDER_NO">
											</div>
										</div>
									</div>                                    
                                </div>
                               <div id="results"></div>
                    <div class="loader"></div>
  
            </div></div></div></div>
            
            <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Jobs Status</h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">

                                        <div class="flexbox control-div mb-2">
                                            <div class="flexbox">
                                                <label class="mb-0 pr-2 ml-0">Status:</label>
                                                <select class="selectpicker show-tick form-control" id="type-filter2" title="Please select" data-style="btn-solid" data-width="150px">
                                            <option value="">All</option>
                                            <option value="2">CN-29 Eligible</option>
                                            <option value="1">Field Remediation Required</option>
                                            <option value="3">Unknown Status</option>

                                            <option value="6">Approved</option>
                                            <option value="7">Rejected</option>
                                        </select>
                                   </div>
									</div>
										<div>
                                            <div class="d-flex align-items-center justify-content-end searchinputdiv">
                                                <label class="Searchdivclass mr-2 ml-0">Search</label>
                                                <div class="input-group-icon input-group-icon-left">
                                                    <input class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-search2" type="text" placeholder="">
                                                </div>
												<input type="hidden" id="sortOrderjobstatus" value="DESC">	
								                <input type="hidden" id="sortFieldjobstatus" value="ORDER_NO">
                                            </div>
                                        </div>
									</div>
                                    
                              <div id="results2"></div>
                    <div class="loader2"></div>  
   
       
            </div></div></div></div>
            
            <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Jobs by BR CB Team</h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">

                                        <div class="flexbox control-div mb-2">
                                            <div class="flexbox">
                                                <label class="mb-0 pr-2 ml-0">Status:</label>
                                                <select class="selectpicker show-tick form-control" id="type-filter3" title="Please select" data-style="btn-solid" data-width="150px">
                                            <option value="">All</option>
                                            <!--<option value="2">CN-29 Eligible</option>-->
                                            <!--<option value="1">Field Remediation Required</option>-->
                                            <!--<option value="3">Unknown Status</option>-->
                                            <option value="4">CN29 Eligible per BR CB Team</option>
                                            <option value="5">Incomplete</option>
                                             

                                        </select>
                                   </div>
									</div>
										<div>
                                            <div class="d-flex align-items-center justify-content-end searchinputdiv">
                                                <label class="Searchdivclass mr-2 ml-0">Search</label>
                                                <div class="input-group-icon input-group-icon-left">
                                                    <input class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-search3" type="text" placeholder="">
                                                </div>
                                            </div>
                                        </div>
									</div>
                                        <div id="results3"></div>
                    <div class="loader3"></div>    
                              
            </div></div></div></div>
            
            <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Jobs Not Started</h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">

                                        <div class="flexbox control-div mb-2">
                                            <div class="flexbox">
                                                <label class="mb-0 pr-2 ml-0">Status:</label>
                                                <select class="selectpicker show-tick form-control" id="type-filtercompleted" title="Please select" data-style="btn-solid" data-width="150px">
                                            <option value="">All</option>
                                             

                                        </select>
                                   </div>
									</div>
										<div>
                                            <div class="d-flex align-items-center justify-content-end searchinputdiv">
                                                <label class="Searchdivclass mr-2 ml-0">Search</label>
                                                <div class="input-group-icon input-group-icon-left">
                                                    <input class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-searchcompleted" type="text" placeholder="">
                                                </div>
                                            </div>
                                        </div>
									</div>
                                    
                                 <div id="results4"></div>
                    <div class="loader4"></div> 
                                
            </div></div></div></div>
              <div class="row">
            <div class="col-lg-4 mb-md-4">
                      <div class="ibox">
                            <div class="ibox-head">
                               <div class="ibox-title">Total Jobs</div>
                            </div>
                          <div class="ibox-body">
                                 <div class="chart-wrapper">
                                    <div id="dash_pie_totaljobs" style="height:150px;"></div>
                                   
                                    <input type="hidden" name="total_jobs" value="<?php echo $row_TotalJobs;?>">
                                   <input type="hidden" name="JobsCoverSheet" value="<?php echo $row_JobsCoverSheet;?>">
                                   <input type="hidden" name="JobsPrjDetails" value="<?php echo $row_JobsPrjDetails;?>">
                                    <input type="hidden" name="JobsQualifyFive" value="<?php echo $row_JobsQualifyFive;?>">
                                    <input type="hidden" name="JobsDistributnChkklist" value="<?php echo $row_JobsDistributnChkklist;?>">
                                    <input type="hidden" name="Jobsreviewdone" value="<?php echo $row_JobsReviewDone;?>">
                                   <input type="hidden" name="JobsStatusCN29" value="<?php echo $row_JobsCN29;?>">
                                    <input type="hidden" name="JobsStatusFieldRemediation" value="<?php echo $row_Jobsfield_remediation;?>">
                                   <input type="hidden" name="JobsStatusUnknownStatus" value="<?php echo $row_Jobsunknown_status;?>">
                                </div>
                            </div>
                        </div>
                   </div>
                    <div class="col-lg-4 mb-md-4">
                        <div class="ibox">
                           <div class="ibox-head">
                               <div class="ibox-title">Form Stages</div>
                           </div>
                            <div class="ibox-body">
                                <div class="chart-wrapper">
                                    <div id="dash_pie_formstage" style="height:150px;"></div>
                               </div>
                           </div>
                       </div>
                   </div>
                    <div class="col-lg-4 mb-md-4">
                        <div class="ibox">
                          <div class="ibox-head">
                              <div class="ibox-title">Job Status</div>
                         </div>
                         <div class="ibox-body">
                            <div class="chart-wrapper">
                              <div id="dash_jobstatus" style="height:150px;"></div>
                           </div>
                          </div>
                        </div>
                  </div>
                      
               </div>
           <div class="modal fade customModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="exampleModal">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="container">					
                           <form id="form-wizard" action="javascript:;" method="post" novalidate="novalidate" class="mform stepForm wizard p-2 background-form-div clearfix" role="application">
						    <button type="button" class="close buttondivbold" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
                           </button>
							<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Cover Sheet</h5>
                           <div class="rowdiv1">
						    <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">LANID</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly="" value="" id="lanid" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Created On</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly="" value="" id="review_date" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Reviewer Completion Date</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="" readonly value="" id="review_completion_date" class="form-control">
                                       <input type="hidden" id="OREDRNO" value="">
                                       <input type="hidden" id="USERID" value="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Number</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly=""   value="" id="order_no" class="form-control valid" placeholder="" aria-invalid="false">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Project ID</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="project_id" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Division</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly  id="division" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">City</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="city" class="form-control">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Description</label>
                                    <div class="col-sm-7">
                                       <textarea  value="" readonly id="order_description" class="form-control"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">FE/CM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="FE_CM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">CE/RCM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="CE_RCM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Foreman</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="foreman" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">M&amp;C Supervisor</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="m_c_supervisor" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Distribution/Transmission</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid" readonly aria-invalid="false" id="Distribution_Transmission">
                                         
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Resp Group</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid" readonly aria-invalid="false" id="resp_gp">
                                        
                                    </div>
                                 </div>
                              </div>
                           </div>
                           </div>
						   <h5 class="font-strong mb-4 pt-4 formheadingdiv01">Project Details</h5>
						   <div class="rowdiv1">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="row mb-2 pb-1">
                                    <div class="col-sm-12">									   
									   <div class="row p-0">
											<div class=" col-1 p-0">
												<label class="pl-4">MAT</label>
											</div>
											<div class=" col-10 p-0">
												<input type="text" value="" readonly id="mat" class="form-control full-w-input">
											
											</div>
											<div class=" col-1">
												 <div class="custom-control custom-checkbox ml-4">
													 <input type="checkbox" value="" disabled="disabled" class="custom-control-input" id="Checkmat">
													 <label class="custom-control-label checkdivclass" readonly for="Checkmat"></label>
												  </div>
											</div>
									   </div>                             
                                          
                                         
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">

                                          <label class="pl-4 paddcol-div">CN24</label>
										  <span class="inlineInput inlineinput2">
                                          <input id="cn24" type="text" readonly class="form-control inlineInput inlineinput2">                                            
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value="" readonly  id="cn24_lanid" class="form-control valid" placeholder="" aria-invalid="false">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value="" readonly id="cn24_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" id="check_cn24" disabled="disabled" class="custom-control-input">
                                             <label class="custom-control-label checkdivclass" for="check_cn24"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">CN29</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly class="form-control" id="cn29">
                                              
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input value="" readonly id="cn29_lanid" type="text" class="form-control" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                             <!--<input  type="text" value="" id="cn29_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="Date">-->
                                             <input type="text" readonly value="" id="cn29_date" class="form-control datepicker" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" disabled="disabled" class="custom-control-input" id="check_cn29">
                                             <label class="custom-control-label checkdivclass" for="check_cn29"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">CN07</label>
                                          <span class="inlineInput inlineinput2">
										  
                                             <input type="text" readonly class="form-control" id="cn07">
                                                
                                             
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="cn07_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="cn07_date" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" disabled="disabled" class="custom-control-input" id="check_cn07">
                                             <label class="custom-control-label checkdivclass" for="check_cn07"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 39</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="dc39">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc39_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc39_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 46</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly class="form-control" id="dc46">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc46_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc46_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 05</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="dc05">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc05_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc05_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 14</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly  class="form-control" id="dc14">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc14_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc14_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 15</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="dc15">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc15_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc15_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 19</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly class="form-control valid" id="dc19" aria-invalid="false">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc19_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc19_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 10</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly  class="form-control" id="dc10">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc10_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc10_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 
                              </div>
							  <div class="row">
                                    <div class="col-sm-12 pl-4 paddcol-div">
                                       <div class="form-group fild-width textarea-formdiv">
                                          <label class=" d-block">General comments for SAP task (CN/DC): </label>
                                          <textarea  value="" readonly id="cmt_cn_dc" class="form-control bg-white"></textarea>
                                       </div>
                                    </div>
                               </div>
							   </div>
                            <h5 class="font-strong mb-4 pt-4 formheadingdiv01">Qualifying Five</h5>
							<div class="rowdiv1">
                           <div class="row padd-div">
                              <div class="col-sm-8 col-md-4 align-self-center">
                                 <div class="form-group fild-width">
                                    <label>CN29 completed under Task Tab in SAP or in the Notification Long Text?</label>
                                 </div>
                              </div>
                              <div class="col-sm-4 col-md-2 align-self-center">
                                 <div class="outerDivFull">
                                    <div class="switchToggle">
                                       <input type="checkbox" readonly name="name" value="" id="CN29_in_SAP" disabled>
                                       <label for="CN29_in_SAP">Toggle</label>
                                    </div>
                                    <!--<div class="switchToggle">
                                       <input type="checkbox" name="name" value="" id="switch1" >
                                       <label for="switch1">Toggle</label>
                                       </div>-->
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group class-color_div">
                                  <textarea rows="2" readonly id="CN29_in_SAP_cmt" value="" class="form-control bg-white" placeholder=""></textarea>
                                 </div>
                                 <span class="errorcmt" readonly id="errorcmt" style="display:none;color:red;">Please Enter Notes</span>
                              </div>
                           </div>
                           <div id="qualfi" class="">
                              <div class="row padd-div CN24-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Has the work been completed ?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="CN24">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="CN24_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="errorCN24_cmt" style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                              <div class="row padd-div gas_assets_installed-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Was any gas assets (ex. valve, pipe, Etc.) installed?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="gas_assets_installed">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="gas_assets_installed_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="errorgas_assets_installed_cmt" style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                              <div class="row padd-div installation_below_ground-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Installation took place below ground?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="installation_below_ground">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="installation_below_ground_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="errorinstallation_below_ground_cmt" style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                              <div class="row padd-div MOI-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>What is the Method of Installation (MOI)</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" id="errorMOI_cmt" readonly style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                           </div>
						    </div>
							  <h5 class="font-strong mb-4 pt-4 formheadingdiv01">Checklist Questions</h5>
							  <div class="rowdiv1 mb-3">
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Was Display Notification in SAP Reviewed </label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="outerDivFull">
                                       <div class="switchToggle">
                                          <input type="checkbox" name="name" readonly value="" id="SAP_Reviewed" disabled>
                                          <label for="SAP_Reviewed">Toggle</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" value="" readonly id="SAP_Reviewed_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>MOI for Srv (s)?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="MOI_for_Srv">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="MOI_for_Srv_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>MOI for Main (s)?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="MOI_for_Main">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="MOI_for_Main_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Type of document used to determine the MOI</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input readonly type="text" class="form-control" id="determine_the_MOI">
                                       <!--<p id="determine_the_MOI"></p>-->
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="determine_the_MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Which software was used to retrieve the document (Ex. Unifier, ECTS, SAP) </label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="used_to_retrieve_the_document">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="used_to_retrieve_the_document_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Doc Number From SAP</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="outerDivFull">
                                       <div class="switchToggle select-box-div">
                                          <input type="text" readonly value="" id="SAP" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="SAP_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>PRE- Inspection Document (s) Provided?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="PRE_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Post Inspection Required per PRE-Inspection Document (s)?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                      <input type="text" readonly class="form-control" id="Post_Inspection_Required_per_PRE_Inspection">
                                        
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="Post_Inspection_Required_per_PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>POST- Inspection Document (s) Provided?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="POST_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="POST_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Cross Bore Log (s) Ready for Inspection ?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="Cross_Bore_Log">                                          
                                    </div>
                                    <!--<div class="outerDivFull">
                                       <div class="switchToggle">
                                           <input type="checkbox" name="name" value="" id="Cross_Bore_Log">
                                           <label for="Cross_Bore_Log">Toggle</label>
                                       </div>
                                       </div>-->
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" id="Cross_Bore_Log_cmt" readonly class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                               <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Recommendation</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-8">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" id="recommendation" readonly class="form-control bg-white" placeholder=""></textarea>
                                     </div>
                                 </div>
                              </div>
                              
                               <div class="row padd-div reason-reject">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Reason for reject if any  ?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-8">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" id="reject_cmt" class="form-control bg-white" placeholder=""></textarea>
                                      <span class="error errorcomment"></span>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="download-icondiv">
                                  
                                  <?php 
                              if (in_array("1", $roleID))
                                    {
                              ?>
                                    <a><button type="button" onclick="return Reject()"  class="btn btn-danger approvediv-color mr-2 mb-2 show-action">Reject</button></a>

                                    <a><button onclick="return Approveview()" type="button"  class="btn btn-primary approvediv-color mr-2 mb-2 show-action" id="submit">Approve</button></a>
									<?php }else{
									?>
								 <a><button type="button"  disabled class="btn btn-danger approvediv-color mr-2 mb-2">Reject</button></a>

                                    <a><button  type="button" disabled class="btn btn-primary approvediv-color mr-2 mb-2" id="submit">Approve</button></a>
										
									<?php
									
									} ?>
								 
									<a><button type="button" onclick="return downloadpdf()" class="btn btn-primary approvediv-color mr-2 mb-2">Download PDF</button></a>
                                 </div>
                          <!--<div class="">-->
                          <!--    <button onclick="return Reject()" class="btn btn-danger">Reject</button>-->
                          <!--</div>-->
						   </div>
                            </form>
                        </div>
                       
                     </div>
                  </div> </div>     
            <!-- END PAGE CONTENT-->
         <?php include('footer.php');  ?>  
          <script src="assets/js/dashboard.admn.min.js"></script><!--Piechart js-->

 <script>

           
//$(document).ready(function() {
  //$(document).on('change','.datepicker2',function() {
    //     $("#submit").on("click", function() {
    function Approve() {
        
             var approveby = '<?= $userid ?>';
         var order_no = new Array();
$.each($("input[name='reviewer[]']:checked"), function() {
  order_no.push($(this).val());
  // or you can do something to the actual checked checkboxes by working directly with  'this'
  // something like $(this).hide() (only something useful, probably) :P
});
if(order_no==''){
  $('#error').text('Please select atleast one job');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to Approve selected jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Approve'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                      //location.reload();
									  $('#error').text('Job Approved successfully'); 
									  $('#error').css({'color':'green'});
									   setTimeout(function(){
										location.reload();
									  },5000)
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
    }  
    
  function Approveview() {
      $('.errorcomment').text('');
             var approveby = '<?= $userid ?>';
         var order_no = $('#OREDRNO').val();
if(order_no==''){
  $('.errorcomment').text('Please select atleast one job');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to Approve this jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Approveview'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                      location.reload();
                                  //alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
    }     
    
function Reject() {
             var approveby = '<?= $userid ?>';
         var order_no = $('#order_no').val();
 var comment = $('#reject_cmt').val();

if(comment==''){
  $('.errorcomment').text('Please enter the commnet');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to Reject this job.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Reject',comment:comment}
                                    });
                                  
                                    request.done(function(msg) {
                            
                                    // console.log(msg);
                                       location.reload();
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                //    alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
    }      
//});
//});

function downloadpdf() {
  var approveby = $('#USERID').val();
var order_no = $('#OREDRNO').val();
 window.location.href='GenPdf.php?id='+approveby+'&ono='+order_no
}  

</script>

<script>
$(document).ready(function(){
    $( "#reject_cmt" ).focus(function() {
 $('.errorcomment').text('');
                            });
});
</script>
<script type="text/javascript">
 
        // fetching records
                            function displayRecords(numRecords, pageNum,Keysearch,jobstatus,total_pages,SORT_FIELD) {
								
						  
							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
							var sortOrder = $('#sortOrder').val(); 
	                        var sortField = $('#sortField').val();
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobaproval.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results").html(html);
                                        $('.loader').html('');
                                    }
                                });
                            }

        // used when user change row limit
                            function changeDisplayRowCount(numRecords) {
                                displayRecords(numRecords, 1);
                            }

                            $(document).ready(function() {
                                displayRecords(5, 1,'','','','');
								//console.log($("#key-search").val());
                            });
		 		
        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#key-search').keyup(function(e){
		 console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();	
    var Keysearch = $(this).val();
	 if($('#type-filterjobstatus').val()=='undefined')	{
	 var jobstatus = '';	
	}else{
	var jobstatus = $('#type-filterjobstatus').val();	
	}
	var sortOrder = $('#sortOrder').val(); 
	var sortField = $('#sortField').val();
         // fetching records
             
 								 
 								//alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobaproval.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results").html(html);
                                        $('.loader').html('');
                                    }
                                });
								});
 });  
                          

        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#type-filterjobstatus').on('change',function(e){
		// console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();
    if($('#key-search').val()=='undefined')	{
	 var Keysearch = '';	
	}else{
	 var Keysearch = $('#key-search').val();	
	}
   
	var jobstatus = $(this).val();
         // fetching records
    var sortOrder = $('#sortOrder').val(); 
	var sortField = $('#sortField').val();         
 								 
 							// alert(jobstatus);
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobaproval.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results").html(html);
                                        $('.loader').html('');
                                    }
                                });
								});
 });  
                          

        </script>
	<script type="text/javascript">
 
        // fetching records
                            function displayRecordsbysort(numRecords, pageNum,Keysearch,jobstatus,SORT_FIELD) {
								//alert('ok');
							//var Keysearchcheck = $('#key-search').val();
 
 							$('#sortField').val(SORT_FIELD);
							var sortOrder = $('#sortOrder').val(); 
							var sortField = $('#sortField').val(); 
							if(sortOrder=='ASC'){
							 var sortOrder = 	'DESC';
							 $('#sortOrder').val('DESC');
   							}else{
							var sortOrder = 	'ASC';
                            $('#sortOrder').val('ASC');	
 
 							}
							 
						    var id = <?= $userid ?>;
							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
							 
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobaproval.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&id=" + id + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results").html(html);
                                       // $('.loader').html('');
                                    }
                                });
                            }

		 		
        </script>	
		<script type="text/javascript">
 
        // fetching records
                            function displayRecordsjobstatus(numRecords, pageNum,Keysearch,jobstatus,total_pages) {
								
					 
							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
                          var sortOrder = $('#sortOrderjobstatus').val(); 
	                     var sortField = $('#sortFieldjobstatus').val(); 
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobstatus.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results2").html(html);
                                        $('.loader2').html('');
                                    }
                                });
                            }

        // used when user change row limit
                            function changeDisplayRowCount(numRecords) {
                                displayRecords(numRecords, 1);
                            }

                            $(document).ready(function() {
                                displayRecordsjobstatus(5, 1,'','');
								//console.log($("#key-search").val());
                            });
		 		
        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#key-search2').keyup(function(e){
		 console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();	
    var Keysearch = $(this).val();
	 if($('#type-filter2').val()=='undefined')	{
	 var jobstatus = '';	
	}else{
	var jobstatus = $('#type-filter2').val();	
	}
	var sortOrder = $('#sortOrderjobstatus').val(); 
	var sortField = $('#sortFieldjobstatus').val(); 
         // fetching records
             
 								 
 								//alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobstatus.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader2').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results2").html(html);
                                        $('.loader2').html('');
                                    }
                                });
								});
 });  
                          

        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#type-filter2').on('change',function(e){
		// console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();
    if($('#key-search2').val()=='undefined')	{
	 var Keysearch = '';	
	}else{
	 var Keysearch = $('#key-search2').val();	
	}
   
	var jobstatus = $(this).val();
         // fetching records
     var sortOrder = $('#sortOrderjobstatus').val(); 
    var sortField = $('#sortFieldjobstatus').val();         
 								 
 							// alert(jobstatus);
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobstatus.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader2').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results2").html(html);
                                        $('.loader2').html('');
                                    }
                                });
								});
 });  
                          

        </script>
		
		<script type="text/javascript">
  
        // fetching records
                            function displayRecordsbysortjobstatus(numRecords, pageNum,Keysearch,jobstatus,SORT_FIELD) {
								//alert('ok');
							//var Keysearchcheck = $('#key-search').val();
 
 							$('#sortFieldjobstatus').val(SORT_FIELD);
							var sortOrder = $('#sortOrderjobstatus').val(); 
							var sortField = $('#sortFieldjobstatus').val(); 
							if(sortOrder=='ASC'){
							 var sortOrder = 	'DESC';
							 $('#sortOrderjobstatus').val('DESC');
   							}else{
							var sortOrder = 	'ASC';
                            $('#sortOrderjobstatus').val('ASC');	
 
 							}
							 
 							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
							 
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "adminjobstatus.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results2").html(html);
                                       // $('.loader').html('');
                                    }
                                });
                            }

		 		
        </script>
		<script type="text/javascript">
 
        // fetching records
                            function displayRecordsjobstatuscompletedjobs(numRecords, pageNum,Keysearch,jobstatus,total_pages) {
								
					  
							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "admincompletedjobs.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results3").html(html);
                                        $('.loader3').html('');
                                    }
                                });
                            }

        // used when user change row limit
                          

                            $(document).ready(function() {
                                displayRecordsjobstatuscompletedjobs(5, 1,'','','');
								//console.log($("#key-search").val());
                            });
		 		
        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#key-search3').keyup(function(e){
		 console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();	
    var Keysearch = $(this).val();
	 if($('#type-filter3').val()=='undefined')	{
	 var jobstatus = '';	
	}else{
	var jobstatus = $('#type-filter3').val();	
	}
	
         // fetching records
             
 								 
 								//alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "admincompletedjobs.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader2').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results3").html(html);
                                        $('.loader3').html('');
                                    }
                                });
								});
 });  
                          

        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#type-filter3').on('change',function(e){
		// console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();
    if($('#key-search3').val()=='undefined')	{
	 var Keysearch = '';	
	}else{
	 var Keysearch = $('#key-search3').val();	
	}
   
	var jobstatus = $(this).val();
         // fetching records
             
 								 
 							// alert(jobstatus);
                                $.ajax({
                                    type: "GET",
                                    url: "admincompletedjobs.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader2').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results3").html(html);
                                        $('.loader3').html('');
                                    }
                                });
								});
 });  
                          

        </script>
<script type="text/javascript">
 
        // fetching records
                            function displayRecordsjobnotstarted(numRecords, pageNum,Keysearch,jobstatus,total_pages) {
							
						 
							//var Keysearchcheck = $('#key-search').val();
						
							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "AdminJobsNotStarted.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results4").html(html);
                                        $('.loader4').html('');
                                    }
                                });
                            }

        // used when user change row limit
                          

                            $(document).ready(function() {
                                displayRecordsjobnotstarted(5, 1,'','','');
								//console.log($("#key-search").val());
                            });
		 		
        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#key-searchcompleted').keyup(function(e){
		 console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();	
    var Keysearch = $(this).val();
	 if($('#type-filtercompleted').val()=='undefined')	{
	 var jobstatus = '';	
	}else{
	var jobstatus = $('#type-filtercompleted').val();	
	}
	
         // fetching records
             
 								 
 								//alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "AdminJobsNotStarted.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader4').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results4").html(html);
                                        $('.loader4').html('');
                                    }
                                });
								});
 });  
                          

        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#type-filtercompleted').on('change',function(e){
		// console.log("11111");
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();
    if($('#key-searchcompleted').val()=='undefined')	{
	 var Keysearch = '';	
	}else{
	 var Keysearch = $('#key-searchcompleted').val();	
	}
   
	var jobstatus = $(this).val();
         // fetching records
             
 								 
 							// alert(jobstatus);
                                $.ajax({
                                    type: "GET",
                                    url: "AdminJobsNotStarted.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus,
                                    cache: true,
									beforeSend: function() {
                                        $('.loader2').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results4").html(html);
                                        $('.loader4').html('');
                                    }
                                });
								});
 });  
                          

        </script>
     