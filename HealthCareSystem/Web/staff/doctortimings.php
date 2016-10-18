<?php  $master = new MasterData();
$doctorList = $master->hospitalSpecificdoctorList();
$startTime=strtotime("00:00:00");
$endTime=strtotime("24:00:00");
$intervel="30";

//print_r($doctorList);

?>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function(){ 
     $( "#inline-start" ).datepicker({  minDate: 0, maxDate: "+2M", 
      // changeMonth: true,
      // changeYear: true,
       yearRange:'+0:+0',
       hideIfNoPrevNext: true,
       "dateFormat": 'dd.mm.yy',
       nextText:'<i class="fa fa-angle-right"></i>',
       prevText:'<i class="fa fa-angle-left"></i>',
        weekHeader: "W"});
        
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
<div class="col-md-12 sky-form">
          
      <fieldset>
     <div class="row ">  
         <form method="POST" action="../../Business/SetDocterTimings.php">
         <section class="col col-md-1"></section>
                <section class="col col-md-10">
                    <input type="submit" value="Set Doctor Timings" class="btn-u btn-u-primary pull-right" id="" />
                        <div class="panel panel-orange margin-bottom-40">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-edit"></i>Doctor List</h3>
                        </div>
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Doctor Name</th>
                                    <th>From Time</th>
                                     <th>To Time</th>
                                     <th>Duration</th>
                                </tr>
                             </thead> 
                             <tbody>
                                 <?php $counter = 0; foreach($doctorList as $doctor){ ?>
                                       <tr>
                                           <td><input type="checkbox" name="<?php echo $counter; ?>" value="<?php echo $doctor->ID; ?>"></td>
                                            <td><?php echo $doctor->name; ?></td>
                                            <td>
                                                <select name="<?php echo 'fromtime'.$counter; ?>" class="select">
                                                <?php 
                                                    $time=$startTime;
                                                    $slotStart = "";
                                                    $slotEnd =  "";
                                                    while ($time <= $endTime) {
                                                         $slotStart =  $time;
                                                         $slotEnd =  strtotime('+'.$intervel.' minutes', $time);
                                                        //  $temp = date('H:i', $slotStart)." - ".date('H:i', $slotEnd); 
                                                ?>
                                                    <option value="<?php echo date('H:i', $slotStart); ?>"><?php echo date('H:i', $slotStart); ?></option>
                                                       <?php $time = strtotime('+'.$intervel.' minutes', $time);
                                                 
                                                    } ?>
                                                    </select>
                                            </td>
                                             <td>
                                                <select name="<?php echo 'totime'.$counter; ?>" class="select">
                                                <?php 
                                                    $time=$startTime;
                                                    $slotStart = "";
                                                    $slotEnd =  "";
                                                    while ($time <= $endTime) {
                                                         $slotStart =  $time;
                                                         $slotEnd =  strtotime('+'.$intervel.' minutes', $time);
                                                        //  $temp = date('H:i', $slotStart)." - ".date('H:i', $slotEnd); 
                                                ?>
                                                    <option value="<?php echo date('H:i', $slotStart); ?>"><?php echo date('H:i', $slotStart); ?></option>
                                                       <?php $time = strtotime('+'.$intervel.' minutes', $time);
                                                 
                                                    } ?>
                                                    </select>
                                            </td>
                                            <!--td><?php //echo $attendances->endleave; ?></td-->
                                            <td>
                                                <select name="<?php echo 'duration'.$counter; ?>" class="select">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                </select>
                                                
                                            </td>
                                        </tr>         
                                  <?php  $counter++;} ?>
                             <input type="hidden" name="counter" value="<?php  echo $counter; ?>"/>
                            </tbody>
                        </table>
                    </div>
                </section>

        
     </form>
     </div>
          </fieldset>
</div>    