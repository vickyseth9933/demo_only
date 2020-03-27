<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
// Require composer autoload
//echo file_exists('/var/www/html/crossbore/vendor/autoload.php');
require_once('/var/www/html/crossbore/vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf();
 // Buffer the following html with PHP so we can store it to a variable later
$htmlOut = 'Some html code';


$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;

$mpdf->WriteHTML($htmlOut);

$mpdf->Output("filename.pdf",'I');