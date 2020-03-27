 <?php
include_once 'config.php';
$conn = OpenCon();


$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$Number = mysqli_real_escape_string($conn, $_POST['phnno']);
$Password = mysqli_real_escape_string($conn, $_POST['Password']);
$zip = mysqli_real_escape_string($conn, $_POST['zip']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$state = mysqli_real_escape_string($conn, $_POST['state']);
$hire_date = mysqli_real_escape_string($conn, $_POST['hire_date']);
$hire_date = date("Y-m-d", strtotime($hire_date));
$lanid = mysqli_real_escape_string($conn, $_POST['lanid']);
$roleid = $_POST['roleid'];

$sql_UsrProfile = "SELECT id FROM cb_user WHERE email = '$email'";
$result_UsrProfile = $conn->query($sql_UsrProfile);
$UsrProfile_res = $result_UsrProfile->fetch_array();
//echo $roleid;
if ($result_UsrProfile->num_rows > 0) {
  $response2 = array("status" => 400, "status_message" => "Fail","query"=>$sql_cb_project_details); 
     echo json_encode($response2);    
}else{
    $sql = "INSERT INTO cb_user(first_name,last_name,email,phone,password,state,city,zip,hire_date,role_id,lanid) VALUES ('$firstName','$lastName','$email',$Number,'$Password','$state','$city','$zip','$hire_date',$roleid,'$lanid')";
$conn->query($sql);
$response = array("status" => 200, "status_message" => "Success","query"=>$sql_cb_project_details); 
echo json_encode($response); 

}
?>