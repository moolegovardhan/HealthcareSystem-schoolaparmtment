<div class="col-md-12 sky-form">
<fieldset>
    <div class="row">
        <section class="col">
            
        </section>  
      <section class="col col-4">
          <label class="input">
               <input type="text" id="userId" placeholder="User Id"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
      <button type="button" class="btn-u"  name="button" id="Verify" > Search </button>
        <input type="button" value="Register Request"class="btn-u btn-u-primary pull-right" id="btnSubmitMemberRequest"/>
                 
     </div>     

  </fieldset> 
                     <fieldset>
                       <div class="row">
                         <section>
                        <div class="col-md-5 sky-form">
                              <fieldset>

                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                             <input type="text" id="name"  placeholder="Name" readonly>
                                             <input type="hidden" id="userid" />
                                        </label>
                                         <font color="red"><i><span id="weighterr"></span></i></font> 
                                    </section>

                                    <section>
                                       <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="email"  placeholder="Email" readonly>
                                        </label>
                                          <font color="red"><i><span id="heighterr"></span></i></font> 
                                    </section>

                                   <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="Mobile"  placeholder="Mobile" readonly>
                                        </label>
                                        <font color="red"><i><span id="bmierr"></span></i></font> 
                                    </section>

                                 </fieldset>

                          </div>     
                           <div class="col-md-6 sky-form">
                                <fieldset>
                                     <section>
                                      <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="email" id="bday" placeholder="Birthday" readonly>

                                        </label>
                                         <font color="red"><i><span id="bperr"></span></i></font> 
                                    </section>

                                     <section>
                                              <label class="input">
                                                   <i class="icon-append fa fa-user"></i>
                                                    <input type="text" id="City"  placeholder="City" readonly>
                                               </label>
                                          <font color="red"><i><span id="heloglobinerr"></span></i></font> 
                                           </section>
                               <section>
                                   <label class="input">
                                       <i class="icon-append fa fa-user"></i>
                                       <input type="text" id="address1"  placeholder="Address1" readonly>
                                   </label>
                                    <font color="red"><i><span id="sugarerr"></span></i></font> 
                               </section>

                           </fieldset>

                          </div> 
    
                         </section>
                       </div>
                     </fieldset>  
                <fieldset>
                   <section class="col-md-5">
                    <label class="select">
                            <select id="memberRequestType" class="form-control" required>
                                <option value="">-- Select Request Type --</option>
                               <option value="Registration">Registration</option>
                               <option value="Appointment">Appointment</option>
                               <option value="Credits">Credits</option>
                                <option value="Others">Others</option>

                            </select>
                             <font><i><span id="gendererrormsg"></span></i></font>       
                        </label>

                   </section>
                    <section class="col-md-5">
                        
                        <textarea id="memberRequest" rows="5" cols="50"></textarea>
                        
                    </section>
                    
                </fieldset>
    <fieldset>
        
        <section>
            <table class="table table-striped" id="user_specific_request_table">
                    <thead>
                        <tr>
                            <th>Request Id</th>
                            <th>Request Date</th>
                            <th>Request Type</th>
                            <th>Request </th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
        </section>
        
    </fieldset>  
</div>