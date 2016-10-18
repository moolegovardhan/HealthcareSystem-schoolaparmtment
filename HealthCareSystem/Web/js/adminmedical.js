/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
      
      displayErrorResults();
      
     $('#getStaffMedical').click(function() {
         
        displayErrorResults();
         
         if($('#adminMedicalname').val() < 2){//
               $('#adminErrorMessage').html("Please Enter Medical Shop Name");
               $('#adminErrorBlock').show();
               return false;
            }
         $('input[type="button"]').removeAttr('disabled');
         getStaffMedicalList($('#adminMedicalname').val());
         
     });
     
    $('#btnStaffSubmitMedical').click(function() {
    	
    	var medicalShopId = $('#medicalid').val();
    	if(medicalShopId != ''){
	         emailAddress = $('#email').val();
	        var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
	           var valid = emailRegex.test(emailAddress);
	            if (!valid) {
	              $('#adminErrorMessage').html("Please Enter valid email address {sample@sample.com}");
	              $('#adminErrorBlock').show();
	
	              return false;
	            }  
    	}
        
            
        displayErrorResults();
        if(validateForm()){ 
           console.log("medical ID : "+$('#medicalid').val() );
           
           if($('#medicalid').val() != ""){
               updateMedicalData(buildMedicalJsonObject());
           }else{
               registerMedical(buildMedicalJsonObject()); 
           }
           $('#editMedicalModal').modal('hide');
       }
    });
    
    
     $('#name').bind('keypress', function (e) {
        /*var valid = (e.which == 32);
        if (!valid) { //space bar
            e.preventDefault();
        }*/
        var valid = (e.which == 32 || e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122);
        if (!valid) {
            e.preventDefault();
        }
   
        var valid = (e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122 || e.which == 32 || e.which == 95 || e.which == 8);
        if (!valid) {
            e.preventDefault();
        }
        console.log(valid);
  });
   
  $('#mobile').bind('keypress', function (e) {
     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        } 
  });  
  $('#landline').bind('keypress', function (e) {
     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57))) {
            e.preventDefault();
        } 
  }); 
 $('#zipcode').bind('keypress', function (e) {
     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57))) {
            e.preventDefault();
        } 
  });
 $('#email').bind('focusout', function (e) {
     emailAddress = $('#email').val();
     var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
        var valid = emailRegex.test(emailAddress);
         if (!valid) {
           $('#adminErrorMessage').html("Please Enter valid email address {sample@sample.com}");
           $('#adminErrorBlock').show();
            
           return false;
         } else{
             $('#adminErrorMessage').html(" ");
           $('#adminErrorBlock').hide();
           return true;
       }  
       
      
 });  
$("#district").keypress(function(e){
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    if(code == 32 || (code>=97 && code<=122)|| (code>=65 && code<=90))
        return true;
    else
        return false;
});
$("#city").keypress(function(e){
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    if(code == 32 || (code>=97 && code<=122)|| (code>=65 && code<=90))
        return true;
    else
        return false;
});
$("#state").keypress(function(e){
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    if(code == 32 || (code>=97 && code<=122)|| (code>=65 && code<=90))
        return true;
    else
        return false;
});
  
$('#addMedicalShop').click(function(){
	$('.myModalLabel').text('Add Medical Shop');
	$('#editMedicalModal').modal('show');
});  
     
});


function buildMedicalJsonObject(){
        name = $('#name').val();
        zipcode = $('#zipcode').val();
        state  = $('#state').val();        
        district = $('#district').val();
        city = $('#city').val();
        landline = $('#landline').val();
        address1 = $('#address1').val();
        email = $('#email').val();
        address2 = $('#address2').val();
        mobile = $('#mobile').val();
        medicalid = $('#medicalid').val();
        
        var medicalData = JSON.stringify( {"name" : name,"zipcode" : zipcode,"state" : state,"district" : district,
            "city" : city,"landline" : landline,"email" : email,"address1":address1,"address2":address2,"mobile":mobile,
            "medicalid":medicalid } ); 
        
        return medicalData;
    
}

function updateMedicalData(medicalData){
    
    
    console.log(medicalData);
    console.log(rootURL + '/updateMedical');
         $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL + '/updateMedical',
            dataType: "json",
            data:  medicalData,
            success: function(data, textStatus, jqXHR){
                    console.log('authentic success: ' + data)
                 var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                        
                 clearFormValues();
                  $.each(list, function(index, responseMessageDetails) {
                        console.log(responseMessageDetails);
                        if(responseMessageDetails.status == "Success"){
                            $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#adminErrorBlock').show();
                            getStaffMedicalList($('#adminMedicalname').val());
                        }   
                    });   

                },
                error: function(data){
                     var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

                    $.each(list, function(index, responseErrorMessageDetails) {
                        var message = responseErrorMessageDetails.message;
                        if(message.indexOf("]:") > 0)
                          message = message.substring(0,message.indexOf("]:")+2);

                        $('#adminErrorMessage').html("<b>Error : </b>"+message);
                        $('#adminErrorBlock').show();
                    });
                }
            });
    
}
function registerMedical(medicalData){
    
    console.log(medicalData);
         $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL + '/createMedical',
            dataType: "json",
            data:  medicalData,
            success: function(data, textStatus, jqXHR){
                    console.log('authentic success: ' + data)
                 var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                        
                 clearFormValues();
                  $.each(list, function(index, responseMessageDetails) {
           
                        if(responseMessageDetails.status == "Success"){
                            $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#adminErrorBlock').show();
                            
                        }   
                    });   

                },
                error: function(data){
                    var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

                    $.each(list, function(index, responseErrorMessageDetails) {
                        var message = responseErrorMessageDetails.message;
                        if(message.indexOf("]:") > 0)
                          message = message.substring(0,message.indexOf("]:")+2);

                        $('#adminErrorMessage').html("<b>Error : </b>"+message);
                        $('#adminErrorBlock').show();
                    });
                }
            });
    
}


function clearFormValues(){
    
    $('#name').val("");
    $('#zipcode').val("");
    $('#state').val("");
    $('#district').val("");
    $('#city').val("");
    $('#address1').val("");
    $('#address2').val("");
    $('#landline').val("");
    $('#email').val("");
    $('#mobile').val("");
    
      
    
    
}
function validateForm(){
    clearValidationMessage();
    if($('#name').val().length < 1){
        $('#nameerrormsg').html("Please enter Diagnostics Name"); 
        return false;
    }
    if($('#mobile').val().length < 1){
        $('#mobileerrormsg').html("Please enter Mobile #"); 
        return false;
    }
  /*  if($('#email').val().length < 1){
        $('#emailerrormsg').html("Please enter Email Id"); 
        return false;
    } */
    if($('#landline').val().length < 1){
        $('#landlineerrormsg').html("Please enter user id"); 
        return false;
    }
    if($('#address1').val().length < 1){
        $('#address1errormsg').html("Please enter Address Line 1"); 
        return false;
    }
    if($('#city').val().length < 1){
        $('#cityerrormsg').html("Please enter City"); 
        return false;
    }if($('#district').val().length < 1){
        $('#districterrormsg').html("Please enter District"); 
        return false;
    }
    if($('#state').val().length < 1){
        $('#stateerrormsg').html("Please enter State"); 
        return false;
    }
    if($('#zipcode').val().length < 1){
        $('#zipcodeerrormsg').html("Please enter zipcode"); 
        return false;
    }
    return true;
}

function clearValidationMessage(){
    $('#zipcodeerrormsg').html("");
    $('#nameerrormsg').html("");
    $('#mobileerrormsg').html("");
    $('#emailerrormsg').html("");
    $('#landlineerrormsg').html("");
    $('#cityerrormsg').html("");
    $('#address1errormsg').html("");
    $('#districterrormsg').html("");
    $('#stateerrormsg').html("");
    
    
}




function getStaffMedicalList(medicalname){
   // var page = GetURLParameter('page');
    var para = "";
   
    displayErrorResults();
    para = "Medical";
    
    console.log("Hello : "+rootURL + '/medicalData/'+medicalname);
    if(medicalname != ''){
	     $.ajax({
	    type: 'GET',
	    url: rootURL + '/medicalData/'+medicalname,
	    dataType: "json",
	    success: function(data){
	      console.log('authentic success: ' + data)
	        var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
	       var trHTML = '';
	      // $("#staff_medical_NonActive_data tbody").remove();
	       $("#staff_Medical_NonActive_data tbody").html('');
	       
	       console.log("Data List Length "+list.length);
	       var objLength = '';
	       $.each(list, function(index, responseMessageDetails) {
	           
	           if(responseMessageDetails.status == "Success"){
	               $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
	               $('#adminErrorBlock').show();
	                   
	                shopData = responseMessageDetails.data;
	                
	                console.log("Diagnostics"+shopData.length);
	                objLength = shopData.length;
	                $.each(shopData, function(index, masterUsersData) {
	                    s = masterUsersData.id;
	                    s = s.replace(/^0+/, '');
	                    //trHTML += '<tr><td>' + s +  '</td><td>' + masterUsersData.shopname   +'</td><td> <a href="#" onclick = showMedicalData('+ s +')> Edit <a></td></tr>';
	                    
	                    $('#staff_Medical_NonActive_data tbody').append('<tr class="data"><td>'+s+'</td><td>'+masterUsersData.shopname+
	                    		'</td><td>'+masterUsersData.mobile+'</td><td>'+masterUsersData.email+'</td><td>'+masterUsersData.haddress+
	                    		'</td><td>'+masterUsersData.district+'</td><td>'+masterUsersData.city+'</td><td>'+masterUsersData.state+
	                    		'</td><td>'+masterUsersData.zipcode+'</td><td><button type="button" class="btn btn-warning btn-xs" onclick="showMedicalData('+ s +')"><span class="glyphicon glyphicon-edit"></span> Edit</button></td></tr>');
	                    
	                });
	                
	            }else{
	                   $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
	                   $('#adminErrorBlock').show();
	            }
	           
	       });
	         //$('#staff_medical_NonActive_data').append(trHTML);
	         //$('#staff_medical_NonActive_data').load(); 
	       if(objLength > 0){
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
							$rows = $('#staff_Medical_NonActive_data tbody').find('.data');
		
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
	    	   $('#tablePaging').hide();
	       }
	       
		},
	        error: function(data){
	                     var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);
	
	                    $.each(list, function(index, responseErrorMessageDetails) {
	                        var message = responseErrorMessageDetails.message;
	                        if(message.indexOf("]:") > 0)
	                          message = message.substring(0,message.indexOf("]:")+2);
	
	                        $('#adminErrorMessage').html("<b>Error : </b>"+message);
	                        $('#adminErrorBlock').show();
	                    });
	        }
		});
     
    }else{
    	location.href = rootURL+'/Web/admin/adminindex.php?page=medical';
    }
}




function showMedicalData(medicalid){
    
    displayErrorResults();
    
    console.log(medicalid);
    
    var requesturl = "";
    requesturl = rootURL + '/medicalDataById/'+medicalid;
    
     console.log(requesturl);
     
    $.ajax({
    type: 'GET',
    url: requesturl,
    dataType: "json",
    success: function(data){
       console.log('authentic success: ' + data)
       var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]); 
        console.log("Data List Length : "+list.length);  
        $.each(list, function(index, responseMessageDetails) {
            
            console.log("Message : "+responseMessageDetails.message);console.log("Status : "+responseMessageDetails.status);
            if(responseMessageDetails.status == "Success"){
                
                if(responseMessageDetails.data.length > 0){
                    medicalDataById =   responseMessageDetails.data[0];  
                    
                    console.log("medicalDataById :"+medicalDataById.id);
                    $('#name').val(medicalDataById.shopname);
                    $('#mobile').val(medicalDataById.mobile);
                    $('#landline').val(medicalDataById.landline); 
                    $('#email').val(medicalDataById.email);
                    $('#address1').val(medicalDataById.address1); 
                    $('#address2').val(medicalDataById.address2);
                    $('#city').val(medicalDataById.city);
                    $('#district').val(medicalDataById.district); 
                    $('#state').val(medicalDataById.state); 
                    $('#medicalid').val(medicalDataById.id);
                    $('#zipcode').val(medicalDataById.zipcode);
                    $('.myModalLabel').text('Edit Medical Shop');
                    $('#editMedicalModal').modal('show');
              }else{
                  $('#adminErrorMessage').html("<b>Info : No Data found. If error exists please contact admin </b>");
                  $('#adminErrorBlock').show();
              }
            }else {
                   $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                   $('#adminErrorBlock').show();
            }
            
        });
       },
        error: function(data){
                        var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

            $.each(list, function(index, responseErrorMessageDetails) {
                var message = responseErrorMessageDetails.message;
                if(message.indexOf("]:") > 0)
                  message = message.substring(0,message.indexOf("]:")+2);

                $('#adminErrorMessage').html("<b>Error : </b>"+message);
                $('#adminErrorBlock').show();
            });
        }
	});
    
}



