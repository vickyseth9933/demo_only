<?php
$time = date('m-d-Y_is');
header("Content-disposition: attachment; filename=$time.pdf");
header("Content-type: application/pdf");
readfile("test.pdf");



?>