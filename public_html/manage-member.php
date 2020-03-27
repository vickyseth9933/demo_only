<?php
include('header.php');
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID))
{
	
}else{
session_destroy();
header("Location: index.php");	
}
$sql = "SELECT * FROM cb_user";
$result = $conn->query($sql);


?>

	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-sm-8 border-bottom">
                                        <h5 class="font-strong mb-4">Add Member List</h5>
                                    </div>
									<div class="col-sm-4 border-bottom text-right">
										<div class="addmember-div">
											<a class="" data-toggle="modal" data-target="#modalRegisterForm" href="#"><p>Add Member <small><i class="fa fa-plus"></i></small></p></a>
										</div>
									</div>
                                </div>

                                <div class="flexbox control-div mb-4 mt-4">
                                    <div class="flexbox">
                                        <label class="mb-0 mr-2">Show:</label>
                                        <div class="select-box-div status_select-div">
													<select class="form-control valid" aria-invalid="false">
														<option value="100">100</option>
														<option value="150">150</option>
														<option value="200">200</option>
													</select>				
										</div>
										<label class="mb-0 mr-2 ml-2">Entries</label>
                                    </div>
                                    <div class="input-group-icon input-group-icon-left">
                                        <span>Search</span>
										
                                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="mngement_list">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="table-responsive row">
                                             <table class="table table-bordered table-hover" id="datatable">
                                                <thead class="thead-default thead-lg">
                                                   <tr>
												   <th>Sr No</th>
                                                   <th>First Name</th>
                                                   <th>Last Name</th>
                                                   <th>Address</th>
                                                   <th>Email</th>
                                                   <th>Contact</th>
                                                   <th>Edit</th>
                                                   <th>Delete</th>
                                                </tr></thead>
                                                <tbody>
												<?php
												//if ($result->num_rows > 0) {
													// output data of each row
													while($row = $result->fetch_assoc()) {
															?>
															 <tr>
                                                      <td><?php echo $row['id'];?></td>													  <input type="hidden" name="memid" value="<?php echo $row['id'];?>" id="hiddenmemid">
                                                      <td><?php echo $row['first_name'];?></td>
                                                      <td><?php echo $row['last_name'];?></td>
                                                      <td><?php echo $row['city'];?></td>
                                                      <td><?php echo $row['email'];?></td>
                                                      <td><?php echo $row['phone'];?></td>
                                                      <td>
                                                        <p class="Edit" title="Edit">
                                                            <a class="editmembtn" data-toggle="modal" data-target="#modalRegisterFormedit" href="#"><button class="add-btn" data-title="Edit" data-toggle="modal" data-target="#edit">
                                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                                            </button></a>
                                                         </p>
                                                      </td>
                                                      <td>
                                                         <p class="Edit" title="Delete">
                                                            <button class="btn btn-danger btn-xs deletebtn deletbtn-div" data-title="Delete" data-toggle="modal" data-target="#delete">
                                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                                            </button>
                                                         </p>
                                                      </td>
                                                   </tr>
															<?php
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
<!--<script>
	$(document).ready(function(){
		$("button#submit").click(function(){
			$.ajax({
			type: "POST",
			url: "insert_member.php",
			data: $('form.add_member').serialize(),
				success: function(message){
				//$("#feedback").html(message)
				//$("#feedback-modal").modal('hide');
				},
				error: function(){
				alert("Error");
				}
			});
		});
	});
</script>-->
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
            <div class="modal-content rounded pb-3">
               <div class="modal-header popup-div">
			   
			   
                  <button type="button" class="" data-dismiss="modal" aria-hidden="true"><span><i class="fa fa-times-circle"></i></span></button>
                  <h4 class="modal-title custom_align" id="Heading">Add Member Detail</h4>
               </div>
               <div class="modal-body">
					<form class="editForm" name="add_member" action="#" method="post">
                  <div class="form-group">
                     <input class="form-control" id="first_name" type="text" placeholder="First Name">
                  </div>
                  <div class="form-group">
                     <input class="form-control" id="last_name" type="text" placeholder="Last Name">
                  </div>
				  <div class="form-group">
                     <input class="form-control " id="lan_id" type="text" placeholder="LAN ID">
                  </div>
                  <div class="form-group">
                     <textarea rows="2" class="form-control" id="address" placeholder="Address"></textarea>
                  </div>
				  <div class="form-group roles-div">
                     <h4 class="mb-3">Roles</h4>
					 <a href="#"><span>Admin</span></a>
					 <a class="mx-3" href="#"><span class="">Super Admin</span></a>
					 <a href="#"><span>Reviewer</span></a>
                  </div>
					<div class="">
					  <button type="button" id="addmem" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
				   </div>
				   <div  id="ship_value"></div>
				   </form>
               </div>
               
            </div>
            <!-- /.modal-content --> 
         </div>
</div>



<!-------popup-form-end-form-here----------->
<!-------popup-form-start-form-here-------->                  <div class="modal fade" id="modalRegisterFormedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"                     aria-hidden="true">                     <div class="modal-dialog">                        <div class="modal-content rounded p-3">                           <div class="modal-header popup-div">                              <button type="button" class="" data-dismiss="modal" aria-hidden="true"><span><i class="fa fa-times-circle"></i></span></button>                              <h4 class="modal-title custom_align" id="Heading">Add Member Details</h4>                           </div>                           <div class="modal-body">                              <form  name="form" class="manageform-div">							                                   <div  class="row">                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >First Name</label><input  class="form-control " name="firstName"  type="text" id="fname" value="">                                       </div>                                    </div>									<input type="hidden" value="4" id="edituserid" name="id">									                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >Last Name</label><input  class="form-control " name="lastName" id="lname" value="" >                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >Email</label><input  class="form-control "  name="email"  type="email" id="memmail" value="">                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >Contact Number</label><input  class="form-control " name="Number"  type="Number" id="memcno" value="">                                       </div>                                    </div>                                    <div  class="col-md-6">                                        <div  class="form-group">                                          <label >Password</label><input  class="form-control " name="Password" placeholder="Enter Password" type="Password" value="">                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >Confirm Password</label><input  class="form-control " name="confirmPassword"  type="password" value="">                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >Zip Code</label><input  class="form-control " name="zip" placeholder="Your Zip Code"  id="memzip" type="text" value="<?php echo $row['zip'];?>">                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >City</label><input  class="form-control " name="city" placeholder="Your City"  id="memcity" type="text" value="<?php echo $row['city'];?>">                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >State</label><input  class="form-control " name="state" placeholder="Your State" id="memstate" type="text" value="<?php echo $row['state'];?>">                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group">                                          <label >Role</label>                                          <select class="form-control multiselect " id="selrole" >                                             <option>Admin</option>                                             <option>Employee</option>                                             <option >NDE Vendor Technician</option>                                             <option >Supervisor- Level II</option>                                             <option>GO NDE Lead</option>                                             <option >NDE Field Technician</option>                                             <option >Supervisor- Level III</option>                                             <option >fghd</option>                                             <option >sfdsfsfsdfdsfsfsf</option>                                          </select>                                       </div>                                    </div>                                    <div  class="col-md-6">                                       <div  class="form-group"><label >Hire Date</label><input  class="form-control " id="" name="hire_date" id="hdate" type="date" value="<?php echo $row['state'];?>"></div>                                    </div>									<div class="col-sm-12">                                    <!--<div class="form-group roles-div">-->                                    <!--   <h4 class="mb-3">Roles</h4>-->                                    <!--   <a href="#"><span>Admin</span></a>-->                                    <!--   <a class="mx-3" href="#"><span class="">Super Admin</span></a>-->                                    <!--   <a href="#"><span>Reviewer</span></a>-->                                    <!--</div>-->                                    <div class="">									<input type="hidden" name="editmeminfo" value="editmeminfo" id="editmeminfo">									<input type="hidden" name="editmemidinfo" value="" id="editmemidinfo">                                       <button type="button" id="updatemem" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>                                    </div>									</div>                                 </div>								                              </form>							  <span id="succmsg" class="successmessage"></span>                           </div>                        </div>                        <!-- /.modal-content -->                      </div>                  </div>                  <!-------popup-form-end-form-here----------->               
         <?php
include('footer.php');

?><script> $(document).ready(function(){   $('.editmembtn').click(function(){	   var id = $(this).closest('tr').find('#hiddenmemid').val();	   $('#edituserid').val(id);			$.ajax({				type: "POST",				url: "fetch.php",				data: {"id":id},				dataType: 'json',				success: function(data) { 					$('#fname').val(data.first_name);                     $('#lname').val(data.last_name);					$('#memmail').val(data.email);                      $('#memcno').val(data.phone);					$('#memzip').val(data.zip);                      $('#memcity').val(data.city);					$('#memstate').val(data.state); 					$('#hdate').val(data.hire_date ); 				 },				error: function() {				}			});	});		$('#updatemem').click(function(){	   			$.ajax({				type: "POST",				url: "edit_member.php",				data: $('form.manageform-div').serialize(),				success: function(result) {					$('#succmsg').html('Record updated successfully. reloading the page...');					setTimeout(function() {						location.reload();					}, 5000);				 },				error: function() {				}			});	}); });</script>