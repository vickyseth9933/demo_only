 <?php
include_once 'config.php';
$conn = OpenCon();
echo "<pre>";
//print_r($_POST);
echo "</pre>";
if($_POST['form_type']=='assign'){
foreach($_POST['order_no'] as $OredrNo){
  $query = "UPDATE cb_order_new SET user_id='".$_POST['id']."',order_stage='0',send_job_approval='0',approved_by='0',approved_date='',reject_status='0',rejected_date='',commnets_of_reject='' WHERE order_no='$OredrNo'";
    $conn->query($query);
    $delquery = "DELETE FROM cb_front_cover WHERE order_id='$OredrNo'";
    $conn->query($delquery);
    $delquery = "DELETE FROM cb_project_details WHERE order_id='$OredrNo'";
    $conn->query($delquery);
    $delquery = "DELETE FROM distribution_checklist WHERE order_id='$OredrNo'";
    $conn->query($delquery);
    $delquery = "DELETE FROM qualiflying_five WHERE order_id='$OredrNo'";
    $conn->query($delquery);
     $dupdatequery = " UPDATE `cb_order` SET `status` = '0' WHERE `cb_order`.`order_id` = '$OredrNo'";
    $conn->query($dupdatequery);
}
}
if($_POST['form_type']=='top50'){
$destination_array50 = explode(',', $_POST['order_no']);
for($i=0; $i<=49; $i++){
echo $sql50 = "UPDATE cb_order_new SET user_id='".$_POST['id']."' WHERE order_no='".$destination_array50[$i]."'";
$conn->query($sql50);
}
} 
if($_POST['form_type']=='top100'){
$destination_array100 = explode(',', $_POST['order_no']);
for($i=0; $i<=99; $i++){
echo $sql100 = "UPDATE cb_order_new SET user_id='".$_POST['id']."' WHERE order_no='".$destination_array100[$i]."'";
$conn->query($sql100);
}
} 
?>