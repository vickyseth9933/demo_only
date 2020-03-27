 <?php
include_once '../../config.php';
$conn = OpenCon();
$data = $_POST['data'];
if($_POST['data_Type'] == 'City_Division') {
        
        $sqljob_res = "SELECT cb_order_new.CITY,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE send_job_approval='1' AND order_stage= 6 
                                    AND cb_order_new.CITY = '$data'";
        $result_job = $conn->query($sqljob_res);

    
/*} else if($_POST['data_Type'] == 'month') {
            
        $sqljob_cn29 = "SELECT cb_order_new.order_no,order_status.order_name,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
                                    cb_project_details.mat FROM cb_order_new 
                                    INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
                                    INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
                                    INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
                                    INNER JOIN  order_status ON(cb_order.status=order_status.id)
                                    WHERE order_status.order_name = 'CN-29 Eligible'  AND  send_job_approval='1' AND 
                                    cb_order_new.approved_date >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
                                    AND cb_order_new.approved_date < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY";
            
        } else {*/
    
    
}


$i=1;  
while($row = $result_job->fetch_assoc()) {
            $result .=  "<tr>
                        <td>".$i++."</td>  
                        <td>".$row['order_no']."</td>
                        <td>".$row['description']."</td>
                        <td>".$row['resp_group']."</td>
                        <td>".$row['mat']."</td>
                        <td>".$row['CITY']."</td>
                        <td>".$row['order_name']."</td>
                </tr>";
		}
//$result .=  "</tbody>";
echo $result;
?>