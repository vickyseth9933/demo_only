(function( $ ){
  
$('.ViewJobsDetails').click(function(){
    $(".mform")[0].reset();
            
            var order_no = $(this).closest('tr').find('#hiddenorderid').val();
            var id = $(this).closest('tr').find('#hiddenuserid').val();
           $('#edituserid').val(id);	
                 $.ajax({				
                    type: "POST",				
                    url: "ViewJobDetailsJS.php",			
                    data: {"id":id,"order_no":order_no},				
                    dataType: 'json',				
                    success: function(data) { 
                            
                                     if(data.SAP_Reviewed=='1'){
                                         $( "#SAP_Reviewed" ).prop( "checked", true );
                                     }
                                     $("#SAP_Reviewed_cmt").val(data.SAP_Reviewed_cmt);
                                     $("#OREDRNO").val(data.order_id);
                                     
                                     
                                     $("#recommendation").val(data.recommendation);
                                     $("#MOI_for_Srv").val(data.MOI_for_Srv);
                                     $("#MOI_for_Srv_cmt").val(data.MOI_for_Srv_cmt);
                                     $("#MOI_for_Main").val(data.MOI_for_Main);
                                     $("#MOI_for_Main_cmt").val(data.MOI_for_Main_cmt);
                                     $("#determine_the_MOI").val(data.determine_the_MOI);
                                     $("#determine_the_MOI_cmt").val(data.determine_the_MOI_cmt);
                                     $("#used_to_retrieve_the_document").val(data.used_to_retrieve_the_document);
                                     $("#used_to_retrieve_the_document_cmt").val(data.used_to_retrieve_the_document_cmt);
                                     $("#SAP").val(data.SAP);
                                     $("#SAP_cmt").val(data.SAP_cmt);
                                     $("#PRE_Inspection").val(data.PRE_Inspection);
                                     $("#PRE_Inspection_cmt").val(data.PRE_Inspection_cmt);
                                     $("#Post_Inspection_Required_per_PRE_Inspection").val(data.Post_Inspection_Required_per_PRE_Inspection);
                                     $("#Post_Inspection_Required_per_PRE_Inspection_cmt").val(data.Post_Inspection_Required_per_PRE_Inspection_cmt);
                                     $("#POST_Inspection").val(data.POST_Inspection);
                                     $("#POST_Inspection_cmt").val(data.POST_Inspection_cmt); 
                                     $("#Cross_Bore_Log").val(data.Cross_Bore_Log);
                                     $("#Cross_Bore_Log_cmt").val(data.Cross_Bore_Log_cmt);
                                     
                                     
             
              
            
            },				
            error: function() {	
              alert('error');
            }			
        });	
    });	    

    
})( jQuery );