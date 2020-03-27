<?php 
include_once '../../config.php';
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
$conn = OpenCon();

//echo "test";
 $data = $_POST['getdate'];
 $type= $_POST['gettype'];
$date1 = DateTime::createFromFormat("m/d/Y" , $data);
$today = $date1->format('Y-m-d');
$date = strtotime($today);
$date = strtotime("+7 day", $date);
$nxt7day = date('Y-m-d', $date);

$sqljob_cn29 = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = '$type' AND  send_job_approval='1' AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";
$res=mysqli_query($conn,$sqljob_cn29);
if(mysqli_num_rows($res) > 0){
   while($row=mysqli_fetch_array($res)) {
    print_r($row);
   }
} else {
    echo "No result found";
}


?>