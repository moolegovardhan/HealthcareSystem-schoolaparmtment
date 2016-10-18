var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    $('#counter').val(0);
    console.log(rootURL+'/fetchAllCardVoucherDetails');
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchAllCardVoucherDetails',
        dataType: "json",
        success: function(data, textStatus, jqXHR){
            
            
            
              var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var patientData = responseMessageDetails.data;
                    
                    $.each(patientData, function (index, data) {
                        lab = false;
                            medical = false;
                            hospital = false;
                            mobile = false;
                        if(data.insttype == "Lab"){
                            lab = true;
                            medical = false;
                            hospital = false;
                            mobile = false;
                        }    
                        if(data.insttype == "Medical"){
                            lab = false;
                            medical = true;
                            hospital = false;
                            mobile = false;
                        }  
                        if(data.insttype == "Hospital"){
                            lab = false;
                            medical = false;
                            hospital = true;
                            mobile = false;
                        }  
                        if(data.insttype == "Mobile"){
                            lab = false;
                            medical = false;
                            hospital = false;
                            mobile = true;
                        }  
                        
                        
                        count = $('#counter').val();
                        
                        finaldata = data.vname+"#"+data.vtype +"#"+data.percent +"#"+data.count
                                    +"#"+data.startdate +"#"+data.enddate +"#"+data.cardid+"#"+lab
                             +"#"+ medical+"#"+mobile +"#"+hospital+"#"+data.price+"#"+data.cardname+"#"+data.id+"#"+data.cashvoucher;
                     link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
                      trHTML = "<tr id="+count+"><td>"+data.vname+"</td><td>"+data.price+"</td><td>"+data.percent+"</td><td>"+data.count+"</td>\n\
                   <td>"+data.startdate+"</td><td>"+data.enddate+"</td><td>"+data.cardname+"</td><td>"+lab+"</td>\n\
                   <td>"+medical+"</td><td>"+mobile+"</td><td>"+hospital+"</td><td>"+data.cashvoucher+"</td><td>"+link+"</td></tr>";
                    createVoucherHiddenTextBox(finaldata,count);
                        
                         $('#voucher_details_table').append(trHTML);
                        $('#voucher_details_table').load();

                    });
                   //console.log("message "+);
               });
               
               
        }
    });

    
});//

/*
 * finaldata = $('#vname').val()+"#"+$('#vouchertype').val() +"#"+$('#percent').val() +"#"+$('#vcount').val()
                 +"#"+$('#start').val() +"#"+$('#finish').val() +"#"+$('#cardtype').val()+"#"+lab
          +"#"+ medical+"#"+mobile +"#"+hospital;
  link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
   trHTML = "<tr id="+count+"><td>"+$('#vname').val()+"</td><td>"+$('#percent').val()+"</td><td>"+$('#vcount').val()+"</td>\n\
<td>"+$('#start').val()+"</td><td>"+$('#finish').val()+"</td><td>"+$('#cardtype').val()+"</td><td>"+lab+"</td>\n\
<td>"+medical+"</td><td>"+mobile+"</td><td>"+hospital+"</td><td>"+link+"</td></tr>";
       
       //
       $('#voucher_details_table').append(trHTML);
         $('#voucher_details_table').load();
 */

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

