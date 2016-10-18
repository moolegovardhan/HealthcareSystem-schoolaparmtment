<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  
<script src="../js/patientmedicineorder.js"></script>  
<div class="col-md-15 sky-form">
<fieldset>
    <div class="row">
        
      
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="mobilenumber" placeholder="Mobile Number"/>
            </label>
       <font color="red"><i><span id="mobileerror"></span></i></font>    
      </section>
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="patientname" placeholder="Patient Name"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section> 
        <section class="col-md-3">
         <button type="button" class="btn-u"  name="button" id="fetchAllPatientDetails" > Search </button>
        </section> 
         <section class="col-md-3">
         <button type="button" class="btn-u"  name="button" id="moveBacktoMain" > Back </button>
        </section> 
              
     </div>     

  </fieldset>
    <div id="patientmaintable"> 
    <fieldset>
        <table class="table table-striped" id="patient_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                    <td><b>Patient Name</b></td>
                    <td><b>Patient ID</b></td>
                    <td><b>Mobile</b></td>
                     <th>Date of Birth</th>
                     <th>Gender</th>
                    <td><b>Action</b></td>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>
  </div>
 <div id="patientappointmentmaintable"> 
    <fieldset>
        <table class="table table-striped" id="patient_appointment_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                    <td><b>Appointment ID</b></td>
                    <td><b>Appointment Date</b></td>
                    <td><b>Slot</b></td>
                    <td><b>Amount</b></td>
                     <th>Hospital</th>
                       <th>Doctor</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>
  </div> 
    
  <div id="patienttransactionmaintable"> 
    <fieldset>
        <table class="table table-striped" id="patient_transaction_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                    <th>Receipt ID</th>
                        <th>Payment For</th>
                       <th>Payment Date</th>
                      <th>Amount</th>
                      <th>Payment Type</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>
  </div>   
</div>