<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../js/callcenteramount.js"></script>
<div class="col-md-12   sky-form" >
    <fieldset>
      <section class="col-md-3">

        <div class="panel panel-orange" id="prescriptionsearchpanel">
        <div class="panel-heading">
            <h3 class="panel-title">Prescription : Consultation</h3>
         </div>
         <div class="panel-body"> 
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
                   <input type="button" class="btn-u pull-right"  name="button" id="searchCompletedPrescription" value="search"/>     
                 </footer>  
       </div>
    </div> 
    </section>  
    <section class="col-md-9">
                <br/>  
         
            <div class="col-md-15">
              <div class="panel panel-orange margin-bottom-10">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                </div>
                <table class="table table-striped" id="patient_prescription_records_nonpaid_search_result_table">
                    <thead>
                        <tr>

                            <th>AID</th>
                            <th>Patient Name</th>
                            <th>Appointment Date</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

         </div>    
         </section>    
        <input type="hidden" name="hidcount" id="hidcount" />
        
    </fieldset> 
</div>