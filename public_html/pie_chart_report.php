<?php
   ob_start();
   
   include('header.php');
   
   ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php
   $userid = $_SESSION['userid'];
   $sdate = $_REQUEST['sdate'];
   $sdate = date('Y-m-d', strtotime($sdate));
   $enddate = $_REQUEST['enddate'];
   $enddate = date('Y-m-d', strtotime($enddate));
   $monthyear = $_REQUEST['monthyear'];
   $monthyear = date('Y-m', strtotime($monthyear));
   $filter = $_REQUEST['filter'];
   
   
   /*******************Queries added for pie chart************************/ 
   if($filter==''){
   $sql_TotalJobs = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.order_stage = 5 ";
   }else{
   if($filter=='month'){ 
    $sql_TotalJobs = "SELECT count(*) FROM cb_order_new INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no) WHERE cb_order_new.order_stage = 5 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_TotalJobs = "SELECT count(*) FROM cb_order_new INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no) WHERE  cb_order_new.order_stage = 5 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   }
      
   }
   $result_TotalJobs = $conn->query($sql_TotalJobs);
   $row_TotalJob = $result_TotalJobs->fetch_array();
   //echo "Total Jobs";
   $row_TotalJobs = $row_TotalJob['0'];
   
   // if($filter==''){
   // $sql_JobsCoverSheet = "SELECT count(cb_order.id) FROM cb_order LEFT JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 1";
   // }else{
   // if($filter=='month'){    
   // echo $sql_JobsCoverSheet = "SELECT count(cb_order.id) FROM cb_order
   // LEFT JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id 
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 1 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   // }
   // else if($filter=='week' || $filter=='daterange'){
   // echo $sql_JobsCoverSheet = "SELECT count(cb_order.id) FROM cb_order 
   // LEFT JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 1 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   // }
   // }
   // $result_JobsCoverSheet = $conn->query($sql_JobsCoverSheet);
   // $row_JobsCoverSheet = $result_JobsCoverSheet->fetch_array();
   // $row_JobsCoverSheet = $row_JobsCoverSheet['0'];
   
   
   
   // if($filter==''){
   // $sql_JobsProjctDetails = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 2";
   // }else{
   // if($filter=='month'){    
   // $sql_JobsProjctDetails = "SELECT count(cb_order.id) FROM cb_order 
   // LEFT JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id 
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 2 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   // }
   // else if($filter=='week' || $filter=='daterange'){
   // $sql_JobsProjctDetails = "SELECT count(cb_order.id) FROM cb_order 
   // LEFT JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id 
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 2 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   // }
      
   // }
   // $result_JobsPrjDetails = $conn->query($sql_JobsProjctDetails);
   // $row_JobsPrjDetails = $result_JobsPrjDetails->fetch_array();
   // //echo "PrjDetails";
   // $row_JobsPrjDetails = $row_JobsPrjDetails['0'];
   
   
   
   // if($filter==''){
   // $sql_JobsQualifyFive = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 3";
   // }else{
   // if($filter=='month'){    
   // $sql_JobsQualifyFive = "SELECT count(cb_order.id) FROM cb_order 
   // INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id 
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 3 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   // }
   // else if($filter=='week' || $filter=='daterange'){
   // $sql_JobsQualifyFive = "SELECT count(cb_order.id) FROM cb_order 
   // INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id 
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 3 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   // }
      
   // }
   //  $result_JobsQualifyFive = $conn->query($sql_JobsQualifyFive);
   // $row_JobsQualifyFive = $result_JobsQualifyFive->fetch_array();
   // //echo "QualifyFive";
   // $row_JobsQualifyFive = $row_JobsQualifyFive['0'];
   
   
   // if($filter==''){
   // $sql_JobsDistributnChkklist = "SELECT count(cb_order.id) FROM cb_order INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id WHERE cb_order_new.order_stage = 4";
   // }else{
   // if($filter=='month'){    
   // $sql_JobsDistributnChkklist = "SELECT count(cb_order.id) FROM cb_order 
   // INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id 
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 4 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   // }
   // else if($filter=='week' || $filter=='daterange'){
   // $sql_JobsDistributnChkklist = "SELECT count(cb_order.id) FROM cb_order 
   // INNER JOIN cb_order_new ON cb_order_new.order_no = cb_order.order_id 
   // LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   // WHERE cb_order_new.order_stage = 4 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   // }
      
   // }
   // $result_JobsDistributnChkklist = $conn->query($sql_JobsDistributnChkklist);
   // $row_JobsDistributnChkklist = $result_JobsDistributnChkklist->fetch_array();
   // //echo "DistributnChkklist";
   // $row_JobsDistributnChkklist = $row_JobsDistributnChkklist['0'];
   
   
   if($filter==''){
   $sql_JobsReviewDone = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.order_stage = 6 ";
   }else{
   if($filter=='month'){    
   $sql_JobsReviewDone = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.order_stage = 6 AND DATE_FORMAT(cb_order_new.approved_date, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_JobsReviewDone = "SELECT count(*) FROM cb_order_new WHERE cb_order_new.order_stage = 6 AND DATE(cb_order_new.approved_date) >= '$sdate' AND DATE(cb_order_new.approved_date) <= '$enddate'";
   }
      
   }
   $result_JobsReviewDone = $conn->query($sql_JobsReviewDone);
   $row_JobsReviewDoneres = $result_JobsReviewDone->fetch_array();
   //echo "DistributnChkklist";
   $row_JobsReviewDone = $row_JobsReviewDoneres['0'];
   
   
   
   if($filter==''){
   $sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 1";
   }else{
   if($filter=='month'){    
   $sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM `cb_order_new` 
   LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no 
   LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   WHERE  cb_order.status = 1 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_Jobsfield_remediation = "SELECT count(cb_order.id) FROM `cb_order_new` 
   LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no 
   LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   WHERE cb_order.status = 1 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   }
      
   }
   $result_Jobsfield_remediation = $conn->query($sql_Jobsfield_remediation);
   $row_Jobsfield_remediation = $result_Jobsfield_remediation->fetch_array();
   //echo "Jobsfield_remediation";
   $row_Jobsfield_remediation = $row_Jobsfield_remediation['0'];
   
   
   if($filter==''){
   $sql_JobsCN29 = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 2";
   }else{
   if($filter=='month'){    
   $sql_JobsCN29 = "SELECT count(cb_order.id) FROM `cb_order_new` 
   LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no 
   LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   WHERE  cb_order.status = 2 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_JobsCN29 = "SELECT count(cb_order.id) FROM `cb_order_new` 
   LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no 
   LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   WHERE cb_order.status = 2 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   }
      
   }
   $result_JobsCN29 = $conn->query($sql_JobsCN29);
   $row_JobsCN29 = $result_JobsCN29->fetch_array();
   //echo $CN29;
   $row_JobsCN29 = $row_JobsCN29['0'];
   
   
   if($filter==''){
   $sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM `cb_order_new` INNER JOIN cb_order on cb_order.order_id = cb_order_new.order_no WHERE cb_order.status = 3";
   }else{
   if($filter=='month'){    
   $sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM `cb_order_new` 
   LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no 
   LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   WHERE  cb_order.status = 3 AND DATE_FORMAT(cb_order_new.date_of_submission, '%Y-%m') = '$monthyear'";
   }
   else if($filter=='week' || $filter=='daterange'){
   $sql_Jobsunknown_status = "SELECT count(cb_order.id) FROM `cb_order_new` 
   LEFT JOIN cb_order on cb_order.order_id = cb_order_new.order_no 
   LEFT JOIN cb_front_cover ON cb_order_new.order_no = cb_front_cover.order_id 
   WHERE cb_order.status = 3 AND DATE(cb_order_new.date_of_submission) >= '$sdate' AND DATE(cb_order_new.date_of_submission) <= '$enddate'";
   }
      
   }
   $result_Jobsunknown_status = $conn->query($sql_Jobsunknown_status);
   $row_Jobsunknown_status = $result_Jobsunknown_status->fetch_array();
   //echo $unknown_status;
   $row_Jobsunknown_status = $row_Jobsunknown_status['0'];
   
   /*******************Queries End************************/ 
   
   $role_id = $_SESSION['role'];
   $roleID = explode(',',$role_id);
   if (in_array("1", $roleID))
   {
   	
   }else{
   session_destroy();
   header("Location: index.php");	
   }
   ?>
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
   .legendLabel{
   padding-left: 5px !important;
   color: black !important;
   background-color: white !important;
   /*font-weight: 700;*/
   }
   .legend{
   background-color: white !important;
   }
   .ibox {
    border: 2px solid #ddd;
   }
   .legend div{
  background: none !important;

}
input#from1 {
    width: 153px;
}

.custom_calendar {
    background: url(assets/img/calendar-icon.png) no-repeat;
    background-position: 10px;
    border-radius: 4px;
    border: 1px solid #ddd;
    padding-left: 31px;
}
span.glyphicon.glyphicon-ok.check-mark {
display: none !important;
}
 .month_year, .weekly{
     width:200px;
 }
</style>
<div class="container">
<div class="content-wrapper">
<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
<div class="row">
<div class="col-sm-12" id="">
   <div class="ibox">
      <div class="ibox-body">
         <h5 class="font-strong mb-4">Pie Chart Report</h5>
         <div class="row">
            <div class="col-sm-3">
               <div class="mb-3">
                   <input type="hidden" value="<?= $_REQUEST['filter'] ?>" id="filter">
                  <label class="mb-0 pr-2 ml-0">Status:</label>
                  <select class="selectpicker show-tick form-control selectpickerdiv2" id="type-filtercn29" onchange="get_cn29_weekdata(this.value)" title="Please select" data-style="btn-solid" data-width="150px">
                     <option value="All">All</option>
                     <?php if($_REQUEST['filter'] =='week') { ?>
                     <option value="week" selected>Weekly</option>
                     <?php } else {  ?>
                     <option value="week">Weekly</option>
                     <?php } ?>
                     <?php if($_REQUEST['filter'] =='month') { ?>
                     <option value="month" selected>Monthly</option>
                     <?php } else {  ?>
                     <option value="month">Monthly</option>
                     <?php } ?>
                     <?php if($_REQUEST['filter'] =='daterange') { ?>
                     <option value="custom" selected>Custom Date</option>
                     <?php } else {  ?>
                     <option value="custom">Custom Date</option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="col-md-6">
               <?php if($_REQUEST['filter'] =='month') { ?>
               <div class="form-group month_year" id="month_year1">
                  <?php } else { ?>
                  <div style="display:none" class="form-group month_year" id="month_year1">
                     <?php } ?>
                     <div class='input-group date' id=''>
                        <?php if($_REQUEST['filter'] =='month') { ?>
                        <input class="form-control datepicker monthlyjob custom_calendar" name="" id="monthly1" type="text" value="<?=$_REQUEST['monthyear']?>">
                        <?php } else { ?>
                        <input class="form-control datepicker monthlyjob custom_calendar" name="" id="monthly1" type="text">
                        <?php } ?>
                     </div>
                  </div>
                  <?php if($_REQUEST['filter'] =='daterange') { ?>
                  <div class="form-group date_range"  id="date_range1">
                     <div class='input-group date' id=''>
                        <label for="from">From</label>  &nbsp;
                        <input class="custom_calendar" type="text" id="from" value="<?=$_REQUEST['sdate'] ?>" name="from">&nbsp;
                        <label for="to">to</label>&nbsp;
                        <input class="custom_calendar" type="text" id="to" value="<?= $_REQUEST['enddate'] ?>" name="to">
                     </div>
                  </div>
                  
                   <?php } else { ?>
                  <div class="form-group date_range" style="display:none" id="date_range1">
                     <div class='input-group date' id=''>
                        <label for="from1">From</label>  &nbsp;
                        <input class="custom_calendar" type="text" id="from1" value="" name="from">&nbsp;
                        <label for="to1">to</label>&nbsp;
                        <input class="custom_calendar" type="text" id="to1" value="" name="to">
                     </div>
                  </div>
                   <?php } ?>
                  <?php if($_REQUEST['filter'] =='week') { ?>
                  <div class="form-group weekly" id="weekly1">
                     <?php } else { ?>
                     <div style="display:none" class="form-group weekly" id="weekly1">
                        <?php } ?>
                        <div class='input-group date' id=''>
                           <?php if($_REQUEST['filter'] =='week') { ?>
                           <input class="form-control datepicker3 custom_calendar"  autocomplete="off" name="weekdays" id="weekfilter1" type="text" value="<?=$_REQUEST['sdate']. ' - '.$_REQUEST['enddate']?>">
                           <?php } else { ?>
                           <input class="form-control datepicker3 custom_calendar" autocomplete="off"  name="weekdays" id="weekfilter1" type="text">
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="total_jobs" value="<?php echo $row_TotalJobs;?>">
                  <!--<input type="hidden" name="JobsCoverSheet" value="<?php //echo  $row_JobsCoverSheet;?>">-->
                  <!--<input type="hidden" name="JobsPrjDetails" value="<?php //echo  $row_JobsPrjDetails;?>">-->
                  <!-- <input type="hidden" name="JobsQualifyFive" value="<?php //echo  $row_JobsQualifyFive;?>">-->
                  <!-- <input type="hidden" name="JobsDistributnChkklist" value="<?php //echo  $row_JobsDistributnChkklist;?>">-->
                  <input type="hidden" name="Jobsreviewdone" value="<?php echo $row_JobsReviewDone;?>">
                  <input type="hidden" name="JobsStatusCN29" value="<?php echo $row_JobsCN29;?>">
                  <input type="hidden" name="JobsStatusFieldRemediation" value="<?php echo $row_Jobsfield_remediation;?>">
                  <input type="hidden" name="JobsStatusUnknownStatus" value="<?php echo $row_Jobsunknown_status;?>">
               </div>
			   </div>
			   </div>
			    </div>
      </div>
   </div>
    <div class="row pt-5" id="piechart">
                  <div class="col-lg-6 mb-md-4">
                           <div class="ibox">
                                 <div class="ibox-head">
                                    <div class="ibox-title">Total Jobs</div>
                                 </div>
                               <div class="ibox-body" id="cool-canvas">
                                      <div class="chart-wrapper">
                                         <div id="dash_pie_totaljobs" style="height:150px;"></div>
                                      
                                     </div>
                                 </div>
                             </div>
                        </div>
                  
                      <div class="col-lg-6 mb-md-4">
                             <div class="ibox">
                               <div class="ibox-head">
                                   <div class="ibox-title">Job Status</div>
                              </div>
                              <div class="ibox-body">
                                 <div class="chart-wrapper">
                                   <div id="dash_jobstatus" style="height:150px;"></div>
                                </div>
                               </div>
                             </div>
                       </div>
                           
                    </div> 
              
               <button class="btn bg-success approvediv-color divcolororange mr-2 mb-2" id="id_generate_pdf">Export to PDF</button>
            </div>
        
<!-- END PAGE CONTENT-->
<?php include('footer.php');  ?>  
<script src="assets/js/report_pie_chart.js"></script><!--Piechart js-->
<script src="assets/vendors/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/vendors/js/dataTables.select.min.js"></script>

<script>
   $( "#monthly1" ).click(function() {
       $(".job_status").val("");
           $(".job_status").val("cn29_eligible");
           $('.ui-datepicker-calendar').hide();
   }); 
   $( "#monthly2" ).click(function() {
        $(".job_status").val("");
           $(".job_status").val("fieldremedation");
           $('.ui-datepicker-calendar').hide();
   });
   
   $( "#monthly3" ).click(function() {
        $(".job_status").val("");
           $(".job_status").val("unknownstatus");
           $('.ui-datepicker-calendar').hide();
   });
   $( "#to1" ).click(function() {
        $(".job_status").val("");
           $(".job_status").val("cn29_eligible");
   });
   $( "#to2" ).click(function() {
       //alert('dfgfrdfd');
        $(".job_status").val("");
        $(".job_status").val("fieldremedation");
           //alert($(".job_status").val("fieldremedation"));
   });
   $( "#to3" ).click(function() {
        $(".job_status").val("");
           $(".job_status").val("unknownstatus");
   });
   $( "#weekfilter1" ).click(function() {
       $(".job_status").val("");
           $(".job_status").val("cn29_eligible");
   }); 
   $( "#weekfilter2" ).click(function() {
        $(".job_status").val("");
           $(".job_status").val("fieldremedation");
   });
   $( "#weekfilter3" ).click(function() {
        $(".job_status").val("");
           $(".job_status").val("unknownstatus");
   });
   function get_cn29_weekdata(value) {
       if(value=='week'){
               $('#month_year1').hide();
               $('#date_range1').hide();
               $('#weekly1').show();
       }
       if(value=='month'){
               $('#weekly1').hide();
               $('#date_range1').hide();
               $('#month_year1').show();
       }
         if(value=='custom'){
             //alert('cusot');
               $('#month_year1').hide();
               $('#weekly1').hide();
               $('#date_range1').show();
        
       }
          if(value=='All'){
               $('#month_year1').hide();
               $('#weekly1').hide();
               $('#date_range1').hide();
               window.location.href="pie_chart_report.php";
        
       }
        
       // var data_filter = 'filter='+value;
       //       $.ajax({
       //         type: 'post',
       //         url: 'fetch_cn29data.php',
       //         //data: $('form').serialize(),
       //         data : data_filter,
       //          error: function(xhr, status, error) {
       //         var err = eval("(" + xhr.responseText + ")");
       //         alert(err.Message);
       //         },
       //         success: function (data) {
       //             alert(data);
       //             $("#cn29_weekdata").hide();
       //             $("#res_data").empty();
       //              //$('#myTable tbody').html(data);
       //             $("#res_data").prepend(data);
       //         }
       //       });
               
      
    
   }
   function get_fieldremedation_weekdata(value) {
     
       if(value=='week'){
               $('#month_year2').hide();
               $('#date_range2').hide();
               $('#weekly2').show();
        
       }
       if(value=='month'){
               $('#weekly2').hide();
               $('#date_range2').hide();
               $('#month_year2').show();
       }
       if(value=='custom'){
               $('#month_year2').hide();
               $('#weekly2').hide();
               $('#date_range2').show();
        
       }
       if(value=='All'){
               $('#month_year2').hide();
               $('#weekly2').hide();
               $('#date_range2').hide();
               window.location.href="pie_chart_report.php";
           }
        $( "#monthly2" ).click(function() {
                     $('.ui-datepicker-calendar').hide();
       });   
    
   }
   
   
   
   function get_unknownstatus_weekdata(value) {
       if(value=='week'){
               $('#month_year3').hide();
               $('#date_range3').hide();
               $('#weekly3').show();
        
       }
       if(value=='month'){
               $('#weekly3').hide();
               $('#date_range3').hide();
               $('#month_year3').show();
       }
         if(value=='custom'){
               $('#month_year3').hide();
               $('#weekly3').hide();
               $('#date_range3').show();
        
       }
       if(value=='All'){
               $('#month_year3').hide();
               $('#weekly3').hide();
               $('#date_range3').hide();
               window.location.href="pie_chart_report.php";
       }
       $( "#monthly3" ).click(function() {
                     $('.ui-datepicker-calendar').hide();
       });  
    
             
   }
   
</script>   
<script>
   function downloadpdf() {
     var approveby = $('#USERID').val();
   var order_no = $('#OREDRNO').val();
    window.location.href='GenPdf.php?id='+approveby+'&ono='+order_no
   }  
   
</script>
<!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  -->
<!--<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
<script>
   /*$(document).ready(function(){
           $( "#reject_cmt" ).focus(function() {
           $('.errorcomment').text('');
       });
   });*/
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   $(function() {
   	$('#monthly1').datepicker({
   		changeMonth: true,
   		changeYear: true,
   		showButtonPanel: true,
   		dateFormat: 'MM yy',
   		buttonText: 'Select date'
         
   	 
   	}).focus(function() {
   	    //alert('rfgtfg');
   		var thisCalendar = $(this);
   		$('.ui-datepicker-calendar').detach();
   		$('.ui-datepicker-close').click(function() {
           var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
           var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
           thisCalendar.datepicker('setDate', new Date(year, month, 1));
           var type = 'month';
                   var resultjob = $('.job_status').val();
                   var dateText2 = $('#monthly1').val();
                   //alert(dateText2);
                   var dateText2 = $.trim(dateText2);
                   //alert(dateText2);
                   var str = dateText2.replace(/\s/g, '');
                   window.location.href="pie_chart_report.php?filter="+type+"&monthyear="+str;
   		});
   	
   	});
    
   	
    
   });
   
     
</script>
<script>
   $(function() {
   	$('#monthly2').datepicker({
   		changeMonth: true,
   		changeYear: true,
   		showButtonPanel: true,
   		dateFormat: 'MM yy',
   		buttonText: 'Select date'
         
   	 
   	}).focus(function() {
   	    //alert('mon2');
   		var thisCalendar = $(this);
   		$('.ui-datepicker-calendar').detach();
   		$('.ui-datepicker-close').click(function() {
           var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
           var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
           thisCalendar.datepicker('setDate', new Date(year, month, 1));
           var type = 'month';
                    var resultjob = $('.job_status').val();
                   var dateText2 = $('#monthly2').val();
                   var dateText2 = $.trim(dateText2);
                   var str2 = dateText2.replace(/\s/g, '');
                   window.location.href="pie_chart_report.php?filter="+type+"&monthyear="+str2;
   		});
   	
   	});
    
   	
    
   });
   
     
</script>
<script>
   $(function() {
   	$('#monthly3').datepicker({
   		changeMonth: true,
   		changeYear: true,
   		showButtonPanel: true,
   		dateFormat: 'MM yy',
   		buttonText: 'Select date'
         
   	 
   	}).focus(function() {
   	    //alert('mon3');
   		var thisCalendar = $(this);
   		$('.ui-datepicker-calendar').detach();
   		$('.ui-datepicker-close').click(function() {
           var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
           var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
           thisCalendar.datepicker('setDate', new Date(year, month, 1));
           var type = 'month';
                   var resultjob = $('.job_status').val();
                   var dateText2 = $('#monthly3').val();
                   //alert(dateText2);
                   var dateText2 = $.trim(dateText2);
                   //alert(dateText2);
                   var str = dateText2.replace(/\s/g, '');
                   window.location.href="pie_chart_report.php?filter="+type+"&monthyear="+str;
   		});
   	
   	});
    
   	
    
   });
   
     
</script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script>
   $( function() {
    var dateFormat1 = "mm/dd/yy",
      from = $( "#from" ).datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths:1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate1( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths:1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate1( this ) );
      });
   
     function getDate1( element ) {
        var resultjob = $('.job_status').val();
        var sdate = $( "#from" ).val();
        var enddate = $( "#to" ).val();
        var date;
       try {
         date = $.datepicker.parseDate( dateFormat1, element.value );
       } catch( error ) {
         date = null;
       }
        if(sdate!='' && enddate!=''){
          

       var type = 'daterange';
      window.location.href="pie_chart_report.php?filter="+type+"&sdate="+sdate+"&enddate="+enddate;
        }
       
       return date;
     }
     
     
     
     
   });
    
    var dateFormat2 = "mm/dd/yy",
      from1 = $( "#from1" ).datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths:1
        })
        .on( "change", function() {
          to1.datepicker( "option", "minDate", getDate2( this ) );
        }),
      to1 = $( "#to1" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths:1
      })
      .on( "change", function() {
        from1.datepicker( "option", "maxDate", getDate2( this ) );
      });
   
     function getDate2( element ) {
        var resultjob = $('.job_status').val();
        var sdate = $( "#from1" ).val();
        var enddate = $( "#to1" ).val();
        var date;
       try {
         date = $.datepicker.parseDate( dateFormat2, element.value );
       } catch( error ) {
         date = null;
       }
        if(sdate!='' && enddate!=''){
       var type = 'daterange';
      window.location.href="pie_chart_report.php?filter="+type+"&sdate="+sdate+"&enddate="+enddate;
       }
       return date;
     }
     
    
</script>
<!-----------------Code Added for week filter------------------->
<script>
   $(document).ready(function() {
        $('#weekfilter1').datepicker({
            changeMonth: true,
            changeYear: true,
             onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                var startDat = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                var Enddate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var type = 'week';
                var resultjob = $('.job_status').val();
                //alert(resultjob);
                window.location.href="pie_chart_report.php?filter="+type+"&sdate="+startDat+"&enddate="+Enddate;
        }
      });
      
      $('#weekfilter2').datepicker({
            changeMonth: true,
            changeYear: true,
             onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                var startDat = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                var Enddate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var type = 'week';
                var resultjob = $('.job_status').val();
                //alert(resultjob);
                window.location.href="pie_chart_report.php?filter="+type+"&sdate="+startDat+"&enddate="+Enddate;
    }
   });
   $('#weekfilter3').datepicker({
            changeMonth: true,
            changeYear: true,
             onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                var startDat = $.datepicker.formatDate( dateFormat, startDate, inst.settings );
                var Enddate = $.datepicker.formatDate( dateFormat, endDate, inst.settings );
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " - " + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var type = 'week';
                var resultjob = $('.job_status').val();
                //alert(resultjob);
                window.location.href="pie_chart_report.php?filter="+type+"&sdate="+startDat+"&enddate="+Enddate;
    }
   });
   });
</script>
<!-------------Code Ends----------------->
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
   });
</script>