<?php
include('header.php');
$userid = $_SESSION['userid'];
if($userid==''){
  header("Location: index.php");  
}
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
// if (in_array("1", $roleID))
// {
	
// }else{
// session_destroy();
// header("Location: index.php");	
// }


/*
if(!empty($_GET['id']) && $_GET['id'] !=''){
	$delete_resource_id = $_GET['id'];
	// sql to delete a record
	$sql = "DELETE FROM cb_resources_document WHERE id = $delete_resource_id"; 

	if (mysqli_query($conn, $sql)) {
		$del_success = "Record Deleted Successfully";
	} else {
		$del_success = "Error deleting record";
	}
}
*/
?>

<style>
select.custom-select.custom-select-sm.form-control.form-control-sm {
    width: 58px;
}
input.form-control.form-control-sm {
    background-color: #f4f5f9;
    border-color: #f4f5f9;
    border-radius: 24px;
}
.cls_succ_msg{
    color:green;
}
.table-responsive {
    overflow-x: inherit;
}
</style>


         <div class="container mk">
            <div class="content-wrapper">
               <!-- START PAGE CONTENT-->
               <div class="page-content fade-in-up">
                  <div class="row justify-content-md-center">
                     <div class="col-md-9">
                        <div class="ibox">
                           <div class="ibox-body">
                              <div class="row border-bottom">
                                 <div class="col-sm-6 text-center text-sm-left">
                                    <h5 class="font-strong mb-3">Reference Documents</h5>
                                 </div>
                                 <div class="col-sm-6 text-center text-sm-right">
                                    <div class="addmember-div mb-3 mb-sm-0">
                                       <!--<a class="" data-toggle="modal" data-target="#modaldocuploadForm" href="#">
                                          <p class="mb-0">Add Documents<small><i class="fa fa-plus"></i></small></p>
                                       </a>-->
                                    </div>
                                 </div>
                              </div>
                            
							  
                              <div class="mngement_list">
                                 <div class="row mt-2">
                                    <div class="col-md-12 cls_succ_msg">
										<?php if(!empty($del_success)){
											   echo $del_success;
										    } 
										?>
										</div>
									</div>
										<div class="row mt-2">
										    <div class="col-md-12">
										        	<h4><span id="successmsg" class="cls_succ_msg"></span><h4>
											<form class="addresource" name="add_member" action="#" method="post" enctype="multipart/form-data">
												
										  <div class="form-group">
											 <input class="form-control " id="resoource_doc" type="file" name="fileToUpload" placeholder="resource" style="padding:0;">
											 <span class="error" id="resource_doc_error"></span>
										  </div>
										  
											<div class="">
											  <button type="button" id="addresource" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
										   </div>
										   <div  id="ship_value"></div>
										   </form>
                                          <div class="clearfix"></div>
                                          <div class="clearfix"></div>
                                          <div class="clearfix"></div>
                                          <br><br><br>
                                           <h5 class="font-strong mb-3">Jobs by BR CB Team</h5>
                                          <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Order id</th>
                <th>Description</th>
                <th>Complete_status</th>
                <th>Complete_date</th>
                <th>Delete</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            $sqljobcompleted = "SELECT * FROM completed_jobs";
            $resultjobcompleted = $conn->query($sqljobcompleted);
			 while($rowjobcompleted = $resultjobcompleted->fetch_assoc()) { ?>
            <tr id="order_no_<?= $rowjobcompleted['order_id']; ?>">
                <td><?= $i+1 ?></td>
                <td><?= $rowjobcompleted['order_id']; ?></td>
                <td><?= $rowjobcompleted['description']; ?></td>
                <td><?= $rowjobcompleted['complete_status']; ?></td>
                <td><?php if($rowjobcompleted['complete_date']!='0000-00-00'){ echo date('m-d-Y',strtotime($rowjobcompleted['complete_date'])); } else{ echo 'N/A' ;} ?></td>
                <td><a onClick="return RemoveJobs(<?= $rowjobcompleted['order_id']; ?>)"><i class='fas fa-remove'></i></a></td>
                 
            </tr>
            <?php 
            $i++;
            } ?>
            </tbody>
            </table>
									 
										
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                     </div>
                     <div class="row justify-content-md-center">
                     <div class="col-md-9">
                     
             </div>
                        
                     </div>
               <div id="wait" style="display:none;position:absolute;top:50%;left:50%;padding:2px;"><img src='assets/img/Spinner-1s-200px.gif' width="64" height="64" /></div>

                     <?php include('footer.php');  ?>
                  </div>
                   
				   </div>
				   
				  </div>
				   <!-------popup-form-end-form-here----------->
	 
<div class="modal fade" id="modaldocuploadForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
            <div class="modal-content rounded">
               <div class="modal-header popup-div">
			   
			   
                  <button type="button" class="" data-dismiss="modal" aria-hidden="true"><span><i class="fa fa-times-circle"></i></span></button>
                  <h4 class="modal-title custom_align" id="Heading">Add Resources Detail</h4>
               </div>
               <div class="modal-body">
			    <span id="successmsg" class="cls_succ_msg"></span>
					
               </div>
               
            </div>
            <!-- /.modal-content --> 
         </div>
</div>
<div class="modal fade" id="modalRegisterForm6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog divregisterform">
                            <div class="modal-content rounded text-center">
                                <div class="modal-header border-0 p-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                                <div class="modal-body">
                                    <form class="editForm" action="#" method="post">
                                        <input type="hidden" id="removeorder" class="removeorder" value="">
                                        <p></p>
                                        <div class="form-group roles-div text-center">
                                            <p>This Job has been removed successfully !</p>
                                            <a href=""  data-dismiss="modal" id="cn29statusnoo"><span>Ok</span></a>
                                         </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>

<!-------popup-form-end-form-here----------->  

 <script src='https://kit.fontawesome.com/a076d05399.js'></script>
           <script>
    $(document).ready(function() {
    $('#table').DataTable();
} );

//new code start
$("button#addresource").click(function(){
                   $(document).ajaxStart(function(){
              $("#wait").css("display", "block");
               }); 
				var $err = 'false';
				
				if($('#resoource_doc').val() === ''){
					$("#resource_doc_error").html('Please select resource file');
					$err = 'true';
				}else{
					$("#resource_doc_error").html('');
				}			
				
				if($err == 'true'){
					return false;
				}
				var fileExtension =  ['xlsx', 'docx'];
				if ($.inArray($('#resoource_doc').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
					$("#resource_doc_error").html('Only .xlsx, .doc, .docx format is allowed.');
					this.value = ''; // Clean field
					return false;
				}
				
				var form = $('form.addresource')[0];
				var formData = new FormData(form);
				$.ajax({
				type: "POST",
				url: "submit-update-weekly-report.php",
				data: formData,
				processData: false,
                contentType: false,
				success: function(message){	
					    console.log(message);
						
					$("#wait").css("display", "none");
					$("#successmsg").html(message);
					location.reload();
				},
				error: function(){
					$("#wait").css("display", "none");
				}
				});
			});
//new code end
$(document).ready(function() {
    $('#example').DataTable();
} );
</script> 
<script>
    function RemoveJobs(order_no) {
 
 Lobibox.confirm({
            msg: 'Are you sure want to remove this job.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      dataType: "json",
                                      async: false,
                                      type: "POST",
                                      data: {order_no:order_no,form_type:'removecompljobs'}
                                    });
                                  
                                    request.done(function(msg) {
                             if(msg.status_message=='Fail'){
                                     // $('#modalRegisterForm4').modal('show');
                                     }else{
                                      //   $(this).parent().hide();
                                         $("#order_no_"+order_no).hide();
       
                                      $('#modalRegisterForm6').modal('show');
                                     // alert( "Requestc done: " + msg );
                                    //  window.location.href="review.php?id="+encodeid+"&ono="+encode_orderno;
                                     }
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                //    alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
    }
</script>

  
  