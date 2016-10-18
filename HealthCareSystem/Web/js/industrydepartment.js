var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
    
    
    console.log(rootURL+'/fetchIndustryDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchIndustryDetails',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
            
            
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var industryData = responseMessageDetails.data;
                    
                    $.each(industryData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                        finaldata = data.departmentname +"#"+data.deptdesc;
                            
                     link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                      trHTML = "<tr id="+count+"><td>"+data.departmentname+"</td><td>"+data.deptdesc+"</td><td>"+link+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#industry_department_table').append(trHTML);
                        $('#industry_department_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });
   
    
    
    
    $('#addIndustryDetailsToList').click( function(){
       
      
        if($('#departmentname').val() == ""){
           
           alert("Please enter class department name");
           return false;
       }
        if($('#desc').val() == ""){
           
           alert("Please select class Description ");
           return false;
       }
        
        count = $('#counter').val();
        trHTML = "";
        link = "";
       /*
        *  finaldata = data.schoolid +"#"+data.classname +"#"+data.section
                                    +"#"+data.strength +"#"+data.classteacherid +"#"+data.classteacherid +"#"+data.teachername;
                        
        */
      
        finaldata = $('#departmentname').val()+"#"+$('#desc').val();
  
        link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#departmentname').val()+"</td><td>"+$('#desc').val()+"</td><td>"+link+"</td></tr>";
       
       
       $('#industry_department_table').append(trHTML);
         $('#industry_department_table').load();
         
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