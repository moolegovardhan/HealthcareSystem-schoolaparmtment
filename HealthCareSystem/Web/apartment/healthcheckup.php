<?php session_start(); 
 include_once '../../Business/ApartmentData.php';
 
 $sd = new ApartmentData();
 
 
$apartmentAppointment = $sd->fetchSpecificApartmentAppointmentDates($_SESSION['officeid']);

$flatlist = $sd->fetchApartmentDetails($_SESSION['officeid']);

?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/apartmenthealthcheck.js"></script> 
<div class="col-md-12 sky-form" >
    <div id="showSearch">
    <fieldset>
        
        
        <section class="col-md-2">
            <label class="select">
                <select id="flatnumber" name="flatnumber" >
                      <option value="nodata">- Select Flat # -</option>
                       <?php  

                               if(sizeof($flatlist) > 0){
                                   foreach($flatlist as $flat){

                       ?>
                      <option value="<?php  echo $flat->id; ?>"><?php  echo $flat->flatnumber; ?></option>
                      <?php
                                   }
                               }
                      ?>


                </select>
            </label>  
       </section>
         <section class="col-md-2">
          <label class="input">
              <input type="text" id="block"  name="block" placeholder="block" size="4" />    
            </label>
       
      </section>
      <section class="col-md-3">
          <label class="input">
              <input type="text" id="patientname"  name="patientname" placeholder="Patient Name"  />
            </label>
       
      </section>
     <section class="col-md-2">
          <label class="input">
              <input type="text" id="patientid"  name="patientid" placeholder="Patient Id"  />
            </label>
       
      </section>
       
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="searchflatmembers" > Search </button>
        </section>
    </fieldset>
    <fieldset>
        <section class="col-md-12">
            <table class="table table-striped" id="flat_member_search_table">
                <thead>
                    <tr style="background-color: #F2CD00">


                         <td><b>Flat No</b></td>
                        <td><b>Block</b></td>
                        <td><b>Member Name</b></td>
                        <td><b>Member Id </b></td>
                        <td><b>Mobile</b></td>
                         <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
            <div id="labtabledata">

            </div>    
          <input type="hidden"  name="counter" id="counter" />
        </section>  
        
    </fieldset>
   </div> 
    <div id="showDataEntry">
        
        <form class=" sky-form" action="../../Business/SaveFlatMemberHealthParameters.php" method="POST">
                <input type="hidden" name="appointmentflatmemberid" id="appointmentflatmemberid" />
                <input type="hidden" name="gflatnumber" id="gflatnumber" />
                <fieldset>
                    <section class="col-md-4">
                        <label class="select">
                            <select id="appointmentid" name="appointmentid" >
                                  <option value="nodata">- Appointment Date -</option>
                                  <?php
                                   if(sizeof($apartmentAppointment) > 0) {
                                       foreach($apartmentAppointment as $appointment){
                                  ?>
                                  <option value="<?php  echo $appointment->id; ?>"><?php  echo $appointment->appointmentdate; ?></option>
                                  <?php
                                       }
                                   }
                                  ?>
                                  
                              


                             </select>
                        </label>   
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="sugar" name="sugar"  placeholder="Sugar" class="valid"  >

                           </label>
                       </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="bp" name="bp"  placeholder="BP" class="valid" >

                       </label>
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="cholo1" name="cholo1"  placeholder="Cholostral" class="valid" >

                       </label>
                   </section>
                   <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="cholo2" name="cholo2"  placeholder="Cholostral" class="valid" >

                           </label>
                     </section> 
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="cholo3" name="cholo3"  placeholder="Cholostral" class="valid" >

                           </label>
                     </section>
                 
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="cholo4" name="cholo4"  placeholder="Cholostral" class="valid" >

                           </label>
                     </section>

                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="cholo5" name="cholo5"  placeholder="Cholostral" class="valid" >

                           </label>
                     </section>
                    
                </fieldset>
                     <div class="modal-footer">
                        <input type="submit" value="Submit Details"class="btn-u btn-u-primary" id="submitApartment"/>

                    </div>
            </form>
    </div>
    <div id="showDietitianEntry">
        
        <form  action="../../Business/SaveFlatMemberDietitianHealthParameters.php" method="POST">
                <input type="hidden" name="dappointmentflatmemberid" id="dappointmentflatmemberid" />
                <input type="hidden" name="dflatnumber" id="dflatnumber" />
                <section class="col-md-12">
                    <br/><br/><br/><br/>
                    
                </section>
                    <section class="col-md-4">
                        <label class="select">
                            <select id="dappointmentid" name="dappointmentid" >
                                  <option value="nodata">- Appointment Date -</option>
                                  <?php
                                   if(sizeof($apartmentAppointment) > 0) {
                                       foreach($apartmentAppointment as $appointment){
                                  ?>
                                  <option value="<?php  echo $appointment->id; ?>"><?php  echo $appointment->appointmentdate; ?></option>
                                  <?php
                                       }
                                   }
                                  ?>
                                  
                             </select>
                        </label>   
                   </section>
                <section class="col-md-4">
                        <label class="select">
                            <select id="dietitian" name="dietitian" >
                                  <option value="nodata">- Dietitian -</option>
                                  
                                  <option value="121">Ravi Kumar</option>
                                 
                                  
                             </select>
                        </label>   
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                                <textarea id="complaints"  name="complaints" placeholder="Complaints" rows="3" cols="30"></textarea>

                           </label>
                       </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                                <textarea id="dobservation"  name="dobservation" placeholder="Observations" rows="3" cols="30"></textarea>

                           </label>
                       </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                                <textarea id="mfrecomendation"  name="mfrecomendation" placeholder="Morning Food Recomendation" rows="3" cols="30"></textarea>

                           </label>
                       </section>
                   <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                                <textarea id="afrecomendation"  name="afrecomendation" placeholder="Afternoon Food Recomendation" rows="3" cols="30"></textarea>

                           </label>
                       </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                                <textarea id="efrecomendation"  name="efrecomendation" placeholder="Night Food Recomendation" rows="3" cols="30"></textarea>

                           </label>
                       </section>
                <section class="col-md-12">
                    <br/><br/><br/><br/><br/><br/>
                    
                </section>
                     <div class="modal-footer">
                        <input type="submit" value="Submit Details"class="btn-u btn-u-primary" id="submitApartment"/>

                    </div>
            </form>
    </div>
    <div id="showOpthoEntry">
        
        <form  action="../../Business/SaveFlatMemberOpticianHealthParameters.php" method="POST">
                <input type="hidden" name="oappointmentstudentid" id="oappointmentstudentid" />
                <input type="hidden" name="oflatnumber" id="oflatnumber" />
                
                <!-- Optomology start -->
                <section class="col-md-12"><br/><br/></section>
                <section class="col-md-3">
                        <label class="select">
                            <select id="oappointmentid" name="oappointmentid" >
                                  <option value="nodata">- Appointment Date -</option>
                                  <?php
                                   if(sizeof($apartmentAppointment) > 0) {
                                       foreach($apartmentAppointment as $appointment){
                                  ?>
                                  <option value="<?php  echo $appointment->id; ?>"><?php  echo $appointment->appointmentdate; ?></option>
                                  <?php
                                       }
                                   }
                                  ?>
                                  
                             </select>
                        </label>   
                   </section>
                <section class="col-md-3">
                        <label class="select">
                            <select id="optodoctor" name="optodoctor" >
                                  <option value="nodata">- Doctor -</option>
                                  
                                  <option value="121">Ravi Kumar</option>
                                 
                                  
                             </select>
                        </label>   
                   </section>
                    <section id="doctoriddiv" class="col col-3">
                            <label class="input">
                                <textarea id="ocomplaints"  name="ocomplaints" placeholder="Complaints" rows="3" cols="30"></textarea>

                           </label>
                       </section>
                    <section id="doctoriddiv" class="col col-3">
                            <label class="input">
                                <textarea id="oobservations"  name="oobservations" placeholder="Observations" rows="3" cols="30"></textarea>

                           </label>
                       </section>
                <div class="row">
                    <section class="col col-md-12">
                      <table class="table table-striped" id="patient_records_table">
                             <tr>

                                    <td><h6></h6></td>
                                    <td><h6><b>Right Eye</b></h6></td>
                                    <td><h6><b>Left Eye</b></h6></td>
                                </tr>
                            <tbody>
                               <tr>

                                    <td>Diagnosis</td>
                                    <td><input type="textbox" name="rDiagnosis" id="rightdiagnosis" /></td>
                                    <td><input type="textbox" name="lDiagnosis" id="lDiagnosis"/></td>
                                </tr>
                                  <tr>

                                    <td>Diagnosis Code </td>
                                    <td><input type="textbox" name="rDiagnosisCode" id="rDiagnosisCode" /></td>
                                    <td><input type="textbox" name="lDiagnosisCode" id="lDiagnosisCode"/></td>
                                </tr>
                                  <tr>

                                    <td>Lids & Adnexae</td>
                                    <td><input type="textbox" name="rLidsandAdnexae" id="rLidsandAdnexae" /></td>
                                    <td><input type="textbox" name="lLidsandAdnexae" id="lLidsandAdnexae"/></td>
                                </tr>
                                  <tr>

                                    <td>Lacrimal Ducts</td>
                                    <td><input type="textbox" name="rLacrimalDucts" id="rLacrimalDucts" /></td>
                                    <td><input type="textbox" name="lLacrimalDucts" id="lLacrimalDucts"/></td>
                                </tr>
                                  <tr>

                                    <td>Conjunctiva</td>
                                    <td><input type="textbox" name="rConjunctiva" id="rConjunctiva" /></td>
                                    <td><input type="textbox" name="lConjunctiva" id="lConjunctiva"/></td>
                                </tr>
                                  <tr>

                                    <td>Cornea</td>
                                    <td><input type="textbox" name="rCornea" id="rCornea" /></td>
                                    <td><input type="textbox" name="lCornea" id="lCornea"/></td>
                                </tr>
                                  <tr>

                                    <td>Anterior Chamber</td>
                                    <td><input type="textbox" name="rAnteriorChamber" id="rAnteriorChamber" /></td>
                                    <td><input type="textbox" name="lAnteriorChamber" id="lAnteriorChamber"/></td>
                                </tr>
                                  <tr>

                                    <td>Iris</td>
                                    <td><input type="textbox" name="rIris" id="rIris" /></td>
                                    <td><input type="textbox" name="lIris" id="lIris"/></td>
                                </tr>
                                  <tr>

                                    <td>Pupil</td>
                                    <td><input type="textbox" name="rPupil" id="rPupil" /></td>
                                    <td><input type="textbox" name="lPupil" id="lPupil"/></td>
                                </tr>
                                  <tr>

                                    <td>Lens</td>
                                    <td><input type="textbox" name="rLens" id="rLens" /></td>
                                    <td><input type="textbox" name="lLens" id="lLens"/></td>
                                </tr>
                                  <tr>

                                    <td>Ocular Movements</td>
                                    <td><input type="textbox" name="rOcularMovements" id="rOcularMovements" /></td>
                                    <td><input type="textbox" name="lOcularMovements" id="lOcularMovements"/></td>
                                </tr>
                            </tbody>
                      </table>    
                      
                    </div>
                    </section>
                    <div class="modal-footer">
                        <input type="submit" value="Submit Details"class="btn-u btn-u-primary" id="submitApartment"/>

                    </div>
                     </form>
                </div>
                
                <!-- end -->
       <div id="showPhysianEntry">
        <?php
            include_once '../../Business/MasterData.php';
            $md = new MasterData();
            $diseaseslist = $md->getDiseasesData();
            $lablist = $md->getLabData();
        
        
        ?>
                <form  action="../../Business/SaveFlatMemberPhysianHealthParameters.php" method="POST">
                        <input type="hidden" name="pappointmentflatmemberid" id="pappointmentflatmemberid" />
                        <input type="hidden" name="pflatnumber" id="pflatnumber" />
                  
                   <section class="col-md-12"><br/>
                       
                       <div class="modal-footer">
                        <input type="submit" value="Submit Details"class="btn-u btn-u-primary" id="submitApartment"/>

                    </div>
                       <br/></section>
                        <section class="col-md-3">
                                <label class="select">
                                    <select id="pappointmentid" name="pappointmentid" >
                                          <option value="nodata">- Appointment Date -</option>
                                          <?php
                                           if(sizeof($apartmentAppointment) > 0) {
                                               foreach($apartmentAppointment as $appointment){
                                          ?>
                                          <option value="<?php  echo $appointment->id; ?>"><?php  echo $appointment->appointmentdate; ?></option>
                                          <?php
                                               }
                                           }
                                          ?>

                                     </select>
                                </label>   
                           </section>
                        <section class="col-md-3">
                                <label class="select">
                                    <select id="optodoctor" name="pptodoctor" >
                                          <option value="nodata">- Doctor -</option>

                                          <option value="121">Ravi Kumar</option>


                                     </select>
                                </label>   
                           </section>
                            <section id="doctoriddiv" class="col col-3">
                                    <label class="input">
                                        <textarea id="pcomplaints"  name="pcomplaints" placeholder="Complaints" rows="3" cols="30"></textarea>

                                   </label>
                               </section>
                             <section id="doctoriddiv" class="col col-3">
                                    <label class="input">
                                        <textarea id="pobservations"  name="pobservations" placeholder="Observations" rows="3" cols="30"></textarea>

                                   </label>
                               </section>      
                            <section id="doctoriddiv" class="col-md-1">
                                    <label class="input">
                                       
                                        <input type="text" id="weight" name="weight" placeholder="Weight" />
                                        
                                   </label>
                               </section>
                             <section id="doctoriddiv" class="col-md-1">
                                    <label class="input">
                                       
                                        <input type="text" id="height" name="height" placeholder="Height" />
                                        
                                   </label>
                               </section>
                   <div class="row">
                       <section class="col-md-3">
                                      <label class="select select-multiple">
                                                <select multiple id="presdiseases" name="presdiseases[]">
                                                    <option value="Diseases" >-------- Select Diseases ----------</option>
                                                   <?php foreach($diseaseslist as $value){?>
                                                      <option value=<?php echo $value->diseasesname;?>><?php echo $value->diseasesname;?></option>
                                                   <?php } ?>
                                                </select>
                                            </label>
                                    </section>  
                                    <section class="col-md-3">
                                        <label class="select">
                                              <select id="presdiagnostics" name="presdiagnostics">
                                                  <option value="Medicines" >-------- Select Diagnostics ----------</option>
                                                  <?php foreach($lablist as $value){?>
                                                     <option value=<?php echo $value->id;?>><?php echo $value->diagnosticsname;?></option>
                                                  <?php } ?>

                                              </select>
                                          </label>
                                      </section>
                                       
                                    <section class="col-md-3">
                                        <label class="select select-multiple">
                                              <select multiple id="presdiagnosticstests" name="presmedicaltest[]">
                                                  <option value="Medicines" >-------- Select Test ----------</option>
                                                  <?php foreach( $testsList as $value){?>
                                                     <option value=<?php echo $value->id;?>><?php echo $value->testname;?></option>
                                                  <?php } ?>

                                              </select>
                                          </label>
                                      </section>
                       
                   </div>
                             <div class="row">
                                    
                                    <section class="col-md-3">
                                       <label class="input">
                                            <input type="text"  name="gmedicines"  id="gmedicines" readonly placeholder="General Medicine">
                                                <span class="glyphicon  glyphicon-search" id="showChildMedicineSerachPop"></span>
                                        </label>

                                           <input type="hidden" id="hidgeneralmedicines"  name="hidgeneralmedicines" />
                                           <b><font color="red"><i><span id="listerror"></span></i></font></b>
                                       </section>
                                        <section class="col-md-4">
                                           <label class="input">
                                                       <input type="text"  name="dmedicines"  id="dmedicines" readonly placeholder="Doctor Medicine">
                                                       <span class="glyphicon  glyphicon-search" id="showChildDoctorMedicineSerachPop"></span>
                                               </label>


                                           <input type="hidden" id="hiddendoctormedicines"  name="hiddendoctormedicines" />
                                           <b><font color="red"><i><span id="listerror"></span></i></font></b>
                                       </section>
                                    
                                </div>
                                <div class="row">
                                   
                                         <section class="col-md-4">
                                              <label class="input"> 
                                                    <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="omedicines" id="omedicines" placeholder="Other Medicines">
                                                     <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                                                </label>
                                        </section>
                                     <section class="col-md-4">
                                             <label class="input"> 

                                                    <input type="text" name="noofdays" id="noofdays" placeholder="No of Days">
                                                     <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                                                </label>
                                        </section>
                                         <section class="col-md-4">
                                              <label class="input"> 
                                                    <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="usage" id="usage" placeholder="Usage {EX: 5 ML}">
                                                     <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                                                </label>
                                        </section>                                    
                                </div>
                                <div class="row">
                                    <section class="col-md-15">
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
                                    <section class="col-md-12">
                
                                        <div class="row">
                                        <div class="panel panel-primary margin-bottom-40" id="patient_medcine_records_repords_table">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><i class="fa fa-globe"></i>Medicines Prescribed
                                                       
                                                        <input type="button" class="btn-u-blue btn-u pull-right"  name="button" id="btnAddChildMedicinesSpecificData" value="Add Medicine Data"/>
                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table class="table table-bordered table-hover" id="patient_child_medincine_records_repords_table">
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
                        
                </form>
       </div>   
    </div> 



<!-- Select Medicine Popup Start -->
<div class="modal fade" id="searchNewChildMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchNewChildGenericMedicine()" id="saveData">Search</button></section>
            	</div>
            	<table class="table table-striped" id="searchMedicinesResults">
            		<thead>
            			<tr>
            				<td>SNo#</td>
            				<td>Medicine Name</td>
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
<div class="modal fade" id="searchNewChildDoctorMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchNewChildDoctorMedicine()" id="saveData">Search</button></section>
            	</div>
            	<table class="table table-striped" id="searchDoctorMedicinesResults">
            		<thead>
            			<tr>
            				<td>SNo#</td>
            				<td>Medicine Name</td>
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
</div>   