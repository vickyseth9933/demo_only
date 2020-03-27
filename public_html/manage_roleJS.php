 <?php
include_once 'config.php';
$conn = OpenCon();
  $formtype = mysqli_real_escape_string($conn, $_POST['form_type']);
  $rolename = mysqli_real_escape_string($conn, $_POST['rolename']);
  $role_name = mysqli_real_escape_string($conn, $_POST['role_name']);
  $roleid = mysqli_real_escape_string($conn, $_POST['editroleid']);
if($formtype=='addrole'){
  $sql = "INSERT INTO user_role(role_type) VALUES ('$rolename')";
$conn->query($sql);
}
if($formtype=='editrole'){
  $sql = "UPDATE  user_role SET role_type='$role_name' WHERE id='$roleid'";
$conn->query($sql);    
}
?>