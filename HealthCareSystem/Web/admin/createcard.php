<?php

$md = new MasterData();
$userData = $md->getNonActiveUsers('Medical');

if(count($userData) > 0){
    
    $medicalData = $md->getMedicalShopData();
}
?>
<div class="col-md-12">
    <form action="../../Business/CreateCardDetails.php" method="POST">
    <input type="hidden" name="from_page" value="medical">
        <?php if(isset($_GET['msg'])) {?>
            <div class="alert alert-info fade in"><span id="adminErrorMessage">Please select Lab and then press Submit</span></div>
           <?php  } ?>
     <div  class="pull-left">
         
     </div>       
     <div  class="pull-right">
          <?php $count = count($userData);?>
             <input type="submit" value=" Submit "class="btn-u btn-u-primary" id=""/>
     </div>
    <div class="panel panel-orange margin-bottom-40">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-edit"></i>Card's Info
            <!--section class="pull-right col col-md-4">
             <select name="institutionType" class="form-control pull-right">
                <option value="">-- Select Institution Type --</option>
                
                   <option value="Lab">Lab</option>
                   <option value="Medical">Medical Shop</option>
                   <option value="Hospital">Hospital</option>
               
           </select> 
           </section--> 
            </h3>
                
        </div>
        <table class="table table-striped" id="staff_hosiptal_NonActive_data">
            <thead>
                <tr>
                  
                    <th>Feature Type</th>
                    <th>Promotional</th>
                    <th>General</th>
                    <th>Silver</th>
                    <th>1.5L</th>
                    <th>3.0 L</th>
                    <th>4.5 L</th>
                    <th>7.5 L</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>Doctor Appointment</td>
                   <td><input type="checkbox" name='pda'/></td>
                    <td><input type="checkbox" name='gda'/></td>
                    <td><input type="checkbox" name='sda'/></td>
                    <td><input type="checkbox" name='15da'/></td>
                    <td><input type="checkbox" name='3da'/></td>
                    <td><input type="checkbox" name='45da'/></td>
                    <td><input type="checkbox" name='75da'/></td>
                </tr>
                <tr>
                   <td>Medical Kit</td>
                   <td><input type="checkbox" name='pmk'/></td>
                    <td><input type="checkbox" name='gmk'/></td>
                    <td><input type="checkbox" name='smk'/></td>
                    <td><input type="checkbox" name='15mk'/></td>
                    <td><input type="checkbox" name='3mk'/></td>
                    <td><input type="checkbox" name='45mk'/></td>
                    <td><input type="checkbox" name='75mk'/></td>
                </tr>
                <tr>
                   <td>Lab Reports</td>
                   <td><input type="checkbox" name='plr'/></td>
                    <td><input type="checkbox" name='glr'/></td>
                    <td><input type="checkbox" name='slr'/></td>
                    <td><input type="checkbox" name='15lr'/></td>
                    <td><input type="checkbox" name='3lr'/></td>
                    <td><input type="checkbox" name='45lr'/></td>
                    <td><input type="checkbox" name='75lr'/></td>
                </tr>
                <tr>
                   <td>Dietitian calls</td>
                   <td><input type="checkbox" name='pdc'/></td>
                    <td><input type="checkbox" name='gdc'/></td>
                    <td><input type="checkbox" name='sdc'/></td>
                    <td><input type="checkbox" name='15dc'/></td>
                    <td><input type="checkbox" name='3dc'/></td>
                    <td><input type="checkbox" name='45dc'/></td>
                    <td><input type="checkbox" name='75dc'/></td>
                </tr>
                
                
            </tbody>
        </table>
     </div>
    </form>  
</div>