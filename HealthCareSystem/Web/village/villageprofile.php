<?php
session_start();
include_once '../../Business/VillageData.php';
$sd = new VillageData();


$officeid = $_SESSION['officeid'];
$villageProfile = $sd->fetchVillageProfile($officeid);

if(count($villageProfile) > 0 ){
    $villageData = $villageProfile[0];
}
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script src="../js/state.js"></script>
<div class="col-md-12">
   
    <div class="panel panel-red">

        <div class="panel-heading">
             
            <h3 class="panel-title"><i class="fa fa-user"></i> Village Profile   </h3>
        </div>
        <div class="panel-body">

            <form class=" sky-form" action="../../Business/VillageProfile.php" method="POST">
                <input type="hidden" name="uniqueid" value="<?php  echo $villageData->unqiueid; ?>"/>
                <fieldset>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="villagename" name="villagename"  placeholder="Village Name" class="valid"  value="<?php  echo $villageData->villagename; ?>">

                           </label>
                       </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="govtregno" name="govtregno"  placeholder="Government Registration No" class="valid" value="<?php  echo $villageData->govtregno; ?>">

                           </label>
                     </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="precidentname" name="precidentname"  placeholder="President Name" class="valid" value="<?php  echo $villageData->precidentname; ?>">

                       </label>
                   </section>
                  <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="noofstreets" name="noofstreets"  placeholder="No Of Streets " class="valid" value="<?php  echo $villageData->noofstreets; ?>">

                       </label>
                   </section>                    
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="noofhouses" name="noofhouses"  placeholder="No Of Houses " class="valid" value="<?php  echo $villageData->noofhouses; ?>">

                       </label>
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="villagepopulation" name="villagepopulation"  placeholder="Village Population" class="valid" value="<?php  echo $villageData->villagepopulation; ?>">

                       </label>
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="noofmales" name="noofmales"  placeholder="No Of Males" class="valid" value="<?php  echo $villageData->noofmales; ?>">

                       </label>
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="nooffemales" name="nooffemales"  placeholder="No Of Females" class="valid" value="<?php  echo $villageData->nooffemales; ?>">

                       </label>
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="noofchildren" name="noofchildren"  placeholder="No Of Children" class="valid" value="<?php  echo $villageData->noofchildren; ?>">

                       </label>
                   </section>
                    
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="noofseniorcitizens" name="noofseniorcitizens"  placeholder=" NoofSeniorCitizens" class="valid" value="<?php  echo $villageData->noofseniorcitizens; ?>">

                       </label>
                   </section>
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="mobile" name="mobile"  placeholder="Mobile" class="valid" value="<?php  echo $villageData->mobile; ?>">

                       </label>
                   </section>
                   <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="landline" name="landline"  placeholder="Landline" class="valid" value="<?php  echo $villageData->landline; ?>">

                           </label>
                     </section> 
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="email" name="email"  placeholder="Email" class="valid" value="<?php  echo $villageData->email; ?>">

                           </label>
                     </section>
                     <section class="col col-md-4">
                          <label class="select">
                            <select id="state" name="state" class="form-control" required="true"  value="<?php  echo $villageData->state; ?>">
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
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <textarea id="address1" name="address1" rows="3" cols="20" placeholder="Address1"><?php  echo $villageData->addressline1; ?></textarea>

                           </label>
                     </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <textarea id="address2" name="address2" rows="3" cols="20" placeholder="Address2"><?php  echo $villageData->addressline2; ?></textarea>

                           </label>
                     </section>
                     <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                            <input type="text" id="city" name="city"  placeholder="City" class="valid" value="<?php  echo $villageData->city; ?>">
                           </label>
                     </section>
                   <section class="col col-4">
                            <label class="select">
                            <select id="district" name="district" class="form-control" >
                               <option value="DISTRICT">- District -</option>
                            </select> 
                            <font><i><span id="districterrormsg"></span></i></font>       
                           </label>
                       </section>
                   <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                             <input type="text" id="mandal" name="mandal"  placeholder="Mandal" class="valid" value="<?php  echo $villageData->mandal; ?>">
                           </label>
                     </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                             <input type="text" id="pincode" name="pincode"  placeholder="Pincode" class="valid" value="<?php  echo $villageData->pincode; ?>">
                           </label>
                     </section>
                          
                   
                </fieldset>
                     <div class="modal-footer">
                        <input type="submit" value="Submit Details"class="btn-u btn-u-primary" id="submitVillage"/>

                    </div>
            </form>
            
        </div>
    </div>
</div>    
    