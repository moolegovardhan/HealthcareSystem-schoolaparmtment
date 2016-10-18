<?php

$md = new MasterData();
$userData = $md->getNonActiveStaffUsers('Staff',$_POST['name']);

if(count($userData) > 0){
    
    $hospitalData = $md->getHosiptalData();
}
?>
<div class="col-md-12 sky-form">
    <div  class="pull-left">
        <form action="#" method="POST">
     
         <section class="col col-md-7">
             <label class="input">
                <i class="icon-append fa fa-users"></i>
                <input type="text" id="name" name="name" placeholder="Name" size="40" value="<?php  echo $_POST['name']; ?>">
                <input type="hidden" name="hospitalname" value="<?php echo $hosiptalName[0]->hosiptalname;?>" />
            </label>
             
         </section> 
         <section class="col col-md-5">
               <input type="submit" value="Search Staff" class="btn-u btn-u-primary" id="staffDoctor"/>
                
             
         </section>
        </form>
     </div>
    <form action="../../Business/ActivateHospitalStaffUser.php" method="POST">
        <?php if(isset($_GET['msg'])) {?>
            <div class="alert alert-info fade in"><span id="adminErrorMessage">Please select doctor and then press Submit</span></div>
           <?php  } ?>
     <div  class="pull-left">
         
     </div>       
     <div  class="pull-right">
         <?php $count = count($userData);?>
             <input type="submit" value="Attach Staff to <?php echo $hosiptalName[0]->hosiptalname;?>" class="btn-u btn-u-primary" id="activateUser" <?php if($count < 1){ echo "disabled";}?>/>
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
                   <td></td>
                    <td>Id</td>
                    <td>First Name</td>
                    <td>Middle Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Mobile # </td>
                    <td>Role</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; foreach($userData as $user) { ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $user->ID;?>" name="<?php echo $count;?>"/></td>
                     <td><?php echo $user->ID;?></td>
                    <td><?php echo $user->firstname;?></td>
                    <td><?php echo $user->middlename;?></td>
                    <td><?php echo $user->lastname;?></td>
                    
                    <td><?php echo $user->email;?></td>
                    <td><?php echo $user->mobile;?></td>
                   
                    <td>
                        Staff
                        
                    </td>
                    
                </tr>
                <?php $count++; }  if($count == 0){ ?>
                <tr><td colspan="7" align="center"><h5><font color="blue">-- No Data to Link ! --</font></h5></td></tr>
                <?php } ?>
                <input type="hidden" name="recordcount" value="<?php echo $count;?>"/>
            </tbody>
        </table>
     </div>
    </form>  
</div>