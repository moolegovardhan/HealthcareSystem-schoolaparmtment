/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
  
  $('#listofpatients').hide();
   $('#listofmedicines').hide();
  
  $('#searchPrescription').click(function(){
        
        if(validateSearchForm()){
            
            if($('#patientName').val() == ""){
                patientname = "nodata";
            } else
                patientname = $('#patientName').val();
            if($('#patientID').val() == ""){
                 patientid = "nodata";
            }else
                patientid =$('#patientID').val();
            if($('#appointmentID').val() == ""){
                 appid = "nodata";
            }else{
                appid = $('#appointmentID').val(); 
            }
            if($('#mobile').val() == ""){
                 mobile = "nodata";
            }else
                mobile = $('#mobile').val();
            
            
          console.log(rootURL + '/fetchPaidPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPaidPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    $('#patient_consultation_records_search_result_table tbody').html('');
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    //$("#patient_consultation_records_search_result_table tbody").remove();
                    	var objLength = '';
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  //$('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    //$('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     objLength = userData.length;
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
									 datatopass = userDetails.PatientId+"$"+userDetails.appointmentid+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId;  
									  console.log("datatopass : "+datatopass);    
									  console.log("index........"+(index < 1));
									  if(index < 1 && patientid != "nodata")
									  btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
									  else{
									      if(patientid != "nodata")
									         btst = "   ";
									      else
									          btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
									  
									  }    
									  
					
									  $('#patient_consultation_records_search_result_table tbody').append('<tr class="data"><td>' + userDetails.appointmentid + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
				                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
				                               + '</td><td>'+btst+'</td></tr>');
                                     
                                        
                                      // console.log("Patient Name : "+userDetails.PatientName); 
                                        $('#prespatientName').html(userDetails.PatientName);
                                        $('#doctorName').html(userDetails.DoctorName);
                                        $('#hospitalName').html(userDetails.HospitalName);
                                        $('#appointmentDate').html(userDetails.AppointementDate);
                                     // console.log("Pavan Kumar");
                                         $('#hidpatientName').val(userDetails.PatientName);  
                                         $('#hiddoctorName').val(userDetails.DoctorName);
                                         $('#hidhospitalName').val(userDetails.HospitalName);
                                         $('#hidappointmentDate').val(userDetails.AppointementDate);
                                         $('#hidappointmentId').val(userDetails.id);
                                         $('#hidpatientID').val(userDetails.patientid);
                                           
                                          
                                    });    
                                        //$('#patient_consultation_records_search_result_table').append(trHTML);
                                        //$('#patient_consultation_records_search_result_table').load();
                                     
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
                    							$rows = $('#patient_consultation_records_search_result_table tbody').find('.data');
                    	
                    						$rows.hide();
                    	
                    						for (var i = start; i < end; i++) {
                    							$rows.eq(i).show();
                    						}
                    					}
                    					});
                    				 /* Pagination Code End */
                    				 }
                    	
                    				 load();
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                                   $('#patient_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
                    
                }
            });    
        }
            
        
        $('#listofpatients').show();
        $('#listofmedicines').hide();
    });
   
   
   
     
}); 

function showDetails(data){
     datapass = (unescape(data).split("$"));    
     console.log("Data pass : : : : : : :"+(datapass));  
     $('#hiddenpatientName').val(datapass[5]);  
    $('#hiddendoctorName').val(datapass[4]);
     $('#hidhospitalName').val(datapass[3]);
     $('#hiddendoctorId').val(datapass[7]);
     $('#hidhospitalId').val(datapass[6]);
      $('#hidappointmentDate').val(datapass[2]);
      $('#hidappointmentId').val(datapass[1]);
      $('#hiddenpatientId').val(datapass[0]);
      
            
    console.log(rootURL + '/fetchAppointmentSpecificPatientMedicines/' + datapass[1] );  
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchAppointmentSpecificPatientMedicines/' + datapass[1],
          dataType: "json",
          success: function(data){
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_consultation_medicines_table tbody").remove();
            console.log("Data List Length "+list.length);
             $.each(list, function(index, responseMessageDetails) {
                  if(responseMessageDetails.status == "Success"){
                       // $('#medicalErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                        //$('#adminStaffErrorBlock').show();
                        userData = responseMessageDetails.data;
                         var trHTML = "";
                        $.each(userData, function(index, userDetails) {
                            
                            console.log(userDetails);
                        //MBF,MAF,ABF,AAF,EBF, EAF 
                        textname = "medicinedist"+index;
                        medicineid = "medicine"+index;
                         medicinename = "medicinename"+index;
                        price = "medicineprice"+index;
                        batch = "medicinebatch"+index;
                        ucost = "unitcost"+index;
                        console.log(userDetails.totalcount);
                        $('#patientname').val(userDetails.patientname);
                        passonvalue = userDetails.id+"$"+userDetails.totalcount+"$"+userDetails.patientid+"$"+userDetails.appointmentid+"$"+escape(userDetails.medicinename)+"$"+escape(userDetails.patientname);
                        btst = '<input type="text" size="3" id='+textname+' name='+textname+' value='+userDetails.totalcount +' onblur="updateCost(this)">'; 
                        hbtst = '<input type="hidden" size="3" id='+medicineid+' name='+medicineid+' value='+passonvalue+'>'; 
                         namebtst = '<input type="hidden" size="3" id='+medicinename+' name='+medicinename+' value="'+userDetails.medicinename+'">'; 
                        pbtst = '<input type="text" size="5" id='+price+' name='+price+'>'; 
                         batchst = '<input type="text" size="10" id='+batch+' name='+batch+' onblur="fetchCost(this)">'; 
                          unitcosts = '<input type="hidden" size="5" id= '+ucost+' name='+ucost+'>';    
                     /*   trHTML += '<tr><td>' + userDetails.medicinename + '</td><td>' + userDetails.noofdays   +'</td><td>' + userDetails.dosage  + 
                      '</td><td>' + userDetails.MBF + '</td><td>' + userDetails.MAF  + '</td><td>' + userDetails.ABF
                      + '</td><td>' + userDetails.AAF  + '</td><td>' + userDetails.EBF  + '</td><td>' + userDetails.EAF  + '</td><td>' + userDetails.totalcount  + '</td><td>'+btst+'</td><td>'+pbtst+'</td><td>'+hbtst+'</td></tr>';  
                            
                     */       
                         trHTML += '<tr><td>' + userDetails.medicinename + '</td><td>' + userDetails.noofdays   +'</td><td>' + userDetails.dosage  + 
                      '</td><td>' +  userDetails.totalcount   + '</td>\n\
                        <td>' +btst + '</td><td>'+batchst+'</td><td>'+pbtst+'</td><td>'+hbtst+'</td><td>'+namebtst+'</td><td>'+unitcosts+'</td></tr>';  
                           
                            $('#hidcount').val(index);
                           $('#hiddenpatientid').val(userDetails.patientid); 
                            $('#hiddenpatientname').val(userDetails.patientname); 
                        });
                         $('#patient_consultation_medicines_table').append(trHTML);
                         $('#patient_consultation_medicines_table').load();
                        
                  }
             });
             $('#listofpatients').hide();
                        $('#listofmedicines').show();
          }
      
    });  
  //  window.location.href = "../medical/medicalindex.php?page=presmedicinelist&appointmentid="+datapass[1];
 //   
}

function fetchCost(obj){
    
    console.log(obj.id);
    console.log(obj.value);
    console.log($('#medicinename0').val());
    var d = obj.id;
    console.log(d.split("medicinebatch"));
     console.log(d.split("medicinebatch",d.length));
     var f= d.split("medicinebatch",d.length);
     console.log(f[1]);
     var td = $('#medicinedist'+f[1]).val();
     $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: rootURL + '/fetchCostBasedOnMedicneNameandOfficeId/'+$('#medicinename'+f[1]).val()+'/'+obj.value,
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                        console.log('authentic success: ' + data.responseMessageDetails.message);
                         if((data.responseMessageDetails.data).length > 0){
                                   console.log('authentic success: ' + (data.responseMessageDetails.data)[0].UnitCost);
                                   console.log(parseInt((data.responseMessageDetails.data)[0].UnitCost)*parseInt(td));
                                      $('#medicineprice'+f[1]).val(parseInt((data.responseMessageDetails.data)[0].UnitCost)*parseInt(td));
                                      
                                      $('#unitcosts'+f[1]).val(((data.responseMessageDetails.data)[0].UnitCost));
                                      
                              }else{
                                  $('#medicineprice'+f[1]).val("0");
                              }
                        },
                error: function(jqXHR, textStatus, errorThrown){
                   
                 }
                
                });
}
function updateCost(obj){
     var d = obj.id;
     var f= d.split("medicinedist",d.length);
     console.log(f[1]);
    var vale = $('#unitcost'+f[1]).val();
    if(vale != ""){
         $('#medicineprice'+f[1]).val(parseInt(vale)*parseInt(obj.value));
    }
}


function fetchnonpresccost(obj){
    count = $('#medicinecount').val();
    if(count != ""){
        console.log(rootURL + '/fetchCostBasedOnMedicneNameandOfficeId/'+$('#medicinename').val()+'/'+obj.value);
    $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: rootURL + '/fetchCostBasedOnMedicneNameandOfficeId/'+$('#medicinename').val()+'/'+obj.value,
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                        console.log('authentic success: ' + data.responseMessageDetails.message);
                         if((data.responseMessageDetails.data).length > 0){
                                   console.log('authentic success: ' + (data.responseMessageDetails.data)[0].UnitCost);
                                   console.log(parseInt((data.responseMessageDetails.data)[0].UnitCost)*parseInt(count));
                                      $('#cost').val(parseInt((data.responseMessageDetails.data)[0].UnitCost)*parseInt(count));
                                      $('#errornonpresmsg').text(" ");
                                     // $('#unitcosts'+f[1]).val(((data.responseMessageDetails.data)[0].UnitCost));
                                      
                              }else{
                                  $('#cost').val("0");
                                  $('#errornonpresmsg').text("Stock unavailable for given batch");
                              }
                        },
                error: function(jqXHR, textStatus, errorThrown){
                   
                 }
                
                });
                
    }else{
        alert("Please enter medicine requirement count");
    }           
}