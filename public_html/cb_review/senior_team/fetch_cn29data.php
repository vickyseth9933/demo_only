 <?php
include_once '../../config.php';
$conn = OpenCon();
//$today = date("Y-m-d");
$today =  "2019-07-01";

$date = strtotime($today);
$date = strtotime("+7 day", $date);
$nxt7day = date('Y-m-d', $date);
$sdate = $_POST['sdate'];
$sdate = date('Y-m-d', strtotime($sdate));
$enddate = $_POST['enddate'];
$enddate = date('Y-m-d', strtotime($enddate));


// print_r($_POST);
if($_POST['filter'] == 'week') {
        
          $sqljob_cn29 = "SELECT order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'CN-29 Eligible'  AND  send_job_approval='1' AND order_stage= 6 
                                    AND cb_order_new.approved_date >= '$sdate' AND cb_order_new.approved_date <= '$enddate'";
      //  $result_fieldremedatn = $conn->query($sqljob_cn29);

    
} else if($_POST['filter'] == 'month') {
            
        $sqljob_cn29 = "SELECT cb_order_new.order_no,order_status.order_name,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'CN-29 Eligible'  AND  send_job_approval='1' AND order_stage= 6  
                                    cb_order_new.approved_date >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
                                    AND cb_order_new.approved_date < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY";
            
        } else {
    
    
}

$result_cn29 = $conn->query($sqljob_cn29);

//Field Remediation Required
//CN-29 Eligible
//$data_cn29 = $result_cn29->fetch_assoc();

//$res = json_encode($data_cn29);
//echo $res;

//$result = "";
while($row = $result_cn29->fetch_assoc()) {
            $result .=  "<tr>
                        <td>".$row['name']."</td>
                        <td>".$row['order_no']."</td>
                        <td>".$row['description']."</td>
                        <td>".$row['resp_group']."</td>
                        <td>".$row['mat']."</td>
                        <td>".$row['order_name']."</td>
                        <td align='center'>
                          <button  type='button' class='btn btn-primary rejectjobs' data-toggle='modal' data-target='#exampleModal'>View</button>
                        </td>
                </tr>";
		}
//$result .=  "</tbody>";
echo $result;
?>