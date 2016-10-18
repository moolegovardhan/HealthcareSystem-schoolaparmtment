 
<div class="col-md-8">
    <div class="row margin-bottom-40">
         <div class="panel panel-orange">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Create Appointment</h3>
             </div>
             <div class="panel-body"> 
              <form action="" id="sky-form" class="sky-form">
                 <div class="col-md-12">  
                    <fieldset>
                       <div class="row">
                            <label class="label col col-2">Patient Name</label>
                            <section class="col col-4">
                                <label class="input">
                               <?php // echo (if(isset(((isset($_SESSION['profession']) == "Patient") || isset($_SESSION['profession']) == "Others")));   ?>  
                                    <?php if(isset($_SESSION['profession']) != "Staff"){ ?>
                                   <i><?php  echo $_SESSION['pname']; ?></i>
                                    <input type="hidden" id="patientName"  value="<?php  echo $_SESSION['pname']; ?>" placeholder="Patient Name">
                                    <?php } else {?>
                                      <input type="text" id="patientName"  placeholder="Patient Name">
                                     <input type="hidden" id="patientName"  placeholder="Patient Name">
                                    <?php } ?>
                                  </label>
                            </section>
                           <label class="label col col-2">Hospital Name</label>
                            <section class="col col-4">
                                <label class="select">
                                    <select name="hosiptal" id="hosiptal">
                                        <option value="HOSIPTAL" selected >Hospital Name</option>
                                         <?php foreach ($hosiptal as $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->hosiptalname ?></option>
                                        <?php } ?>
                                    </select>
                                     
                                </label>
                                <font color="red"><i><span id="hosiptalerrormsg"></span> </i></font>
                            </section>
                            <label class="label col col-2">Doctor Name</label>
                            <section class="col col-4">
                                <label class="select">
                                    <select name="doctor" id="doctor">
                                        <option value="DOCTOR" selected >Doctor Name</option>
                                        <?php foreach ($doctor as $value) { ?>
                                            <option value="<?php echo $value->ID ?>"><?php echo $value->name?></option>
                                        <?php } ?>
                                    </select>
                                     
                                </label>
                                <font color="red"><i><span id="doctorerrormsg"></span> </i></font>
                            </section>
                           
                            <label class="label col col-2">Appointment Date</label>
                            <section class="col col-4">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="start" id="start" placeholder="Appointment date">
                                     <font color="red"><i><span id="starterrormsg"></span> </i></font>
                                </label>
                            </section>
                        </div>     
                        
                     </fieldset> 
                    <fieldset>
                       <div class="row">
                           <font color="red"><i><span id="appointmentemsg"></span></i></font>
                         <input type="button" class="btn-u"  name="button" id="blockAppointment" value="Block Slot ">  
                           <input type="button" class="btn-u pull-right"  name="button" id="bthCheckAppointment" value="Search">
                        </div>     
                        
                     </fieldset>  
                    <fieldset>
                       <div class="row">
                           <label class="label col col-2">Slot Time</label>
                            <section class="col col-2">
                                <label class="select">
                                    <select name="slot" id="slot">
                                        <option value="0" selected disabled>Slot</option>
                                        <option value="9.00">9.00</option>
                                        <option value="9.30">9.30</option>
                                        <option value="10.00">10.00</option>
                                        <option value="10.30">10.30</option>
                                        <option value="11.00">11.00</option>
                                        <option value="11.30">11.30</option>
                                        <option value="12.00">12.00</option>
                                        <option value="12.30">12.30</option>
                                        <option value="1.00">1.00</option>
                                        <option value="1.30">1.30</option>
                                        <option value="2.00">2.00</option>
                                        <option value="2.30">2.30</option>
                                        <option value="3.00">3.00</option>
                                         <option value="3.30">3.30</option>
                                        <option value="4.00">4.00</option>
                                        <option value="4.30">4.30</option>
                                        <option value="5.00">5.00</option>
                                        <option value="5.30">5.30</option>
                                        <option value="6.00">6.00</option>
                                    </select>
                                   
                                </label>
                       <font color="red"><i><span id="sloterrormsg"></span> </i></font>
                            </section>
                            <section class="col col-8">
                        <div class="col-md-12">
                          <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Booked Slots Time</h3>
                            </div>
                            <table class="table table-striped" id="records_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Slot Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td><i>9.00</i></td>
                                         <td><i>Completed</i> </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td><i>10.00</i></td>
                                        <td><i>Completed</i> </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td><i>11.00</i></td>
                                        <td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>Confirm </button></td>
                                    </tr>
                                   <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td><i>1.00</i></td>
                                        <td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>Confirm </button></td>
                                    </tr-->
                                </tbody>
                            </table>
                        </div>
                                    
                     </div>    
                            </section>
                           
                        </div>     
                        
                     </fieldset> 
                   
                 </div>
                 </form>  
             </div>     
        </div>
     </div>
</div>    
    
    
</div>