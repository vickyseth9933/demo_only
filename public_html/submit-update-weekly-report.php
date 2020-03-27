<?php 
require 'config.php';
include 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

$conn = OpenCon();
if($conn){
	//echo "conected";
}else {
	//echo "Not connected";
}


$inputFile = $_FILES['fileToUpload']['tmp_name'];
$inputFileType = PHPExcel_IOFactory::identify($inputFile);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFile);

$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

$column = array();
$index = 0;
for ($row = 2; $row <= $highestRow; $row++){
		// Read a row of data into an array
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
	if(!empty($rowData[0][0])){
		// Insert into array
		$column[$index]['COLUMN_A'] = $rowData[0][0];
		$column[$index]['COLUMN_B'] = "'".mysqli_escape_string($conn, $rowData[0][1])."'";
		$column[$index]['COLUMN_C'] = "'".mysqli_escape_string($conn, $rowData[0][2])."'";
		$UNIX_DATE = ($rowData[0][3] - 25569) * 86400;
		$column[$index]['COLUMN_D'] = isset($rowData[0][3])? "'".gmdate("Y-m-d", $UNIX_DATE)."'" : '0000-00-00';
		
		$index = $index + 1;
	}
};
$sql = "SELECT order_id FROM completed_jobs";
$result = $conn->query($sql);
$ids_array = array();
while($row = $result->fetch_array())
{
    $ids_array[] = $row['order_id'];
}

$values = array();
foreach( $column as $key => $record )
{
    if( in_array( $record['COLUMN_A'], $ids_array ) )
    {
	   $queryupdate = "UPDATE  completed_jobs SET description=$record[COLUMN_B], complete_status=$record[COLUMN_C], complete_date=$record[COLUMN_D] WHERE order_id=$record[COLUMN_A]";
	       $conn->query($queryupdate) or die();
          unset( $column[ $key ] );  
    }else{
        $values[] = "(" . implode(', ', $record) . ")";
    }
}
if(!empty($values)){
     $query = "INSERT INTO completed_jobs (order_id, description, complete_status, complete_date) VALUES ". implode (', ', $values);
	$conn->query($query) or die();
	echo "Records updated";
}else{
	echo "Already up-to-date";
}

?>