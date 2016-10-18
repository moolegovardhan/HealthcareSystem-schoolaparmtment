<?php
//session_start();
include_once ('../../Business/MedicalData.php');

$md = new MedicalData();

if( isset( $_SESSION['userid'] ) )
   {
   	  $userType = 'Doctor';
      //$doctorData = $md->getUserData($userType);
      $doctorData = $md->getMapOfficeDoctorData($_SESSION['officeid']);
    }
    $objLength = count((array)$doctorData);
    //print_r($doctorData);
?>
<div class="col-md-12">  
    <fieldset>
        <section class="col col-md-3">
        	<!-- Added below code by achyuth for getting the Doctors with Doctor Name Sep072015 -->
		    <div class="panel-body"> 
		       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
		         <fieldset>
		            <div class="row">
		                <section class="col">
		                    <label class="input">
		                      <input type="text" id="doctorName"  placeholder="Doctor Name">
		                    </label>
		                    <i><font color="red"><span id="doctorName"></span></font></i>
		                </section>
		                <section class="col">
							<input type="button" class="btn-u pull-right"  name="button" id="searchDoctorsTests" value="Search"/>
		                </section>
		            </div>
		         </fieldset> 
		         </form>
		     </div>
        </section>
        <section class="col col-md-9">
            
           <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Doctor's
                </h5>
            </div>
            <table class="table table-striped" id="doctorsList">
                <thead>
                    <tr>
                        <th>Sl #</th>
                        <th>Doctor Name</th>
                        <th>Hospital Name</th>
                        <th>Details</th>
                        
                    </tr>
                 </thead>    
                 
            </table>
            <div class="paging-container" id="tablePaging"> </div>
        </div> 
      </section>
   </fieldset>  
    
    
    <div class="modal fade" id="myDoctorTestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title doctor-name-text"></h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">                        
                        <table class="table table-striped" id="PatientReportTable">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Test Name</th> 
                                </tr>
                            </thead>
                            <tbody id="doctorPrescription"></tbody></tbody>
                        </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
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
				$('#doctorsList').append('<tr class="data"><td>'+(i+1)+'</td><td id="doctorNameText_'+labDataObj[i].doctorid+'">'+labDataObj[i].DoctorName+'</td><td>'+labDataObj[i].HospitalName+'</td><td><a href="#" onclick="showDoctorTestDetails('+labDataObj[i].doctorid+',<?php echo$_SESSION[officeid]?>)">Details</a></td></tr>');
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
							$rows = $('#doctorsList').find('.data');

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