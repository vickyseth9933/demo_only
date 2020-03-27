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
                     <div class="col-md-10">
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
                                         <div class="flexbox control-div mb-4 flex-column flex-md-row">
                                    <div class="flexbox">
                                    <div class="dataTables_length" id="example_length">
									<label>Show 
									<select name="example_length" id="select_length" aria-controls="example" class="">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
									</select> entries</label></div>
                                    </div>
                                    <br class="clearfix d-block d-md-none">
                                    <div class="input-group-icon input-group-icon-left">
                                        <span>Search</span>
										
                                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
									<input type="hidden" id="limitid" value="<?php echo '5';  ?>">
								    <input type="hidden" id="pageid" value="1">	
								    <input type="hidden" id="sortOrder" value="DESC">	
								    <input type="hidden" id="sortField" value="SLNO">	
                                    </div>
                                </div>
								<div id="results">
							    
										
                                       </div> 
									   
									                                  <div class="loader"></div>
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

  <script type="text/javascript">
 
        // fetching records
                            function displayRecords(numRecords, pageNum,Keysearch,total_pages) {
								
							//var Keysearchcheck = $('#key-search').val();
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
                                    url: "update-weekly-report-jobs.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch +   "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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
                                displayRecords(10, 1,'','');
								//console.log($("#key-search").val());
                            });
		 		
        </script>
		<script type="text/javascript">
		 $(document).ready(function(e) {
     $('#key-search').keyup(function(e){
		 console.log("11111");
 		// alert(id);
	var numRecords = $('#select_length').val();	
    var pageNum = $('#pageid').val();	
    var Keysearch = $(this).val();
	 
	 
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
                                    url: "update-weekly-report-jobs.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch +   "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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
     $('#select_length').on('change',function(e){
 	var numRecords = $(this).val();	
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
          // fetching records
             
 								 
 							// alert(jobstatus);
                                $.ajax({
                                    type: "GET",
                                    url: "update-weekly-report-jobs.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch +  "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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
                            function displayRecordsbysort(numRecords, pageNum,Keysearch,SORT_FIELD) {
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
							 
 							if(Keysearch=='undefined'){
							var Keysearch = '';	
							}else{
							var Keysearch = Keysearch;	
							}
							 
                               // var Keysearch = '';
 							// alert(Keysearch);
                                $.ajax({
                                    type: "GET",
                                    url: "update-weekly-report-jobs.php",
                                    data: "show=" + numRecords + "&JobsforApproval=" + pageNum +"&Keysearch=" + Keysearch +  "&sortField=" + sortField + "&sortOrder=" + sortOrder,
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
  