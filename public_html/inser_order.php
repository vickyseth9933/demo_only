<?php 
echo 'checck='. file_exists('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
require('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
header("Access-Control-Allow-Origin: *");
require 'config.php';
$conn = OpenCon();
if($conn){
	//echo "conected";
}else {
	//echo "Not connected";
}
//insert order data for cross bore 
	
			
			$FileName = 'Cross_Bore_Merger.Flat_File.061319_(1).xlsx';
		
			try {
				$inputFileType = PHPExcel_IOFactory::identify($FileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($FileName);
			} 
				catch(Exception $e) {
				return ('Error loading file "'.pathinfo($FileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}
			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();
			
			$keys = array();
			$results = array();
             
			for ($row = 2; $row <= $highestRow; $row++){ 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,null,true,false);
			//echo print_r($rowData);
			$order_no = isset($rowData[0][0])? $rowData[0][0] : 'N/A';
			$order_desc = isset($rowData[0][1])? $rowData[0][1] : 'N/A';
		 	$order_desc = RemoveSpecialChar($order_desc);
			$order_data = isset($rowData[0][2])? $rowData[0][2] : 'N/A';
			$order_mat = isset($rowData[0][3])? $rowData[0][3] : 'N/A';
			$order_type = isset($rowData[0][4])? $rowData[0][4] : 'N/A';
			$created_on = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(trim($rowData[0][5])));
			$user_status = isset($rowData[0][6])? $rowData[0][6] : 'N/A';
			$cn24 = isset($rowData[0][7])? $rowData[0][7] : 'N/A';
			$cn07 = isset($rowData[0][8])? $rowData[0][8] : 'N/A';
			$cn29 = isset($rowData[0][9])? $rowData[0][9] : 'N/A';
			$cnn29 = isset($rowData[0][10])? $rowData[0][10] : 'N/A';
			$total_dollars = isset($rowData[0][11])? $rowData[0][11] : 'N/A';
			$con_operation = isset($rowData[0][12])? $rowData[0][12] : 'N/A';
			$cn24_comp_by  = isset($rowData[0][13])? $rowData[0][13] : 'N/A';
			$cn07_comp_by  = isset($rowData[0][14])? $rowData[0][14] : 'N/A';
			$partner_cost_center = isset($rowData[0][15])? $rowData[0][15] : 'N/A';
			$Division_Org_Lvl4  = isset($rowData[0][16])? $rowData[0][16] : 'N/A';
			$resp_group = isset($rowData[0][17])? $rowData[0][17] : 'N/A';
			$cn29_on_job = isset($rowData[0][18])? $rowData[0][18] : 'N/A';
			$PROJECTID  =isset($rowData[0][19])? $rowData[0][19] : 'N/A';
			$CITY  =isset($rowData[0][20])? $rowData[0][20] : 'N/A';
			$division  =isset($rowData[0][21])? $rowData[0][21] : 'N/A';
			$TRANS_DIST  =isset($rowData[0][22])? $rowData[0][22] : 'N/A';
			$RESPONSIBLE_GROUP =isset($rowData[0][23])? $rowData[0][23] : 'N/A';
			
			
			
			$FOREMAN  =isset($rowData[0][24])? $rowData[0][24] : 'N/A';
			$FOREMAN_JOB_TITLE =isset($rowData[0][25])? $rowData[0][25] : 'N/A';
	        $FIELD_ENGINEER =isset($rowData[0][26])? $rowData[0][26] : 'N/A';
			$FIELD_ENGINEER_JOB_TITLE =isset($rowData[0][27])? $rowData[0][27] : 'N/A';
			$CONSTRUCTION_MANAGER =isset($rowData[0][28])? $rowData[0][28] : 'N/A';
            $CN24_SAP_DATE=isset($rowData[0][29])? $rowData[0][29] : 'N/A';
            $CN24_BY_SAP=isset($rowData[0][30])? $rowData[0][30] : 'N/A';
            $LOB_GROUP_CN24=isset($rowData[0][31])? $rowData[0][31] : 'N/A';
            $CN24_JOB_TITLE=isset($rowData[0][32])? $rowData[0][32] : 'N/A';
            $CN29_SAP_DATE=isset($rowData[0][33])? $rowData[0][33] : 'N/A';
            $CN29_BY_SAP=isset($rowData[0][34])? $rowData[0][34] : 'N/A';
            $CN07_SAP_DATE=isset($rowData[0][35])? $rowData[0][35] : 'N/A';
            $CN07_BY_SAP=isset($rowData[0][36])? $rowData[0][36] : 'N/A';
            $LOB_GROUP_CN07=isset($rowData[0][37])? $rowData[0][37] : 'N/A';
            $DC39_SAP_DATE=isset($rowData[0][38])? $rowData[0][38] : 'N/A';
            $DC39_BY_SAP=isset($rowData[0][39])? $rowData[0][39] : 'N/A';
            $DC46_SAP_DATE=isset($rowData[0][40])? $rowData[0][40] : 'N/A';
            $DC46_BY_SAP=isset($rowData[0][41])? $rowData[0][41] : 'N/A';
            $DC05_SAP_DATE=isset($rowData[0][42])? $rowData[0][42] : 'N/A';
            $DC05_BY_SAP=isset($rowData[0][43])? $rowData[0][43] : 'N/A';
            $DC14_SAP_DATE=isset($rowData[0][44])? $rowData[0][44] : 'N/A';
            $DC14_BY_SAP=isset($rowData[0][45])? $rowData[0][45] : 'N/A';
            $DC15_SAP_DATE=isset($rowData[0][46])? $rowData[0][46] : 'N/A';
            $DC15_BY_SAP=isset($rowData[0][47])? $rowData[0][47] : 'N/A';
            $DC19_SAP_DATE=isset($rowData[0][48])? $rowData[0][48] : 'N/A';
            $DC19_BY_SAP=isset($rowData[0][49])? $rowData[0][49] : 'N/A';
            $DC10_SAP_DATE=isset($rowData[0][50])? $rowData[0][50] : 'N/A';
            $DC10_BY_SAP=isset($rowData[0][51])? $rowData[0][51] : 'N/A';
            
            
            
			
			$user_id = 24;
			$status = 1;
			
			$sql  = "INSERT INTO cb_order_new (order_no,description, order_data,mat,order_type,created_on,user_status,cn24,cn07,cn29,cn_new29,total_dollars,con_operation,cn24_comp_by,cn07_comp_by,partner_cost_center,division,resp_group,cn29_on_job,user_id,status,TRANS_DIST,RESPONSIBLE_GROUP,FOREMAN,FOREMAN_JOB_TITLE,FIELD_ENGINEER,FIELD_ENGINEER_JOB_TITLE,CONSTRUCTION_MANAGER,CN24_SAP_DATE,CN24_BY_SAP,LOB_GROUP_CN24,CN24_JOB_TITLE,CN29_SAP_DATE,CN29_BY_SAP,CN07_SAP_DATE,CN07_BY_SAP,LOB_GROUP_CN07,DC39_SAP_DATE,DC39_BY_SAP,DC46_SAP_DATE,DC46_BY_SAP,DC05_SAP_DATE,DC05_BY_SAP,DC14_SAP_DATE,DC14_BY_SAP,DC15_SAP_DATE,DC15_BY_SAP,DC19_SAP_DATE,DC19_BY_SAP,DC10_SAP_DATE,DC10_BY_SAP,Division_Org_Lvl4,PROJECTID,CITY) VALUES ('".$order_no."','".$order_desc."','".$order_data."','".$order_mat."','".$order_type."','".$created_on."','".$user_status."','".$cn24."','".$cn07."','".$cn29."','".$cnn29."','".$total_dollars."','".$con_operation."','".$cn24_comp_by."','".$cn07_comp_by."','".$partner_cost_center."','".$division."','".$resp_group."','".$cn29_on_job."','',$status,'".$TRANS_DIST."','".$RESPONSIBLE_GROUP."','".$FOREMAN."','".$FOREMAN_JOB_TITLE."','".$FIELD_ENGINEER."','".$FIELD_ENGINEER_JOB_TITLE."','".$CONSTRUCTION_MANAGER."',	'".$CN24_SAP_DATE."','".$CN24_BY_SAP."','".$LOB_GROUP_CN24."','".$CN24_JOB_TITLE."','".$CN29_SAP_DATE."','".$CN29_BY_SAP."','".$CN07_SAP_DATE."','".$CN07_BY_SAP."','".$LOB_GROUP_CN07."','".$DC39_SAP_DATE."','".$DC39_BY_SAP."','".$DC46_SAP_DATE."','".$DC46_BY_SAP."','".$DC05_SAP_DATE."','".$DC05_BY_SAP."','".$DC14_SAP_DATE."','".$DC14_BY_SAP."','".$DC15_SAP_DATE."','".$DC15_BY_SAP."','".$DC19_SAP_DATE."','".$DC19_BY_SAP."','".$DC10_SAP_DATE."'  ,'".$DC10_BY_SAP."','".$Division_Org_Lvl4."','".$PROJECTID."','".$CITY."')";
			if ($conn->query($sql) === TRUE) {
			    
				$last_inserted_id = $conn->insert_id;
						$sql1  = "INSERT INTO cb_front_cover (status,order_id) VALUES($status,$last_inserted_id)";
					//	$conn->query($sql1);
						$sql2 = "INSERT INTO cb_project_details (order_id) VALUES($last_inserted_id)";
					//	$conn->query($sql2);
						$sql3 = "INSERT INTO cb_order (order_id,form_stage) VALUES($order_no,0)";
						$conn->query($sql3);
						echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			
			
			
			
            
			
			
			
				
			
				
			}
			function RemoveSpecialChar($value){
$result  = preg_replace('/[^a-zA-Z0-9_ -]/s','',$value);
		
return $result;
}
			 
