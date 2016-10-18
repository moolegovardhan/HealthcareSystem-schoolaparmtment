var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    $('#ordercounter').val("0");
    
     $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: rootURL + '/fetchOrderInwardInfo',
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                        console.log('authentic success: ' + data);
                                            
                        },
                error: function(jqXHR, textStatus, errorThrown){
                   
                 }
                
                });
    
    


$('#addOrderToMedicalList').click( function(){
    
    medicinename = $('#medicinename').val();
    orderid = $('#orderid').val();
    dispatcheddate = $('#start').val();
    receiveddate = $('#edate').val();
    company = $('#companyname').val();
    distributor = $('#distname').val();
    batch = $('#batchnumber').val();
    expirydate = $('#finish').val();
    packaging = $('#packagingtype').val();
    noofunits = $('#noofunits').val();
    unitsperpack = $('#unitsperpack').val();
    totalcost = $('#totalbatchcost').val();
    unitcost  = $('#perunitcost').val();
     countperpack  = $('#countperpack').val();
    count = parseInt($('#ordercounter').val())+1;   
    trHTML = "";
    data = medicinename+"$"+orderid+"$"+dispatcheddate+"$"+receiveddate+"$"+company+"$"+distributor+"$"+batch+"$"+expirydate+"$"
            +packaging+"$"+noofunits+"$"+unitsperpack+"$"+totalcost+"$"+unitcost+"$"+countperpack;
   createOrderHiddenTextBox(data,count); 
    $('#medicines_per_orderid').append("<tr><td>"+medicinename+"</td><td>"+orderid+"</td><td>"+dispatcheddate+"</td><td>"+receiveddate+"</td><td>"+company+"</td>\n\
<td>"+distributor+"</td><td>"+batch+"</td><td>"+expirydate+"</td><td>"+packaging+"</td>\n\
<td>"+noofunits+"</td><td>"+unitsperpack+"</td><td>"+totalcost+"</td><td>"+unitcost+"</td></tr>");
    
    
});


 $('#addMedicalforOrder').click( function(){
    
     ocounter = $('#ordercounter').val();
     var list = new Array();
     console.log(ocounter);
     for(i=1;i<parseInt(ocounter)+1;i++){
         
         console.log($('#textbox'+i).val());
         list.push($('#textbox'+i).val());
         // console.log(list);
     }
     console.log(rootURL+'/insertNewOrder');
    console.log(JSON.stringify({"ordered":list }));
    data = JSON.stringify({"ordered":list });
    $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/insertNewOrder',
            dataType: "json",
            data:  data,
            success: function(data, textStatus, jqXHR){
                 $("#errorDisplay").html("Data Updated Successfully").show();
                    $('#errormessages').show();
            },
                error: function(jqXHR, textStatus, errorThrown){
                    $("#errorDisplay").html("Please re submit data").show();
                    $('#errormessages').show();
                 }
    });    
 });


});
function createOrderHiddenTextBox(data,count){
    
    console.log("in create div");
    var newTextBoxDiv1 = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv1);
   
	newTextBoxDiv1.after().html('<label></label>' +
	      '<input type="text" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
        console.log(newTextBoxDiv1);    
	newTextBoxDiv1.appendTo("#medicinesordertabledata");

				
	$('#ordercounter').val(count);
    
}
