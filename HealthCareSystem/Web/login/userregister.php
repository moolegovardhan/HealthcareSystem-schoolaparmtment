 <?php  $whatINeed = explode("/", $_SERVER['PHP_SELF']);
            $_SESSION['host'] = $_SERVER['HTTP_HOST'];
            $_SESSION['rootNode'] = $whatINeed[1];
        include_once ('../../Business/DiagnosticData.php');
        $dd = new DiagnosticData();
        $departments = $dd->getdepartments();
?>  
 <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script src="../js/state.js"></script>
<div class="col-md-12">
   
<div class="panel panel-red">
   
<div class="panel-heading">
     <button type="button" class="btn-u btn-u-default pull-right" onclick="showLogin()">BACK TO LOGIN</button>
    <h3 class="panel-title"><i class="fa fa-user"></i> User Registration    </h3>
</div>
    <div class="panel-body">
    
           <input type="hidden" id="host" value="<?php   print( $_SERVER['HTTP_HOST']);     ?>" />  
            <input type="hidden" id="rootnode" value="<?php print_r($whatINeed[1]);?>" />
                
        <form id="registerform"  action="#" method="post" id="sky-form1" class="sky-form">   
           
                
            <!-- new layout start -->
             <fieldset>   
               <div class="col-md-12">
                   <div class="row">
                        <section class="col col-4">
                             <label class="select">
                                <select id="profession" class="form-control" class="valid">
                                 <option value="">-- Select Profession --</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Staff">Hospital Staff</option>
                                <option value="Lab">Lab Staff</option> 
                                <option value="Medical">Medical Shop Staff</option> 
                                <option value="Others">Others</option> 
                                </select>
                                    
                            </label>  
                         </section> 
                         <section id="doctoriddiv" class="col col-4">
                             <label class="input">
                                <i class="icon-append fa fa-asterisk"></i>
                                <input type="text" id="doctorrepid" name="newuser"  placeholder="Doctor ID" class="valid">
                                      
                            </label>
                        </section>
                        <section class="col col-4" id="doctoriddeptdiv">
                             <label class="select">
                                <select id="department" class="form-control" class="valid">
                                 <option value="">-- Select Department --</option>
                                <?php foreach($departments as $value){ ?>
                                 <option value="<?php echo $value->id?>" ><?php echo $value->departmentname ?></option> 
                                <?php } ?>
                                </select>
                                    
                            </label>  
                         </section>
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
                                     <font><i><span id="address1errormsg"></span></i></font> 
                                      <font><i><span id="cityerrormsg"></span></i></font> 
                                    <font><i><span id="districterrormsg"></span></i></font> 
                                    <font><i><span id="zipcodeerrormsg"></span></i></font> 
                                    <font><i><span id="aadharerrormsg"></span></i></font>
                                     <font><i><span id="stateerrormsg"></span></i></font> 
                           </font>  </b> 
                       </section>
                    </div>
               </div> 
             </fieldset>
            <!-- Section 1 end -->
               <fieldset >  
                <div class="col-md-12">
                 <div class="row">
                        <section class="col col-4">
                             <label class="input">
                                <i class="icon-append fa fa-asterisk"></i>
                                <input type="text" id="newuser" name="newuser"  placeholder="User Id" min="5" maxlength="11" class="form-control  state-success" required>
                                        
                            </label>
                        </section>
                          
                        <section class="col col-4">
                             <label class="input">
                                <i class="icon-append fa fa-asterisk"></i>
                                <input type="password" id="newuserpassword" placeholder="Password"  min="5" maxlength="11"   class="form-control  state-success"  required>
                                
                            </label>
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
                           <input type="text" id="name" placeholder="First Name"  class="form-control  state-success"   required>
                        </label>
                       
                     </section>
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="mname" placeholder="Middle Name"  class="form-control  state-success"  > 
                         </label>
                       
                        </section>
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="lname" placeholder="Last Name"  class="form-control  state-success"   required>
                               
                       </label>
                     </section> 
                  <section class="col col-4">
                    <label class="input">
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text" name="start" id="start" placeholder="Date of Birth" required readonly>
                              
                    </label>
                   </section>
                   <section class="col col-4">
                        <label class="input">
                            <i class="icon-append fa fa-calendar"></i>
                            <input type="text" name="age" id="age" placeholder="Age" >

                        </label>
                   </section>
                    <section class="col col-4">
                        <label class="select">
                           <select id="gender" class="form-control" required>
                            <option value="">-- Select Gender --</option>
                           <option value="male">Male</option>
                                <option value="female">Female</option>

                           </select>
                               
                       </label>
                     </section> 
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="mobile" placeholder="Mobile #" required  maxlength="10">
                                 
                       </label>

                     </section>
                    
                     <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="email" name="email" placeholder="Email" >
                                
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
                           <input type="text" id="aadharcard" placeholder="Aadhar Card" maxlength="12" class="form-control  state-success"   > <font><i><span id="aadharerrormsg"></span></i></font>       
                       </label>
                     </section>
                      <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-user"></i>
                               <input type="text" id="altmobile" placeholder="ALT Mobile #" maxlength="10" >
                                 <font><i><span id="altmobileerrormsg"></span></i></font>       
                           </label>

                                <font color="red"><i><span id="errmsgaltmobile"></span></i></font>
                      </section> 
                      <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-user"></i>
                               <input type="text" id="landline" placeholder="Landline #"  maxlength="13">

                             </label>

                            <font color="red"><i><span id="errmsglandline"></span></i></font>
                       </section> 
                        <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-lock"></i>
                               <input type="text" id="address1" placeholder="Address Line 1"   required>
                                 <font><i><span id="address1errormsg"></span></i></font>       
                           </label>
                        </section>
                       <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-lock"></i>
                               <input type="text" id="address2" placeholder="Address Line 2"  >
                                 <font><i><span id="address2errormsg"></span></i></font>       
                           </label>
                        </section>
                        <section class="col col-4">
                          <label class="select">
                            <select id="state" class="form-control" required="true">
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
                        <label class="input">
                           <i class="icon-append fa fa-lock"></i>
                           <input type="text" id="city" placeholder="City"   required>
                             <font><i><span id="cityerrormsg"></span></i></font>       
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
                        <label class="input">
                           <i class="icon-append fa fa-user"></i>
                           <input type="text" id="zipcode" placeholder="Zipcode" required  maxlength="7">
                             <font><i><span id="zipcodeerrormsg"></span></i></font>       
                       </label>

                         <font color="red"><i><span id="errmsgzipcode"></span></i></font>
                   </section> 
                      <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-lock"></i>
                               <input type="text" id="plociyid" placeholder="Policy ID">     
                           </label>
                    </section>
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-user"></i>
                           <input type="text" id="policytype" placeholder="Policy Type" >
                       </label>
                   </section>  
                     
                 </div>
             </div><input type="hidden" name="fromrequest"  id="fromrequest" value="Web">
          </fieldset>     
          
          <!-- end of section 4 -->
          <!-- new layout end -->  
                <!--div class="row col-md-4"><!--div class="col-md-6">
                      <fieldset>
                        
                       </fieldset> 
                        <fieldset>
                    
                            
                            
                           
                        </fieldset>
                </div-->
             <!--div class="row col-md-4"><!--div class="col-md-6">
                      <fieldset>
                        
                       </fieldset> 
                        <fieldset>
                         
                           
                          
                            
                        </fieldset>
                </div-->
                <!--     <fieldset>
                          
                       </fieldset> 
                     <fieldset>
                       
                         
                         <section>
                             <label class="select">
                                <select id="profession" class="form-control">
                                 <option value="">-- Select Profession --</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Staff">Hospital Staff</option>
                                <option value="Others">Others</option> 
                                </select>
                                <font><i><span id="proferrormsg"></span></i></font>       
                            </label>  
                         </section>  
                       </fieldset> 
          -->
        </form>     
            <div class="modal-footer">
                <input type="button" value="Register User"class="btn-u btn-u-primary" id="registerNewUser"/>
                
            </div>
        
    </div>
</div>   
</div>    