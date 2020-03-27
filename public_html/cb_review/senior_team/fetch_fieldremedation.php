 <?php
include_once '../../config.php';
$conn = OpenCon();

$today = date("Y-m-d");
//$today =  "2019-07-01";

$date = strtotime($today);
$date = strtotime("+7 day", $date);
$nxt7day = date('Y-m-d', $date);


/*$sqljob_fieldremedatn = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Field Remediation Required'  AND  send_job_approval='1' AND 
cb_order_new.approved_date >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
AND cb_order_new.approved_date < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY";
$result_fieldremedatn = $conn->query($sqljob_fieldremedatn);*/

$sqljob_fieldremedatn = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE order_status.order_name = 'Field Remediation Required'  AND  send_job_approval='1'  AND order_stage= 6 
AND cb_order_new.approved_date >= '$today' AND cb_order_new.approved_date <= '$nxt7day'";
$result_fieldremedatn = $conn->query($sqljob_fieldremedatn);






//$data_fieldremedatn = $result_fieldremedatn->fetch_assoc();
$result = "<tbody>";
while($row = $result_fieldremedatn->fetch_assoc()) {
            $result .=  "<tr>
                        <td>'".$row['name']."'</td>
                        <td>'".$row['order_no']."'</td>
                        <td>'".$row['description']."'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align='center'>
                          <button  type='button' class='btn btn-primary rejectjobs' data-toggle='modal' data-target='#exampleModal'>View</button>
                        </td>
                </tr>";
		}
$result .=  "</tbody>";
echo $result;
?>
?>