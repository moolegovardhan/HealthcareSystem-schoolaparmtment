<?php
session_start();
$md = new PatientData();
$ad = new AppointmentData();
//echo "user id ....".$_SESSION['userid'];
//$result = $ad->fetchMedicinesForPatient($_SESSION['userid']);
//$medicinesDetails = json_decode($result);
$medicinesDetails = $md->patientMedicinces();
$objLength = count((array)$medicinesDetails);

//print_r($medicinesDetails);

?>
<div class="col-md-12">
    <form action="../../Business/SubmitMedicines.php" method="POST" name="patientmedicines"> 
    <?php if(count($medicinesDetails) > 0){?>
     <div  class="pull-right">
             <input type="submit" value="Order Medicines" class="btn-u btn-u-primary" id="orderMedicines"/>
     </div> <input type="hidden" name="countcloumn" value="<?php echo count($medicinesDetails);?>"/>
       
    <?php } ?>   
    <div class="panel panel-orange margin-bottom-40">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-edit"></i>Medicines List
            
            </h3>
               
        </div>
        <table class="table table-striped" id="staff_hosiptal_NonActive_data">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Medicines Name</th>
                    <th>Doctor Name</th>
                    <th>No Of Days</th>
                    <th>Total Count</th>
                    <th>Appointment Date</th>
                    <th>Quantity Required</th>
                </tr>
            </thead>
           
            
        </table>
        <div class="paging-container" id="tablePaging"></div>
        
     </div>
    </form>
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