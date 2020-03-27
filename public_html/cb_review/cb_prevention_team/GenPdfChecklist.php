<?php
ob_start();
?>
 <!--<a href="sample.php">Download pdf</a>-->
<?php
 
require_once('../../vendor/autoload.php');
// Create an instance of the class:
include_once '../../config.php';
$conn = OpenCon();
$userid = $_GET['id'];
$order_id = $_GET['id'];
$order_no = $_GET['ono'];

     $sql = "SELECT distribution_checklist.*,cb_order_new.recommendation FROM distribution_checklist 
   INNER JOIN cb_order_new as cb_order_new ON cb_order_new.order_no = $order_no 
   WHERE order_id='$order_no'";
 
$result = $conn->query($sql);
$row = $result->fetch_assoc();


$lanid = $row['lanid'];
$order_id = $row['order_no'];

if($row['SAP_Reviewed']=='1'){ $SAP_Reviewed = '<img src="https://epiksolution.org/cross_bore/profile_image/YesIcon.png">';
}else{
   $SAP_Reviewed = '<img src="https://epiksolution.org/cross_bore/profile_image/Noicon.png">';
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

<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Checklist Questions</h5>
<table width="100%" class="qf" cellspacing="5" cellpadding="5">
	<tr>
		<td>Recommendation</td>
		<td colspan="3" style="background:#fff; border:1px solid #373737;">	'.htmlentities($row['recommendation'], ENT_QUOTES).'</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="width:300px;">Order Number</td>
		<td class=""></td>
	<td class="textarea3" style="width:150px;">'.$order_no.'</td>
	</tr>
	<tr>
		<td style="width:300px;">Was Display Notification in SAP Reviewed</td>
	<td>'.$SAP_Reviewed.'</td>
	<td class="textarea3" style="width:150px;">'.htmlentities($row['SAP_Reviewed_cmt'], ENT_QUOTES).'</td>
	</tr>
		<tr>
		<td style="width:300px;">MOI for Srv (s)?</td>
		<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['MOI_for_Srv'].'</td>
			<td class="textarea3" style="width:150px;">'.htmlentities($row['MOI_for_Srv_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">MOI for Main (s)?</td>
	<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['MOI_for_Main'].'</td>
	<td class="textarea3" style="width:150px;">'.htmlentities($row['MOI_for_Main_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Type of document used to determine the MOI</td>
		<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['determine_the_MOI'].'
		</td>
	<td class="textarea3" style="width:150px;">'.htmlentities($row['determine_the_MOI_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Which software was used to retrieve the document (Ex. Unifier, ECTS, SAP)</td>
	<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['used_to_retrieve_the_document'].'</td>
			<td class="textarea3" style="width:150px;">'.htmlentities($row['used_to_retrieve_the_document_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Doc Number From SAP</td>
		<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['SAP'].'</td>
			<td class="textarea3" style="width:150px;">'.htmlentities($row['SAP_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">PRE- Inspection Document (s) Provided?</td>
<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['PRE_Inspection'].'</td>
			<td class="textarea3" style="width:150px;">'.htmlentities($row['PRE_Inspection_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Post Inspection Required per PRE-Inspection Document (s)?
</td>
	<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['Post_Inspection_Required_per_PRE_Inspection'].'</td>
			<td class="textarea3" style="width:150px;">'.htmlentities($row['Post_Inspection_Required_per_PRE_Inspection_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">POST- Inspection Document (s) Provided?</td>
		<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['POST_Inspection'].'</td>
			<td class="textarea3" style="width:150px;">'.htmlentities($row['POST_Inspection_cmt'], ENT_QUOTES).'</td>
	</tr>
	<tr>
		<td style="width:300px;">Cross Bore Log (s) Ready for Inspection ?</td>
	<td style="width:120px; background:#fff;border:1px solid #222;">'.$row['Cross_Bore_Log'].'</td>
		<td class="textarea3" style="width:150px;">'.htmlentities($row['Cross_Bore_Log_cmt'], ENT_QUOTES).'</td>
	</tr>
</table>
<br>

</div>

';


  //echo $html;
// Write some HTML code:
   $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
  $mpdf->Output('ViewPDF.pdf');							

 header("Location: DownloadPdf.php");

 						?>
 						<script>
 					 	//    window.location.href="DownloadPdf.php";
 						    </script>
                        						 