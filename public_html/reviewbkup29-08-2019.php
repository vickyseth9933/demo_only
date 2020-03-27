<?php
ob_start();
include('header.php');
?>
<link href="assets/css/select2.css" rel="stylesheet" />
<?php
$userid = $_SESSION['userid'];
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
date_default_timezone_set("America/Los_Angeles");
$serverLink = 'https://'.$_SERVER['HTTP_HOST'].'/';
$order_id = base64_decode($_REQUEST['id']);
$idd = $_REQUEST['id'];
if($idd=='')
{
header("Location: ".$serverLink."reviewer-dashboard.php");    
}
$order_no = base64_decode($_REQUEST['ono']);
$query = "SELECT id FROM cb_front_cover WHERE order_id='$order_no' AND user_id='$userid'";
$result = $conn->query($query);
$rowcount=mysqli_num_rows($result);
//$check_front_cover = $result->fetch_assoc();
//$checklanid = $check_front_cover['reviewerlanid'];
 if($rowcount==1){
   $sql = "SELECT cb_project_details.cn24_date as CN24_SAP_DATE,cb_project_details.cn29_date as CN29_SAP_DATE,cb_project_details.cn07_date as CN07_SAP_DATE,cb_order_new.order_no,DATE_FORMAT(cb_order_new.approved_date,'%m/%d/%Y') as approved_date,cb_order_new.commnets_of_reject,cb_order_new.reject_status,cb_order_new.order_stage,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_user.city,cb_front_cover.project_id,cb_front_cover.dateofreview as created_on,cb_front_cover.reviewcompletiondate,cb_front_cover.order_description as description,cb_front_cover.resp_group,cb_front_cover.division,cb_front_cover.city as city_name,cb_front_cover.cn_29_eligible,cb_front_cover.fc_cm,cb_front_cover.ce_rcm,cb_front_cover.foreman,cb_front_cover.m_c_supervisor,cb_front_cover.distribution_transmission,cb_front_cover.inspector,
cb_front_cover.reviewerlanid as lanid,cb_project_details.*,qualiflying_five.CN29_in_SAP,qualiflying_five.CN24,qualiflying_five.gas_assets_installed,qualiflying_five.installation_below_ground,qualiflying_five.MOI,qualiflying_five.CN29_in_SAP_cmt,qualiflying_five.CN24_cmt,qualiflying_five.gas_assets_installed_cmt,qualiflying_five.installation_below_ground_cmt,qualiflying_five.MOI_cmt,distribution_checklist.* FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id='$order_no')
INNER JOIN cb_project_details ON(cb_project_details.order_id='$order_no')
INNER JOIN qualiflying_five ON(qualiflying_five.order_id='$order_no')
INNER JOIN distribution_checklist ON(distribution_checklist.order_id='$order_no')
WHERE cb_order_new.user_id = $userid AND cb_order_new.order_no='$order_no'";
 }else{
$sql = "SELECT cb_order_new.CN24_SAP_DATE,cb_order_new.CN29_SAP_DATE,cb_order_new.CN07_SAP_DATE,cb_order_new.*,cb_user.first_name,cb_user.last_name,cb_user.lanid,cb_user.city FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
WHERE cb_order_new.user_id = $userid AND cb_order_new.order_no='$order_no'";     
 }
$result = $conn->query($sql);
$row = $result->fetch_assoc();

/* $result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result); */
		
// print_r($row);
?>
        <!-- END HEADER-->
<style>
/*.custompopup .close{*/
/*    margin: 0;*/
/*    font-size: 20px;*/
/*    font-family: inherit;*/
/*    font-style: normal;*/
/*    font-variant: normal;*/
/*    text-transform: none;*/
/*    opacity: .5;*/
/*    cursor: pointer;*/
/*    position: absolute;*/
/*    right: 10px;*/
/*    z-index: 9;*/
/*    top: 6px;*/
/*}*/
/*.custompopup .close::before{*/
/*    display:none;*/
/*}*/
/*   .errorcls {*/
/*color: red;*/
/*font-size: 12px;*/
/*display: block;*/
/*} */
/*    .datepicker {*/
/*    position: relative;*/
/*    width: 150px; height: 20px;*/
/*    color: white;*/
/*}*/

/*.datepicker:before {*/
    
/*    top: 3px; left: 3px;*/
/*    content: attr(data-date);*/
/*    display: inline-block;*/
/*    color: black;*/
/*    width: 100%;*/
/*}*/

/*.datepicker::-webkit-datetime-edit, .datepicker::-webkit-inner-spin-button, .datepicker::-webkit-clear-button {*/
/*    display: none;*/
/*}*/

/*.datepicker::-webkit-calendar-picker-indicator {*/
      
/*    top: 0;*/
/*    right: 0;*/
/*    color: black;*/
/*    opacity: 1;*/
/*}*/
.modal-header .close {
    padding: 1rem 2rem;
    margin: -1rem -1rem -1rem auto;
    font-size: 27px;
}
.errorcls{
    color:red;
}
.errorclslanid {

    color: red;
    text-align: left;
    float: right;
    position: relative;
    left: 150px;
    width: 228px;

}
select#determine_the_MOI {
    height: 46px;
    white-space: pre-wrap;
}
.select2.narrow {
    width: 200px;
}
.wrap.select2-selection--single {
    height: 100%;
}
.select2-container .wrap.select2-selection--single .select2-selection__rendered {
    word-wrap: break-word;
    text-overflow: inherit;
    white-space: normal;
}
</style>
        <div class="container mk">
            <div class="content-wrapper">
                <!-- START PAGE CONTENT-->
                <div class="page-content fade-in-up mb-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="form-wizard" action="javascript:;" method="post" novalidate="novalidate" class="mform stepForm">
                                        <h6><span class="step">1 </span> <span class="desc">Cover sheet</span></h6>
                                        <section>
                                            <h3>Cover Sheet</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Reviewer LANID</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="<?= htmlentities($row['lanid'], ENT_QUOTES); ?>" id="lanid" onInput="validatelanid()"  class="form-control" placeholder="">
                                                        </div>
                                                        <span class="errorclslanid" id="errorlanid" style="display:none;">Please enter valid four letters LANID</span>
                                                    </div>
                                                   

                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Created On</label>
                                                        <div class="col-sm-7">
                                                            <?php $cur_date = date("m/d/Y")?>
                                                            <input type="text" readonly  value="<?php echo $cur_date;?>" id="review_date" class="form-control">
                                                            <!--<input type="text" readonly  value="<?php //echo $created_date = date("m/d/Y", strtotime($row[created_on]) );?>" id="review_date" class="form-control">-->
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Reviewer Completion Date</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" placeholder="MM/DD/YYYY" value="<?php if($row[approved_date]=='00/00/0000' || $row[approved_date]==null){ echo '';  }else{ echo  $row[approved_date]; } ; ?>" id="review_completion_date" disabled class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Order Number</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" readonly value="<?= $row[order_no]; ?>" id="order_no" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Project ID</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="<?= htmlentities($row['project_id'], ENT_QUOTES); ?>" id="project_id" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Division</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="<?= htmlentities($row['division'], ENT_QUOTES); ?>" id="division" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">City</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="<?= htmlentities($row['city_name'], ENT_QUOTES); ?>" id="city" class="form-control">
                                                        </div>
                                                    </div>

                                                    

                                                </div>
                                                <div class="col-lg-6">                                                   

                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Order Description</label>
                                                        <div class="col-sm-7">
                                                            <textarea type="text" value="<?= htmlentities($row['description'], ENT_QUOTES); ?>" id="order_description" class="form-control"><?= $row[description]; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">FE/CM</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="<?= htmlentities($row['fc_cm'], ENT_QUOTES); ?>" id="FE_CM" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">CE/RCM</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="<?= htmlentities($row['ce_rcm'], ENT_QUOTES); ?>" id="CE_RCM" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Foreman</label>
                                                        <div class="col-sm-7">
                                                            <input type="text"  value="<?= htmlentities($row['foreman'], ENT_QUOTES); ?>" id="foreman" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">M&C Supervisor</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="<?= htmlentities($row['m_c_supervisor'], ENT_QUOTES); ?>" id="m_c_supervisor" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Distribution/Transmission</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control valid" aria-invalid="false" id="Distribution_Transmission">
                                                                <?php if($row['distribution_transmission'] == ''){ ?>
                                                                <option value="">Please Select</option>
                                                                  <?php   } ?>
                                                              <option value="Distribution"<?php if($row['distribution_transmission'] == 'Distribution'): ?> selected="selected"<?php endif; ?>>Distribution</option>
                                                              <option value="Transmission"<?php if($row['distribution_transmission'] == 'Transmission'): ?> selected="selected"<?php endif; ?>>Transmission</option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    
                                                     <div class="form-group row">
                                                        <label class="col-sm-5 col-form-label">Resp Group</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control valid" aria-invalid="false" id="resp_gp">
                                                                <?php if($row['resp_group'] == ''){ ?>
                                                                <option value="">Please Select</option>
                                                                  <?php   } ?>
                                                              <option value="T&D Operations"<?php if(strtolower($row['resp_group']) == strtolower('T&D Operations')): ?> selected="selected"<?php endif; ?>>T&D Operations</option>
                                                              <option value="T&D Construction"<?php if(strtolower($row['resp_group']) == strtolower('T&D Construction')): ?> selected="selected"<?php endif; ?>>T&D Construction</option> 
                                                              <option value="UNKNOWN"<?php if(strtolower($row['resp_group']) == strtolower('UNKNOWN')): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                            </div>
                                            <?php   if($row['commnets_of_reject']!=''  && $row['reject_status']=='1'){  ?>
                                                   <div class="row">
                                                        <label class="col-sm-2 text-right">Reason For Reject</label>
                                                        <div class="col-sm-10"> 
                                                    <textarea readonly value="<?= htmlentities($row['commnets_of_reject'], ENT_QUOTES); ?>" class="form-control commnets_of_reject"><?= $row['commnets_of_reject'] ?></textarea>
                                              </div>
                                            </div>
                                            <?php  } ?>
                                        </section>
                                        <!--<a href="resources.php" id="gotorev">ccc</a>-->
                                        <h6><span class="step">2 </span> <span class="desc">Project Details</span></h6>

                                        <section class="mstp2">
                                            <h3>Project Details</h3>

                                            <div class="row">
                                                <div class="col-sm-12 col-lg-7 col-xl-6">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>MAT</label>
                                                                <input type="text" value="<?= htmlentities($row['mat'], ENT_QUOTES); ?>" id="mat" class="form-control">
                                                                <span>&nbsp;</span>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" value="" <?php if($row['MAT_check'] == 'true'): ?> checked="checked"<?php endif; ?> class="custom-control-input" id="Checkmat">
                                                                    <label class="custom-control-label" for="Checkmat"></label>
                                                                </div>
                                                                
                                                                <span class="errorcls" id="errormat" style="display:none;">Please Select checkbox for MAT</span>
                                                                <!--<span class="error" style="color:red;font-size:12px;display:block;">Please Select checkbox for MAT</span>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>CN24</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="cn24">
                                                                    <?php if($row['cn24'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="COMP"<?php if($row['cn24'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                    <option value="INPR"<?php if($row['cn24'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text"  value="<?= htmlentities($row['cn24_lanid'], ENT_QUOTES); ?>" id="cn24_lanid" class="form-control" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" value="<?= htmlentities($row['CN24_SAP_DATE'], ENT_QUOTES); ?>" id="cn24_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="MM/DD/YYYY">
                                                             </span>
                                                                <span>&nbsp;</span>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" value="" <?php if($row['CN24_check'] == 'true'): ?> checked="checked"<?php endif; ?> id="check_cn24" class="custom-control-input">
                                                                    <label class="custom-control-label" for="check_cn24"></label>
                                                                </div>
                                                                 <span class="errorcls" id="errorcn24" style="display:none;">Please Select checkbox for CN24</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>CN29</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="cn29">
                                                                    <?php if($row['cn29'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['cn29'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['cn29'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  value="<?= htmlentities($row['cn29_lanid'], ENT_QUOTES); ?>" id="cn29_lanid" type="text" class="form-control" placeholder="LAN ID">
                                                             </span>
                                                            
                                                                <span class="inlineInput">
                                                                <!--<input  type="text" value="<?= $row['CN29_SAP_DATE'] ?>" id="cn29_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="Date">-->
                                                                <input  type="text" value="<?php if(htmlentities($row['CN29_SAP_DATE'], ENT_QUOTES)!='0000-00-00'){ echo htmlentities($row['CN29_SAP_DATE'], ENT_QUOTES); } ?>" id="cn29_date"  class="form-control datepicker" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" placeholder="MM/DD/YYYY">
                                                             </span>
                                                                <span>&nbsp;</span>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" value="" <?php if($row['CN29_check'] == 'true'): ?> checked="checked"<?php endif; ?> class="custom-control-input" id="check_cn29">
                                                                    <label class="custom-control-label" for="check_cn29"></label>
                                                                </div>
                                                                 <span class="errorcls" id="errorcn29" style="display:none;">Please Select checkbox for CN29</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>CN07</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="cn07">
                                                                    <?php if($row['cn07'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="COMP"<?php if($row['cn07'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                    <option value="INPR"<?php if($row['cn07'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['cn07_lanid'], ENT_QUOTES); ?>" id="cn07_lanid" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?php if(htmlentities($row['CN07_SAP_DATE'], ENT_QUOTES)!='0000-00-00'){ echo htmlentities($row['CN07_SAP_DATE'], ENT_QUOTES); } ?>" id="cn07_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                                <span>&nbsp;</span>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" value="" <?php if($row['CN07_check'] == 'true'): ?> checked="checked"<?php endif; ?> class="custom-control-input" id="check_cn07">
                                                                    <label class="custom-control-label" for="check_cn07"></label>
                                                                </div>
                                                                <span class="errorcls" id="errorcn07" style="display:none;">Please Select checkbox for CN07</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>DC 39</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="dc39">
                                                                    <?php if($row['dc39'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['dc39'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['dc39'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                                <span class="errorcls" id="errorcn08" style="display:none;">Please Select checkbox for CN07</span>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['dc39_lanid'], ENT_QUOTES) ?>" id="dc39_lanid" placeholder="LAN ID">
                                                             </span>
                                                             <span class="errorcls" id="errorcnlanid" style="display:none;">Please enter lanid for CN07</span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?= htmlentities($row['dc39_date'], ENT_QUOTES); ?>" id="dc39_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                             <span class="errorcls" id="errorcndate" style="display:none;">Please Select date for CN07</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>DC 46</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="dc46">
                                                                    <?php if($row['dc46'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['dc46'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['dc46'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['dc46_lanid'], ENT_QUOTES); ?>" id="dc46_lanid" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?= htmlentities($row['dc46_date'], ENT_QUOTES); ?>" id="dc46_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>DC 05</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="dc05">
                                                                    <?php if($row['dc05'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['dc05'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['dc05'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['dc05_lanid'], ENT_QUOTES); ?>" id="dc05_lanid" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?= htmlentities($row['dc05_date'], ENT_QUOTES); ?>" id="dc05_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>DC 14</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="dc14">
                                                                    <?php if($row['dc14'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['dc14'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['dc14'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['dc14_lanid'], ENT_QUOTES); ?>" id="dc14_lanid" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?= htmlentities($row['dc14_date'], ENT_QUOTES); ?>" id="dc14_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>DC 15</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="dc15">
                                                                     <?php if($row['dc15'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['dc15'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['dc15'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['dc15_lanid'], ENT_QUOTES); ?>" id="dc15_lanid" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?= htmlentities($row['dc15_date'], ENT_QUOTES); ?>" id="dc15_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>DC 19</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="dc19">
                                                                     <?php if($row['dc19'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['dc19'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['dc19'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['dc19_lanid'], ENT_QUOTES); ?>" id="dc19_lanid" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?= htmlentities($row['dc19_date'], ENT_QUOTES); ?>" id="dc19_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width label-width">
                                                                <label>DC 10</label>
                                                                <span class="inlineInput">
                                                                <select class="form-control" id="dc10">
                                                                     <?php if($row['dc10'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                                    <option value="INPR"<?php if($row['dc10'] == 'INPR'): ?> selected="selected"<?php endif; ?>>INPR</option>
                                                                    <option value="COMP"<?php if($row['dc10'] == 'COMP'): ?> selected="selected"<?php endif; ?>>COMP</option>
                                                                </select>
                                                            </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" class="form-control" value="<?= htmlentities($row['dc10_lanid'], ENT_QUOTES); ?>" id="dc10_lanid" placeholder="LAN ID">
                                                             </span>
                                                                <span class="inlineInput">
                                                                <input  type="text" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="<?= htmlentities($row['dc10_date'], ENT_QUOTES); ?>" id="dc10_date" placeholder="MM/DD/YYYY">
                                                             </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-5 col-xl-6">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group fild-width">
                                                                <label>General comments for SAP task (CN/DC): </label>
                                                                <textarea rows="12" value="<?php echo htmlentities($row['cmt_cn_dc'], ENT_QUOTES) ?>" id="cmt_cn_dc" class="form-control"><?php echo htmlentities($row['cmt_cn_dc'], ENT_QUOTES); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div></div>
                                                <?php   if($row['commnets_of_reject']!=''  && $row['reject_status']=='1'){  ?>
                                                   <div class="row">
                                                       <div class="col-sm-2 text-right">
                                                        <label >Reason For Reject</label>
                                                        </div>
                                                        <div class="col-sm-10"> 
                                                    <textarea readonly value="<?= htmlentities($row['commnets_of_reject'], ENT_QUOTES); ?>" class="form-control commnets_of_reject"><?= htmlentities($row['commnets_of_reject'], ENT_QUOTES); ?></textarea>
                                              </div>
                                            </div>
                                            <?php  } ?>
                                        </section>
                                        <h6><span class="step">3 </span> <span class="desc">Qualifying Five</span></h6>
                                        <section class="mstp3">
                                            <h3>Qualifying Five</h3>
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>CN29 completed under Task Tab in SAP or in the Notification Long Text?</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="outerDivFull">
                                                        <div class="switchToggle">
                                                            <input type="checkbox" name="name"   value="<?php echo $row['CN29_in_SAP'] ?>" <?php if($row['CN29_in_SAP'] == '1'): ?>  checked <?php endif; ?> id="CN29_in_SAP">
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
                                                        <textarea class="form-control textareas" rows="2" id="CN29_in_SAP_cmt" value="<?php echo htmlentities($row['CN29_in_SAP_cmt'], ENT_QUOTES); ?>" placeholder=" TXEJ completed SAP task (CN 29);&#13;&#10; Notes found in long text completed by ABC1"><?php echo htmlentities($row['CN29_in_SAP_cmt'], ENT_QUOTES); ?></textarea>

                                                    </div>
                                                    <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
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
                                                        <select class="form-control Qualify" id="CN24">
                                                            <?php if($row['CN24'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                            <option value="Yes" <?php if($row['CN24'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option>
                                                            <option value="No" <?php if($row['CN24'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option>
                                                            <option value="Unknown" <?php if($row['CN24'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control textareas" rows="2" value="<?php echo  htmlentities($row['CN24_cmt'], ENT_QUOTES); ?>" id="CN24_cmt"  placeholder=" Mapping dates completed and skipped CN 24 & CN 07 SAP task."><?php echo htmlentities($row['CN24_cmt'], ENT_QUOTES); ?></textarea>
                                                        </textarea>
                                                    </div>
                                                      <span class="errorcmt" id="errorCN24_cmt" style="display:none;color:red;">Please enter your comments</span>
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
                                                        <select class="form-control Qualify" id="gas_assets_installed">
                                                             <?php if($row['gas_assets_installed'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                            <option value="Yes" <?php if($row['gas_assets_installed'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option>
                                                            <option value="No" <?php if($row['gas_assets_installed'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option>
                                                            <option value="Unknown" <?php if($row['gas_assets_installed'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <!--<textarea   class="form-control textareas" rows="2" value="<?php echo htmlentities($row['gas_assets_installed_cmt'], ENT_QUOTES); ?>"  id="gas_assets_installed_cmt" placeholder="  Yes, Gas assets installed (main & Srv's) No, Paving only (Above ground)"><?php echo htmlentities($row['gas_assets_installed_cmt'], ENT_QUOTES); ?></textarea>-->
                                                        <textarea   class="form-control textareas" rows="2" value="<?php echo htmlentities($row['gas_assets_installed_cmt'],ENT_QUOTES); ?>"  id="gas_assets_installed_cmt" placeholder="  Yes, Gas assets installed (main & Srv's) &#13;&#10;  No, Paving only (Above ground)"><?php echo htmlentities($row['gas_assets_installed_cmt'], ENT_QUOTES); ?></textarea>
                                                    </div>
                                                     <span class="errorcmt" id="errorgas_assets_installed_cmt" style="display:none;color:red;">Please enter your comments</span>
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
                                                        <select class="form-control Qualify" id="installation_below_ground">
                                                             <?php if($row['installation_below_ground'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                            <option value="Yes" <?php if($row['installation_below_ground'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option>
                                                            <option value="No" <?php if($row['installation_below_ground'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option>
                                                            <option value="Unknown" <?php if($row['installation_below_ground'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control textareas" rows="2" value="<?php echo htmlentities($row['installation_below_ground_cmt'], ENT_QUOTES); ?>"  id="installation_below_ground_cmt"   placeholder="  No,  above ground work ( riser ONLY) assets installed (main & Srv's)"><?php echo htmlentities($row['installation_below_ground_cmt'], ENT_QUOTES); ?></textarea>
                                                    </div>
                                                    <span class="errorcmt" id="errorinstallation_below_ground_cmt" style="display:none;color:red;">Please enter your comments</span>
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
                                                        <select class="form-control Qualify" id="MOI">
                                                            <?php if($row['MOI'] == ''){ ?>
                                                                    <option value="">Please Select</option>
                                                                    <?php   } ?>
                                                            <option value="Trenchless" <?php if($row['MOI'] == 'Trenchless'): ?> selected="selected"<?php endif; ?>>Trenchless</option>
                                                            <option value="100% Trench" <?php if($row['MOI'] == '100% Trench'): ?> selected="selected"<?php endif; ?>>100% Trench</option>
                                                            <option value="Unknown" <?php if($row['MOI'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control textareas" rows="2" value="<?php echo htmlentities($row['MOI_cmt'], ENT_QUOTES); ?>"  id="MOI_cmt"   placeholder="  Gas assets installed (main & Srv's)"><?php echo htmlentities($row['MOI_cmt'], ENT_QUOTES); ?></textarea>
                                                    </div>
                                                    <span class="errorcmt" id="errorMOI_cmt" style="display:none;color:red;">Please enter your comments</span>
                                                </div>
                                            </div>
                                        </div>
                                       <?php   if($row['commnets_of_reject']!=''  && $row['reject_status']=='1'){  ?>
                                                   <div class="row">
                                                        <label class="col-sm-2 text-right">Reason For Reject</label>
                                                        <div class="col-sm-10"> 
                                                    <textarea readonly value="<?= htmlentities($row['commnets_of_reject'], ENT_QUOTES); ?>" class="form-control commnets_of_reject"><?= htmlentities($row['commnets_of_reject'], ENT_QUOTES); ?></textarea>
                                              </div>
                                            </div>
                                            <?php  } ?>
										</section>
                                        <h6><span class="step">4 </span> <span class="desc">Checklist Questions</span></h6>
                                        <section class="mstp4">
                                            <h3>Checklist Questions</h3>
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>Was Display Notification in SAP Reviewed </label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="outerDivFull">
                                                        <div class="switchToggle">
                                                            <input type="checkbox"  name="name" value="<?php echo $row['SAP_Reviewed'] ?>" <?php if($row['SAP_Reviewed'] == '1'): ?> checked="checked"<?php endif; ?> id="SAP_Reviewed">
                                                            <label for="SAP_Reviewed">Toggle</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['SAP_Reviewed_cmt'], ENT_QUOTES); ?>" id="SAP_Reviewed_cmt"   placeholder=" Yes, Obtained from Construction Drawings; &#13;&#10; No, 100% Open Trench Unknown, Unable to verify"><?php echo htmlentities($row['SAP_Reviewed_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="row padd-div">-->
                                            <!--    <div class="col-sm-8 col-md-4 align-self-center">-->
                                            <!--        <div class="form-group fild-width">-->
                                            <!--            <label> Trenchless MOI?</label>-->

                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--    <div class="col-sm-4 col-md-2 align-self-center">-->
                                            <!--        <div class="select-box-div">-->
                                            <!--            <select class="form-control" id="Trenchless_MOI">-->
                                            <!--                <?php //if($row['Trenchless_MOI'] == ''){ ?>-->
                                            <!--                <option value="">Please Select</option>-->
                                            <!--                <?php   //} ?>-->
                                            <!--                <option value="Yes" <?php //if($row['Trenchless_MOI'] == 'Yes'): ?> selected="selected"<?php //endif; ?>>Yes</option>-->
                                            <!--                <option value="No" <?php //if($row['Trenchless_MOI'] == 'No'): ?> selected="selected"<?php //endif; ?>>No</option>-->
                                            <!--                <option value="Unknown" <?php //if($row['Trenchless_MOI'] == 'Unknown'): ?> selected="selected"<?php //endif; ?>>Unknown</option>-->
                                            <!--            </select>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--    <div class="col-sm-12 col-md-6">-->
                                            <!--        <div class="form-group class-color_div">-->
                                            <!--            <textarea class="form-control textareas" rows="2" value="<?php echo $row['Trenchless_MOI_cmt'] ?>" id="Trenchless_MOI_cmt"   placeholder=" 47 Srv and 4 different MOI's (HDD, Splitting, Dry Bore)"><?php echo $row['Trenchless_MOI_cmt'] ?></textarea>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>MOI for Srv (s)?</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="MOI_for_Srv">
                                                            <?php if($row['MOI_for_Srv'] == ''){ ?>
                                                            <option value="">Please Select</option>

                                                         <?php   } ?>
                                                            <option value="Trench" <?php if($row['MOI_for_Srv'] == 'Trench'): ?> selected="selected"<?php endif; ?>>Trench</option>
                                                            <option value="HDD" <?php if($row['MOI_for_Srv'] == 'HDD'): ?> selected="selected"<?php endif; ?>>HDD</option>
                                                            <option value="Splitting" <?php if($row['MOI_for_Srv'] == 'Splitting'): ?> selected="selected"<?php endif; ?>>Splitting</option>
                                                            <option value="Dry Bore" <?php if($row['MOI_for_Srv'] == 'Dry Bore'): ?> selected="selected"<?php endif; ?>>Dry Bore</option>
                                                            <option value="Insert" <?php if($row['MOI_for_Srv'] == 'NA'): ?> selected="selected"<?php endif; ?>>Insert</option>
                                                            <option value="NA" <?php if($row['MOI_for_Srv'] == 'Yes'): ?> selected="selected"<?php endif; ?>>NA</option>
                                                            <option value="Unknown" <?php if($row['MOI_for_Srv'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['MOI_for_Srv_cmt'], ENT_QUOTES); ?>" id="MOI_for_Srv_cmt"   placeholder=" 4 different Mains and all main was HDD."><?php echo htmlentities($row['MOI_for_Srv_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>MOI for Main (s)?</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="MOI_for_Main">
                                                             <?php if($row['MOI_for_Main'] == ''){ ?>
                                                            <option value="">Please Select</option>

                                                         <?php   } ?>
                                                           <option value="Trench" <?php if($row['MOI_for_Main'] == 'Trench'): ?> selected="selected"<?php endif; ?>>Trench</option>
                                                            <option value="HDD" <?php if($row['MOI_for_Main'] == 'HDD'): ?> selected="selected"<?php endif; ?>>HDD</option>
                                                            <option value="Splitting" <?php if($row['MOI_for_Main'] == 'Splitting'): ?> selected="selected"<?php endif; ?>>Splitting</option>
                                                            <option value="Dry Bore" <?php if($row['MOI_for_Main'] == 'Dry Bore'): ?> selected="selected"<?php endif; ?>>Dry Bore</option>
                                                            <option value="Insert" <?php if($row['MOI_for_Main'] == 'Insert'): ?> selected="selected"<?php endif; ?>>Insert</option>
                                                            <option value="NA" <?php if($row['MOI_for_Main'] == 'NA'): ?> selected="selected"<?php endif; ?>>NA</option>
                                                            <option value="Unknown" <?php if($row['MOI_for_Main'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['MOI_for_Main_cmt'], ENT_QUOTES); ?>" id="MOI_for_Main_cmt" placeholder=" 4 different Mains and all main was HDD."><?php echo htmlentities($row['MOI_for_Main_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>Type of document used to determine the MOI</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="determine_the_MOI">
                                                             <?php if($row['determine_the_MOI'] == ''){ ?>
                                                            <option value="">Please Select</option>

                                                         <?php   } ?>
                                                            <option class="wrap-div" value="Construction Drawings & GSR" <?php if($row['determine_the_MOI'] == 'Construction Drawings & GSR’s'): ?> selected="selected"<?php endif; ?>>Construction Drawings & GSR’s</option>
                                                            <option value="GSRs" <?php if($row['determine_the_MOI'] == "GSRs"): ?> selected="selected"<?php endif; ?>>GSRs</option>
                                                            <option value="Cross Bore Logs" <?php if($row['determine_the_MOI'] == 'Cross Bore Logs'): ?> selected="selected"<?php endif; ?>>Cross Bore Logs</option>
                                                            <option value="Other" <?php if($row['determine_the_MOI'] == 'Other'): ?> selected="selected"<?php endif; ?>>Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['determine_the_MOI_cmt'], ENT_QUOTES); ?>" id="determine_the_MOI_cmt" placeholder="Found MOI in multiple drawings (pg.. 1 & 5 of Construction Drawings)"><?php echo htmlentities($row['determine_the_MOI_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
											
											<div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>Which software was used to retrieve the document (Ex. Unifier, ECTS, SAP) </label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="used_to_retrieve_the_document">
                                                           <?php if($row['used_to_retrieve_the_document'] == ''){ ?>
                                                            <option value="">Please Select</option>
                                                           <?php   } ?>
                                                            <option value="Unifer" <?php if($row['used_to_retrieve_the_document'] == 'Unifer'): ?> selected="selected"<?php endif; ?>>Unifer</option>
															<option value="SAP" <?php if($row['used_to_retrieve_the_document'] == 'SAP'): ?> selected="selected"<?php endif; ?>>SAP</option>
															<option value="PSRS" <?php if($row['used_to_retrieve_the_document'] == 'PSRS'): ?> selected="selected"<?php endif; ?>>PSRS</option>
                                                            <option value="Other" <?php if($row['used_to_retrieve_the_document'] == 'Other'): ?> selected="selected"<?php endif; ?>>Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['used_to_retrieve_the_document_cmt'], ENT_QUOTES); ?>" id="used_to_retrieve_the_document_cmt" placeholder=" Unifier , Folder submittal under tab Project Management."><?php echo htmlentities($row['used_to_retrieve_the_document_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
											
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>Doc Number From SAP</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="outerDivFull">
                                                        <div class="switchToggle">
                                                            <input type="text" value="<?php echo htmlentities($row['SAP'], ENT_QUOTES); ?>" id="SAP" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['SAP_cmt'], ENT_QUOTES); ?>" id="SAP_cmt" placeholder="If multiple Doc Numbers place the remaining here "><?php echo htmlentities($row['SAP_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>PRE- Inspection Document (s) Provided?</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="PRE_Inspection">
                                                             <?php if($row['PRE_Inspection'] == ''){ ?>
                                                            <option value="">Please Select</option>
                                                           <?php   } ?>
                                                            <option value="Yes" <?php if($row['PRE_Inspection'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option>
                                                            <option value="No" <?php if($row['PRE_Inspection'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option>
                                                            <option value="Unknown" <?php if($row['PRE_Inspection'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['PRE_Inspection_cmt'], ENT_QUOTES); ?>" id="PRE_Inspection_cmt" placeholder=" Pre-Logs obtained from SAP"><?php echo htmlentities($row['PRE_Inspection_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>Post Inspection Required per PRE-Inspection Document (s)?</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="Post_Inspection_Required_per_PRE_Inspection">
                                                             <?php if($row['Post_Inspection_Required_per_PRE_Inspection'] == ''){ ?>
                                                            <option value="">Please Select</option>
                                                           <?php   } ?>
                                                            <option value="Yes" <?php if($row['Post_Inspection_Required_per_PRE_Inspection'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option>
                                                            <option value="No" <?php if($row['Post_Inspection_Required_per_PRE_Inspection'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option>
                                                            <option value="NA" <?php if($row['Post_Inspection_Required_per_PRE_Inspection'] == 'NA'): ?> selected="selected"<?php endif; ?>>NA</option>
                                                            <option value="Unknown" <?php if($row['Post_Inspection_Required_per_PRE_Inspection'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['Post_Inspection_Required_per_PRE_Inspection_cmt'], ENT_QUOTES); ?>" id="Post_Inspection_Required_per_PRE_Inspection_cmt" placeholder=" Yes, Atleast  one (1) trenchless installed states post inspection is required.&#13;&#10; No, Srv Installed was plastic pipe Splitting Unknown, Not clear.
"><?php echo htmlentities($row['Post_Inspection_Required_per_PRE_Inspection_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>POST- Inspection Document (s) Provided?</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="POST_Inspection">
                                                            <?php if($row['POST_Inspection'] == ''){ ?>
                                                            <option value="">Please Select</option>
                                                           <?php   } ?>
                                                            <option value="Yes" <?php if($row['POST_Inspection'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option>
                                                            <option value="No" <?php if($row['POST_Inspection'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option>
                                                            <option value="NA" <?php if($row['POST_Inspection'] == 'NA'): ?> selected="selected"<?php endif; ?>>NA</option>
                                                            <option value="Unknown" <?php if($row['POST_Inspection'] == 'Unknown'): ?> selected="selected"<?php endif; ?>>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea class="form-control" rows="2" value="<?php echo htmlentities($row['POST_Inspection_cmt'], ENT_QUOTES); ?>" id="POST_Inspection_cmt" placeholder=" Logs Obtained from SAP; &#13;&#10; NA Post Inspect was NOT required per Pre-Inspection Logs"><?php echo htmlentities($row['POST_Inspection_cmt'], ENT_QUOTES); ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row padd-div"> -->
                                            <!-- <div class="col-sm-4 align-self-center"> -->
                                            <!-- <div class="form-group fild-width"> -->
                                            <!-- <label>Cross Bore Log (s) Ready for Inspection ?</label> -->

                                            <!-- </div> -->
                                            <!-- </div> -->
                                            <!-- <div class="col-sm-2 align-self-center"> -->
                                            <!-- <div class="outerDivFull" > -->
                                            <!-- <div class="switchToggle"> -->
                                            <!-- <input type="checkbox" name="name" value="" id="switch14"> -->
                                            <!-- <label for="switch14">Toggle</label> -->
                                            <!-- </div> -->
                                            <!-- </div> -->
                                            <!-- </div> -->
                                            <!-- <div class="col-sm-6"> -->
                                            <!-- <div class="form-group class-color_div"> -->
                                            <!-- <textarea class="form-control" rows="2" placeholder="Comment"></textarea> -->
                                            <!-- </div> -->
                                            <!-- </div> -->
                                            <!-- </div> -->
                                            <div class="row padd-div">
                                                <div class="col-sm-8 col-md-4 align-self-center">
                                                    <div class="form-group fild-width">
                                                        <label>Cross Bore Log (s) Ready for Inspection ?</label>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-2 align-self-center">
                                                    <div class="select-box-div">
                                                        <select class="form-control" id="Cross_Bore_Log">
                                                            <?php if($row['Cross_Bore_Log'] == ''){ ?>
                                                            <option value="">Please Select</option>
                                                           <?php   } ?>
                                                            <option value="Yes" <?php if($row['Cross_Bore_Log'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option>
                                                            <option value="No" <?php if($row['Cross_Bore_Log'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option>
                                                          
                                                    </select>
                                                    </div>
                                                    <!--<div class="outerDivFull">
                                                        <div class="switchToggle">
                                                            <input type="checkbox" name="name" value="<?php //echo $row['Cross_Bore_Log'] ?>" id="Cross_Bore_Log">
                                                            <label for="Cross_Bore_Log">Toggle</label>
                                                        </div>
                                                    </div>-->
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group class-color_div">
                                                        <textarea id="Cross_Bore_Log_Ready" class="form-control" rows="2"   placeholder=" Yes, Pre & Post Cross Bore Logs present.&#13;&#10; No,Post Logs not found in SAP and required per PRE-Inspection Logs."><?= $row['Cross_Bore_Log_cmt'] ?></textarea>
                                                        <span class="errorcmt" id="errorcmt" style="display:none;color:red;">Please enter your comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                           <?php   if($row['commnets_of_reject']!=''  && $row['reject_status']=='1'){  ?>
                                                   <div class="row">
                                                        <label class="col-sm-2 text-right">Reason For Reject</label>
                                                        <div class="col-sm-10"> 
                                                    <textarea readonly value="<?= htmlentities($row['commnets_of_reject'], ENT_QUOTES); ?>" class="form-control commnets_of_reject"><?= htmlentities($row['commnets_of_reject'], ENT_QUOTES); ?></textarea>
                                              </div>
                                            </div>
                                            <?php  } ?>
                                        </section>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------popup-form-start-form-here-------->

                    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded text-center">
        <div class="modal-header border-0 p-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                                 <div class="modal-body">
                                    
                                    <form class="editForm" action="#" method="post">
                                        <input type="hidden" value="2" id="status_job">
                                        <input type="hidden" value="" id="add_comment">
                                       
                                        <p></p>
                                        <div class="form-group roles-div">
                                            <p>This job with Order #<span class="order_number"> 34543 </span> is determined as <span class="job_status">CN-29 Eligible</span></p>
                                            <!--<a onClick="return RestartReview()" href="<?php echo $actual_link ?>"><span>Start Next Review</span></a>-->
                                            
                                            <div class="form-group row" id="cn29_eligible" style="display:none;">
                                                        <label class="col-sm-12 col-form-label">Recommendation:</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control valid select2 wrap" aria-invalid="false" name="recomandation" id="cn29eligible">
                                                                 <option value="">Please Select</option>
                                                                 
                                                               <option value="Desktop review required, QC Long Text entry">Desktop review required, QC Long Text entry</option>
                                                              <option value="Approve for Cross Bore validation, CN29 Complete in SAP">Approve for Cross Bore validation, CN29 Complete in SAP</option>
                                                              <option value="Approve for Cross Bore validation, MOI 100% Open Trench">Approve for Cross Bore validation, MOI 100% Open Trench</option>
                                                              <option value="Approve for Cross Bore validation, no subsurface work">Approve for Cross Bore validation, no subsurface work</option>
                                                              <option value="Approve for Cross Bore validation, no work was performed or no gas assets were installed">Approve for Cross Bore validation, no work was performed or no gas assets were installed</option>
                                                              <option value="Others">Others</option>
                                                           
                                                             </select>
                                                                <div class="form-group comment" style="display:none;">
                                                              <label for="comment">Comment:</label>
                                                                <textarea class="form-control textareaval" rows="5" id=""></textarea>
                                                                </div>
                                                            <span class="errorcmtrecom" style="display:none;color:red;">Please Select Recommendation</span> 
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group row" id="FieldRem" style="display:none;">
                                                        <label class="col-sm-12 col-form-label">Recommendation:</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control valid select2 wrap" aria-invalid="false" name="recomandation" id="fieldremidation">
                                                                 <option value="">Please Select</option>
                                                               <option value="Fieldwork required, missing pre- and/or post-inspection">Fieldwork required, missing pre- and/or post-inspection</option>
                                                              <option value="Desktop review required, missing post-inspection from files, project note(s) indicate post-inspection may have been performed">Desktop review required, missing post-inspection from files, project note(s) indicate post-inspection may have been performed</option> 
                                                              <option value="Desktop review required, post-inspection ready for review">Desktop review required, post-inspection ready for review</option>
                                                             <option value="Others">Others</option>
                                                            </select>
                                                              <div class="form-group comment" style="display:none;">
                                                              <label for="comment">Comment:</label>
                                                                <textarea class="form-control textareaval" rows="5" id=""></textarea>
                                                                </div>
                                                            <span class="errorcmtrecom" style="display:none;color:red;">Please Select Recommendation</span> 
                                                        </div>
                                                    </div>
                                                     <div class="form-group row" id="Unknownstatus" style="display:none;">
                                                        <label class="col-sm-12 col-form-label">Recommendation:</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control valid select2 wrap" aria-invalid="false" name="recomandation" id="unknownss">
                                                                 <option value="">Please Select</option>
                                                            <option  value="Cancel / delete order, very little / no project information indicating that work was assigned and/or performed">Cancel / delete order, very little / no project information indicating that work was assigned and/or performed</option>
                                                              <option value="Desktop review required, DC46 not started or is in process ">Desktop review required, DC46 not started or is in process </option>
                                                              <option value="Others">Others</option>
                                                              
                                                            </select>
                                                               <div class="form-group comment" style="display:none;">
                                                              <label for="comment">Comment:</label>
                                                                <textarea class="form-control textareaval" rows="5" id=""></textarea>
                                                                </div>
                                        <span class="errorcmtrecom" style="display:none;color:red;">Please Select Recommendation</span>                    
                                                        </div>
                                                    </div>
                                            <a onClick="return RestartReview()"><span>Send For Approval</span></a>
                                            <a onClick="return RestartReview()"><span>My Dashboard</span></a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
               <div id="wait" style="display:none;position:absolute;top:50%;left:50%;padding:2px;"><img src='assets/img/Spinner-1s-200px.gif' width="64" height="64" /></div>

                    <!-------popup-form-end-form-here----------->
                     <!-------popup-form-start-form-here-------->

                    

                    <!-- END PAGE CONTENT-->
<footer class="page-footer">
                        <div class="font-13">2019 ©</div>
                        <div class="px-3">
                            Design by: <a href="http://epikso.com" target="_blank">Epik Solutions</a>
                        </div>
                        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
                    </footer>
                </div>
            </div>
        </div>
        	<!-------input-form-start-form-here-------->
				
				
                    <div class="modal fade" id="modalRegisterForm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog divregisterform">
                            <div class="modal-content rounded text-center">
                                <div class="modal-header border-0 p-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                                <div class="modal-body">
                                    <form class="editForm" action="#" method="post">
                                        <p></p>
                                        <div class="form-group roles-div text-center">
                                            <p>Are you sure, this project is <span class="change_msg_status">CN 29 Eligible</span>?</p>
                                            <a href="" data-dismiss="modal" id="cn29status"><span>Yes</span></a>
                                            <a href=""  data-dismiss="modal" id="cn29statusnoo"><span>No</span></a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
                    
                    
                    
                    <div class="modal fade" id="modalRegisterForm4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog divregisterform">
                            <div class="modal-content rounded text-center">
                                <div class="modal-header border-0 p-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                                <div class="modal-body">
                                    <form class="editForm" action="#" method="post">
                                        <p></p>
                                        <div class="form-group roles-div text-center">
                                            <p>Are you sure, this project is <span class="">Field Remediation Required</span>?</p>
                                            <a href="" data-dismiss="modal" id="cn29status2"><span>Yes</span></a>
                                            <a href=""  data-dismiss="modal" id="cn29statusnoo2"><span>No</span></a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>

                    <!-------input-form-end-form-here----------->
        <!-- START SEARCH PANEL-->
        <!-- BEGIN PAGA BACKDROPS-->
        <div class="sidenav-backdrop backdrop"></div>
 <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div> 
        <!-- END PAGA BACKDROPS-->
        <!-- CORE PLUGINS-->
        <script src="assets/vendors/js/jquery.min.js"></script>
        <script src="assets/vendors/js/popper.min.js"></script>
        <script src="assets/vendors/js/bootstrap.min.js"></script>
        <script src="assets/vendors/js/metisMenu.min.js"></script>
        <script src="assets/vendors/js/jquery.slimscroll.min.js"></script>
        <script src="assets/vendors/js/toastr.min.js"></script>
        <script src="assets/vendors/js/jquery.validate.min.js"></script>
        <script src="assets/vendors/js/bootstrap-select.min.js"></script>
        <script src="assets/vendors/js/jquery.steps.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/js/select2.full.js"></script>

        <script>
$(document).ready(function(){

var $select2 = $('.select2').select2({
     containerCssClass: "wrap"
})
})

</script>
<script>

$( ".textareaval").keyup(function(e) {
    
    $('#add_comment').val(e.target.value);
    //alert($('textarea.textareaval ').val());
    //console.log('acc'+$(this).value);
});

         $(document).on('change','.recomandation',function() {
          $(".recomandation").parent().find(".errorcmtrecom").hide();    
        //  if(this.value!='') {
        //   $(".recomandation").parent().find(".errorcmtrecom").hide(); 
        //  }else{
             
        //  }
         if(this.value=='Others'){
           $(".recomandation").parent().find(".comment").show();
            
             
                                      
           
          }else{ 
                $(".comment").hide();   
            
          }
          });
</script>
        <script>
		
	  
	     $(document).on('change','#MOI_for_Srv',function() {
                                    if(this.value!='') {
                                   $('#MOI_for_Srv').css('border-color', '');
                                    }
                                  });
                                  
                                 $(document).on('change','#MOI_for_Main',function() {  
                                    if(this.value!='') {
                                   $('#MOI_for_Main').css('border-color', '');
                                    }
                                  });
                                  
                               $(document).on('change','#determine_the_MOI',function() { 
                                    if(this.value!='') {
                                   $('#determine_the_MOI').css('border-color', '');
                                    }
                                  });
                                   
                           $(document).on('change','#used_to_retrieve_the_document',function() {
                                    if(this.value!='') {
                                   $('#used_to_retrieve_the_document').css('border-color', '');
                                    }
                                  });
                                  
                                $(document).keypress('#SAP',function() {
                                    if(this.value!='') {
                                   $('#SAP').css('border-color', '');
                                    }
                                  });
                                 
                                  $(document).on('change','#PRE_Inspection',function() {
                                    if(this.value!='') {
                                   $('#PRE_Inspection').css('border-color', '');
                                    }
                                  });
                                  
                                  $(document).on('change','#Post_Inspection_Required_per_PRE_Inspection',function() {
                                    if(this.value!='') {
                                   $('#Post_Inspection_Required_per_PRE_Inspection').css('border-color', '');
                                    }
                                  });
                                  
                                  $(document).on('change','#POST_Inspection',function() {
                                    if(this.value!='') {
                                   $('#POST_Inspection').css('border-color', '');
                                    }
                                  });
                                 
                                $(document).on('change','#Cross_Bore_Log',function() {
                                    if(this.value!='') {
                                   $('#Cross_Bore_Log').css('border-color', '');
                                    }
                                  });	
		
		
		$(document).on('change','#CN29_in_SAP',function() {
			if (this.checked) {
			        //alert("43434");
			         $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        }); 
			        
			        $("#CN24 option:selected").prop("selected", false);
			        $("#gas_assets_installed option:selected").prop("selected", false);
                    $("#installation_below_ground option:selected").prop("selected", false);
                    $("#MOI option:selected").prop("selected", false);
                    $("#MOI_cmt").val("");
                    $("#CN24_cmt").val("");
			        $("#gas_assets_installed_cmt").val("");
                    $("#installation_below_ground_cmt").val("");
                    
                    $(".installation_below_ground-div").show();
	                $(".MOI-div").show();
			        $('#modalRegisterForm3').modal('show');
				$('#qualfi').addClass('d-none');
			}else{
			        $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Submit', 'Next')); 
                                           
                                        }); 
				$('#qualfi').removeClass('d-none');
			}
		});
	 
        
			/*$(document).on('change','#cn29status',function() {
			if (this.checked) {
		        $('#modalRegisterFormaprove').modal('show');
			}
			    
			})*/
 		$(document).on("change", ".Qualify", function(){			
 			var val = $(this).val();
			
 			if(val=='Yes' || val == "Trenchless"){
			   
 		        $(this).parent().parent().parent().find('.errorcmt').hide();
 			}else{
				$(".mstp3").find(".errorcmt").hide();
 	            //$(this).parent().parent().parent().find('textarea').attr("disabled", !(val=='Yes' || val == "Trenchless"));
	
	 
 			}
 		});


 	$(document).on("change", "#CN24", function(){
 	    return true;
    //alert( this.value ); // or $(this).val()
  var val = $(this).val();
   
  if(this.value == "Yes" || this.value =='') {
      
       $("#gas_assets_installed option:selected").prop("selected", false);
       $("#installation_below_ground option:selected").prop("selected", false);
       $("#MOI option:selected").prop("selected", false);
    
      
     // $(this).parent().parent().parent().find('textarea').prop('disabled', true);
    $(".gas_assets_installed-div").show();
	 $(".installation_below_ground-div").show();
	 $(".MOI-div").show();
  } else {
     
     // $("#CN24 option:selected").prop("selected", false);
      if(this.value == "No"){
       $('.change_msg_status').text("Unknown");   
      }
      if(this.value == "Unknown"){
       $('.change_msg_status').text("Unknown");   
      }
      $('#modalRegisterForm3').modal('show');
      
     // $(this).parent().parent().parent().find('textarea').removeAttr("disabled");
    $(".gas_assets_installed-div").show();
	 $(".installation_below_ground-div").show();
	 $(".MOI-div").show();
	 
	   
  }
});



	$(document).on("change", "#gas_assets_installed", function(){
  //  alert( this.value ); // or $(this).val()
  
  var val = $(this).val();
 
  if(this.value == "Yes" || this.value =='' || this.value == "Unknown" ) {
         $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Submit', 'Next')); 
                                           
                                        }); 
    
     // $(this).parent().parent().parent().find('textarea').prop('disabled', true);
     // $(".gas_assets_installed-div").show();
    //   $("#installation_below_ground option:selected").prop("selected", false);
    //   $("#MOI option:selected").prop("selected", false);
     
	 $(".installation_below_ground-div").show();
	 $(".MOI-div").show();
  } else {
      if(this.value == "No"){
            $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        }); 
          $(".installation_below_ground-div").hide();
	 $(".MOI-div").hide();
       $('.change_msg_status').text("CN 29 Eligible");  
      
      }
      if(this.value == "Unknown"){
       //    $(".installation_below_ground-div").show();
	// $(".MOI-div").show();
   //    $('.change_msg_status').text("Unknown");   
      }
       $('#modalRegisterForm3').modal('show');
     // $(this).parent().parent().parent().find('textarea').removeAttr("disabled");
    //  $(".gas_assets_installed-div").hide();
	  $("#installation_below_ground option:selected").prop("selected", false);
       $("#MOI option:selected").prop("selected", false);
  }
});

	$(document).on("change", "#installation_below_ground", function(){
 //  alert( this.value ); // or $(this).val()
  var val = $(this).val();
  
  if(this.value == "Yes" || this.value =='' || this.value == "Unknown") {
         $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Submit', 'Next')); 
                                           
                                        }); 
     // $(this).parent().parent().parent().find('textarea').prop('disabled', true);
	// $(".installation_below_ground-div").show();
	 $(".MOI-div").show();
  } else {
      if(this.value == "No"){
             $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        }); 
       $('.change_msg_status').text("CN 29 Eligible"); 
       $("#MOI option:selected").prop("selected", false);
                    $("#MOI_cmt").val("");
      }
    //   if(this.value == "Unknown"){
    //   $('.change_msg_status').text("Unknown");   
    //   }
      $('#modalRegisterForm3').modal('show');
      //$(this).parent().parent().parent().find('textarea').removeAttr("disabled");
	// $(".installation_below_ground-div").hide();
	 $(".MOI-div").hide();
  }
});

	$(document).on("change", "#MOI", function(){
  //  alert( this.value ); // or $(this).val()
  var val = $(this).val();
 
  if(this.value == "Trenchless" || this.value =='') {
      $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Submit', 'Next')); 
                                           
                                        }); 
      //$(this).parent().parent().parent().find('textarea').prop('disabled', true);
 
  } else {
         $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        }); 
      if(this.value == "100% Trench"){
       $('.change_msg_status').text("CN 29 Eligible");   
      }
      if(this.value == "Unknown"){
       $('.change_msg_status').text("Unknown");   
      }
      $('#modalRegisterForm3').modal('show');
      //$(this).parent().parent().parent().find('textarea').removeAttr("disabled");
  //$(".MOI-div").hide();
  }
});
		
	$(document).on("change", "#Cross_Bore_Log", function(){ 
	    if(this.value!=''){
       $('#modalRegisterForm4').modal('show');  
	    }
	    
	});	
$(document).ready(function() {
    //alert('reay');
		$('#lanid').keydown(function() {
		     alert('down');
		//$(this).val($(this).val().toUpperCase());
		
	});
});


function coversheet(mydata){
    var kk = $.ajax({
                                      url: "cover_sheet_saveJS.php",
                                      type: "POST",
                                      dataType: "json",
                                      async: false,
                                      data: mydata
                                        ,success: function(data){
                                            //console.log(data);
                                            if(data.status_message=='Fail'){
                                                return false; 
                                            }else{
                                                return true;
                                            }
                                            
                                        },
                                        error:function(data){
                                            return false;
                                        }
                                        
                                        
                                    });
                              //  console.log(kk.responseJSON);
                                if(kk.responseJSON.status == 400){return false;}
                                else{return true;}
                                
}
function ProjectDetails(mydata){
    var kk = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      dataType: "json",
                                      async: false,
                                      data: mydata
                                        ,success: function(data){
                                            console.log(data);
                                            if(data.status_message=='Fail'){
                                                return false; 
                                            }else{
                                                return true;
                                            }
                                            
                                        },
                                        error:function(data){
                                            return false;
                                        }
                                        
                                        
                                    });
                                console.log(kk.responseJSON);
                                if(kk.responseJSON.status == 400){return false;}
                                else{return true;}
                                
}
function ProjectDetails(mydata){
    var kk = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      dataType: "json",
                                      async: false,
                                      data: mydata
                                        ,success: function(data){
                                            console.log(data);
                                            if(data.status_message=='Fail'){
                                                return false; 
                                            }else{
                                                return true;
                                            }
                                            
                                        },
                                        error:function(data){
                                            return false;
                                        }
                                        
                                        
                                    });
                                console.log(kk.responseJSON);
                                if(kk.responseJSON.status == 400){return false;}
                                else{return true;}
                                
}
function QualifyingFive(mydata){
    var kk = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      dataType: "json",
                                      async: false,
                                      data: mydata
                                        ,success: function(data){
                                            console.log(data);
                                            
                                        },
                                        error:function(data){
                                            return false;
                                        }
                                        
                                        
                                    });
                                console.log(kk.responseJSON);
                                if(kk.responseJSON.status == 400){return false;}
                                else{return true;}
                                
}
function ChecklistQuestions(mydata){
    var kk = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      dataType: "json",
                                      async: false,
                                      data: mydata
                                        ,success: function(data){
                                            console.log(data);
                                            if(data.status_message=='Fail'){
                                                return false; 
                                            }else{
                                                return true;
                                            }
                                            
                                        },
                                        error:function(data){
                                            return false;
                                        }
                                        
                                        
                                    });
                                console.log(kk.responseJSON);
                                if(kk.responseJSON.status == 400){return false;}
                                else{return true;}
                                
}

var LoadErrorlanid = 0;

function validatelanid() {
    
    var lanid = document.getElementById("lanid");
    lanid.value = lanid.value.toUpperCase();
    var lanidres = lanid.value;
    var letters = /^[A-Za-z]+$/;
    //alert(lanidres);
      if(lanid.value == 0) {
           //alert(lanidres);
           LoadErrorlanid = 1;
      }
      if((lanid.value.match(letters)) && lanidres.length == 4 )
      {
            $("#errorlanid").css("display","none");
            //alert('match');
           LoadErrorlanid = 0;
      } else {
           //alert('nt matcg');
           $("#errorlanid").css("display","block");
           LoadErrorlanid = 1;
      }
      //console.log(LoadErrorlanid);
}
/*function validatelanid(this){
    alert('test');
    var res  = this.val();
    alert(res);
    var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
}*/
	
	
    // function CheckStatus(){
    //     if($("#gas_assets_installed").val() == "No" || $("#gas_assets_installed").val() == "Unknown"){
    //         $(".mstp3").find(".errorcmt").hide();
    //          $("#gas_assets_installed").parent().parent().parent().find(".errorcmt").show();
            
    //         $("#installation_below_ground").val("");
    //         $("#MOI").val("");
    //     }
        
    //     if($("#installation_below_ground").val() == "No" || $("#installation_below_ground").val() == "Unknown"){
    //         $(".mstp3").find(".errorcmt").hide();
    //          $("#installation_below_ground").parent().parent().parent().find(".errorcmt").show();
            
    //         $("#MOI").val("");
    //     }
        
    //     if($("#MOI").val() == "100% Trench" || $("#MOI").val() == "Unknown"){
    //         $(".mstp3").find(".errorcmt").hide();
    //         $("#MOI").parent().parent().parent().find(".errorcmt").show();
    //     }
    // }	
              
                            	        
            $(function() {
                $('#form-wizard').steps({
                    headerTag: "h6",
                    bodyTag: "section",
                    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                    onStepChanging: function(event, currentIndex, newIndex) {
                        
                        if(newIndex=='0' || newIndex=='1' || newIndex=='2') {
                      $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Submit', 'Next')); 
                                           
                                        });   
                    } else{
                       $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        });     
                    }
                        var form = $(this);
                    //   alert('Current'+currentIndex);
                    //     alert('Newindex'+newIndex);
                      
                      
                       //Last Previous Click
                       if(currentIndex==3 &&  (newIndex==2 || newIndex==0 || newIndex==1)){
                      var Status = Validate();
						  
						  if(Status){
							  return false;
						  };
                           
                                    if ($('#SAP_Reviewed').is(":checked"))
                                        {
                                        var SAP_Reviewed = '1';
                                        }else{
                                         var SAP_Reviewed = '0';   
                                        }
                                     var order_no = $("#order_no").val();
                                    
                                      var SAP_Reviewed_cmt = $("#SAP_Reviewed_cmt").val();
                                     //var Trenchless_MOI = '$("#Trenchless_MOI").val()';
                                     var Trenchless_MOI = '';
                                     var Trenchless_MOI_cmt = $("#Trenchless_MOI_cmt").val();
                                     var MOI_for_Srv = $("#MOI_for_Srv").val();
                                     var MOI_for_Srv_cmt = $("#MOI_for_Srv_cmt").val();
                                     var MOI_for_Main = $("#MOI_for_Main").val();
                                     var MOI_for_Main_cmt = $("#MOI_for_Main_cmt").val();
                                     var determine_the_MOI = $("#determine_the_MOI").val();
                                     var determine_the_MOI_cmt = $("#determine_the_MOI_cmt").val();
                                     var used_to_retrieve_the_document = $("#used_to_retrieve_the_document").val();
                                     var used_to_retrieve_the_document_cmt = $("#used_to_retrieve_the_document_cmt").val();
                                     var SAP = $("#SAP").val();
                                     var SAP_cmt = $("#SAP_cmt").val();
                                     var PRE_Inspection = $("#PRE_Inspection").val();
                                     var PRE_Inspection_cmt = $("#PRE_Inspection_cmt").val();
                                     var Post_Inspection_Required_per_PRE_Inspection = $("#Post_Inspection_Required_per_PRE_Inspection").val();
                                     var Post_Inspection_Required_per_PRE_Inspection_cmt = $("#Post_Inspection_Required_per_PRE_Inspection_cmt").val();
                                     var POST_Inspection = $("#POST_Inspection").val();
                                     var POST_Inspection_cmt = $("#POST_Inspection_cmt").val(); 
                                     var Cross_Bore_Log = $("#Cross_Bore_Log").val();
                                     var Cross_Bore_Log_Ready = $("#Cross_Bore_Log_Ready").val();
                                     var reviewer_id = '<?php echo $userid  ?>';
                                     
                                   
                                  
                                  
                                //   if(MOI_for_Srv=='' AND MOI_for_Main=='' AND determine_the_MOI=='' AND Cross_Bore_Log=='' AND POST_Inspection=='' AND Post_Inspection_Required_per_PRE_Inspection=='' AND PRE_Inspection=='' AND SAP=='' AND used_to_retrieve_the_document==''){
                                //     return false;
                                // }   
                                     
                                   ChecklistQuestions({Cross_Bore_Log_cmt:Cross_Bore_Log_Ready,order_no:order_no,id:reviewer_id,form_type:'ChecklistQuestions',SAP_Reviewed:SAP_Reviewed,SAP_Reviewed_cmt:SAP_Reviewed_cmt,Trenchless_MOI:Trenchless_MOI,Trenchless_MOI_cmt:Trenchless_MOI_cmt,
                                             MOI_for_Srv:MOI_for_Srv,MOI_for_Srv_cmt:MOI_for_Srv_cmt,MOI_for_Main:MOI_for_Main,MOI_for_Main_cmt:MOI_for_Main_cmt,determine_the_MOI:determine_the_MOI,determine_the_MOI_cmt:determine_the_MOI_cmt
                                             ,used_to_retrieve_the_document:used_to_retrieve_the_document,used_to_retrieve_the_document_cmt:used_to_retrieve_the_document_cmt,SAP:SAP
                                             ,SAP_cmt:SAP_cmt,PRE_Inspection:PRE_Inspection,PRE_Inspection_cmt:PRE_Inspection_cmt,Post_Inspection_Required_per_PRE_Inspection:Post_Inspection_Required_per_PRE_Inspection,
                                              Post_Inspection_Required_per_PRE_Inspection_cmt:Post_Inspection_Required_per_PRE_Inspection_cmt,POST_Inspection:POST_Inspection,POST_Inspection_cmt:POST_Inspection_cmt,Cross_Bore_Log:Cross_Bore_Log
                                         });  
                                    
							 
                        }
                      
                        if(currentIndex==1 &&  newIndex==0){
                          
                            return true;
                        }
                        
                        if(currentIndex==2 &&  newIndex==1){
                            $("#errorcmt").css("display","none"); 
                            $("#errorCN24_cmt").css("display","none");
                             $("#errorgas_assets_installed_cmt").css("display","none");
                            $("#errorinstallation_below_ground_cmt").css("display","none");
                            $("#errorMOI_cmt").css("display","none");
                            return true;
                        }
                        
                        if(currentIndex==0){
                                    console.log(LoadErrorlanid);
                                     if(LoadErrorlanid == 1){
                                         $("#errorlanid").css("display","block");
                                      return false;
                                    } 
                                    var reviewer_lanid = $("#lanid").val();
                                    var review_date = $("#review_date").val();
                                    var reviewer_completion_date = $("#review_completion_date").val();
                                    var proj_id = $("#project_id").val();
                                    var order_no = $("#order_no").val();
                                    var division = $("#division").val();
                                    var city = $("#city").val();
                                    var resp_gp = $("#resp_gp").val();
                                    var cn29eligible = $("#cn29eligible").val();
                                    var order_desc = $("#order_description").val();
                                    var fecm = $("#FE_CM").val();
                                    var cercm = $("#CE_RCM").val();
                                    var foreman = $("#foreman").val();
                                    var mcsupervisor = $("#m_c_supervisor").val();
                                    var distribution = $("#distribution").val();
                                    var inspector = $("#inspector").val();
                                    var Distribution_Transmission = $("#Distribution_Transmission").val();
                                    
                                    var reviewer_id = '<?php echo $userid  ?>';
                                    return coversheet({reviewer_lanid:reviewer_lanid,order_no:order_no,review_date:review_date, reviewer_completion_date:reviewer_completion_date,proj_id:proj_id, division:division, city:city, resp_gp:resp_gp, cn29eligible:cn29eligible, order_desc:order_desc,fecm:fecm, cercm:cercm, foreman:foreman, mcsupervisor:mcsupervisor, distribution:distribution, inspector:inspector, reviewer_id:reviewer_id,Distribution_Transmission:Distribution_Transmission});
                                    /* var request = $.ajax({
                                      url: "cover_sheet_saveJS.php",
                                      type: "POST",
                                      data: {reviewer_lanid:reviewer_lanid,order_no:order_no,review_date:review_date, reviewer_completion_date:reviewer_completion_date,proj_id:proj_id, division:division, city:city, resp_gp:resp_gp, cn29eligible:cn29eligible, order_desc:order_desc,fecm:fecm, cercm:cercm, foreman:foreman, mcsupervisor:mcsupervisor, distribution:distribution, inspector:inspector, reviewer_id:reviewer_id,Distribution_Transmission:Distribution_Transmission}
                                    });
                                    
                                    request.done(function(msg) {
                                        console.log(msg);
                                        //alert( "Requestc done: " + msg );
                                    });
                                    
                                    request.fail(function(jqXHR, textStatus) {
                                    //alert( "Request failed: " + textStatus );
                                    }); */
                                    }
                                    
                                    $("#cn29status").click(function(){
                                       
                                       $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        });     
                            			
                                    });
                                       $("#cn29statusnoo").click(function(){
                                           $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Submit', 'Next')); 
                                           
                                        }); 
                                       ///   $("#CN24 option:selected").prop("selected", false);
                                        //   $("#gas_assets_installed option:selected").prop("selected", false);
                                          // $('#gas_assets_installed:eq(1)').attr('selected', 'selected');
                                       //    $('#gas_assets_installed option[value="Yes"]').attr("selected", "selected");
                                        //   $("#installation_below_ground option:selected").prop("selected", false);
                                        //   $('#installation_below_ground option[value="Yes"]').attr("selected", "selected");
                                        //   $("#MOI option:selected").prop("selected", false);
                                        //    $('#MOI option[value="Trenchless"]').attr("selected", "selected");
                                         //  $('.textareas').prop('disabled', true);
                                         $("#CN29_in_SAP").prop("checked", false);
                                        
                                        if($("#gas_assets_installed").val()=='No')
                                        {
                                            $('#gas_assets_installed').prop("selectedIndex", 0);
                                        }
                                        
                                         if($("#installation_below_ground").val()=='No')
                                        {
                                            $('#installation_below_ground').prop("selectedIndex", 0);
                                        }
                                         if($("#installation_below_ground").val()=='Unknown')
                                        {
                                            $('#installation_below_ground').prop("selectedIndex", 0);
                                        }
                                        
                                        
                                        if($("#MOI").val()=='100% Trench')
                                        {
                                            $('#MOI').prop("selectedIndex", 0);
                                        }
                                         if($("#MOI").val()=='Unknown')
                                        {
                                            $('#MOI').prop("selectedIndex", 0);
                                        }
                                        
                                        
                                        
                                        
                                        
                                            $('#qualfi').removeClass('d-none');
                                            
                                             $(".gas_assets_installed-div").show();
                                        	 $(".installation_below_ground-div").show();
                                        	 $(".MOI-div").show();
                                        	 
                                        	 
                                        	 
                                         
                                    });
                                    
                                     
                                    /*$( "#submit" ).click(function() {
                                        $('#modalRegisterFormaprove').modal('show');
                                    });*/
        
        
                                    if(currentIndex==1){
                                    var order_no = $("#order_no").val();
                                    var mat = $("#mat").val();
                                    var Checkmat = $('#Checkmat').is(":checked");
                                    var cn24 = $("#cn24").val();
                                    var cn24_lanid = $("#cn24_lanid").val();
                                    var cn24_date = $("#cn24_date").val();
                                    var check_cn24 = $('#check_cn24').is(":checked");
                                    var cn29 = $("#cn29").val();
                                    var cn29_lanid = $("#cn29_lanid").val();
                                    var cn29_date = $("#cn29_date").val();
                                    var check_cn29 = $('#check_cn29').is(":checked");
                                    
                                    var cn07 = $("#cn07").val();
                                    var cn07_lanid = $("#cn07_lanid").val();
                                    var cn07_date = $("#cn07_date").val();
                                    var check_cn07 = $('#check_cn07').is(":checked");
                                    
                                     var dc39 = $("#dc39").val();
                                    var dc39_lanid = $("#dc39_lanid").val();
                                    var dc39_date = $("#dc39_date").val();
                                    
                                    var dc46 = $("#dc46").val();
                                    var dc46_lanid = $("#dc46_lanid").val();
                                    var dc46_date = $("#dc46_date").val();
                                    
                                    var dc05 = $("#dc05").val();
                                    var dc05_lanid = $("#dc05_lanid").val();
                                    var dc05_date = $("#dc05_date").val();
                                    
                                    var dc14 = $("#dc14").val();
                                    var dc14_lanid = $("#dc14_lanid").val();
                                    var dc14_date = $("#dc14_date").val();
                                    
                                    var dc15 = $("#dc15").val();
                                    var dc15_lanid = $("#dc15_lanid").val();
                                    var dc15_date = $("#dc15_date").val();
                                    
                                    var dc19 = $("#dc19").val();
                                    var dc19_lanid = $("#dc19_lanid").val();
                                    var dc19_date = $("#dc19_date").val();
                                    
                                    var dc10 = $("#dc10").val();
                                    var dc10_lanid = $("#dc10_lanid").val();
                                    var dc10_date = $("#dc10_date").val();
                                    var cmt_cn_dc = $("#cmt_cn_dc").val();
                                    
                                    var reviewer_id = '<?php echo $userid  ?>';
                                     //var serialized = $('#form-wizard').serialize();
                                     //alert($('#Checkmat').is(":checked"));
                                /*         Form Validation Start  
                                */     
                                 if($('#CN29_in_SAP').is(":checked")==true){
                                  $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        }); 
                                   $('#qualfi').addClass('d-none');
                                   }else{
                                   $('#qualfi').removeClass('d-none');    
                                   } 
                                   if($("#gas_assets_installed").val()=='No'){
                                     $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        });     
                                   }
                                   if($("#installation_below_ground").val()=='No'){
                                     $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        });     
                                   }
                                   if($("#MOI").val()=='100% Trench' || $("#MOI").val()=='Unknown'){
                                     $('.submit').each(function() {
                                            var text = $(this).text();
                                            $(this).text(text.replace('Next', 'Submit')); 
                                           
                                        });     
                                   }
                                   
                                    
                                   if($('#Checkmat').is(":checked")==false){
                                      // alert('Please checked MAT');
                                       $("#errormat").css("display","block");
                                   }
                                   
                                    $('#Checkmat').change(function() {
                                    if(this.checked) {
                                        
                                       $("#errormat").css("display","none");
                                    }
                                   })
                                   if($('#check_cn24').is(":checked")==false){
                                       //alert('Please checked check_cn24');
                                        $("#errorcn24").css("display","");
                                   }
                                    $('#check_cn24').change(function() {
                                    if(this.checked) {
                                       $("#errorcn24").css("display","none");
                                    }
                                   })
                                   if($('#check_cn29').is(":checked")==false){
                                       //alert('Please checked check_cn29');
                                        $("#errorcn29").css("display","");
                                       
                                   }
                                    $('#check_cn29').change(function() {
                                    if(this.checked) {
                                       $("#errorcn29").css("display","none");
                                    }
                                   })
                                   if($('#check_cn07').is(":checked")==false){
                                      // alert('Please checked check_cn07');
                                        $("#errorcn07").css("display","");
                                   }
                                   $('#check_cn07').change(function() {
                                    if(this.checked) {
                                       $("#errorcn07").css("display","none");
                                    }
                                   })
                                   
                                //   if(cn24==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn24').css('border-color', 'red');
                                       
                                       
                                //   }
                                //   $('#cn24').change(function() {
                                //     if(this.value!='') {
                                //       $('#cn24').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(cn24_lanid==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn24_lanid').css('border-color', 'red');
                                       
                                        
                                //   }
                                //   $('#cn24_lanid').keypress(function() {
                                //     if(this.value!='') {
                                //       $('#cn24_lanid').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(cn24_date==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn24_date').css('border-color', 'red');
                                      
                                //     }
                                //   $('#cn24_date').change(function() {
                                //     if(this.value!='') {
                                //       $('#cn24_date').css('border-color', '');
                                //     }
                                //   })
                                   
                                   
                                //   if(cn29==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn29').css('border-color', 'red');
                                       
                                       
                                //   }
                                //   $('#cn29').change(function() {
                                //     if(this.value!='') {
                                //       $('#cn29').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(cn29_lanid==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn29_lanid').css('border-color', 'red');
                                       
                                        
                                //   }
                                //   $('#cn29_lanid').keypress(function() {
                                //     if(this.value!='') {
                                //       $('#cn29_lanid').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(cn29_date==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn29_date').css('border-color', 'red');
                                      
                                //     }
                                //   $('#cn29_date').change(function() {
                                //     if(this.value!='') {
                                //       $('#cn29_date').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(cn07==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn07').css('border-color', 'red');
                                       
                                       
                                //   }
                                //   $('#cn07').change(function() {
                                //     if(this.value!='') {
                                //       $('#cn07').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(cn07_lanid==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn07_lanid').css('border-color', 'red');
                                       
                                        
                                //   }
                                //   $('#cn07_lanid').keypress(function() {
                                //     if(this.value!='') {
                                //       $('#cn07_lanid').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(cn07_date==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#cn07_date').css('border-color', 'red');
                                      
                                //     }
                                //   $('#cn07_date').change(function() {
                                //     if(this.value!='') {
                                //       $('#cn07_date').css('border-color', '');
                                //     }
                                //   })
                                   
                                //     if(dc39==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc39').css('border-color', 'red');
                                       
                                       
                                //   }
                                //   $('#dc39').change(function() {
                                //     if(this.value!='') {
                                //       $('#dc39').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(dc39_lanid==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc39_lanid').css('border-color', 'red');
                                       
                                        
                                //   }
                                //   $('#dc39_lanid').keypress(function() {
                                //     if(this.value!='') {
                                //       $('#dc39_lanid').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(dc39_date==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc39_date').css('border-color', 'red');
                                      
                                //     }
                                //   $('#dc39_date').change(function() {
                                //     if(this.value!='') {
                                //       $('#dc39_date').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(dc14==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc14').css('border-color', 'red');
                                       
                                       
                                //   }
                                //   $('#dc14').change(function() {
                                //     if(this.value!='') {
                                //       $('#dc14').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(dc14_lanid==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc14_lanid').css('border-color', 'red');
                                       
                                        
                                //   }
                                //   $('#dc14_lanid').keypress(function() {
                                //     if(this.value!='') {
                                //       $('#dc14_lanid').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(dc14_date==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc14_date').css('border-color', 'red');
                                      
                                //     }
                                //   $('#dc14_date').change(function() {
                                //     if(this.value!='') {
                                //       $('#dc14_date').css('border-color', '');
                                //     }
                                //   })
                                   
                                   
                                //   if(dc19==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc19').css('border-color', 'red');
                                       
                                       
                                //   }
                                //   $('#dc19').change(function() {
                                //     if(this.value!='') {
                                //       $('#dc19').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(dc19_lanid==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc19_lanid').css('border-color', 'red');
                                       
                                        
                                //   }
                                //   $('#dc19_lanid').keypress(function() {
                                //     if(this.value!='') {
                                //       $('#dc19_lanid').css('border-color', '');
                                //     }
                                //   })
                                   
                                //   if(dc19_date==''){
                                //       // alert('Please checked check_cn07');
                                //       $('#dc19_date').css('border-color', 'red');
                                      
                                //     }
                                //   $('#dc19_date').change(function() {
                                //     if(this.value!='') {
                                //       $('#dc19_date').css('border-color', '');
                                //     }
                                //   })
                                   
                                   
                                   /*         Form Validation End            */  
                                   if ($('#Checkmat').is(":checked") && $('#check_cn24').is(":checked") && $('#check_cn29').is(":checked")&& $('#check_cn07').is(":checked"))
                                    {
                                         //alert('checked');
                                    }else{
                                        
                                     return false;   
                                    }
									
									return ProjectDetails({Checkmat:Checkmat,check_cn24:check_cn24,check_cn29:check_cn29,check_cn07:check_cn07,mat:mat,cn24:cn24,cn24_lanid:cn24_lanid, cn24_date:cn24_date,order_no:order_no,cn29:cn29, cn29_lanid:cn29_lanid, cn29_date:cn29_date,cn07:cn07, cn07_lanid:cn07_lanid, cn07_date:cn07_date,dc39:dc39, dc39_lanid:dc39_lanid, dc39_date:dc39_date,dc46:dc46, dc46_lanid:dc46_lanid, dc46_date:dc46_date,dc05:dc05, dc05_lanid:dc05_lanid, dc05_date:dc05_date,dc14:dc14, dc14_lanid:dc14_lanid, dc14_date:dc14_date,dc15:dc15, dc15_lanid:dc15_lanid, dc15_date:dc15_date,dc19:dc19, dc19_lanid:dc19_lanid, dc19_date:dc19_date,dc10:dc10, dc10_lanid:dc10_lanid, dc10_date:dc10_date,id:reviewer_id,cmt_cn_dc:cmt_cn_dc,form_type:'ProjectDetails'});
                                     /* var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {Checkmat:Checkmat,check_cn24:check_cn24,check_cn29:check_cn29,check_cn07:check_cn07,mat:mat,cn24:cn24,cn24_lanid:cn24_lanid, cn24_date:cn24_date,order_no:order_no,cn29:cn29, cn29_lanid:cn29_lanid, cn29_date:cn29_date,cn07:cn07, cn07_lanid:cn07_lanid, cn07_date:cn07_date,dc39:dc39, dc39_lanid:dc39_lanid, dc39_date:dc39_date,dc46:dc46, dc46_lanid:dc46_lanid, dc46_date:dc46_date,dc05:dc05, dc05_lanid:dc05_lanid, dc05_date:dc05_date,dc14:dc14, dc14_lanid:dc14_lanid, dc14_date:dc14_date,dc15:dc15, dc15_lanid:dc15_lanid, dc15_date:dc15_date,dc19:dc19, dc19_lanid:dc19_lanid, dc19_date:dc19_date,dc10:dc10, dc10_lanid:dc10_lanid, dc10_date:dc10_date,id:reviewer_id,cmt_cn_dc:cmt_cn_dc,form_type:'ProjectDetails'}
                                     });
                                    
                                    request.done(function(msg) {
                                        console.log(msg);
                                   // alert( "Requestc done: " + msg );
                                    });
                                    
                                    request.fail(function(jqXHR, textStatus) {
                                   // alert( "Request failed: " + textStatus );
                                    }); */
                                    }
                         if(currentIndex==2){
                             if($(".recomandation").val()=='Others'){
                             $(".recomandation").parent().find(".comment").show();
                            }else{ 
                             $(".comment").hide();   
            
                        }
                             $( "#CN29_in_SAP_cmt" ).focus(function() {
                                  $("#errorcmt").css("display","none");
                            });
                            $( "#CN24_cmt" ).focus(function() {
                                 $("#errorCN24_cmt").css("display","none");
                            });
                            $( "#gas_assets_installed_cmt" ).focus(function() {
                                   $("#errorgas_assets_installed_cmt").css("display","none");
                            });
                            $( "#installation_below_ground_cmt" ).focus(function() {
                                  $("#errorinstallation_below_ground_cmt").css("display","none");
                            });
                            $( "#MOI_cmt" ).focus(function() {
                                  $("#errorMOI_cmt").css("display","none");
                            });
                            
//                             var LoadError=0;
//                             if($("#CN29_in_SAP_cmt").val()=='')
//                             			{
//                             			    $("#errorcmt").css("display","none");
                            			    
//                             			    LoadError=0;
//                             			}
//                           if($("#CN24_cmt").val()=='') 
//                             			{
//                             			    $("#errorCN24_cmt").css("display","none");
                            			    
//                             			   LoadError=0;
//                             			}
//                             			if($("#gas_assets_installed_cmt").val()=='')
//                             			{
//                             			    $("#errorgas_assets_installed_cmt").css("display","none");
//                             			     LoadError=0;
//                             			}
//                             			if($("#installation_below_ground_cmt").val()=='')
//                             			{
//                             			    $("#errorinstallation_below_ground_cmt").css("display","none");
                            			    
//                             			     LoadError=0;
//                             			}
//                             				if($("#MOI_cmt").val()=='')
//                             			{
//                             			    $("#errorMOI_cmt").css("display","none");
                            			    
//                             			     LoadError=0;
//                             			} 
                            			
//                             			CheckStatus();
                            			
//                             		var Status = $(".mstp3").find(".errorcmt").is(":visible");
                            		
//                             		if(Status){
//                             		    LoadError = 1;
//                             		}
//                             		else {
//                             		    LoadError = 0;
//                             		}	

// if( LoadError==1)
// {
//     return false;
// }
                                    var order_no = $("#order_no").val();
                                   // var CN29_in_SAP = $("#CN29_in_SAP").val();
                                    var CN29_in_SAP_cmt = $("#CN29_in_SAP_cmt").val();
                                    var CN24 = $("#CN24").val();
                                    var CN24_cmt = $("#CN24_cmt").val();
                                    var gas_assets_installed = $("#gas_assets_installed").val();
                                    var gas_assets_installed_cmt = $("#gas_assets_installed_cmt").val();
                                    var installation_below_ground = $("#installation_below_ground").val();
                                    var installation_below_ground_cmt = $("#installation_below_ground_cmt").val();
                                    var MOI = $("#MOI").val();
                                    var MOI_cmt = $("#MOI_cmt").val();
                                    var reviewer_id = '<?php echo $userid  ?>';
                            		if ($('#CN29_in_SAP').is(":checked"))
                                    { 
                                       var CN29_in_SAP = '1'; 
                                    }else{
                                      var CN29_in_SAP = '0';   
                                    }
                            		if(gas_assets_installed=='No'){
                            		   
                            			if($("#gas_assets_installed_cmt").val()=='')
                            			{
                            			    $("#errorgas_assets_installed_cmt").css("display","block");
                            			      return false;
                            			}
                            		}
                            		 if(installation_below_ground == "No"){
                            		     if($("#installation_below_ground_cmt").val()=='')
                            			{
                                      $("#errorinstallation_below_ground_cmt").css("display","block");
                                      return false;
                            			}
                                            }
                                            if(MOI == "100% Trench" || MOI == "Unknown"){
                            		     if($("#MOI_cmt").val()=='')
                            			{
                                      $("#errorMOI_cmt").css("display","block");
                                      return false;
                            			}
                                            }
                                   if ($('#CN29_in_SAP').is(":checked"))
                                    { 
                                        document.getElementById("status_job").value = "2";
                                      $(".job_status").text("CN-29 Eligible");
                                      $(".order_number").text(order_no);
                                      $('#unknownss').removeClass('recomandation');
                                      $('#fieldremidation').removeClass('recomandation');
                                      $('#cn29eligible').addClass('recomandation');
                                      
                                      
                                      
                                      
                                      $("#FieldRem").hide();
                                      $("#Unknownstatus").hide();
                                        $("#cn29_eligible").show();
                                        
                            			if($("#CN29_in_SAP_cmt").val()=='')
                            			{
                            			    $("#errorcmt").css("display","block");
                            			    
                            			    return false;
                            			}
                            			
                            		var jj  =   QualifyingFive({CN29_in_SAP:CN29_in_SAP,CN29_in_SAP_cmt:CN29_in_SAP_cmt,CN24:CN24, CN24_cmt:CN24_cmt,order_no:order_no,gas_assets_installed:gas_assets_installed, gas_assets_installed_cmt:gas_assets_installed_cmt, installation_below_ground:installation_below_ground,installation_below_ground_cmt:installation_below_ground_cmt,MOI:MOI,MOI_cmt:MOI_cmt,id:reviewer_id,form_type:'QualifyingFive'}); 	
                                   /*  var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {CN29_in_SAP:CN29_in_SAP,CN29_in_SAP_cmt:CN29_in_SAP_cmt,CN24:CN24, CN24_cmt:CN24_cmt,order_no:order_no,gas_assets_installed:gas_assets_installed, gas_assets_installed_cmt:gas_assets_installed_cmt, installation_below_ground:installation_below_ground,installation_below_ground_cmt:installation_below_ground_cmt,MOI:MOI,MOI_cmt:MOI_cmt,id:reviewer_id,form_type:'QualifyingFive'}
                                     }); 
                                    
                                   request.done(function(msg) {
                                        console.log(msg);
                                    //alert( "Requestc done: " + msg );
                                    });
                                    
                                    request.fail(function(jqXHR, textStatus) {
                                   // alert( "Request failed: " + textStatus );
                                    });  */
                                     if(jj==true){
                                     $("#modalRegisterForm").modal();   
                                     return false; 
                                }  
                                   //  alert('checked');
                                    }else{
                                     
                                      var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {CN29_in_SAP:CN29_in_SAP,CN29_in_SAP_cmt:CN29_in_SAP_cmt,CN24:CN24, CN24_cmt:CN24_cmt,order_no:order_no,gas_assets_installed:gas_assets_installed, gas_assets_installed_cmt:gas_assets_installed_cmt, installation_below_ground:installation_below_ground,installation_below_ground_cmt:installation_below_ground_cmt,MOI:MOI,MOI_cmt:MOI_cmt,id:reviewer_id,form_type:'QualifyingFive'}
                                     }); 
                                    
                                   request.done(function(msg) {
                                      //  console.log(msg);
                                  //  alert( "Requestc done: " + msg );
                                    });
                                    
                                    request.fail(function(jqXHR, textStatus) {
                                   // alert( "Request failed: " + textStatus );
                                    });   
                                     //return false;
                                     
                                    }
                                  if(CN24=='No' || CN24=='Unknown') {
                                    if(CN24=='No'){
                                          document.getElementById("status_job").value = "2";
                                      $(".job_status").text("CN-29 Eligible");
                                      $(".order_number").text(order_no);
                                       $('#unknownss').removeClass('recomandation');
                                      $('#fieldremidation').removeClass('recomandation');
                                      $('#cn29eligible').addClass('recomandation');
                                       
                                      $("#FieldRem").hide();
                                      $("#Unknownstatus").hide();
                                        $("#cn29_eligible").show();
                                   
                                  }else{
                                      document.getElementById("status_job").value = "3";
                                   $(".job_status").text("Unknown");   
                                   $(".order_number").text(order_no);
                                     $('#fieldremidation').removeClass('recomandation');
                                      $('#cn29eligible').removeClass('recomandation');
                                    $('#unknownss').addClass('recomandation');
                                     
                                    
                                   $("#FieldRem").hide();
                                        $("#cn29_eligible").hide();
                                   $("#Unknownstatus").show();
                                  }
                                      $(".gas_assets_installed-div").show();
                                        	 $(".installation_below_ground-div").show();
                                        	 $(".MOI-div").show();
                                     // $("#modalRegisterForm").modal(); 
                                        
                                      
                                     // return false;
                                      
                                  }
                                  if(gas_assets_installed=='No') { 
                                      if(gas_assets_installed=='No'){
                                          document.getElementById("status_job").value = "2";
                                      $(".job_status").text("CN-29 Eligible");
                                      $(".order_number").text(order_no);
                                       $('#fieldremidation').removeClass('recomandation');
                                      $('#unknownss').removeClass('recomandation');
                                        $('#cn29eligible').addClass('recomandation');
                                         
                                      $("#Unknownstatus").hide();
                                       $("#FieldRem").hide();
                                        $("#cn29_eligible").show();
                                  }else{
                                      document.getElementById("status_job").value = "3";
                                   $(".job_status").text("Unknown");   
                                   $(".order_number").text(order_no);
                                   $('#fieldremidation').removeClass('recomandation');
                                     $('#cn29eligible').removeClass('recomandation');
                                      $('#unknownss').addClass('recomandation');
                                       
                                      
                                     $("#FieldRem").hide();
                                        $("#cn29_eligible").hide();
                                   $("#Unknownstatus").show();
                                     
                                  }
                                 
                                      $("#modalRegisterForm").modal(); 
                                      return false;
                                  }
                                  if(installation_below_ground=='No') {
                                      if(installation_below_ground=='No'){
                                          document.getElementById("status_job").value = "2";
                                      $(".job_status").text("CN-29 Eligible");
                                      $(".order_number").text(order_no);
                                       $('#fieldremidation').removeClass('recomandation');
                                      $('#unknownss').removeClass('recomandation');
                                        $('#cn29eligible').addClass('recomandation');
                                         
                                   $("#Unknownstatus").hide();
                                       $("#FieldRem").hide();
                                        $("#cn29_eligible").show();
                                      
                                  }else{
                                      document.getElementById("status_job").value = "3";
                                   $(".job_status").text("Unknown");  
                                   $(".order_number").text(order_no);
                                     $('#fieldremidation').removeClass('recomandation');
                                     
                                        $('#cn29eligible').removeClass('recomandation');
                                         $('#unknownss').addClass('recomandation');
                                          
                                   $("#cn29_eligible").hide();
                                   $("#Unknownstatus").hide();
                                       $("#FieldRem").show();
                                  }
                                  
                                      $("#modalRegisterForm").modal(); 
                                      return false;
                                  }
                                  if(MOI=='100% Trench' || MOI=='Unknown') {
                                     if(MOI=='100% Trench'){
                                         document.getElementById("status_job").value = "2";
                                      $(".job_status").text("CN-29 Eligible");
                                      $(".order_number").text(order_no);
                                        $('#fieldremidation').removeClass('recomandation');
                                      $('#unknownss').removeClass('recomandation');
                                        $('#cn29eligible').addClass('recomandation');
                                         
                                       $("#Unknownstatus").hide();
                                       $("#FieldRem").hide();
                                      $("#cn29_eligible").show();
                          
                                  }else{
                                      document.getElementById("status_job").value = "3";
                                   $(".job_status").text("Unknown"); 
                                   $(".order_number").text(order_no);
                                     $('#fieldremidation').removeClass('recomandation');
                                     
                                     
                                        $('#cn29eligible').removeClass('recomandation');
                                         $('#unknownss').addClass('recomandation');
                                          
                                   
                                   $("#cn29_eligible").hide();
                                       $("#FieldRem").hide();
                                   $("#Unknownstatus").show();
                                   
                                      
                                  }
                                  
                                      $("#modalRegisterForm").modal(); 
                                      return false;
                                  }
                                    }
                                    
                                    
                                    
                        //alert(currentIndex);
                        // Always allow going backward even if the current step contains invalid fields!
                        if (currentIndex > newIndex) {
                            return true;
                        }

                        // Clean up if user went backward before
                        if (currentIndex < newIndex) {
                            // To remove error styles
                            $(".body:eq(" + newIndex + ") label.error", form).remove();
                            $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                        }

                        // Disable validation on fields that are disabled or hidden.
                        form.validate().settings.ignore = ":disabled,:hidden";

                        // Start validation; Prevent going forward if false
                        return form.valid();
                    },
                    onFinished: function (event, currentIndex)
                       {
                           
						   
						  var Status = Validate();
						  
						  if(Status){
							  return false;
						  };
                           
                                    if ($('#SAP_Reviewed').is(":checked"))
                                        {
                                        var SAP_Reviewed = '1';
                                        }else{
                                         var SAP_Reviewed = '0';   
                                        }
                                     var order_no = $("#order_no").val();
                                    
                                      var SAP_Reviewed_cmt = $("#SAP_Reviewed_cmt").val();
                                     //var Trenchless_MOI = '$("#Trenchless_MOI").val()';
                                     var Trenchless_MOI = '';
                                     var Trenchless_MOI_cmt = $("#Trenchless_MOI_cmt").val();
                                     var MOI_for_Srv = $("#MOI_for_Srv").val();
                                     var MOI_for_Srv_cmt = $("#MOI_for_Srv_cmt").val();
                                     var MOI_for_Main = $("#MOI_for_Main").val();
                                     var MOI_for_Main_cmt = $("#MOI_for_Main_cmt").val();
                                     var determine_the_MOI = $("#determine_the_MOI").val();
                                     var determine_the_MOI_cmt = $("#determine_the_MOI_cmt").val();
                                     var used_to_retrieve_the_document = $("#used_to_retrieve_the_document").val();
                                     var used_to_retrieve_the_document_cmt = $("#used_to_retrieve_the_document_cmt").val();
                                     var SAP = $("#SAP").val();
                                     var SAP_cmt = $("#SAP_cmt").val();
                                     var PRE_Inspection = $("#PRE_Inspection").val();
                                     var PRE_Inspection_cmt = $("#PRE_Inspection_cmt").val();
                                     var Post_Inspection_Required_per_PRE_Inspection = $("#Post_Inspection_Required_per_PRE_Inspection").val();
                                     var Post_Inspection_Required_per_PRE_Inspection_cmt = $("#Post_Inspection_Required_per_PRE_Inspection_cmt").val();
                                     var POST_Inspection = $("#POST_Inspection").val();
                                     var POST_Inspection_cmt = $("#POST_Inspection_cmt").val(); 
                                     var Cross_Bore_Log = $("#Cross_Bore_Log").val();
                                     var Cross_Bore_Log_Ready = $("#Cross_Bore_Log_Ready").val();
                                     var reviewer_id = '<?php echo $userid  ?>';
                                     
                                   
                                  
                                  
                                //   if(MOI_for_Srv=='' AND MOI_for_Main=='' AND determine_the_MOI=='' AND Cross_Bore_Log=='' AND POST_Inspection=='' AND Post_Inspection_Required_per_PRE_Inspection=='' AND PRE_Inspection=='' AND SAP=='' AND used_to_retrieve_the_document==''){
                                //     return false;
                                // }   
                                     
                                  var  jjj =  ChecklistQuestions({Cross_Bore_Log_cmt:Cross_Bore_Log_Ready,order_no:order_no,id:reviewer_id,form_type:'ChecklistQuestions',SAP_Reviewed:SAP_Reviewed,SAP_Reviewed_cmt:SAP_Reviewed_cmt,Trenchless_MOI:Trenchless_MOI,Trenchless_MOI_cmt:Trenchless_MOI_cmt,
                                             MOI_for_Srv:MOI_for_Srv,MOI_for_Srv_cmt:MOI_for_Srv_cmt,MOI_for_Main:MOI_for_Main,MOI_for_Main_cmt:MOI_for_Main_cmt,determine_the_MOI:determine_the_MOI,determine_the_MOI_cmt:determine_the_MOI_cmt
                                             ,used_to_retrieve_the_document:used_to_retrieve_the_document,used_to_retrieve_the_document_cmt:used_to_retrieve_the_document_cmt,SAP:SAP
                                             ,SAP_cmt:SAP_cmt,PRE_Inspection:PRE_Inspection,PRE_Inspection_cmt:PRE_Inspection_cmt,Post_Inspection_Required_per_PRE_Inspection:Post_Inspection_Required_per_PRE_Inspection,
                                              Post_Inspection_Required_per_PRE_Inspection_cmt:Post_Inspection_Required_per_PRE_Inspection_cmt,POST_Inspection:POST_Inspection,POST_Inspection_cmt:POST_Inspection_cmt,Cross_Bore_Log:Cross_Bore_Log
                                         });  
                                    /*  var request = $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      data: {Cross_Bore_Log_cmt:Cross_Bore_Log_Ready,order_no:order_no,id:reviewer_id,form_type:'ChecklistQuestions',SAP_Reviewed:SAP_Reviewed,SAP_Reviewed_cmt:SAP_Reviewed_cmt,Trenchless_MOI:Trenchless_MOI,Trenchless_MOI_cmt:Trenchless_MOI_cmt,
                                             MOI_for_Srv:MOI_for_Srv,MOI_for_Srv_cmt:MOI_for_Srv_cmt,MOI_for_Main:MOI_for_Main,MOI_for_Main_cmt:MOI_for_Main_cmt,determine_the_MOI:determine_the_MOI,determine_the_MOI_cmt:determine_the_MOI_cmt
                                             ,used_to_retrieve_the_document:used_to_retrieve_the_document,used_to_retrieve_the_document_cmt:used_to_retrieve_the_document_cmt,SAP:SAP
                                             ,SAP_cmt:SAP_cmt,PRE_Inspection:PRE_Inspection,PRE_Inspection_cmt:PRE_Inspection_cmt,Post_Inspection_Required_per_PRE_Inspection:Post_Inspection_Required_per_PRE_Inspection,
                                              Post_Inspection_Required_per_PRE_Inspection_cmt:Post_Inspection_Required_per_PRE_Inspection_cmt,POST_Inspection:POST_Inspection,POST_Inspection_cmt:POST_Inspection_cmt,Cross_Bore_Log:Cross_Bore_Log
                                         }
                                     });
                                    
                                    request.done(function(msg) {
                                         console.log(msg);
                                    //alert( "Requestc done: " + msg );
                                    });
                                    
                                    request.fail(function(jqXHR, textStatus) {
                                  // alert( "Request failed: " + textStatus );
                                    }); */
									if(jjj==true){
                        document.getElementById("status_job").value = "1";
                           $(".job_status").text("Field Remediation Required");
                           $(".order_number").text(order_no); 
                                      $('#unknownss').removeClass('recomandation');
                                        $('#cn29eligible').removeClass('recomandation');
                                                                    $('#fieldremidation').addClass('recomandation');
                                                                     
                                                                    

                           $("#modalRegisterForm").modal();
                           $("#cn29_eligible").hide();
                           $("#Unknownstatus").hide();
                           $("#FieldRem").show();

                           
									}
                       }
                })
            })
        </script>
       <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>-->
        <script>
       
    function RestartReview() {
         
         var reviewer_id = '<?php echo $userid  ?>';
        var order_no = $("#order_no").val();
        var status_job = $("#status_job").val();
       var recomandation_cmt = $('#add_comment').val();
   
        if($(".recomandation").val()!='Others'){
        var recomandation = $(".recomandation").val();
        $(".recomandation").parent().find(".errorcmtrecom").text('Please Select Recommendation'); 
        }else{
         var recomandation = recomandation_cmt; 
        $(".recomandation").parent().find(".errorcmtrecom").text('Please enter your comment'); 
        }
        
        if(recomandation==''){
        $(".recomandation").parent().find(".errorcmtrecom").show();
        return false;
         }else{
          
         $(".recomandation").parent().find(".errorcmtrecom").hide(); 
           $(document).ajaxStart(function(){
              $("#wait").css("display", "block");
            });
          }
         var mydata = {id:reviewer_id,order_no:order_no,status_job:status_job,form_type:'job_status',recomandation:recomandation};
    //   var request = $.ajax({
    //                                   url: "ProjectDetailsSaveJS.php",
    //                                   type: "POST",
    //                                   data: {id:reviewer_id,order_no:order_no,status_job:status_job,form_type:'job_status',recomandation:recomandation}
    //                                 });
                                  
    //                                 request.done(function(msg) {
    //                                 alert(msg.status);    
    //                                 setTimeout(function(){ window.location.href="reviewer-dashboard.php"; }, 5000);
                                   
    //                               // alert( "Requestc done: " + msg );
    //                                 });
    //                                  request.fail(function(jqXHR, textStatus) {
    //                               //alert( "Request failed: " + textStatus );
    //                                 }); 
                                    
                                    
       $.ajax({
                                      url: "ProjectDetailsSaveJS.php",
                                      type: "POST",
                                      dataType: 'json',
                                      cache: false,
                                       data: mydata,
                                        success: function(data){
                                           
                                           // setTimeout(function(){  }, 5000);
                                            console.log(data);
                                            //alert(data.status_message);
                                            if(data.status_message=='Success'){
                                             //    alert(data.status_message);
                                                console.log("hhhh");
                                                $('#modalRegisterForm .close').click();
                                                 
                                                    console.log("calling page")
                                                    window.location.href="reviewer-dashboard.php";
                                                    //window.location.replace("https://crossqafinal.epiksolution.org/reviewer-dashboard.php");
                                                    //$('#gotorev').click();
                                                 
                                               
                                               console.log("test");
                                            }else{
                                                
                                             //   alert('Error1');
                                                
                                            }
                                            
                                        },
                                        error:function(data){
                                        //   alert('Error2');
                                        }
                                        
                                        
                                    });                              
                                 
 
    }
    
    $(document).on("keydown", "textarea", function(){
	$(this).parent().find(".errorcmt").hide();
});
    
    function Validate() {
	 
	 var i=0;
	
	if($("#SAP_Reviewed_cmt").val() == ""){
		$("#SAP_Reviewed_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#SAP_Reviewed_cmt").parent().find(".errorcmt").hide();
	}
	if($("#MOI_for_Srv").val() == ""){
     $('#MOI_for_Srv').css('border-color', 'red');
     i=1;
     }
	if($("#MOI_for_Srv_cmt").val() == ""){
		$("#MOI_for_Srv_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#MOI_for_Srv_cmt").parent().find(".errorcmt").hide();
	}
	if($("#MOI_for_Main").val() == ""){
     $('#MOI_for_Main').css('border-color', 'red');
     i=1;
        }
	if($("#MOI_for_Main_cmt").val() == ""){
		$("#MOI_for_Main_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#MOI_for_Main_cmt").parent().find(".errorcmt").hide();
	}
	if($("#determine_the_MOI").val() == ""){
     $('#determine_the_MOI').css('border-color', 'red');
     i=1;
        }
	if($("#determine_the_MOI_cmt").val() == ""){
		$("#determine_the_MOI_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#determine_the_MOI_cmt").parent().find(".errorcmt").hide();
	}
	if($("#used_to_retrieve_the_document").val() == ""){
     $('#used_to_retrieve_the_document').css('border-color', 'red');
     i=1;
        }
	if($("#used_to_retrieve_the_document_cmt").val() == ""){
		$("#used_to_retrieve_the_document_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#used_to_retrieve_the_document_cmt").parent().find(".errorcmt").hide();
	}
		if($("#SAP").val() == ""){
     $('#SAP').css('border-color', 'red');
     i=1;
        }else{
        $('#SAP').css('border-color', '');    
        }
	if($("#SAP_cmt").val() == ""){
		$("#SAP_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#SAP_cmt").parent().find(".errorcmt").hide();
	}
			if($("#PRE_Inspection").val() == ""){
     $('#PRE_Inspection').css('border-color', 'red');
     i=1;
        }
	if($("#PRE_Inspection_cmt").val() == ""){
		$("#PRE_Inspection_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#PRE_Inspection_cmt").parent().find(".errorcmt").hide();
	}
	if($("#Post_Inspection_Required_per_PRE_Inspection").val() == ""){
     $('#Post_Inspection_Required_per_PRE_Inspection').css('border-color', 'red');
     i=1;
        }
	if($("#Post_Inspection_Required_per_PRE_Inspection_cmt").val() == ""){
		$("#Post_Inspection_Required_per_PRE_Inspection_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#Post_Inspection_Required_per_PRE_Inspection_cmt").parent().find(".errorcmt").hide();
	}
	if($("#POST_Inspection").val() == ""){
     $('#POST_Inspection').css('border-color', 'red');
     i=1;
        }
	if($("#POST_Inspection_cmt").val() == ""){
		$("#POST_Inspection_cmt").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#POST_Inspection_cmt").parent().find(".errorcmt").hide();
	}
		if($("#Cross_Bore_Log").val() == ""){
     $('#Cross_Bore_Log').css('border-color', 'red');
     i=1;
        }
	if($("#Cross_Bore_Log_Ready").val() == ""){
		$("#Cross_Bore_Log_Ready").parent().find(".errorcmt").show();
		i=1;
	}
	else{
		$("#Cross_Bore_Log_Ready").parent().find(".errorcmt").hide();
	}
	if(i==1)
	{
	    return true;
	    
	}
	else
	{
	    return false;
	}
	 
}
</script>
<script>
 $( document ).ready(function() {
//  $(".datepicker").on("change", function() {
//   //  alert(this.value);
//           if(this.value!=''){
//     this.setAttribute(
//         "data-date",
//         moment(this.value, "YYYY-MM-DD")
//         .format( this.getAttribute("data-date-format") )
//     )
//          }else{
             
//          }
// }).trigger("change")
// $("#form-wizard-t-0").css({'cursor': '', 'pointer-events' : 'none'});
// $("#form-wizard-t-1").css({'cursor': '', 'pointer-events' : 'none'});
// $("#form-wizard-t-2").css({'cursor': '', 'pointer-events' : 'none'});
// $("#form-wizard-t-3").css({'cursor': '', 'pointer-events' : 'none'});

  });


</script>
</body>

</html>
                  