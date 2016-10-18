var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
 $('#counter').val(0);
 
 $('#showNonPrescriptionMedicineSerachPop').click(function(){
    	$('#searchPatientNonPrescriptionMedicinesModal').modal('show');
    }); 
});



function searchPatientNonPrescriptionGenericMedicine(){
	var serchData = $('#searchMedicine').val();
	$.ajax({
		type: 'GET',
		url: rootURL + '/fetchMedicinesList/'+serchData,
		dataType: "json",
		success: function(data){
			$('#searchPatientNonPrescriptionMedicinesResults').show();
			$('#searchPatientNonPrescriptionMedicinesResults tbody').html('');
			var objLength = data.length;
			if(objLength > 0){
                           
				 for (var i = 0; i < objLength; i++) {
                                            dataToPass = "'"+escape(data[i].id+"#"+i+"#"+data[i].medicinename)+"'";
                                            console.log(dataToPass);
					 $('#searchPatientNonPrescriptionMedicinesResults tbody').append('<tr class="data" onclick="addSearchPatientNonPrescriptionMedicine('+dataToPass+')" id="row_'+data[i].id+'"><td>'+(i+1)+'</td><td class="medicine-name">'+data[i].medicinename+'</td></tr>');
					}
				 $('#tablePaging').show();
				 /* Pagination Code Start */
				 load = function() {
					window.tp = new Pagination('#tablePaging', {
					itemsCount: objLength,
					onPageSizeChange: function (ps) {
						console.log('changed to ' + ps);
					},
					onPageChange: function (paging) {
						//custom paging logic here
						//console.log(paging);
						var start = paging.pageSize * (paging.currentPage - 1),
							end = start + paging.pageSize,
							$rows = $('#searchPatientNonPrescriptionMedicinesResults tbody').find('.data');
	
						$rows.hide();
	
						for (var i = start; i < end; i++) {
							$rows.eq(i).show();
						}
					}
					});
				 /* Pagination Code End */
				 }
	
				 load();
			}else{
				$('#searchMedicinesResults tbody').append('<tr><td colspan="2" style="text-align:center;">No Data Found</td></tr>');
				$('#tablePaging').hide();
			}
			 
			}
  });
}
function addSearchPatientNonPrescriptionMedicine(datatoPass){
        //console.log(datatoPass);
        console.log(unescape(datatoPass));
        splitingData = unescape(datatoPass).split('#');
        console.log("splitingData.........."+splitingData);
        count = $('#counter').val();
        data = splitingData[0]+"#"+splitingData[2];
        trHtml = "";
        link = "<input type='text' id='quantity"+count+"' name='quantity"+count+"' />";
        trHtml = "<tr id="+count+"><td>"+splitingData[2]+"</td><td>"+link+"</td></tr>";
        $('#patient_non_prescription_list').append(trHtml);
        createPregnancyHiddenTextBox(data,count);
        $('#counter').val(parseInt(count)+parseInt(1));
	//$('#gmedicines').val($('#row_'+id).find('.medicine-name').text());
	$('#searchPatientNonPrescriptionMedicinesModal').modal('hide'); 
}


function createPregnancyHiddenTextBox(data,count){
    
    console.log("in create div");
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html('<label> : </label>' +
	      '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#medicinestabledata");

				
	$('#counter').val(count);
    
}
