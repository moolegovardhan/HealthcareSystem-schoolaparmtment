  <?php  include_once '../Common/Barcode39.php'; 
  include_once '../../Business/DiagnosticData.php';
  include_once '../../Business/PatientData.php';
   $dd = new DiagnosticData();
   $pd = new PatientData();
  try{
      //  echo "appointment ...............".$_GET['appointmentid'];
        $result = $dd->getPatientTestDetails($_GET['appointmentid']);
       // print_r($result);
        $patientdetails = $pd->patientDetails($result[0]->patientid);

        $data = json_decode($patientdetails);
          //      print_r($data[0]->name);
  }  catch (Exception $e){
      echo $e->getMessage();
  }
  ?>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/labmain.js"></script>
<script>
 function printReceipts(){
  
        $('#generateBill').hide();
    
          window.print();
          
          return true;
        
 }
</script>
<div class="col-md-12 sky-form" id="patientsamplecollection">
    <input type="hidden" id="host" value="<?php   print( $_SESSION['host']);     ?>" />  
      <input type="hidden" id="rootnode" value="<?php print_r($_SESSION['rootNode']);?>" />
                    <section id="errormessages" class="col col-4 alert alert-info">
                        <font color="red"> <span id="errorDisplay"></span> </font>
                    </section>
                    <div class="margin-bottom-40 ">                        
                        <div class="sky-form">
                            <form action="../../Business/CollectSamples.php" method="post">
                                <input type="button" class="button"  name="generateBill" id="generateBill" value="Print"  onclick="return printReceipts()"/>
                             <br/><br/><br/>
                        <fieldset>
                           
               
                            <table width="70%" border="0"  class="table table-striped" style="border-collapse: collapse;" id="appointment_test_prescribed">
                                <tbody>
                          <?php $counter = 0; foreach($result as $tests){ ?>          
                                <tr align="left">
                                    <td><input type="checkbox" value="<?php echo $tests->constid;  ?>" id="testsample<?php echo $counter; ?>"  name="testsample<?php echo $counter; ?>"/></td>
                                    <td><b><?php echo $tests->testname; ?></b></td>
                                    <td>
                                        <table style="border: 1px;border: dotted;width: 80%" >
                                            <tr align="left">
                                                <td width="30%" nowrap>Patient ID : </td>
                                                <td align="left" nowrap><?php echo $data[0]->ID; ?></td>
                                            </tr>
                                             <tr align="left">
                                                <td width="30%" nowrap>Patient Name : </td>
                                                <td align="left" nowrap><?php echo $data[0]->name; ?></td>
                                            </tr>
                                             <tr align="left">
                                                <td width="30%" nowrap>Test Name : </td>
                                                <td align="left" nowrap><?php echo $tests->testname; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><hr/></td>
                                </tr>
                          <?php $counter++; } ?>      
                                </tbody>
                               
                            </table> 
                            <input type="hidden" name="recordcount" id="recordcount" value="<?php  echo $counter; ?>"/>
                                  <input type="hidden" name="hidpatientid" id="hidpatientid"/>
                                 <input type="hidden" name="appointmentidhid" id="appointmentidhid"/>
                        </fieldset>
                       </form>     
                      </div>
                </div>
               
</div>