var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#adminCallCenterErrorBlock').hide();
    //
    $('#nonHCSCreateAppointment').click(function(){
        
       nonHCSCreateAppointment(); 
    });
    
     $("#fetchData").click(function(){
        console.log(rootURL);
        console.log(rootURL+ '/userDataDetails/' + $('#userId').val());
        
        $.ajax({
            type: 'GET',
            url: rootURL + '/userDataDetails/' + $('#userId').val(),
            dataType: "json",
            success: function(data){
                console.log('authentic success: ' + data);
                var list = data == null ? [] : (data.user instanceof Array ? data.user : [data.user]);
                console.log(list);
                console.log(list.length);
                 if((list).length < 1 ){

                     $('#errorlist').html("<font color='red'><b>  Invalid User Name and Password Combination </b></font>");
                     $('#errorblock').css("visibility") == "visible";

                  }
                else{
                    $.each(list, function(index, user) {
                        console.log(user.ID);
                        $('#name').val(user.name);
                        $('#email').val(user.email);
                        $('#Mobile').val(user.mobile);
                        $('#bday').val(user.dob);
                        $('#City').val(user.city);
                        $('#address1').val(user.address);
                        $('#userid').val(user.ID);
                    });

                }



            },
            error: function(data){
               $('#errorlist').html("<font color='red'><b>  Unable to login to System Please contact System Admin.</b></font>");
                     $('#errorblock').css("visibility") == "visible";
            }
        });
        
     });   
    
    
    
    $("#Verify").click(function(){
        console.log(rootURL);
        console.log(rootURL+ '/userDetails/' + $('#userId').val());
        
        $.ajax({
            type: 'GET',
            url: rootURL + '/userDetails/' + $('#userId').val(),
            dataType: "json",
            success: function(data){
                console.log('authentic success: ' + data);
                var list = data == null ? [] : (data.user instanceof Array ? data.user : [data.user]);
                console.log(list);
                console.log(list.length);
                 if((list).length < 1 ){

                     $('#errorlist').html("<font color='red'><b>  Invalid User Name and Password Combination </b></font>");
                     $('#errorblock').css("visibility") == "visible";

                  }
                else{
                    $.each(list, function(index, user) {
                        console.log(user.ID);
                        $('#name').val(user.name);
                        $('#email').val(user.email);
                        $('#Mobile').val(user.mobile);
                        $('#bday').val(user.dob);
                        $('#City').val(user.city);
                        $('#address1').val(user.addressline1);
                        $('#userid').val(user.ID);
                    });

                }



            },
            error: function(data){
               $('#errorlist').html("<font color='red'><b>  Unable to login to System Please contact System Admin.</b></font>");
                     $('#errorblock').css("visibility") == "visible";
            }
        });
        
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchUserSpecificRequests/' + $('#userId').val(),
            dataType: "json",
            success: function(data){
                console.log('authentic success: ' + data);
                var list = data == null ? [] : (data.user instanceof Array ? data.user : [data.user]);
                console.log(list);
                console.log(list.length);
          
            $("#user_specific_request_table tbody").remove();
                 $.each(data.responseMessageDetails.data, function(index, responseMessageDetails) {
                     userData = data.responseMessageDetails.data;
                     console.log("userData : "+userData);
                      var trHTML = "";
                     if(userData != ""){ 
                     if(userData.length > 0) {    
                     $.each(userData, function(index, userDetails) {
                             trHTML += "<tr><td>" + userDetails.receiptid + "</td><td>" + userDetails.createddate  +"</td>\n\
                                <td>" + userDetails.fk_RequestType  +"</td>\n\
                                        <td>" + userDetails.Text + "</td><td>" + userDetails.status + "</td></tr>";
                         });
                     }else{
                       trHTML += '<tr><td colspan="4"><center><font color="blue"><center> Sorry No Data Found  </center<</font></center></td></tr>';   
                     }   
                     $('#user_specific_request_table').append(trHTML);
                     $('#user_specific_request_table').load(); 
                 } else{
                      $('#adminPatientErrorMessage').html(" No Data Found. Please refine your search Criteria");
                       $('#adminPatientErrorBlock').show();
                 }
                     
                });
            },
            error: function(data){
               $('#errorlist').html("<font color='red'><b>  Unable to login to System Please contact System Admin.</b></font>");
                     $('#errorblock').css("visibility") == "visible";
            }
        }); 

    });

    $('#btnSubmitMemberRequest').click(function(){
   
     var memberRequestDetails = JSON.stringify( {"userId" : $('#userId').val(),"requestMessage" : $('#memberRequest').val(), "requestType":$('#memberRequestType').val(),"requestby":"callcenter","mobile":$('#Mobile').val(),"name":$('#name').val()} );
     console.log(memberRequestDetails);
     $.ajax({
                type: 'POST',
                contentType: 'application/json',
                url: rootURL + '/registerMemberRequest',
                dataType: "json",
                data:  memberRequestDetails,
                success: function(data){
                    console.log($('#Mobile').val());
                   
                    var message = "Submited Request Successfully.Thanks for contacting CGS HCS. Concerned staff will reach out to you soon.Request Id:"+data.responseMessageDetails.comments;
                         var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+$('#Mobile').val()+"&text="+message+"&priority=ndnd&stype=normal";

                            $.post(url, function(data){
                                    //Need to show some message if we get response from the SMS api.
                                    //Currently we are just sending Message after Signup
                            });
                        $('#adminCallCenterErrorMessage').html("<b>Info : User Request Submitted Successfully.  Request Id</b>"+data.responseMessageDetails.comments);
                         $('#adminCallCenterErrorBlock').show();
                            
                        },
                error: function(data){

                }

        });

    });
    
  $('#nbtnSubmitMemberRequest').click(function(){
    //alert($('#requestMessage').val());
     var memberRequestDetails = JSON.stringify( {"requestMessage" : $('#nmemberRequest').val(), 
         "requestType":$('#nmemberRequestType').val(),"name" : $('#nname').val(),"mobile" : $('#nmobile').val()
     ,"email" : $('#nemail').val(),"city" : $('#ncity').val(),"address" : $('#naddress1').val()} );
     console.log(memberRequestDetails);
     $.ajax({
                type: 'POST',
                contentType: 'application/json',
                url: rootURL + '/registerNonMemberRequest',
                dataType: "json",
                data:  memberRequestDetails,
                success: function(data){
                    var message = "Submited Request Successfully.Thanks for contacting CGS HCS. Concerned staff will reach out to you soon.Request Id:"+data.responseMessageDetails.comments;
                    var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                                           +$('#Mobile').val()+"&text="+message+"&priority=ndnd&stype=normal";

                       $.post(url, function(data){
                               //Need to show some message if we get response from the SMS api.
                               //Currently we are just sending Message after Signup
                       });
                       
                        $('#adminCallCenterErrorMessage').html("<b>Info : User Request Submitted Successfully. Request Id : </b>"+data.responseMessageDetails.comments);
                         $('#adminCallCenterErrorBlock').show();
                              $('#nname').val("");
                            $('#nemail').val("");
                            $('#nmobile').val("");
                            $('#nbday').val("");
                            $('#ncity').val("");
                            $('#naddress').val("");
                            $('#nmessage').val("");
                        },
                error: function(data){

                }

        });

    });
    
    $('#hospital').change( function(){
            if($('#hospital').val() != "HOSPITAL")
              fetchDoctorsForHospital($('#hospital').val());
        });
        
        
        
         $('#btnDoctorTimings').click( function(){
      
      if($('#hospital').val() == "HOSPITAL"){
          $('#staffhospitalerrormsg').html("Please Select Hosiptal");
          return false;
      }
      doctorid = "nodata";
      if($('#doctor').val() != "DOCTOR"){
          doctorid = $('#doctor').val();
      }
          
      
       console.log( rootURL + '/fetchDoctorTimings/' + $('#hospital').val() +'/'+ doctorid);
     $.ajax({
            type: 'GET',
            url: rootURL + '/fetchDoctorTimings/' + $('#hospital').val() +'/'+ doctorid ,
            dataType: "json",
            success: function(data){
                
                console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            console.log("Data List Length "+list.length);
            $("#doctor_timings tbody").remove();
          
                $.each(list, function(index, responseMessageDetails) {
                     userData = responseMessageDetails.data;
                     console.log("userData : "+userData);
                      var trHTML = "";
                     if(userData != ""){ 
                     if(userData.length > 0) {    
                     $.each(userData, function(index, userDetails) {
                               gotoNextScreen = escape(userDetails.ID);
                             trHTML += "<tr onclick='callDoctorAppointmentSlots("+gotoNextScreen+")'><td>" + userDetails.ID + "</td><td>" + userDetails.name  +"</td><td>" + userDetails.starttime + "</td><td>" + userDetails.endtime + "</td></tr>";
                         });
                     }else{
                       trHTML += '<tr><td colspan="4"><center><font color="blue"><center> Sorry No Data Found  </center<</font></center></td></tr>';   
                     }   
                     $('#doctor_timings').append(trHTML);
                     $('#doctor_timings').load(); 
                 } else{
                      $('#adminPatientErrorMessage').html(" No Data Found. Please refine your search Criteria");
                       $('#adminPatientErrorBlock').show();
                 }
                     
                });

                    
            }
     });
      });
    $('#bthCheckStaffHomeConsultationUsers').click(function(){
       
       if($('#patientName').val() == "" && $('#patientid').val() == ""){
           $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");
           return false;
       }
       
     
          getAppointmentHomePatientList("Others",$('#patientName').val(),$('#patientid').val(),$('#hospital').val());
          //getAppointmentDetails($('#hosiptal').val(),$('#doctor').val(),appdate);
    });
    
    $('#submitPatientCardDetails').click( function(){
        
        console.log($('#pcardtype').val());
        console.log($('#pcardamount').val());
        console.log($('#psalesperson').val());
        console.log(console.log($('#ppatientid').val()));
         var patientData = JSON.stringify( {"patientId" : $('#ppatientid').val(),"cardType" : $('#pcardtype').val(),"cardAmount" : $('#pcardamount').val(),"salesPerson" : $('#psalesperson').val()} );
        
        console.log(patientData);
        console.log(rootURL + '/updatePatientCardDetails');
        
        console.log(rootURL + '/updatePatientCardDetails');
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL + '/updatePatientCardDetails',
            dataType: "json",
            data:  patientData,
            success: function(data, textStatus, jqXHR){
                        console.log('authentic success: ' + data);
                        
                             window.location.href = rootURL+"/Web/callcenter/callcenterindex.php?page=carddistribution&start=0&end=15";                   
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
    });
    
    
    $('#submitPatientPaymentDetails').click( function(){
        
        console.log($('#pcardtype').val());
        console.log($('#pcardamount').val());
        console.log($('#psalesperson').val());
        console.log(console.log($('#ppatientid').val()));
         var patientData = JSON.stringify( {"patientId" : $('#ppatientid').val(),"cardAmount" : $('#pcardamount').val(),"officeid" : "Callcenter","insttype":"Callcenter"} );
        
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
                      window.location.href = rootURL + "/Web/callcenter/callcenterindex.php?page=payments&start=0&end=100&patientname="+patientname;
                  }else
                      window.location.href = rootURL + "/Web/callcenter/callcenterindex.php?page=payments";

    });
    
    
    $( "#pcardtype" ).change(function() {
        if( $( "#pcardtype" ).val() == "SilverFamily")
            $('#showfamily').show();
        else
            $('#showfamily').hide();
      });

});


function fetchDoctorsForHospital(hospitalid){
    //fetchHospitalSpecificDoctorList
    
    console.log(rootURL + '/fetchHospitalSpecificDoctorList/' + hospitalid);
        $.ajax({
                type: 'GET',
                url: rootURL + '/fetchHospitalSpecificDoctorList/' + hospitalid,
                dataType: "json",
                success: function(data){
                     console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#doctor option").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                              //    $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                              //    $('#adminPatientErrorBlock').show();
                                  doctorData = responseMessageDetails.data;
                                     console.log("doctorData : "+doctorData.length);
                                     var trHTML = "";
                                    strtext = 'DOCTOR'
                                     $('<option>').text(strtext).appendTo('#doctor');
                                     $.each(doctorData, function(index, data) {
                                          $('<option>').val(data.ID).text(data.name).appendTo('#doctor');
                                     });
                                 
                                }
                            });        
                }
            });  
    
}




function callDoctorAppointmentSlots(data){
    datatoSplit = unescape(data).split("$");
    doctorName = datatoSplit[1];
    doctorId = datatoSplit[0];
    //doctorName = $("#doctor option:selected").text();
    hospitalName = $("#hospital option:selected").text();
    //doctorId = $('#doctor').val();
    hospitalId = $('#hospital').val();
     var appdt = ($('#start').val()).split('.');
    var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
    appointmentdate = appdate;
    $('#staffhospitalerrormsg').html(" ");
    $('#staffdoctorerrormsg').html(" ");
    $('#starterrormsg').html(" ");
    
   //alert(hospitalId+","+doctorId+","+appointmentdate);
    if(hospitalId == "HOSPITAL"){
        $('#staffhospitalerrormsg').html("Please Select Hosiptal");
        return false;
    }
     if(doctorId == "DOCTOR"){
        $('#staffdoctorerrormsg').html("Please Select Doctor");
        return false;
    }
     if(appdt == ""){
        $('#starterrormsg').html("Please enter Appointment Date");
        return false;
    }
    
     window.location.href = rootURL + "/Web/callcenter/callcenterindex.php?page=viewDoctorAppointments&doctorid="+doctorId+'&appointmentdate='+appointmentdate+'&hospital='+hospitalId+'&doctorname='+doctorName+'&hospitalname='+hospitalName;
}

function bookAppointment(slotTime){
   
    var fullDate = new Date();console.log(fullDate);
     var time = fullDate.getHours() + ":" + fullDate.getMinutes();
    var dateEntered = $('#appointmentdate').val();
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
    /*if(fullDate > dateToCompare){
         $('#generalMessage').html("Sorry you cant book appointment for old dates");
        $('#appointmentGeneralMessage').modal('show');
    }else */// if((fullDate < dateToCompare)){
        
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
            //$('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");

             $('#slot').val(unescape(slotTime));
             $('#start').val(dateEntered);
            $('#currdate').html(dateEntered+" <b> Time : </b> "+unescape(slotTime));

            //alert(checkForLeave(currentDate,$('#doctorid').val()));
            if( checkForLeave(dateEntered,$('#doctorid').val()) != "Fail")
                 $('#enterAppointmentData').modal('show');
      
   // } else {
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
          //  $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");

             $('#slot').val(unescape(slotTime));
             $('#start').val(currentDate);
            $('#currdate').html(currentDate+" <b> Time : </b> "+unescape(slotTime));

            //alert(checkForLeave(currentDate,$('#doctorid').val()));
            if( checkForLeave(currentDate,$('#doctorid').val()) != "Fail")
                 $('#enterAppointmentData').modal('show');
        }/*else{
            
            $('#generalMessage').html("Sorry Time Elapsed you cant book this slot. "+unescape(slotTime));
            $('#appointmentGeneralMessage').modal('show');

        }*/
        
   // }
    
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
 
 appointmentType = $('#appointmenttype').val();
 console.log("appointmentType..................."+appointmentType);
     //alert(appdate);
    // pageFrom = GetPageParameter('page')
     staffHomeCreateAppointment($('#hospital').val(),$('#doctor').val(),appdate,patientid,$('#slot').val(),'N',"",appointmentType);
alert("Appointment Created Successfully");
  
       window.location.replace(rootURL + '/Web/callcenter/callcenterindex.php?page=appointment');
       
 
}



function staffHomeCreateAppointment(hosiptal,doctor,appdate,pid,slot,status,pname,appointmentType){
    
    var appointmentDetails = JSON.stringify( {"hosiptal" : hosiptal,"doctor" : doctor,"appdate" : appdate,"slot":slot,"pid" : pid,"status":status,"pname":pname,"appointmentType":appointmentType } );
   //alert(appointmentDetails);
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
                    alert(list);
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


function nonHCSCreateAppointment(){
    
    if($('#hospital').val() == 'HOSPITAL' && $('#hospitalname').val() != ""){
     hospitalname = $('#hospitalname').val(); 
     hospital = "-";
    }
    if($('#hospital').val() != 'HOSPITAL'){
       hospitalname = "-"; 
       hospital = $('#hospital').val();  
    }
    if($('#doctor').val() == 'DOCTOR' && $('#doctorname').val() != ""){
     doctorname = $('#doctorname').val(); 
     doctor = "-";
    }
    if($('#doctor').val() != 'DOCTOR'){
       doctorname = "-"; 
       doctor = $('#doctor').val();  
    }
     if($('#appointmenttype').val() == 'nodata'){
        
        alert("Please select appointment type");
        return false;
    }
    if($('#start').val() == ""){
        alert("Please select appointment date");
        return false;
    }else{
       app =  $('#start').val();
       applist = app.split(".");
       appdate = applist[2]+"-"+applist[1]+"-"+applist[0];
    }
    
    
    status = "Y";
    slot = "00:00-00:00";
    var appointmentDetails = JSON.stringify( {"hospitalname":hospitalname,"doctorname":doctorname,"hosiptal" : hospital,"doctor" : doctor,
        "appdate" : appdate,"slot":slot,"pid" : $('#userid').val(),"status":status,"pname":$('#name').val(),"appointmentType":$('#appointmenttype').val() } );
   //alert(appointmentDetails);
    console.log(appointmentDetails);
    console.log(rootURL + '/createNonHCSAppointment');
    $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: rootURL + '/createNonHCSAppointment',
    dataType: "json",
    data:  appointmentDetails,
    success: function(data, textStatus, jqXHR){
		console.log('authentic success: ' + data);
         var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            //$("#records_table tbody").remove();

                console.log("Data List Length "+list.length);
                    alert(list);
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

function editDetails(id,cardtype,cardamount,salesperson){
    console.log('Hellooooo');
    $('#ppatientid').val(id);
    $('#pcardtype').val();
    $('#pcardamount').val();
    $('#psalesperson').val();   
    $('#showfamily').hide();
    $('#myPatientCardDetails').modal('show');
    
    
}

function editPaymentDetails(id){
    console.log('Hellooooo');
    $('#ppatientid').val(id); 
    $('#myPatientPaymentDetails').modal('show');
    
    
}
