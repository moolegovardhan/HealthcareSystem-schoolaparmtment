/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
     displayErrorResults();
     
       $('#hidpatientid').on('blur', function(){
        
         var patient = $('#hidpatientid').val();
         patientid = patient.substring(1,patient.length);
         
     });
       
     
     
    $('#bthCheckStaffConsultationUsers').click(function(){
     
          getCPatientList();
         //getAppointmentDetails($('#hosiptal').val(),$('#doctor').val(),appdate);
    });

 });

function getCPatientList(){
    
    
    if($('#chosiptal').val() == "HOSIPTAL"){
           $('#hosiptalerrormsg').html("Please Select Hosiptal");
          $('#starterrormsg').html("");
         $('#patienterrormsg').html("");
           return false;
        }
    else if($('#start').val() < 2){
           $('#starterrormsg').html("Please Enter Appointment Date");
         $('#hosiptalerrormsg').html("");
          $('#patienterrormsg').html("");
           return false;
        }
        else if(($('#cpatientName').val().length < 2) && $('#hidpatientid').val() == ""){
             $('#patienterrormsg').html("Please enter Patient Name or Patient Id");
             $('#starterrormsg').html("");
            $('#hosiptalerrormsg').html("");
           return false;
           
        }
  
       $('#starterrormsg').html("");
         $('#hosiptalerrormsg').html("");
     $('#patienterrormsg').html("");
     
    var patientname = $('#cpatientName').val();
    var hosiptal = $('#chosiptal').val();
    var appdt = ($('#start').val()).split('.');
    var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
    
         if(patientname != "")
            patientname = $('#cpatientName').val();
        else
            patientname = "nodata";
        if($('#patientid').val() != "")
            patientid = $('#patientid').val();
        else
            patientid = "nodata";
    
    
    console.log(rootURL + '/appointmentPatientList/' + patientname +'/'+patientid +'/'+appdate);
    $.ajax({
    type: 'GET',
    url: rootURL + '/appointmentPatientList/' + patientname +'/'+patientid +'/'+appdate,
    dataType: "json",
    success: function(data){
     console.log('authentic : ' + data)
     
     
       var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_consultation_records_table tbody").remove();

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
               
                    trHTML += '<tr><td>' + s + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                    '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                    + '</td><td><font color="blue"><i><a href="#" onclick=confirmappointment('+s+')>Confirm</a></font></i></td></tr>';
                            });
                            $('#patient_consultation_records_table').append(trHTML);
                             $('#patient_consultation_records_table').load();
                      }else{
                             $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             $('#adminStaffErrorBlock').show();
                      }
                 });
         
       
		},
        error: function(data){
           $('#errorlist').html("<font color='red'><b>  Sorry No Records Found.</b></font>");
        }
        
        
	});
}





function confirmappointment(appointmentid){
     displayErrorResults();
    var appointmentData = JSON.stringify( {"appointmentid" : appointmentid } );
    console.log(appointmentData);
    console.log(rootURL+'/updateAppointment/'+appointmentid);
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL+'/updateAppointment/'+appointmentid,
            dataType: "json",
            data :appointmentData,
            success: function(data, textStatus, jqXHR){
              	console.log('authentic success: ' + data);
         var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                         $('#adminStaffErrorBlock').show();
                      
                      }else{
                             $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             $('#adminStaffErrorBlock').show();
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

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });
            }
        });
    }
    

