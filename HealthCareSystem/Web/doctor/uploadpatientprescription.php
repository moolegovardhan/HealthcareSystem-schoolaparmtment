<div class="col-md-12   sky-form" >
<fieldset>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/doctorPrescription.js"></script>
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
<section class="col-md-3">

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
                                Search Prescription
                            </a>
                        </h4>
                        </div>
                        <div id="collapse-One" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="row">
                                   
                                    <div class="col-md-10">
                                       
                                        <div class="row">
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
                                        </div>
                                       <footer>
                                           <input type="button" class="btn-u pull-right"  name="button" id="searchPrescription" value="search"/>     
                                         </footer>  
                                        
                                        
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
                                    General Health Info
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-Two" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="row">
                                     <table class="table table-striped" id="table_patient_general_info">
                                        <thead>
                                            <tr>
                                               <th>Parameter Name</th>
                                               <th>Value</th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                             
                                         </tbody>
                                     </table>   
                                </div>
                            </div>
                        </div>   
                    </div>
                    <!-- end of second-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Three">
                                    Medical Health Info
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-Three" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <table class="table table-striped" id="table_patient_medical_info">
                                        <thead>
                                            <tr>
                                               <th>Parameter Name</th>
                                               <th>Value</th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                             
                                         </tbody>
                                     </table> 
                                </div>
                            </div>
                        </div>   
                    </div>
                    <!-- end of Third-->
           
       </div>  
         
          
     </div>
</div> 
    
    
</section>
   <form action="../../Business/DoctorPrescriptionUpload.php" method="POST" enctype="multipart/form-data">     

<div class="col-md-9"> 
    <section class="col-md-14">    
<?php include_once 'prescriptionsearch.php'; ?>
    </section>
 
  
<section id="prescriptionpanel" class="col-md-13"> 
    <!--input type="button" class="btn-u pull-right"  name="button" id="showPatientGeneralInfo" value=" Patient General Info "/>     
    
    <input type="button" class="btn-u pull-right"  name="button" id="showPatientMedicalInfo" value=" Patient Medical Info "/-->     
   
    
    <input type="button" class="btn-u pull-right"  name="button" id="showPatientHistory" value=" Patient History "/>     
    
    
    <input type="submit" class="btn-u pull-right"  name="submit" id="showPrescriptionSearch" value="Submit"/>     
    
    <input type="button" class="btn-u pull-right"  name="button" id="showPrescriptionSearchResult" value="Search Result"/> 
       
<div class="panel panel-orange">
    <div class="panel-heading">
        <h4 class="panel-title">Prescription</h4>
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
                    
                </section>
                <section class="col col-6">
                    <label class="label"><b>Hospital Name :   </b>
                        <span id="hospitalName"><i></i></span></label>
                         <input type="hidden" name="hidhospitalName" id="hidhospitalName"/>
                          <input type="hidden" name="hidhospitalId" id="hidhospitalId"/> 
                </section> 
                  <section class="col col-4">
                    <label class="label"><b>Doctor Name :  </b>
                        <span id="doctorName"><i></i></span>
                         <input type="hidden" name="hiddendoctorName" id="hiddendoctorName"/> 
                          <input type="hidden" name="hiddendoctorId" id="hiddendoctorId"/> 
                    </label>
                </section>
                <section class="col col-4">
                    <label class="label"><b>Appointment Date : </b>
                        <span id="appointmentDate"><i></i></span>
                         <input type="hidden" name="hidappointmentDate" id="hidappointmentDate"/>
                    </label>
                </section> 
             <section class="col col-4">
                     <label class="checkbox"> 
                         <input type="checkbox" id="inpatient"  name="inpatient" value="inpatient" checked="true">
                         <i class="rounded-4x"></i>Admit as inpatient. 
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
                <label class="select">
                    <select id="refertohospital" name="refertohospital">
                        <option value="REFERRAL">-- Referral Hospital Name--</option>
                        <?php foreach ($hosiptal as $data) { ?>
                         <option value='<?php echo $data->id; ?>'><?php echo $data->hosiptalname; ?></option>
                        <?php  } ?>       

                    </select>
                 </label>
         </section>
              
    </div>    
            <div class="row">
               
                 <section class="col col-8">
                        <label class="select select-multiple col-md-7">
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
                     <label class="input col-md-5">
	                 <input type="text"  name="otherdiseases"  id="otherdiseases">
                    </label>
            
                      </section>   
                   <section class="col col-4">
                    <label class="select">
                          <select id="presdiagnostics" name="presdiagnostics">
                              <option value="Diagnostics" >-------- Select Diagnostics ----------</option>
                              <option value="Others">Others</option>
                              <?php foreach($favDiagList as $value){?>
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
                              <?php foreach( $testsList as $value){?>
                                 <option value=<?php echo $value->id;?>><?php echo $value->testname;?></option>
                              <?php } ?>
                              <!--option value="Blood Test">Vijaya</option>
                              <option value="Sugar">Ravi</option-->
                              
                          </select>
                      </label>
                  </section> 
            <section class="col col-6">
                 <label class="input"> 
                     <textarea cols="30" rows="3" name="description" id="description" placeholder="Docotr Observations"></textarea>

                     <font color="red"><i><span id="enderrormsg"></span> </i></font>
                   </label>
            </section>
            
         </div>
         
         <div class="row">
             
            <section class="col col-md-12">
                 <label class="input"> 
                     <textarea cols="30" rows="3" name="suggestions" id="suggestions" placeholder="Docotr Suggestions" style="width:100%; height:100px;"></textarea>
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
        <div class="row">
               
             <section class="col col-md-6">
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
                  <label class="label"> <b>Other Medicines</b></label>
                  <label class="input"> 
                        <i class="icon-append fa fa-user"></i>
                        <input type="text" name="omedicines" id="omedicines" placeholder="Other Medicines">
                         <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                    </label>
            </section>
            <section class="col col-md-4">
                <label class="label"> <b>No Of Days</b></label>
                  <label class="input"> 
                        <i class="icon-append fa fa-user"></i>
                        <input type="text" name="noofdays" id="noofdays" placeholder="No of Days">
                         <font color="red"><i><span id="nooferrmsg"></span> </i></font>
                    </label>
            </section>
             <section class="col col-md-3">
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
                                       <td nowrap><h6>Name</h6></td>
                                            <td><h6># Days</h6></td>
                                            <td><h6>Usage</h6></td>
                                            <td><h6>MBM</h6></td>
                                            <td><h6>MAM</h6></td>
                                            <td><h6>ABM</h6></td>
                                            <td><h6>AAM</h6></td>
                                            <td><h6>EBM</h6></td>
                                            <td><h6>EAM</h6></td>
                                            <td nowrap><h6>Action</h6></td>
                                        </tr>
                                        <thead>
                                    <tbody></tbody>
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
</div>
    <div class="col-md-9" id="patientHistoryPanel">  
                        
            <div class="panel panel-orange margin-bottom-40">
            <div class="panel-heading">
                <h5 class="panel-title"><i class="fa fa-edit"></i>History of Prescription</h5>
            </div>
            <table class="table table-striped" id="patient_prescription_history">
                <thead>
                    <tr>
                        <th nowrap>App ID</th>
                        <th nowrap>App Date</th>
                        <th nowrap>Doctor Name</th>
                         <th nowrap>Comments</th>
                        <th nowrap></th>
                        <th nowrap></th>
                        <th nowrap></th>
                        
                    </tr>
                 </thead>    
                     <?php foreach ($consultations as $value) { ?>
                        <tr>
                            <td><?php echo $value->id;  ?></td>
                            <td><?php echo $value->AppointementDate;  ?></td>
                            <td><?php echo $value->DoctorName; ?></td>
                            <td><?php echo $value->HospitalName; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php } ?> 
               
                <tbody>

                </tbody>
            </table>
        </div>         
          <div class="modal-footer">
              <button data-dismiss="modal" class="btn-u btn-u-default" type="button" onclick="goBack()">Back</button>
        </div>
         </div>
</fieldset>
    
   </form>    
</div>



 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Prescription</h4>
                </div>
                <div class="modal-body">
                
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap">
                       <table class="tg" id="PatientPrescriptionTable" width="100%">
                         <thead>
                          <tr>
                              <th class="tg-uhkr"><b>Doctor Observation</b></th>
                            <th class="tg-uhkr"><b>Doctor Suggestions</b></th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

<div class="modal fade" id="myReportsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Reports</h4>
                </div>
                <div class="modal-body">
                
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap">
                       <table class="tg" id="PatientReportsTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Report Name</th>
                            <th class="tg-uhkr">Parameter Name</th>
                            <th class="tg-uhkr">Value</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>



<div class="modal fade" id="myMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Medicines</h4>
            </div>
            <div class="modal-body">

                <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap"><table class="tg" id="PatientMedicineTable">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Medicine Name</th>
                            <th class="tg-uhkr">Usage</th>
                            <th class="tg-uhkr" colspan="2">Morning {Breakfast}</th>
                            <th class="tg-uhkr" colspan="2">Afternoon {Meal}</th>
                            <th class="tg-uhkr" colspan="2">Night {Meal}</th>
                            <th class="tg-uhkr">Days #</th>
                          </tr>
                          <tr>
                            <td class="tg-031e"></td>
                            <td class="tg-031e"></td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-031e"></td>
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>


<!-- Select Medicine Popup Start -->
<div class="modal fade" id="searchMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
            		<section class="col col-md-6">
                            <button class="btn-u btn-u-orange" type="button" onclick="searchDoctorPageGenericMedicine()" id="saveData">Search</button>
                        </section>
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
    <div class="modal-dialog modal-lg">
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

<div class="modal fade sky-form-modal-overlay" id="myGeneralParametersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Health Data</h4>
                </div>
                <div class="modal-body">
                
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap">
                       <table class="tg" id="PatientParametersTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Parameter ID</th>
                            <th class="tg-uhkr">Parameter Name</th>
                            <th class="tg-uhkr">Parameter Value</th>
                            <th class="tg-uhkr">Observation</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                                
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                     <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>


<div class="modal fade sky-form-modal-overlay" id="myMedicalParametersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Medical Data</h4>
                </div>
                <div class="modal-body">
                
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap">
                       <table class="tg" id="PatientMedicalParametersTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Parameter ID</th>
                            <th class="tg-uhkr">Parameter Name</th>
                            <th class="tg-uhkr">Parameter Value</th>
                            <th class="tg-uhkr">Observation</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                                
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>