<?php

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

$mail->setFrom('emaildummy54@gmail.com', 'emaildummy');
$mail->addAddress('sunilchand@epikso.com ', 'sunil');     // Add a recipient


$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'SMTP';
$mail->Body    = 'sent from SMTP mail</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients  SMTP';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>











