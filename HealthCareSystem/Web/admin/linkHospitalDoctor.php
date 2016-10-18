<?php

$md = new MasterData();
$userData = $md->getNonActiveUsers('Doctor');

if(count($userData) > 0){
    
    $hospitalData = $md->getHosiptalData();
}
?>
<div class="col-md-12">
    <form action="../../Business/LinkAdminHospitalDoctorUser.php" method="POST">
        <?php if(isset($_GET['msg'])) {?>
            <div class="alert alert-info fade in"><span id="adminErrorMessage">Please select doctor and then press Submit</span></div>
           <?php  } ?>
     <div  class="pull-left">
         
     </div>       
     <div  class="pull-right">
            <?php $count = count($userData);?>
             <input type="submit" value=" Attach Hospital to Doctor "  class="btn-u btn-u-primary" id="activateStaffDoctorUser"  <?php if($count < 1){ echo "disabled";}?>/>
     </div>
    <div class="panel panel-orange margin-bottom-40">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-edit"></i>Users List
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
                   <th></th>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile # </th>
                    <th>Institution Name</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; foreach($userData as $user) { ?>
                <tr>
                    <td><!-- <input type="checkbox" value="<?php echo $user->ID;?>" class='doctorCheckbox' name="<?php echo $count;?>"/> -->
                    
                    	<input type="checkbox" value="<?php echo $user->ID;?>" class='doctorCheckbox' name="selectedDoctor[]"/>
                    </td>
                     <td><?php echo $user->ID;?></td>
                    <td><?php echo $user->firstname;?></td>
                    <td><?php echo $user->middlename;?></td>
                    <td><?php echo $user->lastname;?></td>
                    
                    <td><?php echo $user->email;?></td>
                    <td><?php echo $user->mobile;?></td>
                    <td>
                        <select name="<?php echo "hospital".$count;?>" class="form-control">
                             <option value="">-- Select Institution --</option>
                             <?php foreach($hosiptal as $data){?>
                                <option value="<?php echo $data->id;?>"><?php echo $data->hosiptalname;?></option>
                             <?php } ?>  
                       </select>
                        
                        
                    </td>
                    
                </tr>
                <?php $count++; } if($count == 0){ ?>
                <tr><td colspan="8" align="center"><h5><font color="blue">-- No Doctors to Link ! --</font></h5></td></tr>
                <?php } ?>
                <input type="hidden" value="" id="doctorsCheckedCount" name="doctorsCheckedCount"/>
                <input type="hidden" name="recordcount" value="<?php echo $count;?>"/>
            </tbody>
        </table>
     </div>
    </form>  
</div>