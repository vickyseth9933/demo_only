<?php
//include('header_review_new.php');
include('../header_snr_review.php');
$userid = $_SESSION['userid'];
$sdate = $_REQUEST['sdate'];
$sdate = date('Y-m-d', strtotime($sdate));
$enddate = $_REQUEST['enddate'];
$enddate = date('Y-m-d', strtotime($enddate));
$monthyear = $_REQUEST['monthyear'];
$monthyear = date('Y-m', strtotime($monthyear));
 
   $filter = $_REQUEST['filter'];
//echo "kiiiii";

//echo "<pre>";print_r($_REQUEST);



 if($filter=='' || $_REQUEST['jobstatusr']!='piechart'){
   $sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 1";
   }else{
   if($filter=='month'){    
   $sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM cb_order, cb_front_cover 
   WHERE cb_order.order_id = cb_front_cover.order_id and  cb_order.status = 1 AND DATE_FORMAT(cb_front_cover.dateofreview, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM cb_order, cb_front_cover 
   WHERE cb_order.order_id = cb_front_cover.order_id and cb_order.status = 1 AND DATE(cb_front_cover.dateofreview) >= '$sdate' AND DATE(cb_front_cover.dateofreview) <= '$enddate'";
   }
      
   }
   $result_Jobsfield_remediation = $conn->query($sql_Jobsfield_remediation);
   $row_Jobsfield_remediation = $result_Jobsfield_remediation->fetch_array();
   //echo "Jobsfield_remediation";
   $row_Jobsfield_remediation = $row_Jobsfield_remediation['0'];
   
   
   if($filter=='' || $_REQUEST['jobstatusr']!='piechart'){
   $sql_JobsCN29 = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 2";
   }else{
   if($filter=='month'){    
   $sql_JobsCN29 = "SELECT count(cb_order.id) FROM cb_order, cb_front_cover 
   WHERE cb_order.order_id = cb_front_cover.order_id and  cb_order.status = 2 AND DATE_FORMAT(cb_front_cover.dateofreview, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_JobsCN29 = "SELECT count(cb_order.id) FROM cb_order, cb_front_cover 
   WHERE cb_order.order_id = cb_front_cover.order_id and cb_order.status = 2 AND DATE(cb_front_cover.dateofreview) >= '$sdate' AND DATE(cb_front_cover.dateofreview) <= '$enddate'";
   }
      
   }
   $result_JobsCN29 = $conn->query($sql_JobsCN29);
   $row_JobsCN29 = $result_JobsCN29->fetch_array();
   //echo $CN29;
   $row_JobsCN29 = $row_JobsCN29['0'];
   
   
   if($filter=='' || $_REQUEST['jobstatusr']!='piechart'){
   $sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 3";
   }else{
   if($filter=='month'){    
   $sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM cb_order, cb_front_cover 
   WHERE cb_order.order_id = cb_front_cover.order_id and  cb_order.status = 3 AND DATE_FORMAT(cb_front_cover.dateofreview, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM cb_order, cb_front_cover 
   WHERE cb_order.order_id = cb_front_cover.order_id and cb_order.status = 3 AND DATE(cb_front_cover.dateofreview) >= '$sdate' AND DATE(cb_front_cover.dateofreview) <= '$enddate'";
   }
      
   }
   $result_Jobsunknown_status = $conn->query($sql_Jobsunknown_status);
   $row_Jobsunknown_status = $result_Jobsunknown_status->fetch_array();
   //echo $unknown_status;
   $row_Jobsunknown_status = $row_Jobsunknown_status['0'];
   
   /*******************Queries End************************/ 
   
   
   
if($_REQUEST['filter']=='' ||  $_REQUEST['jobstatusr']!='cn29_eligible'){
    $sqljob_cn29 = "SELECT cb_order_new.approved_date,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
    cb_project_details.mat FROM cb_order_new 
    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
    INNER JOIN  order_status ON(cb_order.status=order_status.id)
    WHERE order_status.order_name = 'CN-29 Eligible' AND  send_job_approval='1' AND order_stage= 6";
}

if($_REQUEST['filter']=='' || $_REQUEST['jobstatusr']!='fieldremedation'){
     $sqljob_field_remedtn = "SELECT cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
    cb_project_details.mat FROM cb_order_new 
    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
    INNER JOIN  order_status ON(cb_order.status=order_status.id)
    WHERE order_status.order_name = 'Field Remediation Required' AND  send_job_approval='1' AND order_stage= 6";
}  
if($_REQUEST['filter']=='' || $_REQUEST['jobstatusr']!='unknownstatus'){
    $sqljob_unknown_status = "SELECT order_status.order_name,cb_order_new.approved_date,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
    cb_project_details.mat FROM cb_order_new 
    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
    INNER JOIN  order_status ON(cb_order.status=order_status.id)
    WHERE order_status.order_name = 'Unknown Status' AND  send_job_approval='1' AND order_stage= 6";
}
if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='cn29_eligible'){
     $sqljob_cn29 = "SELECT cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'CN-29 Eligible'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE(cb_order_new.approved_date) >= '$sdate' AND DATE(cb_order_new.approved_date) <= '$enddate'";
}
if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='cn29_eligible'){
     $sqljob_cn29 = "SELECT cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'CN-29 Eligible'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE_FORMAT(cb_order_new.approved_date, '%Y-%m') = '$monthyear'";
}
if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='cn29_eligible'){
    $sqljob_cn29 = "SELECT cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'CN-29 Eligible'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE(cb_order_new.approved_date) >= '$sdate' AND DATE(cb_order_new.approved_date) <= '$enddate'";
}


if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='fieldremedation'){
    $sqljob_field_remedtn = "SELECT cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'Field Remediation Required'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE(cb_order_new.approved_date) >= '$sdate' AND DATE(cb_order_new.approved_date) <= '$enddate'";
}
if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='fieldremedation'){
    $sqljob_field_remedtn = "SELECT cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'Field Remediation Required'  AND  send_job_approval='1'  AND order_stage= 6 
                                    AND DATE_FORMAT(cb_order_new.approved_date, '%Y-%m') = '$monthyear'";
}
if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='fieldremedation'){
    $sqljob_field_remedtn = "SELECT cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'Field Remediation Required'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE(cb_order_new.approved_date) >= '$sdate' AND DATE(cb_order_new.approved_date) <= '$enddate'";
}
if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='unknownstatus'){
     $sqljob_unknown_status = "SELECT order_status.order_name,cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'Unknown Status'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE(cb_order_new.approved_date) >= '$sdate' AND DATE(cb_order_new.approved_date) <= '$enddate'";
}
if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='unknownstatus'){
    $sqljob_unknown_status = "SELECT order_status.order_name,cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'Unknown Status'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE_FORMAT(cb_order_new.approved_date, '%Y-%m') = '$monthyear'";
}
if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='unknownstatus'){
    $sqljob_unknown_status = "SELECT order_status.order_name,cb_order_new.approved_date,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'Unknown Status'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND DATE(cb_order_new.approved_date) >= '$sdate' AND DATE(cb_order_new.approved_date) <= '$enddate'";
}

$result_cn29          =  $conn->query($sqljob_cn29);
$result_field_remedtn =  $conn->query($sqljob_field_remedtn);
$result_unknown_status = $conn->query($sqljob_unknown_status);






/*******************Queries End************************/ 

$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("6", $roleID))
{
	
}else{
session_destroy();
header("Location: index.php");	
}
?>
<style>
 #form-wizard{
     width:768px;
 }
 .ui-datepicker-year{
    color: Black;
}
.ui-datepicker-month{
    color: Black;
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
    color: #e40930 !important;
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
		width: 25px;
		height: 25px;
		background: #ccc;
		display: inline-block;
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
	.form-group.month_year, .form-group.weekly, .form-group.date_range {
    margin-bottom: 0;
    margin-left: 10px;
}
.hasDatepicker {
    border-radius: 2px;
    border: 1px solid rgba(0, 0, 0, .1);
    margin: 0 8px;
}
.table-responsive {
    overflow-x: inherit;
}
.dataTables_wrapper div.dataTables_info {
    float: left;
}
.dataTables_wrapper div.dataTables_paginate {
    float: right;
    margin-top: 12px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    height: 31px;
    width: 31px;
    padding: 0;
    border: 0;
    margin: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #e2e2e2 !important;
    border-color: #e2e2e2 !important;
    color: #fff;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.previous, .dataTables_wrapper .dataTables_paginate .paginate_button.next {
    background: none !important;
    color: #333333;
    width:auto;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.previous a:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.next a:hover{
    color: #00a5df !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.previous a:focus, .dataTables_wrapper .dataTables_paginate .paginate_button.next a:focus{
    color: #00a5df !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button{
    margin-right: 8px;
}
a#dash_datatable_previous:hover, a#dash_datatable_next:hover{
    background:none !important;
    color: #5b6bc0 !important;
}

</style>

	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">  
             <input type="hidden" name="jstatus" class="job_status" id="job1" value="">

                
                <div class="row">
                    <div class="col-sm-12 mx-0 px-0">
                        
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">CN29 Eligible Jobs</h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">
                                  
										<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Status:</label>
												<select class="selectpicker show-tick form-control selectpickerdiv2" id="type-filtercn29" onchange="get_cn29_weekdata(this.value)" title="Please select" data-style="btn-solid" data-width="150px">
													
													<option value="All">All</option>
													<?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
													        <option value="week" selected>Weekly</option>
													<?php } else {  ?>
													        <option value="week">Weekly</option>
													<?php } ?>
													<?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
													    <option value="month" selected>Monthly</option>
													<?php } else {  ?>
													<option value="month">Monthly</option>
													<?php } ?>
													<?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
													<option value="custom" selected>Custom Date</option>
													<?php } else {  ?>
													<option value="custom">Custom Date</option>
													<?php } ?>
												</select>
												
											</div>
											<!--<div class="input-daterange input-group" id="datepicker">
                                              <input type="text" class="input-sm form-control" name="start">
                                              <span class="input-group-addon">to</span>
                                              <input type="text" class="input-sm form-control" name="end">
                                            </div>-->
                                            <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
                                                     <div class="form-group month_year" id="month_year1">
                                            <?php } else { ?>
                                                    <div style="display:none" class="form-group month_year" id="month_year1">
                                                    <?php } ?>
                                                        <div class='input-group date' id=''>
                                                        <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
                                                            <input class="form-control datepicker monthlyjob" name="" id="monthly1" type="text" value="<?=$_REQUEST['monthyear']?>">
                                                        <?php } else { ?>
                                                            <input class="form-control datepicker monthlyjob" name="" id="monthly1" type="text">
                                                        <?php } ?>
                                                        </div>
                                                    </div>
                                                    <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
                                                    <div class="form-group date_range" id="date_range1">
                                                <?php } else { ?>
                                                
                                             <div style="display:none" class="form-group date_range" id="date_range1">
                                            <?php } ?>     
                                                <div class='input-group date' id=''>
                                                <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>        
                                                <label for="from">From</label>
                                                <input class="" type="text" id="from1" name="from" value="<?= $_REQUEST['sdate'] ?>">
                                                <label for="to">to</label>
                                                <input class="" type="text" id="to1" name="to" value="<?= $_REQUEST['enddate'] ?>">
                                                <?php }else { ?>
                                                <label for="from">From</label>
                                                <input class="" type="text" id="from1" name="from">
                                                <label for="to">to</label>
                                                <input class="" type="text" id="to1" name="to">
                                                <?php } ?>

                                                </div>
                                            </div>
                                            <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
                                                    <div class="form-group weekly" id="weekly1">
                                            <?php } else { ?>
                                                    <div style="display:none" class="form-group weekly" id="weekly1">
                                            <?php } ?>
                                                <div class='input-group date' id=''>
                                            <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='cn29_eligible') { ?>
                                                    <input class="form-control datepicker3"  name="weekdays" id="weekfilter1" type="text" value="<?=$_REQUEST['sdate']. ' - '.$_REQUEST['enddate']?>">
                                            <?php } else { ?>
                                                    <input class="form-control datepicker3"  name="weekdays" id="weekfilter1" type="text">
                                            <?php } ?>
                                                
                                                </div>
                                            </div>
                                           
										</div>
									
									<div>                                        
										<div class="d-flex align-items-center justify-content-end searchinputdiv">
											<label class="Searchdivclass mr-2 ml-0">Search</label>
											<div class="input-group-icon input-group-icon-left">
												<input class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-search" type="text" placeholder="">
											</div>
										</div>
									</div>                                    
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="dash_datatable">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <!--<th><input name="select_all" value="1" id="adtbl-select-all" type="checkbox" /></th>-->
                                                        <th>Assign To</th>
                                                        <th>Approved Date</th>
                                                        <th>Order No</th>
                                                        <th>Order Description</th>
                                                        <th>Resp Group</th>
                                                        <th>MAT</th>
                                                        <th>Job Status</th>
                                                        <th>Action</th> 
                                                    </tr>
                                                </thead>
                                                
                                                <tbody id="res_data">
                                                    	<?php
                                                    	$ArrOrderNo = array();
											                while($row = $result_cn29->fetch_assoc()) {
											                    $ArrOrderNo[] = $row['order_no'];?>
                                                                <tr>
                                                                    <!--<td><input type="checkbox" name="reviewer[]" class="checkbox" value="<?php echo $row['order_no'];?>"></td>-->
                                                                     <input type="hidden" name="memid" value="<?php echo $row['order_no'];?>" id="hiddenorderid">
                                                                     <input type="hidden" name="memid" value="<?php echo $row['user_id'];?>" id="hiddenuserid">
                                                                     <td><?= $row['name']; ?></td>
                                                                     <td><?php if($row['approved_date'] == '0000-00-00 00:00:00') { echo 'N/A'; } else { echo date('m-d-Y', strtotime($row['approved_date'])); }  ?></td>
                                                                     
                                                                     <td><?= $row['order_no']; ?></td>
                                                                     <td><?= $row['description']; ?></td>
                                                                     <td><?= $row['resp_group']; ?></td>
                                                                     <td><?= $row['mat']; ?></td>
                                                         <?php
                                                 $sqljobstatus = "SELECT cb_order.status,order_status.order_name FROM `cb_order` INNER JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$row['order_no']."'";
                                                 $resultjonstatus = $conn->query($sqljobstatus);
                                                 $rowjonstatus = $resultjonstatus->fetch_assoc();
                                                 ?>
                                                 <td><?php 
                                                 
                                                 if( $rowjonstatus['order_name']=='CN-29 Eligible')
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                
                                                  if( $rowjonstatus['order_name']=='Unknown Status')
                                                 {
                                                     echo '<span  style="color:lightblue !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                 
                                                  if( $rowjonstatus['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                 
                                                 
                                                 ?></td>
                                                  <td align="center">
                                                  <button  type="button" class="btn btn-primary viewjobs" data-toggle="modal" data-target=".bd-example-modal-lg">View</button>
                                                 </td> 
                                                    </tr>
                                                    <?php }
                                                   // print_r($ArrOrderNo);
                                                    $allorderno = implode(',', $ArrOrderNo);
                                                    ?>
                                                 </tbody>
                                            </table>
                                        </div>
                                        <label id="error" class="help-block" for="email"></label>
                                    </div>
                                </div>
                                 <div class="row">
                                        <div class="col-sm-12">
                                             <!--<a href="jobstatusExcelGenerate.php?type=cn29_eligible"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                           <!-- <a href="ExcelGenerate_cn29_CustomFilter.php?filter=cn29_eligible"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                <?php if($_REQUEST['filter'] == 'week'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=week&jobstatusr=cn29_eligible&sdate=<?=$sdate?>&enddate=<?=$enddate?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                
                                <?php if($_REQUEST['filter'] == 'month'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=month&jobstatusr=cn29_eligible&monthyear=<?=$monthyear?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                
                                <?php if($_REQUEST['filter'] == 'daterange'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=daterange&jobstatusr=cn29_eligible&sdate=<?=$sdate?>&enddate=<?=$enddate?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                <?php if(empty($_REQUEST['filter']) || ($_REQUEST['filter'] != 'week' && $_REQUEST['filter'] != 'month' && $_REQUEST['filter'] != 'daterange')){ ?>
                                <a href="ExcelGenerate_cn29_CustomFilter.php?jobstatusr=cn29_eligible"  class="btn btn-primary approvediv-colorr">Download Excel</a>

                                <?php } ?>
                                </div></div>
                                <div class="download-icondiv">
                                    
                                 </div>

                
            </div></div></div>
            
            <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Field Remediation Required</h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">

                                        <div class="flexbox control-div mb-2">
                                            <!--<input type="hidden" name="jstatus" class="job_status" id="job2" value="">-->
                                            <div class="flexbox">
                                                <label class="mb-0 pr-2 ml-0">Status:</label>
                                                <select class="selectpicker show-tick form-control" id="" onchange="get_fieldremedation_weekdata(this.value)" title="Please select" data-style="btn-solid" data-width="150px">
                                                    <option value="">All</option>
                                                    <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
                                                            <option value="week" selected>Weekly</option>
                                                    <?php } else { ?>
                                                            <option value="week">Weekly</option>
                                                    <?php } ?>
                                                    <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
													        <option value="month" selected>Monthly</option>
													<?php } else { ?>
													        <option value="month">Monthly</option>
													 <?php } ?>
													 <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
													        <option value="custom" selected>Custom Date</option>
													<?php } else { ?>
													        <option value="custom">Custom Date</option>
													<?php } ?>
                                                </select>
                                            </div>
                                            
                                            
                                            <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
                                                <div class="form-group month_year" id="month_year2">
                                            <?php } else { ?>
                                                <div style="display:none" class="form-group month_year" id="month_year2">
                                            <?php } ?>
                                                    <div class='input-group date' id=''>
                                                    <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
                                                        <input class="form-control datepicker monthlyjob" name=""  id="monthly2" type="text"  value="<?=$_REQUEST['monthyear']?>">
                                                    <?php } else { ?>
                                                        <input class="form-control datepicker monthlyjob" name=""  id="monthly2" type="text">
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                                <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
                                                    <div class="form-group date_range" id="date_range2">
                                                <?php } else { ?>
                                                    <div style="display:none" class="form-group date_range" id="date_range2">
                                                <?php } ?>
                                                         <div class='input-group date' id=''>
                                                          <label for="from">From</label>
                                                    <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
                                                          <input class="" type="text" id="from2" name="from" value="<?=$_REQUEST['sdate']?>">
                                                    <?php } else { ?>
                                                          <input class="" type="text" id="from2" name="from">
                                                    <?php } ?>
                                                          <label for="to">to</label>
                                                    <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
                                                            <input class="" type="text" id="to2" name="to" value="<?=$_REQUEST['enddate']?>">
                                                    <?php } else { ?>
                                                            <input class="" type="text" id="to2" name="to">
                                                    <?php } ?>
                                                    
    
                                                    </div>
                                                </div>
                                                <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>
                                                    <div class="form-group weekly" id="weekly2">
                                                <?php } else { ?>
                                                    <div style="display:none" class="form-group weekly" id="weekly2">
                                                <?php } ?>
                                                    <div class='input-group date' id=''>
                                                <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='fieldremedation') { ?>        
                                                    <input class="form-control datepicker3"  name="weekdays" id="weekfilter2" type="text" value="<?=$_REQUEST['sdate']. ' - '.$_REQUEST['enddate']?>">
                                                <?php } else { ?> 
                                                    <input class="form-control datepicker3"  name="weekdays" id="weekfilter2" type="text">
                                                <?php } ?>
                                                    </div>
                                                </div>
									    </div>
        										<div>
                                                    <div class="d-flex align-items-center justify-content-end searchinputdiv">
                                                        <label class="Searchdivclass mr-2 ml-0">Search</label>
                                                        <div class="input-group-icon input-group-icon-left">
                                                            <input class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-search2" type="text" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
									</div>
                                    
                                
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="dash_datatable2">
                                                <thead class="thead-default">
                        
                                            <tr>
                                                <th>Assign To</th>
                                                <th>Approved Date</th>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>MAT</th>
                                                 <!--<th>Current Stage</th>-->
                                                 <th>Job Status</th>
                                                <th>Action</th> 


                                                
                                            </tr>
                                        </thead>
                                        <tbody id="field_remedation">
										<?php
											while($rowjobstatus = $result_field_remedtn->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $rowjobstatus['name'];?></td>
                                                <td><?php if($rowjobstatus['approved_date'] == '0000-00-00 00:00:00') { echo 'N/A'; } else { echo date('m-d-Y', strtotime($rowjobstatus['approved_date'])); }  ?></td>
                                                <input type="hidden" name="memid" value="<?php echo $rowjobstatus['order_no'];?>" id="hiddenorderid">
                                                         <input type="hidden" name="memid" value="<?php echo $rowjobstatus['user_id'];?>" id="hiddenuserid">
                                                <td><?php echo $rowjobstatus['order_no'];?></td>
                                                <td><?php if($rowjobstatus['description']!=''){ echo $rowjobstatus['description']; }else{ echo $rowjobstatus['Discriptions'];
                                                 }?></td>
                                                <td><?php if($rowjobstatus['resp_group']!=''){ echo $rowjobstatus['resp_group']; } else { echo $rowjobstatus['RESPONSIBLE_GROUP']; }?></td>
                                                <td><?php if($rowjobstatus['mat']!=''){ echo $rowjobstatus['mat']; } else { echo $rowjobstatus['MAAT']; }?></td>
                                                 <!--<td><?php 
                                                 /*
                                                 if( $rowjobstatus['order_stage']=='0')
                                                 {
                                                     
                                                     echo 'Not-Started';
                                                 }
                                                 if( $rowjobstatus['order_stage']=='1')
                                                 {
                                                     
                                                     echo 'Cover Sheet';
                                                 }
                                                  if( $rowjobstatus['order_stage']=='2')
                                                 {
                                                     
                                                     echo 'Project Details';
                                                 }
                                                  if( $rowjobstatus['order_stage']=='3')
                                                 {
                                                     
                                                     echo 'Qualifying Five';
                                                 }
                                                  if( $rowjobstatus['order_stage']=='4')
                                                 {
                                                     
                                                     echo 'Checklist Questions';
                                                 }
                                                  if( $rowjobstatus['order_stage']=='5')
                                                 {
                                                     
                                                     echo 'Pending For Approval';
                                                 }
                                                   if( $rowjobstatus['order_stage']=='6')
                                                 {
                                                     
                                                     echo 'Approved';
                                                 }
                                                   if( $rowjobstatus['order_stage']=='7')
                                                 {
                                                     
                                                     echo 'Rejected';
                                                 }*/
                                                 ?>
                                                 
                                                 
                                                 
                                                 </td>-->
                                                   <?php
                                                 $sqljobstatus = "SELECT cb_order.status,order_status.order_name FROM `cb_order` INNER JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$rowjobstatus['order_no']."'";
                                                 $resultjonstatus = $conn->query($sqljobstatus);
                                                 $rowjonstatus = $resultjonstatus->fetch_assoc();
                                                 ?>
                                                 <td><?php 
                                                 
                                                 if( $rowjonstatus['order_name']=='CN-29 Eligible')
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                
                                                  if( $rowjonstatus['order_name']=='Unknown Status')
                                                 {
                                                     echo '<span  style="color:lightblue !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                 
                                                  if( $rowjonstatus['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                 
                                                 
                                                 ?></td>
                                                  <td align="center"><button type="button" class="btn btn-primary viewjobs" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></td> 
                                                 
                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div></div></div></div>
                                 <div class="row">
     <div class="col-sm-12">
                                <!--<a href="jobstatusExcelGenerate.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                <?php if($_REQUEST['filter'] == 'week'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=week&jobstatusr=fieldremedation&sdate=<?=$sdate?>&enddate=<?=$enddate?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                
                                <?php if($_REQUEST['filter'] == 'month'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=month&jobstatusr=fieldremedation&monthyear=<?=$monthyear?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                
                                <?php if($_REQUEST['filter'] == 'daterange'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=daterange&jobstatusr=fieldremedation&sdate=<?=$sdate?>&enddate=<?=$enddate?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                <?php if(empty($_REQUEST['filter']) || ($_REQUEST['filter'] != 'week' && $_REQUEST['filter'] != 'month' && $_REQUEST['filter'] != 'daterange')){ ?>
                                <a href="ExcelGenerate_cn29_CustomFilter.php?jobstatusr=fieldremedation"  class="btn btn-primary approvediv-colorr">Download Excel</a>

                                <?php } ?>
                 </div>
       </div>
                                </div></div></div>

                
        
            
            
            
            <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Unknown Status</h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">
                                        <!--<input type="hidden" name="jstatus" class="job_status" id="job3" value="">-->
                                        <div class="flexbox control-div mb-2">
                                            <div class="flexbox">
                                                <label class="mb-0 pr-2 ml-0">Status:</label>
                                                <select class="selectpicker show-tick form-control" id="" onchange="get_unknownstatus_weekdata(this.value)" title="Please select" data-style="btn-solid" data-width="150px">
                                                    <option value="">All</option>
                                                    <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
													        <option value="week" selected>Weekly</option>
													 <?php }  else { ?>
													        <option value="week">Weekly</option>
													 <?php } ?>
													<?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
													        <option value="month" selected>Monthly</option>
													<?php }  else { ?>
													         <option value="month">Monthly</option>
													<?php } ?>
													<?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
													        <option value="custom" selected>Custom Date</option>	
													<?php }  else { ?>
													        <option value="custom">Custom Date</option>
												    <?php } ?>      
                                                </select>
                                            </div>
                                            
                                            <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
                                                <div class="form-group month_year" id="month_year3">
                                            <?php }  else { ?>
                                                <div style="display:none" class="form-group month_year" id="month_year3">
                                            <?php } ?>   
                                                    <div class='input-group date' id=''>
                                                    <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
                                                        <input class="form-control datepicker monthlyjob" name="" id="monthly3" type="text"  value="<?=$_REQUEST['monthyear']?>">
                                                    <?php }  else { ?>
                                                        <input class="form-control datepicker monthlyjob" name="" id="monthly3" type="text">
                                                    <?php } ?> 
    
                                                    </div>
                                                </div>
                                            <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
                                                <div class="form-group date_range" id="date_range3">
                                            <?php }  else { ?>
                                                <div style="display:none" class="form-group date_range" id="date_range3">
                                            <?php } ?> 
                                                <div class='input-group date' id=''>
                                                <label for="from">From</label>
                                                <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
                                                    <input class="" type="text" id="from3" name="from" value="<?=$_REQUEST['sdate']?>">
                                                <?php }  else { ?>
                                                    <input class="" type="text" id="from3" name="from">
                                                <?php } ?> 
                                                <label for="to">to</label>
                                                <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
                                                    <input class="" type="text" id="to3" name="to"  value="<?=$_REQUEST['enddate']?>">
                                                <?php }  else { ?>
                                                     <input class="" type="text" id="to3" name="to">
                                                <?php } ?> 
                                                
                                                </div>
                                            </div>
                                            <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
                                                <div class="form-group weekly" id="weekly3">
                                            <?php }  else { ?>
                                                    <div style="display:none" class="form-group weekly" id="weekly3">
                                                <?php } ?>   
                                                        <div class='input-group date' id=''>
                                                    <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='unknownstatus') { ?>
                                                            <input class="form-control datepicker3"  name="weekdays" id="weekfilter3" type="text" value="<?=$_REQUEST['sdate']. ' - '.$_REQUEST['enddate']?>">
                                                    <?php }  else { ?>
                                                            <input class="form-control datepicker3"  name="weekdays" id="weekfilter3" type="text">
                                                     <?php } ?>   
                                                        </div>
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
                                    
                                
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="dash_datatable3">
                                                <thead class="thead-default">
                                            <tr>
                                                <th>Assign To</th>
                                                <th>Approved Date</th>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>MAT</th>
                                                <th>Status</th>
                                                <th>Action</th> 


                                                
                                            </tr>
                                        </thead>
                                        <tbody id="res_data2">
										<?php
											while($rownotjobstart = $result_unknown_status->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $rownotjobstart['name'];?></td>
                                                <td><?php if($rownotjobstart['approved_date'] == '0000-00-00 00:00:00') { echo 'N/A'; } else {  echo date('m-d-Y', strtotime($rownotjobstart['approved_date'])); }  ?></td>
                                               
                                                <input type="hidden" name="memid" value="<?php echo $rownotjobstart['order_no'];?>" id="hiddenorderid">
                                                         <input type="hidden" name="memid" value="<?php echo $rownotjobstart['user_id'];?>" id="hiddenuserid">
                                                <td><?php echo $rownotjobstart['order_no'];?></td>
                                                <td><?php if($rownotjobstart['description']!=''){ echo $rownotjobstart['description']; }else{ echo $rownotjobstart['Discriptions'];
                                                 }?></td>
                                                <td><?php if($rownotjobstart['resp_group']!=''){ echo $rownotjobstart['resp_group']; } else { echo $rownotjobstart['resp_group']; }?></td>
                                                <td><?php if($rownotjobstart['mat']!=''){ echo $rownotjobstart['mat']; } else { echo $rownotjobstart['MAAT']; }?></td>
                                                
                                                  <td><?php 
                                                 
                                                 if( $rownotjobstart['order_name']=='CN-29 Eligible')
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">'.$rownotjobstart['order_name'].'</span>';
                                                 }
                                                
                                                  if( $rownotjobstart['order_name']=='Unknown Status')
                                                 {
                                                     echo '<span  style="color:lightblue !important;font-weight: bold;">'.$rownotjobstart['order_name'].'</span>';
                                                 }
                                                 
                                                  if( $rownotjobstart['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rownotjobstart['order_name'].'</span>';
                                                 }
                                                 
                                                 
                                                 ?></td>
                                            <td align="center"><button type="button" class="btn btn-primary viewjobs" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></td> 

                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                        <div class="col-sm-12">
                                        <!--<a href="jobstatusExcelGenerate.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                        <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                        <?php if($_REQUEST['filter'] == 'week'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=week&jobstatusr=unknownstatus&sdate=<?=$sdate?>&enddate=<?=$enddate?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                
                                <?php if($_REQUEST['filter'] == 'month'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=month&jobstatusr=unknownstatus&monthyear=<?=$monthyear?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                
                                <?php if($_REQUEST['filter'] == 'daterange'){ ?>
                                    <a href="ExcelGenerate_cn29_CustomFilter.php?filter=daterange&jobstatusr=unknownstatus&sdate=<?=$sdate?>&enddate=<?=$enddate?>"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php } else { ?>
                                
                                <?php } ?>
                                <?php if(empty($_REQUEST['filter']) || ($_REQUEST['filter'] != 'week' && $_REQUEST['filter'] != 'month' && $_REQUEST['filter'] != 'daterange')){ ?>
                                <a href="ExcelGenerate_cn29_CustomFilter.php?jobstatusr=unknownstatus"  class="btn btn-primary approvediv-colorr">Download Excel</a>

                                <?php } ?>
                                </div></div>
                
            </div></div></div>
            
            

              </div></div></div>
               <div class="container">
             <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Pie Chart Report</h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">
                                        <!--<input type="hidden" name="jstatus" class="job_status" id="job3" value="">-->
                                        <div class="flexbox control-div mb-2">
                                            <div class="flexbox">
                                                <label class="mb-0 pr-2 ml-0">Status:</label>
                                                <select class="selectpicker show-tick form-control" id="" onchange="get_piechart(this.value)" title="Please select" data-style="btn-solid" data-width="150px">
                                                    <option value="">All</option>
                                                    <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='piechart') { ?>
													        <option value="week" selected>Weekly</option>
													 <?php }  else { ?>
													        <option value="week">Weekly</option>
													 <?php } ?>
													<?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='piechart') { ?>
													        <option value="month" selected>Monthly</option>
													<?php }  else { ?>
													         <option value="month">Monthly</option>
													<?php } ?>
													<?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='piechart') { ?>
													        <option value="custom" selected>Custom Date</option>	
													<?php }  else { ?>
													        <option value="custom">Custom Date</option>
												    <?php } ?>      
                                                </select>
                                            </div>
                                            
                                            <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='piechart') { ?>
                                                <div class="form-group month_year" id="month_year3piechart">
                                            <?php }  else { ?>
                                                <div style="display:none" class="form-group month_year" id="month_year3piechart">
                                            <?php } ?>   
                                                    <div class='input-group date' id=''>
                                                    <?php if($_REQUEST['filter'] =='month' && $_REQUEST['jobstatusr']=='piechart') { ?>
                                                        <input class="form-control datepicker monthlyjobpiechart" name="" id="monthly3piechart" type="text"  value="<?=$_REQUEST['monthyear']?>">
                                                    <?php }  else { ?>
                                                        <input class="form-control datepicker monthlyjobpiechart" name="" id="monthly3piechart" type="text">
                                                    <?php } ?> 
    
                                                    </div>
                                                </div>
                                            <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='piechart') { ?>
                                                <div class="form-group date_range" id="date_range3piechart">
                                            <?php }  else { ?>
                                                <div style="display:none" class="form-group date_range" id="date_range3piechart">
                                            <?php } ?> 
                                                <div class='input-group date' id=''>
                                                <label for="from">From</label>
                                                <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='piechart') { ?>
                                                    <input class="" type="text" id="from3piechart" name="from" value="<?=$_REQUEST['sdate']?>">
                                                <?php }  else { ?>
                                                    <input class="" type="text" id="from3piechart" name="from">
                                                <?php } ?> 
                                                <label for="to">to</label>
                                                <?php if($_REQUEST['filter'] =='daterange' && $_REQUEST['jobstatusr']=='piechart') { ?>
                                                    <input class="" type="text" id="to3piechart" name="to"  value="<?=$_REQUEST['enddate']?>">
                                                <?php }  else { ?>
                                                     <input class="" type="text" id="to3piechart" name="to">
                                                <?php } ?> 
                                                
                                                </div>
                                            </div>
                                            <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='piechart') { ?>
                                                <div class="form-group weekly" id="weekly3piechart">
                                            <?php }  else { ?>
                                                    <div style="display:none" class="form-group weeklypiechart" id="weekly3piechart">
                                                <?php } ?>   
                                                        <div class='input-group date' id=''>
                                                    <?php if($_REQUEST['filter'] =='week' && $_REQUEST['jobstatusr']=='piechart') { ?>
                                                            <input class="form-control datepicker3piechart"  name="weekdays" id="weekfilter3piechart" type="text" value="<?=$_REQUEST['sdate']. ' - '.$_REQUEST['enddate']?>">
                                                    <?php }  else { ?>
                                                            <input class="form-control datepicker3"  name="weekdays" id="weekfilter3piechart" type="text">
                                                     <?php } ?>   
                                                        </div>
                                                    </div>
									            </div>
									 
									</div>
                <input type="hidden" name="JobsStatusCN29" value="<?php echo $row_JobsCN29;?>">
                  <input type="hidden" name="JobsStatusFieldRemediation" value="<?php echo $row_Jobsfield_remediation;?>">
                  <input type="hidden" name="JobsStatusUnknownStatus" value="<?php echo $row_Jobsunknown_status;?>">
 
                                
                               
                                
                
            </div>
            <div class="row pt-5 center" id="piechart">
             
                  
                      <div class="col-lg-6 mb-md-4">
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
            </div></div> 
             
            </div>  </div>  </div> 
              
            </div></div></div></div></div></div></div></div>
             
          
             <!-- END PAGE CONTENT-->
             
         <?php include('footer_review_new.php');  ?> 
         
<?php //include('../footer_review.php'); ?> 
         <script src="../../cb_review/report_pie_chart.js"></script><!--Piechart js-->

          <script src="/assets/js/crossbore_main.js"></script>
          <!--<script src="/assets/js/dashboard.admn.min.js"></script><!--Piechart js-->
          <!--<script src="/assets/vendors/js/dataTables.bootstrap4.min.js"></script>
          <script src="/assets/vendors/js/dataTables.select.min.js"></script>-->
<script>
  
$( "#monthly1" ).click(function() {
    $(".job_status").val("");
        $(".job_status").val("cn29_eligible");
        $('.ui-datepicker-calendar').hide();
}); 
$( "#monthly2" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("fieldremedation");
        $('.ui-datepicker-calendar').hide();
});

$( "#monthly3" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("unknownstatus");
        $('.ui-datepicker-calendar').hide();
});
$( "#monthly3piechart" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("piechart");
        $('.ui-datepicker-calendar').hide();
});
$( "#to1" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("cn29_eligible");
});
$( "#to2" ).click(function() {
    //alert('dfgfrdfd');
     $(".job_status").val("");
     $(".job_status").val("fieldremedation");
        //alert($(".job_status").val("fieldremedation"));
});
$( "#to3" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("unknownstatus");
});
$( "#to3piechart" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("piechart");
});
$( "#weekfilter1" ).click(function() {
    $(".job_status").val("");
        $(".job_status").val("cn29_eligible");
}); 
$( "#weekfilter2" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("fieldremedation");
});
$( "#weekfilter3" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("unknownstatus");
});
$( "#weekfilter3piechart" ).click(function() {
     $(".job_status").val("");
        $(".job_status").val("piechart");
});
function get_cn29_weekdata(value) {
    if(value=='week'){
            $('#month_year1').hide();
            $('#date_range1').hide();
            $('#weekly1').show();
    }
    if(value=='month'){
            $('#weekly1').hide();
            $('#date_range1').hide();
            $('#month_year1').show();
    }
      if(value=='custom'){
          //alert('cusot');
            $('#month_year1').hide();
            $('#weekly1').hide();
            $('#date_range1').show();
     
    }
       if(value=='All'){
            $('#month_year1').hide();
            $('#weekly1').hide();
            $('#date_range1').hide();
            window.location.href="review_report1.php";
     
    }
     
    // var data_filter = 'filter='+value;
    //       $.ajax({
    //         type: 'post',
    //         url: 'fetch_cn29data.php',
    //         //data: $('form').serialize(),
    //         data : data_filter,
    //          error: function(xhr, status, error) {
    //         var err = eval("(" + xhr.responseText + ")");
    //         alert(err.Message);
    //         },
    //         success: function (data) {
    //             alert(data);
    //             $("#cn29_weekdata").hide();
    //             $("#res_data").empty();
    //              //$('#myTable tbody').html(data);
    //             $("#res_data").prepend(data);
    //         }
    //       });
            
   
 
}
function get_fieldremedation_weekdata(value) {
  
    if(value=='week'){
            $('#month_year2').hide();
            $('#date_range2').hide();
            $('#date_range1').hide();

            $('#weekly2').show();
     
    }
    if(value=='month'){
            $('#weekly2').hide();
            $('#date_range2').hide();
            $('#date_range1').hide();

            $('#month_year2').show();
    }
    if(value=='custom'){
            $('#month_year2').hide();
            $('#weekly2').hide();
           $('#date_range1').hide();
            $('#date_range2').show();
     
    }
    if(value=='All'){
            $('#month_year2').hide();
            $('#weekly2').hide();
            $('#date_range2').hide();
                       $('#date_range1').hide();

            window.location.href="review_report1.php";
        }
     $( "#monthly2" ).click(function() {
                  $('.ui-datepicker-calendar').hide();
    });   
 
}



function get_unknownstatus_weekdata(value) {
    if(value=='week'){
            $('#month_year3').hide();
            $('#date_range3').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();

            $('#weekly3').show();
     
    }
    if(value=='month'){
            $('#weekly3').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();
            $('#date_range3').hide();
            $('#month_year3').show();
    }
      if(value=='custom'){
            $('#month_year3').hide();
            $('#weekly3').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();
            $('#date_range3').show();
     
    }
    if(value=='All'){
            $('#month_year3').hide();
            $('#weekly3').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();
            $('#date_range3').hide();
            window.location.href="review_report1.php";
    }
    $( "#monthly3" ).click(function() {
                  $('.ui-datepicker-calendar').hide();
    });  
 
          
}
function get_piechart(value) {
    alert(value);
    if(value=='week'){
            $('#month_year3').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();
            $('#date_range3').hide();
            $('#date_range3piechart').hide();
            $('#weekly3').hide();
             $('#month_year3piechart').hide();
              
            $('#weekly3').hide();
            $('#weekly3piechart').show();
     
    }
    if(value=='month'){
            $('#weekly3').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();
            $('#date_range3').hide();
            $('#date_range3piechart').hide();
             $('#weekly3piechart').hide();
            $('#month_year3piechart').show();
    }
      if(value=='custom'){
            $('#month_year3').hide();
            $('#weekly3').hide();
            $('#month_year3piechart').hide();
            $('#weekly3piechart').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();
            $('#date_range3').hide();
            $('#date_range3piechart').show();
     
    }
    if(value=='All'){
            $('#month_year3').hide();
            $('#weekly3').hide();
             $('#monthyear3piechart').hide();
            $('#weekly3piechart').hide();
            $('#date_range1').hide();
            $('#date_range2').hide();
            $('#date_range3').hide();
            $('#date_range3piechart').hide();
            window.location.href="review_report1.php";
    }
    $( "#monthly3piechart" ).click(function() {
                  $('.ui-datepicker-calendar').hide();
    });  
 
          
}
</script>   
<script>
function downloadpdf() {
  var approveby = $('#USERID').val();
var order_no = $('#OREDRNO').val();
 window.location.href='GenPdf.php?id='+approveby+'&ono='+order_no
}  

</script>
<!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  -->
<!--<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->

<script>
/*$(document).ready(function(){
        $( "#reject_cmt" ).focus(function() {
        $('.errorcomment').text('');
    });
});*/
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
	$('#monthly1').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy',
		buttonText: 'Select date'
      
	 
	}).focus(function() {
	    //alert('rfgtfg');
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        thisCalendar.datepicker('setDate', new Date(year, month, 1));
        var type = 'month';
                var resultjob = $('.job_status').val();
                var dateText2 = $('#monthly1').val();
                //alert(dateText2);
                var dateText2 = $.trim(dateText2);
                //alert(dateText2);
                var str = dateText2.replace(/\s/g, '');
                window.location.href="review_report1.php?filter="+type+"&monthyear="+str+"&jobstatusr="+resultjob;
		});
	
	});
 
	
 
});

  </script>
  <script>
$(function() {
	$('#monthly2').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy',
		buttonText: 'Select date'
      
	 
	}).focus(function() {
	    //alert('mon2');
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        thisCalendar.datepicker('setDate', new Date(year, month, 1));
        var type = 'month';
                 var resultjob = $('.job_status').val();
                var dateText2 = $('#monthly2').val();
                var dateText2 = $.trim(dateText2);
                var str2 = dateText2.replace(/\s/g, '');
                window.location.href="review_report1.php?filter="+type+"&monthyear="+str2+"&jobstatusr="+resultjob;
		});
	
	});
 
	
 
});

  </script>
  <script>
$(function() {
	$('#monthly3').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy',
		buttonText: 'Select date'
      
	 
	}).focus(function() {
	    //alert('mon3');
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        thisCalendar.datepicker('setDate', new Date(year, month, 1));
        var type = 'month';
                var resultjob = $('.job_status').val();
                var dateText2 = $('#monthly3').val();
                //alert(dateText2);
                var dateText2 = $.trim(dateText2);
                //alert(dateText2);
                var str = dateText2.replace(/\s/g, '');
                window.location.href="review_report1.php?filter="+type+"&monthyear="+str+"&jobstatusr="+resultjob;
		});
	
	});
 
	
 
});

$(function() {
	$('#monthly3piechart').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy',
		buttonText: 'Select date'
      
	 
	}).focus(function() {
	    //alert('mon3');
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        thisCalendar.datepicker('setDate', new Date(year, month, 1));
        var type = 'month';
                var resultjob = $('.job_status').val();
                var dateText2 = $('#monthly3piechart').val();
                //alert(dateText2);
                var dateText2 = $.trim(dateText2);
                //alert(dateText2);
                var str = dateText2.replace(/\s/g, '');
                window.location.href="review_report1.php?filter="+type+"&monthyear="+str+"&jobstatusr="+resultjob;
		});
	
	});
 
	
 
});
  </script>
  <script>
  $( function() {
   
    //alert('date_rnge');
    //alert($('.job_status').val());
    var dateFormat1 = "mm/dd/yy",
      from = $( "#from1" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate1( this ) );
        }),
      to = $( "#to1" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate1( this ) );
      });
 
    function getDate1( element ) {
       var resultjob = $('.job_status').val();
       var sdate = $( "#from1" ).val();
       var enddate = $( "#to1" ).val();
       var date;
      try {
        date = $.datepicker.parseDate( dateFormat1, element.value );
      } catch( error ) {
        date = null;
      }
       if(sdate!='' && enddate!=''){
      var type = 'daterange';
     window.location.href="review_report1.php?filter="+type+"&sdate="+sdate+"&enddate="+enddate+"&jobstatusr="+resultjob;
      }
      return date;
    }
    
    
    
     var dateFormat2 = "mm/dd/yy",
      from = $( "#from2" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate2( this ) );
        }),
      to = $( "#to2" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate2( this ) );
      });
       function getDate2( element ) {
        var resultjob = $('.job_status').val();
            var sdate = $( "#from2" ).val();
            var enddate = $( "#to2" ).val();
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat2, element.value );
            } catch( error ) {
                date = null;
            }
            if(sdate!='' && enddate!=''){
                var type = 'daterange';
                window.location.href="review_report1.php?filter="+type+"&sdate="+sdate+"&enddate="+enddate+"&jobstatusr="+resultjob;
            }
            return date;
        }
        
        var dateFormat3 = "mm/dd/yy",
        from = $( "#from3" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate3( this ) );
        }),
      to = $( "#to3" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate3( this ) );
      });
       function getDate3( element ) {
        var resultjob = $('.job_status').val();
            var sdate = $( "#from3" ).val();
            var enddate = $( "#to3" ).val();
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat3, element.value );
            } catch( error ) {
                date = null;
            }
            if(sdate!='' && enddate!=''){
                var type = 'daterange';
                window.location.href="review_report1.php?filter="+type+"&sdate="+sdate+"&enddate="+enddate+"&jobstatusr="+resultjob;
            }
            return date;
        }
        
        var dateFormat4 = "mm/dd/yy",
        from = $( "#from3piechart" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate4( this ) );
        }),
      to = $( "#to3piechart" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate4( this ) );
      });
       function getDate4( element ) {
        var resultjob = $('.job_status').val();
            var sdate = $( "#from3piechart" ).val();
            var enddate = $( "#to3piechart" ).val();
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat4, element.value );
            } catch( error ) {
                date = null;
            }
            if(sdate!='' && enddate!=''){
                var type = 'daterange';
                window.location.href="review_report1.php?filter="+type+"&sdate="+sdate+"&enddate="+enddate+"&jobstatusr="+resultjob;
            }
            return date;
        }
  });
   </script>
   
   <!-----------------Code Added for week filter------------------->
   <script>
   $(document).ready(function() {
        $('#weekfilter1').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                var startDat = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                var Enddate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var type = 'week';
                var resultjob = $('.job_status').val();
                //alert(resultjob);
                window.location.href="review_report1.php?filter="+type+"&sdate="+startDat+"&enddate="+Enddate+"&jobstatusr="+resultjob;
        }
      });
      
      $('#weekfilter2').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                var startDat = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                var Enddate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var type = 'week';
                var resultjob = $('.job_status').val();
                //alert(resultjob);
                window.location.href="review_report1.php?filter="+type+"&sdate="+startDat+"&enddate="+Enddate+"&jobstatusr="+resultjob;
    }
  });
  $('#weekfilter3').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                var startDat = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                var Enddate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var type = 'week';
                var resultjob = $('.job_status').val();
                //alert(resultjob);
                window.location.href="review_report1.php?filter="+type+"&sdate="+startDat+"&enddate="+Enddate+"&jobstatusr="+resultjob;
    }
  });
  
  
    $('#weekfilter3piechart').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                var startDat = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                var Enddate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var type = 'week';
                var resultjob = $('.job_status').val();
                //alert(resultjob);
                window.location.href="review_report1.php?filter="+type+"&sdate="+startDat+"&enddate="+Enddate+"&jobstatusr="+resultjob;
    }
  });
});
  </script>
  <!-------------Code Ends----------------->
    <script>
 function ApproveAll() {
  var order_no = '<?= $allorderno ?>';
  var approveby = '<?= $userid ?>';

Lobibox.confirm({
            msg: 'Are you sure want to Approve All jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'ApproveAll'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                     location.reload();
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 
                 
                }
            }
        });
      
 
    }
    function Approve50() {
  var order_no = '<?= $allorderno ?>';
var approveby = '<?= $userid ?>';
Lobibox.confirm({
            msg: 'Are you sure want to Approve 50 jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Approve50'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                     location.reload();
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 
                 
                }
            }
        });
      
 
    }
</script>
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
                                      location.reload();
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
//alert (approveby + order_no);
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
