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
                    
                    <input type="text" readonly="true" id="start" name="start">
                </label>
                <font color="red"><i><span id="staffdoctorerrormsg"></span> </i></font>
            </section>
            <input type="button" class="btn-u pull-right"  name="button" id="btnDoctorTimings" value="Search"/> 

         </div>
     </fieldset>
    <fieldset>
        <section class="col-md-12">
            <table class="table table-striped" id="doctor_timings">
                <thead>
                    <tr  style="background-color: #e67e22">
                       
                        <th><font color="#FFFFFF">Doctor Id</font></th>
                        <th><font color="#FFFFFF">Doctor Name</font></th>
                        <th><font color="#FFFFFF">Start Time</font></th>
                        <th><font color="#FFFFFF">End Time</font></th>
                        
                    </tr>
                 </thead>    
                   
               
                <tbody>

                </tbody>
            </table>
        </section>
    </fieldset>
</div>