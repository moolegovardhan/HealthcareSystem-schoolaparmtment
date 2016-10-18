  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<?php
    include_once '../../Business/PatientData.php';
    $pd = new PatientData();
 $patientid = $_SESSION['userid'];
//echo "Counter : ".$_POST['counter'];echo "<br/>";
 
        $patientGroupList = $pd->familyMemberDetails($patientid);
    if($_POST['counter'] > 0) { 
         $primaryUserId = $_SESSION['userid'];
         for($i=0;$i<$_POST['counter'];$i++){
             $patientId = $_POST['pid'.$i];
           //  echo "PatientID : ".$patientid;
             try{
                    if($patientId != "") { 
                       $pd->createPatientGroup($primaryUserId, $patientId); 
                    } 
             }  catch (Exception $ex){
               //  echo $ex->getMessage();
                // echo $ex->getCode();echo "<br/>";
                 echo "<script>alert('Request sent for Patient Id : '+".$_POST['pid'.$i].")</script>";
             } 
         }
    }
 
?>
  
<div class="col-md-12 sky-form">
     <form action="patientindex.php?page=mapmembers" method="post"> 
    <!--fieldset>
       
        <div class="row">
            <section class="col-md-3">
                  <label class="input">
                    <input type="text" id="patientName" name="patientName"  placeholder="Patient Name" value="<?php echo $_POST['patientName'];?>">
                  </label>
              <i><font color="red"><span id="apptpatientnameerrormsg"></span></font></i>
            </section>
            <section class="col-md-3">
                <label class="input">
                    <input type="text" id="patientId" name="patientId"  placeholder="Patient ID" value="<?php echo $_POST['patientId'];?>">
                  </label>
              <i><font color="red"><span id="patientiderrormsg"></span></font></i>
            </section>
            <section class="col-md-3">
                <label class="input">
                    <input type="text" id="mobile" name="mobile"  placeholder="Mobile #" value="<?php echo $_POST['mobile'];?>">
                  </label>
              <i><font color="red"><span id="mobileerrormsg"></span></font></i>
            </section>
                <input type="submit" class="btn-u pull-right"  name="submit" id="searchGroupingPatient" value="search"/>  &nbsp;&nbsp;&nbsp;    
                &nbsp;&nbsp;&nbsp;    
              
        </div> 
    </fieldset-->
    <fieldset>
        <div class="row">
           <div class="col-md-15">  
                        
                <div class="panel panel-orange margin-bottom-40">
                    <input type="submit" class="btn-u pull-right"  name="submit" id="searchGroupingPatient" value="  Submit  "/> 
                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="fa fa-edit"></i>Patient List</h5>
                    </div>
                </div>
               <table class="table table-striped" id="">
                <thead>
                    <tr>
                       
                        <th></th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                         <th>Address</th>
                        <th>Date of Birth</th>
                        <th>Mobile #</th>
                        
                    </tr>
                 </thead>    
                     <?php $counter = 0; if(count($patientGroupList) > 0) { foreach ($patientGroupList as $value) {  if($value->ID != $patientid) { ?>
                        <tr>
                           
                            <td><input type="checkbox" name="pid<?php echo $counter; ?>" value="<?php echo $value->ID;  ?>"></td>
                            <td nowrap><?php echo $value->ID;  ?></td>
                            <td nowrap><?php echo $value->name;  ?></td>
                            <td nowrap><?php echo $value->address;  ?></td>
                            <td nowrap><?php echo $value->dob; ?></td>
                            <td nowrap><?php echo $value->mobile; ?></td>
                            
                        </tr>
                     <?php $counter++;}  } } else { ?>
                        <tr><td colspan="5"><font color="blue"><center><i><h5> Sorry No Records Found !. Please refine your search criteria.</h5></i></center></font></td></tr>
                    <?php  } ?> 
               <input type="hidden" name="counter" value="<?php echo $counter;  ?>">
                <tbody>

                </tbody>
            </table>
           </div>     
        </div>
    </fieldset>
    </form>   
</div>
 