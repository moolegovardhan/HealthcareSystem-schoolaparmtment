/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    
 $("#zipcode").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
       //display error message
       $("#errmsg").html("Digits Only").show().fadeOut("slow");
        $('#errormessages').show().fadeOut("slow");
              return false;
   }
  }); 


$('#doctor').bind('keypress', function (e) {
    
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
 
 $('#address').bind('keypress', function (e) {
    
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
 
 
    
});
 

