var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#counter').val(0);
 
  console.log(rootURL+'/fetchInstCardTestDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchInstCardTestDetails',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
           
            var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var cardsData = responseMessageDetails.data;
                    
                    $.each(cardsData, function (index, data) {
                        
                        count = $('#counter').val();
                        
                        finaldata = data.cardid +"#"+data.diagid +"#"+data.discount +"#"+data.testid
                 +"#"+data.id+"#"+data.cardname+"#"+data.diagname+"#"+data.testname;
                        console.log(finaldata);
                            
                     link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
                     deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                   trHTML = "<tr id="+count+"><td>"+data.cardname+"</td><td>"+data.diagname+"</td><td>"+data.testname+"</td><td>"+data.discount+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                       
                         $('#card_lab_test_details_table').append(trHTML);
                        $('#card_lab_test_details_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });
  
  
 
 
 
  $('#lab').change( function(){
      
       lab = $('#lab').val();
       console.log(rootURL + '/testsForDiagnostics/' + lab);
        $.ajax({
            type: 'GET',
            url: rootURL + '/testsForDiagnostics/' + lab,
            dataType: "json",
            success: function(data){
                 console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                $("#testname option").remove();
                console.log(list);
                    console.log("Data List Length "+list.length);
                    $.each(list, function(index, responseMessageDetails) {

                         if(responseMessageDetails.status == "Success"){
                                testData = responseMessageDetails.data;
                                 console.log("testData : "+testData.length);
                                 var trHTML = "";
                                strtext = '- Test Name -'
                                 $('<option>').val("nodata").text(strtext).appendTo('#testname');
                                 $.each(testData, function(index, data) {
                                      $('<option>').val(data.testid).text(data.testname).appendTo('#testname');
                                 });

                            }
                        });        
                }
            }); 
      
      
  });
 
 
 
  $('#addCardLabTestDetails').click( function(){
       
       if($('#cardname').val() == "nodata"){
           
           alert("Please select Card Name");
           return false;
       }
        if($('#lab').val() == "nodata"){
           
           alert("Please select Lab Name");
           return false;
       }
        if($('#ppercent').val() == ""){
           
           alert("Please enter discount percent");
           return false;
       }
       
        if($('#testname').val() == "nodata"){
           
           alert("Please select Test Name");
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
      
        finaldata = $('#cardname').val() +"#"+$('#lab').val() +"#"+$('#ppercent').val() +"#"+$('#testname').val()
                 +"#"+rowid+"#"+$('#cardname  option:selected').text()+"#"+$('#lab  option:selected').text()+"#"+$('#testname  option:selected').text();
  
      link = "<font color='blue'><a href='#' onclick='editData("+count+")'>Edit<a></font>";
                     deletelink = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#cardname  option:selected').text()+"</td><td>"+$('#lab  option:selected').text()+"</td>\n\
<td>"+$('#testname  option:selected').text()+"</td><td>"+$('#ppercent').val()+"</td><td>"+link+"&nbsp;&nbsp;&nbsp;&nbsp;"+deletelink+"</td></tr>";
           
       $('#card_lab_test_details_table').append(trHTML);
         $('#card_lab_test_details_table').load();
         
        createVoucherHiddenTextBox(finaldata,count);
        
        
        
          $('#cardname').val("nodata");
        $('#shop').val("nodata");
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
         $('#testname').val(splitDataToEdit[3]);
        $('#dbrowid').val(splitDataToEdit[4]);
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