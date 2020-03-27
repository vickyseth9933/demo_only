 <?php
include_once 'config.php';
$conn = OpenCon();
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
date_default_timezone_set("America/Los_Angeles");

$todaydate = date('Y-m-d H:i:s');
//$sql_cb_project_details = "UPDATE  cb_order_new SET send_job_approval= 1";
 //$conn->query($sql_cb_project_details);


if($_POST['form_type']=='ProjectDetails'){
 
 $response = array("status" => 200, "status_message" => "Success"); 
echo json_encode($response); 
 
}
// if($_POST['form_type']=='ProjectDetails'){
//   $sql_cb_project_details = "UPDATE  cb_project_details SET MAT_check='".$_POST['Checkmat']."',CN24_check='".$_POST['check_cn24']."',CN29_check='".$_POST['check_cn29']."',CN07_check='".$_POST['check_cn07']."',mat='".$_POST['mat']."',cn24='".$_POST['cn24']."',cn24_lanid='".$_POST['cn24_lanid']."',cn24_date='".$_POST['cn24_date']."',cn07='".$_POST['cn07']."',cn07_lanid='".$_POST['cn07_lanid']."',cn07_date='".$_POST['cn07_date']."',cn29='".$_POST['cn29']."',cn29_lanid='".$_POST['cn29_lanid']."',cn29_date='".$_POST['cn29_date']."',dc39='".$_POST['dc39']."',dc39_lanid='".$_POST['dc39_lanid']."',dc39_date='".$_POST['dc39_date']."',dc46='".$_POST['dc46']."',dc46_lanid='".$_POST['dc46_lanid']."',dc46_date='".$_POST['dc46_date']."',dc05='".$_POST['dc05']."',dc05_lanid='".$_POST['dc05_lanid']."',dc05_date='".$_POST['dc05_date']."',dc14='".$_POST['dc14']."',dc14_lanid='".$_POST['dc14_lanid']."',dc14_date='".$_POST['dc14_date']."',dc15='".$_POST['dc15']."',dc15_lanid='".$_POST['dc15_lanid']."',dc15_date='".$_POST['dc15_date']."',dc19='".$_POST['dc19']."',dc19_lanid='".$_POST['dc19_lanid']."',dc19_date='".$_POST['dc19_date']."',dc10='".$_POST['dc10']."',dc10_lanid='".$_POST['dc10_lanid']."',dc10_date='".$_POST['dc10_date']."',cmt_cn_dc='".mysqli_real_escape_string($conn, $_POST['cmt_cn_dc'])."' WHERE order_id='".$_POST['order_no']."' AND user_id='".$_POST['id']."'";
// $res =  $conn->query($sql_cb_project_details);
 
//   $sql3 = "UPDATE cb_order_new SET order_stage='2' WHERE order_no ='".$_POST['order_no']."'";	
//  $res2 = $conn->query($sql3);
//   if($res && $res2){
//           $response = array("status" => 200, "status_message" => "Success","query"=>$sql_cb_project_details); 
// echo json_encode($response); 

//   }else{
//      $response2 = array("status" => 400, "status_message" => "Fail","query"=>$sql_cb_project_details); 
//      echo json_encode($response2); 

//   }
// }
 
if($_POST['form_type']=='QualifyingFive'){

          $response = array("status" => 200, "status_message" => "Success"); 
echo json_encode($response); 

}

if($_POST['form_type']=='ChecklistQuestions'){

          $response = array("status" => 200, "status_message" => "Success"); 
echo json_encode($response); 
 
}
if($_POST['form_type']=='job_status'){

$response = array("status" => 200, "status_message" => "Success"); 
echo json_encode($response); 

}




$comment_reject = $conn->real_escape_string($_POST['comment']);



 ?>