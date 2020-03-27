<?php 
require 'config.php';
$conn = OpenCon();
if($conn){
	//echo "conected";
}else {
	//echo "Not connected";
}

$user_id = $_POST['user_id'];
$title = $_POST['res_title'];
$desc = $_POST['res_desc'];
$curr_date = date("Y-m-d");
$uploaded_file = $_FILES["fileToUpload"]["name"];

if ($_FILES["fileToUpload"]['tmp_name']!='') {		
		$target_dir = "resources/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if file already exists
		if (file_exists($target_file)) {
			//echo "Sorry, file already exists.";
			$timestamp = date("YmdGis"); 
			$target_file = $target_dir . $timestamp.'-'.$_FILES["fileToUpload"]["name"];
			$uploaded_file = $timestamp.'-'.$_FILES["fileToUpload"]["name"];
		}
}

$sql = "INSERT INTO cb_resources_document (user_id,title, uploaded_date	, description, file_path) VALUES ($user_id,'$title', '$curr_date', '$desc', '$uploaded_file')";

if ($conn->query($sql) === TRUE) {
	if ($_FILES["fileToUpload"]['tmp_name']!='') {		
		
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				//echo "Sorry, there was an error uploading your file.";
			}
		
	}
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 

?>