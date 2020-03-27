<?php
include_once 'config.php';
$conn = OpenCon();
date_default_timezone_set('America/Los_Angeles');
$updated_time = date("Y-m-d H:i:s");
$email= strtolower($_POST['email']);
 //$email= 'reviewer@epikso.com';
 $baseurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

$serverLink = 'https://www.crossbore.pgeops.com/';
$email_encript= base64_encode($email);
//$email_decript= base64_decode($email_encript);
$sublink=$baseurl."/reset_pass.php?key=".$email_encript;
$link ='<a href="'.$sublink.'">here</a>';
$link1 = 'set';

    $sql = "SELECT id,first_name FROM cb_user WHERE email = '$email'";
	$users = $conn->query($sql);
    $row_usercount = mysqli_num_rows($users);

if($row_usercount > 0) {
$row = $users->fetch_assoc();

$username = $row["first_name"];
function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$pass = generateRandomString();
$password = MD5($pass);
/********Email Send start***********/
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username ='emaildummy54@gmail.com';               // SMTP username
$mail->Password = '9771212139';                         // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('emaildummy54@gmail.com', 'Cross Bore');
$mail->addAddress($email, $username);
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = "Cross Bore password assistance";
$mail->Body    = "<html><head><title>Reset  Password</title></head><body><p>Hi ".$username.",</p><p>We are sorry that you are having trouble with your password.</p><p>Please click ".$link." to reset your password.</p><br><p>Thank you,<br>Crossbore Team</p></body></html>";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients  SMTP';
$mail->send();



//$mail->Body    = 'Hi Iam using PHPMailer library to sent SMTP mail from localhost';

if(!$mail->send()) {
 $response = array("status"=>400,"error"=>$mail->ErrorInfo,"status_message"=>"Email is not sending.","data"=>$data);  
echo json_encode($response);
}
else{

/********Email Send End***********/

$INSQUERY2 = "UPDATE  `cb_user` SET password_reset_key='" . $email_encript. "' where email='" . $email . "' ";
$conn->query($INSQUERY2);
//$sqlINS2 = mysql_query($INSQUERY2) or die(mysql_error());

 $response = array("status"=>200,"status_message"=>"Reset password link has been sent to your registered email address.","data"=>$data);
echo json_encode($response); 
}
//$response = "Reset password link has been sent to your registered email address.";
//echo json_encode($response);
//$response = array("status"=>200,"status_message"=>"Reset password link has been sent to your registered email address.");
//echo json_encode($response);

    
}else{

 $response = array("status"=>400,"status_message"=>"Please enter your registered email address.","data"=>$data);  
echo json_encode($response); 

    
}
	

	
	

/* function response_json($status,$status_message,$data)
{
	header("HTTP/1.1 $status $status_message");

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	echo json_encode($response);
} */





?>