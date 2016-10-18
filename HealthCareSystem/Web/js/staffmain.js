/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){

	
	$('#getInsuranceCompany').click(function() {
        displayErrorResults();
         
         if($('#incurancecompanyname').val() < 2){//
               $('#adminStaffErrorMessage').html("<font color='red'>Please Enter Incurance Company Name</font>");
               $('#adminStaffErrorBlock').show();
               return false;
            }
         //$('input[type="button"]').removeAttr('disabled');
         getInsuranceCompanyList($('#incurancecompanyname').val());
         
     });
	
	function getInsuranceCompanyList(insurancecompname){
		   
		    displayErrorResults();
		    if(insurancecompname != ''){
			     $.ajax({
			    type: 'GET',
			    url: rootURL + '/insuranceData/'+insurancecompname,
			    dataType: "json",
			    success: function(data){
			        var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
			       var trHTML = '';
			       //$("#staff_hosiptal_NonActive_data tbody").remove();
			       $("#insurance_data tbody").html('');
			       
			       console.log("Data List Length "+list.length);
			       var objLength = '';
			       $.each(list, function(index, responseMessageDetails) {
			           
			           if(responseMessageDetails.status == "Success"){
			                   
			                insuranceCompanyData = responseMessageDetails.data;
			                
			                objLength = insuranceCompanyData.length;
			                if(objLength != 0)
			                {
				                $.each(insuranceCompanyData, function(index, insuranceCompData) {
				                	s = insuranceCompData.id;
				                    s = s.replace(/^0+/, '');
				                   // trHTML += '<tr><td>' + s +  '</td><td>' + masterUsersData.hosiptalname   +'</td><td> <a href="#" onclick = showHosiptalData('+ s +')> Edit <a></td></tr>';
				                    
				                    $('#insurance_data tbody').append('<tr class="data"><td>'+s+'</td><td>'+insuranceCompData.insurancecompanyname+
				                    		'</td><td>'+insuranceCompData.contactnumber+'</td><td>'+insuranceCompData.email+'</td>'+
				                    		'<td><button type="button" class="btn btn-warning btn-xs" onclick="showInsuranceData('+insuranceCompData.id+')"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>'+
				                    		'</tr>');
				                });
			                }
			                else
			                {
			                	$('#insurance_data tbody').append('<tr class="data"><td colspan="4"><font color="red">No data found </font></td></tr>');
			                }
			            }else{
			                   $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
			                   $('#adminStaffErrorBlock').show();
			            }
			           
			       });
			       if(objLength > 0){
				       $('#tablePaging').show();
						 /* Pagination Code Start */
						 load = function() {
							window.tp = new Pagination('#tablePaging', {
							itemsCount: objLength,
							onPageSizeChange: function (ps) {
								console.log('changed to ' + ps);
							},
							onPageChange: function (paging) {
								//custom paging logic here
								//console.log(paging);
								var start = paging.pageSize * (paging.currentPage - 1),
									end = start + paging.pageSize,
									$rows = $('#insurance_data tbody').find('.data');
				
								$rows.hide();
				
								for (var i = start; i < end; i++) {
									$rows.eq(i).show();
								}
							}
							});
						 /* Pagination Code End */
						 }
				
						 load();
			       }else{
			    	   $('#tablePaging').hide();
			       }
			        // $('#staff_hosiptal_NonActive_data').append(trHTML);
			        // $('#staff_hosiptal_NonActive_data').load(); 
				}
				});
			    
		    }else{
		    	location.href = rootURL+'/Web/staff/staffindex.php?page=insurance';
		    }
		}
	
	
	
  $('#searchresult').hide();
    $('#enterdetails').hide();
     $('#searchhealthresult').hide();
    $('#enterhealthdetails').hide();
 $('#counter').val(0);
function displayErrorResults(){
         $('#adminHospitalErrorBlock').hide();
         $('#adminStaffErrorBlock').hide();
         $('#adminErrorBlock').hide();
         $('#adminErrorMessage').html("");  
          $('#adminStaffErrorMessage').html("");  
}
 getCurentAppointments();
 
   $('#bthCheckStaffHomeConsultationUsers').click(function(){
       
       if($('#patientName').val() == "" && $('#patientid').val() == ""){
           $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");
           return false;
       }
       
     
          getAppointmentHomePatientList("Others",$('#patientName').val(),$('#patientid').val(),$('#hospital').val());
          //getAppointmentDetails($('#hosiptal').val(),$('#doctor').val(),appdate);
    });
              
 //Added below code by achyuth for getting Doctors with doctor name functionality (Sep072015) Staff module (Map Medicines page)
	$('#searchDoctor').click(function(){
	var doctorname = $('#doctorName').val();
	if(doctorname == ""){
       $('#adminStaffErrorMessage').html("<b>Error : </b> Please enter Doctor Name for search");
       $('#adminStaffErrorBlock').show();
       return false;
   }
	$.ajax({
       type: 'GET',
       url: rootURL + '/getDoctorsList/' +doctorname,
       dataType: "json",
       success: function(data){

       	var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
           	
           	$('#doctorMedicine tr td').remove();
               $.each(list, function(index, responseMessageDetails) {
               	
                    if(responseMessageDetails.status == "Success"){
                         $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                           $('#adminStaffErrorBlock').show();
                           doctorsData = responseMessageDetails.data;
                            var trHTML = "";
                            var line = 1;
                            $.each(doctorsData,function(key, value){
                           	 
                           	 trHTML += '<tr class="data"><td>'+line+'</td><td>'+doctorsData[key].DoctorName+'</td>'+
                           	 '<td>'+doctorsData[key].HospitalName+'</td><td><a href="#" onclick="ShowDoctorMedicinesList('+doctorsData[key].DoctorId+')">Details</a></td>'+
                           	 '<td><a href="staffindex.php?page=mapdoctormedicines&doctorId='+doctorsData[key].DoctorId+'&name='+doctorsData[key].DoctorName+'">Map Medicines</a></td></tr>';
                           	 line++;
                           });
                            $('#doctorMedicine').append(trHTML);
                               $('#doctorMedicine').load();
                               
                    } else{
                          $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                          $('#adminStaffErrorBlock').show();
                    }
                    
            });   
           
       }
   }); 
	
});// End of code by achyuth on Sep082015


$('#searchPatients').click( function(){
    patientname = $('#patientName').val();patientid=$('#patientID').val();mobile=$('#mobile').val();
    if($('#patientName').val() == ""){
        patientname = "nodata";
    }
    if($('#patientID').val() == ""){
        patientid = "nodata";
    }
    if($('#mobile').val() == ""){
        mobile = "nodata";
    }
    
   if((patientname == "nodata") && (patientid == "nodata") &&  (mobile == "nodata") ){
       alert("Please enter atleast one search criteria");
   } 
    appid = 'nodata';
   console.log(rootURL + '/fetchPatientList/' + patientname +'/'+patientid+'/'+appid+'/'+mobile);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchPatientList/' + patientname +'/'+patientid+'/'+appid+'/'+mobile,
        dataType: "json",
        success: function(data){
            
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_records_search_result_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {
                    
                     if(responseMessageDetails.status == "Success"){

                            userData = responseMessageDetails.data;

                            console.log("userData : "+userData.length);
                            var trHTML = "";
                            $.each(userData, function(index, userDetails) {
                                       console.log("userData : "+userDetails);
                                s = userDetails.ID;
                                s = userDetails.ID;
                                  s = s.replace(/^0+/, '');
                                  if(GetPageParameter('page') == "patientgeneral")
                                     trHTML += '<tr><td  nowrap>' + s + '</td><td>' + userDetails.name  +'</td><td  nowrap>' + userDetails.mobile + '</td><td  nowrap>' + userDetails.dob + '</td><td  nowrap>' + userDetails.gender + '</td><td  nowrap><font color="blue"><a href="#" onclick=enterDetails('+s+')>Enter General Details</a></font></td></tr>';
                                   else
                                        trHTML += '<tr><td  nowrap>' + s + '</td><td>' + userDetails.name  +'</td><td  nowrap>' + userDetails.mobile + '</td><td  nowrap>' + userDetails.dob + '</td><td  nowrap>' + userDetails.gender + '</td><td  nowrap><font color="blue"><a href="#" onclick=enterHealthDetails('+s+')>Enter Health Details</a></font></td></tr>';
                            });
                             $('#patient_records_search_result_table').append(trHTML);
                             $('#patient_records_search_result_table').load(); 
                        }else{

                        }
                      // if(GetPageParameter )
                        //patientgeneral window.location.replace(rootURL + '/Web/staff/staffindex.php?page=patientgeneral');
                });

        }
    }); 
  
      $('#searchresult').show();
      $('#enterdetails').hide();
       $('#searchhealthresult').show();
       $('#enterhealthdetails').hide();
    
});


$('#addPatientGeneralParameters').click( function(){
    paramname = "nodata";
    paramvalue = "nodata";
    generalinfo = "nodata";
    paramname = (($('#paramname').val() == "") ? "nodata" : $('#paramname').val() );
    paramvalue = (($('#paramvalue').val() == "") ? "nodata" : $('#paramvalue').val() );
    generalinfo = (($('#observation').val() == "") ? "nodata" : $('#observation').val() );
    
    if( (paramname == "") && (paramvalue == "") && (generalinfo == "")){
        
        alert("Please enter data atleast in one field"); return false;
    }
    if(((paramname == "") && (paramvalue != "") )|| ((paramname != "") && (paramvalue == "") ) ){
        
        alert("If parameter name is entered value must also be entered or vise versa"); return false;
    }
    
    data = paramname+"$"+paramvalue+"$"+generalinfo;
    
     count = parseInt($('#counter').val())+1;
     
     createHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + paramname + '</td><td>' + paramvalue + '</td><td>' + generalinfo + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#paramname').val("");
      $('#paramvalue').val("");
      $('#observation').val("");
       $('#patient_general_info_table').append(trHtml);
       $('#patient_general_info_table').load();
    
});

 $('#submitGeneralDataEdit').click( function(){
     paramid = $('#paramidedit').val();
    paramname = $('#paramnameedit').val();
    paramvalue = $('#paramvalueedit').val();
    observation = $('#observationedit').val();
    console.log();//
    datatoJSON = {"paramname":paramname,"paramvalue":paramvalue,"observation":observation,"paramid":paramid};
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updatePatientGeneralInfo');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updatePatientGeneralInfo',
        dataType: "json",
        data:  datatoEdit,
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            console.log("Data List Length "+list.length);
            $.each(list, function(index, responseMessageDetails) {
                 if(responseMessageDetails.status == "Success"){
                     alert("Data Updated Successfully");
                     enterDetails($('#patientid').val());
                 }
            });
            
            
        }
    });   
     
 });
 
 
 $('#submitMedicalDataEdit').click( function(){
     paramid = $('#paramidedit').val();
    paramname = $('#paramnameedit').val();
    paramvalue = $('#paramvalueedit').val();
    observation = $('#observationedit').val();
    console.log();//
    datatoJSON = {"paramname":paramname,"paramvalue":paramvalue,"observation":observation,"paramid":paramid};
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updatePatientMedicalInfo');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updatePatientMedicalInfo',
        dataType: "json",
        data:  datatoEdit,
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            console.log("Data List Length "+list.length);
            $.each(list, function(index, responseMessageDetails) {
                 if(responseMessageDetails.status == "Success"){
                     alert("Data Updated Successfully");
                     enterHealthDetails($('#patientid').val());
                 }
            });
            
            
        }
    });   
     
 });
 
 $('#bthIDCardSearchStaffAppointmentUsers').click(function(){
      patientname = $('#patientName').val();patientid=$('#patientID').val();mobile=$('#mobile').val();
    if($('#patientName').val() == ""){
        patientname = "nodata";
    }
    if($('#patientID').val() == ""){
        patientid = "nodata";
    }
    if($('#mobile').val() == ""){
        mobile = "nodata";
    }
    
   if((patientname == "nodata") && (patientid == "nodata") &&  (mobile == "nodata") ){
       alert("Please enter atleast one search criteria");
   }
   appid = 'nodata';
   console.log(rootURL + '/fetchPatientList/' + patientname +'/'+patientid+'/'+appid+'/'+mobile);
      $.ajax({
        type: 'GET',
        url: rootURL + '/fetchPatientList/' + patientname +'/'+patientid+'/'+appid+'/'+mobile,
        dataType: "json",
        success: function(data){
            
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_idcard_records_search_result_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {
                    
                     if(responseMessageDetails.status == "Success"){

                            userData = responseMessageDetails.data;

                            console.log("userData : "+userData.length);
                            var trHTML = "";
                            $.each(userData, function(index, userDetails) {
                                       console.log("patient_idcard_records_search_result_table : "+userDetails);
                                s = userDetails.ID;
                                s = userDetails.ID;
                                  s = s.replace(/^0+/, '');
                                  if(GetPageParameter('page') == "patientgeneral")
                                     trHTML += '<tr><td  nowrap>' + s + '</td><td>' + userDetails.name  +'</td><td  nowrap>' + userDetails.mobile + '</td><td  nowrap>' + userDetails.dob + '</td><td  nowrap>' + userDetails.gender + '</td><td  nowrap><font color="blue"><a href="#" onclick=generateIDCard('+s+')>Generate ID Card</a></font></td></tr>';
                                   else
                                        trHTML += '<tr><td  nowrap>' + s + '</td><td>' + userDetails.name  +'</td><td  nowrap>' + userDetails.mobile + '</td><td  nowrap>' + userDetails.dob + '</td><td  nowrap>' + userDetails.gender + '</td><td  nowrap><font color="blue"><a href="#" onclick=generateIDCard('+s+')>Generate ID Card</a></font></td></tr>';
                            });
                             $('#patient_idcard_records_search_result_table').append(trHTML);
                             $('#patient_idcard_records_search_result_table').load(); 
                        }else{

                        }
                      // if(GetPageParameter )
                        //patientgeneral window.location.replace(rootURL + '/Web/staff/staffindex.php?page=patientgeneral');
                });

        }
    });
     
 });
 
 
 $('#addInsuranceComp').click(function(){
		$('.myModalLabel').text('Add Insurance Company');
		$('#editInsuranceCompModal').modal('show');
	});


$('#btnStaffSubmitInsurance').click(function() {

	 $('#nameerrormsg').html("");
	 $('#mobileerrormsg').html("");
	 $('#emailerrormsg').html("");
  var insurancename = $('#insurancecompanyname').val();
  var emailAddress = $('#email').val();
  var mobile = $('#mobile').val();
  var insuranceHiddenId = $("#insuranceId").val();
  if(insurancename == ''){
 	 $('#nameerrormsg').html("Please Enter Insurance Company Name");
 	 return false;
  }
  
  if(insurancename != ''){
       var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
          var valid = emailRegex.test(emailAddress);
          
          if(mobile == ''){
        	  $('#mobileerrormsg').html("Please Enter Mobile Number");
        	  return false;
          }
          else if (isNaN(mobile)) {
        	  $('#mobileerrormsg').html("Phone number should be numeric.");
        	  return false;
          }
          else if (!(mobile.length == 10)) {
        		$('#mobileerrormsg').html("Please enter 10 digit Phone number");
        		return false;
          }

           if (!valid) {
             $('#emailerrormsg').html("Please Enter valid email address {sample@sample.com}");
             return false;
           }  
  }
  
  if(insuranceHiddenId != ""){
	  $.ajax({
			type: 'POST',
			url: rootURL + '/updateInsuranceCompany/' +insurancename+"/"+emailAddress+"/"+ mobile+"/"+insuranceHiddenId,
			dataType: "json",
			success: function(data){
				alert(data.responseMessageDetails.message);
				window.location.href=rootURL+"/Web/staff/staffindex.php?page=insurance";
			}
	  	});
  }else{
	  $.ajax({
			type: 'POST',
			url: rootURL + '/addInsuranceCompany/' +insurancename+"/"+emailAddress+"/"+ mobile,
			dataType: "json",
			success: function(data){
				alert(data.responseMessageDetails.message);
				window.location.href=rootURL+"/Web/staff/staffindex.php?page=insurance";
			}
	  	});
  }
  
});
 
 
  $('#quickregister').click(function() {
        $('#errorDisplay').html("  ");
            
            var sEmail = $('#email').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
           if(sEmail.length > 1)  {
             if (!filter.test(sEmail))  {
                   $("#errorDisplay").html("Please enter email address or invalid email address").show();
                    $('#errormessages').show();
                 return false;
             }
           }
           
       
       
        if(registerQuickFormValidate()){
            console.log("In if condition validation success ");
            clearValidationMessage()
            checkQuickUserId($('#mobile').val());
           }else{
               console.log("In else ");
               $('#errormessages').show();
           } 

        var flag = "";
       
    });
 
 
 $('#searchPrintPrescription').click(function(){
    	
        if(validatePrintSearchForm()){
            
            if($('#patientName').val() == ""){
                patientname = "nodata";
            } else
                patientname = $('#patientName').val();
            if($('#patientID').val() == ""){
                 patientid = "nodata";
            }else
                patientid =$('#patientID').val();
            if($('#appointmentID').val() == ""){
                 appid = "nodata";
            }else{
                appid = $('#appointmentID').val(); 
            }
            if($('#mobile').val() == ""){
                 mobile = "nodata";
            }else
                mobile = $('#mobile').val();
            
            
          console.log(rootURL + '/fetchConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
					
                    $('#patient_consultation_records_search_print_result_table tbody').html('');
                    
                    var objLength = '';
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  //$('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  //$('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     objLength = userData.length;
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                        datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId;  
                                         console.log("datatopass : "+datatopass);    
                                         console.log("index........"+(index < 1));
                                         if(index < 1 && patientid != "nodata")
                                         btst ='<font color="blue"><i><a href="#" onclick=printPrescription("'+s+'")>Print Prescription</a></i></font>';
                                         else{
                                             if(patientid != "nodata")
                                                btst = "";
                                             else
                                                 btst ='<font color="blue"><i><a href="#" onclick=printPrescription("'+s+'")>Print Prescription</a></i></font>';

                                         }    
  
  
									  
	$('#patient_consultation_records_search_print_result_table tbody').append('<tr class="data"><td>'+s+'</td><td>'+userDetails.PatientName+'</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime+ '</td><td>'+btst+'</td></tr>');
                                        
                                      // console.log("Patient Name : "+userDetails.PatientName); 
                                        $('#prespatientName').html(userDetails.PatientName);
                                        $('#doctorName').html(userDetails.DoctorName);
                                        $('#hospitalName').html(userDetails.HospitalName);
                                        $('#appointmentDate').html(userDetails.AppointementDate);
                                     // console.log("Pavan Kumar");
                                         $('#hidpatientName').val(userDetails.PatientName);  
                                         $('#hiddoctorName').val(userDetails.DoctorName);
                                         $('#hidhospitalName').val(userDetails.HospitalName);
                                         $('#hidappointmentDate').val(userDetails.AppointementDate);
                                         $('#hidappointmentId').val(userDetails.id);
                                         $('#hidpatientID').val(userDetails.patientid);
                                           
                                          
                                    });    
                                       //$('#patient_consultation_records_search_result_table').append(trHTML);
                                       //$('#patient_consultation_records_search_result_table').load();
                                     
                        			
                        				 /*for (var i = 0; i < objLength; i++) {
                        					 $//('#patient_consultation_records_search_result_table tbody').append('<tr class="data" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
                        				 }*/
                        				 $('#tablePaging').show();
                        				 /* Pagination Code Start */
                        				 load = function() {
                        					window.tp = new Pagination('#tablePaging', {
                        					itemsCount: objLength,
                        					onPageSizeChange: function (ps) {
                        						console.log('changed to ' + ps);
                        					},
                        					onPageChange: function (paging) {
                        						//custom paging logic here
                        						//console.log(paging);
                        						var start = paging.pageSize * (paging.currentPage - 1),
                        							end = start + paging.pageSize,
                        							$rows = $('#patient_consultation_records_search_result_table tbody').find('.data');
                        	
                        						$rows.hide();
                        	
                        						for (var i = start; i < end; i++) {
                        							$rows.eq(i).show();
                        						}
                        					}
                        					});
                        				 /* Pagination Code End */
                        				 }
                        	
                        				 load();
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                                   $('#patient_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
                    
                }
            });    
        }
            
        
        $('#listofpatients').show();
    });
 
 
 
 
  $('#submitStaffPatientPaymentDetails').click( function(){
        
        console.log($('#pcardtype').val());
        console.log($('#pcardamount').val());
        console.log($('#psalesperson').val());
        console.log(console.log($('#ppatientid').val()));
         var patientData = JSON.stringify( {"patientId" : $('#ppatientid').val(),"cardAmount" : $('#pcardamount').val(),"officeid":$('#officeid').val(),"insttype":"Hospital"} );
        
        console.log(patientData);
        
        console.log(rootURL + '/updatePatientPaymentInfo');
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL + '/updatePatientPaymentInfo',
            dataType: "json",
            data:  patientData,
            success: function(data, textStatus, jqXHR){
                        console.log('authentic success: ' + data);
                                            
                        },
                error: function(jqXHR, textStatus, errorThrown){
                    var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);
                     console.log(list);  
                     $.each(list, function(index, responseErrorMessageDetails) {
                           console.log(responseErrorMessageDetails);  
                         var message = responseErrorMessageDetails.message;
                         if(message.indexOf("]:") > 0)
                           message = message.substring(0,message.indexOf("]:")+2);

                         $('#confirmmessage').html("<b>Error : </b>"+message);
                         //confirmmessageconfirmmessage$('#adminStaffErrorBlock').show();
                     });
                 }
                
                });
                 patientname = $('#patientname').val();
                 start = 0;
                  end = 100;
                  if(patientname != ""){
                      window.location.href = rootURL + "/Web/staff/staffindex.php?page=payments&start=0&end=100&patientname="+patientname;
                  }else
                      window.location.href = rootURL + "/Web/staff/staffindex.php?page=payments";

    });
    
    
    
    
    $('#fetchAllAssignedHomeServiceOrdered').click(function () {

        console.log($('#patientname').val());
        console.log($('#mobilenumber').val());
        console.log($('#start').val());
        console.log($('#finish').val());
        ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
        if ($('#patientname').val() == "") {
            patientname = 'nodata';
        } else
            patientname = $('#patientname').val();
        if ($('#mobilenumber').val() == "") {
            mobile = 'nodata';
        } else
            mobile = $('#mobilenumber').val();
        if ($('#start').val() == "") {
            start = 'nodata';
        } else
            start = $('#start').val();
        if ($('#finish').val() == "") {
            end = 'nodata';
        } else
            end = $('#finish').val();


        if (start != "nodata") {
            startdate1 = start.split(".");
            startdate = startdate1[2] + "-" + startdate1[1] + "-" + startdate1[0];
        } else
            startdate = "nodata";
        if (end != "nodata") {
            enddate1 = end.split(".");
            enddate = enddate1[2] + "-" + enddate1[1] + "-" + enddate1[0];
        } else
            enddate = "nodata";

        if ($('#receiptid').val() == "") {
            receiptid = 'nodata';
        } else
            receiptid = $('#receiptid').val();
        ///fetchHomeServices/:mobile/:pname/:receiptid/:start/:end
        console.log(rootURL + '/fetchAssignedHospitalHomeServices/' + mobile + '/' + patientname + '/' + receiptid + '/' + startdate + '/' + enddate);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchAssignedHospitalHomeServices/' + mobile + '/' + patientname + '/' + receiptid + '/' + startdate + '/' + enddate,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_home_service_assigned_order_table tbody").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        if (responseMessageDetails.data.length > 0) {
                            patientcid = "";
                            $.each(patientData, function (index, data) {
                                console.log(data.requestserved);
                                if (data.requestserved != "null") {
                                    tooltip = escape('Serviced Date ' + data.requestserved + ' Attended By ' + data.attendername);
                                } else {
                                    tooltip = "Yet to attend service. !";
                                }
                              //  link1 = "<button class='btn btn-warning btn-xs' onclick='closeService(" + data.id + ")'><i class='fa fa-trash-o'></i> Close</button>";
                              //  link2 = "<button class='btn-u btn-u-blue btn-u-xs' onclick='movetoLab(" + data.id + ")'><i class='fa fa-magic'></i> Lab</button>";
                                datatopass = data.id;
                                trHTML = "<tr><td>" + data.patientname + "</td><td>" + data.mobile + "</td><td>" + data.servicename + "</td>\n\
                   <td>" + data.requestdate + "</td><td>" + data.assigneddate + "</td><td>" + data.attendername + "</td>\n\
                 <td>" + data.receiptid + "</td><td>" + data.hospitalcomments + "</td></tr>";


                                $('#patient_home_service_assigned_order_table').append(trHTML);
                                $('#patient_home_service_assigned_order_table').load();

                            });

                        } else {
                            trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_home_service_assigned_order_table').append(trHTML);
                            $('#patient_home_service_assigned_order_table').load();
                        }

                    }
                });


            }
        });

    });
});


function printPrescription(appointmentid){
     var host = $('#host').val();
     var rootnode = $('#rootnode').val();
   var url = 'http://'+host+'/'+rootnode+'/Business/GeneratePrescriptionPDF.php?appointmentid='+appointmentid;
    window.open(url, '_blank');
    
}


function  validatePrintSearchForm(){
      var patientName = $('#patientName').val();
      var patientId = $('#patientID').val();
      var appointmentId = $('#appointmentID').val();
       var mobile = $('#mobile').val();
       
       
       
    if(patientName == "" && patientId == "" && mobile == "" && appointmentId == "" ){
        $('#adminStaffErrorMessage').html("<b><font color='red'>Error : </b> Please enter atleast one search criteria</font>");
        $('#adminStaffErrorBlock').show();
        return false;
    }else
        return true;
    
}




function checkQuickUserId(userId){
    
console.log("user Id "+userId);
  $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/checkUserId/' + userId,
        dataType: "json",
        success: function(data, textStatus, jqXHR){

            var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);

            console.log("In check User Id"+(list).length);
            console.log(list);
            
            $.each(list, function(index, responseMessageDetails) {
                var message = responseMessageDetails.message;
               if(message.indexOf("]:") > 0)
                  message = message.substring(0,message.indexOf("]:")+2);
                if(responseMessageDetails.status == "Success"){
                    console.log("Data length : "+responseMessageDetails.data.length);
                    if(message.indexOf("User Exists") > 0){
                         $('#errorDisplay').html(message);
                         $('#errormessages').show()
                    }else{
                        
                        
                        registerQuickNewUser();
                        
                        
                    }
                    
                }else if(responseMessageDetails.status == "Fail"){
                   $('#errorDisplay').html(responseMessageDetails.message);
                   $('#errormessages').show()
                }else {
                    $('#errorDisplay').html("Sorry Intermittent Error. Please try after some time");
                    $('#errormessages').show()
                }
                
                
            });
          
        },
        error: function(data){
               var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#errorDisplay').html("<font color='red'><b>"+message+"</b></font>");
                 $('#errormessages').show()
             });
        }
    });

    
}


function registerQuickNewUser(){
    

        
        registerQuickUser($('#mobile').val(),$('#password').val(),$('#email').val(),$('#mobile').val(),'Others',$('#name').val());


}


function registerQuickUser(userName,password,email,mobile,profession,name){
   
    var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"name":name,"insttype":"Hospital"} );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/quickRegister',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                console.log(list);
            
               $.each(list, function(index, responseMessageDetails) {
                   var message = responseMessageDetails.message;
                   
                  
                    if(message.indexOf("]:") > 0)
                        message = message.substring(0,message.indexOf("]:")+2);
                    
                     console.log("Message : "+message);
                    
                   if(responseMessageDetails.status == "Success"){
                       console.log("In SUccess"+responseMessageDetails.message);
                       $('#errorDisplay').html(responseMessageDetails.message);
                       $('#errormessages').show();
                        var mobileNumber = mobile;
                    	//var message = responseMessageDetails.message;
                    	var message = responseMessageDetails.comments;
                    	var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+mobileNumber+"&text="+message+"&priority=ndnd&stype=normal";

                    	$.post(url, function(data){
                    		//Need to show some message if we get response from the SMS api.
                    		//Currently we are just sending Message after Signup
                    	});
                    	
                       clearFormValues();
                   }else{
                       console.log("In fail");
                       if(message.indexOf("Exists") > 0){
                            
                           $('#errorDisplay').html("User Id already exists");
                            $('#errormessages').show();
                       }else{
                           
                           $('#errorDisplay').html(responseMessageDetails.message);
                            $('#errormessages').show();
                            clearFormValues();
                       }
                   }
                   
                   
                });
 
            },
            error: function(data){
                var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#errorDisplay').html("<font color='red'><b>"+message+"</b></font>");
                 $('#errormessages').show()
             });

            }
        });

}


function registerQuickFormValidate(){
    
    clearValidationMessage();
    if($('#mobile').val() == ""){
        console.log("new user");
        $('#errorDisplay').html("Please enter Mobile Number"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
   
    if($('#mobile').val().length < 10){
         console.log("new user less then 10");
        $('#errorDisplay').html("Mobile Number Minimum length is 10"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    
     if($('#password').val() == ""){
          console.log("password");
        $('#errorDisplay').html("Please enter password"); 
         $('#password').attr('style', 'background-color: #FBFAC9');
        return false;  
    } 
    if($('#password').val().length < 5){
         console.log("pass les then 5");
        $('#errorDisplay').html("Password Minimum length is 5"); 
         $('#password').attr('style', 'background-color: #FBFAC9');
        return false;  
    } 
     if($('#name').val().length < 1){
         console.log("name");
        $('#errorDisplay').html("Please enter name"); 
        $('#name').attr('style', 'background-color: #FBFAC9');
        return false;
    } 
    
     if($('#mobile').val().length < 1){
          console.log("mobile");
        $('#errorDisplay').html("Please enter mobile #"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    } 
    
    
   return true;
}


function clearValidationMessage(){
    $('#useriderrmsg').html("");
     $('#passworderrormsg').html("");  
    $('#nameerrormsg').html(""); 
     $('#mnameerrormsg').html("");   
     $('#lnamerrormsg').html("");
     $('#emailerrormsg').html("");  
    $('#mobileerrormsg').html("");
     $('#address1errormsg').html("");
      $('#stateerrormsg').html("");   
     $('#districterrormsg').html("");
       $('#zipcodeerrormsg').html(""); 
     $('#gendererrormsg').html("");  
    $('#proferrormsg').html("") ; 
     $('#aadharerrormsg').html("") ; 
     $('#cityerrormsg').html("") ; 
       $('#errorDisplay').html("") ; 
         $('#errmsg').html("") ; 
           $('#starterrormsg').html("") ; 

}


function generateIDCard(userid){
    var host = $('#host').val();
     var rootnode = $('#rootnode').val();
   var url = 'http://'+host+'/'+rootnode+'/Business/GenerateIDCardPDF.php?patientid='+userid;
    window.open(url, '_blank');
   // window.location.href = url;
    
}

function createHiddenDiv(data,count){
      console.log("in create div");
        var newTextBoxDiv = $(document.createElement('div'))
                 .attr("id", 'newTextBoxDiv' + count);

       console.log(" newTextBoxDiv : "+newTextBoxDiv);

            newTextBoxDiv.after().html('<label>Textbox #'+ count + ' : </label>' +
                            '<input type="text" name="textbox' + count + 
                  '" id="textbox' + count + '" value="'+data+'" >');

            newTextBoxDiv.appendTo("#generaldiv");


            $('#counter').val(count);
}

function deleteGeneralData(rowData){
   console.log("In Delete"+rowData);
   try{
        row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
        
          $("#newTextBoxDiv" + rowData).remove();
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function editGeneralData(rowData){
   console.log("In edit"+rowData);
   try{
          console.log($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         console.log(" dataToEdit :"+dataToEdit);
         var splitDataToEdit = dataToEdit.split("$");
         console.log(" splitDataToEdit :"+splitDataToEdit);
         
     $('#paramname').val((splitDataToEdit[0] == "nodata" ? "" : splitDataToEdit[0]));
    $('#paramvalue').val((splitDataToEdit[1] == "nodata" ? "" : splitDataToEdit[1]));
    $('#observation').val((splitDataToEdit[2] == "nodata" ? "" : splitDataToEdit[2])); 
    
    $("#newTextBoxDiv" + rowData).remove();
      row = document.getElementById(rowData) ;
      console.log("row :"+row);
      (row).parentNode.removeChild(row);
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}



function enterDetails(s){
    
    $('#searchresult').hide();
    $('#enterdetails').show();
    $('#patientid').val(s);
    //fetchPatientGeneralInfo
    console.log(rootURL + '/fetchPatientGeneralInfo/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchPatientGeneralInfo/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_existing_records_search_result_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                       
                          userData = responseMessageDetails.data;

                          console.log("userData : "+userData.length);
                          var trHTML = "";
                          $.each(userData, function(index, userDetails) {
                              s = userDetails.id;
                              s = userDetails.id;
                                s = s.replace(/^0+/, '');
                               data = escape(s+"#"+userDetails.paramname+"#"+userDetails.paramvalue+"#"+userDetails.observation); 
                                   trHTML += '<tr><td>' + s + '</td><td>' + userDetails.paramname  +'</td><td>' + userDetails.paramvalue + '</td><td>' + userDetails.observation + '</td><td><font color="blue"><a href="#" onclick=editGeneralInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#patient_existing_records_search_result_table').append(trHTML);
                           $('#patient_existing_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});
    
}

function editGeneralInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    $('#paramidedit').val(splitData[0]);
    $('#paramnameedit').val(splitData[1]);
    $('#paramvalueedit').val(splitData[2]);
    $('#observationedit').val(splitData[3]);
    $('#myParametersModal').modal('show');
}//

function editMedicalInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    $('#paramidedit').val(splitData[0]);
    $('#paramnameedit').val(splitData[1]);
    $('#paramvalueedit').val(splitData[2]);
    $('#observationedit').val(splitData[3]);
    $('#myMedicalParametersModal').modal('show');
}//

function enterHealthDetails(s){
   // alert("Hello");
    $('#searchhealthresult').hide();
    $('#enterhealthdetails').show();
    $('#patientid').val(s);
    
     console.log(rootURL + '/fetchPatientMedicalInfo/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchPatientMedicalInfo/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_existing_medical_records_search_result_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                       
                          userData = responseMessageDetails.data;

                          console.log("userData : "+userData.length);
                          var trHTML = "";
                          $.each(userData, function(index, userDetails) {
                              s = userDetails.id;
                              s = userDetails.id;
                                s = s.replace(/^0+/, '');
                               data = escape(s+"#"+userDetails.paramname+"#"+userDetails.paramvalue+"#"+userDetails.observation); 
                                   trHTML += '<tr><td>' + s + '</td><td>' + userDetails.paramname  +'</td><td>' + userDetails.paramvalue + '</td><td>' + userDetails.observation + '</td><td><font color="blue"><a href="#" onclick=editMedicalInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#patient_existing_medical_records_search_result_table').append(trHTML);
                           $('#patient_existing_medical_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});
    
    
}

function showDoctorAppointments(doctorId){
    //document.getElementById('yourAnchorId').innerHTML
      window.location.replace(rootURL + '/Web/staff/staffindex.php?doctorid='+doctorId);

}

function getAppointmentHomePatientList(profession,patientname,patientid,hosiptal){
    
    if(patientname == ""){
        patientname = "nodata";
    }
    if(patientid == ""){
        patientid = "nodata";
    }
    
   console.log(rootURL + '/hospitalSpecifiPatientsDetails/' + profession +'/'+patientname+'/'+patientid);
    $.ajax({
    type: 'GET',
    url: rootURL + '/hospitalSpecifiPatientsDetails/' + profession +'/'+patientname+'/'+patientid,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_home_staff_records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                       
                          userData = responseMessageDetails.data;

                          console.log("userData : "+userData.length);
                          var trHTML = "";
                          if(userData.length > 0){
                          $.each(userData, function(index, userDetails) {
                              s = userDetails.ID;
                              s = userDetails.ID;
                                s = s.replace(/^0+/, '');
                                   trHTML += '<tr><td>' + s + '</td><td>' + userDetails.name  +'</td><td>' + userDetails.email + '</td><td>' + userDetails.mobile + '</td><td><font color="blue"><a href="#" onclick=staffHomeBookAppointment('+s+')>Book Appointment</a></font></td></tr>';
                               });
                           }else{
                               trHTML += '<tr><td colspan="5"><i><font color="blue"><h6>-- Sorry No Records Found --</h6></font></i></td></tr>';
                           }  
                           $('#patient_home_staff_records_table').append(trHTML);
                           $('#patient_home_staff_records_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        },
        error: function(data){
             var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });
         }
        
        
	});
}


function staffHomeBookAppointment(patientid){

   //alert($('#start').val());
    if($('#start').val().indexOf(".") > 0){
     var appdt = ($('#start').val()).split(".");
     var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
 }else{ 
     var appdate = $('#start').val();
 } 
     //alert(appdate);
     
     appointmentType = $('#appointmenttype').val();
     
     pageFrom = GetPageParameter('page')
     staffHomeCreateAppointment($('#hosiptal').val(),$('#doctor').val(),appdate,patientid,$('#slot').val(),'N',"",appointmentType);
alert("Appointment Created Successfully");
    if(pageFrom == ' ' || (pageFrom == undefined))
         window.location.replace(rootURL + '/Web/staff/staffindex.php');
    else if(pageFrom == 'appointment')
       window.location.replace(rootURL + '/Web/staff/staffindex.php?page=appointment');
   else if(pageFrom == 'createappointment')
       window.location.replace(rootURL + '/Web/staff/staffindex.php?page=appointment');
       
 
}



function staffHomeCreateAppointment(hosiptal,doctor,appdate,pid,slot,status,pname,appointmentType){
    
    var appointmentDetails = JSON.stringify( {"hosiptal" : hosiptal,"doctor" : doctor,"appdate" : appdate,"slot":slot,"pid" : pid,"status":status,"pname":pname,"appointmentType":appointmentType } );
   //alert(appointmentDetails);
    console.log(appointmentDetails);
    $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: rootURL + '/createAppointment',
    dataType: "json",
    data:  appointmentDetails,
    success: function(data, textStatus, jqXHR){
		console.log('authentic success: ' + data);
         var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            //$("#records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message+" {Appointment ID :  "+responseMessageDetails.comments +" }" );
                         $('#adminStaffErrorBlock').show();
                      
                      }else{
                             $('#confirmmessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             //confirmmessage$('#adminStaffErrorBlock').show();
                      }
                 });
         
        
		},
        error: function(jqXHR, textStatus, errorThrown){
            var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);
             console.log(list);  
             $.each(list, function(index, responseErrorMessageDetails) {
                   console.log(responseErrorMessageDetails);  
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#confirmmessage').html("<b>Error : </b>"+message);
                 //confirmmessageconfirmmessage$('#adminStaffErrorBlock').show();
             });
         }
	});
    
}


function showDoctorAppointment(doctorName){
    
    console.log(rootURL + '/todayDoctorAppointments/'+doctorName);
    $.ajax({
    type: 'GET',
    url: rootURL + '/todayDoctorAppointments/'+doctorName,
    dataType: "json",
    success: function(data){
      console.log('authentic success: ' + data)
        var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
       var trHTML = '';
       $("#current_doctor_appointment_records_table tbody").remove();
       
       console.log("Data List Length "+list.length);
       
       $.each(list, function(index, responseMessageDetails) {
           
           if(responseMessageDetails.status == "Success"){
              // $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
              // $('#adminStaffErrorBlock').show();
                   
                todayAppointments = responseMessageDetails.data;
                
                console.log("todayAppointments"+todayAppointments.length);
                
                $.each(todayAppointments, function(index, todayAppointment) {
                   if(todayAppointment.STATUS == "Y")
                     btst = "Completed";
              else if(todayAppointment.STATUS == "C"){
                  btst = "Canceled";
              } else
                  btst = "Not Done";
                    trHTML += '<tr><td>' + todayAppointment.ID +  '</td><td>' + todayAppointment.PATIENTNAME    +'</td><td> '+ todayAppointment.APPOINTMENTTIME  +'</td><td><font color="blue"> '+ btst  +'</font></td></tr>';
                
                });
                
            }else{
                  // $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                  // $('#adminStaffErrorBlock').show();
            }
           
       });
        $('#myModal').modal('show');
         $('#current_doctor_appointment_records_table').append(trHTML);
         $('#current_doctor_appointment_records_table').load(); 
    }
	});
        
        
        
}

function getCurentAppointments(){
    //alert("hello");
      
    console.log(rootURL + '/todayAppointments');
    $.ajax({
    type: 'GET',
    url: rootURL + '/todayAppointments',
    dataType: "json",
    success: function(data){
       console.log('authentic current appointment : ' + data)
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.todayAppointments ]); 
       
        if(list.length > 0){
         var trHTML = '';
        btst = "";
         $('#current_appointment_records_table tbody').remove(); 
       $.each(list, function(index, todayAppointments) {
            console.log("current appointment "+todayAppointments.AppointmentTime)  
              if(todayAppointments.status == "Y")
                     btst = "Completed";
              else if(todayAppointments.status == "C"){
                  btst = "Canceled";
              } else
                    btst = "<a href='#' onclick='cancelAppointment("+todayAppointments.id+")'>Cancel</a> &nbsp;&nbsp;&nbsp;&nbsp;"+
                         "<a href='#' onclick='confirmAppointment("+todayAppointments.id+")'>Confirm</a> &nbsp;&nbsp;&nbsp;&nbsp;";
                
                    trHTML += '<tr><td>' + todayAppointments.id +  '</td><td>' + todayAppointments.PatientName    +'</td><td> '+ todayAppointments.DoctorName  +'</td><td>' + todayAppointments.AppointmentTime    +'</td><td><font color="blue"> '+ btst  +'</font></td></tr>';
                
              
            });
             $('#current_appointment_records_table').append(trHTML);
            $('#current_appointment_records_table').load(); 
         }
    }
	});
}


function cancelAppointment(appointmentid){
    
    
       
    console.log(rootURL + '/confirmCancelAppointments/Cancel/'+appointmentid);
    $.ajax({
    type: 'PUT',
    url: rootURL + '/confirmCancelAppointments/Cancel/'+appointmentid,
    dataType: "json",
    success: function(data){
        console.log(data);
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
       console.log(list.length);
        $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show(); 
                } 
            });       
       // getCurentAppointments();
	 window.location.replace(rootURL + '/Web/staff/staffindex.php');
    }
	});
   
}

function confirmAppointment(appointmentid){
    
    
    
       
    console.log(rootURL + '/confirmCancelAppointments/Confirm/'+appointmentid);
    $.ajax({
    type: 'PUT',
    url: rootURL + '/confirmCancelAppointments/Confirm/'+appointmentid,
    dataType: "json",
    success: function(data){
        console.log(data);
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
       console.log(list.length);
        $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show(); 
                } 
            });       
       // getCurentAppointments();
	 window.location.replace(rootURL + '/Web/staff/staffindex.php');
    }
	});
}

function finishAppointment(appointmentid){
    
    console.log(rootURL + '/fetchAppointmentConsultationDetails/'+appointmentid);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchAppointmentConsultationDetails/'+appointmentid,
    dataType: "json",
    success: function(data){
        console.log(data);
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
       console.log(list.length);
        $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show(); 
                }
                 prescriptionData = responseMessageDetails.data;
                console.log("userData Pregnancy : "+prescriptionData);
                objLength = prescriptionData.length;
                var trHTML = "";
                $.each(prescriptionData, function(index, userDetails) {
           // datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName
           // +"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId+"$"+appointmentType;  
                             if(userDetails.pregnancy == "Y")
                                    appointmentType = "P";
                                else if(userDetails.child == "Y")
                                    appointmentType = "C";
                                else 
                                    appointmentType = "G";                     
                    doctorname = userDetails.DoctorName;
                    hospitalname = userDetails.HospitalName;
                    patientname = userDetails.PatientName;
                    patientid = userDetails.PatientId;
                    hospitalid = userDetails.HosiptalId;
                    doctorid = userDetails.DoctorId;
                    appointmentdate = userDetails.AppointementDate;
                    appointmentid = userDetails.id;
                });
            });   
           
         if(appointmentType == "P")
            window.location.href = "staffindex.php?page=pregnancyprescription&frompage=pregnancyprescription&patientid="+patientid+"&patientname="+patientname+"&doctorid="+doctorid+"&doctorname="+doctorname+"&appointmentid="+appointmentid+"&hospitalid="+hospitalid+"&hospitalname="+hospitalname+"&appointmentdate="+appointmentdate;//
           else if(appointmentType == "C")    
               window.location.href = "staffindex.php?page=childprescription&frompage=childprescription&patientid="+patientid+"&patientname="+patientname+"&doctorid="+doctorid+"&doctorname="+doctorname+"&appointmentid="+appointmentid+"&hospitalid="+hospitalid+"&hospitalname="+hospitalname+"&appointmentdate="+appointmentdate;//
          else 
               window.location.href = "staffindex.php?page=patientprescription&frompage=childprescription&&patientid="+patientid+"&patientname="+patientname+"&doctorid="+doctorid+"&doctorname="+doctorname+"&appointmentid="+appointmentid+"&hospitalid="+hospitalid+"&hospitalname="+hospitalname+"&appointmentdate="+appointmentdate;//
          
        
        
        
       // getCurentAppointments();
       //page=createappointment&doctorid=114&appointmentdate=2015-09-30&doctorname=Rajiv%20Kumar%20Lopuri
	//console.log((GetPageParameter("doctorid") != undefined && GetPageParameter("appointmentdate") != "" && GetPageParameter("doctorname") != ""));
     /*   if(GetPageParameter("doctorid") != undefined && GetPageParameter("appointmentdate") != undefined && GetPageParameter("doctorname") != undefined)
            window.location.replace(rootURL + '/Web/staff/staffindex.php?page=createappointment&doctorid='+GetPageParameter("doctorid")+'&appointmentdate='+GetPageParameter("appointmentdate")+'&doctorname='+GetPageParameter("doctorname"));
        else{
            console.log("In else");
            window.location.replace(rootURL + '/Web/staff/staffindex.php');
        }  */ 
    }
	});
}

function checkForLeave(currDate,doctorid){
    var flag = "";
     $.ajax({
    type: 'GET',
    url: rootURL + '/checkForLeave/'+currDate+'/'+doctorid,
    dataType: "json",
        success: function(data){
             console.log(data);
                var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
               console.log(list.length);
                $.each(list, function(index, responseMessageDetails) {

                        if(responseMessageDetails.status == "Success"){
                            $('#leaveMessage').html("Doctor is on leave on current day");
                            $('#appointmentLeaveMessage').modal('show');
                                flag = responseMessageDetails.status;
                        }else
                             flag = responseMessageDetails.status;
                    });
        }
    });
    return flag;
}

function bookSpecificDateAppointment(slotTime){
    
   // alert($('#start').val());
    if($('#start').val() == ""){
        alert("Please enter appointment date");
        return false;
    }
     var fullDate = new Date();console.log(fullDate);
    
    var time = fullDate.getHours() + ":" + fullDate.getMinutes();
    peakTime = slotTime.substring(slotTime.indexOf("-")+1,slotTime.length);
    console.log("peakTime : "+unescape(peakTime));
    slot = (((unescape(peakTime)).replace(/^\s+|\s+$/gm,'')).replace(":",''))//.replace(/^0+|0+$/g, "");
    
    time = ((((unescape(time)).replace(/^\s+|\s+$/gm,'')).replace(":",'')))//.replace(/^0+|0+$/g, ""))
    
    console.log("SLOT : "+slot);
     console.log("time : "+time);
   //  alert(slot+" : "+time+" : "+(parseInt(slot) >  parseInt(time)));
    if(parseInt(slot) >  parseInt(time)){
        console.log("Slot greater : "+(slot>time));
         console.log("Slot lesser : "+(slot<time));

        console.log("Slot time trim "+slotTime.replace(/^0+|0+$/g, ""));

        console.log("time trip"+time.replace(/^0+|0+$/g, ""));

        console.log("Trm peak time : "+(((unescape(peakTime)).replace(/^\s+|\s+$/gm,'')).replace(".",'')).replace(/^0+|0+$/g, ""));
         $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");
       
         var appdt = ($('#start').val()).split('.');
         
         var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
          $('#slot').val(unescape(slotTime));
         $('#start').val(appdate);
         $('#currdate').html(appdate+" <b> Time : </b> "+unescape(slotTime));
        if( checkForLeave(appdate,$('#doctorid').val()) != "Fail")
             $('#enterAppointmentData').modal('show');
    }else{
        
        $('#generalMessage').html("Sorry Time Elapsed you cant book this slot. "+unescape(slotTime));
        $('#appointmentGeneralMessage').modal('show');
        
    }
    
}

function bookAppointment(slotTime){
   
    var fullDate = new Date();console.log(fullDate);
     var time = fullDate.getHours() + ":" + fullDate.getMinutes();
    var dateEntered = $('#appointmentdate').val();
   // alert((parseInt(fullDate.getMonth())+parseInt(1)));
    if(dateEntered == ""){
       dateEntered = fullDate.getFullYear()+"-"+(parseInt(fullDate.getMonth())+parseInt(1))+"-"+fullDate.getDate();
    }
    console.log("dateEntered"+dateEntered);
    var appdt = (dateEntered).split('-');
  // var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
    var fullDate = new Date(fullDate.getFullYear(),fullDate.getMonth(),fullDate.getDate());
    var dateToCompare = new Date(appdt[0], appdt[1]-1, appdt[2]);
    console.log("year : "+appdt[0]);
     console.log("month : "+appdt[1]);
      console.log("date : "+appdt[2]);
    console.log("fullDate : "+fullDate);
     console.log("dateToCompare : "+dateToCompare);
     console.log(" > "+(fullDate > dateToCompare));
     console.log(" < "+(fullDate < dateToCompare));
     console.log(" eqyual "+(fullDate == dateToCompare));
    if(fullDate > dateToCompare){
         $('#generalMessage').html("Sorry you cant book appointment for old dates");
        $('#appointmentGeneralMessage').modal('show');
    }else if((fullDate < dateToCompare)){
        
       console.log("In else if less then");
        console.log("time Before : "+time);
        peakTime = slotTime.substring(slotTime.indexOf("-")+1,slotTime.length);
        console.log("peakTime : "+unescape(peakTime));
        slot = (((unescape(peakTime)).replace(/^\s+|\s+$/gm,'')).replace(":",''))//.replace(/^0+|0+$/g, "");

        time = ((((unescape(time)).replace(/^\s+|\s+$/gm,'')).replace(":",'')))//.replace(/^0+|0+$/g, ""))

        slotHour = (peakTime.split(":"))[0];
        timeHour = (time.split(":"))[0];
        console.log("SLOT : "+slotHour);
         console.log("time : "+timeHour);
       //  alert(slot+" : "+time+" : "+(parseInt(slot) >  parseInt(time)));
       
            console.log("Slot greater : "+(slotHour>timeHour));
             console.log("Slot lesser : "+(slotHour<timeHour));

            console.log("Slot time trim "+slotTime.replace(/^0+|0+$/g, ""));

            console.log("time trip"+time.replace(/^0+|0+$/g, ""));

            console.log("Trm peak time : "+(((unescape(peakTime)).replace(/^\s+|\s+$/gm,'')).replace(".",'')).replace(/^0+|0+$/g, ""));
            // alert(time);
            var twoDigitMonth = parseInt(fullDate.getMonth())+1+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
           console.log("twoDigitMonth"+twoDigitMonth);
            var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
            console.log("twoDigitDate"+twoDigitDate);
            var currentDate = twoDigitDate + "." + twoDigitMonth + "." + fullDate.getFullYear();
            console.log("currentDate"+currentDate);
            $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");

             $('#slot').val(unescape(slotTime));
             $('#start').val(dateEntered);
            $('#currdate').html(dateEntered+" <b> Time : </b> "+unescape(slotTime));

            //alert(checkForLeave(currentDate,$('#doctorid').val()));
            if( checkForLeave(dateEntered,$('#doctorid').val()) != "Fail")
                 $('#enterAppointmentData').modal('show');
      
    } else {
        flag = true;
        console.log("In else equall");
        
        console.log("time Before : "+time);
        peakTime = slotTime.substring(slotTime.indexOf("-")+1,slotTime.length);
        console.log("peakTime : "+unescape(peakTime));
        slotHour = (unescape(peakTime).split(":"))[0];
        timeHour = (time.split(":"))[0];
        slotMinute = (unescape(peakTime).split(":"))[1];
        timeMinute = (time.split(":"))[1];
        
        slot = (((unescape(peakTime)).replace(/^\s+|\s+$/gm,'')).replace(":",''))//.replace(/^0+|0+$/g, "");

        time = ((((unescape(time)).replace(/^\s+|\s+$/gm,'')).replace(":",'')))//.replace(/^0+|0+$/g, ""))

        console.log("SLOT : "+slot);
         console.log("time : "+time);
         
         console.log("slotHour : "+slotHour);
         console.log("timeHour : "+timeHour);
         console.log("slotMinute : "+slotMinute);
         console.log("timeMinute : "+timeMinute);
         
         if(parseInt(slotHour) > parseInt(timeHour))
             flag = true;
         else if(parseInt(slotHour) < parseInt(timeHour))
             flag = false;
         else if(parseInt(slot) === parseInt(timeHour)){
             if(parseInt(slotMinute) > parseInt(timeMinute))
                 flag = true;   
             else if(parseInt(slotMinute) < parseInt(timeMinute))
                flag = false; 
            else
                flag = true;
         }
         
       //  alert(slot+" : "+time+" : "+(parseInt(slot) >  parseInt(time)));
        if(flag){
            console.log("Slot greater : "+(slot>time));
             console.log("Slot lesser : "+(slot<time));

            console.log("Slot time trim "+slotTime.replace(/^0+|0+$/g, ""));

            console.log("time trip"+time.replace(/^0+|0+$/g, ""));

            console.log("Trm peak time : "+(((unescape(peakTime)).replace(/^\s+|\s+$/gm,'')).replace(".",'')).replace(/^0+|0+$/g, ""));
            // alert(time);
            var twoDigitMonth = parseInt(fullDate.getMonth())+1+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
           console.log("twoDigitMonth"+twoDigitMonth);
            var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
            console.log("twoDigitDate"+twoDigitDate);
            var currentDate = twoDigitDate + "." + twoDigitMonth + "." + fullDate.getFullYear();
            console.log("currentDate"+currentDate);
            $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");

             $('#slot').val(unescape(slotTime));
             $('#start').val(dateEntered);
            $('#currdate').html(dateEntered+" <b> Time : </b> "+unescape(slotTime));

            //alert(checkForLeave(currentDate,$('#doctorid').val()));
            if( checkForLeave(dateEntered,$('#doctorid').val()) != "Fail")
                 $('#enterAppointmentData').modal('show');
        }else{

            $('#generalMessage').html("Sorry Time Elapsed you cant book this slot. "+unescape(slotTime));
            $('#appointmentGeneralMessage').modal('show');

        }
        
    }
    
}

function GetPageParameter(sParam){
    
     var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}

function displayErrorResults(){
         $('#adminHospitalErrorBlock').hide();
         $('#adminStaffErrorBlock').hide();
         $('#staffErrorBlock').hide();
         $('#staffErrorMessage').html("");  
          $('#adminStaffErrorMessage').html("");  
}

function editPaymentDetails(id){
    console.log('Hellooooo');
    $('#ppatientid').val(id); 
    $('#myPatientPaymentDetails').modal('show');
    
    
}