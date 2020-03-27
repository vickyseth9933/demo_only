<link href="assets/vendors/css/select.datatable.min.css" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="assets/css/main.min.css" rel="stylesheet" />
<style>
    select.bs-select-hidden, select.selectpicker{
            cursor: pointer;
            display: block!important;
    }
</style>
<?php 
session_start();
include_once 'config.php';
$conn = OpenCon();

$userid = $_SESSION['userid'];
 
// $sql = "SELECT * FROM cb_order_new WHERE user_id =$userid AND order_stage!='7' AND reject_status='0'";

    $sqlrejected = "SELECT cb_order_new.order_no,cb_order_new.reject_status,cb_order_new.commnets_of_reject,cb_order_new.recommendation,cb_order_new.user_id,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
INNER JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
INNER JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
INNER JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id =$userid AND  cb_order_new.rejected_date!='null' AND cb_order_new.reject_status='1'";
$resultrejected = $conn->query($sqlrejected);

?>
 
                               
                                <div class="flexbox control-div mb-4 flex-column flex-md-row">
                                    <div class="flexbox">
                                        <label class="mb-0 mr-2">Status:</label>
                                        <select class="selectpicker show-tick form-control" id="type-filter2" title="Please select" data-style="btn-solid" data-width="150px">
                                            <option value="">All</option>
                                            <option value="CN-29 Eligible">CN-29 Eligible</option>
                                            <option value="Field Remediation Required">Field Remediation Required</option>
                                            <option value="Unknown">Unknown Status</option>
                                          </select>
                                    </div>
                                    <br class="clearfix d-block d-md-none">
                                    <div class="input-group-icon input-group-icon-left">
                                        <span>Search</span>
										
                                        <input class="form-control form-control-rounded form-control-solid" id="key-search2" type="text" placeholder="">
                                    </div>
                                </div>
                               <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dash_datatable2">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>Reason For Reject</th>
                                                <th>MAT</th>
                                                
                                                
                                                <th>Current Stage</th>
                                                <th>Job Status</th>
                                                <th>Recommendation</th>
                                                
                                                <th width="80px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($rowrejected = $resultrejected->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $rowrejected['order_no'];?></td>
                                                <td><?php echo $rowrejected['description'];?></td>
                                                <td><?php echo $rowrejected['resp_group'];?></td>
                                                <td><?php echo $rowrejected['commnets_of_reject'];?></td>
                                                <td><?php echo $rowrejected['mat'];?></td>
                                                 <td><?php 
                                                 
                                                 if( $rowrejected['order_stage']=='0')
                                                 {
                                                     
                                                     echo 'Not-Started';
                                                 }
                                                 if( $rowrejected['order_stage']=='1')
                                                 {
                                                     
                                                     echo 'Cover Sheet';
                                                 }
                                                  if( $rowrejected['order_stage']=='2')
                                                 {
                                                     
                                                     echo 'Project Details';
                                                 }
                                                  if( $rowrejected['order_stage']=='3')
                                                 {
                                                     
                                                     echo 'Qualifying Five';
                                                 }
                                                  if( $rowrejected['order_stage']=='4')
                                                 {
                                                     
                                                     echo 'Checklist Questions';
                                                 }
                                                  if( $rowrejected['order_stage']=='5')
                                                 {
                                                     
                                                     echo 'Pending For Approval';
                                                 }
                                                  if( $rowrejected['order_stage']=='6')
                                                 {
                                                     
                                                     echo 'Approved';
                                                 }
                                                  if( $rowrejected['order_stage']=='7')
                                                 {
                                                     
                                                     echo 'Rejected';
                                                 }
                                                 ?>
                                                 
                                                 
                                                 
                                                 </td>
                                                 <?php
                                                   $sqljobstatusrej = "SELECT cb_order.status,order_status.order_name FROM `cb_order` INNER JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$rowrejected['order_no']."'";
                                                 $resultjonstatusrej = $conn->query($sqljobstatusrej);
                                                 $rowjonstatusrej = $resultjonstatusrej->fetch_assoc();
                                                 ?>
                                                 <td><?php 
                                                 
                                                 if( $rowjonstatusrej['order_name']=='CN-29 Eligible')
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">'.$rowjonstatusrej['order_name'].'</span>';
                                                 }
                                                
                                                  if( $rowjonstatusrej['order_name']=='Unknown Status')
                                                 {
                                                     echo '<span  style="color:lightblue !important;font-weight: bold;">Unknown</span>';
                                                 }
                                                 
                                                  if( $rowjonstatusrej['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rowjonstatusrej['order_name'].'</span>';
                                                 }
                                                 
                                                 
                                                 ?></td>
                                                 <td><?php if($rowrejected['recommendation']==null){ echo 'N/A'; } else { echo $rowrejected['recommendation']; } ?></td>
                                                  <?php if( $rowrejected['order_stage']=='5')
                                                 {
                                                 ?>
                                                     
                                                     <td align="center"><a href="#"  class="bttn">Pending For Approval</a></td>
                                                  <?php }else if($rowrejected['order_stage']=='6'){ ?>
                                                   <td align="center"><a href="#"  class="bttn">Approved</a></td>

                                                  <?php }else{
                                                  ?>  <td align="center"><a  onClick="return RestartReview('<?= $userid ?>','<?= $rowrejected['order_no'] ?>')" id="rejectbtn"  class="bttn">Restart Review</a></td><?php
                                                  } ?>
                                                 
                                                 
                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                       
<script>
$(function() {
    $('#dash_datatable2').DataTable({
        pageLength: 5,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatable2').DataTable();
    $('#key-search2').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filter2').on('change', function() {
         table.search($(this).val()).draw();
    });
    $('#adtbl-select-all2').on('click', function(){
              // Check/uncheck all checkboxes in the table
              var rows = table.rows({ 'search': 'applied' }).nodes();
              $('input[type="checkbox"]', rows).prop('checked', this.checked);
              $("#assign_tojob").toggle();
           });
});
</script>
 <script src="assets/vendors/js/bootstrap-select.min.js"></script>
										