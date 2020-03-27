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
   //$sql_cb_project_details = "UPDATE  cb_project_details SET MAT_check='".$_POST['Checkmat']."',CN24_check='".$_POST['check_cn24']."',CN29_check='".$_POST['check_cn29']."',CN07_check='".$_POST['check_cn07']."',mat='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['mat']))."',cn24='".mysqli_real_escape_string($conn, $_POST['cn24'])."',cn24_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['cn24_lanid']))."',cn24_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['cn24_date']))."',cn07='".mysqli_real_escape_string($conn, $_POST['cn07'])."',cn07_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['cn07_lanid']))."',cn07_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['cn07_date']))."',cn29='".mysqli_real_escape_string($conn, $_POST['cn29'])."',cn29_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['cn29_lanid']))."',cn29_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['cn29_date']))."',dc39='".mysqli_real_escape_string($conn, $_POST['dc39'])."',dc39_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc39_lanid']))."',dc39_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc39_date']))."',dc46='".mysqli_real_escape_string($conn, $_POST['dc46'])."',dc46_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc46_lanid']))."',dc46_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc46_date']))."',dc05='".mysqli_real_escape_string($conn, $_POST['dc05'])."',dc05_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc05_lanid']))."',dc05_date='".mysqli_real_escape_string($conn,RemoveSpecialChapr($_POST['dc05_date']))."',dc14='".mysqli_real_escape_string($conn, $_POST['dc14'])."',dc14_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc14_lanid']))."',dc14_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc14_date']))."',dc15='".mysqli_real_escape_string($conn, $_POST['dc15'])."',dc15_lanid='".mysqli_real_escape_string($conn,RemoveSpecialChapr($_POST['dc15_lanid']))."',dc15_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc15_date']))."',dc19='".mysqli_real_escape_string($conn, $_POST['dc19'])."',dc19_lanid='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc19_lanid']))."',dc19_date='".mysqli_real_escape_string($conn, RemoveSpecialChapr($_POST['dc19_date']))."',dc10='".mysqli_real_escape_string($conn, $_POST['dc10'])."',dc10_lanid='".mysqli_real_escape_string($conn,RemoveSpecialChapr($_POST['dc10_lanid']))."',dc10_date='".mysqli_real_escape_string($conn , RemoveSpecialChapr($_POST['dc10_date']))."',cmt_cn_dc='".mysqli_real_escape_string($conn,RemoveSpecialChapr($_POST['cmt_cn_dc']))."' WHERE order_id='".$_POST['order_no']."' AND user_id='".$_POST['id']."'";

  $sql_cb_project_details = "UPDATE  cb_project_details SET MAT_check='".$_POST['Checkmat']."',CN24_check='".$_POST['check_cn24']."',CN29_check='".$_POST['check_cn29']."',CN07_check='".$_POST['check_cn07']."',mat='".mysqli_real_escape_string($conn, $_POST['mat'])."',cn24='".mysqli_real_escape_string($conn, $_POST['cn24'])."',cn24_lanid='".mysqli_real_escape_string($conn, $_POST['cn24_lanid'])."',cn24_date='".mysqli_real_escape_string($conn, $_POST['cn24_date'])."',cn07='".mysqli_real_escape_string($conn, $_POST['cn07'])."',cn07_lanid='".mysqli_real_escape_string($conn, $_POST['cn07_lanid'])."',cn07_date='".mysqli_real_escape_string($conn, $_POST['cn07_date'])."',cn29='".mysqli_real_escape_string($conn, $_POST['cn29'])."',cn29_lanid='".mysqli_real_escape_string($conn, $_POST['cn29_lanid'])."',cn29_date='".mysqli_real_escape_string($conn, $_POST['cn29_date'])."',dc39='".mysqli_real_escape_string($conn, $_POST['dc39'])."',dc39_lanid='".mysqli_real_escape_string($conn, $_POST['dc39_lanid'])."',dc39_date='".mysqli_real_escape_string($conn, $_POST['dc39_date'])."',dc46='".mysqli_real_escape_string($conn, $_POST['dc46'])."',dc46_lanid='".mysqli_real_escape_string($conn, $_POST['dc46_lanid'])."',dc46_date='".mysqli_real_escape_string($conn, $_POST['dc46_date'])."',dc05='".mysqli_real_escape_string($conn, $_POST['dc05'])."',dc05_lanid='".mysqli_real_escape_string($conn, $_POST['dc05_lanid'])."',dc05_date='".mysqli_real_escape_string($conn, $_POST['dc05_date'])."',dc14='".mysqli_real_escape_string($conn, $_POST['dc14'])."',dc14_lanid='".mysqli_real_escape_string($conn, $_POST['dc14_lanid'])."',dc14_date='".mysqli_real_escape_string($conn, $_POST['dc14_date'])."',dc15='".mysqli_real_escape_string($conn, $_POST['dc15'])."',dc15_lanid='".mysqli_real_escape_string($conn, $_POST['dc15_lanid'])."',dc15_date='".mysqli_real_escape_string($conn, $_POST['dc15_date'])."',dc19='".mysqli_real_escape_string($conn, $_POST['dc19'])."',dc19_lanid='".mysqli_real_escape_string($conn, $_POST['dc19_lanid'])."',dc19_date='".mysqli_real_escape_string($conn, $_POST['dc19_date'])."',dc10='".mysqli_real_escape_string($conn, $_POST['dc10'])."',dc10_lanid='".mysqli_real_escape_string($conn, $_POST['dc10_lanid'])."',dc10_date='".mysqli_real_escape_string($conn , $_POST['dc10_date'])."',cmt_cn_dc='".mysqli_real_escape_string($conn, $_POST['cmt_cn_dc'])."' WHERE order_id='".$_POST['order_no']."' AND user_id='".$_POST['id']."'";
$res =  $conn->query($sql_cb_project_details);
 

  if($res){
        $sql3 = "UPDATE cb_order_new SET order_stage='2' WHERE order_no ='".$_POST['order_no']."' AND order_stage !='3' AND order_stage !='4'";	
 $res2 = $conn->query($sql3);
          $response = array("status" => 200, "status_message" => "Success","query"=>$sql_cb_project_details); 
echo json_encode($response); 

  }else{
     $response2 = array("status" => 400, "status_message" => "Fail","query"=>$sql_cb_project_details); 
     echo json_encode($response2); 

  }
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
   $sql_QualifyingFive = "UPDATE  qualiflying_five SET CN29_in_SAP='".$_POST['CN29_in_SAP']."',CN29_in_SAP_cmt='".mysqli_real_escape_string($conn, $_POST['CN29_in_SAP_cmt'])."',CN24='".$_POST['CN24']."',CN24_cmt='".mysqli_real_escape_string($conn, $_POST['CN24_cmt'])."',gas_assets_installed='".$_POST['gas_assets_installed']."',gas_assets_installed_cmt='".mysqli_real_escape_string($conn, $_POST['gas_assets_installed_cmt'])."',installation_below_ground='".$_POST['installation_below_ground']."',installation_below_ground_cmt='".mysqli_real_escape_string($conn, $_POST['installation_below_ground_cmt'])."',MOI='".$_POST['MOI']."',MOI_cmt='".mysqli_real_escape_string($conn, $_POST['MOI_cmt'])."' WHERE order_id='".$_POST['order_no']."' AND user_id='".$_POST['id']."'";
$res =  $conn->query($sql_QualifyingFive);

   if($res){
        $sql3 = "UPDATE cb_order_new SET order_stage='3' WHERE order_no ='".$_POST['order_no']."' AND order_stage !='4'";	
$res2 = $conn->query($sql3);
          $response = array("status" => 200, "status_message" => "Success","query"=>$sql_QualifyingFive); 
echo json_encode($response); 

  }else{
     $response2 = array("status" => 400, "status_message" => "Fail","query"=>$sql_QualifyingFive); 
     echo json_encode($response2); 

  }
}

if($_POST['form_type']=='ChecklistQuestions'){
    $query = "UPDATE distribution_checklist SET SAP_Reviewed='".$_POST['SAP_Reviewed']."',SAP_Reviewed_cmt='".mysqli_real_escape_string($conn, $_POST['SAP_Reviewed_cmt'])."',Trenchless_MOI='".$_POST['Trenchless_MOI']."',Trenchless_MOI_cmt='".mysqli_real_escape_string($conn, $_POST['Trenchless_MOI_cmt'])."',MOI_for_Srv='".$_POST['MOI_for_Srv']."',MOI_for_Srv_cmt='".mysqli_real_escape_string($conn, $_POST['MOI_for_Srv_cmt'])."',MOI_for_Main='".$_POST['MOI_for_Main']."',MOI_for_Main_cmt='".mysqli_real_escape_string($conn, $_POST['MOI_for_Main_cmt'])."',determine_the_MOI='".$_POST['determine_the_MOI']."',determine_the_MOI_cmt='".mysqli_real_escape_string($conn, $_POST['determine_the_MOI_cmt'])."',used_to_retrieve_the_document='".$_POST['used_to_retrieve_the_document']."',used_to_retrieve_the_document_cmt='".mysqli_real_escape_string($conn, $_POST['used_to_retrieve_the_document_cmt'])."',SAP='".mysqli_real_escape_string($conn, $_POST['SAP'])."',SAP_cmt='".mysqli_real_escape_string($conn, $_POST['SAP_cmt'])."',PRE_Inspection='".$_POST['PRE_Inspection']."',PRE_Inspection_cmt='".mysqli_real_escape_string($conn, $_POST['PRE_Inspection_cmt'])."',Post_Inspection_Required_per_PRE_Inspection='".$_POST['Post_Inspection_Required_per_PRE_Inspection']."', Post_Inspection_Required_per_PRE_Inspection_cmt='".mysqli_real_escape_string($conn, $_POST['Post_Inspection_Required_per_PRE_Inspection_cmt'])."',POST_Inspection='".$_POST['POST_Inspection']."',POST_Inspection_cmt='".mysqli_real_escape_string($conn, $_POST['POST_Inspection_cmt'])."',Cross_Bore_Log='".$_POST['Cross_Bore_Log']."',Cross_Bore_Log_cmt='".mysqli_real_escape_string($conn, $_POST['Cross_Bore_Log_cmt'])."'  WHERE order_id='".$_POST['order_no']."' AND user_id='".$_POST['id']."'";
$res = $conn->query($query);

    if($res){
        $sql3 = "UPDATE cb_order_new SET order_stage='4' WHERE order_no ='".$_POST['order_no']."'";	
 $res2 = $conn->query($sql3);
          $response = array("status" => 200, "status_message" => "Success","query"=>$query); 
echo json_encode($response); 

  }else{
     $response2 = array("status" => 400, "status_message" => "Fail","query"=>$query); 
     echo json_encode($response2); 

  }
}
if($_POST['form_type']=='job_status'){
    
  
   $sql_cb_order = "UPDATE  cb_order SET  status ='".$_POST['status_job']."'  WHERE order_id='".$_POST['order_no']."'";
 $updatequery = $conn->query($sql_cb_order);
 
 $sql3 = "UPDATE cb_order_new SET order_stage='5',send_job_approval='1',date_of_submission='$todaydate',reject_status='0',recommendation='".mysqli_real_escape_string($conn, $_POST['recomandation'])."' WHERE order_no ='".$_POST['order_no']."'";	
 $conn->query($sql3);
 
  $sqlall1 = "UPDATE cb_front_cover SET dateofreview='$todaydate'  WHERE order_id ='".$_POST['order_no']."'";	
 $conn->query($sqlall1);
    
 if($updatequery){
$response = array("status" => 200, "status_message" => "Success"); 
echo json_encode($response); 

  }else{
     $response2 = array("status" => 400, "status_message" => "Fail"); 
     echo json_encode($response2); 

  } 
}
if($_POST['form_type']=='Approve'){
//  echo "<pre>";
//  print_r($_POST);
//  echo "<pre>";
$destination_arrayall = $_POST['order_no'];
for($i=0; $i<count($destination_arrayall); $i++){
       $sqlall = "UPDATE cb_order_new SET order_stage='6' ,approved_by='".$_POST['approveby']."',approved_date='$todaydate',approved_date='$todaydate'  WHERE order_no ='".$destination_arrayall[$i]."'";	
 $conn->query($sqlall);
 
  $sqlall1 = "UPDATE cb_front_cover SET reviewcompletiondate='$todaydate'  WHERE order_id ='".$destination_arrayall[$i]."'";	
 $conn->query($sqlall1);
 
 
}
}
if($_POST['form_type']=='Approveview'){
//  echo "<pre>";
//  print_r($_POST);
//  echo "<pre>";

       $sqlall = "UPDATE cb_order_new SET order_stage='6' ,approved_by='".$_POST['approveby']."',approved_date='$todaydate' WHERE order_no ='".$_POST['order_no']."'";	
   $conn->query($sqlall);
}
if($_POST['form_type']=='ApproveAll'){
//  echo "<pre>";
//  print_r($_POST);
//  echo "<pre>";
$destination_arrayall = explode(',', $_POST['order_no']);
for($i=0; $i<count($destination_arrayall); $i++){
      $sqlall = "UPDATE cb_order_new SET order_stage='6' ,approved_by='".$_POST['approveby']."',approved_date='$todaydate' WHERE order_no ='".$destination_arrayall[$i]."'";	
  $conn->query($sqlall);
   $sqlall1 = "UPDATE cb_front_cover SET reviewcompletiondate='$todaydate'  WHERE order_id ='".$destination_arrayall[$i]."'";	
 $conn->query($sqlall1);
}
}
if($_POST['form_type']=='Approve50'){


$destination_array50 = explode(',', $_POST['order_no']);
for($i=0; $i<=49; $i++){
  $sql50 = "UPDATE cb_order_new SET order_stage='6', approved_by='".$_POST['approveby']."',approved_date='$todaydate' WHERE order_no ='".$destination_array50[$i]."'";	
    $conn->query($sql50);
     $sqlall1 = "UPDATE cb_front_cover SET reviewcompletiondate='$todaydate'  WHERE order_id ='".$destination_arrayall[$i]."'";	
 $conn->query($sqlall1);
}
}


$comment_reject = $conn->real_escape_string($_POST['comment']);


if($_POST['form_type']=='Reject'){
   $sql50 = "UPDATE cb_order_new SET reject_status='1',order_stage='7', send_job_approval='0',commnets_of_reject='".$comment_reject."',approved_by='".$_POST['approveby']."',rejected_date='$todaydate' WHERE order_no ='".$_POST['order_no']."'";	
 $conn->query($sql50);
 
}
 ?>