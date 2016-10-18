/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
    
    $('#counter').val(0);
    $('#addTestToPatient').click( function(){
        
        console.log("List................"+$('#list').val());
        data = $('#list').val();
        testData = data.split("#");
        count = $('#counter').val();
        trHTML = "";
        link = "";
        finaldata = testData[0] +"#"+$('#list :selected').text() +"#"+testData[1];
        createHiddenTextBox(finaldata,count);
        link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
        trHTML = "<tr id="+count+"><td>"+testData[0]+"</td><td>"+$('#list :selected').text()+"</td><td>"+testData[1]+"</td><td>"+link+"</td></tr>";
        $('#patient_lab_test_table').append(trHTML);
         $('#patient_lab_test_table').load();
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

function editData(rowData){
   console.log("In"+rowData);
   try{
         //alert($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         var splitDataToEdit = dataToEdit.split("#");
    //gmedicine+"#"+dmedicine+"#"+nofodays+"#"+mbm+"#"+mam+"#"+abm+"#"+aam+"#"+ebm+"#"+eam;
     $('#gmedicines').val((splitDataToEdit[0] == "nogmedicine" ? "" : splitDataToEdit[0]));
    $('#dmedicines').val((splitDataToEdit[1] == "nodmedicine" ? "" : splitDataToEdit[1]));
    $('#noofdays').val(splitDataToEdit[2]);
     $('#usage').val(splitDataToEdit[10]);
    $('#omedicines').val(splitDataToEdit[9]); 
    $('#mbm1').prop("checked",(splitDataToEdit[3] == 1 ? true : false));
     $('#mam1').prop("checked",(splitDataToEdit[4] == 1 ? true : false));
      $('#abm1').prop("checked",(splitDataToEdit[5] == 1 ? true : false));
       $('#aam1').prop("checked",(splitDataToEdit[6] == 1 ? true : false));
        $('#ebm1').prop("checked",(splitDataToEdit[7] == 1 ? true : false));
      $('#aam1').prop("checked",(splitDataToEdit[8] == 1 ? true : false));    
    $("#TextBoxDiv" + rowData).remove();
      row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function createHiddenTextBox(data,count){
    
    console.log("in create div");
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html( '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#labtabledata");

				
	$('#counter').val(parseInt(count)+parseInt(1));
    
}

function createLabsTest(userid){
    console.log("userid............"+userid);
      $('#testforpatient').val(userid);
    $('#showTestDiagnostics').modal('show');//createLabsTest
  
    
}