
<link href="assets/vendors/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/toastr.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/lobinbox.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/vendors/css/datatables.min.css" rel="stylesheet" />
    <link href="assets/vendors/css/select.datatable.min.css" rel="stylesheet" />
     
         
    <link href="assets/css/main.min.css" rel="stylesheet" />
	 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
<style>
body{background:none;}
.inlineInput.inlineinput2 {
    min-width: 292px !important;
}
.full-w-input {
    margin-left: 21px;
    width: 100% !important;
}
.form-group.fild-width.textarea-formdiv.ml-6 {
    margin-left: 86px;
}
.form-group.fild-width.textarea-formdiv {
    margin-left: 88px;
}
.stepForm .form-group.fild-width textarea.form-control {
    width: 95% !important;
}
</style>
        <div class="container mk">
            <div class="content-wrapper">
                <!-- START PAGE CONTENT-->
                <div class="page-content fade-in-up mb-4" >
                    <div class="row">
                        <div class="col-sm-12">
                           <div class="modal-content border-0">
                        <div class="container" id="prnct">					
                            <form id="form-wizard" action="javascript:;" method="post" novalidate="novalidate" class="mform stepForm wizard p-2 background-form-div clearfix" role="application">
							<h5 class="font-strong mb-4 pt-4 formheadingdiv01">Cover Sheet</h5>
                           <div class="rowdiv1">
						    <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Reviewer LANID</label>
                                    <div class="col-sm-7">
                                       <input type="text"  value="" id="2lanid" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Date of Review</label>
                                    <div class="col-sm-7">
                                       <input type="text"  value="" id="2review_date" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Reviewer Completion Date</label>
                                    <div class="col-sm-7">
                                       <input type="text" placeholder=""  value="" id="2review_completion_date" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Number</label>
                                    <div class="col-sm-7">
                                       <input type="text"  readonlyvalue="" id="2order_no" class="form-control valid" placeholder="" aria-invalid="2false">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Project ID</label>
                                    <div class="col-sm-7">
                                       <input type="text" value=""  id="2project_id" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Division</label>
                                    <div class="col-sm-7">
                                       <input type="text" value=""  id="2division" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">City</label>
                                    <div class="col-sm-7">
                                       <input type="text" value=""  id="2city" class="form-control">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Order Description</label>
                                    <div class="col-sm-7">
                                       <textarea value=""  id="2order_description" class="form-control"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">FE/CM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value=""  id="2FE_CM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">CE/RCM</label>
                                    <div class="col-sm-7">
                                       <input type="text" value=""  id="2CE_RCM" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Foreman</label>
                                    <div class="col-sm-7">
                                       <input type="text" value=""  id="2foreman" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">M&amp;C Supervisor</label>
                                    <div class="col-sm-7">
                                       <input type="text" value=""  id="2m_c_supervisor" class="form-control" placeholder="">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Distribution/Transmission</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid"  aria-invalid="2false" id="2Distribution_Transmission">
                                         
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Resp Group</label>
                                    <div class="col-sm-7">
                                       <input type="text" class="form-control valid"  aria-invalid="2false" id="2resp_gp">
                                        
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
												<input type="text" value=""  id="2mat" class="form-control full-w-input">
											
											</div>
											<div class=" col-1">
												  <div class="custom-control custom-checkbox" style="margin-left: 18px;">
										  <input type="checkbox" class="custom-control-input" id="customCheck1">
										  <label class="custom-control-label" for="customCheck1">&nbsp;</label>
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
                                          <input id="2cn24" type="text"  class="form-control inlineInput inlineinput2">                                            
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value=""  id="2cn24_lanid" class="form-control valid" placeholder="" aria-invalid="2false">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text" value=""  id="2cn24_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" id="customCheck2">
										  <label class="custom-control-label" for="customCheck2">&nbsp;</label>
										</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">CN29</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text"  class="form-control" id="2cn29">
                                              
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input value=""  id="2cn29_lanid" type="text" class="form-control" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                             <!--<input  type="text" value="" id="2cn29_date" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" placeholder="Date">-->
                                             <input type="text"  value="" id="2cn29_date" class="form-control datepicker" data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" id="customCheck3">
										  <label class="custom-control-label" for="customCheck3">&nbsp;</label>
										</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">CN07</label>
                                          <span class="inlineInput inlineinput2">
										  
                                             <input type="text"  class="form-control" id="2cn07">
                                                
                                             
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2cn07_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2cn07_date" placeholder="">
                                          </span>
                                          <span>&nbsp;</span>
                                          <div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" id="customCheck4">
										  <label class="custom-control-label" for="customCheck4">&nbsp;</label>
										</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 39</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text"  class="form-control" id="2dc39">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2dc39_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc39_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 46</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text"  class="form-control" id="2dc46">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2dc46_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc46_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 05</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text"  class="form-control" id="2dc05">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2dc05_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc05_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 14</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text"  class="form-control" id="2dc14">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2dc14_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc14_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 15</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text"  class="form-control" id="2dc15">
                                               
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2dc15_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc15_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 19</label>
                                          <span class="inlineInput inlineinput2">
                                             <input type="text"  class="form-control valid" id="2dc19" aria-invalid="2false">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2dc19_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc19_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group fild-width label-width">
                                          <label class="pl-4">DC 10</label>
                                          <span class="inlineInput inlineinput2">
                                            <input type="text"  class="form-control" id="2dc10">
                                                
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  class="form-control" value="" id="2dc10_lanid" placeholder="">
                                          </span>
                                          <span class="inlineInput inlineinput2">
                                          <input type="text"  data-date="MM-DD-YYYY" data-date-format="MM-DD-YYYY" class="form-control datepicker" value="" id="2dc10_date" placeholder="">
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 
                              </div>
							  <div class="row">
                                    <div class="col-sm-12 pl-4">
									
                                       <div class="form-group fild-width textarea-formdiv">
                                          <label class=" d-block">General comments for SAP task (CN/DC): </label>
                                          <textarea value=""  id="2cmt_cn_dc" class="form-control bg-white"></textarea>
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
                                    <div class="outerDivFull">
                                                        <div class="switchToggle">
                                                            <input type="checkbox" name="name" value="" id="CN29_in_SAP">
                                                            <label for="CN29_in_SAP">Toggle</label>
                                                        </div>
                                                        <!--<div class="switchToggle">
                                                            <input type="checkbox" name="name" value="" id="switch1" >
                                                            <label for="switch1">Toggle</label>
                                                        </div>-->
                                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="form-group class-color_div">
                                  <textarea rows="2"  id="2CN29_in_SAP_cmt" value="" class="form-control bg-white" placeholder=""></textarea>
                                 </div>
                                 <span class="errorcmt"  id="2errorcmt" style="display:none;color:red;">Please Enter Notes</span>
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
                                       <input type="text"  class="form-control Qualify" id="2CN24">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2CN24_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt"  id="2errorCN24_cmt" style="display:none;color:red;">Please Enter Notes</span>
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
                                       <input type="text"  class="form-control Qualify" id="2gas_assets_installed">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2gas_assets_installed_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt"  id="2errorgas_assets_installed_cmt" style="display:none;color:red;">Please Enter Notes</span>
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
                                       <input type="text"  class="form-control Qualify" id="2installation_below_ground">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2installation_below_ground_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt"  id="2errorinstallation_below_ground_cmt" style="display:none;color:red;">Please Enter Notes</span>
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
                                       <input type="text"  class="form-control Qualify" id="2MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
                                    </div>
                                    <span class="errorcmt" id="2errorMOI_cmt"  style="display:none;color:red;">Please Enter Notes</span>
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
                                                            <input type="checkbox" name="name" value="" id="second">
                                                            <label for="second">Toggle</label>
                                                        </div>
                                                        <!--<div class="switchToggle">
                                                            <input type="checkbox" name="name" value="" id="switch1" >
                                                            <label for="switch1">Toggle</label>
                                                        </div>-->
                                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2" value=""  id="2SAP_Reviewed_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text"  class="form-control" id="2MOI_for_Srv">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2MOI_for_Srv_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text"  class="form-control" id="2MOI_for_Main">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2MOI_for_Main_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text"  class="form-control" id="2determine_the_MOI">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2determine_the_MOI_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text"  class="form-control" id="2used_to_retrieve_the_document">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2used_to_retrieve_the_document_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                          <input type="text"  value="" id="2SAP" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2SAP_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text"  class="form-control" id="2PRE_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                      <input type="text"  class="form-control" id="2Post_Inspection_Required_per_PRE_Inspection">
                                        
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2Post_Inspection_Required_per_PRE_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text"  class="form-control" id="2POST_Inspection">
                                          
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="form-group class-color_div">
                                      <textarea rows="2"  value="" id="2POST_Inspection_cmt" class="form-control bg-white" placeholder=""></textarea>
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
                                       <input type="text"  class="form-control" id="2Cross_Bore_Log">                                          
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
                                      <textarea rows="2" id="2Cross_Bore_Log_cmt"  class="form-control bg-white" placeholder=""></textarea>
                                    </div>
									
                                 </div>
								 
                              </div>
							   
						   </div>
						   <div class="row padd-div">
                                 <div class="col-sm-12 text-center">
							  <button class="btn btn-primary approvediv-color mr-2 mb-2">Print</button>
                          
						   </div>
						   </div>
                             </form>
                        </div>
                       <!-- Modal Footer -->
            </div>
                            </div>
                        </div>
                    </div>
                    

                  