/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
      $('#counter').val(0);
     $('#showPatientHistory').click( function(){
         
          $('#hiddenpatientId').val();
         if($('#hiddenpatientId').val() == ""){
             alert("System Error, Please refresh and try again.");
         }else{
             fetchPatientHistory($('#hiddenpatientId').val());
         }
         
     }); 
    
    $('#btnAddMedicinesSpecificData').click(function(){
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
         //  alert("hello 1"+$( "#presdiagnostics" ).val());
         // if($( "#presdiagnostics" ).val() != "Otherts" || $( "#presdiagnostics" ).val() != "Diagnostics")
             testsForDiagnostics($( "#presdiagnostics" ).val());
          });
    
        $('#showPatientGeneralInfo').click( function(){
            patientid = $('#hiddenpatientId').val();
             console.log(rootURL + '/fetchPatientGeneralInfo/'+patientid);
                $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPatientGeneralInfo/'+patientid,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                      var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                        $("#PatientParametersTable tbody").remove();

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
                                           //data = escape(s+"#"+userDetails.paramname+"#"+userDetails.paramvalue+"#"+userDetails.observation); 
                                               trHTML += '<tr><td>' + s + '</td><td>' + userDetails.paramname  +'</td><td>' + userDetails.paramvalue + '</td><td>' + userDetails.observation + '</td></tr>';
                                           });
                                       $('#PatientParametersTable').append(trHTML);
                                       $('#PatientParametersTable').load(); 
                                  }else{

                                  }
                             });

                            $('#myGeneralParametersModal').modal('show');
                    }
                            

                    });
            
            
            
        }); 
        
        
        
        $('#showPatientMedicalInfo').click( function(){
            patientid = $('#hiddenpatientId').val();
             console.log(rootURL + '/fetchPatientMedicalInfo/'+patientid);
                $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPatientGeneralInfo/'+patientid,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                      var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                        $("#PatientMedicalParametersTable tbody").remove();

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
                                           //data = escape(s+"#"+userDetails.paramname+"#"+userDetails.paramvalue+"#"+userDetails.observation); 
                                               trHTML += '<tr><td>' + s + '</td><td>' + userDetails.paramname  +'</td><td>' + userDetails.paramvalue + '</td><td>' + userDetails.observation + '</td></tr>';
                                           });
                                       $('#PatientMedicalParametersTable').append(trHTML);
                                       $('#PatientMedicalParametersTable').load(); 
                                  }else{

                                  }
                             });

                            $('#myMedicalParametersModal').modal('show');
                    }
                            

                    });
            
            
            
        });
 //     
    $('#navigatetoPrescription').click( function(){
        
        navigateToPrescription();
        
    }) ;
 
});


function navigateToPrescription(appointmentid){
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
                                        datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId+"$"+userDetails.pregnancy+"$"+userDetails.child+"$"+userDetails.amount;  
                                     showDetailsForNavigationtoPrescription(escape(datatopass));
                                       
                                         /*  console.log("datatopass : "+datatopass);    
                                         console.log("index........"+(index < 1));
                                         if(index < 1 && patientid != "nodata")
                                         btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
                                         else{
                                             if(patientid != "nodata")
                                                btst = "";
                                             else
                                                 btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';

                                         }    
                                         */   
  								/*
                               trHTML += '<tr><td>' + s + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                               + '</td><td>'+btst+'</td></tr>';
                               */ 
							/*		  
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
                                           
                                         */ 
                                    });    
                                       //$('#patient_consultation_records_search_result_table').append(trHTML);
                                       //$('#patient_consultation_records_search_result_table').load();
                                     
                        			
                                        
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



function fetchPatientHistory(patientId){
    
         console.log(rootURL + '/patientPrescriptionHistory/' + patientId);  
            $.ajax({
                type: 'GET',
                url: rootURL +  '/patientPrescriptionHistory/' + patientId,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#patient_prescription_history tbody").remove();

                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    $('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log(userData); 
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                       console.log(userDetails); 
                              prescription = '<a href="#" onclick="showPopUpPrescription('+userDetails.patientappointmentid+')">Prescription</a>';          
                              reports = '<a href="#" onclick="showReports('+userDetails.patientappointmentid+')">Report</a>';
                              medicines = '<a href="#" onclick="showMedicines('+userDetails.patientappointmentid+')">Medicine</a>';
                           cssClass = "";
                          // console.log("userDetails.description"+userDetails.description);
                          // console.log("userDetails.inpatient"+userDetails.inpatient);
                          if(userDetails.inpatient == 'Y'){
                              console.log("In Y");
                              cssClass = "#F5A9A9";
                              
                          }
                          shortComment = userDetails.description;  
                          console.log(shortComment);
                          if(shortComment != null){
                          if(shortComment.indexOf(' ') > 0)
                             shortComment = shortComment.substring(0,shortComment.indexOf(' '));
                     }
                          console.log("shortComment 1 : "+shortComment);
                            trHTML += '<tr style="background-color:'+cssClass+'"><td>' + userDetails.patientappointmentid   +'</td><td>' + userDetails.AppointementDate   +'</td><td>' + userDetails.DoctorName + '</td><td title="'+userDetails.description+'">' + shortComment + '</td><td>' + prescription  + '</td><td>' + reports
                            + '</td><td>'+medicines+'</td></tr>';


                                          
                                    });    
                                     $('#listofpatients').hide();
                                    $('#prescriptionsearchpanel').show();
                                    $('#prescriptionpanel').hide();
                                     $('#patientHistoryPanel').show();
                                        $('#patient_prescription_history').append(trHTML);
                                        $('#patient_prescription_history').load();
                                        
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                             }
                             
                     });   
                    
                }
            });    
    
    
}

function showPopUpPrescription(appointmentid){
      console.log(rootURL + '/fetchPrescriptionDescription/' + appointmentid);  
            $.ajax({
                type: 'GET',
                url: rootURL +  '/fetchPrescriptionDescription/' + appointmentid,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#PatientPrescriptionTable tbody").remove();

                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    $('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                    /*      var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                        
                                        
                                console.log(userDetails.description); 
                                imgpath = userDetails.path;
                                console.log("imgpath : "+imgpath);
                                imgurl = escape(userDetails.filename);
                                imgpath = imgpath.substring(imgpath.indexOf("/")+1,imgpath.length);
                                 console.log("imgpath : "+imgpath.indexOf("/")+1);
                                  console.log("imgpath : "+imgpath);
                                console.log(imgurl);
                                imgurl = "'"+rootURL+"/"+imgpath+"/"+imgurl+"'";*/
                            //  btst = '<a href="javascript:" onclick="window.open('+imgurl+');" target="_blank">'+userDetails.filename +'</a>';
                            trHTML += '<tr><td>' + userDetails.description   +'</td><td>' + userDetails.suggestions   +'</td></tr>';

                                //readPrescriptionURL          
                                    });    
                                
                                        $('#patientHistoryPanel').show();
                                        $('#PatientPrescriptionTable').append(trHTML);
                                        $('#PatientPrescriptionTable').load();
                                        $('#myModal').modal('show');
                                        
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                             }
                             
                     });   
                    
                }
            }); 
    
    
    
    

}

function readPrescriptionURL(input) {
  //  alert(input);
    //input = unescape(inputs);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                console.log(e.target.result);
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
 

function showMedicines(appointmentid){
    //fetchMedicinesByAppointmentId
    
    
         console.log(rootURL + '/fetchMedicinesByAppointmentId/' + appointmentid);  
            $.ajax({
                type: 'GET',
                url: rootURL +  '/fetchMedicinesByAppointmentId/' + appointmentid,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#PatientMedicineTable tbody").remove();

                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    $('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                        
                                        
                                        
                              
                            trHTML += '<tr><td>' + userDetails.medicinename   +'</td><td>' + userDetails.dosage  + 
                            '</td><td>' + userDetails.MBF + '</td><td>' + userDetails.MAF + '</td><td>' + userDetails.ABF + '</td>\n\
                            <td>' + userDetails.AAF + '</td><td>' + userDetails.EBF + '</td><td>' + userDetails.EAF + '</td>\n\
                            <td>' + userDetails.noofdays + '</td></tr>';

                                          
                                    });    
                                  //   $('#listofpatients').hide();
                                  //  $('#prescriptionsearchpanel').show();
                                  //  $('#prescriptionpanel').hide();
                                     $('#patientHistoryPanel').show();
                                        $('#PatientMedicineTable').append(trHTML);
                                        $('#PatientMedicineTable').load();
                                        $('#myMedicinesModal').modal('show');
                                        
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                             }
                             
                     });   
                    
                }
            });    
    
}



function showReports(appointmentid){
    //fetchMedicinesByAppointmentId
    
    
         console.log(rootURL + '/fetchAppointmentSpecificTest/' + appointmentid);  
            $.ajax({
                type: 'GET',
                url: rootURL +  '/fetchAppointmentSpecificTest/' + appointmentid,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#PatientReportsTable tbody").remove();

                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    $('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                      
                            trHTML += '<tr><td>' + userDetails.testname   +'</td><td>' + userDetails.parametername  + 
                            '</td><td>' + userDetails.d + '</td></tr>';

                                          
                                    });    
                                  //   $('#listofpatients').hide();
                                  //  $('#prescriptionsearchpanel').show();
                                  //  $('#prescriptionpanel').hide();
                                     $('#patientHistoryPanel').show();
                                        $('#PatientReportsTable').append(trHTML);
                                        $('#PatientReportsTable').load();
                                        $('#myReportsModal').modal('show');
                                        
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                             }
                             
                     });   
                    
                }
            });    
    
}

function goBack(){
      $('#listofpatients').hide();
      $('#prescriptionsearchpanel').show();
     $('#prescriptionpanel').show();
    $('#patientHistoryPanel').hide();
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
    // console.log((datapass));
    // alert(datapass[5]);
     $('#hiddenpatientName').val(datapass[5]);  
    $('#hiddendoctorName').val(datapass[4]);
     $('#hidhospitalName').val(datapass[3]);
     $('#hiddendoctorId').val(datapass[7]);
     $('#hidhospitalId').val(datapass[6]);
      $('#hidappointmentDate').val(datapass[2]);
      $('#hidappointmentId').val(datapass[1]);
      $('#hiddenpatientId').val(datapass[0]);
      pregnancy  = datapass[8];
      child  = datapass[9];
      amount  = datapass[10];
      
      console.log("pregnancy......................"+pregnancy);
      console.log("child......................"+child);
      console.log("amount......................"+amount);
      if(pregnancy == "Y"){
          appointmentType = "P";
      }else if (child == "Y"){
          appointmentType = "C";
      }
      
      
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchAppointmentDoctorPrecritption/' + datapass[1]+"/"+datapass[7],
          dataType: "json",
          success: function(data){
              //console.log(data);
        	  //alert(data[0].nextappointmentdt);
        	 // $('#start').val(data[0].nextappointmentdt);
        	  $.each(data,function(key, value){
                      
                      
  				$('#doctorPrescription').append('<tr id="'+data[key].id+'"><td>'+data[key].medicinename+'</td><td>'+data[key].noofdays+'</td><td>'+data[key].totalcount+'</td></tr>');
  			
                  
                  
                  });
                    $('#listofpatients').hide();
                    $('#patientHistoryPanel').hide();
                    console.log(unescape(s));
                    $('#prescriptionpanel').show();
                                                                                                                                                                                                                                        /*
                                                                                                                                                                                                                                         *  $('#hiddenpatientName').val(datapass[5]);  
                                                                                                                                                                                                                                  $('#hiddendoctorName').val(datapass[4]);
                                                                                                                                                                                                                                   $('#hidhospitalName').val(datapass[3]);
                                                                                                                                                                                                                                   $('#hiddendoctorId').val(datapass[7]);
                                                                                                                                                                                                                                   $('#hidhospitalId').val(datapass[6]);
                                                                                                                                                                                                                                    $('#hidappointmentDate').val(datapass[2]);
                                                                                                                                                                                                                                    $('#hidappointmentId').val(datapass[1]);
                                                                                                                                                                                                                                    $('#hiddenpatientId').val(datapass[0]);
                                                                                                                                                                                                                                         */       

        if(appointmentType == "P")
         window.location.href = "doctorindex.php?page=pregnancyprescription&frompage=pregnancyprescription&patientid="+datapass[0]+"&patientname="+datapass[5]+"&doctorid="+datapass[7]+"&doctorname="+datapass[4]+"&appointmentid="+datapass[1]+"&hospitalid="+datapass[6]+"&hospitalname="+datapass[3]+"&appointmentdate="+datapass[2];//
        else if(appointmentType == "C")    
            window.location.href = "doctorindex.php?page=childprescription&frompage=childprescription&patientid="+datapass[0]+"&patientname="+datapass[5]+"&doctorid="+datapass[7]+"&doctorname="+datapass[4]+"&appointmentid="+datapass[1]+"&hospitalid="+datapass[6]+"&hospitalname="+datapass[3]+"&appointmentdate="+datapass[2];//
        else
            window.location.href=rootURL+"/Web/doctor/doctorindex.php?page=prescription&navigatefrom=fromAppointment&appointmentid="+datapass[1];
          
          }
      }); 
}




function showDetails(s){
  //  datapass = (unescape(s).split("$"));
  //  checkforAvailableData(datapass[1]);
    console.log("kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk");
      $('#listofpatients').hide();
       $('#patientHistoryPanel').hide();
     console.log(unescape(s));
    $('#prescriptionpanel').show();
//datatopass = 
//datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+
//userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+
//userDetails.HospitalId+"$"+userDetails.DoctorId;   
    
     datapass = (unescape(s).split("$"));    
    // console.log((datapass));
    // alert(datapass[5]);
     $('#hiddenpatientName').val(datapass[5]);  
    $('#hiddendoctorName').val(datapass[4]);
     $('#hidhospitalName').val(datapass[3]);
     $('#hiddendoctorId').val(datapass[7]);
     $('#hidhospitalId').val(datapass[6]);
      $('#hidappointmentDate').val(datapass[2]);
      $('#hidappointmentId').val(datapass[1]);
      $('#hiddenpatientId').val(datapass[0]);
      
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchAppointmentDoctorPrecritption/' + datapass[1]+"/"+datapass[7],
          dataType: "json",
          success: function(data){
              //console.log(data);
        	  //alert(data[0].nextappointmentdt);
        	  $('#start').val(data[0].nextappointmentdt);
        	  $.each(data,function(key, value){
                      
                      
  				$('#doctorPrescription').append('<tr id="'+data[key].id+'"><td>'+data[key].medicinename+'</td><td>'+data[key].noofdays+'</td><td>'+data[key].totalcount+'</td></tr>');
  			
                  
                  
                  });
          }
      }); 
}

