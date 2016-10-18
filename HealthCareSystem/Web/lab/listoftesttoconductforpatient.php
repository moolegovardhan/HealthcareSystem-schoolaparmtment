<div class="col-md-12" id="patienttests">
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/labtestadd.js"></script>
  <?php
  include_once '../../Business/DiagnosticData.php';
   include_once '../../Business/AppointmentData.php';
  $dd = new DiagnosticData();
  $ad = new AppointmentData();
  $appointmentid = $_GET['appointmentid'];
  $consultationDetails = $ad->fetchCallCenterConsultationList('nodata','nodata',$appointmentid,'nodata');
 // print_r($consultationDetails);
   $patientid = $consultationDetails[0]->PatientId;
  $result = $dd->getPatientTestDetails($appointmentid);
  
  
  ?>
 

  <fieldset>
      <div class="row  sky-form">
          
          <form action="labindex.php?page=collectlabsample" method="post">
              <br/>
              <div class="row">
                <section class="col-md-1"></section>
                <section class="col-md-3">
                     <label class="select">
                           <select id="samplecollectiontype" name = "samplecollectiontype" class="form-control"  >
                               <option value="selectpaymenttype">-- Select Sample Collection Type --</option>
                               <option value="home">From Home</option>
                               <option value="Lab">In Lab</option>
                            </select>
                         </label>
                </section>
                      <section class="col-md-5">

                           <input type="submit" class="btn-u pull-right"  name="button" id="generateBill" value="Generate Bill"/>
            <br/>

                      </section>
           </div>
               <!--input type="submit" class="btn-u pull-right"  name="button" id="generateBill" value="Generate Bill"/>
                             <br/-->
          <section class=" col-md-7">    
                <table width="70%" border="1"  class="table table-striped" style="border-collapse: collapse;" id="patient_test_prescribed">
                    <thead>
                    <tr align="center" style="background-color: #ffce93;font-weight: 15px;">
                        <td></td>
                        <td><b>Test Name</b></td>
                        <td><b>Test Price</b></td>
                        <td><b>Action</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  
                    $counter = 0;
                     foreach($result as $test){
                          $finalValue = $test->constid."$".$test->namevalue."$".$test->finalprice."$".$test->testname;
                           
                    ?>
                    <tr align="center">
                        <td><input type="checkbox" name="<?php echo $counter; ?>" id="<?php echo $counter; ?>" value="<?php echo $finalValue; ?>" ></td>
                        <td><?php echo $test->testname; ?></td>
                        <td><?php echo $test->finalprice; ?></td>
                        <?php if($test->nonprestest == "NP"){?>
                          <td><a href="#" onclick='deleteFromTest(<?php echo $test->constid; ?>)'>Delete</a></td>
                        <?php } else { ?>  
                          
                           <td>&nbsp;&nbsp;&nbsp;</td>
                          
                        <?php } ?>  
                    </tr>
                   
                   <?php  
                    $counter++; }
                    ?>
                     </tbody>
                </table>
              </section>
                               <input type="hidden" name="recordcount" id="recordcount"  value="<?php  echo sizeof($result); ?>"/>
                                <input type="hidden" name="hidpatientid" id="hidpatientid" value="<?php  echo $patientid; ?>"/>
                               <input type="hidden" name="appointmentidhid" id="appointmentidhid" value="<?php  echo $appointmentid; ?>"/>
              </form>
          <section class="col-md-5">
              <fieldset>
                  <section>
                      <label class="input">
                        <input type="text" id="testname" name="testname" placeholder="Test Name">
                      </label>
                      <input type="button" class="btn-u pull-right"  name="button" id="fetchTestForPatient" value="search"/>     
                         
                  </section>
                  <section>
                   <hr/>         
                  </section>
                  <section>
                      <table width="50%" border="1"  align="center" class="table table-striped" style="border-collapse: collapse;" id="test_name">
                          <thead>
                              <tr style="background-color: #ffce93;"><td>Name</td><td>Price</td><td></td></tr>
                          </thead>
                          <tbody>
                               <tr><td></td><td></td><td></td></tr>
                          </tbody>
                      </table>
                  </section>
              </fieldset>
          </section>
         
        </div> 
        
    <div class="col-md-13 sky-form" id="payment-options">
        <div class="row">
            <section class="col-md-2"></section>  
            <section class="col-md-9" >
      <?php 
       // print_r($data);
     // include '../common/payment.php';

      ?>
            </section> <section class="col-md-2"></section>  
          </div>
  </div>      
    
    </fieldset>
  
</div>