<?php
ob_start();
include('header.php');
$userid = $_SESSION['userid'];
 
// $sql = "SELECT * FROM cb_order_new WHERE user_id =$userid AND order_stage!='7' AND reject_status='0'";

$sql = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.rejected_date,cb_order_new.recommendation,cb_order_new.reject_status,cb_order_new.RESPONSIBLE_GROUP,cb_order_new.mat as MAAT,cb_order_new.description as Discriptions,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id =$userid AND cb_order_new.order_stage!='7' AND cb_order_new.reject_status='0'";
$result = $conn->query($sql);


// $sqlrejected = "SELECT * FROM cb_order_new WHERE user_id =$userid AND  rejected_date!='null' AND reject_status='1'";
    $sqlrejected = "SELECT cb_order_new.order_no,cb_order_new.reject_status,cb_order_new.commnets_of_reject,cb_order_new.recommendation,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id =$userid AND  cb_order_new.rejected_date!='null' AND cb_order_new.reject_status='1'";
$resultrejected = $conn->query($sqlrejected);

/*******************Queries added for pie chart************************/ 


$sql_TotalJobs = "SELECT count(cb_order.id) FROM cb_order LEFT JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.user_id =$userid";
$result_TotalJobs = $conn->query($sql_TotalJobs);
$row_TotalJob = $result_TotalJobs->fetch_array();
$row_TotalJobs = $row_TotalJob['0'];


$sql_JobsCoverSheet = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.user_id =$userid AND cb_order_new.order_stage = 1";
$result_JobsCoverSheet = $conn->query($sql_JobsCoverSheet);
$row_JobsCoverSheet = $result_JobsCoverSheet->fetch_array();
//echo "coversheet";
$row_JobsCoverSheet = $row_JobsCoverSheet['0'];
//echo '<br/>';

$sql_JobsProjctDetails = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.user_id =$userid AND cb_order_new.order_stage = 2";
$result_JobsPrjDetails = $conn->query($sql_JobsProjctDetails);
$row_JobsPrjDetails = $result_JobsPrjDetails->fetch_array();
//echo "PrjDetails";
$row_JobsPrjDetails = $row_JobsPrjDetails['0'];


 $sql_JobsQualifyFive = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.user_id =$userid AND cb_order_new.order_stage = 3";
$result_JobsQualifyFive = $conn->query($sql_JobsQualifyFive);
$row_JobsQualifyFive = $result_JobsQualifyFive->fetch_array();
//echo "QualifyFive";
$row_JobsQualifyFive = $row_JobsQualifyFive['0'];

$sql_JobsDistributnChkklist = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.user_id =$userid AND cb_order_new.order_stage = 4";
$result_JobsDistributnChkklist = $conn->query($sql_JobsDistributnChkklist);
$row_JobsDistributnChkklist = $result_JobsDistributnChkklist->fetch_array();
//echo "DistributnChkklist";
$row_JobsDistributnChkklist = $row_JobsDistributnChkklist['0'];

$sql_JobsReviewDone = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.user_id =$userid AND cb_order_new.order_stage = 6";
$result_JobsReviewDone = $conn->query($sql_JobsReviewDone);
$row_JobsReviewDone = $result_JobsReviewDone->fetch_array();
//echo "DistributnChkklist";
$row_JobsReviewDone = $row_JobsReviewDone['0'];

$sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM `cb_order_new` LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 1 AND cb_order_new.user_id =$userid";
$result_Jobsfield_remediation = $conn->query($sql_Jobsfield_remediation);
$row_Jobsfield_remediation = $result_Jobsfield_remediation->fetch_array();
//echo "Jobsfield_remediatio";
$row_Jobsfield_remediation = $row_Jobsfield_remediation['0'];

$sql_JobsCN29 = "SELECT count(cb_order.id) FROM `cb_order_new` LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 2 AND cb_order_new.user_id =$userid";
$result_JobsCN29 = $conn->query($sql_JobsCN29);
$row_JobsCN29 = $result_JobsCN29->fetch_array();
$row_JobsCN29 = $row_JobsCN29['0'];

$sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM `cb_order_new` LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 3 AND cb_order_new.user_id =$userid";
$result_Jobsunknown_status = $conn->query($sql_Jobsunknown_status);
$row_Jobsunknown_status = $result_Jobsunknown_status->fetch_array();
$row_Jobsunknown_status = $row_Jobsunknown_status['0'];

/*******************Queries End************************/ 

?>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<div class="container mk">
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
                                <div class="flexbox control-div mb-4 flex-column flex-md-row">
                                    <div class="flexbox">
                                        <label class="mb-0 mr-2">Status:</label>
                                        <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">
                                            <option value="">All</option>
                                            <option value="CN-29 Eligible">CN-29 Eligible</option>
                                            <option value="Field Remediation Required">Field Remediation Required</option>
                                            <option value="Unknown">Unknown Status</option>
                                            <option value="Not-Started">Not-Started</option>
                                            <option value="Pending For Approval">Approval Pending</option>
                                             <option value="Approved">Approved</option>
                                        </select>
                                    </div>
                                    <br class="clearfix d-block d-md-none">
                                    <div class="input-group-icon input-group-icon-left">
                                        <span>Search</span>
										
                                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dash_datatable">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>MAT</th>
                                                <th>Current Stage</th>
                                                <th>Job Status</th>
                                                <th>Recommendation</th>
                                                <th width="80px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($row = $result->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $row['order_no'];?></td>
                                                <td><?php if($row['description']!=''){ echo $row['description']; }else{ echo $row['Discriptions'];
                                                 }?></td>
                                                <td><?php if($row['resp_group']!=''){ echo $row['resp_group']; } else { echo $row['RESPONSIBLE_GROUP']; }?></td>
                                                <td><?php if($row['mat']!=''){ echo $row['mat']; } else { echo $row['MAAT']; }?></td>
                                                 <td><?php 
                                                 
                                                 if( $row['order_stage']=='0')
                                                 {
                                                     
                                                     echo 'Not-Started';
                                                 }
                                                 if( $row['order_stage']=='1')
                                                 {
                                                     
                                                     echo 'Cover Sheet';
                                                 }
                                                  if( $row['order_stage']=='2')
                                                 {
                                                     
                                                     echo 'Project Details';
                                                 }
                                                  if( $row['order_stage']=='3')
                                                 {
                                                     
                                                     echo 'Qualifying Five';
                                                 }
                                                  if( $row['order_stage']=='4')
                                                 {
                                                     
                                                     echo 'Checklist Questions';
                                                 }
                                                  if( $row['order_stage']=='5')
                                                 {
                                                     
                                                     echo 'Approval Pending';
                                                 }
                                                  if( $row['order_stage']=='6')
                                                 {
                                                     
                                                     echo 'Approved';
                                                 }
                                                 ?>
                                                 
                                                 
                                                 
                                                 </td>
                                                 <?php
                                                 $sqljobstatus = "SELECT cb_order.status,order_status.order_name FROM `cb_order` LEFT JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$row['order_no']."'";
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
                                                     echo '<span  style="color:lightblue !important;font-weight: bold;">Unknown</span>';
                                                 }
                                                 
                                                  if( $rowjonstatus['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                 
                                                 
                                                 ?></td>
                                                 <td><?php if($row['recommendation']==null){ echo 'N/A'; } else { echo $row['recommendation']; } ?></td>
                                                  <?php if( $row['order_stage']=='5')
                                                 {
                                                 ?>
                                                     
                                                     <td align="center"><a href="#"  class="bttn">Approval&nbsp;Pending</a></td>
                                                  <?php }else if($row['order_stage']=='6'){ ?>
                                                   <td align="center"><a href="#"  class="bttn">Approved</a></td>

                                                  <?php }else{
                                                  ?>  <td align="center"><a  onClick="return RestartReview('<?= $userid ?>','<?= $row['order_no'] ?>')"   class="bttn">Restart Review</a></td><?php
                                                  } ?>
                                                 
                                                 
                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> </div>
                    
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="font-strong mb-4">Rejected jobs</h5>
                                    </div>
                                </div>
                                <div class="flexbox control-div mb-4 flex-column flex-md-row">
                                    <div class="flexbox">
                                        <label class="mb-0 mr-2">Status:</label>
                                        <select class="selectpicker show-tick form-control" id="type-filter2" title="Please select" data-style="btn-solid" data-width="150px">
                                            <option value="">All</option>
                                            <option value="CN-29 Eligible">CN-29 Eligible</option>
                                            <option value="Field Remediation Required">Field Remediation Required</option>
                                            <option value="Unknown">Unknown Status</option>
                                          </select>
                                    </div>
                                    <br class="clearfix d-block d-md-none">
                                    <div class="input-group-icon input-group-icon-left">
                                        <span>Search</span>
										
                                        <input class="form-control form-control-rounded form-control-solid" id="key-search2" type="text" placeholder="">
                                    </div>
                                </div>
                               <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dash_datatable2">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>Reason For Reject</th>
                                                <th>MAT</th>
                                                
                                                
                                                <th>Current Stage</th>
                                                <th>Job Status</th>
                                                <th>Recommendation</th>
                                                
                                                <th width="80px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($rowrejected = $resultrejected->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $rowrejected['order_no'];?></td>
                                                <td><?php echo $rowrejected['description'];?></td>
                                                <td><?php echo $rowrejected['resp_group'];?></td>
                                                <td><?php echo $rowrejected['commnets_of_reject'];?></td>
                                                <td><?php echo $rowrejected['mat'];?></td>
                                                 <td><?php 
                                                 
                                                 if( $rowrejected['order_stage']=='0')
                                                 {
                                                     
                                                     echo 'Not-Started';
                                                 }
                                                 if( $rowrejected['order_stage']=='1')
                                                 {
                                                     
                                                     echo 'Cover Sheet';
                                                 }
                                                  if( $rowrejected['order_stage']=='2')
                                                 {
                                                     
                                                     echo 'Project Details';
                                                 }
                                                  if( $rowrejected['order_stage']=='3')
                                                 {
                                                     
                                                     echo 'Qualifying Five';
                                                 }
                                                  if( $rowrejected['order_stage']=='4')
                                                 {
                                                     
                                                     echo 'Checklist Questions';
                                                 }
                                                  if( $rowrejected['order_stage']=='5')
                                                 {
                                                     
                                                     echo 'Pending For Approval';
                                                 }
                                                  if( $rowrejected['order_stage']=='6')
                                                 {
                                                     
                                                     echo 'Approved';
                                                 }
                                                  if( $rowrejected['order_stage']=='7')
                                                 {
                                                     
                                                     echo 'Rejected';
                                                 }
                                                 ?>
                                                 
                                                 
                                                 
                                                 </td>
                                                 <?php
                                                   $sqljobstatusrej = "SELECT cb_order.status,order_status.order_name FROM `cb_order` LEFT JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$rowrejected['order_no']."'";
                                                 $resultjonstatusrej = $conn->query($sqljobstatusrej);
                                                 $rowjonstatusrej = $resultjonstatusrej->fetch_assoc();
                                                 ?>
                                                 <td><?php 
                                                 
                                                 if( $rowjonstatusrej['order_name']=='CN-29 Eligible')
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">'.$rowjonstatusrej['order_name'].'</span>';
                                                 }
                                                
                                                  if( $rowjonstatusrej['order_name']=='Unknown Status')
                                                 {
                                                     echo '<span  style="color:lightblue !important;font-weight: bold;">Unknown</span>';
                                                 }
                                                 
                                                  if( $rowjonstatusrej['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rowjonstatusrej['order_name'].'</span>';
                                                 }
                                                 
                                                 
                                                 ?></td>
                                                 <td><?php if($rowrejected['recommendation']==null){ echo 'N/A'; } else { echo $rowrejected['recommendation']; } ?></td>
                                                  <?php if( $rowrejected['order_stage']=='5')
                                                 {
                                                 ?>
                                                     
                                                     <td align="center"><a href="#"  class="bttn">Pending For Approval</a></td>
                                                  <?php }else if($rowrejected['order_stage']=='6'){ ?>
                                                   <td align="center"><a href="#"  class="bttn">Approved</a></td>

                                                  <?php }else{
                                                  ?>  <td align="center"><a  onClick="return RestartReview('<?= $userid ?>','<?= $rowrejected['order_no'] ?>')" id="rejectbtn"  class="bttn">Restart Review</a></td><?php
                                                  } ?>
                                                 
                                                 
                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> </div>
                <div class="row">
                    <div class="col-lg-4 mb-md-4">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Total Jobs</div>
                            </div>
                            <div class="ibox-body">
                                 <div class="chart-wrapper">
                                   <div id="dash_pie_totaljobs" style="height:150px;"></div>
                                   <!--<div id="dash_pie_totaljobs" style="text-align:center;height:30px;width:250px;height:20px;text-align:center;margin:0 auto"></div>-->
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
            </div>
    
  <!-- END PAGE CONTENT-->
          <?php
include('footer.php');

?>
<script src="assets/js/reviwer.pie.char.js"></script><!--Piechart js-->
<script>
    function RestartReview(id,order_no) {
    var encodeid = $.base64.encode(id);
    var encode_orderno = $.base64.encode(order_no);
                                    var request = $.ajax({
                                      url: "RestartReviewJS.php",
                                      type: "POST",
                                      data: {id:id,order_no:order_no}
                                    });
                                  
                                    request.done(function(msg) {
                                     console.log(msg);
                                     //alert( "Requestc done: " + msg );
                                      window.location.href="review.php?id="+encodeid+"&ono="+encode_orderno;
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                          console.log(textStatus);
                                   //  alert( "Request failed: " + textStatus );
                                    });
    }
</script>