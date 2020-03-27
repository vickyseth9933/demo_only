<?php
include_once 'config.php';
$conn = OpenCon();
  $id = $_POST['id'];
  $order_no = $_POST['order_no'];


    $querycheckorder = "SELECT id FROM completed_jobs WHERE order_id='$order_no' AND   (`complete_status` = 'Complete, In SAP Long Text' || `complete_status` = 'Complete')";

$resultorderexists = $conn->query($querycheckorder);
$rowcount_completed_jobs=mysqli_num_rows($resultorderexists);

if($rowcount_completed_jobs>0){
  $response2 = array("status" => 400, "status_message" => "Fail","status_msg"=>"Fail"); 
     echo json_encode($response2);   
}
else{
    

$query1 = "SELECT id FROM cb_front_cover WHERE order_id='$order_no' AND user_id='$id'";
$result1 = $conn->query($query1);
$rowcount_cb_front_cover=mysqli_num_rows($result1);

$query2 = "SELECT id FROM qualiflying_five WHERE order_id='$order_no' AND user_id='$id'";
$result2 = $conn->query($query2);
$rowcount_qualiflying_five=mysqli_num_rows($result2);

$query3 = "SELECT id FROM cb_project_details WHERE order_id='$order_no' AND user_id='$id'";
$result3 = $conn->query($query3);
$rowcount_cb_project_details=mysqli_num_rows($result3);

$query4 = "SELECT id FROM distribution_checklist WHERE order_id='$order_no' AND user_id='$id'";
$result4 = $conn->query($query4);
$rowcount_distribution_checklist=mysqli_num_rows($result4);

  $sql = "SELECT cb_order_new.*,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_user.city FROM cb_order_new INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id) WHERE cb_order_new.user_id = $id AND cb_order_new.order_no='$order_no'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row['CN24_SAP_DATE']==''){ 
     $CN24_SAP_DATE = '' ;
 } else { 
    $CN24_SAP_DATE =  date('m/d/Y',strtotime($row['CN24_SAP_DATE'])); 
 }
if($row['CN07_SAP_DATE']==''){ 
    $CN07_SAP_DATE = '';
} 
else { 
    $CN07_SAP_DATE = date('m/d/Y',strtotime($row['CN07_SAP_DATE']));
}
 if($row['CN29_SAP_DATE']==''){ 
     $CN29_SAP_DATE = ''; 
 } else { 
     $CN29_SAP_DATE = date('m/d/Y',strtotime($row['CN29_SAP_DATE']));
 }


 if($row['DC39_SAP_DATE']==''){ 
     $DC39_SAP_DATE = ''; 
 } else { 
     $DC39_SAP_DATE = date('m/d/Y',strtotime($row['DC39_SAP_DATE']));
 }
 if($row['DC46_SAP_DATE']==''){ 
     $DC46_SAP_DATE = ''; 
 } else { 
     $DC46_SAP_DATE = date('m/d/Y',strtotime($row['DC46_SAP_DATE']));
 }
 if($row['DC05_SAP_DATE']==''){ 
     $DC05_SAP_DATE = ''; 
 } else { 
     $DC05_SAP_DATE = date('m/d/Y',strtotime($row['DC05_SAP_DATE']));
 }
 if($row['DC14_SAP_DATE']==''){ 
     $DC14_SAP_DATE = ''; 
 } else { 
     $DC14_SAP_DATE = date('m/d/Y',strtotime($row['DC14_SAP_DATE']));
 }
 if($row['DC15_SAP_DATE']==''){ 
     $DC15_SAP_DATE = ''; 
 } else { 
     $DC15_SAP_DATE = date('m/d/Y',strtotime($row['DC15_SAP_DATE']));
 }
 if($row['DC19_SAP_DATE']==''){ 
     $DC19_SAP_DATE = ''; 
 } else { 
     $DC19_SAP_DATE = date('m/d/Y',strtotime($row['DC19_SAP_DATE']));
 }
 if($row['DC10_SAP_DATE']==''){ 
     $DC10_SAP_DATE = ''; 
 } else { 
     $DC10_SAP_DATE = date('m/d/Y',strtotime($row['DC10_SAP_DATE']));
 }


//print_r($row);
$message = '';
$queryfc = '';
$query = '';
$queryqf ='';
$querydc = '';
if($rowcount_cb_front_cover > 0){
 $message = $message.  'failed front_cover';
}else{
   $sql_cb_front_cover = "INSERT INTO cb_front_cover SET distribution_transmission='".$row['TRANS_DIST']."',foreman='".$row['FOREMAN']."',city='".$row['CITY']."',project_id='".$row['PROJECTID']."',reviewerlanid = '".$row['lanid']."', dateofreview = '".$row['created_on']."', division = '".$row['division']."', resp_group = '".$row['RESPONSIBLE_GROUP']."', order_description = '".$row['description']."',order_id = $order_no,user_id='$id'";	
 $queryfc =  $conn->query($sql_cb_front_cover);
 $message = $message. 'success front_cover';
 	
}

if($rowcount_cb_project_details >0){
 $message = $message. 'failed project_details'; 
}else{
	       $sql_cb_project_details = "INSERT INTO cb_project_details (order_id,user_id,mat,cn24,cn24_date,cn07,cn07_date,cn29,cn29_date,dc39_date,dc46_date,dc05_date,dc14_date,dc15_date,dc19_date,dc10_date,cn24_lanid,cn07_lanid,cn29_lanid,dc39_lanid,dc46_lanid,dc05_lanid,dc14_lanid,dc15_lanid,dc19_lanid,dc10_lanid) VALUES ('$order_no','$id','".$row['mat']."','".$row['cn24']."','".$CN24_SAP_DATE."','".$row['cn07']."','".$CN07_SAP_DATE."','".$row['cn29']."','".$CN29_SAP_DATE."','".$DC39_SAP_DATE."','".$DC46_SAP_DATE."','".$DC05_SAP_DATE."','".$DC14_SAP_DATE."','".$DC15_SAP_DATE."','".$DC19_SAP_DATE."','".$DC10_SAP_DATE."','".$row['CN24_BY_SAP']."','".$row['CN07_BY_SAP']."','".$row['CN29_BY_SAP']."','".$row['DC39_BY_SAP']."','".$row['DC46_BY_SAP']."','".$row['DC05_BY_SAP']."','".$row['DC14_BY_SAP']."','".$row['DC15_BY_SAP']."','".$row['DC19_BY_SAP']."','".$row['DC10_BY_SAP']."')";
    
 $query = $conn->query($sql_cb_project_details);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
$message = $message. 'success project_details';

 }
if($rowcount_qualiflying_five >0){
$message = $message. 'failed qualiflying_five'; 

}else{
 $sql_cb_qualiflying_five = "INSERT INTO qualiflying_five (order_id,user_id) VALUES ('$order_no','$id')";
 $queryqf = $conn->query($sql_cb_qualiflying_five);
  $message = $message. 'success qualiflying_five';
 
 }
if($rowcount_distribution_checklist > 0){
$message = $message. 'failed distribution_checklist'; 

}else{
	      $sql_cb_distribution_checklist = "INSERT INTO distribution_checklist (order_id,user_id) VALUES ('$order_no','$id')";
   $querydc = $conn->query($sql_cb_distribution_checklist);
 
$message = $message. 'success distribution_checklist';
 
}
if($queryfc && $query && $queryqf && $querydc){
$response2 = array("status" => 200, "status_message" => $message,"status_msg"=>"success"); 
     echo json_encode($response2); 
}else{
$response2 = array("status" => 400, "status_message" => 'exists',"status_msg"=>"failed"); 
     echo json_encode($response2);	
}
}

  ?>