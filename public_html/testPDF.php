<?php
ob_start();
?>
 <a href="sample.php">Download pdf</a>
<?php
 
require_once('vendor/autoload.php');
// Create an instance of the class:
include_once 'config.php';
$conn = OpenCon();
$userid = '45';
$order_id = '45';
$order_no = '30652285';
$query = "SELECT id FROM cb_front_cover WHERE order_id='$order_no' AND user_id='$userid'";
$result = $conn->query($query);
$rowcount=mysqli_num_rows($result);
//$check_front_cover = $result->fetch_assoc();
//$checklanid = $check_front_cover['reviewerlanid''];
 if($rowcount==1){
    $sql = "SELECT cb_order_new.order_no,cb_order_new.commnets_of_reject,cb_order_new.reject_status,cb_order_new.order_stage,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_user.city,cb_front_cover.project_id,cb_front_cover.dateofreview as created_on,cb_front_cover.reviewcompletiondate,cb_front_cover.order_description as description,cb_front_cover.resp_group,cb_front_cover.division,cb_front_cover.city as city_name,cb_front_cover.cn_29_eligible,cb_front_cover.fc_cm,cb_front_cover.ce_rcm,cb_front_cover.foreman,cb_front_cover.m_c_supervisor,cb_front_cover.distribution_transmission,cb_front_cover.inspector,
cb_project_details.*,qualiflying_five.CN29_in_SAP,qualiflying_five.CN24,qualiflying_five.gas_assets_installed,qualiflying_five.installation_below_ground,qualiflying_five.MOI,qualiflying_five.CN29_in_SAP_cmt,qualiflying_five.CN24_cmt,qualiflying_five.gas_assets_installed_cmt,qualiflying_five.installation_below_ground_cmt,qualiflying_five.MOI_cmt,distribution_checklist.* FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN qualiflying_five ON(qualiflying_five.order_id=cb_order_new.order_no)
INNER JOIN distribution_checklist ON(distribution_checklist.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id = $userid AND cb_order_new.order_no='$order_no'";
 }else{
$sql = "SELECT cb_order_new.*,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_user.city FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
WHERE cb_order_new.user_id = $userid AND cb_order_new.order_no='$order_no'";     
 }
$result = $conn->query($sql);
$row = $result->fetch_assoc();

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


$created_date = date("m-d-Y", strtotime($row[created_on]) );
if($row['reviewcompletiondate']=='0000-00-00'){
   $reviewcompletiondate    =  '';  }else{ 
        
  $reviewcompletiondate = $row['reviewcompletiondate']; 
       
   } 
$mpdf = new \Mpdf\Mpdf();




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

table.frist-table tr td{width:33.33%; margin:10px 5px;}
table.frist-table tr td input{width:100%; display:block;}
td.white-bg{background:#fff; width:200px;  border:1px solid #373737;}
.width100{width:70px;}
.width30{width:30px;}
.white-bg1{background:#fff; width:150px;  border:1px solid #373737;}
.textarea3{height:40px; background:#fff;   word-break: break-all; border:1px solid #373737;}
</style>

<link href="css/print.min">
<div class="wrapper" id="content">
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Cover Sheet</h5>
	<table class="frist-table" cellspacing="5" cellpadding="5">
	<tr>
		<td>Reviewer LANID</td>
		<td class="white-bg">'.$row['lanid'].'</td>
		<td>Order Description</td>	
		<td class="white-bg">'.$row['description'].'</td>
			
	</tr>
	<tr>
		<td>Date of Review</td>
		<td class="white-bg">'.$created_date.'</td>
		<td>FE/CM</td>
		<td class="white-bg">'.$row['fc_cm'].'</td>
	</tr>
	<tr>
		<td>Reviewer Completion Date</td>
		<td class="white-bg">'.$reviewcompletiondate.'</td>
		<td>CE/RCM</td>
		<td class="white-bg">'.$row['ce_rcm'].'</td>
	</tr>
	<tr>
		<td>Order Number</td>
		<td class="white-bg">'.$row['order_no'].'</td>
		<td>Foreman</td>
		<td class="white-bg">'.$row['foreman'].'</td>
	</tr>
	<tr>
		<td>Project ID</td>
		<td class="white-bg">'.$row['project_id'].'</td>
		<td>M&C Supervisor</td>
		<td class="white-bg">'.$row['m_c_supervisor'].'</td>
	</tr>
	<tr>
		<td>Division</td>
		<td class="white-bg">'.$row['division'].'</td>
		<td>Distribution/Transmission</td>
		<td class="white-bg">'.$row['distribution_transmission'].'</td>
	</tr>
	<tr>
		<td>City</td>
		<td class="white-bg">'.$row['city_name'].'</td>
		<td>Resp Group</td>
		<td class="white-bg">'.$row['resp_group'].'</td>
	</tr>
</table>
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Project Details</h5>
<table class="second" width="100%"  cellspacing="5" cellpadding="5">
	<tr>
		<td>MAT</td>
		<td colspan="3" style="background:#fff; border:1px solid #373737;">'.$row['mat'].'</td>	
		<td>'.$MAT_check.'</td>
	</tr>
	<tr>
		<td class="width100">CN24</td>
		<td class="white-bg1">'.$row['cn24'].'</td>
		<td class="white-bg1">'.$row['cn24_lanid'].'</td>
		<td class="white-bg1">'.$row['cn24_date'].'</td>
		<td class="width30">'.$check_cn24.'</td>
	</tr>
	<tr>
		<td class="width100">CN29</td>
		<td class="white-bg1">'.$row['cn29'].'</td>
		<td class="white-bg1">'.$row['cn29_lanid'].'</td>
		<td class="white-bg1">'.$row['cn29_date'].'</td>
		<td class="width30">'.$check_cn29.'</td>
	</tr>
	<tr>
		<td>CN07</td>
		<td class="white-bg1">'.$row['cn07'].'</td>
		<td class="white-bg1">'.$row['cn07_lanid'].'</td>
		<td class="white-bg1">'.$row['cn07_date'].'</td>
		<td class="width30">'.$check_cn07.'</td>
	</tr>
	<tr>
		<td>DC 39</td>
		<td class="white-bg1">'.$row['dc39'].'</td>
		<td class="white-bg1">'.$row['dc39_lanid'].'</td>
		<td class="white-bg1">'.$row['dc39_date'].'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 46</td>
		<td class="white-bg1">'.$row['dc46'].'</td>
		<td class="white-bg1">'.$row['dc46_lanid'].'</td>
		<td class="white-bg1">'.$row['dc46_date'].'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 05</td>
		<td class="white-bg1">'.$row['dc05'].'</td>
		<td class="white-bg1">'.$row['dc05_lanid'].'</td>
		<td class="white-bg1">'.$row['dc05_date'].'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 14</td>
		<td class="white-bg1">'.$row['dc14'].'</td>
		<td class="white-bg1">'.$row['dc14_lanid'].'</td>
		<td class="white-bg1">'.$row['dc14_date'].'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 15</td>
		<td class="white-bg1">'.$row['dc15'].'></td>
		<td class="white-bg1">'.$row['dc15_lanid'].'</td>
		<td class="white-bg1">'.$row['dc15_date'].'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 19</td>
		<td class="white-bg1">'.$row['dc19'].'></td>
		<td class="white-bg1">'.$row['dc19_lanid'].'</td>
		<td class="white-bg1">'.$row['dc19_date'].'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>DC 10</td>
		<td class="white-bg1">'.$row['dc10'].'</td>
		<td class="white-bg1">'.$row['dc10_lanid'].'</td>
		<td class="white-bg1">'.$row['dc10_date'].'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>General comments for SAP task (CN/DC):</td>
		<td colspan="3" style="background:#fff;">	'.$row['cmt_cn_dc'].'</td>
		<td>&nbsp;</td>
	</tr>
</table>
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Qualifying Five</h5>
<table width="100%" class="qf" cellspacing="5" cellpadding="5">
	<tr>
		<td style="width:300px">CN29 completed under Task Tab in SAP or in the Notification Long Text?</td>
		<td style="width:100px;">'.$CN29_in_SAP.'</td>
		<td class="textarea3">'.$row['CN29_in_SAP_cmt'].'</td>
	</tr>
		<tr>
		<td style="width:300px">Has the work been completed ?</td>
		<td style="width:100px;"><input type="text" value="'.$row['CN24'].'" placeholder=""></td>
		<td class="textarea3">'.$row['CN24_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px">Was any gas assets (ex. valve, pipe, Etc.) installed?</td>
		<td style="width:100px;"><input type="text" value="'.$row['gas_assets_installed'].'" placeholder=""></td>
		<td class="textarea3">'.$row['gas_assets_installed_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px">Installation took place below ground?</td>
		<td style="width:100px;"><input type="text" value="'.$row['installation_below_ground'].'" plaecholder=""></td>
		<td class="textarea3">'.$row['installation_below_ground_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px">What is the Method of Installation (MOI)</td>
		<td style="width:100px;"><input type="text" value="'.$row['MOI'].'"  placeholder=""></span></td>
		<td class="textarea3">'.$row['MOI_cmt'].'</td>
	</tr>
</table>
<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Checklist Questions</h5>
<table width="100%" class="qf" cellspacing="5" cellpadding="5">
	<tr>
		<td style="width:300px;">Was Display Notification in SAP Reviewed</td>
		<td style="width:100px;">'.$SAP_Reviewed.'</td>
	<td class="textarea3" style="width:200px;">'.$row['SAP_Reviewed_cmt'].'</td>
	</tr>
		<tr>
		<td style="width:300px;">MOI for Srv (s)?</td>
		<td style="width:100px;"><input type="text" value="'.$row['MOI_for_Srv'].'" placeholder=""></td>
			<td class="textarea3" style="width:200px;">'.$row['MOI_for_Srv_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">MOI for Main (s)?</td>
		<td style="width:100px;"><input type="text" value="'.$row['MOI_for_Main'].'" placeholder=""></td>
	<td class="textarea3" style="width:200px;">'.$row['MOI_for_Main_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">Type of document used to determine the MOI</td>
		<td style="width:100px;"><input type="text" value="'.$row['determine_the_MOI'].'" placeholder=""></td>
	<td class="textarea3" style="width:200px;">'.$row['determine_the_MOI_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">Which software was used to retrieve the document (Ex. Unifier, ECTS, SAP)</td>
	<td style="width:100px;"><input type="text" value="'.$row['used_to_retrieve_the_document'].'" placeholder=""></td>
			<td class="textarea3" style="width:200px;">'.$row['used_to_retrieve_the_document_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">Doc Number From SAP</td>
		<td style="width:100px;"><input type="text" value="'.$row['SAP'].'" placeholder=""></td>
			<td class="textarea3" style="width:200px;">'.$row['SAP_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">PRE- Inspection Document (s) Provided?</td>
	<td style="width:100px;"><input type="text" value="'.$row['PRE_Inspection'].'" placeholder=""></td>
			<td class="textarea3" style="width:200px;">'.$row['PRE_Inspection_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">Post Inspection Required per PRE-Inspection Document (s)?
</td>
		<td style="width:100px;"><input type="text" value="'.$row['Post_Inspection_Required_per_PRE_Inspection'].'" placeholder=""></td>
			<td class="textarea3" style="width:200px;">'.$row['Post_Inspection_Required_per_PRE_Inspection_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">POST- Inspection Document (s) Provided?</td>
		<td style="width:100px;"><input type="text" value="'.$row['POST_Inspection'].'" placeholder=""></td>
			<td class="textarea3" style="width:200px;">'.$row['POST_Inspection_cmt'].'</td>
	</tr>
	<tr>
		<td style="width:300px;">Cross Bore Log (s) Ready for Inspection ?</td>
		<td style="width:100px;"><input type="text" value="'.$row['Cross_Bore_Log'].'" placeholder=""></td>
		<td class="textarea3" style="width:200px;">'.$row['Cross_Bore_Log_cmt'].'</td>
	</tr>
</table>
<br>

</div>

';


  //echo $html;
// Write some HTML code:
   $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
  $mpdf->Output('test.pdf');							

 header("Location: sample.php");

 						?>
                        						 