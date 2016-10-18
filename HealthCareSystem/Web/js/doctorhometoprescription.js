/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    $('#counter').val(0);
       
    appointmentid = getParameterByName('appointmentid');
    
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
                    var appointmentData = responseMessageDetails.data;
                     $.each(appointmentData, function(index, appointment) {
                         console.log(appointment);
                         /*
                          * {"id":"2","StaffId":"0","StaffName":"","DoctorId":"56","DoctorName":"Pavan Kumar Kuppa",
                          * "HospitalName":"Vijay","AppointementDate":"2015-08-09","AppointmentTime":"15.00 - 15.10",
                          * "PhoneMumber":"0","Address":"","status":"Y","PatientId":"2","PatientName":"Patient Name","HosiptalId":"7"}
                          */
                         
                         $('#prespatientName').html(appointment.PatientName);
                          $('#hospitalName').html(appointment.HospitalName);
                           $('#doctorName').html(appointment.DoctorName);
                            $('#appointmentDate').html(appointment.AppointementDate);
                             $('#hiddenpatientName').val(appointment.PatientName);
                          $('#hidhospitalId').val(appointment.HosiptalId);
                           $('#hiddendoctorId').val(appointment.DoctorId);
                            $('#hidappointmentId').val(appointment.id);
                             $('#hiddenpatientId').val(appointment.PatientId); 
                           $('#hidappointmentDate').html(appointment.AppointementDate);
                         console.log(appointment.DoctorId);
                         console.log(appointment.AppointementDate);
                         console.log(appointment.HosiptalId);
                     });
                } 
            });       
       // getCurentAppointments();
	// window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=homeprescription');
    }
	});
        
        
        
        
     
    
    $('#btnAddHomeMedicinesSpecificData').click(function(){
        var trHtml = "";
        if(validateBeforeAddMedicines()){
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
        trHtml += '<tr id="'+count+'"><td>' + medicineName + '</td><td>' + nofodays + '</td><td>' + usage + '</td><td>' + mbm + '</td><td>' + mam   +'</td><td>' + abm  + 
            '</td><td>' + aam + '</td><td>' + ebm + '</td><td>' + eam + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';
              
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
        
    
         $( "#presdiagnostics" ).change(function() {
          // alert("hello 1");
            testsForDiagnostics($( "#presdiagnostics" ).val());
          });    
         
         $('#showMedicineSerachPop').click(function(){
         	$('#searchMedicinesModal').modal('show');
         }); 
         $('#showDoctorMedicineSerachPop').click(function(){
         	$('#searchDoctorMedicinesModal').modal('show');
         }); 
});




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

function checkforAvailableData(selectedDiagnostics){
    console.log(rootURL + '/testsForDiagnostics/' + selectedDiagnostics);
        $.ajax({
                type: 'GET',
                url: rootURL + '/testsForDiagnostics/' + selectedDiagnostics,
                dataType: "json",
                success: function(data){
                    
                }
            });   
    
}

function showDetails(s){
  //  datapass = (unescape(s).split("$"));
  //  checkforAvailableData(datapass[1]);
    
    
      $('#listofpatients').hide();
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
}




function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
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
    console.log(id);
    console.log($('#row_'+id).find('.medicine-name').text());
  //  console.log(id);
	$('#gmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchMedicinesModal').modal('hide'); 
}

function searchDoctorMedicine(){
	var serchData = $('#searchDoctorMedicine').val();
	var doctorId = $('#hiddendoctorId').val();
        console.log(rootURL + '/fetchDoctorMedicinesList/'+serchData+'/'+doctorId);
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
