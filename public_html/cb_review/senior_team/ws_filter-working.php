<?php
//include('../header_prevention.php');
include('../header_snr_review.php');
$userid = $_SESSION['userid'];


//for cn29

if($_REQUEST['send_value'] == 'TD_Construction'){
  $filterval = "T&D Construction";  
} else {
     $filterval = "T&D Operations"; 
}
 
if($_REQUEST['date'] && $_REQUEST['type'] != '') {
 $data = $_REQUEST['date'];
 $type= $_REQUEST['type'];
 $date1 = DateTime::createFromFormat("m/d/Y" , $data);
 $today = $date1->format('Y-m-d');
 $date = strtotime($today);
 $date = strtotime("+7 day", $date);
 $nxt7day = date('Y-m-d', $date); 
}
 
 if($_REQUEST['type'] == 'CN29' && $_REQUEST['send_value'] != '') {
     
$sqljob_cn29 = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'CN-29 Eligible' AND  send_job_approval='1' AND cb_front_cover.resp_group = '$filterval'"; 

} else if($_REQUEST['date'] != ''  && $_REQUEST['type'] == 'CN29'){
 $sqljob_cn29 = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'CN-29 Eligible' AND  send_job_approval='1' AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";   
}
else {
    
$sqljob_cn29 = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'CN-29 Eligible' AND  send_job_approval='1'"; 

}
$result_cn29 = $conn->query($sqljob_cn29);

//for remidation    
 if($_REQUEST['type'] == 'Remediation' && $_REQUEST['send_value'] != '') {
 $sqljob_field_remedtn = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Field Remediation Required' AND  send_job_approval='1' AND cb_front_cover.resp_group = '$filterval'";  
}

else if($_REQUEST['date'] !='' && $_REQUEST['type'] == 'Remediation') {
    
$sqljob_field_remedtn = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Field Remediation Required' AND  send_job_approval='1' AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";  

} else {
    
$sqljob_field_remedtn = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Field Remediation Required' AND  send_job_approval='1'";   

}

$result_field_remedtn = $conn->query($sqljob_field_remedtn);

//for unknown status
if($_REQUEST['type'] == 'Unknown' && $_REQUEST['send_value'] != '') {
   
$sqljob_unknown_status = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Unknown Status' AND  send_job_approval='1' AND cb_front_cover.resp_group = '$filterval'"; 
}

else if($_REQUEST['date'] !='' && $_REQUEST['type'] == 'Unknown') {
$sqljob_unknown_status = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Unknown Status' AND  send_job_approval='1' AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";  
} 

else {
    
$sqljob_unknown_status = "SELECT cb_order_new.total_dollars,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Unknown Status' AND  send_job_approval='1'";
}


$result_unknown_status = $conn->query($sqljob_unknown_status);


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
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  
  
  <!--newkljklj-->
  <!--<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">-->
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>-->
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
										<h5 class="font-strong mb-4">CN29 Eligible Jobs   <?php if( $_REQUEST['date'] != '' || $_REQUEST['type'] != '') { ?> <a href="https://crossdemo.epikso.com/cb_review/senior_team/ws_filter-working.php"><button type="button" class="btn btn-link">Go Back</button></a> <?php } ?></h5>
									</div>
                                </div>
                                <div class="d-flex justify-content-between flexible-status-search">
                                    
                                    	<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Filter Resp Group:</label>
											<select class="selectpicker show-tick form-control" name="filter" id="filterdata" title="Please select" onchange="showfun(this.value,'CN29')" data-style="btn-solid" data-width="150px">
                                            <option <?php  if($_REQUEST['send_value'] == 'TD_Construction'  ) { echo "selected"; } ?> value="TD_Construction">T&D Construction</option>
                                            <option <?php if($_REQUEST['send_value'] == 'TD_Operations' && $_REQUEST['type'] == 'CN29') { echo "selected"; } ?> value="TD_Operations">T&D Operations</option>
                                            
                                            </select>
											</div>
										</div>
                                  
										<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Date Filter:</label>
												<input type="text" class="selectpicker show-tick form-control selectpickerdiv2" onChange="datefun(datepicker.value,'CN29')" id="datepicker" title="Please select date" data-style="btn-solid" data-width="150px" value="<?php if($type == 'CN29') { echo $data; }  ?>">
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
                                                        <th>Dollars</th>
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
                                                         <td><?= $row['total_dollars']; ?></td>
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
                                             <?php 
                                             if($_REQUEST['send_value'] == 'TD_Operations' || $_REQUEST['send_value'] == 'TD_Construction' && $_REQUEST['type'] == 'CN29'){
                                             //if($_REQUEST['send_value'] != ''  && $_REQUEST['type'] == 'CN29') { ?>
                                             
                                             <a href="../senior_team/ExcelGenerate_ws_filter.php?type=RespGroup-CN29&data_value=<?php echo $_REQUEST['send_value']; ?>"  class="btn btn-primary approvediv-colorr">Download Resp Group</a>  
                                             
                                             
                                              <?php } else if($_REQUEST['send_value'] != 'TD_Operations'  && $_REQUEST['type'] == 'CN29') { ?>
                                              
                                              <a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSCN29&date_value=<?php  echo $data;   ?>"  class="btn btn-primary approvediv-colorr">Download Weekly Excel</a>
                                                 
                                             
                                             <?php } else { ?>
                                             
                                             <a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSCN29-all"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                           
                                            <?php  } ?>
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
												<label class="mb-0 pr-2 ml-0">Filter Resp Group:</label>
											<select class="selectpicker show-tick form-control" name="filter" id="filterdata" title="Please select" onchange="showfun(this.value,'Remediation')" data-style="btn-solid" data-width="150px">
                                            <option <?php if($_REQUEST['send_value'] == 'TD_Construction' && $_REQUEST['type'] == 'Remediation') { echo "selected"; } ?> value="TD_Construction">T&D Construction</option>
                                            <option <?php if($_REQUEST['send_value'] == 'TD_Operations' && $_REQUEST['type'] == 'Remediation') { echo "selected"; } ?> value="TD_Operations">T&D Operations</option>
                                            
                                            </select>
											</div>
										</div>
										
                                    	<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Date Filter:</label>
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
                                                <th>Dollars</th>
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
                                                 <td><?= $rowjobstatus['total_dollars']; ?></td>
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
                                             <?php 
                                             if($_REQUEST['send_value'] == 'TD_Operations' || $_REQUEST['send_value'] == 'TD_Construction' && $_REQUEST['type'] == 'Remediation'){
                                             //if($_REQUEST['send_value'] != ''  && $_REQUEST['type'] == 'CN29') { ?>
                                             
                                             <a href="../senior_team/ExcelGenerate_ws_filter.php?type=RespGroup-Remidiation&data_value=<?php echo $_REQUEST['send_value']; ?>"  class="btn btn-primary approvediv-colorr">Download Resp Group</a>  
                                             
                                             
                                              <?php } else if($_REQUEST['send_value'] != 'TD_Operations'  && $_REQUEST['type'] == 'Remediation') { ?>
                                              
                                              <a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSRemediation&date_value=<?php  echo $data;   ?>"  class="btn btn-primary approvediv-colorr">Download Weekly Excel</a>
                                                 
                                             
                                             <?php } else { ?>
                                             
                                             <a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSRemediation-all"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                           
                                            <?php  } ?>
                                            <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                </div>

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
                                    
                                    	<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Filter Resp Group:</label>
											<select class="selectpicker show-tick form-control" name="filter" id="filterdata" title="Please select" onchange="showfun(this.value,'Unknown')" data-style="btn-solid" data-width="150px">
                                            <option <?php if($_REQUEST['send_value'] == 'TD_Construction' && $_REQUEST['type'] == 'Unknown') { echo "selected"; } ?> value="TD_Construction">T&D Construction</option>
                                            <option <?php if($_REQUEST['send_value'] == 'TD_Operations' && $_REQUEST['type'] == 'Unknown') { echo "selected"; } ?> value="TD_Operations">T&D Operations</option>
                                            
                                            </select>
											</div>
										</div>
                                    
                                    	<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Date Filter:</label>
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
                                                        <th>Dollars</th>
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
                                                <td><?= $rownotjobstart['total_dollars']; ?></td>
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
                                             <?php 
                                             if($_REQUEST['send_value'] == 'TD_Operations' || $_REQUEST['send_value'] == 'TD_Construction' && $_REQUEST['type'] == 'Unknown'){
                                             //if($_REQUEST['send_value'] != ''  && $_REQUEST['type'] == 'CN29') { ?>
                                             
                                             <a href="../senior_team/ExcelGenerate_ws_filter.php?type=RespGroup-Unknown&data_value=<?php echo $_REQUEST['send_value']; ?>"  class="btn btn-primary approvediv-colorr">Download Resp Group</a>  
                                             
                                             
                                              <?php } else if($_REQUEST['send_value'] != 'TD_Operations'  && $_REQUEST['type'] == 'Unknown') { ?>
                                              
                                                <a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSUnknown&date_value=<?php  echo $data;  ?>"  class="btn btn-primary approvediv-colorr">Download Weekly Excel</a>
                                                 
                                             
                                             <?php } else { ?>
                                             
                                             <a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSUnknown-all"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                           
                                            <?php  } ?>
                                            
                                        <!--<a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSUnknown-all"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                        <!--<?php if($type == 'Unknown' && $rowjonstatus['order_name'] != '') { ?>-->
                                        <!-- <a href="../senior_team/ExcelGenerate_ws_filter.php?type=WSUnknown&date_value=<?php  echo $data;  ?>"  class="btn btn-primary approvediv-colorr">Download Weekly Excel</a>-->
                                        <!--<?php } ?>-->
                                        <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                </div></div>
                
            </div></div></div></div>
          
      
            <!-- END PAGE CONTENT-->
         <?php include('../footer_review.php');  ?>  
     <script src="/assets/vendors/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/js/dataTables.select.min.js"></script>
    
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>-->
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>-->
 
  <script>
function showfun(data,job_type)
{
   // alert (data);
    window.location.href="ws_filter-working.php?send_value="+data+"&type="+job_type;
}
</script>
    
     <script>
  function datefun(date,type){
      //alert(type);
       window.location.href="ws_filter-working.php?date="+date+"&type="+type;
  }
  </script>
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

     