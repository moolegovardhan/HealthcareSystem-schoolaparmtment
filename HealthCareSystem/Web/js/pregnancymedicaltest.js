
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
$('#counter').val(0);

fetchPregnancyTestData($('#officeid').val());


$('#addPregnancyMedicalTestParameters').click( function(){
    month = $('#month').val();
    testname = $('#testname').val();
    observation = $('#observation').val();
    if(month == "MONTH"){
        alert("Please select Month"); return false;
    }
    if(testname == ""){
        alert("Please enter test name"); return false;
    }
   
    if(observation.length < 0){
        observation = "nodata";
    }
    
    data = month+"$"+testname+"$"+observation;
    
     count = parseInt($('#counter').val())+1;
     
     createTmedicalHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteTMedicalGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editTMedicalGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + month + '</td><td>' + testname + '</td><td>' + observation + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#month').val("");
      $('#testname').val("");
      $('#observation').val("");
       $('#pregnancy_test_info_table').append(trHtml);
       $('#pregnancy_test_info_table').load();
    
});



$('#submitPregnancyTestDataEdit').click( function(){
       month = $('#tmonth').val();
    testname = $('#ttestname').val();
    observation = $('#tobservation').val();
    
    id = $('#generalid').val();
   
    datatoJSON = {"id":id,"month":month,"testname":testname,"description":observation,"hospitalId":$('#officeid').val(),"status":"Y"};
    console.log(datatoJSON)
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updateTestInMasterData');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updateTestInMasterData',
        dataType: "json",
        data:  datatoEdit,
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            console.log("Data List Length "+list.length);
            $.each(list, function(index, responseMessageDetails) {
                 if(responseMessageDetails.status == "Success"){
                     alert("Data Updated Successfully");
                     enterDetails($('#patientid').val());
                 }
            });
          fetchPregnancyTestData($('#officeid').val());
            
        }
    });   
     
 });


});




function createTmedicalHiddenDiv(data,count){
      console.log("in create div");
        var newTextBoxDiv = $(document.createElement('div'))
                 .attr("id", 'newTextBoxDiv' + count);

       console.log(" newTextBoxDiv : "+newTextBoxDiv);

            newTextBoxDiv.after().html('<label>Textbox #'+ count + ' : </label>' +
                            '<input type="text" name="textbox' + count + 
                  '" id="textbox' + count + '" value="'+data+'" >');

            newTextBoxDiv.appendTo("#generaldiv");


            $('#counter').val(count);
}

function deleteTMedicalGeneralData(rowData){
   console.log("In Delete"+rowData);
   try{
        row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
        
          $("#newTextBoxDiv" + rowData).remove();
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function editTMedicalGeneralData(rowData){
   console.log("In edit"+rowData);
   try{
          console.log($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         console.log(" dataToEdit :"+dataToEdit);
         var splitDataToEdit = dataToEdit.split("$");
         console.log(" splitDataToEdit :"+splitDataToEdit);
              console.log(" splitDataToEdit[1] :"+splitDataToEdit[1]);
         
     $('#month').val( splitDataToEdit[0]);
    $('#testname').val(splitDataToEdit[1]);
    $('#observation').val((splitDataToEdit[2] == "nodata" ? "" : splitDataToEdit[2])); 
    
    $("#newTextBoxDiv" + rowData).remove();
      row = document.getElementById(rowData) ;
      console.log("row :"+row);
      (row).parentNode.removeChild(row);
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function fetchPregnancyTestData(s){
    
    
      
   console.log(rootURL + '/fetchPregnancyTests/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchPregnancyTests/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#pregnancy_test_records_search_result_table tbody").remove();

                console.log("Data List Length "+list.length);

                $.each(list, function(index, responseMessageDetails) {

                     if(responseMessageDetails.status == "Success"){
                       
                          userData = responseMessageDetails.data;

                          console.log("userData : "+userData.length);
                          var trHTML = "";
                          $.each(userData, function(index, userDetails) {
                              s = userDetails.id;
                              s = userDetails.id;
                                s = s.replace(/^0+/, '');
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.testname+"#"+userDetails.description); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.testname + '</td><td>' 
                                           + userDetails.description +'</td><td><font color="blue">\n\
     <a href="#" onclick=editPregnancyTestInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#pregnancy_test_records_search_result_table').append(trHTML);
                           $('#pregnancy_test_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});  
     
}


function editPregnancyTestInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    console.log("asasdasd......"+splitData[1]);
    console.log("asasdasd......"+splitData[0]);
    console.log("asasdasd......"+splitData[2]);
    console.log("asasdasd......"+splitData[3]);
    $('#tmonth').val(splitData[1]);
    $('#ttestname').val(splitData[2]);
    $('#tobservation').val(splitData[3]);
    $('#generalid').val(splitData[0]);
    $('#myParametersModal').modal('show');
}