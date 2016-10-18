<?php
session_start();
include_once '../../Business/MasterData.php';
include_once '../../Business/MedicalData.php';
$mdd = new MedicalData();

$medicineList = $mdd->getTodaysMedicineData($_SESSION['officeid']);
$objLength = count((array)$medicineList);

?>
<div class="container content" style="padding-top: 20px;">
		
		<div class="row" id="medicalHomeData">
			<section class="col col-md-12">
                      		<!--div class="collapse navbar-collapse navbar-responsive-collapse">
				                 <ul class="nav navbar-nav">
				                       <li><a href="javascript:showAppoinmentDataTab()">Appointments</a></li>
				                       <li><a href="javascript:void(0);">Inventory</a></li>
				                 </ul>
				             </div--> 
							<div class="panel panel-orange  sky-form">
								<div class="panel-heading">
									<h3 class="panel-title">
										<i class="fa fa-tasks"></i>List of Medicines
									</h3>
								</div>
								<table class="table table-bordered table-hover" id="medicine_records_search_result_table1">
									<thead>
										<tr>
											<th>Appointment ID</th>
											<th>Patient Name</th>
											<th>Medicine Name</th>
											<th>Patient ID</th>
											<th>Visit Date</th>
											<!-- <th>Action</th> -->
										</tr>
									</thead>
								</table>
								<div class="paging-container" id="tablePaging"></div>
							</div>
						</section>
		</div>
		
		<div class="row" id="appoinmentTabData" style="margin-top:30px; display: none;">
		<div class="md-col-3">
		<?php  include_once('leftmenu.php');  ?>
		</div>
                      <section class="col col-md-9">
							<div class="panel panel-orange  sky-form">
								<div class="panel-heading">
									<h3 class="panel-title">
										<i class="fa fa-tasks"></i>Medicine search result
									</h3>
								</div>
								<table class="table table-bordered table-hover"
									id="medicine_records_search_result_table">
									<thead>
										<tr>
											<th>Appointment ID</th>
											<th>Patient Name</th>
											<th>Medicine Name</th>
											<th>Patient ID</th>
											<th>Visit Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="medicineList">
									</tbody>
								</table>
							</div>
						</section>
					</div>
					</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var labDataObj = <?php echo json_encode($medicineList) ?>;
		if(objLength > 0)
		{
			for (var i = 0; i < objLength; i++) {
				$('#medicine_records_search_result_table1').append('<tr class="data"><td>'+labDataObj[i].appointmentid+'</td><td>'+labDataObj[i].PatientName+'</td><td>'+labDataObj[i].medicinename+'</td><td>'+labDataObj[i].patientid+'</td><td>'+labDataObj[i].AppointementDate+'</td></tr>');
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
							$rows = $('#medicine_records_search_result_table1').find('.data');

						$rows.hide();

						for (var i = start; i < end; i++) {
							$rows.eq(i).show();
						}
					}
				});
			}

			load();
		}
		else
		{
			$('#medicine_records_search_result_table1').append('<tr class="data"><td colspan="5" style="text-align:center">No Data found</td>');
		}
	});
</script>