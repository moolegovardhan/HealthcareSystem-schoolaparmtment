<div class="col-md-12 sky-form">
    
     <fieldset>
        <div class="row">
             <section class="col col-4">
                <label class="select">
                    <select name="hospital" id="hospital">
                        <option value="HOSPITAL" selected >Hospital Name</option>
                        <?php foreach ($hosiptal as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->hosiptalname?></option>
                        <?php } ?>
                    </select>

                </label>
                <font color="red"><i><span id="staffhospitalerrormsg"></span> </i></font>
            </section>
            <section class="col col-4">
                <label class="select">
                    <select name="doctor" id="doctor">
                        <option value="DOCTOR" selected >Doctor Name</option>
                        
                    </select>

                </label>
                <font color="red"><i><span id="staffdoctorerrormsg"></span> </i></font>
            </section>
            <section class="col col-4">
                <label class="input">
                    <i class="icon-append fa fa-calendar"></i>
                    <input type="text" name="start" id="start" placeholder="Appointment date" readonly>

                     <font color="red"><i><span id="starterrormsg"></span> </i></font>
                </label>
            </section>
               
            <input type="button" class="btn-u pull-right"  name="button" id="bthSearchStaffAppointmentUsers" value="Search" onclick="callDoctorAppointmentSlots()"/> 

         </div>
     </fieldset>
</div>