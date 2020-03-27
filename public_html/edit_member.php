 <?php
include_once 'config.php';
$conn = OpenCon();
//echo "<pre>";
//print_r($_POST);exit;
//echo "</pre>";
$id = $_POST['id'];
$firstName = mysqli_real_escape_string($conn, $_POST['firstNameedit']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastNameedit']);
$email = mysqli_real_escape_string($conn, $_POST['emailedit']);
$Number = mysqli_real_escape_string($conn, $_POST['phnnoedit']);
$Password = mysqli_real_escape_string($conn, $_POST['Passwordedit']);
$zip = mysqli_real_escape_string($conn, $_POST['zipedit']);
$city = mysqli_real_escape_string($conn, $_POST['cityedit']);
$state = mysqli_real_escape_string($conn, $_POST['stateedit']);
$hire_date = mysqli_real_escape_string($conn, $_POST['hire_dateedit']);
$hire_date = date('Y-m-d',strtotime($hire_date));
$roleid = $_POST['roleidedit'];
$lanid = mysqli_real_escape_string($conn, $_POST['lanidedit']);


$sql_UsrProfile = "SELECT id FROM cb_user WHERE email = '$email' AND id NOT IN($id) ";
$result_UsrProfile = $conn->query($sql_UsrProfile);
$UsrProfile_res = $result_UsrProfile->fetch_array();

if ($result_UsrProfile->num_rows > 0) {

  $response2 = array("status" => 400, "status_message" => "Fail"); 
     echo json_encode($response2);  
}else{
    if($Password!=''){
    $sql_update = "UPDATE cb_user SET password='$Password',first_name = '$firstName',last_name = '$lastName',email = '$email',phone = '$Number', state = '$state', city = '$city', zip = '$zip',role_id = $roleid,hire_date='$hire_date',lanid = '$lanid' WHERE id= $id";
}else{
     $sql_update = "UPDATE cb_user SET first_name = '$firstName',last_name = '$lastName',email = '$email',phone = '$Number', state = '$state', city = '$city', zip = '$zip',role_id = $roleid,hire_date='$hire_date',lanid = '$lanid' WHERE id= $id";
   
}
$conn->query($sql_update);

$response = array("status" => 200, "status_message" => "Success"); 
echo json_encode($response);   
}

?>