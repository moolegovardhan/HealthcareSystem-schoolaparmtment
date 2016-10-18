/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    
     $('#bthCheckDoctorConsultationUsers').click(function(){
       
       if($('#patientName').val() == "" && $('#patientid').val() == ""){
           $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");
           return false;
       }
       
     
          fetchDoctorAppointmentHomePatientList("Others",$('#patientName').val(),$('#patientid').val(),$('#hospital').val());
          //getAppointmentDetails($('#hosiptal').val(),$('#doctor').val(),appdate);
    });
    
});

function fetchDoctorAppointmentHomePatientList(profession,patientname,patientid,hosiptal){
    
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
                                   trHTML += '<tr><td>' + s + '</td><td>' + userDetails.name  +'</td><td>' + userDetails.email + '</td><td>' + userDetails.mobile + '</td><td><font color="blue"><a href="#" onclick=doctorClinicBookAppointment('+s+')>Book Appointment</a></font></td></tr>';
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

                 $('#adminDoctorErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminDoctorErrorBlock').show();
             });
         }
        
        
	});
}

function doctorCreateAppointment(slotTime){
   
    var fullDate = new Date();console.log(fullDate);
     var time = fullDate.getHours() + ":" + fullDate.getMinutes();
    var dateEntered = $('#appointmentdate').val();
   // alert((parseInt(fullDate.getMonth())+parseInt(1)));
   console.log("dateEntered....,,,,..."+dateEntered);
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

            //alert(checkForMyLeave(currentDate,$('#doctorid').val()));
            if( checkForMyLeave(dateEntered,$('#doctorid').val()) != "Fail")
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

            //alert(checkForMyLeave(currentDate,$('#doctorid').val()));
            if( checkForMyLeave(dateEntered,$('#doctorid').val()) != "Fail")
                 $('#enterAppointmentData').modal('show');
        }else{

            $('#generalMessage').html("Sorry Time Elapsed you cant book this slot. "+unescape(slotTime));
            $('#appointmentGeneralMessage').modal('show');

        }
        
    }
    
}


function checkForMyLeave(currDate,doctorid){
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


function doctorClinicBookAppointment(patientid){

   //alert($('#start').val()+patientid);
    if($('#start').val().indexOf(".") > 0){
     var appdt = ($('#start').val()).split(".");
     var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
 }else{ 
     var appdate = $('#start').val();
 } 
     //alert(appdate);
     pageFrom = GetPageParameter('page')
     DoctorClinicCreateAppointment($('#hosiptal').val(),$('#doctor').val(),appdate,patientid,$('#slot').val(),'N',"",$('#appointmenttype').val());
     
    if(pageFrom == ' ' || (pageFrom == undefined))
         window.location.replace(rootURL + '/Web/staff/staffindex.php');
    else if(pageFrom == 'appointment')
       window.location.replace(rootURL + '/Web/staff/staffindex.php?page=appointment');
   else if(pageFrom == 'createappointment')
       window.location.replace(rootURL + '/Web/staff/staffindex.php?page=appointment');
   else if(pageFrom == 'createAppointments')
       window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=createAppointments&appointmentDate='+$('#start').val());
       
 
}


function DoctorClinicCreateAppointment(hosiptal,doctor,appdate,pid,slot,status,pname,appointmenttype){
    
    var appointmentDetails = JSON.stringify( {"hosiptal" : hosiptal,"doctor" : doctor,"appdate" : appdate,"slot":slot,"pid" : pid,"status":status,"pname":pname,"appointmentType":appointmenttype } );
    console.log(appointmentDetails);
    console.log(rootURL + '/createAppointment');
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
                         alert("Info : "+responseMessageDetails.message);
                         $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message+" {Appointment ID :  "+responseMessageDetails.comments +" }" );
                         $('#adminStaffErrorBlock').show();
                      
                      }else{
                           alert("Error : "+responseMessageDetails.message);
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



function cancelDoctorAppointment(appointmentid){
    
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
        pageFrom = GetPageParameter('page') 
        if(pageFrom == 'createAppointments')
            window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=createAppointments');
          
    }
	});
   
}

function confirmDoctorAppointment(appointmentid){
    
    
    
       
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
        pageFrom = GetPageParameter('page'); 
        console.log('createAppointments'+pageFrom);
        if(pageFrom == 'createAppointments')
            window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=createAppointments&appointmentDate='+$('#start').val());
    }
	});
}
