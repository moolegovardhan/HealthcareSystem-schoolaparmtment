/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    
    $('#searchformedicines').click( function(){
        patientid = $('#patientId').val();
        patientname = $('#patientname').val();
        mobile = $('#mobile').val();
        if(patientid != "")
            fetchPatientAppointmentMedicines();
        else
            fetchListOfPatientDetails(patientname,mobile);
    });
    
});

function fetchListOfPatientDetails(patientname){
    ///fetchMedicineList/:patientname/:patientid/:appointmentid/:mobile
    
     patientid = $('#patientId').val();
     if(patientid == "")
       patientid = "nodata";
     patientname = $('#patientname').val();
     if(patientname == "")
       patientname = "nodata";
    
       appointmentid = "nodata";
       
     mobile = $('#mobile').val();
     if(mobile == "")
       mobile = "nodata";
   
     
     
    console.log(rootURL + '/fetchAppointmentMedicines/' + patientname+'/' + patientid+'/' + appointmentid+'/' + mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchAppointmentMedicines/' + patientname+'/' + patientid+'/' + appointmentid+'/' + mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
					
                    $('#patient_appointment_medicines_table tbody').html('');
                    
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
                                         console.log("userDetails.........>>>>>........"+userDetails.patientname);   
  		
                          $('#patientname').html(userDetails.patientname);               
           							  
		  $('#patient_appointment_medicines_table tbody').append('<tr class="data"><td>'+userDetails.appointementdate+'</td><td>'+userDetails.DoctorName+'</td><td>' + userDetails.HospitalName + '</td><td>' + userDetails.medicinename  + '</td><td>' + userDetails.dosage+'</td><td>' + userDetails.MBF  + '</td><td>' + userDetails.MAF  + '</td><td>' + userDetails.EAF  + '</td><td>' + userDetails.AAF  + '</td><td>' + userDetails.EBF  + '</td><td>' + userDetails.EAF  + '</td><td>' + userDetails.noofdays  + '</td></tr>');
                                        

                    });    
        //$('#patient_consultation_records_search_result_table').append(trHTML);
        //$('#patient_consultation_records_search_result_table').load();


                          /*for (var i = 0; i < objLength; i++) {
                                  $//('#patient_consultation_records_search_result_table tbody').append('<tr class="data" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
                          }*/
                          $('#tablePaging').show();
                          /* Pagination Code Start */
                          load = function() {
                                 window.tp = new Pagination('#tablePaging', {
                                 itemsCount: objLength,
                                 onPageSizeChange: function (ps) {
                                         console.log('changed to ' + ps);
                                 },
                                 onPageChange: function (paging) {
                                         //custom paging logic here
                                         //console.log(paging);
                                         var start = paging.pageSize * (paging.currentPage - 1),
                                                 end = start + paging.pageSize,
                                                 $rows = $('#patient_appointment_medicines_table tbody').find('.data');

                                         $rows.hide();

                                         for (var i = start; i < end; i++) {
                                                 $rows.eq(i).show();
                                         }
                                 }
                                 });
                          /* Pagination Code End */
                          }

                          load();

                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                                   $('#patient_appointment_medicines_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
                    
                }
            });
    
    
}
function fetchPatientAppointmentMedicines(){
    patientid = $('#patientId').val();
    console.log(rootURL + '/fetchMedicinesByAppointmentForPatient/' + patientid);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchMedicinesByAppointmentForPatient/' + patientid,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
					
                    $('#patient_appointment_medicines_table tbody').html('');
                    
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
                                         console.log("userDetails.........>>>>>........"+userDetails.patientname);   
  		
                          $('#patientname').html(userDetails.patientname);               
           							  
		  $('#patient_appointment_medicines_table tbody').append('<tr class="data"><td>'+userDetails.appointementdate+'</td><td>'+userDetails.DoctorName+'</td><td>' + userDetails.HospitalName + '</td><td>' + userDetails.medicinename  + '</td><td>' + userDetails.dosage+'</td><td>' + userDetails.MBF  + '</td><td>' + userDetails.MAF  + '</td><td>' + userDetails.EAF  + '</td><td>' + userDetails.AAF  + '</td><td>' + userDetails.EBF  + '</td><td>' + userDetails.EAF  + '</td><td>' + userDetails.noofdays  + '</td></tr>');
                                        

                    });    
        //$('#patient_consultation_records_search_result_table').append(trHTML);
        //$('#patient_consultation_records_search_result_table').load();


                          /*for (var i = 0; i < objLength; i++) {
                                  $//('#patient_consultation_records_search_result_table tbody').append('<tr class="data" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
                          }*/
                          $('#tablePaging').show();
                          /* Pagination Code Start */
                          load = function() {
                                 window.tp = new Pagination('#tablePaging', {
                                 itemsCount: objLength,
                                 onPageSizeChange: function (ps) {
                                         console.log('changed to ' + ps);
                                 },
                                 onPageChange: function (paging) {
                                         //custom paging logic here
                                         //console.log(paging);
                                         var start = paging.pageSize * (paging.currentPage - 1),
                                                 end = start + paging.pageSize,
                                                 $rows = $('#patient_appointment_medicines_table tbody').find('.data');

                                         $rows.hide();

                                         for (var i = start; i < end; i++) {
                                                 $rows.eq(i).show();
                                         }
                                 }
                                 });
                          /* Pagination Code End */
                          }

                          load();

                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                                   $('#patient_appointment_medicines_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
                    
                }
            });
            
}
