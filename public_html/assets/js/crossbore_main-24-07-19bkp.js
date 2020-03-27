(function( $ ){
    $('.editmembtn').click(function(){	
            //alert("edit");
            var id = $(this).closest('tr').find('#hiddenmemid').val();	   
            $('#edituserid').val(id);	
            //alert(id);
                $.ajax({				
                    type: "POST",				
                    url: "fetch.php",			
                    data: {"id":id},				
                    dataType: 'json',				
                    success: function(data) { 
            
                $('#fstname').val(data.first_name);                     
                $('#lname').val(data.last_name);					
                $('#memmail').val(data.email);                      
                $('#memcno').val(data.phone);					
                $('#memzip').val(data.zip);                      
                $('#memcity').val(data.city);					
                $('#memstate').val(data.state); 
                if(data.hire_date!='0000-00-00'){
                var newdate = formatDate (data.hire_date); // "18/01/10"
                }else{
                newdate = '';    
                }
                $('#hdate').val(newdate);
                $('#selrole').val(data.role_id);
                $('#lanid').val(data.lanid);
                
            
           
             //$("#hdate").datepicker({format: 'yy-mm-dd'});
            //  var date = $('#hdate').val(data.hire_date); 
            // var d=new Date(date.split("-").reverse().join("/"));
            // var dd=d.getDate();
            // var mm=d.getMonth()+1;
            // var yy=d.getFullYear();
            // var newdate=dd+"/"+mm+"/"+yyyy;
            
            },				
            error: function() {			
            }			
        });	
    });		
        $('#updatemem').click(function(){	   			
            $.ajax({				
            type: "POST",				
            url: "edit_member.php",				
            data: $('form.manageform-div').serialize(),				
            success: function(result) {					
                $('#succmsg').html('Record updated successfully.');					
                setTimeout(function() {						
                location.reload();					
                }, 1000);				 
            },				
            error: function() {				
            }			
            });	
        }); 
        /*$("#updatememform").validate({
      rules: { 
        firstName: "required",
        email: {
          required: true, 
          email: true 
        }, 
        lastName: { 
          required: true 
        },
        phnno: { 
          required: true,
		  number: true
        },
        Password: { 
          required: true 
        } ,
        lanid: { 
          required: true,
          alphanumeric:true,
          minlength:4,
          maxlength:4
        } ,
         hire_date: { 
          required: true 
        } ,
        confirmPassword: { 
          required: true,
		  equalTo: "#password"
        } 
      },
      messages: {
                   lanid:{  
                        lettersonly: "Letters, numbers,only please",
                        minlength: "Please enter valid combination of letters and numbers up to 4 digits only",
                        maxlength: "Please enter valid combination of letters and numbers up to 4 digits only",
                },
      },
     
      submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "edit_member.php",
          data: $(form).serialize(),
          timeout: 3000,
          success: function(data) {
              $('#successmsg').html('Record updated successfully.');
              setTimeout(function() {						
                location.reload();					
                }, 1000);
                return true;
          },
          error: function() {
		   $('#listmembr').html("<div id='divErrorMsg'></div>");
            $('#divErrorMsg').html("Something is going wrong...")
            .hide()
            .fadeIn(1500, function() { $('#divErrorMsg'); });
            return false;
          }
        });
      }    
      
      
    });*/
	/*jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        }, "Letters, numbers, up to four only please");*/
        
        

    $("button#addresource").click(function(){
       
				var $err = 'false';
				if($('#resource_title').val() === ''){
					$("#resource_title_error").html('Please enter resource title');
					$err = 'true';
				}else{
					$("#resource_title_error").html('');
				}				
				if($('#resource_desc').val() === ''){
					$("#resource_desc_error").html('Please enter resource description');
					$err = 'true';
				}else{
					$("#resource_desc_error").html('');
				}
				if($('#resoource_doc').val() === ''){
					$("#resource_doc_error").html('Please select resource file');
					$err = 'true';
				}else{
					$("#resource_doc_error").html('');
				}			
				
				if($err == 'true'){
					return false;
				}
				var fileExtension =  ['doc', 'docx', 'pdf'];
				if ($.inArray($('#resoource_doc').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
					$("#resource_doc_error").html('Only .pdf, .doc, .docx format is allowed.');
					this.value = ''; // Clean field
					return false;
				}
				
				var form = $('form.addresource')[0];
				var formData = new FormData(form);
				$.ajax({
				type: "POST",
				url: "insert_resource.php",
				data: formData,
				processData: false,
                contentType: false,
					success: function(message){					
					$("#successmsg").html(message);
					setTimeout(function(){ location.reload(true); }, 5000);					
					//$("#feedback-modal").modal('hide');
					},
					error: function(){
					}
				});
			});
		 
    $("#addmemberform").validate({
      rules: { 
        firstName: "required",
        email: {
          required: true, 
          email: true 
        }, 
        lastName: { 
          required: true 
        },
        phnno: { 
          required: true,
		  number: true
        },
        Password: { 
          required: true 
        } ,
        lanid: { 
          required: true,
          alphanumeric:true,
          minlength:4,
          maxlength:4
        } ,
         hire_date: { 
          required: true 
        } ,
        confirmPassword: { 
          required: true,
		  equalTo: "#password"
        } 
      },
      messages: {
                   lanid:{  
                        lettersonly: "Letters, numbers,only please",
                        minlength: "Please enter valid combination of letters and numbers up to 4 digits only",
                        maxlength: "Please enter valid combination of letters and numbers up to 4 digits only",
                },
      },
     
      submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "insert_member.php",
          data: $(form).serialize(),
          timeout: 3000,
          success: function(data) {
              $('#successmsg').html('Record updated successfully.');
              setTimeout(function() {						
                location.reload();					
                }, 1000);
                return true;
            //$("#modalRegisterForm").hide();
             //$('#modalRegisterForm').modal('toggle');
            //$('#successmsg').html('Record updated successfully.');	
            //$('#listmembr').html("<div id='successmsg' style='color:green'></div>");
            //$('#successmsg').html("Member added successfully");
            //location.reload();
            //$("#memberlist").load(" #memberlist");
          },
          error: function() {
		   $('#listmembr').html("<div id='divErrorMsg'></div>");
            $('#divErrorMsg').html("Something is going wrong...")
            .hide()
            .fadeIn(1500, function() { $('#divErrorMsg'); });
            return false;
          }
        });
        //return false;
      }    
      
      
    });
     /*jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Please enter a valid value");*/
     jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        }, "Letters, numbers, up to four only please");
  // $(document).ready(function () {
   
    /*$("#lanidmembr").keyup(function (e) {
        $(this).val($(this).val().toUpperCase());
    });*/
//});

    /*function validatelanid() {
    var lanid = document.getElementById("lanid");
    var lanidres = lanid.value;
    var letters = /^[A-Za-z]+$/;
      if(lanid.value === 0) {
           //alert(lanidres);
           LoadErrorlanid = 1;
      }
      if((lanid.value.match(letters)) && lanidres.length == 4 )
      {
            $("#errorlanid").css("display","none");
           LoadErrorlanid = 0;
      } else {
           $("#errorlanid").css("display","block");
           LoadErrorlanid = 1;
      }
}*/
    
    /*********************edit role js********************************/
     $('.editrolebtn').click(function(){	
            var id = $(this).closest('tr').find('#hiddenroleid').val();	   
            $('#editroleid').val(id);	
                $.ajax({				
                    type: "POST",				
                    url: "fetch_role.php",			
                    data: {"id":id},				
                    dataType: 'json',				
                    success: function(data) { 
                        
                        $('#role_name').val(data.role_type);                     
                       
                        },				
                error: function() {			
                }			
            });	
    });		
        $('#updaterole').click(function(){	   			
            $.ajax({				
            type: "POST",				
            url: "manage_roleJS.php",				
            data: $('form.manageform-div').serialize(),				
            success: function(result) {	
                 $('#succmsg').html('Record updated successfully.');					
                setTimeout(function() {						
                location.reload();					
                }, 1000);				 
            },				
            error: function() {				
            }			
            });	
        }); 
		$("#addroleform").validate({
      rules: { 
        rolename: "required",
        
      },
      submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "manage_roleJS.php",
          data: $(form).serialize(),
          timeout: 3000,
          success: function(data) {
              $('#successmsg').html('Record updated successfully.');
              setTimeout(function() {						
                location.reload();					
                }, 1000);
          },
          error: function() {
          }
        });
        return false;
      }     
    });
    


$('.rejectjobs').click(function(){
    $(".mform")[0].reset();
            //alert("edit");
            var order_no = $(this).closest('tr').find('#hiddenorderid').val();
            var id = $(this).closest('tr').find('#hiddenuserid').val();
           // $('#edituserid').val(id);	
            //alert(order_no);
           // alert(id);
                $.ajax({				
                    type: "POST",				
                    url: "ViewJobDetailsJS.php",			
                    data: {"id":id,"order_no":order_no},				
                    dataType: 'json',				
                    success: function(data) { 
                      //  alert(data.order_no);
                                  $("#lanid").val(data.lanid);
                                                      if(data.created_on!='0000-00-00'){
                var created_onformat2 =  dateFormat(data.created_on, "mm/dd/yyyy");
                }else{
                var created_onformat2 = '';    
                }
              
                        $("#review_date").val(created_onformat2);
                     if(data.approved_date!='00/00/0000'){
                var approved_date =  data.approved_date;
                }else{
                var approved_date = '';    
                }
                                  $("#review_completion_date").val(approved_date);
                                  $("#project_id").val(data.project_id);
                                  $("#order_no").val(data.order_no);
                                  $("#OREDRNO").val(data.order_no);
                                  $("#USERID").val(data.user_id);
                                  $("#division").val(data.division);
                                  $("#city").val(data.CITY);
                                  $("#resp_gp").val(data.resp_group);
                                  $("#cn29eligible").val(data.cn29eligible);
                                  $("#order_description").val(data.description);
                                  $("#FE_CM").val(data.fc_cm);
                                  $("#CE_RCM").val(data.ce_rcm);
                                  $("#foreman").val(data.foreman);
                                  $("#m_c_supervisor").val(data.m_c_supervisor);
                                  $("#inspector").val(data.inspector);
                                  $("#Distribution_Transmission").val(data.distribution_transmission);
                                  
                                     $("#mat").val(data.mat);
                                     $('#Checkmat').val(data.MAT_check);
                                     if(data.MAT_check=='true'){
                                         $( "#Checkmat" ).prop( "checked", true );
                                     }
                                     $("#cn24").val(data.cn24);
                                      $("#cn24_lanid").val(data.cn24_lanid);
                                      $("#cn24_date").val(data.cn24_date);
                                      $('#check_cn24').val(data.CN24_check);
                                      if(data.CN24_check=='true'){
                                         $( "#check_cn24" ).prop( "checked", true );
                                     }
                                     $("#cn29").val(data.cn29);
                                      $("#cn29_lanid").val(data.cn29_lanid);
                                       if(data.cn29_date=='0000-00-00'){
                                      var cn29_date = '';   
                                     }else{
                                      var cn29_date = data.cn29_date;     
                                     }
                                      $("#cn29_date").val(cn29_date);
                                     $('#check_cn29').val(data.CN29_check);
                                     if(data.CN29_check=='true'){
                                         $( "#check_cn29" ).prop( "checked", true );
                                     }
                                    
                                     $("#cn07").val(data.cn07);
                                     $("#cn07_lanid").val(data.cn07_lanid);
                                       if(data.cn07_date=='0000-00-00'){
                                      var cn07_date = '';   
                                     }else{
                                      var cn07_date = data.cn07_date;     
                                     }
                                     $("#cn07_date").val(cn07_date);
                                     $('#check_cn07').val(data.CN07_check);
                                     if(data.CN07_check=='true'){
                                         $( "#check_cn07" ).prop( "checked", true );
                                     }
                                     $("#dc39").val(data.dc39);
                                     $("#dc39_lanid").val(data.dc39_lanid);
                                    $("#dc39_date").val(data.dc39_date);
                                    
                                     $("#dc46").val(data.dc46);
                                     $("#dc46_lanid").val(data.dc46_lanid);
                                     $("#dc46_date").val(data.dc46_date);
                                    
                                     $("#dc05").val(data.dc05);
                                     $("#dc05_lanid").val(data.dc05_lanid);
                                     $("#dc05_date").val(data.dc05_date);
                                    
                                     $("#dc14").val(data.dc14);
                                     $("#dc14_lanid").val(data.dc14_lanid);
                                     $("#dc14_date").val(data.dc14_date);
                                    
                                     $("#dc15").val(data.dc15);
                                     $("#dc15_lanid").val(data.dc15_lanid);
                                     $("#dc15_date").val(data.dc15_date);
                                    
                                     $("#dc19").val(data.dc19);
                                     $("#dc19_lanid").val(data.dc19_lanid);
                                     $("#dc19_date").val(data.dc19_date);
                                    
                                     $("#dc10").val(data.dc10);
                                     $("#dc10_lanid").val(data.dc10_lanid);
                                     $("#dc10_date").val(data.dc10_date);
                                     $("#cmt_cn_dc").val(data.cmt_cn_dc);
                                     
                                     $("#CN29_in_SAP").val(data.CN29_in_SAP);
                                     if(data.CN29_in_SAP=='1'){
                                        // $('#qualfi').addClass('d-none');
                                         $( "#CN29_in_SAP" ).prop( "checked", true );
                                     }else{
                                    // $('#qualfi').removeClass('d-none');
                                         $( "#CN29_in_SAP" ).prop( "checked", false );    
                                     }
                                     $("#CN29_in_SAP_cmt").val(data.CN29_in_SAP_cmt);
                                     $("#CN24").val(data.CN24);
                                     $("#CN24_cmt").val(data.CN24_cmt);
                                     $("#gas_assets_installed").val(data.gas_assets_installed);
                                     $("#gas_assets_installed_cmt").val(data.gas_assets_installed_cmt);
                                     $("#installation_below_ground").val(data.installation_below_ground);
                                     $("#installation_below_ground_cmt").val(data.installation_below_ground_cmt);
                                     $("#MOI").val(data.MOI);
                                     $("#MOI_cmt").val(data.MOI_cmt);
                                     if(data.SAP_Reviewed=='1'){
                                         $( "#SAP_Reviewed" ).prop( "checked", true );
                                     }
                                     $("#SAP_Reviewed_cmt").val(data.SAP_Reviewed_cmt);
                                     
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
              //  alert('error');
            }			
        });	
    });	    
 $('.viewjobs').click(function(){
    $(".mform")[0].reset();
            //alert("edit");
            var order_no = $(this).closest('tr').find('#hiddenorderid').val();
            var id = $(this).closest('tr').find('#hiddenuserid').val();
           // $('#edituserid').val(id);	
            //alert(order_no);
           // alert(id);
                $.ajax({				
                    type: "POST",				
                    url: "ViewJobDetailsJS.php",			
                    data: {"id":id,"order_no":order_no},				
                    dataType: 'json',				
                    success: function(data) { 
                      //  alert(data.order_no);
                                  $("#2lanid").val(data.lanid);
                                 
                                  if(data.created_on!='0000-00-00'){
                var created_onformat =  dateFormat(data.created_on, "mm/dd/yyyy");
                }else{
                var created_onformat = '';    
                }
              
                        $("#2review_date").val(created_onformat);
                           if(data.approved_date!='00/00/0000'){
                var approved_date =  data.approved_date;
                }else{
                var approved_date = '';    
                }
                                  $("#2review_completion_date").val(approved_date);
                                  $("#2project_id").val(data.project_id);
                                  $("#2order_no").val(data.order_no);
                                  $("#OREDRNO").val(data.order_no);
                                  $("#USERID").val(id);
                                  $("#2division").val(data.division);
                                  $("#2city").val(data.CITY);
                                  $("#2resp_gp").val(data.resp_group);
                                  $("#2cn29eligible").val(data.cn29eligible);
                                  $("#2order_description").val(data.description);
                                  $("#2FE_CM").val(data.fc_cm);
                                  $("#2CE_RCM").val(data.ce_rcm);
                                  $("#2foreman").val(data.foreman);
                                  $("#2m_c_supervisor").val(data.m_c_supervisor);
                                  $("#2inspector").val(data.inspector);
                                  $("#2Distribution_Transmission").val(data.distribution_transmission);
                                  
                                     $("#2mat").val(data.mat);
                                     $('#2Checkmat').val(data.MAT_check);
                                     if(data.MAT_check=='true'){
                                         $( "#2Checkmat" ).prop( "checked", true );
                                     }
                                     $("#2cn24").val(data.cn24);
                                      $("#2cn24_lanid").val(data.cn24_lanid);
                                      $("#2cn24_date").val(data.cn24_date);
                                      $('#2check_cn24').val(data.CN24_check);
                                      if(data.CN24_check=='true'){
                                         $( "#2check_cn24" ).prop( "checked", true );
                                     }
                                     $("#2cn29").val(data.cn29);
                                      $("#2cn29_lanid").val(data.cn29_lanid);
                                      if(data.cn29_date=='0000-00-00'){
                                      var cn29_date = '';   
                                     }else{
                                      var cn29_date = data.cn29_date;     
                                     }
                                      $("#2cn29_date").val(cn29_date);
                                     $('#2check_cn29').val(data.CN29_check);
                                     if(data.CN29_check=='true'){
                                         $( "#2check_cn29" ).prop( "checked", true );
                                     }
                                    
                                     $("#2cn07").val(data.cn07);
                                     $("#2cn07_lanid").val(data.cn07_lanid);
                                     if(data.cn07_date=='0000-00-00'){
                                      var cn07_date = '';   
                                     }else{
                                      var cn07_date = data.cn07_date;     
                                     }
                                     $("#2cn07_date").val(cn07_date);
                                     $('#2check_cn07').val(data.CN07_check);
                                     if(data.CN07_check=='true'){
                                         $( "#2check_cn07" ).prop( "checked", true );
                                     }
                                     $("#2dc39").val(data.dc39);
                                     $("#2dc39_lanid").val(data.dc39_lanid);
                                    $("#2dc39_date").val(data.dc39_date);
                                    
                                     $("#2dc46").val(data.dc46);
                                     $("#2dc46_lanid").val(data.dc46_lanid);
                                     $("#2dc46_date").val(data.dc46_date);
                                    
                                     $("#2dc05").val(data.dc05);
                                     $("#2dc05_lanid").val(data.dc05_lanid);
                                     $("#2dc05_date").val(data.dc05_date);
                                    
                                     $("#2dc14").val(data.dc14);
                                     $("#2dc14_lanid").val(data.dc14_lanid);
                                     $("#2dc14_date").val(data.dc14_date);
                                    
                                     $("#2dc15").val(data.dc15);
                                     $("#2dc15_lanid").val(data.dc15_lanid);
                                     $("#2dc15_date").val(data.dc15_date);
                                    
                                     $("#2dc19").val(data.dc19);
                                     $("#2dc19_lanid").val(data.dc19_lanid);
                                     $("#2dc19_date").val(data.dc19_date);
                                    
                                     $("#2dc10").val(data.dc10);
                                     $("#2dc10_lanid").val(data.dc10_lanid);
                                     $("#2dc10_date").val(data.dc10_date);
                                     $("#2cmt_cn_dc").val(data.cmt_cn_dc);
                                     
                                    // $("#2CN29_in_SAP").val(data.CN29_in_SAP);
                                     if(data.CN29_in_SAP=='1'){
                                         //$('#qualfi').addClass('d-none');
                                         $( "#2CN29_in_SAP" ).prop( "checked", true );
                                     }
                                     else{
                                         $( "#2CN29_in_SAP" ).prop( "checked", false );
                                     }
                                     $("#2CN29_in_SAP_cmt").val(data.CN29_in_SAP_cmt);
                                     $("#2CN24").val(data.CN24);
                                     $("#2CN24_cmt").val(data.CN24_cmt);
                                     $("#2gas_assets_installed").val(data.gas_assets_installed);
                                     $("#2gas_assets_installed_cmt").val(data.gas_assets_installed_cmt);
                                     $("#2installation_below_ground").val(data.installation_below_ground);
                                     $("#2installation_below_ground_cmt").val(data.installation_below_ground_cmt);
                                     $("#2MOI").val(data.MOI);
                                     $("#2MOI_cmt").val(data.MOI_cmt);
                                     if(data.SAP_Reviewed=='1'){
                                         $( "#2SAP_Reviewed" ).prop( "checked", true );
                                     }
                                     $("#2SAP_Reviewed_cmt").val(data.SAP_Reviewed_cmt);
                                     
                                     $("#2MOI_for_Srv").val(data.MOI_for_Srv);
                                     $("#2MOI_for_Srv_cmt").val(data.MOI_for_Srv_cmt);
                                     $("#2MOI_for_Main").val(data.MOI_for_Main);
                                     $("#2MOI_for_Main_cmt").val(data.MOI_for_Main_cmt);
                                     $("#2determine_the_MOI").val(data.determine_the_MOI);
                                     $("#2determine_the_MOI_cmt").val(data.determine_the_MOI_cmt);
                                     $("#2used_to_retrieve_the_document").val(data.used_to_retrieve_the_document);
                                     $("#2used_to_retrieve_the_document_cmt").val(data.used_to_retrieve_the_document_cmt);
                                     $("#2SAP").val(data.SAP);
                                     $("#2SAP_cmt").val(data.SAP_cmt);
                                     $("#2PRE_Inspection").val(data.PRE_Inspection);
                                     $("#2PRE_Inspection_cmt").val(data.PRE_Inspection_cmt);
                                     $("#2Post_Inspection_Required_per_PRE_Inspection").val(data.Post_Inspection_Required_per_PRE_Inspection);
                                     $("#2Post_Inspection_Required_per_PRE_Inspection_cmt").val(data.Post_Inspection_Required_per_PRE_Inspection_cmt);
                                     $("#2POST_Inspection").val(data.POST_Inspection);
                                     $("#2POST_Inspection_cmt").val(data.POST_Inspection_cmt); 
                                     $("#2Cross_Bore_Log").val(data.Cross_Bore_Log);
                                     $("#2Cross_Bore_Log_cmt").val(data.Cross_Bore_Log_cmt);
                                     
                                     
             
              
            
            },				
            error: function() {	
              //  alert('error');
            }			
        });	
    });	    
    
    
    var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	// Regexes and supporting functions are cached through closure
	return function (date, mask, utc) {
		var dF = dateFormat;

		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

// Some common format strings
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
	return dateFormat(this, mask, utc);
};
    
})( jQuery );