/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){

function displayErrorResults(){
         $('#adminHospitalErrorBlock').hide();
         $('#adminStaffErrorBlock').hide();
         $('#adminErrorBlock').hide();
         $('#adminErrorMessage').html("");  
          $('#adminStaffErrorMessage').html("");  
}
   $('#searchCompletedPrescription').click( function(){
       //alert("Hello");
       fetchDetails();
   });
});

function fetchDetails(){
    //fetchNonPaidPrescription
    if(validateSearchForm()){
        resultStatus = "";
         if($('#patientName').val() == ""){
                patientname = "nodata";
            } else
                patientname = $('#patientName').val();
            if($('#patientID').val() == ""){
                 patientid = "nodata";
            }else{
                patientid =$('#patientID').val();
                resultStatus = "Y";
            }   
            if($('#appointmentID').val() == ""){
                 appid = "nodata";
            }else{
                appid = $('#appointmentID').val(); 
                 resultStatus = "Y";
            }
            if($('#mobile').val() == ""){
                 mobile = "nodata";
            }else
                mobile = $('#mobile').val();
            
      console.log(rootURL + '/fetchNonPaidPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL +  '/fetchNonPaidPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#patient_prescription_records_nonpaid_search_result_table tbody").remove();

                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  //$('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    //$('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     var trHTML = "";
                               //  if( resultStatus == "Y"){    
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                       //if(index < 1){   
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                  console.log("User "+userDetails.id);
                                        console.log("User "+userDetails);
                                       prescription = "prescription"+index;
                                       passonvalue = s+"$"+userDetails.id;
                                       price = "price"+index;
                                       
                                            hbtst = '<input type="hidden" size="3" name='+prescription+' value='+passonvalue+'>'; 
                                            pbtst = '<input type="text" size="5" name='+price+'>'; 

                                                btst = '<a href="#" onclick="showPopUp('+userDetails.id+')"><font color="blue">Enter Details</font></a>';

                                           trHTML += '<tr><td>' + userDetails.id   +'</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.AppointementDate   +'</td><td>' + btst   +'</td><td>&nbsp;</td></tr>';
                                           $('#hidcount').val(index);
                                     // }
                                    }); 
                                //}/*else{
                                 
                                
                                       $('#patient_prescription_records_nonpaid_search_result_table').append(trHTML);
                                        $('#patient_prescription_records_nonpaid_search_result_table').load();
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                             }
                             
                     });   
                    
                }
            }); 
    
    
    
    }
    
    
    
}


function showPopUp(s){
     console.log("s"+s);
    var amount = prompt("Please enter amount");
    console.log("amount"+amount);
     $.ajax({
                type: 'PUT',
                url: rootURL +  '/updatePrescription/' + s +'/'+amount,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    fetchDetails();
                    $.each(list, function(index, responseMessageDetails) {
                         
                          $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                          $('#adminStaffErrorBlock').show();
                         
                           //$('#searchCompletedPrescription').click( function()
                     });

                },
                complete: function(data){
                    console.log("Hello");
                     fetchDetails();
                }
            });      
}


function  validateSearchForm(){
      var companyName = $('#companyName').val();
      var medicineName = $('#medicineName').val();
      var doctorName = $('#doctorName').val();
       var technicalName = $('#technicalName').val();
       
       
       
    if(companyName == "" && medicineName == "" && doctorName == "" && technicalName == "" ){
        $('#medicineSearchErrorMessage').html("<b>Error : </b> Please enter atleast one search criteria");
        $('#medicineSearchErrorBlock').show();
        return false;
    }else
        return true;
    
}