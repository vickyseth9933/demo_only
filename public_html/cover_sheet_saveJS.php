 <?php
include_once 'config.php';
$conn = OpenCon();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>"; 

$reviewer_lanid = mysqli_real_escape_string($conn, $_POST['reviewer_lanid']);
  $review_date = mysqli_real_escape_string($conn, $_POST['review_date']); 
//$datestr = str_replace("-", "/", $review_date);
 $review_dateformat = date("Y-m-d", strtotime($review_date));
$reviewer_completion_date = mysqli_real_escape_string($conn, $_POST['reviewer_completion_date']); 
$order_no =  mysqli_real_escape_string($conn, $_POST['order_no']); 
$proj_id =  mysqli_real_escape_string($conn, $_POST['proj_id']); 

$division = mysqli_real_escape_string($conn, $_POST['division']);
$city = mysqli_real_escape_string($conn, $_POST['city']); 
$resp_gp = mysqli_real_escape_string($conn, $_POST['resp_gp']); 
$cn29eligible =  isset($_POST['cn29eligible']) ? mysqli_real_escape_string($conn, $_POST['cn29eligible']) : ''; 
$order_desc =  mysqli_real_escape_string($conn, $_POST['order_desc']);

$fecm = mysqli_real_escape_string($conn, $_POST['fecm']);
$cercm = mysqli_real_escape_string($conn, $_POST['cercm']); 
$foreman = mysqli_real_escape_string($conn, $_POST['foreman']); 
$mcsupervisor =  mysqli_real_escape_string($conn, $_POST['mcsupervisor']); 
$Distribution_Transmission =  mysqli_real_escape_string($conn, $_POST['Distribution_Transmission']);

$inspector = isset($_POST['inspector']) ? mysqli_real_escape_string($conn, $_POST['inspector']) : '';
$form_step =  isset($_POST['currentstep']) ? mysqli_real_escape_string($conn, $_POST['currentstep']) : ''; 
$reviewer_id =  mysqli_real_escape_string($conn, $_POST['reviewer_id']);
//echo $sql = "UPDATE cb_order_new SET reviewer_lanid = $reviewer_lanid, created_on = '$review_date', reviewer_completion_date = '$reviewer_completion_date', project_id = '$proj_id', division = '$division', city = '$city', resp_group = '$resp_gp', description = '$order_desc' WHERE id = $reviewer_id";	
 //$conn->query($sql);
$query = "SELECT id FROM cb_front_cover WHERE order_id='$order_no'";
$result = $conn->query($query);
$rowcount=mysqli_num_rows($result);
//$check_front_cover = $result->fetch_assoc();
//$checklanid = $check_front_cover['reviewerlanid'];
 if($rowcount >0){ 
 
 
if($reviewer_completion_date == ''){
	 $sql2 = "UPDATE cb_front_cover SET status='1',reviewerlanid ='$reviewer_lanid', dateofreview = '$review_dateformat', project_id = '$proj_id', division = '$division', city = '$city', resp_group = '$resp_gp', order_description = '$order_desc',cn_29_eligible='$$cn29eligible',fc_cm='$fecm',ce_rcm='$cercm',foreman='$foreman',m_c_supervisor='$mcsupervisor',distribution_transmission='$Distribution_Transmission',inspector='$inspector' WHERE order_id = $order_no";
}
else{
	 $sql2 = "UPDATE cb_front_cover SET status='1',reviewerlanid ='$reviewer_lanid', dateofreview = '$review_dateformat', reviewcompletiondate = '$reviewer_completion_date', project_id = '$proj_id', division = '$division', city = '$city', resp_group = '$resp_gp', order_description = '$order_desc',cn_29_eligible='$$cn29eligible',fc_cm='$fecm',ce_rcm='$cercm',foreman='$foreman',m_c_supervisor='$mcsupervisor',distribution_transmission='$Distribution_Transmission',inspector='$inspector' WHERE order_id = $order_no";
}
 }else{
if($reviewer_completion_date == ''){
	 $sql2 = "INSERT INTO  cb_front_cover SET user_id='$reviewer_id',status='1',reviewerlanid ='$reviewer_lanid', dateofreview = '$review_dateformat', project_id = '$proj_id', division = '$division', city = '$city', resp_group = '$resp_gp', order_description = '$order_desc',cn_29_eligible='$$cn29eligible',fc_cm='$fecm',ce_rcm='$cercm',foreman='$foreman',m_c_supervisor='$mcsupervisor',distribution_transmission='$Distribution_Transmission',inspector='$inspector',order_id = $order_no";
}
else{
	 $sql2 = "INSERT INTO  cb_front_cover SET user_id='$reviewer_id',status='1',reviewerlanid ='$reviewer_lanid', dateofreview = '$review_dateformat', reviewcompletiondate = '$reviewer_completion_date', project_id = '$proj_id', division = '$division', city = '$city', resp_group = '$resp_gp', order_description = '$order_desc',cn_29_eligible='$$cn29eligible',fc_cm='$fecm',ce_rcm='$cercm',foreman='$foreman',m_c_supervisor='$mcsupervisor',distribution_transmission='$Distribution_Transmission',inspector='$inspector', order_id = $order_no";
}	 
 }
	
 $res = $conn->query($sql2);
 $sql3 = "UPDATE cb_order_new SET order_stage='1' WHERE order_no = $order_no AND order_stage !='2' AND order_stage !='3' AND order_stage !='4'";	
 $res2 =  $conn->query($sql3); 
 if($res && $res2){
          $response = array("status" => 200, "status_message" => "Success","query"=>$sql2); 
echo json_encode($response); 

  }else{
     $response2 = array("status" => 400, "status_message" => "Fail","query"=>$sql2); 
     echo json_encode($response2); 

  }
  	

 ?>