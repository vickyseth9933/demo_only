
<?php
if($_GET['show']==''){
$limit = 5;	
} else{
$limit = $_GET['show'];	
}
$searchValue = $_GET['Keysearch']; 
$jobstatus = $_GET['jobstatus']; 
if (isset($_GET["JobsforApproval"])) {
	$JobsforApproval  = $_GET["JobsforApproval"]; 
	} 
	else{ 
	$JobsforApproval=1;
	};  
$start_fromJobsforApproval = ($JobsforApproval-1) * $limit; 
session_start();
include_once 'config.php';
$conn = OpenCon();
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (completed_jobs.order_id like '%".$searchValue."%' or 
        CONCAT(cb_user.first_name, ' ' , cb_user.last_name) like '%".$searchValue."%')";
}
$searchQuery2 = " ";
if($jobstatus != ''){
 	if($jobstatus==1 || $jobstatus==2 || $jobstatus==3){
	$jobstatus1 = "AND cb_order.status= $jobstatus";	
	}else{
	$jobstatus1 = '';	
	}
	 if($jobstatus==4){
	$jobstatus2 = "AND (cb_order.status=0 || cb_order.status='') AND (completed_jobs.complete_status='Complete' || completed_jobs.complete_status='Complete, In SAP Long Text')";	
	}
	 else if($jobstatus==5){
	$jobstatus2 = "AND (cb_order.status=0 || cb_order.status='') AND (completed_jobs.complete_status='Not Complete/In Progress')";	
	}
	 else{
	$jobstatus2 ='';	
	}
   $searchQuery2 = "$jobstatus1  $jobstatus2";
}

$userid = $_SESSION['userid'];
 $role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
// $sql = "SELECT * FROM cb_order_new WHERE user_id =$userid AND order_stage!='7' AND reject_status='0'";

$sqljobcompleted = "SELECT completed_jobs.*,cb_order_new.order_no,cb_order_new.recommendation,cb_order_new.user_id,cb_order_new.RESPONSIBLE_GROUP,cb_order_new.mat as MAAT,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.resp_group,
cb_project_details.mat FROM completed_jobs 
LEFT  JOIN cb_order_new ON(cb_order_new.order_no=completed_jobs.order_id)
LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=completed_jobs.order_id)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=completed_jobs.order_id)
WHERE (cb_order_new.order_stage NOT IN(5) OR completed_jobs.order_stage=0) AND (cb_order_new.order_stage !=0 ||  completed_jobs.order_stage=0) $searchQuery $searchQuery2 LIMIT $start_fromJobsforApproval, $limit";
$resultjobcompleted = $conn->query($sqljobcompleted);

    $query = "SELECT COUNT(*) FROM completed_jobs 
LEFT  JOIN cb_order_new ON(cb_order_new.order_no=completed_jobs.order_id)
LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_order ON(cb_order.order_id=completed_jobs.order_id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=completed_jobs.order_id)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=completed_jobs.order_id)
WHERE (cb_order_new.order_stage NOT IN(5) OR completed_jobs.order_stage=0) AND (cb_order_new.order_stage !=0 ||  completed_jobs.order_stage=0) $searchQuery $searchQuery2";  

$result_db = mysqli_query($conn,$query); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
?>
 
                              
                                    
                                
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="dash_datatable3">
                                                <thead class="thead-default">
                                            <tr>
                                                <th>Assign To</th>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Job status</th>
                                                <th>Resp Group</th>
                                                <th>MAT</th>
                                                 <th>Action</th>


                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										if( mysqli_num_rows($resultjobcompleted)>0){
											while($rowjobcompleted = $resultjobcompleted->fetch_assoc()) { ?>
											<tr>
											     <input type="hidden" name="" value="<?php echo $rowjobcompleted['order_id'];?>" id="hiddenorderidcmpt">
                                                 <input type="hidden" name="" value="<?php echo $rowjobcompleted['user_id'];?>" id="hiddenuseridcmpt">
                                                <td><?php if($rowjobcompleted['name']!=''){ echo $rowjobcompleted['name']; }else{ echo 'Unknown';
                                                 }?></td>
                                                 
                                                <td><?php echo $rowjobcompleted['order_id'];?></td>
                                                <td><?php if($rowjobcompleted['description']!=''){ echo $rowjobcompleted['description']; }else{ echo 'N/A';
                                                 }?></td>
                                                 <td>
                                                 <?php 
                                                 $sqljobstatus = "SELECT cb_order.status,order_status.order_name FROM `cb_order` INNER JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$rowjobcompleted['order_id']."'";
                                                 $resultjonstatus = $conn->query($sqljobstatus);
                                                 $rowjonstatus = $resultjonstatus->fetch_assoc();
                                                 ?>
                                                 <?php 
                                                 
                                                 if( $rowjonstatus['order_name']=='CN-29 Eligible')
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                
                                                  if( $rowjonstatus['order_name']=='Unknown Status')
                                                 {
                                                    //  echo '<span  style="color:lightblue !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                      echo '<span  style="color:lightblue !important;font-weight: bold;">Unknown</span>';
                                                 }
                                                 
                                                  if( $rowjonstatus['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                
                                                 if( ($rowjonstatus['status']=='0' || $rowjonstatus['status']=='') AND ($rowjobcompleted['complete_status']=='Complete' || $rowjobcompleted['complete_status']=='Complete, In SAP Long Text'))
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">CN29 Eligible per BR CB Team</span>';
                                                 }
                                                  if(($rowjonstatus['status']=='0' || $rowjonstatus['status']=='') AND $rowjobcompleted['complete_status']=='Not Complete/In Progress')
                                                 {
                                                     echo '<span style="color:lightblue !important;font-weight: bold;">Incomplete</span>';
                                                 }
                                                 ?>
                                                 </td>
                                                <td><?php if($rowjobcompleted['resp_group']!=''){ echo $rowjobcompleted['resp_group']; } else { echo $rowjobcompleted['RESPONSIBLE_GROUP']; }?></td>
                                                <td><?php if($rowjobcompleted['mat']!=''){ echo $rowjobcompleted['mat']; } else { echo $rowjobcompleted['MAAT']; }?></td>
                                                
                                                 <td align="center"><button type="button" class="btn btn-primary viewcompletedjobs" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></td>
                                                 
                                            </tr>
															
										<?php }}else{
											?>
											<tr><td valign="top" colspan="9" class="dataTables_empty">No matching records found</td></tr>
											<?php
										} ?>
                                            
                                           
                                        </tbody>
                                            </table>
                                        <!--    
                                            <?php
if($total_records>0){
?>
	<td align="right" valign="top">
	Showing <?php  if($JobsforApproval==1){ echo '1';}else{ echo $limit*$JobsforApproval-$limit; } ?>  to <?php  if($JobsforApproval==1){ echo '5'; }else{ echo $limit*$JobsforApproval; } ?> of <?= $total_records ?> Entries
	</td>
<?php }else{
	?>
<td align="right" valign="top">
	Showing 0  to 0 of <?= $total_records ?> Entries
	</td>	
	<?php
} ?> 
											<td valign="top" align="right" >
 
	<?php
	if ( ($JobsforApproval-1) > 0) {
	?>	
	 <a href="javascript:void(0);" class="links" onclick="displayRecordsjobstatuscompletedjobs('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>');">First</a>
	<a href="javascript:void(0);" class="links"  onclick="displayRecordsjobstatuscompletedjobs('<?php echo $limit;  ?>', '<?php echo $JobsforApproval-1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>');">Previous</a>
	<?php
	}

if ( ($JobsforApproval+1) <= $total_pages) {
?>
	<a href="javascript:void(0);" onclick="displayRecordsjobstatuscompletedjobs('<?php echo $limit;  ?>', '<?php echo $JobsforApproval+1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>');" class="links">Next</a>
<?php } if ( ($JobsforApproval) != $total_pages) { ?>	
	<a href="javascript:void(0);" onclick="displayRecordsjobstatuscompletedjobs('<?php echo $limit;  ?>', '<?php echo $total_pages; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>');" class="links" >Last</a> 
<?php
	} 
?>
</td>-->
                                     </div>
                                    </div>
                                </div>
    <script src="assets/js/crossbore_main.js"></script>                      
                     

 										