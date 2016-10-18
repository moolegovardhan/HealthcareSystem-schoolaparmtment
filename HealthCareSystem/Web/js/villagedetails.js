var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
    
    
    console.log(rootURL+'/fetchVillageDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchVillageDetails',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
            
            
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var villageData = responseMessageDetails.data;
                    
                    $.each(villageData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                        finaldata = data.villageid +"#"+data.streetname +"#"+data.housenumber
                                     +"#"+data.familycount +"#"+data.id;
                        console.log(finaldata);
                            
                     link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
                     deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                   trHTML = "<tr id="+count+"><td>"+data.villageid+"</td><td>"+data.streetname+"</td><td>"+data.housenumber+"</td><td>"+data.familycount+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                       
                         $('#village_details_table').append(trHTML);
                        $('#village_details_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });
   
    
    
    
    $('#addVillageDetailsToList').click( function(){
       
       if($('#streetname').val() == "nodata"){
           
           alert("Please select streetname");
           return false;
       }
        if($('#housenumber').val() == "nodata"){
           
           alert("Please select housenumber");
           return false;
       }
       
        if($('#familycount').val() == "nodata"){
           
           alert("Please select class familycount ");
           return false;
       }
        
        count = $('#counter').val();
        trHTML = "";
        link = "";
        
        console.log("....house number......................."+$('#housenumber').val());
       /*
        *  finaldata = data.schoolid +"#"+data.classname +"#"+data.section
                                    +"#"+data.strength +"#"+data.classteacherid +"#"+data.classteacherid +"#"+data.teachername;
                        
        */
      // flatownername = $( "#flatowner option:selected" ).text();
      
       if($('#dbrowid').val() != '' && $('#dbrowid').val() != 'null' ){
           rowid = $('#dbrowid').val();
       }else
           rowid = "NA";
      
        finaldata = $('#officeid').val()+"#"+$('#streetname').val() +"#"+$('#housenumber').val() 
                 +"#"+$('#familycount').val()+"#"+rowid;
  
      link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
      deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#officeid').val()+"</td><td>"+$('#streetname').val()+"</td><td>"+$('#housenumber').val()+"</td>\n\
<td>"+$('#familycount').val()+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
           
       $('#village_details_table').append(trHTML);
         $('#village_details_table').load();
         
        createVoucherHiddenTextBox(finaldata,count);
        
        
        
          $('#streetname').val("nodata");
        $('#housenumber').val("");
        $('#familycount').val("");
        $('#dbrowid').val("");
        
    });
    
});
function deleteData(rowData){
   console.log("In"+rowData);
   try{
     // row = document.getElementById(rowData) ;
      row = document.getElementById(rowData);
    console.log("row :"+row);
   (row).parentNode.removeChild(row);
      // row.removeChild(row.childNodes[0]);
        
//if (row.parentNode) {
//  row.parentNode.removeChild(row);
//}
        
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
         var dataToEdit = $('#textbox'+rowData).val();
          var splitDataToEdit = dataToEdit.split("#");
         console.log(splitDataToEdit);
        $('#streetname').val(splitDataToEdit[1]);
        $('#housenumber').val(splitDataToEdit[2]);
        $('#familycount').val(splitDataToEdit[3]);
        $('#dbrowid').val(splitDataToEdit[4]);
          $("#TextBoxDiv" + rowData).remove();
      row = document.getElementById(rowData) ;
        $("#TextBoxDiv" + rowData).remove();
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
         
    }catch( e){
        console.log(e);
    }  
 }
function createVoucherHiddenTextBox(data,count){
    console.log(data);
    console.log("in create div"+$('#counter').val());
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html( '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#labtabledata");

				
	$('#counter').val(parseInt(count)+parseInt(1));
    
}