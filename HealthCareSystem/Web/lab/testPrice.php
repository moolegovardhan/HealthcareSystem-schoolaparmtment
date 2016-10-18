<?php
//session_start();
include_once ('../../Business/DiagnosticData.php');

$dd = new DiagnosticData();
if( isset( $_SESSION['userid'] ) )
   {
      $userId = $_SESSION['userid']; 
      $labDataDetails = $dd->getMapedLabData($_SESSION['officeid']);
	  //print_r($labDataDetails);
      
    }
    $objLength = count((array)$labDataDetails);
    //var_dump($labDataDetails);
?>
<div class="col-md-12">  
    <fieldset>
        <section class="col col-md-3">
        	<!-- Added below code by achyuth for getting the Tests prices with Test Name Sep072015 -->
    <div class="panel-body"> 
       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="testName1"  placeholder="Test Name">
                    </label>
                    <i><font color="red"><span id="testName1"></span></font></i>
                </section>
                <section class="col">
					<input type="button" class="btn-u pull-right"  name="button" id="searchTestPrice" value="Search"/>
                </section>
            </div>
         </fieldset> 
         </form>
     </div>
     <!-- End of achyuth's code Sep072015  -->
        </section>
        <section class="col col-md-9">
            <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
            	<h5 class="panel-title"><i class="fa fa-edit"></i>List of Tests</h5>
            </div>
            <table class="table table-striped" id="testPrices">
                <thead>
                    <tr>
                        <th>Test ID</th>
                        <th>Test Name</th>
                        <th>Department</th>
                         <th>Price</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                 </thead>  
            </table>
            <div class="paging-container" id="tablePaging"> </div>
        </div> 
      </section>
   </fieldset>  
    
    <div class="modal fade" id="myTestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title myModalLabel"></h4>
                </div>
                <div class="modal-body">
                 <!--  <h5 id="recordData"></h5> --> 
                    <div class="panel panel-orange margin-bottom-40"> 
                        <table class="table table-striped" id="testPriceDetailsTable">
                            <thead>
                                <tr>
                                    <th>Base Price</th>
                                    <th>Discount {%}</th> 
                                    <th>Tax 1</th> 
                                    <th>Tax 2</th> 
                                    <th>Tax 3</th> 
                                    <th>Tax 4</th> 
                                    <th>Tax 5</th>
                                    <th>Effected Date</th> 
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            	<tr>
                                     <th colspan="6"><b><center>Total</center></b></th>
                                     <td colspan="2" ><b id="totalPriceView"></b></td> 
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
    
    <div class="modal fade" id="testPriceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title myModalLabel"></h4>
                </div>
                <div class="modal-body">
                <h5 id="editRecordData"></h5>
                    <div class="panel panel-orange">                        
                        <table class="table table-striped test-price-form" id="PatientReportTable">
                            <tbody>
                            	<tr>
                            		<td><input type="number" value="" size="7" id="price" class="field-text" placeholder="Price" required /></td>
                                    <td><input type="number" value="" size="7" id="discount" class="field-text" placeholder="Discount {%}" required /> </td> 
                                    <td><input type="number" value="" size="7" id="tax_1" class="field-text" placeholder="Tax 1" required /></td> 
                                    <td><input type="number" value="" size="7" id="tax_2" class="field-text" placeholder="Tax 2" required /></td> 
                            	</tr>
                                <tr>
                                    <td><input type="number" value="" size="7" id="tax_3" class="field-text" placeholder="Tax 3" required /></td> 
                                    <td><input type="number" value="" size="7" id="tax_4" class="field-text" placeholder="Tax 4" required /></td> 
                                    <td><input type="number" value="" size="7" id="tax_5" class="field-text" placeholder="Tax 5" required /></td>
                                    <td>
                                    	<section class="col col-4">
						                    <label class="input">
						                        <i class="icon-append fa fa-calendar"></i>
						                        <input type="text" name="start" id="start" placeholder="Effected Date" required readonly>
						                    </label>
					                   </section>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                            	<tr>
                                     <td colspan="2"><b><center>Total</center></b></th>
                                     <td colspan="2" ><b id="totalPriceEdit"></b></td> 
                                </tr>
                            </tfoot>
                        </table>
                        <input type="hidden" value="<?php echo $_SESSION['officeid'];?>" id="officeId" />
                        <input type="hidden" value="<?php echo $_SESSION['userid'];?>" id="userId" />
                        <input type="hidden" value="" id="testId" />
                        <input type="hidden" value="" id="diagnosticsTestId" />
                    </div>
                    
                    <div id="testPriceHistoryData" style="display:none;">
	                    <div class="modal-header">
	                    <h4 class="modal-title myModalLabel">History</h4>
	               		 </div>
	                    <div class="panel panel-orange" >
	                    	<table class="table table-striped" id="PatientReportTable">
		                            <thead>
		                                <tr>
		                                    <th>Price</th>
		                                    <th>Discount {%}</th> 
		                                    <th>Tax 1</th> 
		                                    <th>Tax 2</th> 
		                                    <th>Tax 3</th> 
		                                    <th>Tax 4</th> 
		                                    <th>Tax 5</th> 
		                                    <th>Created Date</th> 
		                                </tr>
		                            </thead>
		                            <tbody id="testPriceHistoryDataTr"></tbody>
	                            </table>
	                    </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                      <button data-dismiss="modal" class="btn-u btn-u-orange" type="button" onclick="saveTestPrice()" id="saveData">Submit</button>
                      <button data-dismiss="modal" class="btn-u btn-u-orange" type="button" onclick="saveTestPrice()" id="editData">Save</button>
                      <button class="btn-u btn-u-brown" type="button" onclick="showPriceHistory()">History</button>
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
		var labDataObj = <?php echo json_encode($labDataDetails) ?>;
               // console.log("+labDataObj"+labDataObj);
			for (var i = 0; i < objLength; i++) {
				$('#testPrices').append('<tr class="data"><td>000'+labDataObj[i].testid+'</td><td id="name_'+labDataObj[i].testid+'">'+labDataObj[i].testname+'</td><td>'+labDataObj[i].departmentname+'</td><td>'+labDataObj[i].finalprice+'</td>\n\
                        <td><a href="#" onclick="showTestPriceDetails('+labDataObj[i].id+')">Details</a></td><td><a href="#" onclick="addTestPriceDetails('+labDataObj[i].testid+','+labDataObj[i].id+')">Add</a>\n\
                        &nbsp;&nbsp;<a href="#" onclick="editTestPriceDetails('+labDataObj[i].testid+','+labDataObj[i].id+')">Edit</a></td></tr>');
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
							$rows = $('#testPrices').find('.data');

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