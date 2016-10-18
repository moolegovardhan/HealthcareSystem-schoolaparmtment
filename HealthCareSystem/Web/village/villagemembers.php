 <?php 
 session_start();
 $whatINeed = explode("/", $_SERVER['PHP_SELF']);
    $_SESSION['host'] = $_SERVER['HTTP_HOST'];
    $_SESSION['rootNode'] = $whatINeed[1];

    ?>   
 
<div class="col-md-12"> 
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script src="../js/state.js"></script>
  
    <?php if(strlen($_SESSION['message']) > 0) {?>
            <center><h5> User Registration Successful </h5></center>
    <?php } ?>
            <?php
include_once '../../Business/VillageData.php';

$sd = new VillageData();
$houselist = $sd->fetchVillageDetails($_SESSION['officeid']);

?>
           
  <form id="registerform"  action="../../Business/VillageMemberPhotoUpload.php" method="POST" class="sky-form"  enctype="multipart/form-data">   
 <fieldset>
    <div class="col-md-14">
        <div class="row">
            
<div class="panel panel-orange margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i>House Member Registration</h3>
                    </div>
    <div class="panel-body">
    
           <input type="hidden" id="host" value="<?php   print( $_SERVER['HTTP_HOST']);     ?>" />  
            <input type="hidden" id="rootnode" value="<?php print_r($whatINeed[1]);?>" />
                <input type="hidden" id="hosiptal" value="<?php echo $_SESSION['officeid'];?>"/>
            
            <!-- new layout start -->
             
            <!-- Section 1 end -->
               <fieldset >  
                <div class="col-md-12">
                 <div class="row">
                        
               <section class="col col-md-3">
                    <label class="select">
                                <select id="housenumber" name="housenumber" >
                                      <option value="nodata">- Select house number -</option>
                                       <?php  

                                               if(sizeof($houselist) > 0){
                                                   foreach($houselist as $house){

                                       ?>
                                      <option value="<?php  echo $house->id; ?>"><?php  echo $house->housenumber; ?></option>
                                      <?php
                                                   }
                                               }
                                      ?>


                                </select>
                     </label>   
               </section>
                     
<!--               <section class="col-md-3">
          <label class="input">
              <input type="text" id="nooffamilymembers"  name="nooffamilymembers" placeholder="Family Size" size="4" />    
            </label>
      </section>     -->
                
               
                     <section id="errormessages" class="col col-4 alert alert-info">
                            <b>  <font color="red">
                                <font><i><span id="proferrormsg"></span></i></font>  
                                  <font><i><span id="doctoriderrmsg"></span></i></font>  
                                <font><i><span id="nameerrormsg"></span></i></font> 
                                <font><i><span id="mnameerrormsg"></span></i></font> 
                                <font><i><span id="lnamerrormsg"></span></i></font>
                                <font><i><span id="useriderrmsg"></span></i></font> 
                                <font><i><span id="gendererrormsg"></span></i></font>   
                                 <font color="red"><i><span id="errmsg"></span></i></font>
                                <font><i><span id="emailerrormsg"></span></i></font> 
                                <font><i><span id="passworderrormsg"></span></i></font>  
                                  <font><i><span id="starterrormsg"></span></i></font> 
                                  <font color="red"> <span id="errorDisplay"></span> </font>
                                    <font><i><span id="mobileerrormsg"></span></i></font>  
                                    
                                    
                           </font>  </b> 
                       </section>
                    </div>
                </div>
             </fieldset>       
          <!-- Section 2 ends -->
          
        <fieldset>
          <div class="col-md-12">
             <div class="row">
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="name" name="name" placeholder="First Name">
                        </label>
                       
                     </section>
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="mname" name="mname" placeholder="Middle Name"> 
                         </label>
                       
                        </section>
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="lname" name="lname" placeholder="Last Name">
                               
                       </label>
                     </section> 
                  <section class="col col-4">
                    <label class="input">
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text" name="start" id="start" placeholder="Date of Birth"  readonly>
                              
                    </label>
                   </section>
                 <section class="col col-4">
                    <label class="input">
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text" name="age" id="age" placeholder="Age">
                              
                    </label>
                   </section>
                    <section class="col col-4">
                        <label class="select">
                           <select id="gender" name="gender" class="form-control">
                            <option value="">-- Select Gender --</option>
                           <option value="male">Male</option>
                                <option value="female">Female</option>

                           </select>
                               
                       </label>
                     </section> 
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="mobile" name="mobile" placeholder="Mobile #"   maxlength="10">
                                
                       </label>

                     </section>
                    
                     <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="email"  name="email" name="email" placeholder="Email" >
                                
                       </label>
                    </section>
                 <section class="col col-4">
                    <label for="file" class="input input-file">
                        <div class="button"><input placeholder="Photo"  type="file" name="filepres"  id="filepres" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</div><input type="text" name="filepres"  readonly>
                    </label>

                </section>
                 </div>
            </div>     
           </fieldset>
          <!-- end of section 3 -->
          <fieldset>
             <div class="col-md-12">
                 <div class="row">
                     <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-lock"></i>
                           <input type="text" id="aadharcard"  name="aadharcard" placeholder="Aadhar Card" maxlength="12"  > <font><i><span id="aadharerrormsg"></span></i></font>       
                       </label>
                     </section>
                      <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-user"></i>
                               <input type="text" id="altmobile"  name="altmobile" placeholder="ALT Mobile #" maxlength="10" >
                                 <font><i><span id="altmobileerrormsg"></span></i></font>       
                           </label>

                                <font color="red"><i><span id="errmsgaltmobile"></span></i></font>
                      </section> 
                      <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-user"></i>
                               <input type="text" id="landline"  name="landline" placeholder="Landline #"  maxlength="10">

                             </label>

                            <font color="red"><i><span id="errmsglandline"></span></i></font>
                       </section> 
                        <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-lock"></i>
                               <input type="text" id="address1"  name="address1" placeholder="Address Line 1">
                                 <font><i><span id="address1errormsg"></span></i></font>       
                           </label>
                        </section>
                       <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-lock"></i>
                               <input type="text" id="address2"  name="address2" placeholder="Address Line 2"  >
                                 <font><i><span id="address2errormsg"></span></i></font>       
                           </label>
                        </section>
                        <section class="col col-4">
                          <label class="select">
                            <select id="state" class="form-control">
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
                         </label>
                    </section> 
                      <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-lock"></i>
                           <input type="text" id="city"  name="city" placeholder="Village">      
                       </label>
                     </section> 
                     <section class="col col-4">
                          <label class="select">
                            <select id="district"  name="district" class="form-control">
                              <option value="DISTRICT">- District -</option>
                           
                            </select>     
                         </label>
                    </section>
                      <section class="col-md-4">
                    

                            <label class="select">
                           <select id="cardtype" name="cardtype" >
                                 <option value="cardtype">- Select Card Type -</option>
                                       
                                       <option value="SHP-800">SHP-800</option>
                                       <option value="SHP-1600">SHP-1600</option>
                                       <option value="SHP-2400">SHP-2400</option>

                            </select>
                       </label>   

                   </section>
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-user"></i>
                           <input type="text" id="zipcode"  name="zipcode" placeholder="Zipcode"  maxlength="7">
                       </label>

                         <font color="red"><i><span id="errmsgzipcode"></span></i></font>
                   </section> 
                  
                 </div>
             </div>  <input type="hidden" id="selectedpatientid" name="selectedpatientid">  
          </fieldset>     
          
          <!-- end of section 4 -->
            
          
             
            <div class="modal-footer">
               
                <input type="submit" value="Register HouseMembers" class="btn-u btn-u-primary" id="registerMemberk"/>
                
            </div>
        
    </div>
</div>   
</div>  
  </div> 
     </fieldset>
              </form>
</div>  
