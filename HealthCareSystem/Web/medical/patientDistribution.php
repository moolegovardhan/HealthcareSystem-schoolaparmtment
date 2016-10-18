<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../js/medicalmedicinesdistribute.js"></script>
<div class="row">
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
               <input type="button" class="btn-u pull-right"  name="button" id="searchPrescription" value="search"/>     
             </footer>  
          
         
          
     </div>
</div> 
    
    
</section>
<div class="col-md-9"  id="listofpatients"> 
    
          <section class="col-md-15">
                <br/>  
         
            <div class="col-md-15">
              <div class="panel panel-orange margin-bottom-10">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                </div>
                <table class="table table-striped" id="patient_consultation_records_search_result_table">
                    <thead>
                        <tr>
                            <th>AID</th>
                            <th>Patient Name</th>
                            <th>Hospital Name</th>
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
    
</div>
          
        <form action="../../Business/DistributeMedicine.php" method="POST">   
            <input type="hidden" name="hiddenpatientname"  id="hiddenpatientname" >
            <input type="hidden" name="hiddenpatientid"  id="hiddenpatientid" >
            
<div class="col-md-9"  id="listofmedicines"> 
      <input type="submit" class="btn-u pull-right"  name="submit" id="distributeMedicines" value=" Distribute "/> 
          <section class="col-md-15">
                <br/>  
         
            <div class="col-md-15">
              <div class="panel panel-orange margin-bottom-10">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>Medicine Details</h3>
                </div>
                <table class="table table-striped" id="patient_consultation_medicines_table">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Days #</th>
                            <th>Usage</th>
                            <!--th>MBM</th>
                            <th>MAM</th>
                            <th>ABM</th>
                            <th>AAM</th>
                            <th>EBM</th>
                            <th>EAM</th-->
                            <th>Distributed</th>
                            <th>Count</th>
                            <th>Batch Number</th>
                            <th>Cost</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

         </div>    
         </section>
    
</div>    
        <input type="hidden" name="hidcount" id="hidcount" value=""/> 
 </form>    
    </fieldset> 
</div>
</div>