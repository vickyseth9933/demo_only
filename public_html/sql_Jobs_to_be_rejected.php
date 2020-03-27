
<?php
if($_GET['show']==''){
$limit = 5;	
} else{
$limit = $_GET['show'];	
}
 $sortField = $_GET['sortField'];
 $sortOrder = $_GET['sortOrder'];
 
 $searchValue = $_GET['Keysearch']; 
$jobstatus = $_GET['jobstatus']; 
if (isset($_GET["JobsforApproval"])) {
	$JobsforApproval  = $_GET["JobsforApproval"]; 
	} 
	else{ 
	$JobsforApproval=1;
	};  
$start_fromJobsforApproval = ($JobsforApproval-1) * $limit; 
//session_start();
include_once 'config.php';
$conn = OpenCon();
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (cb_order_new.order_no like '%".$searchValue."%' OR 
        CONCAT(cb_user.first_name, ' ' , cb_user.last_name) like '%".$searchValue."%' OR cb_order_new.mat LIKE '%".$searchValue."%' OR cb_order_new.description LIKE '%".$searchValue."%' OR cb_order_new.resp_group LIKE '%".$searchValue."%' OR cb_order_new.recommendation LIKE '%".$searchValue."%' OR cb_order_new.commnets_of_reject LIKE '%".$searchValue."%')";
}
$searchQuery2 = " ";
if($jobstatus != ''){
   $searchQuery2 = " AND (cb_order.status= $jobstatus OR cb_order_new.order_stage=$jobstatus)";
}


$sortFieldQuery = " ";
if($sortField != ''){
	if($sortField=='ORDER_NO'){
   $sortFieldQuery = "ORDER BY cb_order_new.order_no $sortOrder";
	}
	else if($sortField=='MAT'){
   $sortFieldQuery = "ORDER BY cb_order_new.mat  $sortOrder";
	}
		else if($sortField=='OrderDescription'){
   $sortFieldQuery = "ORDER BY cb_order_new.description  $sortOrder";
	}
		else if($sortField=='RespGroup'){
   $sortFieldQuery = "ORDER BY cb_front_cover.resp_group  $sortOrder";
	}
		else if($sortField=='CurrentStage'){
   $sortFieldQuery = "ORDER BY cb_order_new.order_stage  $sortOrder";
	}
		else if($sortField=='Recommendation'){
   $sortFieldQuery = "ORDER BY cb_order_new.recommendation  $sortOrder";
	}
 else if($sortField=='JobStatus'){
   $sortFieldQuery = "ORDER BY cb_order.status  $sortOrder";
	}
	else if($sortField=='Action'){
   $sortFieldQuery = "ORDER BY cb_order_new.order_stage  $sortOrder";
	}
	else if($sortField=='ReasonForReject'){
   $sortFieldQuery = "ORDER BY cb_order_new.commnets_of_reject  $sortOrder";
	}
	
}
$userid = $_GET['id'];
//$role_id = $_SESSION['role'];
//  $roleID = explode(',',$role_id);

// print_r($roleID);
// $sql = "SELECT * FROM cb_order_new WHERE user_id =$userid AND order_stage!='7' AND reject_status='0'";

   $sql = "SELECT cb_order_new.order_no,cb_order_new.RESPONSIBLE_GROUP,cb_order_new.reject_status,cb_order_new.commnets_of_reject,cb_order_new.recommendation,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id =$userid AND  cb_order_new.rejected_date!='null' AND cb_order_new.reject_status='1' AND cb_order_new.remove_status='0' $searchQuery $searchQuery2 $sortFieldQuery LIMIT  $limit OFFSET $start_fromJobsforApproval";
$resultrejected = $conn->query($sql);


     $query = "SELECT COUNT(*) FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id =$userid AND  cb_order_new.rejected_date!='null' AND cb_order_new.reject_status='1' AND cb_order_new.remove_status='0' $searchQuery $searchQuery2 $sortFieldQuery ";  

$result_db = mysqli_query($conn,$query); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
?>
 
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dash_datatable2">
                                        <thead class="thead-default">
                                            <tr>
                                               <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','ORDER_NO')"><b>Order No</b> <span  style="top: 5px;right:2px;"><?php if($sortField=='ORDER_NO'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                                <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','OrderDescription')">Order Description</b><span  style="top: 5px;right:2px;"><?php if($sortField=='OrderDescription'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                                <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','RespGroup')"><b>Resp Group</b><span  style="top: 5px;right:2px;"><?php if($sortField=='RespGroup'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                                <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','ReasonForReject')"><b>Reason For Reject</b> <span  style="top: 5px;right:2px;"><?php if($sortField=='ORDER_NO'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                                <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','MAT')"><b>MAT</b><span  style="top: 5px;right:2px;"><span  style="top: 5px;right:2px;"><?php if($sortField=='MAT'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                                <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','CurrentStage')"><b>Current Stage</b><span  style="top: 5px;right:2px;"><?php if($sortField=='CurrentStage'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                                <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','JobStatus')"><b>Job Status</b><span  style="top: 5px;right:2px;"><?php if($sortField=='JobStatus'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                                <th onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','Recommendation')"><b>Recommendation</b><span  style="top: 5px;right:2px;"><span  style="top: 5px;right:2px;"><?php if($sortField=='Recommendation'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>                                                
                                                <th width="120px" onclick="displayRecordsbysortrejected('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','Action')"><b>Action</b><span  style="top: 5px;right:2px;"><span  style="top: 5px;right:2px;"><?php if($sortField=='Action'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										if($total_records > 0){
											while($rowrejected = $resultrejected->fetch_assoc()) { ?>
											<tr id="order_no_<?= $rowrejected['order_no'] ?>">
                                                <td><?php echo $rowrejected['order_no'];?></td>
                                                <td><?php echo $rowrejected['description'];?></td>
                                                <td><?php if($rowrejected['resp_group']!=''){ echo $rowrejected['resp_group']; } else { echo $rowrejected['RESPONSIBLE_GROUP']; }?></td>
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
                                                   $sqljobstatusrej = "SELECT cb_order.status,order_status.order_name FROM `cb_order` INNER JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$rowrejected['order_no']."'";
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
															
												 	<?php } }else{
											?>
											<tr><td valign="top" colspan="9" class="text-center dataTables_empty">No data available in table</td></tr>
											<?php
										} ?>
                                        </tbody>
                                    </table>
                                </div>
                       		<div class="row mt-3">
    <div class="col-sm-12 col-md-5">
        <?php
if($total_records>0){
?>  
    <div class="dataTables_info" id="DataTables_Table_6_info">Showing <?php  if($JobsforApproval==1){ echo '1';}else{ echo $limit*$JobsforApproval-$limit; } ?>  to <?php  if($JobsforApproval==1){ echo '5'; }else{ echo $limit*$JobsforApproval; } ?> of <?= $total_records ?> Entries</div>
 <?php }else{
	?>
<div class="dataTables_info" id="DataTables_Table_6_info" role="status" aria-live="polite">Showing 0  to 0 of <?= $total_records ?> Entries</div>
<?php
} ?> 
     </div>
    <div class="col-sm-12 col-md-7">
        <div class="custum-pgination" id="DataTables_Table_6_paginate">
            <ul class="pagination  justify-content-end">
                <li class="paginate_button page-item previous disabled" id="DataTables_Table_6_previous">
                    	<?php  
  	   if ( ($JobsforApproval-1) > 0) {
     	?>	 
                    <a href="javascript:void(0);"    onclick="displayRecordsrejected('<?php echo $limit;  ?>', '<?php echo $JobsforApproval-1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');" class="links">Previous</a>
                    
                    <?php   
	if($JobsforApproval > 5){
	
	?>
                <li class="paginate_button page-item next disabled" id="DataTables_Table_6_next">
                     <a href="javascript:void(0);" onclick="displayRecordsrejected('<?php echo $limit;  ?>', '<?php echo 1 ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"  class="links">1</a>
                    <li class="firstvalue"><span>...</span></li>
<?php }   
 
 ?>
                    <?php }else{
?>
<li class="paginate_button page-item next disabled" id="DataTables_Table_6_next">


<a href="javascript:void(0);" disabled="disabled"  class="links">Previous</a>
 

<?php
						} ?>
                </li>
 
           <?php
							//Show page links
	$k = 0;
 	for($i=1; $i<=$total_pages; $i++) {
		if($i < $JobsforApproval){
			continue;
		}
		else if ($i == $JobsforApproval ) {
?>
		<li><a href="javascript:void(0);" class="selected"><?php echo $i ?></a></li>
<?php
	} else{  
	if($k > 5){
		continue;
	}
 else{
	
?>
<li>	<a href="javascript:void(0);" class="links"  onclick="displayRecordsrejected('<?php echo $limit;  ?>', '<?php echo $i; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"><?php echo $i ?></a></li>
	
<?php
	$k++;
	}
	}
 
}
?>
            <?php if ($JobsforApproval <= $total_pages - 7) { ?>
<li class="lastvalue"><span>...</span></li>
	
                <li class="paginate_button page-item next disabled" id="DataTables_Table_6_next">
                 
                    <a href="javascript:void(0);" onclick="displayRecordsrejected('<?php echo $limit;  ?>', '<?php echo $total_pages; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"  class="links lastvaluepageupx"><?= $total_pages ?></a>
                   </li> 
<?php }  else{
    ?>
   
    <?php
}
 ?>
 <li>
                    <?php if ( ($JobsforApproval+1) <= $total_pages) { ?>
                    <a href="javascript:void(0);" onclick="displayRecordsrejected('<?php echo $limit;  ?>', '<?php echo $JobsforApproval+1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"  class="links">Next</a>
                    
<?php } 
if ( ($JobsforApproval) != $total_pages) { ?> 
                    <!--<a href="javascript:void(0);" onclick="displayRecordsrejected('<?php //echo $limit;  ?>', '<?php //echo $total_pages; ?>','<?php //echo $searchValue; ?>','<?php //echo $jobstatus; ?>');" class="links">Last</a>-->
<?php } ?>                    
                </li>
            </ul>
        </div>
    </div>
</div>
<style>
	.custum-pgination ul.pagination li {
    margin-right: 5px;
}
	.custum-pgination ul.pagination li a {
		    color: #6c757d;
    cursor: auto;
    background-color: #fff;
    border-radius: 0 !important;
    padding: 2px 10px;
    background: #dddddd;
    border: none;
	cursor:pointer;
	}
	.custum-pgination ul.pagination li a.selected {
		    background: #5c6bc0;
			color:#fff;
	}
thead.thead-default tr {
    cursor: pointer;
}
</style>								