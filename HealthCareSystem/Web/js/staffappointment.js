/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
  
//alert(($('#start').val() != ""));
  
       displayErrorResults();
       
     $('#hidpatientid').on('blur', function(){
        
         var patient = $('#hidpatientid').val();
         patientid = patient.substring(1,patient.length);
         
     });
    
    $('#bthSearchStaffAppointmentUsers').click(function(){
        
        if($('#doctor').val() == "DOCTOR"){
             $('#staffdoctorerrormsg').html("Please Select Doctor Name");
            return false;
        }
        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        if(!($('#start').val() != "")){
            $('#staffapptpatientstartdt').html("Please Appointment Date");
            return false;
        }
        
        window.location.href = rootURL + "/Web/staff/staffindex.php?page=createappointment&doctorid="+$('#doctor').val()+'&appointmentdate='+appdate+'&doctorname='+$("#doctor option:selected").text();
    });
    
    
   /*    
    $('#bthSearchStaffAppointmentUsers').click(function(){
        //alert("hello");
        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        
            $('#staffdoctorerrormsg').html("");
        $('#staffhosiptalerrormsg').html("");
        $('#staffapptpatientname').html("");
         $('#staffapptpatientstartdt').html("");
       $('#staffsloterrormsg').html("");
         $('#staffapptpatientid').html("");
      
       //alert($('#patientName').val().length) ;
       //alert($('#hidpatientid').val());
        if(($('#patientName').val().length < 2) && $('#hidpatientid').val() == ""){
            $('#staffapptpatientname').html("Please enter Patient Name or Patient Id");
            return false;
        }
        if(($('#doctor').val() == "DOCTOR")){
            $('#staffdoctorerrormsg').html("Please Select Doctor Name");
            return false;
        }
        if(!($('#start').val() != "")){
            $('#staffapptpatientstartdt').html("Please Appointment Date");
            return false;
        }
        if($('#patientName').val() != "")
            patientname = $('#patientName').val();
        else
            patientname = "nodata";
          if($('#hidpatientid').val() != "")
            patientid = $('#hidpatientid').val();
        else
            patientid = "nodata";
       // alert(checkAvailability());
         if(checkAvailability() != "Fail"){
              getPatientList("Others",patientname,patientid);
             getAppointmentDetails($('#hosiptal').val(),$('#doctor').val(),appdate);
             fetchAppointmentSlots($('#doctor').val());
             
         }
    });
   */ 
 
 });

function fetchAppointmentSlots(doctorid){
    console.log("fetchAppointmentSlots"+rootURL + '/appointmentSlots/'+doctorid);
      $.ajax({
    type: 'GET',
    url: rootURL + '/appointmentSlots/'+doctorid,
    dataType: "json",
        success: function(data){
             console.log(data);
                var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
               console.log("list length : "+list.length);
               console.log("List : "+list);
                $.each(list, function(index, responseMessageDetails) {
  console.log("responseMessageDetailsssssssssssssssssssssss : "+responseMessageDetails);
                        if(responseMessageDetails.status == "Success"){
                           $("#slot option").remove();
                             slotData = responseMessageDetails.data;
                             
                             console.log("slotData : "+slotData);
                             
                             trHTML = "<option value='0' selected>-----Slot-----</option>";
                              $.each(slotData, function(index, slot) {
                                  slottime = escape(slot.slot);
                                   trHTML += '<option value='+slottime+'>'+slot.slot+'</option>';
                              });
                               $('#slot').append(trHTML);
                               $('#slot').load(); 
                        }
                          
                    });
        },
        error: function(data){
            console.log("Hellooooooo Errorrr");
        }
    });
}


function checkAvailability(doctorid,appdate){
    //date/doctorid
    var flag = "";
     $.ajax({
    type: 'GET',
    url: rootURL + '/checkForLeave/'+appdate+'/'+doctorid,
    dataType: "json",
        success: function(data){
             console.log(data);
                var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
               console.log(list.length);
                $.each(list, function(index, responseMessageDetails) {
                        console.log("responseMessageDetails.status"+responseMessageDetails.status);
                        if(responseMessageDetails.status == "Success"){
                            $('#adminStaffErrorMessage').html("Doctor is on leave on current day");
                            $('#adminStaffErrorBlock').show();
                                flag = responseMessageDetails.status;
                        }else
                             flag = responseMessageDetails.status;
                    });
        }
    });
    return flag;
}
function getPatientList(profession,patientname,patientid){
    
      displayErrorResults();
    //alert("Hello")
    console.log(rootURL + '/hospitalSpecifiPatientsDetails/' + profession +'/'+patientname+'/'+patientid);
    $.ajax({
    type: 'GET',
    url: rootURL + '/hospitalSpecifiPatientsDetails/' + profession +'/'+patientname+'/'+patientid,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                         $('#adminStaffErrorBlock').show();

                          userData = responseMessageDetails.data;

                          console.log("userData : "+userData.length);
                          var trHTML = "";
                          $.each(userData, function(index, userDetails) {
                              s = userDetails.ID;
                              s = userDetails.ID;
                                s = s.replace(/^0+/, '');
                                   trHTML += '<tr><td>' + s + '</td><td>' + userDetails.name  +'</td><td>' + userDetails.email + '</td><td>' + userDetails.mobile + '</td><td><font color="blue"><a href="#" onclick=staffBookAppointment('+s+')>Book Appointment</a></font></td></tr>';
                               });
                           $('#patient_records_table').append(trHTML);
                           $('#patient_records_table').load(); 
                      }else{
                             $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             $('#adminStaffErrorBlock').show();
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




function getAppointmentDetails(hosiptal,doctor,appdate){
     displayErrorResults();
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


function staffBookAppointment(patientid){
      displayErrorResults();
    var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        $('#staffdoctorerrormsg').html("");
        $('#staffhosiptalerrormsg').html("");
        $('#staffapptpatientname').html("");
         $('#staffapptpatientid').html("");
         $('#staffapptpatientstartdt').html("");
       $('#staffsloterrormsg').html("");
        pname = $('#patientName').val();
    if(validateAppointment())     
        staffCreateAppointment($('#hosiptal').val(),$('#doctor').val(),appdate,patientid,unescape($('#slot').val()),'N',pname);
    
}

function clearForm(){
      $('#slot').val("");
   $('#hosiptal').val("");
   $('#doctor').val("");
   $('#start').val("");
    $('#patientid').val("");
     $('#patientName').val("");
   
   
}


function validateAppointment(){
       if($('#slot').val() < 2){
           $('#staffsloterrormsg').html("Please Select Slot");
           return false;
        }
   else if($('#hosiptal').val() == "HOSIPTAL"){
           $('#staffhosiptalerrormsg').html("Please Select Hosiptal");
           return false;
        }
   else if($('#doctor').val() == "DOCTOR"){
           $('#staffdoctorerrormsg').html("Please Select Doctor");
           return false;
        }
   else if($('#start').val() < 2){
           $('#staffapptpatientstartdt').html("Please Enter Appointment Date");
           return false;
        }
    else
        return true;
}



function staffCreateAppointment(hosiptal,doctor,appdate,pid,slot,status,pname){
    
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
                         clearForm();
                         $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message+" {Appointment ID :  "+responseMessageDetails.comments +" }" );
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
