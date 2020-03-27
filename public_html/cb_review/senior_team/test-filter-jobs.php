<?php
//include('../header_prevention.php');
include('../header_snr_review.php');
$userid = $_SESSION['userid'];

//for filter
if($_REQUEST['date'] && $_REQUEST['type'] != '') {
 $data = $_REQUEST['date'];
 $type= $_REQUEST['type'];
$date1 = DateTime::createFromFormat("m/d/Y" , $data);
$today = $date1->format('Y-m-d');
$date = strtotime($today);
$date = strtotime("+7 day", $date);
echo  $nxt7day = date('Y-m-d', $date); 
}

//filter end
if($type == 'Eligible'){
    
 $sqljob_cn29 = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'CN-29 Eligible' AND  send_job_approval='1' AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";

} else {
 $sqljob_cn29 = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'CN-29 Eligible' AND  send_job_approval='1'"; 

}

$result_cn29 = $conn->query($sqljob_cn29);

if($type == 'Remediation'){
    
 $sqljob_field_remedtn = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Field Remediation Required' AND  send_job_approval='1' AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";  

} else {
    
 $sqljob_field_remedtn = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Field Remediation Required' AND  send_job_approval='1'";  
}

$result_field_remedtn = $conn->query($sqljob_field_remedtn);

if($type == 'Unknown') {
 $sqljob_unknown_status = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Unknown Status' AND  send_job_approval='1' AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";   
} else {
$sqljob_unknown_status = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Unknown Status' AND  send_job_approval='1'";
}


$result_unknown_status = $conn->query($sqljob_unknown_status);


// $sqljob_unknown_status = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
// cb_project_details.mat FROM cb_order_new 
// INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
// INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
// INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
// INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
// INNER JOIN  order_status ON(cb_order.status=order_status.id)
// WHERE order_status.order_name = 'Unknown Status' AND  send_job_approval='1'";
// $result_unknown_status = $conn->query($sqljob_unknown_status);


/*******************Queries End************************/ 

$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("12", $roleID))
{
	
}else{
session_destroy();
header("Location: ../../index.php");	
}
?>
 <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
  
  
  <!--newkljklj-->
  <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>-->
    
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  
   $( function() {
    $( "#datepicker2" ).datepicker();
  } );
  
   $( function() {
    $( "#datepicker3" ).datepicker();
  } );
  </script>
  
  <script>
    var startDate;
    var endDate;
    $('.date-picker').datepicker( {
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    onSelect: function(dateText, inst) {
    var date = $(this).datepicker('getDate');
    startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
    endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
    var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
    $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
    $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
    $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
    }
  });
  </script>
  <script>
  function datefun(date,type){
      //alert(type);
       window.location.href="/cb_review/senior_team/test-filter-jobs.php?date="+date+"&type="+type;
//   $.ajax({
//         url: "https://crossdemo.epikso.com/cb_review/cb_prevention_team/get-data.php",
//         type: "post",
//         data: {getdate:date,gettype:type},
//         success: function(data) {
           
//             console.log(data);
//           }
//   });
  }
  </script>
 <style>
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

</style>

 
  
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
										<h5 class="font-strong mb-4">CN29 Eligible Jobs   <?php if( $_REQUEST['date'] != '') { ?> <a href="/cb_review/cb_prevention_team/admin-dashboard-prevention.php"><button type="button" class="btn btn-link">Back to Dashboard</button></a> <?php } ?></h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">
                                  
										<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<!--<label class="mb-0 pr-2 ml-0">Select Date:</label>-->
												<!--<input type="text" class="selectpicker show-tick form-control selectpickerdiv2" onChange="datefun(datepicker.value,'Eligible')" id="datepicker" title="Please select date" data-style="btn-solid" data-width="150px" value="<?php if($type == 'Eligible') { echo $data; }  ?>">-->
											<label for="startDate">Date :</label>
                                            <input name="startDate" class="date-picker" />
                                            <label>Week :</label> <span id="startDate"></span> - <span id="endDate"></span>
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
                                                        <th>Order No</th>
                                                        <th>Order Description</th>
                                                        <th>Resp Group</th>
                                                        <th>MAT</th>
                                                         <th>Job Status</th>
                                                         <!--<th>Action</th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    	<?php
                                                    	$ArrOrderNo = array();
											while($row = $result_cn29->fetch_assoc()) {
											$ArrOrderNo[] = $row['order_no'];
											?>
                                                    <tr>
                                                        <!--<td><input type="checkbox" name="reviewer[]" class="checkbox" value="<?php echo $row['order_no'];?>"></td>-->
                                                         <!--<input type="hidden" name="memid" value="<?php echo $row['order_no'];?>" id="hiddenorderid">-->
                                                         <!--<input type="hidden" name="memid" value="<?php echo $row['user_id'];?>" id="hiddenuserid">-->
                                                        <td><?= $row['name']; ?></td>
                                                        <td><?= $row['order_no']; ?></td>
                                                        <td><?= $row['description']; ?></td>
                                                        <td><?php if($row['resp_group']!=''){echo $row['resp_group']; }else{ echo 'N/A';}?></td>
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
                                                 <!--<td align="center">
                                                   
                                                  <button  type="button" class="btn btn-primary rejectjobs" data-toggle="modal" data-target="#exampleModal">View</button>
                                                 



                  
                                                 </td>-->
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
                                             <a href="../ExcelGenerate.php?type=eligible-all"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                             <?php if($type == 'Eligible' && $rowjonstatus['order_name'] != '') { ?>
                                              <a href="../ExcelGenerate.php?type=eligible&date_value=<?php  echo $data;   ?>"  class="btn btn-primary approvediv-colorr">Download Weekly Excel</a>
                                              <?php } ?>
                                            <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                </div></div>
                                <div class="download-icondiv">
                                    <!--<a><button onclick="return Approve()" type="button" class="btn btn-primary approvediv-color mr-2 mb-2" id="submit">Approve</button></a>
									
                                    <a><button onclick="return ApproveAll()" type="button" class="btn bg-success approvediv-color divcolororange mr-2 mb-2">Approve All</button></a>
									
                                <a><button onclick="return Approve50()" type="button" class="btn bg-info approvediv-color color01 mr-2 mb-2">Approve Top 50</button></a>

									<a href="ForAprovalExcelGen.php"><button type="button" class="btn btn-primary approvediv-color mr-2 mb-2">Download Excel</button></a>-->
                                 </div>

                
            </div></div></div></div>
            
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
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Select Date:</label>
												<input type="text" class="selectpicker show-tick form-control selectpickerdiv2" onChange="datefun(datepicker2.value,'Remediation')" id="datepicker2" title="Please select date" data-style="btn-solid" data-width="150px" value="<?php if($type == 'Remediation') { echo $data; }  ?>">
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
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>MAT</th>
                                                 <!--<th>Current Stage</th>-->
                                                 <th>Job Status</th>
                                                 <!--<th>Action</th>-->


                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($rowjobstatus = $result_field_remedtn->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $rowjobstatus['name'];?></td>
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
                                                 <!--<td align="center"><button type="button" class="btn btn-primary viewjobs" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></td>-->
                                                 
                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
 <div class="row">
     <div class="col-sm-12">
                                <a href="../ExcelGenerate.php?type=remediation-all"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                <?php if($type == 'Remediation' && $rowjonstatus['order_name'] != '') { ?>
                                <a href="../ExcelGenerate.php?type=remediation&date_value=<?php  echo $data;   ?>"  class="btn btn-primary approvediv-colorr">Download Weekly Excel</a>
                               <?php } ?>
                                <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                </div></div>
                
            </div></div></div></div>
            
            
            
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
                                    	<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Select Date:</label>
												<input type="text" class="selectpicker show-tick form-control selectpickerdiv2" onChange="datefun(datepicker3.value,'Unknown')" id="datepicker3" title="Please select date" data-style="btn-solid" data-width="150px" value="<?php if($type == 'Unknown') { echo $data; }  ?>">
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
                                                        <!--<th><input name="select_all" value="1" id="adtbl-select-all" type="checkbox" /></th>-->
                                                        <th>Assign To</th>
                                                        <th>Order No</th>
                                                        <th>Order Description</th>
                                                        <th>Resp Group</th>
                                                        <th>MAT</th>
                                                         <th>Job Status</th>
                                                         <!--<th>Action</th>-->
                                                    </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($rownotjobstart = $result_unknown_status->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $rownotjobstart['name'];?></td>
                                                <input type="hidden" name="memid" value="<?php echo $rownotjobstart['order_no'];?>" id="hiddenorderid">
                                                         <input type="hidden" name="memid" value="<?php echo $rownotjobstart['user_id'];?>" id="hiddenuserid">
                                                <td><?php echo $rownotjobstart['order_no'];?></td>
                                                <td><?php if($rownotjobstart['description']!=''){ echo $rownotjobstart['description']; }else{ echo $rownotjobstart['Discriptions'];
                                                 }?></td>
                                                <td><?php if($rownotjobstart['resp_group']!=''){ echo $rownotjobstart['resp_group']; } else { echo $rownotjobstart['RESPONSIBLE_GROUP']; }?></td>
                                                <td><?php if($rownotjobstart['mat']!=''){ echo $rownotjobstart['mat']; } else { echo $rownotjobstart['MAAT']; }?></td>
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
                                                 $sqljobstatus = "SELECT cb_order.status,order_status.order_name FROM `cb_order` INNER JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$rownotjobstart['order_no']."'";
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
                                                 <!--<td align="center"><button type="button" class="btn btn-primary viewjobs" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></td>-->
                                                 
                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                        <div class="col-sm-12">
                                        <a href="../ExcelGenerate.php?type=unknown-all"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                        <?php if($type == 'Unknown' && $rowjonstatus['order_name'] != '') { ?>
                                         <a href="../ExcelGenerate.php?type=unknown&date_value=<?php  echo $data;  ?>"  class="btn btn-primary approvediv-colorr">Download Weekly Excel</a>
                                        <?php } ?>
                                        <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                </div></div>
                
            </div></div></div></div>
          
           <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="exampleModal">
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
                                    <label class="col-sm-5 col-form-label">Date of Review</label>
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
													 <input type="checkbox" value="" readonly class="custom-control-input" id="Checkmat">
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
                                             <input type="checkbox" value="" id="check_cn24" readonly class="custom-control-input">
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
                                             <input type="checkbox" value="" readonly class="custom-control-input" id="check_cn29">
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
                                             <input type="checkbox" value="" readonly class="custom-control-input" id="check_cn07">
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
                                       <input type="checkbox" readonly name="name" value="" id="CN29_in_SAP">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="outerDivFull">
                                       <div class="switchToggle">
                                          <input type="checkbox" name="name" readonly value="" id="SAP_Reviewed">
                                          <label for="SAP_Reviewed">Toggle</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="MOI_for_Srv">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="MOI_for_Main">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="determine_the_MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="used_to_retrieve_the_document">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="outerDivFull">
                                       <div class="switchToggle select-box-div">
                                          <input type="text" readonly value="" id="SAP" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="PRE_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                      <input type="text" readonly class="form-control" id="Post_Inspection_Required_per_PRE_Inspection">
                                        
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="POST_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
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
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" id="Cross_Bore_Log_cmt" readonly class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                               <div class="row padd-div">
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
                                    <a><button type="button" onclick="return Reject()" class="btn btn-danger approvediv-color mr-2 mb-2">Reject</button></a>

                                    <a><button onclick="return Approveview()" type="button" class="btn btn-primary approvediv-color mr-2 mb-2" id="submit">Approve</button></a>
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
         <?php include('../footer_review.php');  ?>  
          <script src="/assets/js/dashboard.admn.min.js"></script><!--Piechart js-->
     <script src="/assets/vendors/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/js/dataTables.select.min.js"></script>
    
   <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>-->
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>-->
 
    
 <script>

           
//$(document).ready(function() {
  //$(document).on('change','.datepicker2',function() {
    //     $("#submit").on("click", function() {


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

     