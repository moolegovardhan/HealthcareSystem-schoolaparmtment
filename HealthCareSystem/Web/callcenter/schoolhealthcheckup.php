<?php session_start(); ?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/schoolhealthcheckup.js"></script> 
<?php
include_once '../../Business/SchoolData.php';


?>
<form method="post" action="../../Business/createschoolappointment.php">
    
<fieldset>
    <section class="col-md-1"></section>
     <section>
<div class="col-md-12 sky-form" >
    
    <fieldset>
        
        <section class="col col-md-4">
                          <label class="select">
                            <select id="state" name="state" class="form-control" required="true"  value="<?php  echo $schoolData->state; ?>">
                             <option value="">-- Select State --</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option> 
                            <option value="Assam">Assam</option> 
                            <option value="Bihar">Bihar</option>
                            <option value="Chandigarh">Chandigarh </option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Dadra and Nagar Haveli ">Dadra and Nagar Haveli </option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="New Delhi">New Delhi</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Puducherry">Puducherry</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            </select>
                              <font><i><span id="stateerrormsg"></span></i></font>       
                         </label>
                    </section>
                     <section class="col col-4">
                            <label class="select">
                            <select id="district" class="form-control" >
                               <option value="DISTRICT">- District -</option>
                            </select> 
                            <font><i><span id="districterrormsg"></span></i></font>       
                           </label>
                       </section>
                   <section class="col col-4">
                            <label class="select">
                            <select id="schoollist" class="form-control" >
                               <option value="School">- School -</option>
                            </select> 
                            <font><i><span id="districterrormsg"></span></i></font>       
                           </label>
                       </section>
                     <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                             <input type="text" id="start" name="start"  placeholder="Appointment Date" class="valid">
                           </label>
                     </section>
         
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="addSchoolAppointmentData" > Add Data </button>
        </section>
        <section class="col-md-3">
               <button type="submit" class="btn-u"  name="submit" id="createSchoolDetails" > Create Appointments </button>
       
        </section>
    </fieldset>
    <fieldset>
        <section class="col-md-12">
        <table class="table table-striped" id="school_appointment_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    <td><b>School Id</b></td>
                    <td><b>School Name</b></td>
                     <td><b>Appointment Date</b></td>
                     <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
            <div id="labtabledata">

                </div>    
               </div>  <input type="hidden"  name="counter" id="counter" />
        </section>  
        
    </fieldset>
    </section>
    
  </fieldset>  
</div>
</form>         