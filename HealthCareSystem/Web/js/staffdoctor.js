/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
//alert("hello");
    displayErrorResults();
     $('#errormessages').hide();
    if($('#hosiptalcount').val() > 0){
        
        $('#adminStaffErrorMessage').html("<b>INFO </b> : Please register hospital's before registering staff");
        $('#adminStaffErrorBlock').show();
    }
    
    $('#registerStaffDoctorUser').click( function(){
    //$( "form" ).submit(function( event ){
         if($('#email').val().length < 1){
                $('#emailerrormsg').html("Please enter email");  
                return false; 
            }
      
            
            var sEmail = $('#email').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
             if (!filter.test(sEmail))  {
                  $("#emailerrormsg").html("Invalid Email Address").show();
                 return false;
           }
              if($('#email').val().length < 1){
                   $('#emailerrormsg').html("Please enter email");  
                   event.preventDefault();
               } 
        
        if(registerFormValidate()){
            if(checkDoctorUserId($('#newuser').val()));
        }    
        
        
        
    });
    
      $('#errorDisplay').html("  ");
        
        
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
              
            $('#name').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });
            $('#mname').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });
            $('#lname').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });
            $('#city').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });
            $('#district').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });
            $('#state').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });
            $('#aadharcard').keyup(function() {
                var $th = $(this);
                $th.val( $th.val().replace(/[^0-9]/g, function(str) {
                    $("#errmsg").html("Characters Only").show().fadeOut("slow");
                    $('#errormessages').show().fadeOut("slow");
                    return ''; } ) );
            });
    
    
});



function checkDoctorUserId(userId){
    
console.log("user Id "+userId);

console.log(rootURL+'/checkUserId/' + userId);
  $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/checkUserId/' + userId,
        dataType: "json",
        success: function(data, textStatus, jqXHR){
 alert("Check userid success"+data.responseMessageDetails);
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
                         $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                         $('#adminStaffErrorBlock').show();
                        
                    }else{
                        
                        
                        registerDoctorNewUser();
                        
                        
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
            alert("Check userid error");
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
    //alert("Hello");
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
    if($('#start').val().length < 1){
         console.log("start");
        $('#starterrormsg').html("Please enter date of birth");
        $('#start').attr('style', 'background-color: #FBFAC9');
        return false; 
    }
     if($('#gender').val().length < 1){
          console.log("gender");
        $('#gendererrormsg').html("Please select gender ");  
        $('#gender').attr('style', 'background-color: #FBFAC9');
        return false;
    }
     if($('#doctorid').val().length < 1){
          console.log("doctor");
        $('#gendererrormsg').html("Please enter doctorid ");  
        $('#doctorid').attr('style', 'background-color: #FBFAC9');
        return false;
    }
     if($('#department').val().length < 1){
          console.log("doctor");
        $('#gendererrormsg').html("Please select deparment ");  
        $('#doctorid').attr('style', 'background-color: #FBFAC9');
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
      $('#aadharcard').val("") ; 
       $('#altmobile').val("") ; 
        $('#landline').val("") ; 
     $('#city').val("") ; 
}




function registerDoctorNewUser(){
    

        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        if($('#address2').val().length < 1)
        {
          addressline2 = " ";
        }else
          addressline2 = $('#address2').val();

         profession = "Doctor"; 
        registerDoctorUser($('#newuser').val(),$('#newuserpassword').val(),$('#email').val(),$('#mobile').val(),profession,$('#address1').val(),$('#name').val(), addressline2, $('#district').val(), $('#state').val(), $('#mname').val(),$('#lname').val(), $('#zipcode').val(), appdate, $('#gender').val(),  $('#aadharcard').val(),  $('#city').val(),  $('#hosiptal').val(),  $('#altmobile').val(),  $('#landline').val(),  $('#doctorid').val(),  $('#department').val(),  $('#age').val(),  $('#cardtype').val()  );


}



function registerDoctorUser(userName,password,email,mobile,profession,address,name,address2,district,state,mname,lname,zipcode,start,gender,aadharcard,city,hosiptal,altmobile,landline,doctorid,department,age,cardtype){
   
    var finalname = $('#name').val()+" "+$('#mname').val()+" "+$('#lname').val();

    var registerDoctorData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"address":address,"name":finalname,"mname":mname,"state":state,"zipcode":zipcode,"district":district,"lname":lname,"gender":gender,"start":start,"aadharcard":aadharcard,"address2":address2,"fname":$('#name').val(),"city":city,"hospital":hosiptal ,"altmobile":altmobile,"landline":landline,"doctorid":doctorid,"department":department,"age":age,"cardtype":cardtype,"insttype":"Hospital" } );
      
    console.log("data "+registerDoctorData);
      alert("Calling junk ajax");  
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/registerAdminUser',
            dataType: "json",
            data:  registerDoctorData,
            success: function(data, textStatus, jqXHR){
                alert("Success");
                var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var message = responseMessageDetails.message;
                   
                  
                    if(message.indexOf("]:") > 0)
                        message = message.substring(0,message.indexOf("]:")+2);
                    
                     console.log("Message : "+message);
                    
                   if(responseMessageDetails.status == "Success"){
                      // uploadFile($('#filepres').val());
                       console.log("In SUccess");
                       $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                        $('#adminStaffErrorBlock').show();
                        return true;
                      // clearFormValues();
                       
                   }else{
                        alert("in Fail");
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
                alert("In Error");
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

function uploadFile(file){
           console.log(file);
            $.get('../../Business/doctorimageupload.php?filename='+file, function(data) {
                alert("Server Returned: " + data);
            });
            return false;
       
   /* var url = rootURL+'/doctorimageupload';
    var xhr = new XMLHttpRequest();
    var fd = new FormData();
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Every thing ok, file uploaded
            console.log(xhr.responseText); // handle response.
        }
    };
    fd.append("upload_file", file);
    xhr.send(fd);
    */
}




