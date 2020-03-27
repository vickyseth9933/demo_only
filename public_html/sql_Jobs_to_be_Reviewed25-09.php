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

  $sql = "SELECT cb_order_new.order_no,cb_order_new.user_id,cb_order_new.rejected_date,cb_order_new.recommendation,cb_order_new.reject_status,cb_order_new.RESPONSIBLE_GROUP,cb_order_new.mat as MAAT,cb_order_new.description as Discriptions,cb_order_new.order_stage,CONCAT(cb_user.first_name, ' ' , cb_user.last_name)  as name,cb_front_cover.order_description as description,cb_front_cover.resp_group,
cb_project_details.mat FROM cb_order_new 
LEFT JOIN cb_user ON(cb_order_new.user_id=cb_user.id)
LEFT JOIN cb_front_cover ON(cb_front_cover.order_id=cb_order_new.order_no)
LEFT JOIN cb_project_details ON(cb_project_details.order_id=cb_order_new.order_no)
WHERE cb_order_new.user_id =$userid AND cb_order_new.order_stage!='7' AND cb_order_new.reject_status='0'";
$result = $conn->query($sql);
?>
 
                                <div class="flexbox control-div mb-4 flex-column flex-md-row">
                                    <div class="flexbox">
                                        <label class="mb-0 mr-2">Status:</label>
                                        <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">
                                            <option value="">All</option>
                                            <option value="CN-29 Eligible">CN-29 Eligible</option>
                                            <option value="Field Remediation Required">Field Remediation Required</option>
                                            <option value="Unknown">Unknown Status</option>
                                            <option value="Not-Started">Not-Started</option>
                                            <option value="Pending For Approval">Approval Pending</option>
                                             <option value="Approved">Approved</option>
                                        </select>
                                    </div>
                                    <br class="clearfix d-block d-md-none">
                                    <div class="input-group-icon input-group-icon-left">
                                        <span>Search</span>
										
                                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dash_datatable">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>Order No</th>
                                                <th>Order Description</th>
                                                <th>Resp Group</th>
                                                <th>MAT</th>
                                                <th>Current Stage</th>
                                                <th>Job Status</th>
                                                <th>Recommendation</th>
                                                <th width="80px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											while($row = $result->fetch_assoc()) { ?>
											<tr>
                                                <td><?php echo $row['order_no'];?></td>
                                                <td><?php if($row['description']!=''){ echo $row['description']; }else{ echo $row['Discriptions'];
                                                 }?></td>
                                                <td><?php if($row['resp_group']!=''){ echo $row['resp_group']; } else { echo $row['RESPONSIBLE_GROUP']; }?></td>
                                                <td><?php if($row['mat']!=''){ echo $row['mat']; } else { echo $row['MAAT']; }?></td>
                                                 <td><?php 
                                                 
                                                 if( $row['order_stage']=='0')
                                                 {
                                                     
                                                     echo 'Not-Started';
                                                 }
                                                 if( $row['order_stage']=='1')
                                                 {
                                                     
                                                     echo 'Cover Sheet';
                                                 }
                                                  if( $row['order_stage']=='2')
                                                 {
                                                     
                                                     echo 'Project Details';
                                                 }
                                                  if( $row['order_stage']=='3')
                                                 {
                                                     
                                                     echo 'Qualifying Five';
                                                 }
                                                  if( $row['order_stage']=='4')
                                                 {
                                                     
                                                     echo 'Checklist Questions';
                                                 }
                                                  if( $row['order_stage']=='5')
                                                 {
                                                     
                                                     echo 'Approval Pending';
                                                 }
                                                  if( $row['order_stage']=='6')
                                                 {
                                                     
                                                     echo 'Approved';
                                                 }
                                                 ?>
                                                 
                                                 
                                                 
                                                 </td>
                                                 <?php
                                                 $sqljobstatus = "SELECT cb_order.status,order_status.order_name FROM `cb_order` INNER JOIN  order_status ON(cb_order.status=order_status.id) WHERE  cb_order.order_id='".$row['order_no']."'";
                                                 $resultjonstatus = $conn->query($sqljobstatus);
                                                 $rowjonstatus = $resultjonstatus->fetch_assoc();
                                                 ?>
                                                 <td><?php 
                                                 
                                                 if( $rowjonstatus['order_name']=='CN-29 Eligible')
                                                 {
                                                     echo '<span style="color:Green !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                
                                                  if( $rowjonstatus['order_name']=='Unknown Status')
                                                 {
                                                     echo '<span  style="color:lightblue !important;font-weight: bold;">Unknown</span>';
                                                 }
                                                 
                                                  if( $rowjonstatus['order_name']=='Field Remediation Required')
                                                 {
                                                     echo '<span  style="color:Orange !important;font-weight: bold;">'.$rowjonstatus['order_name'].'</span>';
                                                 }
                                                 
                                                 
                                                 ?></td>
                                                 <td><?php if($row['recommendation']==null){ echo 'N/A'; } else { echo $row['recommendation']; } ?></td>
                                                  <?php if( $row['order_stage']=='5')
                                                 {
                                                 ?>
                                                     
                                                     <td align="center"><a href="#"  class="bttn">Approval&nbsp;Pending</a></td>
                                                  <?php }else if($row['order_stage']=='6'){ ?>
                                                   <td align="center"><a href="#"  class="bttn">Approved</a></td>

                                                  <?php }else{
                                                  ?>  <td align="center"><a  onClick="return RestartReview('<?= $userid ?>','<?= $row['order_no'] ?>')"   class="bttn">Restart Review</a></td><?php
                                                  } ?>
                                                 
                                                 
                                            </tr>
															
													<?php } ?>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                       
<script>
    $(function() {
    $('#dash_datatable').DataTable({
        pageLength: 5,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatable').DataTable();
    $('#key-search').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filter').on('change', function() {
         table.search($(this).val()).draw();
    });
    $('#adtbl-select-all').on('click', function(){
              // Check/uncheck all checkboxes in the table
              var rows = table.rows({ 'search': 'applied' }).nodes();
              $('input[type="checkbox"]', rows).prop('checked', this.checked);
              $("#assign_tojob").toggle();
           });
});
</script>
 <script src="assets/vendors/js/bootstrap-select.min.js"></script>
										