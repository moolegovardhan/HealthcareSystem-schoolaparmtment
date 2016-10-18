
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
$('#counter').val(0);

$('#submitChildVacinationDataEdit').click( function(){
       month = $('#umonth').val();
    vacinename = $('#uvacinename').val();
    id = $('#generalid').val();
    observation = $('#uobservations').val();
    console.log();//
    datatoJSON = {"id":id,"month":month,"vacinename":vacinename,"observations":observation,"hospitalId":$('#officeid').val(),"status":"Y"};
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updateChildVacination');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updateChildVacination',
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

            fetchChildVacinationInfo($('#officeid').val());  
            
        }
    });   
     
 });

fetchChildVacinationInfo($('#officeid').val());

$('#addChildVacinationParameters').click( function(){
    month = $('#month').val();
    vacinename = $('#vacinename').val();
    observation = $('#observation').val();
    if(month == "MONTH"){
        alert("Please select Month"); return false;
    }
    if(vacinename == ""){
        alert("Please enter Vacination Name"); return false;
    }
   
    if(observation == ""){
        alert("Please enter Observation"); return false;
    }
   
    
    data = month+"$"+vacinename+"$"+observation;
    
     count = parseInt($('#counter').val())+1;
     
     createCVGeneralHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteCVGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editCVGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + month + '</td><td>' + vacinename + '</td>\n\
<td>' + observation + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#month').val("MONTH");
      $('#vacinename').val("");
      $('#observation').val("");
       $('#child_vacination_info_table').append(trHtml);
       $('#child_vacination_info_table').load();
    
});

});

function fetchChildVacinationInfo(s){
    
   console.log(rootURL + '/fetchChildVacination/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchChildVacination/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#child_vacination_existing_records_search_result_table tbody").remove();

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
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.vacinename+"#"+userDetails.observation); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.vacinename + '</td><td>' + userDetails.observation + '</td><td><font color="blue">\n\
     <a href="#" onclick=editChildVacinationInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#child_vacination_existing_records_search_result_table').append(trHTML);
                           $('#child_vacination_existing_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});  
}


function editChildVacinationInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    $('#umonth').val(splitData[1]);
    $('#uvacinename').val(splitData[2]);
    $('#uobservations').val(splitData[3]);
    $('#generalid').val(splitData[0]);
    $('#myParametersModal').modal('show');
}//


function createCVGeneralHiddenDiv(data,count){
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

function deleteCVGeneralGeneralData(rowData){
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


function editCVGeneralGeneralData(rowData){
   console.log("In edit"+rowData);
   try{
          console.log($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         console.log(" dataToEdit :"+dataToEdit);
         var splitDataToEdit = dataToEdit.split("$");
         console.log(" splitDataToEdit :"+splitDataToEdit);
 //data = month+"$"+weight+"$"+height+"$"+bp+"$"+postsugar+"$"+sugarfasting+"$"+observation;
  
       $('#month').val(splitDataToEdit[0]);
      $('#vacinename').val(splitDataToEdit[1]);
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

