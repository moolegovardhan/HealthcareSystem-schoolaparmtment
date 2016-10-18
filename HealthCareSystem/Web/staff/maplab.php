<?php
include_once '../../Business/DiagnosticData.php';
$dd = new DiagnosticData();

if($_POST['name'] == ""){
    $diagnosticsList = $dd->fetchListOfDiagnosticCenters($_SESSION['officeid']);
} else {
    $diagnosticsList = $dd->fetchListOfDiagnosticCentersGivenName($_SESSION['officeid'],$_POST['name']);
} 
if(count($userData) > 0){
    
    $hospitalData = $md->getHosiptalData();
}
?>
<div class="col-md-12 sky-form">
    <div  class="pull-left">
        <fieldset>
        <form action="#" method="POST">
     
         <section class="col-md-7">
             <label class="input">
                <i class="icon-append fa fa-users"></i>
                <input type="text" id="name" name="name" placeholder="Name" size="40" value="<?php  echo $_POST['name']; ?>">
                <input type="hidden" name="hospitalname" value="<?php echo $hosiptalName[0]->hosiptalname;?>" />
            </label>
             
         </section> 
         <section class="col-md-5">
               <input type="submit" value="Search Diagnostics" class="btn-u btn-u-primary" id="staffDoctor"/>
                
             
         </section>
        </form>
            </fieldset>
     </div>
    
    <form action="../../Business/MapLabAndDiagnostics.php" method="POST">
        
        <input type="hidden" name="mapfor" id="mapfor" value="lab" >
        <?php if(isset($_GET['msg'])) {?>
            <div class="alert alert-info fade in"><span id="adminErrorMessage">Please select Diagnostics and then press Submit</span></div>
           <?php  } ?>
            <?php $count = count($diagnosticsList);?>
   
    <div class="panel panel-orange margin-bottom-40">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-edit"></i>Diagnostics List
            <!--section class="pull-right col col-md-4">
             <select name="institutionType" class="form-control pull-right">
                <option value="">-- Select Institution Type --</option>
                
                   <option value="Lab">Lab</option>
                   <option value="Medical">Medical Shop</option>
                   <option value="Hospital">Hospital</option>
               
           </select> 
           </section--> 
            <div class="pull-right">
             <input  type="submit" value="Attach Diagnostics to <?php echo $hosiptalName[0]->hosiptalname;?>"class="btn-u btn-u-primary" id="activateUser" <?php if($count < 1){ echo "disabled";}?>/>
           </div>
            </h3>
                
        </div>
        <table class="table table-striped" id="staff_hosiptal_NonActive_data">
            <thead>
                <tr>
                   <td></td>
                    <td>Diagnostics Name</td>
                    <td>Address</td>
                    <td>City</td>
                    <td>Mobile #</td>
                    <td>Landline # </td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; foreach($diagnosticsList as $diagnostics) { ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $diagnostics->id;?>" name="<?php echo $count;?>"/></td>
                     <td><?php echo $diagnostics->diagnosticsname;?></td>
                    <td><?php echo $diagnostics->haddress;?></td>
                    <td><?php echo $diagnostics->city;?></td>
                    <td><?php echo $diagnostics->mobile;?></td>
                    
                    <td><?php echo $diagnostics->landline;?></td>
                    <td><?php echo $diagnostics->email;?></td>
                  
                    
                </tr>
                <?php $count++; } if($count == 0){ ?>
                <tr><td colspan="7" align="center"><h5><font color="blue">-- No Data to Link ! --</font></h5></td></tr>
                <?php } ?>
                <input type="hidden" name="recordcount" value="<?php echo $count;?>"/>
            </tbody>
        </table>
     </div>
    </form>  
</div>