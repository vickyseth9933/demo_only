<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dinesh@epikso.com';                 // SMTP username
$mail->Password = 'dcodedinesh@12';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('dineshpilani007@gmail.com', 'Mailer');
$mail->addAddress('shwetarai@epikso.com ', 'Joe User');     // Add a recipient


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