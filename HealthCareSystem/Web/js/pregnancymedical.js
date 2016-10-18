
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
$('#counter').val(0);

fetchPregnancyMedicalData($('#officeid').val());


$('#submitPregnancyMedicineDataEdit').click( function(){
       month = $('#umonth').val();
    medicinename = $('#umedicinename').val();
    observation = $('#uobservation').val();
    
    id = $('#generalid').val();
   
    datatoJSON = {"id":id,"month":month,"medicinename":medicinename,"observation":observation,"hospitalId":$('#officeid').val(),"status":"Y"};
    console.log(datatoJSON)
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updatePregnancyMasterMedicineData');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updatePregnancyMasterMedicineData',
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
          fetchPregnancyMedicalData($('#officeid').val());
            
        }
    });   
     
 });


$('#addPregnancyMedicalParameters').click( function(){
    month = $('#month').val();
    medicinename = $('#medicinename').val();
    observation = $('#observation').val();
    if(month == "MONTH"){
        alert("Please select Month"); return false;
    }
    if(medicinename == ""){
        alert("Please enter medicine name"); return false;
    }
   
    if(observation.length < 0){
        observation = "nodata";
    }
    
    data = month+"$"+medicinename+"$"+observation;
    
     count = parseInt($('#counter').val())+1;
     
     createPmedicalHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deletePMedicalGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editPMedicalGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + month + '</td><td>' + medicinename + '</td><td>' + observation + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#month').val("");
      $('#medicinename').val("");
      $('#observation').val("");
       $('#pregnancy_medical_info_table').append(trHtml);
       $('#pregnancy_medical_info_table').load();
    
});

});




function createPmedicalHiddenDiv(data,count){
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

function deletePMedicalGeneralData(rowData){
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


function editPMedicalGeneralData(rowData){
   console.log("In edit"+rowData);
   try{
          console.log($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         console.log(" dataToEdit :"+dataToEdit);
         var splitDataToEdit = dataToEdit.split("$");
         console.log(" splitDataToEdit :"+splitDataToEdit);
              console.log(" splitDataToEdit[1] :"+splitDataToEdit[1]);
         
     $('#month').val( splitDataToEdit[0]);
    $('#medicinename').val(splitDataToEdit[1]);
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

function fetchPregnancyMedicalData(s){
    
      
   console.log(rootURL + '/fetchPregnancyMedicineDetails/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchPregnancyMedicineDetails/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#pregnancy_medicine_existing_records_search_result_table tbody").remove();

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
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.medicinename+"#"+userDetails.purpose); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.medicinename + '</td><td>' 
                                           + userDetails.purpose +'</td><td><font color="blue">\n\
     <a href="#" onclick=editPregnancyMedicalInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#pregnancy_medicine_existing_records_search_result_table').append(trHTML);
                           $('#pregnancy_medicine_existing_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});  
        
        
}

function editPregnancyMedicalInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    $('#umonth').val(splitData[1]);
    $('#umedicinename').val(splitData[2]);
    $('#uobservation').val(splitData[3]);
    $('#generalid').val(splitData[0]);
    $('#myParametersModal').modal('show');
}