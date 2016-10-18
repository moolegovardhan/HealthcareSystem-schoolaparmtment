<div class="col-md-12   sky-form" >
<fieldset>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/callcenterpregnancyprescription.js"></script>
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
<style>
.stripe-6 {
  color: #FFFFFF;
  background: repeating-linear-gradient(
    to right,
    orangered,
    orangered 10px,
    orangered 10px,
    orangered 20px
  );
  padding-left: 20px;
  padding-right: 20px;
      
}
</style>
<section class="col-md-15">

   <div class="panel panel-orange" id="prescriptionsearchpanel">
        <div class="panel-heading">
            <h3 class="panel-title">Prescription : Consultation</h3>
         </div>
         <div class="panel-body"> 
             <div class="panel-group acc-v1" id="accordion-1"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-One">
                                Search for Patients  Appointments
                            </a>
                        </h4>
                        <div id="collapse-One" class="panel-collapse collapse in">
                            <div class="panel-body">
                            <div class="col-md-15">
                                <div class="row">
                                    <section class="col">

                                    </section>
                                    <section class="col">
                                        <label class="input">
                                          <input type="text" id="patientName"  placeholder="Patient Name">
                                          <input type="hidden" id="hidpatientName" name="hidpatientName">
                                        </label>
                                        <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                                    </section>
                                    <section class="col">
                                        <label class="input">
                                          <input type="text" id="patientID"  placeholder="Patient ID">
                                          <input type="hidden" id="hidpatientID"  name="hidpatientID"  >
                                        </label>
                                        <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                                    </section>
                                    <section class="col">
                                        <label class="input">
                                          <input type="text" id="appointmentID"  placeholder="Appointment ID">
                                          <input type="hidden" id="hidappointmentid"  name="hidappointmentid" >
                                        </label>
                                        <i><font color="red"><span id="staffappointmentid"></span></font></i>
                                    </section>
                                    <section class="col">
                                        <label class="input">
                                          <input type="text" id="mobile"  placeholder="Mobile Number">
                                          <input type="hidden" id="hidpatientName"  name="hidpatientName"  placeholder="Patient Name">
                                        </label>
                                        <i><font color="red"><span id="staffpatientmobile"></span></font></i>
                                    </section>
                                    <section class="col">
                                          <input type="button" class="btn-u "  name="button" id="searchPrescriptionPrescription" value="search"/>  

                                    </section>
                                </div>
                                <div class="row col-md-12">
                                    
                                    <div class="panel panel-orange margin-bottom-10">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">List of Patients</h3>
                                    </div>
                                    <table class="table table-striped" id="patient_pregnancy_consultation_records_search_result_table">
                                        <thead>
                                            <tr>
                                                <td>AID</td>
                                                <td>Patient Name</td>
                                                <td>Doctor Name</td>
                                                <td>Date</td>
                                                <td>Time</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <div class="paging-container" id="tablePaging"></div>
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                            
                    </div>     
                    </div>
                    
                </div>
                   <!-- end of first -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Two">
                                    Patient Prescription
                                </a>
                            </h4>
                        </div>
                  <form action="../../Business/CallCenterPregnancyPrescriptionUpload.php" method="POST" enctype="multipart/form-data">     
  
                        <div id="collapse-Two" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-15 sky-form inline-group" >
                                         

                                        <input type="submit" class="btn-u "  name="submit" id="showPrescriptionSearch" value="Submit"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                        <input type="button" class="btn-u "  name="button" id="showPregnancyMedicines" value=" Medicines "/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                        <input type="button" class="btn-u "  name="button" id="showPregnancyMedicalTests" value=" Medical Tests "/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                       <input type="button" class="btn-u "  name="button" id="showPatientMasterData" value=" Set Master Data "/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                       <section class="col-md-2 pull-right">
                                            <label class="input"> 

                                                <input type="text" name="oweight" id="oweight" placeholder="Weight">
                                                 <font color="red"><i><span id="enderrormsg"></span> </i></font>
                                          </label>
                                     </section>
                                       <section class="col-md-2 pull-right">
                                             <label class="input"> 

                                                <input type="text" name="obp" id="obp" placeholder="BP">
                                                 <font color="red"><i><span id="enderrormsg"></span> </i></font>
                                            </label>
                                     </section>
                                        <label class="checkbox pull-right"> 
                                          <input type="checkbox" id="inpatient"  name="inpatient" value="inpatient" checked="true">
                                          <i class="rounded-x"></i> In Patient&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                         </label>
                                    </div>      
                                </div>
                                <div class="row col-md-15">
                                    <br/>
                                    <section class="col-md-3">
                                     <label class="label"><b>Patient Name :   </b>
                                            <span id="prespatientName"><i></i></span>
                                            <input type="hidden" name="hiddenpatientName" id="hiddenpatientName"/>
                                            <input type="hidden" name="hidappointmentId" id="hidappointmentId"/> 
                                           <input type="hidden" name="hiddenpatientId" id="hiddenpatientId"/> 
                                         </label>
                                     </section>   
                                    <section class="col-md-3">
                                        <label class="label"><b>Doctor Name :   </b>
                                            <span id="doctorName"><i></i></span>
                                            <input type="hidden" name="hiddendoctorName" id="hiddendoctorName"/>
                                            <input type="hidden" name="hiddendoctorId" id="hiddendoctorId"/> 
                                         </label>
                                    </section>
                                    <section class="col-md-3">
                                        <label class="label"><b>Hospital Name :   </b>
                                            <span id="hospitalName"><i></i></span>
                                              <input type="hidden" name="hidhospitalName" id="hidhospitalName"/>
                                             <input type="hidden" name="hidhospitalId" id="hidhospitalId"/>
                                         </label>
                                    </section>    
                                    <section class="col-md-3">
                                        <label class="label"><b>Appointment Date :   </b>
                                            <span id="appointmentDate"><i></i></span>
                                             <input type="hidden" name="hidappointmentDate" id="hidappointmentDate"/>
                                         </label>
                                     </section>   
                                   
                                  </div>
                                <div class="row col-md-15">
                                    <section class="col col-4">
                                        <label class="input"> 
                                              <i class="icon-append fa fa-calendar"></i>
                                              <input type="text" name="start" id="start" placeholder="Next Appointment date">
                                               <font color="red"><i><span id="enderrormsg"></span> </i></font>
                                          </label>
                                   </section>
                                   <section class="col col-4">
                                        <label class="select">
                                            <select id="refertohospital" name="refertohospital">
                                                <option value="REFERRAL">-- Referral Hospital Name--</option>
                                                <?php foreach ($hosiptal as $data) { ?>
                                                 <option value='<?php echo $data->id; ?>'><?php echo $data->hosiptalname; ?></option>
                                                <?php  } ?>       
                                                
                                            </select>
                                         </label>
                                 </section>
                                    <section class="col col-4">
                                            <label class="select">
                                              <select id="omonth" name="omonth" class="form-control">
                                               <option value="MONTH">- Month -</option>
                                               <option value="0">0</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                                <option value="9">9</option>
                                                 <option value="10">10</option>
                                               
                                              </select>
                                               <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                                           </label>
                                      </section> 
                                <section class="col col-4">
                                      <label class="select select-multiple">
                                                <select multiple id="presdiseases" name="presdiseases[]">
                                                    <option value="Diseases" >-------- Select Diseases ----------</option>
                                                   <?php foreach($diseaseslist as $value){?>
                                                      <option value=<?php echo $value->diseasesname;?>><?php echo $value->diseasesname;?></option>
                                                   <?php } ?>
                                                </select>
                                            </label>
                                    </section>  
                                    <section class="col col-4">
                                        <label class="select">
                                              <select id="presdiagnostics" name="presdiagnostics">
                                                  <option value="Medicines" >-------- Select Diagnostics ----------</option>
                                                  <?php foreach($lablist as $value){?>
                                                     <option value=<?php echo $value->id;?>><?php echo $value->diagnosticsname;?></option>
                                                  <?php } ?>

                                              </select>
                                          </label>
                                      </section>
                                       
                                    <section class="col col-4">
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
                                   <section class="col-md-6">
                                        <label class="input"> 
                                            <textarea cols="50" rows="5" name="description" id="description" placeholder="Doctor Observations"></textarea>

                                            <font color="red"><i><span id="enderrormsg"></span> </i></font>
                                          </label>
                                   </section> 
                               
                                    <section class="col-md-6">
                                        <label class="input"> 
                                            <textarea cols="50" rows="5" name="suggestions" id="suggestions" placeholder="Docotr Suggestions" style="width:100%; height:100px;"></textarea>
                                            <font color="red"><i><span id="enderrormsg"></span> </i></font>
                                          </label>
                                   </section>
                                    
                                </div>
                                <div class="row">
                                    <section class="col-md-4">
                                        <label class="select">
                                              <select id="presmedicalshop" name="presmedicalshop">
                                                  <option value="" >-------- Select Medical Shop ----------</option>
                                                  <?php foreach($medicalShopList as $value){?>
                                                     <option value=<?php echo $value->id;?>><?php echo $value->shopname;?></option>
                                                  <?php } ?>

                                              </select>
                                          </label>
                                      </section> 
                                    <section class="col-md-4">
                                       <label class="input">
                                            <input type="text"  name="gmedicines"  id="gmedicines" readonly placeholder="General Medicine">
                                                <span class="glyphicon  glyphicon-search" id="showPregnancyMedicineSerachPop"></span>
                                        </label>

                                           <input type="hidden" id="hidgeneralmedicines"  name="hidgeneralmedicines" />
                                           <b><font color="red"><i><span id="listerror"></span></i></font></b>
                                       </section>
                                        <section class="col-md-4">
                                           <label class="input">
                                                       <input type="text"  name="dmedicines"  id="dmedicines" readonly placeholder="Doctor Medicine">
                                                       <span class="glyphicon  glyphicon-search" id="showPregnancyDoctorMedicineSerachPop"></span>
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
                                    <section class="col-md-15">
                
                                        <div class="row">
                                        <div class="panel panel-primary margin-bottom-40" id="patient_medcine_records_repords_table">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><i class="fa fa-globe"></i>Medicines Prescribed
                                                       
                                                        <input type="button" class="btn-u-blue btn-u pull-right"  name="button" id="btnAddPregnancyMedicinesSpecificData" value="Add Medicine Data"/>
                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table class="table table-bordered table-hover" id="patient_pregnancy_medincine_records_repords_table">
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
                                </div><!-- Panel Body -->
                            </div>
                    </form>
                        </div>   
                    </div>
                    <!-- end of second--> 
            </div> 
             
         </div>
   </div>   
    
</section>
</fieldset>

</div>




<!-- Select Medicine Popup Start -->
<div class="modal fade" id="searchPregnancyTestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Month Wise Medical tests to be Performed</h4>
            </div>
            <div class="modal-body sky-form ">
            	
                         <table class="table table-striped pull-left" id="pregnancy_test_records_search_result_table">
                           <thead>
                               <tr>
                                   <td nowrap>Month</td>
                                   <td nowrap>Test Name</td>
                                   <td nowrap>Observations</td>
                                    <td nowrap></td>
                               </tr>
                           </thead>
                           <tbody>

                           </tbody>
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
<div class="modal fade" id="searchPregnancyMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Month Wise Medicines List</h4>
            </div>
            <div class="modal-body sky-form ">
            	
                     <table class="table table-striped pull-left" id="pregnancy_medicine_existing_records_search_result_table">
                           <thead>
                               <tr>
                                   <td nowrap>Month</td>
                                   <td nowrap>Medicine Name</td>
                                   <td nowrap>Observations</td>
                                    <td nowrap></td>
                               </tr>
                           </thead>
                           <tbody>

                           </tbody>
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
<!-- Enter Master Data for Pregnancy -->
<div class="modal fade" id="searchPregnancyMasterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Patient Master Data</h4>   <span id="displayMessage"><font><i><h5></h5></i></font></span>
            </div>
            <div class="modal-body sky-form ">
                <fieldset>
                    <div class="row">
                        <section class="col-md-4">
                            <label class="input"> 
                                  <i class="icon-append fa fa-calendar"></i>
                                  <input type="text" name="cdate" id="cdate" placeholder="Conceived date" >
                                   <font color="red"><i><span id="starterrormsg"></span> </i></font>
                              </label>
                        </section>
                    <section class="col-md-4">
                        <label class="input"> 
                              <i class="icon-append fa fa-calendar"></i>
                              <input type="text" name="edate" id="edate" placeholder="Expected date" >
                               <font color="red"><i><span id="finisherrormsg"></span> </i></font>
                          </label>
                   </section> 
                         <section class="col-md-4">
                                <label class="input"> 
                                      <i class="icon-append fa fa-user"></i>
                                      <input type="text" name="mweight" id="mweight" placeholder="Weight">
                                       <font color="red"><i><span id="weighterrmsg"></span> </i></font>
                                  </label>
                          </section> 
                         <section class="col-md-4">
                                <label class="input"> 
                                      <i class="icon-append fa fa-user"></i>
                                      <input type="text" name="mheight" id="mheight" placeholder="Height">
                                       <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                                  </label>
                          </section>
                        <section class="col-md-4">
                            <label class="input"> 
                                  <i class="icon-append fa fa-user"></i>
                                  <input type="text" name="mbp" id="mbp" placeholder="BP">
                                   <font color="red"><i><span id="bperrmsg"></span> </i></font>
                              </label>
                      </section>
                        <section class="col-md-4">
                                    <label class="select">
                                      <select id="mcurrentmonth" name="mcurrentmonth" class="form-control">
                                       <option value="MONTH">- Month -</option>
                                       <option value="0">0</option>
                                       <option value="1">1</option>
                                       <option value="2">2</option>
                                       <option value="3">3</option>
                                       <option value="4">4</option>
                                       <option value="5">5</option>
                                       <option value="6">6</option>
                                       <option value="7">7</option>
                                       <option value="8">8</option>
                                        <option value="9">9</option>
                                         <option value="10">10</option>

                                      </select>
                                       <i><font color="red"><span id="mmontherrormsg"></span></font></i>
                                   </label>
                              </section>
                    </div>
                    
                </fieldset> 
            	
            	<div class="paging-container" id="tablePaging"></div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-dark-blue" id="submitPatientMasterData" type="button">Submit</button>
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>


<!-- Select Medicine Popup Start -->
<div class="modal fade" id="searchNewPregnancyMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchNewPregnancyGenericMedicine()" id="saveData">Search</button></section>
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
<div class="modal fade" id="searchNewPregnancyDoctorMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchNewPregnancyDoctorMedicine()" id="saveData">Search</button></section>
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
<!-- Select Doctor Medicine Popup End -->

