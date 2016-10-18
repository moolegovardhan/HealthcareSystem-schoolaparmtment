var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
    
    
    console.log(rootURL+'/fetchIndustryGroupDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchIndustryGroupDetails',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
            
            
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var industryData = responseMessageDetails.data;
                    
                    $.each(industryData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                        finaldata = data.groupname +"#"+data.geoupdesc;
                            
                     link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                      trHTML = "<tr id="+count+"><td>"+data.groupname+"</td><td>"+data.geoupdesc+"</td><td>"+link+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#industry_testgroup_table').append(trHTML);
                        $('#industry_testgroup_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });
   
    
    
    
    $('#addIndustryGroupDetailsToList').click( function(){
       
      
        if($('#groupname').val() == ""){
           
           alert("Please enter class group name");
           return false;
       }
        if($('#groupdesc').val() == ""){
           
           alert("Please select class group description ");
           return false;
       }
        
        count = $('#counter').val();
        trHTML = "";
        link = "";
       /*
        *  finaldata = data.schoolid +"#"+data.classname +"#"+data.section
                                    +"#"+data.strength +"#"+data.classteacherid +"#"+data.classteacherid +"#"+data.teachername;
                        
        */
      
        finaldata = $('#groupname').val()+"#"+$('#groupdesc').val();
  
        link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#groupname').val()+"</td><td>"+$('#groupdesc').val()+"</td><td>"+link+"</td></tr>";
       
       
       $('#industry_testgroup_table').append(trHTML);
         $('#industry_testgroup_table').load();
         
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

