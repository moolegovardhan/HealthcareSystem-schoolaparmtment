<?php
include_once '../../Business/IndustryData.php';
$sd = new IndustryData();

$officeid = $_SESSION['officeid'];
$schoolProfile = $sd->fetchIndustryProfile($officeid);
if(count($schoolProfile) > 0 ){
    $schoolData = $schoolProfile[0];
}
?>
<div class="col-md-12">
   
    <div class="panel panel-red">

        <div class="panel-heading">
             
            <h3 class="panel-title"><i class="fa fa-user"></i> Industry Profile   </h3>
        </div>
        <div class="panel-body">

            <form class=" sky-form" action="../../Business/IndustryProfile.php" method="POST">
                <input type="hidden" name="uniqueid" value="<?php  echo $schoolData->unqiueid; ?>"/>
                <fieldset>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="industryname" name="industryname"  placeholder="Industry Name" class="valid"  value="<?php  echo $schoolData->industryname; ?>">

                           </label>
                       </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="licno" name="licno"  placeholder="Lic No" class="valid" value="<?php  echo $schoolData->licensenumber; ?>">

                       </label>
                   </section>
                    <section class="col col-md-4">
                        <label class="select">
                          <select id="category" name="category" class="form-control" class="valid" >
                           <option value="">-- Select Industry Category --</option>
                          <option value="IronOre">Iron Ore</option>
                          
                          </select>
                     </label>  
                   </section> 
                   
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="deptcount" name="deptcount"  placeholder="Department Count" class="valid" value="<?php  echo $schoolData->totaldepartments; ?>">

                       </label>
                   </section>
                    <section id="doctoriddiv" class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="mobile" name="mobile"  placeholder="Mobile" class="valid" value="<?php  echo $schoolData->mobile; ?>">

                       </label>
                   </section>
                   <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="landline" name="landline"  placeholder="Landline" class="valid" value="<?php  echo $schoolData->landline; ?>">

                           </label>
                     </section> 
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <input type="text" id="email" name="email"  placeholder="Email" class="valid" value="<?php  echo $schoolData->email; ?>">

                           </label>
                     </section>
                 
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

                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <textarea id="address1" name="address1" rows="3" cols="20"><?php  echo $schoolData->addressline1; ?></textarea>

                           </label>
                     </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                               <textarea id="address2" name="address2" rows="3" cols="20"><?php  echo $schoolData->addressline2; ?></textarea>

                           </label>
                     </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                            <input type="text" id="city" name="city"  placeholder="City" class="valid" value="<?php  echo $schoolData->city; ?>">
                           </label>
                     </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                             <input type="text" id="district" name="district"  placeholder="District" class="valid" value="<?php  echo $schoolData->district; ?>">
                           </label>
                     </section>
                    <section id="doctoriddiv" class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-asterisk"></i>
                             <input type="text" id="pincode" name="pincode"  placeholder="Pincode" class="valid" value="<?php  echo $schoolData->zipcode; ?>">
                           </label>
                     </section>
                    
                            
                                  </label>  
                               </section> 
                   
                </fieldset>
                     <div class="modal-footer">
                        <input type="submit" value="Submit Details"class="btn-u btn-u-primary" id="submitSchool"/>

                    </div>
            </form>
            
        </div>
    </div>
</div>    
    