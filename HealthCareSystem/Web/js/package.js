var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
     $('#counter').val(0);
     
     $('#addLabToList').click( function(){
         
          if($('#packagename').val() == ""){

                alert("Please enter Package Name");
                return false;
            }
          if($('#price').val() == ""){
           
           alert("Please enter price");
           return false;
       }
        if($('#start').val() == ""){
           
           alert("Please enter start date");
           return false;
       }
        if($('#finish').val() == ""){
           
           alert("Please enter end date");
           return false;
       }
         
         console.log($('#diagname').val());
         console.log($('#testnames').val());
          console.log($('#diagname  :selected').text());
           console.log($('#testnames :selected').text());
           console.log($("#testnames").find(":selected").text());
         console.log($('#price').val());
         console.log($('#start').val());
         console.log($('#finish').val());
         console.log($('#packagename').val());
         
         diagId = $('#diagname').val();
         diagName = $('#diagname  :selected').text();
         testId = $('#testnames').val();
         start = $('#start').val();
         finish = $('#finish').val();
         package = $('#packagename').val();
        price =  $('#price').val();
         var testName = "";
         $("#testnames option:selected").each(function () {
                var $this = $(this);
                if ($this.length) {
                    if(testName.length < 1){
                         testName = $this.text();
                    }else{
                         testName = testName+"#"+$this.text();
                    }
                 
                 
                }
             });
              count = $('#counter').val();
         console.log(testName);
         dataToPass = diagId+"$"+diagName+"$"+testName+"$"+testId+"$"+price+"$"+start+"$"+finish+"$"+package;
         console.log(dataToPass);
          createPackageHiddenTextBox(dataToPass,count);
          
          var labtoShow = testName.replace(/#/g," , ");
           link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
          trHTML = "<tr id="+count+"><td>"+package+"</td><td>"+start+"</td><td>"+finish+"</td><td>"+price+"</td>\n\
<td>"+labtoShow+"</td><td>"+diagName+"</td><td>"+link+"</td></tr>";
                      $('#package_details_table').append(trHTML);
                        $('#package_details_table').load();
     })
     
});

function createPackageHiddenTextBox(data,count){
    
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