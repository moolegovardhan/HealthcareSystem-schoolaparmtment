/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
    
    //alert(getUrlParam("navigatefrom"));
    
    $('#prescriptionpanel').hide();
    $('#listofpatients').hide();
    $('#adminStaffErrorBlock').hide();
     $('#patientHistoryPanel').hide();
      $("#collapse-Two").collapse('hide');
    $("#collapse-One").collapse('show');
    $("#collapse-Three").collapse('hide');
    
    if(getUrlParam("navigatefrom") == "fromAppointment"){
        console.log(".............................................................");
                $('#listofpatients').hide();
             $('#patientHistoryPanel').hide();
          $('#prescriptionpanel').show();
          gotoPrescriptionFromHome(getUrlParam("appointmentid"));
          
    }
    
    
    $('#searchPrescription').click(function(){
    	
        if(validateSearchForm()){
            
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
					
                    $('#patient_consultation_records_search_result_table tbody').html('');
                    
                    var objLength = '';
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  //$('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  //$('#adminStaffErrorBlock').show();
                                    prescriptionData = responseMessageDetails.data;
                                     console.log("userData Pregnancy : "+prescriptionData);
                                     objLength = prescriptionData.length;
                                     var trHTML = "";
                                     $.each(prescriptionData, function(index, userDetails) {
                                          console.log("userDetails child : "+userDetails.child);
                                          console.log("userDetails Pregnancy : "+userDetails.pregnancy);
                                          console.log("userDetails inpatient : "+userDetails.inpatient);
                                          console.log("userDetails amount : "+userDetails.amount);
                                           console.log("userDetails Y : "+(userDetails.pregnancy == "Y"));
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                        if(userDetails.pregnancy == "Y")
                                            appointmentType = "P";
                                        else if(userDetails.child == "Y")
                                            appointmentType = "C";
                                        else 
                                            appointmentType = "G";
                                        datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId+"$"+appointmentType;  
                                         console.log("datatopass : "+datatopass);    
                                         console.log("index........"+(index < 1));
                                         if(index < 1 && patientid != "nodata")
                                         btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
                                         else{
                                             if(patientid != "nodata")
                                                btst = "";
                                             else
                                                 btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';

                                         }    
  
  								/*
                               trHTML += '<tr><td>' + s + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                               + '</td><td>'+btst+'</td></tr>';
                               */ 
									  
									  $('#patient_consultation_records_search_result_table tbody').append('<tr class="data"><td>'+s+'</td><td>'+userDetails.PatientName+'</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime+ '</td><td>'+btst+'</td></tr>');
                                        
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
    
    
    
    
   
    $('#showPrescriptionSearch').click(function(){
        // alert("Helo patien search");
            $('#listofpatients').hide();
            $('#prescriptionsearchpanel').show();
            $('#prescriptionpanel').hide();
             $('#patientHistoryPanel').hide();
    });
    $('#showPrescriptionSearchResult').click(function(){
        //alert("Helo patien list");
            $('#listofpatients').show();
            //$('#prescriptionsearchpanel').hide();
            $('#prescriptionpanel').hide();
             $('#patientHistoryPanel').hide();
    });
   
    $('#showMedicineSerachPop').click(function(){
    	$('#searchMedicinesModal').modal('show');
    }); 
    $('#showDoctorMedicineSerachPop').click(function(){
    	$('#searchDoctorMedicinesModal').modal('show');
    }); 
    
    
    
    $("#pregnant").change( function() {
       // alert("Hello");
            if(this.checked) {
                if(confirm(("Do You Want to navigate to Pregnancy section"))){
                    console.log("Hello in yes");
                     $.ajax({
                                type: 'PUT',
                                url: rootURL + '/updateAppointmenttoPregnancy/' + $('#hidappointmentId').val(),
                                dataType: "json",
                                success: function(data){
                                       
                                       console.log("Navigating to Pregnancy......");
                                        window.location.href = "staffindex.php?page=pregnancyprescription&frompage=pregnancyprescription&patientid="+$('#hiddendoctorName').val()+"&patientname="+$('#hiddenpatientName').val()+"&doctorid="+$('#hiddendoctorId').val()+"&doctorname="+$('#hiddendoctorName').val()+"&appointmentid="+$('#hidappointmentId').val()+"&hospitalid="+$('#hidhospitalId').val()+"&hospitalname="+$('#hidhospitalName').val()+"&appointmentdate="+$('#hidappointmentDate').val();//
    
                                }

                            });
                }else{
                    console.log("In Else");
                }
            }
        });
       $("#child").change( function() {
       // alert("Hello");
            if(this.checked) {
                if(confirm(("Do You Want to navigate to Child section"))){
                    console.log("Hello in CHild");
                     $.ajax({
                                type: 'PUT',
                                url: rootURL + '/updateAppointmenttoChild/' + $('#hidappointmentId').val(),
                                dataType: "json",
                                success: function(data){
                                       
                                       console.log("Navigating to Pregnancy......");
                                        window.location.href = "staffindex.php?page=childprescription&frompage=childprescription&patientid="+$('#hiddendoctorName').val()+"&patientname="+$('#hiddenpatientName').val()+"&doctorid="+$('#hiddendoctorId').val()+"&doctorname="+$('#hiddendoctorName').val()+"&appointmentid="+$('#hidappointmentId').val()+"&hospitalid="+$('#hidhospitalId').val()+"&hospitalname="+$('#hidhospitalName').val()+"&appointmentdate"+$('#hidappointmentDate').val();//
    
                                }

                            });
                }else{
                    console.log("In Else");
                }
            }
        }); 
    
});

function  validateSearchForm(){
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

function showDetails(s){
  //  datapass = (unescape(s).split("$"));
  //  checkforAvailableData(datapass[1]);
    
    console.log("jjjjjjjjjjjjjjjjjjjjjjjjjj");
      $('#listofpatients').hide();
       $('#patientHistoryPanel').hide();
     console.log(unescape(s));
    $('#prescriptionpanel').show();
//datatopass = 
//datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+
//userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+
//userDetails.HospitalId+"$"+userDetails.DoctorId;   
    
     datapass = (unescape(s).split("$"));    
     console.log((datapass));  
     $('#hiddenpatientName').val(datapass[5]);  
     $('#hiddendoctorName').val(datapass[4]);
     $('#hidhospitalName').val(datapass[3]);
     $('#hiddendoctorId').val(datapass[7]);
     $('#hidhospitalId').val(datapass[6]);
     $('#hidappointmentDate').val(datapass[2]);
     $('#hidappointmentId').val(datapass[1]);
     $('#hiddenpatientId').val(datapass[0]);
     
     $('#prespatientName').html(datapass[5]);
    $('#doctorName').html(datapass[4]);
    $('#hospitalName').html(datapass[3]);
    $('#appointmentDate').html(datapass[2]);
     
     appointmentType = datapass[8];
     
     fromPage = window.location.pathname;
     
     console.log("fromPage : "+fromPage);
     
     if(fromPage.indexOf('doctor') > 0){
       if(appointmentType == "P")
         window.location.href = "doctorindex.php?page=pregnancyprescription&frompage=pregnancyprescription&patientid="+$('#hiddenpatientId').val()+"&patientname="+$('#hiddenpatientName').val()+"&doctorid="+$('#hiddendoctorId').val()+"&doctorname="+$('#hiddendoctorName').val()+"&appointmentid="+$('#hidappointmentId').val()+"&hospitalid="+$('#hidhospitalId').val()+"&hospitalname="+$('#hidhospitalName').val()+"&appointmentdate="+$('#hidappointmentDate').val();//
        else if(appointmentType == "C")    
            window.location.href = "doctorindex.php?page=childprescription&frompage=childprescription&patientid="+$('#hiddenpatientId').val()+"&patientname="+$('#hiddenpatientName').val()+"&doctorid="+$('#hiddendoctorId').val()+"&doctorname="+$('#hiddendoctorName').val()+"&appointmentid="+$('#hidappointmentId').val()+"&hospitalid="+$('#hidhospitalId').val()+"&hospitalname="+$('#hidhospitalName').val()+"&appointmentdate="+$('#hidappointmentDate').val();//

     }else{
        if(appointmentType == "P")
         window.location.href = "staffindex.php?page=pregnancyprescription&frompage=pregnancyprescription&patientid="+$('#hiddenpatientId').val()+"&patientname="+$('#hiddenpatientName').val()+"&doctorid="+$('#hiddendoctorId').val()+"&doctorname="+$('#hiddendoctorName').val()+"&appointmentid="+$('#hidappointmentId').val()+"&hospitalid="+$('#hidhospitalId').val()+"&hospitalname="+$('#hidhospitalName').val()+"&appointmentdate="+$('#hidappointmentDate').val();//
        else if(appointmentType == "C")    
            window.location.href = "staffindex.php?page=childprescription&frompage=childprescription&patientid="+$('#hiddenpatientId').val()+"&patientname="+$('#hiddenpatientName').val()+"&doctorid="+$('#hiddendoctorId').val()+"&doctorname="+$('#hiddendoctorName').val()+"&appointmentid="+$('#hidappointmentId').val()+"&hospitalid="+$('#hidhospitalId').val()+"&hospitalname="+$('#hidhospitalName').val()+"&appointmentdate="+$('#hidappointmentDate').val();//

     }
     
     
     
       fetchGeneralHealthInfo(datapass[0]);
       fetchMedicalHealthInfo(datapass[0]);
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchAppointmentDoctorPrecritption/' + datapass[1] +'/'+datapass[7],
          dataType: "json",
          success: function(data){
        	 //console.log(data);
        	 
        	 var lastIndex = data.length;
        	 lastIndex = parseInt(lastIndex)-1;
        	 
        	 $('#start').val(data[lastIndex].nextappointmentdt);
        	 $('#suggestions').val(data[lastIndex].suggestions);
        	 $('#description').val(data[lastIndex].description);
        	 
        	 var diagnosisCenter = '';
        	 $.map(data, function(obj) {
        		    if(obj.type === "DIAGNOSIS CENTER")
        		    	diagnosisCenter = obj.namevalue;
        		});
        	 $('#presdiagnostics option:eq('+diagnosisCenter+')').prop('selected', true);
        	 
        	 $.map(data, function(obj) {
     		    if(obj.type === "DISEASES")
     		    	$('#presdiseases option:eq('+obj.namevalue+')').prop('selected', true);
     		});
        	
        	 $.map(data, function(obj) {
      		    if(obj.type === "MEDICAL TEST")
      		    	$('#presdiagnosticstests option:eq('+obj.namevalue+')').prop('selected', true);
      		});
        	
          }
          });
      
      
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchMedicineWithAppointment/' + datapass[1] +'/'+datapass[0],
          dataType: "json",
          success: function(data){
        	  $('#patient_medincine_records_repords_table tbody').html("");
        	  $.each(data,function(key, value){
        		  $('#patient_medincine_records_repords_table').append('<tr id="'+data[key].id+'"><td nowrap>'+data[key].medicinename+'</td><td>'+data[key].noofdays+'</td><td>'+data[key].dosage+'</td><td>'+data[key].MBF+'</td><td>'+data[key].MAF+'</td><td>'+data[key].ABF+'</td><td>'+data[key].AAF+'</td><td>'+data[key].EBF+'</td><td>'+data[key].EAF+'</td><td ><button class="btn btn-warning btn-xs" onclick="deleteData('+data[key].id+')"><i class="fa fa-trash-o"></i> Delete</button></td></tr>');
			
                       
                  
                  });
          }
      
      });
      
      //fetchDoctorMedicines(datapass[7]);
      
      
}

function fetchGeneralHealthInfo(patientid){
   // alert("Hello General");
    $("#collapse-Two").collapse('show');
    $("#collapse-One").collapse('hide');
    $("#collapse-Three").collapse('hide');
     console.log("Doctor Medicines : "+rootURL + '/fetchPatientGeneralInfo/' + patientid);
        $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPatientGeneralInfo/' + patientid,
                dataType: "json",
                success: function(data){
                     console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#table_patient_general_info tbody").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#adminStaffErrorBlock').show();
                                  testData = responseMessageDetails.data;
                                     console.log("Patient General Info : "+testData.length);
                                     var trHTML = "";
                                     $.each(testData, function(index, testDetails) {
                                         
                                     
                                     trHTML += '<tr><td>'+testDetails.paramname+'</td>\n\
                                                    <td>'+testDetails.paramvalue+'</td></tr>';
                                     
                                     });
                                      $('#table_patient_general_info').append(trHTML);
                                     $('#table_patient_general_info').load();
                                 
                                }
                            });        
                }
            });
    
}



function fetchMedicalHealthInfo(patientid){
   // alert("Hello Medical");
     console.log("Doctor Medicines : "+rootURL + '/fetchPatientMedicalInfo/' + patientid);
        $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPatientMedicalInfo/' + patientid,
                dataType: "json",
                success: function(data){
                     console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#table_patient_medical_info tbody").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#adminStaffErrorBlock').show();
                                  testData = responseMessageDetails.data;
                                     console.log("Patient General Info : "+testData.length);
                                     var trHTML = "";
                                     $.each(testData, function(index, testDetails) {
                                         
                                     
                                     trHTML += '<tr><td>'+testDetails.paramname+'</td>\n\
                                                    <td>'+testDetails.paramvalue+'</td></tr>';
                                     
                                     });
                                     $('#table_patient_medical_info').append(trHTML);
                                     $('#table_patient_medical_info').load();
                                 
                                }
                            });        
                }
            });
    
}


function fetchDoctorMedicines(doctorid){
    //fetchHospitalSpecificDoctorMedicines
    
    console.log("Doctor Medicines : "+rootURL + '/fetchHospitalSpecificDoctorMedicines/' + doctorid);
        $.ajax({
                type: 'GET',
                url: rootURL + '/fetchHospitalSpecificDoctorMedicines/' + doctorid,
                dataType: "json",
                success: function(data){
                     console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#doctormedicineslist option").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#adminStaffErrorBlock').show();
                                  testData = responseMessageDetails.data;
                                     console.log("Doctor Medicines : "+testData.length);
                                     var trHTML = "";
                                    strtext = 'Doctor Medicines'
                                     $('<option>').text(strtext).appendTo('#doctormedicineslist');
                                     $.each(testData, function(index, testDetails) {
                                          $('<option>').val(testDetails.name).text(testDetails.name).appendTo('#doctormedicineslist');
                                     });
                                 
                                }
                            });        
                }
            }); 
    
}


function searchGenericMedicine(){
	var serchData = $('#searchMedicine').val();
	$.ajax({
		type: 'GET',
		url: rootURL + '/fetchMedicinesList/'+serchData,
		dataType: "json",
		success: function(data){
			$('#searchMedicinesResults').show();
			$('#searchMedicinesResults tbody').html('');
			var objLength = data.length;
			if(objLength > 0){
				 for (var i = 0; i < objLength; i++) {
					 $('#searchMedicinesResults tbody').append('<tr class="data" onclick="addSearchMedicine('+data[i].id+')" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
					}
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
							$rows = $('#searchMedicinesResults tbody').find('.data');
	
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
				$('#searchMedicinesResults tbody').append('<tr><td colspan="2" style="text-align:center;">No Data Found</td></tr>');
				$('#tablePaging').hide();
			}
			 
			}
  });
}


function searchDoctorPageGenericMedicine(){
	var serchData = $('#searchMedicine').val();
        if(serchData.length < 3){
            $('#searchMedicinesResults').show();
	$('#searchMedicinesResults tbody').html('');
            $('#searchMedicinesResults tbody').append('<tr><td colspan="2" style="text-align:center;">Please enter 3 char for medicine search</td></tr>');
            $('#tablePaging').hide();
            console.log("In If condition.............");
            return false;
        }
            
        console.log(rootURL + '/fetchMedicinesList/'+serchData);
        $('#searchMedicinesResults tbody').html('');
	$.ajax({
		type: 'GET',
		url: rootURL + '/fetchMedicinesList/'+serchData,
		dataType: "json",
		success: function(data){
			$('#searchMedicinesResults').show();
			$('#searchMedicinesResults tbody').html('');
			var objLength = data.length;
                        console.log("objLength................"+objLength);
                        console.log("data................"+data);
			if(objLength > 0){
				 for (var i = 0; i < objLength; i++) {
					 $('#searchMedicinesResults tbody').append('<tr class="data" onclick="addDoctorPageSearchMedicine('+data[i].id+')" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
					}
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
							$rows = $('#searchMedicinesResults tbody').find('.data');
	
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
				$('#searchMedicinesResults tbody').append('<tr><td colspan="2" style="text-align:center;">No Data Found</td></tr>');
				$('#tablePaging').hide();
			}
			 
			}
  });
}


function addDoctorPageSearchMedicine(id){
    console.log("........"+id);
  //  console.log("................."+'#row_'+id.find('.medicine-name').text());
	$('#gmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchMedicinesModal').modal('hide'); 
}

function addSearchMedicine(id){
    console.log("........"+id);
    console.log("................."+'#row_'+id.find('.medicine-name').text());
	$('#gmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchMedicinesModal').modal('hide'); 
}

function searchDoctorMedicine(){
	var serchData = $('#searchDoctorMedicine').val();
	var doctorId = $('#hiddendoctorId').val();
	$.ajax({
		type: 'GET',
		url: rootURL + '/fetchDoctorMedicinesList/'+serchData+'/'+doctorId,
		dataType: "json",
		success: function(data){
			$('#searchMedicinesResults').show();
			$('#searchDoctorMedicinesResults tbody').html('');
			var objLength = data.length;
			
			if(objLength > 0){
			
				 for (var i = 0; i < objLength; i++) {
					 $('#searchDoctorMedicinesResults tbody').append('<tr class="data" onclick="addSearchDoctorMedicine('+data[i].id+')" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
				 }
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
							$rows = $('#searchDoctorMedicinesResults tbody').find('.data');
	
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
				 $('#searchDoctorMedicinesResults tbody').append('<tr><td colspan="2" style="text-align:center;">No Data Found</td></tr>');
				 $('#tablePaging').hide();
			}
			
			}
  });
}
function addSearchDoctorMedicine(id){
     console.log("id............."+id);
    //console.log($("row.............."+'#row_'+id).find('.medicine-name').text());
	$('#dmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchDoctorMedicinesModal').modal('hide'); 
}

function getUrlParam(sParam){
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

function  gotoPrescriptionFromHome(appointmentid){
    nodata = "nodata";
     console.log(rootURL + '/fetchConsultationList/' + nodata +'/'+nodata +'/'+appointmentid+'/'+nodata);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchConsultationList/'+ nodata +'/'+nodata +'/'+appointmentid+'/'+nodata,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
					
                    $('#patient_consultation_records_search_result_table tbody').html('');
                    
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
                                     showDetailsForNavigationtoPrescription(escape(datatopass));
                                       
                                        
                                    });    
                                      	
                                        
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


function showDetailsForNavigationtoPrescription(s){
  //  datapass = (unescape(s).split("$"));
  //  checkforAvailableData(datapass[1]);
    
      $('#listofpatients').hide();
       $('#patientHistoryPanel').hide();
     console.log(unescape(s));
    $('#prescriptionpanel').show();
//datatopass = 
//datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+
//userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+
//userDetails.HospitalId+"$"+userDetails.DoctorId;   
    
     datapass = (unescape(s).split("$"));    
     console.log((datapass));  
     $('#hiddenpatientName').val(datapass[5]);  
     $('#hiddendoctorName').val(datapass[4]);
     $('#hidhospitalName').val(datapass[3]);
     $('#hiddendoctorId').val(datapass[7]);
     $('#hidhospitalId').val(datapass[6]);
     $('#hidappointmentDate').val(datapass[2]);
     $('#hidappointmentId').val(datapass[1]);
     $('#hiddenpatientId').val(datapass[0]);
       fetchGeneralHealthInfo(datapass[0]);
       fetchMedicalHealthInfo(datapass[0]);
       
       $('#prespatientName').html(datapass[5]);
        $('#doctorName').html(datapass[4]);
        $('#hospitalName').html(datapass[3]);
        $('#appointmentDate').html(datapass[2]);
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchAppointmentDoctorPrecritption/' + datapass[1] +'/'+datapass[7],
          dataType: "json",
          success: function(data){
        	 //console.log(data);
        	 
        	 var lastIndex = data.length;
        	 lastIndex = parseInt(lastIndex)-1;
        	 
        	 $('#start').val(data[lastIndex].nextappointmentdt);
        	 $('#suggestions').val(data[lastIndex].suggestions);
        	 $('#description').val(data[lastIndex].description);
        	 
        	 var diagnosisCenter = '';
        	 $.map(data, function(obj) {
        		    if(obj.type === "DIAGNOSIS CENTER")
        		    	diagnosisCenter = obj.namevalue;
        		});
        	 $('#presdiagnostics option:eq('+diagnosisCenter+')').prop('selected', true);
        	 
        	 $.map(data, function(obj) {
     		    if(obj.type === "DISEASES")
     		    	$('#presdiseases option:eq('+obj.namevalue+')').prop('selected', true);
     		});
        	
        	 $.map(data, function(obj) {
      		    if(obj.type === "MEDICAL TEST")
      		    	$('#presdiagnosticstests option:eq('+obj.namevalue+')').prop('selected', true);
      		});
        	
          }
          });
      
      
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchMedicineWithAppointment/' + datapass[1] +'/'+datapass[0],
          dataType: "json",
          success: function(data){
        	  $('#patient_medincine_records_repords_table tbody').html("");
        	  $.each(data,function(key, value){
        		  $('#patient_medincine_records_repords_table').append('<tr id="'+data[key].id+'"><td nowrap>'+data[key].medicinename+'</td><td>'+data[key].noofdays+'</td><td>'+data[key].dosage+'</td><td>'+data[key].MBF+'</td><td>'+data[key].MAF+'</td><td>'+data[key].ABF+'</td><td>'+data[key].AAF+'</td><td>'+data[key].EBF+'</td><td>'+data[key].EAF+'</td><td ><button class="btn btn-warning btn-xs" onclick="deleteData('+data[key].id+')"><i class="fa fa-trash-o"></i> Delete</button></td></tr>');
			
                       
                  
                  });
          }
      
      });
      
      //fetchDoctorMedicines(datapass[7]);
      
}

