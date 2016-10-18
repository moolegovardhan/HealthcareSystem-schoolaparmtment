var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
 
   console.log(rootURL+'/fetchApartmentDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchInstCardDetails/Lab',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
           
            var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var cardsData = responseMessageDetails.data;
                    
                    $.each(cardsData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                       finaldata = data.cardid +"#"+data.instid +"#"+data.discount
                                       +"#"+data.id+"#"+data.cardname+"#"+data.labname;
                        console.log(finaldata);
                            
                     link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
                     deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                   trHTML = "<tr id="+count+"><td>"+data.cardname+"</td><td>"+data.labname+"</td><td>"+data.discount+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                       
                         $('#card_lab_details_table').append(trHTML);
                        $('#card_lab_details_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });
  
  
  
  
  
  $('#addCardLabDetails').click( function(){
       
       if($('#cardname').val() == "nodata"){
           
           alert("Please select Card Name");
           return false;
       }
        if($('#lab').val() == "nodata"){
           
           alert("Please select Lab");
           return false;
       }
        if($('#ppercent').val() == ""){
           
           alert("Please enter discount percent");
           return false;
       }
       
        count = $('#counter').val();
        trHTML = "";
        link = "";
        
     
      // flatownername = $( "#flatowner option:selected" ).text();
      
       if($('#dbrowid').val() != '' && $('#dbrowid').val() != 'null' ){
           rowid = $('#dbrowid').val();
       }else
           rowid = "NA";
      
        finaldata = $('#cardname').val() +"#"+$('#lab').val() +"#"+$('#ppercent').val()
                 +"#"+rowid+"#"+$('#cardname  option:selected').text()+"#"+$('#lab  option:selected').text();
  
      link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
                     deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#cardname  option:selected').text()+"</td><td>"+$('#lab  option:selected').text()+"</td>\n\
<td>"+$('#ppercent').val()+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
           
       $('#card_lab_details_table').append(trHTML);
         $('#card_lab_details_table').load();
         
        createVoucherHiddenTextBox(finaldata,count);
        
        
        
          $('#cardname').val("nodata");
        $('#lab').val("nodata");
        $('#ppercent').val("");
        
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
         var dataToEdit = $('#textbox'+rowData).val();
          var splitDataToEdit = dataToEdit.split("#");
         console.log(splitDataToEdit);
        $('#cardname').val(splitDataToEdit[0]);
        $('#lab').val(splitDataToEdit[1]);
        $('#ppercent').val(splitDataToEdit[2]);
        $('#dbrowid').val(splitDataToEdit[3]);
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