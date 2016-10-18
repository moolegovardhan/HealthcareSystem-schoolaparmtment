/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
    $('#patientreportss').load();
    //initialise counter
    $('#counter').val(0);
    
    $('#reportspanel').hide();
    $('#listofreports').hide();
    $('#adminStaffErrorBlock').hide();
    var rowData = [];
    var reportTestData = [];
    $('#patient_records_reports_table tr').click(function (event) {
        row = document.getElementById($(this).attr('id')) ;
        alert(row);
    });
    
    $('#btnAddReportSpecificData').click( function(){
        
       
        
        count = parseInt($('#counter').val())+1;
        
         var trHtml = "";
        if(validateDataBeforeAdding()){
        parameterName = $('#parameterName').val();
        parameterValue1 = $('#parameterValue1').val();
        parameterValue2 = $('#parameterValue2').val();
        parameterValue3 = $('#parameterValue3').val();
        report = $('#reportname').val();
        reportArray = report.split("#");
        reportName = reportArray[1];
        reportId = reportArray[0];
        
        
      
        
      idValue = (reportId+"_"+reportName+"_"+parameterName+"_"+parameterValue1+"_"+parameterValue2+"_"+parameterValue3);
    //idValue =  JSON.stringify({reportId:reportId,reportName:reportName,parameterName:parameterName,parameterValue1:parameterValue1});
    console.log(idValue);
     //   reportTestData.push({reportId:reportId,reportName:reportName,parameterName:parameterName,parameterValue1:parameterValue1}); 
       
        btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
        btnEdit = '<button class="btn btn-warning btn-xs" onclick="editData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
        //idValue = "1";
        trHtml += '<tr id="'+count+'"><td>' + reportId + '</td><td>' + reportName + '</td><td>' + parameterName + '</td><td>' + parameterValue1   +'</td><td>' + parameterValue2  + 
            '</td><td>' + parameterValue3 + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';
        
            createHiddenTextBox(idValue,count)
     
     
     
        $('#tableValue').val(reportTestData);
        
        
        $('#parameterName').val("");
        $('#parameterValue1').val("");
         $('#parameterValue2').val("");
        $('#parameterValue3').val("");
        
        
        
        }
        $('#patient_records_reports_table').append(trHtml);
        $('#patient_records_reports_table').load();
       
    });
    
    $('#searchReports').click(function(){
        
        if(validateSearchReportsForm()){
            
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
            
            
          console.log(rootURL + '/fetchPaidLabSampleCollectedPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
             var dataLenght = '';
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPaidLabSampleCollectedPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    $('#patient_consultation_records_search_result_table tbody').html('');
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    //$("#patient_consultation_records_search_result_table tbody").remove();

                        console.log("Data List Length "+list.length);
                        var dataLenght = '';
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    $('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     //console.log("userData : "+userData.length);
                                $('#dataalength').val(userData.length);

                                dataLenght = userData.length;
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');

                              /* trHTML += '<tr><td>' + s + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                               + '</td><td><font color="blue"><i><a href="#" onclick=showReportsDetails('+s+')>Enter Details</a></font></i></td></tr>';*/
                               var link = '';
                             
                            	  link = '<a href="#" onclick=showLabPatientReportsDetails('+userDetails.appointmentid +') style="color:#e67e22;">Enter Details</a>';
                              
                               $('#patient_consultation_records_search_result_table tbody').append('<tr class="data"><td>' + userDetails.appointmentid + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                               + '</td><td>'+link+'</td></tr>');
                               
                                       console.log("Patient Name : "+userDetails.PatientName); 
                                       $('#prespatientName').html(userDetails.PatientName);
                                       $('#doctorName').html(userDetails.DoctorName);
                                       $('#hospitalName').html(userDetails.HospitalName);
                                       $('#appointmentDate').html(userDetails.AppointementDate);
                                      
                                       $('#hidpatientName').val(userDetails.PatientName);
                                       $('#hiddoctorName').val(userDetails.DoctorName);
                                       $('#hidhospitalName').val(userDetails.HospitalName);
                                       $('#hidappointmentDate').val(userDetails.AppointementDate);
                                       $('#hidappointmentId').val(userDetails.id);
                                    });    
                                       // $('#patient_consultation_records_search_result_table').append(trHTML);
                                        //$('#patient_consultation_records_search_result_table').load();
                                     
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
                    							$rows = $('#patient_consultation_records_search_result_table tbody').find('.data');
                    	
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
                                   $('#patient_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
					// alert(dataLenght);
					 /* Pagination Code Start */
					 load = function() {
						window.tp = new Pagination('#tablePaging', {
						itemsCount: dataLenght,
						onPageSizeChange: function (ps) {
							console.log('changed to ' + ps);
						},
						onPageChange: function (paging) {
							//custom paging logic here
							console.log(paging);
							var start = paging.pageSize * (paging.currentPage - 1),
								end = start + paging.pageSize,
								$rows = $('#patient_consultation_records_search_result_table').find('.data');
	
							$rows.hide();
	
							for (var i = start; i < end; i++) {
								$rows.eq(i).show();
							}
						}
					});
					 /* Pagination Code End */
			}

		load();
                    
                }
            });    
        }
            
        
        $('#listofreports').show();
        $('#reportspanel').hide();
    });
    
   
   
   
   $('#searchNonPrescriptionPatient').click(function(){
        
        if(validateSearchReportsForm()){
            
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
            
            console.log("0 Hi Man ");
          console.log(rootURL + '/fetchPaidNonPrescriptionPatients/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
             var dataLenght = '';
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPaidNonPrescriptionPatients/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    $('#patient_consultation_records_search_result_table tbody').html('');
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    //$("#patient_consultation_records_search_result_table tbody").remove();

                        console.log("Data List Length "+list.length);
                        var dataLenght = '';
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    $('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData);
                                    $('#dataalength').val(userData.length);

                                    dataLenght = userData.length;
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.appointmentid;
                                        s = s.replace(/^0+/, '');

                              /* trHTML += '<tr><td>' + s + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                               + '</td><td><font color="blue"><i><a href="#" onclick=showReportsDetails('+s+')>Enter Details</a></font></i></td></tr>';*/
                                link = '<a href="#" onclick=showListofTesttoConduct('+userDetails.appointmentid +') style="color:#e67e22;">Collect Bill</a>';
                              
                               $('#patient_consultation_records_search_result_table tbody').append('<tr class="data"><td>' + userDetails.appointmentid + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                               + '</td><td>'+link+'</td></tr>');
                               
                                       console.log("Patient Name : "+userDetails.PatientName); 
                                       $('#prespatientName').html(userDetails.PatientName);
                                       $('#doctorName').html(userDetails.DoctorName);
                                       $('#hospitalName').html(userDetails.HospitalName);
                                       $('#appointmentDate').html(userDetails.AppointementDate);
                                      
                                       $('#hidpatientName').val(userDetails.PatientName);
                                       $('#hiddoctorName').val(userDetails.DoctorName);
                                       $('#hidhospitalName').val(userDetails.HospitalName);
                                       $('#hidappointmentDate').val(userDetails.AppointementDate);
                                       $('#hidappointmentId').val(userDetails.id);
                                    });    
                                       // $('#patient_consultation_records_search_result_table').append(trHTML);
                                        //$('#patient_consultation_records_search_result_table').load();
                                     
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
                    							$rows = $('#patient_consultation_records_search_result_table tbody').find('.data');
                    	
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
                                   $('#patient_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
					// alert(dataLenght);
					 /* Pagination Code Start */
					 load = function() {
						window.tp = new Pagination('#tablePaging', {
						itemsCount: dataLenght,
						onPageSizeChange: function (ps) {
							console.log('changed to ' + ps);
						},
						onPageChange: function (paging) {
							//custom paging logic here
							console.log(paging);
							var start = paging.pageSize * (paging.currentPage - 1),
								end = start + paging.pageSize,
								$rows = $('#patient_consultation_records_search_result_table').find('.data');
	
							$rows.hide();
	
							for (var i = start; i < end; i++) {
								$rows.eq(i).show();
							}
						}
					});
					 /* Pagination Code End */
			}

		load();
                    
                }
            });    
        }
            
        
        $('#listofreports').show();
        $('#reportspanel').hide();
    });
   
    $('#showReportsSearch').click(function(){
         alert("Helo patien search");
            $('#listofreports').hide();
            $('#reportssearchpanel').show();
            $('#reportspanel').hide();
    });
    $('#showReportsSearchResult').click(function(){
        
      //  alert("Helo patien list");
            $('#listofreports').show();
            //$('#reportssearchpanel').hide();
            $('#reportspanel').hide();
    });
    
    
    
    $("input[type='file']").bind("change",function() {
        console.log(this);

      });
    
    
    
     $('#searchNonPrescriptionLabPaidPatient').click(function(){
        
        if(validateSearchReportsForm()){
            
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
            
            console.log("0 Hi Man ");
          console.log(rootURL + '/fetchPaidLabPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
             var dataLenght = '';
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPaidLabPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    $('#patient_consultation_records_search_result_table tbody').html('');
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    //$("#patient_consultation_records_search_result_table tbody").remove();

                        console.log("Data List Length "+list.length);
                        var dataLenght = '';
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    $('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData);
                                    $('#dataalength').val(userData.length);

                                    dataLenght = userData.length;
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.appointmentid;
                                       
                              /* trHTML += '<tr><td>' + s + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
                               + '</td><td><font color="blue"><i><a href="#" onclick=showReportsDetails('+s+')>Enter Details</a></font></i></td></tr>';*/
                                link = '<a href="#" onclick=collectLabtestSampleFromPatient('+userDetails.id +') style="color:#e67e22;">Collect Samples</a>';
                              
                               $('#patient_consultation_records_search_result_table tbody').append('<tr class="data"><td>' + userDetails.id + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>'+link+'</td></tr>');
                               
                                       console.log("Patient Name : "+userDetails.PatientName); 
                                       $('#prespatientName').html(userDetails.PatientName);
                                       $('#doctorName').html(userDetails.DoctorName);
                                       $('#hospitalName').html(userDetails.HospitalName);
                                       $('#appointmentDate').html(userDetails.AppointementDate);
                                      
                                       $('#hidpatientName').val(userDetails.PatientName);
                                       $('#hiddoctorName').val(userDetails.DoctorName);
                                       $('#hidhospitalName').val(userDetails.HospitalName);
                                       $('#hidappointmentDate').val(userDetails.AppointementDate);
                                       $('#hidappointmentId').val(userDetails.id);
                                    });    
                                       // $('#patient_consultation_records_search_result_table').append(trHTML);
                                        //$('#patient_consultation_records_search_result_table').load();
                                     
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
                    							$rows = $('#patient_consultation_records_search_result_table tbody').find('.data');
                    	
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
                                   $('#patient_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
					// alert(dataLenght);
					 /* Pagination Code Start */
					 load = function() {
						window.tp = new Pagination('#tablePaging', {
						itemsCount: dataLenght,
						onPageSizeChange: function (ps) {
							console.log('changed to ' + ps);
						},
						onPageChange: function (paging) {
							//custom paging logic here
							console.log(paging);
							var start = paging.pageSize * (paging.currentPage - 1),
								end = start + paging.pageSize,
								$rows = $('#patient_consultation_records_search_result_table').find('.data');
	
							$rows.hide();
	
							for (var i = start; i < end; i++) {
								$rows.eq(i).show();
							}
						}
					});
					 /* Pagination Code End */
			}

		load();
                    
                }
            });    
        }
            
        
        $('#listofreports').show();
        $('#reportspanel').hide();
    });
    
    
    
    
    
    
    
});


function validateDataBeforeAdding(){
    
    parameterName = $('#parameterName').val();
    parameterValue1 = $('#parameterValue1').val();
    parameterValue2 = $('#parameterValue2').val();
    parameterValue3 = $('#parameterValue3').val();
    reportname = $('#reportname').val();
    
    if(reportname == "REPORT"){
        $('#adminStaffErrorMessage').html("<b>Error : </b> Please select Report Name");
        $('#adminStaffErrorBlock').show();
        return false;
    } else if(parameterName == ""){
        $('#adminStaffErrorMessage').html("<b>Error : </b> Please enter Parameter Name");
        $('#adminStaffErrorBlock').show();
        return false;
    }else if(parameterValue2 == "" && parameterValue1 == "" && parameterValue3 == ""){
        
        $('#adminStaffErrorMessage').html("<b>Error : </b> Please enter atleast one paramter value before adding data ");
        $('#adminStaffErrorBlock').show();
        return false;
    }else
        return true;
    
    
}

function showReportsDetails(appointmentid){
      $('#patientreportss').load();
        console.log(rootURL + '/fetchPatientAppointmentSpecificMedicalTestList/' + appointmentid);
        console.log(".........>>>>>>>>>>>>>>>>>>>>>>>>>>>........");
        $('#appointmentid').val(appointmentid);
         $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPatientAppointmentSpecificMedicalTestList/' + appointmentid,
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
                                     $('#reportname option[value!="REPORT"]').remove();
                                     $('#FileUploadDiv').empty();
                                    $('#FileUploadLinkDiv').empty();
                                    $('#reportimage').attr('src','../config/content/assets/img/image001.jpg');
                                     $.each(testData, function(index, test) {
                                         console.log(test.id); console.log(test.testname);
                                          $('#reportname')
                                                .append($("<option></option>")
                                                .attr("value",test.id+"#"+test.testname)
                                                .text(test.testname)); 
                                         createFileUploadDiv(test.testname,test.id);
                                         createReportsTab(test.id,test.testname);
                                          $('.nav-pills a[href="#reports"]').tab('show');
                                     });
                                
                            }else{
                              $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                              $('#adminStaffErrorBlock').show();  
                            }
                            
                        });
                        
                    
                    
                }
            });   
    
    
      $('#listofreports').hide();
    //  $('#reportssearchpanel').hide();
    $('#reportspanel').show();
}



function  validateSearchReportsForm(){
      var patientName = $('#patientName').val();
      var patientId = $('#patientID').val();
      var appointmentId = $('#appointmentID').val();
       var mobile = $('#mobile').val();
       
       
       
    if(patientName == "" && patientId == "" && mobile == "" && appointmentId == "" ){
        $('#adminStaffErrorMessage').html("<b>Error : </b> Please enter atleast one search criteria");
        $('#adminStaffErrorBlock').show();
        return false;
    }else
        return true;
    
}

function createFileUploadDiv(reportname,id){
     var newFileBoxDiv = $(document.createElement('div'))
	     .attr("id", 'FileUploadDiv' + reportname);
     newFileBoxDiv.after().html('<label>Report '+ reportname + ' : </label>' +'<input type="file" name="file' + id + 
	      '" id="file' + id + '"  onchange="previewReport(this,'+id+');" accept="image/*">');
            
	newFileBoxDiv.appendTo("#FileUploadDiv");
        
        
    var newTestContentBoxDiv = $(document.createElement('div'))
      .attr({id: 'test' + id
        });
        
  
    
        
        
     
}
//
/**
function myPreviewFunction(fileid){
    console.log("file ID "+fileid);
    //var url = document.getElementById(fileid).value;
    var filename = "#"+fileid;
    console.log("file Name "+$('#fileid').val());
    console.log("file Name 1"+$(filename).val());
    window.open(url,"_blank");
}
**/

function createHiddenTextBox(data,count){
    
    console.log("in create div");
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html('<label>Textbox #'+ count + ' : </label>' +
	      '<input type="text" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#hiddendatagroup");

				
	$('#counter').val(count);
    
    
    
}

function previewReport1(reportid){
    //alert(reportid);
    var filename = "file"+reportid;
    for (i = 0; i < 5; i++){
      //  alert(i == reportid);
        if(i == reportid){
            
            input = document.getElementById('file'+i);
             file = input.files[0];
            fr = new FileReader();
          //  fr.onload = receivedText;
           console.log("fr : "+fr);
            fr.readAsDataURL(file);
             console.log("fr 1 : "+fr);
             
             
              fr.onload = function (e) {
               // $('#filepreview').attr('src', e.target.result);
                $('#reportimage').attr('src', e.target.result);
            } 
           // alert($('input[type=file]')[i].files[i].val());
           // $('#showimage')
           //   .prepend('<img class="inline" src="'+$('input[type=file]')[i].files[i].val()+'" />');
        }
    }
   //var filedata =   $('input[type=file]')[reportid].files[reportid].name;
   //alert(filedata);
}


function createReportsTab(reportid,reportname){
   console.log("in create div");
   
   console.log("in create div");
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'hrefBoxDiv' + reportid);
     
    
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html('<a href="#" onclick="previewReport1('+reportid+')">'+reportname+'</a>');
        console.log(" newTextBoxDiv 1: "+newTextBoxDiv);          
	newTextBoxDiv.appendTo("#FileUploadLinkDiv");
 
    
   
  /* 
   $('#tabdisp'+reportid).tab("destroy");
   
    var newTabBoxDiv = $(document.createElement('li'));
	    // .attr("id", 'tab' + reportname);
     
    console.log(newTabBoxDiv);
    console.log('<a  href="#tabdisp'+reportid+'" data-toggle="pill" >'+reportname+'</a>' );
     newTabBoxDiv.after().html('<a  href="#tabdisp'+reportid+'" data-toggle="pill" >'+reportname+'</a>' );
    console.log("After : "+reportname);
    newTabBoxDiv.appendTo("#tabheading");
    
     var newTabContentBoxDiv = $(document.createElement('div'))
      .attr({id: 'tabdisp' + reportid,
             class:  "tab-pane fade" 
        });
        
    newTabContentBoxDiv.after().html('<center><img id="'+reportid+'" src="#" alt="Report Preview" /> </center>');
            
	newTabContentBoxDiv.appendTo("#displayreportcontent");    
    */
    
}



function previewReport(input,reportId) {
    console.log("Hello input");
     console.log("input.file"+input.file);
      var filename = $('#file'+reportId).val();
     // console.log("input.[0]"+input.file[0]);
      
      $('.nav-pills a[href="#tabdisp' + reportId + '"]').tab('show');
      console.log("Input : "+input);console.log("Input This : "+input.file);
      
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
               // $('#filepreview').attr('src', e.target.result);
                $('#'+reportId).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
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

function editData(rowData){
   console.log("In"+rowData);
   try{
        // alert($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         var splitDataToEdit = dataToEdit.split("_");//test.id+"#"+test.parametername+"#"+test.unitsid+"#"+test.testid
       //(reportId+"_"+reportName+"_"+parameterName+"_"+parameterValue1+"_"+parameterValue2+"_"+parameterValue3);
     $('#parameterName').val(splitDataToEdit[7]);
   $('#parameterValue1').val(splitDataToEdit[3]);
   $('#parameterValue2').val(splitDataToEdit[4]);
   $('#parameterValue3').val(splitDataToEdit[5]);
   $('#reportname').val(splitDataToEdit[0]+"#"+splitDataToEdit[1]);
    $('#reportResult').val(splitDataToEdit[5]);
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



function showListofTesttoConduct(appointmentid){
 
     url = rootURL+"/Web/lab/labindex.php?page=collectbillfortest&appointmentid="+appointmentid;
   window.location.href=url;
    
    /*
    $('#appointmentidhid').val(appointmentid);
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
  
  console.log("Afte rmodal show"); */
}




function collectLabtestSampleFromPatient(appointmentid){
    $('#appointmentidhid').val(appointmentid);
   /* $('#patientreportss').load();
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
   url = rootURL+"/Web/lab/collectsample.php?appointmentid="+appointmentid;
   window.location.href=url;
}

/* ====== Lab Patient Results Start =======*/
function showLabPatientReportsDetails(appointmentid){
    $('#patientreportss').load();
    console.log("...........................");
      console.log(rootURL + '/fetchSampleCollectedPatientTestDetails/' + appointmentid);
      $('#appointmentid').val(appointmentid);
       $.ajax({
              type: 'GET',
              url: rootURL + '/fetchSampleCollectedPatientTestDetails/' + appointmentid,
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
                                   $('#reportname option[value!="REPORT"]').remove();
                                   $('#FileUploadDiv').empty();
                                  $('#FileUploadLinkDiv').empty();
                                  $('#reportimage').attr('src','../config/content/assets/img/image001.jpg');
                                   $.each(testData, function(index, test) {
                                       console.log(test.id); console.log(test.namevalue);
                                        $('#reportname')
                                              .append($("<option></option>")
                                              //.attr("value",test.id+"#"+test.namevalue)
                                            .attr("value",test.id+"#"+test.testname)
                                              .text(test.testname)); 
                                       createFileUploadDiv(test.testname,test.id);
                                       createReportsTab(test.id,test.testname);
                                        $('.nav-pills a[href="#reports"]').tab('show');
                                   });
                              
                          }else{
                            $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                            $('#adminStaffErrorBlock').show();  
                          }
                          
                      });
                      
                  
                  
              }
          });   
  
  
    $('#listofreports').hide();
  //  $('#reportssearchpanel').hide();
  $('#reportspanel').show();
}

function updateParamsWithTest(testid){
	$.ajax({
        type: 'GET',
        url: rootURL + '/getLabTestData/' + testid,
        dataType: "json",
        success: function(data){
        	$('#parameterName').html('');
        	$('#parameterName').append('<option value="PARAMETER">-- Select Parameter --</option>');
        	$.each(data, function(index, test) {
        		$('#parameterName')
                .append($("<option></option>")
                .attr("value",test.id+"#"+test.parametername+"#"+test.unitsid+"#"+test.testid)
                .text(test.parametername)); 
        	});
        }
	
	});
}

function btnAddLabReportSpecificData(){
    
    count = parseInt($('#counter').val())+1;
    
     var trHtml = "";
   // if(validateDataBeforeAdding()){
    parameter = $('#parameterName').val();
    report = $('#reportname').val();
    result = $('#reportResult').val();
    reportArray = report.split("#");
    reportName = reportArray[1];
    reportId = reportArray[0];
    parameterArray = parameter.split("#");
    parameterName = parameterArray[1];
    parameterId = parameterArray[0];
    units = parameterArray[2];
    testId = parameterArray[3];
    //test.id+"#"+test.parametername+"#"+test.unitsid+"#"+test.testid
  idValue = (reportId+"_"+reportName+"_"+parameterId+"_"+parameterName+"_"+units+"_"+result+"_"+testId+"_"+parameter);
//idValue =  JSON.stringify({reportId:reportId,reportName:reportName,parameterName:parameterName,parameterValue1:parameterValue1});
console.log(idValue);
 //   reportTestData.push({reportId:reportId,reportName:reportName,parameterName:parameterName,parameterValue1:parameterValue1}); 
   
    btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + reportId + '</td><td>' + reportName + '</td><td>' + parameterName + '</td><td>' + units +'</td><td>' + result + 
        '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';
    
        createHiddenTextBox(idValue,count)
 
 
 
    //$('#tableValue').val(reportTestData);
    
    
   // $('#parameterName').val("");
   // $('#parameterValue1').val("");
   //  $('#parameterValue2').val("");
   // $('#parameterValue3').val("");
    $('#reportResult').val(" ");
    $('#parameterName').val("PARAMATER");
   // }
    $('#patient_records_reports_table').append(trHtml);
    $('#patient_records_reports_table').load();
   
}

/* ====== Lab Patient Results End =======*/
