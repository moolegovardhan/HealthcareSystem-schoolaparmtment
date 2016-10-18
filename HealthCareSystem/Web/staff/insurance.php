
<!-- JS Global Compulsory -->   
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
   <!--script type="text/javascript" src="../config/content/assets/plugins/jquery-1.10.2.min.js"></script-->
   <script type="text/javascript" src="../config/content/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="../config/content/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
   <!-- JS Implementing Plugins -->           
   <script type="text/javascript" src="../config/content/assets/plugins/back-to-top.js"></script>
   <!-- JS Page Level -->           
   <script type="text/javascript" src="../config/content/assets/js/app.js"></script>
   <script type="text/javascript" src="../config/content/assets/js/plugins/datepicker.js"></script>
    <script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
    <script src="../config/content/assets/plugins/pagination/pagination.js"></script>
<div class="panel-body">
    <div class="col-md-12">
    <div class="margin-bottom-40">
         <div class="panel panel-orange">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i>Insurance</h3>
             </div>
             <div class="panel-body"> 
              <form action="" id="sky-form" class="sky-form">
                 <div class="col-md-12">  
                    <fieldset>
                            <label class="label col col-2">Insurance Company Name</label>
                            <section class="col col-4">
                                <label class="input">
                                     <input type="text" id="incurancecompanyname" placeholder="Insurance Company Name"/>
                                  </label>
                            </section>
                            <button type="button" class="btn-u"  name="button" id="getInsuranceCompany" > Search </button>
                            <button type="button" class="btn-u pull-right"  name="button" id="addInsuranceComp" ><span class="glyphicon glyphicon-plus"></span> Add Insurance Company </button>
                     </fieldset>  
                    <fieldset>
                           <section class="col col-md-12">
	                           <div class="panel panel-orange margin-bottom-40">
	                            <div class="panel-heading">
	                                <h3 class="panel-title"><i class="fa fa-edit"></i>Insurance Company List</h3>
	                            </div>
	                            
	                             <table class="table table-striped" id="insurance_data">
		                                <thead>
		                                    <tr>
		                                        <th>#</th>
		                                        <th>Insurance Company Name</th>
		                                        <th>Contact Number</th>
		                                        <th>Email</th>
		                                        <th>Actions</th>
		                                    </tr>
		                                </thead>
		                                <tbody></tbody>
		                            </table>
		                            <div class="paging-container" id="tablePaging"></div>
	                         </div>
                           </section> 
                     </fieldset> 
                   
                 </div>
                 </form>  
             </div>     
        </div>
     </div>
</div>    
    
</div>  


<!-- Edit Hospital Edit Form Start -->
<div class="modal fade" id="editInsuranceCompModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title myModalLabel">Edit Diagnostics</h4>
            </div>
            <div class="modal-body">
            <form  id="profile-form" action="." method="post">
                        <div class="col-md-15">
                          <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Insurance Company Data</h3>
                                
                            </div>
                            
			<input type="hidden" name="insuranceId" id="insuranceId" value="">
          <div class="sky-form" style="width: 50%">
                <fieldset>
                          <section>
                              <label class="input">
                                  <i class="icon-append fa fa-user"></i>
                                   <input type="text" id="insurancecompanyname"  placeholder="Insurance Company Name">
                              </label>
                               <font><i><span id="nameerrormsg"></span></i></font>  
                          </section>

                          <section>
                              <label class="input">
                                  <i class="icon-append fa fa-phone"></i>
                                  <input type="mobile" id="mobile"  placeholder="Mobile #"  maxlength="10">
                              </label>
                                <font><i><span id="mobileerrormsg"></span></i></font>   
                          </section>
                        
                          <section>
                            <label class="input">
                                  <i class="icon-append fa fa-envelope-o"></i>
                                  <input type="email" id="email" placeholder="Email Id">
                               
                              </label>
                               <font><i><span id="emailerrormsg"></span></i></font>  
                          </section>
                  </fieldset>

          </div>     

     </div>
      </div>
      </form>
       		</div>
       		<div class="modal-footer">
       			<button type="button" class="btn-u pull-right"  name="button" id="btnStaffSubmitInsurance">Save Data</button>
       		</div>  
    </div>
 </div>
</div>
 <!-- Edit Hospital Edit Form Start -->
 
 <?php $objLength = count($insuranceList);?>
 <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
 <script>

 function showInsuranceData(insuranceid){
	   // displayErrorResults();
	    
	    var requesturl = "";
	    requesturl = rootURL + '/insuranceDataById/'+insuranceid;
	    
	     console.log(requesturl);
	     
	    $.ajax({
	    type: 'GET',
	    url: requesturl,
	    dataType: "json",
	    success: function(data){
	       console.log('authentic success: ' + data)
	       var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]); 
	        console.log("Data List Length : "+list.length);  
	        $.each(list, function(index, responseMessageDetails) {
	            
	            console.log("Message : "+responseMessageDetails.message);console.log("Status : "+responseMessageDetails.status);
	            if(responseMessageDetails.status == "Success"){
	                
	                if(responseMessageDetails.data.length > 0){
	                	insuranceDataById =   responseMessageDetails.data[0];  
	                    
	                    $('#insurancecompanyname').val(insuranceDataById.insurancecompanyname);
	                    $('#mobile').val(insuranceDataById.contactnumber);
	                    $('#email').val(insuranceDataById.email);
	                    $('#insuranceId').val(insuranceid); 
	                    $('#editInsuranceCompModal').modal('show');
	              }else{
	                  $('#adminErrorMessage').html("<b>Info : No Data found. If error exists please contact admin </b>");
	                  $('#adminErrorBlock').show();
	              }
	            }else {
	                   $('#adminErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
	                   $('#adminErrorBlock').show();
	            }
	            
	        });
	       },
	        error: function(data){
	                        var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

	            $.each(list, function(index, responseErrorMessageDetails) {
	                var message = responseErrorMessageDetails.message;
	                if(message.indexOf("]:") > 0)
	                  message = message.substring(0,message.indexOf("]:")+2);

	                $('#adminErrorMessage').html("<b>Error : </b>"+message);
	                $('#adminErrorBlock').show();
	            });
	        }
		});
	    
	}
 
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var insuranceData = <?php echo json_encode($insuranceList) ?>;
			for (var i = 0; i < objLength; i++) {
				$('#insurance_data tbody').append('<tr class="data"><td>'+(i+1)+'</td><td>'+insuranceData[i].insurancecompanyname+
                		'</td><td>'+insuranceData[i].contactnumber+'</td><td>'+insuranceData[i].email+'</td>'+
                		'<td><button type="button" class="btn btn-warning btn-xs" onclick="showInsuranceData('+insuranceData[i].id+')"><span class="glyphicon glyphicon-edit"></span> Edit</button></td></tr>');
           
				}
			
			load = function() {
				window.tp = new Pagination('#tablePaging', {
					itemsCount: objLength,
					onPageSizeChange: function (ps) {
						console.log('changed to ' + ps);
					},
					onPageChange: function (paging) {
						//custom paging logic here
						console.log(paging);
						var start = paging.pageSize * (paging.currentPage - 1),
							end = start + paging.pageSize,
							$rows = $('#insurance_data tbody').find('.data');

						$rows.hide();

						for (var i = start; i < end; i++) {
							$rows.eq(i).show();
						}
					}
				});
			}

		load();
	});
</script>