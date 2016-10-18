var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
    $('#villcounter').val(0);
     $('#showSearch').show();
    $('#showDataEntry').hide();
    $('#showDietitianEntry').hide();
    $('#showOpthoEntry').hide();
     $('#showPhysianEntry').hide();
     
     $('#btnAddChildMedicinesSpecificData').click( function(){
      addChildMedicinestoTable();  
    });
     
    
    $( "#presdiagnostics" ).change(function() {
         //alert("hello 1");
          testsForDiagnostics($( "#presdiagnostics" ).val());
        });
        
        
    $('#searchhousemembers').click(function(){
        
        console.log($('#patientname').val());
        console.log($('#patientid').val());
        console.log($('#housenumber').val());
        console.log($('#streetname').val());
        //console.log($('#block').val());
        
        
        
        if($('#patientname').val() != ""){
            membername = $('#patientname').val();
        }else{
            membername = "nodata";
        }
        if($('#patientid').val() != ""){
            memberid = $('#patientid').val();
        }else{
            memberid = "nodata";
        }
       
        if($('#housenumber').val() != "nodata"){
            housenumber = $('#housenumber').val();
        }else{
            housenumber = "nodata";
        }
         if($('#streetname').val() != ""){
            streetname = $('#streetname').val();
        }else{
            streetname = "nodata";
        }
        
        
        console.log(rootURL+'/fetchHouseMembers/'+membername+'/'+memberid+'/'+housenumber+'/'+streetname);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchHouseMembers/'+membername+'/'+memberid+'/'+housenumber+'/'+streetname,
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
              $('#house_member_search_table tbody').remove();      
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                     datToPass = "'"+escape(data.housenumber)+"'";
                            
                     general = "<font color='blue'><a href='#' onclick=enterDetails("+data.ID+","+data.house+")>General<a></font>";
                      dietitian = "<font color='blue'><a href='#' onclick=enterDietitianDetails("+data.ID+","+data.house+")>Dietitian<a></font>";
                       ophthalmology = "<font color='blue'><a href='#' onclick=enterOphthalmologyDetails("+data.ID+","+data.house+")>Ophthalmology<a></font>";
                        physician  = "<font color='blue'><a href='#' onclick=enterPhysicianDetails("+data.ID+","+data.house+")>Physician <a></font>";
                      trHTML = "<tr id="+count+"><td>"+data.housenumber+"</td><td>"+data.streetname+"</td><td>"+data.name+"</td><td>"+data.ID+"</td>\n\
                   <td>"+data.mobile+"</td><td>"+general+"&nbsp;&nbsp;|&nbsp;&nbsp;"+dietitian+"&nbsp;&nbsp;|&nbsp;&nbsp; "+ophthalmology+" &nbsp;&nbsp;|&nbsp;&nbsp;"+physician+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                       console.log(trHTML)
                         $('#house_member_search_table').append(trHTML);
                        $('#house_member_search_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        });        
        
    });
    
    $('#searchVillageConsultationDetails').click( function(){
        
         
        console.log(rootURL+'/fetchVillageAppointmentHistory/'+$('#housenumber').val());
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchVillageAppointmentHistory/'+$('#housenumber').val(),
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    $('#searchResultForHistory').show();
                    $('#showDetailsforHouse').hide();
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#village_health_checkup_history_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                     datatoPass = "'"+escape(data.keyid+"#"+data.appointmentid)+"'";
                            console.log(datatoPass);
                     link = "<font color='blue'><a href='#' onclick=showHouseDetails("+datatoPass+","+data.passdate+")>Enter Details<a></font>";
                      trHTML = "<tr><td>"+data.housenumber+"</td><td>"+data.count+"</td><td>"+data.appointmentdate+"</td><td>"+link+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        console.log(trHTML);
                         $('#village_health_checkup_history_table').append(trHTML);
                        $('#village_health_checkup_history_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
    });    
        $('#searchVillageOptoConsultationDetails').click( function(){
        
         
        console.log(rootURL+'/fetchVillageAppointmentHistory/'+$('#housenumber').val());
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchVillageAppointmentHistory/'+$('#housenumber').val(),
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    $('#searchResultForHistory').show();
                    $('#showDetailsforHouse').hide();
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#village_health_optocheckup_history_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                     datatoPass = "'"+escape(data.housenumber+"#"+data.appointmentid)+"'";
                            
                     link = "<font color='blue'><a href='#' onclick=showOptoHouseDetails("+datatoPass+","+data.passdate+")>Enter Details<a></font>";
                      trHTML = "<tr><td>"+data.housenumber+"</td><td>"+data.count+"</td><td>"+data.appointmentdate+"</td><td>"+link+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#village_health_optocheckup_history_table').append(trHTML);
                        $('#village_health_optocheckup_history_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
    });
    
    $('#searchVillageDietConsultationDetails').click( function(){
        
         
        console.log(rootURL+'/fetchVillageAppointmentHistory/'+$('#housenumber').val());
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchVillageAppointmentHistory/'+$('#housenumber').val(),
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    $('#searchResultForHistory').show();
                    $('#showDetailsforHouse').hide();
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#village_health_dietcheckup_history_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                     datatoPass = "'"+escape(data.housenumber+"#"+data.appointmentid)+"'";
                            
                     link = "<font color='blue'><a href='#' onclick=showDietHouseDetails("+datatoPass+","+data.passdate+")>Enter Details<a></font>";
                      trHTML = "<tr><td>"+data.housenumber+"</td><td>"+data.count+"</td><td>"+data.appointmentdate+"</td><td>"+link+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#village_health_dietcheckup_history_table').append(trHTML);
                        $('#village_health_dietcheckup_history_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
    });
    
 $('#searchResultForHistory').show();
 $('#showDetailsforHouse').hide();
 
 $('#showChildDoctorMedicineSerachPop').click(function(){
    	$('#searchNewChildDoctorMedicinesModal').modal('show');
    });
    
    $('#showChildMedicineSerachPop').click(function(){
    	$('#searchNewChildMedicinesModal').modal('show');
    }); 
 });

function showHouseDetails(housenumber,passdate){
    console.log(unescape(housenumber));
    console.log(passdate);//
    
    splitData = unescape(housenumber).split("#");
    $('#searchResultForHistory').hide();
 $('#showDetailsforHouse').show();
    console.log(rootURL+'/fetchVillageConsultationDetailsForHouse/'+splitData[0]+'/'+splitData[1]);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchVillageConsultationDetailsForHouse/'+splitData[0]+'/'+splitData[1],
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#village_health_checkup_history_details_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                    
                      trHTML = "<tr><td>"+data.memberid+"</td><td>"+data.name+"</td><td>"+data.bp+"</td><td>"+data.sugar+"</td>\n\
<td>"+data.colo1+"</td>\n\
<td>"+data.colo2+"</td>\n\
<td>"+data.colo3+"</td>\n\
<td>"+data.colo4+"</td>\n\
<td>"+data.colo5+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#village_health_checkup_history_details_table').append(trHTML);
                        $('#village_health_checkup_history_details_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
}

function showOptoHouseDetails(housenumber,passdate){
    console.log(unescape(housenumber));
    console.log(passdate);//
    
    splitData = unescape(housenumber).split("#");
    $('#searchResultForHistory').hide();
 $('#showDetailsforHouse').show();
    console.log(rootURL+'/\n\
/'+splitData[0]+'/'+splitData[1]);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchVillageOptoConsultationDetailsForHouse/'+splitData[0]+'/'+splitData[1],
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    
                    
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#village_health_checkup_history_opto_details_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                    
                      trHTML = "<tr><td>"+data.memberid+"</td><td>"+data.name+"</td><td>"+data.observations+"</td><td>"+data.complaints+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#village_health_checkup_history_opto_details_table').append(trHTML);
                        $('#village_health_checkup_history_opto_details_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
}

function showDietHouseDetails(housenumber,passdate){
    console.log(unescape(housenumber));
    console.log(passdate);//
    
    splitData = unescape(housenumber).split("#");
    $('#searchResultForHistory').hide();
 $('#showDetailsforHouse').show();
    console.log(rootURL+'/fetchVillageDietConsultationDetailsForHouse/'+splitData[0]+'/'+splitData[1]);
        $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL+'/fetchVillageDietConsultationDetailsForHouse/'+splitData[0]+'/'+splitData[1],
                dataType: "json",
                success: function(data, textStatus, jqXHR){
                     
                    console.log(data);
                    
                    
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                 $('#village_health_checkup_history_diet_details_table tbody').remove();
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                    
                      trHTML = "<tr><td>"+data.memberid+"</td><td>"+data.name+"</td><td>"+data.observations+"</td><td>"+data.complaints+"</td>\n\
<td>"+data.mfrecomend+"</td>\n\
<td>"+data.afrecomend+"</td>\n\
<td>"+data.nfrecomend+"</td></tr>";
                    //createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#village_health_checkup_history_diet_details_table').append(trHTML);
                        $('#village_health_checkup_history_diet_details_table').load();

                    });
                   //console.log("message "+);
               });
               
                    
                    
                    
                }
                
        }); 
}

function enterDetails(memberid,housenumber){
  //  flatnumber = unescape(flatnumber);
    console.log(memberid); console.log(housenumber);
    $('#appointmenthousememberid').val(memberid);
     $('#ghousenumber').val(housenumber);
      $('#showSearch').hide();
    $('#showDataEntry').show();
     $('#showPhysianEntry').hide();
}

function enterDietitianDetails(memberid,housenumber){
   // flatnumber = unescape(flatnumber);
   // console.log(memberid);
    $('#dappointmenthousememberid').val(memberid);
     $('#dhousenumber').val(housenumber);
      $('#showSearch').hide();
    $('#showDataEntry').hide();
    $('#showDietitianEntry').show();
    $('#showOpthoEntry').hide();
     $('#showPhysianEntry').hide();
}

function enterOphthalmologyDetails(memberid,housenumber){
    $('#oappointmenthouseid').val(memberid);
     $('#ohousenumber').val(housenumber);
      $('#showSearch').hide();
    $('#showDataEntry').hide();
    $('#showDietitianEntry').hide();
    $('#showOpthoEntry').show();
     $('#showPhysianEntry').hide();
    
}//showPhysianEntry

function enterPhysicianDetails(memberid,housenumber){
    $('#pappointmenthousememberid').val(memberid);
     $('#phousenumber').val(housenumber);
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
            count = parseInt($('#villcounter').val())+1;
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

				
	$('#villcounter').val(count);
    
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