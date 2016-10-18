<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../js/appointmentwisemedicines.js"></script>
<div class="col-md-15 sky-form">
<fieldset>
    <div class="row">
        <section class="col">
            
        </section>  
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="patientId" placeholder="Patient Id"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="patientname" placeholder="Patient Name"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="mobile" placeholder="Mobile Number"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
         
     </div>     

         <div class="row">
             <section class="col-md-1"></section>
     <section class="col-md-3">
      <button type="button" class="btn-u"  name="button" id="searchformedicines" > Search </button>
     </section> 
      <section class="col-md-3">
      <b>Patient Name : </b><span id="patientname"><font color="blue"><i><h3></h3></i></font></span> 
      </section>
      
     </div>     

  </fieldset>
    <fieldset>
        <table class="table table-striped" id="patient_appointment_medicines_table">
            <thead>
                <tr>
                    <th>Appointment Date</th>
                    <th>Doctor Name</th>
                    <th>Hospital Name</th>
                    <th>Medicine Name</th>
                    <th>Dosage</th>
                    <th>MBB</th>
                    <th>MAB</th>
                    <th>ABM</th>
                    <th>AAM</th>
                    <th>EBD</th>
                    <th>EAD</th>
                    <th>No Of Days</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>
    
</div>   