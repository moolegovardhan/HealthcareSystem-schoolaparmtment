var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
   
    $('#counter').val("0");
    if(getUrlParam('frompage') == "optoprescription"){
        $("#collapse-Two").collapse({"toggle": true, 'parent': '#accordion-1',active:true});
       $("#collapse-One").collapse({"toggle": true, 'parent': '#accordion-1',active:false});
      // patientid="+$('#hiddendoctorName').val()+"&patientname="+$('#hiddenpatientName').val()+"&doctorid="+$('#hiddendoctorId').val()+
      // "&doctorname="+$('#hiddendoctorName').val()+"&appointmentid="+$('#hidappointmentId').val()+"&hospitalid="+$('#hidhospitalId').val()+
      // "&hospitalname="+$('#hidhospitalName').val()
      console.log("patientname"+unescape(getUrlParam("patientname")));
        $('#hiddenpatientName').val(unescape(getUrlParam("patientname")));  
        $('#hiddendoctorName').val(unescape(getUrlParam("doctorname")));
        $('#hidhospitalName').val(unescape(getUrlParam("hospitalname")));
        $('#hiddendoctorId').val(unescape(getUrlParam("doctorid")));
        $('#hidhospitalId').val(unescape(getUrlParam("hospitalid")));
        $('#hidappointmentDate').val(unescape(getUrlParam("appointmentdate")));
        $('#hidappointmentId').val(unescape(getUrlParam("appointmentid")));
        $('#hiddenpatientId').val(unescape(getUrlParam("patientid")));
        
        $('#prespatientName').html(unescape(getUrlParam("patientname")));
        $('#doctorName').html(unescape(getUrlParam("doctorname")));
        $('#hospitalName').html(unescape(getUrlParam("hospitalname")));
        $('#appointmentDate').html(unescape(getUrlParam("appointmentdate")));
    }
    
//    $('#showPatientOpthoMasterData').click( function(){
//        console.log("Show Master Data");
//        $('#searchPregnancyMasterModal').modal('show');
//    });
//    
//    $('#submitPatientOpthoMasterData').click(function() {
//        rDiagnosis = $('#rDiagnosis').val();
//        lDiagnosis = $('#lDiagnosis').val();
//        
//        rDiagnosisCode = $('#rDiagnosisCode').val();
//        lDiagnosisCode = $('#lDiagnosisCode').val();
//       
//        rLidsandAdnexae = $('#rLidsandAdnexae').val();
//        lLidsandAdnexae = $('#lLidsandAdnexae').val();
//
//        rLacrimalDucts = $('#rLacrimalDucts').val();
//        lLacrimalDucts = $('#lLacrimalDucts').val();
//        
//        rConjunctiva = $('#rConjunctiva').val();
//        lConjunctiva = $('#lConjunctiva').val();
//        
//        rCornea = $('#rCornea').val();
//        lCornea = $('#lCornea').val();
//        
//        rAnteriorChamber = $('#rAnteriorChamber').val();
//        lAnteriorChamber = $('#lAnteriorChamber').val();
//        
//        rIris = $('#rIris').val();
//        lIris = $('#lIris').val();
//        
//        rPupil = $('#rPupil').val();
//        lPupil = $('#lPupil').val();
//        
//        rLens = $('#rLens').val();
//        lLens = $('#lLens').val();
//        
//        rOcularMovements = $('#rOcularMovements').val();
//        lOcularMovements = $('#lOcularMovements').val();
//      
//        
//        addPatientOpthoMasterData(rDiagnosis,lDiagnosis,rDiagnosisCode,lDiagnosisCode,rLidsandAdnexae,lLidsandAdnexae,rLacrimalDucts,lLacrimalDucts,rConjunctiva,lConjunctiva,rCornea,lCornea,rAnteriorChamber,lAnteriorChamber,rIris,lIris,rPupil,lPupil,rLens,lLens,rOcularMovements,lOcularMovements);
//        
//    });
//    
    
   $('#searchPrescriptionPrescription').click( function() {
       
         if($('#patientName').val() == ""){
                patientname = "nodata";
            } else
                patientname = $('#patientName').val();
            if($('#patientID').val() == ""){
                 patientid = "nodata";
            }else
                patientid =$('#patientID').val();
            if($('#appointmentID').val() == ""){
                 appid = "nodata";
            }else{
                appid = $('#appointmentID').val(); 
            }
            if($('#mobile').val() == ""){
                 mobile = "nodata";
            }else
                mobile = $('#mobile').val();
            
            console.log(rootURL + '/fetchOpthomologyConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchOpthomologyConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $('#patient_opthomology_consultation_records_search_result_table tbody').html('');
                    
                    var objLength = '';
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  //$('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  //$('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     objLength = userData.length;
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
                                        datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId;  
                                       console.log("datatopass : "+datatopass);    
                                         console.log("index........"+(index < 1));
                                         if(index < 1 && patientid != "nodata")
                                         btst ='<font color="blue"><i><a href="#" onclick=showOpthamologyDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
                                         else{
                                             if(patientid != "nodata")
                                                btst = "";
                                             else
                                                 btst ='<font color="blue"><i><a href="#" onclick=showOpthamologyDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';

                                         }    
  
  				
									  
	  $('#patient_opthomology_consultation_records_search_result_table tbody').append('<tr class="data"><td>'+s+'</td><td>'+userDetails.PatientName+'</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime+ '</td><td>'+btst+'</td></tr>');
                                        
                          // showDetailsForNavigationtoPrescription(escape(datatopass));
                                       
                                        
                                    });    
                                      	
                                        
                             } else{
                                   $('#staffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#staffErrorBlock').show();
                                   $('#patient_pregnancy_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
                    
                }
            });
    });
    
    
});
function getUrlParam(sParam){
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

function showOpthamologyDetails(s){
   // datapass = (unescape(s).split("$"));
   
    $("#collapse-Two").collapse({"toggle": true, 'parent': '#accordion-1',active:true});
    $("#collapse-One").collapse({"toggle": true, 'parent': '#accordion-1',active:false});
    
     // $('#listofpatients').hide();
    //   $('#patientHistoryPanel').hide();
     console.log(unescape(s));
    $('#prescriptionpanel').show();
    
     datapass = (unescape(s).split("$"));    
     console.log((datapass));  
     $('#hiddenpatientName').val(datapass[5]);  
     $('#hiddendoctorName').val(datapass[4]);
     $('#hidhospitalName').val(datapass[3]);
     $('#hiddendoctorId').val(datapass[7]);
     $('#hidhospitalId').val(datapass[6]);
     $('#hidappointmentDate').val(datapass[2]);
     $('#hidappointmentId').val(datapass[1]);
     $('#hiddenpatientId').val(datapass[0]);
    
    $('#prespatientName').html(datapass[5]);
    $('#doctorName').html(datapass[4]);
    $('#hospitalName').html(datapass[3]);
    $('#appointmentDate').html(datapass[2]);

      
}


//function addPatientOpthoMasterData(rDiagnosis,lDiagnosis,rDiagnosisCode,lDiagnosisCode,rLidsandAdnexae,lLidsandAdnexae,rLacrimalDucts,lLacrimalDucts,rConjunctiva,lConjunctiva,rCornea,lCornea,rAnteriorChamber,lAnteriorChamber,rIris,lIris,rPupil,lPupil,rLens,lLens,rOcularMovements,lOcularMovements){
//  /*
//   * :patientid,:patientname,:doctorid,:doctorname,:hospitalid,:hospitalname,"
//                . ":rDiagnosis,:lDiagnosis,:rDiagnosisCode,:lDiagnosisCode,:rLidsandAdnexae,:lLidsandAdnexae,:rLacrimalDucts,:lLacrimalDucts,:rConjunctiva,:lConjunctiva,:rCornea,:lCornea,:rAnteriorChamber,:lAnteriorChamber,:rIris,:lIris,:rPupil,:lPupil,:rLens,:lLens,:rOcularMovements,:lOcularMovements,:'Y')";
//   */ 
//
//  patientname = $('#hiddenpatientName').val();
//  patientid = $('#hiddenpatientId').val();
//  hospitalid = $('#hidhospitalId').val();
//  hospitalname = $('#hidhospitalName').val();
//  doctorid = $('#hiddendoctorId').val();
//  doctorname = $('#hiddendoctorName').val();
//  
//  
//     var registerData = JSON.stringify( {"patientid" : patientid,"patientname" : patientname,
//         "doctorname" : doctorname,"doctorid" : doctorid,"hospitalid" : hospitalid,"hospitalname" : hospitalname,
//         "rDiagnosis" : rDiagnosis,"lDiagnosis" : lDiagnosis,"rDiagnosisCode" : rDiagnosisCode,
//         "lDiagnosisCode" : lDiagnosisCode,"rLidsandAdnexae" : rLidsandAdnexae,"lLidsandAdnexae": lLidsandAdnexae,
//         "rLacrimalDucts" : rLacrimalDucts, "lLacrimalDucts": lLacrimalDucts, "rConjunctiva": rConjunctiva,"lConjunctiva": lConjunctiva,
//         "rCornea": rCornea,"lCornea": lCornea,"rAnteriorChamber": rAnteriorChamber,"lAnteriorChamber": lAnteriorChamber,"rIris": rIris,
//         "lIris": lIris,"rPupil": rPupil,"lPupil": lPupil,"rLens": rLens,"lLens": lLens,"rOcularMovements": rOcularMovements,"lOcularMovements": lOcularMovements});
//        
//    console.log("data "+registerData);
//        
//        $.ajax({
//            type: 'POST',
//            contentType: 'application/json',
//            url: rootURL+'/insertPatientOpthoMasterData',
//            dataType: "json",
//            data:  registerData,
//            success: function(data, textStatus, jqXHR){
//                $('#displayMessage').html('Data Updated Successfully');
//            }
//        });   
//}

function getUrlParam(sParam){
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


      


                
                