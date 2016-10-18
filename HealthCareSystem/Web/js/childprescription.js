var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
   console.log("From Page : "+getUrlParam('frompage'));
    fetchVacinationList();
    $('#counter').val("0");
     if(getUrlParam('frompage') == "childprescription"){
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
    
    $('#showChildMedicineSerachPop').click(function(){
    	$('#searchNewChildMedicinesModal').modal('show');
    }); 
    
    $('#showChildDoctorMedicineSerachPop').click(function(){
    	$('#searchNewChildDoctorMedicinesModal').modal('show');
    });
    
    $('#btnAddChildMedicinesSpecificData').click( function(){
      addChildMedicinestoTable();  
    });
    
    
    $('#showChildMedicines').click(function(){
        
        fetchMedicines();
    });
    
    $('#showChildMedicalTests').click( function() {
        fetchChildTests();
        
    });
    
    $('#showPatientMasterData').click( function(){
        console.log("Show Master Data");
        $('#searchChildMasterModal').modal('show');
    });
    
    $('#submitPatientChildMasterData').click(function() {
        weight = $('#mweight').val();
        height = $('#mheight').val();
        bp = $('#mbp').val();
        month = $('#mcurrentmonth').val();
        weight = $('#mweight').val();
        
        eyes = $('#eyes').val();
        ears = $('#ears').val();
        lungs = $('#lungs').val();
        hearth = $('#hearth').val();
        
        legs = $('#legs').val();
        hands = $('#hands').val();
        observations = $('#observations').val();
      
        var appdt = ($('#cdate').val()).split('.');
        var birthdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        addPatientChildMasterData(weight,height,bp,month,birthdate,eyes,ears,lungs,hearth,legs,hands,observations);
        
    });
    
    
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
            
     console.log(rootURL + '/fetchChildConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchChildConsultationList/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
					
                    $('#patient_child_consultation_records_search_result_table tbody').html('');
                    
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
                                         btst ='<font color="blue"><i><a href="#" onclick=showChildDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
                                         else{
                                             if(patientid != "nodata")
                                                btst = "";
                                             else
                                                 btst ='<font color="blue"><i><a href="#" onclick=showChildDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';

                                         }    
  
  				
									  
	  $('#patient_child_consultation_records_search_result_table tbody').append('<tr class="data"><td>'+s+'</td><td>'+userDetails.PatientName+'</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime+ '</td><td>'+btst+'</td></tr>');
                                        
                          // showDetailsForNavigationtoPrescription(escape(datatopass));
                                       
                                        
                                    });    
                                      	
                                        
                             } else{
                                   $('#staffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#staffErrorBlock').show();
                                   $('#patient_child_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
                    
                }
            });
    });
    
    
});//


function fetchMedicines(){
    
   s = $('#officeid').val();
   console.log(rootURL + '/fetchChildMedicines/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchChildMedicines/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#child_medicine_existing_records_search_result_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                       
                          userData = responseMessageDetails.data;

                          console.log("userData : "+userData.length);
                          var trHTML = "";
                          $.each(userData, function(index, userDetails) {
                              s = userDetails.id;
                              s = userDetails.id;
                                s = s.replace(/^0+/, '');
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.medicinename+"#"+userDetails.observation); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.medicinename + '</td><td>' 
                                           + userDetails.observation +'</td></tr>';
                               });
                           $('#child_medicine_existing_records_search_result_table').append(trHTML);
                           $('#child_medicine_existing_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
        }
         
	});  
       
    $('#searchChildMedicinesModal').modal('show');
}


function fetchChildTests(){
  
    s = $('#officeid').val();  
   console.log(rootURL + '/fetchChildVacination/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchChildVacination/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#child_test_records_search_result_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                       
                          userData = responseMessageDetails.data;

                          console.log("userData : "+userData.length);
                          var trHTML = "";
                          $.each(userData, function(index, userDetails) {
                              s = userDetails.id;
                              s = userDetails.id;
                                s = s.replace(/^0+/, '');
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.vacinename+"#"+userDetails.observation); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.vacinename + '</td><td>' 
                                           + userDetails.observation +'</td></tr>';
                               });
                           $('#child_test_records_search_result_table').append(trHTML);
                           $('#child_test_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
         
	});
        
         $('#searchChildTestModal').modal('show');
}


function addPatientChildMasterData(weight,height,bp,month,birthdate,eyes,ears,lungs,hearth,legs,hands,observations){
  /*
   * :patientid,:patientname,:doctorid,:doctorname,:hospitalid,:hospitalname,"
                . "'Y',:expecteddate,:concivieddate,:currentmonth,:intialweight,:height,:bp
   */ 

  patientname = $('#hiddenpatientName').val();
  patientid = $('#hiddenpatientId').val();
  hospitalid = $('#hidhospitalId').val();
  hospitalname = $('#hidhospitalName').val();
  doctorid = $('#hiddendoctorId').val();
  doctorname = $('#hiddendoctorName').val();
  
     var registerData = JSON.stringify( {"patientid" : patientid,"patientname" : patientname,
         "doctorname" : doctorname,"doctorid" : doctorid,"hospitalid" : hospitalid,"hospitalname" : hospitalname,
         "birthdate" : birthdate,"currentmonth" : month,
         "weight" : weight,"height" : height,
         "bp" : bp,"eyes" : eyes,"ears" : ears,"lungs" : lungs,"hearth" : hearth,"legs" : legs,"hands" : hands,"observations":observations} );
        
    console.log("registerData "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/insertPatientChildMasterData',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                $('#displayMessage').html('Data Updated Successfully');
            }
        });   
}

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

function showChildDetails(s){
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

function addChildMedicinestoTable(){
      var trHtml = "";
        
        if(validateBeforeAddMedicines()){
             $('#nooferrmsg').html("");
            count = parseInt($('#counter').val())+1;
            mbm = ($('#mbm1').is(":checked") ? 1 : 0);
            mam = ($('#mam1').is(":checked") ? 1 : 0);
            abm = ($('#abm1').is(":checked") ? 1 : 0);
            aam = ($('#aam1').is(":checked") ? 1 : 0);
            ebm = ($('#ebm1').is(":checked") ? 1 : 0);
            eam = ($('#eam1').is(":checked") ? 1 : 0);
            nofodays = $('#noofdays').val();
            gmedicine =  ($('#gmedicines').val() == "" ? "nogmedicine" : $('#gmedicines').val());
            dmedicine = ($('#dmedicines').val() == "" ? "nodmedicine" : $('#dmedicines').val());
            omedicine = ($('#omedicines').val() == "" ? "noomedicine" : $('#omedicines').val());
            usage = $('#usage').val();
            rowvalue = gmedicine+"#"+dmedicine+"#"+nofodays+"#"+mbm+"#"+mam+"#"+abm+"#"+aam+"#"+ebm+"#"+eam+"#"+omedicine+"#"+usage;
              console.log("rowvalue : "+rowvalue);
              
                  createChildHiddenTextBox(rowvalue,count);
          if($('#gmedicines').val() != "")
              var medicineName = $('#gmedicines').val();
          if($('#dmedicines').val() != "")
              var medicineName = $('#dmedicines').val();
          if($('#omedicines').val() != "")
              var medicineName = $('#omedicines').val();
            
            
         //   var medicineName =  ($('#gmedicines').val() == "" ? $('#dmedicines').val() : $('#gmedicines').val()) 
            
        btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteChildData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
        btnEdit = '<button class="btn btn-warning btn-xs" onclick="editChildData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
        //idValue = "1";
        trHtml += '<tr id="'+count+'"><td nowrap>' + medicineName + '</td><td>' + nofodays + '</td><td>' + usage + '</td><td>' + mbm + '</td><td>' + mam   +'</td><td>' + abm  + 
            '</td><td>' + aam + '</td><td>' + ebm + '</td><td>' + eam + '</td><td  nowrap>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';
              
              $('#gmedicines').val("");
               $('#omedicines').val("");
              $('#dmedicines').val("");
              $('#noofdays').val("");
              $('#mbm1').prop("checked",false);
               $('#mam1').prop("checked",false);
                $('#abm1').prop("checked",false);
                 $('#aam1').prop("checked",false);
                  $('#ebm1').prop("checked",false);
                $('#aam1').prop("checked",false);       
                  
     
        }
         $('#patient_child_medincine_records_repords_table').append(trHtml);
        $('#patient_child_medincine_records_repords_table').load();
    
}



function createChildHiddenTextBox(data,count){
    
    console.log("in create div");
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html('<label>Textbox #'+ count + ' : </label>' +
	      '<input type="text" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#medicinestabledata");

				
	$('#counter').val(count);
    
}




function validateBeforeAddMedicines(){
    
     console.log("General : "+$('#gmedicines').val());
     console.log("Doctor : "+$('#dmedicines').val());
     console.log("noofdays : "+$('#noofdays').val());
     console.log("mbm1 : "+$('#mbm1').is(":checked"));
     console.log("mam1 : "+$('#mam1').is(":checked"));
     console.log("abm1 : "+$('#abm1').is(":checked"));
     console.log("aam1 : "+$('#aam1').is(":checked"));
     console.log("ebm1 : "+$('#ebm1').is(":checked"));
     console.log("eam1 : "+$('#eam1').is(":checked")); 
    
    if($('#gmedicines').val() == "" && $('#dmedicines').val() == ""  && $('#omedicines').val() == "" ){
        $('#nooferrmsg').html("Please select general or doctor or other medicines");
        return false;
    }
    if($('#noofdays').val() == ""){
        $('#nooferrmsg').html("Please enter no of days");
        return false;
    }
    if(!$('#mbm1').is(":checked") && !$('#mam1').is(":checked") && !$('#abm1').is(":checked") && !$('#aam1').is(":checked") && !$('#ebm1').is(":checked") && !$('#eam1').is(":checked")){
       $('#nooferrmsg').html("Please select atleast 1 in-take time");
        return false;  
    }
    
    return true;
    console.log("General : "+$('#gmedicines').val());
     console.log("Doctor : "+$('#dmedicines').val());
     console.log("noofdays : "+$('#noofdays').val());
     console.log("mbm1 : "+$('#mbm1').is(":checked"));
     console.log("mam1 : "+$('#mam1').is(":checked"));
     console.log("abm1 : "+$('#abm1').val());
     console.log("aam1 : "+$('#aam1').val());
     console.log("ebm1 : "+$('#ebm1').val());
     console.log("eam1 : "+$('#eam1').val());   
    
}



function deleteChildData(rowData){
   console.log("In"+rowData);
   try{
        row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
        
          $("#TextBoxDiv" + rowData).remove();
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}

function editChildData(rowData){
   console.log("In"+rowData);
   try{
         //alert($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         var splitDataToEdit = dataToEdit.split("#");
    //gmedicine+"#"+dmedicine+"#"+nofodays+"#"+mbm+"#"+mam+"#"+abm+"#"+aam+"#"+ebm+"#"+eam;
     $('#gmedicines').val((splitDataToEdit[0] == "nogmedicine" ? "" : splitDataToEdit[0]));
    $('#dmedicines').val((splitDataToEdit[1] == "nodmedicine" ? "" : splitDataToEdit[1]));
    $('#noofdays').val(splitDataToEdit[2]);
     $('#usage').val(splitDataToEdit[10]);
    $('#omedicines').val(splitDataToEdit[9]); 
    $('#mbm1').prop("checked",(splitDataToEdit[3] == 1 ? true : false));
     $('#mam1').prop("checked",(splitDataToEdit[4] == 1 ? true : false));
      $('#abm1').prop("checked",(splitDataToEdit[5] == 1 ? true : false));
       $('#aam1').prop("checked",(splitDataToEdit[6] == 1 ? true : false));
        $('#ebm1').prop("checked",(splitDataToEdit[7] == 1 ? true : false));
      $('#aam1').prop("checked",(splitDataToEdit[8] == 1 ? true : false));    
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



function searchNewChildGenericMedicine(){
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
					 $('#searchMedicinesResults tbody').append('<tr class="data" onclick="addSearchNewChildMedicine('+data[i].id+')" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
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
function addSearchNewChildMedicine(id){
	$('#gmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchNewChildMedicinesModal').modal('hide'); 
}

function searchNewChildDoctorMedicine(){
	var serchData = $('#searchDoctorMedicine').val();
	var doctorId = $('#hiddendoctorId').val();
	$.ajax({
		type: 'GET',
		url: rootURL + '/fetchDoctorMedicinesList/'+serchData+'/'+doctorId,
		dataType: "json",
		success: function(data){
			$('#searchMedicinesResults').show();
			$('#searchDoctorMedicinesResults tbody').html('');
			var objLength = data.length;
			
			if(objLength > 0){
			
				 for (var i = 0; i < objLength; i++) {
					 $('#searchDoctorMedicinesResults tbody').append('<tr class="data" onclick="addSearchNewChildDoctorMedicine('+data[i].id+')" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
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
							$rows = $('#searchDoctorMedicinesResults tbody').find('.data');
	
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
				 $('#searchDoctorMedicinesResults tbody').append('<tr><td colspan="2" style="text-align:center;">No Data Found</td></tr>');
				 $('#tablePaging').hide();
			}
			
			}
  });
}
function addSearchNewChildDoctorMedicine(id){
	$('#dmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchNewChildDoctorMedicinesModal').modal('hide'); 
}

function fetchVacinationList(){
    
    
    
    
}