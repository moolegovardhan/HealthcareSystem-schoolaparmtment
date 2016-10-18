
<div class="col-md-10 pull-right" id="medicineSearchErrorBlock">
	<div class="row">
		<center>
                  <i>
                  <div class="alert alert-info fade in">
	                  <span id="medicineSearchErrorMessage">
	            	</span>
	            </div>
        	</i>
    	</center>
	</div>
</div>
 
 <div class="col-md-3">
     <div class="panel panel-orange" id="prescriptionsearchpanel">
    <div class="panel-heading">
        <h3 class="panel-title">Medicines Search</h3>
     </div>
     <div class="panel-body"> 
       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="patientName"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientId"  placeholder="Patient Id">
                    </label>
                    <i><font color="red"><span id="patientId"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="appointmentId"  placeholder="Appointment Id">
                    </label>
                    <i><font color="red"><span id="appointmentId"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="mobileNo"  placeholder="Mobile No.">
                    </label>
                    <i><font color="red"><span id="mobileNo"></span></font></i>
                </section>
            </div>
         </fieldset> 
           <footer>
               <input type="button" class="btn-u pull-right"  name="button" id="searchMedicine" value="Search"/>     
             </footer>  
          
         
           
           
         </form>
     </div>
</div> 
    
</div>
