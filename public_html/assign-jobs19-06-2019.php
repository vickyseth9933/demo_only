<?php
include('header.php');
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID))
{
	
}else{
session_destroy();
header("Location: index.php");	
}
$sql = "SELECT * FROM cb_order_new WHERE user_id = 0 LIMIT 0,500";
$result = $conn->query($sql);

$sqlreviewer = "SELECT * FROM `cb_user` where role_id=3";
$resultreviewer = $conn->query($sqlreviewer);


?>
<style>
       .help-block {
    display: block;
    font-size: 13px;
    margin-bottom: 0;
    margin-top: 2px;
    color: #e40930 !important;
}
</style>
	<div class="container">
        <div class="content-wrapper mk">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <p class="assign_msg" style="display: none;"></p>
                               <h5 class="font-strong mb-3 mb-md-0">Jobs to be Reviewed</h5>
                                <div class="row">                                   
                                    <div class="col-sm-12">                                        
                                        <div class="d-flex mb-4 justify-content-end">                                            
                                            <div class="flexbox">
                                                <label class="mb-0 mr-2">Search</label>
                                                <div class="input-group-icon input-group-icon-left">
                                                    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="ad_assignjobstbl">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th><input name="select_all" value="1" id="adtbl-select-all" type="checkbox" /></th>
                                                        <th>Order No</th>
                                                        <th>Order Description</th>
                                                        <th>Resp Group</th>
                                                        <th>MAT</th>
                                                       
                                                    </tr>
                                                </thead>
                                               <tbody>
										<?php
										$ArrOrderNo = array();
											while($row = $result->fetch_assoc()) {
											$ArrOrderNo[] = $row['order_no'];
											?>
											<tr>
                                                <td><input type="checkbox" name="reviewer[]" class="checkbox" value="<?php echo $row['order_no'];?>"></td>
                                                <td><?php echo $row['order_no'];?></td>
                                                <td><?php echo $row['description'];?></td>
                                                <td><?php if($row['RESPONSIBLE_GROUP']!=''){echo $row['RESPONSIBLE_GROUP']; }else{ echo 'N\A';}?></td>
                                                <td><?php echo $row['mat'];?></td>
                                             </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                            </table>
											
                                        </div>
                                        <label id="error" class="help-block" for="email"></label>
										<div class="last-form-var">
											<div class="d-flex align-items-center justify-content-center justify-content-sm-start my-4">
                                                <label class="mb-0 mr-2">Please Select User:</label>
                                                <div>
                                                    <select title="James" data-style="btn-solid" data-width="150px" id="user_id" class="form-control">
                                                        <option value="">Please select</option>
                                                        <?php
    											while($rowreviewer = $resultreviewer->fetch_assoc()) { ?>
                                                        <option value="<?= $rowreviewer['id'] ?>"><?= $rowreviewer['first_name'] ?>   <?= $rowreviewer['last_name'] ?></option>
                                                       <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="download-icondiv">
										  <button onclick="return assign()" type="button" class="btn btn-primary approvediv-color text-white mr-2" id="submit">Assign Job</button>
										  
									        <a><button onclick="return assign50()" type="button" class="btn bg-success approvediv-color divcolororange text-white">Assign Top 50</button></a>
											
									        <a><button onclick="return assign100()" type="button" class="btn bg-info approvediv-color color01 text-white mx-2">Assign Top 100</button></a>
                                            </div>
                                           <?php $allorderno = implode(',', $ArrOrderNo); ?>
											</div>
                                    </div>
                                </div>
                                <!-- <div class="row" id="assign_tojob" style="display: none;"> -->
                                    <!-- <div class="col-sm-12  d-flex"> -->
                                        <!-- <select class="form-control mr-3 w-auto" id="ad_assignctrl" name="ad_assignctrl" style="padding: .375rem .75rem;"> -->
                                            <!-- <option>Assign Jobs To</option> -->
                                            <!-- <option>Sam</option> -->
                                            <!-- <option>Michal</option> -->
                                        <!-- </select> -->
                                        <!-- <button type="button" class="btn btn-primary" style="padding: .375rem .75rem;">Submit</button> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <?php
include('footer.php');

?>
            <!-- END PAGE CONTENT-->
  <!--          <footer class="page-footer">-->
  <!--              <div class="font-13">2019 ©</div>-->
  <!--              <div class="px-3">-->
  <!--                  Design by: <a href="http://epikso.com" target="_blank">Epik Solutions</a>-->
  <!--              </div>-->
  <!--              <div class="to-top"><i class="fa fa-angle-double-up"></i></div>-->
  <!--          </footer>-->
  <!--      </div>-->
		<!--</div>-->
  <!--  </div>-->
    <!-- START SEARCH PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
  <!--  <div class="sidenav-backdrop backdrop"></div>-->
    
	 <!--<div class="preloader-backdrop">-->
  <!--      <div class="page-preloader">Loading</div>-->
  <!--  </div> -->
	
	
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
  <!--  <script src="assets/vendors/js/jquery.min.js"></script>-->
  <!--  <script src="assets/vendors/js/popper.min.js"></script>-->
  <!--  <script src="assets/vendors/js/bootstrap.min.js"></script>-->
  <!--  <script src="assets/vendors/js/metisMenu.min.js"></script>-->
  <!--  <script src="assets/vendors/js/jquery.slimscroll.min.js"></script>-->
  <!--  <script src="assets/vendors/js/toastr.min.js"></script>-->
  <!--  <script src="assets/vendors/js/jquery.validate.min.js"></script>-->
  <!--  <script src="assets/vendors/js/bootstrap-select.min.js"></script>-->
  <!--      <script src="assets/js/lobinbox.min.js"></script>-->

    <!-- datatables -->
    <!-- <script src="assets/vendors/js/datatables.min.js"></script> -->
  <!--  <script src="assets/vendors/js/jquery.dataTables.min.js"></script>-->
  <!--  <script src="assets/vendors/js/dataTables.bootstrap4.min.js"></script>-->
  <!--  <script src="assets/vendors/js/dataTables.select.min.js"></script>-->
  <!--  <script src="assets/js/app.min.js"></script>-->
    <script>
        $(function() {
            $('#ad_assignjobstbl').DataTable({
                pageLength: 5,
                fixedHeader: true,
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                },
                "sDom": 'rtip',
                'columnDefs': [{
                 'targets': 0,
                 'searchable':false,
                 'orderable':false,
                 'className':'sno',
                 
              }],
              'order': [1, 'asc']
            });

            var table = $('#ad_assignjobstbl').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table.column(4).search($(this).val()).draw();
            });
            $('#adtbl-select-all').on('click', function(){
              // Check/uncheck all checkboxes in the table
              var rows = table.rows({ 'search': 'applied' }).nodes();
              $('input[type="checkbox"]', rows).prop('checked', this.checked);
              $("#assign_tojob").toggle();
           });
        });
    </script>
    <script>
//$( document ).ready(function() {
  //$(document).on('change','.datepicker2',function() {
        // $("#submit").on("click", function() {
              function assign() {
         var order_no = new Array();
$.each($("input[name='reviewer[]']:checked"), function() {
  order_no.push($(this).val());
  // or you can do something to the actual checked checkboxes by working directly with  'this'
  // something like $(this).hide() (only something useful, probably) :P
});
var user_id = $('#user_id').val();
if(order_no==''){
  $('#error').text('Please select atleast one job');  
  return false;  
}
if(user_id==''){
  $('#error').text('Please select reviewer');  
  return false;  
}
 Lobibox.confirm({
            msg: 'Are you sure want to assign this jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 
 var request = $.ajax({
                                      url: "job_assign_js.php",
                                      type: "POST",
                                      data: {id:user_id,order_no:order_no,form_type:'assign'}
                                    });
                                  
                                    request.done(function(msg) {
                                     $(".assign_msg").text("Hello world!");
                               location.reload();
                          // alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                              //   alert( "Request failed: " + textStatus );
                                    });
			 }
                }
               });
         }            
//});
//});
</script>
<script>
   function assign50() {
  var order_no = '<?= $allorderno ?>';
var approveby = $('#user_id').val();
if(order_no==''){
  $('#error').text('Please select atleast one job');  
  return false;  
}
if(approveby==''){
  $('#error').text('Please select reviewer');  
  return false;  
}
Lobibox.confirm({
            msg: 'Are you sure want to Assign Top 50 jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "job_assign_js.php",
                                      type: "POST",
                                      data: {id:approveby,order_no:order_no,form_type:'top50'}
                                    });
                                   
                                    request.done(function(msg) {
                                     //console.log(msg);
                                    location.reload();
                                // alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                  //  alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
      
 
    }  
      function assign100() {
  var order_no = '<?= $allorderno ?>';
var approveby = $('#user_id').val();
if(order_no==''){
  $('#error').text('Please select atleast one job');  
  return false;  
}
if(approveby==''){
  $('#error').text('Please select reviewer');  
  return false;  
}
Lobibox.confirm({
            msg: 'Are you sure want to Assign Top 50 jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
			 var request = $.ajax({
                                      url: "job_assign_js.php",
                                      type: "POST",
                                      data: {id:approveby,order_no:order_no,form_type:'top100'}
                                    });
                                   
                                    request.done(function(msg) {
                                     //console.log(msg);
                                     location.reload();
                                // alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                                  //  alert( "Request failed: " + textStatus );
                                    }); 		
                 
                }
            }
        });
      
 
    }  
</script>

<!--</body>-->


<!--</html>-->