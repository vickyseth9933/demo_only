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
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="ibox">
                           <div class="ibox-body">
                              <div class="row border-bottom">
                                 <div class="col-sm-6 text-center text-sm-left">
                                    <h5 class="font-strong mb-3">Reference Documents</h5>
                                 </div>
                                 <div class="col-sm-6 text-center text-sm-right">
                                    <div class="addmember-div mb-3 mb-sm-0">
                                       <a class="" data-toggle="modal" data-target="#modaldocuploadForm" href="#">
                                          <p class="mb-0">Add Documents<small><i class="fa fa-plus"></i></small></p>
                                       </a>
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
                                       <div class="table-responsive">
                                          <table class="table table-bordered table-hover" id="table">
                                             <thead class="thead-default thead-lg">
                                                <tr>
                                                   <th>Title</th>
                                                   <th>Upload Date</th>
                                                   <th>Description</th>
                                                   <th>View</th>
                                                   <th>Download</th>
												<?php if (in_array("1", $roleID)){ ?>   
                                                   <th>Delete</th>
												<?php } ?>   
                                                </tr>
                                             </thead>
                                             <tbody>
											 
											 <?php
												$sql = "SELECT * FROM cb_resources_document ORDER BY uploaded_date DESC";
												$result = $conn->query($sql);
												while($row = $result->fetch_assoc()) {
												$ext = substr($row['file_path'], strrpos($row['file_path'], '.') + 1);
											 
												?>
                                                <tr>
                                                   <td><?php if($ext=='pdf'){  ?><img _ngcontent-c1="" alt="" title="view" class="doctype" src="assets/img/docicon.png" width="30" height="30">&nbsp; <?php } else{
                                                   ?><img _ngcontent-c1="" alt="" class="doctype" src="assets/img/doc-file-37-531689.png" width="30" height="30">&nbsp; <?php } echo $row['title'];?></td>
                                                   <td><?php echo date('m/d/Y',strtotime($row['uploaded_date']));?></td>
                                                   <td><?php echo $row['description'];?></td>
                                                   
                                                   <td>
                                                       <a class="add-btn" target="blank" href="resources/<?php echo $row['file_path'];?>">
                                                           <i aria-hidden="true" class="fa fa-eye"></i>
                                                       </a>
                                                    </td>
                                                   <td>
                                                      <p class="Edit" title="Download">
													  <a class="add-btn" href="resources/<?php echo $row['file_path'];?>" download>
														  <i aria-hidden="true" class="fa fa-download"></i>
														</a>
                                                      </p>
                                                   </td>
												   <?php if (in_array("1", $roleID)){ ?> 
													   <td>
														  <p class="Edit" title="Delete">
														  <a class="btn btn-danger btn-xs deletebtn deletbtn-div" href="resources.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-trash" aria-hidden="true"></span></a>
														  </p>
													   </td>
												   <?php } ?>  
                                                </tr>
												<?php } ?>       
                                                
                                                
                                                
											
                                             </tbody>
                                          </table>
                                          </div>
                                          <div class="clearfix"></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
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
					<form class="addresource" name="add_member" action="#" method="post" enctype="multipart/form-data">
					    <input type="hidden" value="<?= $userid ?>" name="user_id" id="user_id">
                  <div class="form-group">
                     <input class="form-control" id="resource_title" type="text" name="res_title" placeholder="Title">
					 <span class="error" id="resource_title_error"></span>
                  </div>
                  <div class="form-group">
                     <input class="form-control" id="resource_desc" type="text" name="res_desc" placeholder="Description">
					 <span class="error" id="resource_desc_error"></span>
                  </div>
				  <div class="form-group">
                     <input class="form-control " id="resoource_doc" type="file" name="fileToUpload" placeholder="resource" style="padding:0;">
					 <span class="error" id="resource_doc_error"></span>
                  </div>
                  
					<div class="">
					  <button type="button" id="addresource" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
				   </div>
				   <div  id="ship_value"></div>
				   </form>
               </div>
               
            </div>
            <!-- /.modal-content --> 
         </div>
</div>


<!-------popup-form-end-form-here----------->  



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
				if($('#resource_title').val() === ''){
					$("#resource_title_error").html('Please enter resource title');
					$err = 'true';
				}else{
					$("#resource_title_error").html('');
				}				
				if($('#resource_desc').val() === ''){
					$("#resource_desc_error").html('Please enter resource description');
					$err = 'true';
				}else{
					$("#resource_desc_error").html('');
				}
				if($('#resoource_doc').val() === ''){
					$("#resource_doc_error").html('Please select resource file');
					$err = 'true';
				}else{
					$("#resource_doc_error").html('');
				}			
				
				if($err == 'true'){
					return false;
				}
				var fileExtension =  ['doc', 'docx', 'pdf'];
				if ($.inArray($('#resoource_doc').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
					$("#resource_doc_error").html('Only .pdf, .doc, .docx format is allowed.');
					this.value = ''; // Clean field
					return false;
				}
				
				var form = $('form.addresource')[0];
				var formData = new FormData(form);
				$.ajax({
				type: "POST",
				url: "insert_resource.php",
				data: formData,
				processData: false,
                contentType: false,
					success: function(message){	
					    
					$("#successmsg").html(message);
					setTimeout(function(){ location.reload(true); }, 5000);					
					$('#addresource').prop("disabled", true);
					},
					error: function(){
					}
				});
			});
//new code end
</script> 
<script type="text/javascript"> 
      $(document).ready( function() {
		  $('.cls_succ_msg').show();
        $('.cls_succ_msg').delay(1000).fadeOut();
      });
    </script>
  
  