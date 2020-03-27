<?php
session_start();
$serverLink = 'https://'.$_SERVER['HTTP_HOST'].'/';
include('config.php');
$conn = OpenCon();

 date_default_timezone_set('America/Los_Angeles');
 $updated_time = date("Y-m-d H:i:s");
if($_GET['key'])
{
   $email=$_GET['key'];
 $email = base64_decode($email);
    $select_qry= "select email,password,updated_date from cb_user where email='$email'";
  $select = $conn->query($select_qry);
  $row = $select->fetch_assoc();
 // $hourdiff = round((strtotime($updated_time) - strtotime($row['updated_date']))/3600, 1);
  //echo $hourdiff;exit;
  //if(trim($_GET['key'])==trim($row['password_reset_key']) AND $hourdiff>=24){
  //if($hourdiff<=24){
	  $row_cnt = $select->num_rows;
  if($row_cnt==1)
  {
    ?>
    <!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
<link href="assets/vendors/css/bootstrap.min.css" rel="stylesheet" />


<!-- Optional theme -->

 


<!-- Latest compiled and minified JavaScript -->
<script src="<?= $serverLink ?>js/jquery18.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 <link href="assets/vendors/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?= $serverLink ?>css/custom.css" type="text/css" rel="stylesheet" />
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body, html {
    height: 100%;
    background-repeat: no-repeat;
}

.card-container.card {
    max-width: 400px;    text-align: left;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
/* Style all input fields */
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
    color: white;
}


/* The message box is shown when the user clicks on the password field */
#validation {
    display:none;
    color: #000;
    position: relative;
    padding: 0px;
    margin-top: 10px;
}
.reset-pass .form-control {
    padding: 12px 12px !important;
    height: auto;
    box-shadow: none;
}
button.btn.btn-lg.btn-primary.btn-block.btn-signin {
    background: #0062cc;
    border-color: #0062cc;
    box-shadow: none;
    padding: 12px 20px !important;
    font-size: 16px;
    color: #fff;
    height: auto;
    width: 100%;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 35px;
}
/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -10px;
    content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
    color: red;
}

.invalid:before {
    position: relative;
    left: -10px;
    content: "✖";
}
 .file-drop-zone {
    border: 2px dashed #ccc;
    border-radius: 5px;
    color: #595959;
    padding: 15px;
    position: relative;
    text-align: center;
    width: 100%;
}
.btn-sucesss{
    
background:#11b6ec;    
 color: #fff;

}
.btn-primaryy{
 border: dotted;
    padding: 3px 33px 8px;
    margin-top: 20px;
    background: #0156a6;
    color: #fff;
   
}

#panel
{
     display: none;
}
.reset-pass h3 {
       font-size: 13px;
    margin: 0 0 15px 0;
    color: #7b5f5f;
}

@media(min-width:260px) and (max-width:767px){
	
	.reset-pass p {
    float: none;
    width: 100%;
}
}
	html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
  background: #3f93b1;
}
*{ margin: 0;
    padding: 0;}
	.wrapper {
    position: relative;
    z-index: 2;
    height: 100%;
    width: 100%;
    display: table;
    vertical-align: middle; text-align:center;
}
.middle {
    display: table-cell;
    vertical-align: middle;
    padding: 10px 10px;
}
.holderb {
    background: #ded3d3;
    text-align: left;
    padding: 10px;
    border-radius: 5px;
}
.top-m{margin-top: -22px;
    position: relative;}
.auth-head-icon {
position: relative;
    height: 72px;
    width: 72px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    background-color: #fff;
    color: #3f93b1;
    box-shadow: 0 5px 20px #d6dee4;
    border-radius: 50%;
    transform: translateY(-50%);
    z-index: 2;
}
h5#msgbox {
    color: #FF0000;
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;    font-size: 13px;
}
.font-strong {
    font-weight: 500!important;
}
</style>
    <div class="container">
	<div class="wrapper">
		<div class="middle">
	
        <div class="card card-container reset-pass ">
		
            <div class="text-center top-m">
            <span class="auth-head-icon"><i class="fa fa-unlock" aria-hidden="true"></i></span>
        </div>
            <form class="form-signin" method="post" id="resetpass" name="resetpass" autocomplete="off" onSubmit="return form_validate(this)">
                <h4 class="font-strong text-center mb-4">Reset Password</h4>
                <!--<p class="mb-4">Please enter your email adddress to request a Password reset.</p>-->
                <p class="mb-4">Please enter your new password and confirm Password.</p>
                <h5 id="msgbox"></h5>
                <span id="reauth-email" class="reauth-email"></span>
                <input style="display:none;" type="text" id="email" name="email" value="<?php echo  $email;?>" class="form-control" placeholder="New Password *">
				
                <input autocomplete="off" type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password *" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&`^~/]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
				<div id="validation">

  <div class="holderb">
    <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
  <p id="special_char" class="invalid">Minimum <b>1 Special characters</b></p>
  <div style="clear:both"></div>
</div></div>
                <input type="password" autocomplete="off" id="ConfirmPassword" name="ConfirmPassword" class="form-control" placeholder="Confirm Password" >
                <div id="remember" class="checkbox">
               
                </div>
                <button  type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="submit_password" type="submit">Save Password</button>
            </form><!-- /form -->
			
        </div><!-- /card-container -->
		
			</div>
	</div>
		
		

				

		
		
    </div><!-- /container -->
	<!--Modal For sucess msg -->
<div id="myModalSucess" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Check Your Email and Click on the link sent to your email.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--Modal For sucess msg -->
<!--Modal For Failed msg -->
<div id="myModalfailed" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Invalid Email Id.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--Modal For Failed msg -->
    <?php
  }

}
?>
<?php
if(isset($_POST['submit_password']) && $_GET['key'])
{
   //$email=$_POST['email'];
   /*$pass=md5($_POST['new_password']);
   $qry="update cb_user set password='$pass' where password_reset_key='".$_GET['key']."'";
  $select=mysqli_query($conn,$qry);
  echo $updateqry="update cb_user set updated_date='',password_reset_key=''  where FROM_BASE64(email)='".$email."'";exit;
  $select=mysqli_query($conn,$updateqry);*/
  
  $email=$_POST['email'];
   $pass=$_POST['new_password'];
  $qry="update cb_user set password='$pass',password_reset_key='' where password_reset_key='".$_GET['key']."'";
  $select=$conn->query($qry);
  $updateqry="update cb_user set updated_date='',password_reset_key=''  where FROM_BASE64(email)='".$email."'";
  $select1=$conn->query($updateqry);
  
  
  if($select1){
	 ?>
	 <script>
	window.location.href = '<?= $serverLink ?>/Thankyou.php?action=true';
	</script>
	<?php 
  }
  else{
 ?>
 
 <script>
window.location.href = '<?= $serverLink ?>Thankyou.php?action=false';
 </script><?php   
 
  }
}
?>
<script type="text/javascript">
$(document).ready(function() {
    $("#resetpass").submit(function()
    {
        var flag=1;
    var form=$("#new_password").val();
    if(form=='')
    {
    $("#new_password").addClass('validat_false');
    $("#msgbox").html('* Please Fill The Blank Fields.');
flag=0;}
 
 var stud=$("#ConfirmPassword").val();
 if(stud=='')
    {
    $("#ConfirmPassword").addClass('validat_false');
    $("#msgbox").html('* Please Fill The Blank Fields.');
flag=0;}
if(stud !== form){
    $("#msgbox").html('Password Does not Match');
	flag=0;
}
if(flag==1){
$("#msgbox").html('Success');
$("#resetpass").submit(); 

}
else if(flag==0){ return false;}
    
});
});
</script>

<script>
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var special_char = document.getElementById("special_char");
var myInput = document.getElementById("new_password");


// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    document.getElementById("validation").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("validation").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.oninput = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
 
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }


  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
   // Validate special letters
  var specialchar =/[@$!%*#?&`^~/]/;
  if(myInput.value.match(specialchar)) {  
    special_char.classList.remove("invalid");
    special_char.classList.add("valid");
  } else {
    special_char.classList.remove("valid");
    special_char.classList.add("invalid");
  }
}
</script>
