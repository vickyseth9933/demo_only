 <?php
include_once '../../config.php';
$conn = OpenCon();
$id = $_POST['id'];
$order_no = $_POST['order_no'];
  
   $sql_data = "SELECT distribution_checklist.*,cb_order_new.recommendation FROM distribution_checklist 
   INNER JOIN cb_order_new as cb_order_new ON cb_order_new.order_no = $order_no 
   WHERE order_id='$order_no'";
 
$result = $conn->query($sql_data);
$data = $result->fetch_assoc();

$res = json_encode($data);
echo $res;
?>