
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
$('#counter').val(0);

$('#submitChildMedicineDataEdit').click( function(){
       month = $('#umonth').val();
    medicinename = $('#umedicinename').val();
    id = $('#generalid').val();
    observation = $('#uobservations').val();
    console.log();//
    datatoJSON = {"id":id,"month":month,"medicinename":medicinename,"observations":observation,"hospitalId":$('#officeid').val(),"status":"Y"};
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updateChildMedicines');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updateChildMedicines',
        dataType: "json",
        data:  datatoEdit,
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            console.log("Data List Length "+list.length);
            $.each(list, function(index, responseMessageDetails) {
                 if(responseMessageDetails.status == "Success"){
                     alert("Data Updated Successfully");
                    // enterDetails($('#patientid').val());
                 }
            });

            fetchChildMedicineInfo($('#officeid').val());  
            
        }
    });   
     
 });

fetchChildMedicineInfo($('#officeid').val());

$('#addChildMedicineParameters').click( function(){
    month = $('#month').val();
    medicinename = $('#medicinename').val();
    observation = $('#observation').val();
    if(month == "MONTH"){
        alert("Please select Month"); return false;
    }
    if(medicinename == ""){
        alert("Please enter Medicine Name"); return false;
    }
   
    if(observation == ""){
        alert("Please enter Observation"); return false;
    }
   
    
    data = month+"$"+medicinename+"$"+observation;
    
     count = parseInt($('#counter').val())+1;
     
     createCMGeneralHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteCMGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editCMGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + month + '</td><td>' + medicinename + '</td>\n\
<td>' + observation + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#month').val("MONTH");
      $('#medicinename').val("");
      $('#observation').val("");
       $('#child_medicine_info_table').append(trHtml);
       $('#child_medicine_info_table').load();
    
});

});

function fetchChildMedicineInfo(s){
    
   console.log(rootURL + '/fetchChildMedicines/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchChildMedicines/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#child_medicine_existing_records_search_result_table tbody").remove();

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
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.medicinename+"#"+userDetails.observation); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.medicinename + '</td><td>' + userDetails.observation + '</td><td><font color="blue">\n\
     <a href="#" onclick=editChildMedicalInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#child_medicine_existing_records_search_result_table').append(trHTML);
                           $('#child_medicine_existing_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});  
}


function editChildMedicalInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    $('#umonth').val(splitData[1]);
    $('#umedicinename').val(splitData[2]);
    $('#uobservations').val(splitData[3]);
    $('#generalid').val(splitData[0]);
    $('#myParametersModal').modal('show');
}//


function createCMGeneralHiddenDiv(data,count){
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

function deleteCMGeneralGeneralData(rowData){
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


function editCMGeneralGeneralData(rowData){
   console.log("In edit"+rowData);
   try{
          console.log($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         console.log(" dataToEdit :"+dataToEdit);
         var splitDataToEdit = dataToEdit.split("$");
         console.log(" splitDataToEdit :"+splitDataToEdit);
 //data = month+"$"+weight+"$"+height+"$"+bp+"$"+postsugar+"$"+sugarfasting+"$"+observation;
  
       $('#month').val(splitDataToEdit[0]);
      $('#medicinename').val(splitDataToEdit[1]);
      $('#observation').val(splitDataToEdit[2]);
    
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

