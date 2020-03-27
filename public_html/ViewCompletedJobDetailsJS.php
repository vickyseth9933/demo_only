 <?php
include_once 'config.php';
$conn = OpenCon();
$id = $_POST['id'];
$order_no = $_POST['order_no'];
 
    $sql_data = "SELECT completed_jobs.*,completed_jobs.order_id as order_no,cb_order_new.user_id,DATE_FORMAT(completed_jobs.complete_date,'%m/%d/%Y') as approved_date,cb_order_new.recommendation,cb_order_new.commnets_of_reject,cb_order_new.order_stage,cb_order_new.reject_status,cb_order_new.order_no,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_front_cover.project_id,cb_front_cover.dateofreview as created_on,cb_front_cover.city as CITY,STR_TO_DATE(cb_front_cover.reviewcompletiondate,'mm/dd/YYYY') as reviewcompletiondate,cb_front_cover.resp_group,cb_front_cover.division,cb_front_cover.city as city_name,cb_front_cover.cn_29_eligible,cb_front_cover.fc_cm,cb_front_cover.ce_rcm,cb_front_cover.foreman,cb_front_cover.m_c_supervisor,cb_front_cover.distribution_transmission,cb_front_cover.inspector,
cb_project_details.*,qualiflying_five.CN29_in_SAP,qualiflying_five.CN24,qualiflying_five.gas_assets_installed,qualiflying_five.installation_below_ground,qualiflying_five.MOI,qualiflying_five.CN29_in_SAP_cmt,qualiflying_five.CN24_cmt,qualiflying_five.gas_assets_installed_cmt,qualiflying_five.installation_below_ground_cmt,qualiflying_five.MOI_cmt,distribution_checklist.* FROM completed_jobs 
LEFT  JOIN cb_order_new ON(completed_jobs.order_id=cb_order_new.order_no)
LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=completed_jobs.order_id)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=completed_jobs.order_id)
LEFT JOIN qualiflying_five ON(qualiflying_five.order_id=completed_jobs.order_id)
LEFT JOIN distribution_checklist ON(distribution_checklist.order_id=completed_jobs.order_id)
WHERE  completed_jobs.order_id=$order_no";


 
//   $sql_data = "SELECT completed_jobs.*,cb_order_new.order_no,cb_order_new.recommendation,cb_order_new.user_id,cb_order_new.RESPONSIBLE_GROUP,cb_order_new.mat as MAAT,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.resp_group,
// cb_project_details.mat FROM completed_jobs 
// LEFT  JOIN cb_order_new ON(completed_jobs.order_id=cb_order_new.order_no)
// LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
// LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=completed_jobs.order_id)
// LEFT JOIN cb_project_details ON(cb_project_details.order_id=completed_jobs.order_id)
// WHERE completed_jobs.order_id=$order_no ";
 
$result = $conn->query($sql_data);
$data = $result->fetch_assoc();

$res = json_encode($data);
echo $res;
?>