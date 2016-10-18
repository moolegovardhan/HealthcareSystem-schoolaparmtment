<input type="hidden" id="doctorname" value="<?php echo $_SESSION['logeduser']?>"/>
<input type="hidden" id="doctorid"  value="<?php echo $_SESSION['userid']?>"/>
<input type="hidden" id="officeid"  value="<?php echo $_SESSION['officeid']?>"/>
<?php  $appointment = new DoctorData();
$attendancesList = $appointment->getDoctorAttendances();?>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function(){ 
        $("#inline-finish").datepicker();
     $( "#inline-start" ).datepicker({  minDate: 0, maxDate: "+2M", 
      // changeMonth: true,
      // changeYear: true,
       yearRange:'+0:+0',
       hideIfNoPrevNext: true,
       "dateFormat": 'dd.mm.yy',
       nextText:'<i class="fa fa-angle-right"></i>',
       prevText:'<i class="fa fa-angle-left"></i>',
        weekHeader: "W"}
        onSelect: function (dateText, inst) {
        var date = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
        $("#inline-finish").datepicker("option", "minDate", date);
    });
        
      $( "#inline-finish" ).datepicker({  minDate: 0, maxDate: "+3M", 
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
<div class="col-md-12 margin-bottom-40">
           <section class="col col-md-7 "> 
                <p> 
                 <label class="label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="Apply Leave" class="btn-u btn-u-primary" id="applyLeaveButton" />
               </label>
                <label class="label"><font color="brown" size="2"><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select date range for applying leave</i></font></label>
                
                </p>
             </section>
     <br/>  <br/>  <br/>
      <fieldset>
     <div class="row ">  
        
                 <section class="col col-md-3">
                    <div id="inline-start" class="col col-md-12"></div>
                </section>
                <section class="col col-md-3">
                    <div id="inline-finish" class="col col-md-12"></div>
                </section>
                <section class="col col-md-5">
                        <div class="panel panel-sea margin-bottom-40">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-edit"></i>Leave Record</h3>
                        </div>
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                </tr>
                             </thead> 
                             <tbody>
                                 <?php foreach($attendancesList as $attendances){ ?>
                                       <tr>
                                            <td><?php echo $attendances->fromleave; ?></td>
                                            <td><?php echo $attendances->endleave; ?></td>
                                        </tr>         
                                  <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </section>

        
    
     </div>
          </fieldset>
</div>    