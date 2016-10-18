/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    displayErrorResults();
    $('#errorBlock').hide();
     $('#counter').val(0);
    
     $("#othermobile").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
           //display error message
           $("#mobileerrormessages").html("Digits Only").show().fadeOut("slow");
            $('#mobileerrormessages').show().fadeOut("slow");
                  return false;
       }
   });
    
    $('#othername').bind('keypress', function (e) {
           
            var valid = (e.which == 32 || e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122);
            if (!valid) {
                e.preventDefault();
            }

            var valid = (e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122 || e.which == 32 || e.which == 95 || e.which == 8);
            if (!valid) {
                e.preventDefault();
            }
            console.log(valid);
      }); 
    $('#updateprofile').click(function() {
      displayErrorResults();
       
       var sEmail = $('#email').val();
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!filter.test(sEmail))  {
             $("#emailErrmsg").html("Invalid Email Address").show();
            return false;
        }
      
      if(registerFormValidate()){ 
       
       var appdate = "";
       if($('#start').val().indexOf(".") > 0){
            appdt = ($('#start').val()).split('.');
            appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
           
       }else
           appdt = ($('#start').val());
       
        if($('#address2').val().length < 1)
        {
            addressline2 = " ";
        }else
            addressline2 = $('#address2').val();
       
      // alert("App Date : "+appdt);
       updateProfile($('#newuser').val(),$('#newuserpassword').val(),$('#email').val(),$('#mobile').val(),$('#profession').val(),$('#address1').val(),$('#name').val(), addressline2, $('#district').val(), $('#state').val(), $('#mname').val(),$('#lname').val(), $('#zipcode').val(), appdate, $('#gender').val(),  $('#aadharcard').val(),  $('#city').val(),  $('#altmobile').val(),  $('#landline').val());
       
       return false;
      }
       
    });
   $("#patient_health_parameters").hide();
   $('#patientParametersHistory').click( function(){
       healthParametersHistory();
       $("#patient_health_parameters").show();
   }); 
  healthParameters();
  
  $('#hospital').change( function(){
      if($('#hospital').val() != "HOSPITAL")
        fetchDoctorsForHospital($('#hospital').val());
  });
  
$('#bthSearchStaffAppointmentUsers').click(function(){
        
        
        if(validateSearchFields()){
            fetchDoctorsBasedonSearchCriteria();
        }
        
       
       //alert("Hospital "+$("#hospital option:selected").text());
      //  window.location.href = rootURL + "/Web/patient/patientindex.php?page=createappointment&doctorid="+$('#doctor').val()+'&appointmentdate='+appdate+'&hospital='+$('#hospital').val()+'&doctorname='+$("#doctor option:selected").text()+'&hospitalname='+$("#hospital option:selected").text();
    });  
  
  
  $('#bthCheckStaffHomeConsultationUsers').click(function(){
       
       
          getAppointmentHomePatientList("Others",$('#patientName').val(),$('#patientid').val(),$('#hospital').val());
          //getAppointmentDetails($('#hosiptal').val(),$('#doctor').val(),appdate);
    });
  
  
  
$('#addPatientGeneralParameters').click( function(){
    paramname = "nodata";
    paramvalue = "nodata";
    generalinfo = "nodata";
    paramname = (($('#paramname').val() == "") ? "nodata" : $('#paramname').val() );
    paramvalue = (($('#paramvalue').val() == "") ? "nodata" : $('#paramvalue').val() );
    generalinfo = (($('#observation').val() == "") ? "nodata" : $('#observation').val() );
    
    if( (paramname == "") && (paramvalue == "") && (generalinfo == "")){
        
        alert("Please enter data atleast in one field"); return false;
    }
    if(((paramname == "") && (paramvalue != "") )|| ((paramname != "") && (paramvalue == "") ) ){
        
        alert("If parameter name is entered value must also be entered or vise versa"); return false;
    }
    
    data = paramname+"$"+paramvalue+"$"+generalinfo;
    
     count = parseInt($('#counter').val())+1;
     
     createHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + paramname + '</td><td>' + paramvalue + '</td><td>' + generalinfo + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#paramname').val("");
      $('#paramvalue').val("");
      $('#observation').val("");
       $('#patient_general_info_table').append(trHtml);
       $('#patient_general_info_table').load();
    
});
  
  $('#hospital').change( function(){
      hospitalid = $('#hospital').val();
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
                                    strtext = '- Doctor Name -'
                                     $('<option>').val("DOCTOR").text(strtext).appendTo('#doctor');
                                     $.each(doctorData, function(index, data) {
                                          $('<option>').val(data.ID).text(data.name).appendTo('#doctor');
                                     });
                                 
                                }
                            });        
                }
            });  
   
      
  });
  //fetchDoctorNamesBasedonHosiptalName
  
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
                     
                             trHTML += '<tr><td>' + userDetails.ID + '</td><td>' + userDetails.name  +'</td><td>' + userDetails.starttime + '</td><td>' + userDetails.endtime + '</td></tr>';
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
  
  $('#searchFriend').click( function (){
      //fetchPatientList
      
      $.ajax({
            type: 'GET',
            url: rootURL + '/fetchDoctorsBasedOnSearchCriteria/' + hospital +'/'+ doctor +'/'+ address +'/'+ zipcode +'/'+ district +'/'+ department +'/'+city,
            dataType: "json",
            success: function(data){
                
                console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            console.log("Data List Length "+list.length);
            $("#doctor_search_result_data tbody").remove();
          
                $.each(list, function(index, responseMessageDetails) {
                     userData = responseMessageDetails.data;
                     console.log("userData : "+userData);
                      var trHTML = "";
                     if(userData != ""){   
                     $.each(userData, function(index, userDetails) {
                       /* s = userDetails.ID;
                        s = userDetails.ID;
                          s = s.replace(/^0+/, '');
                        */
                       
                       dataToPass = escape(userDetails.doctorid+"$"+userDetails.hospitalid+"$"+userDetails.doctorname+"$"+userDetails.hospitalname+"$"+appdate);
                       
                             trHTML += '<tr><td>' + userDetails.doctorname + '</td><td>' + userDetails.hospitalname  +'</td><td>' + userDetails.starttime + '</td><td>' + userDetails.endtime + '</td><td><font color="blue"><a href="#" onclick=patientShowAppointmentSlots("'+dataToPass+'")>Book Appointment</a></font></td></tr>';
                         });
                         
                     $('#doctor_search_result_data').append(trHTML);
                     $('#doctor_search_result_data').load(); 
                     $('#mySearchResult').modal('show');
                 } else{
                      $('#adminPatientErrorMessage').html(" No Data Found. Please refine your search Criteria");
                       $('#adminPatientErrorBlock').show();
                 }
                     
                });

                    
            }
     });
  });
  
  
   $('#quickregister').click(function() {
       $('#showprocessing').show();
        $('#errorDisplay').html("  ");
            
            var sEmail = $('#email').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
           if(sEmail.length > 1)  {
             if (!filter.test(sEmail))  {
                   $("#errorDisplay").html("Please enter email address or invalid email address").show();
                    $('#errormessages').show();
                 return false;
             }
           }
           
       
       
        if(registerPatientFamilyQuickFormValidate()){
            console.log("In if condition validation success ");
           // clearValidationMessage()
            checkPatientFamilyQuickUserId($('#mobile').val());
           }else{
               $('#showprocessing').hide();
               console.log("In else ");
               $('#errormessages').show();
           } 

        var flag = "";
       
    });
  
});

function registerPatientFamilyQuickNewUser(){
    
     registerQuickUser($('#mobile').val(),$('#qpassword').val(),$('#email').val(),$('#mobile').val(),'Others',$('#name').val());


}

function checkPatientFamilyQuickUserId(userId){
    
console.log("user Id "+userId);
  $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/checkUserId/' + userId,
        dataType: "json",
        success: function(data, textStatus, jqXHR){

            var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);

            console.log("In check User Id"+(list).length);
            console.log(list);
            
            $.each(list, function(index, responseMessageDetails) {
                var message = responseMessageDetails.message;
               if(message.indexOf("]:") > 0)
                  message = message.substring(0,message.indexOf("]:")+2);
                if(responseMessageDetails.status == "Success"){
                    console.log("Data length : "+responseMessageDetails.data.length);
                    if(message.indexOf("User Exists") > 0){
                         $('#errorDisplay').html(message);
                         $('#errormessages').show()
                    }else{
                        
                        
                        registerPatientFamilyQuickNewUser();
                        
                        
                    }
                    
                }else if(responseMessageDetails.status == "Fail"){
                   $('#errorDisplay').html(responseMessageDetails.message);
                   $('#errormessages').show();
                    $('#showprocessing').hide();
                }else {
                    $('#errorDisplay').html("Sorry Intermittent Error. Please try after some time");
                    $('#errormessages').show();
                     $('#showprocessing').hide();
                }
                
                
            });
          
        },
        error: function(data){
               var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#errorDisplay').html("<font color='red'><b>"+message+"</b></font>");
                 $('#errormessages').show()
             });
        }
    });

    
}

   function registerPatientFamilyQuickFormValidate(){
    console.log("validation");
    clearValidationMessage();
    if($('#mobile').val() == ""){
        console.log("new user");
        $('#errorDisplay').html("Please enter Mobile Number"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        $('#showprocessing').hide();
        return false;
    }
    if($('#mobile').val().length < 10){
         console.log("new user less then 10");
        $('#errorDisplay').html("Mobile Number Minimum length is 10"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
         $('#showprocessing').hide();
        return false;
    }
     if($('#qpassword').val() == ""){
          console.log("password");
        $('#errorDisplay').html("Please enter password"); 
         $('#qpassword').attr('style', 'background-color: #FBFAC9');
          $('#showprocessing').hide();
        return false;  
    }
    if($('#qpassword').val().length < 5){
         console.log("pass les then 5");
        $('#errorDisplay').html("Password Minimum length is 5"); 
         $('#qpassword').attr('style', 'background-color: #FBFAC9');
          $('#showprocessing').hide();
        return false;  
    }
   // alert("Hello");
     if($('#name').val().length < 1){
         console.log("name");
        $('#errorDisplay').html("Please enter name"); 
        $('#name').attr('style', 'background-color: #FBFAC9');
         $('#showprocessing').hide();
        return false;
    }
    /*
     if($('#email').val().length < 1){
          console.log("email");
        $('#errorDisplay').html("Please enter email");  
        $('#email').attr('style', 'background-color: #FBFAC9');
        return false; 
    }*/
     if($('#mobile').val().length < 1){
          console.log("mobile");
        $('#errorDisplay').html("Please enter mobile #"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
         $('#showprocessing').hide();
        return false;
    }
    
    
   return true;
}

function createHiddenDiv(data,count){
      console.log("in create div");
        var newTextBoxDiv = $(document.createElement('div'))
                 .attr("id", 'newTextBoxDiv' + count);

       console.log(" newTextBoxDiv : "+newTextBoxDiv);

            newTextBoxDiv.after().html('<label>Textbox #'+ count + ' : </label>' +
                            '<input type="text" name="textbox' + count + 
                  '" id="textbox' + count + '" value="'+data+'" >');

            newTextBoxDiv.appendTo("#generaldiv");


            $('#counter').val(count);
}

function deleteGeneralData(rowData){
   console.log("In Delete"+rowData);
   try{
        row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
        
          $("#newTextBoxDiv" + rowData).remove();
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function editGeneralData(rowData){
   console.log("In edit"+rowData);
   try{
          console.log($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         console.log(" dataToEdit :"+dataToEdit);
         var splitDataToEdit = dataToEdit.split("$");
         console.log(" splitDataToEdit :"+splitDataToEdit);
         
     $('#paramname').val((splitDataToEdit[0] == "nodata" ? "" : splitDataToEdit[0]));
    $('#paramvalue').val((splitDataToEdit[1] == "nodata" ? "" : splitDataToEdit[1]));
    $('#observation').val((splitDataToEdit[2] == "nodata" ? "" : splitDataToEdit[2])); 
    
    $("#newTextBoxDiv" + rowData).remove();
      row = document.getElementById(rowData) ;
      console.log("row :"+row);
      (row).parentNode.removeChild(row);
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}

function callDoctorAppointmentSlots(){
    doctorName = $("#doctor option:selected").text();
    hospitalName = $("#hospital option:selected").text();
    doctorId = $('#doctor').val();
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
    
        
    console.log(doctorId);
     console.log(hospitalId);
      console.log(appointmentdate);
      
      console.log(hospitalName);
     window.location.href = rootURL + "/Web/patient/patientindex.php?page=viewDoctorAppointments&doctorid="+doctorId+'&appointmentdate='+appointmentdate+'&hospital='+hospitalId+'&doctorname='+doctorName+'&hospitalname='+hospitalName;
}


function patientShowAppointmentSlots(data){
  
    appointmentdata = unescape(data);
    arrayresult = appointmentdata.split("$");
   //userDetails.doctorid+"$"+userDetails.hospitalid+"$"+userDetails.doctorname+"$"+userDetails.hospitalname+"$"+appdate);
   console.log("arrayresult : "+arrayresult);                    
   window.location.href = rootURL + "/Web/patient/patientindex.php?page=createappointment&doctorid="+arrayresult[0]+'&appointmentdate='+arrayresult[4]+'&hospital='+arrayresult[1]+'&doctorname='+arrayresult[2]+'&hospitalname='+arrayresult[3];
}


function  fetchDoctorsBasedonSearchCriteria(){
     hospital = (($('#hospital').val() == "HOSPITAL")?"nodata":$('#hospital').val());
     doctor = (($('#doctor').val() == "")? "nodata" :$('#doctor').val());
     zipcode = (($('#zipcode').val() == "")? "nodata" :$('#zipcode').val());
     address = (($('#address').val() == "")? "nodata" :$('#address').val());
     city = (($('#city').val() == "")? "nodata" :$('#city').val());
     district = (($('#district').val() == "DISTRICT")? "nodata" :$('#district').val());
     department = (($('#department').val() == "")? "nodata" :$('#department').val());
   //($hospital,$doctor,$address,$zipcode,$district,$department,$city) 
  // = (($('#city').val() == "")? "nodata" :$('#city').val());
   // appointmentdate = $('#start').val() == "";
     var appdt = ($('#start').val()).split('.');
    var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
    console.log(appdate);
    console.log( rootURL + '/fetchDoctorsBasedOnSearchCriteria/' + hospital +'/'+ doctor +'/'+ address +'/'+ zipcode +'/'+ district +'/'+ department +'/'+city);
     $.ajax({
            type: 'GET',
            url: rootURL + '/fetchDoctorsBasedOnSearchCriteria/' + hospital +'/'+ doctor +'/'+ address +'/'+ zipcode +'/'+ district +'/'+ department +'/'+city,
            dataType: "json",
            success: function(data){
                
                console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            console.log("Data List Length "+list.length);
            $("#doctor_search_result_data tbody").remove();
          
                $.each(list, function(index, responseMessageDetails) {
                     userData = responseMessageDetails.data;
                     console.log("userData : "+userData);
                      var trHTML = "";
                     if(userData != ""){   
                     $.each(userData, function(index, userDetails) {
                       /* s = userDetails.ID;
                        s = userDetails.ID;
                          s = s.replace(/^0+/, '');
                        */
                       
                       dataToPass = escape(userDetails.doctorid+"$"+userDetails.hospitalid+"$"+userDetails.doctorname+"$"+userDetails.hospitalname+"$"+appdate);
                       
                             trHTML += '<tr><td>' + userDetails.doctorname + '</td><td>' + userDetails.hospitalname  +'</td><td>' + userDetails.starttime + '</td><td>' + userDetails.endtime + '</td><td><font color="blue"><a href="#" onclick=patientShowAppointmentSlots("'+dataToPass+'")>Book Appointment</a></font></td></tr>';
                         });
                         
                     $('#doctor_search_result_data').append(trHTML);
                     $('#doctor_search_result_data').load(); 
                     $('#mySearchResult').modal('show');
                 } else{
                      $('#adminPatientErrorMessage').html(" No Data Found. Please refine your search Criteria");
                       $('#adminPatientErrorBlock').show();
                 }
                     
                });

                    
            }
     });
}


function validateSearchFields(){
    var appdt = ($('#start').val()).split('.');
    var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
      
       if(!($('#start').val() != "")){
            $('#staffapptpatientstartdt').html("Please Select Appointment Date");
            return false;
        }  
     hospital = $('#hospital').val();
     doctor = $('#doctor').val();
     zipcode = $('#zipcode').val();
     address = $('#hospital').val();
     city = $('#hospital').val();
     district = $('#district').val();
     //alert(zipcode,address,city,district);
     //alert(hospital,doctor);
     //alert(((zipcode == "" || address == "" || city == "" || district == "" ) && (hospital == "HOSPITAL" || doctor == "")));
     if(!(zipcode == "" || address == "" || city == "" || district == "" ) && (hospital == "HOSPITAL" || doctor == "")){
        $('#adminPatientErrorMessage').html("<b>Error : </b>Please enter atlease one search criteria");
        $('#adminPatientErrorBlock').show();
        return false;  
     }
     return true;
   
    
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

                 $('#adminPatientErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminPatientErrorBlock').show();
             });
         }
        
        
	});
}


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
                                    strtext = '- Doctor Name -'
                                     $('<option>').text(strtext).appendTo('#doctor');
                                     $.each(doctorData, function(index, data) {
                                          $('<option>').val(data.ID).text(data.name).appendTo('#doctor');
                                     });
                                 
                                }
                            });        
                }
            });  
    
    
}

function updateProfile(userName,password,email,mobile,profession,address,name,address2,district,state,mname,lname,zipcode,start,gender,aadharcard,city,altmobile,landline){
    displayErrorResults();
 //alert("Update Profile");     
    var finalname = $('#name').val()+" "+$('#mname').val()+" "+$('#lname').val();


var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"address":address,"name":finalname,"mname":mname,"state":state,"zipcode":zipcode,"district":district,"lname":lname,"gender":gender,"start":start,"aadharcard":aadharcard,"address2":address2,"fname":$('#name').val(),"city":city,"altmobile":altmobile,"landline":landline } );
        
            console.log("data "+registerData);
       
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL+'/updateprofile/'+userName,
            dataType: "json",
            data:  registerData,
            success: function(data){
            
                 console.log('authentic success: ' + data)
                 var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                        
                 clearValidationMessage();
                  $.each(list, function(index, responseMessageDetails) {
           
                        if(responseMessageDetails.status == "Success"){
                            $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#adminPatientErrorBlock').show();
                            
                        }   
                    });   

                
            },
            error: function(data){
                  var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

                    $.each(list, function(index, responseErrorMessageDetails) {
                        var message = responseErrorMessageDetails.message;
                        if(message.indexOf("]:") > 0)
                          message = message.substring(0,message.indexOf("]:")+2);

                        $('#adminErrorMessage').html("<b>Error : </b>"+message);
                        $('#adminErrorBlock').show();
                    });
            }
        });
    
}



function registerFormValidate(){
   // alert("hello- hello");
    clearValidationMessage();
     if($('#newuserpassword').val().length < 1){
       $('#passworderrormsg').html("Please enter password"); 
        return false;  
    }
    else if($('#name').val().length < 1){
        $('#nameerrormsg').html("Please enter first name"); 
        return false;
    }
    else  if($('#mname').val().length < 1){
        $('#mnameerrormsg').html("Please enter mname"); 
        return false;  
    }
    else  if($('#lname').val().length < 1){
        $('#lnamerrormsg').html("Please enter last name"); 
        return false;  
    }
    else  if($('#email').val().length < 1){
        $('#emailerrormsg').html("Please enter email");  
        return false; 
    }
     else if($('#mobile').val().length < 1){
       $('#mobileerrormsg').html("Please enter mobile #");  
        return false;
    }
     else if($('#address1').val().length < 1){
        $('#address1errormsg').html("Please enter address line 1");  
        return false; 
    }
    else  if($('#district').val().length < 1){
         $('#districterrormsg').html("Please enter district");
        return false;  
    }
    else  if($('#state').val().length < 1){
        $('#stateerrormsg').html("Please enter state");  
        return false; 
    }
    else  if($('#zipcode').val().length < 1){
        $('#zipcodeerrormsg').html("Please enter zipcode"); 
        return false;  
    }
    else  if($('#start').val().length < 1){
        $('#starterrormsg').html("Please enter date of birth");
        return false; 
    }
    else  if($('#gender').val().length < 1){
         $('#gendererrormsg').html("Please select gender ");   
        return false;
    }
     else if($('#city').val().length < 1){
        $('#cityerrormsg').html("Please enter aadhar card ") ; 
        return false;
    }else
        return true;
    
}
function clearValidationMessage(){
    $('#useriderrmsg').html("");
     $('#passworderrormsg').html("");  
    $('#nameerrormsg').html(""); 
     $('#mnameerrormsg').html("");   
     $('#lnamerrormsg').html("");
     $('#emailerrormsg').html("");  
    $('#mobileerrormsg').html("");
     $('#address1errormsg').html("");
      $('#stateerrormsg').html("");   
     $('#districterrormsg').html("");
       $('#zipcodeerrormsg').html(""); 
     $('#gendererrormsg').html(""); 
     $('#aadharerrormsg').html("") ; 
     $('#cityerrormsg').html("") ; 
}



function showupdateprofile(){
     window.location = "patientindex.php?page=updateprofile";
 }

function displayErrorResults(){
         $('#adminPatientErrorBlock').hide();
         $('#adminPatientErrorMessage').html("");  
}



function healthParametersHistory(){
     displayErrorResults();
     
    var patientId = $('#pid').val();
    console.log("patientId  "+patientId);
    console.log(rootURL + '/healthParametersHistory/' + patientId);
    $.ajax({
    type: 'GET',
    url: rootURL + '/healthParameters/' + patientId,
    dataType: "json",
    success: function(data){
        
        console.log('authentic success: ' + data)
        var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
      
        console.log("Data List Length "+list.length);
       
       $.each(list, function(index, responseMessageDetails) {
           
           console.log(responseMessageDetails.data);
            console.log("Hello  "+responseMessageDetails.message);
               console.log(responseMessageDetails.status);
           
           if(responseMessageDetails.status == "Success"){
             
              $("#patient_health_parameters_history_data tbody").remove();
       
            //  $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
              // $('#adminErrorBlock').show();
                   
                healthParametersHistory = responseMessageDetails.data;
                
                console.log("healthParametersHistory "+healthParametersHistory.length);
           var trHTML ="";     
                $.each(healthParametersHistory, function(index, healthParameters) {
                    s = healthParameters.id;
                    s = s.replace(/^0+/, '');
                    trHTML += '<tr><td>' 
                   + healthParameters.weight   +'</td><td>' 
                   + healthParameters.height   +'</td><td>' 
                   + healthParameters.bmi   +'</td><td>' 
                   + healthParameters.bp   +'</td><td>' 
                   + healthParameters.hemoglobin   +'</td><td>' 
                   + healthParameters.sugar   +'</td></tr>';

                });
               /*
                *  $('#weight').html(healthParameters.weight);
                    $('#height').html(healthParameters.height);
                    $('#bmi').html(healthParameters.bmi);
                    $('#bp').html(healthParameters.bp);
                    $('#hemoglobin').html(healthParameters.hemoglobin);
                    $('#sugar').html(healthParameters.sugar); 
                */ 
             
             
            }else{
                  // $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                   //$('#adminPatientErrorBlock').show();
            }
         $('#patient_health_parameters_history_data').append(trHTML);
         $('#staff_hosiptal_Npatient_health_parameters_history_dataonActive_data').load(); 
       });
        
      
		},
        error: function(data){
           console.log("Error IS ......".data);
        }
	});
    
}

function healthParameters(){
     displayErrorResults();
     
    var patientId = $('#pid').val();
    console.log("patientId  "+patientId);
    console.log(rootURL + '/healthParameters/' + patientId);
    $.ajax({
    type: 'GET',
    url: rootURL + '/healthParameters/' + patientId,
    dataType: "json",
    success: function(data){
        
        console.log('authentic success: ' + data)
        var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
      
        console.log("Data List Length "+list.length);
       
       $.each(list, function(index, responseMessageDetails) {
           
           console.log(responseMessageDetails.data);
            console.log("Hello  "+responseMessageDetails.message);
               console.log(responseMessageDetails.status);
           
           if(responseMessageDetails.status == "Success"){
              // $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                      // $('#adminPatientErrorBlock').show();
                   
                healthParametersData = responseMessageDetails.data;
                
                console.log("healthParametersData  "+healthParametersData.length);
                
                $.each(healthParametersData, function(index, healthParameters) {
                   
                    $('#weight').html(healthParameters.weight);
                    $('#height').html(healthParameters.height);
                    $('#bmi').html(healthParameters.bmi);
                    $('#bp').html(healthParameters.bp);
                    $('#hemoglobin').html(healthParameters.hemoglobin);
                    $('#sugar').html(healthParameters.sugar);            
                   
                   
                });
                
            }else{
                  // $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                   //$('#adminPatientErrorBlock').show();
            }
        
       });
        
      
		},
        error: function(data){
           console.log("Error IS ......".data);
        }
	});
    
}

function generatePDF(appointmentid){
    var host = $('#host').val();
     var rootnode = $('#rootnode').val();
   var url = 'http://'+host+'/'+rootnode+'/Business/GeneratePrescriptionPDF.php?appointmentid='+appointmentid;
    window.open(url, '_blank');
   // window.location.href = url;
}
function showPrescription(appointmentid){
    
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
                                //  $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                //    $('#adminPatientErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     if(userData.length > 0){
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.appointmentid;
                                        s = s.replace(/^0+/, '');
                                        
                                        
                                console.log(userDetails.description); 
                                /*imgpath = userDetails.path;
                                console.log("imgpath : "+imgpath);
                                imgurl = escape(userDetails.filename);
                                imgpath = imgpath.substring(imgpath.indexOf("/")+1,imgpath.length);
                                 console.log("imgpath : "+imgpath.indexOf("/")+1);
                                  console.log("imgpath : "+imgpath);
                                console.log(imgurl);
                                imgurl = "'"+rootURL+"/"+imgpath+"/"+imgurl+"'"; */
                           //   btst = '<a href="javascript:" onclick="window.open('+imgurl+');" target="_blank">'+userDetails.filename +'</a>';
                            trHTML += '<tr><td>' + userDetails.description   +'</td><td>' + userDetails.suggestions   +'</td></tr>';
                                    $('#hidmymodalappointmentid').val(userDetails.appointmentid);
                                //readPrescriptionURL 
                                    fetchDiseasesNames(userDetails.appointmentid);
                                   // fetchTestNames(userDetails.appointmentid);
                                    }); 
                                }else{
                                    trHTML += "<tr><td colspan='1'>Sorry No Description Data</td></tr>"; 
                                }
                                        $('#PatientPrescriptionTable').append(trHTML);
                                        $('#PatientPrescriptionTable').load();
                                        $('#myModal').modal('show');
                                        
                                        
                             } else{
                                 //  $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                  // $('#adminPatientErrorBlock').show();
                             }
                             
                     });   
                    
                }
            }); 
    
}
function showFamilyPrescription(appointmentid,patientid){
    
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
                                //  $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                //    $('#adminPatientErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     if(userData.length > 0){
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.appointmentid;
                                        s = s.replace(/^0+/, '');
                                        
                                        
                                console.log(userDetails.description); 
                                $('.appointmentDate').text(data.appointmentdt);
                                $('.appointmentID').text(data.appointmentid);
                                /*imgpath = userDetails.path;
                                console.log("imgpath : "+imgpath);
                                imgurl = escape(userDetails.filename);
                                imgpath = imgpath.substring(imgpath.indexOf("/")+1,imgpath.length);
                                 console.log("imgpath : "+imgpath.indexOf("/")+1);
                                  console.log("imgpath : "+imgpath);
                                console.log(imgurl);
                                imgurl = "'"+rootURL+"/"+imgpath+"/"+imgurl+"'"; */
                           //   btst = '<a href="javascript:" onclick="window.open('+imgurl+');" target="_blank">'+userDetails.filename +'</a>';
                            trHTML += '<tr><td>' + userDetails.description   +'</td><td>' + userDetails.suggestions   +'</td></tr>';
                                    $('#hidmymodalappointmentid').val(userDetails.appointmentid);
                                //readPrescriptionURL 
                                    fetchDiseasesNames(userDetails.appointmentid);
                                   // fetchTestNames(userDetails.appointmentid);
                                    }); 
                                }else{
                                    trHTML += "<tr><td colspan='1'>Sorry No Description Data</td></tr>"; 
                                }
                                        $('#PatientPrescriptionTable').append(trHTML);
                                        $('#PatientPrescriptionTable').load();
                                        $('#myModal').modal('show');
                                        
                                        
                             } else{
                                 //  $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                  // $('#adminPatientErrorBlock').show();
                             }
                             
                     });   
                    
                }
            }); 
    
}

function fetchDiseasesNames(appointmentid){
   //$app->get('/fetchDiseasesByAppointmentid/:appointmentid','fetchDiseasesByAppointmentid');
//$app->get('/fetchTestsByAppointmentid/:appointmentid','fetchTestsByAppointmentid'); 
 $.ajax({
                type: 'GET',
                url: rootURL +  '/fetchDiseasesByAppointmentid/' + appointmentid,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#PatientDiseasesTable tbody").remove();

                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                //  $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                //    $('#adminPatientErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                     if(userData.length > 0){
                                     $.each(userData, function(index, userDetails) {
                                        trHTML += '<tr><td>' + userDetails.namevalue   +'</td></tr>';
                                   
                                    }); 
                                }else{
                                    trHTML += "<tr><td colspan='1'>Sorry No Diseases Data</td></tr>"; 
                                }
                                        $('#PatientDiseasesTable').append(trHTML);
                                        $('#PatientDiseasesTable').load();
                                       // $('#myModal').modal('show');
                                        
                                        
                             } else{
                                   $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminPatientErrorBlock').show();
                             }
                             
                     });   
                    
                }
            }); 
}

function showFamilyMedicines(appointmentid){
 
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
                             //     $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             //       $('#adminPatientErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                    if(userData.length > 0){ 
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                        
                                        
                                        
                              
                           trHTML += '<tr><td>' + userDetails.medicinename   +'</td><td>' + userDetails.dosage  + 
                            '</td><td>' + userDetails.mbm + '</td><td>' + userDetails.mam + '</td><td>' + userDetails.abm + '</td>\n\
                            <td>' + userDetails.aam + '</td><td>' + userDetails.nbm + '</td><td>' + userDetails.nam + '</td>\n\
                            <td>' + userDetails.noofdays + '</td></tr>';


                                          
                                    });
                                    }else{
                                    trHTML += "<tr><td colspan='9'>Sorry No Medicine Data</td></tr>"; 
                                    }
                                 
                                        $('#PatientMedicineTable').append(trHTML);
                                        $('#PatientMedicineTable').load();
                                        $('#myFamilyMedicinesModal').modal('show');
                                        
                                        
                             } else{
                                 console.log("Helooooooooooooooooooo");
                                   $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                  trHTML += "<tr><td colspan='9'>"+responseMessageDetails.message+"</td></tr>"; 
                                    $('#PatientMedicineTable').append(trHTML);
                                        $('#PatientMedicineTable').load();
                                        $('#myFamilyMedicinesModal').modal('show');
                             }
                             
                     });   
                    
                }
            });    
   
}

function showMedicines(appointmentid){
 
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
                             //     $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                             //       $('#adminPatientErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                    if(userData.length > 0){ 
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                        
                                        
                                        
                              
                             trHTML += '<tr><td>' + userDetails.medicinename   +'</td><td>' + userDetails.dosage  + 
                            '</td><td>' + userDetails.mbm + '</td><td>' + userDetails.mam + '</td><td>' + userDetails.abm + '</td>\n\
                            <td>' + userDetails.aam + '</td><td>' + userDetails.nbm + '</td><td>' + userDetails.nam + '</td>\n\
                            <td>' + userDetails.noofdays + '</td></tr>';
                                          
                                    });
                                    }else{
                                    trHTML += "<tr><td colspan='9'>Sorry No Medicine Data</td></tr>"; 
                                    }
                                 
                                        $('#PatientMedicineTable').append(trHTML);
                                        $('#PatientMedicineTable').load();
                                        $('#myMedicinesModal').modal('show');
                                        
                                        
                             } else{
                                   $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminPatientErrorBlock').show();
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
                               //   $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                               //    $('#adminPatientErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                   if(userData.length > 0){  
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                      
                            trHTML += '<tr><td>' + userDetails.testname   +'</td><td>' + userDetails.parametername  + 
                            '</td><td>' + userDetails.d + '</td></tr>';

                                          
                                    });    
                                 }else{
                                        trHTML += "<tr><td colspan='3'>Sorry No Reports Data</td></tr>"; 
                                    }
                                        $('#PatientReportsTable').append(trHTML);
                                        $('#PatientReportsTable').load();
                                        $('#myReportsModal').modal('show');
                                        
                                        
                             } else{
                                   $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminPatientErrorBlock').show();
                             }
                             
                     });   
                    
                }
            }); 
}

function showFamilyReports(appointmentid){
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
                               //   $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                               //    $('#adminPatientErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                                   if(userData.length > 0){  
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                      
                            trHTML += '<tr><td>' + userDetails.testname   +'</td><td>' + userDetails.parametername  + 
                            '</td><td>' + userDetails.d + '</td><td>' + userDetails.bioref + '</td></tr>';

                                          
                                    });    
                                 }else{
                                        trHTML += "<tr><td colspan='4'>Sorry No Reports Data</td></tr>"; 
                                    }
                                        $('#PatientReportsTable').append(trHTML);
                                        $('#PatientReportsTable').load();
                                        $('#myReportsModal').modal('show');
                                        
                                        
                             } else{
                                   $('#adminPatientErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminPatientErrorBlock').show();
                             }
                             
                     });   
                    
                }
            }); 
}


function  showReport(reportimage) {
    var host = $('#host').val();
     var rootnode = $('#rootnode').val();
   var url = 'http://'+host+'/'+rootnode+'/'+reportimage;
    console.log(url);
    //alert(url);
  // largeImage.style.display = 'block';
   //largeImage.style.width=200+"px";
   //largeImage.style.height=200+"px";
window.open(url,'Image','width= 700px,height=500px,resizable=1');
}




/*
 * Added by achyuth for adding Questions asked by patients (Sep092015)
 * 
 */

function addQuestion()
{
	var subject = $('#subject').val();
	var question = $('#question').val();
	if(subject == "" || question == "")
	{
		$('#patientErrorMessage').html("<b>Error : </b> Please enter both Subject and Question for adding a Question");
        $('#patientErrorBlock').show();
        return false;
	}
	
	var questionData = JSON.stringify({"subject":subject,"question":question});
	$.ajax({
		type: 'POST',
		url: rootURL + '/addQuestion',
		dataType: "json",
		data:questionData,
		success: function(data){
			alert(data.responseMessageDetails.message);
			window.location.href=rootURL+"/Web/patient/patientindex.php?page=question";
		}
  });
	
}



function bookAppointment(slotTime){
    $('#slottime').val(unescape(slotTime));
            console.log("Slooooooooooo222222222222222ooottttttttttttttt"+$('#slottime').val());
            console.log(window.location.pathname);
             console.log(window.location.href);
              console.log(window.location.protocol);
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
            //$('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");

             $('#slot').val(unescape(slotTime));
             $('#start').val(dateEntered);
            $('#currdate').html(dateEntered+" <b> Time : </b> "+unescape(slotTime));
            $('#slottime').val(unescape(slotTime));
            console.log("Sloooooooooooooottttttttttttttt"+$('#slottime').val());
            //alert(checkForLeave(currentDate,$('#doctorid').val()));
            if( checkForLeave(dateEntered,$('#doctorid').val()) != "Fail")
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
          //  $('#staffapptpatientname').html("Please enter atleast Patient Name or Patient ID to Book a appointment");

             $('#slot').val(unescape(slotTime));
             $('#start').val(currentDate);
            $('#currdate').html(currentDate+" <b> Time : </b> "+unescape(slotTime));
            $('#slottime').val(unescape(slotTime));
            console.log("Sloooooooooooooottttttttttttttt"+$('#slottime').val());
            //alert(checkForLeave(currentDate,$('#doctorid').val()));
            if( checkForLeave(currentDate,$('#doctorid').val()) != "Fail")
                 $('#enterAppointmentData').modal('show');
        }else{

            $('#generalMessage').html("Sorry Time Elapsed you cant book this slot. "+unescape(slotTime));
            $('#appointmentGeneralMessage').modal('show');

        }
        
    }
    
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



function staffHomeBookAppointment(patientid){
  $('#usernameexist').val(" ");
    
    if($('#start').val().indexOf(".") > 0){
     var appdt = ($('#start').val()).split(".");
     var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
 }else{ 
     var appdate = $('#start').val();
 } 
 
 appointmentType = $('#appointmenttype').val();
 if($('#appointmentforothers').is(":checked")){
     flag = "Y";
     if(($('#othermember').val() == "MEMBER")){
         if($('#othername').val() == ""){
             alert("Please enter name");
              $('#enterAppointmentData').modal('show');
            flag = "N";
         }
         if($('#othermobile').val() == ""){
             alert("Please enter mobile #");
              $('#enterAppointmentData').modal('show');
             flag = "N";
         }
         if($('#otheremail').val() == ""){
             alert("Please enter email");
              $('#enterAppointmentData').modal('show');
             flag = "N";
         }
         if($('#otherusername').val() == ""){
             alert("Please enter User Name");
              $('#enterAppointmentData').modal('show');
             flag = "N";
         }
         
         
     }
     if(($('#othermember').val() == "") && ($('#othername').val() == "" && $('#othermobile').val() == "" && $('#otheremail').val() == "")){
         alert("Please enter other member information");
         flag = "N";
     }
     if(($('#othermember').val() == "") && ($('#othername').val() == "" ||  $('#othermobile').val() == "" || $('#otheremail').val() == "")){
        alert("Please enter other member information");
         flag = "N";
     }
     if(flag == "N"){
           $('#enterAppointmentData').modal('show');
         return false;
     }
     
  //http://localhost:8888/HSMHealthSystem/Web/patient/patientindex.php?page=
  //createappointment&doctorid=114&appointmentdate=2015-10-30&hospital=1&doctorname=
  //Rajiv%20Kumar%20Lopuri&hospitalname=Vijaya%20Hospital 
  
  $('#currdate').html(GetPageParameter('appointmentdate'));
    // alert($('#othermember').val()+"  "+($('#othermember').val() != "MEMBER"));
     ///checkOthersData/:name/:mobile/:email
  if(flag == "Y"){
        if($('#othermember').val() != "MEMBER"){
       //  alert("Member Group");
         registerOtherGroupMemberAppointment($('#hosiptal').val(),$('#doctor').val(),appdate,patientid,$('#slot').val(),'N',"",$('#othermember').val(),appointmentType);
         alert("Appointment Created Successfully");
         url = "page=appointment";
       // window.location.replace(rootURL + '/Web/patient/patientindex.php?page=appointment');
     } else if(($('#othername').val() != "" && $('#othermobile').val() != "" && $('#otheremail').val() != "")){
        // alert("Hello");
         createAppointmentForNewUser($('#username').val(),$('#othername').val(),$('#othermobile').val(),$('#otheremail').val());
         //alert("Appointment Created Successfully");
         //url = "page=appointment";
        // window.location.replace(rootURL + '/Web/patient/patientindex.php?page=appointment');
     } else{
         alert("Please enter other Patient info like,Name,Mobile,Email");
     }
    }else{
         $('#enterAppointmentData').modal('show');
    }  
 }else{
 
    // alert(appdate);
     pageFrom = GetPageParameter('page')
     staffHomeCreateAppointment($('#hosiptal').val(),$('#doctor').val(),appdate,patientid,$('#slot').val(),'N',"",appointmentType);
        alert("Appointment Created Successfully");
    url = "page=appointment";
       window.location.replace(rootURL + '/Web/patient/patientindex.php?page=appointment');
 }   
 //?page=createappointment&doctorid=92&appointmentdate=2015-09-16&hospital=14
}

function createAppointmentForNewUser(newusername,name,mobile,email){
    $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: rootURL + '/checkOthersData/'+name+'/'+mobile+'/'+email,
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                
                console.log(data);
                var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
               console.log(list.length);
                $.each(list, function(index, responseMessageDetails) {
                    console.log("usernameexist  : "+ $('#usernameexist').val());
                        if(responseMessageDetails.status == "Success"){
                            responseData = responseMessageDetails.data;
                            console.log("Data : "+responseMessageDetails.data);
                            console.log("length : "+responseData.length);
                            if(responseData.length > 0){
                                $('#other_member_result_data tbody').remove();
                                $('#enterAppointmentData').modal('hide');
                                //other_member_result_data
                                
                                 var trHTML = "";
                                var line = 1;
                                $.each(responseData,function(key, value){
                                    cssClass = "";
                                  //  $('#usernameexist').val(" ");
                                    console.log("newusername : "+newusername);
                                    console.log("Value.username : "+(newusername == value.username));
                                    if(newusername == value.username){
                                        cssClass = "lightgreen";
                                        $('#usernameexist').val("Y");
                                    }
                                    console.log(value);
                                     trHTML += '<tr style="background-color: '+cssClass+'"><td>'+value.username+'</td><td>'+value.ID+'</td><td>'+value.name+'</td>'+
                                     '<td>'+value.mobile+'</td><td>'+value.gender+'</td><td>'+value.dob+'</td>'+
                                     '<td><font color="blue"><a href="#" onclick="staffHomeNewBookAppointment('+value.ID+')">Book Appointment</a></font></td></tr>';
                                     line++;
                               });
                                $('#other_member_result_data').append(trHTML);
                                   $('#other_member_result_data').load();
                                   $('#othercurrdate').html(GetPageParameter('appointmentdate'));//unescape(slotTime)$('#appointmentdate').val();
                                   $('#othercurrdate').html($('#appointmentdate').val()+" : "+$('#slottime').val());
                                    $('#showOtherMemberInfo').modal('show');
                            }
                        }
                          
                    });
                
                
            }
    }); 
    
}

function staffHomeNewBookAppointment(patientid){
    console.log("Helooooooooooooooo 1375........"+$('#usernameexist').val());
    userExist = $('#usernameexist').val();
     var sEmail = $('#email').val();
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
   /* if (!filter.test(sEmail))  {
        console.log("return email false....");
          $("#emailerrormsg").html("Please enter email address or invalid email address").show();
           $('#emailerrormessages').show();
        return false;
  }*/
    if(userExist =='Y'){
        alert("User Name already exists");
        $('#showOtherMemberInfo').modal('hide');
         $('#enterAppointmentData').modal('show');
    }else{
        console.log("In Elseeeeeee");
       // $('#hosiptal').val(),$('#doctor').val(),appdate,patientid,$('#slot').val(),'N',""
       
        registerNewMemberandAppointment($('#hosiptal').val(),$('#doctor').val(), GetPageParameter('appointmentdate'),patientid,$('#slot').val(),'N',$('#othername').val(),$('#othermobile').val(),$('#username').val(),$('#otheremail').val(),$('#oappointmenttype').val());
        alert("Appointment Created Successfully");
        $('#showOtherMemberInfo').modal('hide');
        location.href = "patientindex.php?page=createappointment";
    }
    
}

//complete this... create new user and appointment
function registerNewMemberandAppointment(hosiptal,doctor,appdate,pid,slot,status,pname,mobile,username,email,appointmentType){
    
    var appointmentDetails = JSON.stringify( {"hosiptal" : hosiptal,"doctor" : doctor,"appdate" : appdate,"slot":slot,"mobile" : mobile,"username":username,"pname":pname,"email":email,"profession":"Others","name":pname,"appointmentType":appointmentType,"insttype":"Web" } );
  
    
    console.log("appointmentDetails : "+appointmentDetails);
    console.log(rootURL + '/createNewMemberandAppointment');
    
    $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: rootURL + '/createNewMemberandAppointment',
    dataType: "json",
    data:  appointmentDetails,
    success: function(data, textStatus, jqXHR){
        console.log('authentic success: ' + data);
         var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            //$("#records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message+" {Appointment ID :  "+responseMessageDetails.comments +" }" );
                         $('#adminPatientErrorBlock').show();
                      
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





function registerOtherGroupMemberAppointment(hosiptal,doctor,appdate,pid,slot,status,pname,otermemberid,appointmentType){
    
      var appointmentDetails = JSON.stringify( {"hosiptal" : hosiptal,"doctor" : doctor,"appdate" : appdate,"slot":slot,"pid" : otermemberid,"status":status,"pname":pname,"appointmentType":appointmentType } );
    console.log(appointmentDetails);
    $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: rootURL + '/createOtherMemberAppointment',
    dataType: "json",
    data:  appointmentDetails,
    success: function(data, textStatus, jqXHR){
		console.log('authentic success: ' + data);
         var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            //$("#records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message+" {Appointment ID :  "+responseMessageDetails.comments +" }" );
                         $('#adminPatientErrorBlock').show();
                      
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

function updateUserIdinFamilyGroup(userid){
    
    id = $('#familygrpid').val();
  $.ajax({
    type: 'PUT',
    url: rootURL + '/updateUserIdofMember/'+id+'/'+userid,
    dataType: "json",
    success: function(data){
            alert("Data Update Successfully");
            $('#showQuickRegister').modal('hide');
            window.location.href= rootURL+"Web/patient/patientindex.php?page=familymemberdetails";
    }
  });
}

function registerQuickUser(userName,password,email,mobile,profession,name){
   
    var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"name":name,"insttype":"Patient Family"} );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/quickRegister',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                console.log(list);
            
               $.each(list, function(index, responseMessageDetails) {
                   var message = responseMessageDetails.message;
                   
                  
                    if(message.indexOf("]:") > 0)
                        message = message.substring(0,message.indexOf("]:")+2);
                    
                     console.log("Message : "+message);
                    
                   if(responseMessageDetails.status == "Success"){
                       console.log("In Success"+responseMessageDetails.message);
                       $('#errorDisplay').html(responseMessageDetails.message);
                       $('#errormessages').show();
                        $('#errorRBlock').show();
                        var mobileNumber = mobile;
                    	//var message = responseMessageDetails.message;
                    	var message = responseMessageDetails.comments;
                    	var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+mobileNumber+"&text="+message+"&priority=ndnd&stype=normal";

                    	$.post(url, function(data){
                    		//Need to show some message if we get response from the SMS api.
                    		//Currently we are just sending Message after Signup
                    	});
                    	updateUserIdinFamilyGroup(userName);
                      // clearFormValues();
                   }else{
                       console.log("In fail");
                       if(message.indexOf("Exists") > 0){
                            
                           $('#errorDisplay').html("User Id already exists");
                            $('#errormessages').show();
                             $('#errorRBlock').show();
                             
                             userIdData = responseMessageDetails.data;
                             userid = userIdData.substring(userIdData.indexOf(":")+1,userIdData.length);
                              $('#showprocessing').hide();
                       }else{
                            $('#showprocessing').hide();
                           $('#errorDisplay').html(responseMessageDetails.message);
                            $('#errormessages').show();
                        $('#errorRBlock').show();
                           // clearFormValues();
                       }
                   }
                   
                   
                });
 
            },
            error: function(data){
                var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);
 $('#showprocessing').hide();
             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#errorDisplay').html("<font color='red'><b>"+message+"</b></font>");
                 $('#errormessages').show()
             });

            }
        });

}



function staffHomeCreateAppointment(hosiptal,doctor,appdate,pid,slot,status,pname,appointmentType){
    
    var appointmentDetails = JSON.stringify( {"hosiptal" : hosiptal,"doctor" : doctor,"appdate" : appdate,"slot":slot,"pid" : pid,"status":status,"pname":pname,"appointmentType":appointmentType } );
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
            //$("#records_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                         $('#adminPatientErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message+" {Appointment ID :  "+responseMessageDetails.comments +" }" );
                         $('#adminPatientErrorBlock').show();
                      
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

/*
 * Added below function by achyuth for getting Answers for questions (Sep092015)
 * 
 */
function showAnswers(id){
	$.ajax({
		type: 'GET',
		url: rootURL + '/getAnswers/'+id,
		dataType: "json",
		success: function(data){
			var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
				
			$('#AnswersListTable tbody').remove();
			$("#questionId").val("");
                $.each(list, function(index, responseMessageDetails) {
               	 $("#questionId").val(id);
                	if(responseMessageDetails.status == "Success"){
                    	 
                          $('#labErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#labErrorBLock').show();
                            answersData = responseMessageDetails.data;
                             var trHTML = "";
                             var line = 1;
                             $.each(answersData,function(key, value){
                            	 
                            	 trHTML += '<tr><td>'+answersData[key].answer+'</td><td>'+answersData[key].answerby+
                            	 			'</td></tr>';
                       		line++;
                            });
                             $('#AnswersListTable').append(trHTML);
                                $('#AnswersListTable').load();
                                
                     } else{
                           $('#labErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                           $('#labErrorBLock').show();
                     }
                     
             });   
		}
  });
	
  $('#patientAnswersModal').modal('show');  
}


function navigateToProfile(){
    window.location.href = 'patientindex.php?page=personal';
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

function showorders(patientid){
    
    
    console.log($('#pid').val());
    
    pid = $('#pid').val();
    console.log(pid);
    console.log(rootURL + '/fetchPatientSpecificOrders/' + patientid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchPatientSpecificOrders/' + patientid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_received_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientlid = "";
                            $('#recordcount').val(dataCount);
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientlid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientlid != data.ID ));
                                
                           checkboxid = index+"selected";
                           if(data.status == "D")
                            checklink = "<input type='checkbox' id="+checkboxid+" name="+checkboxid+" value="+data.id+">";   
                           else
                            checklink = "";
                                console.log("......"+data.redirecteddate);
                                 
                                 trHTML ="<tr><td nowrap='true'>"+checklink+"</td><td>"+((data.redirecteddate == null) ? " " : data.redirecteddate)+"</td>\n\
<td>"+((data.medicinename == "") ? " " : data.medicinename)+"</td><td>"+((data.dispatchdate == null) ? " " : data.dispatchdate)+"</td><td>"+((data.medicalshopname == null) ? " " : data.medicalshopname)+"</td>\n\
<td>"+((data.price == null) ? " " : data.price)+"</td></tr>";
                                       $('#patient_medicines_order_received_table').append(trHTML);
                                        $('#patient_medicines_order_received_table').load();
                               
                                 patientlid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_received_table').append(trHTML);
                             $('#patient_medicines_order_received_table').load();
                        }
                         
                    }
                });

                        
        }
    });
    
    $('#orderedReceivedMedicines').modal('show');
}




function showNonPrescriptionMedicines(patientid){
    
    
    console.log($('#pid').val());
    
    pid = $('#pid').val();
    console.log(pid);
    console.log(rootURL + '/nonPrescriptionMedicines/' + patientid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/nonPrescriptionMedicines/' + patientid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#PatientNonPrescriptionMedicines tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientlid = "";
                            $('#recordcount').val(dataCount);
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientlid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientlid != data.ID ));
                                
                           checkboxid = index+"selected";
                           if(data.status == "D")
                            checklink = "<input type='checkbox' id="+checkboxid+" name="+checkboxid+" value="+data.id+">";   
                           else
                            checklink = "";
                                console.log("......"+data.redirecteddate);
                                 
                                 trHTML ="<tr><td>"+((data.medicinename == null) ? " " : data.medicinename)+"</td>\n\
<td>"+((data.distributed == "") ? " " : data.distributed)+"</td><td>"+((data.createddate == null) ? " " : data.createddate)+"</td></tr>";
                                       $('#PatientNonPrescriptionMedicines').append(trHTML);
                                        $('#PatientNonPrescriptionMedicines').load();
                               
                                 patientlid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='3' align='center'><b>No Data</b></td></tr>";
                            $('#PatientNonPrescriptionMedicines').append(trHTML);
                             $('#PatientNonPrescriptionMedicines').load();
                        }
                         
                    }
                });

                        
        }
    });
    
    $('#myNonPrescriptionMedicinesModal').modal('show');
}


function openregister(grpid){
    $('#familygrpid').val(grpid);
    $('#showprocessing').hide();
    $('#showQuickRegister').modal('show');
}
