var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
    
    
    console.log(rootURL+'/fetchSchoolDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchSchoolDetails',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
            
            
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var schoolData = responseMessageDetails.data;
                    
                    $.each(schoolData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                        finaldata = data.schoolid +"#"+data.classname +"#"+data.section
                                    +"#"+data.strength +"#"+data.classteacherid +"#"+data.teachername;
                            
                     link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                      trHTML = "<tr id="+count+"><td>"+data.classname+"</td><td>"+data.section+"</td><td>"+data.strength+"</td><td>"+data.classteacherid+"</td>\n\
                   <td>"+data.teachername+"</td><td>"+link+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#school_details_table').append(trHTML);
                        $('#school_details_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });
   
    
    
    
    $('#addSchoolDetailsToList').click( function(){
       
       if($('#classname').val() == "nodata"){
           
           alert("Please select class");
           return false;
       }
        if($('#section').val() == "nodata"){
           
           alert("Please select section");
           return false;
       }
        if($('#strength').val() == ""){
           
           alert("Please enter class strength");
           return false;
       }
        if($('#teacher').val() == "nodata"){
           
           alert("Please select class teacher ");
           return false;
       }
        
        count = $('#counter').val();
        trHTML = "";
        link = "";
       /*
        *  finaldata = data.schoolid +"#"+data.classname +"#"+data.section
                                    +"#"+data.strength +"#"+data.classteacherid +"#"+data.classteacherid +"#"+data.teachername;
                        
        */
       teachername = $( "#teacher option:selected" ).text();
        finaldata = $('#officeid').val()+"#"+$('#classname').val() +"#"+$('#section').val() +"#"+$('#strength').val()
                 +"#"+$('#teacher').val() +"#"+teachername;
  
        link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#classname').val()+"</td><td>"+$('#section').val()+"</td><td>"+$('#strength').val()+"</td>\n\
<td>"+$('#teacher').val()+"</td><td>"+teachername+"</td><td>"+link+"</td></tr>";
       
       
       $('#school_details_table').append(trHTML);
         $('#school_details_table').load();
         
        createVoucherHiddenTextBox(finaldata,count);
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


function createVoucherHiddenTextBox(data,count){
    
    console.log("in create div"+$('#counter').val());
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html( '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#labtabledata");

				
	$('#counter').val(parseInt(count)+parseInt(1));
    
}