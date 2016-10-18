/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();

//Added code by achyuth for getting tests based on Test Name (Sep072015)
$(document).ready(function(){ 
    
   
    $('#searchTest').click(function(){
		var testname = $('#testName').val();
		if(testname == ""){
	        $('#labErrorMessage').html("<b><font color='red'>Error : </b> Please enter Test Name for search</font>").show();
	        $('#labErrorBlock').show();
	        return false;
	    }
		$.ajax({
            type: 'GET',
            url: rootURL + '/getSearchedTests/' +testname,
            dataType: "json",
            success: function(data){
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
                $('#testsdata tr td').remove();
                    $.each(list, function(index, responseMessageDetails) {
                    	
                         if(responseMessageDetails.status == "Success"){
                              //$('#labErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                //$('#labErrorBlock').show();
                                testData = responseMessageDetails.data;
                                 console.log("testData : "+testData);
                                 var trHTML = "";
                                 $.each(testData,function(key, value){
                                	console.log("value..2.."+value);  
                                	 trHTML += '<tr class="data"><td><input type="checkbox" name="1" id="'+testData[key].id+'" class="link-test"/></td>'+
                                	 '<td>000'+testData[key].id+'</td><td>'+testData[key].testname+'</td><td>'+testData[key].department+'</td>'+
                                	 '<td><a href="#" onclick="showTestDetails('+testData[key].id+')">Details</a></td>'+
                                	 '</tr>';
                                });
                                 $('#testsdata').append(trHTML);
                                    $('#testsdata').load();
                                    $('#labErrorMessage').removeClass('in');
                                    $('#labErrorMessage').addClass('out');
                         } else{
                               $('#labErrorMessage').html("<b><font color='red'>Error : </b>"+responseMessageDetails.message+'</font>').show();
                               $('#labErrorMessage').removeClass('out');
                               $('#labErrorMessage').addClass('in');
                         }
                         
                 });   
                
            }
        }); 
		
	});
	
    pid = $('#pid').val();
    console.log(pid);
    console.log(rootURL + '/fetchPatientSpecificOrders/' + pid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchPatientSpecificOrders/' + pid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_received_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientlid = "";
                            $('#recordcount').val(dataCount);
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientlid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientlid != data.ID ));
                                
                           checkboxid = index+"selected";
                           if(data.status == "D")
                            checklink = "<input type='checkbox' id="+checkboxid+" name="+checkboxid+" value="+data.id+">";   
                           else
                            checklink = "";
                                console.log("......"+data.redirecteddate);
                                 
                                 trHTML ="<tr><td nowrap='true'>"+checklink+"</td><td>"+((data.redirecteddate == null) ? " " : data.redirecteddate)+"</td>\n\
<td>"+((data.medicinename == "") ? " " : data.medicinename)+"</td><td>"+((data.dispatchdate == null) ? " " : data.dispatchdate)+"</td><td>"+((data.medicalshopname == null) ? " " : data.medicalshopname)+"</td>\n\
<td>"+((data.price == null) ? " " : data.price)+"</td></tr>";
                                       $('#patient_medicines_order_received_table').append(trHTML);
                                        $('#patient_medicines_order_received_table').load();
                               
                                 patientlid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_received_table').append(trHTML);
                             $('#patient_medicines_order_received_table').load();
                        }
                         
                    }
                });

                        
        }
    });
    });   
    
    
     
    function showTestDetails(id){
	
	$.ajax({
		type: 'GET',
		url: rootURL + '/getLabTestData/'+id,
		dataType: "json",
		success: function(data){
			$('#PatientReportTable tbody').html('<tr><td>'+data[0].parametername+'</td><td>'+data[0].bioref+'</td><td>'+data[0].unitsid+'</td><td>'+data[0].comments+'</td><td>'+data[0].addinputs+'</td></tr>');
		}
        });
         $('#myTestModal').modal('show');  
	
    }
    
    function addParamaters(){
	
	var department = $('#department').val();
	var parameterName = $('#parameterName').val();
	var units = $('#units').val();
	var comments = $('#comments').val();
	var addInputs = $('#addInputs').val();
	var bioref = $('#bioref').val();
	var pageType = $('#pageType').val();
	var indexValue = $('#indexValue').val();
	var unitsText = $("#units option:selected").text();
		
		if(pageType != 'edit'){
			
			if(labParamValidate()){
				indexValue = parseInt(indexValue)+1;
				$('#paramsData').append('<tr id="'+indexValue+'" data-type="update"><td>'+parameterName+'</td><td>'+unitsText+
						'</td><td>'+comments+'</td><td>'+addInputs+'</td><td>'+bioref+'</td><td>'+
						'<button class="btn btn-warning btn-xs" onclick="editParams('+indexValue+')"><i class="fa fa-trash-o"></i> Edit</button> &nbsp;&nbsp;&nbsp;&nbsp;'+
						'<button class="btn btn-warning btn-xs" onclick="deleteParam('+indexValue+')"><i class="fa fa-trash-o"></i> Delete</button></td>');
				$('#indexValue').val(indexValue);
				clearParamFields();
				
			}else{
				$('#labErrorMessage').show();
			}
		}else{
			$.ajax({
				type: 'GET',
				url: rootURL + '/getLastLabtestsdetailsId',
				dataType: "json",
				success: function(data){
					$('#lastInserteID').val(data[0].MaximumID);
					if(indexValue == 0){
						var lastId = parseInt(data[0].MaximumID)+parseInt(1);
						$('#indexValue').val(lastId);
						indexValue = lastId;
						$('#paramsData').append('<tr id="'+indexValue+'"data-type="insert"><td>'+parameterName+'</td><td>'+units+'</td><td>'+comments+'</td><td>'+addInputs+'</td><td>'+bioref+'</td><td><a href="javascript:editParams('+indexValue+')">Edit</a></td></tr>');
						$('#indexValue').val(indexValue);
						clearParamFields();
					}else{
						var lastId = parseInt($('#indexValue').val())+parseInt(1);
						$('#indexValue').val(lastId);
						indexValue = lastId;
						$('#paramsData').append('<tr id="'+indexValue+'"data-type="insert"><td>'+parameterName+'</td><td>'+units+'</td><td>'+comments+'</td><td>'+addInputs+'</td><td>'+bioref+'</td><td><a href="javascript:editParams('+indexValue+')">Edit</a></td></tr>');
						$('#indexValue').val(indexValue);
						clearParamFields();
					}
					
				} 
			});
		}
		
}

function editParams(id){
	var editParamArr = Array();
	$('#'+id+' td').each(function(){
		editParamArr.push($(this).text());
	});
	$('#parameterNameField').val(editParamArr[0]);
	$('#unitsField').val(editParamArr[1]);
	$('#commentsField').val(editParamArr[2]);
	$('#additionalInputsField').val(editParamArr[3]);
	$('#bioRefField').val(editParamArr[4]);
	$('#testParamId').val(id);
	
	$('#paramEditModal').modal('show');
}

function deleteParam(id){
	
	$('#paramsData #'+id).remove();
	
}

function clearParamFields(){
	$('#parameterName').val('').removeAttr('style');
	$('#addInputs').val('').removeAttr('style');
	$('#comments').val('').removeAttr('style');
	$('#bioref').val('').removeAttr('style');
	$('#units option:eq(0)').prop('selected', true);
	$('#units').removeAttr('style');
}

function editLab(testId){
	var testName = $('#testName').val();
	var department = $('#department').val();
	var parameterName = $('#parameterName').val();
	var units = $('#units').val();
	var comments = $('#comments').val();
	var addInputs = $('#addInputs').val();
	var bioref = $('#bioref').val();
	var createdby = $('#createdby').val();
	
	var paramData = Array();
	var paramIds = Array();
	var paramType = Array();
	$("#paramsData tr").each(function(i, v){
		paramData[i] = Array();
		paramIds.push($(this).attr('id'));
		paramType.push($(this).attr('data-type'));
	    $(this).children('td').each(function(ii, vv){
	    	paramData[i][ii] = $(this).text();
	    }); 
	});
	
	var labData = JSON.stringify( {"testid":testId, "testname":testName,"testtype":"blod","department":department,"status":"Y","createdby":createdby,"paramData":paramData,"paramIds":paramIds,'paramType':paramType} );
	console.log(labData);
    console.log(rootURL + '/editLabTestData');
     $.ajax({
		type: 'PUT',
		url: rootURL + '/editLabTestData',
		dataType: "json",
		data:labData,
		success: function(data){
			
                        $('#labErrorMessage').html('<b>Info : Test Created Successfully</b>'); 
                        $('#labErrorBlock').show(); 
		},
                error: function(data){
                    
                        $('#labErrorMessage').html('<b>Error : Test Creation Failed Please contact Administrator</b>'); 
                        $('#labErrorBlock').show(); 
                    
                }
  });
}


function createLab(){
	var paramsData = $('#paramsData tr').length;
	
	if(labValidate()){
        console.log("In if condition validation success ");
        //clearValidationMessage()
       if(paramsData > 0){
        	saveLabData();
        }else{
        	$('#labErrorMessage').show();
        	$('#labErrorMessage').text('Please add parameters data');
        }
       }else{
           console.log("In else ");
           $('#labErrorMessage').show();
       } 

}



function saveLabData(){
	var testName = $('#testName').val();
	var department = $('#department').val();
	var parameterName = $('#parameterName').val();
	var units = $('#units').val();
	var comments = $('#comments').val();
	var addInputs = $('#addInputs').val();
	var bioref = $('#bioref').val();
	var createdby = $('#createdby').val();
	var diagnosticstestid = $('#officeId').val();
	
	var paramData = Array();
    
	$("#paramsData tr").each(function(i, v){
		paramData[i] = Array();
	    $(this).children('td').each(function(ii, vv){
	    	paramData[i][ii] = $(this).text();
	    }); 
	});

	//alert(paramData);
	//var paramData = JSON.stringify(paramData);
         
	var labData = JSON.stringify( {"testname":testName,"testtype":"","department":department,"status":"Y","createdby":createdby,"diagnosticstestid":diagnosticstestid,paramData:paramData} );
        console.log(labData);
        console.log(rootURL + '/createLabTest');
	$.ajax({
		type: 'POST',
		url: rootURL + '/createLabTest',
		dataType: "json",
		data:labData,
		success: function(data){
			//alert(data.responseMessageDetails.message);
			$('#labErrorMessage').show();
			$('#labErrorMessage').html(testName+' '+data.responseMessageDetails.message);
			$('#testName').val('').removeAttr('style');
			$('#department option:eq(0)').prop('selected', true);
			$('#department').removeAttr('style');
			$('#paramsData').html('');
		}
  });
  
}


function labValidate(){
    console.log("validation");
    //clearValidationMessage();
    
     if($('#testName').val().length < 1){
        $('#labErrorMessage').html("Please enter test name"); 
        $('#testName').attr('style', 'background-color: #FBFAC9');
        return false;
    }
     if($('#department').val() < 1){
        $('#labErrorMessage').html("Please select department");  
        $('#department').attr('style', 'background-color: #FBFAC9');
        return false; 
    }
    
   return true;
}

function labParamValidate(){
    console.log("validation");
     
     if($('#parameterName').val().length < 1){
          console.log("parameterName");
        $('#labErrorMessage').html("Please enter last parameter name"); 
        $('#parameterName').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
     if($('#units').val() < 1){
          console.log("units");
        $('#labErrorMessage').html("Please select units");  
        $('#units').attr('style', 'background-color: #FBFAC9');
        return false; 
    }
   /*  if($('#comments').val().length < 1){
          console.log("comments");
        $('#labErrorMessage').html("Please enter comments"); 
        $('#comments').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    if($('#addInputs').val().length < 1){
         console.log("addInputs");
        $('#labErrorMessage').html("Please enter additional input");
        $('#addInputs').attr('style', 'background-color: #FBFAC9');
        return false; 
    }*/
     if($('#bioref').val().length < 1){
          console.log("bioref");
        $('#labErrorMessage').html("Please enter bio reference");  
        $('#bioref').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    
   return true;
}


function updateParamsData(){
	var id = $('#testParamId').val();
	var editParamArr = Array();
	$('.field-text').each(function(){
		editParamArr.push($(this).val());
	});
	var i = 0;
	$('#'+id+' td').each(function(){
		$(this).text(editParamArr[i]);
		i++;
	});
	//alert(editParamArr);
	/*$('#parameterNameField').val(editParamArr[0]);
	$('#unitsField').val(editParamArr[1]);
	$('#commentsField').val(editParamArr[2]);
	$('#additionalInputsField').val(editParamArr[3]);
	$('#bioRefField').val(editParamArr[4]);*/
	
}

function linkTestLab(){
	var officeId = $('#officeId').val();
	var userId = $('#userId').val();
	$('.link-test').each(function(){
		if($(this).is(':checked') == true){
			var testId = $(this).attr('id');
			var testData = JSON.stringify( {"industryid":officeId,"testid":testId, "userid":userId, "status":"Y"} );
                       // console.log(testData);
                      //  console.log(rootURL + '/linkTestToIndustryData');
			$.ajax({
				type: 'POST',
				url: rootURL + '/linkTestToIndustryData',
				dataType: "json",
				data:testData,
				success: function(data){
					alert(data.responseMessageDetails.message);
					window.location.href=rootURL+"/Web/industry/industryindex.php?page=importtest";
				}
		  });
		}
	});
}