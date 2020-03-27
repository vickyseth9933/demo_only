<?php
session_start();
 $_SESSION['LAST_ACTIVITY'];
 $timestamp =  time() - $_SESSION['LAST_ACTIVITY'];
echo gmdate("Y-m-d H:i:s", $timestamp);
?>