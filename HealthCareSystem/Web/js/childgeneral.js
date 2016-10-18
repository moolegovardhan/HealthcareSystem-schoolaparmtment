
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
$('#counter').val(0);

$('#submitChildGeneralDataEdit').click( function(){
       month = $('#umonth').val();
    height = $('#uheight').val();
    weight = $('#uweight').val();
    pulse = $('#upulse').val();
    id = $('#generalid').val();
    observation = $('#uobservations').val();
    console.log();//
    datatoJSON = {"id":id,"month":month,"weight":weight,"height":height,"pulse":pulse,"observations":observation,"hospitalId":$('#officeid').val(),"status":"Y"};
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updateChildGeneral');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updateChildGeneral',
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
          fetchChildGeneralInfo($('#officeid').val());  
            
        }
    });   
     
 });

fetchChildGeneralInfo($('#officeid').val());

$('#addChildGeneralParameters').click( function(){
    month = $('#month').val();
    height = $('#height').val();
    weight = $('#weight').val();
    pulse = $('#pulse').val();
    observation = $('#observation').val();
    if(month == "MONTH"){
        alert("Please select Month"); return false;
    }
    if(weight == ""){
        alert("Please enter weight"); return false;
    }
    if(height == ""){
        alert("Please enter weight"); return false;
    }
    if(pulse == ""){
        alert("Please enter Pulse"); return false;
    }
    if(observation == ""){
        alert("Please enter Observation"); return false;
    }
   
    
    data = month+"$"+weight+"$"+height+"$"+pulse+"$"+observation;
    
     count = parseInt($('#counter').val())+1;
     
     createCGeneralHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deleteCGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editCGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + month + '</td><td>' + weight + '</td><td>' + height + '</td><td>' + pulse + '</td>\n\
<td>' + observation + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#month').val("MONTH");
      $('#weight').val("");
      $('#height').val("");
      $('#pulse').val("");
     
      $('#observation').val("");
       $('#child_general_info_table').append(trHtml);
       $('#child_general_info_table').load();
    
});

});

function fetchChildGeneralInfo(s){
    
   console.log(rootURL + '/fetchChildGeneral/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchChildGeneral/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#child_existing_records_search_result_table tbody").remove();

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
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.weight+"#"+userDetails.height+"#"+userDetails.pulse+"#"+userDetails.observation); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.weight + '</td><td>' 
                                           + userDetails.height +'</td><td>' + userDetails.pulse + '</td><td>' + userDetails.observation + '</td><td><font color="blue">\n\
     <a href="#" onclick=editChildGeneralInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#child_existing_records_search_result_table').append(trHTML);
                           $('#child_existing_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});  
}


function editChildGeneralInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    $('#umonth').val(splitData[1]);
    $('#uweight').val(splitData[2]);
    $('#uheight').val(splitData[3]);
    $('#upulse').val(splitData[4]);
    $('#uobservations').val(splitData[5]);
    $('#generalid').val(splitData[0]);
    $('#myParametersModal').modal('show');
}//


function createCGeneralHiddenDiv(data,count){
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

function deleteCGeneralGeneralData(rowData){
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


function editCGeneralGeneralData(rowData){
   console.log("In edit"+rowData);
   try{
          console.log($('#textbox'+rowData).val());
         var dataToEdit = $('#textbox'+rowData).val();
         console.log(" dataToEdit :"+dataToEdit);
         var splitDataToEdit = dataToEdit.split("$");
         console.log(" splitDataToEdit :"+splitDataToEdit);
 //data = month+"$"+weight+"$"+height+"$"+bp+"$"+postsugar+"$"+sugarfasting+"$"+observation;
  
       $('#month').val(splitDataToEdit[0]);
      $('#weight').val(splitDataToEdit[1]);
      $('#height').val(splitDataToEdit[2]);
      $('#pulse').val(splitDataToEdit[3]);
     
    $('#observation').val((splitDataToEdit[4] == "nodata" ? "" : splitDataToEdit[4])); 
    
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

