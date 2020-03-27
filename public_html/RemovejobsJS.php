<?php
include_once 'config.php';
$conn = OpenCon();
   $order_no = $_POST['order_no'];


    $querycheckorder = "UPDATE cb_order_new SET remove_status='1' WHERE order_no='$order_no'";
$orderidremove = $conn->query($querycheckorder);
if($orderidremove){
  $response2 = array("status" => 200, "status_message" => "success"); 
     echo json_encode($response2); 
}
else{
    
 $response2 = array("status" => 400, "status_message" => "Fail"); 
     echo json_encode($response2); 

 
}

  ?>