<?php
//session_start();
include_once ('../../Business/DiagnosticData.php');

$dd = new DiagnosticData();

$testId = $_GET['testId'];
if( isset( $_SESSION['userid'] ) )
   {
      if($testId != ""){
      	$labDataDetails = $dd->getTestData($testId);
      	$exitLabTestData = $dd->getLabDetailData($testId);
      }
      $departments = $dd->getdepartments();
      $measureunits = $dd->getmeasureunits();
    }
   // print_r($labDataDetails);
?>


<div class="col-md-12" id="patientreportss">
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/industrymain.js"></script> 


  <form name="searchreport" action="#" method="POST"   enctype="multipart/form-data">
  
<div class="col-md-12"> 
  <!-- <input type="button" class="btn-u pull-right"  name="button" id="btnAddReportSpecificData" value="View Existing" /> -->
<section id="reportspanel"> 
<?php if($_GET['type'] == "edit"){?>
	<input type="button" class="btn-u pull-right"  name="button" id="SubmitReports" value="Edit" onclick="editLab(<?php echo $testId;?>)"/>
<?php }else{?>
	<input type="button" class="btn-u pull-right"  name="button" id="SubmitReports" value="Submit" onclick="createLab()"/>
<?php }?>    
        
<div class="panel panel-orange  sky-form">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-tasks"></i>New Test</h3>
     </div>
 
<div class="col-md-12">  
    
    <div class="row"> 
        <fieldset>
            <section class="col col-4">
                <label class="input">
                     <input type="text" id="testName"  placeholder="Test Name" value="<?php if(isset($labDataDetails[0]->testname)){
    echo $exitLabTestData[0]->testname;}?>" required />
                 </label>
                <font><i><span id="reporterrormsg"></span></i></font> 
             </section> 
             <section class="col col-4">
                <label class="select">
                   <select id="department" class="form-control" required>
    					<option value="0">-- Select Department --</option>
    					<?php foreach($departments as $value){ 
    					if(isset($labDataDetails[0]->department)){
    						if($labDataDetails[0]->department == $value->id){
    					?>
                       <option value="<?php echo $value->id?>" selected="slected"><?php echo $value->departmentname?></option>
                       <?php }else{ ?>
                       <option value="<?php echo $value->id?>" ><?php echo $value->departmentname?></option>
                       <?php }}else{ ?>
                       	<option value="<?php echo $value->id?>" ><?php echo $value->departmentname?></option>
                       <?php }} ?>
                    </select>
                 </label>
                <font><i><span id="reporterrormsg"></span></i></font> 
             </section>
        </fieldset>
        <fieldset>
            <section class="col col-4">
                <label class="input">
                    <input type="text" id="parameterName"  placeholder="Parameter Name" value="<?php if(isset($exitLabTestData[0]->parametername)){
    echo $exitLabTestData[0]->parametername;}?>" required />
                </label>
            </section>
            
            <section class="col col-4" >
                <label class="select">
                    <select id="units" class="form-control" required>
    					<option value="0">-- Select Units --</option>
    					<?php foreach($measureunits as $value){ 
    					if(isset($exitLabTestData[0]->unitsid)){
    						if($exitLabTestData[0]->unitsid == $value->id){
    					?>
                       <option value="<?php echo $value->id?>" selected="slected"><?php echo $value->displayname?></option>
                       <?php }else{ ?>
                       <option value="<?php echo $value->id?>" ><?php echo $value->displayname?></option>
                       <?php }}else{ ?>
                       	<option value="<?php echo $value->id?>" ><?php echo $value->displayname?></option>
                       <?php }} ?>
                    </select>
                    
                    
                 </label>
                <font><i><span id="reporterrormsg"></span></i></font> 
             </section> 
             <section class="col col-4">
                <label class="input">
                    <input type="text" id="comments"  placeholder="Comments" value="<?php if(isset($exitLabTestData[0]->comments)){
    echo $exitLabTestData[0]->comments;}?>" required />
                </label>
            </section>
             <section class="col col-4">
                <label class="input">
                    <input type="text" id="addInputs"  placeholder="Additional Input " value="<?php if(isset($exitLabTestData[0]->addinputs)){
    echo $exitLabTestData[0]->addinputs;}?>" required />
                </label>
            </section>
             <section class="col col-4">
                <label class="input">
                    <textarea cols="50" rows="3" id="bioref" placeholder="Bio Reference" required><?php if(isset($exitLabTestData[0]->bioref)){ echo $exitLabTestData[0]->bioref;}?></textarea>
                </label>
            </section>
            <!--section class="col col-2">
                <label class="input">
                   
                    <input type="text" id="biorefmin" placeholder="Min" >
                </label>
            </section>
            <section class="col col-2">
                <label class="input">
                   <input type="text" id="biorefmax" placeholder="Max">  
                </label>
            </section-->
             <input type="button" class="btn-u pull-right"  name="button" id="btnAddReportSpecificData" value="Add Parameters Data" onclick="addParamaters()"/>
        	<input type="hidden" value="" id="lastInsertId" />
        </fieldset>
        
    </div>
    <input type="hidden" id="tableValue">
    <div class="row">
        <div class="panel panel-primary margin-bottom-40" id="patient_records_repords_table">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-globe"></i>Tests Data</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover" id="patient_records_reports_table">
                            <thead>
                                 <tr>
                                     <th>Parameter Name</th>
                                    <th>Units</th>
                                    <th>Comments</th>
                                    <th>Additional Inputs</th>
                                    <th>Biological References</th>
                                     <!--th>References Minimum</th>
                                      <th>References Maximum</th-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody id="paramsData">
                            	<?php if($_GET['type'] == "edit" || $_GET['type'] == "copy"){?>
                            	<?php foreach($exitLabTestData as $paramData){?>
                            	<tr id="<?php echo $paramData->id; ?>">
                            		<td><?php echo $paramData->parametername; ?></td>
                            		<td><?php echo $paramData->unitsid; ?></td>
                            		<td><?php echo $paramData->comments; ?></td>
                            		<td><?php echo $paramData->addinputs; ?></td>
                            		<td><?php echo $paramData->bioref; ?></td>
                            		<td><a href="javascript:editParams(<?php echo $paramData->id; ?>)">Edit</a></td>
                            	</tr>
                            	<?php } }?>
                            </tbody>
                            
                        </table>
                    </div>                      
                </div>
    </div>
    
    <input type="hidden" id="indexValue" name="indexValue" value="0" />
    <input type="hidden" id="createdby" name="createdby" value="<?php echo $_SESSION['userid'];?>" />
    <input type="hidden" id="officeId" name="officeId" value="<?php echo $_SESSION['officeid'];?>" />
    <input type="hidden" id="pageType" name="pageType" value="<?php echo $_GET['type'];?>" />
    <input type="hidden" id="lastInserteID" name="lastInserteID" value="" />
    
    
</div> 
   
</div>    
    
</div>
</section>
</fieldset>
</div>
      <div id="hiddendatagroup">
        <input type="hidden"  name="counter" id="counter" />
    </div>
</form>
</div>

<div class="modal fade" id="paramEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title myModalLabel">Edit Parameter Data</h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">                        
                        <table class="table table-striped" id="PatientReportTable">
                            <thead>
                                <tr>
                                    <th>Parameter Name</th>
                                    <th>Units</th> 
                                    <th>Comments</th> 
                                    <th>Additional Inputs</th> 
                                    <th>Biological References</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" value="" id="parameterNameField" class="field-text" required /></td>
                                    <td><input type="text" value="" id="unitsField" class="field-text" required /></td> 
                                    <td><input type="text" value="" id="commentsField" class="field-text" required /></td> 
                                    <td><input type="text" value="" id="additionalInputsField" class="field-text" required /></td> 
                                    <td><input type="text" value="" id="bioRefField" class="field-text" required /></td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                	<input type="hidden" id ="testParamId" value="" />
                    <button data-dismiss="modal" class="btn-u btn-u-orange" type="button" onclick="updateParamsData()" id="editData">Edit</button>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>