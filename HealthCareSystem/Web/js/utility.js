/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
   
    
    
    
    
});

function onlyCharacters(errorblock,inputtxt){
    
    var letters = /^[A-Za-z]+$/;  
    if(inputtxt.value.match(letters))  
     {  
       return true;  
     }  
     else  
        {  
            $('#'+errorblock).html("Only Characters"); 
            return false;  
        } 
        
}

function numbersonly(errorblock,e){
    var unicode=e.charCode? e.charCode : e.keyCode
    if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57) //if not a number
            return false //disable key press
    }
}



