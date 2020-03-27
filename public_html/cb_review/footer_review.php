<?php
// include('header.php');
$userid = $_SESSION['userid'];
$role_id = $_SESSION['role'];

?> 
 <footer class="page-footer">
                <div class="font-13">2019 ©</div>
                <div class="px-3">
                  Developed By: <a href="">CROSS BORE</a>
                </div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>

    <!-- START SEARCH PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
	
   <!--<div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>--> 
	
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="../../assets/vendors/js/jquery.min.js"></script>
    <script src="../../assets/vendors/js/popper.min.js"></script>
    <script src="../../assets/vendors/js/bootstrap.min.js"></script>
    <script src="../../assets/vendors/js/metisMenu.min.js"></script>
    <script src="../../assets/vendors/js/jquery.slimscroll.min.js"></script>
    <script src="../../assets/vendors/js/toastr.min.js"></script>
    <script src="../../assets/vendors/js/jquery.validate.min.js"></script>
    <script src="../../assets/vendors/js/bootstrap-select.min.js"></script>
    <script src="../../assets/js/lobinbox.min.js"></script>
    <script src="../../assets/js/jquery.base64.js"></script>
    <script src="../../assets/js/jquery.base64.min.js"></script>
    <!-- datatables -->
    <!--<script src="assets/vendors/js/datatables.min.js"></script> -->
    <script src="../../assets/vendors/js/jquery.dataTables.min.js"></script>
    <!--<script src="assets/vendors/js/dataTables.bootstrap4.min.js"></script>-->
    <!--<script src="assets/vendors/js/dataTables.select.min.js"></script>-->
    <!-- pie chart -->
    <script src="../../assets/vendors/Flot/jquery.flot.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.resize.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.tooltip.min.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.categories.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.selection.js"></script>
    <script src="../../assets/vendors/Flot/jquery.flot.orderBars.js"></script>
    <!--<script src="../../assets/js/crossbore_main.js"></script>-->
             <script src="../../assets/js/app.min.js"></script>
    <script src="../../assets/js/dashboard.reviewer.min.js"></script><!--Reviewer dashboard js-->
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <?php
        $link = $_SERVER['PHP_SELF'];
        $link_array = explode('/',$link);
        $current_page = end($link_array);
        $roleID = explode(',',$role_id);
       ?>
          
           
        
	<script>
	/*$("#addmem").click(function(e){
var fname = $("#first_name").val();
var lname = $("#last_name").val();
var lanid = $("#lan_id").val();
var address = $("#address").val();
if(lanid !=''){

        $.ajax({
            type:'POST',
            url: 'AddMemberJS.php',
            data:{FisrtName:fname,LastName:lname,LanID:lanid,Address:address},
            success :function(data){
          $("#ship_value").html("<p>Member Created Successfully</p>");
		 document.getElementById("ship_value").style.color = "green"; 
         window.setTimeout(function () { 
         location.reload() }, 3000);
    }
});
}else{
$("#ship_value").html("<p>Error</p>");
document.getElementById("ship_value").style.color = "Red"; 

}
});*/
</script>
<style>
    @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
  .dropdown-menu.dropdown-arrow.dropdown-menu-right.admin-dropdown-menu.mr-md-1.mdropdown.show .dropdown-item.active, .dropdown-item:active {
    text-decoration: none;
    color: #f39c12 !important;
    background: none !IMPORTANT;
}


</style>
 <div id="printThis">
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="content">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="container" id="prnct">					
                            <form id="form-wizard" action="javascript:;" method="post" novalidate="novalidate" class="mform stepForm wizard p-2 background-form-div clearfix" role="application">
						    <button type="button" class="close buttondivbold" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
                           </button>
							<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Cover Sheet</h5>
                            <div class="rowdiv1">
						    <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Reviewer LANID</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly="" value="" id="2lanid" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Date of Review</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly="" value="" id="2review_date" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Reviewer Completion Date</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder="" readonly value="" id="2review_completion_date" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Number</label>
                                    <div class="col-sm-7">
                                       <input type="text" readonly="" value="" id="2order_no" class="form-control valid" placeholder="" aria-invalid="2false">
                                    <input type="hidden" id="OREDRNO" value="">
                                    <input type="hidden" id="USERID" value="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Project ID</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="2project_id" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Division</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly  id="2division" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">City</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="2city" class="form-control">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Description</label>
                                    <div class="col-sm-7">
                                       <textarea  value="" readonly id="2order_description" class="form-control"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">FE/CM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="2FE_CM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">CE/RCM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="2CE_RCM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Foreman</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="2foreman" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">M&amp;C Supervisor</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" readonly id="2m_c_supervisor" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Distribution/Transmission</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid" readonly aria-invalid="2false" id="2Distribution_Transmission">
                                         
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Resp Group</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid" readonly aria-invalid="2false" id="2resp_gp">
                                        
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
												<input type="text" value="" readonly id="2mat" class="form-control full-w-input">
											
											</div>
											<div class=" col-1">
												 <div class="custom-control custom-checkbox ml-4">
													 <input type="checkbox" value="" readonly class="custom-control-input" id="2Checkmat">
													 <label class="custom-control-label checkdivclass" readonly for="Checkmat"></label>
												  </div>
											</div>
									   </div>                             
                                          
                                         
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">

                                          <label class="pl-4">CN24</label>
										  <span class="inlineInput inlineinput2">
                                          <input id="2cn24" type="text" readonly class="form-control inlineInput inlineinput2">                                            
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value="" readonly  id="2cn24_lanid" class="form-control valid" placeholder="" aria-invalid="2false">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value="" readonly id="2cn24_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" id="2check_cn24" readonly class="custom-control-input">
                                             <label class="custom-control-label checkdivclass" for="check_cn24"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">CN29</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly class="form-control" id="2cn29">
                                              
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input value="" readonly id="2cn29_lanid" type="text" class="form-control" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                             <!--<input  type="text" value="" id="2cn29_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="Date">-->
                                             <input type="text" readonly value="" id="2cn29_date" class="form-control datepicker" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" readonly class="custom-control-input" id="2check_cn29">
                                             <label class="custom-control-label checkdivclass" for="check_cn29"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">CN07</label>
                                          <span class="inlineInput inlineinput2">
										  
                                             <input type="text" readonly class="form-control" id="2cn07">
                                                
                                             
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2cn07_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2cn07_date" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" value="" readonly class="custom-control-input" id="2check_cn07">
                                             <label class="custom-control-label checkdivclass" for="check_cn07"></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 39</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="2dc39">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2dc39_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc39_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 46</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly class="form-control" id="2dc46">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2dc46_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc46_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 05</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="2dc05">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2dc05_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc05_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 14</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly  class="form-control" id="2dc14">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2dc14_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc14_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 15</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly  class="form-control" id="2dc15">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2dc15_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc15_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 19</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text" readonly class="form-control valid" id="2dc19" aria-invalid="2false">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2dc19_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc19_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 10</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text" readonly  class="form-control" id="2dc10">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly class="form-control" value="" id="2dc10_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" readonly data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc10_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 
                              </div>
							  <div class="row">
                                    <div class="col-sm-12 pl-4">
                                       <div class="form-group fild-width textarea-formdiv">
                                          <label class=" d-block">General comments for SAP task (CN/DC): </label>
                                          <textarea  value="" readonly id="2cmt_cn_dc" class="form-control bg-white"></textarea>
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
                                       <input type="checkbox" readonly name="name" value="" id="2CN29_in_SAP">
                                       <label for="CN29_in_SAP">Toggle</label>
                                    </div>
                                    <!--<div class="switchToggle">
                                       <input type="checkbox" name="name" value="" id="2switch1" >
                                       <label for="switch1">Toggle</label>
                                       </div>-->
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group class-color_div">
                                  <textarea rows="2" readonly id="2CN29_in_SAP_cmt" value="" class="form-control bg-white" placeholder=""></textarea>
                                 </div>
                                 <span class="errorcmt" readonly id="2errorcmt" style="display:none;color:red;">Please Enter Notes</span>
                              </div>
                           </div>
                           <div id="2qualfi" class="">
                              <div class="row padd-div CN24-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Has the work been completed ?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control Qualify" id="2CN24">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2CN24_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="2errorCN24_cmt" style="display:none;color:red;">Please Enter Notes</span>
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
                                       <input type="text" readonly class="form-control Qualify" id="2gas_assets_installed">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2gas_assets_installed_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="2errorgas_assets_installed_cmt" style="display:none;color:red;">Please Enter Notes</span>
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
                                       <input type="text" readonly class="form-control Qualify" id="2installation_below_ground">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2installation_below_ground_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" readonly id="2errorinstallation_below_ground_cmt" style="display:none;color:red;">Please Enter Notes</span>
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
                                       <input type="text" readonly class="form-control Qualify" id="2MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" id="2errorMOI_cmt" readonly style="display:none;color:red;">Please Enter Notes</span>
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
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="outerDivFull">
                                       <div class="switchToggle">
                                          <input type="checkbox" name="name" readonly value="" id="2SAP_Reviewed">
                                          <label for="SAP_Reviewed">Toggle</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" value="" readonly id="2SAP_Reviewed_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>MOI for Srv (s)?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="2MOI_for_Srv">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2MOI_for_Srv_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text" readonly class="form-control" id="2MOI_for_Main">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2MOI_for_Main_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text" readonly class="form-control" id="2determine_the_MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2determine_the_MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text" readonly class="form-control" id="2used_to_retrieve_the_document">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2used_to_retrieve_the_document_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                          <input type="text" readonly value="" id="2SAP" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2SAP_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text" readonly class="form-control" id="2PRE_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                      <input type="text" readonly class="form-control" id="2Post_Inspection_Required_per_PRE_Inspection">
                                        
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2Post_Inspection_Required_per_PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text" readonly class="form-control" id="2POST_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" readonly value="" id="2POST_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row padd-div">
                                 <div class="col-sm-8 col-md-4 align-self-center">
                                    <div class="form-group fild-width">
                                       <label>Cross Bore Log (s) Ready for Inspection ?</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-2 align-self-center">
                                    <div class="select-box-div">
                                       <input type="text" readonly class="form-control" id="2Cross_Bore_Log">                                          
                                    </div>
                                    <!--<div class="outerDivFull">
                                       <div class="switchToggle">
                                           <input type="checkbox" name="name" value="" id="2Cross_Bore_Log">
                                           <label for="Cross_Bore_Log">Toggle</label>
                                       </div>
                                       </div>-->
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" id="2Cross_Bore_Log_cmt" readonly class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                 </div>
                              </div>
                          
						   </div>
                             </form>
                        </div>
    <div class="row padd-div">
                                 <div class="col-sm-12 text-center">
							  <a><button onclick="return downloadpdf()" type="button" class="btn btn-primary approvediv-color mr-2 mb-2">Download PDF</button></a>
                          
						   </div>
						   </div>
                     </div>
                    
                  </div> </div> </div> 

                  <div id="editor" style="color:#000"></div>
                   
                  <!-- Button trigger modal -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script>
    (function () {
        var
         form = $('#prnct'),
         cache_width = form.width(),
         a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#btnPrint').on('click', function () {
            $('body').scrollTop(0);
           // createPDF();
        });
        //create pdf
        function createPDF() {
            getCanvas().then(function (canvas) {
			console.log(canvas);
                var
                 img = canvas.toDataURL("image/png"),
                 doc = new jsPDF({
                     unit: 'px',
                     format: 'a4'
                 });
				 console.log(img);
                doc.addImage(img, 'png', 20, 20);
                doc.save('download.pdf');
                form.width(cache_width);
            });
        }

        // create canvas object
        function getCanvas() {
            form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
            return html2canvas(form, {
                imageTimeout: 2000,
                removeContainer: true
            });
        }

    }());
</script>
<script>
    /*
 * jQuery helper plugin for examples and tests
 */
    (function ($) {
        $.fn.html2canvas = function (options) {
            var date = new Date(),
            $message = null,
            timeoutTimer = false,
            timer = date.getTime();
            html2canvas.logging = options && options.logging;
            html2canvas.Preload(this[0], $.extend({
                complete: function (images) {
                    var queue = html2canvas.Parse(this[0], images, options),
                    $canvas = $(html2canvas.Renderer(queue, options)),
                    finishTime = new Date();

                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);
                    $canvas.siblings().toggle();

                    $(window).click(function () {
                        if (!$canvas.is(':visible')) {
                            $canvas.toggle().siblings().toggle();
                            throwMessage("Canvas Render visible");
                        } else {
                            $canvas.siblings().toggle();
                            $canvas.toggle();
                            throwMessage("Canvas Render hidden");
                        }
                    });
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);
                }
            }, options));

            function throwMessage(msg, duration) {
                window.clearTimeout(timeoutTimer);
                timeoutTimer = window.setTimeout(function () {
                    $message.fadeOut(function () {
                        $message.remove();
                    });
                }, duration || 2000);
                if ($message)
                    $message.remove();
                $message = $('<div ></div>').html(msg).css({
                    margin: 0,
                    padding: 10,
                    background: "#000",
                    opacity: 0.7,
                    position: "fixed",
                    top: 10,
                    right: 10,
                    fontFamily: 'Tahoma',
                    color: '#fff',
                    fontSize: 12,
                    borderRadius: 12,
                    width: 'auto',
                    height: 'auto',
                    textAlign: 'center',
                    textDecoration: 'none'
                }).hide().fadeIn().appendTo('body');
            }
        };
    })(jQuery);

</script>

    <script>
        
        	$(document).ready(function(){
                 $(function($) {
     var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
     $('ul.navbar-toolbar li a').each(function() {
      if (this.href === path) {
       $(this).parent().addClass('menu-active');
		            $(this).closest("li").find('ul li a').css({'color':'#1e1c1f'});
		             $(this).closest("li.menu-has-children").addClass("menu-active");
      }
     });
});
});
    </script>
    <script>
        	$(document).ready(function(){
        	    var pathname = window.location.pathname;
        	   // alert(pathname);
        	   var pageURL = $(location).attr("href");
               //alert(pageURL);
               //https://crossfinal.epiksolution.org/cb_review/senior_team/view-jobs-matcode.php
               if (pathname.includes("ws_filter")) {
                //alert("ok");
                $(".nav").find("li:nth-child(2)").addClass("menu-active");
                
                }
                else if(pathname.includes("job-filter")){
                    
                     $(".nav").find("li:nth-child(3)").addClass("menu-active");
                }
                else if(pathname.includes("review_report1")){
                     $(".nav").find("li:nth-child(4)").addClass("menu-active");
                }
                 else if(pathname.includes("view-jobs-matcode")){
                     if(pageURL.includes("senior_team")){
                        $(".nav").find("li:nth-child(5)").addClass("menu-active");
                     } else {
                         $(".nav").find("li:nth-child(3)").addClass("menu-active");
                     }
                }
                 else if(pathname.includes("view-jobs-respgroup")){
                     if(pageURL.includes("senior_team")){
                         $(".nav").find("li:nth-child(5)").addClass("menu-active");
                     } else {
                         $(".nav").find("li:nth-child(3)").addClass("menu-active");
                     }
                     
                }
                else if(pathname.includes("view-jobs-division")){
                     if(pageURL.includes("senior_team")){
                         $(".nav").find("li:nth-child(5)").addClass("menu-active");
                     }else {
                         $(".nav").find("li:nth-child(3)").addClass("menu-active");
                     }
                     
                }
                else if(pathname.includes("view-jobs-fecm")){
                    if(pageURL.includes("senior_team")){
                         $(".nav").find("li:nth-child(5)").addClass("menu-active");
                    }else{
                         $(".nav").find("li:nth-child(3)").addClass("menu-active");
                    }
                    
                }
                else if(pathname.includes("view-jobs-foreman")){
                    if(pageURL.includes("senior_team")){
                         $(".nav").find("li:nth-child(5)").addClass("menu-active");
                    }else{
                         $(".nav").find("li:nth-child(3)").addClass("menu-active");
                    }
                    
                }
                else if(pathname.includes("view-jobs-inspector")){
                    if(pageURL.includes("senior_team")){
                         $(".nav").find("li:nth-child(5)").addClass("menu-active");
                    }else {
                        $(".nav").find("li:nth-child(3)").addClass("menu-active");
                    }
                }
                
                
               
            });
    </script>
   <script>
        var refreshTime = 6000000 
        // every 10 minutes in milliseconds 
        window.setInterval( function() { 
            $.ajax({
                cache: false, 
                type: "GET", 
                url: "../../refreshSession.php", 
                success: function(data) { 
                    
                } 
                
            }); 
            
        }, refreshTime );
    </script>
</body>


</html>