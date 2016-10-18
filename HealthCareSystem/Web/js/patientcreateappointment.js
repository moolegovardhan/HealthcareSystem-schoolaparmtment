/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
 
 displayErrorResults();
 
 $('#bthCheckAppointment').click(function() {
        
        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        $('#sloterrormsg').html("");
        $('#hosiptalerrormsg').html("");
        $('#doctorerrormsg').html("");
         $('#starterrormsg').html("");
         checkHospitalandDoctor();
          $("#records_table tbody").remove();
        getAppointmentDetails($('#hosiptal').val(),$('#doctor').val(),appdate);
        
    });
    
    
    $('#blockAppointment').click(function() {
        $('#patientcreateappointmenterrormsg').html("");
        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
           $('#sloterrormsg').html("");
            $('#hosiptalerrormsg').html("");
            $('#doctorerrormsg').html("");
             $('#starterrormsg').html("");
         //checkHospitalandDoctor();
         //alert(validateAppointment());
        if(validateAppointment())   
            createAppointment($('#hosiptal').val(),$('#doctor').val(),appdate,$('#pid').val(),$('#slot').val(),'N',$('#patientName').val());
        
    });
    
});


function checkHospitalandDoctor(){
    if($('#hosiptal').val() == "HOSIPTAL"){
           $('#hosiptalerrormsg').html("Please Select Hosiptal");
           return false;
        }
    if($('#doctor').val() == "DOCTOR"){
           $('#doctorerrormsg').html("Please Select Doctor");
           return false;
        }
}

function validateAppointment(){
   
       if($('#slot').val() == null){
           $('#sloterrormsg').html("Please Select Slot");
           return false;
        }
   else if($('#hosiptal').val() == "HOSIPTAL"){
           $('#hosiptalerrormsg').html("Please Select Hosiptal");
           return false;
        }
   else if($('#doctor').val() == "DOCTOR"){
           $('#doctorerrormsg').html("Please Select Doctor");
           return false;
        }
   else if($('#start').val() < 2){
           $('#starterrormsg').html("Please Enter Appointment Date");
           return false;
        }
    else
        return true;
}



function getAppointmentDetails(hosiptal,doctor,appdate){
    console.log(rootURL + '/appointmentsList/' + hosiptal +'/'+doctor +'/'+appdate);
    $.ajax({
    type: 'GET',
    url: rootURL + '/appointmentsList/' + hosiptal +'/'+doctor +'/'+appdate,
    dataType: "json",
    success: function(data){
        console.log('authentic success: ' + data);
         var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                         $('#adminStaffErrorBlock').show();

                          appointmentData = responseMessageDetails.data;

                          console.log("userData : "+appointmentData.length);
                          var trHTML = "";
                          $.each(appointmentData, function(index, appointmentDetails) {
                              var btst = "";
                              if(appointmentDetails.status == "Y")
                                      btst = "Completed";
                                else
                                     btst = "Not Done Yet";


                                     trHTML += '<tr><td>' + index + '</td><td>' + appointmentDetails.PatientName + '</td><td>' + appointmentDetails.AppointmentTime  +'</td><td>' + btst + '</td></tr>';
                        });
                           $('#records_table').append(trHTML);
                           $('#records_table').load(); 
                      }else{
                             $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             $('#adminStaffErrorBlock').show();
                      }
                 });
         
        
	/*		console.log('authentic success: ' + data)
            var list = data == null ? [] : (data.appointmentDetails instanceof Array ? data.appointmentDetails : [data.appointmentDetails]); 
         
    console.log((list).length );
             if((list).length < 1 ){
                 
                 $('#patientcreateappointmenterrormsg').html("<font color='red'><b> No Appointment Data found with given combination record .</b></font>");
                 //$('#errorblock').css("visibility") == "visible";
                 
              }
         var trHTML = '';
           $.each(list, function(index, appointmentDetails) {
               var btst = "";
               if(appointmentDetails.status == "Y")
                     btst = "Completed";
               else
                    btst = "Not Done Yet";
              
               
                    trHTML += '<tr><td>' + index + '</td><td>' + appointmentDetails.PatientName + '</td><td>' + appointmentDetails.AppointmentTime  +'</td><td>' + btst + '</td></tr>';
                
                // console.log(appointmentDetails.PatientName );
               
            });
             $('#records_table').append(trHTML);
            $('#records_table').load();*/
        },
        error: function(data){
           $('#patientcreateappointmenterrormsg').html("<font color='red'><b>  Sorry Network Issue Please try after some time.</b></font>");
        }
	});
    
}



function createAppointment(hosiptal,doctor,appdate,pid,slot,status,pname){
    
    var appointmentDetails = JSON.stringify( {"hosiptal" : hosiptal,"doctor" : doctor,"appdate" : appdate,"slot":slot,"pid" : pid,"status":status,"pname":pname } );
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
            $("#records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                         $('#adminPatientErrorBlock').show();
                      
                      }else{
                             $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             $('#adminPatientErrorBlock').show();
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

                 $('#adminPatientErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminPatientErrorBlock').show();
             });
         }
	});
    
}
