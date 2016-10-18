<?php
session_start();

include_once '../../Business/MasterData.php';
$patientId = $_GET['memberid'];
       $consultations = $md->patientConsultationHistory($patientId);

?>
<div class="col-md-15">  
                        
            <div class="panel panel-orange margin-bottom-40">
            <div class="panel-heading">
                <h5 class="panel-title"><i class="fa fa-edit"></i>Consultations History
                
                   
                </h5>
            </div>
            <table class="table table-striped" id="">
                <thead>
                    <tr>
                       <th>Patient Id</th>
                       <th>Patient Name</th>
                        <th>Appointment Date</th>
                        <th>Time</th>
                        <th>Doctor Name</th>
                        <th>Hospital Name</th>
                         
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        
                    </tr>
                 </thead>    
                     <?php foreach ($consultations as $value) { ?>
                        <tr>
                           <td nowrap><?php echo $value->patientid;  ?></td>
                           <td nowrap><?php echo $value->patientname;  ?></td>
                            <td nowrap><?php echo $value->dispdate;  ?></td>
                            <td nowrap><?php echo $value->AppointmentTime;  ?></td>
                            <td nowrap><?php echo $value->DoctorName; ?></td>
                            <td nowrap><?php echo $value->HospitalName; ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="showFamilyPrescription('<?php echo $value->id; ?>')">Prescription</a><?php } ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="showFamilyReports('<?php echo $value->id; ?>')">Report</a><?php } ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="showFamilyMedicines('<?php echo $value->id; ?>')">Medicine</a><?php } ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="generatePDF('<?php echo $value->id; ?>')">Download</a><?php } ?></td>
                        </tr>
                    <?php } ?> 
               
                <tbody>

            </tbody>
        </table>
    </div>         

     </div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>

var toMmDdYy = function(input) {
    var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
    if(!input || !input.match(ptrn)) {
        return null;
    }
    return input.replace(ptrn, '$2/$3/$1');
};

//toMmDdYy('2015-01-25');//prints: "01/25/2015"
//toMmDdYy('2000-12-01');//"12/01/2000"

	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var medicineDataObj = <?php echo json_encode($medicinesDetails) ?>;
		if(objLength > 0)
		{


			for (var i = 0; i < objLength; i++) {
				var checkVal = medicineDataObj[i].medicinename+"#"+medicineDataObj[i].doctorname+"#"+medicineDataObj[i].noofdays+"#"+medicineDataObj[i].totalcount+"#"+medicineDataObj[i].id+"#"+medicineDataObj[i].appointmentid+"#"+medicineDataObj[i].doctorname+"#"+medicineDataObj[i].DoctorId;
					checkVal = encodeURIComponent(checkVal);
					console.log(checkVal);
				textboxname = i+"medicinecount"
				$('#staff_hosiptal_NonActive_data').append('<tr class="data"><td><input type="checkbox" value='+checkVal+' name="'+i+'"/></td><td>'+medicineDataObj[i].medicinename+'</td><td>'+medicineDataObj[i].doctorname+'</td><td>'+medicineDataObj[i].noofdays+'</td><td>'+medicineDataObj[i].totalcount+'</td><td>'+toMmDdYy(medicineDataObj[i].AppointementDate)+'</td>\n\
                                        <td><input type="text" name="'+textboxname+'" id="'+textboxname+'"></td></tr>');

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
							$rows = $('#staff_hosiptal_NonActive_data').find('.data');

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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Prescription </h4>
                </div>
                <div class="modal-body">
                
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap">
                       <table class="tg" id="PatientPrescriptionTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr" nowrap>Doctor Observation</th>
                            <th class="tg-uhkr">Suggestions</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>
                            <input type="hidden" id="hidmymodalappointmentid" />
                        </table></div>
                   <div class="tg-wrap">
                       <table class="tg" id="PatientDiseasesTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr" nowrap>Diseases Name</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>
                        </table></div>
                  
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

<div class="modal fade" id="myReportsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Reports</h4>
                </div>
                <div class="modal-body">
                
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap">
                       <table class="tg" id="PatientReportsTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Report Name</th>
                            <th class="tg-uhkr">Parameter Name</th>
                            <th class="tg-uhkr">Value</th>
                            <th class="tg-uhkr">Reference</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>



<div class="modal fade" id="myFamilyMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Medicines</h4>
            </div>
            <div class="modal-body">

                <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap"><table class="tg" id="PatientMedicineTable">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Medicine Name</th>
                            <th class="tg-uhkr">Usage</th>
                            <th class="tg-uhkr" colspan="2">Morning {Breakfast}</th>
                            <th class="tg-uhkr" colspan="2">Afternoon {Meal}</th>
                            <th class="tg-uhkr" colspan="2">Night {Meal}</th>
                            <th class="tg-uhkr">Days #</th>
                          </tr>
                          <tr>
                            <td class="tg-031e"></td>
                            <td class="tg-031e"></td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-031e"></td>
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>

