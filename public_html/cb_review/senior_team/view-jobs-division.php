<?php
include('../header_snr_review.php');
$userid = $_SESSION['userid'];

$sql="select DISTINCT cb_front_cover.division from cb_front_cover 
INNER JOIN cb_project_details ON(cb_front_cover.order_id = cb_project_details.order_id)
INNER JOIN cb_order_new ON(cb_order_new.order_no = cb_project_details.order_id)
INNER JOIN cb_order ON(cb_order.order_id = cb_project_details.order_id)
INNER JOIN order_status ON(cb_order.status =order_status.id) where cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_front_cover.division != ''";
  $query = $conn->query($sql);
 

/*******************Queries End************************/ 

$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("6", $roleID))
{
	
}else{
session_destroy();
header("Location: ../../../index.php");	
}
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  
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
	
	
	
	.tble_wrp .dataTables_wrapper .row {
    width: 100%;
}

div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    float: right;
}
div.dataTables_wrapper div.dataTables_length select {
    width: 76px;
    display: inline-block;
    height: auto !important;
    padding: 3px 5px;
    border: 1px solid #aaa;
    margin: 0 7px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    height: 31px;
    width: 31px;
    padding: 0;
    border: 0;
    margin: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #00a5df !important;
    border-color: #00a5df !important;
    color: #fff;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.previous, .dataTables_wrapper .dataTables_paginate .paginate_button.next {
    background: none !important;
    color: #333333;
    width:auto;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.previous a:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.next a:hover {
    color: #00a5df !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.previous a:focus, .dataTables_wrapper .dataTables_paginate .paginate_button.next a:focus{
   color: #00a5df !important;
}
table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
    content: "\2193" !important;
}
h5.table-heading {
    font-weight: 600;
    position: relative;
}
h5.table-heading:after {
    position: absolute;
    content: "";
    width: 90px;
    background: rgba(0,0,0,.1);
    height: 2px;
    bottom: -6px;
    left: 15px;
}
.navBreadcrumb .breadcrumb{
    margin-bottom: -6px;
    background: #fff;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.navBreadcrumb .breadcrumb-item {
    color: #fdb813;
    font-size: 16px;
}
.navBreadcrumb .breadcrumb-item.active {
    color: #00a5df;
}
</style>

	<div class="container">
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">  
             <div  class="row">
                  <div class="col-md-12">
                      <div class="navBreadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                  <a href="/cb_review/senior_team/view-jobs.php">View Jobs</a>
                                 </li>
                                 <li class="breadcrumb-item active">
                                    View Jobs by Division
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                 <?php
			       	while($row = $query->fetch_array()) {
			       	    $division = $conn->real_escape_string($row['division']);

                        //cb_front_cover.foreman = '".$division."'
					?> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            
                            <div class="ibox-body">
                                <div class="row">
									<div class="col-sm-12">
										<h5 class="table-heading mb-4"> <i class="fa fa-caret-down"></i> <?php echo $row['division']; ?>  Jobs</h5>
									</div>
                                </div>
                                        <div class="tble_wrp">
                                            <table class="table table-bordered table-hover datatable">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th width="30">#</th>
                                                        <th width="85">Order Id</th>
                                                        <th>Description</th>
                                                        <th width="140">Response Group</th>
                                                        <th>City</th>
                                                        <th width="60">MAT</th>
                                                        <th>Division</th>
                                                        <th>Recommendation</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php 
                                            $show_que = "SELECT cb_front_cover.city as CITY,order_status.order_name,cb_order_new.recommendation,cb_order_new.order_no,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat,cb_front_cover.division FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
LEFT JOIN cb_order ON(cb_order.order_id=cb_order_new.order_no)
LEFT JOIN  order_status ON(cb_order.status=order_status.id)
WHERE cb_order_new.send_job_approval='1' AND order_stage= 6 AND cb_front_cover.division = '".$division."' ";
                                            $show_res = $conn->query($show_que);
                                            $i=1;
                                           while($show_row = $show_res->fetch_array()){
                                            ?>
                                                    <tr>
                                                     <td><?php echo $i++; ?></td>  
                                                     <td><?php echo $show_row['order_no']; ?></td>  
                                                    <input type="hidden" name="memid" value="<?php echo $show_row['order_no'];?>" id="hiddenorderid">
                                                    <input type="hidden" name="memid" value="<?php echo $show_row['user_id'];?>" id="hiddenuserid">
                                                     <td><?php echo $show_row['description']; ?></td>  
                                                     <td><?php echo $show_row['resp_group']; ?></td>  
                                                     <td><?php echo $show_row['CITY']; ?></td>  
                                                     <td><?php echo $show_row['mat']; ?></td>  
                                                     <td><?php echo $show_row['division']; ?></td>
                                                      <td><?php if($show_row['recommendation']==null){ echo 'N/A'; } else { echo $show_row['recommendation']; }?></td>
                                                     <td><?php 
                                                 
                                                        if( $show_row['order_name']=='CN-29 Eligible')
                                                        {
                                                            echo '<span style="color:Green !important;font-weight: bold;">'.$show_row['order_name'].'</span>';
                                                        }
                                                        
                                                        if( $show_row['order_name']=='Unknown Status')
                                                        {
                                                            echo '<span  style="color:lightblue !important;font-weight: bold;">Unknown</span>';
                                                        }
                                                        
                                                        if( $show_row['order_name']=='Field Remediation Required')
                                                        {
                                                            echo '<span  style="color:Orange !important;font-weight: bold;">'.$show_row['order_name'].'</span>';
                                                        }
                                                        
                                                        
                                                        ?></td>
                                                     <td align="center">
                                                   <button  type="button" class="btn btn-primary rejectjobs" data-toggle="modal" data-target="#exampleModal">View</button>
                                                   </td>
                                                    </tr>
                                                <?php } ?>   
                                                 </tbody>
                                            </table>
                                        </div>
                                        
                                        <label id="error" class="help-block" for="email"></label>
                                
                                
                                
                                 <div class="row">
                                        <div class="col-sm-12">
                                             <!--<a href="../senior_team/ExcelGenerate_trans_dist.php?type=transmission"  class="btn btn-primary approvediv-colorr">Download Excel</a>-->
                                </div></div>
                               

                
            </div></div></div></div>
             <?php } ?>
            
             
       <div class="modal fade customModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="exampleModal">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="container">					
                           <form id="form-wizard" action="javascript:;" method="post" novalidate="novalidate" class="mform stepForm wizard p-2 background-form-div clearfix" role="application">
						    <button type="button" class="close buttondivbold" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
                           </button>
							<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Cover Sheet</h5>
                           <div class="rowdiv1">
						    <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">LANID</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly="" value="" id="lanid" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Date of Review</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly="" value="" id="review_date" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Reviewer Completion Date</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="" readonly value="" id="review_completion_date" class="form-control">
                                       <input type="hidden" id="OREDRNO" value="">
                                       <input type="hidden" id="USERID" value="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Number</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly=""   value="" id="order_no" class="form-control valid" placeholder="" aria-invalid="false">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Project ID</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="project_id" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Division</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly  id="division" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">City</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="city" class="form-control">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Description</label>
                                    <div class="col-sm-7">
                                       <textarea  value="" readonly id="order_description" class="form-control"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">FE/CM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="FE_CM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">CE/RCM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="CE_RCM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Foreman</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="foreman" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">M&amp;C Supervisor</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="m_c_supervisor" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Distribution/Transmission</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid" readonly aria-invalid="false" id="Distribution_Transmission">
                                         
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Resp Group</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid" readonly aria-invalid="false" id="resp_gp">
                                        
                                    </div>
                                 </div>
                              </div>
                           </div>
                           </div>
						   <h5 class="font-strong mb-4 pt-4 formheadingdiv01">Project Details</h5>
						   <div class="rowdiv1">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="row mb-2 pb-1">
                                    <div class="col-sm-12">									   
									   <div class="row p-0">
											<div class=" col-1 p-0">
												<label class="pl-4">MAT</label>
											</div>
											<div class=" col-10 p-0">
												<input type="text" value="" readonly id="mat" class="form-control full-w-input">
											
											</div>
											<div class=" col-1">
												 <div class="custom-control custom-checkbox ml-4">
													 <input type="checkbox" value="" readonly class="custom-control-input" id="Checkmat" disabled>
													 <label class="custom-control-label checkdivclass" readonly for="Checkmat"></label>
												  </div>
											</div>
									   </div>                             
                                          
                                         
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">

                                          <label class="pl-4 paddcol-div">CN24</label>
										  <span class="inlineInput inlineinput2">
                                          <input id="cn24" type="text" readonly class="form-control inlineInput inlineinput2">                                            
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value="" readonly  id="cn24_lanid" class="form-control valid" placeholder="" aria-invalid="false">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value="" readonly id="cn24_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" id="check_cn24" readonly class="custom-control-input" disabled>
                                             <label class="custom-control-label checkdivclass" for="check_cn24"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">CN29</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly class="form-control" id="cn29">
                                              
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input value="" readonly id="cn29_lanid" type="text" class="form-control" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                             <!--<input  type="text" value="" id="cn29_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="Date">-->
                                             <input type="text" readonly value="" id="cn29_date" class="form-control datepicker" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" readonly class="custom-control-input" id="check_cn29" disabled>
                                             <label class="custom-control-label checkdivclass" for="check_cn29"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">CN07</label>
                                          <span class="inlineInput inlineinput2">
										  
                                             <input type="text" readonly class="form-control" id="cn07">
                                                
                                             
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="cn07_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="cn07_date" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" readonly class="custom-control-input" id="check_cn07" disabled>
                                             <label class="custom-control-label checkdivclass" for="check_cn07"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 39</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="dc39">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc39_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc39_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 46</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly class="form-control" id="dc46">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc46_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc46_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 05</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="dc05">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc05_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc05_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 14</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly  class="form-control" id="dc14">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc14_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc14_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 15</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="dc15">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc15_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc15_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 19</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly class="form-control valid" id="dc19" aria-invalid="false">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc19_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc19_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width form_responsive_width ">
                                          <label class="pl-4 paddcol-div">DC 10</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly  class="form-control" id="dc10">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="dc10_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="dc10_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 
                              </div>
							  <div class="row">
                                    <div class="col-sm-12 pl-4 paddcol-div">
                                       <div class="form-group fild-width textarea-formdiv">
                                          <label class=" d-block">General comments for SAP task (CN/DC): </label>
                                          <textarea  value="" readonly id="cmt_cn_dc" class="form-control bg-white"></textarea>
                                       </div>
                                    </div>
                               </div>
							   </div>
                            <h5 class="font-strong mb-4 pt-4 formheadingdiv01">Qualifying Five</h5>
							<div class="rowdiv1">
                           <div class="row padd-div">
                              <div class="col-sm-8 col-md-4 align-self-center">
                                 <div class="form-group fild-width">
                                    <label>CN29 completed under Task Tab in SAP or in the Notification Long Text?</label>
                                 </div>
                              </div>
                              <div class="col-sm-4 col-md-2 align-self-center">
                                 <div class="outerDivFull">
                                    <div class="switchToggle">
                                       <input type="checkbox" readonly name="name" value="" id="CN29_in_SAP" disabled>
                                       <label for="CN29_in_SAP">Toggle</label>
                                    </div>
                                    <!--<div class="switchToggle">
                                       <input type="checkbox" name="name" value="" id="switch1" >
                                       <label for="switch1">Toggle</label>
                                       </div>-->
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group class-color_div">
                                  <textarea rows="2" readonly id="CN29_in_SAP_cmt" value="" class="form-control bg-white" placeholder=""></textarea>
                                 </div>
                                 <span class="errorcmt" readonly id="errorcmt" style="display:none;color:red;">Please Enter Notes</span>
                              </div>
                           </div>
                           <div id="qualfi" class="">
                              <div class="row padd-div CN24-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Has the work been completed ?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="CN24">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="CN24_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="errorCN24_cmt" style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                              <div class="row padd-div gas_assets_installed-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Was any gas assets (ex. valve, pipe, Etc.) installed?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="gas_assets_installed">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="gas_assets_installed_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="errorgas_assets_installed_cmt" style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                              <div class="row padd-div installation_below_ground-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Installation took place below ground?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="installation_below_ground">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="installation_below_ground_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="errorinstallation_below_ground_cmt" style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                              <div class="row padd-div MOI-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>What is the Method of Installation (MOI)</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" id="errorMOI_cmt" readonly style="display:none;color:red;">Please Enter Notes</span>
                                 </div>
                              </div>
                           </div>
						    </div>
							  <h5 class="font-strong mb-4 pt-4 formheadingdiv01">Checklist Questions</h5>
							  <div class="rowdiv1 mb-3">
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Was Display Notification in SAP Reviewed </label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="outerDivFull">
                                       <div class="switchToggle">
                                          <input type="checkbox" name="name" readonly value="" id="SAP_Reviewed">
                                          <label for="SAP_Reviewed">Toggle</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" value="" readonly id="SAP_Reviewed_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>MOI for Srv (s)?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="MOI_for_Srv">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="MOI_for_Srv_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>MOI for Main (s)?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="MOI_for_Main">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="MOI_for_Main_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Type of document used to determine the MOI</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="determine_the_MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="determine_the_MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Which software was used to retrieve the document (Ex. Unifier, ECTS, SAP) </label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="used_to_retrieve_the_document">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="used_to_retrieve_the_document_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Doc Number From SAP</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="outerDivFull">
                                       <div class="switchToggle select-box-div">
                                          <input type="text" readonly value="" id="SAP" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="SAP_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>PRE- Inspection Document (s) Provided?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="PRE_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Post Inspection Required per PRE-Inspection Document (s)?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                      <input type="text" readonly class="form-control" id="Post_Inspection_Required_per_PRE_Inspection">
                                        
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="Post_Inspection_Required_per_PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>POST- Inspection Document (s) Provided?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="POST_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="POST_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Cross Bore Log (s) Ready for Inspection ?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-3 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="Cross_Bore_Log">                                          
                                    </div>
                                    <!--<div class="outerDivFull">
                                       <div class="switchToggle">
                                           <input type="checkbox" name="name" value="" id="Cross_Bore_Log">
                                           <label for="Cross_Bore_Log">Toggle</label>
                                       </div>
                                       </div>-->
                                 </div>
                                 <div class="col-sm-12 col-md-5">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" id="Cross_Bore_Log_cmt" readonly class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Recommendation</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-8">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" id="recommendation" readonly class="form-control bg-white" placeholder=""></textarea>
                                     </div>
                                 </div>
                              </div>
                              <!-- <div class="row padd-div">-->
                              <!--   <div class="col-sm-8 col-md-4 align-self-center">-->
                              <!--      <div class="form-group fild-width">-->
                              <!--         <label>Reason for reject if any  ?</label>-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--   <div class="col-sm-12 col-md-8">-->
                              <!--      <div class="form-group class-color_div">-->
                              <!--        <textarea rows="2" id="reject_cmt" class="form-control bg-white" placeholder=""></textarea>-->
                              <!--        <span class="error errorcomment"></span>-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--</div>-->
                              <div class="download-icondiv">
                                    <!--<a><button type="button" onclick="return Reject()" class="btn btn-danger approvediv-color mr-2 mb-2">Reject</button></a>-->

                                    <!--<a><button onclick="return Approveview()" type="button" class="btn btn-primary approvediv-color mr-2 mb-2" id="submit">Approve</button></a>-->
									<a><button type="button" onclick="return downloadpdf()" class="btn btn-primary approvediv-color mr-2 mb-2">Download PDF</button></a>
                                 </div>
                          <!--<div class="">-->
                          <!--    <button onclick="return Reject()" class="btn btn-danger">Reject</button>-->
                          <!--</div>-->
						   </div>
                            </form>
                        </div>
                       
                     </div>
                  </div> </div>        
          
              
            <!-- END PAGE CONTENT-->
         <?php include('../footer_review.php');  ?>  
          <!--<script src="https://crossdemo.epikso.com/cb_review/crossbore_main.js"></script>-->
          <script src="../crossbore_main.js"></script>
         <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
          <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
          <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    
 <script>


// function downloadpdf() {
//   var approveby = $('#USERID').val();
// var order_no = $('#OREDRNO').val();
//  window.location.href='GenPdf.php?id='+approveby+'&ono='+order_no
// }  

</script>

<script>
// $(document).ready(function(){
//     $( "#reject_cmt" ).focus(function() {
//  $('.errorcomment').text('');
//                             });
// });
</script>
<script>
  $(document).ready(function() {
    $('.datatable').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[20];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
} );
  </script>
  
    <script>
 function ApproveAll() {
  var order_no = '<?= $allorderno ?>';
  var approveby = '<?= $userid ?>';

Lobibox.confirm({
            msg: 'Are you sure want to Approve All jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'ApproveAll'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                     location.reload();
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
      
 
    }
    function Approve50() {
  var order_no = '<?= $allorderno ?>';
var approveby = '<?= $userid ?>';
Lobibox.confirm({
            msg: 'Are you sure want to Approve 50 jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Approve50'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                     location.reload();
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
      
 
    }
</script>
 <script>

           
//$(document).ready(function() {
  //$(document).on('change','.datepicker2',function() {
    //     $("#submit").on("click", function() {
    function Approve() {
        
             var approveby = '<?= $userid ?>';
         var order_no = new Array();
$.each($("input[name='reviewer[]']:checked"), function() {
  order_no.push($(this).val());
  // or you can do something to the actual checked checkboxes by working directly with  'this'
  // something like $(this).hide() (only something useful, probably) :P
});
if(order_no==''){
  $('#error').text('Please select atleast one job');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to Approve selected jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Approve'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                      location.reload();
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
    }  
    
  function Approveview() {
      $('.errorcomment').text('');
             var approveby = '<?= $userid ?>';
         var order_no = $('#OREDRNO').val();
if(order_no==''){
  $('.errorcomment').text('Please select atleast one job');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to Approve this jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Approveview'}
                                    });
                                  
                                    request.done(function(msg) {
                                     //console.log(msg);
                                      location.reload();
                                  //alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                   //alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
    }     
    
function Reject() {
             var approveby = '<?= $userid ?>';
         var order_no = $('#order_no').val();
 var comment = $('#reject_cmt').val();

if(comment==''){
  $('.errorcomment').text('Please enter the commnet');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to Reject this job.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {approveby:approveby,order_no:order_no,form_type:'Reject',comment:comment}
                                    });
                                  
                                    request.done(function(msg) {
                                    // console.log(msg);
                                       location.reload();
                                //  alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                //    alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
    }      
//});
//});

function downloadpdf() {
  var approveby = $('#USERID').val();
var order_no = $('#OREDRNO').val();
//alert (approveby + order_no);
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