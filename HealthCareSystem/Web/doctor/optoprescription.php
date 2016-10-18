<div class="col-md-12   sky-form" >
<fieldset>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/opthoprescription.js"></script>
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
     <form action="../../Business/DoctorOpthamologyPrescriptionUpload.php" method="POST" enctype="multipart/form-data">     
  
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
                                    <table class="table table-striped" id="patient_opthomology_consultation_records_search_result_table">
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
                   
                       
                      <div id="collapse-Two" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-15 sky-form inline-group" >
                                        
                                        <input type="submit" class="btn-u pull-right" style="margin-right: 35px;margin-top: 15px;" name="submit" id="showPrescriptionSearch" value="Submit"/>
                                       
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
               <section class="col-md-6">
                <label class="input"> 
                         <textarea cols="50" rows="5" name="complaints" id="complaints" placeholder="Complaints"></textarea>
                         
                         <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
               </section> 
                
            </div>   
            <div class="row">
            <section class="col col-md-12">
              <table class="table table-striped" id="patient_records_table">
                     <tr>

                            <td><h6></h6></td>
                            <td><h6>Right Eye</h6></td>
                            <td><h6>Left Eye</h6></td>
                        </tr>
                    <tbody>
                       <tr>

                            <td>Diagnosis</td>
                            <td><input type="textbox" name="rDiagnosis" id="rightdiagnosis" /></td>
                            <td><input type="textbox" name="lDiagnosis" id="lDiagnosis"/></td>
                        </tr>
                          <tr>

                            <td>DiagnosisCode </td>
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
               <!-- <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-dark-blue" id="submitPatientOpthoMasterData" type="button">Submit</button>
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>-->
            </div>
            </section>
        </div>
        </div>
                                </div>
                                </div>
                            </div>
                      </div>    
                      
                  
                        </div>   
                    </div>
                    <!-- end of second--> 
            </div> 
             
         </div>
   </div>   
    
</section>
             
                    </form>
</fieldset>

</div>