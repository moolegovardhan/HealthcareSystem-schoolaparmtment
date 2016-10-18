/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
    
    
    $('#medicineSearchErrorBlock').hide();
    $('#searchMedicine').click(function(){


        if($('#patientName').val() == "" && $('#patientId').val() == "" && $('#appointmentId').val() == "" && $('#mobileNo').val() == "" ){
            $('#medicineSearchErrorMessage').html("<b><font color='red' >Error : </b> Please enter atleast one criteria for searching Medicines</font>");
            $('#medicineSearchErrorBlock').show();
            return false;
        }
    	
    	if($('#patientName').val() == ""){
                patientname = "nodata";
            } else
            	patientname = $('#patientName').val();
            if($('#patientId').val() == ""){
                 patientid = "nodata";
            }else
            	patientid =$('#patientId').val();
            if($('#appointmentId').val() == ""){
            	appointmentid = "nodata";
            }else{
            	appointmentid = $('#appointmentId').val(); 
            }
            if($('#mobileNo').val() == ""){
            	mobileno = "nodata";
            }else
            	mobileno = $('#mobileNo').val();
            
            
          console.log(rootURL + '/fetchMedicineList/' + patientname +'/'+patientid +'/'+appointmentid+'/'+mobileno);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchMedicineList/' + patientname +'/'+patientid +'/'+appointmentid+'/'+mobileno,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                    $("#medicine_records_search_result_table tbody").remove();
                    console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                            	 
                                  $('#medicalErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#medicalErrorMessage').removeClass('out');
                                  $('#medicalErrorMessage').addClass('in');
                                    medicienData = responseMessageDetails.data;
                                     console.log("medicineData : "+medicienData);
                                     var trHTML = "";
                                     $.each(medicienData, function(index, medicienData) {

                               trHTML += '<tr><td>' + medicienData.appointmentid   +'</td><td>' + medicienData.PatientName  + 
                               '</td><td>' + medicienData.medicinename  + '</td><td>'+medicienData.PatientId+'</td><td>'+medicienData.AppointementDate+'</td><td><font color="blue"><i><a href="javascript:void(0)">Details</a></font></i></td></tr>';
                                     
                                    });   
                                        $('#medicine_records_search_result_table').append(trHTML);
                                        $('#medicine_records_search_result_table').load();
                                        
                             } else{
                                   $('#medicalErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#medicalErrorBlock').show();
                             }
                             
                     });   
                    
                }
            });    
            
    });
    
    /*
     * Added by achyuth for searching Medicine (Sep072015)
     * 
     */
    $('#searchMedicine1').click(function(){

    	if(validateMedicineSearchForm()){
    		if($('#medicineName').val() == ""){
                medicinename = "nodata";
                //$('#medicineSearchErrorMessage').html("<b>Error : </b> Please enter atleast one search criteria");
                //$('#medicineSearchErrorBlock').show();
                //return false;
            } else
            	medicinename = $('#medicineName').val();
    	
    		$.ajax({
                type: 'GET',
                url: rootURL + '/searchedMedicine/' +medicinename,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                    $('#medicine_list_data_table tbody').remove();
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                            	 
                                  $('#medicalErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#medicalErrorMessage').removeClass('out');
                                  $('#medicalErrorMessage').addClass('in');
                                    medicineData = responseMessageDetails.data;
                                     console.log("medicineData : "+medicineData);
                                     var trHTML = "";
                                     $.each(medicineData,function(key, value){

                               trHTML += '<tr><td><input type="checkbox" class="link-shop" id="'+medicineData[key].id+'" value="'+medicineData[key].id+'"/></td><td>' + medicineData[key].company   +'</td><td>' + medicineData[key].medicinename  + 
                               '</td><td>' + medicineData[key].technicalname  + '</td><td>'+medicineData[key].medicinetype+'</td><td>'+medicineData[key].strength+'</td><td>'+medicineData[key].units+'</td></tr>';
                               			
                                    });
                                     $('#medicine_list_data_table').append(trHTML);
                                        $('#medicine_list_data_table').load();
                                        $('#medicalErrorMessage').removeClass('in');
                                        $('#medicalErrorMessage').addClass('out');
                                        
                             } else{
                                   $('#medicalErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#medicalErrorMessage').removeClass('out');
                                   $('#medicalErrorMessage').addClass('in');
                             }
                             
                     });   
                    
                }
            }); 
    		
    		
        }
            
    });//End of change on Sep072015 (Searching medicines with Medicine Name)
    
    
    
    /*
     * Added by achyuth for searching Doctor with Doctor Name (Sep072015)
     * 
     */
    $('#searchDoctor').click(function(){

    	if(validateDoctorSearchForm()){
    		if($('#doctorName').val() == ""){
                doctorname = "nodata";
            } else
            	doctorname = $('#doctorName').val();
    	
    		$.ajax({
                type: 'GET',
                url: rootURL + '/searchDoctor/' +doctorname,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                    $('#doctor_list_data_table tbody').remove();
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                            	 
                                  $('#medicalErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#medicalErrorMessage').removeClass('out');
                                  $('#medicalErrorMessage').addClass('in');
                                    doctorData = responseMessageDetails.data;
                                     console.log("doctorData : "+doctorData);
                                     var trHTML = "";
                                     var line = 1;
                                     $.each(doctorData,function(key, value){
                                    	 
                               trHTML += '<tr><td>' + line   +'</td><td>000' + doctorData[key].ID + 
                               '</td><td>' + doctorData[key].name  + '</td><td>'+doctorData[key].name+'</td><td><a href="#" onclick="showDoctorPrescriptionDetails('+doctorData[key].ID+')">Details</a></td></tr>';
                               		line++;
                                    });

                                     $('#doctor_list_data_table').append(trHTML);
                                        $('#doctor_list_data_table').load();
                                        $('#medicalErrorMessage').removeClass('in');
                                        $('#medicalErrorMessage').addClass('out');
                                        
                             } else{
                                   $('#medicalErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#medicalErrorMessage').removeClass('out');
                                   $('#medicalErrorMessage').addClass('in');
                             }
                             
                     });   
                    
                }
            }); 
    		
    		
        }
            
    });//End of change on Sep072015 (Searching doctor with Doctor Name)
    
    
    /*
     * Added by achyuth for searching Doctor with Doctor Name on Doctor's Medicines screen(Sep072015)
     * 
     */
    $('#searchDoctorsMedicine').click(function(){
    		
    		var doctorname = $('#doctorName1').val();
    		
    		if(doctorname == ""){
    	        $('#medicalErrorMessage').html("<b><font color='red'>Error : </b> Please enter Doctor Name for search</font>");
    	        $('#medicalErrorMessage').removeClass('out');
    	        $('#medicalErrorMessage').addClass('in');
    	        return false;
    	    }
    	
    		$.ajax({
                type: 'GET',
                url: rootURL + '/searchDoctor/' +doctorname,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                    $('#doctorMedicine tr td').remove();
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                            	 
                                  $('#medicalErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#medicalErrorMessage').removeClass('out');
                                  $('#medicalErrorMessage').addClass('in');
                                    doctorData = responseMessageDetails.data;

                                    var trHTML = "";
                                     var line = 1;
                                     $.each(doctorData,function(key, value){
                                    	 
                               trHTML += '<tr class="data"><td>'+line+'</td><td>'+doctorData[key].name+'</td><td>'+doctorData[key].name+'</td>'+
                               '<td><a href="#" onclick="ShowDoctorMedicinesList('+doctorData[key].ID+')">Details</a></td>'+
                               '<td><a href="medicalindex.php?page=mapdoctormedicines&doctorId='+doctorData[key].ID+'&name='+doctorData[key].name+'">Map Medicines</a></td></tr>';
                               		line++;
                                    });

                                     $('#doctorMedicine').append(trHTML);
                                        $('#doctorMedicine').load();
                                        $('#medicalErrorMessage').removeClass('in');
                                        $('#medicalErrorMessage').addClass('out');
                                        
                             } else{
                                   $('#medicalErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#medicalErrorMessage').removeClass('out');
                                   $('#medicalErrorMessage').addClass('in');
                             }
                             
                     });   
                    
                }
            }); 
    		
    });//End of change on Sep072015 (Searching doctor with Doctor Name)
    
    
});

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

/*
 * Added by achyuth for validating search form for Medicine Search on Sep072015
 * 
 */
function validateMedicineSearchForm(){
	var medicineName = $('#medicineName').val();
	if(medicineName == ""){
        $('#medicalErrorMessage').html("<b><font color='red'>Error : </b> Please enter Medicine Name for search</font>");
        $('#medicalErrorMessage').removeClass('out');
        $('#medicalErrorMessage').addClass('in');
        return false;
    }else
        return true;
}

/*
 * Added by achyuth for validating search form for Doctor Search on Sep072015
 * 
 */
function validateDoctorSearchForm(){
	var doctorName = $('#doctorName').val();
	if(doctorName == ""){
        $('#medicalErrorMessage').html("<b><font color='red'>Error : </b> Please enter Doctor Name for search</font>");
        $('#medicalErrorMessage').removeClass('out');
        $('#medicalErrorMessage').addClass('in');
        return false;
    }else
        return true;
}


function showAppoinmentDataTab(){
	$("#appoinmentTabData").show();
	//$('#medicalHomeData').hide();
}
