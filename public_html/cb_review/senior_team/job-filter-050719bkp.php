<?php
include('../header_prevention.php');
$userid = $_SESSION['userid'];
if(isset($_REQUEST['date'])){
   $date =  $_REQUEST['date'];
   $date1 = DateTime::createFromFormat("m/d/Y" , $date);
   $search_date = $date1->format('Y-m-d');
}
if(isset($_REQUEST['send_data'])){
   $send_data = $_REQUEST['send_data'];
}
if($date != ''){
    
$sqljob_data = "SELECT cb_order_new.CITY,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE send_job_approval='1' AND cb_order_new.CN24_SAP_DATE = '$search_date'";

} else if($send_data != '') {

echo$sqljob_data = "SELECT cb_order_new.CITY,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE send_job_approval='1' AND (cb_front_cover.fc_cm = '$send_date' OR cb_front_cover.ce_rcm = '$send_data' OR cb_front_cover.foreman = '$send_data' OR cb_front_cover.reviewerlanid = '$send_data')";
  
} else {
    
$sqljob_data = "SELECT cb_order_new.CITY,order_status.order_name,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
INNER JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
INNER JOIN  order_status ON(cb_order.status=order_status.id)
WHERE send_job_approval='1'"; 

}
$result_jobs = $conn->query($sqljob_data);
// $search_date = '1';
// if($_REQUEST['date'])
// {
//   $search_date = $_REQUEST['date'];
// } 
// echo $_REQUEST['date'];
// echo $_REQUEST['selectdate'];
/*******************Queries End************************/ 

$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID))
{
	
}else{
session_destroy();
header("Location: ../../../index.php");	
}
?>
<script>
  function addFun(data)
{
    alert (data);
    if(data == 'City_Division'){
    $("#cityinp" ).css('display','block');
    } else{
         $("#cityinp" ).css('display','none');
    }
    if(data == 'cn24_date'){
       $("#dateinp" ).css('display','block');  
    } else{
         $("#dateinp" ).css('display','none');
    }
     if(data == 'roleWise'){
       $("#roleinp" ).css('display','block');  
    } else{
         $("#roleinp" ).css('display','none');
    }
    
    if(data == 'questionnaire'){
       $("#questioninp" ).css('display','block');  
    } else{
         $("#questioninp" ).css('display','none');
    }
   
}
</script>
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

</style>

	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">  
               
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="font-strong mb-4">Jobs for Gc Distribution  <?php if( $_REQUEST['date'] != '') { ?> <a href="/cb_review/senior_team/job-filter.php"><button type="button" class="btn btn-link">Back to Job</button></a> <?php } ?></h5>
									</div>
                                </div>
                                
                                
                                <div class="d-flex justify-content-between flexible-status-search">
                                    
                                        <div class="flexbox control-div mb-4">
                                            <div class="flexbox">
                                            <label class="mb-0 pr-2 ml-0">Filter:</label>
                                            <select class="selectpicker show-tick form-control" name="filter" id="filterdata" title="Please select" onchange="addFun(this.value)" data-style="btn-solid" data-width="150px">
                                            <option value="City_Division">City/Division</option>
                                             <option <?php if($_REQUEST['selectdate'] == 'cn24_date') { echo "selected"; } ?> value="cn24_date">CN-24 completed</option>
                                            <option value="roleWise">CM, CE, Foreman, Construction Supervisors and their LAN IDs</option>
                                            <option value="questionnaire"> MAT Code + answers for all the questions in the questionnaire</option>
                                            </select>
                                            <input type="text" id="cityinp" style="display: none;" />
                                            
                                            <input type="text" onChange="datefun(this.value,'cn24_date')" id="dateinp" class="datepicker"  value="<?php echo $_REQUEST['date']; ?>" style="display: none;" />
                                            
                                            <input type="text" onChange="rolefun(this.value)" id="roleinp" class=""  style="display: none;" />
                                            
                                            <input type="text" id="questioninp" class=""  style="display: none;" />
                                        </div>
									</div>
									<div>                                        
										<div class="d-flex align-items-center justify-content-end searchinputdiv">
											<label class="Searchdivclass mr-2 ml-0">Search</label>
											<div class="input-group-icon input-group-icon-left">
												<input class="form-control form-control-rounded form-control-solid Searchdivresponsive" id="key-search" type="text" placeholder="">
											</div>
										</div>
									</div>                                    
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="dash_datatable">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Order Id</th>
                                                        <th>Description</th>
                                                        <th>Response Group</th>
                                                        <th>MAT</th>
                                                        <th>City</th>
                                                        <th>Order Status</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="res_data">
                                            <?php
                                             $i=1;       	
											while($row = $result_jobs->fetch_array()) {
											 
											?>
                                                    <tr>
                                                      <td><?php echo $i++; ?></td>  
                                                     <td><?php echo $row['order_no']; ?></td>  
                                                     <td><?php echo $row['description']; ?></td>  
                                                     <td><?php echo $row['resp_group']; ?></td>  
                                                     <td><?php echo $row['mat']; ?></td>
                                                     <td><?php echo $row['CITY']; ?></td>  
                                                     <td><?php echo $row['order_name']; ?></td>  
                                                    
                                                    </tr>
                                                    <?php }
                                                   // print_r($ArrOrderNo);
                                                    $allorderno = implode(',', $ArrOrderNo);
                                                    ?>
                                                 </tbody>
                                            </table>
                                        </div>
                                        <label id="error" class="help-block" for="email"></label>
                                    </div>
                                </div>
                                
                                
                                
                                 <div class="row">
                                        <div class="col-sm-12">
                                             <a href="../ExcelGenerate_trans_dist.php?type=transmission"  class="btn btn-primary approvediv-colorr">Download Excel</a>
                                </div></div>
                               

                
            </div></div></div></div>
            
            
              
            <!-- END PAGE CONTENT-->
         <?php include('../footer_review.php');  ?>  
          <script src="/assets/js/dashboard.admn.min.js"></script><!--Piechart js-->
          <script src="/assets/vendors/js/dataTables.bootstrap4.min.js"></script>
          <script src="/assets/vendors/js/dataTables.select.min.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  function datefun(date,type){
     // alert(date);
       window.location.href="job-filter.php?date="+date+"&selectdate=" + type;
  }
  
  function rolefun(data) {
      alert(data);
      
      window.location.href="job-filter.php?send_data="+data;
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

     