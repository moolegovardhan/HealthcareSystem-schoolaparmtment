/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#login').click(function() {
        authenticateUser($('#username').val(),$('#password').val());
        return false;
    });

                
                 $( "#start" ).datepicker({  maxDate: 0,
                 changeMonth: true,
                 changeYear: true,
                 yearRange:'1900:+0',
                 hideIfNoPrevNext: true,
                 "dateFormat": 'dd.mm.yy',
                 nextText:'<i class="fa fa-angle-right"></i>',
                 prevText:'<i class="fa fa-angle-left"></i>',
                  weekHeader: "W"});
                 
        
});


function forwardtoRegister(){

     window.location = "login.php?page=register";
 } 



function authenticateUser(userName,password) {
    console.log('userName: ' + userName);
    console.log('password: ' + password);
   
    if(userName.length < 1){
        $('#errorlist').html("<font color='red'><b>  Please enter User ID</b></font>");
        return false;
    }
    if(password.length < 1){
        $('#errorlist').html(" <font color='red'><b>  Please enter Password</b></font>");
        return false;
    }
    console.log(rootURL + '/authenticate/' + userName +'/'+password);
	$.ajax({
		type: 'GET',
		url: rootURL + '/authenticate/' + userName +'/'+password,
		dataType: "json",
		success: function(data){
                      var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                      
                      
                        console.log("List : "+list);
                        if((list).length < 1 ){

                             $('#errorlist').html("<font color='red'><b>  Invalid User Name and Password Combination </b></font>");
                             $('#errorblock').css("visibility") == "visible";

                          } 
                          
                       $.each(list, function(index, responseMessageDetails) {
                           console.log("Status   "+responseMessageDetails);
                           var message = responseMessageDetails.message;
                           if(message.indexOf("]:") > 0)
                             message = message.substring(0,message.indexOf("]:")+2);
                           console.log("message"+message);
                           console.log("USer Data"+responseMessageDetails.status);
                           console.log("USer Data"+responseMessageDetails.message);
                           
                           if(responseMessageDetails.status == "Success"){
                               
                               if(message.indexOf("Successfull") > 0){
                                  
                                   var role = responseMessageDetails.data[0].profession;
                                  console.log("Role : "+role);
                                   if((role == "Patient") || (role == "Others")){
                                      $(location).attr('href',rootURL+"/Web/patient/patientindex.php"); 
                                     } else if(role == "Staff"){
                                        $(location).attr('href',rootURL+"/Web/staff/staffindex.php"); 
                                     } else  if(role == "Hosiptal"){
                                        $(location).attr('href',rootURL+"/Web/hosiptal/hosiptalindex.php"); 
                                     } else  if(role == "Doctor"){
                                         //alert('<?php echo  $_SESSION["hospitalcount"]; ?>');
                                        $(location).attr('href',rootURL+"/Web/doctor/doctorindex.php"); 
                                     } else   if(role == "superadmin"){
                                        $(location).attr('href',rootURL+"/Web/admin/adminindex.php"); 
                                     } else  if(role == "callcenter"){
                                        $(location).attr('href',rootURL+"/Web/callcenter/callcenterindex.php"); 
                                     }else if(role == "Lab"){
                                        $(location).attr('href',rootURL+"/Web/lab/labindex.php"); 
                                     } else if(role == "Medical"){
                                        $(location).attr('href',rootURL+"/Web/medical/medicalindex.php"); 
                                     }  else if(role == "School"){
                                        $(location).attr('href',rootURL+"/Web/school/schoolindex.php"); 
                                     }  else if(role == "Industry"){
                                        $(location).attr('href',rootURL+"/Web/industry/industryindex.php"); 
                                     } else if(role == "Apartment"){
                                        $(location).attr('href',rootURL+"/Web/apartment/apartmentindex.php"); 
                                     } else if(role == "Village"){
                                        $(location).attr('href',rootURL+"/Web/village/villageindex.php"); 
                                     } else{
                                         console.log("In Else");
                                          $('#errorlist').html("<font color='red'><b>  Please Contact Admin for activating account  </b></font>");
                                         $('#errorblock').css("visibility") == "visible";
                                     }
                                   
                               }else
                                   $('#errorlist').html("<font color='red'><b>"+message+"</b></font>");
                               
                               
                               
                           }else if(responseMessageDetails.status == "Fail"){
                               $('#errorlist').html("<font color='red'><b>"+message+"</b></font>");
                           }else {
                               $('#errorlist').html("<font color='red'><b> We are sorry some intermittent Issue. Please try after some time. </b></font>");
                           }
                          
                        });
            
		},
        error: function(data){
           var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);
           console.log("data...."+data);
            $.each(list, function(index, responseErrorMessageDetails) {
                 console.log(responseErrorMessageDetails);
                var message = responseErrorMessageDetails.message;
                if(message.indexOf("]:") > 0)
                  message = message.substring(0,message.indexOf("]:")+2);
              
                $('#errorlist').html("<font color='red'><b>"+message+"</b></font>");
            });
            
            
        }
	});
        
   
}
function showLogin(){
     window.location = "login.php";
}