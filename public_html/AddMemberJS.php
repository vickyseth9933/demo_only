<?php
include_once 'config.php';
$conn = OpenCon();
$Fname = $_POST['FisrtName'];
$Lname = $_POST['LastName'];
$LanID = $_POST['LanID'];
$address = $_POST['Address'];
echo $query = "INSERT INTO cb_user SET first_name='$Fname',last_name='$Lname',lanid='$LanID',address='$address'";
$res = mysqli_query($conn,$query);





?>