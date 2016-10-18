<?php
include_once '../../Business/DoctorDiagnostics.php';

//echo "userid".$_SESSION['userid'];

?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../js/doctordiagnostics.js"></script>
<script>
    $(document).ready(function(){ 
     $( "#finish" ).datepicker({  minDate: "-2M", maxDate: "+1", 
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
     <section class="col col-3">
        <label class="input"> 
              <i class="icon-append fa fa-calendar"></i>
              <input type="text" name="start" id="start" placeholder="Start Date">
               <font color="red"><i><span id="endstarterrormsg"></span> </i></font>
          </label>
   </section>
      <section class="col col-3">
        <label class="input"> 
              <i class="icon-append fa fa-calendar"></i>
              <input type="text" name="finish" id="finish" placeholder="End Date">
               <font color="red"><i><span id="endfinisherrormsg"></span> </i></font>
          </label>
   </section> 
    <section class="col col-3">
        <label class="select">
            <select id="presdiagnostics" name="presdiagnostics">
                <option value="Diagnostics" >-------- Select Diagnostics ----------</option>
                <option value="Others">Others</option>
                <?php foreach($lablist as $value){?>
                   <option value=<?php echo $value->id;?>><?php echo $value->diagnosticsname;?></option>
                <?php } ?>
                   <input type="hidden" id="doctoruserid" name="doctoruserid" value="<?php  echo $_SESSION['userid'];?>">
            </select>
        </label>
    </section> 
   <section class="col col-3">
        <input type="button" class="btn-u "  name="button" id="searchDiagnostics" value="search"/> 
   </section>    
     <br/>  <br/>  <br/>
     
     <div class="row ">  
          <section class="col col-md-3"></section>
         <section class="col col-md-11">
             <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of DIagnostics's
                </h5>
            </div>
            <table class="table table-striped" id="diagnosticsdetails">
                <thead>
                    <tr>
                        <th>Diagnostics Name</th>
                        <th>Patient Name</th>
                        <th>Price</th>
                          <th>Appointment Date</th>
                        <th>Details</th>
                        
                    </tr>
                 </thead>    
                     
                       
                <tbody>

                </tbody>
            </table>
        </div> 
             
             
         </section>
         
     </div>
      </fieldset>     
    
    
</div>