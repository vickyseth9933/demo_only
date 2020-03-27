<?php
if($_GET['show']==''){
$limit = 10;	
} else{
$limit = $_GET['show'];	
}
 $sortField = $_GET['sortField'];
 $sortOrder = $_GET['sortOrder'];
 
 $searchValue = $_GET['Keysearch']; 
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
   $searchQuery = "WHERE order_id like '%".$searchValue."%' OR 
        description like '%".$searchValue."%' OR complete_date like '%".$searchValue."%' OR complete_status like '%".$searchValue."%'";
}


$sortFieldQuery = " ";
if($sortField != ''){
	if($sortField=='ORDER_NO'){
   $sortFieldQuery = "ORDER BY order_id $sortOrder";
	}
 
		else if($sortField=='OrderDescription'){
   $sortFieldQuery = "ORDER BY description  $sortOrder";
	}
		else if($sortField=='complete_status'){
   $sortFieldQuery = "ORDER BY complete_status  $sortOrder";
	}
	 
		else if($sortField=='complete_date'){
   $sortFieldQuery = "ORDER BY complete_date  $sortOrder";
	}
		else if($sortField=='SLNO'){
   $sortFieldQuery = "ORDER BY id  $sortOrder";
	}
	
  
}

 $role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);

// $sql = "SELECT * FROM cb_order_new WHERE user_id =$userid";
  $sql = "SELECT * FROM completed_jobs  $searchQuery  $sortFieldQuery LIMIT  $limit OFFSET $start_fromJobsforApproval";
 

 
$result = $conn->query($sql);
     $query = "SELECT count(*) FROM completed_jobs   $searchQuery ";  

$result_db = mysqli_query($conn,$query); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
 
?>
 
                                
                                
                                     <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                 <th onclick="displayRecordsbysort('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','ORDER_NO')"><b>Order id</b> <span  style="top: 5px;right:2px;"><?php if($sortField=='ORDER_NO'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                <th onclick="displayRecordsbysort('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','OrderDescription')"><b>Description</b> <span  style="top: 5px;right:2px;"><?php if($sortField=='OrderDescription'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                <th onclick="displayRecordsbysort('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','complete_status')"><b>Complete status</b> <span  style="top: 5px;right:2px;"><?php if($sortField=='complete_status'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                <th onclick="displayRecordsbysort('<?php echo $limit;  ?>', '<?php echo 1; ?>','<?php echo $searchValue; ?>','complete_date')"><b>Complete date</b> <span  style="top: 5px;right:2px;"><?php if($sortField=='complete_date'){ ?><span class="<?php if($sortOrder=='DESC'){ echo 'text-white';} ?>" >↑</span><span   class="<?php if($sortOrder=='ASC'){ echo 'text-white';} ?> ">↓</span> <?php } else{ ?> <span class="" >↑</span><span   class="">↓</span> <?php } ?></span></th>
                <th>Delete</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
             while($rowjobcompleted = $result->fetch_assoc()) { ?>
            <tr id="order_no_<?= $rowjobcompleted['order_id']; ?>">
                 <td><?= $rowjobcompleted['order_id']; ?></td>
                <td><?= $rowjobcompleted['description']; ?></td>
                <td><?= $rowjobcompleted['complete_status']; ?></td>
                <td><?= $rowjobcompleted['complete_date']; ?></td>
                <td><a onClick="return RemoveJobs(<?= $rowjobcompleted['order_id']; ?>)"><i class='fa fa-remove'></i></a></td>
                 
            </tr>
            <?php 
            $i++;
            } ?>
            </tbody>
            </table>
                                 
											<td> 


<div class="row">
    <div class="col-sm-12 col-md-5">
        <?php
if($total_records>0){
?>  
    <div class="dataTables_info" id="DataTables_Table_6_info">Showing <?php  if($JobsforApproval==1){ echo '1';}else{ echo $limit*$JobsforApproval-$limit; } ?>  to <?php  if($JobsforApproval==1){ echo $limit; }else{ echo $limit*$JobsforApproval; } ?> of <?= $total_records ?> Entries</div>
 <?php }else{
	?>
<div class="dataTables_info" id="DataTables_Table_6_info" role="status" aria-live="polite">ShowingShowing 0  to 0 of <?= $total_records ?> Entries</div>
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
                    <a href="javascript:void(0);"    onclick="displayRecords('<?php echo $limit;  ?>', '<?php echo $JobsforApproval-1; ?>','<?php echo $searchValue; ?>','<?php echo $total_pages; ?>');" class="links">Previous</a>
                    
                    <?php   
	if($JobsforApproval > 5){
	
	?>
                <li class="paginate_button page-item next disabled" id="DataTables_Table_6_next">
                     <a href="javascript:void(0);" onclick="displayRecords('<?php echo $limit;  ?>', '<?php echo 1 ?>','<?php echo $searchValue; ?>','<?php echo $total_pages; ?>');"  class="links">1</a>
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
<li>	<a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $limit;  ?>', '<?php echo $i; ?>','<?php echo $searchValue; ?>','<?php echo $total_pages; ?>');"><?php echo $i ?></a></li>
	
<?php
	$k++;
	}
	}
 
}
?>
            <?php if ($JobsforApproval <= $total_pages - 7) { ?>
<li class="lastvalue"><span>...</span></li>
	
                <li class="paginate_button page-item next disabled" id="DataTables_Table_6_next">
                 
                    <a href="javascript:void(0);" onclick="displayRecords('<?php echo $limit;  ?>', '<?php echo $total_pages; ?>','<?php echo $searchValue; ?>','<?php echo $total_pages; ?>');"  class="links lastvaluejobstst"><?= $total_pages ?></a>
                   </li> 
<?php }  else{
    ?>
   
    <?php
}
 ?>
 <li>
                    <?php if ( ($JobsforApproval+1) <= $total_pages) { ?>
                    <a href="javascript:void(0);" onclick="displayRecords('<?php echo $limit;  ?>', '<?php echo $JobsforApproval+1; ?>','<?php echo $searchValue; ?>','<?php echo $total_pages; ?>');"  class="links">Next</a>
                    
<?php } 
if ( ($JobsforApproval) != $total_pages) { ?> 
                    <!--<a href="javascript:void(0);" onclick="displayRecords('<?php //echo $limit;  ?>', '<?php //echo $total_pages; ?>','<?php //echo $searchValue; ?>','<?php //echo $jobstatus; ?>');" class="links">Last</a>-->
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
<?php
/* echo '</ul>';

echo '<div align="center">';
// To generate links, we call the pagination function here. 
echo paginate_function($limit, $JobsforApproval, $total_records, $total_pages);
echo '</div>'; */
?>

 
                   
<script>
  
$(document).ready(function(){
	$('#adtbl-select-all').change(function () {
    $('tbody tr td input[type="checkbox"]').prop('checked', $(this).prop('checked'));
});

 
 });	    

 
</script>

 <script src="assets/js/crossbore_main.js"></script> 

										