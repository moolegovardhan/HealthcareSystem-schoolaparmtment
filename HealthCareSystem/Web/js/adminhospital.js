/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
      
      displayErrorResults();
      
     $('#getStaffHosiptal').click(function() {
         
        displayErrorResults();
         
         if($('#adminhosiptalname').val() < 2){//
               $('#adminErrorMessage').html("Please Enter Hospital Name");
               $('#adminErrorBlock').show();
               return false;
            }
         $('input[type="button"]').removeAttr('disabled');
         getStaffHosiptalList($('#adminhosiptalname').val());
         
     });
     
    $('#btnStaffSubmitHospital').click(function() {
    	
       var haspitalId = $('#hosiptalid').val();
       
       if(haspitalId != ''){
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
            
           if($('#hosiptalid').val() != ""){
               // alert("Hello 1 :"+($('#clinic').val() != ""));
                var data = buildHospitalJsonObject();
               updateHospitalData(data);
           }else{
               //alert("Hi"+$('#clinic').is(":checked"));
               registerHospital(buildHospitalJsonObject()); 
           }
           $('#editHospitalModal').modal('hide');
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
    
    /*
     * if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
     */
    
    
$('#addHosiptal').click(function(){
	$('.myModalLabel').text('Add Hospital');
	$('#editHospitalModal').modal('show');
});
    
    
});


function buildHospitalJsonObject(){
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
        hospitalid = $('#hosiptalid').val();
         clinic = (($('#clinic').is(":checked") == true) ? 'Y' : 'N');
     // alert("hospitalid"+hospitalid);
        var hospitalData = JSON.stringify( {"name" : name,"zipcode" : zipcode,"state" : state,"district" : district,
            "city" : city,"landline" : landline,"email" : email,"address1":address1,"address2":address2,"mobile":mobile,
            "hospitalid":hospitalid,"clinic":clinic } ); 
        
        return hospitalData;
    
}

function updateHospitalData(hospitalData1){
    
    
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
        hospitalid = $('#hosiptalid').val();
         clinic = (($('#clinic').is(":checked") == true) ? 'Y' : 'N');
    
      var hospitalData = JSON.stringify( {"name" : name,"zipcode" : zipcode,"state" : state,"district" : district,
            "city" : city,"landline" : landline,"email" : email,"address1":address1,"address2":address2,"mobile":mobile,
            "hospitalid":hospitalid,"clinic":clinic  } ); 
    //alert("Hello"+rootURL + '/updateHospital');
    console.log(hospitalData);
         $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL + '/updateHospital',
            dataType: "json",
            data:  hospitalData,
            success: function(data, textStatus, jqXHR){
                    console.log('authentic success: ' + data)
                 var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                        
                 clearFormValues();
                  $.each(list, function(index, responseMessageDetails) {
           
                        if(responseMessageDetails.status == "Success"){
                            $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#adminErrorBlock').show();
                            getStaffHosiptalList($('#adminhosiptalname').val());
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
function registerHospital(hospitalData){
    
    console.log(hospitalData);
         $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL + '/createHospital',
            dataType: "json",
            data:  hospitalData,
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
        $('#nameerrormsg').html("Please enter Hosiptal Name"); 
        return false;
    }
    if($('#mobile').val().length < 1){
        $('#mobileerrormsg').html("Please enter Mobile #"); 
        return false;
    }
  /*  if($('#email').val().length < 1){
        $('#emailerrormsg').html("Please enter Email Id"); 
        return false;
    }*/
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




function getStaffHosiptalList(doctorname){
   // var page = GetURLParameter('page');
    var para = "";
   
    displayErrorResults();
    para = "Hospital";
    
    console.log(rootURL + '/hospitalData/'+doctorname);
    
    if(doctorname != ''){
	     $.ajax({
	    type: 'GET',
	    url: rootURL + '/hospitalData/'+doctorname,
	    dataType: "json",
	    success: function(data){
	      console.log('authentic success: ' + data)
	        var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
	       var trHTML = '';
	       //$("#staff_hosiptal_NonActive_data tbody").remove();
	       $("#staff_hosiptal_NonActive_data tbody").html('');
	       
	       console.log("Data List Length "+list.length);
	       var objLength = '';
	       $.each(list, function(index, responseMessageDetails) {
	           
	           if(responseMessageDetails.status == "Success"){
	               $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
	               $('#adminErrorBlock').show();
	                   
	                hospitalData = responseMessageDetails.data;
	                
	                console.log("Hospital"+hospitalData.length);
	                objLength = hospitalData.length;
	                $.each(hospitalData, function(index, masterUsersData) {
	                    s = masterUsersData.id;
	                    s = s.replace(/^0+/, '');
	                   // trHTML += '<tr><td>' + s +  '</td><td>' + masterUsersData.hosiptalname   +'</td><td> <a href="#" onclick = showHosiptalData('+ s +')> Edit <a></td></tr>';
	                    
	                    $('#staff_hosiptal_NonActive_data tbody').append('<tr class="data"><td>'+s+'</td><td>'+masterUsersData.hosiptalname+
	                    		'</td><td>'+masterUsersData.mobile+'</td><td>'+masterUsersData.email+'</td><td>'+masterUsersData.haddress+
	                    		'</td><td>'+masterUsersData.district+'</td><td>'+masterUsersData.city+'</td><td>'+masterUsersData.state+
	                    		'</td><td>'+masterUsersData.zipcode+'</td><td><button type="button" class="btn btn-warning btn-xs" onclick="showHosiptalData('+ s +')"><span class="glyphicon glyphicon-edit"></span> Edit</button></td></tr>');
	                });
	            }else{
	            	
	                   $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
	                   $('#adminErrorBlock').show();
	            }
	           
	       });
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
							$rows = $('#staff_hosiptal_NonActive_data tbody').find('.data');
		
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
	        // $('#staff_hosiptal_NonActive_data').append(trHTML);
	        // $('#staff_hosiptal_NonActive_data').load(); 
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
    	location.href = rootURL+'/Web/admin/adminindex.php?page=hospital';
    }
}




function showHosiptalData(hosiptalid){
    
    displayErrorResults();
    
    console.log(hosiptalid);
    
    var requesturl = "";
    requesturl = rootURL + '/hospitalDataById/'+hosiptalid;
    
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
                    hospitalDataById =   responseMessageDetails.data[0];  
                    
                    console.log("hospitalDataById :"+hospitalDataById.id);
                    
                    $('#name').val(hospitalDataById.hosiptalname);
                    $('#mobile').val(hospitalDataById.mobile);
                    $('#landline').val(hospitalDataById.landline); 
                    $('#email').val(hospitalDataById.email);
                    $('#address1').val(hospitalDataById.addressline1); 
                    $('#address2').val(hospitalDataById.addressline2);
                    $('#city').val(hospitalDataById.city);
                    $('#district').val(hospitalDataById.district); 
                    $('#state').val(hospitalDataById.state); 
                    $('#hosiptalid').val(hospitalDataById.id);
                    $('#zipcode').val(hospitalDataById.zipcode);
                    $('.myModalLabel').text('Edit Hospital');
                    $('#editHospitalModal').modal('show');
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


