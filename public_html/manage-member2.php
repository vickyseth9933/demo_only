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


//$sql = "SELECT * FROM cb_user where role_id!='1'";
$sql = "SELECT cb_user.*,user_role.role_type FROM cb_user INNER JOIN user_role ON(cb_user.role_id=user_role.id)";

$result = $conn->query($sql);

$sql_role = "SELECT * FROM user_role";
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
img.ui-datepicker-trigger {
    position: absolute;
    top: 38px;
    right: 23px;
}
.ui-datepicker td span, .ui-datepicker td a {
    text-align: center !important;

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
                                    <div class="col-sm-8" id="listmembr">
                                        <h5 class="font-strong mb-4">Add Member List</h5>
                                         
                                    </div>
                                    <?php
                                   if (in_array("1", $roleID))
                                { 
                                    ?>
									<div class="col-sm-4 text-right">
                                    <div class="addmember-div">
                                       <a class="" data-toggle="modal" data-target="#modalRegisterForm" href="#">
                                          <p id="dvfdf">Add Member <small><i class="fa fa-plus"></i></small></p>
                                       </a>
                                    </div>
                                 </div>
                          <?php }else{
                          ?>
                          	<div class="col-sm-4 text-right">
                                    <div class="addmember-div">
                                       <a class="" disabled data-toggle="modal" data-target="#" href="#">
                                          <p id="dvfdf">Add Member <small><i class="fa fa-plus"></i></small></p>
                                       </a>
                                    </div>
                                 </div>
                          <?php
                          
                          
                          } ?>
                                </div>

          <!--                      <div class="flexbox control-div mb-4 mt-4">-->
          <!--                          <div class="flexbox">-->
          <!--                              <label class="mb-0 mr-2">Show:</label>-->
          <!--                              <div class="select-box-div status_select-div">-->
										<!--			<select class="form-control valid" aria-invalid="false">-->
										<!--				<option value="100">100</option>-->
										<!--				<option value="150">150</option>-->
										<!--				<option value="200">200</option>-->
										<!--			</select>				-->
										<!--</div>-->
										<!--<label class="mb-0 mr-2 ml-2">Entries</label>-->
          <!--                          </div>-->
          <!--                          <div class="input-group-icon input-group-icon-left">-->
          <!--                              <span>Search</span>-->
										
          <!--                              <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">-->
          <!--                          </div>-->
          <!--                      </div>-->
                                <div class="mngement_list">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div id="memberlist">
                                             <table class="table table-bordered table-hover" id="table">
                                                <thead class="thead-default thead-lg">
                                                   <tr>
												   <th>Sr No</th>
                                                   <th>First Name</th>
                                                   <th>Last Name</th>
                                                   <th>Role</th>
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
													$m = 1;
													while($row = $result->fetch_assoc()) {
															?>
															 <tr>
                                                      <td><?php echo $m;?></td>
                                                       <input type="hidden" name="memid" value="<?php echo $row['id'];?>" id="hiddenmemid">
                                                      <td><?php echo $row['first_name'];?></td>
                                                      <td><?php echo $row['last_name'];?></td>
                                                      <td><?php echo $row['role_type'];?></td>
                                                      <td><?php echo $row['city'];?></td>
                                                      <td><?php echo $row['email'];?></td>
                                                      <td><?php echo $row['phone'];?></td>
                                                       <?php
                                           if (in_array("1", $roleID))
                                                { 
                                        ?>
                                                      <td>
                                                        <p class="Edit" title="Edit">
                                                            <a class="editmembtn" data-toggle="modal" data-target="#modalRegisterFormedit" href="#"><button class="add-btn" data-title="Edit" data-toggle="modal" data-target="#edit">
                                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                                            </button></a>
                                                         </p>
                                                      </td>
                                                      <td>
                                                         <p class="Edit" title="Delete">
                                                             <a class="btn btn-danger btn-xs deletebtn deletbtn-div" href="manage-member2.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-trash" aria-hidden="true"></span></a>
                                                          
                                                            </button>
                                                         </p>
                                                      </td>
                                             <?php }else{
                                             ?>
                                              <td>
                                                        <p class="Edit" title="Edit">
                                                            <a class="editmembtn" data-toggle="modal" data-target="#" href="#"><button disable="disable" class="add-btn" data-title="Edit" data-toggle="modal" data-target="#edit">
                                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                                            </button></a>
                                                         </p>
                                                      </td>
                                                      <td>
                                                         <p class="Edit" title="Delete">
                                                             <a disable class="btn btn-danger btn-xs deletebtn deletbtn-div" href="#"><span class="fa fa-trash" aria-hidden="true"></span></a>
                                                          
                                                            </button>
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
<script>
	/*$(document).ready(function(){
	    alert("dssfrd");
		$("button#addmember").click(function(){
		    alert('dfrd');
			$.ajax({
			type: "POST",
			url: "insert_member.php",
			data: $('form.add_member').serialize(),
				success: function(message){
				    alert('succes');
				//$("#feedback").html(message)
				//$("#feedback-modal").modal('hide');
				},
				error: function(){
				alert("Error");
				}
			});
		});
	});*/
	/*$( document ).ready(function() {
	    alert("dsfd");
    console.log( "ready!" );
});*/


// Code that uses other library's $ can follow here.
</script>

<!--<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
         <!--</div>
</div>-->
 <!-------popup-form-start-form-here-------->
                  <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content rounded p-3">
                           <div class="modal-header popup-div" id="memberdata">
                              <button type="button" class="" data-dismiss="modal" aria-hidden="true"><span><i class="fa fa-times-circle"></i></span></button>
                              <h4 class="modal-title custom_align" id="Heading">Add Member Details</h4>
                           </div>
                           <div class="modal-body">
                                <span id="successmsg" class="successmessage"></span> 
                              <form  name="form" id="addmemberform" class="manageform-div" method="POST">
                                 <div  class="row">
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >First Name</label><i class="text-danger">*</i><input  class="form-control " autocomplete="off" name="firstName"  id="fname" type="text" >
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >Last Name</label><i class="text-danger">*</i><input  class="form-control " autocomplete="off" name="lastName">
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >Email</label><i class="text-danger">*</i><input  class="form-control"  name="email"  autocomplete="off" type="email" >
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >Contact Number</label><i class="text-danger">*</i><input  class="form-control " name="phnno" autocomplete="off" type="Number" >
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                        <div  class="form-group">
                                          <label >Password</label><i class="text-danger">*</i><input  class="form-control" name="Password" placeholder="Enter Password" type="Password" id="password">
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >Confirm Password</label><i class="text-danger">*</i><input  class="form-control" name="confirmPassword" autocomplete="off" type="password">
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >Zip Code</label><input  class="form-control" name="zip" placeholder="Your Zip Code" autocomplete="off"  type="text">
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >Lan Id</label><i class="text-danger">*</i><input  id="lanidmembr" class="form-control"  name="lanid" placeholder="Lan Id"  autocomplete="off" type="text">
                                       </div>
                                       <span id="errorlanid" class="error" style="display:none;">Please enter valid four letters Lanid</span>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >City</label><input  class="form-control" name="city" placeholder="Your City"  type="text">
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >State</label><input  class="form-control" name="state" placeholder="Your State"  type="text">
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group">
                                          <label >Role</label>
                                          <select class="form-control multiselect" name="roleid">
                                          <?php
                                            while($roles = $resultdata->fetch_assoc()) { ?>
                                                <option value="<?=$roles['id']?>"><?=$roles['role_type']?></option>
                                            <?php }
                                          
                                          ?>
                                          <!--<select class="form-control multiselect ">
                                             <option>Admin</option>
                                             <option>Employee</option>
                                             <option >NDE Vendor Technician</option>
                                             <option >Supervisor- Level II</option>
                                             <option>GO NDE Lead</option>
                                             <option >NDE Field Technician</option>
                                             <option >Supervisor- Level III</option>
                                             <option >fghd</option>
                                             <option >sfdsfsfsdfdsfsfsf</option>-->
                                          </select>
                                       </div>
                                    </div>
                                    <div  class="col-md-6">
                                       <div  class="form-group"><label >Hire Date</label><i class="text-danger">*</i><input placeholder="MM/DD/YYYY"  id="" class="datepicker form-control" name="hire_date"  type="text" value=""></div>
                                    </div>
									<div class="col-sm-12">
                                    <!--<div class="form-group roles-div">-->
                                    <!--   <h4 class="mb-3">Roles</h4>-->
                                    <!--   <a href="#"><span>Admin</span></a>-->
                                    <!--   <a class="mx-3" href="#"><span class="">Super Admin</span></a>-->
                                    <!--   <a href="#"><span>Reviewer</span></a>-->
                                    <!--</div>-->
                                    <div class="">
                                        
                                       <!--<button type="button" id="addmember" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>-->
                                    <input name="submit" type="submit" value="Submit" class="btn btn-warning btn-lg mt-1" style="width: 50%; margin: 0 auto; padding: 6px 0px;">
                                    <!--<button type="button"  class="btn btn-warning btn-lg" style="width: 100%;">-->

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
                  
                  
                  <!-------popup-form-start-form-here-------->                  
<div class="modal fade" id="modalRegisterFormedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content rounded p-3">
         <div class="modal-header popup-div">
            <button type="button" class="" data-dismiss="modal" aria-hidden="true"><span><i class="fa fa-times-circle"></i></span></button>                              
            <h4 class="modal-title custom_align" id="Heading">Update Member Details</h4>
         </div>
         <div class="modal-body">
              <span id="succmsg" class="successmessage"></span>      
            <form  name="form" class="manageform-div" id="updatememform">
               <div  class="row">
                  <div  class="col-md-6">
                     <div  class="form-group"> 
                     <label >First Name</label><input  class="form-control " name="firstNameedit" autocomplete="off" type="text" id="fstname" value=""> 
                     </div>
                  </div>
                  <input type="hidden" value="4" id="edituserid" name="id">									                                    
                  <div  class="col-md-6">
                     <div  class="form-group"> 
                     <label >Last Name</label><input  class="form-control " name="lastNameedit" autocomplete="off" id="lname" value="" >                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">                                         
                     <label >Email</label><input  class="form-control "  name="emailedit" autocomplete="off" type="email" id="memmail" value="">                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">                                          
                     <label >Contact Number</label><input  class="form-control " name="phnnoedit" autocomplete="off" type="text" id="memcno" value="">                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">                                          
                     <label >Password</label><input  class="form-control " name="Passwordedit" id="Passwordedit" autocomplete="nope" placeholder="Enter Password" type="Password" value="">                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">                                          
                     <label >Confirm Password</label><input  class="form-control " name="confirmPasswordedit" id="confirmPasswordedit" autocomplete="off" type="password" value="">                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">                                          
                     <label >Zip Code</label><input  class="form-control " name="zipedit" placeholder="Your Zip Code"  id="memzip" type="text" value="<?php echo $row['zip'];?>">                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                    <div  class="form-group">
                        <label >Lan Id</label><input  class="form-control " name="lanidedit" id="lanid" placeholder="Lan Id"  autocomplete="off" type="text">
                    </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">                                          
                     <label >City</label><input  class="form-control " name="cityedit" placeholder="Your City"  id="memcity" autocomplete="off" type="text" value="<?php echo $row['city'];?>">                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">                                          
                     <label >State</label><input  class="form-control " name="stateedit" placeholder="Your State" id="memstate" autocomplete="off" type="text" value="<?php echo $row['state'];?>">                                       
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group">
                        <label >Role</label>                                          
                        <select class="form-control multiselect " id="selrole" name="roleidedit">
                           <?php
                                            $sql_roleres = "SELECT * FROM user_role";
                                            $resultdatan = $conn->query($sql_roleres);
                                            while($rolesresult = $resultdatan->fetch_assoc()) { ?>
                                                <option data="<?= $row['role_id'] ?>" value="<?=$rolesresult['id']?>" ><?=$rolesresult['role_type']?></option>
                                            <?php }
                                          
                             ?>
                        </select>
                     </div>
                  </div>
                  <div  class="col-md-6">
                     <div  class="form-group"><label >Hire Date</label>
                     <input    class="form-control datepicker"  name="hire_dateedit" id="hdate" type="text">
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <!--<div class="form-group roles-div">-->                                    <!--   <h4 class="mb-3">Roles</h4>-->                                    <!--   <a href="#"><span>Admin</span></a>-->                                    <!--   <a class="mx-3" href="#"><span class="">Super Admin</span></a>-->                                    <!--   <a href="#"><span>Reviewer</span></a>-->                                    <!--</div>-->                                    
                     <div class="">									
                     <input type="hidden" name="editmeminfo" value="editmeminfo" id="editmeminfo">									
                     <input type="hidden" name="editmemidinfo" value="" id="editmemidinfo">     
                    <input name="submit" type="submit" value="update" class="btn btn-warning btn-lg mt-1" style="width: 50%; margin: 0 auto; padding: 6px 0px;">

                     <!--<button type="button" id="updatemem" class="btn btn-warning btn-lg" style="width: 100%;">-->
                     <!--    <span class="glyphicon glyphicon-ok-sign"></span> Update</button>                                   -->
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

<!--<script>
    $(function () {
        $('form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'insert_member.php',
            data: $('form').serialize(),
            error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
            },
            success: function () {
                //alert('form was submitted');
                $('#modalRegisterForm').modal('toggle');
                 $("#successmsg").html('Submitted successfully');
                return false;
            }
            
          });

       });
    });
    </script>-->
    
   <script>
 

function formatDate (input) {
  var datePart = input.match(/\d+/g),
  year = datePart[0].substring(0), // get only two digits
  month = datePart[1], day = datePart[2];

  return month+'/'+day+'/'+year;
}
  
</script>
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