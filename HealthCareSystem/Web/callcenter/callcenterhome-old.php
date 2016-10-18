<div class="col-md-12">
    
<div class="row tab-v3">
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked"> 
            <li class="active"><a href="#home-2" data-toggle="tab"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#profile-2" data-toggle="tab"><i class="fa fa-cloud"></i> Member Request</a></li>
            <li><a href="#messages-2" data-toggle="tab"><i class="fa fa-comments"></i> Non Member Request</a></li>                      
        </ul>                    
    </div>
    <form action="" id="sky-form" class="sky-form">
    <div class="col-sm-9">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="home-2">
                <h4>List of Request</h4>
                
                <p>
                    
                   
                        <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Requests </h3>
                            </div>
                            <table class="table table-striped" id="current_Requests_table">
                                <thead>
                                    <tr>
                                        <th>RID</th>
                                        <th>Request Type</th>
                                        <th>Request </th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; foreach ($requests as $value) { ?>
                                    <tr>

                                        <td><?php echo $value->Id;  ?></td>
                                        <td><?php echo $value->fk_RequestType; ?></td>
                                        <td><a href="#" onclick=requestText(<?php echo $value->Id; ?>)><?php echo $value->Text; ?></a></td>
                                        <td><?php echo $value->RequestStatus; ?></td>
                                    </tr>
                                <?php  $count++;} ?>
                                </tbody>
                            </table>
                        </div> 
                </p>
                
                
            </div>
            <div class="tab-pane fade in" id="profile-2">
                                      
                <header><h4>Member Request</h4></header>
                <p>
                  <fieldset>
                       <div class="row">
                         <section class="col col-4">
                             <label class="input">
                                  <input type="text" id="userId" placeholder="User Id"/>
                               </label>
                          <font color="red"><i><span id="userIderr"></span></i></font>    
                         </section>
                         <button type="button" class="btn-u"  name="button" id="Verify" > Search </button>
                         <button type="button" class="btn-u pull-right"  name="button" id="btnRegSubmitPatient">Submit Request</button>
                         
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

                            </select>
                             <font><i><span id="gendererrormsg"></span></i></font>       
                        </label>

                   </section>
                    <section>
                        
                        <textarea id="memberRequest" rows="5" cols="50"></textarea>
                        
                    </section>
                    
                </fieldset>
                <footer>
                     <input type="button" value="Register Request"class="btn-u btn-u-primary" id="btnSubmitMemberRequest"/>
                 
                </footer>
                </p>
                
                
            </div>
            <div class="tab-pane fade in" id="messages-2">
             
            
             <header><h4>Non Member Request</h4></header>
                <p>
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
                <footer>
                    
                 
                </footer>
                </p>
                
            
            
            </div>
        </div>   
    </form>
    </div>
</div> 
    
</div>