/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    $('#patientdata').hide();
      displayErrorResults();
      $("#spatientname").keypress(function (e) {

        $("#spatientnameerr").html("Enter Minimum 3 Characters for Search").show().fadeOut("slow");

        });
    
     $('#getRegPatient').click(function() {
         
          if($('#spatientname').val() < 2){
               $('#spatientnameerr').html("Please Enter Doctor");
               return false;
            }
        // alert($('#spatientname').val());
         getRegPatientList($('#spatientname').val());
         
     });
 
    
});




function getRegPatientList(patientname){
    
    displayErrorResults();
    
   
    para = "Others";
    
    console.log(rootURL + '/hospitalSpecifiPatients/'+para+'/'+patientname);
     $.ajax({
        type: 'GET',
        url: rootURL + '/hospitalSpecifiPatients/'+para+'/'+patientname,
        dataType: "json",
        success: function(data){
        console.log('authentic success: ' + data)
        var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#reg_patient_data_param tbody").remove();

           console.log("Data List Length "+list.length);

           $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show();

                     hospitalData = responseMessageDetails.data;

                     console.log("Hospital"+hospitalData.length);
                     var trHTML = "";
                     $.each(hospitalData, function(index, masterUsersData) {
                         s = masterUsersData.id;
                         s = s.replace(/^0+/, '');
                         trHTML += '<tr><td>' + $.trim(s) +  '</td><td>' + masterUsersData.PatientName  
                                +'</td><td><font color="blue"><i> <a href="#" onclick = showdata('+ masterUsersData.id +')> Select <a></i></font></td></tr>';
                     });
                      $('#reg_patient_data_param').append(trHTML);
                      $('#reg_patient_data_param').load(); 
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



     // For saving Patient
    $('#btnRegSubmitPatient').click(function(){
        weight = $('#weight').val();
        height = $('#height').val();
        bmi  = $('#bmi').val();        
        hemoglobin = $('#hemoglobin').val();
        bp = $('#bp').val();
        sugar = $('#sugar').val();
        regpatientid = $('#regpatientid').val();
        
            if($('#weight').val() < 2){
               $('#weighterr').html("Please Enter Weight");
               return false;
            }
             if($('#height').val() < 2){
               $('#heighterr').html("Please Enter Height");
               return false;
            }
         if($('#bmi').val() < 2){
               $('#bmierr').html("Please Enter BMI");
               return false;
            }
         if($('#hemoglobin').val() < 2){
               $('#hemoglobinerr').html("Please Enter Hemoglobin");
               return false;
            }
         if($('#bp').val() < 2){
               $('#bperr').html("Please Enter Blood Pressure");
               return false;
            }
         if($('#sugar').val() < 2){
               $('#sugarerr').html("Please Enter Sugar");
               return false;
            }
         
    var userDetails = JSON.stringify( {"patientid" : regpatientid,"weight" : weight,"height" : height,"bmi" : bmi,"hemoglobin" : hemoglobin,"bp" : bp,"sugar" : sugar } );
     console.log(userDetails);   
        $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: rootURL + '/createPatientParameters',
        dataType: "json",
        data:  userDetails,
        success: function(data){
                console.log('authentic success: ' + data.responseMessageDetails);
       var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
       
         
             $.each(list, function(index, responseMessageDetails) {
                 
                 console.log(responseMessageDetails.message);
                  console.log(responseMessageDetails.status);
                 
               if(responseMessageDetails.status == "Success")  {        
                    console.log("In check User Id"+(list).length);
                    console.log("lsit : "+list);

                    var message = responseMessageDetails.message;
                    if(message.indexOf("]:") > 0)
                    message = message.substring(0,message.indexOf("]:")+2);
                  
                     $('#adminStaffErrorMessage').html("<b>Info : </b>"+message);
                     $('#adminStaffErrorBlock').show();
                     clearValues();
                    }else {
                 $('#adminStaffErrorMessage').html("<b>Info : </b>"+message);
                     $('#adminStaffErrorBlock').show();
             }  
                 }); 
               
            },
            error: function(data){
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

        });


function clearValues(){

        $('#weight').val("");
        $('#height').val("");
        $('#bmi').val("");
        $('#hemoglobin').val("");
        $('#bp').val("");
        $('#sugar').val(""); 
    
}

function showdata(patientid){
    console.log(patientid);
     $('#regpatientid').val(patientid)
     $('#selectedpatient').html("Selected Patient is : "+patientid);
     $('#patientdata').show();
    
    
}
