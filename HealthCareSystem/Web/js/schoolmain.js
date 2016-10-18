
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    
    
    

console.log($('#pid').val());
    
    pid = $('#pid').val();
    console.log(pid);
    console.log(rootURL + '/fetchPatientSpecificOrders/' + pid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchPatientSpecificOrders/' + pid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_received_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientlid = "";
                            $('#recordcount').val(dataCount);
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientlid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientlid != data.ID ));
                                
                           checkboxid = index+"selected";
                           if(data.status == "D")
                            checklink = "<input type='checkbox' id="+checkboxid+" name="+checkboxid+" value="+data.id+">";   
                           else
                            checklink = "";
                                console.log("......"+data.redirecteddate);
                                 
                                 trHTML ="<tr><td nowrap='true'>"+checklink+"</td><td>"+((data.redirecteddate == null) ? " " : data.redirecteddate)+"</td>\n\
<td>"+((data.medicinename == "") ? " " : data.medicinename)+"</td><td>"+((data.dispatchdate == null) ? " " : data.dispatchdate)+"</td><td>"+((data.medicalshopname == null) ? " " : data.medicalshopname)+"</td>\n\
<td>"+((data.price == null) ? " " : data.price)+"</td></tr>";
                                       $('#patient_medicines_order_received_table').append(trHTML);
                                        $('#patient_medicines_order_received_table').load();
                               
                                 patientlid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_received_table').append(trHTML);
                             $('#patient_medicines_order_received_table').load();
                        }
                         
                    }
                });

                        
        }
    });
    
});



