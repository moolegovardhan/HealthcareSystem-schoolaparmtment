var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
    
    
    console.log(rootURL+'/fetchApartmentDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchApartmentDetails',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
            
            
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var apartmentData = responseMessageDetails.data;
                    
                    $.each(apartmentData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                        finaldata = data.apartmentid +"#"+data.floornumber +"#"+data.flatnumber
                                    +"#"+data.block +"#"+data.familycount +"#"+data.id;
                        console.log(finaldata);
                            
                     link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
                     deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                   trHTML = "<tr id="+count+"><td>"+data.apartmentid+"</td><td>"+data.floornumber+"</td><td>"+data.flatnumber+"</td><td>"+data.block+"</td><td>"+data.familycount+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                       
                         $('#apartment_details_table').append(trHTML);
                        $('#apartment_details_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });
   
    
    
    
    $('#addApartmentDetailsToList').click( function(){
       
       if($('#floornumber').val() == "nodata"){
           
           alert("Please select floornumber");
           return false;
       }
        if($('#flatnumber').val() == "nodata"){
           
           alert("Please select flatnumber");
           return false;
       }
        if($('#block').val() == ""){
           
           alert("Please enter class block");
           return false;
       }
        if($('#familycount').val() == "nodata"){
           
           alert("Please select class familycount ");
           return false;
       }
        if($('#flatownername').val() == "nodata"){
           
           alert("Please select class flatownername ");
           return false;
       }
        count = $('#counter').val();
        trHTML = "";
        link = "";
        
        console.log("....florr number......................."+$('#floornumber').val());
       /*
        *  finaldata = data.schoolid +"#"+data.classname +"#"+data.section
                                    +"#"+data.strength +"#"+data.classteacherid +"#"+data.classteacherid +"#"+data.teachername;
                        
        */
      // flatownername = $( "#flatowner option:selected" ).text();
      
       if($('#dbrowid').val() != '' && $('#dbrowid').val() != 'null' ){
           rowid = $('#dbrowid').val();
       }else
           rowid = "NA";
      
        finaldata = $('#officeid').val()+"#"+$('#floornumber').val() +"#"+$('#flatnumber').val() +"#"+$('#block').val()
                 +"#"+$('#familycount').val()+"#"+rowid;
  
      link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
                     deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#officeid').val()+"</td><td>"+$('#floornumber').val()+"</td><td>"+$('#flatnumber').val()+"</td><td>"+$('#block').val()+"</td>\n\
<td>"+$('#familycount').val()+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
           
       $('#apartment_details_table').append(trHTML);
         $('#apartment_details_table').load();
         
        createVoucherHiddenTextBox(finaldata,count);
        
        
        
          $('#floornumber').val("nodata");
        $('#flatnumber').val("");
        $('#block').val("");
        $('#familycount').val("");
        $('#dbrowid').val("");
        
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
        $('#floornumber').val(splitDataToEdit[1]);
        $('#flatnumber').val(splitDataToEdit[2]);
        $('#block').val(splitDataToEdit[3]);
        $('#familycount').val(splitDataToEdit[4]);
        $('#dbrowid').val(splitDataToEdit[5]);
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