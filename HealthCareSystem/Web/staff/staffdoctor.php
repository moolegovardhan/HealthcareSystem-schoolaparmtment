 <?php  $whatINeed = explode("/", $_SERVER['PHP_SELF']);
    $_SESSION['host'] = $_SERVER['HTTP_HOST'];
    $_SESSION['rootNode'] = $whatINeed[1];
include_once ('../../Business/DiagnosticData.php');

$dd = new DiagnosticData();
$departments = $dd->getdepartments();
    ?>  

<div class="col-md-12 sky-form"> 
      <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
          <script src="../js/start.js"></script>
     <script src="../js/staffdoctor.js"></script>
<script src="../js/jquery.uploadify.min.js" type="text/javascript"></script>
     <!--form id="registerform"  action="#" method="POST" class="sky-form"-->   
 <fieldset>
    <div class="col-md-14">
        <div class="row">
            
<div class="panel panel-orange margin-bottom-40">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i>Doctor Registration</h3>
    </div>
    <div class="panel-body">
    
           <input type="hidden" id="host" value="<?php   print( $_SERVER['HTTP_HOST']);     ?>" />  
            <input type="hidden" id="rootnode" value="<?php print_r($whatINeed[1]);?>" />
                <input type="hidden" id="hosiptal" value="<?php echo $_SESSION['officeid'];?>"/>
     <form id="doctorRegisterform"  action="../../Business/PhotoUpload.php?page=fromDoctor" method="POST"   enctype="multipart/form-data">   
         
            <!-- new layout start -->
             <fieldset >  
                <div class="col-md-12">
                    <div class="row">
                        <section class="col col-4">
                             <label class="input">
                                <i class="icon-append fa fa-asterisk"></i>
                                <input type="text" id="doctorid" name="doctorid"  placeholder="Doctor Id">
                                        
                            </label>
                        </section>
                         <section class="col col-4" id="doctoriddiv">
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
                                <input type="text" id="newuser" name="newuser"  placeholder="User Id" min="5" maxlength="8">
                            </label>
                        </section>
                          
                        <section class="col col-4">
                             <label class="input">
                                <i class="icon-append fa fa-asterisk"></i>
                                <input type="password" id="newuserpassword"  placeholder="Password"  min="5" maxlength="8">
                                
                            </label>
                        </section>
                     <section class="col col-4">
                        <label for="file" class="input input-file">
                            <div class="button"><input placeholder="Photo"  type="file" name="filepres"  id="filepres" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</div><input type="text" id="filepres" name="filepres"  readonly>
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
                        <input type="text" name="start" id="start" placeholder="Date of Birth" required readonly>
                              
                    </label>
                   </section>
                 <section class="col col-4">
                    <label class="input">
                        <i class="icon-append fa fa-calendar"></i>
                        <input type="text" name="age" id="age" placeholder="Age" required>
                              
                    </label>
                   </section>
                    <section class="col col-4">
                        <label class="select">
                           <select id="gender" class="form-control">
                            <option value="">-- Select Gender --</option>
                           <option value="male">Male</option>
                                <option value="female">Female</option>

                           </select>
                               
                       </label>
                     </section> 
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-asterisk"></i>
                           <input type="text" id="mobile" placeholder="Mobile #"   maxlength="10">
                                
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
                           <input type="text" id="aadharcard" placeholder="Aadhar Card" maxlength="12"  > <font><i><span id="aadharerrormsg"></span></i></font>       
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
                               <input type="text" id="landline" placeholder="Landline #"  maxlength="10">

                             </label>

                            <font color="red"><i><span id="errmsglandline"></span></i></font>
                       </section> 
                        <section class="col col-4">
                            <label class="input">
                               <i class="icon-append fa fa-lock"></i>
                               <input type="text" id="address1" placeholder="Address Line 1">
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
                           <input type="text" id="city" placeholder="City">      
                       </label>
                     </section> 
                    <section class="col col-4">
                          <label class="select">
                            <select id="district" class="form-control">
                              <option value="DISTRICT">- District -</option>
                           
                            </select>     
                         </label>
                    </section>
                    <section class="col col-4">
                        <label class="input">
                           <i class="icon-append fa fa-user"></i>
                           <input type="text" id="zipcode" placeholder="Zipcode"  maxlength="7">
                       </label>

                         <font color="red"><i><span id="errmsgzipcode"></span></i></font>
                   </section> 

                     
                 </div>
             </div>
          </fieldset>     
         
             
            <div class="modal-footer">
               
                <input type="button" value="Register User" class="btn-u btn-u-primary" id="registerStaffDoctorUser" />
                
            </div>
         </form>   
    
    </div>
</div>   
</div>  
  </div> 
     </fieldset>
</div>    