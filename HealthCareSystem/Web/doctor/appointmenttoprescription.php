<div class="col-md-12 pull-right" >
<fieldset>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/doctorhometoprescription.js"></script>
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

   <form action="../../Business/DoctorPrescriptionUpload.php"  method="POST" enctype="multipart/form-data">     
<section id="" class="col-md-4"> 
</section>    
  
<section id="prescriptionpanel" class="col-md-10"> 
    <!--input type="button" class="btn-u pull-right"  name="button" id="showPatientHistory" value=" Patient History "/-->     
    
    
    <input type="submit" class="btn-u pull-right"  name="submit" id="showPrescriptionSearch" value="Submit"/>     
      
<div class="panel panel-orange  sky-form">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-tasks"></i>Prescription Details</h3>
     </div>
    
 
    <div class="col-md-12">  
    <div class="row"> 
    <div class="col-md-12">  
         <div class="row">
                  <section class="col col-6">
                    <label class="label"><b>Patient Name :   </b>
                        <span id="prespatientName"><i></i></span></label>
                        <input type="hidden" name="hiddenpatientName" id="hiddenpatientName"/>
                         <input type="hidden" name="hiddenpatientId" id="hiddenpatientId"/>
                        <input type="hidden" name="hidappointmentId" id="hidappointmentId"/> 
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label"><b>Hospital Name :   </b>
                        <span id="hospitalName"><i></i></span></label>
                         <input type="hidden" name="hidhospitalName" id="hidhospitalName"/>
                          <input type="hidden" name="hidhospitalId" id="hidhospitalId"/> 
                </section> 
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
                <section class="col col-6">
                     <label class="input"> 
                           <i class="icon-append fa fa-calendar"></i>
                           <input type="text" name="start" id="start" placeholder="Next Appointment date" readonly="true">
                            <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
                </section>
             <section class="col col-4">
                     <label class="checkbox"> 
                         <input type="checkbox" id="inpatient"  name="inpatient" value="inpatient" checked="true">
                         <i class="rounded-4x"></i>Admit as in patient. 
                       </label>
                </section>
    </div>    
            <div class="row">
               
                 <section class="col col-6">
                        <label class="select select-multiple">
                                  <select multiple id="presdiseases" name="presdiseases[]">
                                      <option value="Diseases" >-------- Select Diseases ----------</option>
                                      <!--option value="Hepitatis">Hepitatis</option>
                                      <option value="Stomach Pain">Stomach Pain</option>
                                      <option value="Skin">Skin</option>
                                      <option value="ENT">ENT</option-->
                                      <?php foreach($diseaseslist as $value){?>
                                        <option value=<?php echo $value->diseasesname;?>><?php echo $value->diseasesname;?></option>
                                     <?php } ?>
                                  </select>
                              </label>
                      </section>   
                   <section class="col col-6">
                    <label class="select">
                          <select id="presdiagnostics" name="presdiagnostics">
                              <option value="Medicines" >-------- Select Diagnostics ----------</option>
                              <?php foreach($lablist as $value){?>
                                 <option value=<?php echo $value->id;?>><?php echo $value->diagnosticsname;?></option>
                              <?php } ?>

                          </select>
                      </label>
                  </section>   
                
            </div>
         <div class="row">
             <section class="col col-6">
                    <label class="select select-multiple">
                          <select multiple id="presdiagnosticstests" name="presmedicaltest[]">
                              <option value="Medicines" >-------- Select Test ----------</option>
                              <!--option value="Blood Test">Vijaya</option>
                              <option value="Sugar">Ravi</option-->
                              
                          </select>
                      </label>
                  </section> 
            <section class="col col-6">
                 <label class="input"> 
                     <textarea cols="30" rows="3" name="description" placeholder="Docotr Observations"></textarea>

                     <font color="red"><i><span id="enderrormsg"></span> </i></font>
                   </label>
            </section>
            <section class="col col-6">
                     <label class="input"> 
                         <textarea cols="50" rows="5" name="suggestions" placeholder="Docotr Suggestions"></textarea>
                         <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
                </section>
            
         </div> 
        
        <hr/>
        <div class="row">
             <section class="col col-4">
                   <input type="button" class="btn-u-blue btn-u pull-right"  name="button" id="btnAddHomeMedicinesSpecificData" value="Add Medicine Data"/>
             </section>
            <section class="col col-6">
                    <label class="select">
                          <select id="presmedicalshop" name="presmedicalshop">
                              <option value="" >-------- Select Medical Shop ----------</option>
                              <?php foreach($medicalShopList as $value){?>
                                 <option value=<?php echo $value->id;?>><?php echo $value->shopname;?></option>
                              <?php } ?>

                          </select>
                      </label>
                  </section>   
        </div>
        <div class="row">
               
             <section class="col col-4">
                 <label class="label"><b> General Medicines</b></label>
                 <label class="input">
	                 <input type="text"  name="gmedicines"  id="gmedicines" readonly>
	                 <span class="glyphicon  glyphicon-search" id="showMedicineSerachPop"></span>
                 </label>
                 <!-- 
                    <label class="input">
                        <input type="text"  name="gmedicines"  id="gmedicines" list="generalmedicineslist">
                        <datalist id="generalmedicineslist" name="gmedicines"> 
                            <option value="" label="General Medicines" />
                             <?php //foreach ($generalMedicines as $value) {?>
                                    <option value="<?php  //echo $value->medicinename;?>" label="<?php  //echo $value->medicinename;?>" />
                              <?php // }?>
                        </datalist>
                    </label>
                     -->
                    <input type="hidden" id="hidgeneralmedicines"  name="hidgeneralmedicines" />
                    <b><font color="red"><i><span id="listerror"></span></i></font></b>
                </section>
                 <section class="col col-md-4">
                     <label class="label"> <b>Doctor Medicines</b></label>
                    <label class="input">
	                 	<input type="text"  name="dmedicines"  id="dmedicines" readonly>
	                 	<span class="glyphicon  glyphicon-search" id="showDoctorMedicineSerachPop"></span>
                 	</label>
                    <!--  
                    <label class="input">
                        <input type="text"  name="dmedicines"  id="dmedicines" list="doctormedicineslist">
                        <datalist id="doctormedicineslist" name="dmedicines"> 
                            <option value="" label="Doctor Medicines" />
                             <?php //foreach ($doctorMedicines as $value) {?>
                                    <option value="<?php  //echo $value->name;?>" label="<?php  //echo $value->name;?>" />
                              <?php //}?>
                        </datalist>
                    </label>
                    -->
                    <input type="hidden" id="hiddendoctormedicines"  name="hiddendoctormedicines" />
                    <b><font color="red"><i><span id="listerror"></span></i></font></b>
                </section>
        
            <section class="col col-md-4">
                  <label class="label"> <b># Days</b></label>
                  <label class="input"> 
                        <i class="icon-append fa fa-user"></i>
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
                    <tbody>
                        <tr>

                            <th>Morning Before Meal</th>
                            <th>Morning After Meal</th>
                            <th>Afternoon Before Meal</th>
                            <th>Afternoon After Meal</th>
                            <th>Evening Before Meal</th>
                            <th>Evening After Meal</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>

                            <th><input type="checkbox" name="mbm1"  id="mbm1"/></th>
                            <th><input type="checkbox" name="mam1" id="mam1" /></th>
                            <th><input type="checkbox" name="abm1" id="abm1"/></th>
                            <th><input type="checkbox" name="aam1" id="aam1"/></th>
                            <th><input type="checkbox" name="ebm1" id="ebm1"/></th>
                            <th><input type="checkbox" name="eam1" id="eam1"/></th>
                        </tr>
                    </tbody>
              </table>    
                
            </section>
        </div>
        <div class="row">
            <section class="col col-md-12">
                
                <div class="row">
                <div class="panel panel-primary margin-bottom-40" id="patient_medcine_records_repords_table">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-globe"></i>Medicines Prescribed</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-hover" id="patient_medincine_records_repords_table">
                                    <thead>
                                         <tr>
                                             <th>Name</th>
                                            <th># Days</th>
                                            <th>Usage</th>
                                            <th>MBM</th>
                                            <th>MAM</th>
                                            <th>ABM</th>
                                            <th>AAM</th>
                                            <th>EBM</th>
                                            <th>EAM</th>
                                            <th>Action</th>
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
 </div>
</div>

</div> 
   
</div>
</section>

   </form> 
</fieldset>    
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