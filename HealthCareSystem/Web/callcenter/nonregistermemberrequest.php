<div class="col-md-12 sky-form">
    <fieldset>
                       <div class="row">
                         <section>
                        <div class="col-md-5 sky-form">
                              <fieldset>

                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                             <input type="text" id="nname"  placeholder="Name">
                                             <input type="hidden" id="userid" />
                                        </label>
                                         <font color="red"><i><span id="nnameerr"></span></i></font> 
                                    </section>

                                    <section>
                                       <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="nemail"  placeholder="Email">
                                        </label>
                                          <font color="red"><i><span id="nemailerr"></span></i></font> 
                                    </section>

                                   <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="nmobile"  placeholder="Mobile">
                                        </label>
                                        <font color="red"><i><span id="mobileerr"></span></i></font> 
                                    </section>

                                 </fieldset>

                          </div>     
                           <div class="col-md-6 sky-form">
                                <fieldset>
                                   
                                     <section>
                                              <label class="input">
                                                   <i class="icon-append fa fa-user"></i>
                                                    <input type="text" id="ncity"  placeholder="City">
                                               </label>
                                          <font color="red"><i><span id="cityerr"></span></i></font> 
                                           </section>
                               <section>
                                   <label class="input">
                                       <i class="icon-append fa fa-user"></i>
                                       <input type="text" id="naddress1"  placeholder="Address1">
                                   </label>
                                    <font color="red"><i><span id="address1err"></span></i></font> 
                               </section>
                                <section>
                                      <input type="button" value="Register Request"class="btn-u btn-u-primary" id="nbtnSubmitMemberRequest"/>
                                    </section>

                           </fieldset>

                          </div> 
    
                         </section>
                       </div>
                     </fieldset>  
                <fieldset>
                   <section class="col-md-5">
                    <label class="select">
                            <select id="nmemberRequestType" class="form-control" required>
                                <option value="">-- Select Request Type --</option>
                               <option value="Registration">Registration</option>
                               <option value="Appointment">Appointment</option>
                               <option value="Credits">Credits</option>    

                            </select>
                             <font><i><span id="ngendererrormsg"></span></i></font>       
                        </label>

                   </section>
                    <section>
                        
                        <textarea id="nmemberRequest" rows="5" cols="50"></textarea>
                        
                    </section>
                    
                </fieldset>
               
    
</div>