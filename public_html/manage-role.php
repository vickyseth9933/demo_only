<?php
include('header.php');
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID) || in_array("7", $roleID))
{
	
}else{
session_destroy();
header("Location: index.php");	
}


if(!empty($_GET['id']) || $_GET['id'] !=''){
	$id = $_GET['id'];
	// sql to delete a record
	$sql = "DELETE FROM cb_user WHERE id = $id"; 

	if (mysqli_query($conn, $sql)) {
		$del_success = "Record Deleted Successfully";
	} else {
		$del_success = "Error deleting record";
	}
}


$sql = "SELECT * FROM cb_user";
$result = $conn->query($sql);

$sql_role = "SELECT * FROM user_role WHERE role_type !='Admin'";
$resultdata = $conn->query($sql_role);






//$sql = "DELETE FROM cb_user WHERE id = $id";
//$conn->query($sql);

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
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                               

                                <div class="row">
                                    <div class="col-sm-8 border-bottom" id="listmembrrole">
                                        <h5 class="font-strong mb-4">Role List</h5>
                                         
                                    </div>
                                <?php
                                    if (in_array("1", $roleID))
                                        { 
                                ?>     
									<div class="col-sm-4 border-bottom text-right">
										<div class="addmember-div ">
											<a class="newdiv" data-toggle="modal" data-target="#modalRegisterForm" href="#">Add Role&nbsp; <span><i class="fa fa-plus"></i></span></a> 											 
										</div> 
									</div>
								<?php } else{
								?>
								<div class="col-sm-4 border-bottom text-right">
										<div class="addmember-div ">
											<a class="newdiv" data-toggle="modal" disable="disabled" data-target="#" href="#">Add Role&nbsp; <span><i class="fa fa-plus"></i></span></a> 											 
										</div> 
									</div>
								<?php
								}?>
                                </div>

         
                                <div class="mngement_list">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="" id="memberlist">
                                             <table class="table table-bordered table-hover" id="table">
                                                <thead class="thead-default thead-lg">
                                                   <tr>
												   <th>Sr No</th>
                                                   <th>Role Name</th>
                                                   <th>Action</th>
                                               
                                                </tr></thead>
                                                <tbody>
												<?php
												//if ($result->num_rows > 0) {
													// output data of each row
													$m = 1;
													while($row = $resultdata->fetch_assoc()) {
															?>
															 <tr>
                                                      <td><?php echo $m;?></td>
                                                      <input type="hidden" name="memid" value="<?php echo $row['id'];?>" id="hiddenroleid">
                                                      <td><?php echo $row['role_type'];?></td>
                                                      <?php
                                    if (in_array("1", $roleID))
                                        { 
                                ?> 
                                                      <td>
                                                        <p class="Edit" title="Edit">
                                                            <a class="editrolebtn" data-toggle="modal" data-target="#modalRegisterFormedit" href="#"><button class="add-btn" data-title="Edit" data-toggle="modal" data-target="#edit">
                                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                                            </button></a>
                                                         </p>
                                                      </td>
                                <?php    }else{
                                ?>
                                 <td>
                                                        <p class="Edit" title="Edit">
                                                            <a class="editrolebtn" data-toggle="modal" disabled data-target="#" href="#"><button class="add-btn" data-title="Edit" data-toggle="modal" data-target="#edit">
                                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                                            </button></a>
                                                         </p>
                                                      </td>
                                <?php
                                
                                } ?>  
                                                     </tr>
															<?php
																$m++;
													}
												//}
												
												?>
                                                  
                                                 
                                                </tbody>
                                             </table>
                                             <div class="clearfix"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
				
<!-------popup-form-start-form-here-------->

 <!-------popup-form-start-form-here-------->
                  <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content rounded p-3">
                           <div class="modal-header popup-div" id="memberdata">
                              <button type="button" class="" data-dismiss="modal" aria-hidden="true"><span><i class="fa fa-times-circle"></i></span></button>
                              <h4 class="modal-title custom_align" id="Heading">Add Role Details</h4>
                           </div>
                           <div class="modal-body">
                                <span id="successmsg" class="successmessage"></span> 
                              <form  name="form" id="addroleform" class="manageform-div" method="POST">
                                  <input type="hidden" id="form_type" name="form_type" value="addrole">
                                 <div  class="row">
                                    <div  class="col-md-12">
                                       <div  class="form-group">
                                          <label ><b>Role</b></label><input  class="form-control " name="rolename"  id="rolename" type="text" >
                                       </div>
                                    </div>
                                   <div class="col-sm-12">
                                        <input name="submit" type="submit" value="Add Role" class="btn btn-warning btn-lg" style="padding: 5px 0px;width: 200px;margin: 0 auto;">
                                      </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <!-- /.modal-content --> 
                     </div>
                  </div>
                  <!-------popup-form-end-form-here----------->
                  
                  
                  <!-------popup-form-start-form-here-------->                  
<div class="modal fade" id="modalRegisterFormedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content rounded p-3">
         <div class="modal-header popup-div">
            <button type="button" class="" data-dismiss="modal" aria-hidden="true"><span><i class="fa fa-times-circle"></i></span></button>                              
            <h4 class="modal-title custom_align" id="Heading">Edit Role Details</h4>
         </div>
         <div class="modal-body">
              <span id="succmsg" class="successmessage"></span>      
            <form  name="form" class="manageform-div" id="editrole" method="post">
              <input type="hidden" id="form_type" name="form_type" value="editrole">  
               <div  class="row">
                  <div  class="col-md-6">
                     <div  class="form-group"> 
                     <label >Role</label><input  class="form-control " name="role_name"  type="text" id="role_name" value=""> 
                     </div>
                  </div>
                  <input type="hidden" value="" id="editroleid" name="editroleid">									                                    
                  
                  
                  <div class="col-sm-12">
                                                         
                     <div class="">									
                     <input type="hidden" name="editmeminfo" value="editmeminfo" id="editmeminfo">									
                     <input type="hidden" name="editmemidinfo" value="" id="editmemidinfo">                                       
                     <button type="submit" id="updaterole" class="btn btn-warning btn-lg" style="width: 100%;">
                         <span class="glyphicon glyphicon-ok-sign"></span> Update</button>                                   
                    </div>
                  </div>
               </div>
            </form>
                                
         </div>
      </div>
      <!-- /.modal-content -->                      
   </div>
</div>
<!-------popup-form-end-form-here-----------> 



               
         <?php
include('footer.php');
?>
   <script>
 function formatDate (input) {
  var datePart = input.match(/\d+/g),
  year = datePart[0].substring(0), // get only two digits
  month = datePart[1], day = datePart[2];

  return month+'/'+day+'/'+year;
}
  
</script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "assets/img/calender.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  } );
  </script>
  <script>
    $(document).ready(function() {
    $('#table').DataTable();
} );
</script>