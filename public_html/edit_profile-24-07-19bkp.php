<?php
ob_start();
include('header.php');
$userid = $_SESSION['userid'];
if($userid==''){
  header("Location: index.php");
  exit();
}
$sql_UsrProfile = "SELECT cb_user.* FROM cb_user WHERE id = $userid";
$result_UsrProfile = $conn->query($sql_UsrProfile);
$UsrProfile_res = $result_UsrProfile->fetch_array();
 $user_rolid = $UsrProfile_res['role_id'];




$sql_UsrRole = "SELECT role_type FROM user_role WHERE id = $user_rolid";
$result_UsrRole = $conn->query($sql_UsrRole);
$UsrProfile_Role = $result_UsrRole->fetch_array();
//echo "test";
//echo "<pre>";print_r($UsrProfile_Role);
$user_role = $UsrProfile_Role['role_type'];
if ($result_UsrProfile->num_rows > 0) {
    
    if($UsrProfile_res['first_name'])
    {
        $user_name = $UsrProfile_res['first_name'].' '.$UsrProfile_res['last_name'];
        $user_fname = $UsrProfile_res['first_name'];
        if($UsrProfile_res['last_name']) {
             $user_lname = $UsrProfile_res['last_name'];
        } else {
             $user_lname = '';
        }
    } else {
        $user_name = 'N/A';
        $user_fname = '';
    }
    if($UsrProfile_res['email'])
    {
        $user_email = $UsrProfile_res['email'];
        $user_emailtop = $UsrProfile_res['email'];
    } else {
        $user_email = 'N/A';
        $user_emailtop = '';
    }
    if($UsrProfile_res['phone'])
    {
        $user_phone = $UsrProfile_res['phone'];
        $user_phonetop = $UsrProfile_res['phone'];
    } else {
        $user_phone = 'N/A';
        $user_phonetop = '';
    }
    if($UsrProfile_res['username'])
    {
        $user_profilename = $UsrProfile_res['username'];
    } else {
        $user_profilename = 'N/A';
    }
    if($UsrProfile_res['city'] || $UsrProfile_res['state'])
    {
        //echo "iff enter";
        
        if($UsrProfile_res['state'] && $UsrProfile_res['city'] )
        {
            $user_address = $UsrProfile_res['city'];
            $user_address .= ",".$UsrProfile_res['state'];
             
        } elseif($UsrProfile_res['city']){
            
            $user_address = $UsrProfile_res['city'];
        } else {
            $user_address = $UsrProfile_res['state'];
        }
       
        //$user_addresstop = $UsrProfile_res['address'];
    } else {
        echo "else enter";
        $user_address = '';
       // $user_addresstop = '';
    }
    
     if($UsrProfile_res['website'])
    {
        $user_website = $UsrProfile_res['website'];
    } else {
        $user_website = '';
    }
    if($UsrProfile_res['lanid'])
    {
        $user_lanid = $UsrProfile_res['lanid'];
    } else {
        $user_lanid = '';
    }
    if($UsrProfile_res['state'])
    {
        $user_state = $UsrProfile_res['state'];
    } else {
        $user_state = '';
    }
    if($UsrProfile_res['city'])
    {
        $user_city = $UsrProfile_res['city'];
    } else {
        $user_city = '';
    }
    if($UsrProfile_res['zip'])
    {
        $user_zip = $UsrProfile_res['zip'];
    } else {
        $user_zip = '';
    }
    if($UsrProfile_res['hire_date'])
    {
        $user_hire_date = $UsrProfile_res['hire_date'];
    } else {
        $user_hire_date = '';
    }
    if($UsrProfile_res['profile_image'])
    {
        $user_profile_image = $UsrProfile_res['profile_image'];
    } 
    //echo "date";
    //echo $user_hire_date;
    //echo $user_profile_image
    
    
        
        
} else {
        $user_fname = 'N/A';
        $user_lname = 'N/A';
        $user_name = 'N/A';
        $user_email = 'N/A';
        $user_phone = 'N/A';
        $user_profilename = 'N/A';
        $user_address = 'N/A';
        $user_website = 'N/A';
        $user_lanid = 'N/A';
}
?>

    <style>
    .error{
       margin:3px 0;
        color:red; 
    }
    .errorcls {
   margin:3px 0;
   color:red;
    }
.card-body .a-classdiv {
    background: #ddd;
    width: 40px;
    height: 40px;
    display: inline-block;
    padding: 7px 0px 0px 10px;
    border-radius: 50%;
    color: #3f93b1;
    font-size: 18px;
    position: absolute;
    top: 10px;
    right: 20px;
    z-index: 999;
}
.card-body.setting-imgdiv img {
    width: 150px;
    position: relative;
}
.timeline .timeline-item01 {
    padding: 4px 0px;
}
.list-heading-div {
    font-size: 18px;
    padding-left: 5px;
    font-weight: bold;
    color: #00a5df;
}
.timeline-item01 .fa {
    font-size: 20px;
    color: #6d7c85;
    text-align: center;
    min-width: 28px;
}
.setting-form-update button.btn {
    padding: 4px 47px;
    display: inline-block;
}
.ibox-body.setting-div-padd {
    background: #fff;
    vertical-align: middle;
    margin-bottom: 20px;
    padding: 10px;
}
.edit_imgdiv {
    margin-bottom: 14px;
}
#editprofilebtn {
    padding: 2px 29px;
    font-size: 16px;
}
.card-body.setting-imgdiv input#imgInp {
    position: absolute;
    left: 0px;
    opacity: 0;
    right: 0;
    top: 0px;
    overflow: hidden;
}
.card-body.setting-imgdiv img {
    
    margin-left: 22px;
}
.card-body.setting-imgdiv {
    height: 162px;
    width: 162px;
}

    </style>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        
        <!-- END HEADER-->

        <div class="container">
            <div class="content-wrapper">
                <!-- START PAGE CONTENT-->
                <div class="page-content fade-in-up">
                        <div class="ibox-body setting-div-padd mb-0 mx-1">
                                <div class="row">
                                        <div class="col-sm-8">
                                           <h5 class="font-strong mt-2">Edit Profile</h5>
                                        </div>
                                       <!----<div class="col-sm-4 text-right">
                                             <div class="addmember-div ">
                                                     <a class="newdiv d-inline-block" data-toggle="modal" data-target="#modalRegisterForm1" href="#">Edit Profile&nbsp; <span><i class="fa fa-pencil"></i></span></a>											 
                                                </div>
                                        </div>---->
                                     </div>
                    </div>
                     <form id="profile_form" name="form" class="manageform-div  p-4 mb-3" method="POST" action="my_profile.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 card mb-3">
                            <div class="card-body setting-imgdiv">
                                        <a class="a-classdiv" href="#"><i _ngcontent-c1="" class="fa fa-camera"></i><input type="file" name="fileToUpload" id="imgInp"></a>



 <?php if($user_profile_image==''){
                                            ?>
                                            <img class="img-circle" src="./profile_image/users01.png" alt="image"/>
                                            <!--<img class="img-circle" src="assets/img/users/u1.jpg" alt="image"/>-->
                                            <?php
                                            
                                            } else{   ?>
                                            <img class="img-circle" src="profile_image/<?= $user_profile_image ?>" alt="image"/>
                                            <?php } ?>
                                </div>
                        </div>
                            <div class="col-sm-9 col-md-9 mb-3 pr-0 user-card-profile-div">
                                <div class="card">
                                    <div class="card-body">
                                        <ul _ngcontent-c12="" class="timeline">
                                            <li class="list-heading-div"><?= $user_name ?></li>
                                            <li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-map-marker timeline-icon"></i><?= $user_address ?></li>
                                            <li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-envelope timeline-icon"></i> <a _ngcontent-c12="" title="#" href="#"><?= $user_email ?></a></li>
                                            <li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-phone timeline-icon"></i><a _ngcontent-c12="" title="#" href="#"><?= $user_phone ?></a></li>
                                            <!--<li class="timeline-item01"><i _ngcontent-c12="" class="fa fa-envelope timeline-icon"></i> <a _ngcontent-c12="" title="#" href="#"><?= $user_address ?></a></li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card ">
                                   
                                            <div class="row">
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>First Name</label><input class="form-control required" id="fname" name="firstName" type="text" value="<?= $user_fname ?>">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Last Name</label><input class="form-control required" id="lname" name="lastName" value="<?= $user_lname ?>">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Email</label><input class="form-control required" readonly name="email" id="email" type="email" value="<?= $user_email ?>">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>LAN ID</label><input class="form-control required" name="lanid" type="text" value="<?= $user_lanid ?>">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                    <div class="form-group">
                                                       <label>Phone</label><input class="form-control required" name="phone" id="phn" type="Number" value="<?= $user_phone ?>">
                                                    </div>
                                                 </div>
                                               <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label>Password</label><input class="form-control "  name="Password" placeholder="Enter Password" type="Password">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>City</label><input class="form-control" name="city" placeholder="Your City" type="text" value="<?= $user_city ?>">
                                                  </div>
                                               </div>
                                               
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Zip Code</label><input class="form-control" name="zip" placeholder="Your Zip Code" type="text" value="<?= $user_zip ?>">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>Confirm Password</label><input class="form-control" name="confirmPassword" type="password">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                     <label>State</label><input class="form-control" name="state" placeholder="Your State" type="text" value="<?= $user_state ?>">
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label>Role</label>
                                                    
                                                     <select readonly class="form-control multiselect ">
                                                        <option><?=$user_role?></option>
                                                        <!--<option>Employee</option>
                                                        <option>NDE Vendor Technician</option>
                                                        <option>Supervisor- Level II</option>
                                                        <option>GO NDE Lead</option>
                                                        <option>NDE Field Technician</option>
                                                        <option>Supervisor- Level III</option>
                                                        <option>fghd</option>
                                                        <option>sfdsfsfsdfdsfsfsf</option>-->
                                                     </select>
                                                  </div>
                                               </div>
                                               <div class="col-md-4">
                                                  <div class="form-group"><label>Hire Date</label><input class="form-control " readonly id="" name="hire_date" type="date" value="<?=$user_hire_date?>"></div>
                                               </div>
                                               <div class="col-sm-12 text-center">
                                               <div class="setting-form-update">
                                                   <input type ="Submit" class="btn btn-warning btn-lg" id="editprofilebtn" value="Save"><span class="glyphicon glyphicon-ok-sign"></span>
                                                  <!--<button type="button" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-ok-sign"></span>Save</button>-->
                                               </div>
                                               </div>
                                            </div>
                                         </form>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE CONTENT-->
					<div class="mx-1">
                   <footer class="page-footer" style="width:100%;">
                        <div class="font-13">2019 ©</div>
                        <div class="px-3">
                            Design by: <a href="http://epikso.com" target="_blank">Epik Solutions</a>
                        </div>
                        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
                    </footer>
					</div>
                </div>
            </div>
        </div>
        <!-- START SEARCH PANEL-->
        <!-- BEGIN PAGA BACKDROPS-->
        <div class="sidenav-backdrop backdrop"></div>

        <!-- END PAGA BACKDROPS-->
        <!-- CORE PLUGINS-->
        <script src="assets/vendors/js/jquery.min.js"></script>
        <script src="assets/vendors/js/popper.min.js"></script>
        <script src="assets/vendors/js/bootstrap.min.js"></script>
        <script src="assets/vendors/js/metisMenu.min.js"></script>
        <script src="assets/vendors/js/jquery.slimscroll.min.js"></script>
        <script src="assets/vendors/js/toastr.min.js"></script>
        <script src="assets/vendors/js/jquery.validate.min.js"></script>
        <script src="assets/vendors/js/bootstrap-select.min.js"></script>
        <script src="assets/vendors/js/jquery.steps.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script>
            /*$(function() {
                $('#form-wizard').steps({
                    headerTag: "h6",
                    bodyTag: "section",
                    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                    onStepChanging: function(event, currentIndex, newIndex) {
                        var form = $(this);
                        // Always allow going backward even if the current step contains invalid fields!
                        if (currentIndex > newIndex) {
                            return true;
                        }

                        // Clean up if user went backward before
                        if (currentIndex < newIndex) {
                            // To remove error styles
                            $(".body:eq(" + newIndex + ") label.error", form).remove();
                            $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                        }

                        // Disable validation on fields that are disabled or hidden.
                        form.validate().settings.ignore = ":disabled,:hidden";

                        // Start validation; Prevent going forward if false
                        return form.valid();
                    },
                    onFinished: function (event, currentIndex)
                       {
                           $("#modalRegisterForm").modal();
                       }
                })
            })*/			

        </script>
		
		<script>
		    function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }
		    $("#imgInp").change(function(){
                readURL(this);
            });

        		$(function() {
                        $('#editprofilebtn').click(function() {
                            //alert('dssffd');
                        $("#profile_form").valid(); //validate form 1
                        //alert('dfrdg');
                       // return false;
                });
            });
		</script>
</body>

</html>