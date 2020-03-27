<?php
include('header.php');
$role_id = $_SESSION['role'];
$roleID = explode(',',$role_id);
if (in_array("1", $roleID) || in_array("7", $roleID))
{
	
}else{
session_destroy();
header("Location: index.php");	
}
$sql50 = "SELECT order_no FROM cb_order_new WHERE user_id = 0 LIMIT 50";
$result50 = $conn->query($sql50);
$array50 = array();
while($rowreviewer50 = $result50->fetch_assoc()) {
$array50[] = $rowreviewer50['order_no'];	
}
$allorderno50 = implode(',', $array50);

$sql100 = "SELECT order_no FROM cb_order_new WHERE user_id = 0 LIMIT 100";
$result100 = $conn->query($sql100);
$array100 = array();
while($rowreviewer100 = $result100->fetch_assoc()) {
$array100[] = $rowreviewer100['order_no'];	
}
$allorderno100 = implode(',', $array100);
$sqlreviewer = "SELECT * FROM `cb_user` where role_id = 3";
$resultreviewer = $conn->query($sqlreviewer);


?>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" >
<style>
       .help-block {
    display: block;
    font-size: 13px;
    margin-bottom: 0;
    margin-top: 2px;
    color: #e40930 !important;
}
.green{
background: #1e7e34 !important;}
</style>
	<div class="container">
        <div class="content-wrapper mk">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="alert alert-success green" id="success-alert" style="display:none">
    <button type="button" class="close" data-dismiss="alert">x</button>
   Job has been assigned Successfully.
</div>
                                <p class="assign_msg" style="display: none;"></p>
                               <h5 class="font-strong mb-3 mb-md-0">Jobs to be Reviewed</h5>
                                <div class="row">                                   
                                    <div class="col-sm-12">                                        
                                        <div class="d-flex mb-4 justify-content-end">                                            
                                           <!--<div class="flexbox">
                                                <label class="mb-0 mr-2">Search</label>
                                                <div class="input-group-icon input-group-icon-left">
                                                    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="ad_assignjobstbl">
                                               <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                                                        <th>Order No</th>
                                                        <th>Order Description</th>
                                                        <th>Resp Group</th>
                                                        <th>MAT</th>
                                                       
                                                    </tr>
                                                </thead>
                                               <tbody>
										<?php
										?>
											 	
													
                                            
                                           
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
                                             <?php
                                        if (in_array("1", $roleID))
                                            {
                                                ?>
                                            <div class="download-icondiv">
										  <button onclick="return assign()" type="button" class="btn btn-primary approvediv-color text-white mr-2" id="submit">Assign Job</button>
										  
									        <a><button onclick="return assign50()" type="button" class="btn bg-success approvediv-color divcolororange text-white">Assign Top 50</button></a>
											
									        <a><button onclick="return assign100()" type="button" class="btn bg-info approvediv-color color01 text-white mx-2">Assign Top 100</button></a>
                                            </div>
                                          	<?php }else{
                                          	?>
                                           <div class="download-icondiv">
										  <button  type="button" disabled class="btn btn-primary approvediv-color text-white mr-2" id="submit">Assign Job</button>
										  
									        <a><button  type="button" disabled class="btn bg-success approvediv-color divcolororange text-white">Assign Top 50</button></a>
											
									        <a><button  type="button" disabled class="btn bg-info approvediv-color color01 text-white mx-2">Assign Top 100</button></a>
                                            </div>	
                                          	<?php
                                          	} ?> 
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
                        <div id="wait" style="display:none;position:absolute;top:50%;left:50%;padding:2px;"><img src='assets/img/Spinner-1s-200px.gif' width="64" height="64" /></div>

               <?php
 include('footer.php');

?>

 <!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>-->    
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
   $(document).ready(function() {
      ///  $("#success-alert").hide();
			//alert("db code");
			$('#ad_assignjobstbl').DataTable({
				"processing": true,
				"serverSide": true,
				'columnDefs': [{
         'targets': 0,
         'searchable': false,
         'orderable': false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="reviewer[]" value="' + $('<div/>').text(data).html() + '">';
         }
      }],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']],
				"ajax": "server_processing.php"
			});
			 // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
	  // alert('hello');
      // Get all rows with search applied
      //var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]').prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#ad_assignjobstbl tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   }); 		
		});
// 	$(document).ready(function() {
		
	
//   var table = $('#ad_assignjobstbl').DataTable({
//       'ajax': 'jobs.php',
//      'columnDefs': [{
//          'targets': 0,
//          'searchable': false,
//          'orderable': false,
//          'className': 'dt-body-center',
//          'render': function (data, type, full, meta){
//              return '<input type="checkbox" name="reviewer[]" value="' + $('<div/>').text(data).html() + '">';
//          }
//       }],
//       'select': {
//          'style': 'multi'
//       },
//       'order': [[1, 'asc']],
//       "columns":
//             [
//                 {data:'id'},
//                 {data:'order_no'},
//                 {data:'description'},
//                 {data:'RESPONSIBLE_GROUP'},
//                 {data:'mat'}
//             ]
//   });
 
// 	 // Handle click on "Select all" control
//   $('#example-select-all').on('click', function(){
//       // Get all rows with search applied
//       var rows = table.rows({ 'search': 'applied' }).nodes();
//       // Check/uncheck checkboxes for all rows in the table
//       $('input[type="checkbox"]', rows).prop('checked', this.checked);
//   });

//   // Handle click on checkbox to set state of "Select all" control
//   $('#ad_assignjobstbl tbody').on('change', 'input[type="checkbox"]', function(){
//       // If checkbox is not checked
//       if(!this.checked){
//          var el = $('#example-select-all').get(0);
//          // If "Select all" control is checked and has 'indeterminate' property
//          if(el && el.checked && ('indeterminate' in el)){
//             // Set visual state of "Select all" control
//             // as 'indeterminate'
//             el.indeterminate = true;
//          }
//       }
//   });	
		
      /* $('#ad_assignjobstbl').dataTable({
        "bProcessing": true,
        "sAjaxSource": "jobs.php",
		'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']],
        "aoColumns": [
              { mData: 'order_no' } ,
              { mData: 'order_no' },
              { mData: 'description' },
              { mData: 'RESPONSIBLE_GROUP' },
			  { mData: 'mat' }
            ]
      });  */
	    
		/* setInterval(function(){ 
				SetTd(); */
				/*var heads = [];
				$("thead").find("th").each(function () {
				  heads.push($(this).text().trim());
				});
				var rows = [];
				$("tbody tr").each(function () {
				  cur = {};
				  $(this).find("td").each(function(i, v) {
					cur[heads[i]] = $(this).text().trim();
				  });
				  
				  rows.push(cur);
				  console.log(rows);
				  cur = {};
				  
				});*/
		//}, 100);
 // });
  /* function SetTd(){
			$("#ad_assignjobstbl tr td:first-child").each(function(){
				var td0 = $(this).text();
				//var td1 = $('#order_no').text();
				//alert(td1);
				
				var checkbox = "<input type='checkbox' value='" + td0 +"' />";
				$(this).html(checkbox);
				//console.log(checkbox);
			});
		} */
		/*$(document).ready(function() {
			//alert("db code");
			$('#ad_assignjobstbl').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "server_processing.php"
			});
			
			setInterval(function(){ 
				SetTd();
			}, 500);		
		});*/
		
		
		/*function SetTd(){
			$("#ad_assignjobstbl tr td:first-child").each(function(){
				var td0 = $(this).text();
				//var td1 = $('#order_no').text();
				//alert(td1);
				
				var checkbox = "<input type='checkbox' value='" + td0 +"' />";
				$(this).html(checkbox);
				console.log(checkbox);
			});
		}*/
        /*$(function() {
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
			

            
        });*/
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
			 $(document).ajaxStart(function(){
              $("#wait").css("display", "block");
               }); 
              $('#error').text('');
 var request = $.ajax({
                                      url: "job_assign_js.php",
                                      type: "POST",
                                      data: {id:user_id,order_no:order_no,form_type:'assign'}
                                    });
                                  
                                    request.done(function(msg) {
                                           $("#wait").css("display", "none");
                                    // $(".assign_msg").text("Job has been assigned successfully!");
                                   //  $(".assign_msg").css("color", "green");

                                  // $(".assign_msg").show();
                                  $("#success-alert").fadeTo(4000, 700).slideUp(700, function(){
                                  $("#success-alert").slideUp(700);
                                  location.reload();
});
                           
                         // alert( "Requestc done: " + msg );
                                    });
                                     request.fail(function(jqXHR, textStatus) {
                             //alert( "Request failed: " + textStatus );
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
  var order_no = '<?= $allorderno50 ?>';
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
                     $(document).ajaxStart(function(){
              $("#wait").css("display", "block");
               }); 
              $('#error').text('');
			 var request = $.ajax({
                                      url: "job_assign_js.php",
                                      type: "POST",
                                      data: {id:approveby,order_no:order_no,form_type:'top50'}
                                    });
                                   
                                    request.done(function(msg) {
                                   $("#wait").css("display", "none");
                                     //console.log(msg);
                                  $("#success-alert").fadeTo(4000, 700).slideUp(700, function(){
                                  $("#success-alert").slideUp(700);
                                  location.reload();
});
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
  var order_no = '<?= $allorderno100 ?>';
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
            msg: 'Are you sure want to Assign Top 100 jobs.',
            title: 'Note : Confirmation',
            callback: function ($this, type) {
                if (type === 'yes') {
                        $(document).ajaxStart(function(){
              $("#wait").css("display", "block");
               }); 
              $('#error').text('');
			 var request = $.ajax({
                                      url: "job_assign_js.php",
                                      type: "POST",
                                      data: {id:approveby,order_no:order_no,form_type:'top100'}
                                    });
                                   
                                    request.done(function(msg) {
                                            $("#wait").css("display", "none");
                                     //console.log(msg);
                                     $('#error').text('');
                                  $("#success-alert").fadeTo(4000, 700).slideUp(700, function(){
                                  $("#success-alert").slideUp(700);
                                  location.reload();
});
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