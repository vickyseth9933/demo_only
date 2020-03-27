<?php
$conn = new mysqli("localhost", "epikso6_crosbore", "Epikso@1986", "epikso6_cross_bore_prevention");


$query = "SELECT order_no as id,order_no,description,RESPONSIBLE_GROUP,mat FROM cb_order_new WHERE user_id = 0";
$result = $conn->query($query);

//$data=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
  $data[] = $row;
}
//print_r(array_values($data));
$results = ["sEcho" => 1,
          "iTotalRecords" => count($data),
          "iTotalDisplayRecords" => count($data),
          "aaData" => array_values($data) ];
//file_put_contents("test.txt",$results);

 echo json_encode($results);


?>