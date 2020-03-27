<?php
include('../header_prevention.php');
//include('../header_snr_review.php');
$userid = $_SESSION['userid'];

//for mat count
$c_que = "select count(DISTINCT cb_project_details.mat) from cb_project_details 
INNER JOIN cb_front_cover ON(cb_project_details.order_id = cb_front_cover.order_id) 
INNER JOIN cb_order_new ON(cb_order_new.order_no = cb_project_details.order_id) 
INNER JOIN cb_order ON(cb_order.order_id = cb_project_details.order_id) 
INNER JOIN order_status ON(cb_order.status =order_status.id) 
where cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_project_details.mat != ''";
$c_res = $conn->query($c_que);
$crow = $c_res->fetch_array();
//print_r($crow);

//echo $crow;


//for Resp Group count
$resp_que = "select count(DISTINCT cb_front_cover.resp_group) from cb_front_cover 
INNER JOIN cb_project_details ON(cb_front_cover.order_id = cb_project_details.order_id)
INNER JOIN cb_order_new ON(cb_order_new.order_no = cb_project_details.order_id)
INNER JOIN cb_order ON(cb_order.order_id = cb_project_details.order_id)
INNER JOIN order_status ON(cb_order.status =order_status.id) where cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_front_cover.resp_group != ''";
$resp_res = $conn->query($resp_que);
$resp_row = $resp_res->fetch_array();
//print_r($resp_row);
//echo $crow;



//for division job count
$div_que = "select count(DISTINCT cb_front_cover.division) from cb_front_cover 
INNER JOIN cb_project_details ON(cb_front_cover.order_id = cb_project_details.order_id)
INNER JOIN cb_order_new ON(cb_order_new.order_no = cb_project_details.order_id)
INNER JOIN cb_order ON(cb_order.order_id = cb_project_details.order_id)
INNER JOIN order_status ON(cb_order.status =order_status.id) where cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_front_cover.division != ''";
$div_res = $conn->query($div_que);
$div_row = $div_res->fetch_array();

//for Fe/cm job count
$fe_que = "select count(DISTINCT cb_front_cover.fc_cm) from cb_front_cover 
INNER JOIN cb_project_details ON(cb_front_cover.order_id = cb_project_details.order_id)
INNER JOIN cb_order_new ON(cb_order_new.order_no = cb_project_details.order_id)
INNER JOIN cb_order ON(cb_order.order_id = cb_project_details.order_id)
INNER JOIN order_status ON(cb_order.status =order_status.id) where cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_front_cover.fc_cm != ''";
$fe_res = $conn->query($fe_que);
$fe_row = $fe_res->fetch_array();

//for foreman job count
$forman_que = "select count(DISTINCT cb_front_cover.foreman) from cb_front_cover 
INNER JOIN cb_project_details ON(cb_front_cover.order_id = cb_project_details.order_id)
INNER JOIN cb_order_new ON(cb_order_new.order_no = cb_project_details.order_id)
INNER JOIN cb_order ON(cb_order.order_id = cb_project_details.order_id)
INNER JOIN order_status ON(cb_order.status =order_status.id) where cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_front_cover.foreman != ''";
$forman_res = $conn->query($forman_que);
$forman_row = $forman_res->fetch_array();

//for inspector job count
$isp_que = "select count(DISTINCT cb_front_cover.inspector) from cb_front_cover 
INNER JOIN cb_project_details ON(cb_front_cover.order_id = cb_project_details.order_id)
INNER JOIN cb_order_new ON(cb_order_new.order_no = cb_project_details.order_id)
INNER JOIN cb_order ON(cb_order.order_id = cb_project_details.order_id)
INNER JOIN order_status ON(cb_order.status =order_status.id) where cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_front_cover.inspector != ''";
$isp_res = $conn->query($isp_que);
$isp_row = $isp_res->fetch_array();

/*******************Queries End************************/ 

$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("4", $roleID))
{
	
}else{
session_destroy();
header("Location: ../../index.php");	
}
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );

  </script>
<style>
button.btn.btn-primary.rejectjobs {
    background-color: #f39c12 !important;
    border-color: #f39c12 !important;
    color: #fff !important;
    padding: 3px 9px;
    display: inline-block;
    margin-left: 0px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
}
.inlineInput{
			min-width:200px !important;
	   }
	   .checkbox1{
			display:inline;
			width:250px;
	   }
       .help-block {
    display: block;
    font-size: 13px;
    margin-bottom: 0;
    margin-top: 2px;
    color: #e40930 !important;
}
.card-body.admin-fixeddiv h4 {
    font-size: 15px;
}
.text-blue.divspan01 {
    padding-right: 20px;
    width: 210px;
    display: inline-block;
}
 
select.custom-select.custom-select-sm.form-control.form-control-sm {
    width: 58px;
}
input.form-control.form-control-sm {
    background-color: #f4f5f9;
    border-color: #f4f5f9;
    border-radius: 24px;
}

.approvediv-color:hover {
color: #fff !important;
}
.color01{background: #117a8b !important;}

.approvediv-color {
    color: #fff !important;
    font-size: 14px !important;
    padding: 8px 24px !important;
    border-radius: 4px !important;
}
	.userprofile .card{
		color:#000;
		transition:1s;
		border-bottom:5px solid #5c6bc0;
		position:relative;
		 overflow: visible !important;
		border: 0;
		
	}
	.userprofile .user{
		margin-top:-50px;
	}
	.userprofile .card-body .social-link{
	    font-size: 25px;
		text-decoration: none;
	}
	.userprofile  data{
		width: 25px;
		height: 25px;
		background: #ccc;
		display: inline-block;
	}		
	.userprofile  .view-btn-parent{	
		position:absolute;
		top:100%;
		left:50%;
		transform:translate(-50%,-50%);	
	}
	.userprofile  .view-btn{
		border-radius:25px !important;
		padding:9px 29px !important;
		font-weight:600;
		color:white;
		transition:1s;
	}
	.userprofile  .card:hover{
		box-shadow:0px 0px 5px #ddd;
	}
	.userprofile .user img{
		width: 100px;
	}
	.userprofile  .card-header{
		border-bottom:0;
		background:none;
	}
	.userprofile .d-flex.justify-content-center.text-center.pb-2 i {
		display: block;
	}

  .ibox {
    background: #fff;
    border-radius: 4px;
}
  .navBreadcrumb .breadcrumb {
    background: none;
    padding: 15px 20px;
    margin-bottom: 0;
    border-radius: 0;
}
.navBreadcrumb .breadcrumb-item {
    color: #fdb813;
    font-size: 16px;
}
.navBreadcrumb .breadcrumb-item.active {
    color: #00a5df;
}
.navBreadcrumb .breadcrumb-item i {
    font-size: 12px;
    margin: 0 3px;
    color: #b5b5b5;
}
.ibox .ibox-body {
    padding: 0px 20px 20px;
}
h3.BigTitle {
    color: #fdb813;
    font-size: 15px;
    font-weight: 600;
    border-bottom: 1px dashed #c1c1c1;
    padding-bottom: 10px;
    margin-bottom: 0;
}
h3.BigTitle span {
    margin-right: 12px;
}
ul.view-jobs-list {
    padding: 0;
    list-style: none;
}
ul.view-jobs-list li a {
    width: 100%;
    display: inline-block;
    color: #333;
    font-weight: 600;
    font-size: 14px;
    padding: 15px 0;
    border-bottom: 1px solid #c1c1c1;
}
ul.view-jobs-list li a:hover {
    color: #00a5df;
    border-color: #00a5df;
text-decoration:none;
}
  </style>

	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">  
               
                
               <div class="row">
                        <div class="col-md-12 contnt-rght-pnl">
                           <div class="ibox">
<div class="row">
<div class="col-md-12">
<div class="navBreadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/cb_review/cb_prevention_team/admin-dashboard-prevention.php">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><i class="ti-angle-double-right"></i>View Jobs</li>
</ol>
</div>
</div>
</div>
<div class="ibox-body">
<h3 class="BigTitle"><span><img width="25" src="../../assets/img/view-jobs.png"></span>View Jobs</h3>
<ul class="view-jobs-list">
<li><a href="/cb_review/cb_prevention_team/view-jobs-matcode.php" title="Mat Code Jobs"> Mat Code Jobs (<?php echo $crow[0]; ?>)</a></li>
<li><a href="/cb_review/cb_prevention_team/view-jobs-respgroup.php" title="Resp Group Jobs"> Resp Group Jobs (<?php echo $resp_row[0]; ?>)</a></li>
<li><a href="/cb_review/cb_prevention_team/view-jobs-division.php" title="Division Jobs"> Division Jobs (<?php echo $div_row[0]; ?>)</a></li>
<li><a href="/cb_review/cb_prevention_team/view-jobs-fecm.php" title="FE/CM Jobs"> FE/CM Jobs (<?php echo $fe_row[0]; ?>)</a></li>
<li><a href="/cb_review/cb_prevention_team/view-jobs-foreman.php" title="Forman Jobs"> Foreman Jobs (<?php  echo $forman_row[0]; ?>)</a></li>
<li><a href="/cb_review/cb_prevention_team/view-jobs-inspector.php" title="Inspector Jobs"> Inspector Jobs (<?php echo $isp_row[0]; ?>)</a></li>
</ul>
</div>
                           </div>
                        </div>
                     </div>
            
            
              
            <!-- END PAGE CONTENT-->
         <?php include('../footer_review.php');  ?>  
          <script src="/assets/js/dashboard.admn.min.js"></script><!--Piechart js-->
          <script src="/assets/vendors/js/dataTables.bootstrap4.min.js"></script>
          <script src="/assets/vendors/js/dataTables.select.min.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
//   function datefun(date,type){
//      // alert(date);
//       window.location.href="job-filter.php?date="+date+"&selectdate=" + type;
//   }
  
//   function rolefun(data) {
//       alert(data);
      
//       window.location.href="job-filter.php?send_data="+data;
//   }
  </script>
  <script>
  function showfun(data)
{
  //  alert (data);
    window.location.href="job-filter.php?send_value="+data
    // if(data == 'City_Division'){
    // $("#cityinp" ).css('display','block');
    // } else{
    //      $("#cityinp" ).css('display','none');
    // }
    // if(data == 'cn24_date'){
    //   $("#dateinp" ).css('display','block');  
    // } else{
    //      $("#dateinp" ).css('display','none');
    // }
    //  if(data == 'roleWise'){
    //   $("#roleinp" ).css('display','block');  
    // } else{
    //      $("#roleinp" ).css('display','none');
    // }
    
    // if(data == 'questionnaire'){
    //   $("#questioninp" ).css('display','block');  
    // } else{
    //      $("#questioninp" ).css('display','none');
    // }
   
}
</script>
    
 <script>
function downloadpdf() {
  var approveby = $('#USERID').val();
var order_no = $('#OREDRNO').val();
 window.location.href='GenPdf.php?id='+approveby+'&ono='+order_no
}  

</script>

<script>
$(document).ready(function(){
        $( "#reject_cmt" ).focus(function() {
                $('.errorcomment').text('');
        });
        $( "#cityinp" ).change(function() {
               var res =  $("#cityinp").val();
               var filter_Type =  $("#filterdata").val();
               $.ajax({
                    type: 'post',
                    url: 'fetch_jobsdata.php',
                    data : {data_Type:filter_Type,data:res},
                     error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                    },
                    success: function (data) {
                        //alert(data);
                        $("#res_data").empty();
                        $("#res_data").prepend(data);
                    }
          });
        });
});
</script>

     