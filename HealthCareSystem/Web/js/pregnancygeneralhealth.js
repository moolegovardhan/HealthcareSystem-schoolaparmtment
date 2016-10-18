
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
$('#counter').val(0);

$('#submitPregnancyGeneralDataEdit').click( function(){
       month = $('#umonth').val();
    height = $('#uheight').val();
    weight = $('#uweight').val();
    bp = $('#ubp').val();
    id = $('#generalid').val();
    postsugar = $('#upostsugar').val();
    sugarfasting = $('#usugarfasting').val();
    console.log();//
    datatoJSON = {"id":id,"month":month,"weight":weight,"height":height,"bp":bp,"postsugar":postsugar,"sugarfasting":sugarfasting,"hospitalId":$('#officeid').val()};
    datatoEdit = JSON.stringify(datatoJSON);
    console.log(datatoEdit);
     console.log(rootURL + '/updatePregnancyGeneralHealth');
    $.ajax({
        type: 'PUT',
        url: rootURL + '/updatePregnancyGeneralHealth',
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
          fetchPatientGeneralInfo($('#officeid').val());  
            
        }
    });   
     
 });

fetchPatientGeneralInfo($('#officeid').val());

$('#addPregnancyGeneralParameters').click( function(){
    month = $('#month').val();
    height = $('#height').val();
    weight = $('#weight').val();
    bp = $('#bp').val();
    postsugar = $('#postsugar').val();
    sugarfasting = $('#sugarfasting').val();
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
    if(bp == ""){
        alert("Please enter BP"); return false;
    }
    if(sugarfasting == ""){
        alert("Please enter Sugar Fasting"); return false;
    }
    if(postsugar == ""){
        alert("Please enter Post Sugar"); return false;
    }
    if(observation.length < 0){
        observation = "nodata";
    }
    
    data = month+"$"+weight+"$"+height+"$"+bp+"$"+postsugar+"$"+sugarfasting+"$"+observation;
    
     count = parseInt($('#counter').val())+1;
     
     createPGeneralHiddenDiv(data,count);
   trHtml = "";  
   btnDelete = '<button class="btn btn-warning btn-xs"  onclick="deletePGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Delete</button>';
    btnEdit = '<button class="btn btn-warning btn-xs" onclick="editPGeneralGeneralData('+count+')"><i class="fa fa-trash-o"></i> Edit</button>';
    //idValue = "1";
    trHtml += '<tr id="'+count+'"><td>' + month + '</td><td>' + weight + '</td><td>' + height + '</td><td>' + bp + '</td>\n\
<td>' + sugarfasting + '</td><td>' + postsugar + '</td><td>' + observation + '</td><td>'+btnDelete+'&nbsp;&nbsp;&nbsp;&nbsp;'+btnEdit+' </td></tr>';

      $('#month').val("MONTH");
      $('#weight').val("");
      $('#height').val("");
      $('#bp').val("");
      $('#postsugar').val("");
      $('#sugarfasting').val("");
      $('#observation').val("");
       $('#pregnancy_general_info_table').append(trHtml);
       $('#pregnancy_general_info_table').load();
    
});

});

function fetchPatientGeneralInfo(s){
    
   console.log(rootURL + '/fetchPregnancyGeneralHealth/'+s);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchPregnancyGeneralHealth/'+s,
    dataType: "json",
    success: function(data){
	console.log('authentic : ' + data)
          var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#pregnancy_existing_records_search_result_table tbody").remove();

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
                               data = escape(s+"#"+userDetails.month+"#"+userDetails.weight+"#"+userDetails.height+"#"+userDetails.bp+"#"+userDetails.sugarfasting+"#"+userDetails.sugarpostfasting); 
                                   trHTML += '<tr><td>' + userDetails.month  +'</td><td>' + userDetails.weight + '</td><td>' 
                                           + userDetails.height +'</td><td>' + userDetails.bp + '</td><td>' + userDetails.sugarfasting + '</td><td>' + userDetails.sugarpostfasting + '</td><td><font color="blue">\n\
     <a href="#" onclick=editPregnancyGeneralInfo("'+data+'")>Edit Data</a></font></td></tr>';
                               });
                           $('#pregnancy_existing_records_search_result_table').append(trHTML);
                           $('#pregnancy_existing_records_search_result_table').load(); 
                      }else{
                            
                      }
                 });
         
         
        }
        
        
	});  
}


function editPregnancyGeneralInfo(data){
    
    editData = unescape(data);
    splitData = editData.split("#");
    console.log("splitData"+splitData);
    $('#umonth').val(splitData[1]);
    $('#uweight').val(splitData[2]);
    $('#uheight').val(splitData[3]);
    $('#ubp').val(splitData[4]);
    $('#usugarfasting').val(splitData[5]);
    $('#upostsugar').val(splitData[6]);
    $('#generalid').val(splitData[0]);
    $('#myParametersModal').modal('show');
}//


function createPGeneralHiddenDiv(data,count){
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

function deletePGeneralGeneralData(rowData){
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


function editPGeneralGeneralData(rowData){
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
      $('#bp').val(splitDataToEdit[3]);
      $('#postsugar').val(splitDataToEdit[4]);
      $('#sugarfasting').val(splitDataToEdit[5]);
     
    $('#observation').val((splitDataToEdit[6] == "nodata" ? "" : splitDataToEdit[6])); 
    
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

