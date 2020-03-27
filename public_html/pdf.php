<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';
use mikehaertl\wkhtmlto\Pdf;

$pdf = new Pdf('<html><head></head><body>Hello pdf</body></html>');
$pdf->binary = '/usr/local/bin/wkhtmltopdf';

if (!$pdf->saveAs('/var/www/cgi-bin/pdf/test.pdf')) {
    echo $pdf->getError();
}
?>