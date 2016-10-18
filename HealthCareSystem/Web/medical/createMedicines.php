<?php
//session_start();
include_once ('../../Business/MedicalData.php');

$md = new MedicalData();

$testId = $_GET['testId'];
if( isset( $_SESSION['userid'] ) )
   {
      $measureunits = $md->getmeasureunits();
      //$medicineData = $md->getMedicinData($medicineId = "");
      $medicineData = $md->getUnMapMedicinData();
    }
    $objLength = count((array)$medicineData);
   // echo $objLength;
   //print_r($medicineData);
?>
<div class="row">
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
<div class="col-md-3">
	<!-- Added below code by achyuth for getting the Medicine with Medicine Name Sep072015 -->
    <div class="panel-body"> 
       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="medicineName"  placeholder="Medicine Name">
                    </label>
                    <i><font color="red"><span id="medicineName"></span></font></i>
                </section>
                <section class="col">
					<input type="button" class="btn-u pull-right"  name="button" id="searchMedicine1" value="Search"/>
                </section>
            </div>
         </fieldset> 
         </form>
     </div>
     <!-- End of achyuth's code Sep072015  -->
</div>
<div class="col-md-9">  
    <fieldset>
       <section class="col col-md-12">
            
           <div class="panel panel-orange margin-bottom-40">
            <input type="button" class="btn-u pull-right"  name="button" id="searchPrescription" onclick="showMedicineAdd()" value="Add New"/> 
            <input type="button" class="btn-u pull-right"  name="button" id="searchPrescription" value="Link Medicines to Center" onclick="linkToShop()"/> 
                
            <div class="panel-heading">
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Medicines's</h5>
            </div>
            <!-- Added id for table medicine_list_data_table by achyuth on Sep072015 -->
            <table class="table table-striped" id="medicine_list_data_table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Company Name</th>
                        <th>Medicine Name</th>
                        <th>Technical Name</th>
                        <th>Medicine Type</th>
                        <th>Dosage</th>
                        <th>Units</th>
                    </tr>
                 </thead>
            </table>
            <div class="paging-container" id="tablePaging"></div>
        </div> 
      </section>
   </fieldset>  
    
    
    <div class="modal fade" id="myMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Medicines</h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">                        
                <form name="searchreport" action="#"  id="sky-form" class="sky-form"  method="POST"   enctype="multipart/form-data">
  
                        <fieldset>
                              <section class="col col-4">
                                <label class="input">
                                    <input type="text" id="companyName"  placeholder="Company Name">
                                </label>
                            </section>
                             <section class="col col-4">
                                <label class="input">
                                    <input type="text" id="newMedicineName"  placeholder="Medicine Name">
                                </label>
                            </section>
                             <section class="col col-4">
                                <label class="input">
                                    <input type="text" id="technicalName"  placeholder="Technical Name">
                                </label>
                            </section>
                             <section class="col col-4">
                                <label class="input">
                                    <input type="text" id="dosage"  placeholder="Dosage">
                                </label>
                            </section>
                           <section class="col col-4">
                            <label class="select">
                               <select id="medicineType" class="form-control" required>
                               		<option value="1">-- Select Type --</option>
                                   <option value="1">Capsules</option>
                                   <option value="2">Syrup</option>
                                   <option value="3">Tablet</option>
                                </select>
                             </label>
                            <font><i><span id="reporterrormsg"></span></i></font> 
                         </section>
                         <section class="col col-4">
                            <label class="select">
                               <select id="units" class="form-control" required>
                                   <option value="0">-- Select Units --</option>
			    					<?php foreach($measureunits as $value){ ?>
			                       	<option value="<?php echo $value->id?>" ><?php echo $value->displayname?></option>
			                       <?php } ?>
                                </select>
                             </label>
                            <font><i><span id="reporterrormsg"></span></i></font> 
                         </section>   
                            
                        </fieldset>
                </form>   
                    </div>
                
                </div>
                <div class="modal-footer">
                	<input type="hidden" id="userId" value="<?php echo $_SESSION['userid']; ?>" />
                     <button data-dismiss="modal" class="btn-u btn-u-orange" type="button" onclick="createMedicin()">Submit</button>
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
		var labDataObj = <?php echo json_encode($medicineData) ?>;
			for (var i = 0; i < objLength; i++) {
				$('#medicine_list_data_table').append('<tr class="data"><td><input type="checkbox" id="'+labDataObj[i].id+'" class="link-shop"/></td><td>'+labDataObj[i].company+'</td><td>'+labDataObj[i].medicinename+'</td><td>'+labDataObj[i].technicalname+'</td><td>'+labDataObj[i].medicinetype+'</td><td>'+labDataObj[i].strength+'</td><td>'+labDataObj[i].displayname+'</td></tr>');
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
							$rows = $('#medicine_list_data_table').find('.data');

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
