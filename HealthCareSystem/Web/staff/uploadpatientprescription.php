<div class="col-md-8" >
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/searchprescription.js"></script>
<script>
    $(document).ready(function(){ 
     $( "#start" ).datepicker({  minDate: 0, maxDate: "+2M", 
      // changeMonth: true,
      // changeYear: true,
       yearRange:'+0:+0',
       hideIfNoPrevNext: true,
       "dateFormat": 'dd.mm.yy',
       nextText:'<i class="fa fa-angle-right"></i>',
       prevText:'<i class="fa fa-angle-left"></i>',
        weekHeader: "W"});
    }); 
</script>
<div class="col-md-15"> 
<fieldset> 
    <section class="col-md-15">    
<?php include_once 'prescriptionsearch.php'; ?>
    </section>
</fieldset>
 <form action="../../Business/StaffPrescriptionUpload.php" method="POST" enctype="multipart/form-data">     
   
<fieldset>  
  
<section id="prescriptionpanel"> 
    <input type="submit" class="btn-u pull-right"  name="button" id="showPrescriptionSearch" value="Submit"/>     
    
    <input type="button" class="btn-u pull-right"  name="button" id="showPrescriptionSearchResult" value="Search Result"/> 
    
       
<div class="panel panel-orange  sky-form">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-tasks"></i>Prescription Details</h3>
     </div>
    
 
    <div class="col-md-12">  
    <div class="row"> 
    <div class="col-md-12">  

        <fieldset>
              <div class="row">
                  <section class="col col-6">
                    <label class="label"><b>Patient Name :   </b>
                        <span id="prespatientName"><i></i></span></label>
                        <input type="hidden" name="hiddenpatientName" id="hiddenpatientName"/>
                        <input type="hidden" name="hidappointmentId" id="hidappointmentId"/> 
                       <input type="hidden" name="hiddenpatientId" id="hiddenpatientId"/> 
                </section>
                <section class="col col-6">
                    <label class="label"><b>Hospital Name :   </b>
                        <span id="hospitalName"><i></i></span></label>
                         <input type="hidden" name="hidhospitalName" id="hidhospitalName"/>
                           <input type="hidden" name="hidhospitalId" id="hidhospitalId"/>
                </section> 
              </div>
             <div class="row">
                  <section class="col col-6">
                    <label class="label"><b>Doctor Name :  </b>
                        <span id="doctorName"><i></i></span>
                         <input type="hidden" name="hiddendoctorName" id="hiddendoctorName"/>
                          <input type="hidden" name="hiddendoctorId" id="hiddendoctorId"/> 
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label"><b>Appointment Date : </b>
                        <span id="appointmentDate"><i></i></span>
                         <input type="hidden" name="hidappointmentDate" id="hidappointmentDate"/>
                    </label>
                </section>    
                 </div>
             <div class="row">
                <section class="col col-6">
                     <label class="input"> 
                           <i class="icon-append fa fa-calendar"></i>
                           <input type="text" name="start" id="start" placeholder="Next Appointment date">
                            <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
                </section>
                
                 <section class="col col-6"> 
                    
                     <label for="file" class="input input-file">

                         <input  class="btn-u btn-u-default" type="file" id="files[]" name="files[]" multiple="multiple" accept="image/*" placeholder="Prescription "> 

                    </label>
                  </section>
                   <section class="col col-6">
                     <label class="checkbox"> 
                         <input type="checkbox" id="inpatient"  name="inpatient" value="inpatient" checked="true">
                         <i class="rounded-4x"></i>Admit as in patient. 
                       </label>
                </section>
                   <section class="col col-3">
                     <label class="checkbox"> 
                         <input type="checkbox" id="pregnant"  name="pregnant" value="pregnant">
                         <i class="rounded-4x"></i>Pregnant. 
                       </label>
                     </section>    
                    <section class="col col-3">
                     <label class="checkbox"> 
                         <input type="checkbox" id="child"  name="child" value="child">
                         <i class="rounded-4x"></i>Infant / Child. 
                       </label>
                     </section>
               </div>   
            <div class="row">
                <section class="col col-6">
                    <label class="select">
                          <select id="presdiagnostics" name="presdiagnostics">
                              <option value="Medicines" >-------- Select Diagnostics ----------</option>
                              <?php foreach($favDiagList as $value){?>
                                 <option value=<?php echo $value->id;?>><?php echo $value->diagnosticsname;?></option>
                              <?php } ?>

                          </select>
                      </label>
                  </section>  
                <section class="col col-6">
                    <label class="select select-multiple">
                          <select multiple id="presdiagnosticstests" name="presmedicaltest[]">
                              <option value="Medicines" >-------- Select Test ----------</option>
                              <?php foreach( $testsList as $value){?>
                                 <option value=<?php echo $value->id;?>><?php echo $value->testname;?></option>
                              <?php } ?>
                             
                          </select>
                      </label>
                  </section> 
                  <section class="col col-8">
                        <label class="select select-multiple  col-md-7">
                                  <select multiple id="presdiseases" name="presdiseases[]">
                                      <option value="Diseases" >-------- Select Diseases ----------</option>
                                     <?php foreach($diseaseslist as $value){?>
                                        <option value=<?php echo $value->diseasesname;?>><?php echo $value->diseasesname;?></option>
                                     <?php } ?>
                                  </select>
                              </label>
                                <label class="input col-md-5" >
                                    <input type="text"  name="otherdiseases"  id="otherdiseases" placeholder="Other Diseases">
                                
                                 </label>
                      </section>  
                 
                
                 
                <section class="col col-4">
                     <label class="input"> 
                         <textarea cols="50" rows="5" name="description" id="description" placeholder="Doctor Observations"></textarea>
                         
                         <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
                </section>
           
                <section class="col col-md-12">
                     <label class="input"> 
                         <textarea cols="50" rows="5" name="suggestions" id="suggestions" placeholder="Docotr Suggestions" style="width:100%; height:100px;"></textarea>
                         <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
                </section>
               
               </div> 
           <hr/> 
          <div class="row">
             <section class="col col-4">
                   <input type="button" class="btn-u-blue btn-u pull-right"  name="button" id="btnAddMedicinesSpecificData" value="Add Medicine Data"/>
             </section>
            <section class="col col-6">
                    <label class="select">
                          <select id="presmedicalshop" name="presmedicalshop">
                              <option value="" >-------- Select Medical Shop ----------</option>
                              <?php foreach($favMedicalShopList as $value){?>
                                 <option value=<?php echo $value->id;?>><?php echo $value->shopname;?></option>
                              <?php } ?>

                          </select>
                      </label>
                  </section>   
            </div> 
            <!-- delete -->
            <div class="row">
               
             <section class="col col-6">
                 <label class="label"><b> General Medicines</b></label>
                 
                 <label class="input">
	                 <input type="text"  name="gmedicines"  id="gmedicines" readonly>
	                 <span class="glyphicon  glyphicon-search" id="showMedicineSerachPop"></span>
                 </label>
                 
                    <input type="hidden" id="hidgeneralmedicines"  name="hidgeneralmedicines" />
                    <b><font color="red"><i><span id="listerror"></span></i></font></b>
                </section>
                 <section class="col col-md-6">
                     <label class="label"> <b>Doctor Medicines</b></label>
                     <label class="input">
	                 	<input type="text"  name="dmedicines"  id="dmedicines" readonly>
	                 	<span class="glyphicon  glyphicon-search" id="showDoctorMedicineSerachPop"></span>
                 	</label>
                     
                 
                    <input type="hidden" id="hiddendoctormedicines"  name="hiddendoctormedicines" />
                    <b><font color="red"><i><span id="listerror"></span></i></font></b>
                </section>
        
            <section class="col col-md-4">
                  <label class="label"> <b># Days</b></label>
                  <label class="input"> 
                        
                        <input type="text" name="noofdays" id="noofdays" placeholder="No of Days">
                         <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                    </label>
            </section>
             <section class="col col-md-4">
                  <label class="label"> <b>Other Medicines</b></label>
                  <label class="input"> 
                        <i class="icon-append fa fa-user"></i>
                        <input type="text" name="omedicines" id="omedicines" placeholder="Other Medicines">
                         <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                    </label>
            </section>
             <section class="col col-md-4">
                  <label class="label"> <b>Usage</b></label>
                  <label class="input"> 
                        <i class="icon-append fa fa-user"></i>
                        <input type="text" name="usage" id="usage" placeholder="Usage {EX: 5 ML}">
                         <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                    </label>
            </section>
            <section class="col col-md-12">
              <table class="table table-striped" id="patient_records_table">
                     <tr>

                            <td><h6>Morning Before Meal</h6></td>
                            <td><h6>Morning After Meal</h6></td>
                            <td><h6>Afternoon Before Meal</h6></td>
                            <td><h6>Afternoon After Meal</h6></td>
                            <td><h6>Evening Before Meal</h6></td>
                            <td><h6>Evening After Meal</h6></td>
                        </tr>
                    <tbody>
                       <tr>

                            <td><input type="checkbox" name="mbm1"  id="mbm1"/></td>
                            <td><input type="checkbox" name="mam1" id="mam1" /></td>
                            <td><input type="checkbox" name="abm1" id="abm1"/></td>
                            <td><input type="checkbox" name="aam1" id="aam1"/></td>
                            <td><input type="checkbox" name="ebm1" id="ebm1"/></td>
                            <td><input type="checkbox" name="eam1" id="eam1"/></td>
                        </tr>
                    </tbody>
              </table>    
                
            </section>
        </div>
        <div class="row">
            <section class="col col-md-15">
                
                <div class="row">
                <div class="panel panel-primary margin-bottom-40" id="patient_medcine_records_repords_table">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-globe"></i>Medicines Prescribed</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-hover" id="patient_medincine_records_repords_table">
                                	<thead>
	                                   	<tr>
	                                       <td nowrap><h6>Name</h6></td>
	                                            <td><h6>Days</h6></td>
	                                            <td><h6>Usage</h6></td>
	                                            <td><h6>MBM</h6></td>
	                                            <td><h6>MAM</h6></td>
	                                            <td><h6>ABM</h6></td>
	                                            <td><h6>AAM</h6></td>
	                                            <td><h6>EBM</h6></td>
	                                            <td><h6>EAM</h6></td>
	                                            <td nowrap><h6>Action</h6></td>
	                                        </tr>
                                        </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>                      
                        </div>
            </div>
            </section>
            
        </div>
        <div id="medicinestabledata">
             <input type="hidden"  name="counter" id="counter" />
        </div>
            <!-- End -->
            </fieldset>




 </div>
</div>

    </div> 
    
    
  
</div>
</section>
</fieldset>
</form>    
</div>

</div>

<!-- Select Medicine Popup Start -->
<div class="modal fade" id="searchMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Search and Select Medicine</h4>
            </div>
            <div class="modal-body sky-form ">
            	<div class="row">
            		<section class="col col-md-6">
            			<label class="input"><input type="text" value="" placeholder="Enter Medicine Name" id="searchMedicine" /></label>
            		</section>
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchGenericMedicine()" id="saveData">Search</button></section>
            	</div>
            	<table class="table table-striped" id="searchMedicinesResults">
            		<thead>
            			<tr>
            				<th>SNo#</th>
            				<th>Medicine Name</th>
            			</tr>
            		</thead>
            		<tbody></tbody>
            	</table>
            	<div class="paging-container" id="tablePaging"></div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>
<!-- Select Medicine Popup End -->

<!-- Select Doctor Medicine Popup Start -->
<div class="modal fade" id="searchDoctorMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Search and Select Medicine</h4>
            </div>
            <div class="modal-body sky-form ">
            	<div class="row">
            		<section class="col col-md-6">
            			<label class="input"><input type="text" value="" placeholder="Enter Medicine Name" id="searchDoctorMedicine" /></label>
            		</section>
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchDoctorMedicine()" id="saveData">Search</button></section>
            	</div>
            	<table class="table table-striped" id="searchDoctorMedicinesResults">
            		<thead>
            			<tr>
            				<th>SNo#</th>
            				<th>Medicine Name</th>
            			</tr>
            		</thead>
            		<tbody></tbody>
            	</table>
            	<div class="paging-container" id="tablePaging"></div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>
<!-- Select Doctor Medicine Popup End -->
