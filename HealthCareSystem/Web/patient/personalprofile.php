
<div class="col-md-12">
        <div class="row margin-bottom-40">
            <div class="panel panel-orange">
               <div class="panel-heading">
                   <h3 class="panel-title"><i class="fa fa-tasks"></i> Profile
                    </h3>

               </div>
<div class="panel-body"> 
<form  id="profile-form" action="." method="post">

          <div class="col-md-6 sky-form">
                 <header>Personal Details
                   
                </header>
                <fieldset>

                          <section>
                              <label class="label"><b>First Name :</b></label>
                              <label class="label">    <i><?php  echo $result[0]->firstname; ?></i>  
                              </label>
                          </section>
                        <section>
                              <label class="label"><b>Middle Name :</b> </label>
                               <label class="label">    <i><?php  echo $result[0]->middlename; ?></i>
                              </label>
                          </section>
                        <section>
                              <label class="label"><b>last Name :</b> </label>
                              <label class="label">     <i><?php  echo $result[0]->lastname; ?></i>
                              </label>
                          </section>

                          <section>
                               <label class="label"><b>Mobile # : </b> </label>
                                <label class="label">   <i><?php  echo $result[0]->mobile; ?></i>
                              </label>

                          </section>

                            <section>
                               <label class="label"><b>Alternate Mobile # : </b> </label>
                                <label class="label">   <i><?php  echo $result[0]->altmobile; ?></i>
                              </label>

                          </section>

                          <section>
                               <label class="label"><b>Email Id : </b> </label>
                                 <label class="label"><i><?php  echo $result[0]->email; ?></i>
                               
                              </label>
                          </section>
                          <section>
                               <label class="label"><b>Date of Birth : </b> </label>
                                <label class="label"> <i><?php  echo $result[0]->dob; ?></i>
                               
                              </label>
                          </section>
                      
                            <section>
                               <label class="label"><b>Gender : </b> </label>
                                 <label class="label"><i><?php  echo $result[0]->gender; ?></i>
                               
                              </label>
                          </section>
                  </fieldset>

          </div>     

                        <!-- end of Personal Form -->
                             
                        <!-- Health Form -->
                                 
      <div class="col-md-6 sky-form">
                 <header>       
                    <button type="button" class="btn-u pull-right"  name="button" id="btnprofileedit"   onclick="showupdateprofile()">Edit</button><br/>
                </header>
                <fieldset>
                        
                       
                            <section>
                               <label class="label"><b>Aadhar Card : </b> </label>
                                 <label class="label"><i><?php  echo $result[0]->aadharcard; ?></i>
                               
                              </label>
                          </section>
                         
                           <section>
                               <label class="label"><b>Land line # : </b> </label>
                                 <label class="label"><i><?php  echo $result[0]->landline; ?></i>
                               
                              </label>
                          </section>
                    
                    
                    
                          <section>
                               <label class="label"><b>Address Line 1 : </b> </label>
                                 <label class="label"><i><?php  echo $result[0]->addressline1; ?></i>
                               
                              </label>
                          </section>
                          <section>
                               <label class="label"><b>Address Line 2 : </b> </label>
                                <label class="label"> <i><?php  echo $result[0]->addressline2; ?></i>
                               
                              </label>
                          </section>
                    
                    
                          <section>
                              <label class="label"><b>District :</b> </label>
                               <label class="label">    <i><?php  echo $result[0]->district; ?></i>
                              </label>
                          </section>
                        <section>
                              <label class="label"><b>City :</b> </label>
                               <label class="label">    <i><?php  echo $result[0]->city; ?></i>
                              </label>
                          </section>
                        <section>
                              <label class="label"><b>State :</b> </label>
                              <label class="label">     <i><?php  echo $result[0]->state; ?></i>
                              </label>
                          </section>

                          <section>
                               <label class="label"><b>Zip Code : </b> </label>
                                <label class="label">   <i><?php  echo $result[0]->zipcode; ?></i>
                              </label>

                          </section>


                

                  </fieldset>

          </div>
                        <!-- end of Helath Form -->
                        
                  
               
                        
                </form> 
  <div class="modal fade" id="responsive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Update Profile</h4>
            </div>
        
          
        <form id="registerform" action="#" method="post" class="sky-form">   
            <div class="modal-body">
                <div class="row">  
                    <div class="col-md-10" id="errorRBlock">
                        <p class="validation-summary-errors">
                            <font color="red">
                                <span id="errorDisplay"></span>
                            </font>
                         </p> 
                    </div> 
                </div>     
              <input type="hidden" id="userid" value="<?php  echo $result[0]->ID; ?>" />
                <div class="row col-md-6"><!--div class="col-md-6"-->
                      <fieldset>
                        <section>
                             <label class="input">
                                
                                <?php  echo $result[0]->username; ?>
                            </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->                       </section>
                          
                        <section>
                             <label class="input">
                                <i class="icon-append fa fa-lock"></i>
                                <input type="password" id="newuserpassword" placeholder="Password"  value="<?php  echo $result[0]->password; ?>" >
                            </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->                       </section>  
                       </fieldset> 
                </div>
                     <fieldset>
                        <section>
                             <label class="input">
                                <i class="icon-append fa fa-user"></i>
                                <input type="text" id="email" placeholder="Email" value="<?php  echo $result[0]->email; ?>">
                                  <font color="red"><i><span id="emailErrmsg"></span></i></font>
                            </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->                       </section>
                        <section>
                             <label class="input">
                                <i class="icon-append fa fa-user"></i>
             <input type="text" id="mobile" placeholder="Mobile # {User ID }" value="<?php  echo $result[0]->mobile; ?>">
                            </label>
                            
                            <font color="red"><i><span id="errmsg"></span></i></font>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->                       </section>  
                       </fieldset> 
                     <fieldset>
                        <section>
                             <label class="input">
                                <i class="icon-append fa fa-user"></i>
                                <input type="text" id="name" placeholder="Name" value="<?php  echo $result[0]->name; ?>">
                            </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->                       </section>
                        <section>
                             <label class="input">
                                <i class="icon-append fa fa-user"></i>
                                <label class="textarea">
                                    <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="3" placeholder="Contact Address" id="address" ><?php  echo $result[0]->address; ?></textarea>
                                </label>
                            </label>
                                <!--input type="text" id="newuser" placeholder="Name" class="form-control  state-success" required-->                       </section>
                        
                       </fieldset> 
            </div>
        </form>     
            <div class="modal-footer">
                <button type="button" class="btn-u btn-u-default" data-dismiss="modal">Close</button>
                 <input type="submit" value="Update Profile"class="btn-u btn-u-primary" id="updateprofile"/>
                
            </div>
        </div>
    </div>
</div>
          
    
    
          </div>
        </div>
  </div>	    