 <?php
include_once 'config.php';
$conn = OpenCon();
$id = $_POST['id'];
$sql_data = "SELECT * FROM user_role WHERE id = $id";
$result = $conn->query($sql_data);
$data = $result->fetch_assoc();

$res = json_encode($data);
echo $res;
?>