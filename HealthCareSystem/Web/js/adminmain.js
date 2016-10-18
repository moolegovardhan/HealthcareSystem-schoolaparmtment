/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
//alert("hello");
    $('#adminErrorBlock').hide();
    $('#adminStaffErrorBlock').hide();
    if($('#hosiptalcount').val() > 0){
        
        $('#adminErrorMessage').html("<b>INFO </b> : Please register hospital's before registering staff");
        $('#adminErrorBlock').show();
    }
    
    $('#registerAdminUser').click( function(){
         if($('#email').val().length < 1){
                $('#emailerrormsg').html("Please enter email");  
                return false; 
            }
        $('#errorDisplay').html("  ");
            
            var sEmail = $('#email').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
             if (!filter.test(sEmail))  {
                  $("#emailerrormsg").html("Invalid Email Address").show();
                 return false;
           }
       
            $("#mobile").keypress(function (e) {
                   if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                      //display error message
                      $("#errmsg").html("Digits Only").show().fadeOut("slow");
                             return false;
                  }
              });
           $("#zipcode").keypress(function (e) {
               if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                  //display error message
                  $("#errmsg").html("Digits Only").show().fadeOut("slow");
                         return false;
              }
             });
       
        
        
        
        if(registerFormValidate())
            checkUserId($('#newuser').val());
        
    });
    
    //Added by achyuth for getting the checked doctors count
    $('.doctorCheckbox').click(function(){
    	var doctorsCheckedCount = $('.doctorCheckbox:checked').length;
    	//alert(doctorsCheckedCount);
    	$('#doctorsCheckedCount').val(doctorsCheckedCount);
    });

  
$('#addsystemDiscount').click( function(){
     $('#systemDiscountModal').modal('show');
});

$('#submitSystemDiscount').click( function(){
    
    var startdate = ($('#start').val()).split(".");
    var enddate = ($('#finish').val()).split(".");
    var start = startdate[2]+"-"+startdate[1]+"-"+startdate[0];
    var end = enddate[2]+"-"+enddate[1]+"-"+enddate[0];
    
    lab = ($("#lab").is(':checked') == true) ? 'true' : 'false';
    medical = ($("#medical").is(':checked')  == true) ? 'true' : 'false';
    hospital = ($("#hospital").is(':checked')  == true) ? 'true' : 'false';
    mobile = ($("#mobile").is(':checked')  == true) ? 'true' : 'false';
    
      console.log($("#lab").is(':checked'));
    console.log($("#medical").is(':checked'));
    console.log($("#hospital").is(':checked'));
    console.log($("#mobile").is(':checked'));
    
    console.log(lab);
    console.log(medical);
    console.log(hospital);
    console.log(mobile);
    
    
       var registerData = JSON.stringify( {"discountname" : $('#pdiscountname').val(),"percent" : $('#ppercent').val(),"start" : start,
           "end" : end,"lab" : lab,
           "medical":medical,"hospital":hospital,"mobile":mobile} );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/insertNewSystemDiscount',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                $('#systemDiscountModal').modal('hide');
            }
        });
        
});


$('#updateSystemDiscount').click( function(){
    
    if((($('#start').val()).indexOf(".")) > 0){
         var startdate = ($('#start').val()).split(".");
          var start = startdate[2]+"-"+startdate[1]+"-"+startdate[0];
    }else{
        var start = $('#start').val();
    }
   if((($('#finish').val()).indexOf(".")) > 0){
        var enddate = $('#finish').val().split(".");
         var end = enddate[2]+"-"+enddate[1]+"-"+enddate[0];
   }else{
    var end = ($('#finish').val());
   }
   
    
    lab = ($("#lab").is(':checked') == true) ? 'true' : 'false';
    medical = ($("#medical").is(':checked')  == true) ? 'true' : 'false';
    hospital = ($("#hospital").is(':checked')  == true) ? 'true' : 'false';
    mobile = ($("#mobile").is(':checked')  == true) ? 'true' : 'false';
    
      console.log($("#lab").is(':checked'));
    console.log($("#medical").is(':checked'));
    console.log($("#hospital").is(':checked'));
    console.log($("#mobile").is(':checked'));
    
    console.log(lab);
    console.log(medical);
    console.log(hospital);
    console.log(mobile);
       var registerData = JSON.stringify( {"discountname" : $('#pdiscountname').val(),"percent" : $('#ppercent').val(),"start" : start,
           "end" : end,"lab" : lab,
           "medical":medical,"hospital":hospital,"mobile":mobile,"pid":$('#pid').val()} );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL+'/updateSystemDiscounts',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                $('#systemDiscountModal').modal('hide');
            }
        });
        
});

    $('#addVoucherToList').click( function(){
       
       if($('#vname').val() == ""){
           
           alert("Please enter voucher name");
           return false;
       }
        if($('#vname').val() == ""){
           
           alert("Please enter voucher name");
           return false;
       }
        if($('#vname').val() == ""){
           
           alert("Please enter voucher name");
           return false;
       }
        if($('#vouchertype').val() == ""){
           
           alert("Please select voucher type");
           return false;
       }
        if($('#percent').val() == "" && $('#vouchertype').val() == "Percent"){
           
           alert("Please enter voucher percent");
           return false;
       }
        if($('#vcount').val() == ""){
           
           alert("Please enter voucher count");
           return false;
       }
        if($('#start').val() == ""){
           
           alert("Please enter start date");
           return false;
       }
        if($('#finish').val() == ""){
           
           alert("Please enter end date");
           return false;
       }
       console.log($('#cardtype').val());
        console.log($('#vname').val());
        console.log($('#vouchertype').val());
        console.log($('#percent').val());
        console.log($('#vcount').val());
        console.log($('#start').val());
        console.log($('#finish').val());
        console.log($('#lab').is(":checked"));
        console.log($('#medical').is(":checked"));
        console.log($('#mmobile').is(":checked"));
        console.log($('#hospital').is(":checked"));
        
        count = $('#counter').val();
        trHTML = "";
        link = "";
        if($('#percent').val() == "" || $('#percent').val() == null){
            
            $('#percent').val(0);
        }
        lab = $('#lab').is(':checked');
        medical = $('#medical').is(':checked');
        mobile = $('#mmobile').is(':checked');
        hospital = $('#hospital').is(':checked');
        cashvoucher = $('#cashvoucher').is(':checked');
        finaldata = $('#vname').val()+"#"+$('#vouchertype').val() +"#"+$('#percent').val() +"#"+$('#vcount').val()
                 +"#"+$('#start').val() +"#"+$('#finish').val() +"#"+$('#cardtype').val()+"#"+lab
          +"#"+ medical+"#"+mobile +"#"+hospital+"#"+$('#price').val()+"#"+$("#cardtype option:selected").text()+"#"+'NA'+"#"+cashvoucher;
  link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
   trHTML = "<tr id="+count+"><td>"+$('#vname').val()+"</td><td>"+$('#price').val()+"</td><td>"+$('#percent').val()+"</td><td>"+$('#vcount').val()+"</td>\n\
<td>"+$('#start').val()+"</td><td>"+$('#finish').val()+"</td><td>"+$("#cardtype option:selected").text()+"</td><td>"+lab+"</td>\n\
<td>"+medical+"</td><td>"+hospital+"</td><td>"+mobile+"</td><td>"+cashvoucher+"</td><td>"+link+"</td></tr>";
       
       //
       $('#voucher_details_table').append(trHTML);
         $('#voucher_details_table').load();
         
        createVoucherHiddenTextBox(finaldata,count);
    });

});

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

function createHiddenTextBox(data,count){
    
    console.log("in create div"+$('#counter').val());
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html( '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#labtabledata");

				
	$('#counter').val(parseInt(count)+parseInt(1));
    
}

function checkUserId(userId){
    
console.log("user Id "+userId);

console.log(rootURL+'/checkUserId/' + userId);
  $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/checkUserId/' + userId,
        dataType: "json",
        success: function(data, textStatus, jqXHR){

            var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);

            console.log("In check User Id"+(list).length);
            console.log("lsit : "+list);
            
            $.each(list, function(index, responseMessageDetails) {
                var message = responseMessageDetails.message;
               if(message.indexOf("]:") > 0)
                  message = message.substring(0,message.indexOf("]:")+2);
              
              console.log(message);
              
                if(responseMessageDetails.status == "Success"){
                    console.log("Data length : "+responseMessageDetails.data.length);
                     
                    if(message.indexOf("Exists") > 0){
                        console.log("User Exists count");
                         $('#adminErrorMessage').html("<b>Error : </b>"+message);
                         $('#adminErrorBlock').show();
                        
                    }else{
                        
                        
                        registerNewUser();
                        
                        
                    }
                    
                }else if(responseMessageDetails.status == "Fail"){
                    $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                    $('#adminStaffErrorBlock').show();
                }else {
                     $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                     $('#adminStaffErrorBlock').show();
                }
                
                
            });
          
        },
        error: function(data){
               var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });
        }
    });

    
}



function registerFormValidate(){
    
    clearValidationMessage();
    if($('#newuser').val().length < 1){
        $('#useriderrmsg').html("Please enter user id"); 
        return false;
    }
     if($('#newuserpassword').val().length < 1){
        $('#passworderrormsg').html("Please enter password"); 
        return false;  
    }
     if($('#name').val().length < 1){
        $('#nameerrormsg').html("Please enter first name"); 
        return false;
    }
     if($('#mname').val().length < 1){
        $('#mnameerrormsg').html("Please enter mname"); 
        return false;  
    }
     if($('#lname').val().length < 1){
        $('#lnamerrormsg').html("Please enter last name"); 
        return false;  
    }
    
     if($('#mobile').val().length < 1){
        $('#mobileerrormsg').html("Please enter mobile #");  
        return false;
    }
     if($('#address1').val().length < 1){
        $('#address1errormsg').html("Please enter address line 1");  
        return false; 
    }
     if($('#district').val().length < 1){
        $('#districterrormsg').html("Please enter district");
        return false;  
    }
     if($('#state').val().length < 1){
        $('#stateerrormsg').html("Please enter state");  
        return false; 
    }
     if($('#zipcode').val().length < 1){
        $('#zipcodeerrormsg').html("Please enter zipcode"); 
        return false;  
    }
     if($('#start').val().length < 1){
        $('#starterrormsg').html("Please enter date of birth");
        return false; 
    }
     if($('#gender').val().length < 1){
        $('#gendererrormsg').html("Please select gender ");   
        return false;
    }
    if($('#hosiptal').val() == "HOSPITAL"){
        $('#proferrormsg').html("Please Select Hsopital ") ; 
        return false;
    }
    if($('#aadharcard').val().length < 1){
        $('#aadharerrormsg').html("Please enter aadhar card ") ; 
        return false;
    }
     if($('#city').val().length < 1){
        $('#cityerrormsg').html("Please enter aadhar card ") ; 
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
}

function clearFormValues(){
    $('#name').val("");
     $('#mname').val("");  
    $('#lname').val(""); 
     $('#email').val("");   
     $('#newuserpassword').val("");
    $('#newuser').val("");
     $('#mobile').val("");  
    $('#address1').val("");
     $('#address2').val("");
     $('#district').val("");
      $('#state').val("");   
     $('#zipcode').val("");
       $('#start').val(""); 
     $('#gender').val("");  
    $('#profession').val("") ; 
      $('#aadharcard').val("") ; 
     $('#city').val("") ; 
}




function registerNewUser(){
    

        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        if($('#address2').val().length < 1)
        {
          addressline2 = " ";
        }else
          addressline2 = $('#address2').val();

         profession = "Staff"; 
        registerUser($('#newuser').val(),$('#newuserpassword').val(),$('#email').val(),$('#mobile').val(),profession,$('#address1').val(),$('#name').val(), addressline2, $('#district').val(), $('#state').val(), $('#mname').val(),$('#lname').val(), $('#zipcode').val(), appdate, $('#gender').val(),  $('#aadharcard').val(),  $('#city').val(),  $('#hosiptal').val(),  $('#altmobile').val(),  $('#landline').val(),  $('#age').val(),  $('#cardtype').val()    );


}



function registerUser(userName,password,email,mobile,profession,address,name,address2,district,state,mname,lname,zipcode,start,gender,aadharcard,city,hosiptal,altmobile,landline,age,cardtype){
   
    var finalname = $('#name').val()+" "+$('#mname').val()+" "+$('#lname').val();

    var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"address":address,"name":finalname,"mname":mname,"state":state,"zipcode":zipcode,"district":district,"lname":lname,"gender":gender,"start":start,"aadharcard":aadharcard,"address2":address2,"fname":$('#name').val(),"city":city,"hospital":hosiptal,"altmobile":altmobile,"landline":landline,"age":age,"cardtype":cardtype } );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/registerAdminUser',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var message = responseMessageDetails.message;
                   
                  
                    if(message.indexOf("]:") > 0)
                        message = message.substring(0,message.indexOf("]:")+2);
                    
                     console.log("Message : "+message);
                    
                   if(responseMessageDetails.status == "Success"){
                       console.log("In SUccess");
                       $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                        $('#adminStaffErrorBlock').show();
                       clearFormValues();
                   }else{
                       console.log("In fail");
                       if(message.indexOf("Exists") > 0){
                           $('#adminStaffErrorMessage').html("<b>Error : User Id exists</b>");
                             $('#adminStaffErrorBlock').show(); 
                       }else{
                           $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                             $('#adminStaffErrorBlock').show();
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

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });

            }
        });

}


function displayErrorResults(){
         $('#adminHospitalErrorBlock').hide();
         $('#adminStaffErrorBlock').hide();
         $('#adminErrorBlock').hide();
         $('#adminErrorMessage').html("");  
          $('#adminStaffErrorMessage').html("");  
}



function requestText(requestId){
    console.log(rootURL+'/fetchRequestText/' + requestId);
    $.ajax({
                type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchRequestText/' + requestId,
        dataType: "json",
        success: function(data){
            
               var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var message = responseMessageDetails.message;
                   $('#requestMessage').html(responseMessageDetails.data[0].Text);
                   //console.log("message "+);
               });
            
        $('#myModal').modal('show');
                     
        },
        error: function(data){
       var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails :    [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });
        }
        
    });
}


function displayErrorResults(){
         $('#adminHospitalErrorBlock').hide();
         $('#adminStaffErrorBlock').hide();
         $('#adminErrorBlock').hide();
         $('#adminErrorMessage').html("");  
          $('#adminStaffErrorMessage').html("");  
}

function editSystemDiscountDetails(obj1,obj2,obj3,obj4,obj5,obj6,obj7,obj8,obj9){
    console.log((obj3 == true));
    console.log((obj4 == true));
    $('#pdiscountname').val(obj1);
    $('#ppercent').val(obj2);
    console.log(obj3);
    
    if(obj3 == true)
        $('#lab').prop('checked', true);
    if(obj4 == true)
        $('#medical').prop('checked', true);
    if(obj5 == true)
        $('#hospital').prop('checked', true);
    if(obj6 == true)
        $('#mobile').prop('checked', true);
    $('#start').val(obj7);
    $('#finish').val(obj8);
    $('#pid').val(obj9);
    $('#updateSystemDiscount').show();
    $('#submitSystemDiscount').hide();
     $('#systemDiscountModal').modal('show');
}

function addsystemDiscount(){
     $('#updateSystemDiscount').hide();
    $('#submitSystemDiscount').show();
    $('#pdiscountname').val("");
    $('#ppercent').val("");
    $('#start').val("");
    $('#finish').val("");
    $('#pid').val("");
     $('#lab').prop('checked', false);
      $('#medical').prop('checked', false);
       $('#hospital').prop('checked', false);
        $('#mobile').prop('checked', false);
     $('#systemDiscountModal').modal('show');
}



//$app->post('/','insertNewSystemDiscount');
//$app->put('/','updateSystemDiscounts');