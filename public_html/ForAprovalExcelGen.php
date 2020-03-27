<?php 
error_reporting(E_ALL); 
ini_set('display_errors', 1);
 include_once 'config.php';
include 'PHPExcel-1.8/Classes/PHPExcel.php';
$conn = OpenCon();


//  $sql = "SELECT cb_order_new.order_no,cb_order_new.order_stage,cb_front_cover.order_description as description,
// cb_user.first_name,cb_user.last_name,DATE_FORMAT(cb_order_new.approved_date,'%m/%d/%Y'),cb_user.lanid,cb_order_new.total_dollars,cb_front_cover.project_id,DATE_FORMAT(cb_front_cover.dateofreview,'%m/%d/%Y') as created_on,DATE_FORMAT(cb_order_new.approved_date,'%m/%d/%Y') as reviewcompletiondate,cb_front_cover.resp_group,cb_front_cover.division,cb_front_cover.city as city_name,cb_front_cover.cn_29_eligible,cb_front_cover.fc_cm,cb_front_cover.ce_rcm,cb_front_cover.foreman,cb_front_cover.m_c_supervisor,cb_front_cover.distribution_transmission,cb_front_cover.inspector,
// cb_project_details.*,qualiflying_five.CN29_in_SAP,qualiflying_five.CN24,qualiflying_five.gas_assets_installed,qualiflying_five.installation_below_ground,qualiflying_five.MOI,qualiflying_five.CN29_in_SAP_cmt,qualiflying_five.CN24_cmt,qualiflying_five.gas_assets_installed_cmt,qualiflying_five.installation_below_ground_cmt,qualiflying_five.MOI_cmt,distribution_checklist.*,order_status.order_name as JobStatus FROM cb_order_new 
// INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
// INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
// LEFT JOIN order_status ON(order_status.id=cb_order.status)
// LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
// LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
// LEFT JOIN qualiflying_five ON(qualiflying_five.order_id=cb_order_new.order_no)
// LEFT JOIN distribution_checklist ON(distribution_checklist.order_id=cb_order_new.order_no)
// WHERE cb_order_new.order_stage NOT IN(5) ORDER BY cb_order_new.order_no"; 


$sql = "SELECT cb_order_new.order_no,order_status.order_name as JobStatus,IFNULL(cb_front_cover.order_description,cb_order_new.description) as description,cb_order_new.order_type,IFNULL(DATE_FORMAT(cb_front_cover.dateofreview,'%m/%d/%Y'),DATE_FORMAT(cb_order_new.created_on,'%m/%d/%Y')) as created_on,cb_order_new.user_status,
cb_order_new.total_dollars,cb_user.first_name,cb_user.last_name,DATE_FORMAT(cb_order_new.approved_date,'%m/%d/%Y'),cb_user.lanid,cb_front_cover.project_id,DATE_FORMAT(cb_order_new.approved_date,'%m/%d/%Y') as reviewcompletiondate,IFNULL(cb_front_cover.resp_group,cb_order_new.RESPONSIBLE_GROUP) as resp_group,cb_front_cover.division,IFNULL(cb_front_cover.city,cb_order_new.CITY) as city_name,cb_front_cover.cn_29_eligible,cb_front_cover.fc_cm,cb_front_cover.ce_rcm,cb_front_cover.foreman,cb_order_new.FOREMAN_JOB_TITLE,cb_order_new.FIELD_ENGINEER,cb_order_new.FIELD_ENGINEER_JOB_TITLE,cb_order_new.CONSTRUCTION_MANAGER,
DATE_FORMAT(cb_order_new.CN24_SAP_DATE,'%m/%d/%Y'),cb_order_new.CN24_BY_SAP,cb_order_new.LOB_GROUP_CN24,cb_order_new.CN24_JOB_TITLE,DATE_FORMAT(cb_order_new.CN29_SAP_DATE,'%m/%d/%Y'),cb_order_new.CN29_BY_SAP,
DATE_FORMAT(cb_order_new.CN07_SAP_DATE,'%m/%d/%Y'),cb_order_new.CN07_BY_SAP,cb_order_new.LOB_GROUP_CN07,
DATE_FORMAT(cb_order_new.DC39_SAP_DATE,'%m/%d/%Y'),DATE_FORMAT(cb_order_new.DC39_BY_SAP,'%m/%d/%Y'),DATE_FORMAT(cb_order_new.DC46_SAP_DATE,'%m/%d/%Y'),
cb_order_new.DC46_BY_SAP,DATE_FORMAT(cb_order_new.DC05_SAP_DATE,'%m/%d/%Y'),cb_order_new.DC05_BY_SAP,
DATE_FORMAT(cb_order_new.DC14_SAP_DATE,'%m/%d/%Y'),cb_order_new.DC14_BY_SAP,DATE_FORMAT(cb_order_new.DC15_SAP_DATE,'%m/%d/%Y'),cb_order_new.DC15_BY_SAP,
DATE_FORMAT(cb_order_new.DC19_SAP_DATE,'%m/%d/%Y'),cb_order_new.DC19_BY_SAP,DATE_FORMAT(cb_order_new.DC10_SAP_DATE,'%m/%d/%Y'),cb_order_new.DC10_BY_SAP,
cb_front_cover.m_c_supervisor,IFNULL(cb_front_cover.distribution_transmission,cb_order_new.TRANS_DIST),cb_front_cover.inspector,
cb_project_details.id,
cb_project_details.user_id,
cb_project_details.status,
cb_project_details.job_status,
cb_project_details.order_id,
IFNULL(cb_project_details.mat,cb_order_new.mat),
cb_project_details.cn24,
cb_project_details.cn24_lanid,
cb_project_details.cn24_date,
cb_project_details.cn29,
cb_project_details.cn29_lanid,
cb_project_details.cn29_date,
cb_project_details.cn07,
cb_project_details.cn07_lanid,
cb_project_details.cn07_date,
cb_project_details.dc39,
cb_project_details.dc39_lanid,
cb_project_details.dc39_date,
cb_project_details.dc05,
cb_project_details.dc05_lanid,
cb_project_details.dc05_date,
cb_project_details.dc14,
cb_project_details.dc14_lanid,
cb_project_details.dc14_date,
cb_project_details.dc15,
cb_project_details.dc15_lanid,
cb_project_details.dc15_date,
cb_project_details.dc19,
cb_project_details.dc19_lanid,
cb_project_details.dc19_date,
cb_project_details.dc10,
cb_project_details.dc10_lanid,
cb_project_details.dc10_date,
cb_project_details.dc36,
cb_project_details.dc36_lanid,
cb_project_details.dc36_date,
cb_project_details.dc46,
cb_project_details.dc46_lanid,
cb_project_details.dc46_date,
cb_project_details.cmt_cn_dc,
cb_project_details.MAT_check,
cb_project_details.CN24_check,
cb_project_details.CN29_check,
cb_project_details.CN07_check,qualiflying_five.CN29_in_SAP,qualiflying_five.CN24,qualiflying_five.gas_assets_installed,qualiflying_five.installation_below_ground,qualiflying_five.MOI,qualiflying_five.CN29_in_SAP_cmt,qualiflying_five.CN24_cmt,qualiflying_five.gas_assets_installed_cmt,qualiflying_five.installation_below_ground_cmt,qualiflying_five.MOI_cmt,distribution_checklist.cn_29_completed,distribution_checklist.SAP_Reviewed,distribution_checklist.SAP_Reviewed_cmt,distribution_checklist.MOI_for_Srv,
distribution_checklist.MOI_for_Srv_cmt,distribution_checklist.MOI_for_Main,distribution_checklist.MOI_for_Main_cmt,
distribution_checklist.determine_the_MOI,distribution_checklist.determine_the_MOI_cmt,distribution_checklist.SAP,
distribution_checklist.SAP_cmt,distribution_checklist.PRE_Inspection,distribution_checklist.PRE_Inspection_cmt,
distribution_checklist.Post_Inspection_Required_per_PRE_Inspection,distribution_checklist.Post_Inspection_Required_per_PRE_Inspection_cmt,
distribution_checklist.POST_Inspection,distribution_checklist.POST_Inspection_cmt,distribution_checklist.used_to_retrieve_the_document,
distribution_checklist.used_to_retrieve_the_document_cmt,distribution_checklist.Cross_Bore_Log,distribution_checklist.Cross_Bore_Log_cmt,DATE_FORMAT(cb_order_new.date_of_submission,'%m/%d/%Y') FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
LEFT JOIN order_status ON(order_status.id=cb_order.status)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
LEFT JOIN qualiflying_five ON(qualiflying_five.order_id=cb_order_new.order_no)
LEFT JOIN distribution_checklist ON(distribution_checklist.order_id=cb_order_new.order_no)
WHERE cb_order_new.order_stage = 5 ORDER BY cb_order_new.order_no";




$objPHPExcel = new PHPExcel();
$inputFileName = 'gen_excelnew.xlsx';
	
try {
	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
	return ('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
$sheet = $objPHPExcel->getSheet(0); 

$columnIdsArray = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV');
foreach($columnIdsArray as $colId) {
	$sheet->getColumnDimension($colId)
			->setWidth(25);
}


/*$styleArray =  array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'E05CC2'));*/
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 10,
        'name'  => 'Arial'
    ));
$styleArray2 = array(
        'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
            /* 'borders' => array(
    'outline' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )*/
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'FFFFFF')
                )
            ),
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size'  => 10,
                'name'  => 'Arial'
        ));	
    
$rowCount = 0;  
$sheet->setCellValue("A1", "Order No")
    ->setCellValue("B1", "Job Status")
    ->setCellValue("C1", "Order Description")
    ->setCellValue("D1", "Order Type")
    ->setCellValue("E1", "Created on")
    ->setCellValue("F1", "User Status")
    ->setCellValue("G1", "Total Dollars")
	->setCellValue("H1", "First Name")
	->setCellValue("I1", "Last Name")
	->setCellValue("J1", "Approved Date")
	->setCellValue("K1", "LANId")
	->setCellValue("L1", "PROJECT ID")
	->setCellValue("M1", "Review Completion Date")
	->setCellValue("N1", "RESPONSIBLE GROUP")
	->setCellValue("O1", "DIVISION")
	->setCellValue("P1", "CITY")
	->setCellValue("Q1", "CN29 Eligible")
	->setCellValue("R1", "FC CM")
	->setCellValue("S1", "CE RCM")
	->setCellValue("T1", "FOREMAN")
	->setCellValue("U1", "FOREMAN JOB TITLE")
	->setCellValue("V1", "FIELD ENGINEER")
	->setCellValue("W1", "FIELD ENGINEER JOB TITLE")
	->setCellValue("X1", "CONSTRUCTION MANAGER")
	->setCellValue("Y1", "CN24 SAP DATE")
	->setCellValue("Z1", "CN24 BY SAP")
	->setCellValue("AA1", "LOB GROUP CN24")
	->setCellValue("AB1", "CN24 JOB TITLE")
	->setCellValue("AC1", "CN29 SAP")
	->setCellValue("AD1", "CN29 BY SAP")
	->setCellValue("AE1", "CN07 SAP")
	->setCellValue("AF1", "CN07 BY SAP")
	->setCellValue("AG1", "LOB GROUP CN07")
	->setCellValue("AH1", "DC39 SAP")
	->setCellValue("AI1", "DC39 BY SAP")
	->setCellValue("AJ1", "DC46 SAP")

	->setCellValue("AK1", "DC46 BY SAP")
	->setCellValue("AL1", "DC05 SAP DATE")
	->setCellValue("AM1", "DC05 BY SAP")
	
	->setCellValue("AN1", "DC14 SAP DATE")
	->setCellValue("AO1", "DC14 BY SAP")
	
	->setCellValue("AP1", "DC15 SAP DATE")
	->setCellValue("AQ1", "DC15 BY SAP")
	
	->setCellValue("AR1", "DC19 SAP DATE")
	->setCellValue("AS1", "DC19 BY SAP")
	
	->setCellValue("AT1", "DC10 SAP DATE")
	->setCellValue("AU1", "DC10 BY SAP")
	
	
	

	
	->setCellValue("AV1", "M C supervisor")
	->setCellValue("AW1", "Distribution Transmission")
	->setCellValue("AX1", "Inspector")
	->setCellValue("AY1", "ID")
	->setCellValue("AZ1", "user_id")
	->setCellValue("BA1", "Status")
	->setCellValue("BB1", "Job Status")
	->setCellValue("BC1", "Order_id")
	->setCellValue("BD1", "MAT")
	->setCellValue("BE1", "CN24")
	->setCellValue("BF1", "CN24 LAN ID")
	->setCellValue("BG1", "CN24 Date")
	->setCellValue("BH1", "CN29")
	->setCellValue("BI1", "CN29 LAN ID")
	->setCellValue("BJ1", "CN29_date")
	->setCellValue("BK1", "CN07")
	->setCellValue("BL1", "CN07 LAN ID")
	->setCellValue("BM1", "CN07 Date")
	->setCellValue("BN1", "DC39")
	->setCellValue("BO1", "DC39 LAN ID")
	->setCellValue("BP1", "DC39 Date")
	->setCellValue("BQ1", "DC05")
	->setCellValue("BR1", "DC05 LAN ID")
	->setCellValue("BS1", "DC05 Date")
	->setCellValue("BT1", "DC14")
	->setCellValue("BU1", "DC14 LAN ID")
	->setCellValue("BV1", "DC14 Date")
	->setCellValue("BW1", "DC15")
	->setCellValue("BX1", "DC15 LAN ID")
	->setCellValue("BY1", "DC15 Date")
	->setCellValue("BZ1", "DC19")
	->setCellValue("CA1", "DC19 LAN ID")
	->setCellValue("CB1", "DC19 Date")
	->setCellValue("CC1", "DC10")
	->setCellValue("CD1", "DC10 LAN ID")
	->setCellValue("CE1", "DC10 Date")
	->setCellValue("CF1", "DC36")
	->setCellValue("CG1", "DC36 LAN ID")
	->setCellValue("CH1", "DC36 Date")
	->setCellValue("CI1", "DC46")
	->setCellValue("CJ1", "DC46 LAN ID")
	->setCellValue("CK1", "DC46 Date")
	->setCellValue("CL1", "CMT_CN_DC")
	->setCellValue("CM1", "MAT Check")
	->setCellValue("CN1", "CN24 CHECK")
	->setCellValue("CO1", "CN29 CHECK")
	->setCellValue("CP1", "CN07 CHECK")
	->setCellValue("CQ1", "CN29_in_SAP")
	->setCellValue("CR1", "CN24")
	->setCellValue("CS1", "Gas Assets Installed")
	->setCellValue("CT1", "Installation Below Ground")
	->setCellValue("CU1", "MOI")
	->setCellValue("CV1", "CN29 In SAP Comment")
	->setCellValue("CW1", "CN24 Comment")
	->setCellValue("CX1", "Gas Assets Installed Comment")
	->setCellValue("CY1", "Installation Below Ground Comment")
	->setCellValue("CZ1", "MOI Comment")
	->setCellValue("DA1", "CN29 Completed")
	->setCellValue("DB1", "SAP Reviewed")
	->setCellValue("DC1", "SAP Reviewed Comment")
	->setCellValue("DD1", "MOI For Server")
	->setCellValue("DE1", "MOI For Server Comment")
	->setCellValue("DF1", "MOI For Main")
	->setCellValue("DG1", "MOI For Main Comment")
	->setCellValue("DH1", "Determine The MOI")
	->setCellValue("DI1", "Determine The MOI Comment")
	->setCellValue("DJ1", "SAP")
	->setCellValue("DK1", "SAP Comment")
	->setCellValue("DL1", "PRE Inspection")
	->setCellValue("DM1", "PRE Inspection Comment")
	->setCellValue("DN1", "Post Inspection Required Per PRE Inspection")
	->setCellValue("DO1", "Post_Inspection Required Per PRE Inspection Comment")
	->setCellValue("DP1", "POST Inspection")
	->setCellValue("DQ1", "POST Inspection Comment")
	->setCellValue("DR1", "Used To Retrieve The Document")
	->setCellValue("DS1", "Used To Retrieve The Document Comment")
	->setCellValue("DT1", "Cross Bore Log")
	->setCellValue("DU1", "Cross Bore Log Comment")
	->setCellValue("DV1", "Date of submission");
	
	$sheet->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('4169e1');

	$sheet->getStyle('I1:DW1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFA500');
	
	$sheet->getStyle('A1:DW1')->applyFromArray($styleArray2);


$column = 'A';
$rowCount = 2;  
if ($result = $conn->query($sql)) {

    $field_cnt = $result->field_count;
	while($row = $result->fetch_array())
	{
		$column = 'A';
		$field_cnt = $result->field_count;
			for($j=0; $j<$field_cnt;$j++)  
			{ 
				// if(!isset($row[$j]))  

				// 	$value = NULL;  

				// elseif($row[$j] != "")  

					
                    
                 
                    
					

				// else  

				//	$value = "";  
				if($j == 94 || $j == 105 || $j == 9 || $j == 12 || $j == 61 || $j == 64 || $j == 104){
                           if($row[$j] == 1){
                               $value = 'Yes';
                           }
                           if($row[$j] == 0) {
                                $value = 'No';
                           }
			       	   if($row[$j] == '00/00/0000') {
                                $value = '';
                           }
                           if($row[$j] == '0000-00-00') {
                                $value = '';
                           }
                         
                    } else {
                        $value = strip_tags($row[$j]);  
                    }
                    
// if($j == 9 || $j == 12){
//                           if($row[$j] == '00/00/0000'){
//                               $value = '';
//                           } elseif($row[$j] == '') {
//                                 $value = '';
//                           } else {
//                                 $value = strip_tags($row[$j]);  
//                           }
//                     } else {
//                         $value = strip_tags($row[$j]);  
//                     }   
				$sheet->setCellValue($column.$rowCount, $value);
				$column++;
			}  

		$rowCount++;
	}

    
}
for($j=0; $j<$rowCount;$j++)  
			{ 
				if ($j % 2 == 0) {
						$sheet->getStyle('A' . $j . ':L' . $j)->applyFromArray(
							array(
								'fill' => array(
									'type' => \PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'CCCCFF')
								),
							)
						);
				}
				
				if(!isset($row[$j]))  

					$value = NULL;  

				elseif($row[$j] != "")  

					$value = strip_tags($row[$j]);  

				else  

					$value = "";  


				$sheet->setCellValue($column.$rowCount, $value);
				$column++;
			}
//DDDDDD
$rowCountvar = $rowCount-1;
$sheet->getStyle('I2' . ':DV' . $rowCountvar)->applyFromArray(
					array(
						'fill' => array(
							'type' => \PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'FFE4B5')
						),
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('rgb' => 'FFFFCC')
						)
						)	
					)); 



$todaydate = date('is');
$filename = "JobStatus".$todaydate.".xls"; // File Name
// Download file

header('Content-Type: application/vnd.ms-excel'); 
header("Content-Disposition: attachment; filename=\"$filename\"");
//header('Content-Disposition: attachment;filename="gen_excel.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');