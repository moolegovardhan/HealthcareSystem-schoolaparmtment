   <?php  $whatINeed = explode("/", $_SERVER['PHP_SELF']);
            $_SESSION['host'] = $_SERVER['HTTP_HOST'];
            $_SESSION['rootNode'] = $whatINeed[1];
        include_once ('../../Business/DiagnosticData.php');
        $dd = new DiagnosticData();
        $departments = $dd->getdepartments();
?>  
 <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script src="../js/state.js"></script>
     <script>
          $(document).ready(function(){ 
      $( "#start" ).datepicker({  maxDate: 0,
                 changeMonth: true,
                 changeYear: true,
                 yearRange:'1900:+0',
                 hideIfNoPrevNext: true,
                 "dateFormat": 'dd.mm.yy',
                 nextText:'<i class="fa fa-angle-right"></i>',
                 prevText:'<i class="fa fa-angle-left"></i>',
                  weekHeader: "W"});
      });
     </script>
<div class="col-md-12 sky-form">
<div class="panel panel-orange margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> User Profile Details</h3>
                    </div>
    <div class="panel-body">
    
                
        <form id="registerform"  action="#" method="post">   
           
                <div class="row">  
                    <div class="col-md-10" id="errorRBlock">
                        <p class="validation-summary-errors">
                            <font color="red">
                                <span id="updateprofileerrormsg"></span>
                            </font>
                         </p> 
                    </div> 
                </div>     
              
                <div class="row col-md-4"><!--div class="col-md-6"-->
                      <fieldset>
                        <section>
                            <label class="input">
                                <i class="icon-append fa fa-user"></i>
                               <input type="text" id="newuser"  disabled  value="<?php  echo $result[0]->username; ?>">
                                      
                            </label>
                          </section>
                          
                        <section>
                             <label class="input">
                                <i class="icon-append fa fa-lock"></i>
                                <input type="password" id="newuserpassword" placeholder="Password" value="<?php  echo $password; ?>"> <font><i><span id="passworderrormsg"></span></i></font>       
                            </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->   
                        </section>
                        
                    
                             <section>
                                 <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="name" placeholder="First Name" value="<?php  echo $result[0]->firstname; ?>"> <font><i><span id="nameerrormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                             <section>
                                 <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="mname" placeholder="Middle Name" value="<?php  echo $result[0]->middlename; ?>"> <font><i><span id="mnameerrormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                             <section>
                                 <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="lname" placeholder="Last Name" value="<?php  echo $result[0]->lastname; ?>"> <font><i><span id="lnamerrormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                            <section>
                                 <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="aadharcard" placeholder="Aadhar Card" value="<?php  echo $result[0]->aadharcard; ?>"> <font><i><span id="aadharerrormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                             <section>
                                 <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="altmobile" placeholder="Alternate Mobile" value="<?php  echo $result[0]->altmobile; ?>"> <font><i><span id="altmobileerrormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                        </fieldset>
                </div>
             <div class="row col-md-4"><!--div class="col-md-6"-->
                      <fieldset>
                         <section>
                             <label class="input">
                                <i class="icon-append fa fa-user"></i>
                                <input type="text" id="email" name="email" placeholder="Email"  value="<?php  echo $result[0]->email; ?>">
                                  <font><i><span id="emailerrormsg"></span></i></font>       
                            </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->                       </section>
                        <section>
                             <label class="input">
                                <i class="icon-append fa fa-user"></i>
                                <input type="text" id="mobile" placeholder="Mobile #"  value="<?php  echo $result[0]->mobile; ?>">
                                  <font><i><span id="mobileerrormsg"></span></i></font>       
                            </label>
                            
                            <font color="red"><i><span id="errmsg"></span></i></font>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required--> 
                         </section> 
                      
                             <section>
                                 <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="landline" placeholder="Land line #" value="<?php  echo $result[0]->landline; ?>"> <font><i><span id="landlineerrormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                             <section>
                                 <label class="input">
                                     <textarea cols="32" rows="5" id="address1" placeholder="Address Line 1"><?php  echo $result[0]->addressline1; ?></textarea>
                                   
                                      <font><i><span id="address1errormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                             <section>
                                 <label class="input">
                                    <textarea cols="32" rows="5" id="address2" placeholder="Address Line 2"><?php  echo $result[0]->addressline2; ?></textarea>
                                   
                                      <font><i><span id="address2errormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                           
                        </fieldset>
                </div>
             <div class="row col-md-4">
                     <fieldset>
                            <section>
                            <label class="select">
                            <select id="district" class="form-control" >
                               <option value="DISTRICT">- District -</option>
                            </select> 
                            <font><i><span id="districterrormsg"></span></i></font>       
                           </label>
                       </section>
                              <section>
                                 <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="city" placeholder="City"    value="<?php  echo $result[0]->city; ?>">
                                      <font><i><span id="cityerrormsg"></span></i></font>       
                                </label>
                                    <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                            </section>
                        <section >
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
                         <section>
                             <label class="input">
                                <i class="icon-append fa fa-user"></i>
                                <input type="text" id="zipcode" placeholder="Zipcode"  value="<?php  echo $result[0]->zipcode; ?>">
                                  <font><i><span id="zipcodeerrormsg"></span></i></font>       
                            </label>
                            
                            <font color="red"><i><span id="errmsg"></span></i></font>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required--> 
                         </section>  
                      
                        <section>
                             <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="start" id="start" placeholder="Date of Birth" readonly="true"  value="<?php  echo $result[0]->dob; ?>">
                                      <font><i><span id="starterrormsg"></span></i></font>       
                                </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->  
                        </section>
                      
                         <section>
                             <label class="select">
                                <select id="gender" class="form-control" required>
                                    <option value="">-- Select Gender --</option>
                                    <?php if($result[0]->gender == "male")
                                                $male = "selected";
                                           else
                                               $female = "selected";
                                            ?>
                                    <option value="male" <?php  echo $male; ?>>Male</option>
                                     <option value="female" <?php  echo $female; ?>>Female</option>
                                 
                                </select>
                                     
                            </label>
                             <font><i><span id="gendererrormsg"></span></i></font> 
                          
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required--> 
                         </section>  
                         
                       </fieldset> 
                  <div class="modal-footer">
                    <button  class="btn-u btn-u-primary" id="updateprofile">Update User</button>


               </div>
             </div>     
          
        </form>     
           
        
    </div>
</div>   
</div>    