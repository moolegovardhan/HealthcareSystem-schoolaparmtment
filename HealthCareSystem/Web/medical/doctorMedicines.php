<?php
//session_start();
include_once ('../../Business/MedicalData.php');

$md = new MedicalData();

if( isset( $_SESSION['userid'] ) )
   {
   	  $userType = 'Doctor';
      $doctorData = $md->getDoctorData($userType);
    }
    $objLength = count((array)$doctorData);
    //print_r($doctorData);
?>
<div class="row">
<div class="col-md-3">
	<!-- Added below code by achyuth for getting the Doctors with Doctor Name Sep072015 -->
    <div class="panel-body"> 
       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="doctorName1"  placeholder="Doctor Name">
                    </label>
                    <i><font color="red"><span id="doctorName1"></span></font></i>
                </section>
                <section class="col">
					<input type="button" class="btn-u pull-right"  name="button" id="searchDoctorsMedicine" value="Search"/>
                </section>
            </div>
         </fieldset> 
         </form>
     </div>
</div>
<div class="col-md-9">  
    <fieldset>
       <section class="col col-md-12">
            
           <div class="panel panel-orange margin-bottom-40">
           <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Doctor's
                 </h5>
            </div>
            <table class="table table-striped" id="doctorMedicine">
                <thead>
                    <tr>
                        <th>Sl #</th>
                        <th>Doctor Name</th>
                        <th>Hospital Name</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                 </thead> 
            </table>
            <div class="paging-container" id="tablePaging"></div>
        </div> 
      </section>
   </fieldset>  
    
    
    <div class="modal fade" id="myDoctorMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Medicines</h4>
                </div>
                <div class="modal-body">
                        <table class="table table-striped" id="doctorsMedicines">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company Name</th>
                                    <th>Medicine Name</th>
                                    <th> Technical Name</th>
                                </tr>
                             </thead>    
                            <tbody id="medicinDoctor"></tbody>
                        </table>
                </div>
                <div class="modal-footer">
                     <button data-dismiss="modal" class="btn-u btn-u-orange" type="button">Submit</button>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
    
</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var labDataObj = <?php echo json_encode($doctorData) ?>;
			for (var i = 0; i < objLength; i++) {
				$('#doctorMedicine').append('<tr class="data"><td>'+(i+1)+'</td><td>'+labDataObj[i].name+'</td><td>'+labDataObj[i].name+'</td><td><a href="#" onclick="ShowDoctorMedicinesList('+labDataObj[i].ID+')">Details</a></td><td><a href="medicalindex.php?page=mapdoctormedicines&doctorId='+labDataObj[i].ID+'&name='+labDataObj[i].name+'">Map Medicines</a></td></tr>');
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
							$rows = $('#doctorMedicine').find('.data');

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