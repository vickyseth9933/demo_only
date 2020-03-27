<?php
include('../header_prevention.php');
$userid = $_SESSION['userid'];

/*$que = "select d.user_id,a.id,a.order_id,a.SAP_Reviewed,a.MOI_for_Srv,a.MOI_for_Main,a.determine_the_MOI,a.SAP,PRE_Inspection,c.status,b.send_job_approval from (((distribution_checklist as a INNER JOIN cb_order_new  as b ON a.order_id = b.order_no)
INNER JOIN  cb_order as c ON a.order_id = c.order_id)
INNER JOIN cb_order_new as d ON d.order_no = a.order_id)
where b.send_job_approval = 1 AND order_stage= 6 AND (c.status = 1 OR c.status = 2 OR c.status = 3)";*/

$que = "select d.user_id,a.id,a.order_id,a.SAP_Reviewed,a.MOI_for_Srv,a.MOI_for_Main,a.determine_the_MOI,a.SAP,d.recommendation,PRE_Inspection,c.status,b.send_job_approval from (((distribution_checklist as a INNER JOIN cb_order_new  as b ON a.order_id = b.order_no)
INNER JOIN  cb_order as c ON a.order_id = c.order_id)
INNER JOIN cb_order_new as d ON d.order_no = a.order_id)
where b.send_job_approval = 1 AND d.order_stage= 6 AND (c.status = 1 OR c.status = 2 OR c.status = 3)";
$res=$conn->query($que);


/*******************Queries End************************/ 

$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("4", $roleID))
{
	
}else{
session_destroy();
header("Location: ../../../index.php");	
}
?>
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
button.btn.btn-primary.ViewJobsDetails {
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
										<h5 class="font-strong mb-4">Checklist Questionnaire List</h5>
									</div>
                                </div>
                                
                                <div class="d-flex justify-content-between flexible-status-search">
									<div class="flexbox control-div mb-2">
											<div class="flexbox">
												<label class="mb-0 pr-2 ml-0">Status:</label>
												<select class="selectpicker show-tick form-control selectpickerdiv2" id="type-filtersnr" title="Please select" data-style="btn-solid" data-width="150px">
													<option value="">All</option>
													<option value="CN-29 Eligible">CN-29 Eligible</option>
													<option value="Field Remediation Required">Field Remediation Required</option>
													<option value="Unknown">Unknown Status</option>													
												</select>
											</div>
										</div>	
									<div>                                        
										<div class="d-flex align-items-center justify-content-end searchinputdiv">
											<label class="Searchdivclass mr-2 ml-0">Search</label>
											<div class="input-group-icon input-group-icon-left">
												<input class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-searchsnr" type="text" placeholder="">
											</div>
										</div>
									</div>                                    
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="dash_datatablesnr">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Order Id</th>
                                                        <th>SAP Reviewed</th>
                                                        <th>MOI for SRV</th>
                                                        <th>MOI for Main</th>
                                                        <th width="20px;">Determine the MOI</th>
                                                        <th>Doc Number From SAP</th>
                                                        <th>Pre Inspection Status</th>
                                                        <th>Recommendation</th>
                                                        <th>Job Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php
                                             $i=1;       	
											while($row = $res->fetch_array()) {
											 
											?>
                                                    <tr>
                                                      <td><?php echo $i++; ?></td>  
                                                        <input type="hidden" name="memid" value="<?php echo $row['order_id'];?>" id="hiddenorderid">
                                                         <input type="hidden" name="memid" value="<?php echo $row['user_id'];?>" id="hiddenuserid">
                                                     <td><?php echo $row['order_id']; ?></td>  
                                                     <td><?php if($row['SAP_Reviewed'] == 1) { echo "Yes"; } else if($row['SAP_Reviewed'] == 0) {echo "No";} else { echo "N/A"; } ?></td>  
                                                     <td><?php if($row['MOI_for_Srv'] != '') { echo $row['MOI_for_Srv']; } else { echo "N/A"; } ?></td>  
                                                     <td><?php if($row['MOI_for_Main'] != '') { echo $row['MOI_for_Main']; } else { echo "N/A"; } ?></td>  
                                                     <td><?php if($row['determine_the_MOI'] != '') { echo $row['determine_the_MOI']; } else { echo "N/A"; } ?></td>  
                                                     <td><?php if($row['SAP'] != '') { echo $row['SAP']; } else { echo "N/A"; } ?></td> 
                                                     <td><?php if($row['PRE_Inspection'] != '') { echo $row['PRE_Inspection']; } else { echo "N/A"; } ?></td>
                                                     <td><?php if($row['recommendation']==null){ echo 'N/A'; } else { echo $row['recommendation']; }?></td>
                                                     <!--<td><?php if($row['status'] == 1){ echo "Field Remediation Required"; } else if($row['status'] == 2) { echo "CN-29 Eligible"; } else { echo "Unknown Status"; } ?></td>-->
                                                     <td><?php 
                                                 
                                                        if($row['status'] == 1)
                                                        {
                                                            echo '<span style="color:Orange !important;font-weight: bold;">Field Remediation Required</span>';
                                                        }
                                                        
                                                       else if($row['status'] == 2)
                                                        {
                                                            echo '<span  style="color:Green !important;font-weight: bold;">CN-29 Eligible</span>';
                                                        }
                                                        
                                                        else
                                                        {
                                                            echo '<span  style="color:lightblue !important;font-weight: bold;">Unknown</span>';
                                                        }
                                                        
                                                        
                                                        ?></td>
                                                        
                                                     
                                                     
                                                     <td align="center">
                                                     <button  type="button" class="btn btn-primary ViewJobsDetails" data-toggle="modal" data-target="#exampleModal" >View</button>
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
                                             <!--<a href="../ExcelGenerate.php?type=eligible-all"  class="btn btn-primary approvediv-colorr">Download Pdf</a>-->
                                              <a href="../ExcelGenerate.php?type=ChecklistQuestionnaire"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                            <!--<a href="jobstatusExcelGen.php"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                </div></div>
                               

                
            </div></div></div></div>
              <div class="modal fade customModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="exampleModal">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="container">					
                           <form id="form-wizard" action="javascript:;" method="post" novalidate="novalidate" class="mform stepForm wizard p-2 background-form-div clearfix" role="application">
						    <button type="button" class="close buttondivbold" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
                           </button>
							
							  <h5 class="font-strong mb-4 pt-4 formheadingdiv01">Checklist Questions</h5>
							  <div class="rowdiv1 mb-3">
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
                                        <input type="hidden" id="OREDRNO" value="">
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
                                       <input type="text" readonly class="form-control" id="determine_the_MOI">
                                          
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
                              <!-- <div class="row padd-div">-->
                              <!--   <div class="col-sm-8 col-md-4 align-self-center">-->
                              <!--      <div class="form-group fild-width">-->
                              <!--         <label>Reason for reject if any  ?</label>-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--   <div class="col-sm-12 col-md-8">-->
                              <!--      <div class="form-group class-color_div">-->
                              <!--        <textarea rows="2" id="reject_cmt" class="form-control bg-white" placeholder=""></textarea>-->
                              <!--        <span class="error errorcomment"></span>-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--</div>-->
                              <div class="download-icondiv">
                                    <!--<a><button type="button" onclick="return Reject()" class="btn btn-danger approvediv-color mr-2 mb-2">Reject</button></a>-->

                                    <!--<a><button onclick="return Approveview()" type="button" class="btn btn-primary approvediv-color mr-2 mb-2" id="submit">Approve</button></a>-->
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
          <script src="../crossviewJS.js"></script><!--Piechart js-->
          <!--<script src="/assets/js/dashboard.admn.min.js"></script>--><!--Piechart js-->
     <script src="/assets/vendors/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/js/dataTables.select.min.js"></script>
<script>
 

           
//$(document).ready(function() {
  //$(document).on('change','.datepicker2',function() {
    //     $("#submit").on("click", function() {


//});
//});

function downloadpdf() {
var order_no = $('#OREDRNO').val();
 window.location.href='GenPdfChecklist.php?ono='+order_no
}  

</script>

<script>
$(document).ready(function(){
    $( "#reject_cmt" ).focus(function() {
 $('.errorcomment').text('');
                            });
});
</script>
<script>
      $(function() {
    $('#dash_datatablesnr').DataTable({
        pageLength: 5,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatablesnr').DataTable();
    $('#key-searchsnr').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filtersnr').on('change', function() {
        table.column(9).search($(this).val()).draw();
        // table.search($(this).val()).draw();
    });

});
</script>

     