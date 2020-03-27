 <?php
include_once 'config.php';
$conn = OpenCon();
/*  echo "<pre>";
  print_r($_POST);
 echo "</pre>";
die(); */
$reviewer_id = $_POST['reviewer_id'];
$datakey = $_POST['datakey'];
$datavalue = mysqli_real_escape_string($conn, $_POST['datavalue']);
$order_no =  mysqli_real_escape_string($conn, $_POST['order_no']);  

//echo $sql = "UPDATE cb_order_new SET reviewer_lanid = $reviewer_lanid, created_on = '$review_date', reviewer_completion_date = '$reviewer_completion_date', project_id = '$proj_id', division = '$division', city = '$city', resp_group = '$resp_gp', description = '$order_desc' WHERE id = $reviewer_id";	
 //$conn->query($sql);
 if($_POST['form_type']=='ProjectDetails'){
	$query = "SELECT id FROM cb_project_details WHERE order_id='$order_no'";
$result = $conn->query($query);
$rowcount=mysqli_num_rows($result);
if($rowcount >0){  
    $sql2 = "UPDATE cb_project_details SET $datakey ='$datavalue' WHERE order_id = $order_no";
}else{
$sql2 = "INSERT INTO cb_project_details SET $datakey ='$datavalue',user_id='$reviewer_id', order_id = $order_no";	
}
 }
else if($_POST['form_type']=='QualifyingFive'){
$query = "SELECT id FROM qualiflying_five WHERE order_id='$order_no'";
$result = $conn->query($query);
$rowcount=mysqli_num_rows($result);
if($rowcount >0){
  $sql2 = "UPDATE qualiflying_five SET $datakey ='$datavalue' WHERE order_id = $order_no";	
}else{
  $sql2 = "INSERT INTO qualiflying_five SET $datakey ='$datavalue',user_id='$reviewer_id', order_id = $order_no";	
	
}
} 
else if($_POST['form_type']=='ChecklistQuestions'){
$query = "SELECT id FROM distribution_checklist WHERE order_id='$order_no'";
$result = $conn->query($query);
$rowcount=mysqli_num_rows($result);
if($rowcount >0){	
$sql2 = "UPDATE distribution_checklist SET $datakey ='$datavalue' WHERE order_id = $order_no";
}else{
$sql2 = "UPDATE distribution_checklist SET $datakey ='$datavalue',user_id='$reviewer_id', order_id = $order_no";
	
}	
} 
  $res = $conn->query($sql2);
  
 if($res){
          $response = array("status" => 200, "status_message" => "Success","query"=>$sql2); 
echo json_encode($response); 

  }else{
     $response2 = array("status" => 400, "status_message" => "Fail","query"=>$sql2); 
     echo json_encode($response2); 

  }
  	

 ?>