/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();

//Added code by achyuth for getting tests based on Test Name (Sep072015)
$(document).ready(function(){ 
    
        $('#fetchPatientForReports').click( function(){
            fetchPatientList();
        });
    
    
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
                                	 '<td><a href="labindex.php?page=newwlab&testId='+testData[key].id+'&type=copy" >Copy and Create New</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="labindex.php?page=newwlab&testId='+testData[key].id+'&type=edit" >Edit</a></td></tr>';
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
	
	//Added below code by achyuth for getting Tests prices with test name functionality (Sep072015)
	$('#searchTestPrice').click(function(){
	var testname = $('#testName1').val();
	if(testname == ""){
        $('#labErrorMessage').html("<b><font color='red'>Error : </b> Please enter Test Name for search</font>").show();
        $('#labErrorBlock').show();
        return false;
    }
	$.ajax({
        type: 'GET',
        url: rootURL + '/getTestPrices/' +testname,
        dataType: "json",
        success: function(data){
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
            	
            	$('#testPrices tr td').remove();
                $.each(list, function(index, responseMessageDetails) {
                	
                     if(responseMessageDetails.status == "Success"){
                          //$('#labErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            //$('#labErrorBlock').show();
                            testPricesData = responseMessageDetails.data;
                             console.log("testPricesData : "+testPricesData);
                             var trHTML = "";
                             $.each(testPricesData,function(key, value){
                            	console.log("value...."+value); 
                            	 trHTML += '<tr class="data"><td><input type="checkbox" name="1" id="'+testPricesData[key].testid+'" class="link-test"/></td>'+
                            	 '<td>000'+testPricesData[key].testid+'</td><td>'+testPricesData[key].testname+'</td><td>'+testPricesData[key].department+'</td>'+
                            	 '<td><a href="#" onclick="showTestPriceDetails('+testPricesData[key].testid+')">Details</a></td>'+
                            	 '<td><a href="#" onclick="addTestPriceDetails('+testPricesData[key].testid+','+testPricesData[key].id+')">Add</a>&nbsp;&nbsp;<a href="#" onclick="editTestPriceDetails('+testPricesData[key].testid+','+testPricesData[key].id+')">Edit</a></td></tr>';
                            });
                             $('#testPrices').append(trHTML);
                                $('#testPrices').load();
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
	
});////End of code by achyuth for getting Tests prices with test name functionality (Sep072015)
	
	
	//Added below code by achyuth for getting Doctors with doctor name functionality (Sep072015)
	$('#searchDoctorsTests').click(function(){
	var doctorname = $('#doctorName').val();
	if(doctorname == ""){
        $('#labErrorMessage').html("<b><font color='red'>Error : </b> Please enter Doctor Name for search</font>").show();
        $('#labErrorBlock').show();
        return false;
    }
	$.ajax({
        type: 'GET',
        url: rootURL + '/getDoctorsList/' +doctorname,
        dataType: "json",
        success: function(data){

        	var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
            	
            	$('#doctorsList tr td').remove();
                $.each(list, function(index, responseMessageDetails) {
                	
                     if(responseMessageDetails.status == "Success"){
                          //$('#labErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            //$('#labErrorBlock').show();
                            doctorsData = responseMessageDetails.data;
                             var trHTML = "";
                             var line = 1;
                             $.each(doctorsData,function(key, value){
                            	 
                            	 trHTML += '<tr class="data"><td>'+line+'</td><td id="doctorNameText_'+doctorsData[key].doctorid+'">'+doctorsData[key].DoctorName+'</td>'+
                            	 '<td>'+doctorsData[key].HospitalName+'</td><td><a href="#" onclick="showDoctorTestDetails('+doctorsData[key].doctorid+','+doctorsData[key].namevalue+')">Details</a></td></tr>';
                            	 line++;
                            });
                             $('#doctorsList').append(trHTML);
                             $('#doctorsList').load();
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
	
	$('.field-text').on('blur', function(){
		var price = $('#price').val();
		var discount = $('#discount').val();
		var tax1 = $('#tax_1').val();
		var tax2 = $('#tax_2').val();
		var tax3 = $('#tax_3').val();
		var tax4 = $('#tax_4').val();
		var tax5 = $('#tax_5').val();
		
		var totalTax = ((tax1 != "") ? parseFloat(tax1): 0)+((tax2 != "") ? parseFloat(tax2): 0)+((tax3 != "") ? parseFloat(tax3): 0)+((tax4 != "") ? parseFloat(tax4): 0)+((tax5 != "") ? parseFloat(tax5): 0);
        console.log("totalTax : "+totalTax);
        var totalDiscountAmount = ((price != "") ? parseFloat(price): 0)*((discount != "") ? parseFloat(discount): 0)/100;
         console.log("totalDiscountAmount : "+totalDiscountAmount);
        var totalDiscountPrice = ((price != "") ? parseFloat(price): 0)-(totalDiscountAmount);
         console.log("totalDiscountPrice : "+totalDiscountPrice);
        var totalTaxAmount = (totalDiscountPrice)*(totalTax)/100;
         console.log("totalTaxAmount : "+totalTaxAmount);
        var totalPrice = (totalDiscountPrice)+(totalTaxAmount);
         console.log("totalPrice : "+totalPrice);

         $('#totalPriceEdit').text(totalPrice+'/-');
         $('#totalPriceEdit').show();
		
		
	});

    $('#quickregister').click(function() {
        $('#errorDisplay').html("  ");
            
            var sEmail = $('#email').val();
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
            checkQuickUserId($('#mobile').val());
           }else{
               console.log("In else ");
               $('#errormessages').show();
           } 

        var flag = "";
       
    });
 
 
 
 $('#generateBill').click( function(){
     
     recordcount = $('#recordcount').val();
             jsonObj = [];
     for(i=0;i<recordcount;i++){
          idvalue = '#testsample'+i;
          console.log("idvalue..........."+idvalue);
           console.log(".........................."+$(idvalue).val());
    
          if($(idvalue).is(":checked")){
              // console.log(".........................."+$(idvalue).val());
                        item = {}
                 item ["constid"] = $(idvalue).val();
                
                 jsonObj.push(item);
            }
            
     }
     console.log("host....................."+$('#host').val());
     console.log("rootnode....................."+$('#rootnode').val());
     var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();

     console.log("...........json obj...................."+JSON.stringify(jsonObj));
     $.ajax({
        type: 'POST',
        url: rootURL + '/collectPatientTestLabSample',
        dataType: "json",
        data:JSON.stringify(jsonObj),
        success: function(data){
            console.log(data);
            window.location.href=rootURL+"/Web/lab/labindex.php?page=samplecollection";
        }
    });   
     
 });
 
 
 
  $('#submitStaffPatientPaymentDetails').click( function(){
        
        console.log($('#pcardtype').val());
        console.log($('#pcardamount').val());
        console.log($('#psalesperson').val());
        console.log(console.log($('#ppatientid').val()));
       
         var patientData = JSON.stringify( {"patientId" : $('#ppatientid').val(),"cardAmount" : $('#pcardamount').val(),"officeid":$('#officeid').val(),"insttype":"Lab"} );
        
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
                      window.location.href = rootURL + "/Web/lab/labindex.php?page=payments&start=0&end=100&patientname="+patientname;
                  }else
                      window.location.href = rootURL + "/Web/lab/labindex.php?page=payments";

    });
 
});


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


function addTestPriceDetails(testId, diagnosticsTestId){
	$('#editData').hide();
	$('#saveData').show();
	$('#totalPriceEdit').hide();
	$('.field-text').val('');
	$('#testPriceModal').modal('show');
	$('#testId').val(testId);
	$('#diagnosticsTestId').val(diagnosticsTestId);
	$('#testPriceHistoryData').hide();
	$('.myModalLabel').text($('#name_'+testId).text());
}

function showDoctorTestDetails(doctorId,officeId){
	$.ajax({
		type: 'GET',
		url: rootURL + '/showDoctorPrescribedLabData/'+doctorId+"/"+officeId,
		dataType: "json",
		success: function(data){
			//alert(data[0].id);
			//var newData2 = data.responseMessageDetails;
			//var dataLength = newData2.data.length;
			$('#doctorPrescription').html('');
			//var newData = Array();
			var doctorName = $('#doctorNameText_'+doctorId).text();
			$('.doctor-name-text').text(doctorName);
			var oldAppId = "";
			$.each(data,function(key, value){
					$('#doctorPrescription').append('<tr id="'+data[key].id+'"><td>'+(key+1)+'</td><td>'+data[key].testname+'</td></tr>');
			});
		}
  });
  $('#myDoctorTestModal').modal('show');  
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


function registerQuickFormValidate(){
    console.log("validation");
    clearValidationMessage();
    if($('#mobile').val() == ""){
        console.log("new user");
        $('#errorDisplay').html("Please enter Mobile Number"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    if($('#mobile').val().length < 10){
         console.log("new user less then 10");
        $('#errorDisplay').html("Mobile Number Minimum length is 10"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
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
     if($('#name').val().length < 1){
         console.log("name");
        $('#errorDisplay').html("Please enter name"); 
        $('#name').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    /*
     if($('#email').val().length < 1){
          console.log("email");
        $('#errorDisplay').html("Please enter email");  
        $('#email').attr('style', 'background-color: #FBFAC9');
        return false; 
    }*/
     if($('#mobile').val().length < 1){
          console.log("mobile");
        $('#errorDisplay').html("Please enter mobile #"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    
    
   return true;
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

function saveTestPrice(){
	var price = $('#price').val();
	var discount = $('#discount').val();
	var tax_1 = $('#tax_1').val();
	var tax_2 = $('#tax_2').val();
	var tax_3 = $('#tax_3').val();
	var tax_4 = $('#tax_4').val();
	var tax_5 = $('#tax_5').val();
	var testId = $('#testId').val();
	var diagnosticsTestId = $('#diagnosticsTestId').val();
	var diagnosticId = $('#officeId').val();
	var userId = $('#userId').val();
	
	var appdt = ($('#start').val()).split('.');
    var effectedDate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
	var testPriceData = JSON.stringify( {"diagnosticid":diagnosticId,"testid":testId,"diagnosticstestid":diagnosticsTestId,"baseprice":price,"discount":discount,"tax1":tax_1,"tax2":tax_2,"tax3":tax_3,"tax4":tax_4,"tax5":tax_5,"status":"Y","createdby":userId,"effecteddate":effectedDate} );
	console.log(testPriceData);
    
            $.ajax({
		type: 'POST',
		url: rootURL + '/createTestPrice',
		dataType: "json",
		data:testPriceData,
		success: function(data){
			//alert(data.message);
		}
  });
}

function editTestPrice(){
	var price = $('#price').val();
	var discount = $('#discount').val();
	var tax_1 = $('#tax_1').val();
	var tax_2 = $('#tax_2').val();
	var tax_3 = $('#tax_3').val();
	var tax_4 = $('#tax_4').val();
	var tax_5 = $('#tax_5').val();
	var officeId = $('#officeId').val();
	var userId = $('#userId').val();
	var testId = $('#testId').val();
	
	var testPriceData = JSON.stringify( {"diagnosticstestid":officeId,"baseprice":price,"discount":discount,"tax1":tax_1,"tax2":tax_2,"tax3":tax_3,"tax4":tax_4,"tax5":tax_5,"status":"Y","createdby":userId,"testid":testId} );
	$.ajax({
		type: 'POST',
		url: rootURL + '/editTestPrice',
		dataType: "json",
		data:testPriceData,
		success: function(data){
			//alert(data.message);
		}
  });
}

function showTestPriceDetails(testId){
	console.log(rootURL + '/getTestPriceData/'+testId);
	$.ajax({
		type: 'GET',
		url: rootURL + '/getTestPriceData/'+testId,
		dataType: "json",
		success: function(data){
                    console.log("data[0]"+data);
                    console.log("data[0]"+data[0]);
                    if(data[0] != "undefined" && data != ""){
			$('#testPriceDetailsTable tbody').html('<tr><td>'+data[0].baseprice+'</td><td>'+data[0].discount+'</td><td>'+data[0].tax1+'</td><td>'+data[0].tax2+'</td><td>'+data[0].tax3+'</td><td>'+data[0].tax4+'</td><td>'+data[0].tax5+'</td><td>'+data[0].effecteddate+'</td></tr>');
			
                         tax1 = (data[0].tax1 != "") ? parseFloat(data[0].tax1): 0;
                        tax2 = (data[0].tax2 != "") ? parseFloat(data[0].tax2): 0;
                        tax3 = (data[0].tax3 != "") ? parseFloat(data[0].tax3): 0;
                        tax4 = (data[0].tax4 != "") ? parseFloat(data[0].tax4): 0;
                        tax5 = (data[0].tax5 != "") ? parseFloat(data[0].tax5): 0;
                    
                        console.log("data[0].tax1 : "+tax1);
                        console.log("data[0].tax2 : "+tax2);
                        console.log("data[0].tax3 : "+tax3);console.log("data[0].tax4 : "+tax4);
                        console.log("data[0].tax5 : "+tax5);
                        
                       
                        
			var totalTax = tax1+tax2+tax3+tax4+tax5;//parseFloat(tax1)+parseFloat(tax2)+parseFloat(tax3)+parseFloat(tax4)+parseFloat(tax5);
                        console.log("totalTax : "+totalTax);
                        var totalDiscountAmount = ((data[0].baseprice != "") ? parseFloat(data[0].baseprice): 0)*((data[0].discount != "") ? parseFloat(data[0].discount): 0)/100;
                         console.log("totalDiscountAmount : "+totalDiscountAmount);
                        var totalDiscountPrice = ((data[0].baseprice != "") ? parseFloat(data[0].baseprice): 0)-(totalDiscountAmount);
                         console.log("totalDiscountPrice : "+totalDiscountPrice);
                        var totalTaxAmount = (totalDiscountPrice)*(totalTax)/100;
                         console.log("totalTaxAmount : "+totalTaxAmount);
                        var totalPrice = (totalDiscountPrice)+(totalTaxAmount);
                         console.log("totalPrice : "+totalPrice);
	     	
			$('#totalPriceView').text(totalPrice+'/-');
			
			$('#recordData').text(data[0].createddate);
			$('.myModalLabel').text($('#name_'+testId).text());
			/*
			var equalsNaN = (totalPrice === NaN);
				if(equalsNaN == false){
					$('#totalPriceView').text('/-');
				}else{
					$('#totalPriceView').text(totalPrice+'/-');
				}
				*/
                           }else{
                               $('#testPriceDetailsTable tbody').html("<tr><td colspan='8'>&nbsp;</td></tr>");
                               $('#totalPriceView').text("0");
                               $('#recordData').text(" ");
                                $('.myModalLabel').text($('#name_'+testId).text());
                           }          
		}
		
  });
	
  $('#myTestModal').modal('show');  
}

function editTestPriceDetails(testid,diagnosticsTestId){
	$('#saveData').hide();
	$('#editData').show();
	$('#totalPriceEdit').show();
	
	$('#diagnosticsTestId').val(diagnosticsTestId);
	$('#testPriceHistoryData').hide();
	$('.myModalLabel').text($('#name_'+testid).text());
	
	
	$.ajax({
		type: 'GET',
		url: rootURL + '/getTestPriceData/'+diagnosticsTestId,
		dataType: "json",
		success: function(data){
			
			$('#price').val(data[0].testprice);
			$('#discount').val(data[0].discount);
			$('#tax_1').val(data[0].tax1);
			$('#tax_2').val(data[0].tax2);
			$('#tax_3').val(data[0].tax3);
			$('#tax_4').val(data[0].tax4);
			$('#tax_5').val(data[0].tax5);
			$('#testId').val(data[0].testid);
			$('#start').val(data[0].effecteddate);
			$('#testId').val(testid);
			//$('#editRecordData').text(data[0].createddate);
			
			   tax1 = (data[0].tax1 != "") ? parseFloat(data[0].tax1): 0;
                        tax2 = (data[0].tax2 != "") ? parseFloat(data[0].tax2): 0;
                        tax3 = (data[0].tax3 != "") ? parseFloat(data[0].tax3): 0;
                        tax4 = (data[0].tax4 != "") ? parseFloat(data[0].tax4): 0;
                        tax5 = (data[0].tax5 != "") ? parseFloat(data[0].tax5): 0;
                    
                        console.log("data[0].tax1 : "+tax1);
                        console.log("data[0].tax2 : "+tax2);
                        console.log("data[0].tax3 : "+tax3);console.log("data[0].tax4 : "+tax4);
                        console.log("data[0].tax5 : "+tax5);
                        
                       
                        
			var totalTax = tax1+tax2+tax3+tax4+tax5;//parseFloat(tax1)+parseFloat(tax2)+parseFloat(tax3)+parseFloat(tax4)+parseFloat(tax5);
                        console.log("totalTax : "+totalTax);
                        var totalDiscountAmount = ((data[0].baseprice != "") ? parseFloat(data[0].baseprice): 0)*((data[0].discount != "") ? parseFloat(data[0].discount): 0)/100;
                         console.log("totalDiscountAmount : "+totalDiscountAmount);
                        var totalDiscountPrice = ((data[0].baseprice != "") ? parseFloat(data[0].baseprice): 0)-(totalDiscountAmount);
                         console.log("totalDiscountPrice : "+totalDiscountPrice);
                        var totalTaxAmount = (totalDiscountPrice)*(totalTax)/100;
                         console.log("totalTaxAmount : "+totalTaxAmount);
                        var totalPrice = (totalDiscountPrice)+(totalTaxAmount);
                         console.log("totalPrice : "+totalPrice);
			$('#totalPriceEdit').text(totalPrice+'/-');
			
		}
		
  });
	$('#testPriceModal').modal('show'); 
}
function linkTestLab(){
	var officeId = $('#officeId').val();
	var userId = $('#userId').val();
	$('.link-test').each(function(){
		if($(this).is(':checked') == true){
			var testId = $(this).attr('id');
			var testData = JSON.stringify( {"diagnosticstestid":officeId,"testid":testId, "userid":userId, "status":"Y"} );
			$.ajax({
				type: 'POST',
				url: rootURL + '/linkTestToLab',
				dataType: "json",
				data:testData,
				success: function(data){
					alert(data.responseMessageDetails.message);
					window.location.href=rootURL+"/Web/lab/labindex.php?page=createtest";
				}
		  });
		}
	});
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

function showPriceHistory(){
	
	var diagnosticstestId = $('#diagnosticsTestId').val();
	$.ajax({
		type: 'GET',
		url: rootURL + '/getLabTestPriceHostory/'+diagnosticstestId,
		dataType: "json",
		success: function(data){
			$('#testPriceHistoryDataTr').html('');
			$('#testPriceHistoryData').show();
			if(data.length > 0){
				$.each(data,function(key, value){
					$('#testPriceHistoryDataTr').append('<tr><td>'+data[key].baseprice+'</td><td>'+data[key].discount+'</td><td>'+data[key].tax1+'</td><td>'+data[key].tax2+'</td><td>'+data[key].tax3+'</td>'+'<td>'+data[key].tax4+'</td><td>'+data[key].tax5+'</td></td><td>'+data[key].createddate+'</td></tr>');
				});
			}else{
				$('#testPriceHistoryDataTr').append('<tr><td colspan="8" style="text-align:center;">No Data Found</td></tr>');
			}
			
		}
  });
}

/* Added Achyuth */

function showLabTestsPateients(id,labid){
	$.ajax({
		type: 'GET',
		url: rootURL + '/getLabTestPatients/'+id+'/'+labid,
		dataType: "json",
		success: function(data){
			$('#labtestPatientList').html('');
			if(data != null)
			{
				$.each(data,function(key, value){
					$('#labtestPatientList').append('<tr><td>'+data[key].id+'</td><td>'+data[key].PatientName+'</td><td>'+data[key].DoctorName+'</td><td>'+data[key].AppointementDate+'</td><td>'+data[key].AppointmentTime+'</td>'+'<td><a href="#">Edit</a></td></tr>');
				});
			}
			else
			{
				$('#labtestPatientList').append('<tr><td colspan="6" style="text-align:center" >No data found</td></tr>');
			}
			
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

function clearParamFields(){
	$('#parameterName').val('').removeAttr('style');
	$('#addInputs').val('').removeAttr('style');
	$('#comments').val('').removeAttr('style');
	$('#bioref').val('').removeAttr('style');
	$('#units option:eq(0)').prop('selected', true);
	$('#units').removeAttr('style');
}

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
    
     registerQuickUser($('#mobile').val(),$('#qpassword').val(),$('#email').val(),$('#mobile').val(),'Others',$('#name').val());


}


function registerQuickUser(userName,password,email,mobile,profession,name){
   
    var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"name":name,"insttype":"Lab"} );
        
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
                                 link = "<font color='blue'><a href='#' onclick='createLabsTest("+data.ID+")'>Create</a></font>";
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


function createLabsTest(userid){
    console.log(userid);
    $('#testforpatient').val(userid);
    $('#showTestDiagnostics').modal('show');//createLabsTest
    
    
}

function editPaymentDetails(id){
    console.log('Hellooooo');
    $('#ppatientid').val(id); 
    $('#myPatientPaymentDetails').modal('show');
    
    
}
