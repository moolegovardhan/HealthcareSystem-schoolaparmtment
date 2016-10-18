<?php
//session_start();
include_once ('../../Business/MedicalData.php');

$md = new MedicalData();

$testId = $_GET['testId'];
if( isset( $_SESSION['userid'] ) && !isset( $_GET['medicinename'] ) )
   {//echo "Hello in phat";
      $medicineData = $md->getUnMapDoctorMedicinData();
    }
    
  if(isset( $_GET['medicinename'] )){
     // echo "Hello in get";
      $medicineData = $md->getUnMapDoctorMedicinDataByMedicineName($_GET['medicinename']);
  } 
  

?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>

function showMedicinesSearch(){
    doctorId = $('#doctorId').val();
    doctorName = $('#doctorname').val();
    medicineName = $('#medicinename').val();
    window.location.href = "medicalindex.php?page=mapdoctormedicines&doctorId="+doctorId+"&name="+doctorName+"&medicinename="+medicineName;
}
</script>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-11">  
     <form action="#" id="sky-form" class="sky-form" method="POST" >  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="medicinename" name="medicinename" placeholder="Medicine Name">
                    </label>
                    <i><font color="red"><span id="medicinename"></span></font></i>
                </section>
                <input type="hidden" name="doctorId" id="doctorId" value="<?php echo $_GET['doctorId'] ?>"/>
             <input type="hidden" name="doctorname" id="doctorname"  value="<?php echo $_GET['name'] ?>"/>
                <section class="col">
                    <input type="button" class="btn-u pull-right"  name="button" id="searchMedicineToDoctor" value="Search" onclick="showMedicinesSearch()"/>
                </section>
            </div>
         </fieldset> 
         </form>
    <fieldset>
       <section class="col col-md-12">
           
           <div class="panel panel-orange margin-bottom-40">
            <input type="button" class="btn-u pull-right"  name="button" id="searchPrescription" onclick="linkMedicineToDoctor('<?php echo $_GET['doctorId']?>')" value="Map Medicines To Dr <?php echo $_GET['name']?>"/> 
                
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Medicines's
                 </h5>
            </div>
            <table class="table table-striped" id="">
                <thead>
                    <tr>
                        <th></th>
                        <th>Company Name</th>
                        <th>Medicine Name</th>
                        <th>Type</th>
                        <th>Dosage</th>
                        <th>Units</th>
                        
                    </tr>
                 </thead>    
                     <?php foreach($medicineData as $value){?>
                        <tr>
                            <td><input type="checkbox" class="link-doctor" id="<?php echo $value->id; ?>" value="<?php echo $value->id; ?>"/></td>
                            <td><?php echo $value->company; ?></td>
                            <td><?php echo $value->medicinename; ?></td>
                            <td><?php echo $value->medicinetype; ?></td>
                            <td><?php echo $value->strength; ?></td>
                            <td><?php echo $value->units; ?></td>
                        </tr>
                      <?php }?>
                <tbody>

                </tbody>
            </table>
        </div> 
      </section>
   </fieldset>  
    
    
    <div class="modal fade" id="myDoctorMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Medicines</h4>
                </div>
                <div class="modal-body">
                
                    
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company Name</th>
                                    <th>Medicine Name</th>
                                    <th> Technical Name</th>
                                </tr>
                             </thead>    

                                    <tr>

                                        <td>1</td>
                                        <td>DR Reddy</td>
                                        <td>Brufen </td>
                                        <td>Headace</td>
                                    </tr>

                            <tbody>

                            </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                     <button data-dismiss="modal" class="btn-u btn-u-orange" type="button">Submit</button>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
    
</div>
</div>
