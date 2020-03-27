<?php
ob_start();
?>
<!--<a href="DownloadPdf.php">Download pdf</a>-->
<?php
 require_once('../../vendor/autoload.php');
// Create an instance of the class:
include_once '../../config.php';
$conn = OpenCon();
if($_GET['id']==''){
$userid =  0;	
}else{
$userid =  $_GET['id'];	
}

  $order_no = $_GET['ono'];
$query = "SELECT id FROM cb_front_cover WHERE order_id='$order_no' AND user_id='$userid'";
$result = $conn->query($query);
$rowcount=mysqli_num_rows($result);
//$check_front_cover = $result->fetch_assoc();
//$checklanid = $check_front_cover['reviewerlanid''];
 if($rowcount==1){
    $sql = "SELECT cb_order_new.user_id,cb_order_new.recommendation,cb_order_new.approved_date,cb_order_new.order_no,cb_order_new.commnets_of_reject,cb_order_new.reject_status,cb_order_new.order_stage,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_user.city,cb_front_cover.project_id,cb_front_cover.dateofreview as created_on,cb_front_cover.reviewcompletiondate,cb_front_cover.order_description as description,cb_front_cover.resp_group as RESPONSIBLE_GROUP,cb_front_cover.division,cb_front_cover.city as CITY,cb_front_cover.cn_29_eligible,cb_front_cover.fc_cm,cb_front_cover.ce_rcm,cb_front_cover.foreman,cb_front_cover.m_c_supervisor,cb_front_cover.distribution_transmission as TRANS_DIST,cb_front_cover.inspector,
cb_project_details.*,qualiflying_five.CN29_in_SAP,qualiflying_five.CN24,qualiflying_five.gas_assets_installed,qualiflying_five.installation_below_ground,qualiflying_five.MOI,qualiflying_five.CN29_in_SAP_cmt,qualiflying_five.CN24_cmt,qualiflying_five.gas_assets_installed_cmt,qualiflying_five.installation_below_ground_cmt,qualiflying_five.MOI_cmt,distribution_checklist.* FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=$order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=$order_no)
INNER JOIN qualiflying_five ON(qualiflying_five.order_id=$order_no)
INNER JOIN distribution_checklist ON(distribution_checklist.order_id=$order_no)
WHERE cb_order_new.user_id = $userid AND cb_order_new.order_no='$order_no'";
 }else{
$sql = "SELECT cb_order_new.*,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_user.city FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
WHERE cb_order_new.user_id = $userid AND cb_order_new.order_no='$order_no'";     
 }
$result = $conn->query($sql);
 //echo  mysqli_num_rows($result);
// exit;
if(mysqli_num_rows($result)>0){
$row = $result->fetch_assoc();	
}else{
  $sql2 = "SELECT completed_jobs.description,completed_jobs.order_id as order_no,completed_jobs.complete_date as created_on,cb_order_new.user_id,completed_jobs.complete_date as approved_date,cb_order_new.recommendation,cb_order_new.commnets_of_reject,cb_order_new.order_stage,cb_order_new.reject_status,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_front_cover.project_id,cb_front_cover.city as CITY,STR_TO_DATE(cb_front_cover.reviewcompletiondate,'mm/dd/YYYY') as reviewcompletiondate,cb_front_cover.resp_group as RESPONSIBLE_GROUP,cb_front_cover.division,cb_front_cover.city as CITY,cb_front_cover.cn_29_eligible,cb_front_cover.fc_cm,cb_front_cover.ce_rcm,cb_front_cover.foreman,cb_front_cover.m_c_supervisor,cb_front_cover.distribution_transmission as TRANS_DIST,cb_front_cover.inspector,
cb_project_details.*,qualiflying_five.CN29_in_SAP,qualiflying_five.CN24,qualiflying_five.gas_assets_installed,qualiflying_five.installation_below_ground,qualiflying_five.MOI,qualiflying_five.CN29_in_SAP_cmt,qualiflying_five.CN24_cmt,qualiflying_five.gas_assets_installed_cmt,qualiflying_five.installation_below_ground_cmt,qualiflying_five.MOI_cmt,distribution_checklist.* FROM completed_jobs 
LEFT  JOIN cb_order_new ON(completed_jobs.order_id=cb_order_new.order_no)
LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=completed_jobs.order_id)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=completed_jobs.order_id)
LEFT JOIN qualiflying_five ON(qualiflying_five.order_id=completed_jobs.order_id)
LEFT JOIN distribution_checklist ON(distribution_checklist.order_id=completed_jobs.order_id)
WHERE  completed_jobs.order_id=$order_no";     

$result2 = $conn->query($sql2);
$row = $result2->fetch_assoc();	

}	
/* echo '<pre>';
print_r($row);
echo '<pre>';
exit; */
$lanid = $row['lanid'];
$order_id = $row['order_no'];

if($row['CN29_in_SAP']=='1'){ $CN29_in_SAP = '<img src="https://epiksolution.org/cross_bore/profile_image/YesIcon.png">';
}else{
   $CN29_in_SAP = '<img src="https://epiksolution.org/cross_bore/profile_image/Noicon.png">';
		}
if($row['SAP_Reviewed']=='1'){ $SAP_Reviewed = '<img src="https://epiksolution.org/cross_bore/profile_image/YesIcon.png">';
}else{
   $SAP_Reviewed = '<img src="https://epiksolution.org/cross_bore/profile_image/Noicon.png">';
		}
if($row['MAT_check']=='true'){ $MAT_check = '<img src="https://epiksolution.org/cross_bore/profile_image/checked.png">';
}else{
   $MAT_check = '<img src="https://epiksolution.org/cross_bore/profile_image/uncheck.png">';
		}
		if($row['CN24_check']=='true'){ $check_cn24 = '<img src="https://epiksolution.org/cross_bore/profile_image/checked.png">';
}else{
   $check_cn24 = '<img src="https://epiksolution.org/cross_bore/profile_image/uncheck.png">';
		}
		if($row['CN29_check']=='true'){ $check_cn29 = '<img src="https://epiksolution.org/cross_bore/profile_image/checked.png">';
}else{
   $check_cn29 = '<img src="https://epiksolution.org/cross_bore/profile_image/uncheck.png">';
		}
		if($row['CN07_check']=='true'){ $check_cn07 = '<img src="https://epiksolution.org/cross_bore/profile_image/checked.png">';
}else{
   $check_cn07 = '<img src="https://epiksolution.org/cross_bore/profile_image/uncheck.png">';
		}


$created_date = date("m/d/Y", strtotime($row['created_on']) );
if($row['approved_date']=='0000-00-00 00:00:00'){
   $reviewcompletiondate    =  '';  }else{ 
        
  $reviewcompletiondatecheck = date("m/d/Y", strtotime($row['approved_date'])); 
  if($reviewcompletiondatecheck=='01/01/1970'){
	$reviewcompletiondate =   '';
  }else{
	$reviewcompletiondate =   date("m/d/Y", strtotime($row['approved_date']));  
  }
       
   } 
   
$mpdf = new \Mpdf\Mpdf();

//print_r($row);
//die();


$html = '';

 $html = $html . ' <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
<style>

body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff;
}
.wrapper{max-width:1067px; margin:0px auto;}
   table{ background: #ddd;
    border-top: 4px solid #3f93b1; padding:15px;}
	table tr td {
    padding: 5px;
    font-size: 11px; vertical-align:top;
}
input[type="text"] {
    background: #fff;
    height:80px;
    padding: 7px;
}
.bg-white {
    background: #fff;
width:200px;
    border: none;
overflow-wrap: break-word;
  word-wrap: break-word;
  hyphens: auto;
	height:40px; display:block;    margin-bottom: 10px;
}
input[type="checkbox"] {
    width: 18px;
    height: 18px;
}
input[type="radio"]{
    width: 16px;
    height: 17px;
    vertical-align: middle;
    margin: 0;
    margin: 0px 5px;
}
.font-strong {
     font-weight: 500;
    position: relative;
    font-size: 1.25rem;
    margin: 0;
    padding: 0;
    margin: 8px 0;
}
.font-strong.formheadingdiv01:before {
background: #007098;
    color: #fff;
    content: "i";
    border-radius: 100px;
    text-align: center;
    vertical-align: middle;
    display: inline-block;
    margin: 0px 10px 0px 0px;
    width: 30px;
    height: 30px;
}

table.qf tr td:first-child {
    width: 360px;
}
table.qf tr td:nth-child(2) {
    width: 150px;
}


table.frist-table tr td{ margin:10px 5px;}
table.frist-table tr td input{width:100%; display:block;}
td.white-bg{background:#fff; width:200px;  border:1px solid #373737;}
.width100{width:70px;}
.width30{width:30px;}
.white-bg1{background:#fff; width:150px;  border:1px solid #373737;}
.textarea3{height:40px; background:#fff;   word-break: break-all; border:1px solid #373737;}
.qf tr td.bg-ro { background:#fff; border:1px solid #373737; width:100px;}

</style>

<link href="css/print.min">
<div class="wrapper" id="content">
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Cover Sheet</h5>
	<table class="frist-table" cellspacing="5" cellpadding="5">
	<tr>
		<td>Reviewer LANID</td>
		<td class="white-bg">'.htmlentities($row['lanid'], ENT_QUOTES).'</td>
		<td>Order Description</td>	
		<td class="white-bg">'.htmlentities($row['description'], ENT_QUOTES).'</td>
			
	</tr>
	<tr>
		<td>Date of Review</td>
		<td class="white-bg">'.$created_date.'</td>
		<td>FE/CM</td>
		<td class="white-bg">'.htmlentities($row['fc_cm'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td>Reviewer Completion Date</td>
		<td class="white-bg">'.$reviewcompletiondate.'</td>
		<td>CE/RCM</td>
		<td class="white-bg">'.htmlentities($row['ce_rcm'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td>Order Number</td>
		<td class="white-bg">'.htmlentities($row['order_no'], ENT_QUOTES).'</td>
		<td>Foreman</td>
		<td class="white-bg">'.htmlentities($row['foreman'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td>Project ID</td>
		<td class="white-bg">'.htmlentities($row['project_id'], ENT_QUOTES).'</td>
		<td>M&C Supervisor</td>
		<td class="white-bg">'.htmlentities($row['m_c_supervisor'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td>Division</td>
		<td class="white-bg">'.htmlentities($row['division'], ENT_QUOTES).'</td>
		<td>Distribution/Transmission</td>
		<td class="white-bg">'.$row['TRANS_DIST'].'</td>
	</tr>
	<tr>
		<td>City</td>
		<td class="white-bg">'.htmlentities($row['CITY'], ENT_QUOTES).'</td>
		<td>Resp Group</td>
		<td class="white-bg">'.htmlentities($row['RESPONSIBLE_GROUP'], ENT_QUOTES).'</td>
	</tr>
</table>
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Project Details</h5>
<table class="second" width="100%"  cellspacing="5" cellpadding="5">
	<tr>
		<td>MAT</td>
		<td colspan="3" style="background:#fff; border:1px solid #373737;">'.htmlentities($row['mat'], ENT_QUOTES).'</td>	
		<td>'.$MAT_check.'</td>
	</tr>
	<tr>
		<td class="width100">CN24</td>
		<td class="white-bg1">'.$row['cn24'].'</td>
		<td class="white-bg1">'.htmlentities($row['cn24_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['cn24_date'], ENT_QUOTES).'</td>
		<td class="width30">'.$check_cn24.'</td>
	</tr>
	<tr>
		<td class="width100">CN29</td>
		<td class="white-bg1">'.$row['cn29'].'</td>
		<td class="white-bg1">'.htmlentities($row['cn29_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['cn29_date'], ENT_QUOTES).'</td>
		<td class="width30">'.$check_cn29.'</td>
	</tr>
	<tr>
		<td>CN07</td>
		<td class="white-bg1">'.$row['cn07'].'</td>
		<td class="white-bg1">'.htmlentities($row['cn07_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['cn07_date'], ENT_QUOTES).'</td>
		<td class="width30">'.$check_cn07.'</td>
	</tr>
	<tr>
		<td>DC 39</td>
		<td class="white-bg1">'.$row['dc39'].'</td>
		<td class="white-bg1">'.htmlentities($row['dc39_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['dc39_date'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 46</td>
		<td class="white-bg1">'.$row['dc46'].'</td>
		<td class="white-bg1">'.htmlentities($row['dc46_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['dc46_date'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 05</td>
		<td class="white-bg1">'.$row['dc05'].'</td>
		<td class="white-bg1">'.htmlentities($row['dc05_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['dc05_date'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 14</td>
		<td class="white-bg1">'.$row['dc14'].'</td>
		<td class="white-bg1">'.htmlentities($row['dc14_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['dc14_date'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 15</td>
		<td class="white-bg1">'.$row['dc15'].'</td>
		<td class="white-bg1">'.htmlentities($row['dc15_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['dc15_date'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 19</td>
		<td class="white-bg1">'.$row['dc19'].'</td>
		<td class="white-bg1">'.htmlentities($row['dc19_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['dc19_date'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 10</td>
		<td class="white-bg1">'.$row['dc10'].'</td>
		<td class="white-bg1">'.htmlentities($row['dc10_lanid'], ENT_QUOTES).'</td>
		<td class="white-bg1">'.htmlentities($row['dc10_date'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>General comments for SAP task (CN/DC):</td>
		<td colspan="3" style="background:#fff;">	'.htmlentities($row['cmt_cn_dc'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
</table>
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Qualifying Five</h5>
<table width="100%" class="qf" cellspacing="5" cellpadding="5">
	<tr>
		<td style="width:300px">CN29 completed under Task Tab in SAP or in the Notification Long Text?</td>
		<td style="width:100px;">'.$CN29_in_SAP.'</td>
		<td class="textarea3">'.htmlentities($row['CN29_in_SAP_cmt'], ENT_QUOTES).'</td>
	</tr>';
		if($row['CN29_in_SAP']=='0'){	 
	$html = $html . ' 
		<tr>
		<td style="width:300px">Has the work been completed ?</td>
		<td class="bg-ro">'.$row['CN24'].'</td>
		<td class="textarea3">'.htmlentities($row['CN24_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px">Was any gas assets (ex. valve, pipe, Etc.) installed?</td>
		<td class="bg-ro">'.$row['gas_assets_installed'].'</td>
		<td class="textarea3">'.htmlentities($row['gas_assets_installed_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px">Installation took place below ground?</td>
		<td class="bg-ro">'.$row['installation_below_ground'].'</td>
		<td class="textarea3">'.htmlentities($row['installation_below_ground_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px">What is the Method of Installation (MOI)</td>
		<td class="bg-ro">'.$row['MOI'].'</span></td>
		<td class="textarea3">'.htmlentities($row['MOI_cmt'], ENT_QUOTES).'</td>
	</tr>';
	}
$html = $html . '</table>
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Checklist Questions</h5>
<table width="100%" class="qf" cellspacing="5" cellpadding="5">
	<tr>
		<td style="width:300px;">Was Display Notification in SAP Reviewed</td>
		<td>'.$SAP_Reviewed.'</td>
	<td class="textarea3" style="width:200px;">'.htmlentities($row['SAP_Reviewed_cmt'], ENT_QUOTES).'</td>
	</tr>
		<tr>
		<td style="width:300px;">MOI for Srv (s)?</td>
		<td class="bg-ro">'.$row['MOI_for_Srv'].'</td>
			<td class="textarea3" style="width:200px;">'.htmlentities($row['MOI_for_Srv_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">MOI for Main (s)?</td>
		<td class="bg-ro">'.$row['MOI_for_Main'].'</td>
	<td class="textarea3" style="width:200px;">'.htmlentities($row['MOI_for_Main_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Type of document used to determine the MOI</td>
		<td class="bg-ro">'.$row['determine_the_MOI'].'</td>
	<td class="textarea3" style="width:200px;">'.htmlentities($row['determine_the_MOI_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Which software was used to retrieve the document (Ex. Unifier, ECTS, SAP)</td>
	<td class="bg-ro">'.$row['used_to_retrieve_the_document'].'</td>
			<td class="textarea3" style="width:200px;">'.htmlentities($row['used_to_retrieve_the_document_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Doc Number From SAP</td>
		<td class="bg-ro">'.htmlentities($row['SAP'], ENT_QUOTES).'</td>
			<td class="textarea3" style="width:200px;">'.htmlentities($row['SAP_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">PRE- Inspection Document (s) Provided?</td>
	<td class="bg-ro">'.$row['PRE_Inspection'].'</td>
			<td class="textarea3" style="width:200px;">'.htmlentities($row['PRE_Inspection_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Post Inspection Required per PRE-Inspection Document (s)?
</td>
		<td class="bg-ro">'.$row['Post_Inspection_Required_per_PRE_Inspection'].'</td>
			<td class="textarea3" style="width:200px;">'.htmlentities($row['Post_Inspection_Required_per_PRE_Inspection_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">POST- Inspection Document (s) Provided?</td>
		<td class="bg-ro">'.$row['POST_Inspection'].'</td>
			<td class="textarea3" style="width:200px;">'.htmlentities($row['POST_Inspection_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Cross Bore Log (s) Ready for Inspection ?</td>
		<td class="bg-ro">'.$row['Cross_Bore_Log'].'</td>
		<td class="textarea3" style="width:200px;">'.htmlentities($row['Cross_Bore_Log_cmt'], ENT_QUOTES).'</td>
	</tr>
		<tr>
		<td>Recommendation:</td>
		<td colspan="3" style="background:#fff; border:1px solid #373737;">	'.htmlentities($row['recommendation'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>';
	  if($row['order_stage']=='7' && $row['reject_status']=='1'){	 
	$html = $html . ' <tr>
		<td>Reason for reject</td>
		<td colspan="3" style="background:#fff; border:1px solid #373737;">	'.htmlentities($row['commnets_of_reject'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>';
	  }
$html = $html . ' </table>
<br>

</div>

';

$filename = $order_no.'.pdf';
  //echo $html;
// Write some HTML code:
   $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
//$mpdf->Output('ViewPDF.pdf');							
$mpdf->Output($filename,'D'); 
 //header("Location: DownloadPdf.php");
 						?>
 						<script>
 					 	//    window.location.href="DownloadPdf.php";
 						    </script>