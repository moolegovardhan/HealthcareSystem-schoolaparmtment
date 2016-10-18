
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
   
    $('#counter').val("0");
    $('#searchCallCenterPrescription').click( function(){
        console.log();
          fetchPatientDetails();
    });
    
     $( "#presdiagnostics" ).change(function() {
         //alert("hello 1");
          testsForDiagnostics($( "#presdiagnostics" ).val());
        });
       
    $('#showMedicineSerachPop').click(function(){
    	$('#searchMedicinesModal').modal('show');
    }); 
    $('#showDoctorMedicineSerachPop').click(function(){
    	$('#searchDoctorMedicinesModal').modal('show');
    }); 
    
      $('#btnAddMedicinesSpecificData').click(function(){
        var trHtml = "";
        
        if(validateBeforeAddMedicines()){
             $('#nooferrmsg').html("");
            count = parseInt($('#counter').val())+1;
            mbm = ($('#mbm1').is(":checked") ? 1 : 0);
            mam = ($('#mam1').is(":checked") ? 1 : 0);
            abm = ($('#abm1').is(":checked") ? 1 : 0);
            aam = ($('#aam1').is(":checked") ? 1 : 0);
            ebm = ($('#ebm1').is(":checked") ? 1 : 0);
            eam = ($('#eam1').is(":checked") ? 1 : 0);
            nofodays = $('#noofdays').val();
            gmedicine =  ($('#gmedicines').val() == "" ? "nogmedicine" : $('#gmedicines').val());
            dmedicine = ($('#dmedicines').val() == "" ? "nodmedicine" : $('#dmedicines').val());
            omedicine = ($('#omedicines').val() == "" ? "noomedicine" : $('#omedicines').val());
            usage = $('#usage').val();
            rowvalue = gmedicine+"#"+dmedicine+"#"+nofodays+"#"+mbm+"#"+mam+"#"+abm+"#"+aam+"#"+ebm+"#"+eam+"#"+omedicine+"#"+usage;
              console.log("rowvalue : "+rowvalue);
              
                  createHiddenTextBox(rowvalue,count);
          if($('#gmedicines').val() != "")
              var medicineName = $('#gmedicines').val();
          if($('#dmedicines').val() != "")
              var medicineName = $('#dmedicines').val();
          if($('#omedicines').val() != "")
              var medicineName = $('#omedicines').val();
            
            
         //   var medicineName =  ($('#gmedicines').val() == "" ? $('#dmedicines').val() : $('#gmedicines').val()) 
            
        btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
        btnEdit = '<button class="btn btn-warning btn-xs" onclick="editData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
        //idValue = "1";
        trHtml += '<tr id="'+count+'"><td nowrap>' + medicineName + '</td><td>' + nofodays + '</td><td>' + usage + '</td><td>' + mbm + '</td><td>' + mam   +'</td><td>' + abm  + 
            '</td><td>' + aam + '</td><td>' + ebm + '</td><td>' + eam + '</td><td  nowrap>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';
              
              $('#gmedicines').val("");
               $('#omedicines').val("");
              $('#dmedicines').val("");
              $('#noofdays').val("");
              $('#mbm1').prop("checked",false);
               $('#mam1').prop("checked",false);
                $('#abm1').prop("checked",false);
                 $('#aam1').prop("checked",false);
                  $('#ebm1').prop("checked",false);
                $('#aam1').prop("checked",false);       
                  
     
        }
         $('#patient_medincine_records_repords_table').append(trHtml);
        $('#patient_medincine_records_repords_table').load();
    });
});



function deleteData(rowData){
   console.log("In"+rowData);
   try{
        row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
        
          $("#TextBoxDiv" + rowData).remove();
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}

function editData(rowData){
   console.log("In"+rowData);
   try{
         //alert($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         var splitDataToEdit = dataToEdit.split("#");
    //gmedicine+"#"+dmedicine+"#"+nofodays+"#"+mbm+"#"+mam+"#"+abm+"#"+aam+"#"+ebm+"#"+eam;
     $('#gmedicines').val((splitDataToEdit[0] == "nogmedicine" ? "" : splitDataToEdit[0]));
    $('#dmedicines').val((splitDataToEdit[1] == "nodmedicine" ? "" : splitDataToEdit[1]));
    $('#noofdays').val(splitDataToEdit[2]);
     $('#usage').val(splitDataToEdit[10]);
    $('#omedicines').val(splitDataToEdit[9]); 
    $('#mbm1').prop("checked",(splitDataToEdit[3] == 1 ? true : false));
     $('#mam1').prop("checked",(splitDataToEdit[4] == 1 ? true : false));
      $('#abm1').prop("checked",(splitDataToEdit[5] == 1 ? true : false));
       $('#aam1').prop("checked",(splitDataToEdit[6] == 1 ? true : false));
        $('#ebm1').prop("checked",(splitDataToEdit[7] == 1 ? true : false));
      $('#aam1').prop("checked",(splitDataToEdit[8] == 1 ? true : false));    
    $("#TextBoxDiv" + rowData).remove();
      row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function createHiddenTextBox(data,count){
    
    console.log("in create div");
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html('<label>Textbox #'+ count + ' : </label>' +
	      '<input type="text" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#medicinestabledata");

				
	$('#counter').val(count);
    
}



function validateBeforeAddMedicines(){
    
     console.log("General : "+$('#gmedicines').val());
     console.log("Doctor : "+$('#dmedicines').val());
     console.log("noofdays : "+$('#noofdays').val());
     console.log("mbm1 : "+$('#mbm1').is(":checked"));
     console.log("mam1 : "+$('#mam1').is(":checked"));
     console.log("abm1 : "+$('#abm1').is(":checked"));
     console.log("aam1 : "+$('#aam1').is(":checked"));
     console.log("ebm1 : "+$('#ebm1').is(":checked"));
     console.log("eam1 : "+$('#eam1').is(":checked")); 
    
    if($('#gmedicines').val() == "" && $('#dmedicines').val() == ""  && $('#omedicines').val() == "" ){
        $('#nooferrmsg').html("Please select general or doctor or other medicines");
        return false;
    }
    if($('#noofdays').val() == ""){
        $('#nooferrmsg').html("Please enter no of days");
        return false;
    }
    if(!$('#mbm1').is(":checked") && !$('#mam1').is(":checked") && !$('#abm1').is(":checked") && !$('#aam1').is(":checked") && !$('#ebm1').is(":checked") && !$('#eam1').is(":checked")){
       $('#nooferrmsg').html("Please select atleast 1 in-take time");
        return false;  
    }
    
    return true;
    console.log("General : "+$('#gmedicines').val());
     console.log("Doctor : "+$('#dmedicines').val());
     console.log("noofdays : "+$('#noofdays').val());
     console.log("mbm1 : "+$('#mbm1').is(":checked"));
     console.log("mam1 : "+$('#mam1').is(":checked"));
     console.log("abm1 : "+$('#abm1').val());
     console.log("aam1 : "+$('#aam1').val());
     console.log("ebm1 : "+$('#ebm1').val());
     console.log("eam1 : "+$('#eam1').val());   
    
}

function testsForDiagnostics(selectedDiagnostics){
//alert("hello");
console.log(rootURL + '/testsForDiagnostics/' + selectedDiagnostics);
        $.ajax({
                type: 'GET',
                url: rootURL + '/testsForDiagnostics/' + selectedDiagnostics,
                dataType: "json",
                success: function(data){
                     console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#presdiagnosticstests option").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#adminStaffErrorBlock').show();
                                  testData = responseMessageDetails.data;
                                     console.log("testData : "+testData.length);
                                     var trHTML = "";
                                    strtext = '-------- Select Test ----------'
                                     $('<option>').text(strtext).appendTo('#presdiagnosticstests');
                                     $.each(testData, function(index, testDetails) {
                                          $('<option>').val(testDetails.testid).text(testDetails.testname).appendTo('#presdiagnosticstests');
                                     });
                                 
                                }
                            });        
                }
            });     
    
}



function fetchPatientDetails(){
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
            
            
          console.log(rootURL + '/fetchCallCenterConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchCallCenterConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
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
  
  				
									  
	  $('#patient_consultation_records_search_result_table tbody').append('<tr class="data"><td>'+s+'</td><td>'+userDetails.PatientName+'</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime+ '</td><td>'+btst+'</td></tr>');
                                        
                                     
                                          
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


function showDetails(s){
   // datapass = (unescape(s).split("$"));
   
    $("#collapse-Two").collapse({"toggle": true, 'parent': '#accordion-1',active:true});
    $("#collapse-One").collapse({"toggle": true, 'parent': '#accordion-1',active:false});
    
      $('#listofpatients').hide();
       $('#patientHistoryPanel').hide();
     console.log(unescape(s));
    $('#prescriptionpanel').show();
    
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
     
             medicineName =   data[key].medicinename; 
             noofdays = data[key].noofdays;
             mbf = data[key].MBF;
            maf = data[key].MAF;
            abf = data[key].ABF;
            aaf = data[key].AAF;
            ebf = data[key].EBF;
            eaf = data[key].EAF;
            dosage = data[key].dosage;
   //rowvalue = gmedicine+"#"+dmedicine+"#"+nofodays+"#"+mbm+"#"+mam+"#"+abm+"#"+aam+"#"+ebm+"#"+eam+"#"+omedicine+"#"+usage;                   
  count = parseInt($('#counter').val())+1;                   
rowvalue = medicineName+"#nodmedicine#"+noofdays+"#"+mbf+"#"+maf+"#"+abf+"#"+aaf+"#"+ebf+"#"+eaf+"#noomedicine#"+dosage;
console.log("rowvalue : "+rowvalue);
createHiddenTextBox(rowvalue,count);


  $('#patient_medincine_records_repords_table').append('<tr id="'+count+'"><td nowrap>'+data[key].medicinename+'</td><td>'+data[key].noofdays+'</td><td>'+data[key].dosage+'</td><td>'+data[key].MBF+'</td><td>'+data[key].MAF+'</td><td>'+data[key].ABF+'</td><td>'+data[key].AAF+'</td><td>'+data[key].EBF+'</td><td>'+data[key].EAF+'</td><td ><button class="btn btn-warning btn-xs" onclick="deleteData('+count+')"><i class="fa fa-trash-o"></i> Delete</button></td></tr>');


                  
                  });
          }
      
      });
      
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


function testsForDiagnostics(selectedDiagnostics){
//alert("hello");
console.log(rootURL + '/testsForDiagnostics/' + selectedDiagnostics);
        $.ajax({
                type: 'GET',
                url: rootURL + '/testsForDiagnostics/' + selectedDiagnostics,
                dataType: "json",
                success: function(data){
                     console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#presdiagnosticstests option").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#adminStaffErrorBlock').show();
                                  testData = responseMessageDetails.data;
                                     console.log("testData : "+testData.length);
                                     var trHTML = "";
                                    strtext = '-------- Select Test ----------'
                                     $('<option>').text(strtext).appendTo('#presdiagnosticstests');
                                     $.each(testData, function(index, testDetails) {
                                          $('<option>').val(testDetails.testid).text(testDetails.testname).appendTo('#presdiagnosticstests');
                                     });
                                 
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
function addSearchMedicine(id){
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
	$('#dmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchDoctorMedicinesModal').modal('hide'); 
}
