var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    $('#counter').val(0);
     $('#state').change( function(){
      state = $('#state').val();
       console.log(rootURL + '/fetchDistrict/' + state);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchDistrict/' + state,
            dataType: "json",
            success: function(data){
                 console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                $("#district option").remove();
                console.log(list);
                    console.log("Data List Length "+list.length);
                    $.each(list, function(index, responseMessageDetails) {

                         if(responseMessageDetails.status == "Success"){
                                districtData = responseMessageDetails.data;
                                 console.log("districtData : "+districtData.length);
                                 var trHTML = "";
                                strtext = '- District -'
                                 $('<option>').val("DISTRICT").text(strtext).appendTo('#district');
                                 $.each(districtData, function(index, data) {
                                      $('<option>').val(data.district).text(data.district).appendTo('#district');
                                 });

                            }
                        });        
                }
            });  
  });
  
  $('#showeditoption').hide();
  
  $('#fetchIndustryAppointmentData').click( function(){
        
       //school_appointment__table
        console.log(rootURL + '/fetchIndustryAppointmentList/' + $('#schoollist').val());
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchIndustryAppointmentList/' + $('#schoollist').val(),
            dataType: "json",
            success: function(data){
             
                 $('#showeditoption').hide();
                             var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                            console.log((list).length);
                             $('#school_appointment_table tbody').remove();

                           $.each(list, function(index, responseMessageDetails) {
                               console.log(responseMessageDetails);
                               var schoolData = responseMessageDetails.data;

                                $.each(schoolData, function (index, data) {

                                    count = $('#counter').val();

                                   if(data.status == "Y") {status = "Yet to Start" }else if(data.status == "I"){ 
                                       status = "In Progress";
                                   }else{ 
                                       status = "Closed";
                                   }
                                               
                                   updatestatus = escape(data.status);        
                                 link = "<font color='blue'><a href='#' onclick='updateData("+data.id+")'>Update<a></font>";
                                  trHTML = "<tr id="+count+"><td>"+data.appointmentdate+"</td><td>"+status+"</td><td>"+data.doctorname+"</td><td>"+data.comments+"</td><td>"+link+"</td></tr>";
                               
                                     $('#school_appointment_table').append(trHTML);
                                    $('#school_appointment_table').load();

                                });
                               //console.log("message "+);
                           });
                
                
                
            }
            });  
            
    });
  
  

  
    $('#district').change( function(){
      district = $('#district').val();
       console.log(rootURL + '/fetchIndustryList/' + district);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchIndustryList/' + district,
            dataType: "json",
            success: function(data){
                 console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                $("#schoollist option").remove();
                console.log(list);
                    console.log("Data List Length "+list.length);
                    $.each(list, function(index, responseMessageDetails) {

                         if(responseMessageDetails.status == "Success"){
                                schoolData = responseMessageDetails.data;
                                 console.log("Industry : "+schoolData.length);
                                 var trHTML = "";
                                strtext = '- Industry -'
                                 $('<option>').val("INDUSTRY").text(strtext).appendTo('#schoollist');
                                 $.each(schoolData, function(index, data) {
                                      $('<option>').val(data.id).text(data.industryname).appendTo('#schoollist');
                                 });

                            }
                        });        
                }
            });  
  });
    
    
    $('#start').change( function(){
        
       // var age = getAge(new Date($('#start').val()));
        
            console.log("Start : "+$('#start').val());
            var now = new Date();
            var past = $('#start').val();
            var nowYear = now.getFullYear();
            var pastYear = past.substr(past.lastIndexOf('.')+1,past.length);
            console.log("past : "+past);
            console.log("pastYear : "+pastYear);
              console.log("nowYear : "+nowYear);
            console.log("MINUS : "+nowYear - pastYear);
            var age = nowYear - pastYear;

        
                  $('#age').val(age);
    });
    
    
    
    
    
    
    
    
    
    
    $('#addIndustryAppointmentData').click( function(){
        
        count = $('#counter').val();
        trHTML = "";
        link = "";
        console.log($('#schoollist option:selected').text());
        dataToPass = $('#schoollist').val()+"#"+$('#schoollist option:selected').text()+"#"+$('#start').val();
        
        //school_appointment_details_table
         link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#schoollist').val()+"</td><td>"+$('#schoollist option:selected').text()+"</td><td>"+$('#start').val()+"</td>\n\
 <td>"+link+"</td></tr>";
      createAppointmentHiddenTextBox(dataToPass,count); 
       
       $('#school_appointment_details_table').append(trHTML);
         $('#school_appointment_details_table').load();
        
    });
    
    
    
    
    $('#counter').val(0);
     $('#showSearch').show();
    $('#showDataEntry').hide();
    $('#showDietitianEntry').hide();
    $('#showOpthoEntry').hide();
     $('#showPhysianEntry').hide();
    
     $('#searchResultForHistory').show();
 $('#showDetailsforClass').hide();
    
    $('#searchIndustryDietConsultationDetails').click( function(){
        
         
        console.log(rootURL+'/industryTotalHealthCheckup/'+$('#departmentname').val());
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/industryTotalHealthCheckup/'+$('#departmentname').val(),
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    $('#searchResultForHistory').show();
                    $('#showDetailsforClass').hide();
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#school_health_dietcheckup_history_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var schoolData = responseMessageDetails.data;
                    
                    $.each(schoolData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                     datatoPass = "'"+escape(data.departmentid+"#"+data.appointmentid)+"'";
                            
                     link = "<font color='blue'><a href='#' onclick=showDietDetails("+datatoPass+","+data.passdate+")>Fetch Details<a></font>";
                      trHTML = "<tr><td>"+data.departmentname+"</td><td>"+data.count+"</td><td>"+data.appointmentdate+"</td><td>"+link+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#school_health_dietcheckup_history_table').append(trHTML);
                        $('#school_health_dietcheckup_history_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
    });
    
    
    
    $('#searchIndustryOptoConsultationDetails').click( function(){
        
         
        console.log(rootURL+'/industryTotalHealthCheckup/'+$('#departmentname').val());
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/industryTotalHealthCheckup/'+$('#departmentname').val(),
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    $('#searchResultForHistory').show();
                    $('#showDetailsforClass').hide();
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#school_health_optocheckup_history_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var schoolData = responseMessageDetails.data;
                    
                    $.each(schoolData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                    datatoPass = "'"+escape(data.departmentid+"#"+data.appointmentid)+"'";
                            
                     link = "<font color='blue'><a href='#' onclick=showOptoDetails("+datatoPass+","+data.passdate+")>Fetch Details<a></font>";
                      trHTML = "<tr><td>"+data.departmentname+"</td><td>"+data.count+"</td><td>"+data.appointmentdate+"</td><td>"+link+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#school_health_optocheckup_history_table').append(trHTML);
                        $('#school_health_optocheckup_history_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
    });
    
    
    $('#btnAddChildMedicinesSpecificData').click( function(){
      addChildMedicinestoTable();  
    });
    
    $( "#presdiagnostics" ).change(function() {
         //alert("hello 1");
          testsForDiagnostics($( "#presdiagnostics" ).val());
        });
    
    $('#showChildDoctorMedicineSerachPop').click(function(){
    	$('#searchNewChildDoctorMedicinesModal').modal('show');
    });
    
    $('#showChildMedicineSerachPop').click(function(){
    	$('#searchNewChildMedicinesModal').modal('show');
    }); 
    
    $('#searchIndustryConsultationDetails').click( function(){
          $('#searchResultForHistory').show();
                    $('#showDetailsforClass').hide();
         
        console.log(rootURL+'/industryTotalHealthCheckup/'+$('#departmentname').val());
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/industryTotalHealthCheckup/'+$('#departmentname').val(),
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    $('#searchResultForHistory').show();
                    $('#showDetailsforClass').hide();
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#school_health_checkup_history_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var schoolData = responseMessageDetails.data;
                    
                    $.each(schoolData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                     datatoPass = "'"+escape(data.departmentid+"#"+data.appointmentid)+"'";
                            
                     link = "<font color='blue'><a href='#' onclick=showIndustryDetails("+datatoPass+","+data.passdate+")>Fetch Details<a></font>";
                      trHTML = "<tr><td>"+data.departmentname+"</td><td>"+data.count+"</td><td>"+data.appointmentdate+"</td><td>"+link+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#school_health_checkup_history_table').append(trHTML);
                        $('#school_health_checkup_history_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
    });  
    
    
    
    
    
    
    $('#searchIndustryEmployees').click(function(){
        
        console.log($('#patientname').val());
        console.log($('#patientid').val());
        console.log($('#departmentname').val());
        
        
        
        if($('#patientname').val() != ""){
            employeename = $('#patientname').val();
        }else{
            employeename = "nodata";
        }
        if($('#patientid').val() != ""){
            patientid = $('#patientid').val();
        }else{
            patientid = "nodata";
        }
        if($('#departmentname').val() != "nodata"){
            departmentid = $('#departmentname').val();
        }else{
            departmentid = "nodata";
        }
        
        
        
        console.log(rootURL+'/fetchIndustryEmployee/'+employeename+'/'+patientid+'/'+departmentid);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchIndustryEmployee/'+employeename+'/'+patientid+'/'+departmentid,
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
              $('#industry_employee_search_table tbody').remove();      
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var employeeData = responseMessageDetails.data;
                    
                    $.each(employeeData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                     datToPass = "'"+escape(data.industryrowempid)+"'";
                            
                     general = "<font color='blue'><a href='#' onclick=enterDetails("+data.ID+","+datToPass+")>General<a></font>";
                      dietitian = "<font color='blue'><a href='#' onclick=enterDietitianDetails("+data.ID+","+datToPass+")>Dietitian<a></font>";
                       ophthalmology = "<font color='blue'><a href='#' onclick=enterOphthalmologyDetails("+data.ID+","+datToPass+")>Ophthalmology<a></font>";
                        physician  = "<font color='blue'><a href='#' onclick=enterPhysicianDetails("+data.ID+","+datToPass+")>Physician <a></font>";
                      trHTML = "<tr id="+count+"><td>"+data.name+"</td><td>"+data.employeeid+"</td><td>"+data.emppatientid+"</td><td>"+data.mobile+"</td>\n\
                            <td>"+general+"&nbsp;&nbsp;|&nbsp;&nbsp;"+dietitian+"&nbsp;&nbsp;|&nbsp;&nbsp; "+ophthalmology+" &nbsp;&nbsp;|&nbsp;&nbsp;"+physician+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#industry_employee_search_table').append(trHTML);
                        $('#industry_employee_search_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        });        
        
    });
    
    
    
    
    
    });
    
    
    
    
function enterDetails(patientid,indurstryrowempid){
    industempid = unescape(indurstryrowempid);
    $('#appointmentempid').val(patientid);
      $('#showSearch').hide();
    $('#showDataEntry').show();
     $('#showPhysianEntry').hide();
}

function enterDietitianDetails(patientid,indurstryrowempid){
   industempid = unescape(indurstryrowempid);
    $('#dappointmentempid').val(patientid);
     $('#showSearch').hide();
    $('#showDataEntry').hide();
    $('#showDietitianEntry').show();
    $('#showOpthoEntry').hide();
     $('#showPhysianEntry').hide();
}

function enterOphthalmologyDetails(patientid,indurstryrowempid){
   industempid = unescape(indurstryrowempid);
    $('#oappointmentempid').val(patientid);
      $('#showSearch').hide();
    $('#showDataEntry').hide();
    $('#showDietitianEntry').hide();
    $('#showOpthoEntry').show();
     $('#showPhysianEntry').hide();
    
}//showPhysianEntry

function enterPhysicianDetails(patientid,indurstryrowempid){
    industempid = unescape(indurstryrowempid);
    $('#pappointmentempid').val(patientid);
      $('#showSearch').hide();
    $('#showDataEntry').hide();
    $('#showDietitianEntry').hide();
    $('#showOpthoEntry').hide();
    $('#showPhysianEntry').show();
}


function testsForDiagnostics(selectedDiagnostics){
//alert("hello");
console.log(rootURL + '/testsForDiagnostics/' + selectedDiagnostics);
        $.ajax({
                type: 'GET',
                url: rootURL + '/testsForDiagnostics/' + selectedDiagnostics,
                dataType: "json",
                success: function(data){
                     console.log('authentic : ' + data)
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    $("#presdiagnosticstests option").remove();
                    console.log(list);
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                  $('#adminStaffErrorBlock').show();
                                  testData = responseMessageDetails.data;
                                     console.log("testData : "+testData.length);
                                     var trHTML = "";
                                    strtext = '-------- Select Test ----------'
                                     $('<option>').text(strtext).appendTo('#presdiagnosticstests');
                                     $('<option>').val("Others").text("Others").appendTo('#presdiagnosticstests');
                                     $.each(testData, function(index, testDetails) {
                                          $('<option>').val(testDetails.testid).text(testDetails.testname).appendTo('#presdiagnosticstests');
                                     });
                                 
                                }
                            });        
                }
            });     
    
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

function showIndustryDetails(deparment,passdate){
    console.log(unescape(deparment));
    console.log(passdate);//
    
    splitData = unescape(deparment).split("#");
    
    
    $('#searchResultForHistory').hide();
 $('#showDetailsforClass').show();
    console.log(rootURL+'/fetchIndustryConsultationDetailsForClass/'+splitData[0]+'/'+splitData[1]);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchIndustryConsultationDetailsForClass/'+splitData[0]+'/'+splitData[1],
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#school_health_checkup_history_details_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var schoolData = responseMessageDetails.data;
                    
                    $.each(schoolData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                    
                      trHTML = "<tr><td>"+data.empptientid+"</td><td>"+data.name+"</td><td>"+data.bp+"</td><td>"+data.sugar+"</td>\n\
<td>"+data.colo1+"</td>\n\
<td>"+data.colo2+"</td>\n\
<td>"+data.colo3+"</td>\n\
<td>"+data.colo4+"</td>\n\
<td>"+data.colo5+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#school_health_checkup_history_details_table').append(trHTML);
                        $('#school_health_checkup_history_details_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
}


function showOptoDetails(department,passdate){
    console.log(unescape(department));
    console.log(passdate);//
    
    splitData = unescape(department).split("#");
    $('#searchResultForHistory').hide();
 $('#showDetailsforClass').show();
    console.log(rootURL+'/fetchIndustryClassOptoHistory/'+splitData[0]+'/'+splitData[1]);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchIndustryClassOptoHistory/'+splitData[0]+'/'+splitData[1],
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#school_health_checkup_history_opto_details_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var schoolData = responseMessageDetails.data;
                    
                    $.each(schoolData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                    
                      trHTML = "<tr><td>"+data.patientid+"</td><td>"+data.name+"</td><td>"+data.observations+"</td><td>"+data.complaints+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#school_health_checkup_history_opto_details_table').append(trHTML);
                        $('#school_health_checkup_history_opto_details_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
}


function showDietDetails(department,passdate){
    console.log(unescape(department));
    console.log(passdate);//
    
    splitData = unescape(department).split("#");
    $('#searchResultForHistory').hide();
 $('#showDetailsforClass').show();
    console.log(rootURL+'/fetchIndustryDeptDietHistory/'+splitData[0]+'/'+splitData[1]);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchIndustryDeptDietHistory/'+splitData[0]+'/'+splitData[1],
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#school_health_checkup_history_diet_details_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var schoolData = responseMessageDetails.data;
                    
                    $.each(schoolData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                    
                      trHTML = "<tr><td>"+data.patientid+"</td><td>"+data.name+"</td><td>"+data.observations+"</td><td>"+data.complaints+"</td>\n\
<td>"+data.mfrecomend+"</td>\n\
<td>"+data.afrecomend+"</td>\n\
<td>"+data.nfrecomend+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#school_health_checkup_history_diet_details_table').append(trHTML);
                        $('#school_health_checkup_history_diet_details_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
}


function createAppointmentHiddenTextBox(data,count){
    
    console.log("in create div"+$('#counter').val());
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html( '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#labtabledata");

				
	$('#counter').val(parseInt(count)+parseInt(1));
    
}

function deleteData(rowData){
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



function updateData(rowid){
    console.log(rowid);
   
     console.log(rootURL + '/fetchSpecificIndustryAppointmentList/' + rowid);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchSpecificIndustryAppointmentList/' + rowid,
            dataType: "json",
            success: function(data){
             
                 $('#showeditoption').show();
                             var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                            console.log((list).length);
                            
                           $.each(list, function(index, responseMessageDetails) {
                               console.log(responseMessageDetails);
                               var schoolData = responseMessageDetails.data;

                                $.each(schoolData, function (index, data) {

                                    count = $('#counter').val();

                                   if(data.status == "Y") {status = "Yet to Start" }else if(data.status == "I"){ 
                                       status = "In Progress";
                                   }else{ 
                                       status = "Closed";
                                   }
                                   
                                   $('#rowid').val(data.id);
                                   $('#schoolid').val(data.schoolid);
                                   $('#start').val(data.appointmentdate);
                                  $('#status').val(data.status);
                                  $('#comments').val(data.comments);
                                });
                               //console.log("message "+);
                           });
                
            }
            }); 
}