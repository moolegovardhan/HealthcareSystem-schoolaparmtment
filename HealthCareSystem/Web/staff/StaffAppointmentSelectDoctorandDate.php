  
<div class="col-md-10 sky-form">
     <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script>
   $(document).ready(function(){ 
       
       var currentTime = new Date() 
var minDate = new Date(currentTime.getYear(), currentTime.getMonth() -1, +1); //one day next before month
var maxDate =  new Date(currentTime.getFullYear(), currentTime.getMonth() +2, -1);


      $( "#start" ).datepicker({  minDate: 0, maxDate: "+2M", 
       // changeMonth: true,
       // changeYear: true,
        yearRange:'+0:+0',
        hideIfNoPrevNext: true,
        "dateFormat": 'dd.mm.yy',
        nextText:'<i class="fa fa-angle-right"></i>',
        prevText:'<i class="fa fa-angle-left"></i>',
         weekHeader: "W"});
    });     
     
     </script>
     <fieldset>
         <div class="row">
             <section class="col-md-2"></section> 
             <section class="col col-4">
                <label class="select">
                    <select name="doctor" id="doctor">
                        <option value="DOCTOR" selected >Doctor Name</option>
                        <?php foreach ($doctorList as $value) { ?>
                            <option value="<?php echo $value->ID ?>"><?php echo $value->name?></option>
                        <?php } ?>
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
                <font color="red"><i><span id="staffapptpatientstartdt"></span> </i></font>
            </section> 
              

            <input type="button" class="btn-u pull-right"  name="button" id="bthSearchStaffAppointmentUsers" value="Search"/> 

         </div>
     </fieldset>
</div>     