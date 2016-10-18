/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
     displayErrorResults();
     getPresPatientList();
     
   $("#filepres").change(function(){
        readURL(this);
    });
    $('#conspatient').on('blur', function(){
        displayErrorResults();
        if($('#prescriptionpatientlist').val()){
            $('#listerror').html("Please select patient");
            return false;
        }
        
        //alert($('#conspatient').val());
       var patientId = $('#conspatient').val().split(":");
       var patient = patientId[0];
       $('#selectedpatient').val(patientId[1]);
       $("#appointmentId").val(patientId[2] );
       $('#patientdetails').html("<b><i>Patient Details : "+patientId[0]+" : "+patientId[1]+"</i></b>");
       
        console.log(rootURL +'/consultationPatientDetails/'+$.trim(patient.substring(1,patient.length)));
        $.ajax({
            type: 'GET',
            url: rootURL + '/consultationPatientDetails/'+$.trim(patient.substring(1,patient.length)),
            dataType: "json",
            success: function(data){
                 var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           console.log("Data List Length "+list.length);

           $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show();

                     consultationData = responseMessageDetails.data;

                     console.log("consultationData"+consultationData.length);
                     $.each(consultationData, function(index, consultation) {
                         
                        console.log(consultation); 
                        $("#preshosiptal").val(consultation.HOSPITALNAME);
                        $("#presdoctor").val(consultation.DOCTORNAME);
                        $("#appointmentDate").val(consultation.APPOINTEMENTDATE );
                         $("#hidpreshosiptalid").val(consultation.HOSIPTALID);
                        $("#hidpresdoctorid").val(consultation.DOCTORID);
                        $("#hidappointmentDate").val(consultation.APPOINTEMENTDATE );
                        //$("#appointmentId").val(consultation.ID );
                         $('#selectedpatientid').val(consultation.PATIENTID);
                     });
                      
                 }else{
                        $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                        $('#adminStaffErrorBlock').show();
                 }
            }); 
        
		},
        error: function(data){
          // $('#mainlisterrors').html("<font color='red'><b>  Sorry No Records Found.</b></font>");
        }
        
        
	});  
        
        
        
    });
    
     $('#btnStaffPrescription').click(function(){
        displayErrorResults();
        var patientDetails = $('#conspatient').val().split(":");
        var patientName = $.trim(patientDetails[1]);
        if(patientName.length < 2){
            $('#adminStaffErrorMessage').html("<font color='red'><b>  Please Select Patient Name and then proceed.</b></font>");
            $('#adminStaffErrorBlock').show();
            return false;
         }
        
         if($('#start').val().length < 2){
            $('#adminStaffErrorMessage').html("<font color='red'><b>  Please Enter Next Appointment Date.</b></font>");
            $('#adminStaffErrorBlock').show();
            return false;
         }
        
       // alert($('#presdescription').val());
        
        if($('#presdescription').val().length < 2){
            $('#adminStaffErrorMessage').html("<font color='red'><b>  Please Enter Description.</b></font>");
            $('#adminStaffErrorBlock').show();
            return false;
         }
         var patient = patientDetails[0];
       // $('#selectedpatient').val(patientName);
         $('#selectedpatientid').val($.trim(patient.substring(1,patient.length)));
        
    });
    
     $( "#presdiagnostics" ).change(function() {
         //alert("hello 1");
          testsForDiagnostics($( "#presdiagnostics" ).val());
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
                                     $('<option>').val("Others").text("Others").appendTo('#presdiagnosticstests');
                                     $.each(testData, function(index, testDetails) {
                                          $('<option>').val(testDetails.testid).text(testDetails.testname).appendTo('#presdiagnosticstests');
                                     });
                                 
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
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                              prescription = '<a href="#" onclick="showPopUpPrescription('+userDetails.appointmentid+')">Prescription</a>';          
                              reports = '<a href="#" onclick="showReports('+userDetails.appointmentid+')">Report</a>';
                              medicines = '<a href="#" onclick="showMedicines('+userDetails.appointmentid+')">Medicine</a>';
                            trHTML += '<tr><td>' + userDetails.AppointementDate   +'</td><td>' + userDetails.HospitalName  + 
                            '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.description + '</td><td>' + prescription  + '</td><td>' + reports
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



function getPresPatientList(){
    
    $.ajax({
    type: 'GET',
    url: rootURL + '/consultationPatientList',
    dataType: "json",
    success: function(data){
         var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           console.log("Data List Length "+list.length);

           $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                   // $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                   // $('#adminStaffErrorBlock').show();

                     consultationData = responseMessageDetails.data;

                     console.log("consultationData"+consultationData.length);
                     $.each(consultationData, function(index, consultation) {
                         
                          $("#prescriptionpatientlist").append("<option value='" +"P"+
                            consultation.PATIENTID+" : "+consultation.PATIENTNAME+" : "+"APT"+consultation.ID+"'></option>");
                       
                     
                     });
                      
                 }else{
                        $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                        $('#adminStaffErrorBlock').show();
                 }
            }); 
        
		},
        error: function(data){
          // $('#mainlisterrors').html("<font color='red'><b>  Sorry No Records Found.</b></font>");
        }
        
        
	});   
    
}

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
 