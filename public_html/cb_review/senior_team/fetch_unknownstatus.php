 <?php
include_once '../../config.php';
$conn = OpenCon();


$sqljob_unknownstatus = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Unknown Status'  AND  send_job_approval='1'  AND order_stage= 6 AND 
cb_order_new.approved_date >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
AND cb_order_new.approved_date < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY";
$result_unknownstatus = $conn->query($sqljob_unknownstatus);


$data_unknownstatus = $result_unknownstatus->fetch_assoc();

$res = json_encode($data_unknownstatus);
//echo $res;
?>