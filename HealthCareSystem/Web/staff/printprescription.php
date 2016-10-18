<div class="col-md-12 sky-form" >
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
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
 
<div class="col-md-11"> 
    <div class="row">
        <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientName"  placeholder="Patient Name">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientID"  placeholder="Patient ID">
                      <input type="hidden" id="hidpatientID"  >
                    </label>
                    <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="appointmentID"  placeholder="Appointment ID">
                      <input type="hidden" id="hidappointmentid" >
                    </label>
                    <i><font color="red"><span id="staffappointmentid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="mobile"  placeholder="Mobile Number">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffpatientmobile"></span></font></i>
                </section>
                 <input type="button" class="btn-u pull-right"  name="button" id="searchPrintPrescription" value="search"/> 
            </div>
              
        </fieldset>
    </div>
    <div class="row">
    <fieldset>
        
          <section class="col-md-15">
                <br/>  
         
            <div class="col-md-15">
              <div class="panel panel-orange margin-bottom-10" id="listofpatients">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                </div>
                <table class="table table-striped" id="patient_consultation_records_search_print_result_table">
                    <thead>
                        <tr>

                            <th>AID</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="paging-container" id="tablePaging"></div>
            </div>

         </div>    
         </section>
           
        
    </fieldset>
    </div>    
    
    
</div>
 
</div>      