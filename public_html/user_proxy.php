<?php
ob_start();
include('header.php');
$userid = $_GET['id'];
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);

// $sql = "SELECT * FROM cb_order_new WHERE user_id =$userid";
  $sql = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.recommendation,cb_order_new.RESPONSIBLE_GROUP,cb_order_new.mat as MAAT,cb_order_new.description as Discriptions,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id =$userid";
$result = $conn->query($sql);

$sqlreviewer2 = "SELECT * FROM `cb_user` where role_id=3 AND id!=$userid";
$resultreviewer2 = $conn->query($sqlreviewer2);

/*******************Queries added for pie chart************************/ 


$sql_TotalJobs = "SELECT count(cb_order.id) FROM cb_order LEFT JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.user_id =$userid";
$result_TotalJobs = $conn->query($sql_TotalJobs);
$row_TotalJob = $result_TotalJobs->fetch_array();
$row_TotalJobs = $row_TotalJob['0'];


$sql_JobsCoverSheet = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.user_id = $userid AND cb_order.form_stage = 1";
$result_JobsCoverSheet = $conn->query($sql_JobsCoverSheet);
$row_JobsCoverSheet = $result_JobsCoverSheet->fetch_array();
//echo "coversheet";
$row_JobsCoverSheet = $row_JobsCoverSheet['0'];
//echo '<br/>';

$sql_JobsProjctDetails = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.user_id = $userid AND cb_order.form_stage = 2";
$result_JobsPrjDetails = $conn->query($sql_JobsProjctDetails);
$row_JobsPrjDetails = $result_JobsPrjDetails->fetch_array();
//echo "PrjDetails";
$row_JobsPrjDetails = $row_JobsPrjDetails['0'];


$sql_JobsQualifyFive = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.user_id =$userid AND cb_order.form_stage = 3";
$result_JobsQualifyFive = $conn->query($sql_JobsQualifyFive);
$row_JobsQualifyFive = $result_JobsQualifyFive->fetch_array();
//echo "QualifyFive";
$row_JobsQualifyFive = $row_JobsQualifyFive['0'];

$sql_JobsDistributnChkklist = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.user_id = 5 AND cb_order.form_stage = 4";
$result_JobsDistributnChkklist = $conn->query($sql_JobsDistributnChkklist);
$row_JobsDistributnChkklist = $result_JobsDistributnChkklist->fetch_array();
//echo "DistributnChkklist";
$row_JobsDistributnChkklist = $row_JobsDistributnChkklist['0'];

$sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 1 AND cb_order_new.user_id =$userid";
$result_Jobsfield_remediation = $conn->query($sql_Jobsfield_remediation);
$row_Jobsfield_remediation = $result_Jobsfield_remediation->fetch_array();
$row_Jobsfield_remediation = $row_Jobsfield_remediation['0'];

$sql_JobsCN29 = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 2 AND cb_order_new.user_id =$userid";
$result_JobsCN29 = $conn->query($sql_JobsCN29);
$row_JobsCN29 = $result_JobsCN29->fetch_array();
$row_JobsCN29 = $row_JobsCN29['0'];

$sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 3 AND cb_order_new.user_id =$userid";
$result_Jobsunknown_status = $conn->query($sql_Jobsunknown_status);
$row_Jobsunknown_status = $result_Jobsunknown_status->fetch_array();
$row_Jobsunknown_status = $row_Jobsunknown_status['0'];

/*******************Queries End************************/ 

?>
<style>
    .help-block {
    display: block;
    font-size: 13px;
    margin-bottom: 0;
    margin-top: 2px;
    color: #e40930 !important;
}
.green{
background: #1e7e34 !important;}

</style>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<div class="container mk">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                                                <div class="alert alert-success green" id="success-alert" style="display:none">
    <button type="button" class="close" data-dismiss="alert">x</button>
   Job has been assigned Successfully.
</div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                    </div>
                                </div>
								<div class="row">
								<div class="col-md-3 py-4 userprofile">
							
                    <?php
                    $queryreviewer = "SELECT id,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_user.profile_image,CONCAT(cb_user.city, ',' , cb_user.state) as address,cb_user.email FROM   cb_user WHERE role_id=3 AND id='$userid'";
                   // $queryreviewer = "SELECT CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_user.profile_image,cb_user.address,cb_user.email,cb_order_new.user_id, count(*) as total_count,COUNT(if(order_stage='5',1,NULL)) as pending_count,COUNT(if(order_stage='6',1,NULL)) as completed_count FROM cb_order_new INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id) GROUP BY user_id";
                    $resultreviewer = $conn->query($queryreviewer);
                   while($rowreviewer = $resultreviewer->fetch_assoc()) {
                    ?>
                    
                              
									
								
				<div class="card text-center mt-4 border">
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
					<div class="card-body p-0">
						<div class=" pb-2">
							<a href="http://maps.google.com/?q=<?= $rowreviewer['address'] ?>"  target="_blank" class="d-block  w-100"><i class="fa fa-map-marker px-3 social-link" aria-hidden="true"></i> <?= $rowreviewer['address'] ?> </a> 
							<a href="mailto:<?= $rowreviewer['email'] ?>" class="d-block w-100"><i class="fa fa-envelope-o px-3 social-link" aria-hidden="true"></i><?= $rowreviewer['email'] ?></a>
						</div>
						<ul class="nav nav-pills nav-fill py-4">
						  <li class="nav-item position-relative">Total <data style="border-radius: 4px !important;" class="rounded-circle">
						   <?php
                                                        $querytcount="SELECT COUNT(id) as total_count FROM cb_order_new WHERE user_id='".$rowreviewer['id']."'";
                                                        $resulttcount = $conn->query($querytcount);
                                                        $totalcount = $resulttcount->fetch_assoc()
                                                        ?>
                                                            
                                                            <?= $totalcount['total_count'] ?>
						  </data></li>
						  <li class="nav-item position-relative">Completed <data style="border-radius: 4px !important;" class="rounded-circle">
							<?php
                                                        $queryccount="SELECT COUNT(id) as completed_count FROM cb_order_new WHERE order_stage='6' && user_id='".$rowreviewer['id']."'";
                                                        $resulctcount = $conn->query($queryccount);
                                                        $completed_count = $resulctcount->fetch_assoc()
                                                        ?>
                                                            <?= $completed_count['completed_count'] ?>
						  </data></li>
						  <li class="nav-item position-relative">Pending <data style="border-radius: 4px !important;" class="rounded-circle">
							<?php
                                                        $querypcount="SELECT COUNT(id) as pending_count FROM cb_order_new WHERE order_stage='5' && user_id='".$rowreviewer['id']."'";
                                                        $resultpcount = $conn->query($querypcount);
                                                        $pending_count = $resultpcount->fetch_assoc()
                                                        ?>
                                                            <?= $pending_count['pending_count'] ?>
						  </data></li>						  
						</ul>						
					</div>	
					
								
			</div>
                   <?php } ?>
                
                </div>
									<div class="col-md-9">
									<h5 class="font-strong mb-4">Jobs to be Reviewed</h5>
									<div class="flexbox control-div mb-4 flex-column flex-md-row">
                                    <div class="flexbox">
                                        <label class="mb-0 mr-2">Status:</label>
                                        <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="208px">
                                            <option value="">All</option>
                                            <option value="2">CN-29 Eligible</option>
                                            <option value="1">Field Remediation Required</option>
                                            <option value="3">Unknown Status</option>
                                            <option value="0">Not-Started</option>
                                            <option value="5">Approval Pending</option>
                                            <option value="6">Approved</option>
                                            <option value="7">Rejected</option>
                                        </select>
                                    </div>
                                    <br class="clearfix d-block d-md-none">
                                    <div class="input-group-icon input-group-icon-left">
                                        <span>Search</span>
										
                                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
									<input type="hidden" id="limitid" value="<?php echo '5';  ?>">
								    <input type="hidden" id="pageid" value="1">	
								    <input type="hidden" id="sortOrder" value="DESC">	
								    <input type="hidden" id="sortField" value="ORDER_NO">	
                                    </div>
                                </div>
										
                               <div id="results"></div>
                    <div class="loader"></div>
                                <label id="error" class="help-block" for="email"></label>
                               
                                <div class="last-form-var">
											<div class="d-flex align-items-center justify-content-center justify-content-sm-start my-4">
                                                <label class="mb-0 mr-2">Please Select User:</label>
                                                <div>
                                                    <select title="James" data-style="btn-solid" data-width="150px" id="user_id" class="form-control">
                                                        <option value="">Please select</option>
                                                        <?php
    											while($rowreviewer2 = $resultreviewer2->fetch_assoc()) { ?>
                                                        <option value="<?= $rowreviewer2['id'] ?>"><?= $rowreviewer2['first_name'] ?>   <?= $rowreviewer2['last_name'] ?></option>
                                                       <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                             <?php
                                if (in_array("1", $roleID))
                                {
                                ?>
											<button type="button" class="btn btn-primary" id="submit" style="padding: .375rem 2.75rem;">Re Assign User</button>
							   <?php }else{
							   ?>
							   <button type="button" disabled class="btn btn-primary" id="" style="padding: .375rem 2.75rem;">Re Assign User</button>
							   <?php
							   } ?>
											</div>
									
									</div>
										
									</div>
								</div>

                            
							
							</div>
                        </div>
                    </div>
                </div>
                
            </div>
                            <div id="wait" style="display:none;position:absolute;top:50%;left:50%;padding:2px;"><img src='assets/img/Spinner-1s-200px.gif' width="64" height="64" /></div>

  <!-- END PAGE CONTENT-->
          <?php
include('footer.php');

?>
 <script>
$( document ).ready(function() {
  //$(document).on('change','.datepicker2',function() {
         $("#submit").on("click", function() {
         var order_no = new Array();
$.each($("input[name='reviewer[]']:checked"), function() {
     $('#error').text('');
  order_no.push($(this).val());
  // or you can do something to the actual checked checkboxes by working directly with  'this'
  // something like $(this).hide() (only something useful, probably) :P
});
var user_id = $('#user_id').val();
 if(order_no==''){
  $('#error').text('Please select atleast one job');  
  return false;  
}
if(user_id==''){
  $('#error').text('Please select reviewer');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to assign this jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
                     $(document).ajaxStart(function(){
              $("#wait").css("display", "block");
               }); 
              $('#error').text('');
 var request = $.ajax({
                                      url: "job_assign_js.php",
                                      type: "POST",
                                      data: {id:user_id,order_no:order_no,form_type:'assign'}
                                    });
                                  
                                    request.done(function(msg) {
                                           $("#wait").css("display", "none");
                                   $("#success-alert").fadeTo(4000, 700).slideUp(700, function(){
                                  $("#success-alert").slideUp(700);
                                  location.reload();
});
                             //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                 // alert( "Request failed: " + textStatus );
                                     }); 
                                     
                }
            }
                });
             
});
});

function downloadpdf() {
  var approveby = $('#USERID').val();
var order_no = $('#OREDRNO').val();
 window.location.href='GenPdf.php?id='+approveby+'&ono='+order_no
}  
</script>
<script type="text/javascript">
 
        // fetching records
                            function displayRecords(numRecords, pageNum,Keysearch,jobstatus,total_pages) {
								
						  if(pageNum <= (total_pages - 5)){
					    $('.lastvaluepageupx').show();
 					    
					    console.log(pageNum <= (total_pages - 5));
					 }else{
					    $('.lastvaluepageupx').hide();
 					

					    console.log("hide it");
					 } 	
							//var Keysearchcheck = $('#key-search').val();
						    var id = <?= $_GET['id'] ?>;
							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
							var sortOrder = $('#sortOrder').val(); 
							var sortField = $('#sortField').val(); 
							/* if(sortOrder=='ASC'){
							 var sortOrder = 	'DESC';
							 $('#sortOrder').val('DESC');
							}else{
							var sortOrder = 	'ASC';
                            $('#sortOrder').val('ASC');							
							} */
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "user_proxy_api.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&id=" + id + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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
                                displayRecords(5, 1,'','');
								//console.log($("#key-search").val());
                            });
		 		
        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#key-search').keyup(function(e){
		 console.log("11111");
		 var id = <?= $_GET['id'] ?>;
		// alert(id);
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();	
    var Keysearch = $(this).val();
	 if($('#type-filter').val()=='undefined')	{
	 var jobstatus = '';	
	}else{
	var jobstatus = $('#type-filter').val();	
	}
	var sortOrder = $('#sortOrder').val(); 
							var sortField = $('#sortField').val(); 
							/* if(sortOrder=='ASC'){
							 var sortOrder = 	'DESC';
							 $('#sortOrder').val('DESC');
							}else{
							var sortOrder = 	'ASC';
                            $('#sortOrder').val('ASC');							
							} */
         // fetching records
             
 								 
 								//alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "user_proxy_api.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&id=" + id + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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
     $('#type-filter').on('change',function(e){
		 var id = <?= $_GET['id'] ?>;
	var numRecords = $('#limitid').val();	
    var pageNum = $('#pageid').val();
    if($('#key-search').val()=='undefined')	{
	 var Keysearch = '';	
	}else{
	 var Keysearch = $('#key-search').val();	
	}
   
   var sortOrder = $('#sortOrder').val(); 
							var sortField = $('#sortField').val(); 
							/* if(sortOrder=='ASC'){
							 var sortOrder = 	'DESC';
							 $('#sortOrder').val('DESC');
							}else{
							var sortOrder = 	'ASC';
                            $('#sortOrder').val('ASC');							
							} */
	var jobstatus = $(this).val();
         // fetching records
             
 								 
 							// alert(jobstatus);
                                $.ajax({
                                    type: "GET",
                                    url: "user_proxy_api.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&id=" + id + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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
							 
						    var id = <?= $_GET['id'] ?>;
							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
							 
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "user_proxy_api.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch + "&jobstatus=" + jobstatus + "&id=" + id + "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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

		 		
        </script>