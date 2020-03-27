 
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
 include_once 'config.php';
$conn = OpenCon();
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (cb_order_new.order_no like '%".$searchValue."%' or 
        CONCAT(cb_user.first_name, ' ' , cb_user.last_name) like '%".$searchValue."%')";
}
$searchQuery2 = " ";
if($jobstatus != ''){
   $searchQuery2 = " AND (cb_order.status= $jobstatus OR cb_order_new.order_stage=$jobstatus)";
}
 
// $sql = "SELECT * FROM cb_order_new WHERE user_id =$userid AND order_stage!='7' AND reject_status='0'";
$sqljobnotstart = "SELECT cb_order_new.order_no,cb_order_new.recommendation,cb_order_new.user_id,cb_order_new.RESPONSIBLE_GROUP,cb_order_new.mat as MAAT,cb_order_new.description as Discriptions,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.order_stage =0 AND cb_order_new.user_id!='0' $searchQuery $searchQuery2 ORDER BY cb_order_new.order_stage DESC LIMIT $start_fromJobsforApproval, $limit";
$resultjobnotstart = $conn->query($sqljobnotstart);
 $query = "SELECT COUNT(*) FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.order_stage =0 AND cb_order_new.user_id!='0' $searchQuery $searchQuery2";  

$result_db = mysqli_query($conn,$query); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit);
?>
 
                             
                                    
                                
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="dash_datatablecompleted">
                                                <thead class="thead-default">
                                            <tr>
                                                <th>Assign To</th>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>MAT</th>
                                                 <th>Action</th>


                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										if( mysqli_num_rows($resultjobnotstart)>0){
											while($rownotjobstart = $resultjobnotstart->fetch_assoc()) { ?>
											<tr> 
                                                <td><?php echo $rownotjobstart['name'];?></td>
                                                <input type="hidden" name="memid" value="<?php echo $rownotjobstart['order_no'];?>" id="hiddenorderid">
                                                         <input type="hidden" name="memid" value="<?php echo $rownotjobstart['user_id'];?>" id="hiddenuserid">
                                                <td><?php echo $rownotjobstart['order_no'];?></td>
                                                <td><?php if($rownotjobstart['description']!=''){ echo $rownotjobstart['description']; }else{ echo $rownotjobstart['Discriptions'];
                                                 }?></td>
                                                <td><?php if($rownotjobstart['resp_group']!=''){ echo $rownotjobstart['resp_group']; } else { echo $rownotjobstart['RESPONSIBLE_GROUP']; }?></td>
                                                <td><?php if($rownotjobstart['mat']!=''){ echo $rownotjobstart['mat']; } else { echo $rownotjobstart['MAAT']; }?></td>
                                                
                                                 <td align="center"><button type="button" class="btn btn-primary viewjobs" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></td>
                                                 
                                            </tr>
											 <?php }}else{
												 ?>
												 <tr><td valign="top" colspan="9" class="text-center dataTables_empty">No data available in table</td></tr>
												 <?php
											 }
                                                   
                                                    ?>
                                            
                                           
                                        </tbody>
                                            </table>
											
<div class="row">
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
                    <a href="javascript:void(0);"    onclick="displayRecordsjobnotstarted('<?php echo $limit;  ?>', '<?php echo $JobsforApproval-1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');" class="links">Previous</a>
                    
                    <?php   
	if($JobsforApproval > 5){
	
	?>
                <li class="paginate_button page-item next disabled" id="DataTables_Table_6_next">
                     <a href="javascript:void(0);" onclick="displayRecordsjobnotstarted('<?php echo $limit;  ?>', '<?php echo 1 ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"  class="links">1</a>
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
<li>	<a href="javascript:void(0);" class="links"  onclick="displayRecordsjobnotstarted('<?php echo $limit;  ?>', '<?php echo $i; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"><?php echo $i ?></a></li>
	
<?php
	$k++;
	}
	}
 
}
?>
            <?php if ($JobsforApproval <= $total_pages - 7) { ?>
<li class="lastvalue"><span>...</span></li>
	
                <li class="paginate_button page-item next disabled" id="DataTables_Table_6_next">
                 
                    <a href="javascript:void(0);" onclick="displayRecordsjobnotstarted('<?php echo $limit;  ?>', '<?php echo $total_pages; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"  class="links lastvaluejonnotstrt"><?= $total_pages ?></a>
                   </li>  
<?php }  else{
    ?>
   
    <?php
}
 ?>
  <li>
                    <?php if ( ($JobsforApproval+1) <= $total_pages) { ?>
                    <a href="javascript:void(0);" onclick="displayRecordsjobnotstarted('<?php echo $limit;  ?>', '<?php echo $JobsforApproval+1; ?>','<?php echo $searchValue; ?>','<?php echo $jobstatus; ?>','<?php echo $total_pages; ?>');"  class="links">Next</a>
                    
<?php } 
if ( ($JobsforApproval) != $total_pages) { ?> 
                    <!--<a href="javascript:void(0);" onclick="displayRecordsjobnotstarted('<?php //echo $limit;  ?>', '<?php //echo $total_pages; ?>','<?php //echo $searchValue; ?>','<?php //echo $jobstatus; ?>');" class="links">Last</a>-->
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
</style>

                                        </div>
                                    </div>
                                </div>
                       
 <script src="assets/js/crossbore_main.js"></script>
										