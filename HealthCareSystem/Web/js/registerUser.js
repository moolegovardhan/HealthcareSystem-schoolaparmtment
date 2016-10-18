/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){

    $('#errorRBlock').hide();
     $('#doctoriddiv').hide();
      $('#doctoriddeptdiv').hide();
     $('#errormessages').hide();
      $('#cpassworderrormessages').hide();
     
      $('#errorDisplay').html("  ");
     clearValidationMessage();
   $('#registerNewUser').click(function() {
        $('#errorDisplay').html("  ");
            
       /*     var sEmail = $('#email').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
             if (!filter.test(sEmail))  {
                   $("#emailerrormsg").html("Please enter email address or invalid email address").show();
                    $('#errormessages').show();
                 return false;
           }
       */
           
       
       
        if(registerFormValidate()){
         console.log("In if condition validation success ");
         clearValidationMessage()
         checkUserId($('#newuser').val());
        }else{
            console.log("In else ");
            $('#errormessages').show();
        } 
     
        var flag = "";
       
    });
    
     $('#quickregister').click(function() {
        $('#errorDisplay').html("  ");
            
            var sEmail = $('#email').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
           if(sEmail.length > 1)  {
             if (!filter.test(sEmail))  {
                   $("#emailerrormsg").html("Please enter email address or invalid email address").show();
                   // $('#errormessages').show();
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
   
    $( "#profession" ).change(function() {
        
        if($('#profession').val() != null && $('#profession').val() != "Doctor"){
            $('#doctoriddiv').hide();
            $('#doctoriddeptdiv').hide();
        
    }else{
             $('#doctoriddiv').show();
             $('#doctoriddeptdiv').show();
         }      
      });
     $("#age").keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       //display error message
                       $("#errmsg").html("Digits Only").show().fadeOut("slow");
                        $('#errormessages').show().fadeOut("slow");
                              return false;
                   }
               });
    
               $("#mobile").keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       //display error message
                       $("#errmsg").html("Digits Only").show().fadeOut("slow");
                        $('#errormessages').show().fadeOut("slow");
                              return false;
                   }
               });
               $("#mobile").keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       //display error message
                       $("#errmsg").html("Digits Only").show().fadeOut("slow");
                        $('#errormessages').show().fadeOut("slow");
                              return false;
                   }
               });
               $("#altmobile").keypress(function (e) {
                 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       //display error message
                       $("#errmsg").html("Digits Only").show().fadeOut("slow");
                        $('#errormessages').show().fadeOut("slow");
                              return false;
                   }
               });
            $("#landline").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                          return false;
               }
              });
             $("#zipcode").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   //display error message
                   $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                          return false;
               }
              }); 
              //
             $('#doctorrepid').bind('keypress', function (e) {
                   
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
            $('#mname').bind('keypress', function (e) {
                 
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
            $('#lname').bind('keypress', function (e) {
               
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
          $('#city').bind('keypress', function (e) {
               
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
                 $('#district').bind('keypress', function (e) {
                        
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
           $('#state').bind('keypress', function (e) {
               
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
            $('#aadharcard').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^0-9]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });

            $('#changePassword').click( function(){
                
                if($('#cuserid').val().length  < 5){
                    $('#changePasswordErrorDisplay').html("<font color='red'><b> Please enter userid</b></font>");
                    $('#cpassworderrormessages').show();
                    return false;
                }
                if($('#cpassword').val().length  < 5){
                    $('#changePasswordErrorDisplay').html("<font color='red'><b> Please enter password</b></font>");
                    $('#cpassworderrormessages').show();
                     return false;
                }
                if($('#confirmpassword').val().length  < 5){
                    $('#changePasswordErrorDisplay').html("<font color='red'><b> Please enter confirm password</b></font>");
                    $('#cpassworderrormessages').show();
                     return false;
                }
                if($('#cmobile').val().length  < 5){
                    $('#changePasswordErrorDisplay').html("<font color='red'><b> Please enter Mobile #</b></font>");
                    $('#cpassworderrormessages').show();
                     return false;
                }
                console.log("onfirmpassword : "+$('#confirmpassword').val());
                console.log("cpassword : "+$('#cpassword').val());
                console.log("validation : "+($('#confirmpassword').val() != $('#cpassword').val()));
                if($('#confirmpassword').val() != $('#cpassword').val()){
                     $('#changePasswordErrorDisplay').html("<font color='red'><b> Confirm password mismatch. Please re enter password and confirm password combination.</b></font>");
                     $('#cpassworderrormessages').show();
                      return false;
                    }
                
                changePassword($('#cuserid').val(),$('#cmobile').val(),$('#cpassword').val());
                
            });


});

function changePassword(userid,mobile,password){
     var registerData = JSON.stringify( {"userid" : userid,"password" : password,"mobile" : mobile} );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/changePassword',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                console.log(list);
            
               $.each(list, function(index, responseMessageDetails) {
                   var message = responseMessageDetails.message;
                   
                  console.log("Message : "+message);
                    
                   if(responseMessageDetails.status == "Success"){
                       console.log("In SUccess"+responseMessageDetails.message);
                       $('#changePasswordErrorDisplay').html(responseMessageDetails.message);
                       $('#cpassworderrormessages').show();
                        var mobileNumber = mobile;
                    	var message = responseMessageDetails.comments;
                    	var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+mobileNumber+"&text="+message+"&priority=ndnd&stype=normal";
                         clearFormValues();               
                    	$.post(url, function(data){
                    		//Need to show some message if we get response from the SMS api.
                    		//Currently we are just sending Message after Signup
                    	});
                    	
                   }else{
                       console.log("In fail");
                        $('#changePasswordErrorDisplay').html("<font color='red'><b> "+message+"</b></font>");
                             $('#cpassworderrormessages').show();
                        
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

function checkUserId(userId){
    
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
                        
                        
                        registerNewUser();
                        
                        
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
                 $('#errormessages').show();
             });
        }
    });

    
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




function registerNewUser(){
    

        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        if($('#address2').val().length < 1)
        {
          addressline2 = " ";
        }else
          addressline2 = $('#address2').val();

        registerUser($('#newuser').val(),$('#newuserpassword').val(),$('#email').val(),$('#mobile').val(),$('#profession').val(),$('#address1').val(),$('#name').val(), addressline2, $('#district').val(), $('#state').val(), $('#mname').val(),$('#lname').val(), $('#zipcode').val(), appdate, $('#gender').val(),  $('#aadharcard').val(),  $('#city').val(),  $('#altmobile').val(),  $('#landline').val(),$('#doctorrepid').val(),  $('#policyid').val(),$('#policytype').val(),$('#department').val(),$('#age').val());


}


function registerQuickNewUser(){
    

        
        registerQuickUser($('#mobile').val(),$('#qpassword').val(),$('#email').val(),$('#mobile').val(),'Others',$('#name').val());


}


function registerQuickUser(userName,password,email,mobile,profession,name){
   
    var registerDataQuick = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"name":name,"insttype":$('#fromrequest').val() } );
        
    console.log("data "+registerDataQuick);
    console.log("FROM REQUEST "+$('#fromrequest').val() );
       
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/quickRegister',
            dataType: "json",
            data:  registerDataQuick,
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
                       $('#quickRegisterDisplay').html(responseMessageDetails.message);
                       $('#quickregistermessages').show();
                        $('#quickregistermessages').show();
                        var mobileNumber = mobile;
                    	//var message = responseMessageDetails.message;
                    	var message = responseMessageDetails.comments;
                    	var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+mobileNumber+"&text="+message+"&priority=ndnd&stype=normal";

                    	$.post(url, function(data){
                    		//Need to show some message if we get response from the SMS api.
                    		//Currently we are just sending Message after Signup
                                $('#errorlist').html('Registration Successfull. Please use your mobile number are userid');
                    	});
                    	
                       clearFormValues();
                   }else{
                       console.log("In fail");
                       if(message.indexOf("Exists") > 0){
                            
                           $('#errorDisplay').html("User Id already exists");
                            $('#errormessages').show();
                        $('#errorRBlock').show();
                       }else{
                           
                           $('#errorDisplay').html(responseMessageDetails.message);
                            $('#errormessages').show();
                        $('#errorRBlock').show();
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


function registerUser(userName,password,email,mobile,profession,address,name,address2,district,state,mname,lname,zipcode,start,gender,aadharcard,city,altmobile,landline,doctorid,policyid,policytype,department,age){
   
    var finalname = $('#name').val()+" "+$('#mname').val()+" "+$('#lname').val();

    var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"address":address,"name":finalname,"mname":mname,"state":state,"zipcode":zipcode,"district":district,"lname":lname,"gender":gender,"start":start,"aadharcard":aadharcard,"address2":address2,"fname":$('#name').val(),"city":city,"altmobile":altmobile,"landline":landline,"doctorid":doctorid,"policyid":policyid,"policytye":policytype,"department":department,"age":age,"insttype":"Web" } );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/registerUser',
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
                        $('#errorRBlock').show();
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
                        $('#errorRBlock').show();
                       }else{
                           
                           $('#errorDisplay').html(responseMessageDetails.message);
                            $('#errormessages').show();
                        $('#errorRBlock').show();
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


function registerFormValidate(){
    console.log("validation");
    clearValidationMessage();
    if($('#newuser').val() == ""){
        console.log("new user");
        $('#useriderrmsg').html("Please enter user id"); 
        $('#newuser').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    if($('#newuser').val().length < 5){
         console.log("new user less then 5");
        $('#useriderrmsg').html("User Name Minimum length is 5"); 
        $('#newuser').attr('style', 'background-color: #FBFAC9');
        return false;
    }
     if($('#newuserpassword').val() == ""){
          console.log("password");
        $('#passworderrormsg').html("Please enter password"); 
         $('#newuserpassword').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
    if($('#newuserpassword').val().length < 5){
         console.log("pass les then 5");
        $('#passworderrormsg').html("Password Minimum length is 5"); 
         $('#newuserpassword').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
   // alert("Hello");
     if($('#name').val().length < 1){
         console.log("name");
        $('#nameerrormsg').html("Please enter first name"); 
        $('#name').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    /* if($('#mname').val().length < 1){
        $('#mnameerrormsg').html("Please enter mname"); 
        return false;  
    }*/
     if($('#lname').val().length < 1){
          console.log("lname");
        $('#lnamerrormsg').html("Please enter last name"); 
        $('#lname').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
  /*   if($('#email').val().length < 1){
          console.log("email");
        $('#emailerrormsg').html("Please enter email");  
        $('#email').attr('style', 'background-color: #FBFAC9');
        return false; 
    }*/
     if($('#mobile').val().length < 1){
          console.log("mobile");
        $('#mobileerrormsg').html("Please enter mobile #"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
   
     if($('#gender').val().length < 1){
          console.log("gender");
        $('#gendererrormsg').html("Please select gender ");  
        $('#gender').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    if($('#profession').val().length < 1){
         console.log("profession");
        $('#proferrormsg').html("Please Select Profession ") ; 
        $('#profession').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    if($('#profession').val() == "Doctor"){
         console.log("professio doctor");
        if($('#doctorrepid').val().length < 1){
            $('#doctoriderrmsg').html("Please Enter Doctor ID ") ; 
            $('#doctorrepid').attr('style', 'background-color: #FBFAC9');
            return false;
        }
        if($('#department').val().length < 1){
            $('#doctoriderrmsg').html("Please Select Department ") ; 
            $('#department').attr('style', 'background-color: #FBFAC9');
            return false;
        }
    }
     if($('#address1').val().length < 1){
        $('#address1errormsg').html("Please enter address line 1");  
         $('#address1').attr('style', 'background-color: #FBFAC9');
        return false; 
    }
     if($('#district').val().length < 1){   
        $('#districterrormsg').html("Please enter district");
          $('#district').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
     if($('#state').val().length < 1){
        $('#stateerrormsg').html("Please enter state");  
          $('#state').attr('style', 'background-color: #FBFAC9');
        return false; 
    }
     if($('#zipcode').val().length < 1){
        $('#zipcodeerrormsg').html("Please enter zipcode");
          $('#zipcode').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
    
   /* if($('#aadharcard').val().length < 1){
        $('#aadharerrormsg').html("Please enter aadhar card ") ; 
          $('#aadharcard').attr('style', 'background-color: #FBFAC9');
        return false;
    } */
     if($('#city').val().length < 1){
        $('#cityerrormsg').html("Please enter aadhar card ") ; 
          $('#city').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    
   return true;
}


function registerQuickFormValidate(){
    console.log("validation");
    clearValidationMessage();
    if($('#mobile').val() == ""){
        console.log("new user");
        $('#errorlist').html("Please enter Mobile Number"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
    if($('#mobile').val().length < 10){
         console.log("new user less then 10");
        $('#errorlist').html("Mobile Number Minimum length is 10"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
        return false;
    }
     if($('#qpassword').val() == ""){
          console.log("password");
        $('#errorlist').html("Please enter password"); 
         $('#qpassword').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
    if($('#qpassword').val().length < 5){
         console.log("pass les then 5");
        $('#errorlist').html("Password Minimum length is 5"); 
         $('#qpassword').attr('style', 'background-color: #FBFAC9');
        return false;  
    }
   // alert("Hello");
     if($('#name').val().length < 1){
         console.log("name");
        $('#errorlist').html("Please enter name"); 
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
        $('#errorlist').html("Please enter mobile #"); 
        $('#mobile').attr('style', 'background-color: #FBFAC9');
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

function clearFormValues(){
    $('#cmobile').val("");
    $('#cpassword').val("");
    $('#cuserid').val("");
    $('#confirmpassword').val("");
    
    $('#name').val("");
     $('#mname').val("");  
    $('#lname').val(""); 
     $('#email').val("");   
     $('#newuserpassword').val("");
     $('#password').val("");
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
     $('#altmobile').val("") ; 
     $('#landline').val("") ; 
      $('#doctorid').val("") ; 
        $('#policyid').val("") ; 
          $('#policytype').val("") ; 
}

