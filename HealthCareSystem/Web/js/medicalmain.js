/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();


function fetchURLParameters(sParam){
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


function showMedicineAdd(){
  $('#myMedicinesModal').modal('show');  
}

function mapDoctorMedicines(){
    
 window.location.href = "../medical/medicalindex.php?page=mapdoctormedicines";
}

function createMedicin(){
	var companyName = $('#companyName').val();
	var medicineName = $('#newMedicineName').val();
	var technicalName = $('#technicalName').val();
	var dosage = $('#dosage').val();
	var medicineType = $('#medicineType').val();
	var units = $('#units').val();
	var createdby = $('#userId').val();

	var labData = JSON.stringify( {"company":companyName,"medicinename":medicineName,"technicalname":technicalName,"dosage":dosage,"medicinetype":medicineType,"units":units,"status":"Y","createdby":createdby} );
	$.ajax({
		type: 'POST',
		url: rootURL + '/createMedicin',
		dataType: "json",
		data:labData,
		success: function(data){
			alert(data.responseMessageDetails.message);
			//window.location.href=rootURL+"/Web/medical/medicalindex.php?page=createmedicine";
		}
  });
}
function linkToShop(){
	$('.link-shop').each(function(){
            
		if($(this).is(':checked') == true){
			var medicineId = $(this).attr('id');
                        console.log(medicineId);
                        console.log(rootURL + '/linkMedicineToshop/'+medicineId);
			$.ajax({
				type: 'POST',
				url: rootURL + '/linkMedicineToshop/'+medicineId,
				dataType: "json",
				success: function(data){
					alert(data.responseMessageDetails.message);
					//window.location.href=rootURL+"/Web/medical/medicalindex.php?page=createmedicine";
				}
		  });
		}
	});
        
      
        
}

function linkMedicineToDoctor(doctorId){
    
	$('.link-shop').each(function(){
		if($(this).is(':checked') == true){
			var medicineId = $(this).attr('id');
                        console.log(rootURL + '/linkMedicineToDoctor/'+medicineId+"/"+doctorId);
			$.ajax({
				type: 'POST',
				url: rootURL + '/linkMedicineToDoctor/'+medicineId+"/"+doctorId,
				dataType: "json",
				success: function(data){
                                    requestFrom = fetchURLParameters('page');
					
                                        if(requestFrom == "doctorMedicines")
                                            window.location.href=rootURL+"/Web/doctor/doctorindex.php?page=doctorMedicines";
                                        else
                                            window.location.href=rootURL+"/Web/medical/medicalindex.php?page=doctorMedicines";
				}
		  });
		}
                alert("Medicine Mapped Successfully");
	});
}


  function linkMedicineToSingleDoctor(doctorId){
      
        jsonObj = [];
      $('.link-doctor').each(function(){
		if($(this).is(':checked') == true){
			var medicineId = $(this).attr('id');
                      
                 item = {}
                 item ["medicineid"] = medicineId;
                 item ["doctorid"] = doctorId;
                 jsonObj.push(item);
		}
	});
        console.log(JSON.stringify(jsonObj));
        $.ajax({
                type: 'POST',
                url: rootURL + '/linkMedicineToSingleDoctor',
                dataType: "json",
                 data:JSON.stringify(jsonObj),
                success: function(data){
                        alert(data.responseMessageDetails.message);
                        window.location.href=rootURL+"/Web/doctor/doctorindex.php?page=doctorMedicines";
                }
           });
}


function ShowDoctorMedicinesList(doctorId){
	$.ajax({
		type: 'GET',
		url: rootURL + '/showDoctorMedicine/'+doctorId,
		dataType: "json",
		success: function(data){
			$('#medicinDoctor').html('');
			var newData = Array();
			$.each(data,function(key, value){
				$('#medicinDoctor').append('<tr id="'+data[key].id+'"><td>'+(key+1)+'</td><td>'+data[key].company+'</td><td>'+data[key].medicinename+'</td><td>'+data[key].technicalname+'</td></tr>');
			});
			$('#myDoctorMedicinesModal').modal('show'); 
		}
  });
}

function showDoctorPrescriptionDetails(doctorId){
	$.ajax({
		type: 'GET',
		url: rootURL + '/showDoctorPrescribedData/'+doctorId,
		dataType: "json",
		success: function(data){
			//alert(data[0].id);
			//var newData2 = data.responseMessageDetails;
			//var dataLength = newData2.data.length;
			$('#doctorPrescription').html('');
			//var newData = Array();
			/*var oldAppId = "";
			$.each(data,function(key, value){
				if(data[key].id != oldAppId)
				{
					//oldAppId = "";
					$('#doctorPrescription').append('<tr id="'+data[key].medicinename+'"><td>'+data[key].noofdays+'</td><td>'+data[key].totalcount+'</td></tr>');
					oldAppId = data[key].id;
				}
				else
				{
					$('#nameValue_'+data[key].id).append('<br/>'+data[key].namevalue);
					
				}
				//$('#doctorPrescription').append('<tr id="'+data[key].id+'"><td>'+data[key].PatientName+'</td><td>'+data[key].id+'</td><td>'+data[key].AppointementDate+'</td><td>'+data[key].AppointmentTime+'</td><td>'+data[key].namevalue+'</td></tr>');
			});*/
			
			$('.doctor-name-text').text($('#doctorName_'+doctorId).text());
			if(data.length > 0){
				$.each(data,function(key, value){
					$('#doctorPrescription').append('<tr id="'+data[key].id+'"><td>'+data[key].medicinename+'</td><td>'+data[key].noofdays+'</td><td>'+data[key].totalcount+'</td></tr>');
				});
			}else{
				$('#doctorPrescription').append('<tr><td colspan="3" style="text-align:center;">No Data Found</td>');
			}
			
		}
  });
	$('#myDoctorMedicinesPatientModal').modal('show');  
}





$(document).ready(function(){
	$('.search-with-char li a').on('click',function(){
		var letter = $(this).text();
		$.ajax({
			type: 'GET',
			url: rootURL + '/fetchMedicinesWithCharter/'+letter,
			dataType: "json",
			success: function(data){
				$('#medicine_list_doctor_data_table tbody').html('');
				var objLength = data.length;
				var labDataObj = data;
				
				if(objLength  > 0){
					for (var i = 0; i < objLength; i++) {
						$('#medicine_list_doctor_data_table tbody').append('<tr class="data"><td><input type="checkbox" id="'+labDataObj[i].id+'" class="link-doctor"/></td><td>'+labDataObj[i].company+'</td><td>'+labDataObj[i].medicinename+'</td><td>'+labDataObj[i].technicalname+'</td><td>'+labDataObj[i].medicinetype+'</td><td>'+labDataObj[i].strength+'</td><td>'+labDataObj[i].units+'</td></tr>');
					}
					
					load = function() {
						window.tp = new Pagination('#tablePaging', {
							itemsCount: objLength,
							onPageSizeChange: function (ps) {
								console.log('changed to ' + ps);
							},
							onPageChange: function (paging) {
								//custom paging logic here
								console.log(paging);
								var start = paging.pageSize * (paging.currentPage - 1),
									end = start + paging.pageSize,
									$rows = $('#medicine_list_doctor_data_table tbody').find('.data');

								$rows.hide();

								for (var i = start; i < end; i++) {
									$rows.eq(i).show();
								}
							}
						});
					}

				load();
				
				}else{
					$('#medicine_list_doctor_data_table tbody').append('<tr><td colspan="7" style="text-align:center;">No Data Found</td></tr>');
					$('#tablePaging').html('');
				}
			}
	  });
	});
        
        $('#quickregister').click(function() {
        $('#errorDisplay').html("  ");
            
            var sEmail = $('#qemail').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
           if(sEmail.length > 1)  {
             if (!filter.test(sEmail))  {
                   $("#errorDisplay").html("Please enter email address or invalid email address").show();
                    $('#errormessages').show();
                 return false;
             }
           }
           
       
       
        if(registerQuickFormValidate()){
            console.log("In if condition validation success ");
            clearValidationMessage()
            checkQuickUserId($('#qmobile').val());
           }else{
               console.log("In else ");
               $('#errormessages').show();
           } 

        var flag = "";
       
    });
    
    
     $('#fetchPatientForMedicines').click( function(){
            fetchPatientList();
        });
        $('#medicinescost').val("0");
        $('#counter').val("0");
        $("#medicinestabledata").hide();
    $('#addMedicine').click( function(){
      count = parseInt($('#counter').val())+1;
        medicineName = $('#medicinename').val();
        
        cost = $('#cost').val();
        medicinecount = $('#medicinecount').val();
        data = medicineName+"#"+medicinecount+"#"+cost;
        console.log("cost..............."+parseInt(cost));
        trHTML = "";
        if(medicineName != ""){
            btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
           btnEdit = '<button class="btn btn-warning btn-xs" onclick="editData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
        
            trHTML =trHTML+'<tr id='+count+'><td>'+medicineName+'</td><td>'+medicinecount+'</td><td>'+cost+'</td><td>'+btnEdit+'&nbsp;&nbsp;&nbsp;'+btnDelete+'</td></tr>';
            $('#patient_medicines_distribute_patient_table').append(trHTML);
            $('#patient_medicines_distribute_patient_table').load();
        }
        if(parseInt(cost) > 0){
         totalCost = $('#medicinescost').val();
         console.log($('#medicinescost').val());
        totalCost = parseInt($('#medicinescost').val())+parseInt(cost);
        $('#medicinescost').val( parseInt($('#medicinescost').val())+parseInt(cost));
        console.log(cost);
    }
        $('#totalcost').html(totalCost);
        createHiddenTextBox(data,count);
        $('#medicinename').val("");
        $('#medicinecount').val("");
        $('#cost').val("");
    });
    //createHiddenTextBox
    
    $('#showMedicineSerachPop').click(function(){
    	$('#searchMedicinesModal').modal('show');
    }); 
    
    
    
    
  $('#submitMedicalPatientPaymentDetails').click( function(){
        
        console.log($('#pcardtype').val());
        console.log($('#pcardamount').val());
        console.log($('#psalesperson').val());
        console.log(console.log($('#ppatientid').val()));
         var patientData = JSON.stringify( {"patientId" : $('#ppatientid').val(),"cardAmount" : $('#pcardamount').val(),"officeid":$('#officeid').val(),"insttype":"Medical Shop"} );
        
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
                      window.location.href = rootURL + "/Web/medical/medicalindex.php?page=payments&start=0&end=100&patientname="+patientname;
                  }else
                      window.location.href = rootURL + "/Web/medical/medicalindex.php?page=payments";

    });
});




function openregister(){
    
    $('#showQuickRegister').modal('show');
}


function checkQuickUserId(userId){
    
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
                        
                        
                        registerQuickNewUser();
                        
                        
                    }
                    
                }else if(responseMessageDetails.status == "Fail"){
                   $('#errorDisplay').html(responseMessageDetails.message);
                   $('#errormessages').show()
                }else {
                    $('#errorDisplay').html("Sorry Intermittent Error. Please try after some time");
                    $('#errormessages').show()
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



function registerQuickNewUser(){
    
     registerQuickUser($('#qmobile').val(),$('#qpassword').val(),$('#qemail').val(),$('#qmobile').val(),'Others',$('#qname').val());


}


function registerQuickUser(userName,password,email,mobile,profession,name){
   
    var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"name":name,"insttype":"Medical Shop"} );
        
    console.log("data "+registerData);
       console.log(rootURL+'/quickRegister'); 
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
                       console.log("In SUccess"+responseMessageDetails.message);
                       $('#errorDisplay').html(responseMessageDetails.message);
                       $('#errormessages').show();
                        var mobileNumber = mobile;
                    	//var message = responseMessageDetails.message;
                    	var message = responseMessageDetails.comments;
                    	var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+mobileNumber+"&text="+message+"&priority=ndnd&stype=normal";

                    	$.post(url, function(data){
                    		//Need to show some message if we get response from the SMS api.
                    		//Currently we are just sending Message after Signup
                    	});
                    	
                       clearFormValues();
                   }else{
                       console.log("In fail");
                       if(message.indexOf("Exists") > 0){
                            
                           $('#errorDisplay').html("User Id already exists");
                            $('#errormessages').show();
                       }else{
                           
                           $('#errorDisplay').html(responseMessageDetails.message);
                            $('#errormessages').show();
                            clearFormValues();
                       }
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


function registerQuickFormValidate(){
    console.log("validation"+$('#qmobile').val()+" Hello");
    clearValidationMessage();
    if($('#qmobile').val() == ""){
        console.log("new user");
        $('#errorDisplay').html("Please enter Mobile Number"); 
        $('#qmobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    if($('#qmobile').val().length < 10){
         console.log("new user less then 10");
        $('#errorDisplay').html("Mobile Number Minimum length is 10"); 
        $('#qmobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
     if($('#qpassword').val() == ""){
          console.log("password");
        $('#errorDisplay').html("Please enter password"); 
         $('#qpassword').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
    if($('#qpassword').val().length < 5){
         console.log("pass les then 5");
        $('#errorDisplay').html("Password Minimum length is 5"); 
         $('#qpassword').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
   // alert("Hello");
     if($('#qname').val().length < 1){
         console.log("name");
        $('#errorDisplay').html("Please enter name"); 
        $('#qname').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    /*
     if($('#email').val().length < 1){
          console.log("email");
        $('#errorDisplay').html("Please enter email");  
        $('#email').attr('style', 'background-color: #FBFAC9');
        return false; 
    }*/
     if($('#qmobile').val().length < 1){
          console.log("mobile");
        $('#errorDisplay').html("Please enter mobile #"); 
        $('#qmobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    
    
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
    $('#proferrormsg').html("") ; 
     $('#aadharerrormsg').html("") ; 
     $('#cityerrormsg').html("") ; 
       $('#errorDisplay').html("") ; 
         $('#errmsg').html("") ; 
           $('#starterrormsg').html("") ; 

}

function fetchPatientList(){
    
      console.log($('#patientname').val());
    console.log($('#mobilenumber').val());
   
    ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
    if($('#patientname').val() == ""){
      patientname ='nodata';  
    }else
        patientname = $('#patientname').val();
    if($('#mobilenumber').val() == ""){
      mobile ='nodata';  
    }else
        mobile = $('#mobilenumber').val();
   //:patientname/:patientid/:appid/:mobile
    console.log(rootURL + '/fetchPatientList/' + patientname +'/nodata/nodata/'+mobile);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchPatientList/' + patientname +'/nodata/nodata/'+mobile,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#fetch_patient_list tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.patientData;
                        console.log(patientData);
                        console.log("data count "+((patientData.length) > 0));
                        if(((patientData.length) > 0)){
                            patientcid = "";
                             $.each(patientData, function(index, data) {
                               if(data.address === undefined)
                                   address = "";
                               else
                                   address = data.address;
                               console.log(data);
                               
                                 link = "<font color='blue'><a href='#' onclick='distributeMedicines("+data.ID+")'>Distribute</a></font>";
                                 trHTML ="<tr><td>"+data.name+"</td><td>"+data.ID+"</td><td>"+data.mobile+"</td><td>"+address+"</td>\n\
<td nowrap='true'>"+link+"</td></tr>";
                                       $('#fetch_patient_list').append(trHTML);
                                        $('#fetch_patient_list').load();
                                
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='5' align='center'><b>No Data</b></td></tr>";
                            $('#fetch_patient_list').append(trHTML);
                             $('#fetch_patient_list').load();
                        }
                         
                    }
                });

                        
        }
    });   
    
}

function distributeMedicines(patientId){
    console.log(patientId);
    $('#totalcost').html("0");
    $('#medicinesforPatient').val(patientId);
    $('#showMedicineDistribution').modal('show');//createLabsTest
    
}





function deleteData(rowData){
   console.log("In"+rowData);
   try{
        row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
         var dataToEdit = $('#textbox'+rowData).val();
         var splitDataToEdit = dataToEdit.split("#");
         
          $('#medicinescost').val( parseInt($('#medicinescost').val())-parseInt(splitDataToEdit[2]));
           $('#totalcost').html($('#medicinescost').val());
          $("#TextBoxDiv" + rowData).remove();
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}

function editData(rowData){
   console.log("In"+rowData);
   try{
         //alert($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         var splitDataToEdit = dataToEdit.split("#");
    //gmedicine+"#"+dmedicine+"#"+nofodays+"#"+mbm+"#"+mam+"#"+abm+"#"+aam+"#"+ebm+"#"+eam;
     $('#medicinename').val(splitDataToEdit[0]);
     $('#medicinecount').val(splitDataToEdit[1]);
    $('#cost').val(splitDataToEdit[2]); 
        //totalCost = parseInt($('#medicinescost').val())-parseInt(splitDataToEdit[2]);
        $('#medicinescost').val( parseInt($('#medicinescost').val())-parseInt(splitDataToEdit[2]));
        
    $("#TextBoxDiv" + rowData).remove();
      row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function createHiddenTextBox(data,count){
    
    console.log("in create div");
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html('<label>Textbox #'+ count + ' : </label>' +
	      '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#medicinestabledata");

				
	$('#counter').val(count);
    
}


function searchGenericMedicine(){
	var serchData = $('#searchMedicine').val();
	$.ajax({
		type: 'GET',
		url: rootURL + '/fetchMedicinesList/'+serchData,
		dataType: "json",
		success: function(data){
			$('#searchMedicinesResults').show();
			$('#searchMedicinesResults tbody').html('');
			var objLength = data.length;
			if(objLength > 0){
				 for (var i = 0; i < objLength; i++) {
					 $('#searchMedicinesResults tbody').append('<tr class="data" onclick="addSearchMedicine('+data[i].id+')" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
					}
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
							$rows = $('#searchMedicinesResults tbody').find('.data');
	
						$rows.hide();
	
						for (var i = start; i < end; i++) {
							$rows.eq(i).show();
						}
					}
					});
				 /* Pagination Code End */
				 }
	
				 load();
			}else{
				$('#searchMedicinesResults tbody').append('<tr><td colspan="2" style="text-align:center;">No Data Found</td></tr>');
				$('#tablePaging').hide();
			}
			 
			}
  });
}
function addSearchMedicine(id){
	$('#medicinename').val($('#row_'+id).find('.medicine-name').text());
	$('#searchMedicinesModal').modal('hide'); 
}

function editPaymentDetails(id){
    console.log('Hellooooo');
    $('#ppatientid').val(id); 
    $('#myPatientPaymentDetails').modal('show');
    
    
}