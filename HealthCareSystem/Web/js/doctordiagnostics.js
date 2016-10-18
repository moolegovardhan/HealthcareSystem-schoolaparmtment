/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
     var fullDate = new Date();
     var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
 
     var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
     console.log(currentDate);
     
     diagnosticsid = $('#presdiagnostics').val();
     console.log(diagnosticsid);
     if(diagnosticsid  == "Diagnostics")
         presdiagnostics = "nodata";
     else 
         presdiagnostics = diagnosticsid;
     
      console.log("..."+presdiagnostics);
      
      callDefaultData(currentDate,currentDate,presdiagnostics);
      $('#searchDiagnostics').click(function(){
          diagnosticsid = $('#presdiagnostics').val();
        console.log(diagnosticsid);
        if(diagnosticsid == "Diagnostics"){console.log("In If");
            presdiagnostics = "nodata";
        } else {console.log("Hello in else");
            presdiagnostics = diagnosticsid;
        }    
         console.log("..."+presdiagnostics);
          if(validateData()){
               var appdt = ($('#start').val()).split('.');
               var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
               
                var appdt1 = ($('#finish').val()).split('.');
                var appdate1 = appdt1[2]+"-"+appdt1[1]+"-"+appdt1[0];
                callDefaultData(appdate,appdate1,presdiagnostics);
           }
      });
      
   
}); 
function callDefaultData(startDate,endDate,diagnosticsid){
 console.log("diagnosticsid : "+diagnosticsid);
 doctoruserid = $('#doctoruserid').val();
 
 if(diagnosticsid == ""){
     alert("Please select Diagnostics");
     return false;
 }
 
    console.log(rootURL + '/doctorDiagnosticsDataForMobile/' + startDate +'/'+endDate +'/'+diagnosticsid+'/'+doctoruserid);
     $.ajax({
                type: 'GET',
                url: rootURL + '/doctorDiagnosticsDataForMobile/' + startDate +'/'+endDate +'/'+diagnosticsid+'/'+doctoruserid,
                dataType: "json",
                success: function(data){
                      console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#diagnosticsdetails tbody").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {
                            console.log(" responseMessageDetails :"+responseMessageDetails);
                           testData = responseMessageDetails.data;
                           console.log("after Data List : "+testData);
                           
                            console.log("Sart Sude "+testData.indexOf('No Data'));
                         if(testData.indexOf('No') != 0){  
                          //  console.log("Inside "+testData[0] instanceof Array);
                            $("#doctor_diagnostics_details tbody").remove();
                              var trHTML = "";
                              console.log();
                         $.each(testData, function(index, test) {
                             console.log("test Of : "+JSON.stringify(test));
                            var testArray = ""; 
                            //   console.log("Test Individual : "+(test[3].testname == undefined)+" :  "+test[3].testname);
                            //  console.log("price"+jsonData);
                               var jsonData =  JSON.stringify(test, function(key, value) {
                                    var result = value;
                                    console.log("Result........."+result);
                                  //  console.log("Hello"+result.testData[0].testname);
                                    //   console.log("Hello"+result.testData.length);
                                       var btst = "";
                                      if(result != ""){ 
                                                for(i =0;i<result.testData.length;i++){
                                                    btst = btst+"<p><b>Test Name : </b><i>"+result.testData[i].testname+"</i> , "+"<b>Price : </b><i>"+result.testData[i].finalprice+"</i></p>";
                                                }

                                            console.log(btst);;
                                            trHTML += '<tr><td>' + result.diagnosticsname +  '</td><td>' + result.patientname    +'</td><td> '
                                                + result.price  +'</td><td> '
                                                + result.appointmentdt  +'</td><td><font color="blue"> '+ btst  +'</font></td></tr>'; 
                                        }else{
                                            console.log("In else loop");
                                            //    trHTML  += '<tr><td colspan="5">No records !</td></tr>';
                                        }
                               });
                             
                            
                               //  console.log("trHTML : "+trHTML);  
                             
                             
                            
                           /*  for(i = 0;i<test.length;i++){
                                 console.log("Hello : "+test[i]);
                                 
                                 
                                 if(test.length-6 < i ){
                                     console.log("In if condition : "+test[i]);
                                     trHTML += '<tr><td>' + todayAppointment.ID +  '</td><td>' + todayAppointment.PATIENTNAME    +'</td><td> '
                                        + todayAppointment.APPOINTMENTTIME  +'</td><td><font color="blue"> '+ btst  +'</font></td></tr>'; 
                                 }else{
                                     if(testArray == ""){
                                     testArray = test[i];
                                 }else
                                     testArray = testArray+"$"+test[i];
                                 } 
                                 
                                 
                             }
                             console.log(testArray);
                             
                                if(test.STATUS == "Y")
                                  btst = "Completed";
                           else if(test.STATUS == "C"){
                               btst = "Canceled";
                           } else
                               btst = "Not Done";
                                 trHTML += '<tr><td>' + todayAppointment.ID +  '</td><td>' + todayAppointment.PATIENTNAME    +'</td><td> '+ todayAppointment.APPOINTMENTTIME  +'</td><td><font color="blue"> '+ btst  +'</font></td></tr>';
                                 */
                             });
                              $('#diagnosticsdetails').append(trHTML);
                         $('#diagnosticsdetails').load();
                         } 
                         
                           
                           
                        });
                        

                }
                
    });    
}

function reviver (key, value) {
   console.log("Value : "+value.price);
   console.log("Value : "+value.testData);
}

function validateData(){
    if($('#start').val() == ""){
        $('#endstarterrormsg').html("Please enter Start Date");
        return false;
    }else if($('#finish').val() == ""){
        $('#endfinisherrormsg').html("Please enter Start Date");
        return false;
    }else
        return true;
    
}