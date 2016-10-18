<?php
//session_start();
include_once ('../../Business/MedicalData.php');

$md = new MedicalData();

$testId = $_GET['testId'];
if( isset( $_SESSION['userid'] ) )
   {
      $medicineData = $md->getUnMapDoctorMedicinData();
     
    }
      $medicineCountData = $md->getCountUnMapDoctorMedicinData();
   // echo "dddddddddddddd";echo "<br/>";echo $medicineCountData[0]->count;
   // print_r($medicineCountData[0]->count);
    //echo "heloooooooooo";
    $objLength = count((array)$medicineData);
    
?>
<div class="col-md-12">
	<ul class="search-with-char">
		<?php 
		foreach (range('A', 'Z') as $char) {
			echo '<li><a href="javascript:void(0)">'.$char.'</a></li>';
		}
		?>
		<li><a href="javascript:void(0)">Other</a></li>
	</ul>
</div>
<div class="col-md-12">  
    <fieldset>
       <section class="col col-md-12">
             <input type="button" class="btn-u pull-right"  name="button" id="searchPrescription" onclick="linkMedicineToSingleDoctor('<?php echo $_SESSION['userid'];?>')" value="Map Medicines To Dr <?php echo $_SESSION['logeduser']?>"/> 
           
           <div class="panel panel-orange margin-bottom-40">
                
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Medicines's
                 </h5>
            </div>
            <table class="table table-striped" id="medicine_list_doctor_data_table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Company Name</th>
                        <th>Medicine Name</th>
                        <th> Technical name</th>
                        <th>Type</th>
                        <th>Dosage</th>
                        <th>Units</th>
                        
                    </tr>
                 </thead>
                 <tbody>  
                 <!--  
                     <?php //foreach($medicineData as $value){?>
                        <tr>
                            <td><input type="checkbox" class="link-doctor" id="<?php //echo $value->id; ?>" value="<?php //echo$value->id; ?>"/></td>
                            <td><?php //echo $value->company; ?></td>
                            <td><?php //echo $value->medicinename; ?></td>
                            <td><?php //echo $value->technicalname; ?></td>
                            <td><?php //echo $value->medicinetype; ?></td>
                            <td><?php //echo $value->strength; ?></td>
                            <td><?php //echo $value->units; ?></td>
                        </tr>
                      <?php //}?>
                       -->
                </tbody>
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
                
                    
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company Name</th>
                                    <th>Medicine Name</th>
                                    <th> Technical Name</th>
                                </tr>
                             </thead>    

                                    <tr>

                                        <td>1</td>
                                        <td>DR Reddy</td>
                                        <td>Brufen </td>
                                        <td>Headace</td>
                                    </tr>

                            <tbody>

                            </tbody>
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
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var labDataObj = <?php echo json_encode($medicineData) ?>;
			for (var i = 0; i < objLength; i++) {
				$('#medicine_list_doctor_data_table').append('<tr class="data"><td><input type="checkbox" id="'+labDataObj[i].id+'" class="link-doctor"/></td><td>'+labDataObj[i].company+'</td><td>'+labDataObj[i].medicinename+'</td><td>'+labDataObj[i].technicalname+'</td><td>'+labDataObj[i].medicinetype+'</td><td>'+labDataObj[i].strength+'</td><td>'+labDataObj[i].units+'</td></tr>');
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
							$rows = $('#medicine_list_doctor_data_table').find('.data');

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