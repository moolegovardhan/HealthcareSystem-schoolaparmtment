/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();

$(document).ready(function(){ 
    
    $('#fetchTestForPatient').click( function(){
        
        testname = $('#testname').val();
        
        $.ajax({
              type: 'GET',
              url: rootURL + '/diagnosticsTestDataByNameandId/nodata/' + testname,
              dataType: "json",
              success: function(data){
                   var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                   console.log("Data List Length "+list.length);
                      $.each(list, function(index, responseMessageDetails) {
                          if(responseMessageDetails.status == "Success"){
                               console.log(responseMessageDetails.message);
                              testData = responseMessageDetails.data;
                               var trHTML = "";
                                  $("#test_name tbody").remove();
                                $.each(testData, function(index, test) {
                                    valuetopass = test.testid+"$"+test.testname+"$"+test.price;
                                    button = "<a href='#' onclick='addTestToList("+test.testid+")' ><i class='icon-plus'></i></a>";
                                     trHTML = trHTML+"<tr ><td>"+test.testname+"</td><td>"+test.price+"</td><td>"+button+"</td></tr>";     
                                      
                                });
                                 $('#test_name').append(trHTML);
                                    $('#test_name').load();
                          }
                          
                      });
                  
              }
          });   
        
    });
    
    
    
   /* $('#appointmentidhid').val(appointmentid);
    $('#patientreportss').load();
      console.log(rootURL + '/getPatientTestDetails/' + appointmentid);
      $('#appointmentid').val(appointmentid);
       $.ajax({
              type: 'GET',
              url: rootURL + '/getPatientTestDetails/' + appointmentid,
              dataType: "json",
              success: function(data){
                  
                   console.log('authentic : ' + data)
                  var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                   console.log("Data List Length "+list.length);
                      $.each(list, function(index, responseMessageDetails) {
                          
                          if(responseMessageDetails.status == "Success"){
                              console.log(responseMessageDetails.message);
                              testData = responseMessageDetails.data;
                               $('#patientid').val(testData[0].patientid);
                                   console.log("testData : "+testData.length);
                                   var trHTML = "";
                                   
                                  $("#appointment_test_prescribed tbody").remove();
                                  $('#recordcount').val(testData.length);
                                  console.log("After hidding count..."+testData.length);
                                 $.each(testData, function(index, test) {
                                        console.log(test);
                                       
                                        finalValue = test.constid+"$"+test.namevalue+"$"+test.finalprice+"$"+test.testname;
                                        textboxname = "text"+index;
                                        checkbox = "<input type='checkbox' name="+index+" value="+finalValue+">";
                                        textbox = "<input type='text' name="+textboxname+" value="+test.finalprice+">";
                                        trHTML = trHTML+"<tr ><td>"+checkbox+"</td><td>"+test.testname+"</td><td>"+test.finalprice+"</td> <td>"+textbox+"</td></tr>";     
                                       console.log("...test.patientid......................."+test.patientid);
                                       $('#hidpatientid').val(test.patientid);
                                   });
                                    $('#appointment_test_prescribed').append(trHTML);
                                    $('#appointment_test_prescribed').load();
                                   $('#showListOfTest').modal('show');
                          }else{
                              
                            $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                            $('#adminStaffErrorBlock').show();  
                          }
                          
                      });
                      
                  if(list.length > 0){
                      if(list[0].status == "Fail"){
                          if(list[0].message == "Doctor did not prescriped any test"){
                              document.getElementById('errorMessage').innerHTML = "Doctor did not prescribed any test to patient";
                              //$('#errorMessage').innerHTML("Doctor did not prescribed any test to patient");
                                $('#noLabTestMessage').modal('show');
                          }
                      }
                  }
                  console.log("After appending and after loop of  first each");
              }
              
          });   
  
  console.log("Final befor mmodal show");
  //  $('#listofreports').hide();
  //  $('#reportssearchpanel').hide();
  
  console.log("Afte rmodal show");
    */
});

function deleteFromTest(constid){
     appointmentid = $('#appointmentidhid').val();
      $.ajax({
        type: 'PUT',
        url: rootURL + '/deleteNonPrescriptionTest/'+constid,
        dataType: "json",
        success: function(data){
            console.log(data);
            reloadPatientTestData(appointmentid);
            console.log("appointmentid............."+appointmentid);
           // window.location.href=rootURL+"/Web/lab/labindex.php?page=samplecollection";
        }
    });  
}
function addTestToList(testid){
    
    appointmentid = $('#appointmentidhid').val();
    patientid = $('#hidpatientid').val();
    console.log("appointmentid........"+appointmentid);
     console.log("testid........"+testid);
     jsonObj = {"diagtype":"MEDICAL TEST","nameValue":testid,"appointmentId":appointmentid,"patientId":patientid};
     console.log(JSON.stringify(jsonObj));
     console.log(rootURL + '/insertNonPrescriptionDiagnosisDetails');
      $.ajax({
        type: 'POST',
        url: rootURL + '/insertNonPrescriptionDiagnosisDetails',
        dataType: "json",
        data:JSON.stringify(jsonObj),
        success: function(data){
            console.log(data);
            reloadPatientTestData(appointmentid);
            console.log("appointmentid............."+appointmentid);
           // window.location.href=rootURL+"/Web/lab/labindex.php?page=samplecollection";
        }
    });  
    
}


function reloadPatientTestData(appointmentid){
     console.log(rootURL + '/getPatientTestDetails/' + appointmentid);
      $('#appointmentid').val(appointmentid);
       $.ajax({
              type: 'GET',
              url: rootURL + '/getPatientTestDetails/' + appointmentid,
              dataType: "json",
              success: function(data){
                  
                   console.log('authentic : ' + data)
                  var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                   console.log("Data List Length "+list.length);
                      $.each(list, function(index, responseMessageDetails) {
                          
                          if(responseMessageDetails.status == "Success"){
                              console.log(responseMessageDetails.message);
                              testData = responseMessageDetails.data;
                               $('#patientid').val(testData[0].patientid);
                                   console.log("testData : "+testData.length);
                                   var trHTML = "";
                                   
                                  $("#patient_test_prescribed tbody").remove();
                                  $('#recordcount').val(testData.length);
                                  console.log("After hidding count..."+testData.length);
                                  $('#recordcount').val(testData.length);
                                 $.each(testData, function(index, test) {
                                        console.log(test);
                                       
                                        finalValue = test.constid+"$"+test.namevalue+"$"+test.finalprice+"$"+test.testname;
                                        textboxname = "text"+index;
                                        checkbox = "<input type='checkbox' name="+index+" value="+finalValue+">";
                                        if(test.nonprestest == "NP")
                                          textbox = "<a href='#' onclick='deleteFromTest("+test.constid+")'>Delete</a>";
                                        else
                                          textbox = "";  
                                        trHTML = trHTML+"<tr ><td>"+checkbox+"</td><td>"+test.testname+"</td><td>"+test.finalprice+"</td> <td>"+textbox+"</td></tr>";     
                                       console.log("...test.patientid......................."+test.patientid);
                                       $('#hidpatientid').val(test.patientid);
                                   });
                                    $('#patient_test_prescribed').append(trHTML);
                                    $('#patient_test_prescribed').load();
                                   $('#showListOfTest').modal('show');
                          }else{
                              
                            $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                            $('#adminStaffErrorBlock').show();  
                          }
                          
                      });
                  }   
               });          
}