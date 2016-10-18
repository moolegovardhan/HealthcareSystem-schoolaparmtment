<?php session_start(); ?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/industrymain.js"></script> 

<?php

include_once ('../../Business/DiagnosticData.php');


$dd = new DiagnosticData();
if( isset( $_SESSION['userid'] ) )
   {
      $userId = $_SESSION['userid']; 
       $officeid = $_SESSION['officeid']; 
      $labDataDetails = $dd->getIndustryMapedTestData($officeid);
      $testGroup = $dd->fetchIndustryTestGroup($officeid);
      
    }
	$objLength = count((array)$labDataDetails);
	//var_dump($labData);
?> 
        
<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" id="userId">
<input type="hidden" value="<?php echo $_SESSION['officeid']; ?>" id="officeId">
<div class="col-md-12">  
     <form action="../../Business/MapTestToIndustry.php" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data"> 
    <fieldset>
        <section class="col col-md-3">
        <!-- Added below code by achyuth for getting the Tests with Test Name Sep072015 -->
	    <div class="panel-body"> 
                
	         
	     </div>
        <!-- End of achyuth's code Sep072015  -->
        </section>
        <section class="col col-md-12">
            
                <button data-dismiss="modal" class="btn-u btn-u-orange pull-right" type="submit"  >Link to Group</button>
            <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Tests</h5>
            </div>
            
            <table class="table table-striped" id="testsdata">
                     <tr>
                        <th></th>
                        <th>Test ID</th>
                        <th>Test Name</th>
                        <th>Department</th>
                        <th>Group</th>
                    </tr>
                    <tbody>
                        <?php $counter = 0; 
                          foreach($labDataDetails as $test){
                        ?>
                        <tr>
                            <td><input type="checkbox"  name="rowid<?php  echo $counter; ?>" value="<?php  echo $test->rowid; ?>" class="link-test"/></td>
                            <td><?php  echo $test->id;  ?></td>
                            <td><?php  echo $test->testname;  ?></td>
                            <td><?php  echo $test->departmentname;  ?></td>
                            <td>
                                <select name="group<?php  echo $counter; ?>">
                                    <option value="nodata">--Select Test Group--</option>   
                                    <?php 
                                        foreach($testGroup as $group){
                                            $selected = "";
                                           
                                            $testgroup = $test->groupid;
                                            $groupid = $group->id;
                                             if(($groupid == $testgroup)){
                                                 $selected = "selected";
                                             }
                                            // echo "Selected.................................".$selected;
                                      ?>
                                             <option <?php echo $selected; ?>  value="<?php  echo $group->id;  ?>"><?php  echo $group->groupname;  ?></option>
                                    <?php
                                        
                                          }
                                        ?>
                                </select>
                                
                            </td>
                        </tr>
                        <?php
                        $counter = $counter+1;
                          }
                        
                        ?>
                    </tbody>
        </table>
                <input type="hidden" name="counter"  value="<?php  echo $counter; ?>"/>
        <div class="paging-container" id="tablePaging"> </div>
        </div> 
      </section>
   </fieldset>  
    
    
    <div class="modal fade" id="myTestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Test Details</h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">                        
                        <table class="table table-striped" id="PatientReportTable">
                            <thead>
                                <tr>
                                    <th>Parameter Name</th>
                                    <th>Biological References</th> 
                                    <th>Units</th> 
                                    <th>Comments</th> 
                                    <th>Additional Inputs</th> 
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
    </form>
</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var labDataObj = <?php echo json_encode($labDataDetails) ?>;
			for (var i = 0; i < objLength; i++) {
			//	$('#testsdata').append('<tr class="data"><td><input type="checkbox" name="1" id="'+labDataObj[i].id+'" class="link-test"/></td><td>000'+labDataObj[i].id+'</td><td>'+labDataObj[i].testname+'</td><td>'+labDataObj[i].departmentname+'</td><td><a href="#" onclick="showTestDetails('+labDataObj[i].id+')">Details</a></td></tr>');
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
							$rows = $('#testsdata').find('.data');

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